// The site's small server side (Cloudflare Worker). Every page, picture and script is still a plain file in public/,
// served by Cloudflare without this code: wrangler.jsonc sends only three kinds of address here.
//
//   /c/...      counting. public/js/site.js tells us "this page was opened" and "this Buy button was clicked".
//               We keep a number per day and page, and the website a visit came from. No cookies, no IP addresses,
//               nothing about the visitor or their device.
//   /stats/KEY/ the owner's private page with those numbers. KEY is in the database (settings: stats_key).
//   /dl/TOKEN/  a pack buyer's download page, and /dl/TOKEN/file.pdf the files. The "Your downloads" PDF that a pack
//               delivers holds this link. Packs and their files are listed in the database (packs); the files are
//               in the FILES store. atlas-products packs.sh uploads them with PUT /dl/_put/file.pdf and the admin key.
//
// Storage: DB is a D1 database (schema.sql), FILES a KV namespace. Both are free at this size.

const DAY = new Intl.DateTimeFormat('en-CA', { timeZone: 'America/Los_Angeles' });
const today = () => DAY.format(new Date());
const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
const PRIVATE = { 'Cache-Control': 'private, no-store', 'X-Robots-Tag': 'noindex, nofollow', 'Referrer-Policy': 'no-referrer', 'X-Content-Type-Options': 'nosniff' };
const html = (body, status = 200) => new Response(body, { status, headers: { 'Content-Type': 'text/html; charset=utf-8', 'Content-Security-Policy': "default-src 'none'; style-src 'unsafe-inline'; img-src 'self'", ...PRIVATE } });
const text = (body, status = 200) => new Response(body, { status, headers: { 'Content-Type': 'text/plain; charset=utf-8', ...PRIVATE } });

async function sha256(s) {
  const d = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(s));
  return [...new Uint8Array(d)].map((b) => b.toString(16).padStart(2, '0')).join('');
}
async function setting(env, k) {
  const row = await env.DB.prepare('SELECT v FROM settings WHERE k = ?').bind(k).first();
  return row ? row.v : null;
}
const bump = (env, table, col, value) =>
  env.DB.prepare(`INSERT INTO ${table} (day, ${col}, n) VALUES (?, ?, 1) ON CONFLICT (day, ${col}) DO UPDATE SET n = n + 1`).bind(today(), value);

/* ---------- counting ---------- */
// POST /c/v  {p: "/worlds/roman/", r: "pinterest.com"}   a page was opened
// POST /c/e  {n: "buy-city-builders"}                    a button was clicked
async function count(request, env, ctx, kind) {
  if (request.method !== 'POST') return text('', 405);
  let data;
  try { data = JSON.parse((await request.text()).slice(0, 600)); } catch { return text('', 204); }
  const ua = request.headers.get('User-Agent') || '';
  if (/bot|crawl|spider|slurp|preview|headless|lighthouse|monitor|pingdom/i.test(ua)) return text('', 204);
  const work = [];
  if (kind === 'v') {
    const p = String(data.p || '');
    // only addresses shaped like this site's pages: lower-case words, at most four folders deep
    if (/^\/(?:[a-z0-9-]{1,60}\/){0,4}$/.test(p)) {
      work.push(bump(env, 'hits', 'path', p));
      let host = String(data.r || '').toLowerCase().replace(/^www\./, '');
      if (!/^[a-z0-9.-]{3,60}$/.test(host)) host = '(none)';
      if (host !== 'atlasofcities.org') work.push(bump(env, 'refs', 'host', host));
    }
  } else {
    const n = String(data.n || '');
    if (/^[a-z0-9-]{1,50}$/.test(n)) work.push(bump(env, 'events', 'name', n));
  }
  if (work.length) ctx.waitUntil(env.DB.batch(work).catch(() => {}));
  return text('', 204);
}

