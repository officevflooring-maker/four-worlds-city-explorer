<?php
// Generates the static site into public/. Run: php build/build.php
// Hostinger (or any host) then serves public/ as plain files: no PHP, database or cookies needed.

require __DIR__ . '/config.php';
require __DIR__ . '/data.php';
require __DIR__ . '/artwork.php';

const PUB = __DIR__ . '/../public';
const WORLD_ORDER = ['roman', 'modern', 'elven', 'future'];

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
    <p class="small">Illustrations &copy; {$year} Four Worlds City Explorer, free to use under CC BY 4.0 with credit. Photos of real places are by the photographers credited with each one.</p>
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

require __DIR__ . '/worldpages.php';

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
foreach ($WORLD_DATA as $w => $D) {
  $srcList .= '<h3>' . h($WORLDS[$w]['name']) . '</h3><ul class="sources">';
  foreach ($D['sources'] as $s) $srcList .= '<li>' . h($s) . '</li>';
  $srcList .= '</ul>';
}
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
  <p>All illustrations of the four worlds are free for everyone to use, under the <a href="https://creativecommons.org/licenses/by/4.0/" rel="license">Creative Commons Attribution 4.0 (CC BY 4.0)</a> licence. You can copy, print, change, share and use them for any purpose, including in lessons, books, websites and commercial projects. The only condition is to credit them, for example: "Illustration: Four Worlds City Explorer".</p>
  <p>Save or print any of them from the <a href="/artwork/">Artwork</a> page.</p>
  <p>Photos of real Roman places come from Wikimedia Commons and are public domain or shared under Creative Commons licences. Each photo is credited where it appears, and all licences are listed on the <a href="/credits/">photo credits</a> page.</p>

  <h2 id="sources">Sources</h2>
  <p>The building pages are based on these sources, listed by world. Each page also lists the sources it uses.</p>
  {$srcList}
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
    $title = $slug ? $WORLD_DATA[$w]['pages'][$slug]['name'] : ($ART_TITLES[$w][preg_replace('/^ground-/', '', $name)] ?? $ART_COMMON[$name] ?? ucfirst(str_replace('-', ' ', $name)));
    $group = str_starts_with($name, 'construction-') ? 'construction'
      : (preg_match('/^ground-tree-|^trees$/', $name) ? 'trees' : (str_starts_with($name, 'ground-') ? 'ground' : 'buildings'));
    $full = "/assets/artwork/$w/$name.webp";
    [$tw, $th] = getimagesize($thumb);
    [$fw, $fh] = getimagesize(PUB . $full);
    $label = "{$WORLDS[$w]['name']}: $title";
    $more = $slug ? ' <a class="art-more" href="/worlds/' . $w . '/' . $slug . '/">Read about it</a>' : '';
    $groups[$group] .= '<li class="art-card"><button type="button" class="lb art-thumb" data-full="' . $full . '" data-title="' . h($label) . '" data-credit="Illustration: Four Worlds City Explorer, free to use under CC BY 4.0 (' . $fw . ' x ' . $fh . ' pixels)" data-download="' . "four-worlds-$w-$name.webp" . '" aria-label="View full size: ' . h($label) . '">'
      . '<img src="/assets/artwork/' . $w . '/' . $name . '-thumb.webp" width="' . $tw . '" height="' . $th . '" alt="' . h($label) . '" loading="lazy" decoding="async"></button>'
      . '<p class="art-title">' . h($title) . $more . '</p>'
      . '<p class="art-actions"><a href="' . $full . '" download="' . "four-worlds-$w-$name.webp" . '">Save</a> <button type="button" class="linkish js-print-art" data-full="' . $full . '" data-title="' . h($label) . '">Print</button></p></li>';
    $count++;
    // Licence data per image, so search engines can show the artwork as free to reuse.
    $artLd[] = ['@type' => 'ImageObject', 'contentUrl' => url($full), 'name' => $label, 'license' => 'https://creativecommons.org/licenses/by/4.0/',
      'acquireLicensePage' => url('/about/#artwork'), 'creditText' => 'Illustration: Four Worlds City Explorer',
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
  'title' => 'Artwork: every illustration from the four city worlds',
  'desc' => h("View, save and print all $artTotal illustrations from Four Worlds City Explorer: ancient Roman, modern, elven and futuristic buildings, cranes, trees and landscapes."),
  'class' => 'artwork',
  'lightbox' => true,
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Artwork</h1>
  <p class="lead">All {$artTotal} illustrations from the four worlds. Select any picture to see it full size, open it full screen, save it or print it.</p>
  <nav aria-label="Worlds"><ul class="world-links">{$artJump}</ul></nav>
  <p class="small">Free for everyone to use for any purpose under CC BY 4.0. Just credit "Illustration: Four Worlds City Explorer". <a href="/about/#artwork">More about reuse</a>. Files are full-size WebP images, which open in all modern browsers and most photo apps.</p>
</section>
<div class="wrap">{$artSections}</div>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Artwork', '/artwork/']]),
    ['@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => 'Four Worlds artwork', 'url' => url('/artwork/'), 'inLanguage' => 'en',
      'license' => 'https://creativecommons.org/licenses/by/4.0/', 'hasPart' => $artLd]],
]);

// ---------- Photo credits (licences require a link to each source and licence) ----------
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
  'desc' => h('Credits and licences for the photos of real Roman places used on Four Worlds City Explorer.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>Photo credits</h1>
  <p class="lead">Photos of real places and technology come from Wikimedia Commons. They are public domain or shared under Creative Commons licences, and we thank the photographers and organisations who shared them.</p>
  <p>Photos have been resized and converted to WebP for this website. Under their licences you may reuse them by following the licence linked beside each one. The illustrations of the four worlds are shared separately under CC BY 4.0; see <a href="/about/#artwork">Artwork and reuse</a>.</p>
  {$rows}
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
foreach ($WORLD_DATA as $w => $D) foreach (array_keys($D['pages']) as $slug) $urls["/worlds/$w/$slug/"] = '0.8';
$urls['/compare/'] = '0.8';
$urls['/artwork/'] = '0.7';
$urls['/about/'] = '0.5';
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $u => $pr) $xml .= "  <url><loc>" . url($u) . "</loc><lastmod>" . LASTMOD . "</lastmod><priority>$pr</priority></url>\n";
$xml .= "</urlset>\n";
file_put_contents(PUB . '/sitemap.xml', $xml);
file_put_contents(PUB . '/robots.txt', "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml') . "\n");
echo "wrote sitemap.xml, robots.txt\n";
