// Tests for the free sampler's email list (src/signup.js, routed by src/worker.js) and the pages that carry its
// forms (built by build/packs.php into public/free/). An in-memory database stands in for D1 (node:sqlite).
// Nothing leaves this computer. Run: php build/build.php, then node tools/signup-test.mjs (Node 22 or newer).
import { DatabaseSync } from 'node:sqlite';
import { readFileSync, existsSync } from 'node:fs';

const root = new URL('../', import.meta.url);
const read = (path) => readFileSync(new URL(path, root), 'utf8');
const SCHEMA = read('src/schema.sql');

/* ---------- stand-ins for Cloudflare's D1 and ASSETS (the same as tools/store-test.mjs) ---------- */
function makeDB(schema = SCHEMA) {
  const db = new DatabaseSync(':memory:');
  db.exec(schema);
  const stmt = (sql, args = []) => ({
    bind: (...a) => stmt(sql, a),
    first: async () => db.prepare(sql).get(...args) ?? null,
    all: async () => ({ results: db.prepare(sql).all(...args) }),
    run: async () => { db.prepare(sql).run(...args); return { success: true }; },
    _exec: () => (/^\s*(SELECT|WITH)/i.test(sql) ? { results: db.prepare(sql).all(...args) } : (db.prepare(sql).run(...args), { results: [] })),
  });
  return { prepare: (sql) => stmt(sql), batch: async (list) => list.map((s) => s._exec()), raw: db };
}
const ASSETS = { fetch: async () => new Response('a site file', { status: 200 }) };
globalThis.fetch = async (url) => { throw new Error('unexpected fetch ' + url); };   // the list never calls out

const { default: worker } = await import('../src/worker.js');
const { cleanEmail, PROMISE } = await import('../src/signup.js');

const STATS = 'stats-key-for-tests-0123';
function makeEnv(extra = {}, schema) {
  const DB = makeDB(schema);
  DB.raw.prepare('INSERT INTO settings (k, v) VALUES (?, ?)').run('stats_key', STATS);
  return { DB, ASSETS, ...extra };
}
const ctx = { waitUntil: (p) => p };
const SITE = 'https://atlasofcities.org';
const get = (env, path) => worker.fetch(new Request(SITE + path, { headers: { 'User-Agent': 'Mozilla/5.0' } }), env, ctx);
const post = (env, path, fields, headers = {}) => worker.fetch(new Request(SITE + path, {
  method: 'POST', body: new URLSearchParams(fields).toString(),
  headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'User-Agent': 'Mozilla/5.0', Origin: SITE, 'CF-Connecting-IP': '203.0.113.7', ...headers },
}), env, ctx);
const join = (env, fields = {}, headers) => post(env, '/signup/', { email: 'Parent@Example.com', adult: 'yes', from: 'free', website: '', ...fields }, headers);
const rows = (env) => env.DB.raw.prepare('SELECT * FROM subscribers ORDER BY email').all();

let passed = 0;
const failures = [];
async function t(name, fn) {
  try { await fn(); passed++; console.log('ok   ' + name); } catch (e) { failures.push(name); console.log('FAIL ' + name + '\n     ' + e.message); }
}
function eq(a, b, what = '') { if (a !== b) throw new Error(`${what} expected ${JSON.stringify(b)}, got ${JSON.stringify(a)}`); }
function ok(v, what) { if (!v) throw new Error(what); }
const goesTo = (r, path) => { eq(r.status, 303, 'status'); eq(r.headers.get('Location'), SITE + path, 'Location'); };

