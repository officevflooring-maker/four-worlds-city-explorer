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

// Badges that mark a section as real-world fact, imagined, speculative, or from the Bible. A Gospel section
// tells one part of the story of Jesus (Heavenly City), and its badge shows the part's number instead.
const SECTION_TAGS = [
  'real'        => ['badge-fact', 'Real world'],
  'imagined'    => ['badge-art', 'Imagined'],
  'speculative' => ['badge-spec', 'Possible future'],
  'history'     => ['badge-fact', 'History'],
  'gospel'      => ['badge-belief', 'Gospel'],
  'bible'       => ['badge-belief', 'Bible'],
];

// A world that tells one story across its pages (Heavenly City): each page has 'part' => [number, title].
// Links to the previous and next parts, shown after the page's Gospel section.
function story_pager($w, $slug, $pages) {
  $slugs = array_keys($pages);
  $k = array_search($slug, $slugs);
  $link = function ($s, $rel) use ($w, $pages) {
    if ($s === null) return '<span></span>';
    return '<a href="/worlds/' . $w . '/' . $s . '/" rel="' . $rel . '"><span>Part ' . $pages[$s]['part'][0] . ' · ' . h($pages[$s]['name']) . '</span> ' . h($pages[$s]['part'][1]) . '</a>';
  };
  return '<nav class="pager story-pager" aria-label="' . h($GLOBALS['WORLD_DATA'][$w]['story']['title']) . '">' . $link($slugs[$k - 1] ?? null, 'prev')
    . '<a href="/worlds/' . $w . '/story/" class="pager-all">The whole story</a>' . $link($slugs[$k + 1] ?? null, 'next') . '</nav>';
}

// The story's contents page, /worlds/{world}/story/: every part in order, chapter by chapter.
function story_page($w, $pages) {
  global $WORLDS, $WORLD_DATA;
  $D = $WORLD_DATA[$w];
  $S = $D['story'];
  $label = $WORLDS[$w]['name'];
  $chapters = '';
  $list = [];
  foreach ($D['cats'] as $cat => [$clabel, $blurb]) {
    $cards = '';
    foreach ($pages as $slug => $r) {
      if ($r['cat'] !== $cat) continue;
      [$n, $title] = $r['part'];
      $list[] = ['@type' => 'ListItem', 'position' => $n, 'name' => "Part $n: $title", 'url' => url("/worlds/$w/$slug/")];
      $cards .= '<li class="place place-link world-' . $w . '" data-pp="' . "$w/$slug" . '"><a href="/worlds/' . $w . '/' . $slug . '/">'
        . '<span class="place-art">' . img($w, $slug, '', '96px', 'loading="lazy"') . '</span>'
        . '<span class="tag">Part ' . $n . ' · ' . h($r['name']) . '</span><span class="place-name">' . h($title) . '</span><span class="what">Read it: ' . h($r['latin']) . '</span></a></li>';
    }
    if ($cards !== '') $chapters .= '<section class="cat" aria-labelledby="ch-' . $cat . '"><h2 id="ch-' . $cat . '">' . h($clabel) . '</h2><p class="what">' . h($blurb) . '</p><ol class="places places-3">' . $cards . '</ol></section>';
  }
  $first = array_key_first($pages);
  $titleH = h($S['title']);
  $introH = h($S['intro']);
  $noteH = h($S['note']);
  $count = count($pages);
  page("/worlds/$w/story/", [
    'title' => $S['pageTitle'],
    'desc' => h($S['desc']),
    'og' => $w,
    'class' => "world world-$w story-page",
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/worlds/{$w}/">{$label}</a></li><li aria-current="page">{$titleH}</li></ol></nav>
</div>
<section class="wrap section page-head">
  <p class="tag">{$label} · {$count} parts</p>
  <h1>{$titleH}</h1>
  <p class="lead">{$introH}</p>
  <p><a class="btn" href="/worlds/{$w}/{$first}/">Start with part 1</a> <a class="btn btn-quiet" href="/worlds/{$w}/">See the city map</a></p>
  {$chapters}
  <p class="setting-note">{$noteH}</p>
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], [$label, "/worlds/$w/"], [$S['title'], "/worlds/$w/story/"]]),
      ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => $S['title'], 'numberOfItems' => $count, 'itemListElement' => $list]],
  ]);
}

// A world's guided tour (build/tours.php): [slug, tour], or [null, null].
function world_tour($w) {
  global $TOURS;
  foreach ($TOURS ?? [] as $slug => $t) if ($t['world'] === $w) return [$slug, $t];
  return [null, null];
}
// Whole sentences from the start of $text, as many as fit in a search result (about 160 characters).
function fit_desc($text, $max = 160) {
  $out = '';
  foreach (preg_split('/(?<=[.?!])\s+/', $text) as $s) {
    if (strlen(trim("$out $s")) > $max) break;
    $out = trim("$out $s");
  }
  return $out !== '' ? $out : $text;
}