/* ---------- the owner's numbers ---------- */
async function stats(env, key) {
  const real = await setting(env, 'stats_key');
  if (!real || key !== real) return text('Not found', 404);
  const since = DAY.format(new Date(Date.now() - 29 * 86400000));
  const week = DAY.format(new Date(Date.now() - 6 * 86400000));
  const [days, pages, refs, events, totals] = (await env.DB.batch([
    env.DB.prepare('SELECT day, SUM(n) AS n FROM hits WHERE day >= ? GROUP BY day ORDER BY day DESC').bind(since),
    env.DB.prepare('SELECT path, SUM(n) AS n FROM hits WHERE day >= ? GROUP BY path ORDER BY n DESC LIMIT 40').bind(since),
    env.DB.prepare('SELECT host, SUM(n) AS n FROM refs WHERE day >= ? GROUP BY host ORDER BY n DESC LIMIT 25').bind(since),
    env.DB.prepare('SELECT name, SUM(n) AS n FROM events WHERE day >= ? GROUP BY name ORDER BY n DESC LIMIT 60').bind(since),
    env.DB.prepare('SELECT SUM(CASE WHEN day = ?1 THEN n ELSE 0 END) AS d1, SUM(CASE WHEN day >= ?2 THEN n ELSE 0 END) AS d7, SUM(CASE WHEN day >= ?3 THEN n ELSE 0 END) AS d30, SUM(n) AS allTime FROM hits').bind(today(), week, since),
  ])).map((r) => r.results);
  const max = Math.max(1, ...days.map((d) => d.n));
  const t = totals[0] || {};
  const table = (rows, a, b, head) => rows.length
    ? `<table><tr><th>${head}</th><th class="n">Count</th></tr>${rows.map((r) => `<tr><td>${esc(r[a])}</td><td class="n">${r[b]}</td></tr>`).join('')}</table>`
    : '<p class="none">Nothing yet.</p>';
  const nice = (name) => name.replace(/^buy-/, 'Buy button: ').replace(/^dl-/, 'Pack download: ').replace(/^free-sampler-/, 'Free sampler download: ');
  return html(`<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex">
<title>Atlas of Cities: visitor numbers</title><style>
body { font: 16px/1.5 system-ui, sans-serif; color: #1d2433; background: #f7f5f0; margin: 0; padding: 1.2rem; }
main { max-width: 900px; margin: 0 auto; } h1 { font-size: 1.5rem; margin: 0 0 .2rem; } h2 { font-size: 1.15rem; margin: 2rem 0 .5rem; }
.tiles { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: .8rem; margin: 1rem 0; }
.tiles div { background: #fff; border: 1px solid #e2ddd2; border-radius: 12px; padding: .8rem 1rem; } .tiles b { display: block; font-size: 1.7rem; }
table { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #e2ddd2; border-radius: 12px; overflow: hidden; }
th, td { text-align: left; padding: .4rem .8rem; border-top: 1px solid #eee8dc; font-size: .95rem; word-break: break-word; } th { border-top: 0; background: #efeadf; }
.n { text-align: right; white-space: nowrap; } .bar { display: inline-block; height: .7rem; background: #23396b; border-radius: 4px; vertical-align: middle; }
.none, .note { color: #5c6577; } .note { font-size: .9rem; }
</style></head><body><main>
<h1>The Atlas of Cities: visitor numbers</h1>
<p class="note">Page views counted by the site itself. No cookies, no IP addresses, nothing about any visitor is stored. Search robots are left out. Days are Pacific time. Keep this address private.</p>
<div class="tiles"><div><b>${t.d1 || 0}</b>page views today</div><div><b>${t.d7 || 0}</b>last 7 days</div><div><b>${t.d30 || 0}</b>last 30 days</div><div><b>${t.allTime || 0}</b>since counting began</div></div>
<h2>Page views by day (last 30 days)</h2>
${days.length ? `<table><tr><th>Day</th><th class="n">Views</th><th></th></tr>${days.map((d) => `<tr><td>${esc(d.day)}</td><td class="n">${d.n}</td><td><span class="bar" style="width:${Math.round(240 * d.n / max)}px"></span></td></tr>`).join('')}</table>` : '<p class="none">Nothing yet.</p>'}
<h2>Buy buttons, downloads and other clicks (last 30 days)</h2>
${table(events.map((e) => ({ name: nice(e.name), n: e.n })), 'name', 'n', 'What')}
<h2>Where visits came from (last 30 days)</h2>
<p class="note">"(none)" means the address was typed, bookmarked, or opened from an app that does not say where it came from.</p>
${table(refs, 'host', 'n', 'Website')}
<h2>Most opened pages (last 30 days)</h2>
${table(pages, 'path', 'n', 'Page')}
</main></body></html>`);
}

