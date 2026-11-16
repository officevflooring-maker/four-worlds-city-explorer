// Tests for the Stripe store in src/store.js and the download pages in src/worker.js, with a pretend Stripe, an
// in-memory database standing in for D1 (node:sqlite) and a pretend file store. Nothing leaves this computer.
// Run: node tools/store-test.mjs   (Node 22 or newer). It prints each test and "N passed" at the end.
import { DatabaseSync } from 'node:sqlite';
import { readFileSync } from 'node:fs';

/* ---------- stand-ins for Cloudflare's D1, KV and ASSETS ---------- */
function makeDB() {
  const db = new DatabaseSync(':memory:');
  db.exec(readFileSync(new URL('../src/schema.sql', import.meta.url), 'utf8'));
  const stmt = (sql, args = []) => ({
    bind: (...a) => stmt(sql, a),
    first: async () => db.prepare(sql).get(...args) ?? null,
    all: async () => ({ results: db.prepare(sql).all(...args) }),
    run: async () => { db.prepare(sql).run(...args); return { success: true }; },
    _exec: () => (/^\s*(SELECT|WITH)/i.test(sql) ? { results: db.prepare(sql).all(...args) } : (db.prepare(sql).run(...args), { results: [] })),
  });
  return { prepare: (sql) => stmt(sql), batch: async (list) => list.map((s) => s._exec()), raw: db };
}
const makeKV = () => {
  const m = new Map();
  return { m, put: async (k, v) => m.set(k, typeof v === 'string' ? v : await new Response(v).text()), get: async (k) => (m.has(k) ? new Response(m.get(k)).body : null) };
};
const ASSETS = { fetch: async () => new Response('a site file', { status: 200 }) };

/* ---------- a pretend Stripe ---------- */
const STRIPE = { calls: [], sessions: {}, failSessions: false, failPrices: false, n: 0 };
globalThis.fetch = async (url, init = {}) => {
  url = String(url);
  if (!url.startsWith('https://api.stripe.com/v1/')) throw new Error('unexpected fetch ' + url);
  const path = url.slice('https://api.stripe.com/v1/'.length);
  const f = Object.fromEntries(new URLSearchParams(init.body || ''));
  STRIPE.calls.push({ method: init.method, path, f, auth: init.headers.Authorization, version: init.headers['Stripe-Version'] });
  const json = (o, status = 200) => new Response(JSON.stringify(o), { status, headers: { 'Content-Type': 'application/json' } });
  if (init.method === 'POST' && path === 'checkout/sessions') {
    if (STRIPE.failSessions) return json({ error: { message: 'Managed Payments is not enabled' } }, 400);
    const live = init.headers.Authorization.includes('_live_');
    const id = `cs_${live ? 'live' : 'test'}_a1B2c3D4e5F6g7H8i9J0k${++STRIPE.n}`;
    STRIPE.sessions[id] = { id, object: 'checkout.session', status: 'complete', payment_status: 'paid', livemode: live, amount_total: Number(f['line_items[0][price_data][unit_amount]'] || 300), currency: 'usd', metadata: { store: f['metadata[store]'], slug: f['metadata[slug]'] } };
    return json({ id, url: 'https://checkout.stripe.com/c/pay/' + id });
  }
  if (init.method === 'POST' && path === 'prices') {
    if (STRIPE.failPrices) return json({ error: { message: 'custom_unit_amount is not supported' } }, 400);
    return json({ id: 'price_pwyw' + (++STRIPE.n) });
  }
  if (init.method === 'GET' && path.startsWith('checkout/sessions/')) {
    const s = STRIPE.sessions[path.split('/')[2]];
    return s ? json(s) : json({ error: { message: 'No such session' } }, 404);
  }
  return json({ error: { message: 'not handled' } }, 400);
};

const logged = [];
console.error = (e) => logged.push(String((e && e.message) || e));   // the store logs Stripe's refusals; tests expect some
const { default: worker } = await import('../src/worker.js');
const CATALOG = JSON.parse(readFileSync(new URL('../src/catalog.json', import.meta.url), 'utf8'));

