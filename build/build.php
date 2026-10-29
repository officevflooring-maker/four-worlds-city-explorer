<?php
// Generates the static site into public/. Run: php build/build.php
// Hostinger (or any host) then serves public/ as plain files: no PHP, database or cookies needed.

require __DIR__ . '/config.php';
require __DIR__ . '/data.php';
require __DIR__ . '/artwork.php';
require __DIR__ . '/crosslinks.php';
require __DIR__ . '/teach.php';

const PUB = __DIR__ . '/../public';
// Oldest first; the Heavenly City, imagined and inspired by the Bible, comes last.
const WORLD_ORDER = ['egypt', 'roman', 'modern', 'elven', 'future', 'heaven'];

// Full worlds (one page per building): content in build/worlds/{world}.php, photo credits in
// build/photos/{world}.json and captions in build/photos/{world}-captions.php.
$WORLD_DATA = [];
$PHOTOS = [];
$PHOTO_CAPTIONS = [];
foreach (WORLD_ORDER as $w) {
  if (is_file(__DIR__ . "/worlds/$w.php")) require __DIR__ . "/worlds/$w.php";
  if (is_file(__DIR__ . "/photos/$w.json")) $PHOTOS[$w] = json_decode(file_get_contents(__DIR__ . "/photos/$w.json"), true);
  if (is_file(__DIR__ . "/photos/$w-captions.php")) require __DIR__ . "/photos/$w-captions.php";
}
require __DIR__ . '/vehicles.php';
require __DIR__ . '/people.php';

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_HTML5, 'UTF-8'); }
function url($path) { return SITE_URL . $path; }

// Builds a responsive <img> from every size of one asset (e.g. aqueduct-960.webp, aqueduct-1600.webp).
function img($world, $name, $alt, $sizes, $attrs = '') {
  // Only {name}-{width}.webp: chariot-arena-480.webp is another picture, not a size of chariot.
  $files = preg_grep('~/' . preg_quote($name, '~') . '-\d+\.webp$~', glob(PUB . "/assets/worlds/$world/$name-*.webp"));
  $set = [];
  foreach ($files as $f) { [$w, $hgt] = getimagesize($f); $set[$w] = [basename($f), $hgt]; }
  if (!$set) { fwrite(STDERR, "missing image $world/$name\n"); return ''; }
  ksort($set);
  $srcset = [];
  foreach ($set as $w => [$file]) $srcset[] = "/assets/worlds/$world/$file {$w}w";
  $first = array_key_first($set);
  $last = array_key_last($set);
  $ratioH = round($set[$last][1] * $first / $last);
  return sprintf('<img src="/assets/worlds/%s/%s" srcset="%s" sizes="%s" width="%d" height="%d" alt="%s" decoding="async"%s>',
    $world, $set[$first][0], implode(', ', $srcset), $sizes, $first, $ratioH, h($alt), $attrs ? " $attrs" : '');
}
function tex($world, $name) { return "/assets/worlds/$world/$name.webp"; }
function asset_v($file) { return substr(md5_file(PUB . $file), 0, 8); }

function world_label($w) { global $WORLDS; return $WORLDS[$w]['name']; }