/* ---------- pack downloads ---------- */
const mb = (bytes) => (bytes / 1048576).toFixed(1) + ' MB';
async function pack(env, token) {
  if (!/^[A-Za-z0-9]{20,64}$/.test(token)) return null;
  const row = await env.DB.prepare('SELECT slug, title, files FROM packs WHERE token = ?').bind(token).first();
  if (!row) return null;
  try { row.files = JSON.parse(row.files); } catch { return null; }
  return row;
}
// files: [{name: "City Builders", note: "A card game", letter: ["city-builders-letter.pdf", bytes], a4: [...]}]
function packPage(p) {
  const link = (f, label) => f ? `<a class="dl" href="${esc(f[0])}" download>${label} <span>${mb(f[1])}</span></a>` : '';
  const rows = p.files.map((f) => `<li><div><b>${esc(f.name)}</b><span class="what">${esc(f.note || '')}</span></div><div class="links">${link(f.letter, 'US Letter')}${link(f.a4, 'A4')}</div></li>`).join('');
  return html(`<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex">
<title>${esc(p.title)}: your downloads | The Atlas of Cities</title><style>
body { font: 17px/1.55 system-ui, -apple-system, "Segoe UI", sans-serif; color: #1d2433; background: #f7f5f0; margin: 0; }
header { background: #142039; color: #fff; padding: 1.4rem 1.2rem; } header p { margin: 0; color: #f0c674; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; font-size: .8rem; }
h1 { font: 700 1.7rem/1.2 Georgia, "Times New Roman", serif; margin: .2rem 0 0; }
main { max-width: 780px; margin: 0 auto; padding: 1.2rem; } header > div { max-width: 780px; margin: 0 auto; }
ul { list-style: none; padding: 0; margin: 1.2rem 0; } li { background: #fff; border: 1px solid #e2ddd2; border-radius: 14px; padding: .9rem 1rem; margin: 0 0 .7rem; display: flex; flex-wrap: wrap; gap: .6rem 1rem; align-items: center; justify-content: space-between; }
li b { display: block; font-size: 1.05rem; } .what { color: #5c6577; font-size: .92rem; }
.links { display: flex; gap: .5rem; flex-wrap: wrap; }
.dl { display: inline-block; background: #23396b; color: #fff; text-decoration: none; font-weight: 700; padding: .65rem 1rem; border-radius: 999px; min-height: 24px; }
.dl span { font-weight: 400; opacity: .85; font-size: .88rem; } .dl:hover, .dl:focus { background: #142039; }
.tips { color: #3a4353; font-size: .95rem; } a { color: #23396b; }
</style></head><body>
<header><div><p>The Atlas of Cities · Your downloads</p><h1>${esc(p.title)}</h1></div></header>
<main>
<p>Thank you for buying! Every printable is here in two paper sizes. Choose <b>US Letter</b> in the United States and Canada, and <b>A4</b> almost everywhere else. Bookmark this page: you can come back and download again whenever you like.</p>
<ul>${rows}</ul>
<p class="tips">Print at 100% or "actual size". The files are for your own home or one classroom, so please don't share them or this page's address. Something not working? Send us a message through the shop you bought from, and we will put it right.</p>
<p class="tips"><a href="/">atlasofcities.org</a>: seven illustrated cities, free games and lessons.</p>
</main></body></html>`);
}
async function downloads(request, env, ctx, parts) {
  // upload (atlas-products packs.sh): PUT /dl/_put/<file>, with the admin key in the X-Key header
  if (parts[0] === '_put') {
    if (request.method !== 'PUT') return text('', 405);
    const hash = await setting(env, 'admin_key_sha256');
    if (!hash || (await sha256(request.headers.get('X-Key') || '')) !== hash) return text('Not found', 404);
    const name = parts[1] || '';
    if (!/^[a-z0-9-]{1,80}\.pdf$/.test(name) || !request.body) return text('Bad file name', 400);
    await env.FILES.put('f:' + name, request.body);
    return text('stored ' + name + '\n');
  }
  if (request.method !== 'GET' && request.method !== 'HEAD') return text('', 405);
  const p = await pack(env, parts[0] || '');
  if (!p) return html('<!doctype html><meta charset="utf-8"><title>Not found</title><body style="font:17px system-ui;padding:2rem"><h1>Download page not found</h1><p>Please open the link in your "Your downloads" PDF again, or copy the whole address. If it still does not work, send us a message through the shop you bought from.</p>', 404);
  if (parts.length === 1) return Response.redirect(new URL(`/dl/${parts[0]}/`, request.url).toString(), 301);
  const file = parts[1];
  if (file === '') return packPage(p);
  const entry = p.files.flatMap((f) => [f.letter, f.a4]).find((f) => f && f[0] === file);
  if (!entry) return text('Not found', 404);
  const headers = { 'Content-Type': 'application/pdf', 'Content-Disposition': `attachment; filename="${file}"`, 'Content-Length': String(entry[1]), ...PRIVATE };
  if (request.method === 'HEAD') return new Response(null, { headers });
  const body = await env.FILES.get('f:' + file, { type: 'stream' });
  if (!body) return text('This file is not ready yet. Please try again in a little while.', 503);
  ctx.waitUntil(env.DB.batch([bump(env, 'events', 'name', 'dl-' + p.slug)]).catch(() => {}));
  return new Response(body, { headers });
}

export default {
  async fetch(request, env, ctx) {
    const url = new URL(request.url);
    const parts = url.pathname.split('/').slice(1);   // "/dl/abc/" -> ["dl", "abc", ""]
    try {
      if (parts[0] === 'c' && (parts[1] === 'v' || parts[1] === 'e')) return await count(request, env, ctx, parts[1]);
      if (parts[0] === 'stats' && parts[1]) return await stats(env, parts[1]);
      if (parts[0] === 'dl' && parts[1]) return await downloads(request, env, ctx, parts.slice(1));
    } catch (e) {
      console.error(e);
      return text('Something went wrong. Please try again in a minute.', 500);
    }
    // anything else is one of the site's own files (or its "page not found" page)
    return env.ASSETS.fetch(request);
  },
};
