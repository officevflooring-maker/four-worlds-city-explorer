<?php
// ---------- The shop: things for grown-ups to buy, made from the worlds of this site ----------
// /shop/ lists them; each has its own page: /life-rpg/ (an app, unlocked with a key), /city-builders/ (a print-and-play
// card game), /classroom-pack/ (a print-ready teaching pack) and /posters/ (posters to print, pay what you want, which
// is also how the Support page takes support). The store delivers the file or the key by itself, so this site still
// has no accounts, payments or cookies. Prices and checkout links are in config.php (SHOP); while a link is empty the
// product says "Coming soon". The pictures come from the products themselves (see the README).

$SHOP_INFO = [
  'life-rpg' => ['Life RPG', '/life-rpg/', 'An app for real-life goals', 'Turn real-life goals into quests, earn XP and grow your own city.', '/assets/life-rpg/phones-card.webp', 960, 540],
  'city-builders' => ['City Builders', '/city-builders/', 'A card game to print at home', 'Collect buildings from every world and build a city that has everything its people need.', '/assets/shop/city-builders-fan.webp', 1100, 513],
  'classroom-pack' => ['Classroom Pack', '/classroom-pack/', 'A teaching pack to print', 'Fact cards, worksheets with answer keys and discussion cards, in one file.', '/assets/shop/classroom-pack-pages.webp', 1100, 697],
  'posters' => ['Poster Set', '/posters/', 'Posters to print', 'Every world, its places and the ten things every city needs, for your wall.', '/assets/shop/posters-fan.webp', 1100, 697],
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
  return "<li class=\"shop-card shop-card-$slug\"><a href=\"$url\"><span class=\"shop-card-pic\"><img src=\"$img\" width=\"$w\" height=\"$hh\" alt=\"\" loading=\"lazy\" decoding=\"async\"></span>"
    . '<span class="shop-card-text"><span class="shop-kind">' . h($kind) . '</span><span class="shop-name">' . h($name) . '</span>'
    . '<span class="shop-line">' . h($line) . "</span><span class=\"shop-state\">$state</span></span></a></li>";
}
function shop_cards($except = '', $only = null) {
  global $SHOP_INFO;
  $slugs = $only ?? array_keys($SHOP_INFO);
  return '<ul class="shop-cards">' . implode('', array_map('shop_card', array_filter($slugs, fn($s) => $s !== $except))) . '</ul>';
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
// What is on which pages, so buyers know exactly what they get: [pages, what is there]
function shop_pages($rows, $total) {
  $out = '';
  foreach ($rows as [$p, $what]) $out .= '<li><span class="shop-pg">' . h($p) . '</span><span>' . $what . '</span></li>';
  return '<section class="wrap section narrow" aria-labelledby="pages-h"><h2 id="pages-h">Page by page</h2><p class="muted">' . h($total) . '</p><ol class="shop-pagelist">' . $out . '</ol></section>';
}
function shop_trust($slug) {
  $points = $slug === 'life-rpg'
    ? ['One payment, no subscription', 'Works offline', 'Up to 10 devices']
    : ['Instant download', 'US Letter and A4', 'Print as often as you need', 'One payment'];
  return '<ul class="shop-trust">' . implode('', array_map(fn($p) => '<li>' . h($p) . '</li>', $points)) . '</ul>';
}
// Structured data for search engines: the product, with its price once it is on sale.
function shop_ld($slug, $desc) {
  global $SHOP_INFO;
  [$name, $url] = $SHOP_INFO[$slug];
  $ld = ['@context' => 'https://schema.org', '@type' => 'Product', 'name' => $name, 'description' => $desc, 'url' => url($url),
    'image' => url('/assets/og/' . $slug . '.jpg'), 'brand' => ['@type' => 'Brand', 'name' => SITE_NAME]];
  if (shop_open($slug)) $ld['offers'] = ['@type' => 'Offer', 'price' => ltrim(SHOP[$slug]['price'], '$'), 'priceCurrency' => 'USD',
    'availability' => 'https://schema.org/InStock', 'url' => SHOP[$slug]['buy']];
  return $ld;
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
  $trust = shop_trust($slug);
  $perfect = empty($o['perfect']) ? '' : '<p class="shop-perfect">Perfect for ' . h(implode(', ', array_slice($o['perfect'], 0, -1)) . ' and ' . end($o['perfect'])) . '</p>';
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
      {$trust}
      <ul class="shop-facts">{$facts}</ul>{$perfect}
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
    'ld' => [crumbs([['Home', '/'], ['Shop', '/shop/'], [$name, $url]]), shop_ld($slug, $o['desc'])],
  ]);
}

