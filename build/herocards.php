<?php
// Hero Cards (/play/hero-cards/): a card duel against the computer with the Life RPG game's Founders set, 48 cards,
// 8 from each world. Winning a duel lets you keep one of the computer's cards for an album saved in this browser only
// (public/js/herocards.js). The pictures and painted frames come from the game (tools/copy-card-art.sh).
//
// Names, numbers and stats match the game's cards.js, so a card here is the same card as in the game's album.
// Two Green World lines are the site's own (no mystical words), and the Heavenly City cards carry a Bible reference
// (BSB, checked with the Bible lookup).

// Kinds, and which stat each kind is best at (the game's CARD_MAIN): that stat gets +2.
const HC_KINDS = ['hero' => ['Hero', 'str'], 'builder' => ['Builder', 'str'], 'vehicle' => ['Vehicle', 'str'], 'creature' => ['Creature', 'hrt'],
  'treasure' => ['Treasure', 'hrt'], 'landmark' => ['Landmark', 'wis'], 'gear' => ['Gear', 'wis']];
const HC_STATS = ['str' => 'Strength', 'wis' => 'Wisdom', 'hrt' => 'Heart'];
const HC_RARITY = ['common' => ['Common', [2, 5]], 'gold' => ['Gold', [4, 7]], 'emerald' => ['Emerald', [6, 9]]];
// In the game's order, which gives the numbers 001 to 048. Keys are the game's world ids ("elven" is the Green World).
// [id, name, kind, rarity, line, page on this site ('' if none), Bible reference]
const HC_LIST = [
  'modern' => [
    ['firefighter', 'Firefighter', 'hero', 'common', 'First in, last out, every time.', ''],
    ['crane_op', 'Crane Operator', 'builder', 'common', 'Lifts steel beams like feathers.', 'tower-crane'],
    ['retriever', 'Golden Retriever', 'creature', 'common', 'Best friend of the whole block.', ''],
    ['city_bus', 'City Bus', 'vehicle', 'common', 'Gets everyone where they need to go.', ''],
    ['skate_park', 'Skate Park', 'landmark', 'common', 'Fall down, get up, try again.', ''],
    ['heli', 'Rescue Helicopter', 'vehicle', 'gold', 'Help from above, day or night.', ''],
    ['toolbox', 'Inventor\'s Toolbox', 'gear', 'gold', 'Every great idea starts here.', ''],
    ['skyline', 'Skyline Tower', 'landmark', 'emerald', 'Built one floor at a time.', 'skyscraper']],
  'roman' => [
    ['scout', 'Legion Scout', 'hero', 'common', 'Watches the road so others can rest.', ''],
    ['mason', 'Stone Mason', 'builder', 'common', 'Square stones, straight walls.', ''],
    ['horse', 'War Horse', 'creature', 'common', 'Brave, loyal and fast.', ''],
    ['chariot', 'Chariot', 'vehicle', 'common', 'Two wheels and a lot of courage.', 'chariot'],
    ['aqueduct', 'Aqueduct', 'landmark', 'common', 'Fresh water for the whole city.', 'aqueduct'],
    ['centurion', 'Centurion', 'hero', 'gold', 'Leads a hundred by example.', ''],
    ['eagle', 'Eagle Standard', 'treasure', 'gold', 'Carried high, never dropped.', ''],
    ['colosseum', 'Colosseum', 'landmark', 'emerald', 'Fifty thousand seats of stone.', 'amphitheater']],
  'elven' => [
    ['ranger', 'Forest Ranger', 'hero', 'common', 'Knows every path in the woods.', ''],
    ['treehouse', 'Treehouse Builder', 'builder', 'common', 'Homes high in the branches.', ''],
    ['fox', 'Woodland Fox', 'creature', 'common', 'Quick feet, quiet paws.', ''],
    ['glider', 'Leaf Glider', 'vehicle', 'common', 'Rides the wind between the trees.', ''],
    ['bridge', 'Mushroom Bridge', 'landmark', 'common', 'Crosses the creek in one hop.', ''],
    ['stag', 'White Stag', 'creature', 'gold', 'Quiet and quick in the deep woods.', ''],
    ['harp', 'Silver Harp', 'gear', 'gold', 'Music for evenings in the village.', ''],
    ['great_tree', 'Great Tree Hall', 'landmark', 'emerald', 'A thousand years of growing.', 'great-tree-hall']],
  'future' => [
    ['cadet', 'Space Cadet', 'hero', 'common', 'Studies the stars every night.', ''],
    ['robot', 'Robot Helper', 'builder', 'common', 'Never tired, always polite.', ''],
    ['robo_pup', 'Robo Pup', 'creature', 'common', 'Fetches anything, even data.', ''],
    ['hover_bike', 'Hover Bike', 'vehicle', 'common', 'No wheels, no traffic.', ''],
    ['solar', 'Solar Garden', 'landmark', 'common', 'Grows food and power together.', 'greenhouse-dome'],
    ['pilot', 'Star Pilot', 'hero', 'gold', 'Steady hands at light speed.', ''],
    ['holo_map', 'Holo Map', 'gear', 'gold', 'Shows the way to anywhere.', ''],
    ['station', 'Sky Station', 'landmark', 'emerald', 'A city floating above the clouds.', '']],
  'heaven' => [
    ['singer', 'Choir Singer', 'hero', 'common', 'Sings with the whole heart.', '', 'Psalm 9:1'],
    ['paver', 'Street Builder', 'builder', 'common', 'Lays streets of shining gold.', '', 'Revelation 21:21'],
    ['dove', 'White Dove', 'creature', 'common', 'A sign of peace.', 'dove-statue', 'Genesis 8:11'],
    ['lamb', 'Little Lamb', 'creature', 'common', 'Gentle, and never lost for long.', '', 'Luke 15:4'],
    ['river', 'River of Life', 'landmark', 'common', 'Clear as crystal.', 'fountain-of-life', 'Revelation 22:1'],
    ['pearl_gate', 'Pearl Gate', 'landmark', 'gold', 'Always open for the welcome.', 'pearl-gate', 'Revelation 21:25'],
    ['tree_life', 'Tree of Life', 'landmark', 'gold', 'Fruit every month of the year.', 'tree-of-life', 'Revelation 22:2'],
    ['crown', 'Crown of Life', 'treasure', 'emerald', 'For the ones who kept going.', '', 'James 1:12']],
  'egypt' => [
    ['fisher', 'River Fisher', 'hero', 'common', 'Up before the sun on the Nile.', ''],
    ['pyr_builder', 'Pyramid Builder', 'builder', 'common', 'One block, then the next.', ''],
    ['camel', 'Camel', 'creature', 'common', 'Crosses the desert without a sip.', 'camel'],
    ['reed_boat', 'Reed Boat', 'vehicle', 'common', 'Light enough to carry, strong enough to sail.', 'papyrus-boat'],
    ['oasis', 'Desert Oasis', 'landmark', 'common', 'Shade and water in the sand.', ''],
    ['scribe', 'Royal Scribe', 'hero', 'gold', 'Writes down what matters.', 'scribe-school'],
    ['granary', 'Joseph\'s Granary', 'landmark', 'gold', 'Saved in the good years for the hard ones.', 'granary'],
    ['great_pyramid', 'Great Pyramid', 'landmark', 'emerald', 'Still standing after 4,500 years.', 'pyramid']],
];

