<?php
// Guided tours (/tours/ and /tours/{slug}/): a short walk through one world, led by one of the
// people from build/people.php, stopping at building pages. Included from build.php after worldpages.php.
// Each stop: [world/slug, what the guide says, a question to think about].

$TOURS = [
'life-on-the-nile' => [
  'world' => 'egypt', 'guide' => 'people-2',
  'title' => 'Ancient Egypt tour: life on the Nile',
  'h1' => 'Life on the Nile',
  'desc' => 'A guided walk through an Egyptian city with a scribe: the river and granaries, markets without money, a scribe school, temples and the pyramids.',
  'theme' => 'The river, food, writing and great monuments',
  'intro' => 'I am a scribe. I write down every sack of grain and every jar of oil, so I know how this city works. Everything here depends on one thing: the river Nile.',
  'time' => '20 to 30 minutes', 'grades' => '3-9',
  'stops' => [
    ['egypt/sailing-boat', 'The Nile is our highway. Boats sail south with the wind and float north with the current, carrying grain, stone and people.', 'Why might a river be easier to travel on than a road?'],
    ['egypt/palm-grove', 'Channels carry the river\'s water to fields and palm groves. Date palms give us fruit, shade, rope, baskets and roof beams.', 'How many different things can one plant give a city?'],
    ['egypt/granary', 'After the harvest, grain goes into domed granaries. Full granaries mean bread and beer all year, even after a poor flood.', 'Why would a city store food for a bad year?'],
    ['egypt/market', 'There are no coins here. At the market people swap goods: sandals for grain, a basket for fish.', 'What would be hard about trading without money?'],
    ['egypt/scribe-school', 'This is where I learned to write, after years of copying signs. Scribes keep the records that keep the city fair.', 'Why do cities need people who can read and write?'],
    ['egypt/hall-of-columns', 'In the temple, giant painted columns hold up the roof, like the Great Hypostyle Hall at Karnak, which has 134 of them.', 'How do you think builders raised such heavy columns?'],
    ['egypt/obelisk', 'Each obelisk was cut from a single piece of granite and set up in pairs at the temple gates.', 'How might people have moved a stone this big without engines?'],
    ['egypt/pyramid', 'The Great Pyramid at Giza, a tomb for a pharaoh, was the tallest building on Earth for about 3,800 years.', 'Why do you think rulers wanted such huge tombs?'],
  ],
  'think' => ['What would happen to this city if the Nile flood failed?', 'Which job would you choose: farmer, scribe, builder or boat captain? Why?', 'Which Egyptian idea do we still use today?'],
  'teach' => 'what-does-a-city-need',
],
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
  'world' => 'green', 'guide' => 'flower-cart', 'guideRole' => 'Pulled by a white pony',
  'title' => 'Ecological design tour: water, plants and shared land',
  'h1' => 'Ecological design',
  'desc' => 'A guided tour of the imagined green city and the real nature-based ideas behind it: clean water, wetlands, green roofs, meadows, compost and the commons.',
  'theme' => 'Imaginative ideas about water, plants and shared land',
  'intro' => 'Hop on! Every morning I carry flowers to the market. This city is imagined, but every stop on this ride shows a real idea that people are using today.',
  'time' => '20 to 30 minutes', 'grades' => '3-9',
  'stops' => [
    ['green/spring-circle', 'Our water starts at a protected spring. Real cities, like New York, protect the forests around their reservoirs to keep water clean.', 'What could harm a water source near you?'],
    ['green/wetland-fountain', 'Water from homes flows through reed beds, where plants and microbes clean it. Real towns build wetlands like this.', 'How can plants clean water?'],
    ['green/green-roof-cottage', 'A roof of living plants keeps the house cool, soaks up rain and feeds insects.', 'Which roofs near you could be green?'],
    ['green/flower-meadow', 'Meadows feed bees, butterflies and other pollinators, which help grow much of our food.', 'Could your school grow a small meadow?'],
    ['green/great-tree-hall', 'Some real bridges are grown from living tree roots, guided by people over many years.', 'What would you grow if you could wait 50 years?'],
    ['green/flower-cart', 'We carry goods by pony and cart. In real forests, horses still haul logs where machines would harm the soil.', 'When is slow transport the better choice?'],
    ['green/market-hall', 'Nothing is wasted: food scraps become compost that feeds next year\'s gardens.', 'What happens to food waste at your home or school?'],
    ['green/council-terrace', 'Everyone shares the forest, so everyone helps make the rules. Real communities manage shared land this way.', 'How should a group decide how to share something everyone needs?'],
  ],
  'think' => ['Which real idea from this tour could work in your town?', 'Which idea sounds good but might be hard to do? Why?', 'Design one imagined green building based on a real natural process.'],
  'teach' => 'biomimicry-examples-for-students',
],
'robotic-cities' => [
  'world' => 'future', 'guide' => 'people-2',
  'title' => 'Robotic future tour: technology, energy and who decides',
  'h1' => 'Human choices in robotic cities',
  'desc' => 'A guided tour of an imagined Moon and Mars settlement: power, robots, self-driving vehicles, recycling and who makes the decisions.',
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
'city-of-goodness' => [
  'world' => 'heaven', 'guide' => 'people-5',
  'title' => 'Heavenly City tour: the story of Jesus in ten stops',
  'h1' => 'The story of Jesus',
  'desc' => 'A guided walk through the imagined Heavenly City with an elder, telling the story of Jesus as the Bible tells it, from the first garden to the empty tomb.',
  'theme' => 'The good news of Jesus, from beginning to end',
  'intro' => 'I have walked a long way in my life, and this is the best story I know. Walk with me through the city, and I will tell you the story of Jesus, as the Bible tells it.',
  'time' => '20 to 30 minutes', 'grades' => '2-8',
  'stops' => [
    ['heaven/tree-of-life', 'We start where the Bible starts. God made a good world, but people turned away from him, and they lost the tree of life.', 'Why do you think God did not give up on the people he made?'],
    ['heaven/welcome-hall', 'Here there is a bed for everyone, but in Bethlehem there was no room. God\'s Son was born where animals were fed.', 'Why might God\'s Son have been born in such a humble place?'],
    ['heaven/dove-statue', 'At the Jordan River, the Spirit came down on Jesus like a dove, and a voice from heaven said, "This is My beloved Son."', 'What did God say about Jesus that day?'],
    ['heaven/fountain-of-life', 'At a well, Jesus offered a woman living water. Whoever drinks the water he gives, he said, will never thirst.', 'What do you think "living water" means?'],
    ['heaven/sharing-pavilion', 'A boy shared five loaves and two fish, and Jesus fed five thousand men. "I am the bread of life," he said.', 'What small thing could you share?'],
    ['heaven/fruit-donkey', 'Crowds waved palm branches as Jesus rode into Jerusalem on a donkey, a gentle King.', 'Why do you think Jesus came on a donkey and not a war horse?'],
    ['heaven/banquet-hall', 'At the last supper Jesus washed his friends\' feet and shared bread and wine. "Love one another," he said.', 'What does it look like to serve others?'],
    ['heaven/sky-bridge', 'Jesus died on a cross. The Bible says he died for our sins, to bring us to God, like a bridge.', 'What did Jesus pray for the people who hurt him?'],
    ['heaven/garden-of-light', 'On the third day the tomb was empty. In the garden, Mary heard Jesus call her name. He is risen!', 'Why is the empty tomb good news?'],
    ['heaven/pearl-gate', 'We end at a gate that is never shut. The Bible\'s last page says God will make all things new, and invites everyone: "Come!"', 'What would you like to tell someone about this story?'],
  ],
  'think' => ['Which part of the story of Jesus would you like to read again?', 'Why do you think this story is called "good news"?', 'Read the whole story, part by part, starting at the Tree of life.'],
  'teach' => 'story-of-jesus-bible-lesson',
],
];

