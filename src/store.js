// The store: selling the shop's products with Stripe Checkout (since Nov 16, 2026, when Lemon Squeezy closed to new
// stores). src/worker.js sends these addresses here:
//
//   /buy/SLUG/          the Buy buttons. Makes a Stripe Checkout Session for one product and sends the buyer to it.
//                       Until Stripe is set up (no key), or while a product's files aren't in the store yet, the
//                       button goes where it went before: the product's Etsy listing, or its page.
//                       /buy/SLUG/?test=STATS_KEY uses Stripe's test mode, for the owner's test purchases.
//   /thanks/?session_id=...  where Stripe sends the buyer after paying: checks the payment with Stripe, then opens
//                       the buyer's own download page /dl/TOKEN/ (src/worker.js shows it).
//   /stripe-webhook     Stripe's message that a payment went through, so an order exists even when the buyer
//                       closes the tab before the thank-you page.
//
// What is sold, and at what price, is src/catalog.json, written by php build/build.php from SHOP in build/config.php
// (plus the Every Stone Speaks packs in STORE_ALSO). The files each order delivers are the rows of the "items" table
// (src/schema.sql), in the same shape as the packs' files; the PDFs themselves are in the FILES store.
//
// An order keeps only what is needed to give the buyer their files: the Stripe session's id, the product, the price
// paid and the date. No name, no email address, no card details: those stay with Stripe.
//
// Settings (Cloudflare: Workers > atlasofcities > Settings > Variables and Secrets). Secrets, never in this repo:
//   STRIPE_KEY                  the live secret key (sk_live_... or a restricted rk_live_... key)
//   STRIPE_WEBHOOK_SECRET       the live webhook's signing secret (whsec_...)
//   STRIPE_TEST_KEY             optional: the test-mode key (sk_test_... or rk_test_...), for ?test= purchases
//   STRIPE_TEST_WEBHOOK_SECRET  optional: the test-mode webhook's signing secret
// Plain settings (vars in wrangler.jsonc):
//   STRIPE_MANAGED   "on": Stripe Managed Payments, so Stripe is the seller of record and handles sales tax, as
//                    Lemon Squeezy did. Needs Managed Payments turned on in the Stripe dashboard first.
//   STRIPE_TAX       "on": Stripe Tax adds sales tax (only without Managed Payments; needs Stripe Tax set up)

import CATALOG from './catalog.json' with { type: 'json' };

const API = 'https://api.stripe.com/v1/';
const API_VERSION = '2026-04-22.dahlia';     // the first API version with managed_payments on Checkout Sessions
const SITE = 'https://atlasofcities.org';
const STORE_TAG = 'atlas-store';             // metadata.store on every session, so other payments on the same
                                             // Stripe account (if any) are never taken for shop orders
const BOTS = /bot|crawl|spider|slurp|preview|headless|lighthouse|monitor|pingdom|facebookexternalhit|embedly/i;

export const catalog = () => CATALOG;
const live = (k) => /^(sk|rk)_live_/.test(k || '');
const test = (k) => /^(sk|rk)_test_/.test(k || '');

/* ---------- small helpers ---------- */
const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
const PRIVATE = { 'Cache-Control': 'private, no-store', 'X-Robots-Tag': 'noindex, nofollow', 'Referrer-Policy': 'no-referrer', 'X-Content-Type-Options': 'nosniff' };
const go = (to, status = 302) => new Response(null, { status, headers: { Location: to, ...PRIVATE } });
const text = (body, status = 200) => new Response(body, { status, headers: { 'Content-Type': 'text/plain; charset=utf-8', ...PRIVATE } });
const page = (title, body, status = 200) => new Response(`<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex">
<title>${esc(title)}</title><style>body{font:17px/1.55 system-ui,-apple-system,"Segoe UI",sans-serif;color:#1d2433;background:#f7f5f0;margin:0;padding:2rem 1.2rem}main{max-width:640px;margin:0 auto}h1{font:700 1.6rem/1.2 Georgia,serif}a{color:#23396b}.btn{display:inline-block;background:#23396b;color:#fff;text-decoration:none;font-weight:700;padding:.7rem 1.1rem;border-radius:999px}</style></head>
<body><main>${body}</main></body></html>`, { status, headers: { 'Content-Type': 'text/html; charset=utf-8', 'Content-Security-Policy': "default-src 'none'; style-src 'unsafe-inline'", ...PRIVATE } });