// The game's fixed roll (FNV-1a on the text, 0 to 1), so the stats come out the same as in the game.
function hc_roll($s) {
  $h = 2166136261;
  for ($i = 0, $n = strlen($s); $i < $n; $i++) { $h ^= ord($s[$i]); $h = ($h * 16777619) & 0xFFFFFFFF; }
  return $h / 4294967296;
}
function hc_cards() {
  static $all = null;
  if ($all !== null) return $all;
  $all = [];
  foreach (HC_LIST as $gw => $list) foreach ($list as $c) {
    [$id, $name, $kind, $rar, $line, $page] = $c;
    $w = $gw === 'elven' ? 'green' : $gw;
    [$lo, $hi] = HC_RARITY[$rar][1];
    $stats = [];
    foreach (HC_STATS as $s => $_) $stats[] = min(10, $lo + (int)floor(hc_roll("$s|{$gw}_$id") * ($hi - $lo + 1)) + (HC_KINDS[$kind][1] === $s ? 2 : 0));
    $all[] = ['i' => "{$w}_$id", 'w' => $w, 'n' => $name, 'k' => $kind, 'r' => $rar, 'l' => $line, 's' => $stats, 'no' => count($all) + 1,
      'p' => "/assets/cards/$w-$id.webp", 'u' => $page ? "/worlds/$w/$page/" : '', 'v' => $c[6] ?? ''];
  }
  return $all;
}
// Each frame's see-through window in % (top, right, bottom, left) and its size, measured by the game.
function hc_frames() {
  static $f = null;
  return $f ??= array_map(fn($x) => [$x['top'], $x['right'], $x['bottom'], $x['left'], $x['w'], $x['h']],
    json_decode(file_get_contents(PUB . '/assets/cards/frames.json'), true));
}
const HC_ICONS = ['str' => 'M13 2 4 14h7l-1 8 9-12h-7z', 'wis' => 'M3 5c3-1 6-.5 9 1.5 3-2 6-2.5 9-1.5v14c-3-1-6-.5-9 1.5-3-2-6-2.5-9-1.5z',
  'hrt' => 'M12 21s-8.5-5.2-8.5-11.2A4.6 4.6 0 0 1 12 7.3a4.6 4.6 0 0 1 8.5 2.5C20.5 15.8 12 21 12 21z'];
