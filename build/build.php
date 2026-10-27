<?php
// Generates the static site into public/. Run: php build/build.php
// Hostinger (or any host) then serves public/ as plain files: no PHP, database or cookies needed.

require __DIR__ . '/config.php';
require __DIR__ . '/data.php';
require __DIR__ . '/roman.php';
require __DIR__ . '/photo-captions.php';
require __DIR__ . '/artwork.php';

const PUB = __DIR__ . '/../public';
const WORLD_ORDER = ['roman', 'modern', 'elven', 'future'];
$PHOTOS = json_decode(file_get_contents(__DIR__ . '/photo-credits.json'), true);

// Positions on the Roman 6 x 6 city map, from the back corner (0) to the front corner (35).
// Tall pieces stand at the back, low and wide ones at the front. 'tree' is a decorative olive tree.
const ROMAN_MAP = [
  'crane', 'lighthouse', 'victory-column', 'city-walls', 'imperial-statue', 'temple',
  'mausoleum', 'pantheon', 'imperial-palace', 'curia', 'treasury', 'temple-of-vesta',
  'amphitheater', 'circus', 'basilica', 'library', 'records-office', 'triumphal-arch',
  'villa', 'forum', 'public-baths', 'apartment-block', 'domus', 'school',
  'gladiator-school', 'warehouse', 'farmhouse', 'inn', 'shop', 'street-food',
  'olive-grove', 'garden', 'tree', 'public-fountain', 'building-materials', 'aqueduct',
];

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_HTML5, 'UTF-8'); }
function url($path) { return SITE_URL . $path; }