async function setting(env, k) {
  const row = await env.DB.prepare('SELECT v FROM settings WHERE k = ?').bind(k).first();
  return row ? row.v : null;
}
// a random code from letters and digits that are easy to read (no 0/O, 1/I/L)
function code(n, chars = 'ABCDEFGHJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789') {
  const b = crypto.getRandomValues(new Uint8Array(n));
  return [...b].map((x) => chars[x % chars.length]).join('');
}
// Life RPG keys: LIFE-XXXX-XXXX-XXXX-XXXX, capitals and digits only, so they can be typed from paper
const licenseKey = () => 'LIFE-' + code(16, 'ABCDEFGHJKMNPQRSTUVWXYZ23456789').match(/.{4}/g).join('-');

/* ---------- Stripe's API (form-encoded, as Stripe expects) ---------- */
function form(obj, prefix = '', out = new URLSearchParams()) {
  for (const [k, v] of Object.entries(obj)) {
    if (v === undefined || v === null) continue;
    const key = prefix ? `${prefix}[${k}]` : k;
    if (typeof v === 'object') form(v, key, out); else out.append(key, String(v));
  }
  return out;
}
async function stripe(key, method, path, body) {
  const res = await fetch(API + path, {
    method,
    headers: { Authorization: 'Bearer ' + key, 'Stripe-Version': API_VERSION, ...(body ? { 'Content-Type': 'application/x-www-form-urlencoded' } : {}) },
    body: body ? form(body).toString() : undefined,
  });
  const data = await res.json().catch(() => ({}));
  if (!res.ok) throw new Error(`Stripe ${method} ${path.split('?')[0]}: ${res.status} ${data.error ? data.error.message : ''}`);
  return data;
}

/* ---------- is a product ready to sell? ---------- */
// A product with files needs its row in "items" (its PDFs uploaded); Life RPG needs nothing more.
async function ready(env, slug) {
  const p = CATALOG[slug];
  if (!p) return false;
  if (p.kind === 'key') return true;
  return Boolean(await env.DB.prepare('SELECT 1 FROM items WHERE slug = ?').bind(slug).first());
}
// where a Buy button goes while the store can't sell the product
const elsewhere = (p) => (p.etsy ? 'https://www.etsy.com/listing/' + p.etsy : p.page);

/* ---------- /buy/SLUG/ ---------- */
export async function buy(request, env, slug) {
  const p = CATALOG[slug];
  if (!p) return text('Not found', 404);
  if (BOTS.test(request.headers.get('User-Agent') || '')) return go(p.page);
  const url = new URL(request.url);
  const testKey = url.searchParams.get('test');
  let key = env.STRIPE_KEY, testing = false;
  if (testKey) {
    // test purchases are only for the owner: the key is the private numbers page's key
    const real = await setting(env, 'stats_key');
    if (!real || testKey !== real) return text('Not found', 404);
    key = env.STRIPE_TEST_KEY;
    testing = true;
    if (!test(key)) return page('Test mode is not set up', '<h1>Test mode is not set up</h1><p>Add the secret STRIPE_TEST_KEY (a key that starts with sk_test_ or rk_test_) to the Worker, then try again.</p>', 503);
  } else if (!live(key)) {
    return go(elsewhere(p));          // Stripe isn't set up yet: the button works as before
  }
  if (!(await ready(env, slug))) {
    if (testing) return page('Not ready', `<h1>${esc(p.name)} isn't ready to sell</h1><p>Its files aren't in the store yet (no row for "${esc(slug)}" in the items table). atlas-products packs.sh uploads them.</p>`, 503);
    return go(elsewhere(p));
  }
  try {
    const session = await stripe(key, 'POST', 'checkout/sessions', await sessionFor(env, key, p, slug, testing));
    return go(session.url, 303);
  } catch (e) {
    console.error(e);
    if (testing) return page('Checkout failed', `<h1>Stripe said no</h1><p>${esc(e.message)}</p>`, 502);
    return go(elsewhere(p));          // never lose a sale to a setup problem: Etsy still sells it
  }
}