function page($path, $o) {
  global $WORLDS;
  $canonical = url($path);
  $title = h($o['title']);
  // Search results show about 60 characters of a title, so the site's name goes on the end only where it fits.
  $fullTitle = $path === '/' || strlen($o['title'] . ' | ' . SITE_NAME) > 65 ? $title : "$title | " . SITE_NAME;
  $ogImage = url('/assets/og/' . ($o['og'] ?? 'home') . '.jpg');
  $ogType = $o['ogType'] ?? 'website';
  $ogAlt = h($o['ogAlt'] ?? $o['title']);
  $robots = !empty($o['noindex']) ? 'noindex, follow' : 'index, follow, max-image-preview:large';
  $bodyClass = $o['class'] ?? '';
  $verify = $path === '/' && GOOGLE_VERIFY ? '<meta name="google-site-verification" content="' . h(GOOGLE_VERIFY) . '">' . "
" : '';
  $cssV = asset_v('/css/site.css');
  $jsV = asset_v('/js/site.js');
  // Page-only scripts (city builder, quiz), from public/js/{name}.js.
  $moreJs = '';
  foreach ($o['js'] ?? [] as $name) $moreJs .= "<script src=\"/js/$name.js?v=" . asset_v("/js/$name.js") . "\" defer></script>\n";
  $ld = '';
  foreach ($o['ld'] ?? [] as $block) {
    $ld .= '<script type="application/ld+json">' . json_encode($block, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
  }
  $nav = '';
  $links = [];
  foreach (WORLD_ORDER as $w) $links["/worlds/$w/"] = $WORLDS[$w]['short'];
  $links['/compare/'] = 'Compare';
  $links['/tours/'] = 'Tours';
  $links['/play/'] = 'Play';
  $links['/teachers/'] = 'Teachers';
  $links['/artwork/'] = 'Artwork';
  foreach ($links as $href => $label) {
    $cur = $href === $path ? ' aria-current="page"' : ($href !== '/' && str_starts_with($path, $href) ? ' aria-current="true"' : '');
    $wc = str_starts_with($href, '/worlds/') ? ' class="nav-' . basename($href) . '"' : '';
    $nav .= "<li><a href=\"$href\"$cur$wc>" . h($label) . "</a></li>";
  }
  $year = substr(LASTMOD, 0, 4);
  // Shared full-screen viewer for any page with .lb image buttons (Roman pages, Artwork).
  $lightbox = empty($o['lightbox']) ? '' : <<<HTML
<dialog class="lightbox" aria-labelledby="lb-title">
  <div class="lb-bar">
    <p id="lb-title" class="lb-title"></p>
    <div class="lb-actions">
      <button type="button" class="btn btn-quiet lb-full">Full screen</button>
      <a class="btn btn-quiet lb-save" href="#" download>Save</a>
      <button type="button" class="btn btn-quiet lb-print">Print</button>
      <button type="button" class="lb-close" aria-label="Close">&times;</button>
    </div>
  </div>
  <div class="lb-stage">
    <button type="button" class="lb-step lb-prev" aria-label="Previous image">&larr;</button>
    <img class="lb-img" alt="">
    <button type="button" class="lb-step lb-next" aria-label="Next image">&rarr;</button>
  </div>
  <p class="lb-credit"></p>
</dialog>
<div class="print-sheet" aria-hidden="true"><img alt=""><p></p></div>
HTML;
  $html = <<<HTML
<!doctype html>
<html lang="en" data-pp-totals="{$GLOBALS['ppTotals']}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$fullTitle}</title>
<meta name="description" content="{$o['desc']}">
<meta name="robots" content="{$robots}">
{$verify}<link rel="canonical" href="{$canonical}">
<meta name="theme-color" content="#f7f5f0">
<meta property="og:type" content="{$ogType}">
<meta property="og:site_name" content="{$GLOBALS['siteNameH']}">
<meta property="og:title" content="{$title}">
<meta property="og:description" content="{$o['desc']}">
<meta property="og:url" content="{$canonical}">
<meta property="og:image" content="{$ogImage}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{$ogAlt}">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="icon" href="/favicon-32.png" sizes="32x32" type="image/png">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="stylesheet" href="/css/site.css?v={$cssV}">
<script src="/js/site.js?v={$jsV}" defer></script>
{$moreJs}{$ld}</head>
<body class="{$bodyClass}">
<a class="skip" href="#main">Skip to main content</a>
<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="/"><img src="/favicon.svg" width="28" height="28" alt=""> <span>The Atlas of Cities</span></a>
    <nav aria-label="Main" id="main-nav"><ul>{$nav}</ul></nav>
    <div class="hdr-tools">
      <a class="hdr-search" href="/search/"><svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5" fill="none" stroke="currentColor" stroke-width="2.4"/><path d="m15.5 15.5 5 5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/></svg><span>Search</span></a>
      <button type="button" class="menu-btn" aria-expanded="false" aria-controls="main-nav" hidden><span class="menu-icon" aria-hidden="true"></span><span class="menu-text">Menu</span></button>
    </div>
  </div>
</header>
<main id="main" tabindex="-1">
{$o['body']}
</main>
<footer class="site-footer">
  <div class="wrap footer-inner">
    <img class="footer-logo" src="/assets/brand/atlas-emblem-200.webp" srcset="/assets/brand/atlas-emblem-200.webp 200w, /assets/brand/atlas-emblem-400.webp 400w" sizes="110px" width="200" height="192" alt="" loading="lazy" decoding="async">
    <div>
      <p><strong>The Atlas of Cities: Past, Present and Imagined</strong> - a free educational project about how cities work.</p>
      <p>No accounts, no ads, no tracking. <a href="/about/">About</a> · <a href="/support/">Support this project</a> · <a href="/about/#privacy">Privacy</a> · <a href="/search/">Find a page</a> · <a href="/about/#sources">Sources</a> · <a href="/credits/">Photo credits</a> · <a href="/shop/">Shop</a></p>
      <p class="small">Illustrations &copy; {$year} The Atlas of Cities, free to use under CC BY 4.0 with credit. Photos of real places are by the photographers credited with each one.</p>
    </div>
  </div>
</footer>
{$lightbox}
</body>
</html>

HTML;
  $file = PUB . ($path === '/' ? '/index.html' : (str_ends_with($path, '.html') ? $path : $path . 'index.html'));
  @mkdir(dirname($file), 0777, true);
  file_put_contents($file, $html);
  echo "wrote $path\n";
}

function crumbs($items) {
  $list = [];
  foreach ($items as $i => [$name, $path]) $list[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $name, 'item' => url($path)];
  return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $list];
}

