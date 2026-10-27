<?php
// Generates the static site into public/. Run: php build/build.php
// Hostinger (or any host) then serves public/ as plain files: no PHP, database or cookies needed.

require __DIR__ . '/config.php';
require __DIR__ . '/data.php';

const PUB = __DIR__ . '/../public';
const WORLD_ORDER = ['roman', 'modern', 'elven', 'future'];

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
  $links['/about/'] = 'About';
  foreach ($links as $href => $label) {
    $cur = $href === $path ? ' aria-current="page"' : '';
    $wc = str_starts_with($href, '/worlds/') ? ' class="nav-' . basename($href) . '"' : '';
    $nav .= "<li><a href=\"$href\"$cur$wc>" . h($label) . "</a></li>";
  }
  $year = substr(LASTMOD, 0, 4);
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
    <p>No accounts, no ads, no tracking. <a href="/about/#privacy">Privacy</a> · <a href="/about/#artwork">Artwork &amp; reuse</a> · <a href="/about/#sources">Sources</a></p>
    <p class="small">Artwork &copy; {$year} Four Worlds City Explorer. Not public domain.</p>
  </div>
</footer>
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
$heroPick = [['roman', 'domed-temple'], ['modern', 'public-library'], ['elven', 'treetop-village'], ['future', 'greenhouse-dome']];
$hero = '';
foreach ($heroPick as $i => [$w, $n]) {
  $hero .= '<div class="hero-piece hero-' . $w . '">' . img($w, $n, '', '(min-width: 900px) 260px, 40vw', $i ? 'loading="lazy"' : 'fetchpriority="high"') . '</div>';
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
    <p>Free to use, with no sign-up, ads or tracking. Questions are open-ended and work well for discussion at home or in class. Roman history notes link to their sources.</p>
    <p><a href="/about/">About this project</a></p>
  </div>
  <div class="panel panel-later">
    <h2>Coming later</h2>
    <ul class="plain">
      <li><a href="/guided/">Guided explorations</a> - short tours such as Roman engineering.</li>
      <li><a href="/library/">Art collection for creators and educators</a> - a browsable reference library.</li>
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
function place_body($w, $p) {
  global $SOURCES;
  [$id, $name, $imgName, $what, $look, $ask] = $p;
  $history = $p[6] ?? '';
  $src = $p[7] ?? [];
  $art = $p[8] ?? '';
  $out = '<h4>Look closer</h4><p>' . h($look) . '</p>';
  if ($w === 'roman') {
    if ($history) {
      $cites = [];
      foreach ($src as $k) $cites[] = '<a href="' . h($SOURCES[$k][2]) . '">' . h($SOURCES[$k][1]) . ': ' . h($SOURCES[$k][0]) . '</a>';
      $out .= '<h4><span class="badge badge-fact">History</span> What history tells us</h4><p>' . h($history) . '</p>'
        . '<p class="cite">Source: ' . implode('; ', $cites) . '</p>';
    }
    $out .= '<h4><span class="badge badge-art">Art</span> In this artwork</h4><p>' . h($art) . '</p>';
  }
  $out .= '<h4>Question to consider</h4><p class="ask">' . h($ask) . '</p>';
  return $out;
}

foreach (WORLD_ORDER as $w) {
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
      . '<details><summary>Look closer<span class="sr-only"> at the ' . h($name) . '</span></summary><div class="place-body">' . place_body($w, $p) . '</div></details></li>';
  }
  $sourcesBlock = '';
  if ($w === 'roman') {
    global $SOURCES;
    $li = '';
    foreach ($SOURCES as $s) $li .= '<li><a href="' . h($s[2]) . '">' . h($s[0]) . '</a> - ' . h($s[1]) . '</li>';
    $sourcesBlock = '<section class="wrap section" id="sources" aria-labelledby="src-h"><h2 id="src-h">Sources for the history notes</h2>'
      . '<p>History notes are short summaries. Follow the links to read more and check the details.</p><ul class="sources">' . $li . '</ul></section>';
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
  <div class="city" style="--tex:url({$groundTex})">
    <div class="city-ground" aria-hidden="true"></div>
    <ul class="city-tiles" aria-label="Buildings in the {$W['name']} city">{$map}</ul>
  </div>
  <p class="setting-note">{$W['note']}</p>
</section>

<section class="wrap section" aria-labelledby="dir-h">
  <h2 id="dir-h">All {$count} places</h2>
  <ul class="places">{$dir}</ul>
</section>
{$sourcesBlock}
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
      learning($W['title'], $W['desc'], "/worlds/$w/", $w === 'roman' ? 'Ancient Roman architecture and city life' : 'City design and how cities work'),
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
foreach ($SOURCES as $s) $srcList .= '<li><a href="' . h($s[2]) . '">' . h($s[0]) . '</a> - ' . h($s[1]) . '</li>';
page('/about/', [
  'title' => 'About, privacy and artwork',
  'desc' => h('About Four Worlds City Explorer: a free educational website with no accounts, ads or tracking. Privacy, accessibility, artwork reuse and sources.'),
  'class' => 'about',
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <h1>About this project</h1>
  <p class="lead">Four Worlds City Explorer is a free educational and creative website. It uses illustrated cities to help visitors notice how cities work and think about what makes a good place to live.</p>

  <h2>What is real and what is imagined</h2>
  <p><strong>Ancient Rome</strong> is a historical setting. Its history notes are short, separated from the artist's interpretation, and linked to their sources. The pictures themselves are illustrations, not exact reconstructions.</p>
  <p>The <strong>modern town</strong>, <strong>green elven world</strong> and <strong>robotic future</strong> are imagined design settings. They don't describe real places, real cultures or predictions.</p>

  <h2 id="privacy">Privacy</h2>
  <p>This site has no accounts, forms, comments, chat, ads, analytics or tracking. It sets no cookies and loads nothing from other websites. Your web host may keep standard server logs.</p>

  <h2 id="accessibility">Accessibility</h2>
  <p>Every building is listed in text as well as on the map. The site works with a keyboard and screen readers, respects reduced-motion settings, and has no autoplay or flashing effects.</p>

  <h2 id="artwork">Artwork and reuse</h2>
  <p>The artwork on this site is not public domain and is not free to reuse. You're welcome to view it and use these pages in class. Please ask before copying or republishing the images. A browsable art collection with clear reuse terms is <a href="/library/">coming later</a>.</p>

  <h2 id="sources">Sources</h2>
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
  'title' => 'Art collection for creators and educators (coming later)',
  'desc' => h('A browsable reference library of the Four Worlds artwork is coming later.'),
  'noindex' => true,
  'body' => <<<HTML
<section class="wrap section page-head narrow">
  <p class="tag">Coming later</p>
  <h1>Art collection for creators and educators</h1>
  <p class="lead">A browsable library of the buildings and landscapes from all four worlds is planned, with image descriptions, categories and clear reuse information.</p>
  <p>The artwork is not public domain. Until the library opens, please ask before reusing any images. See <a href="/about/#artwork">Artwork and reuse</a>.</p>
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
$urls['/compare/'] = '0.8';
$urls['/about/'] = '0.5';
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $u => $pr) $xml .= "  <url><loc>" . url($u) . "</loc><lastmod>" . LASTMOD . "</lastmod><priority>$pr</priority></url>\n";
$xml .= "</urlset>\n";
file_put_contents(PUB . '/sitemap.xml', $xml);
file_put_contents(PUB . '/robots.txt', "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml') . "\n");
echo "wrote sitemap.xml, robots.txt\n";
