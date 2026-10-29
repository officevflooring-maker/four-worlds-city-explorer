<?php
// ---------- The shop's print-and-play games (build/shop.php has the shop itself) ----------
// /journey/ (a race board game), /bingo/ (picture bingo for a class) and /planners/ (a flip-and-write city-planning
// game). Each is a PDF made in the atlas-products project from this site's own places, so the games cover every
// world on the site. Prices and checkout links are in config.php (SHOP).

$SHOP_INFO += [
  'journey' => ['Journey Through the Worlds', '/journey/', 'A board game to print', 'Race through every world, ride shortcuts and answer questions about the places you pass.', '/assets/shop/journey-fan.webp', 1100, 697],
  'bingo' => ['City Bingo', '/bingo/', 'Picture bingo for a class', 'Read a clue, find the place, cover it. 30 different cards, so a whole class can play.', '/assets/shop/bingo-fan.webp', 1100, 697],
  'planners' => ['City Planners', '/planners/', 'A drawing game to print', 'Draw a city where every home is close to what people need.', '/assets/shop/planners-fan.webp', 1100, 697],
];

/* ---------- Journey Through the Worlds ---------- */
shop_page('journey', [
  'title' => 'Journey Through the Worlds: a board game to print',
  'desc' => 'A print-and-play race game for 2 to 4 players, ages 5 and up: travel through every world, ride shortcuts and answer questions about the places you pass.',
  'tag' => 'Print at home · For families and classrooms',
  'lead' => 'A race through every world of the Atlas. Ride shortcuts, dodge road works and answer questions about the places you pass.',
  'facts' => ['2 to 4 players', 'Ages 5 and up', 'About 20 minutes', 'PDF in Letter and A4'],
  'perfect' => ['family game night', 'young players', 'classroom fun'],
  'pic' => '<img src="/assets/shop/journey-board.webp" width="760" height="1001" alt="The Journey Through the Worlds board: a path of numbered squares through a row for each world, with shortcuts, road works and question stars.">',
  'again' => shop_open('journey') ? 'Pack your bags for every world' : 'Journey Through the Worlds is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print and tape.', 'The board prints on four ordinary pages that tape together. Cut out the cards and the paper pawns.'],
      ['Play.', 'Roll, move and answer. The first traveler to reach the finish wins.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the game">'
    . shop_gallery([
      ['/assets/shop/journey-p6.webp', 520, 673, 'A page of nine question cards, each with a picture and three answers.', 'Question cards'],
      ['/assets/shop/journey-p11.webp', 520, 673, 'Paper pawns, a traveler from every world, and a paper die to fold.', 'Pawns and a die'],
      ['/assets/shop/journey-p1.webp', 520, 673, 'The one page of rules, with a picture of how the board goes together.', 'One page of rules'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🗺️', 'A big board', 'Four pages make a board about 16 by 21 inches, with a row for every world.'],
      ['❓', '36 question cards', 'Which world is this from? What does it give its city? The answer is on every card.'],
      ['🚀', 'Shortcuts and setbacks', 'Ride each world\'s own vehicles ahead, and watch out for road works.'],
      ['🧍', 'Paper pawns', 'A traveler from every world, and a paper die if you need one.'],
      ['👶', 'For younger players', 'Skip the questions, or just name the place on the card.'],
      ['🖨️', 'Print as often as you like', 'For your home or your classroom.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'Rules, how to put the board together, and ways to play'],
      ['2 to 5', 'The board, in four parts to tape together: a row for every world, with shortcuts and setbacks'],
      ['6 to 9', '36 question cards, nine to a page'],
      ['10', 'Card backs, for printing on both sides'],
      ['11', 'Pawns, a traveler from every world, and a paper die'],
    ], 'A PDF of 11 pages, in US Letter and A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What do I get?', 'A PDF of 11 pages to download right away: the rules, a board on four pages, 36 cards, card backs, and pawns with a paper die, in both US Letter and A4.'],
      ['Do I need a big printer?', 'No. The board prints on four ordinary pages that you tape together from the back.'],
      ['Is it educational?', 'Yes. Every question card is about a place on this site: which world it comes from, or which need it meets.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);

/* ---------- City Bingo ---------- */
shop_page('bingo', [
  'title' => 'City Bingo: picture bingo for a whole class',
  'desc' => 'Printable picture bingo for 3 to 30 players, ages 5 and up: 30 different cards, calling cards with a clue for each place and a caller\'s checklist.',
  'tag' => 'Print at home · For classrooms and parties',
  'lead' => 'Read a clue, find the place, cover it. There are 30 different cards, so a whole class can play at once.',
  'facts' => ['3 to 30 players', 'Ages 5 and up', '15 to 30 minutes', 'PDF in Letter and A4'],
  'perfect' => ['whole classes', 'parties', 'children who don\'t read yet'],
  'pic' => '<img src="/assets/shop/bingo-fan.webp" width="1100" height="697" alt="Three City Bingo cards, each a grid of pictures of places with a free square in the middle.">',
  'again' => shop_open('bingo') ? 'Bingo night, the Atlas way' : 'City Bingo is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print a card for each player.', 'Every card is different. Cut out the calling cards once.'],
      ['Play.', 'The caller reads a clue, players cover the place, and five in a row wins.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the game">'
    . shop_gallery([
      ['/assets/shop/bingo-p7.webp', 520, 673, 'A bingo card: 24 pictures of places with their names, and a free square in the middle.', 'Every card is different'],
      ['/assets/shop/bingo-p2.webp', 520, 673, 'A page of calling cards, each with a picture, a name and a clue about what the place does.', 'A clue for every place'],
      ['/assets/shop/bingo-p6.webp', 520, 673, 'The caller\'s checklist: every place to call, sorted by world.', 'The caller\'s checklist'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🎱', '30 different cards', '24 places on each, the same number from every world, with a free square in the middle.'],
      ['🗣️', '48 calling cards', 'Each with a picture and a clue about what the place does.'],
      ['✅', 'A caller\'s checklist', 'Tick places off, and check a "Bingo!" in seconds.'],
      ['🌍', 'Five ways to play', 'Picture bingo, guess first, world bingo, needs bingo and full house.'],
      ['🧒', 'For children who don\'t read yet', 'Show the picture and say the name instead of reading the clue.'],
      ['🖨️', 'Copy for every player', 'For your home or your classroom.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'Rules and five ways to play'],
      ['2 to 5', '48 calling cards with clues, twelve to a page'],
      ['6', 'The caller\'s checklist'],
      ['7 to 36', '30 different bingo cards, one to a page'],
    ], 'A PDF of 36 pages, in US Letter and A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What do I get?', 'A PDF of 36 pages to download right away: the rules, calling cards, a checklist and 30 bingo cards, in both US Letter and A4.'],
      ['How many can play?', 'Up to 30 at once, one card each. For a bigger group, print some cards twice.'],
      ['What else do I need?', 'Something to cover squares: counters, coins, beans or scraps of paper. Or print fresh cards and color the squares in.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);

/* ---------- City Planners ---------- */
shop_page('planners', [
  'title' => 'City Planners: a drawing game about planning a city',
  'desc' => 'A print-and-play flip-and-write game for 1 to 30 players, ages 7 and up: plan a city where every home is close to what people need.',
  'tag' => 'Print at home · For families and classrooms',
  'lead' => 'Each round a building card is turned over, and everyone draws one of its needs on their own map. Homes score for every different need around them.',
  'facts' => ['1 to 30 players', 'Ages 7 and up', 'About 20 minutes', 'PDF in Letter and A4'],
  'perfect' => ['whole classes', 'playing alone', 'budding city planners'],
  'pic' => '<img src="/assets/shop/planners-fan.webp" width="1100" height="697" alt="A City Planners map with a river down one side, between two pages of building cards.">',
  'again' => shop_open('planners') ? 'Plan a city where everything is close by' : 'City Planners is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print.', 'Print the cards once, and a map for each player. Everyone needs a pencil.'],
      ['Play.', 'Turn over a card, everyone draws, and after 20 rounds the best-planned city wins.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the game">'
    . shop_gallery([
      ['/assets/shop/planners-p9.webp', 520, 673, 'The River town map: a grid of 25 squares with a river down the left side, and boxes for the score.', 'Two maps to copy'],
      ['/assets/shop/planners-p2.webp', 520, 673, 'A page of building cards from every world, each showing the needs it can meet.', 'Building cards'],
      ['/assets/shop/planners-p7.webp', 520, 673, 'Challenge cards such as Parks for all and Walk to school, and two helper cards.', 'Challenges and helpers'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🏘️', 'Two maps', 'River town and Hill town. Copy them for every game.'],
      ['🃏', '46 building cards', 'Places from every world, each with the needs it can meet.'],
      ['🎯', '6 challenges', 'Two in each game, like Parks for all or Walk to school.'],
      ['👥', 'Everyone plays at once', 'One deck and a map for each player, from one to a whole class.'],
      ['🧍', 'A solo game', 'Rate your city from "keep planning" to "master planner".'],
      ['🚶', 'A real idea', 'Planners call it the 15-minute city: everything you need within a short walk.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'Rules, scoring and a solo game'],
      ['2 to 7', '46 building cards, 6 challenges and 2 helper cards'],
      ['8', 'Card backs, for printing on both sides'],
      ['9 and 10', 'Two maps to copy: River town and Hill town'],
    ], 'A PDF of 10 pages, in US Letter and A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What do I get?', 'A PDF of 10 pages to download right away: the rules, 54 cards, card backs and two maps, in both US Letter and A4.'],
      ['How many maps do I need?', 'One for each player in each game. Copy them as often as you need.'],
      ['What is a 15-minute city?', 'An idea from city planning: homes close to shops, schools, parks and doctors, so people can walk or bike to what they need.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);