/* ---------- helpers ---------- */
const STATS = 'stats-key-for-tests-0123';
const LIVE = 'rk_live_testtesttest', TESTKEY = 'sk_test_testtesttest', WHSEC = 'whsec_livesecret', WHSEC_T = 'whsec_testsecret';
function makeEnv(extra = {}) {
  const DB = makeDB();
  DB.raw.prepare('INSERT INTO settings (k, v) VALUES (?, ?)').run('stats_key', STATS);
  return { DB, FILES: makeKV(), ASSETS, STRIPE_MANAGED: 'on', STRIPE_TAX: 'off', ...extra };
}
const files = (slug, name, size = 11) => JSON.stringify([{ name, note: 'A test', letter: [`${slug}-letter.pdf`, size], a4: [`${slug}-a4.pdf`, size] }]);
const addItem = (env, slug, name = slug) => env.DB.raw.prepare('INSERT INTO items (slug, title, files) VALUES (?, ?, ?)').run(slug, name, files(slug, name));
const ctx = { waitUntil: (p) => p };
const get = (env, path, headers = {}) => worker.fetch(new Request('https://atlasofcities.org' + path, { headers: { 'User-Agent': 'Mozilla/5.0', ...headers } }), env, ctx);
async function hook(env, event, secret = WHSEC, t = Math.floor(Date.now() / 1000)) {
  const body = JSON.stringify(event);
  const k = await crypto.subtle.importKey('raw', new TextEncoder().encode(secret), { name: 'HMAC', hash: 'SHA-256' }, false, ['sign']);
  const mac = [...new Uint8Array(await crypto.subtle.sign('HMAC', k, new TextEncoder().encode(`${t}.${body}`)))].map((b) => b.toString(16).padStart(2, '0')).join('');
  return worker.fetch(new Request('https://atlasofcities.org/stripe-webhook', { method: 'POST', body, headers: { 'Stripe-Signature': `t=${t},v1=${mac}` } }), env, ctx);
}
const lastSession = () => STRIPE.calls.filter((c) => c.path === 'checkout/sessions' && c.method === 'POST').at(-1);
const paidEvent = (id, slug, extra = {}) => ({ type: 'checkout.session.completed', data: { object: { id, object: 'checkout.session', status: 'complete', payment_status: 'paid', livemode: !id.includes('_test_'), amount_total: 399, currency: 'usd', metadata: { store: 'atlas-store', slug }, ...extra } } });

let passed = 0;
const failures = [];
async function t(name, fn) {
  try { await fn(); passed++; console.log('ok   ' + name); } catch (e) { failures.push(name); console.log('FAIL ' + name + '\n     ' + e.message); }
}
function eq(a, b, what = '') { if (a !== b) throw new Error(`${what} expected ${JSON.stringify(b)}, got ${JSON.stringify(a)}`); }
function ok(v, what) { if (!v) throw new Error(what); }

