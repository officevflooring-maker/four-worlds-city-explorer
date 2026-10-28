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

// Hero: one isometric city made of all four worlds, a 2 x 2 quarter each, built with the same map CSS
// as the world pages. Modern sits at the back (its towers make a skyline); people and vehicles stand
// on the two front edges, where no building hides them.
$quarters = [
  // world => [i offset, j offset, four buildings in order (0,0) (1,0) (0,1) (1,1)]
  'modern' => [0, 0, ['skyscraper', 'residential-tower', 'public-library', 'park-pond']],
  'roman'  => [2, 0, ['pantheon', 'amphitheater', 'triumphal-arch', 'public-fountain']],
  'elven'  => [0, 2, ['great-tree-hall', 'treetop-village', 'mushroom-cottage', 'flower-meadow']],
  'future' => [2, 2, ['spaceport', 'power-tower', 'greenhouse-dome', 'habitat-cluster']],
];
$heroGround = '';
$heroTiles = '';
foreach ($quarters as $w => [$io, $jo, $slugs]) {
  $heroGround .= '<span class="hq world-' . $w . '" style="--tex:url(' . tex($w, $WORLDS[$w]['ground']) . ');--roadtex:url(' . tex($w, 'ground-crossroads') . ');left:' . ($io * 25) . '%;top:' . ($jo * 25) . '%"></span>';
  foreach ($slugs as $k => $s) {
    $i = $io + $k % 2; $j = $jo + intdiv($k, 2);
    if (!isset($WORLD_DATA[$w]['pages'][$s])) { fwrite(STDERR, "home hero: unknown page $w/$s\n"); continue; }
    $name = $WORLD_DATA[$w]['pages'][$s]['name'];
    $heroTiles .= '<li class="tile" style="--i:' . $i . ';--j:' . $j . '"><a class="tile-btn" href="/worlds/' . $w . '/' . $s . '/">'
      . img($w, $s, '', '(min-width: 900px) 170px, 22vw', ($w === 'roman' && $k === 0 ? 'fetchpriority="high" ' : '') . 'draggable="false"')
      . '<span class="tile-label">' . h($name . ' · ' . $WORLDS[$w]['short']) . '</span></a></li>';
  }
}
// Street life on the front edges: [world, image, page link, u, v]. Whole numbers are street lines.
foreach ([
  ['roman', 'chariot', 'chariot', 4.12, .75], ['roman', 'people-6', 'people/#people-6', 4.12, 1.55],
  ['future', 'rear-hover-car', 'hover-car', 4.12, 2.75], ['future', 'people-2', 'people/#people-2', 4.12, 3.55],
  ['elven', 'people-5', 'people/#people-5', .5, 4.12], ['elven', 'people-1', 'people/#people-1', 1.3, 4.12],
  ['future', 'people-5', 'people/#people-5', 2.6, 4.12], ['future', 'people-6', 'people/#people-6', 3.4, 4.12],
] as [$w, $f, $link, $u, $v]) {
  $car = !str_starts_with($f, 'people');
  $heroTiles .= '<li class="tile decor ' . ($car ? 'decor-car' : 'decor-person') . '" style="--u:' . $u . ';--v:' . $v . ';--z:20"><a class="tile-btn" href="/worlds/' . $w . '/' . $link . ($car ? '/' : '') . '" aria-label="' . h($WORLDS[$w]['name'] . ($car ? ' vehicle' : ' person')) . '">'
    . img($w, $f, '', $car ? '120px' : '64px', 'draggable="false"') . '</a></li>';
}
$heroLegend = '';
foreach (WORLD_ORDER as $w) $heroLegend .= '<li><a class="world-link world-' . $w . '" href="/worlds/' . $w . '/">' . h($WORLDS[$w]['name']) . '</a></li>';
$parade = [['roman', 'chariot', 'About 2,000 years ago'], ['modern', 'taxi', 'Today'], ['elven', 'flower-cart', 'Imagined'], ['future', 'hover-car', 'Possible future']];