/* ---------- the address check ---------- */
await t('email check: real-looking addresses pass, in lower case', () => {
  eq(cleanEmail('  Parent@Example.COM '), 'parent@example.com');
  eq(cleanEmail('a.b+class3@mail.school.k12.wa.us'), 'a.b+class3@mail.school.k12.wa.us');
  eq(cleanEmail("o'brien@example.ie"), "o'brien@example.ie");
  eq(cleanEmail('teacher@b-cher.xn--p1ai'), 'teacher@b-cher.xn--p1ai', 'international ending');
});
await t('email check: broken addresses fail', () => {
  for (const bad of ['', 'a@b', 'no-at.example.com', 'a@b@example.com', 'a..b@example.com', '.a@example.com', 'a.@example.com',
    'a@-x.com', 'a@x-.com', 'a@x.c', 'a b@example.com', '<script>@example.com', 'a@example.com<', 'x'.repeat(65) + '@example.com',
    'a@' + 'b'.repeat(250) + '.com', 'a@example..com', null, undefined]) eq(cleanEmail(bad), null, String(bad));
});

/* ---------- joining ---------- */
await t('join: keeps the address in lower case, the time, the page and the promise, then opens the thank-you page', async () => {
  const env = makeEnv();
  goesTo(await join(env), '/free/joined/');
  const r = rows(env);
  eq(r.length, 1, 'rows'); eq(r[0].email, 'parent@example.com'); eq(r[0].source, 'free'); eq(r[0].promise, PROMISE);
  eq(PROMISE, 'few-a-year', 'the promise the box on /free/ makes');
  ok(/^\d{4}-\d\d-\d\dT\d\d:\d\d:\d\dZ$/.test(r[0].created), 'created ' + r[0].created);
});
await t('join: the table keeps nothing else (no name, no IP address, no browser)', () => {
  const cols = makeDB().raw.prepare('PRAGMA table_info(subscribers)').all().map((c) => c.name).join(',');
  eq(cols, 'email,created,source,promise');
});
await t('join: the same address twice is one row, and the first date and promise stay', async () => {
  const env = makeEnv();
  await join(env);
  env.DB.raw.prepare("UPDATE subscribers SET created = '2026-01-01T00:00:00Z', promise = 'older'").run();
  goesTo(await join(env, { email: 'PARENT@example.com' }), '/free/joined/');
  const r = rows(env);
  eq(r.length, 1); eq(r[0].created, '2026-01-01T00:00:00Z'); eq(r[0].promise, 'older');
});
await t('join: without the 18+ tick, or with a broken address, nothing is kept', async () => {
  const env = makeEnv();
  goesTo(await join(env, { adult: '' }), '/free/not-added/');
  goesTo(await join(env, { adult: 'on' }), '/free/not-added/');
  goesTo(await join(env, { email: 'parent@example' }), '/free/not-added/');
  goesTo(await post(env, '/signup/', { email: 'parent@example.com' }), '/free/not-added/');
  eq(rows(env).length, 0);
});
await t('join: a robot that fills in the hidden field is thanked, and nothing is kept', async () => {
  const env = makeEnv();
  goesTo(await join(env, { website: 'https://spam.example' }), '/free/joined/');
  eq(rows(env).length, 0);
});
await t('join: a form on another website cannot add addresses', async () => {
  const env = makeEnv();
  goesTo(await join(env, {}, { Origin: 'https://evil.example' }), '/free/not-added/');
  goesTo(await join(env, {}, { Origin: 'null' }), '/free/not-added/');
  eq(rows(env).length, 0);
  goesTo(await join(env, {}, { Origin: '' }), '/free/joined/');   // no Origin header at all (older browsers): allowed
  eq(rows(env).length, 1);
});
await t('join: the rate limiter is asked per connection, and a "too many" stops the sign-up', async () => {
  const keys = [];
  const env = makeEnv({ SIGNUP_LIMIT: { limit: async ({ key }) => { keys.push(key); return { success: keys.length <= 2 }; } } });
  goesTo(await join(env, { email: 'one@example.com' }), '/free/joined/');
  goesTo(await join(env, { email: 'two@example.com' }), '/free/joined/');
  goesTo(await join(env, { email: 'three@example.com' }), '/free/not-added/');
  eq(keys[0], 'signup:203.0.113.7'); eq(rows(env).length, 2);
  ok(!JSON.stringify(rows(env)).includes('203.0.113.7'), 'the IP address is not stored');
});
await t('join: at most 300 new addresses a day', async () => {
  const env = makeEnv();
  const now = new Date().toISOString().slice(0, 19) + 'Z';
  const add = env.DB.raw.prepare("INSERT INTO subscribers (email, created, source, promise) VALUES (?, ?, 'free', 'few-a-year')");
  for (let i = 0; i < 300; i++) add.run(`p${i}@example.com`, now);
  goesTo(await join(env, { email: 'late@example.com' }), '/free/not-added/');
  eq(rows(env).length, 300);
  env.DB.raw.prepare("UPDATE subscribers SET created = '2026-01-01T00:00:00Z'").run();   // yesterday's sign-ups don't count
  goesTo(await join(env, { email: 'late@example.com' }), '/free/joined/');
});
await t('join: an unknown "from" page is kept as the free sampler page', async () => {
  const env = makeEnv();
  await join(env, { from: 'somewhere-else' });
  eq(rows(env)[0].source, 'free');
});
await t('join: works when the live database has no list table yet (it makes it)', async () => {
  const env = makeEnv({}, SCHEMA.replace(/CREATE TABLE IF NOT EXISTS subscribers[^;]*;/, ''));
  eq(env.DB.raw.prepare("SELECT COUNT(*) AS n FROM sqlite_master WHERE name = 'subscribers'").get().n, 0, 'no table at first');
  goesTo(await join(env), '/free/joined/');
  eq(rows(env).length, 1);
});
await t('join: opening /signup/ in the browser goes to the form', async () => {
  goesTo(await get(makeEnv(), '/signup/'), '/free/#join');
  goesTo(await get(makeEnv(), '/signup'), '/free/#join');
  goesTo(await get(makeEnv(), '/signup/remove/'), '/free/remove/');
});

