# The Atlas of Cities: Past, Present and Imagined

(Formerly "Four Worlds City Explorer". The GitHub repository keeps its original name.)

A free educational website: explore seven illustrated isometric cities (Ancient Egypt, Ancient Rome, a Medieval Kingdom, a Modern Town, a Green World, a Robotic Future and an imagined Heavenly City), learn what each building does, and compare how each world provides water, places to gather, safe travel and room for nature.

No accounts, forms, cookies, ads, analytics or third-party requests. Passport stamps, quiz scores and saved cities stay in the visitor's own browser (localStorage) and are never sent anywhere.

## How it's built

- `public/` is the whole website (static HTML, CSS, JS, images), served by a Cloudflare Worker (see Cloudflare below).
- `build/` holds the content (`data.php`), settings (`config.php`) and the page generator (`build.php`). Edit content there, then run `php build/build.php` to regenerate the HTML in `public/`.
- World and building pages: content in `build/worlds/{world}.php`, photo captions in `build/photos/{world}-captions.php`, photo credits in `build/photos/{world}.json`.
- `tools/fetch-photos.php` finds openly licensed photos on Wikimedia Commons (searches in `tools/photo-queries.txt`, rejected files in `tools/photo-reject.txt`). Every photo was checked by eye.
- Checks: `bash tools/check-site.sh` (links, images, alt text, outbound links) and `php tools/deep-check.php` (ids, JSON-LD, stray characters, titles, sitemap).
- `tools/copy-people-vehicles.sh` copies the people art (first pose of each walk strip) and the vehicle art (front and back views). Rome, the Modern Town and the Robotic Future use people-batch-03 and vehicle-batch-01. Egypt, the Medieval Kingdom and the Heavenly City use the Life RPG game's art folder. The Green World uses the game's people and vehicle-batch-01's vehicles. Source images are never changed.
- `tools/copy-artwork.sh` exports every supplied illustration for the Artwork page (`public/assets/artwork/`).
- `tools/make-thumbs.sh` makes the small preview images in `public/assets/thumbs/` (search results, city builder, quiz, passport) from the web-sized building images.
- `build/play.php` builds search (`/data/search.json` and the A to Z page), the play hub and the games: city builder (with challenges), quiz, map hunt, memory match, word search, shadow match, zoom detective, picture puzzle, odd one out, world sort and passport. Card memory and Hero Cards are in `build/cardmemory.php` and `build/herocards.php`. Their browser code is in `public/js/`: `site.js` (search, phone menu, passport, badges), `builder.js`, `quiz.js`, `hunt.js` (runs on the world maps), `memory.js`, `wordsearch.js`, `puzzle.js`, `sort.js`, `cardmemory.js` and `herocards.js`.
- `build/classroom.php` builds the teacher tools: printable worksheets with answer keys, the glossary and the question bank. Word search puzzles are made once in `build/play.php` and shared by the game and the worksheets.
- `tools/copy-assets.sh` copies the selected artwork from the read-only source folders into `public/assets/worlds/{world}/` as web-sized WebP with transparency kept. The selection is listed in `tools/assets.txt`. Ancient Egypt, the Medieval Kingdom and the Heavenly City come from the Life RPG game's art folder (its full-size originals in `art/inbox/done/{world}/`, and its cut-out horizons). Source images are never changed.

## Preview locally

```bash
php -S localhost:8097 -t public
```

Then open http://localhost:8097/

## Publishing a change

The site is live at https://atlasofcities.org. After each change:

1. Run `php build/build.php`. Canonical links, the sitemap, robots.txt and social share images all use `SITE_URL` in `build/config.php`.
2. Run the checks: `bash tools/check-site.sh` and `php tools/deep-check.php`.
3. Commit and push to `main`. Cloudflare then deploys the Worker.

## Pages

