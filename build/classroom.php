<?php
// Classroom tools for teachers: printable worksheets with answer keys (/teachers/worksheets/), a
// glossary of every key word (/teachers/glossary/) and a bank of discussion questions
// (/teachers/question-bank/). Included from build.php after play.php, whose data it reuses
// (quiz items and key words, word search puzzles, the city needs and the jobs of building groups).

// Shuffles the same way on every build, so printed copies stay the same.
function seeded_shuffle($list, $seed) {
  mt_srand($seed);
  for ($i = count($list) - 1; $i > 0; $i--) { $j = mt_rand(0, $i); [$list[$i], $list[$j]] = [$list[$j], $list[$i]]; }
  return $list;
}
function name_words($name) {
  return array_filter(preg_split('/[^a-z]+/', strtolower(preg_replace('/\(.*?\)/', '', $name))), fn($w) => strlen($w) > 3);
}
// Six pairs of buildings that do the same job in two worlds; no picture fits a second pair.
function same_job_pairs($wa, $wb, $seed) {
  global $quizItems, $GROUP_JOBS;
  $pairs = [];
  $used = [];
  foreach (seeded_shuffle(array_keys($GROUP_JOBS), $seed) as $g) {
    if (count($pairs) >= 6) break;
    foreach ($quizItems as $a) {
      if ($a['w'] !== $wa || !in_array($g, $a['g'])) continue;
      foreach ($quizItems as $b) {
        if ($b['w'] !== $wb || !in_array($g, $b['g']) || array_intersect(name_words($a['n']), name_words($b['n']))) continue;
        $clash = false;
        foreach ($used as $u) if (array_intersect($u['g'], $a['g']) || array_intersect($u['g'], $b['g'])) $clash = true;
        if ($clash) continue;
        $pairs[] = [$a, $b, $GROUP_JOBS[$g]];
        $used[] = $a;
        $used[] = $b;
        continue 3;
      }
    }
  }
  return $pairs;
}
const SHEET_LETTERS = 'ABCDEFGHIJ';
$nameLine = '<div class="sheet-name"><span>Name: </span><span>Date: </span></div>';

// ---------- Worksheets ----------
// Each: [slug, kind, h1, title, description, grades, time, sheet HTML, answer key HTML or ''].
$SHEETS = [];
foreach (WORLD_ORDER as $w) {
  $W = $WORLDS[$w];
  // Vocabulary: ten words and their meanings, matched by letter.
  $pool = [];
  foreach ($quizWords as $e) if ($e['w'] === $w && strlen($e['d']) <= 80 && strlen($e['t']) <= 22) $pool[strtolower($e['t'])] ??= $e;
  $pick = array_slice(seeded_shuffle(array_values($pool), crc32("$w-vocab")), 0, 10);
  $order = seeded_shuffle(range(0, 9), crc32("$w-vocab-order"));
  $left = '';
  $right = '';
  $key = '';
  foreach ($pick as $n => $e) $left .= '<li><span class="blank"></span> ' . h($e['t']) . '</li>';
  foreach ($order as $pos => $n) $right .= '<li><b>' . SHEET_LETTERS[$pos] . '.</b> ' . h($pick[$n]['d']) . '</li>';
  foreach ($pick as $n => $e) $key .= '<li><b>' . SHEET_LETTERS[array_search($n, $order)] . '</b> ' . h($e['t']) . ': ' . h($e['d']) . ' <span class="key-from">(' . h($e['n']) . ')</span></li>';
  $SHEETS[] = ["$w-vocabulary", 'Vocabulary', $W['name'] . ' vocabulary', $W['name'] . ' vocabulary worksheet with answer key',
    "A free printable vocabulary worksheet: match ten key words from the {$W['name']} city to their meanings. With an answer key and links to the illustrated building pages.",
    '3-8', '15 minutes',
    $nameLine . '<h2>' . h($W['name']) . ': key words</h2><p class="sheet-do">Write the letter of the right meaning next to each word.</p>'
      . '<div class="vocab"><div><h3>Words</h3><ol class="vocab-words">' . $left . '</ol></div><div><h3>Meanings</h3><ul class="vocab-means">' . $right . '</ul></div></div>',
    '<h2>Answer key: ' . h($W['name']) . ' key words</h2><ol class="key-list">' . $key . '</ol>'];

  // Word search: the first puzzle for this world.
  $p = $WS_PUZZLES[$w][0];
  $hit = [];
  foreach ($p['w'] as [$word, $r, $c, $dr, $dc]) for ($i = 0; $i < strlen($word); $i++) $hit[($r + $dr * $i) . '-' . ($c + $dc * $i)] = true;
  $grid = '';
  $gridKey = '';
  foreach ($p['g'] as $r => $row) {
    $grid .= '<tr>';
    $gridKey .= '<tr>';
    foreach (str_split($row) as $c => $ch) {
      $grid .= '<td>' . $ch . '</td>';
      $gridKey .= '<td' . (isset($hit["$r-$c"]) ? ' class="k"' : '') . '>' . $ch . '</td>';
    }
    $grid .= '</tr>';
    $gridKey .= '</tr>';
  }
  $wordsList = '';
  foreach ($p['w'] as $e) $wordsList .= '<li><b>' . h(ucfirst(strtolower($e[0]))) . '</b>: ' . h($e[5]) . '</li>';
  $SHEETS[] = ["$w-word-search", 'Word search', $W['name'] . ' word search', $W['name'] . ' word search with answer key',
    "A free printable word search with ten key words from the {$W['name']} city, each with its meaning, plus an answer key. Words read across, down or diagonally.",
    '2-6', '15 minutes',
    $nameLine . '<h2>' . h($W['name']) . ': word search</h2><p class="sheet-do">Find the ten words. They read across, down or diagonally. Then read what each one means.</p>'
      . '<table class="wsp">' . $grid . '</table><ul class="wsp-words">' . $wordsList . '</ul>',
    '<h2>Answer key: ' . h($W['name']) . ' word search</h2><table class="wsp wsp-key">' . $gridKey . '</table>'];
}