/* ---------- leaving ---------- */
await t('leave: deletes the address, and the page never says whether it was on the list', async () => {
  const env = makeEnv();
  await join(env); await join(env, { email: 'other@example.com' });
  goesTo(await post(env, '/signup/remove/', { email: ' Parent@EXAMPLE.com' }), '/free/removed/');
  eq(rows(env).map((r) => r.email).join(), 'other@example.com');
  goesTo(await post(env, '/signup/remove/', { email: 'never@example.com' }), '/free/removed/');
  goesTo(await post(env, '/signup/remove/', { email: 'not an address' }), '/free/removed/');
  eq(rows(env).length, 1);
});
await t('leave: a form on another website cannot remove addresses', async () => {
  const env = makeEnv();
  await join(env);
  goesTo(await post(env, '/signup/remove/', { email: 'parent@example.com' }, { Origin: 'https://evil.example' }), '/free/remove/');
  eq(rows(env).length, 1);
});

/* ---------- the owner's numbers page and the list file ---------- */
await t('stats: shows how many joined and links to the list file', async () => {
  const env = makeEnv();
  await join(env); await join(env, { email: 'b@example.com' });
  env.DB.raw.prepare("UPDATE subscribers SET created = '2025-01-01T00:00:00Z' WHERE email = 'b@example.com'").run();
  const html = await (await get(env, `/stats/${STATS}/`)).text();
  ok(html.includes('Email list') && html.includes('2 in all, 1 in the last 30 days'), 'counts');
  ok(html.includes(`href="/stats/${STATS}/signups.csv"`), 'link');
  ok(!html.includes('parent@example.com'), 'the page itself shows no addresses');
});
await t('stats: the list file has every address, oldest first, and is private', async () => {
  const env = makeEnv();
  await join(env, { email: 'second@example.com' });
  env.DB.raw.prepare("UPDATE subscribers SET created = '2026-11-02T10:00:00Z'").run();
  await join(env, { email: '=cmd+1@example.com' });   // allowed in an address, but a formula to a spreadsheet app
  const r = await get(env, `/stats/${STATS}/signups.csv`);
  eq(r.status, 200); ok(r.headers.get('Content-Type').startsWith('text/csv'), 'type');
  ok(/^attachment; filename="atlas-email-list-\d{4}-\d\d-\d\d\.csv"$/.test(r.headers.get('Content-Disposition')), 'download');
  ok(r.headers.get('Cache-Control').includes('no-store') && r.headers.get('X-Robots-Tag').includes('noindex'), 'private');
  const lines = (await r.text()).split('\r\n');
  eq(lines[0], 'email,joined_utc,page,promise');
  eq(lines[1], 'second@example.com,2026-11-02 10:00:00,/free/,few-a-year');
  ok(lines[2].startsWith("'=cmd+1@example.com,"), 'formula guard: ' + lines[2]);
  eq(lines[3], '', 'ends with a line break'); eq(lines.length, 4);
});
await t('stats: the list file needs the right key', async () => {
  eq((await get(makeEnv(), '/stats/wrong/signups.csv')).status, 404);
});