| Path | Page |
| --- | --- |
| `/` | Home: hero city, stats, world cards, games, vehicles through time, people, tours, compare, teachers, artwork, shop (`build/home.php`) |
| `/worlds/{world}/` | City map (6 x 6 with streets, people and vehicles; zoom, pan, full screen, group highlighting) and a directory of its places (`build/worldpages.php`) |
| `/worlds/{world}/{place}/` | One page per place: what it was for, how it worked, photos of real sites, artwork notes, questions, sources |
| `/worlds/{world}/{vehicle}/` | Three or four vehicle pages per world (`build/vehicles.php`), with front and back views |
| `/worlds/{world}/people/` | The people of each world (`build/people.php`) |
| `/stories/`, `/stories/{world}/` | A picture-book story for each world, from the Life RPG game (`build/stories.php`) |
| `/tours/`, `/tours/{tour}/` | Seven guided tours, one for each world, each led by a guide (`build/tours.php`) |
| `/artwork/` | Every supplied illustration (453), by world: view full screen, save, print |
| `/credits/` | Photo credits and licenses |
| `/teachers/` | Teachers & Homeschool hub: 26 free guides, lessons and explainers (content in `build/teach.php`) |
| `/teachers/homeschool/` | Free homeschool resources: how families can use the site |
| `/teachers/{guide}/` | One guide each: quick answer, grades, time, steps, FAQ (FAQPage data), building pages to use, sources |
| `/teachers/free-images-for-classroom/` | How to use and credit the site's CC BY art |
| `/compare/` | One city question across all seven worlds (printable) |
| `/play/` | Play and create: the 13 games below |
| `/play/city-builder/` | City builder: place buildings, trees, water and squares from all seven worlds on a 6 x 6 city, check off ten needs, ten challenges, save a picture, share a link, print |
| `/play/quiz/` | City quiz: ten questions in five kinds (name it, which world, same job in another world, key words, who works here) |
| `/play/map-hunt/` | Map hunt: read a clue, find the place on a world map (the game runs on `/worlds/{world}/#hunt`) |
| `/play/memory/` | Memory match: six pairs (same job in two worlds, or picture and name) |
| `/play/word-search/` | Word search: 48 puzzles from the key words (six for each world and six with words from all of them), tap or drag to find words |
| `/play/shadows/`, `/play/zoom/`, `/play/puzzle/`, `/play/odd-one-out/`, `/play/world-sort/` | Shadow match, zoom detective, picture puzzle, odd one out and world sort |
| `/play/card-memory/` | Card memory: fourteen of the Life RPG game's painted trading cards, two from each world (`build/cardmemory.php`) |
| `/play/hero-cards/` | Hero Cards: a card duel against the computer with 56 of the game's cards, 8 from each world (`build/herocards.php`) |
| `/play/passport/` | Passport: a stamp for every place page opened, 20 badges for exploring and playing, and a pet that grows up as you collect stamps, kept in the browser |
| `/teachers/worksheets/` | 18 printable worksheets with answer keys: vocabulary and word search for each world, compare chart, two matching sheets, city planner |
| `/teachers/glossary/` | Every key word from the building pages, A to Z, filtered as you type |
| `/teachers/question-bank/` | Every "Think about it" question by world and group, with a question of the day |
| `/shop/` and each product's page | The shop: printables and Life RPG (`build/shop.php`, `build/printables.php`, `build/games.php`) |
| `/support/` | How to support the site: by buying from the shop |
| `/search/` | Every page from A to Z, filtered as you type (the header search box uses `/data/search.json`) |
| `/about/` | About, privacy, accessibility, artwork reuse, sources |
| `/guided/`, `/library/` | Old addresses, pointing to `/tours/` and `/artwork/` (not indexed) |

## Artwork inventory

Ancient Egypt, the Medieval Kingdom and the Heavenly City come from the Life RPG game's own art folder (`art/inbox/done/{world}/`, and its cut-out horizons). Ancient Rome, the Modern Town, the Green World and the Robotic Future come from these source batches (read-only):

- Buildings: `life-rpg-art-batch-01/art/inbox/{world}/` - 32 PNGs per world (33 in the "elven" folder, which is the Green World), all 1254x1254, transparent.
- Ground and environment: `life-rpg-ground-batch-01/raw/art/inbox/{world}/` - `horizon.png` (2172x724; the Green World's "elven" folder 1983x793), 7 textures `tex_*.png` (1254x1254, opaque), 4 trees `tree_1-4.png` (1254x1254).
- Construction: `life-rpg-construction-batch-01/art/inbox/{world}/` - `crane.png` (1024x1536), `materials.png` (1254x1254), and `roman/aqueduct.png` (1774x887).

The pictures chosen for each world are listed in `tools/assets.txt` (source file to website filename). People, vehicles, story paintings, cards, guides and pets are copied by the other `tools/copy-*.sh` scripts.

Every building picture in these batches is used. Not used yet: some of the ground textures and trees.

## Placeholders and open items

- `SITE_URL` is the site's domain, `https://atlasofcities.org`, served by the Cloudflare Worker (`wrangler.jsonc` attaches the domain and `www` on every deploy). The temporary `atlasofcities.koaa01.workers.dev` address is turned off, and the Hostinger copy (`yellowgreen-crab-278867.hostingersite.com`) sends every visit to the same page on the domain with a permanent redirect (the repo-root `.htaccess`).
- Google Search Console: add `atlasofcities.org` as a Domain property, verified by a TXT record in Cloudflare's DNS, and submit `https://atlasofcities.org/sitemap.xml`. That needs no tag on the site, so `GOOGLE_VERIFY` in `build/config.php` is empty.
- Pinterest: the site is claimed by the Atlas's Pinterest business account, with a tag on the home page (`PINTEREST_VERIFY` in `build/config.php`).
- Icons (`favicon.svg`, PNG icons) are a simple four-diamond mark made for this site; replace them with a real logo when one exists.
- Social share images (`public/assets/og/*.jpg`) are composed from the supplied artwork.

## Cloudflare

A Cloudflare Worker serves the site: `wrangler.jsonc` serves the files in `public/` as static assets and attaches atlasofcities.org and www.atlasofcities.org as custom domains. Its workers.dev address and preview addresses are off. `public/_headers` and `public/_redirects` give Cloudflare the same security headers, caching and redirects as `public/.htaccess` gives Apache.

## Hostinger

Hostinger is still connected to this repo (hPanel: **Websites → Manage → Advanced → Git**, branch `main`, directory empty), but it only redirects. The repo-root `.htaccess` sends every visit to Hostinger's own address on to the same page at https://atlasofcities.org with a permanent redirect. For any other address it serves the site from `public/` at the normal addresses and hides the build files.

## License

The illustrations are shared under Creative Commons Attribution 4.0 (CC BY 4.0): free for anyone to use for any purpose, with credit to "The Atlas of Cities". Photos of real places keep their own Wikimedia Commons licenses (see `/credits/`).

## Support

The Support page (`/support/`) asks visitors to help by buying from the shop, and its button goes to `/shop/`. Until a product has its store link, the page says the shop is coming soon.
