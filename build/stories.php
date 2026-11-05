<?php
// Picture-book stories (/stories/ and /stories/{world}/): the Life RPG game's three-chapter story for each world,
// in its own words (story.js in the game), with its 63 painted panels (tools/copy-story-art.sh).
// After each chapter: a short note from real life (or, for the Heavenly City, the Bible passage it comes from)
// and the building pages it touches. Loaded before worldpages.php, which links each world to its story.
//
// Each chapter: [title, [[caption, alt] x 3], note, [building pages], Bible references (Heavenly City only)].

$STORIES = [
'egypt' => ['A village on the Nile, from the yearly flood to a giant stone on the move.', [
  ['The Flood', [
    ['The Nile rises and covers the fields, as it does every year.', 'You stand on a mud-brick wall with a dog, looking over flooded fields and palm trees.'],
    ['You help build dikes and store grain while the water is high.', 'You and the villagers pack mud bricks along the riverbank while the water runs high.'],
    ['When the river falls, the dark soil is ready. Planting begins.', 'You scatter seed on dark, wet soil with the villagers, a temple behind you.']],
    'The real Nile flooded every summer and left rich black soil behind. The Egyptians called their country Kemet, the black land.',
    ['granary', 'lifting-lever', 'palm-grove']],
  ['The Scribe\'s Lesson', [
    ['The village needs a scribe to count the harvest.', 'Villagers measure grain in baskets at a granary while you watch.'],
    ['You practice writing on papyrus each night by lamplight.', 'You write on a papyrus scroll by lamplight on a terrace by the river.'],
    ['Your records are so neat that the overseer asks you to teach others.', 'The overseer shows your records to a group of new students.']],
    'Scribes wrote with reed pens on papyrus, a paper made from a reed that grew along the Nile. Few people could read, so scribes counted the harvests and the taxes.',
    ['scribe-school', 'house-of-life', 'great-library']],
  ['The Great Stone', [
    ['A huge block must be moved to the new temple.', 'Workers stand beside a huge stone block and a wooden sled.'],
    ['You train with the haulers, learning to pull together in rhythm.', 'You pull on a long rope with a line of haulers.'],
    ['On a sled over wet sand, the stone glides into place. The crowd cheers.', 'The block slides on its sled over wet sand while the crowd cheers.']],
    'A painting in an Egyptian tomb shows a giant statue on a sled, with a worker pouring water on the sand in front of it. Wet sand is much easier to drag a sled over than dry sand.',
    ['stone-sledge', 'pyramid', 'temple-gateway']],
]],
'roman' => ['A Roman town gets a new road, water for its fountains and a feast of thanks.', [
  ['The Road to the Hill', [
    ['A centurion hands you a map: a road must reach the hill town before winter.', 'A centurion in a red cloak and helmet hands you a map at a building site.'],
    ['Stone by stone, the road grows straight and true.', 'Workers lay big paving stones for a straight new road.'],
    ['Carts roll in with grain and news. The hill town is joined to the world.', 'A cart loaded with grain sacks rolls up the new road into the hill town.']],
    'Roman roads were built in layers of earth, gravel and stone, and many ran almost straight for miles. Some are still used today.',
    ['city-walls', 'ox-cart', 'warehouse']],
  ['Water for the City', [
    ['In the summer heat, the fountains run dry.', 'Townspeople look at a dry fountain in the hot sun.'],
    ['You work with the engineers to check every arch of the aqueduct.', 'You and an engineer check the stones of an aqueduct arch.'],
    ['Water rushes into the forum, and children splash at the fountains.', 'Water pours from the fountain again, and children splash in it.']],
    'Aqueducts carried water downhill on a very gentle slope, sometimes from many miles away, to the city\'s fountains, baths and homes.',
    ['aqueduct', 'public-fountain', 'forum']],
  ['The Harvest Feast', [
    ['The city plans a feast of thanks for the harvest.', 'Neighbors gather at long tables with grain, bread and grapes.'],
    ['Your family bakes bread and sets long tables for the neighbors.', 'Your family takes loaves from an oven and carries bread to the tables.'],
    ['The whole city eats together under the lanterns.', 'The city eats together at long tables under strings of lanterns.']],
    'Bread was the main food in Rome, and cities had many bakeries. In Pompeii, archaeologists found a bakery oven with loaves still inside.',
    ['street-food', 'farmhouse', 'olive-grove']],
]],
'medieval' => ['A castle town opens its old gate, saves its harvest and holds a tournament.', [
  ['The Old Castle', [
    ['An old castle stands empty on the hill, its gate rusted shut.', 'You climb a path to an empty castle with a rusty gate.'],
    ['The village blacksmith forges a new key, and you oil every hinge.', 'The blacksmith forges a key while you oil the hinges of the great door.'],
    ['The gate swings open. Banners go up, and the whole village comes to see.', 'Villagers stream through the open gate under red banners.']],
    'Real castle gates were guarded by a heavy grille called a portcullis, and the blacksmith made the iron for locks, hinges and tools.',
    ['royal-castle', 'gatehouse', 'blacksmith']],
  ['The Harvest Fair', [
    ['Rain has held up the harvest, and the fair is in a week.', 'Farmers look at wheat flattened by rain under dark clouds.'],
    ['You help every farm bring in its wheat before the next storm.', 'You carry sheaves of wheat to a cart with a farm family.'],
    ['The fair opens with bread, music and a pie as big as a cart wheel.', 'A fair with loaves of bread, music and a giant pie on a cart.']],
    'Most medieval people were farmers, and a wet harvest could mean a hungry winter. Towns held a market every week, and some held a big fair once a year.',
    ['farmstead', 'windmill', 'market-hall']],
  ['The Tournament', [
    ['A tournament is called, and every village sends its best rider.', 'Riders on decorated horses parade to the tournament field.'],
    ['You practice at the archery butts from morning till dusk.', 'You practice archery at straw targets, from morning until the sun goes down.'],
    ['You win the ribbon for fair play, and the crowd cheers your name.', 'A knight hands you a ribbon while the crowd claps.']],
    'At tournaments, knights jousted with blunted lances. In England, townsmen also practiced with the longbow at the archery butts.',
    ['tournament-field', 'archery-butts', 'training-yard']],
]],
'modern' => ['An empty lot by the river becomes a town, with a new bridge and a library full of light.', [
  ['A Fresh Start', [
    ['You arrive at a quiet lot by the river with a toolbox and a big idea.', 'You stand with a toolbox beside an empty lot by a river.'],
    ['Neighbors stop by. "Nobody has built here in years," one says. "What will you make?"', 'Neighbors gather around you to talk about the empty lot.'],
    ['By sunset the first walls stand. People start calling it a town.', 'Neighbors watch the first brick walls go up at sunset.']],
    'Before a new building goes up, the town checks its plans, so it will be safe and fit in with its neighbors.',
    ['building-materials', 'tower-crane', 'single-family-house']],
  ['The Bridge', [
    ['A storm washes out the old footbridge, and the kids can\'t reach the park.', 'Kids look at a footbridge broken by a muddy, rushing river.'],
    ['You train with the work crew, hauling beams day after day.', 'You and the work crew carry wooden beams to build a new bridge.'],
    ['The new bridge opens with a ribbon and a race across it. Everyone cheers.', 'Kids race across the new bridge past a red ribbon.']],
    'Bridges, sidewalks and parks belong to everyone. Towns pay for them with taxes and plan safe ways for kids to reach them.',
    ['streets-crosswalks', 'park-pond', 'playground']],
  ['Lights On', [
    ['The library has gone dark: the old wiring failed.', 'You and a friend look up at a library with dark windows.'],
    ['You study the plans at night and teach the helpers what each wire does.', 'You explain a wiring plan to your helpers at a desk in the library at night.'],
    ['One switch, and every window glows. The town reads late into the night.', 'You flip a switch, and every window of the library glows in the dark.']],
    'A public library is free for everyone. Electricians check its wiring, because old wires can wear out and become unsafe.',
    ['public-library', 'school', 'science-center']],
]],
'green' => ['A forest village grows a tree from a seed, links its tree homes and builds a hall for songs.', [
  ['The Seed', [
    ['In the forest, an old gardener hands you a seed as big as your hand.', 'An old gardener hands you a big seed beside a forest village.'],
    ['You water it each day and build a fence to keep the deer away.', 'You water a young tree inside a little fence while deer watch.'],
    ['It grows into a tall young tree full of birds. The forest folk move closer.', 'The villagers gather by the new tree, full of birds.']],
    'Real trees grow slowly. An oak can take 20 years or more to grow its first acorns, and it can live for hundreds of years.',
    ['wild-grove', 'garden-court', 'flower-meadow']],
  ['Rope Bridges', [
    ['The tree homes are far apart, and climbing between them takes all day.', 'You look up at tree houses high in giant trees, far apart.'],
    ['You practice climbing and knots until your hands are sure.', 'A helper teaches you knots with climbing ropes beside a great tree.'],
    ['Rope bridges link every tree, with lanterns swaying along them at dusk.', 'You cross a rope bridge strung with lanterns at dusk.']],
    'Rope bridges are still built across rivers and valleys, and canopy walkways let scientists study the tops of trees without harming them.',
    ['canopy-walkway', 'treetop-village', 'tree-tower-home']],
  ['The Song Hall', [
    ['The forest folk want a place to share their stories.', 'Villagers sit with you around the plans for a hall.'],
    ['You learn the old songs from the grandparents and write them down.', 'You write down songs while a grandfather plays a lute and a grandmother sings.'],
    ['The hall fills with music, and the little ones sing the old songs back.', 'Children sing from songbooks in the hall while the grandparents listen.']],
    'Before books were common, songs and stories were passed down by heart, from grandparents to grandchildren.',
    ['open-air-theater', 'tree-library', 'great-tree-hall']],
]],
'future' => ['A young settler powers up a colony, rescues a lost rover and opens the first school.', [
  ['Power Up', [
    ['Your shuttle lands on a quiet plain. The solar field is dusty and dim.', 'You step off a shuttle beside dusty solar panels, with domes in the distance.'],
    ['You clean panel after panel with the robot crew.', 'You and the robots wipe the dust off the solar panels.'],
    ['The grid hums to life, and domes light up across the plain.', 'The domes light up while robots cheer beside you.']],
    'On Mars, dust really does settle on solar panels. NASA\'s rovers Spirit and Opportunity lost power to dust, and gusts of wind sometimes blew their panels clean.',
    ['power-tower', 'robot-helpers', 'habitat-cluster']],
  ['The Lost Rover', [
    ['A supply rover has gone silent out in the canyon.', 'You look through binoculars at a rover stuck in a red canyon.'],
    ['You train for the long walk and pack the repair kit.', 'A robot helps you pack a backpack and a repair kit.'],
    ['You find it, fix its wheel and drive it home with the supplies.', 'You fix the rover\'s wheel and drive it home to the colony.']],
    'Radio messages take several minutes to travel between Earth and Mars, so rovers there have to look after themselves between orders.',
    ['pressurized-rover', 'rover-track', 'comms-relay']],
  ['First Class', [
    ['The colony\'s kids have no school yet.', 'The colony\'s kids sit on the ground outside an old hangar.'],
    ['You turn the old hangar into classrooms and write the first lessons.', 'You write the first lesson on a board in the new classroom while robots help.'],
    ['On the first day twenty kids pour in. One says she wants to be a pilot.', 'Kids pour into the new school, and one girl dreams of flying.']],
    'Astronauts on the International Space Station have taught lessons to schools on Earth by radio and video call.',
    ['science-lab', 'airlock-hangar', 'telepresence']],
]],
'heaven' => ['A visit to the holy city the Bible describes: an open gate, the river of life and a song from every nation.', [
  ['The Open Gate', [
    ['You stand before a gate of pearl, and it is open.', 'You stand before a tall, open gate of pearl in a golden city.'],
    ['Inside, people are building homes of light, and everyone is welcome.', 'People build homes from white blocks and welcome you.'],
    ['Someone hands you a hammer and smiles: "There is a place for you here."', 'A builder smiles and hands you a hammer beside a new home.']],
    'The Bible says the twelve gates of the holy city are pearls, and that its gates will never be shut. Jesus promised his friends that he would prepare a place for them.',
    ['pearl-gate', 'house-of-many-rooms', 'welcome-hall'], 'Revelation 21:21–25; John 14:1–3'],
  ['The River', [
    ['A river, clear as crystal, flows through the middle of the city.', 'You look at a clear river flowing through the city.'],
    ['You help plant trees along its banks, row after row.', 'You plant young trees along the riverbank with your neighbors.'],
    ['The trees bear fruit every month, and their leaves bring healing.', 'Families share baskets of fruit under the trees by the river.']],
    'The Bible describes the river of the water of life, clear as crystal, and the tree of life beside it, bearing fruit every month, with leaves for the healing of the nations.',
    ['tree-of-life', 'fountain-of-life', 'garden-of-light'], 'Revelation 22:1–2'],
  ['The Song', [
    ['People from every nation gather in the great square.', 'People from many nations gather in the great square.'],
    ['You practice the songs with your family each day.', 'You sing with your family beside a fountain while a man plays the guitar.'],
    ['Together you sing, and the whole city joins in praise.', 'The whole square sings together.']],
    'The Bible describes a great crowd from every nation, tribe, people and language, standing together and praising God.',
    ['harp-workshop', 'bell-tower', 'rainbow-pavilion'], 'Revelation 7:9–10'],
]],
];