function learning($name, $desc, $path, $about) {
  return [
    '@context' => 'https://schema.org', '@type' => 'LearningResource',
    'name' => $name, 'description' => $desc, 'url' => url($path), 'inLanguage' => 'en',
    'learningResourceType' => 'Interactive resource', 'isAccessibleForFree' => true,
    'educationalUse' => 'Discussion, observation', 'audience' => ['@type' => 'EducationalAudience', 'educationalRole' => 'student, teacher, parent'],
    'about' => $about, 'isPartOf' => ['@type' => 'WebSite', 'name' => SITE_NAME, 'url' => url('/')],
  ];
}

$GLOBALS['siteNameH'] = h(SITE_NAME);
// Places per world, for passport progress on every page (public/js/site.js).
$GLOBALS['ppTotals'] = implode(' ', array_map(fn($w) => "$w:" . count($WORLD_DATA[$w]['pages']), WORLD_ORDER));

require __DIR__ . '/worldpages.php';
require __DIR__ . '/shop.php';          // before the pages that point to the shop
require __DIR__ . '/teachpages.php';
require __DIR__ . '/tours.php';
// The world maps and their pages, after the tours they point to.
foreach (WORLD_ORDER as $w) { full_world($w); people_page($w); }
require __DIR__ . '/play.php';
require __DIR__ . '/classroom.php';
require __DIR__ . '/home.php';

