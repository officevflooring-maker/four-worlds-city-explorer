<?php
// ---------- The shop: things for grown-ups to buy, made from the four worlds ----------
// /shop/ lists them; each has its own page: /life-rpg/ (an app, unlocked with a key), /city-builders/ (a print-and-play
// card game), /classroom-pack/ (a print-ready teaching pack) and /posters/ (posters to print, pay what you want, which
// is also how the Support page takes support). The store delivers the file or the key by itself, so this site still
// has no accounts, payments or cookies. Prices and checkout links are in config.php (SHOP); while a link is empty the
// product says "Coming soon". The pictures come from the products themselves (see the README).

$SHOP_INFO = [
  'life-rpg' => ['Life RPG', '/life-rpg/', 'An app for real-life goals', 'Turn real-life goals into quests, earn XP and grow your own city.', '/assets/life-rpg/city-roman-wide.webp', 520, 300],
  'city-builders' => ['City Builders', '/city-builders/', 'A card game to print at home', 'Collect buildings from four worlds and build a city that has everything its people need.', '/assets/shop/city-builders-fan.webp', 1100, 513],
  'classroom-pack' => ['Classroom Pack', '/classroom-pack/', 'A teaching pack to print', 'Fact cards, worksheets with answer keys and discussion cards, in one file.', '/assets/shop/classroom-pack-pages.webp', 1100, 697],
  'posters' => ['Poster Set', '/posters/', 'Posters to print', 'The four worlds, their places and the ten things every city needs, for your wall.', '/assets/shop/posters-fan.webp', 1100, 697],
];

// A checkout link has to come from the store's Share button. Anything else stops the build, including the
// ".../checkout/?cart=..." address a browser shows once a checkout is open, which works only once.
foreach (SHOP as $slug => $p) {
  if ($p['buy'] !== '' && !preg_match('~^' . preg_quote(STORE_URL, '~') . '/(checkout/)?buy/[\w-]+(\?[^\s"<>]*)?$~', $p['buy'])) {
    fwrite(STDERR, "config.php: the 'buy' link for $slug isn't a checkout link from " . STORE_URL . ". In the store, open the product, click Share and copy the link.\n");
    exit(1);
  }
}

function shop_price($slug) { return h(SHOP[$slug]['price']); }
function shop_open($slug) { return SHOP[$slug]['buy'] !== ''; }
function shop_from($slug) { return !empty(SHOP[$slug]['from']); }
function shop_terms($slug) { return shop_from($slug) ? 'pay what you want, from ' . shop_price($slug) : shop_price($slug) . ', one time'; }

// The buy button, or "Coming soon" until the store's link is set.
function shop_buy($slug) {
  global $SHOP_INFO;
  if (!shop_open($slug)) return '<p class="shop-soon">Coming soon · ' . shop_terms($slug) . '</p>';
  $name = h($SHOP_INFO[$slug][0]);
  $price = (shop_from($slug) ? 'from ' : '') . shop_price($slug);
  $more = $slug === 'life-rpg' && !empty(SHOP[$slug]['open']) ? ' Already bought it? <a href="' . h(SHOP[$slug]['open']) . '">Open Life RPG</a>' : '';
  return '<p><a class="btn btn-big shop-buy" href="' . h(SHOP[$slug]['buy']) . "\" rel=\"noopener\">Buy $name · $price</a></p>"
    . "<p class=\"small shop-note\">Opens our store, a separate website.$more</p>";
}

function shop_card($slug) {
  global $SHOP_INFO;
  [$name, $url, $kind, $line, $img, $w, $hh] = $SHOP_INFO[$slug];
  $state = shop_open($slug) ? ucfirst(shop_terms($slug)) : 'Coming soon';
  return "<li class=\"shop-card\"><a href=\"$url\"><span class=\"shop-card-pic\"><img src=\"$img\" width=\"$w\" height=\"$hh\" alt=\"\" loading=\"lazy\" decoding=\"async\"></span>"
    . '<span class="shop-card-text"><span class="shop-kind">' . h($kind) . '</span><span class="shop-name">' . h($name) . '</span>'
    . '<span class="shop-line">' . h($line) . "</span><span class=\"shop-state\">$state</span></span></a></li>";
}
function shop_cards($except = '') {
  global $SHOP_INFO;
  return '<ul class="shop-cards">' . implode('', array_map('shop_card', array_filter(array_keys($SHOP_INFO), fn($s) => $s !== $except))) . '</ul>';
}

