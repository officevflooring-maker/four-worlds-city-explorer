<?php
// Site-wide settings. Change SITE_URL to the real domain before going live,
// then run: php build/build.php
const SITE_URL  = 'https://atlasofcities.koaa01.workers.dev';   // Cloudflare Workers address (Google can index it). Change when a custom domain is connected (no trailing slash)
const SITE_NAME = 'The Atlas of Cities';
const SITE_TAGLINE = 'Past, Present and Imagined';
const SITE_DESC = 'Explore four illustrated isometric cities - ancient Rome, a modern town, a green elven world and a robotic future - and think about how cities work and what makes a good place to live.';
// Patreon page for donations (shown only on /support/). Leave empty until the page exists.
const PATREON_URL = 'https://www.patreon.com/cw/SamPetrov/home';
// Life RPG, the separate game for grown-ups (page /life-rpg/, built by build/liferpg.php). While LIFE_RPG_BUY is
// empty the page says "Coming soon". At launch, set it to the store's checkout link; LIFE_RPG_APP is the game itself.
const LIFE_RPG_BUY   = '';
const LIFE_RPG_APP   = 'https://life-rpg.koaa01.workers.dev/';
const LIFE_RPG_PRICE = '$3';
// Google Search Console verification code (meta tag on the home page).
const GOOGLE_VERIFY = 'hyYqg7CSEBBH3g2PZXng4J2Cx3ihW_7mYysjgOQfAfI';
const LASTMOD   = '2026-10-28';
