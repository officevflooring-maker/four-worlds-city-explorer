// The free sampler's email list (since Nov 18, 2026). The owner's choice: sign-ups are kept in the site's own
// database for now, and an email service is picked before the first email goes out. src/worker.js sends these here:
//
//   POST /signup/          the form on /free/ (build/packs.php): an email address, the tick "I'm 18 or older" and a
//                          hidden field that only robots fill in. Then opens /free/joined/ (thank you, with the
//                          downloads) or /free/not-added/ (check the address, or try again in a minute).
//   POST /signup/remove/   the form on /free/remove/: deletes an address from the list. Always opens /free/removed/,
//                          whether or not the address was on it, so nobody can find out who is on the list.
//
// A sign-up keeps the address, when it joined (UTC), the page it joined on and what it was promised (PROMISE).
// Nothing else: no name, no IP address, no cookie. The list is for grown-ups (parents and teachers), so the form
// asks for the 18+ tick. The sampler itself downloads without joining; the page says "No sign-up".
// The owner downloads the list from his numbers page: /stats/KEY/signups.csv (src/worker.js).
//
// Against robots: the hidden field, a sign-up only from this site's own pages (the browser's Origin header),
// SIGNUP_LIMIT (wrangler.jsonc: Cloudflare's rate limiter, a few tries a minute from one connection, kept in
// Cloudflare's memory and never stored by us) and at most DAY_CAP new addresses a day.

// What the box on /free/ promised, kept with each address (the wording is in build/packs.php). Give it a new name
// whenever that promise changes, so the list shows who agreed to what.
export const PROMISE = 'few-a-year';   // "a few emails a year: new free pages, new packs and shop news"
const DAY_CAP = 300;
const SOURCES = { free: '/free/' };   // the pages with the form, as the form's hidden "from" field names them

const go = (request, path) => new Response(null, {
  status: 303,
  headers: { Location: new URL(path, request.url).toString(), 'Cache-Control': 'private, no-store', 'X-Robots-Tag': 'noindex, nofollow' },
});

// The table is made here too, so the list works on the first sign-up after a deploy even if nobody ran
// src/schema.sql on the live database first (the same statement is in schema.sql).
const TABLE = 'CREATE TABLE IF NOT EXISTS subscribers (email TEXT PRIMARY KEY, created TEXT NOT NULL, source TEXT NOT NULL, promise TEXT NOT NULL)';
const made = new WeakSet();
export async function ensureList(env) {
  if (made.has(env.DB)) return;
  await env.DB.prepare(TABLE).run();
  made.add(env.DB);
}

// A plain check, not a full RFC 5322 one: one @, a sensible name before it, a domain with a dot after it.
// Returns the address in lower case, or null.
export function cleanEmail(raw) {
  const e = String(raw || '').trim().toLowerCase();
  if (e.length < 6 || e.length > 254) return null;
  const m = /^([a-z0-9!#$%&'*+/=?^_`{|}~.-]{1,64})@((?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+(?:[a-z]{2,63}|xn--[a-z0-9-]{1,59}))$/.exec(e);
  if (!m) return null;
  const name = m[1];
  if (name.startsWith('.') || name.endsWith('.') || name.includes('..')) return null;
  return e;
}

async function form(request) {
  // the forms send a few short fields; anything bigger is not from them
  return new URLSearchParams((await request.text()).slice(0, 2000));
}
function fromHere(request) {
  const origin = request.headers.get('Origin');
  return !origin || origin === new URL(request.url).origin;
}
async function tooFast(request, env) {
  if (!env.SIGNUP_LIMIT) return false;
  const { success } = await env.SIGNUP_LIMIT.limit({ key: 'signup:' + (request.headers.get('CF-Connecting-IP') || '') });
  return !success;
}

export async function signup(request, env, what) {
  const remove = what === 'remove';
  if (request.method !== 'POST') return go(request, remove ? '/free/remove/' : '/free/#join');
  if (!fromHere(request)) return go(request, remove ? '/free/remove/' : '/free/not-added/');
  const f = await form(request);
  if (remove) {
    const email = cleanEmail(f.get('email'));
    if (email && !(await tooFast(request, env))) {
      await ensureList(env);
      await env.DB.prepare('DELETE FROM subscribers WHERE email = ?').bind(email).run();
    }
    return go(request, '/free/removed/');
  }
  // a robot filled in the hidden field: it is told "thank you" and nothing is kept
  if ((f.get('website') || '') !== '') return go(request, '/free/joined/');
  const email = cleanEmail(f.get('email'));
  if (!email || f.get('adult') !== 'yes' || (await tooFast(request, env))) return go(request, '/free/not-added/');
  await ensureList(env);
  const now = new Date().toISOString().slice(0, 19) + 'Z';
  const todays = await env.DB.prepare('SELECT COUNT(*) AS n FROM subscribers WHERE created >= ?').bind(now.slice(0, 10)).first();
  if ((todays?.n || 0) >= DAY_CAP) return go(request, '/free/not-added/');
  const source = Object.hasOwn(SOURCES, f.get('from') || '') ? f.get('from') : 'free';
  // already on the list: the same thank-you page, and the first sign-up's date and promise stay
  await env.DB.prepare('INSERT INTO subscribers (email, created, source, promise) VALUES (?, ?, ?, ?) ON CONFLICT (email) DO NOTHING')
    .bind(email, now, source, PROMISE).run();
  return go(request, '/free/joined/');
}

// For the owner's numbers page: how many have joined, and the whole list as a spreadsheet file.
export async function listCounts(env, since) {
  await ensureList(env);
  const row = await env.DB.prepare('SELECT COUNT(*) AS n, SUM(CASE WHEN created >= ? THEN 1 ELSE 0 END) AS d30 FROM subscribers').bind(since).first();
  return { all: row?.n || 0, d30: row?.d30 || 0 };
}
export async function listCsv(env) {
  await ensureList(env);
  const rows = (await env.DB.prepare('SELECT email, created, source, promise FROM subscribers ORDER BY created, email').all()).results;
  // a cell that starts with = + - or @ could run as a formula in a spreadsheet app, so it gets a ' in front
  const cell = (v) => {
    let s = String(v ?? '');
    if (/^[=+\-@\t\r]/.test(s)) s = "'" + s;
    return /[",\r\n]/.test(s) ? '"' + s.replace(/"/g, '""') + '"' : s;
  };
  const lines = rows.map((r) => [r.email, r.created.replace('T', ' ').replace('Z', ''), SOURCES[r.source] || r.source, r.promise].map(cell).join(','));
  return ['email,joined_utc,page,promise', ...lines].join('\r\n') + '\r\n';
}