// Where a person or vehicle stands on a map, and how big it is drawn (see .decor in site.css).
function decor_at($u, $v) { return '--u:' . $u . ';--v:' . $v . ';--z:' . floor($u + $v); }
function vehicle_fit($w, $slug, $side) {
  [$width, $front, $back] = VEHICLE_FIT["$w/$slug"] ?? [6, 1, 1];
  return ';--w:' . $width . ';--b:' . ($side ? $back : $front);
}
function person_fit($w) { return isset(PEOPLE_SCALE[$w]) ? ';--sc:' . PEOPLE_SCALE[$w] : ''; }

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
  // A world that tells a story lists its pages, and pages through them, in story order.
  $story = $D['story'] ?? null;
  if ($story) uasort($pages, fn($a, $b) => $a['part'][0] <=> $b['part'][0]);
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
  // Street life on the two front edges, where no building hides it. Points are grid units (u along i, v along j);
  // whole numbers are street lines. Every vehicle picture heads along u, so the vehicles drive along the left
  // front street (v = 6): front views come toward you in the near lane, back views drive away in the far lane.
  global $VEHICLES, $PEOPLE;
  $decor = '';
  $carSpots = [[1.15, 6.14, ''], [2.65, 6.02, 'rear-'], [4.1, 6.14, ''], [5.5, 6.02, 'rear-']];
  foreach (array_keys($VEHICLES[$w] ?? []) as $k => $vslug) {
    [$u, $v, $side] = $carSpots[$k];
    $decor .= '<li class="tile decor decor-car" style="' . decor_at($u, $v) . vehicle_fit($w, $vslug, $side) . '"' . $tileData($vslug) . '><a class="tile-btn" href="/worlds/' . $w . '/' . $vslug . '/">'
      . img($w, $side . $vslug, '', '90px', 'draggable="false" loading="lazy"') . '<span class="tile-label">' . h($pages[$vslug]['name']) . '</span></a></li>';
  }
  // People: three on the sidewalk between the vehicles, the rest along the right front street.
  $personSpots = [[.45, 6.2], [1.95, 6.2], [3.4, 6.2], [6.2, 5.55], [6.2, 4.45], [6.2, 3.35], [6.2, 2.2], [6.2, 1.05]];
  foreach (array_keys($PEOPLE[$w] ?? []) as $k => $file) {
    [$u, $v] = $personSpots[$k];
    [$pname, $prole] = $PEOPLE[$w][$file];
    $decor .= '<li class="tile decor decor-person" style="' . decor_at($u, $v) . person_fit($w) . '" data-cat="people" data-name="' . h($pname) . '" data-catname="People" data-sum="' . h($prole) . '"><a class="tile-btn" href="/worlds/' . $w . '/people/#' . $file . '">'
      . img($w, $file, '', '64px', 'draggable="false" loading="lazy"') . '<span class="tile-label">' . h($pname) . '</span></a></li>';
  }
  $map .= $decor;
  // Filter buttons: one per building group shown on the map, plus people and vehicles.
  $onMap = [];
  foreach ($D['map'] as $slug) if ($slug !== 'tree') $onMap[$pages[$slug]['cat']] = true;
  $filters = '<button type="button" class="chip" data-filter="" aria-pressed="true">Everything</button>';
  foreach ($D['cats'] as $cat => [$clabel]) {
    if (isset($onMap[$cat]) || ($cat === 'vehicles' && in_array('vehicles', array_column($pages, 'cat')))) $filters .= '<button type="button" class="chip" data-filter="' . $cat . '" aria-pressed="false">' . h($clabel) . '</button>';
  }
  if (!empty($PEOPLE[$w])) $filters .= '<button type="button" class="chip" data-filter="people" aria-pressed="false">People</button>';
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
  // The world at a glance, and its guided tour.
  global $TOURS, $PEOPLE;
  [$tourSlug, $tour] = world_tour($w);
  $vehicleCount = count(array_filter($pages, fn($r) => !empty($r['vehicle'])));
  $photoCount = array_sum(array_map('count', $PHOTOS[$w] ?? []));
  $glance = '<li><strong>' . ($count - $vehicleCount) . '</strong> places</li><li><strong>' . $vehicleCount . '</strong> vehicles</li>' . (empty($PEOPLE[$w]) ? '' : '<li><strong>' . count($PEOPLE[$w]) . '</strong> people</li>')
    . ($photoCount ? '<li><strong>' . $photoCount . '</strong> photos of real places</li>' : '')
    . ($story ? '<li><a href="/worlds/' . $w . '/story/">' . h($story['title']) . ', in ' . $count . ' parts</a></li>' : '')
    . ($tour ? '<li><a href="/tours/' . $tourSlug . '/">Guided tour: ' . h($tour['h1']) . '</a></li>' : '');
  $storyStart = $story ? '<p class="lead">' . h($story['lead']) . '</p><p><a class="btn" href="/worlds/' . $w . '/' . array_key_first($pages) . '/">Start with part 1</a> <a class="btn btn-quiet" href="/worlds/' . $w . '/story/">See all ' . $count . ' parts</a></p>' : '';
  $peopleLink = empty($PEOPLE[$w]) ? '' : '<a href="/worlds/' . $w . '/people/">Meet the people</a> · ';
  $tourLink = $tour ? '<a href="/tours/' . $tourSlug . '/">Take the tour</a>' : '<a href="/tours/">Guided tours</a>';
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
    <ul class="glance" aria-label="{$label} at a glance">{$glance}</ul>
  </div>