function shop_steps($steps) {
  $out = '';
  foreach ($steps as $i => [$title, $text]) $out .= '<li><span class="shop-step-n" aria-hidden="true">' . ($i + 1) . '</span><b>' . h($title) . '</b> ' . h($text) . '</li>';
  return "<ol class=\"shop-steps\">$out</ol>";
}
function shop_feats($feats) {
  $out = '';
  foreach ($feats as [$icon, $title, $text]) $out .= "<li><span class=\"shop-feat-icon\" aria-hidden=\"true\">$icon</span><b>" . h($title) . '</b><span>' . h($text) . '</span></li>';
  return "<ul class=\"shop-feats\">$out</ul>";
}
function shop_faq($faq) {
  $out = '';
  foreach ($faq as [$q, $a]) $out .= '<details><summary>' . h($q) . '</summary><p>' . $a . '</p></details>';
  return "<div class=\"shop-faq\">$out</div>";
}
function shop_gallery($pics) {
  $out = '';
  foreach ($pics as [$src, $w, $hh, $alt, $cap]) $out .= "<li><figure><img src=\"$src\" width=\"$w\" height=\"$hh\" alt=\"" . h($alt) . '" loading="lazy" decoding="async"><figcaption>' . h($cap) . '</figcaption></figure></li>';
  return "<ul class=\"shop-gallery\">$out</ul>";
}

// Every product page: a top band, then its own sections, the buy button again, and the other products.
function shop_page($slug, $o) {
  global $SHOP_INFO;
  [$name, $url] = $SHOP_INFO[$slug];
  $facts = implode('', array_map(fn($f) => '<li>' . h($f) . '</li>', $o['facts']));
  $buy = shop_buy($slug);
  $top = $o['dark'] ?? false ? 'band band-dark shop-top shop-top-dark' : 'band shop-top';
  $more = shop_cards($slug);
  page($url, [
    'title' => $o['title'],
    'desc' => h($o['desc']),
    'class' => "shop shop-$slug",
    'og' => $slug,
    'body' => <<<HTML
<section class="{$top}">
  <div class="wrap shop-top-inner">
    <div class="shop-intro">
      <p class="tag">{$o['tag']}</p>
      <h1>{$name}</h1>
      <p class="lead">{$o['lead']}</p>
      {$buy}
      <ul class="shop-facts">{$facts}</ul>
    </div>
    <div class="shop-top-pic">{$o['pic']}</div>
  </div>
</section>
{$o['body']}
<section class="band shop-again" aria-labelledby="again-h">
  <div class="wrap shop-again-inner">
    <h2 id="again-h">{$o['again']}</h2>
    {$buy}
  </div>
</section>
<section class="wrap section" aria-labelledby="more-h">
  <div class="sec-head"><h2 id="more-h">More from the shop</h2></div>
  {$more}
</section>
HTML,
    'ld' => [crumbs([['Home', '/'], ['Shop', '/shop/'], [$name, $url]])],
  ]);
}

// the print-and-play games: their entries go in $SHOP_INFO before any product page lists the others
require __DIR__ . '/games.php';