// Builds a responsive <img> from every size of one asset (e.g. aqueduct-960.webp, aqueduct-1600.webp).
function img($world, $name, $alt, $sizes, $attrs = '') {
  $files = glob(PUB . "/assets/worlds/$world/$name-*.webp");
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
  $fullTitle = $path === '/' ? $title : "$title | " . SITE_NAME;
  $ogImage = url('/assets/og/' . ($o['og'] ?? 'home') . '.jpg');
  $robots = !empty($o['noindex']) ? 'noindex, follow' : 'index, follow, max-image-preview:large';
  $bodyClass = $o['class'] ?? '';
  $cssV = asset_v('/css/site.css');
  $jsV = asset_v('/js/site.js');
  $ld = '';
  foreach ($o['ld'] ?? [] as $block) {
    $ld .= '<script type="application/ld+json">' . json_encode($block, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
  }
  $nav = '';
  $links = ['/' => 'Home'];
  foreach (WORLD_ORDER as $w) $links["/worlds/$w/"] = $WORLDS[$w]['short'];
  $links['/compare/'] = 'Compare';
  $links['/artwork/'] = 'Artwork';
  $links['/about/'] = 'About';
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
    <img class="lb-img" src="data:," alt="">
    <button type="button" class="lb-step lb-next" aria-label="Next image">&rarr;</button>
  </div>
  <p class="lb-credit"></p>
</dialog>
<div class="print-sheet" aria-hidden="true"><img alt=""><p></p></div>
HTML;
  $html = <<<HTML
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$fullTitle}</title>
<meta name="description" content="{$o['desc']}">
<meta name="robots" content="{$robots}">
<link rel="canonical" href="{$canonical}">
<meta name="theme-color" content="#f7f3ec">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{$GLOBALS['siteNameH']}">
<meta property="og:title" content="{$title}">
<meta property="og:description" content="{$o['desc']}">
<meta property="og:url" content="{$canonical}">
<meta property="og:image" content="{$ogImage}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="icon" href="/favicon-32.png" sizes="32x32" type="image/png">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="stylesheet" href="/css/site.css?v={$cssV}">
<script src="/js/site.js?v={$jsV}" defer></script>
{$ld}</head>
<body class="{$bodyClass}">
<a class="skip" href="#main">Skip to main content</a>
<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="/"><img src="/favicon.svg" width="28" height="28" alt=""> <span>Four Worlds <span class="brand-sub">City Explorer</span></span></a>
    <nav aria-label="Main"><ul>{$nav}</ul></nav>
  </div>
</header>
<main id="main" tabindex="-1">
{$o['body']}
</main>
<footer class="site-footer">
  <div class="wrap footer-inner">
    <p><strong>Four Worlds City Explorer</strong> - a free educational project about how cities work.</p>
    <p>No accounts, no ads, no tracking. <a href="/about/#privacy">Privacy</a> · <a href="/artwork/">Artwork</a> · <a href="/about/#sources">Sources</a> · <a href="/credits/">Photo credits</a></p>
    <p class="small">Illustrations &copy; {$year} Four Worlds City Explorer. Photos of real places are by the photographers credited with each one.</p>
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

// ---------- Home ----------
$cards = '';
foreach (WORLD_ORDER as $w) {
  $W = $WORLDS[$w];
  $cards .= '<li class="world-card world-' . $w . '"><a href="/worlds/' . $w . '/">'
    . '<span class="world-card-art" style="--tex:url(' . tex($w, $W['ground']) . ')">'
    . img($w, $W['card'], '', '(min-width: 900px) 280px, 70vw', 'loading="lazy"') . '</span>'
    . '<span class="world-card-text"><span class="tag">' . h($W['type']) . '</span>'
    . '<span class="world-card-name">' . h($W['name']) . '</span>'
    . '<span class="world-card-lead">' . h($W['lead']) . '</span>'
    . '<span class="world-card-go">Explore ' . h($W['short']) . ' city <span aria-hidden="true">&rarr;</span></span></span></a></li>';
}
$heroPick = [['roman', 'pantheon'], ['modern', 'public-library'], ['elven', 'treetop-village'], ['future', 'greenhouse-dome']];
$hero = '';
foreach ($heroPick as $i => [$w, $n]) {
  $hero .= '<div class="hero-piece hero-' . $w . '">' . img($w, $n, '', '(min-width: 900px) 260px, 40vw', $i ? '' : 'fetchpriority="high"') . '</div>';
}
page('/', [
  'title' => SITE_NAME . ': how cities work, in four illustrated worlds',
  'desc' => h(SITE_DESC),
  'class' => 'home',
  'body' => <<<HTML
<section class="hero">
  <div class="wrap hero-inner">
    <div class="hero-text">
      <h1>How does a city work?</h1>
      <p class="lead">Explore four illustrated cities, from ancient Rome to a robotic future. Discover what each building does, compare how each world solves the same problems, and think about what makes a good place to live.</p>
      <p class="hero-actions"><a class="btn" href="#worlds">Choose a world</a> <a class="btn btn-quiet" href="/compare/">Compare the worlds</a></p>
    </div>
    <div class="hero-art" aria-hidden="true">{$hero}</div>
  </div>
</section>

<section class="wrap section" id="worlds" aria-labelledby="worlds-h">
  <h2 id="worlds-h">Four worlds to explore</h2>
  <p class="setting-note"><strong>Rome is a historical setting.</strong> The modern town, the green elven world and the robotic future are imagined design settings for thinking about ideas, not real places.</p>
  <ul class="world-cards">{$cards}</ul>
</section>

<section class="wrap section how" aria-labelledby="how-h">
  <h2 id="how-h">How to use this site</h2>
  <ol class="steps">
    <li><strong>Look around.</strong> Open a world and select any building to learn what it does.</li>
    <li><strong>Look closer.</strong> Each place has something to notice and a question to think about.</li>
    <li><strong>Compare.</strong> See how all four worlds handle water, gathering, travel and nature.</li>
  </ol>
</section>

<section class="wrap section two-col" aria-label="For families and educators, and what is coming next">
  <div class="panel">
    <h2>For families and educators</h2>
    <p>Free to use, with no sign-up, ads or tracking. Questions are open-ended and work well for discussion at home or in class. Each of the 35 Roman building pages lists the sources its history is based on.</p>
    <p><a href="/artwork/">View, save and print the artwork</a> · <a href="/about/">About this project</a></p>
  </div>
  <div class="panel panel-later">
    <h2>Coming later</h2>
    <ul class="plain">
      <li><a href="/guided/">Guided explorations</a> - short tours such as Roman engineering.</li>
      <li>Detailed building pages for the modern, elven and future worlds.</li>
    </ul>
  </div>
</section>
HTML,
  'ld' => [[
    '@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => SITE_NAME, 'url' => url('/'),
    'description' => SITE_DESC, 'inLanguage' => 'en',
    'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => url('/'), 'logo' => url('/apple-touch-icon.png')],
  ]],
]);

// ---------- World pages ----------
// Modern, elven and future worlds: map buttons open a detail dialog. (Rome has full pages, below.)
function place_body($p) {
  [$id, $name, $imgName, $what, $look, $ask] = $p;
  return '<h4>Look closer</h4><p>' . h($look) . '</p><h4>Question to consider</h4><p class="ask">' . h($ask) . '</p>';
}

foreach (WORLD_ORDER as $w) {
  if ($w === 'roman') continue;
  $W = $WORLDS[$w];
  $map = '';
  $dir = '';
  foreach ($W['places'] as $k => $p) {
    [$id, $name, $imgName, $what] = $p;
    // Reverse order on the map so the crane and materials sit at the back and low, wide pieces in front.
    $slot = count($W['places']) - 1 - $k;
    $i = $slot % 4; $j = intdiv($slot, 4);
    $map .= '<li class="tile" style="--i:' . $i . ';--j:' . $j . '"><button type="button" class="tile-btn" data-place="' . $id . '" aria-haspopup="dialog">'
      . img($w, $imgName, '', '(min-width: 1100px) 300px, 27vw', 'loading="lazy" draggable="false"')
      . '<span class="tile-label">' . h($name) . '</span></button></li>';
    $dir .= '<li class="place" id="place-' . $id . '">'
      . '<div class="place-art">' . img($w, $imgName, "$name: illustration from the {$W['name']} city", '(min-width: 1100px) 240px, (min-width: 600px) 30vw, 45vw', 'loading="lazy"') . '</div>'
      . '<h3>' . h($name) . '</h3><p class="what">' . h($what) . '</p>'
      . '<details><summary>Look closer<span class="sr-only"> at the ' . h($name) . '</span></summary><div class="place-body">' . place_body($p) . '</div></details></li>';
  }
  $others = '';
  foreach (WORLD_ORDER as $o) if ($o !== $w) $others .= '<li><a class="world-link world-' . $o . '" href="/worlds/' . $o . '/">' . h($WORLDS[$o]['name']) . '</a></li>';
  $horizon = img($w, 'horizon', '', '100vw', 'fetchpriority="high"');
  $count = count($W['places']);
  $groundTex = tex($w, $W['ground']);
  page("/worlds/$w/", [
    'title' => $W['title'],
    'desc' => h($W['desc']),
    'og' => $w,
    'class' => "world world-$w",
    'body' => <<<HTML
<section class="world-hero">
  <div class="world-horizon" aria-hidden="true">{$horizon}</div>
  <div class="wrap world-hero-text">
    <p class="tag">{$W['type']}</p>
    <h1>{$W['name']}</h1>
    <p class="lead">{$W['lead']}</p>
  </div>
</section>

<section class="wrap section" aria-labelledby="map-h">
  <div class="map-head">
    <h2 id="map-h">Look around the city</h2>
    <label class="toggle"><input type="checkbox" id="show-labels"> Show building names</label>
  </div>
  <p class="hint">Select a building to learn about it. Every place is also listed below.</p>
  <div class="city" style="--tex:url({$groundTex});--n:4;--y0:18;aspect-ratio:100/72">
    <div class="city-ground" aria-hidden="true"></div>
    <ul class="city-tiles" aria-label="Buildings in the {$W['name']} city">{$map}</ul>
  </div>
  <p class="setting-note">{$W['note']}</p>
</section>

<section class="wrap section" aria-labelledby="dir-h">
  <h2 id="dir-h">All {$count} places</h2>
  <ul class="places">{$dir}</ul>
</section>

<section class="wrap section next" aria-labelledby="next-h">
  <h2 id="next-h">Keep exploring</h2>
  <p><a class="btn" href="/compare/">Compare all four worlds</a></p>
  <ul class="world-links">{$others}</ul>
</section>

<dialog class="place-dialog" aria-labelledby="dlg-title">
  <div class="dlg-inner">
    <button type="button" class="dlg-close" aria-label="Close">&times;</button>
    <div class="dlg-art"></div>
    <div class="dlg-text">
      <p class="tag">{$W['name']}</p>
      <h3 id="dlg-title"></h3>
      <p class="what"></p>
      <div class="dlg-body"></div>
      <div class="dlg-nav"><button type="button" class="btn btn-quiet" data-step="-1">&larr; Previous</button><button type="button" class="btn btn-quiet" data-step="1">Next &rarr;</button></div>
    </div>
  </div>
</dialog>
HTML,
    'ld' => [
      crumbs([['Home', '/'], [$W['name'], "/worlds/$w/"]]),
      learning($W['title'], $W['desc'], "/worlds/$w/", 'City design and how cities work'),
    ],
  ]);
}

// ---------- Ancient Rome: city map + one page per building ----------
function photo_figure($p, $cls = '') {
  global $PHOTO_CAPTIONS;
  $cap = $PHOTO_CAPTIONS[$p['img']] ?? '';
  $credit = 'Photo: ' . $p['author'] . ', ' . $p['license'] . ', via Wikimedia Commons';
  $f800 = "/assets/photos/roman/{$p['img']}-800.webp";
  $f1600 = "/assets/photos/roman/{$p['img']}-1600.webp";
  [$w, $hgt] = getimagesize(PUB . $f800);
  return '<figure class="photo ' . $cls . '"><button type="button" class="lb" data-full="' . $f1600 . '" data-title="' . h($cap) . '" data-credit="' . h($credit) . '" data-download="' . $p['img'] . '.webp" aria-label="View full size: ' . h($cap) . '">'
    . '<img src="' . $f800 . '" srcset="' . $f800 . ' 800w, ' . $f1600 . ' 1600w" sizes="(min-width: 900px) 760px, 100vw" width="' . $w . '" height="' . $hgt . '" alt="' . h($cap) . '" loading="lazy" decoding="async"></button>'
    . '<figcaption>' . h($cap) . ' <span class="credit">' . h($credit) . '</span></figcaption></figure>';
}

function roman_card($slug, $sizes = '(min-width: 1100px) 220px, (min-width: 600px) 30vw, 45vw') {
  global $ROMAN;
  $r = $ROMAN[$slug];
  return '<li class="place place-link"><a href="/worlds/roman/' . $slug . '/">'
    . '<span class="place-art">' . img('roman', $slug, '', $sizes, 'loading="lazy"') . '</span>'
    . '<span class="place-name">' . h($r['name']) . '</span><span class="what">' . h($r['summary']) . '</span></a></li>';
}

$W = $WORLDS['roman'];
$map = '';
foreach (ROMAN_MAP as $s => $slug) {
  $i = $s % 6; $j = intdiv($s, 6);
  if ($slug === 'tree') {
    $map .= '<li class="tile" style="--i:' . $i . ';--j:' . $j . '" aria-hidden="true">' . img('roman', 'olive-tree', '', '(min-width: 1100px) 200px, 18vw') . '</li>';
    continue;
  }
  $map .= '<li class="tile" style="--i:' . $i . ';--j:' . $j . '"><a class="tile-btn" href="/worlds/roman/' . $slug . '/">'
    . img('roman', $slug, '', '(min-width: 1100px) 200px, 18vw', 'draggable="false"')
    . '<span class="tile-label">' . h($ROMAN[$slug]['name']) . '</span></a></li>';
}
$dir = '';
$jump = '';
foreach ($ROMAN_CATEGORIES as $cat => [$label, $blurb]) {
  $cards = '';
  foreach ($ROMAN as $slug => $r) if ($r['cat'] === $cat) $cards .= roman_card($slug);
  $dir .= '<section class="cat" id="' . $cat . '" aria-labelledby="cat-' . $cat . '"><h3 id="cat-' . $cat . '">' . h($label) . '</h3><p class="what">' . h($blurb) . '</p><ul class="places">' . $cards . '</ul></section>';
  $jump .= '<li><a href="#' . $cat . '">' . h($label) . '</a></li>';
}
$others = '';
foreach (WORLD_ORDER as $o) if ($o !== 'roman') $others .= '<li><a class="world-link world-' . $o . '" href="/worlds/' . $o . '/">' . h($WORLDS[$o]['name']) . '</a></li>';
$horizon = img('roman', 'horizon', '', '100vw', 'fetchpriority="high"');
$romanCount = count($ROMAN);
$groundTex = tex('roman', $W['ground']);
$itemList = [];
foreach (array_keys($ROMAN) as $k => $slug) $itemList[] = ['@type' => 'ListItem', 'position' => $k + 1, 'name' => $ROMAN[$slug]['name'], 'url' => url("/worlds/roman/$slug/")];
page('/worlds/roman/', [
  'title' => 'Ancient Roman City Explorer: 35 buildings and how they worked',
  'desc' => h('Explore an illustrated ancient Roman city. Open any of 35 buildings, from aqueducts and baths to the Pantheon and the Senate house, to learn how it worked, with photos of real Roman sites.'),
  'og' => 'roman',
  'class' => 'world world-roman',
  'body' => <<<HTML
<section class="world-hero">
  <div class="world-horizon" aria-hidden="true">{$horizon}</div>
  <div class="wrap world-hero-text">
    <p class="tag">{$W['type']}</p>
    <h1>{$W['name']}</h1>
    <p class="lead">Ancient Rome was a real city of perhaps a million people. Explore {$romanCount} of its buildings: what each one was for, how it worked and where you can still see real examples today.</p>
  </div>
</section>

<section class="wrap section" aria-labelledby="map-h">
  <div class="map-head">
    <h2 id="map-h">Look around the city</h2>
    <label class="toggle"><input type="checkbox" id="show-labels"> Show building names</label>
  </div>
  <p class="hint">Select any building to open its page. Every building is also listed below.</p>
  <div class="city city-6" style="--tex:url({$groundTex});--n:6;--y0:16;aspect-ratio:100/69">
    <div class="city-ground" aria-hidden="true"></div>
    <ul class="city-tiles" aria-label="Buildings in the Roman city">{$map}</ul>
  </div>
  <p class="setting-note">The buildings are illustrations, not exact reconstructions. Each page separates what history tells us from what the artist imagined, and lists its sources.</p>
</section>

<section class="wrap section" aria-labelledby="dir-h">
  <h2 id="dir-h">All {$romanCount} buildings</h2>
  <nav aria-label="Building groups"><ul class="jump">{$jump}</ul></nav>
  {$dir}
</section>

<section class="wrap section next" aria-labelledby="next-h">
  <h2 id="next-h">Keep exploring</h2>
  <p><a class="btn" href="/compare/">Compare all four worlds</a> <a class="btn btn-quiet" href="/artwork/#roman">See all Roman artwork</a></p>
  <ul class="world-links">{$others}</ul>
</section>
HTML,
  'ld' => [
    crumbs([['Home', '/'], [$W['name'], '/worlds/roman/']]),
    learning('Ancient Roman City Explorer', 'An illustrated ancient Roman city with 35 building pages.', '/worlds/roman/', 'Ancient Roman architecture and city life'),
    ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => 'Buildings of ancient Rome', 'itemListElement' => $itemList],
  ],
]);