// Compare chart: five city needs, four worlds.
$head = '<th scope="col"><span class="sr-only">Need</span></th>';
foreach (WORLD_ORDER as $w) $head .= '<th scope="col" class="world-' . $w . '">' . thumb_img(thumb($w, $WORLDS[$w]['card']), '', '') . h($WORLDS[$w]['name']) . '</th>';
$rows = '';
$keyRows = '';
foreach ($COMPARE as [$ckey, $label, $question, $cells]) {
  $rows .= '<tr><th scope="row">' . h($label) . '<span>' . h($question) . '</span></th>' . str_repeat('<td></td>', 4) . '</tr>';
  $keyRows .= '<tr><th scope="row">' . h($label) . '</th>';
  foreach (WORLD_ORDER as $w) $keyRows .= '<td><b>' . h($cells[$w][1]) . '</b> ' . h($cells[$w][2]) . '</td>';
  $keyRows .= '</tr>';
}
$SHEETS[] = ['compare-four-cities-chart', 'Compare', 'Compare four cities', 'Compare four cities: printable chart with answer key',
  'A free printable chart for comparing how ancient Rome, a modern town, an elven world and a Mars settlement provide water, places to gather, safe travel, goods and room for nature.',
  '4-9', '30 to 40 minutes',
  $nameLine . '<h2>How does each city meet its needs?</h2><p class="sheet-do">Use the <b>Compare the worlds</b> page. In each box, write how that world meets the need.</p><table class="chart"><thead><tr>' . $head . '</tr></thead><tbody>' . $rows . '</tbody></table>'
    . '<p class="sheet-do">Which world meets the needs best, in your opinion? Why?</p><div class="lines"></div>',
  '<h2>Answer key: example answers</h2><p>These are the examples on the Compare page. Accept any answer the student can explain.</p><table class="chart chart-key"><thead><tr>' . $head . '</tr></thead><tbody>' . $keyRows . '</tbody></table>'];

