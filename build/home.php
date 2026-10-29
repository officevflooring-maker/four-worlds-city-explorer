<?php
// Home page. Included from build.php after the world, teacher and tour pages, so it can use their data.

// Numbers for the stats band.
$pageCount = 0;
foreach ($WORLD_DATA as $D) $pageCount += count($D['pages']);
$artCount = count(glob(PUB . '/assets/artwork/*/*-thumb.webp'));
$photoCount = count(glob(PUB . '/assets/photos/*/*-800.webp'));
$peopleCount = array_sum(array_map('count', $PEOPLE));
$stats = [
  [count(WORLD_ORDER), 'illustrated worlds'], [$pageCount, 'building and vehicle pages'], [$peopleCount, 'people to meet'],
  [count($TOURS), 'guided tours'], [count($TEACH), 'free teacher guides'], [$artCount, 'free illustrations'], [$photoCount, 'photos of real places'],
];
$statsH = '';
foreach ($stats as [$n, $l]) $statsH .= '<li><strong>' . $n . '</strong> <span>' . h($l) . '</span></li>';

// Hero: one isometric city made of all six worlds, built with the same map CSS as the world pages: a 6 x 6
// grid with a block of 2 x 3 squares for each world, four buildings at the back of the block and two of the
// world's trees in front. Modern and Egypt sit at the back (towers and the pyramid make a skyline); people and
// vehicles stand on the two front edges, where no building hides them.
$blocks = [
  // world => [i offset, j offset, four buildings in order (0,0) (1,0) (0,1) (1,1)]
  'modern' => [0, 0, ['skyscraper', 'residential-tower', 'public-library', 'park-pond']],
  'egypt'  => [2, 0, ['obelisk', 'pyramid', 'temple-gateway', 'sphinx']],
  'heaven' => [4, 0, ['bell-tower', 'palace-of-light', 'pearl-gate', 'tree-of-life']],
  'elven'  => [0, 3, ['great-tree-hall', 'treetop-village', 'mushroom-cottage', 'flower-meadow']],
  'roman'  => [2, 3, ['pantheon', 'amphitheater', 'triumphal-arch', 'public-fountain']],
  'future' => [4, 3, ['spaceport', 'power-tower', 'greenhouse-dome', 'habitat-cluster']],
];
$heroN = 6;
$heroGround = '';
$heroTiles = '';
foreach ($blocks as $w => [$io, $jo, $slugs]) {
  $heroGround .= '<span class="hq world-' . $w . '" style="--tex:url(' . tex($w, $WORLDS[$w]['ground']) . ');--roadtex:url(' . tex($w, 'ground-crossroads') . ');left:'
    . round($io * 100 / $heroN, 3) . '%;top:' . round($jo * 100 / $heroN, 3) . '%;width:' . round(200 / $heroN, 3) . '%;height:' . round(300 / $heroN, 3) . '%"></span>';
  foreach ($slugs as $k => $s) {
    $i = $io + $k % 2; $j = $jo + intdiv($k, 2);
    if (!isset($WORLD_DATA[$w]['pages'][$s])) { fwrite(STDERR, "home hero: unknown page $w/$s\n"); continue; }
    $name = $WORLD_DATA[$w]['pages'][$s]['name'];
    $heroTiles .= '<li class="tile" style="--i:' . $i . ';--j:' . $j . '"><a class="tile-btn" href="/worlds/' . $w . '/' . $s . '/">'
      . img($w, $s, '', '(min-width: 900px) 120px, 15vw', ($w === 'egypt' && $k === 1 ? 'fetchpriority="high" ' : '') . 'draggable="false"')
      . '<span class="tile-label">' . h($name . ' · ' . $WORLDS[$w]['short']) . '</span></a></li>';
  }
  // the world's own trees on the front row of its block
  foreach ([0, 1] as $di) $heroTiles .= '<li class="tile tile-tree" style="--i:' . ($io + $di) . ';--j:' . ($jo + 2) . '" aria-hidden="true">' . img($w, $WORLD_DATA[$w]['tree'], '', '(min-width: 900px) 120px, 15vw', 'draggable="false"') . '</li>';
}
// Street life on the front edges: [world, image, page link, u, v]. Whole numbers are street lines. As on the
// world maps, vehicles drive along the left front street, each in front of its own world.
foreach ([
  ['heaven', 'people-4', 'people/#people-4', 6.2, .9], ['heaven', 'people-2', 'people/#people-2', 6.2, 2.05],
  ['future', 'people-2', 'people/#people-2', 6.2, 3.95], ['future', 'people-5', 'people/#people-5', 6.2, 5.05],
  ['elven', 'people-5', 'people/#people-5', .45, 6.2], ['elven', 'flower-cart', 'flower-cart', 1.35, 6.14],
  ['roman', 'chariot', 'chariot', 2.75, 6.14], ['roman', 'people-6', 'people/#people-6', 3.6, 6.2],
  ['future', 'rear-hover-car', 'hover-car', 4.7, 6.02], ['future', 'people-6', 'people/#people-6', 5.5, 6.2],
] as [$w, $f, $link, $u, $v]) {
  $car = !str_starts_with($f, 'people');
  $heroTiles .= '<li class="tile decor ' . ($car ? 'decor-car' : 'decor-person') . '" style="--u:' . $u . ';--v:' . $v . ';--z:20' . ($car ? vehicle_fit($w, $link, str_starts_with($f, 'rear-')) : person_fit($w)) . '"><a class="tile-btn" href="/worlds/' . $w . '/' . $link . ($car ? '/' : '') . '" aria-label="' . h($WORLDS[$w]['name'] . ($car ? ' vehicle' : ' person')) . '">'
    . img($w, $f, '', $car ? '72px' : '48px', 'draggable="false"') . '</a></li>';
}
$peopleLinks = '';
foreach (WORLD_ORDER as $w) $peopleLinks .= '<li><a class="world-link world-' . $w . '" href="/worlds/' . $w . '/people/">' . h($WORLDS[$w]['short']) . ' people</a></li>';
$homePlayCards = play_cards(['/play/city-builder/', '/play/world-sort/', '/play/shadows/', '/play/quiz/', '/play/puzzle/', '/play/passport/']);
$heroLegend = '';
foreach (WORLD_ORDER as $w) $heroLegend .= '<li><a class="world-link world-' . $w . '" href="/worlds/' . $w . '/">' . h($WORLDS[$w]['name']) . '</a></li>';
$parade = [['egypt', 'chariot', 'About 3,500 years ago'], ['roman', 'chariot', 'About 2,000 years ago'], ['modern', 'taxi', 'Today'], ['elven', 'flower-cart', 'Imagined'], ['future', 'hover-car', 'Possible future'], ['heaven', 'golden-chariot', 'Inspired by belief']];

