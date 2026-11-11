<?php
// ---------- The packs and the free sampler (build/shop.php has the shop itself) ----------
// /bundle/ (every printable in the shop) and /holiday-pack/ (five family games, the Storybook and the calendar): what
// is in each is SHOP_PACKS in shop.php, the prices are in config.php (SHOP). A pack is delivered as a one-page PDF,
// "Your downloads", whose link opens a private download page on this site (the Worker in src/worker.js serves it and
// the files; atlas-products packs.sh makes the PDF and uploads the files).
// /free/ is the free sampler: one page from ten of the printables (SHOP_SAMPLER in shop.php), in public/assets/free/.

// Pages in each printable's PDF (atlas-products README; make.sh prints them too). Keep in step when a product changes.
const SHOP_PAGES = [
  'city-builders' => 25, 'classroom-pack' => 95, 'posters' => 9, 'journey' => 11, 'bingo' => 36, 'planners' => 10, 'trivia' => 10,
  'wordwall' => 57, 'calendar' => 14, 'playset' => 19, 'activity' => 34, 'storybook' => 73, 'memory' => 14, 'dominoes' => 8, 'story-starters' => 10,
];

// What is inside a pack: each printable with its picture, its line, its pages and what it costs alone.
function pack_list($pack) {
  global $SHOP_INFO;
  $out = '';
  foreach (SHOP_PACKS[$pack] as $s) {
    [$name, $url, $kind, $line, $img, $w, $hh] = $SHOP_INFO[$s];
    $out .= "<li><a class=\"pack-pic\" href=\"$url\" tabindex=\"-1\" aria-hidden=\"true\"><img src=\"$img\" width=\"$w\" height=\"$hh\" alt=\"" . h("$name: " . lcfirst($kind)) . "\" loading=\"lazy\" decoding=\"async\"></a>"
      . '<div class="pack-text"><p class="shop-kind">' . h($kind) . "</p><h3><a href=\"$url\">" . h($name) . '</a></h3><p>' . h($line) . '</p>'
      . '<p class="pack-meta">' . SHOP_PAGES[$s] . ' pages · ' . shop_price($s) . ' on its own</p></div></li>';
  }
  return "<ul class=\"pack-list\">$out</ul>";
}
function pack_money($n) { return '$' . number_format($n, 2); }

function pack_page($pack, $o) {
  global $SHOP_INFO;
  $slugs = SHOP_PACKS[$pack];
  $n = count($slugs);
  $pages = array_sum(array_map(fn($s) => SHOP_PAGES[$s], $slugs));
  $alone = pack_money(shop_total($slugs));
  $price = shop_price($pack);
  $name = $SHOP_INFO[$pack][0];
  shop_page($pack, [
    'title' => $o['title'],
    'desc' => $o['desc'],
    'tag' => $o['tag'],
    'lead' => $o['lead'],
    'facts' => ["$n printables", "$pages pages in all", 'PDFs in Letter and A4'],
    'perfect' => $o['perfect'],
    'pic' => '<img src="' . $SHOP_INFO[$pack][4] . '" width="1100" height="697" alt="' . h($o['picAlt']) . '">',
    'again' => shop_open($pack) ? $o['again'] : "The $name is coming soon",
    'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
      . shop_steps([
        ['Buy the pack.', 'Right after paying you get a one-page PDF called "Your downloads".'],
        ['Open its link.', 'It opens your own download page on this site, with every printable in US Letter and A4.'],
        ['Print and play.', 'Download what you need now and come back for the rest. The link keeps working.'],
      ]) . '</section>'
      . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2>'
      . "<p>$n printables, $pages pages in all. Bought one by one they cost $alone. In this pack: $price.</p></div>"
      . pack_list($pack) . '</div></section>'
      . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
      . shop_faq(array_merge([
        ['What do I get?', "A one-page PDF with the link to your download page. There you download all $n printables as PDFs, each in US Letter and A4: $pages pages in all."],
        ['Why a link, and not the files themselves?', 'Together the files are too big to attach to one order. Your download page has them all in one place, and you can come back to it whenever you like.'],
        ['Are these the same printables as the single products?', 'Yes, the very same ones, each as one PDF for US Letter and one for A4. The pack only costs less.'],
        ['Can I print more copies?', 'Yes, for your own home or one classroom. Please don\'t share the files or your download link online.'],
      ], $o['faq'])) . '</section>',
  ]);
}