// ---------- Compare ----------
$rows = '';
foreach ($COMPARE as [$key, $label, $question, $cells]) {
  $li = '';
  foreach (WORLD_ORDER as $w) {
    [$imgName, $name, $prompt] = $cells[$w];
    // Link to the building page: the one named in the data, or a page with the same name as the image.
    $page = $cells[$w][3] ?? (isset($WORLD_DATA[$w]['pages'][$imgName]) ? $imgName : null);
    $more = $page ? '<p class="cmp-more"><a href="/worlds/' . $w . '/' . $page . '/">Read about the ' . h(strtolower($WORLD_DATA[$w]['pages'][$page]['name'])) . '</a></p>' : '';
    $art = str_starts_with($imgName, 'ground-')
      ? '<img class="tex-img" src="' . tex($w, $imgName) . '" width="512" height="512" alt="' . h("$name in the {$WORLDS[$w]['name']} city, seen from above") . '" loading="lazy">'
      : img($w, $imgName, "$name in the {$WORLDS[$w]['name']} city", '(min-width: 1000px) 230px, 45vw', 'loading="lazy"');
    $li .= '<li class="cmp-cell world-' . $w . '"><p class="tag">' . h($WORLDS[$w]['name']) . '</p><div class="cmp-art">' . $art . '</div>'
      . '<h3>' . h($name) . '</h3><p>' . h($prompt) . '</p>' . $more . '</li>';
  }
  $rows .= '<section class="cmp-row" id="' . $key . '" aria-labelledby="cmp-' . $key . '"><h2 id="cmp-' . $key . '">' . h($label) . '</h2>'
    . '<p class="cmp-q">' . h($question) . '</p><ul class="cmp-grid">' . $li . '</ul></section>';
}
$jump = '';
foreach ($COMPARE as [$key, $label]) $jump .= '<li><a href="#' . $key . '">' . h($label) . '</a></li>';
page('/compare/', [
  'title' => 'Compare the Worlds: water, gathering, travel, goods and nature',
  'desc' => h('One city question, six worlds: compare how ancient Egypt, Rome, a modern town, an elven forest, Mars and a heavenly city provide water, travel and more.'),
  'class' => 'compare',
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Compare the worlds</h1>
  <p class="big-q">How could a city provide water, places to gather, safe travel, goods and room for nature?</p>
  <p class="lead">Look at the same need in all six worlds. Egypt and Rome are historical; the others are imagined, so treat them as ideas to test, not facts.</p>
  <nav aria-label="Themes on this page"><ul class="jump">{$jump}</ul></nav>
</section>
<div class="wrap">{$rows}</div>
<section class="wrap section panel discuss" aria-labelledby="disc-h">
  <h2 id="disc-h">Talk it over</h2>
  <ul>
    <li>Which world's idea would work best where you live? Why?</li>
    <li>What does every world need, no matter the time or technology?</li>
    <li>Which ideas sound good but might leave some people out?</li>
  </ul>
  <p><button type="button" class="btn btn-quiet js-print">Print this page</button></p>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Compare the worlds', '/compare/']]),
    learning('Compare the Worlds', 'Compare how six city settings provide water, gathering places, safe travel and room for nature.', '/compare/', 'City design and infrastructure')],
]);

// ---------- About ----------
// Support goes through the store (the poster set, pay what you want) once its link is set; until then through Patreon.
$storeSupport = shop_open('posters');
$payPrivacy = $storeSupport
  ? '<p>Support and things in <a href="/shop/">the shop</a> are paid for on our store\'s website, under that store\'s own privacy policy. This site never sees payment or personal details. See <a href="/support/">Support this project</a>.</p>'
  : '<p>Donations are optional and handled entirely by Patreon, a separate website with its own privacy policy. This site never sees payment or personal details. See <a href="/support/">Support this project</a>.</p>'
    . "\n  " . '<p>Things in <a href="/shop/">the shop</a> are bought on a store website, under that store\'s own privacy policy. This site never sees those payment details either.</p>';
