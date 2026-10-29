<?php
// Guided tours (/tours/ and /tours/{slug}/): a short walk through one world, led by one of the
// people from build/people.php, stopping at building pages. Included from build.php after worldpages.php.
// Each stop: [world/slug, what the guide says, a question to think about].

$TOURS = [
'roman-engineering' => [
  'world' => 'roman', 'guide' => 'worker-1',
  'title' => 'Roman engineering tour: water, roads and concrete',
  'h1' => 'Roman engineering',
  'desc' => 'A guided tour of how Roman engineers built aqueducts, roads, baths, cranes and the Pantheon\'s concrete dome, with questions at every stop.',
  'theme' => 'Water, roads and building methods',
  'intro' => 'I carry stone for a living, so I know how hard building is. Walk with me and see how Roman engineers moved water, stone and people with simple machines and clever materials.',
  'time' => '20 to 30 minutes', 'grades' => '4-10',
  'stops' => [
    ['roman/building-materials', 'Start with the materials. Romans built with stone, brick, timber and concrete made with volcanic ash. Their concrete could even set underwater.', 'Why might volcanic ash make concrete stronger?'],
    ['roman/crane', 'Heavy blocks were lifted by cranes powered by people walking inside a giant wheel. Pulleys multiplied their strength.', 'How does a pulley make lifting easier?'],
    ['roman/aqueduct', 'Aqueducts carried water for kilometers, sloping down so gently you could hardly see it. Most of the channel ran underground.', 'What would happen if the slope were too steep, or too flat?'],
    ['roman/public-fountain', 'Most people did not have water at home. They filled jars at street fountains, which ran day and night.', 'Where does your water come from, and where does it go after you use it?'],
    ['roman/public-baths', 'The baths used water and fire together: furnaces heated air that flowed under the floors and through the walls.', 'Why would a city build huge public baths for everyone?'],
    ['roman/pantheon', 'Look up: the Pantheon\'s dome is still the largest unreinforced concrete dome in the world, nearly 1,900 years later. The concrete gets lighter toward the top.', 'Why would builders use lighter material at the top of a dome?'],
    ['roman/amphitheater', 'Arches carried the weight of tens of thousands of spectators, and numbered entrances let crowds in and out quickly.', 'How do stadiums today move big crowds safely?'],
    ['roman/ox-cart', 'Roads tied it all together. Layers of stone and gravel, a curved surface for rain, and milestones to measure the way.', 'Which Roman idea do we still use in roads today?'],
  ],
  'think' => ['Which Roman invention do you think mattered most? Why?', 'Much of this work was done by enslaved people. How should we remember them when we admire these buildings?', 'Which Roman building would you most like to see standing today?'],
  'teach' => 'build-a-roman-aqueduct',
],
'modern-neighborhoods' => [
  'world' => 'modern', 'guide' => 'people-3',
  'title' => 'Modern neighborhood tour: getting around and public spaces',
  'h1' => 'Modern neighborhoods',
  'desc' => 'A guided walk through a modern town: streets, cars, deliveries, libraries, parks and access for everyone, with questions at every stop.',
  'theme' => 'Getting around, public spaces and access for everyone',
  'intro' => 'I can\'t drive yet, so I walk, bike or take the bus everywhere. Come with me and see the town the way someone without a car sees it.',
  'time' => '20 to 30 minutes', 'grades' => '3-9',
  'stops' => [
    ['modern/streets-crosswalks', 'Streets are the biggest public space in town. A good crossing is short, clearly marked and has a curb ramp.', 'Which crossing near you feels least safe? Why?'],
    ['modern/family-car', 'Cars take up a lot of space, even when parked, which is most of the day.', 'What could a parking lot become instead?'],
    ['modern/delivery-van', 'More online shopping means more vans stopping on the street. Loading zones and parcel lockers help.', 'How could deliveries cause less traffic?'],
    ['modern/mixed-use-building', 'Shops downstairs and homes upstairs mean people can walk to buy what they need.', 'What can you walk to from your home in ten minutes?'],
    ['modern/public-library', 'The library is free, warm, has internet and welcomes everyone. You don\'t have to buy anything to stay.', 'Where else can you spend time without spending money?'],
    ['modern/park-pond', 'Parks give shade, cool the air, soak up rain and give everyone room to play.', 'Who uses your nearest park, and who doesn\'t?'],
    ['modern/playground', 'Good playgrounds let children take small risks and include kids who use wheelchairs.', 'What would make a playground fun for every child?'],
    ['modern/community-center', 'Classes, meals, meetings and sports: the community center is where neighbors meet.', 'What is missing from your neighborhood?'],
  ],
  'think' => ['Plan a route from your home to school. What would make it safer?', 'Who might find your town hard to get around?', 'If you could change one street, what would you change?'],
  'teach' => 'explore-your-town-scavenger-hunt',
],
'ecological-design' => [
  'world' => 'elven', 'guide' => 'people-5',
  'title' => 'Ecological design tour: water, plants and shared land',
  'h1' => 'Ecological design',
  'desc' => 'A guided tour of the imagined elven city and the real nature-based ideas behind it: clean water, wetlands, green roofs, meadows, compost and the commons.',
  'theme' => 'Imaginative ideas about water, plants and shared land',
  'intro' => 'I water the gardens of the elven city. Our city is imagined, but every stop on this walk shows a real idea that people are using today.',
  'time' => '20 to 30 minutes', 'grades' => '3-9',
  'stops' => [
    ['elven/spring-circle', 'Our water starts at a protected spring. Real cities, like New York, protect the forests around their reservoirs to keep water clean.', 'What could harm a water source near you?'],
    ['elven/crystal-fountain', 'Water from homes flows through reed beds, where plants and microbes clean it. Real towns build wetlands like this.', 'How can plants clean water?'],
    ['elven/green-roof-cottage', 'A roof of living plants keeps the house cool, soaks up rain and feeds insects.', 'Which roofs near you could be green?'],
    ['elven/flower-meadow', 'Meadows feed bees, butterflies and other pollinators, which help grow much of our food.', 'Could your school grow a small meadow?'],
    ['elven/great-tree-hall', 'Some real bridges are grown from living tree roots, guided by people over many years.', 'What would you grow if you could wait 50 years?'],
    ['elven/flower-cart', 'We carry goods by pony and cart. In real forests, horses still haul logs where machines would harm the soil.', 'When is slow transport the better choice?'],
    ['elven/market-hall', 'Nothing is wasted: food scraps become compost that feeds next year\'s gardens.', 'What happens to food waste at your home or school?'],
    ['elven/council-terrace', 'Everyone shares the forest, so everyone helps make the rules. Real communities manage shared land this way.', 'How should a group decide how to share something everyone needs?'],
  ],
  'think' => ['Which real idea from this tour could work in your town?', 'Which idea sounds good but might be hard to do? Why?', 'Design one imagined elven building based on a real natural process.'],
  'teach' => 'biomimicry-examples-for-students',
],
'robotic-cities' => [
  'world' => 'future', 'guide' => 'people-2',
  'title' => 'Robotic future tour: technology, energy and who decides',
  'h1' => 'Human choices in robotic cities',
  'desc' => 'A guided tour of an imagined Moon and Mars settlement: power, robots, self-driving vehicles, recycling and who makes the decisions, with real space technology at every stop.',
  'theme' => 'Technology, energy and who decides',
  'intro' => 'I\'m an engineer at the settlement. Robots do a lot of the work here, but people still make the choices. Let\'s see who decides what.',
  'time' => '20 to 30 minutes', 'grades' => '5-12',
  'stops' => [
    ['future/power-tower', 'Everything here needs power, all the time. Solar works by day; small nuclear reactors could work through the long lunar night.', 'What is the most important thing to keep powered in an emergency?'],
    ['future/water-recycler', 'We recycle almost all our water, as astronauts on the space station already do.', 'What could your home recycle that it doesn\'t now?'],
    ['future/robot-helpers', 'Small robots take inventory and inspect equipment, saving people time.', 'Which jobs would you give to a robot? Which would you keep?'],
    ['future/cargo-pod', 'Self-driving pods carry ice and supplies. Giant self-driving trucks already work in mines on Earth.', 'Who is responsible if a self-driving vehicle makes a mistake?'],
    ['future/robotics-factory', 'Robots build parts from local materials, so less has to be shipped from Earth.', 'What happens to people\'s jobs when robots can build things?'],
    ['future/operations-center', 'People watch over everything from here and step in when something goes wrong.', 'Should a robot ever make a decision without asking a person?'],
    ['future/civic-dome', 'Who makes the rules in a settlement? Real treaties already set some rules for space.', 'How should a small settlement make fair decisions?'],
  ],
  'think' => ['Would you want to live in this settlement? Why or why not?', 'What should robots never be allowed to do?', 'Who should decide how new technology is used: experts, companies or everyone?'],
  'teach' => 'design-a-mars-colony-project',
],
];

