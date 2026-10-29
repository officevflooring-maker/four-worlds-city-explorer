<?php
// Play and create: site search (/search/ and /data/search.json), the play hub (/play/), the city
// builder, the picture quiz and the passport. Included from build.php after the world, teacher and
// tour pages, because it uses their data, and before home.php. Everything runs in the browser, and
// anything a visitor makes or collects is kept only in their own browser.

const WORLD_LETTER = ['roman' => 'r', 'modern' => 'm', 'green' => 'e', 'future' => 'f', 'egypt' => 'g', 'heaven' => 'h'];
// Pages whose picture is a ground texture, not a building, so they are not builder or quiz pieces.
const NOT_PIECES = ['modern/water-system', 'modern/streets-crosswalks'];

// What every city needs, for the city builder checklist and the quiz. Each need lists the cross-link
// groups that meet it (build/crosslinks.php) and single pages that also meet it.
$NEEDS = [
  'water'  => ['Water', ['water'], []],
  'homes'  => ['Homes', ['houses', 'flats', 'homes-tech', 'palaces'], ['green/tree-tower-home', 'green/mushroom-cottage', 'green/leafy-cottage', 'modern/mixed-use-building', 'future/tree-pod-habitat']],
  'food'   => ['Food', ['food'], ['roman/street-food', 'modern/corner-store', 'green/canopy-market', 'green/market-hall', 'egypt/market', 'egypt/granary', 'heaven/banquet-hall', 'heaven/sharing-pavilion', 'heaven/tree-of-life']],
  'health' => ['Health', ['health', 'fitness'], []],
  'learn'  => ['Learning', ['schools', 'books', 'science'], ['modern/cultural-center']],
  'lead'   => ['Leaders', ['government'], ['roman/forum', 'roman/treasury', 'future/mission-control', 'egypt/pharaohs-palace', 'heaven/palace-of-light']],
  'meet'   => ['Places to meet', ['squares', 'shows', 'temples', 'prayer'], ['modern/community-center', 'modern/cultural-center', 'green/great-tree-hall', 'egypt/feast-hall', 'heaven/banquet-hall', 'heaven/welcome-hall', 'heaven/rainbow-pavilion']],
  'work'   => ['Work and shops', ['shops', 'making', 'storage'], ['modern/office-building', 'modern/skyscraper']],
  'safety' => ['Safety', ['safety'], []],
  'nature' => ['Nature', ['nature'], ['roman/olive-grove', 'green/flower-meadow', 'modern/community-garden', 'future/greenhouse-dome', 'egypt/palm-grove', 'heaven/tree-of-life', 'heaven/lily-garden']],
];
// Ground squares in the builder: [label, need it meets].
const GROUND_PIECES = ['water' => ['Water', 'water'], 'grass' => ['Grass', 'nature'], 'plaza' => ['Paved square', 'meet']];

// What the buildings in a cross-link group have in common, for the quiz's "same job" questions.
// Groups whose members are too different for a fair question are left out.
$GROUP_JOBS = [
  'water' => 'supply clean water', 'flats' => 'house many families close together', 'houses' => 'are homes for one family',
  'shows' => 'hold shows and games for big crowds', 'squares' => 'are open spaces where people meet',
  'government' => 'are where leaders meet and make decisions', 'books' => 'keep books and records',
  'schools' => 'are where children learn', 'fitness' => 'help people stay fit', 'shops' => 'supply things people need',
  'storage' => 'store goods', 'food' => 'grow plants', 'cranes' => 'lift heavy loads on building sites',
  'materials' => 'supply materials for building', 'temples' => 'were temples in the ancient world', 'prayer' => 'are places to pray', 'palaces' => 'are homes for rulers',
  'safety' => 'help keep people safe', 'science' => 'help people study the world', 'health' => 'look after people\'s health',
  'nature' => 'make room for nature',
];