// The story's panel as an <img>: 600 pixels wide for the page, 1200 for big screens.
function story_img($w, $c, $p, $alt, $sizes = '(min-width: 1000px) 380px, (min-width: 640px) 46vw, 92vw', $attrs = 'loading="lazy"') {
  $a = "/assets/stories/$w/$c-$p";
  return '<img src="' . $a . '-600.webp?v=' . asset_v("$a-600.webp") . '" srcset="' . $a . '-600.webp?v=' . asset_v("$a-600.webp") . ' 600w, ' . $a . '-1200.webp?v=' . asset_v("$a-1200.webp") . ' 1200w" sizes="' . $sizes . '" width="1200" height="900" alt="' . h($alt) . '" decoding="async" ' . $attrs . '>';
}
// A building page as a small picture link.
function story_chip($w, $slug) {
  global $WORLD_DATA;
  $r = $WORLD_DATA[$w]['pages'][$slug] ?? null;
  if (!$r) { fwrite(STDERR, "story: unknown page $w/$slug\n"); return ''; }
  $t = "/assets/thumbs/$w/$slug.webp";
  $pic = is_file(PUB . $t) ? '<img src="' . $t . '?v=' . asset_v($t) . '" width="64" height="64" alt="" loading="lazy" decoding="async">' : '';
  return '<li><a href="/worlds/' . $w . '/' . $slug . '/">' . $pic . '<span>' . h($r['name']) . '</span></a></li>';
}
function story_title($w) {
  global $STORIES;
  $t = array_column($STORIES[$w][1], 0);
  return "$t[0], $t[1] and $t[2]";
}