// the print-and-play games: their entries go in $SHOP_INFO before any product page lists the others
require __DIR__ . '/games.php';
require __DIR__ . '/printables.php';

/* ---------- Life RPG ---------- */
// Screenshots from the game (its dev/shots.sh), at the shape of most phone screens.
$lrpgShots = shop_gallery(array_map(function ($s) {
  [$w, $hh] = getimagesize(PUB . "/assets/life-rpg/$s[0].webp");
  return ["/assets/life-rpg/$s[0].webp", $w, $hh, $s[1], $s[2]];
}, [
  ['today', 'The Today screen: level 7, an 18-day streak and three quests for the day.', "Today's quests"],
  ['hero', 'The Hero screen: a painted hero in a Roman toga, the next unlock and progress in seven skills.', 'Your hero and skills'],
  ['wins', 'The Wins screen: records like quests done and the best streak, quest levels and badges.', 'Records and badges'],
  ['trees', 'A skill tree: steps unlocked by real progress, like Focus Mode and Streak Keeper.', 'Skill trees'],
  ['bosses', 'Boss battles: big tasks you have been putting off, each with a large XP reward.', 'Boss battles'],
  ['rewards', 'Rewards bought with XP: a movie night, new headphones and a weekend trip.', 'Your own rewards'],
]));
// The heroes (tools/copy-heroes.sh): all twelve in everyday clothes, then hero 4 dressed for five of the worlds.
$heroPic = function ($file, $alt) {
  [$w, $h] = getimagesize(PUB . "/assets/life-rpg/heroes/$file.webp");
  return '<img src="/assets/life-rpg/heroes/' . $file . '.webp" width="' . $w . '" height="' . $h . '" alt="' . h($alt) . '" loading="lazy" decoding="async">';
};
$lrpgHeroes = '';
foreach (['Boy in a blue hoodie', 'Girl in a yellow T-shirt', 'Boy in a green T-shirt', 'Girl in a red jacket', 'Teen boy in a gray hoodie',
  'Teen girl with a red ponytail', 'Teen boy with round glasses', 'Teen girl with long braids', 'Dad in a flannel shirt',
  'Mom in a coral blouse', 'Man in a navy polo shirt', 'Grandma in a green cardigan'] as $n => $alt) {
  $lrpgHeroes .= '<li>' . $heroPic(sprintf('h%02d_casual', $n + 1), $alt) . '</li>';
}
$lrpgOutfits = '';
foreach (['modern' => ['casual', 'In everyday clothes'], 'roman' => ['toga', 'In a tunic and toga'], 'egypt' => ['egypt', 'In a linen dress and a wide collar'],
  'future' => ['space', 'In a space suit'], 'heaven' => ['heaven', 'In a white robe']] as $w => [$o, $alt]) {
  $lrpgOutfits .= "<li class=\"world-$w\">" . $heroPic("h04_$o", $alt) . '<span>' . h($WORLDS[$w]['name']) . '</span></li>';
}
$lrpgWorlds = '';
foreach (WORLD_ORDER as $w) {   // all six worlds are in the game
  $lrpgWorlds .= "<li class=\"world-$w\"><img src=\"/assets/life-rpg/city-$w-wide.webp\" width=\"520\" height=\"300\" alt=\"" . h($WORLDS[$w]['name']) . ' in Life RPG" loading="lazy" decoding="async"><span>' . h($WORLDS[$w]['name']) . '</span></li>';
}
$lrpgOpen = shop_open('life-rpg');
shop_page('life-rpg', [
  'title' => 'Life RPG: turn real-life goals into quests',
  'desc' => 'Life RPG is a game for grown-ups and teens: finish real-life quests to earn XP, level up and grow your own city in one of six worlds. One payment, no subscription.',
  'tag' => 'For grown-ups and teens',
  'lead' => 'Turn real-life goals into quests. Finish them to earn XP, level up and grow your own city.',
  'facts' => ['No subscription', 'No ads', 'No account', 'Works offline'],
  'perfect' => ['building habits', 'family goals', 'teens with big plans'],
  'dark' => true,
  'pic' => '<img src="/assets/life-rpg/phones.webp" width="' . implode('" height="', array_slice(getimagesize(PUB . '/assets/life-rpg/phones.webp'), 0, 2))
    . '" alt="Life RPG on three phones: a hero with seven skills, today\'s quests and a Roman city, with two of the game\'s heroes.">',
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
    . '<section class="wrap section" aria-labelledby="heroes-h"><div class="sec-head"><h2 id="heroes-h">Pick your hero</h2><p>Twelve painted heroes, from kids to grandparents. Gear you earn, like a cape or a crown, shows on your hero.</p></div>'
    . "<ul class=\"lrpg-heroes\">$lrpgHeroes</ul><h3 class=\"lrpg-outfits-h\">Dressed for each world</h3><ul class=\"lrpg-outfits\">$lrpgOutfits</ul></section>"
    . "<section class=\"wrap section\" aria-labelledby=\"worlds-h\"><div class=\"sec-head\"><h2 id=\"worlds-h\">Build in one of six worlds</h2><p>The six worlds on this site. Switch any time without losing progress.</p></div><ul class=\"shop-worlds\">$lrpgWorlds</ul></section>"
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
  'desc' => 'A print-and-play card game for 2 to 4 players, ages 8 and up: collect buildings from ancient Egypt to a city in the clouds, and give your city all it needs.',
  'tag' => 'Print at home · For families and classrooms',
  'lead' => 'Collect buildings from six worlds, from ancient Egypt to a city in the clouds, and be the first to build a city with water, homes, food and the seven other things people need.',
  'facts' => ['2 to 4 players', 'Ages 8 and up', 'About 20 minutes', 'PDF in Letter and A4'],
  'perfect' => ['family game night', 'classrooms', 'learning what cities need'],
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
      ['/assets/shop/city-builders-p3.webp', 520, 673, 'A page of nine building cards from Ancient Egypt, ready to cut out.', 'Nine cards to a page'],
      ['/assets/shop/city-builders-p1.webp', 520, 673, 'The first page of the rules, with an example card.', 'Two pages of rules'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🏛️', '155 building cards', 'From all six worlds. Each shows the needs it meets and what it does.'],
      ['🎯', '9 challenge cards', 'Secret goals for bonus points, like a Roman town or a Mars base.'],
      ['🃏', 'Helper cards and card backs', 'A turn summary, the ten needs, and backs for two-sided printing.'],
      ['👶', 'Ways to play', 'An open-hand game for younger players, a short game, and a class version for teams.'],
      ['💬', 'Talk about it', 'Questions for after the game: which need was hardest to meet, and why?'],
      ['🖨️', 'Print as often as you like', 'For your home or your classroom.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1 and 2', 'Rules: setup, turns, scoring, other ways to play and questions to talk about'],
      ['3 to 20', '155 building cards, nine to a page, world by world, and 2 helper cards'],
      ['21', '9 challenge cards'],
      ['22', 'Card backs, for printing on both sides'],
    ], 'A PDF of 22 pages, in US Letter and A4.') . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What do I get?', 'A PDF of 22 pages to download right away: rules, 19 pages of cards and a page of card backs, in both US Letter and A4.'],
      ['Do I need special paper?', 'No. Card stock makes sturdier cards, but plain paper works too. Card sleeves from any game shop make them last even longer.'],
      ['Is it educational?', 'Yes. Every card says which need a building meets and what it does, and the game is built around the big idea of this site: every city has to give its people the same ten things.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
      ['Can younger kids play?', 'Yes. With hands face up and no challenge cards, it works from about age 6 with a grown-up.'],
    ]) . '</section>',
]);

