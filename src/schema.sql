-- The site's small database (Cloudflare D1 "atlasofcities"), used only by src/worker.js.
-- Counts hold no personal data: a number per day for each page, each website visits came from, and each button.
CREATE TABLE IF NOT EXISTS hits (day TEXT NOT NULL, path TEXT NOT NULL, n INTEGER NOT NULL DEFAULT 0, PRIMARY KEY (day, path));
CREATE TABLE IF NOT EXISTS refs (day TEXT NOT NULL, host TEXT NOT NULL, n INTEGER NOT NULL DEFAULT 0, PRIMARY KEY (day, host));
CREATE TABLE IF NOT EXISTS events (day TEXT NOT NULL, name TEXT NOT NULL, n INTEGER NOT NULL DEFAULT 0, PRIMARY KEY (day, name));
-- stats_key: the private address of the numbers page (/stats/KEY/). admin_key_sha256: the upload key, hashed.
CREATE TABLE IF NOT EXISTS settings (k TEXT PRIMARY KEY, v TEXT NOT NULL);
-- A pack's download page (/dl/TOKEN/): its name and its files as JSON
-- [{"name": "City Builders", "note": "A card game", "letter": ["city-builders-letter.pdf", 12345], "a4": [...]}].
CREATE TABLE IF NOT EXISTS packs (token TEXT PRIMARY KEY, slug TEXT NOT NULL, title TEXT NOT NULL, files TEXT NOT NULL);

-- ---------- The Stripe store (src/store.js), since Nov 16, 2026 ----------
-- What each product's download page offers: the same shape as packs.files. A product sells through Stripe only once
-- its row is here (its PDFs uploaded), so a buyer never pays for files that aren't ready. atlas-products packs.sh
-- writes these rows with the packs.
CREATE TABLE IF NOT EXISTS items (slug TEXT PRIMARY KEY, title TEXT NOT NULL, files TEXT NOT NULL);
-- One row per paid Stripe Checkout Session. token: the buyer's download page /dl/TOKEN/. license: a Life RPG key.
-- No name, email or card details: those stay with Stripe. live: 0 for test-mode purchases.
CREATE TABLE IF NOT EXISTS orders (session TEXT PRIMARY KEY, token TEXT NOT NULL UNIQUE, slug TEXT NOT NULL, license TEXT UNIQUE,
  amount INTEGER NOT NULL, currency TEXT NOT NULL, live INTEGER NOT NULL, created TEXT NOT NULL);
-- The devices a Life RPG key has unlocked (the Life RPG Worker, life-rpg-sell, writes these; 10 per key).
CREATE TABLE IF NOT EXISTS activations (license TEXT NOT NULL, instance TEXT NOT NULL, created TEXT NOT NULL, PRIMARY KEY (license, instance));
