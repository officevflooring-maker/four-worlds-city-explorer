<?php
// Site-wide settings. Change SITE_URL to the real domain before going live,
// then run: php build/build.php
const SITE_URL  = 'https://atlasofcities.org';   // the site's domain, served by the Cloudflare Worker (wrangler.jsonc); no trailing slash
const SITE_NAME = 'The Atlas of Cities';
const SITE_TAGLINE = 'Past, Present and Imagined';
const SITE_DESC = 'Explore seven illustrated cities, from ancient Egypt and Rome to a medieval town, a forest city, Mars and a heavenly city, and learn how a city works.';   // 150 characters at most, or search results cut it
// Our sister site: Bible lessons for kids that use these pictures (its own repo, every-stone-speaks). The footer,
// the About page, the Heavenly City pages and the Bible lesson guide link to it.
const SISTER_URL = 'https://everystonespeaks.com/';
// Our store (Lemon Squeezy). Every 'buy' link below must be a checkout link from it: in the store, open the product,
// click Share and copy the link. The build stops on any other link.
const STORE_URL = 'https://theatlasofcities.lemonsqueezy.com';
// Where the Buy buttons go (owner, Nov 11, 2026): 'etsy' while the Lemon Squeezy store waits for approval, so every
// button opens the product's listing in our Etsy shop. When the store is approved, put its live links in each 'buy'
// below (atlas-products STORE-SETUP.md, step 5) and set this back to 'store'. On Etsy a product with no 'etsy'
// listing (Life RPG, which needs the store's license keys) says "Coming soon", and the Poster Set has a fixed price
// ('etsy_price'), since Etsy has no pay-what-you-want.
const SHOP_VIA = 'etsy';
const ETSY_SHOP = 'https://www.etsy.com/shop/EllaWallShop';
const ETSY_NAME = 'EllaWallShop';
// Our Pinterest page (the footer and the About page link to it).
const PINTEREST_URL = 'https://www.pinterest.com/kubik3016/';
// The shop (build/shop.php): things for grown-ups to buy, each with its own page. While a product's 'buy' link is
// empty its page says "Coming soon". 'open' is where Life RPG lives.
// Until the store is approved these are its TEST-MODE links (Lemon Squeezy's test card works on them). At launch,
// replace each with the live product's link (atlas-products STORE-SETUP.md, step 5).
// Each 'price' is what the store charges for that product. 'from' means pay what you want, from that price.
// The Support page sends visitors to the shop.
const SHOP = [
  'life-rpg'       => ['price' => '$5', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/6626256a-f4e4-4579-b0f3-c84647dede9a', 'open' => 'https://life-rpg.atlasofcities.org/'],
  'city-builders'  => ['price' => '$3.99', 'etsy' => '4607212846', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/1c0e24b5-5782-4bcc-aba0-96fe58bf8479'],
  'classroom-pack' => ['price' => '$5.99', 'etsy' => '4607224048', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/725d1f94-0a23-478c-92ed-875f559a87ad'],
  'posters'        => ['price' => '$2', 'etsy' => '4607220706', 'etsy_price' => '$3.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/49c866ae-dad3-497a-84a0-39d64af27e1b', 'from' => true],
  'journey'        => ['price' => '$4.99', 'etsy' => '4607199085', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/083be63b-810b-4a41-b5e3-514cce60c602'],
  'bingo'          => ['price' => '$4.99', 'etsy' => '4607214008', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/4e855f9d-dcea-4d4d-8e2f-535a9e932269'],
  'planners'       => ['price' => '$3.99', 'etsy' => '4607193429', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/497a53f7-d195-4515-bc81-565a8e2065c7'],
  'trivia'         => ['price' => '$4.99', 'etsy' => '4607214856', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/832a2aff-326c-4d11-9050-31be5bebe5da'],
  'wordwall'       => ['price' => '$4.99', 'etsy' => '4607217116', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/4b19b18b-29cc-4bd8-9fce-5a1dd75c853d'],
  'calendar'       => ['price' => '$3.99', 'etsy' => '4607218166', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/7e61126e-bcca-4f40-a315-effb6013edd0'],
  'playset'        => ['price' => '$5.99', 'etsy' => '4607222898', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/e84a6209-0062-4379-8f0b-48d7bc851a48'],
  'activity'       => ['price' => '$4.99', 'etsy' => '4607219226', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/2b5e09fe-7a69-496c-bcf3-67c6f5b64d5f'],
  'memory'         => ['price' => '$3.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/782040fa-ceee-418f-90a8-277c4a4fd19e'],
  'dominoes'       => ['price' => '$3.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/4e6e72b2-052e-4a82-bb3d-ccbf658613f2'],
  'storybook'      => ['price' => '$4.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/445f06f5-4b06-407c-95fb-b2ee94158a49'],
  // the two packs (owner, Nov 11, 2026: $34.99 and $14.99); their Etsy listings and store links come once they exist
  'bundle'         => ['price' => '$34.99', 'buy' => ''],
  'holiday-pack'   => ['price' => '$14.99', 'buy' => ''],
  'story-starters' => ['price' => '$3.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/05794f13-c398-469a-a81d-f0e71ec6b51a'],
];
// Google Search Console verification code (meta tag on the home page). Empty: the domain is verified as a Domain
// property by a TXT record in Cloudflare's DNS, which needs no tag.
const GOOGLE_VERIFY = '';
// Pinterest's code for claiming the site (a meta tag on the home page), from the Pinterest business account's
// Settings > Link to Pinterest > Websites. Claiming credits the site's pins to that account and turns on its analytics.
const PINTEREST_VERIFY = '9b19873d3a12602c933062df973abefb';
const LASTMOD   = '2026-10-29';

// The Life RPG game's six pets (tools/copy-pets.sh), in its order: the passport pet (/play/passport/) and the
// Life RPG page. The names are the game's; public/js/site.js has the same list.
const PETS = ['dog' => 'Puppy', 'cat' => 'Kitten', 'lamb' => 'Lamb', 'horse' => 'Pony', 'robodog' => 'Robo pup', 'fox' => 'Desert fox'];
