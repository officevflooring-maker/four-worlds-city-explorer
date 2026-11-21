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
// Where the Buy buttons go:
//   'etsy'   (owner, Nov 11, 2026) every button opens the product's listing in our Etsy shop. A product with no
//            'etsy' listing (Life RPG, which needs a key) says "Coming soon", and the Poster Set has a fixed price
//            ('etsy_price'), since Etsy has no pay-what-you-want.
//   'stripe' (owner, Nov 16, 2026: Lemon Squeezy closed to new stores, "move everything to Stripe") every button
//            opens /buy/SLUG/, our own Stripe checkout (src/store.js), and the buyer gets a download page on this
//            site. Set it once Stripe is set up and a test purchase worked (STRIPE-STORE.md). Until the Worker has a
//            live Stripe key, /buy/ itself still sends buyers to the Etsy listing, so nothing breaks either way.
const SHOP_VIA = 'etsy';
const ETSY_SHOP = 'https://www.etsy.com/shop/EllaWallShop';
const ETSY_NAME = 'EllaWallShop';
// Our Pinterest page (the footer and the About page link to it).
const PINTEREST_URL = 'https://www.pinterest.com/kubik3016/';
// The shop (build/shop.php): things for grown-ups to buy, each with its own page. 'open' is where Life RPG lives.
// Each 'price' is what our Stripe store charges (the same prices Lemon Squeezy had; owner's, Oct 29 and Nov 11, 2026).
// 'from' means pay what you want, from that price, with 'etsy_price' as the suggested amount. 'etsy' is the Etsy
// listing number. 'tax' is the product's Stripe tax category (STRIPE-STORE.md), when it isn't STORE_TAX.
// (The Lemon Squeezy checkout links that were here went with that store: Lemon Squeezy is winding down.)
// The Support page sends visitors to the shop.
const SHOP = [
  'life-rpg'       => ['price' => '$5', 'open' => 'https://life-rpg.atlasofcities.org/', 'tax' => 'txcd_10201000'],
  'city-builders'  => ['price' => '$3.99', 'etsy' => '4607212846'],
  'classroom-pack' => ['price' => '$5.99', 'etsy' => '4607224048'],
  'posters'        => ['price' => '$2', 'etsy' => '4607220706', 'etsy_price' => '$3.99', 'from' => true, 'tax' => 'txcd_10505001'],
  'journey'        => ['price' => '$4.99', 'etsy' => '4607199085'],
  'bingo'          => ['price' => '$4.99', 'etsy' => '4607214008'],
  'planners'       => ['price' => '$3.99', 'etsy' => '4607193429'],
  'trivia'         => ['price' => '$4.99', 'etsy' => '4607214856'],
  'wordwall'       => ['price' => '$4.99', 'etsy' => '4607217116'],
  'calendar'       => ['price' => '$3.99', 'etsy' => '4607218166'],
  'playset'        => ['price' => '$5.99', 'etsy' => '4607222898'],
  'activity'       => ['price' => '$4.99', 'etsy' => '4607219226', 'tax' => 'txcd_10302000'],
  'memory'         => ['price' => '$3.99', 'etsy' => '4615195472'],
  'dominoes'       => ['price' => '$3.99', 'etsy' => '4615196434'],
  'storybook'      => ['price' => '$4.99', 'etsy' => '4615198120', 'tax' => 'txcd_10302000'],
  // the two packs (owner, Nov 11, 2026: $34.99 and $14.99)
  'bundle'         => ['price' => '$34.99', 'etsy' => '4615185881'],
  'holiday-pack'   => ['price' => '$14.99', 'etsy' => '4615186407'],
  'story-starters' => ['price' => '$3.99', 'etsy' => '4615183909'],
];
// Stripe tax category for a printable: "Digital other news or documents - downloadable - non subscription - with
// permanent rights". Every category used here is one Stripe Managed Payments accepts. Books (the Storybook, the
// Activity Book) are "Digital Books", the Poster Set "Digital Finished Artwork", Life RPG "Video Games - downloaded".
const STORE_TAX = 'txcd_10503000';
// The sister site's printables, sold through this same store (everystonespeaks.com's Buy buttons open
// https://atlasofcities.org/buy/SLUG/). Keep the names and prices in step with PRODUCTS in every-stone-speaks
// build/config.php. They sell through Stripe once their PDFs are uploaded (a row in the items table).
const STORE_ALSO = [
  'esp-lessons' => ['name' => 'The Walk: Sunday school curriculum', 'line' => 'Seven Bible lessons for Sunday schools and homeschools, ready to print.', 'price' => '$5.99', 'etsy' => '4613091322', 'page' => '/printables/#esp-lessons'],
  'esp-stories' => ['name' => 'Where Is Jesus? Picture stories', 'line' => 'Seven picture stories to read aloud, ready to print.', 'price' => '$4.99', 'etsy' => '4613091768', 'page' => '/printables/#esp-stories', 'tax' => 'txcd_10302000'],
  'esp-puzzles' => ['name' => 'Bible Puzzles', 'line' => 'Bible puzzles for kids 5 to 12, ready to print.', 'price' => '$3.99', 'etsy' => '4613090816', 'page' => '/printables/#esp-puzzles'],
  'esp-bingo'   => ['name' => 'Bible Picture Bingo', 'line' => 'Picture bingo for classes, clubs and family night, ready to print.', 'price' => '$3.99', 'etsy' => '4613075839', 'page' => '/printables/#esp-bingo'],
  'esp-verses'  => ['name' => 'Memory Verse Pack', 'line' => 'Twelve memory verses as posters and cards, ready to print.', 'price' => '$3.99', 'etsy' => '4613076255', 'page' => '/printables/#esp-verses'],
  'esp-advent'  => ['name' => 'The Advent Walk', 'line' => 'All 25 Advent days as cards to print, with an Advent chart.', 'price' => '$3.99', 'etsy' => '4613093078', 'page' => '/advent/'],
];
// Google Search Console verification code (meta tag on the home page). Empty: the domain is verified as a Domain
// property by a TXT record in Cloudflare's DNS, which needs no tag.
const GOOGLE_VERIFY = '';
// Pinterest's code for claiming the site (a meta tag on the home page), from the Pinterest business account's
// Settings > Link to Pinterest > Websites. Claiming credits the site's pins to that account and turns on its analytics.
const PINTEREST_VERIFY = '9b19873d3a12602c933062df973abefb';
// IndexNow (Nov 20, 2026): tells Bing and the other IndexNow engines about new or changed pages
// (tools/indexnow.php). The build serves it as /<key>.txt, which IndexNow reads to check the key. Never remove it.
const INDEXNOW_KEY = '50f700b5729e2bd2316af3033d4e9606';
const LASTMOD   = '2026-10-29';

// The Life RPG game's six pets (tools/copy-pets.sh), in its order: the passport pet (/play/passport/) and the
// Life RPG page. The names are the game's; public/js/site.js has the same list.
const PETS = ['dog' => 'Puppy', 'cat' => 'Kitten', 'lamb' => 'Lamb', 'horse' => 'Pony', 'robodog' => 'Robo pup', 'fox' => 'Desert fox'];