/* ---------- Classroom Pack ---------- */
shop_page('classroom-pack', [
  'title' => 'Classroom Pack: how cities work, ready to print',
  'desc' => 'A print-ready teaching pack from The Atlas of Cities: fact cards for 230 places, 16 worksheets with answer keys, the ten needs of a city and 90 discussion cards.',
  'tag' => 'Print at home · For teachers and homeschool',
  'lead' => 'Everything for teaching how cities work, in one file: fact cards for every place, the worksheets with their answer keys, and questions that get a class talking.',
  'facts' => ['83 pages', 'Grades 2 to 9', 'PDF in Letter and A4'],
  'perfect' => ['teachers', 'homeschool', 'substitute plans', 'grades 2 to 9'],
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
      ['/assets/shop/classroom-pack-p68.webp', 520, 673, 'A worksheet comparing how the six cities meet their needs.', 'Worksheets and keys'],
      ['/assets/shop/classroom-pack-p75.webp', 520, 673, 'A page of ten discussion cards.', 'Discussion cards'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🗂️', '230 fact cards', 'Every place, vehicle and green space: a picture, what it does, the needs it meets and a question.'],
      ['📝', '16 worksheets', 'Vocabulary and a word search for every world, matching, a comparison chart and a city plan, each followed by its answer key.'],
      ['🏙️', 'The ten needs', 'Two pages that compare how each world gives its people water, homes, food and more.'],
      ['💬', '90 discussion cards', 'Questions for warm-ups, exit tickets and journals, 15 from each world.'],
      ['💡', 'Ideas for using it', 'Stations, sorting, a design-a-city project and a question of the day.'],
      ['🖨️', 'Ready to print', 'Each section starts on its own page, with page numbers and a contents page.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1 and 2', 'Cover, contents and ideas for using the pack'],
      ['3 and 4', 'Ten things every city needs, compared across the six worlds'],
      ['5 to 43', '230 fact cards, six to a page'],
      ['44 to 74', '16 worksheets, each followed by its answer key'],
      ['75 to 83', '90 discussion cards, ten to a page'],
    ], 'A PDF of 83 pages, in US Letter and A4.') . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['Aren\'t the worksheets free on this site?', 'Yes, and they stay free. The pack puts them in one file with the fact cards, the ten needs pages and the discussion cards, so a whole unit is ready to print.'],
      ['What grades is it for?', 'Grades 2 to 9. The fact cards and discussion cards work across those grades; each worksheet notes its grades on <a href="/teachers/worksheets/">the worksheets page</a>.'],
      ['Can I copy it for my students?', 'Yes, as many copies as your class needs. One purchase is for one teacher\'s classroom or one home; please don\'t share the file online.'],
      ['What do I get?', 'A PDF of 83 pages to download right away, in both US Letter and A4.'],
    ]) . '</section>',
]);