// Same job, two worlds: draw lines between matching buildings.
foreach ([['roman', 'modern', 'rome-and-today-matching', 'Rome and today', 'Rome and today: same job matching worksheet'],
          ['modern', 'future', 'earth-and-mars-matching', 'Earth and Mars', 'Earth and Mars: same job matching worksheet']] as [$wa, $wb, $slug, $h1, $title]) {
  $pairs = same_job_pairs($wa, $wb, crc32($slug));
  $order = seeded_shuffle(array_keys($pairs), crc32("$slug-order"));
  $left = '';
  $right = '';
  $key = '';
  foreach ($pairs as $n => [$a]) $left .= '<li>' . thumb_img(thumb($a['w'], explode('/', $a['k'])[1]), '', '') . '<span><b>' . ($n + 1) . '.</b> ' . h($a['n']) . '</span></li>';
  foreach ($order as $pos => $n) { $b = $pairs[$n][1]; $right .= '<li>' . thumb_img(thumb($b['w'], explode('/', $b['k'])[1]), '', '') . '<span><b>' . SHEET_LETTERS[$pos] . '.</b> ' . h($b['n']) . '</span></li>'; }
  foreach ($pairs as $n => [$a, $b, $job]) $key .= '<li><b>' . ($n + 1) . ' &rarr; ' . SHEET_LETTERS[array_search($n, $order)] . '</b>: ' . h($a['n']) . ' and ' . h($b['n']) . ' both ' . h($job) . '.</li>';
  $SHEETS[] = [$slug, 'Matching', $h1, $title,
    "A free printable matching worksheet: draw lines between buildings in {$WORLDS[$wa]['name']} and {$WORLDS[$wb]['name']} that do the same job. With an answer key.",
    '3-7', '15 minutes',
    $nameLine . '<h2>' . h($h1) . ': same job, different world</h2><p class="sheet-do">Draw a line from each building on the left to the building on the right that does the same job.</p>'
      . '<div class="match"><div><h3>' . h($WORLDS[$wa]['name']) . '</h3><ul class="match-list">' . $left . '</ul></div><div><h3>' . h($WORLDS[$wb]['name']) . '</h3><ul class="match-list">' . $right . '</ul></div></div>'
      . '<p class="sheet-do">Pick one pair. What changed between the two worlds, and what stayed the same?</p><div class="lines"></div>',
    '<h2>Answer key: ' . h($h1) . '</h2><ol class="key-list">' . $key . '</ol>'];
}

// Plan a city: a grid to draw on, the ten needs, and questions.
$planGrid = str_repeat('<tr>' . str_repeat('<td></td>', 6) . '</tr>', 6);
$planNeeds = '';
foreach ($NEEDS as [$label]) $planNeeds .= '<tr><th scope="row">' . h($label) . '</th><td></td><td></td></tr>';
$SHEETS[] = ['plan-a-city', 'Planning', 'Plan a city', 'Plan a city: printable city planning worksheet',
  'A free printable city planning worksheet: draw a city on a 6 by 6 grid and plan a building for each of the ten things every city needs. Works with the online city builder.',
  '3-9', '45 minutes',
  $nameLine . '<h2>Plan your city</h2><p class="sheet-do">Draw your city on the grid. Streets run between the squares. Then fill in the table.</p>'
    . '<table class="plan-grid" aria-label="Empty 6 by 6 city grid">' . $planGrid . '</table>'
    . '<table class="plan-needs"><thead><tr><th scope="col">Need</th><th scope="col">What will you build?</th><th scope="col">Which world is it from?</th></tr></thead><tbody>' . $planNeeds . '</tbody></table>'
    . '<p class="sheet-do">Who will live in your city? What would make it a great place to live?</p><div class="lines"></div>'
    . '<p class="sheet-tip">Try it online: build your plan with the city builder at ' . h(url('/play/city-builder/')) . '</p>',
  ''];