$srcList = '';
foreach ($WORLD_DATA as $w => $D) {
  $srcList .= '<h3>' . h($WORLDS[$w]['name']) . '</h3><ul class="sources">';
  foreach ($D['sources'] as $s) $srcList .= '<li>' . h($s) . '</li>';
  $srcList .= '</ul>';
}
page('/about/', [
  'title' => 'About, privacy and artwork',
  'desc' => h('About The Atlas of Cities: a free educational website with no accounts, ads or tracking. Privacy, accessibility, artwork reuse and sources.'),
  'class' => 'about',
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <img class="about-logo" src="/assets/brand/atlas-wordmark-360.webp" srcset="/assets/brand/atlas-wordmark-360.webp 360w, /assets/brand/atlas-wordmark-720.webp 720w" sizes="(min-width: 640px) 220px, 180px" width="360" height="364" alt="The Atlas of Cities">
  <h1>About this project</h1>
  <p class="lead">The Atlas of Cities is a free educational and creative website. It uses illustrated cities to help visitors notice how cities work and think about what makes a good place to live.</p>

  <h2>What is real and what is imagined</h2>
  <p><strong>Ancient Egypt</strong> and <strong>ancient Rome</strong> are historical settings. Each of their building pages keeps history separate from the artist's interpretation and lists the sources it is based on. The illustrations are not exact reconstructions; photos of real sites show what survives today.</p>
  <p>The <strong>modern town</strong> is imagined, but its pages explain real buildings, vehicles and systems: why towns need them, how they are built and who they serve.</p>
  <p>The <strong>green elven world</strong> and <strong>robotic future</strong> are imagined and speculative. They don't describe real places, real cultures or predictions. Each page uses labels so you always know what you are reading:</p>
  <ul>
    <li><span class="badge badge-fact">History</span> and <span class="badge badge-fact">Real world</span> facts about the past and about real places, technology and research, with sources.</li>
    <li><span class="badge badge-art">Imagined</span> ideas that belong to the fantasy world.</li>
    <li><span class="badge badge-spec">Possible future</span> ideas being researched or proposed, which may or may not happen.</li>
  </ul>
  <p>The <strong>Heavenly City</strong> is imagined too, inspired by the Bible's picture of the heavenly city. As you explore it, its <span class="badge badge-belief">Gospel</span> sections tell the story of Jesus in 35 parts, as the Bible tells it, with chapter and verse, and its <span class="badge badge-belief">Bible</span> sections share more words from Scripture. A few elven pages also share Bible verses about God the Creator. Bible quotations are from the Berean Standard Bible, which is in the public domain.</p>

  <h2 id="privacy">Privacy</h2>
  <p>This site has no accounts, forms, comments, chat, ads, analytics or tracking. It sets no cookies and loads nothing from other websites. Your web host may keep standard server logs.</p>
  <p>Passport stamps, quiz scores and the city you build are saved only in your own browser and never sent anywhere. You can clear them on the <a href="/play/passport/">passport page</a>.</p>
  {$payPrivacy}

  <h2 id="accessibility">Accessibility</h2>
  <p>Every building is listed in text as well as on the map. The site works with a keyboard and screen readers, respects reduced-motion settings, and has no autoplay or flashing effects.</p>

  <h2 id="artwork">Artwork and reuse</h2>
  <p>All illustrations of the six worlds are free for everyone to use, under the <a href="https://creativecommons.org/licenses/by/4.0/" rel="license">Creative Commons Attribution 4.0 (CC BY 4.0)</a> license. You can copy, print, change, share and use them for any purpose, including in lessons, books, websites and commercial projects. The only condition is to credit them, for example: "Illustration: The Atlas of Cities".</p>
  <p>Save or print any of them from the <a href="/artwork/">Artwork</a> page.</p>
  <p>The <a href="/teachers/">teacher guides</a>, worksheets, glossary and question bank are free to print and share for teaching. Please credit The Atlas of Cities.</p>
  <p>Photos of real places come from Wikimedia Commons and are public domain or shared under Creative Commons licenses. Each photo is credited where it appears, and all licenses are listed on the <a href="/credits/">photo credits</a> page.</p>

  <h2 id="sources">Sources</h2>
  <p>The building pages are based on these sources, listed by world. Each page also lists the sources it uses.</p>
  {$srcList}
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['About', '/about/']])],
]);

// ---------- Support (the only page that links to Patreon, until the store takes support) ----------
if ($storeSupport) {
  $give = '<p><a class="btn btn-big" href="' . h(SHOP['posters']['buy']) . '" rel="noopener">Support with ' . shop_price('posters') . ' or more</a></p>'
    . '<p class="small">You choose the amount and get the <a href="/posters/">Poster Set</a> as a thank-you. The button opens our store, a separate website.</p>';
  $giveBy = ['Support is optional. Everything on the site stays free either way.', 'Payments and personal details are handled by our store, under its own privacy policy. This site never sees them.'];
} else {
  $give = PATREON_URL
    ? '<p><a class="btn btn-big" href="' . h(PATREON_URL) . '" rel="noopener">Support on Patreon</a></p><p class="small">This button opens Patreon, a separate website.</p>'
    : '<p class="setting-note"><strong>Donations are opening soon.</strong> Until then, the best way to help is to share the site with a teacher or family who would enjoy it.</p>';
  $giveBy = ['Donations are optional. Everything on the site stays free either way.', 'Payments and personal details are handled by Patreon, under Patreon\'s own privacy policy. This site never sees them.'];
}
page('/support/', [
  'title' => 'Support this free project',
  'desc' => h('The Atlas of Cities is free for everyone, with no ads, accounts or tracking. ' . ($storeSupport ? 'Paying what you want for the posters helps' : 'Optional donations help') . ' add new worlds and fact-checking.'),
  'class' => 'support',
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <p class="tag">Support</p>
  <h1>Help keep it free</h1>
  <p class="lead">The Atlas of Cities is free for everyone, with no ads, accounts or tracking. If it helps your class or your family, you can help it grow.</p>
  {$give}
  <h2>What support pays for</h2>
  <ul class="plain-points">
    <li>New worlds, buildings, vehicles and guided tours.</li>
    <li>Printable packs and worksheets for classrooms.</li>
    <li>Fact-checking by teachers and historians.</li>
    <li>Hosting, so the site stays fast and free.</li>
  </ul>
  <h2>Before you give</h2>
  <ul class="plain-points">
    <li>{$giveBy[0]}</li>
    <li>{$giveBy[1]}</li>
    <li>Under 18? Please ask a parent or guardian first.</li>
  </ul>
  <h2>Free ways to help</h2>
  <ul class="plain-points">
    <li>Share the site with a teacher, school or family.</li>
    <li>Use the illustrations in your lessons and projects, with the credit "Illustration: The Atlas of Cities".</li>
  </ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Support', '/support/']])],
]);