/* ---------- the built pages and settings match the Worker ---------- */
const page = (path) => read('public' + path + 'index.html');
await t('pages: the box on /free/ sends what the Worker reads', () => {
  const html = page('/free/');
  ok(html.includes('action="/signup/"') && html.includes('method="post"'), 'form');
  ok(/name="email" type="email" required/.test(html), 'email field');
  ok(/id="join-adult" type="checkbox" name="adult" value="yes" required/.test(html), '18+ tick');
  ok(html.includes('name="from" value="free"') && /class="hp" aria-hidden="true">.*name="website"[^>]*tabindex="-1"/.test(html), 'hidden fields');
  ok(html.includes('id="join"') && html.includes('href="#join"'), 'the link from the top of the page');
  ok(html.includes('No sign-up') && html.includes('download data-buy="free-sampler-letter"'), 'the sampler still downloads without joining');
  ok(html.includes('a few times a year: new free pages, new packs and shop news'), 'the promise');
});
await t('pages: thank-you, not added, leave and left exist, are kept out of search and the sitemap', () => {
  const sitemap = read('public/sitemap.xml');
  for (const p of ['/free/joined/', '/free/not-added/', '/free/remove/', '/free/removed/']) {
    ok(existsSync(new URL('public' + p + 'index.html', root)), p + ' built');
    ok(page(p).includes('content="noindex'), p + ' noindex');
    ok(!sitemap.includes(p), p + ' not in the sitemap');
  }
  ok(page('/free/joined/').includes('free-sampler-letter.pdf'), 'thank-you page has the downloads');
  ok(page('/free/remove/').includes('action="/signup/remove/"'), 'leave form');
  ok(read('public/robots.txt').includes('Disallow: /signup/'), 'robots.txt');
});
await t('pages: the privacy section explains the list', () => {
  const about = page('/about/');
  ok(about.includes('id="email-list"') && about.includes('we never share or sell it') && about.includes('href="/free/remove/"'), 'privacy');
  ok(!about.includes('no accounts, forms,'), 'no longer says "no forms"');
});
await t('settings: forms may post to this site, and the Worker runs for /signup/', () => {
  for (const f of ['public/_headers', 'public/.htaccess']) ok(read(f).includes("form-action 'self'") && !read(f).includes("form-action 'none'"), f);
  const w = read('wrangler.jsonc');
  ok(w.includes('"/signup", "/signup/*"'), 'run_worker_first');
  ok(/"name": "SIGNUP_LIMIT", "namespace_id": "\d+", "simple": \{ "limit": \d+, "period": (10|60) \}/.test(w), 'rate limiter');
});

console.log(failures.length ? `\n${failures.length} FAILED, ${passed} passed` : `\n${passed} passed`);
process.exit(failures.length ? 1 : 0);
