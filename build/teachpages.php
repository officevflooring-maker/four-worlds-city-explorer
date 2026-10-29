<?php
// Teachers & Homeschool hub (/teachers/), the homeschool page (/teachers/homeschool/) and one page per guide
// (/teachers/{slug}/).
// Content lives in build/teach.php. Included from build.php after the world pages.

const TEACH_GROUPS = [
  ['Projects and lessons', ['design-a-city-project', 'build-a-roman-aqueduct', 'design-a-mars-colony-project', 'roman-engineering-lesson', 'ancient-rome-vs-modern-cities', 'how-local-government-works']],
  ['Ancient Egypt explained', ['how-were-the-pyramids-built', 'daily-life-in-ancient-egypt']],
  ['Ancient Rome explained', ['daily-life-in-ancient-rome', 'how-did-roman-aqueducts-work']],
  ['Cities today', ['how-do-cities-get-clean-water', 'what-does-a-city-need', 'urban-planning-for-students', 'explore-your-town-scavenger-hunt']],
  ['Sustainability and nature', ['sustainable-city-project-ideas', 'biomimicry-examples-for-students', 'solarpunk-explained']],
  ['Space and the future', ['how-could-humans-live-on-mars', 'life-on-the-space-station']],
  ['The story of Jesus', ['story-of-jesus-bible-lesson']],
  ['Creative writing and classroom tools', ['fantasy-city-worldbuilding', 'discussion-questions-what-makes-a-good-city', 'free-images-for-classroom']],
];

function teach_card($slug) {
  global $TEACH;
  $t = $TEACH[$slug];
  return '<li class="guide-card"><a href="/teachers/' . $slug . '/"><span class="tag">' . h($t['kind']) . ' · Grades ' . h($t['grades']) . '</span>'
    . '<span class="guide-title">' . h($t['h1']) . '</span><span class="what">' . h($t['desc']) . '</span></a></li>';
}

// Every guide must appear in exactly one hub group.
$grouped = array_merge(...array_map(fn($g) => $g[1], TEACH_GROUPS));
foreach (array_keys($TEACH) as $slug) if (!in_array($slug, $grouped)) fwrite(STDERR, "teacher guide not in a group: $slug\n");

// ---------- Hub ----------
$hubBody = '';
$jump = '';
foreach (TEACH_GROUPS as $n => [$label, $slugs]) {
  $id = 'g' . ($n + 1);
  $cards = '';
  foreach ($slugs as $s) $cards .= teach_card($s);
  $hubBody .= '<section class="cat" id="' . $id . '" aria-labelledby="' . $id . '-h"><h2 id="' . $id . '-h">' . h($label) . '</h2><ul class="guide-grid">' . $cards . '</ul></section>';
  $jump .= '<li><a href="#' . $id . '">' . h($label) . '</a></li>';
}
$teachCount = count($TEACH);
// Classroom tools (build/classroom.php and the games in build/play.php).
$wordCount = 0;
$questionCount = 0;
foreach ($WORLD_DATA as $D) foreach ($D['pages'] as $r) { $wordCount += count($r['words']); $questionCount += count($r['questions']); }
$tools = '';
foreach ([
  ['/teachers/worksheets/', 'Printables', 'Printable worksheets', 'Vocabulary, word searches, a compare chart, matching and a city planner, all with answer keys.'],
  ['/teachers/glossary/', 'Reference', "Glossary of $wordCount city words", 'Every key word from the building pages, with a simple meaning.'],
  ['/teachers/question-bank/', 'Discussion', 'Question bank', "$questionCount questions for warm-ups, discussions and writing, with a question of the day."],
  ['/play/', 'Games', 'Games for class', 'City builder challenges, five quizzes, map hunts, memory match and word search.'],
] as [$href, $tag, $title, $text]) $tools .= '<li class="guide-card tool-card"><a href="' . $href . '"><span class="tag">' . h($tag) . '</span><span class="guide-title">' . h($title) . '</span><span class="what">' . h($text) . '</span></a></li>';
$hubList = [];
foreach (array_keys($TEACH) as $k => $slug) $hubList[] = ['@type' => 'ListItem', 'position' => $k + 1, 'name' => $TEACH[$slug]['h1'], 'url' => url("/teachers/$slug/")];
$promo = shop_cards('', ['classroom-pack', 'wordwall', 'bingo', 'planners']);
page('/teachers/', [
  'title' => 'Free Lessons for Teachers and Homeschool: Rome, Cities, Mars',
  'desc' => h("$teachCount free lessons for public school, private school and homeschool: design a city, the pyramids, Roman aqueducts, the story of Jesus, Mars and more."),
  'class' => 'teachers',
  'body' => <<<HTML
<section class="wrap section page-head">
  <p class="tag">Teachers &amp; Homeschool</p>
  <h1>Free lessons for school and homeschool</h1>
  <p class="lead">{$teachCount} ready-to-use guides for public and private school classrooms and homeschool families, built around the questions students ask most: how cities work, ancient Egypt and Rome, the story of Jesus, nature and living in space. Each one links to illustrated building pages with photos and sources.</p>
  <ul class="plain-points">
    <li>Free, with no sign-up, ads or tracking.</li>
    <li>Grade ranges, time needed and subject areas for every guide.</li>
    <li>Free to print and share for teaching: use your browser's print button on any page.</li>
    <li>All illustrations are free to reuse under CC BY 4.0.</li>
  </ul>
  <p class="try-it"><span class="badge badge-art">Homeschool</span> <a href="/teachers/homeschool/">Free homeschool resources</a>: a week with one city, lessons by subject, printables and games.</p>
  <nav aria-label="Guide groups"><ul class="jump"><li><a href="#tools-h">Classroom tools</a></li>{$jump}</ul></nav>
</section>
<section class="wrap tools" aria-labelledby="tools-h">
  <h2 id="tools-h">Classroom tools</h2>
  <ul class="guide-grid">{$tools}</ul>
</section>
<div class="wrap">{$hubBody}</div>
<section class="band shop-promo" aria-labelledby="promo-h"><div class="wrap"><div class="sec-head"><p class="tag">From the shop</p><h2 id="promo-h">Ready to print for your class</h2><p>Everything on this site stays free. For a whole unit in one file, or a game for Friday afternoon:</p></div>{$promo}<p class="shop-home-more"><a class="btn btn-quiet" href="/shop/">See everything in the shop</a></p></div></section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Teachers & Homeschool', '/teachers/']]),
    ['@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => 'Teachers & Homeschool', 'url' => url('/teachers/'), 'inLanguage' => 'en',
      'audience' => ['@type' => 'EducationalAudience', 'educationalRole' => ['teacher', 'parent']], 'hasPart' => ['@type' => 'ItemList', 'itemListElement' => $hubList]]],
]);