async function sessionFor(env, key, p, slug, testing) {
  const managed = env.STRIPE_MANAGED === 'on';
  const s = {
    mode: 'payment',
    line_items: { 0: { quantity: 1 } },
    success_url: SITE + '/thanks/?session_id={CHECKOUT_SESSION_ID}',
    cancel_url: p.page,
    submit_type: 'pay',
    metadata: { store: STORE_TAG, slug },
    payment_intent_data: { metadata: { store: STORE_TAG, slug } },
  };
  const price = p.from ? await payWhatYouWant(env, key, p, slug, testing) : null;
  if (price) s.line_items[0].price = price;
  else s.line_items[0].price_data = {
    currency: 'usd',
    unit_amount: p.from ? p.preset : p.price,
    product_data: { name: p.name, description: p.line, images: { 0: p.image }, tax_code: p.tax, metadata: { slug } },
  };
  if (managed) s.managed_payments = { enabled: true };
  else if (env.STRIPE_TAX === 'on') s.automatic_tax = { enabled: true };
  return s;
}

// "Pay what you want, from $2" (the Poster Set) needs a Price made in Stripe once (inline prices can't let the buyer
// choose). It is made on the first sale and remembered in settings. If Stripe refuses, the product sells at its
// suggested price instead.
async function payWhatYouWant(env, key, p, slug, testing) {
  const k = `stripe_price:${slug}:${testing ? 'test' : 'live'}:${p.price}:${p.preset}`;
  const known = await setting(env, k);
  if (known) return known;
  try {
    const price = await stripe(key, 'POST', 'prices', {
      currency: 'usd',
      custom_unit_amount: { enabled: true, minimum: p.price, preset: p.preset },
      product_data: { name: p.name, tax_code: p.tax, metadata: { slug } },
      metadata: { store: STORE_TAG, slug },
    });
    await env.DB.prepare('INSERT OR REPLACE INTO settings (k, v) VALUES (?, ?)').bind(k, price.id).run();
    return price.id;
  } catch (e) {
    console.error(e);
    return null;
  }
}

/* ---------- orders ---------- */
// Makes the order for a paid Checkout Session (once: the thank-you page and the webhook may both try).
async function record(env, s) {
  if (!s || s.object !== 'checkout.session' || !s.metadata || s.metadata.store !== STORE_TAG) return null;
  if (s.payment_status !== 'paid' && s.payment_status !== 'no_payment_required') return null;
  const slug = s.metadata.slug;
  const p = CATALOG[slug];
  if (!p) return null;
  await env.DB.prepare(`INSERT OR IGNORE INTO orders (session, token, slug, license, amount, currency, live, created)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)`).bind(s.id, code(32), slug, p.kind === 'key' ? licenseKey() : null,
    s.amount_total ?? 0, s.currency || 'usd', s.livemode ? 1 : 0, new Date().toISOString()).run();
  return env.DB.prepare('SELECT token FROM orders WHERE session = ?').bind(s.id).first();
}

