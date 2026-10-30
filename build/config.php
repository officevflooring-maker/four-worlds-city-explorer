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
// empty its page says "Coming soon". 'open' is where Life RPG lives.
// Until the store is approved these are its TEST-MODE links (Lemon Squeezy's test card works on them). At launch,
// replace each with the live product's link (atlas-products STORE-SETUP.md, step 5).
// Each 'price' is what the store charges for that product. 'from' means pay what you want, from that price.
// The Support page sends visitors to the shop.
const SHOP = [
  'life-rpg'       => ['price' => '$5', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/6626256a-f4e4-4579-b0f3-c84647dede9a', 'open' => 'https://life-rpg.atlasofcities.org/'],
  'city-builders'  => ['price' => '$3.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/1c0e24b5-5782-4bcc-aba0-96fe58bf8479'],
  'classroom-pack' => ['price' => '$5.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/725d1f94-0a23-478c-92ed-875f559a87ad'],
  'posters'        => ['price' => '$2', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/49c866ae-dad3-497a-84a0-39d64af27e1b', 'from' => true],
  'journey'        => ['price' => '$4.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/083be63b-810b-4a41-b5e3-514cce60c602'],
  'bingo'          => ['price' => '$4.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/4e855f9d-dcea-4d4d-8e2f-535a9e932269'],
  'planners'       => ['price' => '$3.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/497a53f7-d195-4515-bc81-565a8e2065c7'],
  'trivia'         => ['price' => '$4.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/832a2aff-326c-4d11-9050-31be5bebe5da'],
  'wordwall'       => ['price' => '$4.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/4b19b18b-29cc-4bd8-9fce-5a1dd75c853d'],
  'calendar'       => ['price' => '$3.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/7e61126e-bcca-4f40-a315-effb6013edd0'],
  'playset'        => ['price' => '$5.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/e84a6209-0062-4379-8f0b-48d7bc851a48'],
  'activity'       => ['price' => '$4.99', 'buy' => 'https://theatlasofcities.lemonsqueezy.com/checkout/buy/2b5e09fe-7a69-496c-bcf3-67c6f5b64d5f'],
];
// Google Search Console verification code (meta tag on the home page). Empty: the domain is verified as a Domain
// property by a TXT record in Cloudflare's DNS, which needs no tag.
const GOOGLE_VERIFY = '';
const LASTMOD   = '2026-10-29';
