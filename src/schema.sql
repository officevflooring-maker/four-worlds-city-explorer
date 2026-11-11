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