$sheetCards = '';
$kinds = [];
foreach ($SHEETS as [$slug, $kind, $h1, $title, $desc, $grades]) $kinds[$kind][] = '<li class="guide-card"><a href="/teachers/worksheets/' . $slug . '/"><span class="tag">' . h($kind) . ' · Grades ' . h($grades) . '</span><span class="guide-title">' . h($h1) . '</span><span class="what">' . h($desc) . '</span></a></li>';
foreach ($kinds as $kind => $cards) $sheetCards .= '<section class="cat" aria-labelledby="k-' . strtolower($kind) . '"><h2 id="k-' . strtolower($kind) . '">' . h($kind === 'Vocabulary' ? 'Vocabulary matching' : ($kind === 'Word search' ? 'Word searches' : ($kind === 'Compare' ? 'Compare chart' : ($kind === 'Matching' ? 'Same job matching' : 'Plan a city')))) . '</h2><ul class="guide-grid">' . implode('', $cards) . '</ul></section>';
$sheetCount = count($SHEETS);
page('/teachers/worksheets/', [
  'title' => 'Free printable city worksheets with answer keys',
  'desc' => h("$sheetCount free printable worksheets for classrooms: vocabulary matching, word searches, a compare chart, same job matching and a city planning sheet, with answer keys."),
  'class' => 'teachers',
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/teachers/">Teachers &amp; Schools</a></li><li aria-current="page">Worksheets</li></ol></nav>
</div>
<section class="wrap section page-head">
  <h1>Printable worksheets</h1>
  <p class="lead">{$sheetCount} free worksheets that go with the four city worlds, each with an answer key. Open one, then print it.</p>
  <div>{$sheetCards}</div>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Teachers & Schools', '/teachers/'], ['Worksheets', '/teachers/worksheets/']])],
]);
foreach ($SHEETS as [$slug, $kind, $h1, $title, $desc, $grades, $time, $sheet, $answers]) {
  $keyBtn = $answers ? ' <button type="button" class="btn btn-quiet js-print-sheet" data-key="1">Print with answer key</button>' : '';
  $keyBox = $answers ? '<details class="sheet-key-box"><summary>Show the answer key</summary><article class="sheet sheet-key">' . $answers . '</article></details>' : '';
  $h1H = h($h1);
  $descH = h($desc);
  page("/teachers/worksheets/$slug/", [
    'title' => $title,
    'desc' => $descH,
    'class' => 'teachers worksheet',
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/teachers/">Teachers &amp; Schools</a></li><li><a href="/teachers/worksheets/">Worksheets</a></li><li aria-current="page">{$h1H}</li></ol></nav>
</div>
<section class="wrap sheet-head">
  <p class="tag">Printable worksheet · Grades {$grades} · {$time}</p>
  <h1>{$h1H}</h1>
  <p class="lead">{$descH}</p>
  <p class="sheet-btns"><button type="button" class="btn js-print-sheet" data-key="0" hidden>Print worksheet</button>{$keyBtn}</p>
</section>
<div class="wrap sheet-wrap">
  <article class="sheet">{$sheet}<p class="sheet-credit">The Atlas of Cities · free to copy for classroom use</p></article>
  {$keyBox}
</div>
<section class="wrap section" aria-labelledby="more-h">
  <h2 id="more-h">More worksheets</h2>
  <p><a class="btn btn-quiet" href="/teachers/worksheets/">All worksheets</a> <a class="btn btn-quiet" href="/teachers/glossary/">Glossary</a> <a class="btn btn-quiet" href="/teachers/question-bank/">Question bank</a></p>
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], ['Teachers & Schools', '/teachers/'], ['Worksheets', '/teachers/worksheets/'], [$h1, "/teachers/worksheets/$slug/"]]),
      ['@context' => 'https://schema.org', '@type' => 'LearningResource', 'name' => $title, 'description' => $desc, 'url' => url("/teachers/worksheets/$slug/"),
        'inLanguage' => 'en', 'learningResourceType' => 'Worksheet', 'educationalLevel' => "Grades $grades", 'timeRequired' => $time, 'isAccessibleForFree' => true,
        'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => url('/')]]],
  ]);
}