// ---------- Coming later ----------
page('/library/', [
  'title' => 'Art collection',
  'desc' => h('The art collection of The Atlas of Cities is now on the Artwork page, where you can view, save and print every illustration.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>Art collection</h1>
  <p class="lead">Every illustration is now on the <a href="/artwork/">Artwork</a> page, where you can view, save and print it.</p>
</section>
HTML,
]);

// ---------- Artwork: every supplied illustration, by world ----------
// Which building page each illustration belongs to, so cards can link to "Read about it".
$pageBySrc = [];
foreach ($WORLD_DATA as $w => $D) foreach ($D['pages'] as $slug => $r) $pageBySrc[$w][artwork_name($r['src'])] = $slug;
$artSections = '';
$artJump = '';
$artTotal = 0;
$artLd = [];
foreach (WORLD_ORDER as $w) {
  $groups = array_fill_keys(array_keys($ART_GROUPS), '');
  $count = 0;
  $files = glob(PUB . "/assets/artwork/$w/*-thumb.webp");
  natsort($files);
  foreach ($files as $thumb) {
    $name = basename($thumb, '-thumb.webp');
    $slug = $pageBySrc[$w][$name] ?? null;
    if (!$slug && str_ends_with($name, '-back') && ($front = $pageBySrc[$w][substr($name, 0, -5)] ?? null)) { $slug = $front; $ART_TITLES[$w][$name] = $WORLD_DATA[$w]['pages'][$front]['name'] . ' (back view)'; }
    if (isset($PEOPLE[$w][$name])) $ART_TITLES[$w][$name] = $PEOPLE[$w][$name][0];
    $title = $slug && !isset($ART_TITLES[$w][$name]) ? $WORLD_DATA[$w]['pages'][$slug]['name'] : ($ART_TITLES[$w][preg_replace('/^ground-/', '', $name)] ?? $ART_COMMON[$name] ?? ucfirst(str_replace('-', ' ', $name)));
    $group = str_starts_with($name, 'vehicle-') ? 'vehicles' : (preg_match('/^(people|worker)-/', $name) ? 'people' : null);
    $group ??= str_starts_with($name, 'construction-') ? 'construction'
      : (preg_match('/^ground-tree-|^trees$/', $name) ? 'trees' : (str_starts_with($name, 'ground-') ? 'ground' : 'buildings'));
    $full = "/assets/artwork/$w/$name.webp";
    [$tw, $th] = getimagesize($thumb);
    [$fw, $fh] = getimagesize(PUB . $full);
    $label = "{$WORLDS[$w]['name']}: $title";
    $more = $slug ? ' <a class="art-more" href="/worlds/' . $w . '/' . $slug . '/">Read about it</a>' : ($group === 'people' ? ' <a class="art-more" href="/worlds/' . $w . '/people/#' . $name . '">Meet them</a>' : '');
    $groups[$group] .= '<li class="art-card"><button type="button" class="lb art-thumb" data-full="' . $full . '" data-title="' . h($label) . '" data-credit="Illustration: The Atlas of Cities, free to use under CC BY 4.0 (' . $fw . ' x ' . $fh . ' pixels)" data-download="' . "atlas-of-cities-$w-$name.webp" . '" aria-label="View full size: ' . h($label) . '">'
      . '<img src="/assets/artwork/' . $w . '/' . $name . '-thumb.webp" width="' . $tw . '" height="' . $th . '" alt="' . h($label) . '" loading="lazy" decoding="async"></button>'
      . '<p class="art-title">' . h($title) . $more . '</p>'
      . '<p class="art-actions"><a href="' . $full . '" download="' . "atlas-of-cities-$w-$name.webp" . '">Save</a> <button type="button" class="linkish js-print-art" data-full="' . $full . '" data-title="' . h($label) . '">Print</button></p></li>';
    $count++;
    // License data per image, so search engines can show the artwork as free to reuse.
    $artLd[] = ['@type' => 'ImageObject', 'contentUrl' => url($full), 'name' => $label, 'license' => 'https://creativecommons.org/licenses/by/4.0/',
      'acquireLicensePage' => url('/about/#artwork'), 'creditText' => 'Illustration: The Atlas of Cities',
      'creator' => ['@type' => 'Organization', 'name' => SITE_NAME], 'copyrightNotice' => SITE_NAME];
  }
  $artTotal += $count;
  $inner = '';
  foreach ($ART_GROUPS as $g => $glabel) {
    if ($groups[$g] === '') continue;
    $inner .= '<h3>' . h($glabel) . '</h3><ul class="art-grid">' . $groups[$g] . '</ul>';
  }
  $artSections .= '<section class="art-world world-' . $w . '" id="' . $w . '" aria-labelledby="art-' . $w . '"><h2 id="art-' . $w . '">' . h($WORLDS[$w]['name']) . ' <span class="count">' . $count . ' images</span></h2>' . $inner . '</section>';
  $artJump .= '<li><a class="world-link world-' . $w . '" href="#' . $w . '">' . h($WORLDS[$w]['name']) . '</a></li>';
}
page('/artwork/', [
  'title' => 'Artwork: every illustration from the six city worlds',
  'desc' => h("View, save and print all $artTotal illustrations from The Atlas of Cities: ancient Roman, modern, elven and futuristic buildings, cranes, trees and landscapes."),
  'class' => 'artwork',
  'lightbox' => true,
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Artwork</h1>
  <p class="lead">All {$artTotal} illustrations from the six worlds. Select any picture to see it full size, open it full screen, save it or print it.</p>
  <nav aria-label="Worlds"><ul class="world-links">{$artJump}</ul></nav>
  <p class="small">Free for everyone to use for any purpose under CC BY 4.0. Just credit "Illustration: The Atlas of Cities". <a href="/about/#artwork">More about reuse</a>. Files are full-size WebP images, which open in all modern browsers and most photo apps.</p>
</section>
<div class="wrap">{$artSections}</div>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Artwork', '/artwork/']]),
    ['@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => 'The Atlas of Cities artwork', 'url' => url('/artwork/'), 'inLanguage' => 'en',
      'license' => 'https://creativecommons.org/licenses/by/4.0/', 'hasPart' => $artLd]],
]);