// World cards: horizon, signature building, a person, and three places to start.
$starts = [
  'egypt'  => ['pyramid', 'scribe-school', 'village-house'],
  'heaven' => ['pearl-gate', 'tree-of-life', 'banquet-hall'],
  'roman'  => ['aqueduct', 'amphitheater', 'public-baths'],
  'modern' => ['water-system', 'public-library', 'streets-crosswalks'],
  'elven'  => ['great-tree-hall', 'flower-meadow', 'tree-library'],
  'future' => ['water-recycler', 'oxygen-factory', 'pressurized-rover'],
];
$oneLine = [
  'egypt'  => 'The real civilization on the Nile, from the pyramids to the homes of the tomb builders.',
  'heaven' => 'An imagined city of goodness: the beliefs behind it, and real kindness today.',
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
foreach ([['egypt', 'people-2'], ['egypt', 'people-6'], ['roman', 'people-1'], ['roman', 'people-6'], ['modern', 'people-5'], ['modern', 'worker-1'], ['elven', 'people-1'], ['elven', 'people-4'], ['future', 'people-5'], ['future', 'people-6'], ['heaven', 'people-2'], ['heaven', 'people-3']] as [$w, $f]) {
  $crowd .= '<li class="world-' . $w . '"><a href="/worlds/' . $w . '/people/#' . $f . '">' . img($w, $f, '', '(min-width: 900px) 140px, 22vw', 'loading="lazy"')
    . '<span class="p-name">' . h($PEOPLE[$w][$f][0]) . '</span><span class="what">' . h($WORLDS[$w]['short']) . '</span></a></li>';
}

// Compare teaser: water in every world.
$water = '';
foreach (WORLD_ORDER as $w) {
  [$imgName, $name] = $COMPARE[0][3][$w];
  $water .= '<li class="world-' . $w . '"><span class="cmp-mini">' . img($w, $imgName, '', '(min-width: 900px) 200px, 40vw', 'loading="lazy"') . '</span><span class="p-name">' . h($name) . '</span><span class="what">' . h($WORLDS[$w]['short']) . '</span></li>';
}

$tourCards = '';
foreach (array_keys($TOURS) as $slug) $tourCards .= tour_card($slug);

$teachPick = '';
foreach (['design-a-city-project', 'build-a-roman-aqueduct', 'design-a-mars-colony-project'] as $s) $teachPick .= teach_card($s);

// Artwork mosaic: a few favorites from every world.
$mosaic = '';
foreach ([['egypt', 'town-3'], ['roman', 'fitness-3'], ['elven', 'shared-2'], ['heaven', 'growth-3'], ['future', 'growth-1'], ['modern', 'business-3'], ['egypt', 'vehicle-car-1'], ['roman', 'vehicle-car-2'], ['heaven', 'town-1'], ['elven', 'vehicle-car-3'], ['future', 'town-3'], ['modern', 'knowledge-3']] as [$w, $n]) {
  $f = "/assets/artwork/$w/$n-thumb.webp";
  if (!is_file(PUB . $f)) { fwrite(STDERR, "home mosaic missing $f\n"); continue; }
  $mosaic .= '<li class="world-' . $w . '"><img src="' . $f . '" width="480" height="480" alt="" loading="lazy" decoding="async"></li>';
}

// The shop's products, for grown-ups (build/shop.php)
// four to show here; the shop has the rest
$shopCards = shop_cards('', ['journey', 'activity', 'playset', 'classroom-pack']);
$shopCount = count($SHOP_INFO);

page('/', [
  'title' => SITE_NAME . ': how cities work, past, present and imagined',
  'desc' => h(SITE_DESC),
  'class' => 'home',
  'body' => <<<HTML
<section class="hero3">
  <div class="wrap hero3-inner">
    <div class="hero3-text">
      <div class="hero-brand">
        <img class="hero-logo" src="/assets/brand/atlas-emblem-400.webp" srcset="/assets/brand/atlas-emblem-200.webp 200w, /assets/brand/atlas-emblem-400.webp 400w, /assets/brand/atlas-emblem-800.webp 800w" sizes="(min-width: 900px) 170px, 120px" width="400" height="382" alt="" fetchpriority="high">
        <h1 class="hero-title">Past, Present and Imagined</h1>
      </div>
      <h2 class="hero-q">How does a city <span>work?</span></h2>
      <p class="lead">Explore six illustrated cities, from ancient Egypt to a settlement on Mars. Open any building, meet the people and compare how each world solves the same problems.</p>
      <p class="hero-actions"><a class="btn" href="#worlds">Choose a world</a> <a class="btn btn-quiet" href="/tours/">Take a guided tour</a></p>
      <p class="hero-free">Free for everyone. No sign-up, ads or tracking.</p>
    </div>
    <div class="hero3-map">
      <div class="city hero-city" style="--n:6;--y0:9">
        <div class="city-ground hero-ground" aria-hidden="true">{$heroGround}</div>
        <ul class="city-tiles" aria-label="A city made of all six worlds">{$heroTiles}</ul>
      </div>
      <ul class="world-links hero-legend">{$heroLegend}</ul>
    </div>
  </div>
</section>

<section class="stats" aria-label="What is on this site">
  <ul class="wrap stats-list">{$statsH}</ul>
</section>

<section class="wrap section" id="worlds" aria-labelledby="worlds-h">
  <div class="sec-head"><h2 id="worlds-h">Choose a world</h2><p>Egypt and Rome are real history. The other four are imagined settings built around real ideas, and every page shows which is which.</p></div>
  <ul class="wcards">{$cards}</ul>
</section>

<section class="band band-play" aria-labelledby="play-h">
  <div class="wrap">
    <div class="sec-head"><h2 id="play-h">Play and create</h2><p>Build your own city, race to sort the worlds, match shadows and collect a stamp for every place you visit.</p></div>
    <ul class="play-cards">{$homePlayCards}</ul>
    <p class="play-more"><a class="btn btn-quiet" href="/play/">See all {$gameCount} games</a></p>
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
  <ul class="world-links">{$peopleLinks}</ul>
</section>

<section class="band band-dark" aria-labelledby="tours-h">
  <div class="wrap">
    <div class="sec-head"><h2 id="tours-h">Take a guided tour</h2><p>Short walks led by someone who lives there, with a question at every stop.</p></div>
    <ul class="tour-grid">{$tourCards}</ul>
  </div>
</section>

<section class="wrap section split" aria-labelledby="cmp-h">
  <div>
    <h2 id="cmp-h">One question, six answers</h2>
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

<section class="band band-dark shop-home" aria-labelledby="shop-h">
  <div class="wrap">
    <div class="sec-head"><p class="tag">For grown-ups</p><h2 id="shop-h">From the shop</h2><p>Board games, an activity book, a play set, classroom packs and posters, all made from these worlds. Print them at home.</p></div>
    {$shopCards}
    <p class="shop-home-more"><a class="btn" href="/shop/">See all {$shopCount} in the shop</a></p>
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
    'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => url('/'), 'logo' => url('/assets/brand/atlas-logo-512.png')],
  ]],
]);