$slugs = array_keys($ROMAN);
foreach ($slugs as $k => $slug) {
  $r = $ROMAN[$slug];
  $photos = $PHOTOS[$slug] ?? [];
  $catLabel = $ROMAN_CATEGORIES[$r['cat']][0];
  $facts = '';
  foreach ($r['facts'] as $label => $val) $facts .= '<div><dt>' . h($label) . '</dt><dd>' . h($val) . '</dd></div>';
  // Sections, with a photo placed after each one while photos last.
  $body = '';
  $toc = '';
  $pi = 0;
  foreach ($r['sections'] as $n => $sec) {
    $id = 's' . ($n + 1);
    $toc .= '<li><a href="#' . $id . '">' . h($sec[0]) . '</a></li>';
    $body .= '<section class="read" aria-labelledby="' . $id . '"><h2 id="' . $id . '">' . h($sec[0]) . '</h2>';
    foreach (array_slice($sec, 1) as $part) {
      if (isset($part['list'])) {
        $body .= '<ul class="read-list">';
        foreach ($part['list'] as $li) $body .= '<li>' . h($li) . '</li>';
        $body .= '</ul>';
      } else {
        foreach ($part as $para) $body .= '<p>' . h($para) . '</p>';
      }
    }
    $body .= '</section>';
    if (isset($photos[$pi])) $body .= photo_figure($photos[$pi++]);
  }
  $more = '';
  for (; $pi < count($photos); $pi++) $more .= photo_figure($photos[$pi], 'photo-small');
  if ($more) $body .= '<div class="photo-grid">' . $more . '</div>';
  $toc .= '<li><a href="#artwork">In this artwork</a></li><li><a href="#think">Think about it</a></li><li><a href="#sources">Sources</a></li>';

  $look = '';
  foreach ($r['look'] as $l) $look .= '<li>' . h($l) . '</li>';
  $qs = '';
  foreach ($r['questions'] as $q) $qs .= '<li>' . h($q) . '</li>';
  $words = '';
  foreach ($r['words'] as $t => $d) $words .= '<div><dt>' . h($t) . '</dt><dd>' . h($d) . '</dd></div>';
  $srcs = '';
  foreach ($r['sources'] as $s) $srcs .= '<li>' . h($ROMAN_SOURCES[$s]) . '</li>';
  $rel = '';
  foreach ($r['related'] as $s) $rel .= roman_card($s, '(min-width: 900px) 200px, 45vw');
  $prev = $slugs[($k - 1 + count($slugs)) % count($slugs)];
  $next = $slugs[($k + 1) % count($slugs)];
  $hero = img('roman', $slug, "Illustration of a Roman " . strtolower($r['name']), '(min-width: 900px) 480px, 90vw', 'fetchpriority="high"');
  $heroFull = "/assets/artwork/roman/" . (str_starts_with($r['src'], 'build/') ? 'construction-' . basename($r['src'], '.png') : str_replace('_', '-', basename($r['src'], '.png'))) . '.webp';
  $nameH = h($r['name']);
  $latinH = h($r['latin']);
  $summaryH = h($r['summary']);
  $artH = h($r['art']);
  $catH = h($catLabel);
  $prevName = h($ROMAN[$prev]['name']);
  $nextName = h($ROMAN[$next]['name']);
  $photoCount = count($photos);
  $images = [url($heroFull)];
  foreach ($photos as $p) $images[] = url("/assets/photos/roman/{$p['img']}-1600.webp");
  page("/worlds/roman/$slug/", [
    'title' => "{$r['name']} in Ancient Rome: what it was and how it worked",
    'desc' => h($r['summary'] . ' Learn how it worked, see photos of real Roman examples, and explore questions for discussion.'),
    'og' => 'roman',
    'class' => 'world world-roman building',
    'lightbox' => true,
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/worlds/roman/">Ancient Rome</a></li><li><a href="/worlds/roman/#{$r['cat']}">{$catH}</a></li><li aria-current="page">{$nameH}</li></ol></nav>
</div>
<section class="wrap b-hero">
  <div class="b-art"><button type="button" class="lb" data-full="{$heroFull}" data-title="{$nameH} (illustration)" data-credit="Illustration: Four Worlds City Explorer" data-download="roman-{$slug}.webp" aria-label="View the illustration full size">{$hero}</button></div>
  <div class="b-intro">
    <p class="tag">Ancient Rome · {$catH}</p>
    <h1>{$nameH}</h1>
    <p class="latin">Latin: <i lang="la">{$latinH}</i></p>
    <p class="lead">{$summaryH}</p>
    <dl class="facts">{$facts}</dl>
  </div>
</section>

<div class="wrap b-layout">
  <aside class="b-toc" aria-label="On this page"><p class="toc-h">On this page</p><ol>{$toc}</ol></aside>
  <article class="b-body">
    {$body}
    <section class="read art-box" id="artwork" aria-labelledby="art-h">
      <h2 id="art-h"><span class="badge badge-art">Art</span> In this artwork</h2>
      <p>{$artH}</p>
      <h3>Look closer</h3>
      <ul class="read-list">{$look}</ul>
    </section>
    <section class="read" id="think" aria-labelledby="think-h">
      <h2 id="think-h">Think about it</h2>
      <ol class="questions">{$qs}</ol>
      <h3>Key words</h3>
      <dl class="words">{$words}</dl>
    </section>
    <section class="read sources-box" id="sources" aria-labelledby="src-h">
      <h2 id="src-h">Sources</h2>
      <p>The history on this page is a short summary based on these sources:</p>
      <ul class="sources">{$srcs}</ul>
    </section>
  </article>
</div>

<section class="wrap section" aria-labelledby="rel-h">
  <h2 id="rel-h">Related buildings</h2>
  <ul class="places places-3">{$rel}</ul>
  <nav class="pager" aria-label="More buildings">
    <a href="/worlds/roman/{$prev}/" rel="prev"><span>Previous</span> {$prevName}</a>
    <a href="/worlds/roman/" class="pager-all">All buildings</a>
    <a href="/worlds/roman/{$next}/" rel="next"><span>Next</span> {$nextName}</a>
  </nav>
</section>
HTML,
    'ld' => [
      crumbs([['Home', '/'], ['Ancient Rome', '/worlds/roman/'], [$r['name'], "/worlds/roman/$slug/"]]),
      ['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => "{$r['name']} in Ancient Rome", 'description' => $r['summary'],
        'image' => $images, 'inLanguage' => 'en', 'dateModified' => LASTMOD, 'url' => url("/worlds/roman/$slug/"),
        'about' => ['@type' => 'Thing', 'name' => $r['name'] . ' (ancient Rome)'],
        'author' => ['@type' => 'Organization', 'name' => SITE_NAME], 'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'logo' => ['@type' => 'ImageObject', 'url' => url('/icon-512.png')]],
        'isAccessibleForFree' => true, 'educationalUse' => 'Reading, discussion'],
    ],
  ]);
}