function person_img($w, $file, $sizes = '120px', $alt = '') {
  return img($w, $file, $alt, $sizes, 'loading="lazy"');
}

function tour_card($slug) {
  global $TOURS, $PEOPLE, $WORLDS;
  $t = $TOURS[$slug];
  $w = $t['world'];
  [$gname] = $PEOPLE[$w][$t['guide']];
  return '<li class="tour-card world-' . $w . '"><a href="/tours/' . $slug . '/">'
    . '<span class="tour-guide">' . person_img($w, $t['guide'], '120px') . '</span>'
    . '<span class="tour-text"><span class="tag">' . h($WORLDS[$w]['name']) . ' · ' . count($t['stops']) . ' stops</span>'
    . '<span class="tour-title">' . h($t['h1']) . '</span><span class="what">' . h($t['theme']) . '</span>'
    . '<span class="tour-by">Your guide: ' . h(strtolower($gname)) . '</span></span></a></li>';
}

// ---------- Hub ----------
$tourCards = '';
foreach (array_keys($TOURS) as $slug) $tourCards .= tour_card($slug);
page('/tours/', [
  'title' => 'Guided tours of the city worlds',
  'desc' => h('Four short guided tours: Roman engineering, modern neighborhoods, ecological design and human choices in a robotic future. Each stop links to a full illustrated page.'),
  'class' => 'tours',
  'body' => <<<HTML
<section class="wrap section page-head">
  <p class="tag">Guided tours</p>
  <h1>Take a guided tour</h1>
  <p class="lead">Short walks through each world, led by one of its people. Every stop has a picture, a short explanation and a question to talk about. Use them on your own, as a family or with a class.</p>
  <ul class="tour-grid">{$tourCards}</ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Guided tours', '/tours/']])],
]);
// The old "coming later" address now points to the tours.
page('/guided/', [
  'title' => 'Guided tours',
  'desc' => h('Guided explorations are now on the Guided tours page.'),
  'noindex' => true,
  'body' => '<section class="wrap section page-head narrow"><h1>Guided tours</h1><p class="lead">The guided explorations are ready: see <a href="/tours/">Guided tours</a>.</p></section>',
]);

