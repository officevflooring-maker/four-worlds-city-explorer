<?php
// World pages: every world has a content file in build/worlds/{world}.php, a 6 x 6 city map where
// every building links to its own page, and one page per building.
// Included from build.php, which defines page(), img() and the other helpers.

// ---------- Full worlds: city map + one page per building ----------
function other_worlds($w) {
  global $WORLDS;
  $out = '';
  foreach (WORLD_ORDER as $o) if ($o !== $w) $out .= '<li><a class="world-link world-' . $o . '" href="/worlds/' . $o . '/">' . h($WORLDS[$o]['name']) . '</a></li>';
  return $out;
}

// Photo credit and caption for one Wikimedia Commons photo.
function photo_figure($w, $p, $cls = '') {
  global $PHOTO_CAPTIONS;
  $cap = $PHOTO_CAPTIONS[$w][$p['img']] ?? '';
  if ($cap === '') fwrite(STDERR, "missing caption $w/{$p['img']}\n");
  $credit = 'Photo: ' . $p['author'] . ', ' . $p['license'] . ', via Wikimedia Commons';
  $f800 = "/assets/photos/$w/{$p['img']}-800.webp";
  $f1600 = "/assets/photos/$w/{$p['img']}-1600.webp";
  [$pw, $ph] = getimagesize(PUB . $f800);
  return '<figure class="photo ' . $cls . '"><button type="button" class="lb" data-full="' . $f1600 . '" data-title="' . h($cap) . '" data-credit="' . h($credit) . '" data-download="' . "$w-{$p['img']}.webp" . '" aria-label="View full size: ' . h($cap) . '">'
    . '<img src="' . $f800 . '" srcset="' . $f800 . ' 800w, ' . $f1600 . ' 1600w" sizes="(min-width: 900px) 760px, 100vw" width="' . $pw . '" height="' . $ph . '" alt="' . h($cap) . '" loading="lazy" decoding="async"></button>'
    . '<figcaption>' . h($cap) . ' <span class="credit">' . h($credit) . '</span></figcaption></figure>';
}

function building_card($w, $slug, $sizes = '(min-width: 1100px) 220px, (min-width: 600px) 30vw, 45vw') {
  global $WORLD_DATA;
  $r = $WORLD_DATA[$w]['pages'][$slug];
  return '<li class="place place-link world-' . $w . '" data-pp="' . "$w/$slug" . '"><a href="/worlds/' . $w . '/' . $slug . '/">'
    . '<span class="place-art">' . img($w, $slug, '', $sizes, 'loading="lazy"') . '</span>'
    . '<span class="place-name">' . h($r['name']) . '</span><span class="what">' . h($r['summary']) . '</span></a></li>';
}

// Name of a page's illustration on the Artwork page (public/assets/artwork/{world}/{name}.webp).
function artwork_name($src) {
  [$batch, $file] = explode('/', $src);
  $stem = str_replace('_', '-', basename($file, '.png'));
  return ['art' => '', 'build' => 'construction-', 'ground' => 'ground-', 'vehicle' => 'vehicle-'][$batch] . $stem;
}

// Badges that mark a section as real-world fact, imagined, speculative, or what a faith teaches (Heavenly City).
const SECTION_TAGS = [
  'real'        => ['badge-fact', 'Real world'],
  'imagined'    => ['badge-art', 'Imagined'],
  'speculative' => ['badge-spec', 'Possible future'],
  'history'     => ['badge-fact', 'History'],
  'belief'      => ['badge-belief', 'Belief'],
];