pack_page('bundle', [
  'title' => 'Everything Bundle: all 15 printables in one pack',
  'desc' => 'Every printable from The Atlas of Cities in one purchase: five games, a play set, an activity book, a storybook, classroom packs, posters and a 2027 calendar.',
  'tag' => 'Print at home · For families, teachers and homeschool',
  'lead' => 'Everything in the shop that prints, in one purchase: the games, the Play Set, the Activity Book, the Storybook, the classroom packs, the posters and the 2027 Calendar.',
  'perfect' => ['homeschool families', 'teachers', 'a whole year of rainy days'],
  'picAlt' => 'Pages from the printables in the Everything Bundle, spread out like a fan.',
  'again' => 'Every printable, one purchase',
  'faq' => [
    ['Is Life RPG in the bundle?', 'No. Life RPG is an app with its own key, so it is sold on its own.'],
    ['What about printables you add later?', 'The bundle holds the 15 printables listed on this page.'],
  ],
]);
pack_page('holiday-pack', [
  'title' => 'Family Holiday Pack: five games, a storybook and a calendar',
  'desc' => 'A gift to print at home: City Builders, Journey Through the Worlds, Atlas Trivia, Memory Match and Dominoes, the Storybook and the 2027 Calendar, in one pack.',
  'tag' => 'Print at home · A gift for the whole family',
  'lead' => 'Five games for the table, a picture book to read aloud and a calendar for the new year. Print them tonight, wrap them tomorrow.',
  'perfect' => ['holiday gifts', 'family game nights', 'a last-minute present'],
  'picAlt' => 'Pages from the five games, the Storybook and the 2027 Calendar in the Family Holiday Pack, spread out like a fan.',
  'again' => 'Game nights for the whole holiday',
  'faq' => [
    ['What ages is it for?', 'The games start at ages 3 to 8, depending on the game, and each has an easier way to play. Every game\'s own page gives its ages, players and playing time.'],
    ['Is it a Christmas product?', 'No. The games, the book and the calendar are about the seven worlds of this site, so they work all year. It is a pack that makes a good gift.'],
  ],
]);

/* ---------- the free sampler ---------- */
$sampleList = '';
foreach (SHOP_SAMPLER as $s => $what) {
  [$name, $url] = $SHOP_INFO[$s];
  $sampleList .= '<li><b>' . h(ucfirst(preg_replace('~^the ~', 'The ', $what))) . '</b> from <a href="' . $url . '">' . h($name) . '</a></li>';
}
$sampleN = count(SHOP_SAMPLER);
$sampleSize = fn($f) => is_file(PUB . $f) ? ' (' . number_format(filesize(PUB . $f) / 1048576, 1) . ' MB)' : '';
$sampleLetter = '/assets/free/atlas-of-cities-free-sampler-letter.pdf';
$sampleA4 = '/assets/free/atlas-of-cities-free-sampler-a4.pdf';
foreach ([$sampleLetter, $sampleA4] as $f) if (!is_file(PUB . $f)) fwrite(STDERR, "free sampler missing: $f (atlas-products: bash packs.sh)\n");
page('/free/', [
  'title' => 'Free Sampler: ' . $sampleN . ' pages to print from our games and packs',
  'desc' => h('A free PDF to print at home: a poster of seven worlds, a calendar page, a maze, cards from our games and classroom pages. No sign-up.'),
  'class' => 'shop shop-free',
  'og' => 'free',
  'body' => <<<HTML
<section class="band shop-top">
  <div class="wrap shop-top-inner">
    <div class="shop-intro">
      <p class="tag">Free · Print at home</p>
      <h1>Free Sampler</h1>
      <p class="lead">{$sampleN} pages from our printables, free: a poster, a calendar page, a maze, and cards to cut out and play with. No sign-up and no email needed.</p>
      <p><a class="btn btn-big" href="{$sampleLetter}" download data-buy="free-sampler-letter">Download · US Letter{$sampleSize($sampleLetter)}</a></p>
      <p><a class="btn btn-quiet" href="{$sampleA4}" download data-buy="free-sampler-a4">Download · A4{$sampleSize($sampleA4)}</a></p>
      <ul class="shop-trust"><li>Free</li><li>No sign-up</li><li>Print as often as you need</li></ul>
    </div>
    <div class="shop-top-pic"><img src="/assets/shop/free-fan.webp" width="1100" height="697" alt="Three pages of the free sampler: the Seven Worlds poster between a page of game cards and a maze."></div>
  </div>
</section>
<section class="wrap section narrow" aria-labelledby="in-h">
  <h2 id="in-h">What's inside</h2>
  <p>One whole page from each of these, exactly as it comes in the full product:</p>
  <ul class="plain-points">{$sampleList}</ul>
  <p>Print it for your own home or classroom as often as you like. If your family or class enjoys it, the full printables are in <a href="/shop/">the shop</a>, and buying one helps keep this site free.</p>
</section>
HTML,
  'ld' => [crumbs([['Home', '/'], ['Shop', '/shop/'], ['Free Sampler', '/free/']])],
]);