</section>

<section class="map-section" id="hunt" aria-labelledby="map-h">
  <div class="wrap map-head">
    <div>
      <h2 id="map-h">Look around the city</h2>
      <p class="hint">Select any building, person or vehicle to open its page. Everything is also listed below.</p>
    </div>
    <p class="map-links">{$peopleLink}{$tourLink}</p>
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
  {$storyStart}
  <nav aria-label="Building groups"><ul class="jump">{$jump}</ul></nav>
  {$dir}
</section>

<section class="wrap section next" aria-labelledby="next-h">
  <h2 id="next-h">Keep exploring</h2>
  <p><a class="btn" href="/compare/">Compare all six worlds</a> <a class="btn btn-quiet" href="/artwork/#{$w}">See all {$label} artwork</a></p>
  <p class="play-line">Games with this world: <a href="#hunt">Map hunt</a> · <a href="/play/world-sort/">World sort</a> · <a href="/play/shadows/">Shadow match</a> · <a href="/play/puzzle/">Picture puzzle</a></p>
  <ul class="world-links">{$others}</ul>
</section>
HTML,
    'ld' => [
      crumbs([['Home', '/'], [$label, "/worlds/$w/"]]),
      learning($D['title'], $D['desc'], "/worlds/$w/", $D['about']),
      ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => "Buildings of the $label city", 'numberOfItems' => $count, 'itemListElement' => $itemList],
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
      $gospel = false;
      if (!empty($D['defaultTag'])) { [$cls, $txt] = SECTION_TAGS[$D['defaultTag']]; $badge = '<span class="badge ' . $cls . '">' . $txt . '</span> '; }
      foreach (array_slice($sec, 1) as $part) {
        if (!isset($part['tag'])) continue;
        [$cls, $txt] = SECTION_TAGS[$part['tag']];
        $gospel = $part['tag'] === 'gospel' && isset($r['part']);
        if ($gospel) $txt = 'Part ' . $r['part'][0] . ' of ' . count($pages);
        $badge = '<span class="badge ' . $cls . '">' . $txt . '</span> ';
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
      if ($gospel) $body .= story_pager($w, $slug, $pages);
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
    // The illustration is free to reuse, and says so to search engines (Google Images shows it as licensable).
    $images = [['@type' => 'ImageObject', 'contentUrl' => url($heroFull), 'license' => 'https://creativecommons.org/licenses/by/4.0/',
      'acquireLicensePage' => url('/artwork/'), 'creditText' => SITE_NAME, 'creator' => ['@type' => 'Organization', 'name' => SITE_NAME],
      'copyrightNotice' => 'Illustration: ' . SITE_NAME . ', CC BY 4.0']];
    foreach ($photos as $p) $images[] = url("/assets/photos/$w/{$p['img']}-1600.webp");
    // Search results show about 160 characters: the page's extra line goes on only where it fits, or a
    // shorter one.
    $desc = $r['summary'];
    // A long name gets the world's shorter title pattern, so the title fits in a search result.
    $pageTitle = sprintf($D['pageTitle'], $r['name']);
    if (strlen($pageTitle) > 60 && !empty($D['pageTitleShort'])) $pageTitle = sprintf($D['pageTitleShort'], $r['name']);
    foreach ([$D['pageDesc'], $D['pageDescShort'] ?? ''] as $more) {
      if ($more !== '' && strlen($r['summary'] . $more) <= 160) { $desc = $r['summary'] . $more; break; }
    }
    // On the world's map (or driving around it), so the page can point to it there.
    $onMap = in_array($slug, $D['map']) || !empty($r['vehicle']);
    $findH = $onMap ? '<a class="btn btn-quiet btn-sm" href="/worlds/' . $w . '/#find-' . $slug . '">Find it on the map</a> ' : '';
    page("/worlds/$w/$slug/", [
      'title' => $pageTitle,
      'desc' => h($desc),
      'og' => is_file(PUB . "/assets/og/$w/$slug.jpg") ? "$w/$slug" : $w,
      'ogType' => 'article',
      'ogAlt' => $r['name'] . ', ' . $label . ': an illustration from ' . SITE_NAME,
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
    <p class="b-tools">{$findH}<button type="button" class="btn btn-quiet btn-sm" data-listen hidden aria-pressed="false">Listen</button></p>
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
        ['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => $pageTitle, 'description' => $r['summary'],
          'image' => $images, 'inLanguage' => 'en', 'dateModified' => LASTMOD, 'url' => url("/worlds/$w/$slug/"), 'mainEntityOfPage' => url("/worlds/$w/$slug/"),
          'about' => ['@type' => 'Thing', 'name' => $r['name']], 'keywords' => implode(', ', array_merge([$r['name'], $label], array_keys($r['words']))),
          'isPartOf' => ['@type' => 'CollectionPage', 'name' => $D['title'], 'url' => url("/worlds/$w/")],
          'author' => ['@type' => 'Organization', 'name' => SITE_NAME], 'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'logo' => ['@type' => 'ImageObject', 'url' => url('/assets/brand/atlas-logo-512.png')]],
          'isAccessibleForFree' => true, 'educationalUse' => 'Reading, discussion'],
      ],
    ]);
  }
  if ($story) story_page($w, $pages);
}

