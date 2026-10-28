<?php
// Home page. Included from build.php after the world, teacher and tour pages, so it can use their data.

// Numbers for the stats band.
$pageCount = 0;
foreach ($WORLD_DATA as $D) $pageCount += count($D['pages']);
$artCount = count(glob(PUB . '/assets/artwork/*/*-thumb.webp'));
$photoCount = count(glob(PUB . '/assets/photos/*/*-800.webp'));
$peopleCount = array_sum(array_map('count', $PEOPLE));
$stats = [
  [4, 'illustrated worlds'], [$pageCount, 'building and vehicle pages'], [$peopleCount, 'people to meet'],
  [count($TOURS), 'guided tours'], [count($TEACH), 'free teacher guides'], [$artCount, 'free illustrations'], [$photoCount, 'photos of real places'],
];
$statsH = '';
foreach ($stats as [$n, $l]) $statsH .= '<li><strong>' . $n . '</strong> <span>' . h($l) . '</span></li>';

// Hero: a landmark from each world, a person standing in front of it, and a road of vehicles through time.
$heroPick = [['roman', 'pantheon', 'people-2'], ['modern', 'public-library', 'people-3'], ['elven', 'treetop-village', 'people-5'], ['future', 'greenhouse-dome', 'people-2']];
$hero = '';
foreach ($heroPick as $i => [$w, $n, $p]) {
  $hero .= '<a class="hero-piece hero-' . $w . ' world-' . $w . '" href="/worlds/' . $w . '/"><span class="hero-building">' . img($w, $n, '', '(min-width: 900px) 280px, 42vw', $i ? '' : 'fetchpriority="high"') . '</span>'
    . '<span class="hero-person">' . img($w, $p, '', '80px') . '</span><span class="hero-tag">' . h($WORLDS[$w]['name']) . '</span></a>';
}
$parade = [['roman', 'chariot', 'About 2,000 years ago'], ['modern', 'taxi', 'Today'], ['elven', 'flower-cart', 'Imagined'], ['future', 'hover-car', 'Possible future']];

// World cards: horizon, signature building, a person, and three places to start.
$starts = [
  'roman'  => ['aqueduct', 'amphitheater', 'public-baths'],
  'modern' => ['water-system', 'public-library', 'streets-crosswalks'],
  'elven'  => ['great-tree-hall', 'flower-meadow', 'tree-library'],
  'future' => ['water-recycler', 'oxygen-factory', 'pressurized-rover'],
];
$cards = '';
foreach (WORLD_ORDER as $w) {
  $W = $WORLDS[$w];
  $links = '';
  foreach ($starts[$w] as $s) $links .= '<li><a href="/worlds/' . $w . '/' . $s . '/">' . h($WORLD_DATA[$w]['pages'][$s]['name']) . '</a></li>';
  $count = count($WORLD_DATA[$w]['pages']);
  $cards .= '<li class="wcard world-' . $w . '">'
    . '<a class="wcard-top" href="/worlds/' . $w . '/" aria-label="' . h('Explore ' . $W['name']) . '"><span class="wcard-sky">' . img($w, 'horizon', '', '(min-width: 900px) 300px, 90vw', 'loading="lazy"') . '</span>'
    . '<span class="wcard-art">' . img($w, $W['card'], '', '(min-width: 900px) 220px, 60vw', 'loading="lazy"') . '</span>'
    . '<span class="wcard-person">' . img($w, 'people-1', '', '70px', 'loading="lazy"') . '</span></a>'
    . '<div class="wcard-text"><p class="tag">' . h($W['type']) . '</p><h3><a href="/worlds/' . $w . '/">' . h($W['name']) . '</a></h3>'
    . '<p class="what">' . h($W['lead']) . '</p><p class="wcard-start">Start with:</p><ul class="wcard-links">' . $links . '</ul>'
    . '<p class="wcard-go"><a class="btn" href="/worlds/' . $w . '/">Explore ' . $count . ' pages</a></p></div></li>';
}

// Vehicles through time.
$road = '';
foreach ($parade as [$w, $v, $era]) {
  $road .= '<li class="world-' . $w . '"><a href="/worlds/' . $w . '/' . $v . '/"><span class="era">' . h($era) . '</span>'
    . img($w, $v, '', '(min-width: 900px) 240px, 40vw', 'loading="lazy"') . '<span class="veh-name">' . h($WORLD_DATA[$w]['pages'][$v]['name']) . '</span><span class="what">' . h($WORLDS[$w]['name']) . '</span></a></li>';
}

// People strip: two from each world.
$crowd = '';
foreach ([['roman', 'people-1'], ['roman', 'people-6'], ['modern', 'people-5'], ['modern', 'worker-1'], ['elven', 'people-1'], ['elven', 'people-4'], ['future', 'people-5'], ['future', 'people-6']] as [$w, $f]) {
  $crowd .= '<li class="world-' . $w . '"><a href="/worlds/' . $w . '/people/#' . $f . '">' . img($w, $f, '', '(min-width: 900px) 140px, 22vw', 'loading="lazy"')
    . '<span class="p-name">' . h($PEOPLE[$w][$f][0]) . '</span><span class="what">' . h($WORLDS[$w]['short']) . '</span></a></li>';
}

// Compare teaser: water in four worlds.
$water = '';
foreach ($COMPARE[0][3] as $w => [$imgName, $name]) {
  $water .= '<li class="world-' . $w . '"><span class="cmp-mini">' . img($w, $imgName, '', '(min-width: 900px) 200px, 40vw', 'loading="lazy"') . '</span><span class="p-name">' . h($name) . '</span><span class="what">' . h($WORLDS[$w]['short']) . '</span></li>';
}