$storyOrder = array_values(array_filter(WORLD_ORDER, fn($w) => isset($STORIES[$w])));
foreach ($storyOrder as $i => $w) {
  [$lead, $chapters] = $STORIES[$w];
  $W = $WORLDS[$w];
  $name = h($W['name']);
  $body = '';
  $listen = [];
  foreach ($chapters as $n => $ch) {
    [$title, $panels, $note, $links] = $ch;
    $bible = $ch[4] ?? '';
    $c = $n + 1;
    $figs = '';
    foreach ($panels as $p => [$cap, $alt]) {
      $big = "/assets/stories/$w/$c-" . ($p + 1) . '-1200.webp';
      $figs .= '<figure class="story-panel"><button type="button" class="lb" data-full="' . $big . '?v=' . asset_v($big) . '" data-title="' . h("Chapter $c: $title, picture " . ($p + 1)) . '" data-credit="Painting from Life RPG, the game behind The Atlas of Cities" data-download="atlas-of-cities-story-' . $w . "-$c-" . ($p + 1) . '.webp">'
        . story_img($w, $c, $p + 1, $alt, '(min-width: 1000px) 380px, (min-width: 640px) 46vw, 92vw', $n === 0 && $p === 0 ? 'fetchpriority="high"' : 'loading="lazy"')
        . '</button><figcaption>' . h($cap) . '</figcaption></figure>';
    }
    $chips = implode('', array_map(fn($s) => story_chip($w, $s), $links));
    $label = $bible ? 'In the Bible' : 'From real life';
    $ref = $bible ? ' <span class="story-ref">' . h($bible) . '</span>' : '';
    $body .= '<section class="story-ch" aria-labelledby="ch' . $c . '-h"><h2 id="ch' . $c . '-h"><span class="story-n">Chapter ' . $c . '</span> ' . h($title) . '</h2>'
      . '<div class="story-panels">' . $figs . '</div>'
      . '<div class="story-real"><p><b>' . $label . ':</b> ' . h($note) . $ref . '</p><ul class="story-links" aria-label="Places in this chapter">' . $chips . '</ul></div></section>';
  }
  // the other stories
  $more = '';
  foreach ($storyOrder as $o) if ($o !== $w) $more .= '<li class="world-' . $o . '"><a href="/stories/' . $o . '/">' . story_img($o, 1, 3, '', '160px') . '<span>' . h($WORLDS[$o]['name']) . '</span></a></li>';
  $tour = world_tour($w);
  $tourLink = $tour[1] ? ' · <a href="/tours/' . $tour[0] . '/">Take the guided tour</a>' : '';
  $titleText = story_title($w);
  page("/stories/$w/", [
    'title' => "$W[name]: a picture-book story for kids",
    'desc' => h("A free picture-book story in three chapters, set in the $W[name] of The Atlas of Cities: $titleText. $lead"),
    'class' => "story-page world-$w",
    'og' => "stories/$w",
    'ogAlt' => "A painted scene from the $W[name] story",
    'lightbox' => true,
    'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li><a href="/stories/">Stories</a></li><li aria-current="page">{$name}</li></ol></nav>
</div>
<section class="wrap section story-head">
  <p class="tag">Picture-book story</p>
  <h1>{$name}: a story in three chapters</h1>
  <p class="lead">{$lead} You are the young builder with the satchel and the toolbox.</p>
  <p class="story-tools"><button type="button" class="btn btn-quiet btn-sm" data-listen=".story-head h1, .story-ch h2, .story-panel figcaption, .story-real p" hidden aria-pressed="false">Listen to the story</button> <button type="button" class="btn btn-quiet btn-sm js-print">Print the story</button></p>
</section>
<div class="wrap story-book">{$body}</div>
<section class="wrap section story-end" aria-labelledby="end-h">
  <h2 id="end-h">The end. Now explore the real places</h2>
  <p><a class="btn" href="/worlds/{$w}/">Explore the {$name}</a> <a class="btn btn-quiet" href="/worlds/{$w}/people/">Meet the people</a></p>
  <p class="small">The paintings come from <a href="/life-rpg/">Life RPG</a>, the city-building game behind this site{$tourLink}.</p>
  <h2>More stories</h2>
  <ul class="story-more">{$more}</ul>
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Stories', '/stories/'], [$W['name'], "/stories/$w/"]]),
      learning("$W[name] story", "A picture-book story in three chapters: $titleText.", "/stories/$w/", 'Reading and city life')],
  ]);
}