// ---------- Homeschool ----------
// Free homeschool resources (/teachers/homeschool/): a week with one city, the guides by subject, printables and
// games, and the questions homeschool parents ask. It uses the hub's guide cards and classroom tools.
const HOMESCHOOL_SUBJECTS = [
  ['History', ['how-were-the-pyramids-built', 'daily-life-in-ancient-egypt', 'daily-life-in-ancient-rome', 'how-did-roman-aqueducts-work']],
  ['Bible', ['story-of-jesus-bible-lesson']],
  ['Science and engineering', ['build-a-roman-aqueduct', 'how-do-cities-get-clean-water', 'how-could-humans-live-on-mars', 'biomimicry-examples-for-students']],
  ['Civics and community', ['what-does-a-city-need', 'how-local-government-works', 'explore-your-town-scavenger-hunt', 'design-a-city-project']],
  ['Writing and art', ['fantasy-city-worldbuilding', 'free-images-for-classroom']],
];
$cityLinks = implode(', ', array_map(fn($w) => '<a href="/worlds/' . $w . '/">' . h($WORLDS[$w]['name']) . '</a>', WORLD_ORDER));
$weekItems = '';
foreach ([
  ['Monday: explore', "Open one city and read three places your child picks: {$cityLinks}."],
  ['Tuesday: take the tour', 'One of the city\'s people walks you through it, with a question at every stop, and Listen reads it aloud. <a href="/tours/">Guided tours</a>'],
  ['Wednesday: a lesson', 'Pick a guide below for the city\'s big idea, like how the pyramids were built or how a town gets clean water.'],
  ['Thursday: print', 'The city\'s vocabulary sheet and word search, with answer keys. <a href="/teachers/worksheets/">Worksheets</a>'],
  ['Friday: play', 'A quiz, a map hunt or the city builder, then count the week\'s passport stamps. <a href="/play/">Games</a>'],
] as [$day, $what]) $weekItems .= '<li><b>' . h($day) . '</b>' . $what . '</li>';
$subjectBlocks = '';
$hsList = [];
foreach (HOMESCHOOL_SUBJECTS as [$label, $slugs]) {
  $cards = '';
  foreach ($slugs as $s) {
    if (!isset($TEACH[$s])) { fwrite(STDERR, "homeschool page: unknown guide $s\n"); continue; }
    $cards .= teach_card($s);
    $hsList[] = ['@type' => 'ListItem', 'position' => count($hsList) + 1, 'name' => $TEACH[$s]['h1'], 'url' => url("/teachers/$s/")];
  }
  // the Heavenly City's story page goes with the Bible lesson
  if ($label === 'Bible' && !empty($WORLD_DATA['heaven']['story'])) {
    $S = $WORLD_DATA['heaven']['story'];
    $cards .= '<li class="guide-card"><a href="/worlds/heaven/story/"><span class="tag">Story · All ages</span><span class="guide-title">' . h($S['title']) . '</span><span class="what">' . h($S['lead']) . '</span></a></li>';
  }
  $subjectBlocks .= '<section class="cat" aria-label="' . h($label) . '"><h3>' . h($label) . '</h3><ul class="guide-grid">' . $cards . '</ul></section>';
}
$hsFaq = [
  ['Is it free for homeschool families?', 'Yes. Every page, lesson guide, worksheet, tour and game is free, with no account. The shop sells optional printable games and packs, and everything else stays free.'],
  ['What ages is it for?', 'Most of it suits ages 8 to 14 (grades 3 to 8). Each lesson guide lists its grades: the Bible lesson starts at kindergarten, and a few guides go up to grade 12.'],
  ['Does my child need an account or an email?', 'No. Nothing asks for a name or an email. Passport stamps, game scores and the city your child builds stay in your own browser.'],
  ['Can we use it in a co-op?', 'Yes. The lesson guides and worksheets are free to print and share for teaching, for one family or a whole group. Please credit The Atlas of Cities.'],
  ['Is there Bible teaching?', 'Yes. The Heavenly City tells the story of Jesus as the Bible tells it, in 35 parts from place to place, with verses from the Berean Standard Bible. The Bible lesson guide turns it into a six-week plan.'],
  ['Does it work on a tablet or a Chromebook?', 'Yes. It runs in any web browser, on phones, tablets, Chromebooks and computers, with nothing to install.'],
];
$faqHtml = implode('', array_map(fn($f) => '<div class="faq-item"><h3>' . h($f[0]) . '</h3><p>' . h($f[1]) . '</p></div>', $hsFaq));
$hsFaqLd = array_map(fn($f) => ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $hsFaq);
page('/teachers/homeschool/', [
  'title' => 'Free Homeschool Resources: History, Science and the Bible',
  'desc' => h('Free homeschool resources with no sign-up: six illustrated cities, lesson guides, printable worksheets, games and the story of Jesus, for ages 5 to 14.'),
  'class' => 'teachers',
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/teachers/">Teachers &amp; Homeschool</a></li><li aria-current="page">Homeschool</li></ol></nav>
</div>
<section class="wrap section page-head">
  <p class="tag">Homeschool</p>
  <h1>Free homeschool resources</h1>
  <p class="lead">Six illustrated cities to explore, from ancient Egypt and Rome to a modern town and a settlement on Mars, with lesson guides, printables and games. All free for homeschool families and co-ops, with no sign-up, ads or tracking.</p>
  <ul class="plain-points">
    <li>Most of it suits ages 8 to 14, and the Bible lesson starts at kindergarten.</li>
    <li>Free to print and share, for one family or a whole co-op.</li>
    <li>The Heavenly City tells the story of Jesus, as the Bible tells it.</li>
  </ul>
</section>
<section class="wrap section" aria-labelledby="week-h">
  <h2 id="week-h">A week with one city</h2>
  <p>Spend a week in one city, about 30 to 45 minutes a day.</p>
  <ol class="week-plan">{$weekItems}</ol>
</section>
<section class="wrap section" aria-labelledby="subj-h">
  <h2 id="subj-h">Lessons by subject</h2>
  {$subjectBlocks}
</section>
<section class="wrap tools" aria-labelledby="hs-tools-h">
  <h2 id="hs-tools-h">Printables and games</h2>
  <ul class="guide-grid">{$tools}</ul>
</section>
<section class="wrap section" aria-labelledby="hs-faq-h">
  <h2 id="hs-faq-h">Questions homeschool parents ask</h2>
  {$faqHtml}
  <p class="try-it"><span class="badge badge-art">Teachers</span> Teaching in a public or private school? The same guides list grade ranges and class periods: <a href="/teachers/">all teacher guides</a>.</p>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Teachers & Homeschool', '/teachers/'], ['Homeschool', '/teachers/homeschool/']]),
    ['@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => 'Free homeschool resources', 'url' => url('/teachers/homeschool/'), 'inLanguage' => 'en',
      'isAccessibleForFree' => true, 'about' => 'Homeschooling', 'audience' => ['@type' => 'EducationalAudience', 'educationalRole' => 'parent'],
      'hasPart' => ['@type' => 'ItemList', 'itemListElement' => $hsList]],
    ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $hsFaqLd]],
]);