// One card, drawn the same way as herocards.js draws it (for the picture on the start screen and the Play page).
function hc_card_html($c, $lazy = true) {
  $fname = $c['r'] === 'common' ? 'frame-' . $c['w'] : 'frame-' . $c['r'];
  [$t, $r, $b, $l, $fw, $fh] = hc_frames()[$fname];
  $total = str_pad((string)count(hc_cards()), 3, '0', STR_PAD_LEFT);
  $ld = $lazy ? ' loading="lazy"' : '';
  $stats = '';
  foreach (array_keys(HC_STATS) as $k => $s) $stats .= '<span class="hc-st st-' . $s . '"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="' . HC_ICONS[$s] . '"/></svg>' . $c['s'][$k] . '</span>';
  return '<span class="hc r-' . $c['r'] . ($fname === 'frame-heaven' ? ' hc-light' : '') . '" style="aspect-ratio:' . $fw . '/' . $fh . ';--ft:' . $t . '%;--fr:' . $r . '%;--fb:' . $b . '%;--fl:' . $l . '%;--frame:url(/assets/cards/' . $fname . '.webp)">'
    . '<span class="hc-win"><img class="hc-pic" src="' . $c['p'] . '" alt=""' . $ld . '><span class="hc-stats">' . $stats . '</span></span>'
    . '<img class="hc-frame" src="/assets/cards/' . $fname . '.webp" alt=""' . $ld . '>'
    . '<span class="hc-name">' . h($c['n']) . '</span><span class="hc-no">' . str_pad((string)$c['no'], 3, '0', STR_PAD_LEFT) . '/' . $total . '</span></span>';
}
function hc_by_id($id) { foreach (hc_cards() as $c) if ($c['i'] === $id) return $c; return null; }