// ---------- The hub ----------
$cards = '';
foreach ($storyOrder as $w) {
  $W = $WORLDS[$w];
  $cards .= '<li class="story-card world-' . $w . '"><a href="/stories/' . $w . '/">' . story_img($w, 1, 3, '', '(min-width: 1000px) 380px, (min-width: 640px) 46vw, 92vw')
    . '<span class="story-card-text"><span class="tag">' . h($W['type']) . '</span><span class="play-title">' . h($W['name']) . '</span><span class="what">' . h(story_title($w)) . '</span></span></a></li>';
}
$storyCount = count($storyOrder);
page('/stories/', [
  'title' => 'Picture-book stories from seven city worlds',
  'desc' => h("$storyCount free picture-book stories for kids, one in each city world, from ancient Egypt to Mars and the heavenly city. Read them together, print them, or listen."),
  'class' => 'story-page',
  'og' => 'stories/medieval',
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Stories</li></ol></nav>
</div>
<section class="wrap section page-head">
  <h1>Picture-book stories</h1>
  <p class="lead">A short story in every world, in three chapters of painted pictures. You are the young builder with the satchel and the toolbox. Read them together, print them, or press Listen. After each chapter, find out what it was like in real life.</p>
  <ul class="story-cards">{$cards}</ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Stories', '/stories/']])],
]);