/* ---------- Life RPG ---------- */
$lrpgShots = shop_gallery([
  ['/assets/life-rpg/today.webp', 520, 1123, 'The Today screen: level 7, an 18-day streak and three quests for the day, one of them done.', "Today's quests"],
  ['/assets/life-rpg/city-roman.webp', 520, 1123, 'A Roman city of temples, homes and an aqueduct, built by finishing quests.', 'Your city grows'],
  ['/assets/life-rpg/hero.webp', 520, 1123, 'The Hero screen: a block character, the next unlock and progress in seven skills.', 'Skills and badges'],
  ['/assets/life-rpg/city-elven.webp', 520, 1123, 'An elven city in the forest.', 'An elven city'],
]);
$lrpgWorlds = '';
foreach (['roman', 'modern', 'elven', 'future'] as $w) {   // the four worlds in the Life RPG edition for sale
  $lrpgWorlds .= "<li class=\"world-$w\"><img src=\"/assets/life-rpg/city-$w-wide.webp\" width=\"520\" height=\"300\" alt=\"A " . h($WORLDS[$w]['short']) . ' city in Life RPG" loading="lazy" decoding="async"><span>' . h($WORLDS[$w]['name']) . '</span></li>';
}
$lrpgOpen = shop_open('life-rpg');
shop_page('life-rpg', [
  'title' => 'Life RPG: turn real-life goals into quests',
  'desc' => 'Life RPG is a game for grown-ups and teens: finish real-life quests to earn XP, level up and grow your own city in one of four worlds. One payment, no subscription.',
  'tag' => 'For grown-ups and teens',
  'lead' => 'Turn real-life goals into quests. Finish them to earn XP, level up and grow your own city.',
  'facts' => ['No subscription', 'No ads', 'No account', 'Works offline'],
  'dark' => true,
  'pic' => '<img class="shop-phone" src="/assets/life-rpg/today.webp" width="520" height="1123" alt="Life RPG on a phone: today\'s quests, level 7 and an 18-day streak.">',
  'again' => $lrpgOpen ? 'Start your first quest today' : 'Life RPG is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Pick today\'s quests.', 'A workout, homework, reading, chores or a step toward a bigger goal.'],
      ['Do them, then tap.', 'Each quest you finish earns XP. Levels, skills and badges follow.'],
      ['Watch your city grow.', 'Every quest builds part of your city, and milestones add landmarks.'],
    ]) . '</section>'
    . "<section class=\"wrap section\" aria-label=\"Screenshots\">$lrpgShots</section>"
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">Everything that comes with it</h2></div>'
    . shop_feats([
      ['⚔️', 'Daily quests', 'Pick three to five a day. A daily chest rewards coming back.'],
      ['⭐', 'Levels and XP', 'Quests level up the more you do them, and pay more.'],
      ['👹', 'Boss battles', 'One hard thing you\'ve been putting off, with a big reward.'],
      ['🌳', 'Seven skill trees', 'Skills, badges and titles, unlocked only by real progress.'],
      ['🧭', 'Plan my day', 'Suggestions for what to do next, from your own 90-day priorities.'],
      ['🎁', 'Your own rewards', 'Set real treats and spend XP on them.'],
      ['👨‍👩‍👧', 'Family scoreboard', 'Several players can share one device, with weekly leaderboards.'],
      ['💾', 'Yours to keep', 'Save a backup file whenever you like, and move it to a new device.'],
    ]) . '</div></section>'
    . "<section class=\"wrap section\" aria-labelledby=\"worlds-h\"><div class=\"sec-head\"><h2 id=\"worlds-h\">Build in one of four worlds</h2><p>The same worlds as this site. Switch any time without losing progress.</p></div><ul class=\"shop-worlds\">$lrpgWorlds</ul></section>"
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['Is it a subscription?', 'No. You pay ' . shop_price('life-rpg') . ' once, and it\'s yours. There are no ads and nothing else to buy.'],
      ['What do I need?', 'A phone, tablet or computer with an up-to-date web browser. You can add Life RPG to your home screen, where it opens like an app.'],
      ['Do I need an account?', 'No. Your receipt email has a key. Type it in once on each device you play on, up to 10 devices.'],
      ['Where is my progress saved?', 'On your device, not on a server, so it stays private. Save a backup file now and then, and open it on another device to carry on there.'],
      ['Does it work without the internet?', 'Yes, once it has opened. Only unlocking a new device needs a connection.'],
      ['Can I change the quests?', 'Yes. Every quest, reward and stat can be changed. The starter quests cover work, family, health, money, learning and faith; remove any you don\'t want. There is a teen starter pack with school, chores and sports.'],
      ['Can kids play?', 'Yes, with a grown-up. A grown-up buys it, and several players can share one device.'],
    ]) . '</section>',
]);