function person_img($w, $file, $sizes = '120px', $alt = '') {
  return img($w, $file, $alt, $sizes, 'loading="lazy"');
}

// A tour's guide: [name, role]. Usually a person of its world; the Green World has no people, so its tour is
// guided by one of its vehicles (with its own 'guideRole').
function tour_guide($t) {
  global $PEOPLE, $WORLD_DATA;
  $w = $t['world'];
  if (isset($PEOPLE[$w][$t['guide']])) return array_slice($PEOPLE[$w][$t['guide']], 0, 2);
  return [$WORLD_DATA[$w]['pages'][$t['guide']]['name'], $t['guideRole'] ?? ''];
}

function tour_card($slug) {
  global $TOURS, $PEOPLE, $WORLDS;
  $t = $TOURS[$slug];
  $w = $t['world'];
  [$gname] = tour_guide($t);
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
  'desc' => h('Six short guided tours, one through each world, led by one of its people, with a question at every stop. For families and classrooms.'),
  'class' => 'tours',
  'body' => <<<HTML
<section class="wrap section page-head">
  <p class="tag">Guided tours</p>
  <h1>Take a guided tour</h1>
  <p class="lead">Short walks through each world, led by one of its people. Every stop has a picture, a short explanation and a question to talk about. Use them on your own, as a family or with a class.</p>
  <ul class="tour-grid">{$tourCards}</ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Guided tours', '/tours/']]),
    ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => 'Guided tours', 'numberOfItems' => count($TOURS),
      'itemListElement' => array_map(fn($k, $slug) => ['@type' => 'ListItem', 'position' => $k + 1, 'name' => $TOURS[$slug]['h1'], 'url' => url("/tours/$slug/")], array_keys(array_keys($TOURS)), array_keys($TOURS))]],
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
  [$gname, $grole] = tour_guide($t);
  $stops = '';
  $nav = '';
  $stopList = [];
  foreach ($t['stops'] as $n => [$key, $say, $ask]) {
    [$sw, $ss] = explode('/', $key);
    $r = $WORLD_DATA[$sw]['pages'][$ss] ?? null;
    if (!$r) { fwrite(STDERR, "unknown tour stop $slug: $key\n"); continue; }
    $num = $n + 1;
    $stops .= '<li class="stop" id="stop-' . $num . '"><div class="stop-art"><a href="/worlds/' . $sw . '/' . $ss . '/" tabindex="-1" aria-hidden="true">'
      . img($sw, $ss, '', '(min-width: 900px) 280px, 70vw', 'loading="lazy"') . '</a></div>'
      . '<div class="stop-text"><p class="stop-num">Stop ' . $num . '</p><h2>' . h($r['name']) . '</h2>'
      . '<p class="stop-say">' . h($say) . '</p><p class="ask">' . h($ask) . '</p>'
      . '<p><a href="/worlds/' . $sw . '/' . $ss . '/">Read the full page about the ' . h(preg_replace('/^the /', '', strtolower($r['name']))) . '</a>'
      . (in_array($ss, $WORLD_DATA[$sw]['map']) || !empty($r['vehicle']) ? ' · <a href="/worlds/' . $sw . '/#find-' . $ss . '">Find it on the map</a>' : '') . '</p></div></li>';
    $stopList[] = ['@type' => 'ListItem', 'position' => $num, 'name' => $r['name'], 'url' => url("/worlds/$sw/$ss/")];
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
  $wcity = str_ends_with($WORLDS[$w]['name'], 'City') ? $wname : $wname . ' city';   // "Heavenly City", not "Heavenly City city"
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
  <aside class="b-toc" aria-label="Tour stops"><p class="toc-h">Tour stops</p><ol class="plain-ol">{$nav}<li><a href="#think">Think it over</a></li></ol><p><button type="button" class="btn btn-quiet btn-sm" data-listen=".tour-head h1, .bubble, .stop h2, .stop-say, .ask, #think h2, #think li" hidden aria-pressed="false">Listen to the tour</button> <button type="button" class="btn btn-quiet btn-sm js-print">Print this tour</button></p></aside>
  <div>
    <ol class="stops">{$stops}</ol>
    <section class="read panel" id="think" aria-labelledby="think-h">
      <h2 id="think-h">Think it over</h2>
      <ol class="questions">{$think}</ol>
      {$teach}
      <p><a class="btn" href="/worlds/{$w}/">Explore the whole {$wcity}</a></p>
    </section>
  </div>
</div>
<section class="wrap section" aria-labelledby="more-tours">
  <h2 id="more-tours">More tours</h2>
  <ul class="tour-grid">{$others}</ul>
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], ['Guided tours', '/tours/'], [$t['h1'], "/tours/$slug/"]]),
      learning($t['title'], $t['desc'], "/tours/$slug/", $t['theme']),
      ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => $t['h1'] . ': tour stops', 'numberOfItems' => count($stopList), 'itemListElement' => $stopList]],
  ]);
}