// The page itself, built after play.php (it uses game_extras()); this file is loaded before it, for the Play page's card.
function hc_page() {
global $WORLDS;
$hcData = json_encode([
  'cards' => hc_cards(),
  'frames' => hc_frames(),
  'worlds' => array_combine(WORLD_ORDER, array_map(fn($w) => $WORLDS[$w]['name'], WORLD_ORDER)),
  'order' => WORLD_ORDER,
  'kinds' => array_map(fn($k) => $k[0], HC_KINDS),
  'stats' => HC_STATS,
  'icons' => HC_ICONS,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$hcFan = '';
foreach (['roman_colosseum', 'heaven_tree_life', 'egypt_camel'] as $id) $hcFan .= hc_card_html(hc_by_id($id), false);
$hcLevels = '';
foreach (['easy' => 'Easy', 'hard' => 'Hard'] as $v => $label) $hcLevels .= '<label><input type="radio" name="hc-level" value="' . $v . '"' . ($v === 'easy' ? ' checked' : '') . '> ' . $label . '</label>';
$hcStatIcons = '';
foreach (HC_STATS as $s => $label) $hcStatIcons .= '<li class="st-' . $s . '"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="' . HC_ICONS[$s] . '"/></svg>' . h($label) . '</li>';
$hcExtras = game_extras('/play/hero-cards/', 'You and the computer each get five cards. Every round names a stat (Strength, Wisdom or Heart) and a home world. Pick a card: the higher number wins the round, and a card from the home world gets 2 extra. Win more of the five rounds, then keep one of the computer\'s cards for your album.',
  'Which world each person, animal, vehicle and landmark belongs to, and how to plan ahead: a strong card used now is gone for the next round.');
page('/play/hero-cards/', [
  'title' => 'Hero Cards: a card duel with six city worlds',
  'desc' => h('A free card game for kids: duel the computer with 48 painted cards from ancient Egypt, Rome, a modern town and more, and collect them in an album.'),
  'class' => 'play hc-page',
  'js' => ['herocards'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Hero Cards</li></ol></nav>
</div>
<section class="wrap section hcg" data-herocards aria-labelledby="hc-h">
  <h1 id="hc-h">Hero Cards</h1>
  <div class="hcg-start">
    <div class="hcg-fan" aria-hidden="true">{$hcFan}</div>
    <div class="hcg-intro">
      <p class="lead">Duel the computer with cards from six worlds. Win, and keep one of its cards for your album.</p>
      <ul class="hcg-stat-key" aria-label="The three stats">{$hcStatIcons}</ul>
      <fieldset class="hcg-level"><legend>Computer player</legend>{$hcLevels}</fieldset>
      <p class="hcg-welcome" hidden></p>
      <p><button type="button" class="btn hcg-play">Play a duel</button> <button type="button" class="btn btn-quiet hcg-open-album">Your album <span class="hcg-count"></span></button></p>
    </div>
  </div>
  <div class="hcg-duel" hidden>
    <div class="q-top"><p class="hcg-round"></p><p class="hcg-score"></p></div>
    <p class="hcg-call"></p>
    <div class="hcg-arena">
      <div class="hcg-board">
        <div class="hcg-table">
          <div class="hcg-seat"><p class="hcg-who">You</p><div class="hcg-slot hcg-you"></div><p class="hcg-sum hcg-you-sum"></p></div>
          <div class="hcg-seat"><p class="hcg-who">Computer</p><div class="hcg-slot hcg-cpu"></div><p class="hcg-sum hcg-cpu-sum"></p></div>
        </div>
        <p class="hcg-status" aria-live="polite"></p>
        <p class="hcg-actions"><button type="button" class="btn hcg-next" hidden>Next round</button></p>
      </div>
      <div class="hcg-handbox">
        <h2 class="hcg-hand-h">Your cards: pick one</h2>
        <ul class="hcg-hand"></ul>
      </div>
    </div>
  </div>
  <div class="hcg-end" hidden>
    <h2 class="hcg-end-h" tabindex="-1"></h2>
    <p class="hcg-end-text"></p>
    <ul class="hcg-prize"></ul>
    <p class="hcg-actions"><button type="button" class="btn hcg-again">Play again</button> <button type="button" class="btn btn-quiet hcg-open-album">Your album</button></p>
  </div>
  <div class="hcg-album" hidden>
    <h2 class="hcg-album-h" tabindex="-1">Your album</h2>
    <p class="hcg-album-count"></p>
    <div class="hcg-tabs" role="group" aria-label="Show one world"></div>
    <div class="hcg-sets"></div>
    <p class="hcg-actions"><button type="button" class="btn hcg-play">Play a duel</button> <button type="button" class="btn btn-quiet hcg-back">Back</button></p>
  </div>
  <dialog class="hcg-dlg" aria-labelledby="hcg-dlg-h">
    <h2 id="hcg-dlg-h" class="hcg-dlg-h"></h2>
    <div class="hcg-flip"><div class="hcg-flip-in"></div></div>
    <p class="hcg-dlg-meta"></p>
    <p class="hcg-actions"><button type="button" class="btn hcg-turn">Turn over</button> <a class="btn btn-quiet hcg-read" hidden>Read about it</a> <button type="button" class="btn btn-quiet hcg-close">Close</button></p>
  </dialog>
  <noscript><p class="setting-note">Hero Cards needs JavaScript. You can still explore every world from the <a href="/">home page</a>.</p></noscript>
</section>
<script type="application/json" id="hc-data">{$hcData}</script>
{$hcExtras}
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Hero Cards', '/play/hero-cards/']]),
    learning('Hero Cards', 'A card duel with 48 cards of people, animals, vehicles and landmarks from six illustrated city worlds.', '/play/hero-cards/', 'Comparing cities and planning ahead')],
]);
}
