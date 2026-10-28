<?php
// ---------- Life RPG (/life-rpg/): a separate game for grown-ups, sold for a one-time price ----------
// The game lives at its own address (LIFE_RPG_APP) and is sold by a store website, so this site still has no
// accounts, payments or cookies. While LIFE_RPG_BUY (config.php) is empty, the page and the home band say
// "Coming soon". The pictures in /assets/life-rpg/ are screenshots of the game, made from this site's artwork.

$lrpgPrice = h(LIFE_RPG_PRICE);
$lrpgBuy = LIFE_RPG_BUY
  ? '<p><a class="btn btn-big lrpg-buy" href="' . h(LIFE_RPG_BUY) . "\" rel=\"noopener\">Buy Life RPG · $lrpgPrice</a></p>"
    . '<p class="small">Opens our store, a separate website. Already bought it? <a href="' . h(LIFE_RPG_APP) . '">Open Life RPG</a></p>'
  : "<p class=\"lrpg-soon\">Coming soon · $lrpgPrice, one time</p>";

$lrpgShots = '';
foreach ([
  ['today', "Today's quests", 'The Today screen: level 7, an 18-day streak and three quests for the day, one of them done.'],
  ['city-roman', 'Your city grows', 'A Roman city of temples, homes and an aqueduct, built by finishing quests.'],
  ['hero', 'Skills and badges', 'The Hero screen: a block character, the next unlock and progress in seven skills.'],
  ['city-elven', 'Four worlds', 'An elven city in the forest, one of the four worlds to build in.'],
] as [$file, $cap, $alt]) {
  $lrpgShots .= "<li><figure><img src=\"/assets/life-rpg/$file.webp\" width=\"520\" height=\"1123\" alt=\"" . h($alt) . '" loading="lazy" decoding="async"><figcaption>' . h($cap) . '</figcaption></figure></li>';
}

page('/life-rpg/', [
  'title' => 'Life RPG: turn real-life goals into quests',
  'desc' => h('Life RPG is a game for grown-ups and teens: finish real-life quests to earn XP, level up and grow your own city in one of four worlds. One payment of ' . LIFE_RPG_PRICE . '.'),
  'class' => 'lrpg',
  'og' => 'life-rpg',
  'body' => <<<HTML
<section class="band band-dark lrpg-top">
  <div class="wrap lrpg-intro">
    <p class="tag">For grown-ups and teens</p>
    <h1>Life RPG</h1>
    <p class="lead">Turn real-life goals into quests. Finish them to earn XP, level up and grow your own city.</p>
    {$lrpgBuy}
  </div>
</section>

<section class="wrap section">
  <ul class="lrpg-shots">{$lrpgShots}</ul>
</section>

<section class="wrap section narrow lrpg-text">
  <h2>How it works</h2>
  <ul class="plain-points">
    <li>Pick a few quests for today: a workout, homework, reading, chores or a step toward a goal.</li>
    <li>Tap a quest when it's done to earn XP. Levels, skills and badges follow.</li>
    <li>Every quest builds part of your city, and milestones add landmarks.</li>
    <li>Take on a boss battle: one hard thing you've been putting off.</li>
    <li>Several players can share one device, with a family scoreboard.</li>
  </ul>
  <h2>Good to know</h2>
  <ul class="plain-points">
    <li>One payment of {$lrpgPrice}. No subscription and no ads.</li>
    <li>No account. Progress stays on your device, and you can save a backup file.</li>
    <li>Works on phones, tablets and computers, and offline once it's open.</li>
    <li>Starter quests for adults and for teens. You can change any of them.</li>
    <li>A grown-up buys it, on our store's website. This site never sees payment details.</li>
  </ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Life RPG', '/life-rpg/']])],
]);