// ---------- Compare ----------
$rows = '';
foreach ($COMPARE as [$key, $label, $question, $cells]) {
  $li = '';
  foreach (WORLD_ORDER as $w) {
    [$imgName, $name, $prompt] = $cells[$w];
    $art = str_starts_with($imgName, 'ground-')
      ? '<img class="tex-img" src="' . tex($w, $imgName) . '" width="512" height="512" alt="' . h("$name in the {$WORLDS[$w]['name']} city, seen from above") . '" loading="lazy">'
      : img($w, $imgName, "$name in the {$WORLDS[$w]['name']} city", '(min-width: 1000px) 230px, 45vw', 'loading="lazy"');
    $li .= '<li class="cmp-cell world-' . $w . '"><p class="tag">' . h($WORLDS[$w]['name']) . '</p><div class="cmp-art">' . $art . '</div>'
      . '<h4>' . h($name) . '</h4><p>' . h($prompt) . '</p></li>';
  }
  $rows .= '<section class="cmp-row" id="' . $key . '" aria-labelledby="cmp-' . $key . '"><h2 id="cmp-' . $key . '">' . h($label) . '</h2>'
    . '<p class="cmp-q">' . h($question) . '</p><ul class="cmp-grid">' . $li . '</ul></section>';
}
$jump = '';
foreach ($COMPARE as [$key, $label]) $jump .= '<li><a href="#' . $key . '">' . h($label) . '</a></li>';
page('/compare/', [
  'title' => 'Compare the Worlds: water, gathering, travel and nature',
  'desc' => h('One city question, four settings. Compare how ancient Rome, a modern town, a green world and a robotic future could provide water, places to gather, safe travel and room for nature.'),
  'class' => 'compare',
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Compare the worlds</h1>
  <p class="big-q">How could a city provide water, places to gather, safe travel, and room for nature?</p>
  <p class="lead">Look at the same need in all four worlds. Rome is historical; the others are imagined, so treat them as ideas to test, not facts.</p>
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
    learning('Compare the Worlds', 'Compare how four city settings provide water, gathering places, safe travel and room for nature.', '/compare/', 'City design and infrastructure')],
]);