// ---------- Photo credits (licenses require a link to each source and license) ----------
$rows = '';
foreach ($WORLD_DATA as $w => $D) {
  $list = '';
  foreach ($D['pages'] as $slug => $r) {
    foreach ($PHOTOS[$w][$slug] ?? [] as $p) {
      $lic = $p['licenseUrl'] ? '<a href="' . h($p['licenseUrl']) . '" rel="license noopener">' . h($p['license']) . '</a>' : h($p['license']);
      $list .= '<li class="credit-row"><img src="/assets/photos/' . $w . '/' . $p['img'] . '-800.webp" width="120" height="80" alt="" loading="lazy">'
        . '<div><p><strong>' . h($PHOTO_CAPTIONS[$w][$p['img']] ?? $p['file']) . '</strong></p>'
        . '<p>Used on: <a href="/worlds/' . $w . '/' . $slug . '/">' . h($r['name']) . '</a> · By ' . h($p['author']) . ' · ' . $lic
        . ' · <a href="' . h($p['page']) . '" rel="noopener">Original file</a></p></div></li>';
    }
  }
  if ($list) $rows .= '<h2>' . h($WORLDS[$w]['name']) . '</h2><ul class="credit-list">' . $list . '</ul>';
}
page('/credits/', [
  'title' => 'Photo credits',
  'desc' => h('Credits and licenses for every photo of a real place on The Atlas of Cities: who took it, its license, and a link to the original on Wikimedia Commons.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>Photo credits</h1>
  <p class="lead">Photos of real places and technology come from Wikimedia Commons. They are public domain or shared under Creative Commons licenses, and we thank the photographers and organizations who shared them.</p>
  <p>Photos have been resized and converted to WebP for this website. Under their licenses you may reuse them by following the license linked beside each one. The illustrations of the six worlds are shared separately under CC BY 4.0; see <a href="/about/#artwork">Artwork and reuse</a>.</p>
  {$rows}
</section>
HTML,
]);
$nfWorlds = '';
foreach (WORLD_ORDER as $w) $nfWorlds .= '<li><a class="world-link world-' . $w . '" href="/worlds/' . $w . '/">' . h($WORLDS[$w]['name']) . '</a></li>';
page('/404.html', [
  'title' => 'Page not found',
  'desc' => h('This page could not be found. Explore six illustrated city worlds, free games and guided tours on The Atlas of Cities instead.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <img class="nf-logo" src="/assets/brand/atlas-emblem-400.webp" srcset="/assets/brand/atlas-emblem-200.webp 200w, /assets/brand/atlas-emblem-400.webp 400w" sizes="170px" width="400" height="382" alt="">
  <h1>Page not found</h1>
  <p class="lead">That page doesn't exist. Try one of the worlds instead:</p>
  <ul class="world-links">{$nfWorlds}</ul>
  <p><a class="btn" href="/search/">Find a page</a> <button type="button" class="btn btn-quiet" data-surprise hidden>Surprise me</button></p>
  <p><a href="/">Go to the home page</a></p>
</section>
HTML,
]);

// ---------- Sitemap, robots ----------
$urls = ['/' => '1.0'];
foreach (WORLD_ORDER as $w) {
  $urls["/worlds/$w/"] = '0.9';
  $urls["/worlds/$w/people/"] = '0.7';
  if (!empty($WORLD_DATA[$w]['story'])) $urls["/worlds/$w/story/"] = '0.8';
}
foreach ($WORLD_DATA as $w => $D) foreach (array_keys($D['pages']) as $slug) $urls["/worlds/$w/$slug/"] = '0.8';
$urls['/compare/'] = '0.8';
$urls['/tours/'] = '0.8';
foreach (array_keys($TOURS) as $slug) $urls["/tours/$slug/"] = '0.8';
$urls['/teachers/'] = '0.9';
foreach (array_keys($TEACH) as $slug) $urls["/teachers/$slug/"] = '0.8';
$urls['/play/'] = '0.8';
$urls['/play/city-builder/'] = '0.8';
$urls['/play/quiz/'] = '0.8';
$urls['/play/passport/'] = '0.5';
$urls['/play/map-hunt/'] = '0.8';
$urls['/play/memory/'] = '0.8';
$urls['/play/word-search/'] = '0.8';
foreach (['/play/world-sort/', '/play/shadows/', '/play/zoom/', '/play/odd-one-out/', '/play/puzzle/'] as $u) $urls[$u] = '0.8';
$urls['/teachers/worksheets/'] = '0.9';
foreach ($SHEETS as [$slug]) $urls["/teachers/worksheets/$slug/"] = '0.8';
$urls['/teachers/glossary/'] = '0.8';
$urls['/teachers/question-bank/'] = '0.8';
$urls['/search/'] = '0.4';
$urls['/artwork/'] = '0.7';
$urls['/about/'] = '0.5';
$urls['/support/'] = '0.4';
$urls['/shop/'] = '0.5';
$urls['/life-rpg/'] = '0.5';
$urls['/city-builders/'] = '0.5';
$urls['/classroom-pack/'] = '0.5';
$urls['/posters/'] = '0.5';
foreach (['/journey/', '/bingo/', '/planners/', '/trivia/', '/wordwall/', '/calendar/', '/playset/', '/activity/'] as $u) $urls[$u] = '0.5';
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $u => $pr) $xml .= "  <url><loc>" . url($u) . "</loc><lastmod>" . LASTMOD . "</lastmod><priority>$pr</priority></url>\n";
$xml .= "</urlset>\n";
file_put_contents(PUB . '/sitemap.xml', $xml);
file_put_contents(PUB . '/robots.txt', "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml') . "\n");
echo "wrote sitemap.xml, robots.txt\n";
