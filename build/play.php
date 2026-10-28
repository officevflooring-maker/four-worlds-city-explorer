<?php
// Play and create: site search (/search/ and /data/search.json), the play hub (/play/), the city
// builder, the picture quiz and the passport. Included from build.php after the world, teacher and
// tour pages, because it uses their data, and before home.php. Everything runs in the browser, and
// anything a visitor makes or collects is kept only in their own browser.

const WORLD_LETTER = ['roman' => 'r', 'modern' => 'm', 'elven' => 'e', 'future' => 'f'];
// Pages whose picture is a ground texture, not a building, so they are not builder or quiz pieces.
const NOT_PIECES = ['modern/water-system', 'modern/streets-crosswalks'];

// What every city needs, for the city builder checklist and the quiz. Each need lists the cross-link
// groups that meet it (build/crosslinks.php) and single pages that also meet it.
$NEEDS = [
  'water'  => ['Water', ['water'], []],
  'homes'  => ['Homes', ['houses', 'flats', 'homes-tech', 'palaces'], ['elven/tree-tower-home', 'elven/mushroom-cottage', 'elven/leafy-cottage', 'modern/mixed-use-building', 'future/tree-pod-habitat']],
  'food'   => ['Food', ['food'], ['roman/street-food', 'modern/corner-store', 'elven/canopy-market', 'elven/market-hall']],
  'health' => ['Health', ['health', 'fitness'], []],
  'learn'  => ['Learning', ['schools', 'books', 'science'], ['modern/cultural-center']],
  'lead'   => ['Leaders', ['government'], ['roman/forum', 'roman/treasury', 'future/mission-control']],
  'meet'   => ['Places to meet', ['squares', 'shows', 'worship'], ['modern/community-center', 'modern/cultural-center', 'elven/great-tree-hall']],
  'work'   => ['Work and shops', ['shops', 'making', 'storage'], ['modern/office-building', 'modern/skyscraper']],
  'safety' => ['Safety', ['safety'], []],
  'nature' => ['Nature', ['nature'], ['roman/olive-grove', 'elven/flower-meadow', 'modern/community-garden', 'future/greenhouse-dome']],
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
  'materials' => 'supply materials for building', 'worship' => 'are places of worship', 'palaces' => 'are homes for rulers',
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
  $SEARCH[] = [$PEOPLE_INTRO[$w][0], "/worlds/$w/people/", 'People', $w, thumb($w, 'people-1'), 'Meet the people who live and work in the city.', 'people jobs who lives'];
  foreach ($WORLD_DATA[$w]['pages'] as $slug => $r) {
    $kw = $WORLD_DATA[$w]['cats'][$r['cat']][0] . ' ' . ($r['latin'] ?? '') . ' ' . implode(' ', array_keys($r['words']));
    $SEARCH[] = [$r['name'], "/worlds/$w/$slug/", empty($r['vehicle']) ? 'Place' : 'Vehicle', $w, thumb($w, $slug), $r['summary'], $kw];
  }
  foreach ($PEOPLE[$w] as $file => [$pname, $role, $text]) {
    $SEARCH[] = [$pname, "/worlds/$w/people/#$file", 'Person', $w, thumb($w, $file), $role, $text];
  }
}
foreach ($TOURS as $slug => $t) {
  $SEARCH[] = [$t['h1'] . ' tour', "/tours/$slug/", 'Tour', $t['world'], thumb($t['world'], $t['guide']), $t['theme'], 'guided tour walk ' . $t['desc']];
}
foreach ($TEACH as $slug => $g) {
  [$lw, $ls] = explode('/', $g['links'][0] ?? 'roman/aqueduct');
  $SEARCH[] = [$g['h1'], "/teachers/$slug/", 'Teacher guide', '', thumb($lw, $ls), $g['kind'] . ', grades ' . $g['grades'], $g['subjects'] . ' lesson teacher class ' . $g['desc']];
}
foreach ($COMPARE as [$key, $label, $question, $cells]) {
  $SEARCH[] = ["Compare: $label", "/compare/#$key", 'Compare', '', thumb('roman', $cells['roman'][0]) ?? thumb('modern', $cells['modern'][3] ?? ''), $question, 'compare four worlds'];
}
foreach ([
  ['Play and create', '/play/', 'Activity', 'Build a city, take the quiz and collect passport stamps.', 'games play fun'],
  ['Build your own city', '/play/city-builder/', 'Activity', 'Mix buildings from all four worlds and give your city everything it needs.', 'city builder game make design'],
  ['City quiz', '/play/quiz/', 'Activity', 'Ten picture questions about the four worlds.', 'quiz test game questions'],
  ['Your city passport', '/play/passport/', 'Activity', 'Collect a stamp for every place you open.', 'passport stamps visited progress'],
  ['Compare the worlds', '/compare/', 'Page', 'One question, four answers: water, gathering, travel, goods and nature.', 'compare'],
  ['Guided tours', '/tours/', 'Page', 'Short walks with a guide and a question at every stop.', 'tours'],
  ['Teachers and families', '/teachers/', 'Page', 'Free lessons, projects and explainers for every grade.', 'teachers lessons school class'],
  ['Artwork', '/artwork/', 'Page', 'View, save and print every illustration, free under CC BY 4.0.', 'art pictures images download print free'],
  ['About this project', '/about/', 'Page', 'What is real and what is imagined, privacy, accessibility and sources.', 'about privacy sources accessibility'],
  ['Support this project', '/support/', 'Page', 'Help keep the site free, with no ads.', 'donate patreon support'],
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
  'desc' => h("Search all $searchCount pages of The Atlas of Cities: buildings and vehicles in four city worlds, the people who live there, guided tours, teacher guides and activities."),
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

// ---------- Cards for the three activities (play hub and home page) ----------
function play_cards() {
  global $WORLD_DATA;
  $total = 0;
  foreach ($WORLD_DATA as $D) $total += count($D['pages']);
  $b = '';
  foreach ([['modern', 'residential-tower', 0, 0], ['roman', 'pantheon', 1, 0], ['elven', 'treetop-village', 0, 1], ['future', 'greenhouse-dome', 1, 1]] as [$w, $s, $i, $j]) {
    $b .= '<span class="pa-tile" style="--i:' . $i . ';--j:' . $j . '">' . thumb_img(thumb($w, $s)) . '</span>';
  }
  $q = thumb_img(thumb('roman', 'aqueduct'));
  $stamps = '';
  foreach (WORLD_ORDER as $w) $stamps .= '<span class="pa-stamp world-' . $w . '">' . thumb_img(thumb($w, 'people-1')) . '</span>';
  $cards = [
    ['/play/city-builder/', 'Build your own city', 'Mix buildings from all four worlds. Can your city meet every need?', 'Start building', '<span class="pa pa-build" aria-hidden="true"><span class="pa-ground"></span>' . $b . '</span>'],
    ['/play/quiz/', 'City quiz', 'Name the building, find its world and match buildings that do the same job.', 'Take the quiz', '<span class="pa pa-quiz" aria-hidden="true">' . $q . '<span class="pa-q">?</span><span class="pa-opts"><span></span><span></span><span></span></span></span>'],
    ['/play/passport/', 'Your city passport', "Collect a stamp for every place you open. Can you visit all $total?", 'See your stamps', '<span class="pa pa-pass" aria-hidden="true">' . $stamps . '</span>'],
  ];
  $out = '';
  foreach ($cards as [$href, $title, $text, $go, $art]) {
    $out .= '<li class="play-card"><a href="' . $href . '">' . $art . '<span class="play-text"><span class="play-title">' . h($title) . '</span><span class="what">' . h($text) . '</span><span class="play-go">' . h($go) . ' <span aria-hidden="true">&rarr;</span></span></span></a></li>';
  }
  return $out;
}

// ---------- Play hub ----------
$playCards = play_cards();
page('/play/', [
  'title' => 'Play and create: build a city, take the quiz, collect stamps',
  'desc' => h('Free city games for students: build your own city from four illustrated worlds, take a picture quiz and collect a passport stamp for every place you visit. No sign-up.'),
  'class' => 'play',
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Play and create</h1>
  <p class="lead">Build a city, test what you know and collect a stamp for every place you visit. No sign-up, and nothing leaves your device.</p>
  <ul class="play-cards">{$playCards}</ul>
</section>
<section class="wrap section next" aria-labelledby="more-h">
  <h2 id="more-h">More ways to explore</h2>
  <p><a class="btn" href="/tours/">Take a guided tour</a> <a class="btn btn-quiet" href="/compare/">Compare the worlds</a> <button type="button" class="btn btn-quiet" data-surprise hidden>Surprise me</button></p>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/']])],
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
$modernTex = tex('modern', 'ground-grass');
$modernRoad = tex('modern', 'ground-crossroads');
page('/play/city-builder/', [
  'title' => 'Build your own city: a free city builder for students',
  'desc' => h("A free online city builder for kids and classrooms. Place buildings from ancient Rome, a modern town, an elven forest city and a Mars settlement, and check that your city meets all $needCount needs."),
  'class' => 'play builder-page',
  'js' => ['builder'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">City builder</li></ol></nav>
</div>
<section class="wrap builder-head">
  <h1>Build your own city</h1>
  <p class="lead">Pick a building, then tap a square. Mix all four worlds. Can your city meet every need?</p>
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
  <div class="b-actions">
    <button type="button" class="btn" data-act="picture">Save picture</button>
    <button type="button" class="btn btn-quiet" data-act="link">Copy link</button>
    <button type="button" class="btn btn-quiet" data-act="print">Print</button>
  </div>
</div>
<noscript><p class="wrap setting-note">The city builder needs JavaScript. You can still explore every building from the <a href="/">home page</a>.</p></noscript>
<section class="wrap section b-think" aria-labelledby="think-h">
  <h2 id="think-h">Think about it</h2>
  <ul class="plain-points">
    <li>Who lives in your city? How do they get water, food and help when they are sick?</li>
    <li>Which world's buildings did you use most? Why?</li>
    <li>Your city is saved in this browser and in the page address, so you can share the link.</li>
  </ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['City builder', '/play/city-builder/']]),
    learning('Build your own city', 'An online city builder: place buildings from four illustrated worlds and check that the city meets every need.', '/play/city-builder/', 'City planning and what a city needs')],
]);

// ---------- Quiz ----------
$quizItems = [];
foreach ($WORLD_DATA as $w => $D) foreach ($D['pages'] as $slug => $r) {
  if (in_array("$w/$slug", NOT_PIECES)) continue;
  $quizItems[] = ['k' => "$w/$slug", 'w' => $w, 'n' => $r['name'], 'u' => "/worlds/$w/$slug/", 'i' => small_src($w, $slug), 't' => thumb($w, $slug)[0] ?? '',
    'd' => $r['summary'], 'g' => groups_of("$w/$slug"), 'nd' => needs_of("$w/$slug")];
}
$quizData = json_encode(['worlds' => array_map(fn($W) => [$W['name'], $W['short']], $WORLDS), 'jobs' => $GROUP_JOBS, 'items' => $quizItems],
  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$modes = '';
foreach ([
  ['name', 'Name that building', 'Look at the picture and pick its name.', [['roman', 'pantheon'], ['modern', 'public-library']]],
  ['world', 'Which world?', 'Is it from Rome, the modern town, the elven world or the future?', [['elven', 'treehouse-school'], ['future', 'radio-telescope']]],
  ['job', 'Same job, different world', 'Find the building that does the same job in another world.', [['roman', 'aqueduct'], ['future', 'water-recycler']]],
] as [$m, $title, $text, $pics]) {
  $art = '';
  foreach ($pics as [$w, $s]) $art .= '<span class="world-' . $w . '">' . thumb_img(thumb($w, $s), '', '') . '</span>';
  $modes .= '<li><button type="button" class="qmode" data-mode="' . $m . '"><span class="qmode-art" aria-hidden="true">' . $art . '</span><span class="qmode-title">' . h($title) . '</span><span class="what">' . h($text) . '</span><span class="qbest" data-best="' . $m . '"></span></button></li>';
}
page('/play/quiz/', [
  'title' => 'City quiz: picture questions about four city worlds',
  'desc' => h('A free picture quiz for students: name the building, guess which world it comes from, and match buildings that do the same job in ancient Rome, a modern town, an elven world and a Mars settlement.'),
  'class' => 'play quiz-page',
  'js' => ['quiz'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">City quiz</li></ol></nav>
</div>
<section class="wrap section quiz" data-quiz aria-labelledby="quiz-h">
  <h1 id="quiz-h">City quiz</h1>
  <div class="quiz-start">
    <p class="lead">Ten picture questions. Choose a quiz:</p>
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
  <noscript><p class="setting-note">The quiz needs JavaScript. You can still explore every building from the <a href="/">home page</a>.</p></noscript>
</section>
<script type="application/json" id="quiz-data">{$quizData}</script>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['City quiz', '/play/quiz/']]),
    learning('City quiz', 'Picture questions about buildings in four illustrated city worlds.', '/play/quiz/', 'Cities, buildings and what they are for')],
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
page('/play/passport/', [
  'title' => 'Your city passport: collect a stamp for every place',
  'desc' => h("Collect a passport stamp for every one of the $ppTotal places and vehicles you visit in the four city worlds of The Atlas of Cities. Stamps stay on your own device."),
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
<div class="wrap pp-all">{$pp}</div>
<section class="wrap section pp-foot">
  <p>Stamps are saved only in this browser, on this device. Nobody else can see them.</p>
  <p><button type="button" class="btn btn-quiet pp-clear" hidden>Clear my passport</button></p>
</section>
<noscript><style>.pp-grid img { filter: none; opacity: 1; }</style><p class="wrap setting-note">Passport stamps need JavaScript, but every place is still listed here.</p></noscript>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Passport', '/play/passport/']])],
]);