/* ---------- the catalog ---------- */
await t('catalog: every product has a name, a price in cents, a Stripe tax code, a page and a picture', () => {
  for (const [slug, p] of Object.entries(CATALOG)) {
    ok(p.name && p.line && Number.isInteger(p.price) && p.price >= 100, slug + ' name/line/price');
    ok(/^txcd_\d{8}$/.test(p.tax), slug + ' tax');
    ok(/^https:\/\//.test(p.page) && /^https:\/\/.+\.(jpg|png)$/.test(p.image), slug + ' page/image');
  }
  eq(CATALOG['city-builders'].price, 399, 'City Builders');
  eq(CATALOG.bundle.price, 3499, 'bundle');
  eq(CATALOG['life-rpg'].kind, 'key', 'Life RPG kind');
  eq(CATALOG.posters.from, true, 'posters pay what you want');
  eq(CATALOG.posters.price, 200, 'posters minimum');
  eq(CATALOG.posters.preset, 399, 'posters suggested');
  eq(CATALOG['esp-advent'].site, 'esp', 'Advent site');
});

/* ---------- /buy/ ---------- */
await t('buy: without a Stripe key the button still opens the Etsy listing', async () => {
  const r = await get(makeEnv(), '/buy/city-builders/');
  eq(r.status, 302); eq(r.headers.get('Location'), 'https://www.etsy.com/listing/4607212846');
});
await t('buy: a test key alone is never used for the public button', async () => {
  const r = await get(makeEnv({ STRIPE_KEY: TESTKEY }), '/buy/city-builders/');
  eq(r.headers.get('Location'), 'https://www.etsy.com/listing/4607212846');
});
await t('buy: Life RPG without a key goes to its page (it has no Etsy listing)', async () => {
  const r = await get(makeEnv(), '/buy/life-rpg/');
  eq(r.headers.get('Location'), 'https://atlasofcities.org/life-rpg/');
});
await t('buy: with a live key, a product whose files are not uploaded yet still goes to Etsy', async () => {
  const before = STRIPE.calls.length;
  const r = await get(makeEnv({ STRIPE_KEY: LIVE }), '/buy/esp-advent/');
  eq(r.headers.get('Location'), 'https://www.etsy.com/listing/4613093078'); eq(STRIPE.calls.length, before, 'Stripe calls');
});
await t('buy: unknown product is a 404, and /buy/slug without the slash adds it', async () => {
  eq((await get(makeEnv(), '/buy/nothing/')).status, 404);
  const r = await get(makeEnv(), '/buy/city-builders?x=1');
  eq(r.status, 301); eq(r.headers.get('Location'), 'https://atlasofcities.org/buy/city-builders/?x=1');
});
await t('buy: search robots are sent to the product page, with no checkout made', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE }); addItem(env, 'city-builders');
  const before = STRIPE.calls.length;
  const r = await get(env, '/buy/city-builders/', { 'User-Agent': 'Googlebot/2.1' });
  eq(r.headers.get('Location'), 'https://atlasofcities.org/city-builders/'); eq(STRIPE.calls.length, before, 'Stripe calls');
});
await t('buy: makes a Managed Payments checkout with the right price, tax code, picture and tags', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE }); addItem(env, 'city-builders');
  const r = await get(env, '/buy/city-builders/');
  eq(r.status, 303); ok(r.headers.get('Location').startsWith('https://checkout.stripe.com/'), 'goes to Stripe');
  const c = lastSession(), f = c.f;
  eq(c.auth, 'Bearer ' + LIVE); eq(c.version, '2026-04-22.dahlia', 'API version');
  eq(f.mode, 'payment'); eq(f['managed_payments[enabled]'], 'true'); eq(f['automatic_tax[enabled]'], undefined, 'no Stripe Tax with MP');
  eq(f['line_items[0][price_data][unit_amount]'], '399'); eq(f['line_items[0][price_data][currency]'], 'usd');
  eq(f['line_items[0][price_data][product_data][name]'], 'City Builders');
  eq(f['line_items[0][price_data][product_data][tax_code]'], 'txcd_10503000');
  eq(f['line_items[0][price_data][product_data][images][0]'], 'https://atlasofcities.org/assets/og/city-builders.jpg');
  eq(f['metadata[store]'], 'atlas-store'); eq(f['metadata[slug]'], 'city-builders');
  eq(f.success_url, 'https://atlasofcities.org/thanks/?session_id={CHECKOUT_SESSION_ID}');
  eq(f.cancel_url, 'https://atlasofcities.org/city-builders/');
  for (const k of Object.keys(f)) ok(!/payment_method_types|shipping|statement_descriptor|invoice_creation|tax_id/.test(k), 'unsupported with Managed Payments: ' + k);
});
await t('buy: with Managed Payments off and STRIPE_TAX on, Stripe Tax is asked for instead', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE, STRIPE_MANAGED: 'off', STRIPE_TAX: 'on' }); addItem(env, 'journey');
  await get(env, '/buy/journey/');
  const f = lastSession().f;
  eq(f['managed_payments[enabled]'], undefined); eq(f['automatic_tax[enabled]'], 'true');
});
await t('buy: Life RPG sells without files', async () => {
  const r = await get(makeEnv({ STRIPE_KEY: LIVE }), '/buy/life-rpg/');
  eq(r.status, 303); eq(lastSession().f['line_items[0][price_data][unit_amount]'], '500');
  eq(lastSession().f['line_items[0][price_data][product_data][tax_code]'], 'txcd_10201000');
});
await t('buy: the Poster Set is pay what you want (a Stripe price made once, then remembered)', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE }); addItem(env, 'posters');
  await get(env, '/buy/posters/');
  const priceCall = STRIPE.calls.filter((c) => c.path === 'prices').at(-1);
  eq(priceCall.f['custom_unit_amount[minimum]'], '200'); eq(priceCall.f['custom_unit_amount[preset]'], '399'); eq(priceCall.f['custom_unit_amount[enabled]'], 'true');
  const used = lastSession().f['line_items[0][price]'];
  ok(/^price_pwyw/.test(used), 'session uses the price');
  const nPrices = STRIPE.calls.filter((c) => c.path === 'prices').length;
  await get(env, '/buy/posters/');
  eq(STRIPE.calls.filter((c) => c.path === 'prices').length, nPrices, 'price made only once');
  eq(lastSession().f['line_items[0][price]'], used);
});
await t('buy: if Stripe refuses pay what you want, the Poster Set sells at its suggested $3.99', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE }); addItem(env, 'posters');
  STRIPE.failPrices = true;
  try { await get(env, '/buy/posters/'); } finally { STRIPE.failPrices = false; }
  eq(lastSession().f['line_items[0][price_data][unit_amount]'], '399');
});
await t('buy: if Stripe refuses the checkout, the buyer goes to Etsy instead of an error', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE }); addItem(env, 'bingo');
  STRIPE.failSessions = true;
  let r; try { r = await get(env, '/buy/bingo/'); } finally { STRIPE.failSessions = false; }
  eq(r.status, 302); eq(r.headers.get('Location'), 'https://www.etsy.com/listing/4607214008');
});
await t('buy: test purchases need the owner\'s key and use the test-mode Stripe key', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE, STRIPE_TEST_KEY: TESTKEY }); addItem(env, 'trivia');
  eq((await get(env, '/buy/trivia/?test=wrong')).status, 404);
  const r = await get(env, '/buy/trivia/?test=' + STATS);
  eq(r.status, 303); eq(lastSession().auth, 'Bearer ' + TESTKEY);
  const noTest = await get(makeEnv(), '/buy/trivia/?test=' + STATS);
  eq(noTest.status, 503, 'no test key set');
});