/* ---------- City Builders ---------- */
shop_page('city-builders', [
  'title' => 'City Builders: a card game about what every city needs',
  'desc' => 'City Builders is a print-and-play card game for 2 to 4 players, ages 8 and up: collect buildings from ancient Rome to Mars and give your city all ten things it needs.',
  'tag' => 'Print at home · For families and classrooms',
  'lead' => 'Collect buildings from ancient Rome to a base on Mars, and be the first to build a city with water, homes, food and the seven other things people need.',
  'facts' => ['2 to 4 players', 'Ages 8 and up', 'About 20 minutes', 'PDF in Letter and A4'],
  'pic' => '<img src="/assets/shop/city-builders-fan.webp" width="1100" height="513" alt="Five City Builders cards: an aqueduct, a treetop village, a challenge card, a public library and a greenhouse dome.">',
  'again' => shop_open('city-builders') ? 'Print it tonight, play it tomorrow' : 'City Builders is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print and cut.', 'Thick paper makes sturdier cards, but any paper works.'],
      ['Play.', 'Take a card, build a card, and race to meet all ten needs.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the game">'
    . shop_gallery([
      ['/assets/shop/city-builders-p3.webp', 520, 673, 'A page of nine building cards from Ancient Rome, ready to cut out.', 'Nine cards to a page'],
      ['/assets/shop/city-builders-p1.webp', 520, 673, 'The first page of the rules, with an example card.', 'Two pages of rules'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🏛️', '106 building cards', 'From all four worlds. Each shows the needs it meets and what it does.'],
      ['🎯', '9 challenge cards', 'Secret goals for bonus points, like a Roman town or a Mars base.'],
      ['🃏', 'Helper cards and card backs', 'A turn summary, the ten needs, and backs for two-sided printing.'],
      ['👶', 'Ways to play', 'An open-hand game for younger players, a short game, and a class version for teams.'],
      ['💬', 'Talk about it', 'Questions for after the game: which need was hardest to meet, and why?'],
      ['🖨️', 'Print as often as you like', 'For your home or your classroom.'],
    ]) . '</div></section>'
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What do I get?', 'A PDF of 16 pages to download right away: rules, 13 pages of cards and a page of card backs, in both US Letter and A4.'],
      ['Do I need special paper?', 'No. Card stock makes sturdier cards, but plain paper works too. Card sleeves from any game shop make them last even longer.'],
      ['Is it educational?', 'Yes. Every card says which need a building meets and what it does, and the game is built around the big idea of this site: every city has to give its people the same ten things.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
      ['Can younger kids play?', 'Yes. With hands face up and no challenge cards, it works from about age 6 with a grown-up.'],
    ]) . '</section>',
]);

/* ---------- Classroom Pack ---------- */
shop_page('classroom-pack', [
  'title' => 'Classroom Pack: how cities work, ready to print',
  'desc' => 'A print-ready teaching pack from The Atlas of Cities: fact cards for 154 places, 12 worksheets with answer keys, the ten needs of a city and 60 discussion cards.',
  'tag' => 'Print at home · For teachers and homeschool',
  'lead' => 'Everything for teaching how cities work, in one file: fact cards for every place, the worksheets with their answer keys, and questions that get a class talking.',
  'facts' => ['59 pages', 'Grades 2 to 9', 'PDF in Letter and A4'],
  'pic' => '<img src="/assets/shop/classroom-pack-pages.webp" width="1100" height="697" alt="Three pages of the Classroom Pack: the cover, the ten needs of a city and a page of fact cards.">',
  'again' => shop_open('classroom-pack') ? 'Everything for your next unit, in one file' : 'The Classroom Pack is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print what you need.', 'Every section starts on its own page, so you can print one part at a time.'],
      ['Teach.', 'Use the fact cards for stations and sorting, the worksheets for practice, and a discussion card to start each day.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the pack">'
    . shop_gallery([
      ['/assets/shop/classroom-pack-p3.webp', 520, 673, 'The ten needs of a city, with an example from each world.', 'The ten needs'],
      ['/assets/shop/classroom-pack-p5.webp', 520, 673, 'A page of six fact cards, each with a picture, what the place does and a question.', 'Fact cards'],
      ['/assets/shop/classroom-pack-p47.webp', 520, 673, 'A worksheet comparing how the four cities meet their needs.', 'Worksheets and keys'],
      ['/assets/shop/classroom-pack-p54.webp', 520, 673, 'A page of ten discussion cards.', 'Discussion cards'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🗂️', '154 fact cards', 'Every place, vehicle and green space: a picture, what it does, the needs it meets and a question.'],
      ['📝', '12 worksheets', 'Vocabulary, word searches, matching, a comparison chart and a city plan, each followed by its answer key.'],
      ['🏙️', 'The ten needs', 'Two pages that compare how each world gives its people water, homes, food and more.'],
      ['💬', '60 discussion cards', 'Questions for warm-ups, exit tickets and journals, 15 from each world.'],
      ['💡', 'Ideas for using it', 'Stations, sorting, a design-a-city project and a question of the day.'],
      ['🖨️', 'Ready to print', 'Each section starts on its own page, with page numbers and a contents page.'],
    ]) . '</div></section>'
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['Aren\'t the worksheets free on this site?', 'Yes, and they stay free. The pack puts them in one file with the fact cards, the ten needs pages and the discussion cards, so a whole unit is ready to print.'],
      ['What grades is it for?', 'Grades 2 to 9. The fact cards and discussion cards work across those grades; each worksheet notes its grades on <a href="/teachers/worksheets/">the worksheets page</a>.'],
      ['Can I copy it for my students?', 'Yes, as many copies as your class needs. One purchase is for one teacher\'s classroom or one home; please don\'t share the file online.'],
      ['What do I get?', 'A PDF of 59 pages to download right away, in both US Letter and A4.'],
    ]) . '</section>',
]);