// Buildings in other worlds that share a group with this one (see build/crosslinks.php).
function cross_links($w, $slug) {
  global $CROSSLINKS, $WORLD_DATA;
  $out = [];
  foreach ($CROSSLINKS as $group) {
    if (!in_array("$w/$slug", $group)) continue;
    foreach ($group as $key) {
      [$ow, $os] = explode('/', $key);
      if ($ow === $w || isset($out[$key])) continue;
      if (!isset($WORLD_DATA[$ow]['pages'][$os])) { fwrite(STDERR, "unknown crosslink $key
"); continue; }
      $out[$key] = [$ow, $os];
    }
  }
  return array_slice(array_values($out), 0, 6);
}

function full_world($w) {
  global $WORLDS, $WORLD_DATA, $PHOTOS;
  $W = $WORLDS[$w];
  $D = $WORLD_DATA[$w];
  $pages = $D['pages'];
  $label = $W['name'];

  // Map: buildings on a 6 x 6 grid with streets between them, plus people and vehicles on the streets.
  $map = '';
  $tileSizes = '(min-width: 1100px) 220px, 22vw';
  $tileData = function ($slug) use ($w, $pages, $D) {
    $r = $pages[$slug];
    return ' data-cat="' . $r['cat'] . '" data-name="' . h($r['name']) . '" data-catname="' . h($D['cats'][$r['cat']][0]) . '" data-sum="' . h($r['summary']) . '"';
  };
  foreach ($D['map'] as $s => $slug) {
    $i = $s % 6; $j = intdiv($s, 6);
    if ($slug === 'tree') {
      $map .= '<li class="tile tile-tree" style="--i:' . $i . ';--j:' . $j . '" aria-hidden="true">' . img($w, $D['tree'], '', $tileSizes) . '</li>';
      continue;
    }
    $map .= '<li class="tile" style="--i:' . $i . ';--j:' . $j . '"' . $tileData($slug) . '><a class="tile-btn" href="/worlds/' . $w . '/' . $slug . '/">'
      . img($w, $slug, '', $tileSizes, 'draggable="false"')
      . '<span class="tile-label">' . h($pages[$slug]['name']) . '</span></a></li>';
  }
  // Street life: points are in grid units (u along i, v along j); whole numbers are street lines.
  global $VEHICLES, $PEOPLE;
  $decor = '';
  // Inner streets are hidden behind buildings, so street life uses the two front edges of the city.
  $carSpots = [[6.1, .95, ''], [6.1, 2.4, 'rear-'], [6.1, 3.85, ''], [6.1, 5.3, 'rear-']];
  foreach (array_keys($VEHICLES[$w] ?? []) as $k => $vslug) {
    [$u, $v, $side] = $carSpots[$k];
    $decor .= '<li class="tile decor decor-car" style="--u:' . $u . ';--v:' . $v . ';--z:' . floor($u + $v) . '"' . $tileData($vslug) . '><a class="tile-btn" href="/worlds/' . $w . '/' . $vslug . '/">'
      . img($w, $side . $vslug, '', '120px', 'draggable="false" loading="lazy"') . '<span class="tile-label">' . h($pages[$vslug]['name']) . '</span></a></li>';
  }
  $personSpots = [[.45, 6.1], [1.15, 6.1], [2.05, 6.1], [2.75, 6.1], [3.6, 6.1], [4.3, 6.1], [5.05, 6.1], [5.65, 6.1]];
  foreach (array_keys($PEOPLE[$w] ?? []) as $k => $file) {
    [$u, $v] = $personSpots[$k];
    [$pname, $prole] = $PEOPLE[$w][$file];
    $decor .= '<li class="tile decor decor-person" style="--u:' . $u . ';--v:' . $v . ';--z:' . floor($u + $v) . '" data-cat="people" data-name="' . h($pname) . '" data-catname="People" data-sum="' . h($prole) . '"><a class="tile-btn" href="/worlds/' . $w . '/people/#' . $file . '">'
      . img($w, $file, '', '64px', 'draggable="false" loading="lazy"') . '<span class="tile-label">' . h($pname) . '</span></a></li>';
  }
  $map .= $decor;
  // Filter buttons: one per building group shown on the map, plus people and vehicles.
  $onMap = [];
  foreach ($D['map'] as $slug) if ($slug !== 'tree') $onMap[$pages[$slug]['cat']] = true;
  $filters = '<button type="button" class="chip" data-filter="" aria-pressed="true">Everything</button>';
  foreach ($D['cats'] as $cat => [$clabel]) {
    if (isset($onMap[$cat]) || $cat === 'vehicles') $filters .= '<button type="button" class="chip" data-filter="' . $cat . '" aria-pressed="false">' . h($clabel) . '</button>';
  }
  $filters .= '<button type="button" class="chip" data-filter="people" aria-pressed="false">People</button>';
  // Directory by category
  $dir = '';
  $jump = '';
  foreach ($D['cats'] as $cat => [$clabel, $blurb]) {
    $cards = '';
    foreach ($pages as $slug => $r) if ($r['cat'] === $cat) $cards .= building_card($w, $slug);
    if ($cards === '') continue;
    $dir .= '<section class="cat" id="' . $cat . '" aria-labelledby="cat-' . $cat . '"><h3 id="cat-' . $cat . '">' . h($clabel) . '</h3><p class="what">' . h($blurb) . '</p><ul class="places">' . $cards . '</ul></section>';
    $jump .= '<li><a href="#' . $cat . '">' . h($clabel) . '</a></li>';
  }
  $others = other_worlds($w);
  $horizon = img($w, 'horizon', '', '100vw', 'fetchpriority="high"');
  $count = count($pages);
  $groundTex = tex($w, $W['ground']);
  $roadTex = tex($w, 'ground-crossroads');
  $introH = h($D['intro']);
  $noteH = h($D['note']);
  $aside = empty($D['aside']) ? '' : '<aside class="panel aside-note" aria-labelledby="aside-h"><h3 id="aside-h">' . h($D['aside'][0]) . '</h3><p>' . h($D['aside'][1]) . '</p></aside>';
  $itemList = [];
  foreach (array_keys($pages) as $k => $slug) $itemList[] = ['@type' => 'ListItem', 'position' => $k + 1, 'name' => $pages[$slug]['name'], 'url' => url("/worlds/$w/$slug/")];
  page("/worlds/$w/", [
    'title' => $D['title'],
    'desc' => h($D['desc']),
    'og' => $w,
    'class' => "world world-$w",
    'js' => ['hunt'],
    'body' => <<<HTML
<section class="world-hero">
  <div class="world-horizon" aria-hidden="true">{$horizon}</div>
  <div class="wrap world-hero-text">
    <p class="tag">{$W['type']}</p>
    <h1>{$label}</h1>
    <p class="lead">{$introH}</p>
  </div>
</section>

<section class="map-section" id="hunt" aria-labelledby="map-h">
  <div class="wrap map-head">
    <div>
      <h2 id="map-h">Look around the city</h2>
      <p class="hint">Select any building, person or vehicle to open its page. Everything is also listed below.</p>
    </div>
    <p class="map-links"><a href="/worlds/{$w}/people/">Meet the people</a> · <a href="/tours/">Guided tours</a></p>
  </div>
  <div class="map-shell" data-map>
    <div class="wrap map-tools">
      <div class="chips" role="group" aria-label="Highlight on the map">{$filters}</div>
      <div class="map-ctrl">
        <label class="toggle"><input type="checkbox" id="show-labels"> Names</label>
        <span class="zoom" role="group" aria-label="Zoom" hidden><button type="button" class="ctrl" data-zoom="-1" aria-label="Zoom out">&minus;</button><button type="button" class="ctrl" data-zoom="0" aria-label="Reset zoom">Fit</button><button type="button" class="ctrl" data-zoom="1" aria-label="Zoom in">+</button></span>
        <button type="button" class="ctrl map-full" hidden>Full screen</button>
        <button type="button" class="ctrl hunt-start" hidden>Map hunt</button>
      </div>
    </div>
    <div class="wrap hunt-bar" hidden></div>
    <div class="map-view">
      <div class="city city-6" style="--tex:url({$groundTex});--roadtex:url({$roadTex});--n:6;--y0:10">
        <div class="city-ground" aria-hidden="true"></div>
        <ul class="city-tiles" aria-label="Buildings, people and vehicles in the {$label} city">{$map}</ul>
      </div>
    </div>
    <div class="wrap map-info" aria-live="polite"><p class="map-info-empty">Point at anything on the map to learn what it is.</p></div>
  </div>
  <div class="wrap">
    <p class="setting-note">{$noteH}</p>
    {$aside}
  </div>
</section>

<section class="wrap section" aria-labelledby="dir-h">
  <h2 id="dir-h">All {$count} places and vehicles</h2>
  <nav aria-label="Building groups"><ul class="jump">{$jump}</ul></nav>
  {$dir}
</section>

<section class="wrap section next" aria-labelledby="next-h">
  <h2 id="next-h">Keep exploring</h2>
  <p><a class="btn" href="/compare/">Compare all six worlds</a> <a class="btn btn-quiet" href="/artwork/#{$w}">See all {$label} artwork</a></p>
  <ul class="world-links">{$others}</ul>
</section>
HTML,
    'ld' => [
      crumbs([['Home', '/'], [$label, "/worlds/$w/"]]),
      learning($D['title'], $D['desc'], "/worlds/$w/", $D['about']),
      ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => "Buildings of the $label city", 'itemListElement' => $itemList],
    ],
  ]);

  // One page per building
  $slugs = array_keys($pages);
  $photosAll = $PHOTOS[$w] ?? [];
  foreach ($slugs as $k => $slug) {
    $r = $pages[$slug];
    $photos = $photosAll[$slug] ?? [];
    $catLabel = $D['cats'][$r['cat']][0];
    $facts = '';
    foreach ($r['facts'] as $flabel => $val) $facts .= '<div><dt>' . h($flabel) . '</dt><dd>' . h($val) . '</dd></div>';
    // Sections, with a photo placed after each one while photos last.
    $body = '';
    $toc = '';
    $pi = 0;
    foreach ($r['sections'] as $n => $sec) {
      $id = 's' . ($n + 1);
      // A world can give every section a default label (Rome: History); a section can override it.
      $badge = '';
      if (!empty($D['defaultTag'])) { [$cls, $txt] = SECTION_TAGS[$D['defaultTag']]; $badge = '<span class="badge ' . $cls . '">' . $txt . '</span> '; }
      foreach (array_slice($sec, 1) as $part) {
        if (isset($part['tag'])) { [$cls, $txt] = SECTION_TAGS[$part['tag']]; $badge = '<span class="badge ' . $cls . '">' . $txt . '</span> '; }
      }
      $toc .= '<li><a href="#' . $id . '">' . h($sec[0]) . '</a></li>';
      $body .= '<section class="read" aria-labelledby="' . $id . '"><h2 id="' . $id . '">' . $badge . h($sec[0]) . '</h2>';
      foreach (array_slice($sec, 1) as $part) {
        if (isset($part['tag'])) continue;
        if (isset($part['list'])) {
          $body .= '<ul class="read-list">';
          foreach ($part['list'] as $li) $body .= '<li>' . h($li) . '</li>';
          $body .= '</ul>';
        } else {
          foreach ($part as $para) $body .= '<p>' . h($para) . '</p>';
        }
      }
      $body .= '</section>';
      if (isset($photos[$pi])) $body .= photo_figure($w, $photos[$pi++]);
    }
    $more = '';
    for (; $pi < count($photos); $pi++) $more .= photo_figure($w, $photos[$pi], 'photo-small');
    if ($more) $body .= '<div class="photo-grid">' . $more . '</div>';
    $toc .= '<li><a href="#artwork">In this artwork</a></li><li><a href="#think">Think about it</a></li><li><a href="#sources">Sources</a></li>';

    $look = '';
    foreach ($r['look'] as $l) $look .= '<li>' . h($l) . '</li>';
    $qs = '';
    foreach ($r['questions'] as $q) $qs .= '<li>' . h($q) . '</li>';
    $words = '';
    foreach ($r['words'] as $t => $d) $words .= '<div><dt>' . h($t) . '</dt><dd>' . h($d) . '</dd></div>';
    $srcs = '';
    foreach ($r['sources'] as $s) {
      if (!isset($D['sources'][$s])) { fwrite(STDERR, "unknown source $w/$slug: $s\n"); continue; }
      $srcs .= '<li>' . h($D['sources'][$s]) . '</li>';
    }
    $rel = '';
    foreach ($r['related'] as $s) {
      if (!isset($pages[$s])) { fwrite(STDERR, "unknown related page $w/$slug: $s\n"); continue; }
      $rel .= building_card($w, $s, '(min-width: 900px) 200px, 45vw');
    }
    $cross = '';
    foreach (cross_links($w, $slug) as [$ow, $os]) $cross .= str_replace('<span class="place-name">', '<span class="tag">' . h($WORLDS[$ow]['name']) . '</span><span class="place-name">', building_card($ow, $os, '(min-width: 900px) 200px, 45vw'));
    // Teacher guides that use this building page.
    global $TEACH;
    $guides = '';
    foreach ($TEACH as $gs => $g) if (in_array("$w/$slug", $g['links'])) $guides .= '<li><a href="/teachers/' . $gs . '/">' . h($g['h1']) . '</a> <span class="what">(' . h($g['kind']) . ', grades ' . h($g['grades']) . ')</span></li>';
    $guideBlock = $guides ? '<section class="read teach-box" aria-labelledby="teach-h"><h2 id="teach-h">Use it in class</h2><ul class="read-list">' . $guides . '</ul></section>' : '';
    $crossBlock = $cross ? '<h2 id="cross-h">The same idea in other worlds</h2><ul class="places places-3">' . $cross . '</ul>' : '';
    $prev = $slugs[($k - 1 + count($slugs)) % count($slugs)];
    $next = $slugs[($k + 1) % count($slugs)];
    $hero = img($w, $slug, "Illustration of the " . strtolower($r['name']) . " ($label)", '(min-width: 900px) 480px, 90vw', 'fetchpriority="high"');
    $heroFull = "/assets/artwork/$w/" . artwork_name($r['src']) . '.webp';
    $nameH = h($r['name']);
    $aka = '';
    if (!empty($r['latin'])) {
      $lang = empty($D['akaLang']) ? '' : ' lang="' . $D['akaLang'] . '"';
      $aka = '<p class="latin">' . h($D['aka']) . ': <i' . $lang . '>' . h($r['latin']) . '</i></p>';
    }
    $summaryH = h($r['summary']);
    $artH = h($r['art']);
    // Vehicles have a second illustration: the back view.
    $rear = '';
    if (!empty($r['vehicle'])) {
      $rearFull = "/assets/artwork/$w/" . artwork_name($r['src']) . '-back.webp';
      $rear = '<figure class="rear-view"><button type="button" class="lb" data-full="' . $rearFull . '" data-title="' . h($r['name']) . ' (back view)" data-credit="Illustration: The Atlas of Cities, free to use under CC BY 4.0" data-download="' . "$w-$slug-back.webp" . '" aria-label="View the back view full size">'
        . img($w, "rear-$slug", 'Back view of the ' . strtolower($r['name']) . " ($label)", '(min-width: 900px) 260px, 60vw', 'loading="lazy"') . '</button><figcaption>Back view</figcaption></figure>';
    }
    $catH = h($catLabel);
    $prevName = h($pages[$prev]['name']);
    $nextName = h($pages[$next]['name']);
    $srcIntro = h($D['sourcesIntro']);
    $images = [url($heroFull)];
    foreach ($photos as $p) $images[] = url("/assets/photos/$w/{$p['img']}-1600.webp");
    page("/worlds/$w/$slug/", [
      'title' => sprintf($D['pageTitle'], $r['name']),
      'desc' => h($r['summary'] . $D['pageDesc']),
      'og' => $w,
      'class' => "world world-$w building",
      'lightbox' => true,
      'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/worlds/{$w}/">{$label}</a></li><li><a href="/worlds/{$w}/#{$r['cat']}">{$catH}</a></li><li aria-current="page">{$nameH}</li></ol></nav>
</div>
<section class="wrap b-hero">
  <div class="b-art"><button type="button" class="lb" data-full="{$heroFull}" data-title="{$nameH} (illustration)" data-credit="Illustration: The Atlas of Cities, free to use under CC BY 4.0" data-download="{$w}-{$slug}.webp" aria-label="View the illustration full size">{$hero}</button></div>
  <div class="b-intro">
    <p class="tag">{$label} · {$catH}</p>
    <h1>{$nameH}</h1>
    {$aka}
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
      {$rear}
      <h3>Look closer</h3>
      <ul class="read-list">{$look}</ul>
    </section>
    <section class="read" id="think" aria-labelledby="think-h">
      <h2 id="think-h">Think about it</h2>
      <ol class="questions">{$qs}</ol>
      <h3>Key words</h3>
      <dl class="words">{$words}</dl>
    </section>
    {$guideBlock}
    <section class="read sources-box" id="sources" aria-labelledby="src-h">
      <h2 id="src-h">Sources</h2>
      <p>{$srcIntro}</p>
      <ul class="sources">{$srcs}</ul>
    </section>
  </article>
</div>

<section class="wrap section" aria-labelledby="rel-h">
  <h2 id="rel-h">Related buildings</h2>
  <ul class="places places-3">{$rel}</ul>
  {$crossBlock}
  <nav class="pager" aria-label="More buildings">
    <a href="/worlds/{$w}/{$prev}/" rel="prev"><span>Previous</span> {$prevName}</a>
    <a href="/worlds/{$w}/" class="pager-all">All buildings</a>
    <a href="/worlds/{$w}/{$next}/" rel="next"><span>Next</span> {$nextName}</a>
  </nav>
</section>
HTML,
      'ld' => [
        crumbs([['Home', '/'], [$label, "/worlds/$w/"], [$r['name'], "/worlds/$w/$slug/"]]),
        ['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => sprintf($D['pageTitle'], $r['name']), 'description' => $r['summary'],
          'image' => $images, 'inLanguage' => 'en', 'dateModified' => LASTMOD, 'url' => url("/worlds/$w/$slug/"),
          'about' => ['@type' => 'Thing', 'name' => $r['name']],
          'author' => ['@type' => 'Organization', 'name' => SITE_NAME], 'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'logo' => ['@type' => 'ImageObject', 'url' => url('/assets/brand/atlas-logo-512.png')]],
          'isAccessibleForFree' => true, 'educationalUse' => 'Reading, discussion'],
      ],
    ]);
  }
}

// People of each world: /worlds/{world}/people/ (content in build/people.php).
function people_page($w) {
  global $WORLDS, $WORLD_DATA, $PEOPLE, $PEOPLE_INTRO;
  [$title, $intro, $tag] = $PEOPLE_INTRO[$w];
  $label = $WORLDS[$w]['name'];
  [$bcls, $btxt] = SECTION_TAGS[$tag];
  $cards = '';
  foreach ($PEOPLE[$w] as $file => [$name, $role, $text, $places]) {
    $links = [];
    foreach ($places as $p) {
      if (!isset($WORLD_DATA[$w]['pages'][$p])) { fwrite(STDERR, "unknown people link $w/$file: $p\n"); continue; }
      $links[] = '<a href="/worlds/' . $w . '/' . $p . '/">' . h($WORLD_DATA[$w]['pages'][$p]['name']) . '</a>';
    }
    $full = "/assets/artwork/$w/$file.webp";
    $cards .= '<li class="person world-' . $w . '" id="' . $file . '"><button type="button" class="lb person-art" data-full="' . $full . '" data-title="' . h("$label: $name") . '" data-credit="Illustration: The Atlas of Cities, free to use under CC BY 4.0" data-download="atlas-of-cities-' . "$w-$file" . '.webp" aria-label="View full size: ' . h($name) . '">'
      . img($w, $file, $name, '(min-width: 900px) 200px, 40vw', 'loading="lazy"') . '</button>'
      . '<div class="person-text"><h2>' . h($name) . '</h2><p class="tag">' . h($role) . '</p><p>' . h($text) . '</p>'
      . '<p class="person-where"><strong>Where to find them:</strong> ' . implode(', ', $links) . '</p></div></li>';
  }
  $others = '';
  foreach (WORLD_ORDER as $o) if ($o !== $w) $others .= '<li><a class="world-link world-' . $o . '" href="/worlds/' . $o . '/people/">' . h($WORLDS[$o]['short']) . ' people</a></li>';
  $titleH = h($title); $introH = h($intro);
  page("/worlds/$w/people/", [
    'title' => $title . ': who lives in the city',
    'desc' => h($intro),
    'og' => $w,
    'class' => "world world-$w people-page",
    'lightbox' => true,
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/worlds/{$w}/">{$label}</a></li><li aria-current="page">People</li></ol></nav>
</div>
<section class="wrap section page-head">
  <p class="tag">{$label} · People</p>
  <h1>{$titleH}</h1>
  <p class="lead"><span class="badge {$bcls}">{$btxt}</span> {$introH}</p>
  <ul class="people">{$cards}</ul>
</section>
<section class="wrap section next" aria-labelledby="next-h">
  <h2 id="next-h">Keep exploring</h2>
  <p><a class="btn" href="/worlds/{$w}/">Back to the {$label} map</a> <a class="btn btn-quiet" href="/tours/">Take a guided tour</a></p>
  <ul class="world-links">{$others}</ul>
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], [$label, "/worlds/$w/"], ['People', "/worlds/$w/people/"]])],
  ]);
}

foreach (WORLD_ORDER as $w) { full_world($w); people_page($w); }