// ---------- About ----------
$srcList = '';
foreach ($ROMAN_SOURCES as $s) $srcList .= '<li>' . h($s) . '</li>';
page('/about/', [
  'title' => 'About, privacy and artwork',
  'desc' => h('About Four Worlds City Explorer: a free educational website with no accounts, ads or tracking. Privacy, accessibility, artwork reuse and sources.'),
  'class' => 'about',
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>About this project</h1>
  <p class="lead">Four Worlds City Explorer is a free educational and creative website. It uses illustrated cities to help visitors notice how cities work and think about what makes a good place to live.</p>

  <h2>What is real and what is imagined</h2>
  <p><strong>Ancient Rome</strong> is a historical setting. Each of its 35 building pages keeps history separate from the artist's interpretation and lists the sources it is based on. The illustrations are not exact reconstructions; photos of real Roman sites show what survives today.</p>
  <p>The <strong>modern town</strong>, <strong>green elven world</strong> and <strong>robotic future</strong> are imagined design settings. They don't describe real places, real cultures or predictions.</p>

  <h2 id="privacy">Privacy</h2>
  <p>This site has no accounts, forms, comments, chat, ads, analytics or tracking. It sets no cookies and loads nothing from other websites. Your web host may keep standard server logs.</p>

  <h2 id="accessibility">Accessibility</h2>
  <p>Every building is listed in text as well as on the map. The site works with a keyboard and screen readers, respects reduced-motion settings, and has no autoplay or flashing effects.</p>

  <h2 id="artwork">Artwork and reuse</h2>
  <p>The illustrations are not public domain. You're welcome to view, save and print them from the <a href="/artwork/">Artwork</a> page for personal and classroom use. Please ask before republishing them.</p>
  <p>Photos of real Roman places come from Wikimedia Commons and are public domain or shared under Creative Commons licences. Each photo is credited where it appears, and all licences are listed on the <a href="/credits/">photo credits</a> page.</p>

  <h2 id="sources">Sources</h2>
  <p>The Roman building pages are based on these sources:</p>
  <ul class="sources">{$srcList}</ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['About', '/about/']])],
]);