// ---------- Glossary: every key word, A to Z ----------
$gloss = [];
foreach ($WORLD_DATA as $w => $D) foreach ($D['pages'] as $slug => $r) foreach ($r['words'] as $term => $def) {
  $gloss[strtoupper(search_words($term)[0])][] = [$term, $def, $w, $slug, $r['name']];
}
ksort($gloss);
$glossH = '';
$glossJump = '';
$glossCount = 0;
foreach ($gloss as $letter => $list) {
  usort($list, fn($a, $b) => strnatcasecmp($a[0], $b[0]) ?: strcmp($a[2], $b[2]));
  $items = '';
  foreach ($list as [$term, $def, $w, $slug, $pname]) {
    $glossCount++;
    $items .= '<div class="gl-item" data-s="' . h(search_words("$term $def $pname " . $WORLDS[$w]['name'])) . '"><dt>' . h($term) . '</dt><dd>' . h($def)
      . ' <span class="gl-from"><a class="world-' . $w . '" href="/worlds/' . $w . '/' . $slug . '/">' . h($pname) . '</a> · ' . h($WORLDS[$w]['name']) . '</span></dd></div>';
  }
  $id = 'az-' . strtolower($letter);
  $glossH .= '<section class="az-sec" id="' . $id . '" aria-labelledby="' . $id . '-h"><h2 id="' . $id . '-h">' . $letter . '</h2><dl class="gl-list">' . $items . '</dl></section>';
  $glossJump .= '<li><a href="#' . $id . '">' . $letter . '</a></li>';
}
page('/teachers/glossary/', [
  'title' => "City glossary: $glossCount key words with meanings",
  'desc' => h("A free glossary of $glossCount key words about cities, buildings, engineering, nature and space, from ancient Rome to Mars, each with a simple meaning and a link to an illustrated page."),
  'class' => 'teachers glossary',
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/teachers/">Teachers &amp; Schools</a></li><li aria-current="page">Glossary</li></ol></nav>
</div>
<section class="wrap section page-head">
  <h1>Glossary</h1>
  <p class="lead">All {$glossCount} key words from the building pages, with what each one means and where to read more.</p>
  <div class="sp-form" role="search">
    <label for="gl-q" class="sr-only">Filter the glossary</label>
    <input type="search" id="gl-q" class="az-filter" data-noun="word" placeholder="Try arch, solar or water" autocomplete="off" spellcheck="false" disabled>
  </div>
  <p class="sp-count" aria-live="polite"></p>
  <nav aria-label="Letters"><ul class="az-jump">{$glossJump}</ul></nav>
</section>
<div class="wrap az-all">{$glossH}</div>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Teachers & Schools', '/teachers/'], ['Glossary', '/teachers/glossary/']])],
]);

// ---------- Question bank: every "Think about it" question, by world and building group ----------
$qb = '';
$qbJump = '';
$qbCount = 0;
$firstQ = null;
foreach (WORLD_ORDER as $w) {
  $D = $WORLD_DATA[$w];
  $cats = '';
  foreach ($D['cats'] as $cat => [$clabel]) {
    $li = '';
    foreach ($D['pages'] as $slug => $r) {
      if ($r['cat'] !== $cat) continue;
      foreach ($r['questions'] as $q) {
        $qbCount++;
        $firstQ ??= [$q, $w, $slug, $r['name']];
        $li .= '<li><span class="qb-q">' . h($q) . '</span> <a class="qb-from" href="/worlds/' . $w . '/' . $slug . '/">' . h($r['name']) . '</a></li>';
      }
    }
    if ($li) $cats .= '<section class="qb-cat"><h3>' . h($clabel) . '</h3><ul class="qb-list">' . $li . '</ul></section>';
  }
  $qb .= '<section class="qb-world world-' . $w . '" id="q-' . $w . '" aria-labelledby="q-' . $w . '-h"><h2 id="q-' . $w . '-h">' . h($WORLDS[$w]['name']) . '</h2>' . $cats . '</section>';
  $qbJump .= '<li><a class="world-link world-' . $w . '" href="#q-' . $w . '">' . h($WORLDS[$w]['name']) . '</a></li>';
}
[$fq, $fw, $fs, $fn] = $firstQ;
$fqH = h($fq);
$fnH = h($fn);
page('/teachers/question-bank/', [
  'title' => "Question bank: $qbCount discussion questions about cities",
  'desc' => h("$qbCount free discussion questions about how cities work, from ancient Rome to a Mars base, for warm-ups, class discussions and writing prompts, with a question of the day."),
  'class' => 'teachers question-bank',
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/teachers/">Teachers &amp; Schools</a></li><li aria-current="page">Question bank</li></ol></nav>
</div>
<section class="wrap section page-head">
  <h1>Question bank</h1>
  <p class="lead">All {$qbCount} "Think about it" questions from the building pages, for warm-ups, discussions and writing prompts.</p>
  <div class="qotd">
    <p class="tag">Question of the day</p>
    <p class="qotd-q" aria-live="polite">{$fqH}</p>
    <p class="qotd-from">From: <a href="/worlds/{$fw}/{$fs}/">{$fnH}</a></p>
    <p><button type="button" class="btn btn-quiet qotd-next" hidden>Another question</button></p>
  </div>
  <nav aria-label="Worlds"><ul class="world-links">{$qbJump}</ul></nav>
</section>
<div class="wrap qb">{$qb}</div>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Teachers & Schools', '/teachers/'], ['Question bank', '/teachers/question-bank/']])],
]);