$tourCards = '';
foreach (array_keys($TOURS) as $slug) $tourCards .= tour_card($slug);

$teachPick = '';
foreach (['design-a-city-project', 'build-a-roman-aqueduct', 'design-a-mars-colony-project'] as $s) $teachPick .= teach_card($s);

// Artwork mosaic: a few favorites from every world.
$mosaic = '';
foreach ([['roman', 'fitness-3'], ['elven', 'shared-2'], ['future', 'growth-1'], ['modern', 'business-3'], ['roman', 'vehicle-car-2'], ['elven', 'knowledge-1'], ['future', 'town-3'], ['modern', 'vehicle-car-2'], ['roman', 'family-3'], ['elven', 'vehicle-car-3'], ['future', 'vehicle-car-4'], ['modern', 'knowledge-3']] as [$w, $n]) {
  $f = "/assets/artwork/$w/$n-thumb.webp";
  if (!is_file(PUB . $f)) { fwrite(STDERR, "home mosaic missing $f\n"); continue; }
  $mosaic .= '<li class="world-' . $w . '"><img src="' . $f . '" width="480" height="480" alt="" loading="lazy" decoding="async"></li>';
}

page('/', [
  'title' => SITE_NAME . ': how cities work, in four illustrated worlds',
  'desc' => h(SITE_DESC),
  'class' => 'home',
  'body' => <<<HTML
<section class="hero2">
  <div class="wrap hero2-inner">
    <div class="hero2-text">
      <p class="eyebrow">Ancient Rome · Today · Imagined · Possible future</p>
      <h1>How does a city <span>work?</span></h1>
      <p class="lead">Walk through four illustrated cities, from ancient Rome to a settlement on Mars. Open any building to see what it does, meet the people who use it, and compare how each world solves the same problems.</p>
      <p class="hero-actions"><a class="btn" href="#worlds">Choose a world</a> <a class="btn btn-quiet" href="/tours/">Take a guided tour</a></p>
      <p class="hero-free">Free. No sign-up, ads or tracking.</p>
    </div>
    <div class="hero2-art">{$hero}</div>
  </div>
</section>

<section class="stats" aria-label="What is on this site">
  <ul class="wrap stats-list">{$statsH}</ul>
</section>

<section class="wrap section" id="worlds" aria-labelledby="worlds-h">
  <div class="sec-head"><h2 id="worlds-h">Choose a world</h2><p>Rome is real history. The other three are imagined settings built around real ideas, and every page shows which is which.</p></div>
  <ul class="wcards">{$cards}</ul>
</section>

<section class="band band-road" aria-labelledby="road-h">
  <div class="wrap">
    <div class="sec-head"><h2 id="road-h">Getting around, through time</h2><p>Every city needs to move people and goods. Follow the road from Roman chariots to floating cars.</p></div>
    <ol class="road">{$road}</ol>
    <p><a class="btn btn-quiet" href="/compare/#goods">Compare how goods are moved</a></p>
  </div>
</section>

<section class="wrap section" aria-labelledby="people-h">
  <div class="sec-head"><h2 id="people-h">Meet the people</h2><p>Senators and soldiers, runners and dog walkers, elf gardeners and Mars engineers. Find out who uses each city, and how.</p></div>
  <ul class="crowd">{$crowd}</ul>
  <ul class="world-links"><li><a class="world-link world-roman" href="/worlds/roman/people/">Roman people</a></li><li><a class="world-link world-modern" href="/worlds/modern/people/">Modern people</a></li><li><a class="world-link world-elven" href="/worlds/elven/people/">Elven people</a></li><li><a class="world-link world-future" href="/worlds/future/people/">Future people</a></li></ul>
</section>

<section class="band" aria-labelledby="tours-h">
  <div class="wrap">
    <div class="sec-head"><h2 id="tours-h">Take a guided tour</h2><p>Short walks led by someone who lives there, with a question at every stop.</p></div>
    <ul class="tour-grid">{$tourCards}</ul>
  </div>
</section>

<section class="wrap section split" aria-labelledby="cmp-h">
  <div>
    <h2 id="cmp-h">One question, four answers</h2>
    <p class="big-q">Where does clean water come from?</p>
    <p>See how each world handles water, gathering places, safe travel, deliveries and nature, then decide which ideas would work where you live.</p>
    <p><a class="btn" href="/compare/">Compare the worlds</a></p>
  </div>
  <ul class="water4">{$water}</ul>
</section>

<section class="band band-teach" aria-labelledby="teach-h">
  <div class="wrap">
    <div class="sec-head"><h2 id="teach-h">For teachers and families</h2><p>Free lessons, projects and explainers with grade levels, timings, printable pages and sources.</p></div>
    <ul class="guide-grid">{$teachPick}</ul>
    <p><a class="btn" href="/teachers/">All {$teachCount} teacher guides</a></p>
  </div>
</section>

<section class="wrap section split" aria-labelledby="art-h">
  <ul class="mosaic" aria-hidden="true">{$mosaic}</ul>
  <div>
    <h2 id="art-h">Free artwork for everyone</h2>
    <p>All {$artCount} illustrations of buildings, people and vehicles are free to save, print and reuse for any purpose under CC BY 4.0. Just credit "Illustration: Four Worlds City Explorer".</p>
    <p><a class="btn" href="/artwork/">Browse the artwork</a> <a class="btn btn-quiet" href="/about/">About this project</a></p>
  </div>
</section>
HTML,
  'ld' => [[
    '@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => SITE_NAME, 'url' => url('/'),
    'description' => SITE_DESC, 'inLanguage' => 'en',
    'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => url('/'), 'logo' => url('/apple-touch-icon.png')],
  ]],
]);