// ---------- Coming later ----------
page('/guided/', [
  'title' => 'Guided explorations (coming later)',
  'desc' => h('Short guided tours of the four city worlds are coming later.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <p class="tag">Coming later</p>
  <h1>Guided explorations</h1>
  <p class="lead">Short guided tours through the cities are planned. Ideas include:</p>
  <ul class="later-list">
    <li class="world-roman"><strong>Roman engineering</strong> - water, roads and building methods, with sources.</li>
    <li class="world-modern"><strong>Modern neighborhoods</strong> - getting around, public spaces and access for everyone.</li>
    <li class="world-elven"><strong>Ecological design</strong> - imaginative ideas about water, plants and shared land.</li>
    <li class="world-future"><strong>Human choices in robotic cities</strong> - technology, energy and who decides.</li>
  </ul>
  <p>Until then, <a href="/compare/">compare the worlds</a> or start with <a href="/worlds/roman/">ancient Rome</a>.</p>
</section>
HTML,
]);
page('/library/', [
  'title' => 'Art collection',
  'desc' => h('The Four Worlds art collection is now on the Artwork page.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>Art collection</h1>
  <p class="lead">Every illustration is now on the <a href="/artwork/">Artwork</a> page, where you can view, save and print it.</p>
</section>
HTML,
]);

// ---------- Artwork: every supplied illustration, by world ----------
$romanBySrc = [];
foreach ($ROMAN as $slug => $r) {
  $n = str_starts_with($r['src'], 'build/') ? 'construction-' . basename($r['src'], '.png') : str_replace('_', '-', basename($r['src'], '.png'));
  $romanBySrc[$n] = $slug;
}
$artSections = '';
$artJump = '';
$artTotal = 0;
foreach (WORLD_ORDER as $w) {
  $groups = array_fill_keys(array_keys($ART_GROUPS), '');
  $count = 0;
  $files = glob(PUB . "/assets/artwork/$w/*-thumb.webp");
  natsort($files);
  foreach ($files as $thumb) {
    $name = basename($thumb, '-thumb.webp');
    $slug = $w === 'roman' ? ($romanBySrc[$name] ?? null) : null;
    $title = $slug ? $ROMAN[$slug]['name'] : ($ART_TITLES[$w][preg_replace('/^ground-/', '', $name)] ?? $ART_COMMON[$name] ?? ucfirst(str_replace('-', ' ', $name)));
    $group = str_starts_with($name, 'construction-') ? 'construction'
      : (preg_match('/^ground-tree-|^trees$/', $name) ? 'trees' : (str_starts_with($name, 'ground-') ? 'ground' : 'buildings'));
    $full = "/assets/artwork/$w/$name.webp";
    [$tw, $th] = getimagesize($thumb);
    [$fw, $fh] = getimagesize(PUB . $full);
    $label = "{$WORLDS[$w]['name']}: $title";
    $more = $slug ? ' <a class="art-more" href="/worlds/roman/' . $slug . '/">Read about it</a>' : '';
    $groups[$group] .= '<li class="art-card"><button type="button" class="lb art-thumb" data-full="' . $full . '" data-title="' . h($label) . '" data-credit="Illustration: Four Worlds City Explorer (' . $fw . ' x ' . $fh . ' pixels)" data-download="' . "four-worlds-$w-$name.webp" . '" aria-label="View full size: ' . h($label) . '">'
      . '<img src="/assets/artwork/' . $w . '/' . $name . '-thumb.webp" width="' . $tw . '" height="' . $th . '" alt="' . h($label) . '" loading="lazy" decoding="async"></button>'
      . '<p class="art-title">' . h($title) . $more . '</p>'
      . '<p class="art-actions"><a href="' . $full . '" download="' . "four-worlds-$w-$name.webp" . '">Save</a> <button type="button" class="linkish js-print-art" data-full="' . $full . '" data-title="' . h($label) . '">Print</button></p></li>';
    $count++;
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
  'title' => 'Artwork: every illustration from the four city worlds',
  'desc' => h("View, save and print all $artTotal illustrations from Four Worlds City Explorer: ancient Roman, modern, elven and futuristic buildings, cranes, trees and landscapes."),
  'class' => 'artwork',
  'lightbox' => true,
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Artwork</h1>
  <p class="lead">All {$artTotal} illustrations from the four worlds. Select any picture to see it full size, open it full screen, save it or print it.</p>
  <nav aria-label="Worlds"><ul class="world-links">{$artJump}</ul></nav>
  <p class="small">Free to view, save and print for personal and classroom use. Please ask before republishing. Files are full-size WebP images, which open in all modern browsers and most photo apps.</p>
</section>
<div class="wrap">{$artSections}</div>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Artwork', '/artwork/']]),
    ['@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => 'Four Worlds artwork', 'url' => url('/artwork/'), 'inLanguage' => 'en']],
]);

// ---------- Photo credits (licences require a link to each source and licence) ----------
$rows = '';
foreach ($ROMAN as $slug => $r) {
  foreach ($PHOTOS[$slug] ?? [] as $p) {
    $lic = $p['licenseUrl'] ? '<a href="' . h($p['licenseUrl']) . '" rel="license noopener">' . h($p['license']) . '</a>' : h($p['license']);
    $rows .= '<li class="credit-row"><img src="/assets/photos/roman/' . $p['img'] . '-800.webp" width="120" height="80" alt="" loading="lazy">'
      . '<div><p><strong>' . h($PHOTO_CAPTIONS[$p['img']] ?? $p['file']) . '</strong></p>'
      . '<p>Used on: <a href="/worlds/roman/' . $slug . '/">' . h($r['name']) . '</a> · By ' . h($p['author']) . ' · ' . $lic
      . ' · <a href="' . h($p['page']) . '" rel="noopener">Original file</a></p></div></li>';
  }
}
page('/credits/', [
  'title' => 'Photo credits',
  'desc' => h('Credits and licences for the photos of real Roman places used on Four Worlds City Explorer.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>Photo credits</h1>
  <p class="lead">Photos of real Roman places come from Wikimedia Commons. They are public domain or shared under Creative Commons licences, and we thank the photographers.</p>
  <p>Photos have been resized and converted to WebP for this website. Under their licences you may reuse them by following the licence linked beside each one. The illustrations of the four worlds are not covered by these licences; see <a href="/about/#artwork">Artwork and reuse</a>.</p>
  <ul class="credit-list">{$rows}</ul>
</section>
HTML,
]);
page('/404.html', [
  'title' => 'Page not found',
  'desc' => h('This page could not be found.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>Page not found</h1>
  <p class="lead">That page doesn't exist. Try one of the worlds instead:</p>
  <ul class="world-links"><li><a class="world-link world-roman" href="/worlds/roman/">Ancient Rome</a></li><li><a class="world-link world-modern" href="/worlds/modern/">Modern Town</a></li><li><a class="world-link world-elven" href="/worlds/elven/">Elven Green World</a></li><li><a class="world-link world-future" href="/worlds/future/">Robotic Future</a></li></ul>
  <p><a href="/">Go to the home page</a></p>
</section>
HTML,
]);

// ---------- Sitemap, robots ----------
$urls = ['/' => '1.0'];
foreach (WORLD_ORDER as $w) $urls["/worlds/$w/"] = '0.9';
foreach (array_keys($ROMAN) as $slug) $urls["/worlds/roman/$slug/"] = '0.8';
$urls['/compare/'] = '0.8';
$urls['/artwork/'] = '0.7';
$urls['/about/'] = '0.5';
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $u => $pr) $xml .= "  <url><loc>" . url($u) . "</loc><lastmod>" . LASTMOD . "</lastmod><priority>$pr</priority></url>\n";
$xml .= "</urlset>\n";
file_put_contents(PUB . '/sitemap.xml', $xml);
file_put_contents(PUB . '/robots.txt', "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml') . "\n");
echo "wrote sitemap.xml, robots.txt\n";