/* ---------- /thanks/?session_id=cs_... ---------- */
export async function thanks(request, env) {
  const id = new URL(request.url).searchParams.get('session_id') || '';
  if (!/^cs_(live|test)_[A-Za-z0-9]{10,200}$/.test(id)) return go('/shop/');
  let row = await env.DB.prepare('SELECT token FROM orders WHERE session = ?').bind(id).first();
  if (!row) {
    const key = id.startsWith('cs_live_') ? env.STRIPE_KEY : env.STRIPE_TEST_KEY;
    if (!key) return text('Not found', 404);
    let s;
    try { s = await stripe(key, 'GET', 'checkout/sessions/' + id); } catch (e) {
      console.error(e);
      return page('One moment', '<h1>Thank you!</h1><p>We could not reach the payment service to open your downloads. Please reload this page in a minute.</p>', 503);
    }
    if (s.status === 'complete' && s.payment_status === 'unpaid') {
      return page('Payment processing', '<h1>Thank you!</h1><p>Your payment is still going through. Reload this page in a few minutes to open your downloads.</p>', 202);
    }
    row = await record(env, s);
    if (!row) return go('/shop/');
  }
  return go(`/dl/${row.token}/?new=1`, 303);
}

/* ---------- /stripe-webhook ---------- */
// Stripe signs each message: Stripe-Signature "t=TIME,v1=HMAC" over "TIME.BODY" with the endpoint's signing secret.
async function signedBy(secret, header, body) {
  if (!secret || !header) return false;
  const parts = Object.fromEntries(header.split(',').map((x) => x.split('=')).filter((x) => x.length === 2 && x[0] === 't'));
  const sigs = header.split(',').filter((x) => x.startsWith('v1=')).map((x) => x.slice(3));
  const t = Number(parts.t);
  if (!t || Math.abs(Date.now() / 1000 - t) > 300 || !sigs.length) return false;
  const k = await crypto.subtle.importKey('raw', new TextEncoder().encode(secret), { name: 'HMAC', hash: 'SHA-256' }, false, ['sign']);
  const mac = new Uint8Array(await crypto.subtle.sign('HMAC', k, new TextEncoder().encode(`${t}.${body}`)));
  const hex = [...mac].map((b) => b.toString(16).padStart(2, '0')).join('');
  return sigs.some((s) => s.length === hex.length && [...s].reduce((d, c, i) => d | (c.charCodeAt(0) ^ hex.charCodeAt(i)), 0) === 0);
}
export async function webhook(request, env) {
  if (request.method !== 'POST') return text('', 405);
  const body = await request.text();
  if (body.length > 512 * 1024) return text('Too big', 413);
  const sig = request.headers.get('Stripe-Signature');
  const ok = (await signedBy(env.STRIPE_WEBHOOK_SECRET, sig, body)) || (await signedBy(env.STRIPE_TEST_WEBHOOK_SECRET, sig, body));
  if (!ok) return text('Bad signature', 400);
  let event;
  try { event = JSON.parse(body); } catch { return text('Bad JSON', 400); }
  if (event.type === 'checkout.session.completed' || event.type === 'checkout.session.async_payment_succeeded') {
    await record(env, event.data && event.data.object);
  }
  return text('ok');
}

/* ---------- the download page's data for an order (src/worker.js shows it) ---------- */
export async function order(env, token) {
  const o = await env.DB.prepare('SELECT slug, license, live FROM orders WHERE token = ?').bind(token).first();
  if (!o) return null;
  const p = CATALOG[o.slug] || { name: o.slug, kind: 'pdf', site: 'atlas' };
  const out = { slug: o.slug, title: p.name, site: p.site || 'atlas', test: !o.live, files: [] };
  if (p.kind === 'key') {
    out.license = o.license;
    out.open = p.open;
  } else {
    const item = await env.DB.prepare('SELECT files FROM items WHERE slug = ?').bind(o.slug).first();
    try { out.files = item ? JSON.parse(item.files) : []; } catch { out.files = []; }
  }
  return out;
}
// Life RPG keys (orders.license) are checked by the Life RPG Worker (life-rpg-sell), which reads this same database.
