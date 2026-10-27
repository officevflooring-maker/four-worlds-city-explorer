# Four Worlds City Explorer

A free educational website: explore four illustrated isometric cities (Ancient Rome, a Modern Town, an Elven Green World and a Robotic Future), learn what each building does, and compare how each world provides water, places to gather, safe travel and room for nature.

No accounts, forms, cookies, ads, analytics or third-party requests.

## How it's built

- `public/` is the whole website (static HTML, CSS, JS, images). Upload its **contents** to Hostinger's `public_html`.
- `build/` holds the content (`data.php`), settings (`config.php`) and the page generator (`build.php`). Edit content there, then run `php build/build.php` to regenerate the HTML in `public/`.
- Roman building pages: content in `build/roman.php`, photo captions in `build/photo-captions.php`, photo credits in `build/photo-credits.json`.
- `tools/fetch-photos.php` finds openly licensed photos on Wikimedia Commons (searches in `tools/photo-queries.txt`, rejected files in `tools/photo-reject.txt`). Every photo was checked by eye.
- `tools/copy-artwork.sh` exports every supplied illustration for the Artwork page (`public/assets/artwork/`).
- `tools/copy-assets.sh` copies the selected artwork from the read-only source folders into `public/assets/worlds/{roman,modern,elven,future}/` as web-sized WebP with transparency kept. The selection is listed in `tools/assets.txt`. Source images are never changed.

## Preview locally

```bash
php -S localhost:8097 -t public
```

Then open http://localhost:8097/

## Before going live

1. Set the real domain in `build/config.php` (`SITE_URL`), then run `php build/build.php`. Canonical links, the sitemap, robots.txt and social share images all use it.
2. Upload the contents of `public/` (including the hidden `.htaccess`) to `public_html`.
3. Turn on SSL in Hostinger. `.htaccess` then redirects all visits to HTTPS.
4. Add the site to Google Search Console and submit `https://YOUR-DOMAIN/sitemap.xml`.

## Pages

| Path | Page |
| --- | --- |
| `/` | Home: four world cards |
| `/worlds/roman/` | Roman city map (6 x 6) linking to 35 building pages |
| `/worlds/roman/{building}/` | One page per Roman building: history, photos of real sites, artwork notes, questions, sources |
| `/worlds/modern/` etc. | City map + building directory with detail panels |
| `/artwork/` | Every supplied illustration (186), by world: view full screen, save, print |
| `/credits/` | Photo credits and licences (the only page with outbound links) |
| `/compare/` | One city question across all four worlds (printable) |
| `/about/` | About, privacy, accessibility, artwork reuse, sources |
| `/guided/` | "Coming later" placeholder (not indexed) |

## Artwork inventory

Source batches (read-only):

- Buildings: `life-rpg-art-batch-01/art/inbox/{world}/` - 32 PNGs per world (33 for elven), all 1254x1254, transparent.
- Ground and environment: `life-rpg-ground-batch-01/raw/art/inbox/{world}/` - `horizon.png` (2172x724; elven 1983x793), 7 textures `tex_*.png` (1254x1254, opaque), 4 trees `tree_1-4.png` (1254x1254).
- Construction: `life-rpg-construction-batch-01/art/inbox/{world}/` - `crane.png` (1024x1536), `materials.png` (1254x1254), and `roman/aqueduct.png` (1774x887).

Selected per world (16 places each, plus horizon and ground textures): see `tools/assets.txt` for the source file to website filename mapping. All four cranes and all four construction-material images are used.

Not used yet: the remaining building variants (`*_2`, `*_3`, `floor_*` etc.), most ground textures and trees, and the `nt_statue` / `monument` statues (several show human or humanoid figures).

## Placeholders and open items

- `SITE_URL` is set to the temporary Hostinger domain (`https://yellowgreen-crab-278867.hostingersite.com`). Change it to the real domain when one is chosen.
- Icons (`favicon.svg`, PNG icons) are a simple four-diamond mark made for this site; replace them with a real logo when one exists.
- Social share images (`public/assets/og/*.jpg`) are composed from the supplied artwork.
- The Roman "Library" and "Building materials" have no historical notes yet. They're marked as the artist's interpretation.

## Deploying to Hostinger with Git

Hostinger is connected to this repo (hPanel: **Websites → Manage → Advanced → Git**, branch `main`, directory empty).
The repo-root `.htaccess` serves the site from `public/` at the normal addresses and hides the build files.

After each change: run `php build/build.php`, commit and push to `main`, Hostinger auto-deploys it (or click **Redeploy** in hPanel).