/* ---------- the webhook ---------- */
await t('webhook: refuses a message without a good signature', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC });
  eq((await hook(env, paidEvent('cs_live_aaaaaaaaaaaaaaa1', 'journey'), 'whsec_wrong')).status, 400);
  eq((await hook(env, paidEvent('cs_live_aaaaaaaaaaaaaaa1', 'journey'), WHSEC, Math.floor(Date.now() / 1000) - 3600)).status, 400, 'old');
  eq(env.DB.raw.prepare('SELECT COUNT(*) AS n FROM orders').get().n, 0);
});
await t('webhook: a paid checkout makes one order (also when Stripe sends it twice)', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC });
  eq((await hook(env, paidEvent('cs_live_bbbbbbbbbbbbbbb1', 'journey'))).status, 200);
  eq((await hook(env, paidEvent('cs_live_bbbbbbbbbbbbbbb1', 'journey'))).status, 200);
  const rows = env.DB.raw.prepare('SELECT * FROM orders').all();
  eq(rows.length, 1); eq(rows[0].slug, 'journey'); eq(rows[0].live, 1); eq(rows[0].amount, 399); ok(/^[A-Za-z0-9]{32}$/.test(rows[0].token), 'token'); eq(rows[0].license, null);
  ok(!Object.keys(rows[0]).some((k) => /mail|name|card/.test(k)), 'no personal data columns');
});
await t('webhook: test-mode messages are checked with the test secret', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC, STRIPE_TEST_WEBHOOK_SECRET: WHSEC_T });
  eq((await hook(env, paidEvent('cs_test_ccccccccccccccc1', 'memory'), WHSEC_T)).status, 200);
  eq(env.DB.raw.prepare('SELECT live FROM orders').get().live, 0);
});
await t('webhook: ignores other payments on the same Stripe account, and unpaid ones', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC });
  await hook(env, paidEvent('cs_live_ddddddddddddddd1', 'journey', { metadata: { source: 'website' } }));
  await hook(env, paidEvent('cs_live_ddddddddddddddd2', 'journey', { payment_status: 'unpaid' }));
  await hook(env, { type: 'payment_intent.succeeded', data: { object: { id: 'pi_1' } } });
  eq(env.DB.raw.prepare('SELECT COUNT(*) AS n FROM orders').get().n, 0);
});
await t('webhook: a later-paid checkout (async_payment_succeeded) makes the order', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC });
  const e = paidEvent('cs_live_eeeeeeeeeeeeeee1', 'dominoes'); e.type = 'checkout.session.async_payment_succeeded';
  await hook(env, e);
  eq(env.DB.raw.prepare('SELECT COUNT(*) AS n FROM orders').get().n, 1);
});
await t('webhook: a Life RPG order gets a key like LIFE-XXXX-XXXX-XXXX-XXXX', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC });
  await hook(env, paidEvent('cs_live_fffffffffffffff1', 'life-rpg'));
  ok(/^LIFE-[A-Z2-9]{4}-[A-Z2-9]{4}-[A-Z2-9]{4}-[A-Z2-9]{4}$/.test(env.DB.raw.prepare('SELECT license FROM orders').get().license), 'key shape');
});