// ---------- One page per guide ----------
// The time a guide takes, for search engines, as an ISO 8601 duration: the shortest time it says (a class period
// counted as 45 minutes). Times it cannot read are left out.
function iso_time($t) {
  if (preg_match('/^(\d+)-minute read$/', $t, $m)) return 'PT' . $m[1] . 'M';
  if (preg_match('/^(\d+)(?: to \d+)? class periods?$/', $t, $m)) { $min = 45 * $m[1]; return 'PT' . ($min >= 60 ? intdiv($min, 60) . 'H' . ($min % 60 ? $min % 60 . 'M' : '') : $min . 'M'); }
  if (preg_match('/^(\d+)(?: to \d+)? weeks?$/', $t, $m)) return 'P' . $m[1] . 'W';
  return null;
}
// Online activities that go with a guide: [link, name, one line].
const TEACH_PLAY = [
  'design-a-city-project' => ['/play/city-builder/', 'Build your own city', 'Students can sketch their city online first and check that it meets every need.'],
  'what-does-a-city-need' => ['/play/city-builder/', 'Build your own city', 'Students build a city and tick off all ten needs as they go.'],
  'sustainable-city-project-ideas' => ['/play/city-builder/', 'Build your own city', 'Mix nature, homes and work, then check what the city still needs.'],
  'design-a-mars-colony-project' => ['/play/city-builder/', 'Build your own city', 'Build a Moon or Mars settlement from the Robotic Future buildings.'],
  'fantasy-city-worldbuilding' => ['/play/city-builder/', 'Build your own city', 'Lay out a green city, or mix all six worlds into a new one.'],
  'ancient-rome-vs-modern-cities' => ['/play/quiz/', 'City quiz', 'The "Same job, different world" quiz matches Roman buildings with modern ones.'],
  'discussion-questions-what-makes-a-good-city' => ['/play/city-builder/', 'Build your own city', 'Build a city first, then use these questions to talk about it.'],
];
$slugsT = array_keys($TEACH);
foreach ($slugsT as $k => $slug) {
  $t = $TEACH[$slug];
  $body = '';
  $toc = '<li><a href="#answer">Quick answer</a></li>';
  foreach ($t['sections'] as $n => $sec) {
    $id = 's' . ($n + 1);
    $toc .= '<li><a href="#' . $id . '">' . h($sec[0]) . '</a></li>';
    $body .= '<section class="read" aria-labelledby="' . $id . '"><h2 id="' . $id . '">' . h($sec[0]) . '</h2>';
    foreach (array_slice($sec, 1) as $part) {
      if (isset($part['list'])) {
        $body .= '<ul class="read-list">';
        foreach ($part['list'] as $li) $body .= '<li>' . h($li) . '</li>';
        $body .= '</ul>';
      } else {
        foreach ($part as $para) $body .= '<p>' . h($para) . '</p>';
      }
    }
    $body .= '</section>';
  }
  $faq = '';
  $faqLd = [];
  foreach ($t['faq'] as [$q, $a]) {
    $faq .= '<div class="faq-item"><h3>' . h($q) . '</h3><p>' . h($a) . '</p></div>';
    $faqLd[] = ['@type' => 'Question', 'name' => $q, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $a]];
  }
  $toc .= '<li><a href="#faq">Questions</a></li><li><a href="#pages">Building pages to use</a></li><li><a href="#sources">Sources</a></li>';
  $cards = '';
  foreach ($t['links'] as $key) {
    [$w, $s] = explode('/', $key);
    if (!isset($WORLD_DATA[$w]['pages'][$s])) { fwrite(STDERR, "unknown teacher link $slug: $key\n"); continue; }
    $cards .= str_replace('<span class="place-name">', '<span class="tag">' . h($WORLDS[$w]['name']) . '</span><span class="place-name">', building_card($w, $s, '(min-width: 900px) 200px, 45vw'));
  }
  $srcs = '';
  foreach ($t['sources'] as $s) {
    if (!isset($TEACH_SOURCES[$s])) { fwrite(STDERR, "unknown teacher source $slug: $s\n"); continue; }
    $srcs .= '<li>' . h($TEACH_SOURCES[$s]) . '</li>';
  }
  // Related guides: the others in the same hub group, then neighbors in the list.
  $related = [];
  foreach (TEACH_GROUPS as [, $g]) if (in_array($slug, $g)) foreach ($g as $o) if ($o !== $slug) $related[] = $o;
  foreach ([$slugsT[($k + 1) % count($slugsT)], $slugsT[($k + 2) % count($slugsT)]] as $o) if ($o !== $slug && !in_array($o, $related)) $related[] = $o;
  $rel = '';
  foreach (array_slice($related, 0, 3) as $o) $rel .= teach_card($o);
  $h1 = h($t['h1']);
  $quick = h($t['quick']);
  $kind = h($t['kind']);
  $grades = h($t['grades']);
  $time = h($t['time']);
  $subjects = h($t['subjects']);
  $try = isset(TEACH_PLAY[$slug]) ? '<p class="try-it"><span class="badge badge-art">Try it online</span> <a href="' . TEACH_PLAY[$slug][0] . '">' . h(TEACH_PLAY[$slug][1]) . '</a>. ' . h(TEACH_PLAY[$slug][2]) . '</p>' : '';
  page("/teachers/$slug/", [
    'title' => $t['title'],
    'desc' => h($t['desc']),
    'class' => 'teachers guide',
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/teachers/">Teachers &amp; Homeschool</a></li><li aria-current="page">{$h1}</li></ol></nav>
</div>
<section class="wrap guide-head">
  <p class="tag">{$kind}</p>
  <h1>{$h1}</h1>
  <dl class="facts guide-meta"><div><dt>Grades</dt><dd>{$grades}</dd></div><div><dt>Time</dt><dd>{$time}</dd></div><div><dt>Subjects</dt><dd>{$subjects}</dd></div></dl>
  <p class="share-note">Free to print and share for teaching, in a classroom or a homeschool. Please credit The Atlas of Cities.</p>
  <div class="quick-answer" id="answer"><h2>Quick answer</h2><p>{$quick}</p></div>
  {$try}
</section>
<div class="wrap b-layout">
  <aside class="b-toc" aria-label="On this page"><p class="toc-h">On this page</p><ol>{$toc}</ol><p><button type="button" class="btn btn-quiet btn-sm" data-listen="h1, #answer p, .b-body > .read:not(#pages):not(.sources-box) h2, .b-body > .read:not(#pages):not(.sources-box) h3, .b-body > .read:not(#pages):not(.sources-box) p, .b-body > .read:not(#pages):not(.sources-box) li" hidden aria-pressed="false">Listen</button> <button type="button" class="btn btn-quiet btn-sm js-print">Print this page</button></p></aside>
  <article class="b-body">
    {$body}
    <section class="read" id="faq" aria-labelledby="faq-h"><h2 id="faq-h">Questions students and teachers ask</h2>{$faq}</section>
    <section class="read" id="pages" aria-labelledby="pages-h"><h2 id="pages-h">Building pages to use with this guide</h2><ul class="places places-3">{$cards}</ul></section>
    <section class="read sources-box" id="sources" aria-labelledby="src-h"><h2 id="src-h">Sources</h2><p>The facts in this guide are based on these sources:</p><ul class="sources">{$srcs}</ul></section>
  </article>
</div>
<section class="wrap section" aria-labelledby="more-h">
  <h2 id="more-h">More for your classroom</h2>
  <ul class="guide-grid">{$rel}</ul>
  <p><a class="btn btn-quiet" href="/teachers/">All teacher guides</a></p>
</section>
HTML,
    'ld' => [
      crumbs([['Home', '/'], ['Teachers & Homeschool', '/teachers/'], [$t['h1'], "/teachers/$slug/"]]),
      ['@context' => 'https://schema.org', '@type' => 'LearningResource', 'name' => $t['h1'], 'description' => $t['desc'], 'url' => url("/teachers/$slug/"),
        'inLanguage' => 'en', 'learningResourceType' => $t['kind'], 'educationalLevel' => 'Grades ' . $t['grades'],
        'about' => $t['subjects'], 'isAccessibleForFree' => true, 'dateModified' => LASTMOD,
        'audience' => ['@type' => 'EducationalAudience', 'educationalRole' => ['teacher', 'parent', 'student']],
        'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => url('/')]] + (iso_time($t['time']) ? ['timeRequired' => iso_time($t['time'])] : []),
      ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faqLd],
    ],
  ]);
}
