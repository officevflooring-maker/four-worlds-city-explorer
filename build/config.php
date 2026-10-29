<?php
// Site-wide settings. Change SITE_URL to the real domain before going live,
// then run: php build/build.php
const SITE_URL  = 'https://atlasofcities.org';   // the site's domain, served by the Cloudflare Worker (wrangler.jsonc); no trailing slash
const SITE_NAME = 'The Atlas of Cities';
const SITE_TAGLINE = 'Past, Present and Imagined';
const SITE_DESC = 'Explore six illustrated cities, from ancient Egypt and Rome to a modern town, an elven forest, Mars and a heavenly city, and learn how a city works.';
// Patreon page for donations, shown only on /support/ until the poster set below has its store link.
const PATREON_URL = 'https://www.patreon.com/cw/SamPetrov/home';
// Our store (Lemon Squeezy). Every 'buy' link below must be a checkout link from it: in the store, open the product,
// click Share and copy the link. The build stops on any other link.
const STORE_URL = 'https://theatlasofcities.lemonsqueezy.com';
// The shop (build/shop.php): things for grown-ups to buy, each with its own page. While a product's 'buy' link is
// empty its page says "Coming soon". At launch, paste in the store's checkout link. 'open' is where Life RPG lives.
// 'from' means pay what you want, from that price. The poster set's link also becomes the Support page's button,
// in place of Patreon.
const SHOP = [
  'life-rpg'       => ['price' => '$5', 'buy' => '', 'open' => 'https://life-rpg.koaa01.workers.dev/'],
  'city-builders'  => ['price' => '$3', 'buy' => ''],
  'classroom-pack' => ['price' => '$5', 'buy' => ''],
  'posters'        => ['price' => '$2', 'buy' => '', 'from' => true],
  'journey'        => ['price' => '$4', 'buy' => ''],
  'bingo'          => ['price' => '$4', 'buy' => ''],
  'planners'       => ['price' => '$3', 'buy' => ''],
  'trivia'         => ['price' => '$4', 'buy' => ''],
  'wordwall'       => ['price' => '$4', 'buy' => ''],
  'calendar'       => ['price' => '$3', 'buy' => ''],
  'playset'        => ['price' => '$5', 'buy' => ''],
  'activity'       => ['price' => '$4', 'buy' => ''],
];
// Google Search Console verification code (meta tag on the home page).
const GOOGLE_VERIFY = 'hyYqg7CSEBBH3g2PZXng4J2Cx3ihW_7mYysjgOQfAfI';
const LASTMOD   = '2026-10-29';
