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

// ---------- Cards for the activities (play hub and home page) ----------
function play_cards() {
  global $WORLD_DATA;
  $total = 0;
  foreach ($WORLD_DATA as $D) $total += count($D['pages']);
  $b = '';
  foreach ([['modern', 'residential-tower', 0, 0], ['roman', 'pantheon', 1, 0], ['elven', 'treetop-village', 0, 1], ['future', 'greenhouse-dome', 1, 1]] as [$w, $s, $i, $j]) {
    $b .= '<span class="pa-tile" style="--i:' . $i . ';--j:' . $j . '">' . thumb_img(thumb($w, $s)) . '</span>';
  }
  $stamps = '';
  foreach (WORLD_ORDER as $w) $stamps .= '<span class="pa-stamp world-' . $w . '">' . thumb_img(thumb($w, 'people-1')) . '</span>';
  // A small letter grid with one word found.
  $letters = '';
  foreach (['KDOMEP', 'WATERS', 'LBRIGT', 'ARCHVN', 'NSQUAY'] as $r => $row) {
    foreach (str_split($row) as $c => $ch) $letters .= '<span' . ($r === 1 && $c < 5 ? ' class="on"' : '') . '>' . $ch . '</span>';
  }
  $cards = [
    ['/play/city-builder/', 'Build your own city', 'Mix buildings from all four worlds, then try the seven challenges.', 'Start building', '<span class="pa pa-build" aria-hidden="true"><span class="pa-ground"></span>' . $b . '</span>'],
    ['/play/quiz/', 'City quiz', 'Five quizzes: buildings, worlds, jobs, key words and people.', 'Take the quiz', '<span class="pa pa-quiz" aria-hidden="true">' . thumb_img(thumb('roman', 'aqueduct')) . '<span class="pa-q">?</span><span class="pa-opts"><span></span><span></span><span></span></span></span>'],
    ['/play/map-hunt/', 'Map hunt', 'Read a clue, then find the place on a city map.', 'Start hunting', '<span class="pa pa-hunt" aria-hidden="true"><span class="pa-lens">' . thumb_img(thumb('elven', 'treetop-village')) . '</span><span class="pa-handle"></span></span>'],
    ['/play/memory/', 'Memory match', 'Turn over two cards at a time and find the pairs that go together.', 'Play memory', '<span class="pa pa-mem" aria-hidden="true"><span class="pa-card pa-card-back"><img src="/favicon.svg" width="44" height="44" alt=""></span><span class="pa-card">' . thumb_img(thumb('roman', 'aqueduct')) . '</span><span class="pa-card">' . thumb_img(thumb('future', 'water-recycler')) . '</span></span>'],
    ['/play/word-search/', 'Word search', 'Find ten hidden city words, then learn what they mean.', 'Find words', '<span class="pa pa-words" aria-hidden="true"><span class="pa-letters">' . $letters . '</span></span>'],
    ['/play/passport/', 'Your city passport', "Collect stamps and badges. Can you visit all $total places?", 'See your stamps', '<span class="pa pa-pass" aria-hidden="true">' . $stamps . '</span>'],
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
  'title' => 'Play and create: city games for students',
  'desc' => h('Free city games for students: build your own city, take five quizzes, hunt for places on a map, play memory match and word search, and collect passport stamps and badges. No sign-up.'),
  'class' => 'play',
  'body' => <<<HTML
<section class="wrap section page-head">
  <h1>Play and create</h1>
  <p class="lead">Six free games about how cities work. No sign-up, and nothing leaves your device.</p>
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
// Challenges for the city builder: [title, text, goals]. Goals: ['needs', n] needs met, ['only', world]
// every piece from one world, ['every', n] buildings from each world, ['max', n] buildings at most,
// ['nature', n] squares with trees, grass or green places, ['water', n] squares of water.
const CHALLENGES = [
  'roman-town'   => ['A Roman town', 'Use only pieces from Ancient Rome and meet all ten needs.', [['only', 'roman'], ['needs', 10]]],
  'mars-base'    => ['A base on Mars', 'Use only Robotic Future pieces and meet all ten needs.', [['only', 'future'], ['needs', 10]]],
  'small-village'=> ['A small village', 'Meet all ten needs with eight buildings or fewer. Trees and ground do not count.', [['needs', 10], ['max', 8]]],
  'green-city'   => ['A green city', 'Meet all ten needs and give nature at least ten squares.', [['needs', 10], ['nature', 10]]],
  'waterfront'   => ['A waterfront city', 'Add at least four squares of water and meet all ten needs.', [['water', 4], ['needs', 10]]],
  'time-travel'  => ['Time travel town', 'Use at least two buildings from every world and meet all ten needs.', [['every', 2], ['needs', 10]]],
  'forest-city'  => ['An elven forest city', 'Use only Elven pieces. Which need is hardest? Try to meet nine.', [['only', 'elven'], ['needs', 9]]],
];
$chalChips = '';
foreach (CHALLENGES as $id => [$ct]) $chalChips .= '<button type="button" class="chip chal-chip" data-chal="' . $id . '" aria-pressed="false">' . h($ct) . '</button>';
$chalData = json_encode(array_map(fn($c) => ['t' => $c[0], 'd' => $c[1], 'g' => $c[2]], CHALLENGES), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP);
$chalCount = count(CHALLENGES);
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
  <p class="lead">Pick a building, then tap a square. Mix all four worlds, meet every need, then try the challenges.</p>
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
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['City builder', '/play/city-builder/']]),
    learning('Build your own city', 'An online city builder: place buildings from four illustrated worlds and check that the city meets every need.', '/play/city-builder/', 'City planning and what a city needs')],
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
$quizData = json_encode(['worlds' => array_map(fn($W) => [$W['name'], $W['short']], $WORLDS), 'jobs' => $GROUP_JOBS, 'items' => $quizItems, 'words' => $quizWords, 'people' => $quizPeople],
  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$modes = '';
foreach ([
  ['name', 'Name that building', 'Look at the picture and pick its name.', [['roman', 'pantheon'], ['modern', 'public-library']]],
  ['world', 'Which world?', 'Is it from Rome, the modern town, the elven world or the future?', [['elven', 'treehouse-school'], ['future', 'radio-telescope']]],
  ['job', 'Same job, different world', 'Find the building that does the same job in another world.', [['roman', 'aqueduct'], ['future', 'water-recycler']]],
  ['words', 'Key words', 'Read the meaning and pick the right word.', [['roman', 'library'], ['elven', 'tree-library']]],
  ['people', 'Who works here?', 'Meet a person and find the place where they work or live.', [['modern', 'worker-1'], ['future', 'people-2']]],
] as [$m, $title, $text, $pics]) {
  $art = '';
  foreach ($pics as [$w, $s]) $art .= '<span class="world-' . $w . '">' . thumb_img(thumb($w, $s), '', '') . '</span>';
  $modes .= '<li><button type="button" class="qmode" data-mode="' . $m . '"><span class="qmode-art" aria-hidden="true">' . $art . '</span><span class="qmode-title">' . h($title) . '</span><span class="what">' . h($text) . '</span><span class="qbest" data-best="' . $m . '"></span></button></li>';
}
page('/play/quiz/', [
  'title' => 'City quiz: picture questions about four city worlds',
  'desc' => h('A free picture quiz for students in five parts: name the building, guess its world, match buildings that do the same job, learn key words and find where people work, in ancient Rome, a modern town, an elven world and on Mars.'),
  'class' => 'play quiz-page',
  'js' => ['quiz'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">City quiz</li></ol></nav>
</div>
<section class="wrap section quiz" data-quiz aria-labelledby="quiz-h">
  <h1 id="quiz-h">City quiz</h1>
  <div class="quiz-start">
    <p class="lead">Ten questions each. Choose a quiz:</p>
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
// Six puzzles for each world and six with words from all four: one-word key words of 4 to 10 letters.
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
page('/play/word-search/', [
  'title' => 'City word search: find hidden words from four city worlds',
  'desc' => h('A free online word search for students with key words from ancient Rome, a modern town, an elven forest city and a Mars settlement. Find each word, then learn what it means. Printable.'),
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
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Word search', '/play/word-search/']]),
    learning('City word search', 'Word searches with key words about buildings and city systems in four worlds.', '/play/word-search/', 'City vocabulary')],
]);

// ---------- Memory match ----------
$memItems = array_map(fn($it) => ['k' => $it['k'], 'w' => $it['w'], 'n' => $it['n'], 't' => $it['t'], 'g' => $it['g']], $quizItems);
$memData = json_encode(['worlds' => array_map(fn($W) => $W['name'], $WORLDS), 'jobs' => $GROUP_JOBS, 'items' => $memItems], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$memModes = '';
foreach ([
  ['job', 'Same job, two worlds', 'Match buildings that do the same job in different worlds.', [['roman', 'aqueduct'], ['future', 'water-recycler']]],
  ['name', 'Picture and name', 'Match each picture with its name.', [['elven', 'treetop-village'], ['modern', 'stadium']]],
] as [$m, $title, $text, $pics]) {
  $art = '';
  foreach ($pics as [$w, $s]) $art .= '<span class="world-' . $w . '">' . thumb_img(thumb($w, $s), '', '') . '</span>';
  $memModes .= '<li><button type="button" class="qmode" data-mode="' . $m . '"><span class="qmode-art" aria-hidden="true">' . $art . '</span><span class="qmode-title">' . h($title) . '</span><span class="what">' . h($text) . '</span><span class="qbest" data-best="' . $m . '"></span></button></li>';
}
page('/play/memory/', [
  'title' => 'Memory match: city buildings from four worlds',
  'desc' => h('A free memory card game for students: turn over cards to match buildings that do the same job in ancient Rome, a modern town, an elven world and on Mars, or match pictures with names.'),
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
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Memory match', '/play/memory/']]),
    learning('Memory match', 'A card game: match buildings that do the same job in four city worlds.', '/play/memory/', 'Comparing cities')],
]);

// ---------- Map hunt (the game runs on each world's map: /worlds/{world}/#hunt) ----------
$huntCards = '';
foreach (WORLD_ORDER as $w) {
  $W = $WORLDS[$w];
  $huntCards .= '<li class="play-card world-' . $w . '"><a href="/worlds/' . $w . '/#hunt"><span class="pa pa-world"><span class="pa-sky">' . img($w, 'horizon', '', '(min-width: 900px) 360px, 90vw', 'loading="lazy"') . '</span>'
    . '<span class="pa-big">' . thumb_img(thumb($w, $W['card'])) . '</span></span>'
    . '<span class="play-text"><span class="play-title">' . h($W['name']) . '</span><span class="what">' . h($W['type']) . '</span><span class="play-go">Start the hunt <span aria-hidden="true">&rarr;</span></span></span></a></li>';
}
page('/play/map-hunt/', [
  'title' => 'Map hunt: find places on four illustrated city maps',
  'desc' => h('A free map game for students: read a clue about a building, then find it on an illustrated city map of ancient Rome, a modern town, an elven forest city or a Mars settlement.'),
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
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Map hunt', '/play/map-hunt/']]),
    learning('Map hunt', 'Read clues about city buildings and find them on illustrated city maps.', '/play/map-hunt/', 'Map reading and city buildings')],
]);