/* ---------- Poster Set (pay what you want: also the Support page's button) ---------- */
shop_page('posters', [
  'title' => 'Poster Set: every world for your wall',
  'desc' => 'Eight posters to print from The Atlas of Cities: all six worlds together, twelve places from each, and the ten things every city needs. Pay what you want, from ' . SHOP['posters']['price'] . '.',
  'tag' => 'Print at home · Supports this site',
  'lead' => 'Eight posters for a classroom or bedroom wall. You choose the price, and it helps keep The Atlas of Cities free.',
  'facts' => ['8 posters', 'PDF in Letter and A4'],
  'perfect' => ['classroom walls', 'bedrooms', 'supporting this site'],
  'pic' => '<img src="/assets/shop/posters-fan.webp" width="1100" height="697" alt="Three posters: Ancient Egypt, the six worlds and the Heavenly City.">',
  'again' => shop_open('posters') ? 'Put every world on your wall' : 'The Poster Set is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Choose your price.', 'Pay ' . shop_price('posters') . ' or more. Anything above that helps the site grow.'],
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print and hang.', 'Any printer works. Matte photo paper or card stock looks best.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Posters in the set">'
    . shop_gallery([
      ['/assets/shop/posters-p2.webp', 520, 673, 'A poster of twelve places in Ancient Egypt, from the pyramid to a Nile sailing boat, above a desert landscape.', 'Twelve places from each world'],
      ['/assets/shop/posters-p8.webp', 520, 673, 'A chart of the ten things every city needs, with an example from each world.', 'Ten things every city needs'],
      ['/assets/shop/posters-p1.webp', 520, 673, 'A poster of the six worlds, with a landmark from each: a pyramid, an amphitheater, a skyscraper, a great tree hall, a spaceport and a palace of light.', 'The six worlds'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🗺️', 'The Six Worlds', 'One landmark from each world, from long, long ago to maybe one day.'],
      ['🏺', 'Ancient Egypt', 'The pyramid, the Great Sphinx, a Nile sailing boat and nine more.'],
      ['🏛️', 'Ancient Rome', 'The aqueduct, the Pantheon, a chariot and nine more.'],
      ['🏙️', 'Modern Town', 'A skyscraper, a stadium, a taxi and nine more.'],
      ['🌳', 'Green World', 'A great tree hall, a mushroom cottage and ten more.'],
      ['🚀', 'Robotic Future', 'A spaceport, a launch pad, a hover car and nine more.'],
      ['✨', 'Heavenly City', 'A pearl gate, a tree of life, a swan boat and nine more.'],
      ['💧', 'Ten things every city needs', 'A chart with an example of each need from every world.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'The Six Worlds: a landmark from each world'],
      ['2 to 7', 'Twelve places from each world: Ancient Egypt, Ancient Rome, Modern Town, Green World, Robotic Future and the Heavenly City'],
      ['8', 'Ten things every city needs: a chart with an example from every world'],
    ], 'A PDF of 8 posters, in US Letter and A4.') . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What do I get?', 'A PDF of 8 posters to download right away, in both US Letter and A4.'],
      ['Where does the money go?', 'Into keeping The Atlas of Cities free, with no ads: hosting, new worlds and fact-checking.'],
      ['Can I print them bigger?', 'Yes. Print the A4 file on A3 paper, or choose "Fit to page" to print on 11 x 17.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);

/* ---------- the shop page: products on shelves by who they are for ---------- */
// [heading, line, products]; a product not on a shelf is left off the shop page, so add new ones here
$SHOP_SHELVES = [
  ['Games to print', 'Board, card and party games for families and classrooms. Print them tonight, play them tomorrow.', ['journey', 'city-builders', 'trivia', 'bingo', 'planners']],
  ['For young builders', 'Hands-on fun for ages 4 to 10: build a city on the table, or puzzle through six worlds.', ['playset', 'activity']],
  ['For the classroom', 'Everything for a unit on how cities work, ready to print and copy.', ['classroom-pack', 'wordwall']],
  ['For your wall', 'Posters and a calendar from the six worlds. The posters are how you can support this site.', ['posters', 'calendar']],
  ['For grown-ups and teens', 'An app that turns real-life goals into quests.', ['life-rpg']],
];
$shelves = $jump = '';
foreach ($SHOP_SHELVES as $i => [$head, $line, $slugs]) {
  $slugs = array_values(array_filter($slugs, fn($s) => isset($SHOP_INFO[$s])));
  if (!$slugs) continue;
  $id = 'shelf-' . ($i + 1);
  $jump .= '<li><a href="#' . $id . '">' . h($head) . '</a></li>';
  $shelves .= '<section class="wrap section shop-shelf" aria-labelledby="' . $id . '"><div class="sec-head"><h2 id="' . $id . '">' . h($head) . '</h2><p>' . h($line) . '</p></div>' . shop_cards('', $slugs) . '</section>';
}
$nProducts = count($SHOP_INFO);
page('/shop/', [
  'title' => 'Shop: board games, activity books, classroom packs and posters',
  'desc' => h('Printable board games, an activity book, a play set, classroom packs, posters and a calendar from six worlds, and Life RPG. The rest of the site stays free.'),
  'class' => 'shop shop-home-page',
  'body' => <<<HTML
<section class="wrap section page-head">
  <p class="tag">Shop · For grown-ups</p>
  <h1>Games, activities and classroom packs</h1>
  <p class="lead">{$nProducts} things to print and play, all made from the worlds of this site. You get your files right after paying, and the rest of The Atlas of Cities stays free.</p>
  <ul class="shop-jump">{$jump}</ul>
</section>
{$shelves}
<section class="band shop-how" aria-labelledby="how-buy-h">
  <div class="wrap">
    <div class="sec-head"><h2 id="how-buy-h">How it works</h2></div>
    <ol class="shop-steps">
      <li><span class="shop-step-n" aria-hidden="true">1</span><b>Choose.</b> Every page shows exactly what is inside, page by page.</li>
      <li><span class="shop-step-n" aria-hidden="true">2</span><b>Pay once.</b> On our store's checkout. No account, no subscription.</li>
      <li><span class="shop-step-n" aria-hidden="true">3</span><b>Download and print.</b> PDFs in US Letter and A4, to print at home as often as you need.</li>
    </ol>
  </div>
</section>
<section class="wrap section narrow" aria-labelledby="know-h">
  <h2 id="know-h">Good to know</h2>
  <ul class="plain-points">
    <li>Everything is a single payment. No subscriptions and no ads.</li>
    <li>Payment happens on our store's website, under its own privacy policy. This site never sees payment details.</li>
    <li>Your receipt email has your download links, so you can download again later.</li>
    <li>A grown-up buys. Under 18? Ask a parent first.</li>
  </ul>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Shop', '/shop/']])],
]);