/* ---------- Poster Set (pay what you want: also the Support page's button) ---------- */
shop_page('posters', [
  'title' => 'Poster Set: the four worlds for your wall',
  'desc' => 'Six posters to print from The Atlas of Cities: the four worlds, twelve places from each, and the ten things every city needs. Pay what you want, from ' . SHOP['posters']['price'] . '.',
  'tag' => 'Print at home · Supports this site',
  'lead' => 'Six posters for a classroom or bedroom wall. You choose the price, and it helps keep The Atlas of Cities free.',
  'facts' => ['6 posters', 'PDF in Letter and A4'],
  'pic' => '<img src="/assets/shop/posters-fan.webp" width="1100" height="697" alt="Three posters: Ancient Rome, the four worlds and the Robotic Future.">',
  'again' => shop_open('posters') ? 'Put the four worlds on your wall' : 'The Poster Set is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Choose your price.', 'Pay ' . shop_price('posters') . ' or more. Anything above that helps the site grow.'],
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print and hang.', 'Any printer works. Matte photo paper or card stock looks best.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Posters in the set">'
    . shop_gallery([
      ['/assets/shop/posters-p2.webp', 520, 673, 'A poster of twelve places in Ancient Rome, from the aqueduct to a chariot, above a landscape of hills.', 'Twelve places from each world'],
      ['/assets/shop/posters-p6.webp', 520, 673, 'A chart of the ten things every city needs, with an example from each world.', 'Ten things every city needs'],
      ['/assets/shop/posters-p1.webp', 520, 673, 'A poster of the four worlds: an amphitheater, a skyscraper, a great tree hall and a spaceport.', 'The four worlds'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🗺️', 'The Four Worlds', 'One landmark from each world, from long ago to maybe one day.'],
      ['🏛️', 'Ancient Rome', 'The aqueduct, the Pantheon, a chariot and nine more.'],
      ['🏙️', 'Modern Town', 'A skyscraper, a stadium, a taxi and nine more.'],
      ['🌳', 'Elven World', 'A great tree hall, a mushroom cottage and ten more.'],
      ['🚀', 'Robotic Future', 'A spaceport, a launch pad, a hover car and nine more.'],
      ['💧', 'Ten things every city needs', 'A chart with an example of each need from every world.'],
    ]) . '</div></section>'
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What do I get?', 'A PDF of 6 posters to download right away, in both US Letter and A4.'],
      ['Where does the money go?', 'Into keeping The Atlas of Cities free, with no ads: hosting, new worlds and fact-checking.'],
      ['Can I print them bigger?', 'Yes. Print the A4 file on A3 paper, or choose "Fit to page" to print on 11 x 17.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);

/* ---------- the shop page ---------- */
$shopCards = shop_cards();
page('/shop/', [
  'title' => 'Shop: games, posters and classroom packs',
  'desc' => h('Board games, card games, posters and classroom packs made from the worlds of The Atlas of Cities, and Life RPG, an app for real-life goals. The rest of the site stays free.'),
  'class' => 'shop shop-home-page',
  'body' => <<<HTML
<section class="wrap section page-head">
  <p class="tag">Shop · For grown-ups</p>
  <h1>Games, posters and classroom packs</h1>
  <p class="lead">Made from the worlds of this site. You get a download or a key right after paying, and the rest of The Atlas of Cities stays free.</p>
</section>
<section class="wrap section shop-list" aria-label="Products">
  {$shopCards}
</section>
<section class="wrap section narrow" aria-labelledby="know-h">
  <h2 id="know-h">Good to know</h2>
  <ul class="plain-points">
    <li>Everything is a single payment. No subscriptions and no ads.</li>
    <li>Payment happens on our store's website, under its own privacy policy. This site never sees payment details.</li>
    <li>A grown-up buys. Under 18? Ask a parent first.</li>
  </ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Shop', '/shop/']])],
]);
