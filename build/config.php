<?php
// Site-wide settings. Change SITE_URL to the real domain before going live,
// then run: php build/build.php
const SITE_URL  = 'https://atlasofcities.org';   // the site's domain, served by the Cloudflare Worker (wrangler.jsonc); no trailing slash
const SITE_NAME = 'The Atlas of Cities';
const SITE_TAGLINE = 'Past, Present and Imagined';
const SITE_DESC = 'Explore six illustrated cities, from ancient Egypt and Rome to a modern town, a green forest city, Mars and a heavenly city, and learn how a city works.';
// Our store (Lemon Squeezy). Every 'buy' link below must be a checkout link from it: in the store, open the product,
// click Share and copy the link. The build stops on any other link.
const STORE_URL = 'https://theatlasofcities.lemonsqueezy.com';
// The shop (build/shop.php): things for grown-ups to buy, each with its own page. While a product's 'buy' link is
// empty its page says "Coming soon". At launch, paste in the store's checkout link. 'open' is where Life RPG lives.
// Each 'price' is what the store charges for that product. 'from' means pay what you want, from that price.
// The Support page sends visitors to the shop.
const SHOP = [
  'life-rpg'       => ['price' => '$5', 'buy' => '', 'open' => 'https://life-rpg.atlasofcities.org/'],
  'city-builders'  => ['price' => '$3.99', 'buy' => ''],
  'classroom-pack' => ['price' => '$5.99', 'buy' => ''],
  'posters'        => ['price' => '$2', 'buy' => '', 'from' => true],
  'journey'        => ['price' => '$4.99', 'buy' => ''],
  'bingo'          => ['price' => '$4.99', 'buy' => ''],
  'planners'       => ['price' => '$3.99', 'buy' => ''],
  'trivia'         => ['price' => '$4.99', 'buy' => ''],
  'wordwall'       => ['price' => '$4.99', 'buy' => ''],
  'calendar'       => ['price' => '$3.99', 'buy' => ''],
  'playset'        => ['price' => '$5.99', 'buy' => ''],
  'activity'       => ['price' => '$4.99', 'buy' => ''],
];
// Google Search Console verification code (meta tag on the home page). Empty: the domain is verified as a Domain
// property by a TXT record in Cloudflare's DNS, which needs no tag.
const GOOGLE_VERIFY = '';
const LASTMOD   = '2026-10-29';