/* ---------- /thanks/ and the download page ---------- */
await t('thanks: the full buy, pay and download path', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE }); addItem(env, 'storybook', 'Storybook');
  await env.FILES.put('f:storybook-letter.pdf', '%PDF-test');
  const r1 = await get(env, '/buy/storybook/');
  const id = r1.headers.get('Location').split('/').pop();
  const r2 = await get(env, '/thanks/?session_id=' + id);          // no webhook yet: asks Stripe
  eq(r2.status, 303); ok(/^\/dl\/[A-Za-z0-9]{32}\/\?new=1$/.test(r2.headers.get('Location')), 'to the download page');
  const r3 = await get(env, r2.headers.get('Location'));
  const html = await r3.text();
  eq(r3.status, 200); ok(html.includes('Thank you for your order'), 'thank-you note'); ok(html.includes('storybook-letter.pdf'), 'letter link');
  ok(!html.includes('TEST purchase'), 'not a test'); eq(r3.headers.get('X-Robots-Tag'), 'noindex, nofollow');
  const dl = r2.headers.get('Location').replace('?new=1', '');
  const f = await get(env, dl + 'storybook-letter.pdf');
  eq(f.status, 200); eq(await f.text(), '%PDF-test'); eq(f.headers.get('Content-Type'), 'application/pdf');
  eq((await get(env, dl + 'journey-letter.pdf')).status, 404, 'a file not in this order');
  eq((await get(env, '/thanks/?session_id=' + id)).headers.get('Location'), r2.headers.get('Location'), 'same page the second time');
  eq(env.DB.raw.prepare('SELECT COUNT(*) AS n FROM orders').get().n, 1);
  eq(env.DB.raw.prepare("SELECT n FROM events WHERE name = 'order-dl-storybook'").get().n, 1, 'download counted');
});
await t('thanks: a payment still going through says so', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE });
  STRIPE.sessions.cs_live_ggggggggggggggg1 = { id: 'cs_live_ggggggggggggggg1', object: 'checkout.session', status: 'complete', payment_status: 'unpaid', livemode: true, metadata: { store: 'atlas-store', slug: 'journey' } };
  const r = await get(env, '/thanks/?session_id=cs_live_ggggggggggggggg1');
  eq(r.status, 202); ok((await r.text()).includes('still going through'), 'text');
});
await t('thanks: a made-up or foreign session goes back to the shop', async () => {
  const env = makeEnv({ STRIPE_KEY: LIVE });
  eq((await get(env, '/thanks/?session_id=nonsense')).headers.get('Location'), '/shop/');
  STRIPE.sessions.cs_live_hhhhhhhhhhhhhhh1 = { id: 'cs_live_hhhhhhhhhhhhhhh1', object: 'checkout.session', status: 'complete', payment_status: 'paid', livemode: true, metadata: { source: 'website' } };
  eq((await get(env, '/thanks/?session_id=cs_live_hhhhhhhhhhhhhhh1')).headers.get('Location'), '/shop/');
});
await t('download page: a test purchase is marked as a test', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC, STRIPE_TEST_WEBHOOK_SECRET: WHSEC_T }); addItem(env, 'memory');
  await hook(env, paidEvent('cs_test_iiiiiiiiiiiiiii1', 'memory'), WHSEC_T);
  const tok = env.DB.raw.prepare('SELECT token FROM orders').get().token;
  ok((await (await get(env, `/dl/${tok}/`)).text()).includes('TEST purchase'), 'test banner');
});
await t('download page: Life RPG shows the key and an Open Life RPG button', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC });
  await hook(env, paidEvent('cs_live_jjjjjjjjjjjjjjj1', 'life-rpg'));
  const { token, license } = env.DB.raw.prepare('SELECT token, license FROM orders').get();
  const html = await (await get(env, `/dl/${token}/`)).text();
  ok(html.includes(license), 'key shown'); ok(html.includes(`https://life-rpg.atlasofcities.org/unlock/?key=${license}`), 'open link');
});
await t('download page: an Every Stone Speaks order carries that site\'s name', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC }); addItem(env, 'esp-advent', 'The Advent Walk');
  await hook(env, paidEvent('cs_live_kkkkkkkkkkkkkkk1', 'esp-advent'));
  const html = await (await get(env, `/dl/${env.DB.raw.prepare('SELECT token FROM orders').get().token}/`)).text();
  ok(html.includes('Every Stone Speaks · Your downloads'), 'brand'); ok(html.includes('everystonespeaks.com'), 'home link');
});
await t('download page: the packs sold on Etsy still open as before', async () => {
  const env = makeEnv();
  env.DB.raw.prepare('INSERT INTO packs (token, slug, title, files) VALUES (?, ?, ?, ?)').run('P'.repeat(32), 'bundle', 'Everything Bundle', files('trivia', 'Atlas Trivia'));
  const html = await (await get(env, '/dl/' + 'P'.repeat(32) + '/')).text();
  ok(html.includes('Everything Bundle') && html.includes('trivia-a4.pdf'), 'pack page');
  ok(html.includes('through the shop you bought from'), 'Etsy help line');
  eq((await get(env, '/dl/' + 'Q'.repeat(32) + '/')).status, 404);
});

/* ---------- the owner's numbers page ---------- */
await t('stats: lists the orders with their download pages', async () => {
  const env = makeEnv({ STRIPE_WEBHOOK_SECRET: WHSEC });
  await hook(env, paidEvent('cs_live_lllllllllllllll1', 'calendar'));
  const tok = env.DB.raw.prepare('SELECT token FROM orders').get().token;
  const html = await (await get(env, `/stats/${STATS}/`)).text();
  ok(html.includes('Store orders') && html.includes('calendar') && html.includes(`/dl/${tok}/`) && html.includes('$3.99'), 'orders table');
  eq((await get(env, '/stats/wrong/')).status, 404);
});

/* ---------- the rest of the site is untouched ---------- */
await t('other addresses are the site\'s own files', async () => {
  eq(await (await get(makeEnv(), '/shop/')).text(), 'a site file');
});

console.log(failures.length ? `\n${failures.length} FAILED, ${passed} passed` : `\n${passed} passed`);
process.exit(failures.length ? 1 : 0);