// People of each world: /worlds/{world}/people/ (content in build/people.php).
function people_page($w) {
  global $WORLDS, $WORLD_DATA, $PEOPLE, $PEOPLE_INTRO;
  [$title, $intro, $tag] = $PEOPLE_INTRO[$w];
  $label = $WORLDS[$w]['name'];
  [$bcls, $btxt] = SECTION_TAGS[$tag];
  [$tourSlug, $tour] = world_tour($w);
  $cards = '';
  $list = [];
  foreach ($PEOPLE[$w] as $file => [$name, $role, $text, $places]) {
    $list[] = ['@type' => 'ListItem', 'position' => count($list) + 1, 'name' => $name, 'url' => url("/worlds/$w/people/#$file")];
    // Everyone walks on the world's map; one of them also leads its guided tour.
    $more = '<a href="/worlds/' . $w . '/#find-' . $file . '">Find them on the map</a>';
    if ($tour && $tour['guide'] === $file) $more .= ' · <a href="/tours/' . $tourSlug . '/">Join their tour: ' . h($tour['h1']) . '</a>';
    $links = [];
    foreach ($places as $p) {
      if (!isset($WORLD_DATA[$w]['pages'][$p])) { fwrite(STDERR, "unknown people link $w/$file: $p\n"); continue; }
      $links[] = '<a href="/worlds/' . $w . '/' . $p . '/">' . h($WORLD_DATA[$w]['pages'][$p]['name']) . '</a>';
    }
    $full = "/assets/artwork/$w/$file.webp";
    $cards .= '<li class="person world-' . $w . '" id="' . $file . '"><button type="button" class="lb person-art" data-full="' . $full . '" data-title="' . h("$label: $name") . '" data-credit="Illustration: The Atlas of Cities, free to use under CC BY 4.0" data-download="atlas-of-cities-' . "$w-$file" . '.webp" aria-label="View full size: ' . h($name) . '">'
      . img($w, $file, $name, '(min-width: 900px) 200px, 40vw', 'loading="lazy"') . '</button>'
      . '<div class="person-text"><h2>' . h($name) . '</h2><p class="tag">' . h($role) . '</p><p>' . h($text) . '</p>'
      . '<p class="person-where"><strong>Where to find them:</strong> ' . implode(', ', $links) . '</p><p class="person-more">' . $more . '</p></div></li>';
  }
  $tourBtn = $tour ? '<a class="btn btn-quiet" href="/tours/' . $tourSlug . '/">Take the tour: ' . h($tour['h1']) . '</a>' : '<a class="btn btn-quiet" href="/tours/">Take a guided tour</a>';
  $others = '';
  foreach (WORLD_ORDER as $o) if ($o !== $w && !empty($PEOPLE[$o])) $others .= '<li><a class="world-link world-' . $o . '" href="/worlds/' . $o . '/people/">' . h($WORLDS[$o]['short']) . ' people</a></li>';
  $titleH = h($title); $introH = h($intro);
  page("/worlds/$w/people/", [
    'title' => $title . ': who lives in the city',
    'desc' => h($PEOPLE_INTRO[$w][3] ?? fit_desc($intro)),
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
  <p><a class="btn" href="/worlds/{$w}/">Back to the {$label} map</a> {$tourBtn}</p>
  <ul class="world-links">{$others}</ul>
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], [$label, "/worlds/$w/"], ['People', "/worlds/$w/people/"]]),
      ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => $title, 'numberOfItems' => count($list), 'itemListElement' => $list]],
  ]);
}

