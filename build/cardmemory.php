<?php
// Card memory (/play/card-memory/): fourteen trading cards, two of each world, turned over two at a time
// (public/js/cardmemory.js). The cards are the Life RPG game's painted world scenes in its painted card frames, with
// a gold card for the back (tools/copy-world-art.sh). Included from play.php, which has game_extras().

// Each world's card: the name on its top plate, and a line said when its pair is found.
$cmCards = [
  'egypt' => ['Ancient Egypt', 'Ancient Egypt: a city on the river Nile, with temples and pyramids.'],
  'roman' => ['Ancient Rome', 'Ancient Rome: stone arches, an aqueduct and a great amphitheater.'],
  'medieval' => ['Medieval Kingdom', 'Medieval Kingdom: a castle on the hill, a market square and a mill by the river.'],
  'modern' => ['Modern Town', 'Modern Town: a town hall, a fountain, parks and tall buildings.'],
  'green' => ['Green World', 'Green World: a city that grows with the forest.'],
  'future' => ['Robotic Future', 'Robotic Future: glass domes, helper robots and a rocket.'],
  'heaven' => ['Heavenly City', 'Heavenly City: the awaited city of gold and light.'],
];
// A frame's size and see-through window, for the card's style.
function cm_frame($name) {
  static $frames = null;
  $frames ??= json_decode(file_get_contents(PUB . '/assets/card-memory/frames.json'), true);
  $f = $frames["frame-$name"];
  return "aspect-ratio:{$f['w']}/{$f['h']};--ft:{$f['top']}%;--fr:{$f['right']}%;--fb:{$f['bottom']}%;--fl:{$f['left']}%";
}
// A small card for the game's place on /play/: a world's card, or the back (null).
function cm_mini($w = null) {
  $in = $w ? '<img class="cm-art" src="/assets/card-memory/' . $w . '.webp" width="480" height="564" alt="" loading="lazy" decoding="async">'
    : '<span class="cm-logo"><img src="/favicon.svg" width="44" height="44" alt=""></span>';
  $frame = '/assets/card-memory/frame-' . ($w ?? 'gold') . '.webp';
  [$fw, $fh] = getimagesize(PUB . $frame);
  return '<span class="pa-cmcard" style="' . cm_frame($w ?? 'gold') . '"><span class="cm-win">' . $in . '</span>'
    . '<img class="cm-frame" src="' . $frame . '" width="' . $fw . '" height="' . $fh . '" alt="" loading="lazy" decoding="async"></span>';
}
$cmData = [];
$n = 0;
foreach (WORLD_ORDER as $w) {
  $cmData[] = ['w' => $w, 'name' => $cmCards[$w][0], 'line' => $cmCards[$w][1], 'no' => sprintf('%02d/%02d', ++$n, count(WORLD_ORDER)), 'style' => cm_frame($w)];
}
$cmJson = json_encode(['cards' => $cmData, 'back' => cm_frame('gold')], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$cmExtras = game_extras('/play/card-memory/', 'Turn over two cards at a time. If they show the same world, they stay face up; if not, they turn back. Find all seven pairs in as few moves as you can.',
  'The seven city worlds of this site, and a better memory: try to remember where each card was.');
page('/play/card-memory/', [
  'title' => 'Card memory: match the painted city cards',
  'desc' => h('A free memory game with painted trading cards: turn them over two at a time and match the seven city worlds, from ancient Egypt to the Heavenly City.'),
  'class' => 'play card-memory-page',
  'js' => ['cardmemory'],
  'body' => <<<HTML
<div class="wrap">
  <nav class="crumbs" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li><a href="/play/">Play</a></li><li aria-current="page">Card memory</li></ol></nav>
</div>
<section class="wrap section cm" data-cardmemory aria-labelledby="cm-h">
  <h1 id="cm-h">Card memory</h1>
  <p class="lead">Turn over two cards at a time and find the seven pairs of city cards.</p>
  <div class="q-top"><p class="cm-pairs"></p><p class="cm-moves"></p><p class="cm-best"></p></div>
  <ul class="cm-grid"></ul>
  <p class="cm-status" aria-live="polite"></p>
  <p class="cm-actions"><button type="button" class="btn cm-again">Shuffle and play again</button></p>
  <noscript><p class="setting-note">Card memory needs JavaScript. You can still explore all seven worlds from the <a href="/">home page</a>.</p></noscript>
</section>
<script type="application/json" id="cardmemory-data">{$cmJson}</script>
{$cmExtras}
HTML,
  'ld' => [crumbs([['Home', '/'], ['Play and create', '/play/'], ['Card memory', '/play/card-memory/']]),
    learning('Card memory', 'A memory game with painted trading cards of seven city worlds.', '/play/card-memory/', 'Memory and the seven city worlds')],
]);