// World cards: horizon, signature building, a person, and three places to start.
$starts = [
  'roman'  => ['aqueduct', 'amphitheater', 'public-baths'],
  'modern' => ['water-system', 'public-library', 'streets-crosswalks'],
  'elven'  => ['great-tree-hall', 'flower-meadow', 'tree-library'],
  'future' => ['water-recycler', 'oxygen-factory', 'pressurized-rover'],
];
$oneLine = [
  'roman'  => 'The real city, about 2,000 years ago, with photos of what survives.',
  'modern' => 'A town like yours: why each building is there and who it serves.',
  'elven'  => 'A forest city, and the real nature technology behind each idea.',
  'future' => 'How people could live, work and stay alive on the Moon and Mars.',
];
$cards = '';
foreach (WORLD_ORDER as $w) {
  $W = $WORLDS[$w];
  $links = '';
  foreach ($starts[$w] as $s) $links .= '<li><a href="/worlds/' . $w . '/' . $s . '/">' . h($WORLD_DATA[$w]['pages'][$s]['name']) . '</a></li>';
  $count = count($WORLD_DATA[$w]['pages']);
  $cards .= '<li class="wcard world-' . $w . '" data-world="' . $w . '">'
    . '<a class="wcard-top" href="/worlds/' . $w . '/" tabindex="-1" aria-hidden="true"><span class="wcard-ground"><span class="wcard-floor" style="--tex:url(' . tex($w, $W['ground']) . ')"></span></span><span class="wcard-sky">' . img($w, 'horizon', '', '(min-width: 900px) 300px, 90vw', 'loading="lazy"') . '</span>'
    . '<span class="wcard-art">' . img($w, $W['card'], '', '(min-width: 900px) 240px, 70vw', 'loading="lazy"') . '</span>'
    . '<span class="wcard-person">' . img($w, 'people-1', '', '80px', 'loading="lazy"') . '</span></a>'
    . '<div class="wcard-text"><p class="tag">' . h($W['type']) . '</p><h3><a href="/worlds/' . $w . '/">' . h($W['name']) . '</a></h3>'
    . '<p class="what">' . h($oneLine[$w]) . '</p><ul class="wcard-links">' . $links . '</ul>'
    . '<p class="wcard-go"><a href="/worlds/' . $w . '/">Explore all ' . $count . ' pages <span aria-hidden="true">&rarr;</span></a></p></div></li>';
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
  'title' => SITE_NAME . ': how cities work, past, present and imagined',
  'desc' => h(SITE_DESC),
  'class' => 'home',
  'body' => <<<HTML
<section class="hero3">
  <div class="wrap hero3-inner">
    <div class="hero3-text">
      <p class="eyebrow">Ancient Rome · Today · Imagined · Possible future</p>
      <h1>How does a city <span>work?</span></h1>
      <p class="lead">Explore four illustrated cities, from ancient Rome to a settlement on Mars. Open any building, meet the people and compare how each world solves the same problems.</p>
      <p class="hero-actions"><a class="btn" href="#worlds">Choose a world</a> <a class="btn btn-quiet" href="/tours/">Take a guided tour</a></p>
      <p class="hero-free">Free for everyone. No sign-up, ads or tracking.</p>
    </div>
    <div class="hero3-map">
      <div class="city hero-city" style="--n:4;--y0:9">
        <div class="city-ground hero-ground" aria-hidden="true">{$heroGround}</div>
        <ul class="city-tiles" aria-label="A city made of all four worlds">{$heroTiles}</ul>
      </div>
      <ul class="world-links hero-legend">{$heroLegend}</ul>
    </div>
  </div>
</section>

<section class="stats" aria-label="What is on this site">
  <ul class="wrap stats-list">{$statsH}</ul>
</section>

<section class="wrap section" id="worlds" aria-labelledby="worlds-h">
  <div class="sec-head"><h2 id="worlds-h">Choose a world</h2><p>Rome is real history. The other three are imagined settings built around real ideas, and every page shows which is which.</p></div>
  <ul class="wcards">{$cards}</ul>
</section>

<section class="band band-play" aria-labelledby="play-h">
  <div class="wrap">
    <div class="sec-head"><h2 id="play-h">Play and create</h2><p>Build your own city, take the quiz and collect a stamp for every place you visit.</p></div>
    <ul class="play-cards">{$playCards}</ul>
  </div>
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

<section class="band band-dark" aria-labelledby="tours-h">
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
    <p>All {$artCount} illustrations of buildings, people and vehicles are free to save, print and reuse for any purpose under CC BY 4.0. Just credit "Illustration: The Atlas of Cities".</p>
    <p><a class="btn" href="/artwork/">Browse the artwork</a> <a class="btn btn-quiet" href="/about/">About this project</a></p>
  </div>
</section>

<section class="band support-band" aria-labelledby="sup-h">
  <div class="wrap support-inner">
    <div><h2 id="sup-h">Free for everyone, with no ads</h2><p>If the site helps your class or family, you can help it grow.</p></div>
    <p><a class="btn" href="/support/">Support this project</a></p>
  </div>
</section>
HTML,
  'ld' => [[
    '@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => SITE_NAME, 'url' => url('/'),
    'description' => SITE_DESC, 'inLanguage' => 'en',
    'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => url('/'), 'logo' => url('/apple-touch-icon.png')],
  ]],
]);