// ---------- One page per tour ----------
foreach ($TOURS as $slug => $t) {
  $w = $t['world'];
  [$gname, $grole] = $PEOPLE[$w][$t['guide']];
  $stops = '';
  $nav = '';
  foreach ($t['stops'] as $n => [$key, $say, $ask]) {
    [$sw, $ss] = explode('/', $key);
    $r = $WORLD_DATA[$sw]['pages'][$ss] ?? null;
    if (!$r) { fwrite(STDERR, "unknown tour stop $slug: $key\n"); continue; }
    $num = $n + 1;
    $stops .= '<li class="stop" id="stop-' . $num . '"><div class="stop-art"><a href="/worlds/' . $sw . '/' . $ss . '/" tabindex="-1" aria-hidden="true">'
      . img($sw, $ss, '', '(min-width: 900px) 280px, 70vw', 'loading="lazy"') . '</a></div>'
      . '<div class="stop-text"><p class="stop-num">Stop ' . $num . '</p><h2>' . h($r['name']) . '</h2>'
      . '<p class="stop-say">' . h($say) . '</p><p class="ask">' . h($ask) . '</p>'
      . '<p><a href="/worlds/' . $sw . '/' . $ss . '/">Read the full page about the ' . h(preg_replace('/^the /', '', strtolower($r['name']))) . '</a></p></div></li>';
    $nav .= '<li><a href="#stop-' . $num . '">' . $num . '. ' . h($r['name']) . '</a></li>';
  }
  $think = '';
  foreach ($t['think'] as $q) $think .= '<li>' . h($q) . '</li>';
  $others = '';
  foreach (array_keys($TOURS) as $o) if ($o !== $slug) $others .= tour_card($o);
  $guideImg = person_img($w, $t['guide'], '(min-width: 700px) 220px, 140px', '');
  $teach = isset($TEACH[$t['teach']]) ? '<p>For a full lesson, see <a href="/teachers/' . $t['teach'] . '/">' . h($TEACH[$t['teach']]['h1']) . '</a>.</p>' : '';
  $h1 = h($t['h1']); $intro = h($t['intro']); $theme = h($t['theme']);
  $gnameH = h($gname); $groleH = h($grole); $wname = h($WORLDS[$w]['name']);
  $count = count($t['stops']);
  page("/tours/$slug/", [
    'title' => $t['title'],
    'desc' => h($t['desc']),
    'og' => $w,
    'class' => "tours tour world-$w",
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/tours/">Guided tours</a></li><li aria-current="page">{$h1}</li></ol></nav>
</div>
<section class="wrap tour-head">
  <div class="tour-head-text">
    <p class="tag">{$wname} · Guided tour</p>
    <h1>{$h1}</h1>
    <p class="lead">{$theme}.</p>
    <dl class="facts guide-meta"><div><dt>Stops</dt><dd>{$count}</dd></div><div><dt>Time</dt><dd>{$t['time']}</dd></div><div><dt>Grades</dt><dd>{$t['grades']}</dd></div></dl>
  </div>
  <figure class="guide-bubble"><div class="guide-pic">{$guideImg}</div><figcaption><strong>Your guide: {$gnameH}</strong> <span class="what">{$groleH}</span><span class="bubble">{$intro}</span></figcaption></figure>
</section>
<div class="wrap b-layout">
  <aside class="b-toc" aria-label="Tour stops"><p class="toc-h">Tour stops</p><ol class="plain-ol">{$nav}<li><a href="#think">Think it over</a></li></ol><p><button type="button" class="btn btn-quiet js-print">Print this tour</button></p></aside>
  <div>
    <ol class="stops">{$stops}</ol>
    <section class="read panel" id="think" aria-labelledby="think-h">
      <h2 id="think-h">Think it over</h2>
      <ol class="questions">{$think}</ol>
      {$teach}
      <p><a class="btn" href="/worlds/{$w}/">Explore the whole {$wname} city</a></p>
    </section>
  </div>
</div>
<section class="wrap section" aria-labelledby="more-tours">
  <h2 id="more-tours">More tours</h2>
  <ul class="tour-grid">{$others}</ul>
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], ['Guided tours', '/tours/'], [$t['h1'], "/tours/$slug/"]]),
      learning($t['title'], $t['desc'], "/tours/$slug/", $t['theme'])],
  ]);
}