function groups_of($key) {
  global $CROSSLINKS;
  $out = [];
  foreach ($CROSSLINKS as $g => $list) if (in_array($key, $list)) $out[] = $g;
  return $out;
}
function needs_of($key) {
  global $NEEDS;
  $g = groups_of($key);
  $out = [];
  foreach ($NEEDS as $id => [, $groups, $extra]) if (array_intersect($g, $groups) || in_array($key, $extra)) $out[] = $id;
  return $out;
}
// Small preview image (tools/make-thumbs.sh): [url, width, height], or null.
function thumb($w, $name) {
  $f = "/assets/thumbs/$w/$name.webp";
  if (!is_file(PUB . $f)) return null;
  [$tw, $th] = getimagesize(PUB . $f);
  return [$f, $tw, $th];
}
// The smallest web size of a building picture (most have -480; the wide aqueduct starts at -960).
function small_src($w, $name) {
  return is_file(PUB . "/assets/worlds/$w/$name-480.webp") ? "/assets/worlds/$w/$name-480.webp" : "/assets/worlds/$w/$name-960.webp";
}
function thumb_img($t, $alt = '', $attrs = 'loading="lazy"') {
  return $t ? '<img src="' . $t[0] . '" width="' . $t[1] . '" height="' . $t[2] . '" alt="' . h($alt) . '" decoding="async" ' . $attrs . '>' : '';
}
// Normalized words for searching: lower case, no accents or punctuation.
function search_words($s) {
  $s = strtolower(strtr($s, ['ö' => 'o', 'ø' => 'o', 'é' => 'e', 'è' => 'e', 'á' => 'a', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n', 'ç' => 'c', 'Ö' => 'o', 'Ø' => 'o', 'É' => 'e', 'å' => 'a']));
  return trim(preg_replace('/[^a-z0-9]+/', ' ', $s));
}

// ---------- Search index: every page a visitor might look for ----------
// Each entry: name, url, type, world ('' if none), thumbnail (or null), short description, extra keywords.
$SEARCH = [];
foreach (WORLD_ORDER as $w) {
  $W = $WORLDS[$w];
  $SEARCH[] = [$W['name'], "/worlds/$w/", 'World', $w, thumb($w, $W['card']), $W['lead'], $W['short'] . ' ' . $W['type'] . ' map'];
  if (!empty($PEOPLE[$w])) $SEARCH[] = [$PEOPLE_INTRO[$w][0], "/worlds/$w/people/", 'People', $w, thumb($w, 'people-1'), 'Meet the people who live and work in the city.', 'people jobs who lives'];
  if (!empty($WORLD_DATA[$w]['story'])) { $S = $WORLD_DATA[$w]['story']; $SEARCH[] = [$S['title'], "/worlds/$w/story/", 'Story', $w, thumb($w, array_key_first($WORLD_DATA[$w]['pages'])), $S['lead'], 'gospel bible jesus story parts']; }
  foreach ($WORLD_DATA[$w]['pages'] as $slug => $r) {
    $kw = $WORLD_DATA[$w]['cats'][$r['cat']][0] . ' ' . ($r['latin'] ?? '') . ' ' . implode(' ', array_keys($r['words']));
    $SEARCH[] = [$r['name'], "/worlds/$w/$slug/", empty($r['vehicle']) ? 'Place' : 'Vehicle', $w, thumb($w, $slug), $r['summary'], $kw];
  }
  foreach ($PEOPLE[$w] ?? [] as $file => [$pname, $role, $text]) {
    $SEARCH[] = [$pname, "/worlds/$w/people/#$file", 'Person', $w, thumb($w, $file), $role, $text];
  }
}
foreach ($TOURS as $slug => $t) {
  $SEARCH[] = [$t['h1'] . ' tour', "/tours/$slug/", 'Tour', $t['world'], thumb($t['world'], $t['guide']), $t['theme'], 'guided tour walk ' . $t['desc']];
}
foreach ($TEACH as $slug => $g) {
  [$lw, $ls] = explode('/', $g['links'][0] ?? 'roman/aqueduct');
  $SEARCH[] = [$g['h1'], "/teachers/$slug/", 'Teacher guide', '', thumb($lw, $ls), $g['kind'] . ', grades ' . $g['grades'], $g['subjects'] . ' lesson teacher class homeschool ' . $g['desc']];
}
$SEARCH[] = ['Free homeschool resources', '/teachers/homeschool/', 'Teacher guide', '', thumb('egypt', 'pyramid'), 'A week with one city, lessons by subject, printables and games',
  'homeschool home school homeschooling free resources curriculum co-op parents bible lessons'];
foreach ($COMPARE as [$key, $label, $question, $cells]) {
  $SEARCH[] = ["Compare: $label", "/compare/#$key", 'Compare', '', thumb('roman', $cells['roman'][0]) ?? thumb('modern', $cells['modern'][3] ?? ''), $question, 'compare six worlds'];
}
foreach ([
  ['Play and create', '/play/', 'Activity', 'Free games: build a city, sort pictures, match shadows, solve puzzles, quizzes and more.', 'games play fun kids'],
  ['Build your own city', '/play/city-builder/', 'Activity', 'Mix buildings from all six worlds and give your city everything it needs.', 'city builder game make design'],
  ['City quiz', '/play/quiz/', 'Activity', 'Ten picture questions about the six worlds.', 'quiz test game questions'],
  ['World sort', '/play/world-sort/', 'Activity', 'A race against the clock: send each picture home to its world.', 'sort sorting speed race timer game worlds'],
  ['Shadow match', '/play/shadows/', 'Activity', 'Whose shadow is it? Match shadows to buildings, people and vehicles.', 'shadow shadows silhouette shapes match game'],
  ['Zoom detective', '/play/zoom/', 'Activity', 'Name the building from a close-up as it slowly zooms out.', 'zoom close up detective guess picture game'],
  ['Odd one out', '/play/odd-one-out/', 'Activity', 'Four pictures: spot the one that does not belong.', 'odd one out puzzle thinking game'],
  ['Picture puzzle', '/play/puzzle/', 'Activity', 'Swap the mixed-up pieces until the picture is whole again.', 'jigsaw puzzle picture pieces game'],
  ['Memory match', '/play/memory/', 'Activity', 'Turn over cards and match buildings that do the same job.', 'memory cards pairs match game'],
  ['Word search', '/play/word-search/', 'Activity', 'Find ten hidden city words, then learn what they mean.', 'word search letters vocabulary puzzle game'],
  ['Map hunt', '/play/map-hunt/', 'Activity', 'Read a clue, then find the place on a city map.', 'map hunt clues find game'],
  ['Your city passport', '/play/passport/', 'Activity', 'Collect a stamp for every place you open.', 'passport stamps visited progress'],
  ['Compare the worlds', '/compare/', 'Page', 'One question, six answers: water, gathering, travel, goods and nature.', 'compare'],
  ['Guided tours', '/tours/', 'Page', 'Short walks with a guide and a question at every stop.', 'tours'],
  ['Teachers and families', '/teachers/', 'Page', 'Free lessons, projects and explainers for every grade.', 'teachers lessons school class'],
  ['Artwork', '/artwork/', 'Page', 'View, save and print every illustration, free under CC BY 4.0.', 'art pictures images download print free'],
  ['About this project', '/about/', 'Page', 'What is real and what is imagined, privacy, accessibility and sources.', 'about privacy sources accessibility'],
  ['Support this project', '/support/', 'Page', 'Help keep the site free, with no ads.', 'donate patreon support'],
  ['Shop', '/shop/', 'Page', 'Board games, posters and classroom packs for grown-ups, made from the worlds of this site.', 'shop buy store games posters packs printable'],
  ['Life RPG', '/life-rpg/', 'Shop', 'An app for grown-ups and teens: real-life goals become quests.', 'life rpg game app habits goals quests grown-ups parents teens buy'],
  ['City Builders card game', '/city-builders/', 'Shop', 'A card game to print at home about what every city needs.', 'card game print play printable family classroom needs buy'],
  ['Classroom Pack', '/classroom-pack/', 'Shop', 'Fact cards, worksheets and discussion cards in one file to print.', 'classroom pack teachers printable fact cards worksheets discussion buy'],
  ['Poster Set', '/posters/', 'Shop', 'Eight posters to print: every world and the ten things every city needs.', 'posters print wall classroom support donate pay what you want buy'],
  ['Journey Through the Worlds', '/journey/', 'Shop', 'A board game to print: race through every world.', 'board game race dice print play family classroom buy'],
  ['City Bingo', '/bingo/', 'Shop', 'Picture bingo with 30 different cards, for a whole class.', 'bingo game classroom party print play pictures buy'],
  ['City Planners', '/planners/', 'Shop', 'A drawing game: plan a city where homes have what they need.', 'flip and write drawing game planning map print play classroom buy'],
  ['Atlas Trivia', '/trivia/', 'Shop', 'A family quiz game: 162 questions at three levels.', 'trivia quiz questions game family party classroom print buy'],
  ['Atlas Word Wall', '/wordwall/', 'Shop', '144 vocabulary cards and a glossary for the classroom.', 'word wall vocabulary words cards glossary classroom teacher print buy'],
  ['2027 Calendar', '/calendar/', 'Shop', 'A wall calendar with a landmark from a different world every month.', 'calendar 2027 wall months year gift print buy'],
  ['Build-a-City Play Set', '/playset/', 'Shop', 'A play mat and 96 stand-up buildings, people and vehicles.', 'play set mat toy stand up paper buildings kids build city print buy'],
  ['Activity Book', '/activity/', 'Shop', 'Crosswords, mazes, word scrambles and puzzles from six worlds.', 'activity book puzzles crossword maze word scramble kids print buy'],
] as [$n, $u, $y, $d, $k]) $SEARCH[] = [$n, $u, $y, '', null, $d, $k];

$json = [];
foreach ($SEARCH as [$n, $u, $y, $w, $t, $d, $k]) $json[] = ['n' => $n, 'u' => $u, 'y' => $y, 'w' => $w, 't' => $t[0] ?? '', 'd' => $d, 'k' => search_words($k)];
@mkdir(PUB . '/data', 0777, true);
file_put_contents(PUB . '/data/search.json', json_encode(['worlds' => array_map(fn($W) => $W['name'], $WORLDS), 'items' => $json], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo "wrote /data/search.json (" . count($json) . " entries)\n";

// ---------- Search page: everything A to Z, filtered as you type ----------
$az = [];
foreach ($SEARCH as $e) {
  $letter = strtoupper(search_words($e[0])[0]);
  $az[ctype_alpha($letter) ? $letter : '#'][] = $e;
}
ksort($az);
$azH = '';
$azJump = '';
foreach ($az as $letter => $list) {
  usort($list, fn($a, $b) => strnatcasecmp($a[0], $b[0]));
  $li = '';
  foreach ($list as [$n, $u, $y, $w, $t, $d, $k]) {
    $meta = $y . ($w ? ' · ' . $WORLDS[$w]['name'] : '');
    $art = $t ? thumb_img($t) : '<span class="az-icon" aria-hidden="true">' . h(substr($y, 0, 1)) . '</span>';
    $li .= '<li data-s="' . h(search_words("$n $y " . ($w ? $WORLDS[$w]['name'] : '') . " $k $d")) . '"' . ($w ? ' class="world-' . $w . '"' : '') . '><a href="' . h($u) . '"><span class="az-art">' . $art . '</span><span class="az-text"><span class="az-name">' . h($n) . '</span><span class="az-meta">' . h($meta) . '</span></span></a></li>';
  }
  $azH .= '<section class="az-sec" id="az-' . strtolower($letter) . '" aria-labelledby="azh-' . strtolower($letter) . '"><h2 id="azh-' . strtolower($letter) . '">' . $letter . '</h2><ul class="az">' . $li . '</ul></section>';
  $azJump .= '<li><a href="#az-' . strtolower($letter) . '">' . $letter . '</a></li>';
}
$searchCount = count($SEARCH);
page('/search/', [
  'title' => 'Find a page: every building, vehicle, person and tour, A to Z',
  'desc' => h("Search all $searchCount pages of The Atlas of Cities: buildings and vehicles in six worlds, their people, guided tours, teacher guides and games."),
  'class' => 'search-page',
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Find a page</h1>
  <p class="lead">Every building, vehicle, person, tour and guide on the site, from A to Z.</p>
  <div class="sp-form" role="search">
    <label for="sp-q" class="sr-only">Search the site</label>
    <input type="search" id="sp-q" placeholder="Try aqueduct, Mars or library" autocomplete="off" spellcheck="false" disabled>
    <button type="button" class="btn btn-quiet" data-surprise hidden>Surprise me</button>
  </div>
  <p class="sp-count" aria-live="polite"></p>
  <nav aria-label="Letters"><ul class="az-jump">{$azJump}</ul></nav>
</section>
<div class="wrap az-all">{$azH}</div>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Find a page', '/search/']])],
]);

// ---------- Cards for the activities (play hub, and a few on the home page) ----------
function play_cards($only = null) {
  global $WORLD_DATA;
  $total = 0;
  foreach ($WORLD_DATA as $D) $total += count($D['pages']);
  $b = '';
  foreach ([['modern', 'residential-tower', 0, 0], ['roman', 'pantheon', 1, 0], ['green', 'treetop-village', 0, 1], ['future', 'greenhouse-dome', 1, 1]] as [$w, $s, $i, $j]) {
    $b .= '<span class="pa-tile" style="--i:' . $i . ';--j:' . $j . '">' . thumb_img(thumb($w, $s)) . '</span>';
  }
  $stamps = '';
  foreach (WORLD_ORDER as $w) $stamps .= '<span class="pa-stamp world-' . $w . '">' . thumb_img(thumb($w, $WORLDS[$w]['face'] ?? 'people-1')) . '</span>';
  // A small letter grid with one word found.
  $letters = '';
  foreach (['KDOMEP', 'WATERS', 'LBRIGT', 'ARCHVN', 'NSQUAY'] as $r => $row) {
    foreach (str_split($row) as $c => $ch) $letters .= '<span' . ($r === 1 && $c < 5 ? ' class="on"' : '') . '>' . $ch . '</span>';
  }
  $odd = '';
  foreach ([['roman', 'forum'], ['roman', 'pantheon'], ['future', 'spaceport'], ['roman', 'amphitheater']] as $k => [$w, $s]) $odd .= '<span' . ($w === 'future' ? ' class="odd"' : '') . '>' . thumb_img(thumb($w, $s)) . '</span>';
  $bins = '';
  foreach (WORLD_ORDER as $w) $bins .= '<span class="world-' . $w . '"></span>';
  $pz = '';
  $pzSrc = thumb('green', 'treetop-village')[0] ?? '';
  for ($k = 0; $k < 9; $k++) $pz .= '<span' . ($k === 5 ? ' class="out"' : '') . ' style="background-image:url(' . $pzSrc . ');background-position:' . ($k % 3) * 50 . '% ' . intdiv($k, 3) * 50 . '%"></span>';
  $cards = [
    ['/play/city-builder/', 'Build your own city', 'Mix buildings from all six worlds, then try the nine challenges.', 'Start building', '<span class="pa pa-build" aria-hidden="true"><span class="pa-ground"></span>' . $b . '</span>'],
    ['/play/world-sort/', 'World sort', 'A race against the clock: send each picture home to its world.', 'Start sorting', '<span class="pa pa-sort" aria-hidden="true"><span class="pa-sortcard">' . thumb_img(thumb('egypt', 'camel')) . '</span><span class="pa-bins">' . $bins . '</span></span>'],
    ['/play/shadows/', 'Shadow match', 'Whose shadow is it? Find the building, person or vehicle that fits.', 'Match shadows', '<span class="pa pa-shadow" aria-hidden="true"><span class="pa-sil">' . thumb_img(thumb('green', 'deer-statue')) . '</span><span class="pa-col">' . thumb_img(thumb('green', 'deer-statue')) . '</span></span>'],
    ['/play/zoom/', 'Zoom detective', 'A close-up slowly zooms out. Name it early to score more.', 'Start zooming', '<span class="pa pa-zoom" aria-hidden="true"><span class="pa-zf">' . thumb_img(thumb('roman', 'pantheon')) . '</span></span>'],
    ['/play/odd-one-out/', 'Odd one out', 'Four pictures, and one does not belong. Can you spot it?', 'Spot it', '<span class="pa pa-odd" aria-hidden="true"><span class="pa-oddgrid">' . $odd . '</span></span>'],
    ['/play/puzzle/', 'Picture puzzle', 'Swap the mixed-up pieces until the picture is whole again.', 'Solve a puzzle', '<span class="pa pa-puzzle" aria-hidden="true"><span class="pa-pz">' . $pz . '</span></span>'],
    ['/play/quiz/', 'City quiz', 'Five quizzes: buildings, worlds, jobs, key words and people.', 'Take the quiz', '<span class="pa pa-quiz" aria-hidden="true">' . thumb_img(thumb('roman', 'aqueduct')) . '<span class="pa-q">?</span><span class="pa-opts"><span></span><span></span><span></span></span></span>'],
    ['/play/map-hunt/', 'Map hunt', 'Read a clue, then find the place on a city map.', 'Start hunting', '<span class="pa pa-hunt" aria-hidden="true"><span class="pa-lens">' . thumb_img(thumb('green', 'treetop-village')) . '</span><span class="pa-handle"></span></span>'],
    ['/play/memory/', 'Memory match', 'Turn over two cards at a time and find the pairs that go together.', 'Play memory', '<span class="pa pa-mem" aria-hidden="true"><span class="pa-card pa-card-back"><img src="/favicon.svg" width="44" height="44" alt=""></span><span class="pa-card">' . thumb_img(thumb('roman', 'aqueduct')) . '</span><span class="pa-card">' . thumb_img(thumb('future', 'water-recycler')) . '</span></span>'],
    ['/play/word-search/', 'Word search', 'Find ten hidden city words, then learn what they mean.', 'Find words', '<span class="pa pa-words" aria-hidden="true"><span class="pa-letters">' . $letters . '</span></span>'],
    ['/play/passport/', 'Your city passport', "Collect stamps and badges. Can you visit all $total places?", 'See your stamps', '<span class="pa pa-pass" aria-hidden="true">' . $stamps . '</span>'],
  ];
  $out = '';
  foreach ($cards as [$href, $title, $text, $go, $art]) {
    if ($only && !in_array($href, $only)) continue;
    $out .= '<li class="play-card"><a href="' . $href . '">' . $art . '<span class="play-text"><span class="play-title">' . h($title) . '</span><span class="what">' . h($text) . '</span><span class="play-go">' . h($go) . ' <span aria-hidden="true">&rarr;</span></span></span></a></li>';
  }
  return $out;
}

// ---------- Play hub ----------
$playCards = play_cards();
// Every card but the passport is a game.
$gameCount = substr_count($playCards, 'class="play-card"') - 1;
$gameWord = ['Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve'][$gameCount - 6] ?? (string)$gameCount;
$promo = shop_cards('', ['journey', 'trivia', 'activity', 'playset']);
// The games, listed for search engines.
preg_match_all('~<li class="play-card"><a href="([^"]+)">.*?<span class="play-title">([^<]+)</span>~', $playCards, $pm, PREG_SET_ORDER);
$playList = [];
foreach ($pm as $k => [, $href, $name]) $playList[] = ['@type' => 'ListItem', 'position' => $k + 1, 'name' => html_entity_decode($name, ENT_QUOTES | ENT_HTML5), 'url' => url($href)];
page('/play/', [
  'title' => 'Play and create: free city games for kids',
  'desc' => h("$gameWord free city games for kids: build a city, race to sort pictures, match shadows, zoom in, spot the odd one out, solve puzzles, quizzes and map hunts. No sign-up."),
  'class' => 'play',
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Play and create</h1>
  <p class="lead">{$gameWord} free games about how cities work, and a passport to collect stamps. No sign-up, and nothing leaves your device.</p>
  <ul class="play-cards">{$playCards}</ul>
</section>
<section class="wrap section next" aria-labelledby="more-h">
  <h2 id="more-h">More ways to explore</h2>
  <p><a class="btn" href="/tours/">Take a guided tour</a> <a class="btn btn-quiet" href="/compare/">Compare the worlds</a> <button type="button" class="btn btn-quiet" data-surprise hidden>Surprise me</button></p>
</section>
<section class="band shop-promo" aria-labelledby="promo-h"><div class="wrap"><div class="sec-head"><p class="tag">From the shop</p><h2 id="promo-h">Games to play away from the screen</h2><p>The games here are free. These ones you print at home and play around the table:</p></div>{$promo}<p class="shop-home-more"><a class="btn btn-quiet" href="/shop/">See everything in the shop</a></p></div></section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/']]),
    ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => 'Free city games', 'numberOfItems' => count($playList), 'itemListElement' => $playList]],
]);

// ---------- City builder ----------
$tabs = '';
$panels = '';
foreach (WORLD_ORDER as $n => $w) {
  $L = WORLD_LETTER[$w];
  $D = $WORLD_DATA[$w];
  $li = '';
  $piece = function ($code, $kind, $name, $src, $thumbImg, $url, $needs) use ($w) {
    return '<li><button type="button" class="piece" aria-pressed="false" data-code="' . $code . '" data-kind="' . $kind . '" data-world="' . $w . '" data-src="' . $src . '"'
      . ' data-name="' . h($name) . '" data-url="' . $url . '" data-needs="' . implode(' ', $needs) . '">' . $thumbImg . '<span>' . h($name) . '</span></button></li>';
  };
  foreach (GROUND_PIECES as $g => [$glabel, $need]) {
    $src = tex($w, "ground-$g");
    $li .= $piece("$L~$g", 'g', $glabel, $src, '<span class="piece-tex" style="background-image:url(' . $src . ')"></span>', '', [$need]);
  }
  $tree = $D['tree'];
  $li .= $piece($L . $tree, 't', ucfirst(str_replace('-', ' ', $tree)), small_src($w, $tree), thumb_img(thumb($w, $tree)), '', ['nature']);
  foreach ($D['pages'] as $slug => $r) {
    if (!empty($r['vehicle']) || in_array("$w/$slug", NOT_PIECES)) continue;
    $li .= $piece($L . $slug, 'b', $r['name'], small_src($w, $slug), thumb_img(thumb($w, $slug)), "/worlds/$w/$slug/", needs_of("$w/$slug"));
  }
  $sel = $n === 0 ? 'true' : 'false';
  $tabs .= '<button type="button" role="tab" class="pal-tab world-' . $w . '" id="pal-tab-' . $w . '" aria-controls="pal-' . $w . '" aria-selected="' . $sel . '"' . ($n ? ' tabindex="-1"' : '') . '>' . h($WORLDS[$w]['short']) . '</button>';
  $panels .= '<div class="pal-panel world-' . $w . '" role="tabpanel" id="pal-' . $w . '" aria-labelledby="pal-tab-' . $w . '" data-world="' . $w . '"' . ($n ? ' hidden' : '') . '><ul class="pal-grid">' . $li . '</ul></div>';
}
$grounds = '';
foreach (WORLD_ORDER as $w) {
  $grounds .= '<button type="button" class="chip world-' . $w . '" data-base="' . $w . '" data-tex="' . tex($w, 'ground-grass') . '" data-road="' . tex($w, 'ground-crossroads') . '" aria-pressed="' . ($w === 'modern' ? 'true' : 'false') . '">' . h($WORLDS[$w]['short']) . '</button>';
}
$cellsH = '';
for ($k = 0; $k < 36; $k++) {
  $cellsH .= '<button type="button" class="bcell" style="--i:' . ($k % 6) . ';--j:' . intdiv($k, 6) . '" data-k="' . $k . '" tabindex="' . ($k ? -1 : 0) . '"><span class="bcell-g"></span></button>';
}
$needsH = '';
foreach ($NEEDS as $id => [$label]) $needsH .= '<li class="need" data-need="' . $id . '">' . h($label) . '</li>';
$needCount = count($NEEDS);
// Challenges for the city builder: [title, text, goals]. Goals: ['needs', n] needs met, ['only', world]
// every piece from one world, ['every', n] buildings from each world, ['max', n] buildings at most,
// ['nature', n] squares with trees, grass or green places, ['water', n] squares of water.
const CHALLENGES = [
  'roman-town'   => ['A Roman town', 'Use only pieces from Ancient Rome and meet all ten needs.', [['only', 'roman'], ['needs', 10]]],
  'mars-base'    => ['A base on Mars', 'Use only Robotic Future pieces and meet all ten needs.', [['only', 'future'], ['needs', 10]]],
  'nile-town'    => ['A town on the Nile', 'Use only Ancient Egypt pieces and meet all ten needs.', [['only', 'egypt'], ['needs', 10]]],
  'heaven-city'  => ['A heavenly city', 'Use only Heavenly City pieces and meet all ten needs.', [['only', 'heaven'], ['needs', 10]]],
  'small-village'=> ['A small village', 'Meet all ten needs with eight buildings or fewer. Trees and ground do not count.', [['needs', 10], ['max', 8]]],
  'green-city'   => ['A green city', 'Meet all ten needs and give nature at least ten squares.', [['needs', 10], ['nature', 10]]],
  'waterfront'   => ['A waterfront city', 'Add at least four squares of water and meet all ten needs.', [['water', 4], ['needs', 10]]],
  'time-travel'  => ['Time travel town', 'Use at least two buildings from every world and meet all ten needs.', [['every', 2], ['needs', 10]]],
  'forest-city'  => ['A green forest city', 'Use only Green World pieces. Which need is hardest? Try to meet nine.', [['only', 'green'], ['needs', 9]]],
];
$chalChips = '';
foreach (CHALLENGES as $id => [$ct]) $chalChips .= '<button type="button" class="chip chal-chip" data-chal="' . $id . '" aria-pressed="false">' . h($ct) . '</button>';
$chalData = json_encode(array_map(fn($c) => ['t' => $c[0], 'd' => $c[1], 'g' => $c[2]], CHALLENGES), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP);
$chalCount = count(CHALLENGES);
$modernTex = tex('modern', 'ground-grass');
$modernRoad = tex('modern', 'ground-crossroads');
$cbExtras = game_extras('/play/city-builder/', 'Pick a building from any world, then tap a square on the map to build it. The list shows which needs your city meets. Try a challenge, then save a picture of your city or copy its link to share.',
  'What every city needs, from water and homes to safety and nature, and how different places meet those needs.', 'How it works', 'What you learn');
page('/play/city-builder/', [
  'title' => 'Build your own city: a free city builder for students',
  'desc' => h("A free online city builder for kids: place buildings from six illustrated worlds, from ancient Egypt to Mars, and give your city all $needCount things it needs."),
  'class' => 'play builder-page',
  'js' => ['builder'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">City builder</li></ol></nav>
</div>
<section class="wrap builder-head">
  <h1>Build your own city</h1>
  <p class="lead">Pick a building, then tap a square. Mix all six worlds, meet every need, then try the challenges.</p>
</section>
<div class="wrap builder" data-builder>
  <div class="b-main">
    <div class="b-bar">
      <div class="b-tools" role="group" aria-label="Tools">
        <button type="button" class="ctrl b-tool" data-tool="look" aria-pressed="true">Look</button>
        <button type="button" class="ctrl b-tool" data-tool="erase" aria-pressed="false">Eraser</button>
        <button type="button" class="ctrl" data-act="undo" disabled>Undo</button>
        <button type="button" class="ctrl" data-act="random">Random city</button>
        <button type="button" class="ctrl" data-act="clear">Clear</button>
      </div>
      <div class="b-ground" role="group" aria-label="Ground and streets"><span class="b-label">Ground</span>{$grounds}</div>
    </div>
    <div class="b-stage">
      <div class="city builder-city world-modern" style="--tex:url({$modernTex});--roadtex:url({$modernRoad});--n:6;--y0:12">
        <div class="city-ground"><div class="bcells" role="group" aria-label="City squares. Use the arrow keys to move and Enter to build.">{$cellsH}</div></div>
        <ul class="city-tiles" aria-hidden="true"></ul>
      </div>
    </div>
    <p class="b-status" aria-live="polite">Pick a building below, then tap a square on the map.</p>
  </div>
  <section class="b-palette" aria-label="Buildings and ground">
    <div class="pal-tabs" role="tablist" aria-label="World">{$tabs}</div>
    {$panels}
  </section>
  <section class="b-needs" aria-labelledby="needs-h">
    <h2 id="needs-h">What does your city need?</h2>
    <p class="b-score"><strong>0</strong> of {$needCount} needs met</p>
    <ul class="needs">{$needsH}</ul>
    <p class="b-done" hidden>Your city has everything it needs. What would make it a great place to live?</p>
    <p class="small"><a href="/teachers/what-does-a-city-need/">What does a city need to work?</a></p>
  </section>
  <section class="b-chal" aria-labelledby="chal-h">
    <h2 id="chal-h">Challenges</h2>
    <p class="b-score"><strong class="chal-n">0</strong> of {$chalCount} done</p>
    <div class="chal-list" role="group" aria-label="Pick a challenge">{$chalChips}</div>
    <div class="chal-card" hidden><p class="chal-title"></p><p class="chal-text"></p><ul class="chal-goals"></ul><p class="chal-done" hidden>Challenge complete! Pick another one.</p></div>
  </section>
  <div class="b-actions">
    <button type="button" class="btn" data-act="picture">Save picture</button>
    <button type="button" class="btn btn-quiet" data-act="link">Copy link</button>
    <button type="button" class="btn btn-quiet" data-act="print">Print</button>
  </div>
</div>
<script type="application/json" id="challenge-data">{$chalData}</script>
<noscript><p class="wrap setting-note">The city builder needs JavaScript. You can still explore every building from the <a href="/">home page</a>.</p></noscript>
<section class="wrap section b-think" aria-labelledby="think-h">
  <h2 id="think-h">Think about it</h2>
  <ul class="plain-points">
    <li>Who lives in your city? How do they get water, food and help when they are sick?</li>
    <li>Which world's buildings did you use most? Why?</li>
    <li>Your city is saved in this browser and in the page address, so you can share the link.</li>
  </ul>
</section>
{$cbExtras}
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['City builder', '/play/city-builder/']]),
    learning('Build your own city', 'An online city builder: place buildings from six illustrated worlds and check that the city meets every need.', '/play/city-builder/', 'City planning and what a city needs')],
]);

// ---------- Quiz ----------
$quizItems = [];
foreach ($WORLD_DATA as $w => $D) foreach ($D['pages'] as $slug => $r) {
  if (in_array("$w/$slug", NOT_PIECES)) continue;
  $quizItems[] = ['k' => "$w/$slug", 'w' => $w, 'n' => $r['name'], 'u' => "/worlds/$w/$slug/", 'i' => small_src($w, $slug), 't' => thumb($w, $slug)[0] ?? '',
    'c' => $r['cat'], 'd' => $r['summary'], 'g' => groups_of("$w/$slug"), 'nd' => needs_of("$w/$slug")];
}
// Key words from every page (a definition that names its own word would give the answer away).
$quizWords = [];
foreach ($WORLD_DATA as $w => $D) foreach ($D['pages'] as $slug => $r) foreach ($r['words'] as $term => $def) {
  if (stripos($def, $term) !== false || strlen($term) > 24) continue;
  $quizWords[] = ['t' => $term, 'd' => $def, 'w' => $w, 'n' => $r['name'], 'u' => "/worlds/$w/$slug/", 'p' => thumb($w, $slug)[0] ?? ''];
}
// People, and the places where you would find them (build/people.php).
$quizPeople = [];
foreach ($PEOPLE as $w => $list) foreach ($list as $file => [$pname, $role, $text, $places]) {
  $quizPeople[] = ['w' => $w, 'n' => $pname, 'r' => $role, 'x' => $text, 'i' => "/assets/worlds/$w/$file-256.webp", 't' => thumb($w, $file)[0] ?? '', 'u' => "/worlds/$w/people/#$file", 'pl' => $places];
}
$worldNames = array_map(fn($W) => [$W['name'], $W['short']], $WORLDS);
$pick = fn($list, $keys) => array_map(fn($it) => array_intersect_key($it, array_flip($keys)), $list);

// A picture game that runs on public/js/quiz.js: ten questions of one kind, picked on its first screen.
// $g: path, title, desc, h1 (also the breadcrumb), lead, modes ([mode, title, text, two pictures]), data (for
// #quiz-data), key (where best scores are kept), done (the badge it earns), need (the score that earns it; every
// answer right if none), learn ([summary, subject] for search engines) and art (an extra class for the pictures).
function quiz_game($g) {
  $modes = game_modes($g['modes'], $g['art'] ?? '');
  $data = json_encode($g['data'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
  $h1 = h($g['h1']);
  $lead = h($g['lead']);
  $attrs = ' data-key="' . $g['key'] . '" data-done="' . $g['done'] . '"' . (empty($g['need']) ? '' : ' data-need="' . $g['need'] . '"');
  $extras = game_extras($g['path'], $g['howto'][0], $g['howto'][1]);
  page($g['path'], [
    'title' => $g['title'],
    'desc' => h($g['desc']),
    'class' => 'play quiz-page',
    'js' => ['quiz'],
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">{$h1}</li></ol></nav>
</div>
<section class="wrap section quiz" data-quiz{$attrs} aria-labelledby="quiz-h">
  <h1 id="quiz-h">{$h1}</h1>
  <div class="quiz-start">
    <p class="lead">{$lead}</p>
    <ul class="qmodes">{$modes}</ul>
  </div>
  <div class="quiz-play" hidden>
    <div class="q-top"><p class="q-count"></p><p class="q-score"></p></div>
    <div class="q-bar" aria-hidden="true"><span></span></div>
    <h2 class="q-ask" tabindex="-1"></h2>
    <div class="q-pic"></div>
    <div class="q-options"></div>
    <div class="q-feedback" aria-live="polite"></div>
    <p class="q-next-row"><button type="button" class="btn q-next" hidden>Next question</button></p>
  </div>
  <div class="quiz-end" hidden>
    <h2 class="q-result" tabindex="-1"></h2>
    <p class="q-msg"></p>
    <p><button type="button" class="btn q-again">Play again</button> <button type="button" class="btn btn-quiet q-other">Choose another quiz</button></p>
    <h3>Read about them</h3>
    <ul class="q-review"></ul>
  </div>
  <noscript><p class="setting-note">{$h1} needs JavaScript. You can still explore every building from the <a href="/">home page</a>.</p></noscript>
</section>
{$extras}
<script type="application/json" id="quiz-data">{$data}</script>
HTML,
    'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], [$g['h1'], $g['path']]]), learning($g['h1'], $g['learn'][0], $g['path'], $g['learn'][1])],
  ]);
}

quiz_game([
  'path' => '/play/quiz/', 'h1' => 'City quiz',
  'title' => 'City quiz: picture questions about six city worlds',
  'desc' => 'A free picture quiz in five parts: name the building, guess its world, match jobs, learn key words and find where people work, in six city worlds.',
  'howto' => ['Choose one of the five quizzes. Each has ten questions with pictures: pick an answer to see whether you are right, and why. Your best score is kept on this device.',
    'The names, worlds and jobs of buildings from six cities, the key words that describe them, and who works where.'],
  'lead' => 'Ten questions each. Choose a quiz:',
  'modes' => [
    ['name', 'Name that building', 'Look at the picture and pick its name.', [['roman', 'pantheon'], ['modern', 'public-library']]],
    ['world', 'Which world?', 'Is it from Egypt, Rome, the modern town, the Green World, the future or the heavenly city?', [['green', 'treehouse-school'], ['future', 'radio-telescope']]],
    ['job', 'Same job, different world', 'Find the building that does the same job in another world.', [['roman', 'aqueduct'], ['future', 'water-recycler']]],
    ['words', 'Key words', 'Read the meaning and pick the right word.', [['roman', 'library'], ['green', 'tree-library']]],
    ['people', 'Who works here?', 'Meet a person and find the place where they work or live.', [['modern', 'worker-1'], ['future', 'people-2']]],
  ],
  'data' => ['worlds' => $worldNames, 'jobs' => $GROUP_JOBS, 'items' => $quizItems, 'words' => $quizWords, 'people' => $quizPeople],
  'key' => 'atlas.quiz', 'done' => 'quiz',
  'learn' => ['Picture questions about buildings in six illustrated city worlds.', 'Cities, buildings and what they are for'],
]);

// ---------- Shadow match, Zoom detective and Odd one out (picture games on quiz.js) ----------
quiz_game([
  'path' => '/play/shadows/', 'h1' => 'Shadow match',
  'title' => 'Shadow match: whose shadow is it?',
  'desc' => 'A free picture game for kids: find the building, person or vehicle that casts each black shadow, from ancient Egypt to Mars and a heavenly city.',
  'howto' => ['Look closely at the black shape, then pick the picture it belongs to. When you answer, the shadow lights up in full color. Ten shadows make a game.',
    'Looking carefully at shapes and outlines, a skill that artists, architects and scientists use every day, and the buildings, people and vehicles of six worlds.'],
  'lead' => 'Every building, person and vehicle has its own shape. Look closely at the shadow, then find whose it is. Ten shadows a game:',
  'modes' => [
    ['shadow', 'Easy shadows', 'Four buildings from four different worlds.', [['egypt', 'sphinx'], ['egypt', 'sphinx']]],
    ['shadow-hard', 'Tricky shadows', 'All four buildings come from the same world.', [['heaven', 'bell-tower'], ['heaven', 'bell-tower']]],
    ['shadow-pv', 'People and vehicles', 'Find the person or vehicle that fits the shadow.', [['egypt', 'camel'], ['egypt', 'camel']]],
  ],
  'data' => ['worlds' => $worldNames, 'items' => $pick($quizItems, ['k', 'w', 'n', 'u', 'i', 't', 'c', 'd']), 'people' => $pick($quizPeople, ['w', 'n', 'r', 'x', 'i', 't', 'u'])],
  'key' => 'atlas.shadows', 'done' => 'shadows', 'need' => 8,
  'learn' => ['Match black shadows to the buildings, people and vehicles of six illustrated city worlds.', 'Shapes, observation and city buildings'],
  'art' => ' qmode-shadow',
]);
quiz_game([
  'path' => '/play/zoom/', 'h1' => 'Zoom detective',
  'title' => 'Zoom detective: name the building from a close-up',
  'desc' => 'A free picture game: a close-up slowly zooms out, and the sooner you name the building, the more points you score. Places from six city worlds.',
  'howto' => ['A close-up picture slowly zooms out. Pick the building\'s name as soon as you know it: early answers score 3 points, later ones 2, and answers at the end 1.',
    'Noticing details, such as roofs, columns, windows and colors, that tell one building from another.'],
  'lead' => 'Each picture starts as a close-up and slowly zooms out. Name it early for 3 points, a little later for 2, or at the end for 1. Choose a game:',
  'modes' => [
    ['zoom', 'Easy zoom', 'The four answers come from four different worlds.', [['roman', 'pantheon'], ['roman', 'pantheon']]],
    ['zoom-hard', 'Tricky zoom', 'All four answers come from the same world.', [['future', 'radio-telescope'], ['future', 'radio-telescope']]],
  ],
  'data' => ['worlds' => $worldNames, 'items' => $pick($quizItems, ['k', 'w', 'n', 'u', 'i', 't', 'c', 'd'])],
  'key' => 'atlas.zoom', 'done' => 'zoom', 'need' => 20,
  'learn' => ['Name buildings from six illustrated city worlds as close-up pictures zoom out.', 'Observation and city buildings'],
  'art' => ' qmode-zoom',
]);
quiz_game([
  'path' => '/play/odd-one-out/', 'h1' => 'Odd one out',
  'title' => 'Odd one out: which picture does not belong?',
  'desc' => 'A free thinking game for kids: four pictures and one does not belong. Spot the place from another world, or the building with a different job.',
  'howto' => ['Four pictures appear. Three of them belong together and one does not: tap the odd one out, then read why. Ten puzzles make a game.',
    'Comparing and grouping: telling which world a place comes from, and what job a building does for its city.'],
  'lead' => 'Four pictures, and one of them does not belong. Can you spot it? Ten puzzles a game:',
  'modes' => [
    ['odd-world', 'Odd world out', 'Three come from the same world. Which one is from somewhere else?', [['roman', 'forum'], ['future', 'spaceport']]],
    ['odd-job', 'Odd job out', 'Three do the same job in different worlds. Which one does something else?', [['roman', 'aqueduct'], ['modern', 'stadium']]],
  ],
  'data' => ['worlds' => $worldNames, 'jobs' => $GROUP_JOBS, 'items' => $pick($quizItems, ['k', 'w', 'n', 'u', 't', 'g', 'nd'])],
  'key' => 'atlas.odd', 'done' => 'odd',
  'learn' => ['Spot the picture that does not belong: a place from another world, or a building with a different job.', 'Comparing cities and what buildings are for'],
]);

// The first screen of a game: a button for each way to play, with two pictures. The game's script reads data-mode.
function game_modes($modes, $art = '') {
  $out = '';
  foreach ($modes as [$m, $title, $text, $pics]) {
    $a = '';
    foreach ($pics as [$w, $s]) $a .= '<span class="world-' . $w . '">' . thumb_img(thumb($w, $s), '', '') . '</span>';
    $out .= '<li><button type="button" class="qmode" data-mode="' . $m . '"><span class="qmode-art' . $art . '" aria-hidden="true">' . $a . '</span><span class="qmode-title">' . h($title) . '</span><span class="what">' . h($text) . '</span><span class="qbest" data-best="' . $m . '"></span></button></li>';
  }
  return $out;
}

// Below every game: how to play it, what it teaches, and three other games (different ones on each page).
function game_extras($self, $how, $learn, $howTitle = 'How to play', $learnTitle = 'What you learn') {
  $games = [
    '/play/city-builder/' => ['Build your own city', 'Mix buildings from six worlds.'],
    '/play/world-sort/' => ['World sort', 'Send each picture home, against the clock.'],
    '/play/shadows/' => ['Shadow match', 'Whose shadow is it?'],
    '/play/zoom/' => ['Zoom detective', 'Name it from a close-up.'],
    '/play/odd-one-out/' => ['Odd one out', 'Which picture does not belong?'],
    '/play/puzzle/' => ['Picture puzzle', 'Swap the pieces back into place.'],
    '/play/quiz/' => ['City quiz', 'Five quizzes with pictures.'],
    '/play/map-hunt/' => ['Map hunt', 'Find places on a map from clues.'],
    '/play/memory/' => ['Memory match', 'Turn over cards and find the pairs.'],
    '/play/word-search/' => ['Word search', 'Ten hidden city words.'],
  ];
  $keys = array_keys($games);
  $at = array_search($self, $keys);
  $more = '';
  for ($k = 1; $k <= 3; $k++) {
    $href = $keys[(($at === false ? -1 : $at) + $k) % count($keys)];
    $more .= '<li><a href="' . $href . '"><strong>' . h($games[$href][0]) . '</strong><span>' . h($games[$href][1]) . '</span></a></li>';
  }
  return '<section class="wrap section game-about" aria-labelledby="how-h"><div class="game-about-grid">'
    . '<div><h2 id="how-h">' . h($howTitle) . '</h2><p>' . h($how) . '</p></div>'
    . '<div><h2>' . h($learnTitle) . '</h2><p>' . h($learn) . '</p></div></div>'
    . '<h2 class="more-games-h">More games</h2><ul class="more-games">' . $more . '</ul>'
    . '<p><a class="btn btn-quiet" href="/play/">See all the games</a></p></section>';
}

// ---------- World sort: send pictures to their worlds before the minute is up (public/js/sort.js) ----------
$sortItems = [];
foreach ($quizItems as $it) if ($it['t']) $sortItems[] = ['w' => $it['w'], 'n' => $it['n'], 't' => $it['t'], 'u' => $it['u']];
foreach ($quizPeople as $p) if ($p['t']) $sortItems[] = ['w' => $p['w'], 'n' => $p['n'], 't' => $p['t'], 'u' => $p['u']];
$sortData = json_encode(['worlds' => $worldNames, 'items' => $sortItems], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$sortModes = game_modes([
  ['world', 'Which world?', 'Six worlds, one minute. Send each picture home to its world.', [['egypt', 'pyramid'], ['future', 'hover-car']]],
  ['time', 'Long ago, today or imagined?', 'Is it from long ago, from today, from a possible future, or from an imagined world?', [['roman', 'chariot'], ['green', 'mushroom-cottage']]],
]);
$sortExtras = game_extras('/play/world-sort/', 'A picture pops up: tap the world it belongs to, or in the second game, whether it is from long ago, today, a possible future or an imagined world. Sort as many as you can in one minute. On a keyboard, the number keys work too.',
  'Telling history, today, the future and imagined worlds apart, by looking closely at buildings, people and vehicles.');
page('/play/world-sort/', [
  'title' => 'World sort: a speed game about six city worlds',
  'desc' => h('A free speed game for kids: sort buildings, people and vehicles into the right world, or into long ago, today and imagined, before time runs out.'),
  'class' => 'play sort-page',
  'js' => ['sort'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">World sort</li></ol></nav>
</div>
<section class="wrap section quiz sorter" data-sort aria-labelledby="sort-h">
  <h1 id="sort-h">World sort</h1>
  <div class="sort-start">
    <p class="lead">Pictures pop up one at a time. Tap where each one belongs, as fast as you can, before the minute is up. Choose a game:</p>
    <ul class="qmodes">{$sortModes}</ul>
  </div>
  <div class="sort-play quiz-play" hidden>
    <div class="q-top"><p class="sort-time"></p><p class="sort-score"></p></div>
    <div class="q-bar sort-bar" aria-hidden="true"><span></span></div>
    <div class="sort-stage"><figure class="sort-card"></figure><p class="sort-streak" aria-hidden="true"></p></div>
    <p class="sort-say sr-only" aria-live="polite"></p>
    <div class="sort-bins" role="group" aria-label="Where does it belong?"></div>
    <p class="sort-tip">On a keyboard, press the number on a button.</p>
  </div>
  <div class="sort-end quiz-end" hidden>
    <h2 class="q-result" tabindex="-1"></h2>
    <p class="q-msg"></p>
    <p><button type="button" class="btn sort-again">Play again</button> <button type="button" class="btn btn-quiet sort-other">Choose another game</button></p>
    <div class="sort-missed-box"><h3>Take another look</h3><ul class="q-review sort-missed"></ul></div>
  </div>
  <noscript><p class="setting-note">World sort needs JavaScript. You can still explore every building from the <a href="/">home page</a>.</p></noscript>
</section>
{$sortExtras}
<script type="application/json" id="sort-data">{$sortData}</script>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['World sort', '/play/world-sort/']]),
    learning('World sort', 'A speed game: sort buildings, people and vehicles into six illustrated city worlds, or into long ago, today, a possible future and imagined worlds.', '/play/world-sort/', 'Telling history, today, the future and imagined worlds apart')],
]);

// ---------- Picture puzzle: put a mixed-up picture back together (public/js/puzzle.js) ----------
// Two pictures from every world. The script paints each one over its world's horizon.
const PUZZLE_PICTURES = [['egypt', 'pyramid'], ['egypt', 'pharaohs-palace'], ['roman', 'amphitheater'], ['roman', 'pantheon'],
  ['modern', 'public-library'], ['modern', 'stadium'], ['green', 'treetop-village'], ['green', 'mushroom-cottage'],
  ['future', 'greenhouse-dome'], ['future', 'spaceport'], ['heaven', 'palace-of-light'], ['heaven', 'tree-of-life']];
$puzData = [];
$puzPicks = '';
foreach (PUZZLE_PICTURES as [$w, $s]) {
  $r = $WORLD_DATA[$w]['pages'][$s] ?? null;
  if (!$r) { fwrite(STDERR, "puzzle: unknown page $w/$s\n"); continue; }
  $puzPicks .= '<li><button type="button" class="pz-pick world-' . $w . '" data-pic="' . count($puzData) . '">' . thumb_img(thumb($w, $s)) . '<span class="pz-pick-name">' . h($r['name']) . '</span><span class="what">' . h($WORLDS[$w]['name']) . '</span><span class="qbest" data-best="' . "$w/$s" . '"></span></button></li>';
  $puzData[] = ['k' => "$w/$s", 'w' => $w, 'n' => $r['name'], 'u' => "/worlds/$w/$s/", 'b' => "/assets/worlds/$w/$s-960.webp", 'h' => "/assets/worlds/$w/horizon-1600.webp"];
}
$puzJson = json_encode($puzData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$puzExtras = game_extras('/play/puzzle/', 'Choose 9, 16 or 25 pieces, then a picture. Tap two pieces to swap them, or drag one onto another. A piece in the right place locks, and Peek shows the whole picture for a moment.',
  'Seeing how parts make a whole, planning ahead and patience, with a close look at a landmark from each world.');
page('/play/puzzle/', [
  'title' => 'Picture puzzle: put a city picture back together',
  'desc' => h('A free picture puzzle for kids: swap the pieces of a building from ancient Egypt, Rome, a modern town, a green forest city, Mars or a heavenly city.'),
  'class' => 'play puzzle-page',
  'js' => ['puzzle'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Picture puzzle</li></ol></nav>
</div>
<section class="wrap section quiz puzzle" data-puzzle aria-labelledby="pz-h">
  <h1 id="pz-h">Picture puzzle</h1>
  <div class="pz-start">
    <p class="lead">Choose how many pieces, then a picture. The pieces get mixed up: tap two pieces to swap them, or drag one onto another, until the picture is whole again.</p>
    <div class="chips pz-sizes" role="group" aria-label="How many pieces"><button type="button" class="chip" data-size="3" aria-pressed="true">Easy: 9 pieces</button><button type="button" class="chip" data-size="4" aria-pressed="false">Medium: 16 pieces</button><button type="button" class="chip" data-size="5" aria-pressed="false">Hard: 25 pieces</button></div>
    <ul class="pz-picks">{$puzPicks}</ul>
  </div>
  <div class="pz-play quiz-play" hidden>
    <div class="q-top"><p class="pz-name"></p><p class="pz-moves"></p></div>
    <div class="pz-stage">
      <div class="pz-board" role="group" aria-label="Puzzle pieces. Use the arrow keys to move between pieces, and Enter to pick one up or swap it."></div>
      <div class="pz-peek" hidden></div>
    </div>
    <p class="pz-say" aria-live="polite"></p>
    <p class="pz-actions"><button type="button" class="btn btn-quiet pz-peek-btn" aria-pressed="false">Peek at the picture</button> <button type="button" class="btn btn-quiet pz-other">Choose another picture</button></p>
    <div class="pz-won" hidden>
      <p class="pz-won-msg"></p>
      <p><button type="button" class="btn pz-again">Mix it up again</button> <a class="btn btn-quiet pz-read" href="/">Read about it</a></p>
    </div>
  </div>
  <noscript><p class="setting-note">The picture puzzle needs JavaScript. You can still explore every building from the <a href="/">home page</a>.</p></noscript>
</section>
{$puzExtras}
<script type="application/json" id="puzzle-data">{$puzJson}</script>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Picture puzzle', '/play/puzzle/']]),
    learning('Picture puzzle', 'A picture puzzle: swap the pieces to rebuild a building from one of six illustrated city worlds.', '/play/puzzle/', 'Visual reasoning and city buildings')],
]);

// ---------- Passport ----------
$pp = '';
$ppTotal = 0;
foreach (WORLD_ORDER as $w) {
  $li = '';
  foreach ($WORLD_DATA[$w]['pages'] as $slug => $r) {
    $li .= '<li data-pp="' . "$w/$slug" . '"><a href="/worlds/' . $w . '/' . $slug . '/"><span class="pp-art">' . thumb_img(thumb($w, $slug)) . '</span><span class="pp-name">' . h($r['name']) . '</span></a></li>';
  }
  $n = count($WORLD_DATA[$w]['pages']);
  $ppTotal += $n;
  $pp .= '<section class="pp-world world-' . $w . '" data-world="' . $w . '" aria-labelledby="pp-' . $w . '">'
    . '<div class="pp-head"><p class="pp-stamp" aria-hidden="true"><span class="pp-n">0</span><span class="pp-of">of ' . $n . '</span></p>'
    . '<div><h2 id="pp-' . $w . '"><a href="/worlds/' . $w . '/">' . h($WORLDS[$w]['name']) . '</a></h2><p class="pp-line"><span class="pp-count">0</span> of ' . $n . ' places visited</p><div class="pp-bar" aria-hidden="true"><span></span></div></div></div>'
    . '<ul class="pp-grid">' . $li . '</ul></section>';
}
$ppExtras = game_extras('', 'Every place or vehicle page you open adds a stamp to your passport. Badges come from exploring every world and from playing the games.',
  'Nothing is sent anywhere: your stamps and badges are kept only in this browser, on this device.', 'How it works', 'Private by design');
page('/play/passport/', [
  'title' => 'Your city passport: collect a stamp for every place',
  'desc' => h("Collect a stamp for each of the $ppTotal places and vehicles you visit in six city worlds, and earn badges. Stamps stay on your own device."),
  'class' => 'play passport-page',
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Passport</li></ol></nav>
</div>
<section class="wrap section page-head">
  <h1>Your city passport</h1>
  <p class="lead">Every place you open gets a stamp. Gray ones are still waiting for you.</p>
  <p class="pp-total"><strong>0</strong> of {$ppTotal} stamps collected</p>
</section>
<section class="wrap pp-badges" aria-labelledby="badges-h">
  <h2 id="badges-h">Badges</h2>
  <p class="pp-line">Earn badges by exploring and playing the games.</p>
  <ul class="badges" data-badges></ul>
</section>
<div class="wrap pp-all">{$pp}</div>
<section class="wrap section pp-foot">
  <p>Stamps, badges, scores and your saved city stay only in this browser, on this device. Nobody else can see them.</p>
  <p><button type="button" class="btn btn-quiet pp-clear" hidden>Clear all my saved progress</button></p>
</section>
<noscript><style>.pp-grid img { filter: none; opacity: 1; }</style><p class="wrap setting-note">Passport stamps need JavaScript, but every place is still listed here.</p></noscript>
{$ppExtras}
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Passport', '/play/passport/']])],
]);

// ---------- Word search: puzzles made from the key words on every page ----------
// Words read across, down or diagonally (never backwards), so younger players can find them.
// The same puzzles are used by the game (/play/word-search/) and the printable worksheets.
function ws_make($entries, $seed, $size = 12, $count = 10) {
  mt_srand($seed);
  $dirs = [[0, 1], [1, 0], [1, 1], [-1, 1]];
  $grid = array_fill(0, $size, array_fill(0, $size, ''));
  for ($i = count($entries) - 1; $i > 0; $i--) { $j = mt_rand(0, $i); [$entries[$i], $entries[$j]] = [$entries[$j], $entries[$i]]; }
  $placed = [];
  foreach ($entries as $e) {
    if (count($placed) >= $count) break;
    $word = strtoupper($e['t']);
    $len = strlen($word);
    if (isset($placed[$word])) continue;
    for ($try = 0; $try < 200; $try++) {
      [$dr, $dc] = $dirs[mt_rand(0, 3)];
      $r = mt_rand(0, $size - 1);
      $c = mt_rand(0, $size - 1);
      $er = $r + $dr * ($len - 1);
      if ($er < 0 || $er >= $size || $c + $dc * ($len - 1) >= $size) continue;
      $ok = true;
      for ($i = 0; $i < $len; $i++) { $ch = $grid[$r + $dr * $i][$c + $dc * $i]; if ($ch !== '' && $ch !== $word[$i]) { $ok = false; break; } }
      if (!$ok) continue;
      for ($i = 0; $i < $len; $i++) $grid[$r + $dr * $i][$c + $dc * $i] = $word[$i];
      $placed[$word] = [$word, $r, $c, $dr, $dc, $e['d'], $e['u'], $e['w']];
      break;
    }
  }
  $abc = 'ABCDEFGHIKLMNOPRSTUVWY';
  foreach ($grid as &$row) foreach ($row as &$ch) if ($ch === '') $ch = $abc[mt_rand(0, strlen($abc) - 1)];
  unset($row, $ch);
  return ['g' => array_map('implode', $grid), 'w' => array_values($placed)];
}
// Six puzzles for each world and six with words from all of them: one-word key words of 4 to 10 letters.
$wsWords = ['all' => []];
foreach ($quizWords as $e) {
  if (!preg_match('/^[A-Za-z]{4,10}$/', $e['t'])) continue;
  $wsWords[$e['w']][] = $e;
  $wsWords['all'][] = $e;
}
$WS_PUZZLES = [];
foreach (array_merge(WORLD_ORDER, ['all']) as $key) for ($n = 0; $n < 6; $n++) $WS_PUZZLES[$key][] = ws_make($wsWords[$key], crc32("$key-$n"));
$wsData = json_encode(['worlds' => array_map(fn($W) => $W['name'], $WORLDS), 'p' => $WS_PUZZLES], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$wsChips = '';
foreach (array_merge(WORLD_ORDER, ['all']) as $n => $key) {
  $wsChips .= '<button type="button" class="chip' . ($key === 'all' ? '' : ' world-' . $key) . '" data-set="' . $key . '" aria-pressed="' . ($n ? 'false' : 'true') . '">' . ($key === 'all' ? 'All worlds' : h($WORLDS[$key]['short'])) . '</button>';
}
$wsExtras = game_extras('/play/word-search/', 'Find the ten hidden words. They read across, down or diagonally, never backwards. Tap the first letter of a word, then the last, or drag across it. Each word you find shows what it means.',
  'The key words of city life in six worlds, with a short meaning for every one.');
page('/play/word-search/', [
  'title' => 'City word search: find hidden words from six city worlds',
  'desc' => h('Free city word searches: find ten hidden words about the buildings and life of six city worlds, then learn what each one means. Print them too.'),
  'class' => 'play wsearch-page',
  'js' => ['wordsearch'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Word search</li></ol></nav>
</div>
<section class="wrap section wsearch" data-wsearch aria-labelledby="ws-h">
  <h1 id="ws-h">Word search</h1>
  <p class="lead">Find ten hidden city words. They read across, down or diagonally. Tap the first letter, then the last.</p>
  <div class="ws-bar">
    <div class="chips" role="group" aria-label="Words from">{$wsChips}</div>
    <p class="ws-actions"><button type="button" class="ctrl" data-ws="new">New puzzle</button> <button type="button" class="ctrl" data-ws="print">Print</button></p>
  </div>
  <div class="ws-play">
    <div class="ws-grid" role="grid" aria-label="Letter grid. Use the arrow keys to move and Enter to pick the first and last letter of a word."></div>
    <div class="ws-side">
      <p class="ws-count" aria-live="polite"></p>
      <ol class="ws-words"></ol>
    </div>
  </div>
  <noscript><p class="setting-note">The word search needs JavaScript. Printable word searches with answer keys are on the <a href="/teachers/worksheets/">worksheets page</a>.</p></noscript>
</section>
<script type="application/json" id="ws-data">{$wsData}</script>
{$wsExtras}
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Word search', '/play/word-search/']]),
    learning('City word search', 'Word searches with key words about buildings and city systems in six worlds.', '/play/word-search/', 'City vocabulary')],
]);

// ---------- Memory match ----------
$memItems = array_map(fn($it) => ['k' => $it['k'], 'w' => $it['w'], 'n' => $it['n'], 't' => $it['t'], 'g' => $it['g']], $quizItems);
$memData = json_encode(['worlds' => array_map(fn($W) => $W['name'], $WORLDS), 'jobs' => $GROUP_JOBS, 'items' => $memItems], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$memModes = game_modes([
  ['job', 'Same job, two worlds', 'Match buildings that do the same job in different worlds.', [['roman', 'aqueduct'], ['future', 'water-recycler']]],
  ['name', 'Picture and name', 'Match each picture with its name.', [['green', 'treetop-village'], ['modern', 'stadium']]],
]);
$memExtras = game_extras('/play/memory/', 'Turn over two cards at a time. If they make a pair, they stay face up; if not, they turn back. Find all six pairs in as few moves as you can.',
  'Buildings that do the same job in different worlds, and the names of the places in each city.');
page('/play/memory/', [
  'title' => 'Memory match: city buildings from six worlds',
  'desc' => h('A free memory game: turn over cards to match buildings that do the same job in different worlds, or match each picture with its name.'),
  'class' => 'play memory-page',
  'js' => ['memory'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Memory match</li></ol></nav>
</div>
<section class="wrap section memory" data-memory aria-labelledby="mem-h">
  <h1 id="mem-h">Memory match</h1>
  <div class="mem-start">
    <p class="lead">Turn over two cards at a time and find all six pairs. Choose a game:</p>
    <ul class="qmodes mem-modes">{$memModes}</ul>
  </div>
  <div class="mem-play" hidden>
    <div class="q-top"><p class="mem-pairs"></p><p class="mem-moves"></p></div>
    <ul class="mem-grid"></ul>
    <p class="mem-status" aria-live="polite"></p>
    <p class="mem-actions"><button type="button" class="btn mem-again">New game</button> <button type="button" class="btn btn-quiet mem-other">Choose another game</button></p>
  </div>
  <noscript><p class="setting-note">Memory match needs JavaScript. You can still explore every building from the <a href="/">home page</a>.</p></noscript>
</section>
<script type="application/json" id="memory-data">{$memData}</script>
{$memExtras}
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Memory match', '/play/memory/']]),
    learning('Memory match', 'A card game: match buildings that do the same job in six city worlds.', '/play/memory/', 'Comparing cities')],
]);

// ---------- Map hunt (the game runs on each world's map: /worlds/{world}/#hunt) ----------
$huntCards = '';
foreach (WORLD_ORDER as $w) {
  $W = $WORLDS[$w];
  $huntCards .= '<li class="play-card world-' . $w . '"><a href="/worlds/' . $w . '/#hunt"><span class="pa pa-world"><span class="pa-sky">' . img($w, 'horizon', '', '(min-width: 900px) 360px, 90vw', 'loading="lazy"') . '</span>'
    . '<span class="pa-big">' . thumb_img(thumb($w, $W['card'])) . '</span></span>'
    . '<span class="play-text"><span class="play-title">' . h($W['name']) . '</span><span class="what">' . h($W['type']) . '</span><span class="play-go">Start the hunt <span aria-hidden="true">&rarr;</span></span></span></a></li>';
}
$huntExtras = game_extras('/play/map-hunt/', 'Pick a city. Above its map, press Map hunt, then read each clue and tap the place it describes. Eight clues make a round.',
  'Reading a map, and what each building is for.');
page('/play/map-hunt/', [
  'title' => 'Map hunt: find places on six illustrated city maps',
  'desc' => h('A free map game: read a clue about a building, then find it on an illustrated city map of ancient Egypt, Rome, a modern town and more.'),
  'class' => 'play',
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Map hunt</li></ol></nav>
</div>
<section class="wrap section page-head">
  <h1>Map hunt</h1>
  <p class="lead">Read a clue, then find the place on the city map. Eight clues a round. Pick a city:</p>
  <ul class="play-cards hunt-cards">{$huntCards}</ul>
</section>
{$huntExtras}
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Map hunt', '/play/map-hunt/']]),
    learning('Map hunt', 'Read clues about city buildings and find them on illustrated city maps.', '/play/map-hunt/', 'Map reading and city buildings')],
]);
