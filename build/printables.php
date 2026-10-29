<?php
// ---------- Five more things to print (build/shop.php has the shop itself) ----------
// /trivia/ (a family quiz game), /wordwall/ (classroom vocabulary), /calendar/ (a 2027 wall calendar), /playset/ (a play
// mat with stand-up buildings) and /activity/ (an activity book). Each is a PDF made in the atlas-products project
// from this site's own places and words, so they cover every world on the site. Prices and checkout links are in
// config.php (SHOP).

$SHOP_INFO += [
  'trivia' => ['Atlas Trivia', '/trivia/', 'A family quiz game to print', '162 questions at three levels, so children and grown-ups play together.', '/assets/shop/trivia-fan.webp', 1100, 697],
  'wordwall' => ['Atlas Word Wall', '/wordwall/', 'Classroom vocabulary to print', '144 big word cards, a banner for every world and a glossary of 661 words.', '/assets/shop/wordwall-fan.webp', 1100, 697],
  'calendar' => ['2027 Calendar', '/calendar/', 'A wall calendar to print', 'A landmark from a different world every month, with room to write.', '/assets/shop/calendar-fan.webp', 1100, 697],
  'playset' => ['Build-a-City Play Set', '/playset/', 'A play set to print', 'A big play mat and 96 stand-up buildings, people and vehicles.', '/assets/shop/playset-fan.webp', 1100, 697],
  'activity' => ['Activity Book', '/activity/', 'An activity book to print', 'A crossword, a maze, a word scramble and a puzzle for every world.', '/assets/shop/activity-fan.webp', 1100, 697],
];

/* ---------- Atlas Trivia ---------- */
shop_page('trivia', [
  'title' => 'Atlas Trivia: a family quiz game to print',
  'desc' => 'A printable quiz game for 2 to 6 players or teams, ages 7 and up: 162 questions about six worlds, with an easy, a medium and a hard one on every card.',
  'tag' => 'Print at home · For families, classrooms and quiz nights',
  'lead' => 'Every card has an easy, a medium and a hard question, so a seven-year-old and a grandparent can play the same game. Answer right to keep the card; collect all six worlds to win.',
  'facts' => ['2 to 6 players or teams', 'Ages 7 and up', '20 to 40 minutes', '162 questions'],
  'perfect' => ['family game night', 'mixed ages', 'classroom review', 'road trips'],
  'pic' => '<img src="/assets/shop/trivia-fan.webp" width="1100" height="697" alt="Atlas Trivia: the rules page between two pages of question cards from Ancient Egypt and the Heavenly City.">',
  'again' => shop_open('trivia') ? 'Questions for every age, in one game' : 'Atlas Trivia is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Pick your level.', 'Easy names the place in the picture, medium explains a word, hard names a place from what it does.'],
      ['Answer to keep the card.', 'Each card belongs to one world. Tick it in your passport.'],
      ['Collect every world.', 'The first player with a card from all six worlds wins.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the game">'
    . shop_gallery([
      ['/assets/shop/trivia-p2.webp', 520, 673, 'Nine question cards from Ancient Egypt, each with a picture question, a word question and a hard question.', 'Three questions on every card'],
      ['/assets/shop/trivia-p7.webp', 520, 673, 'Nine question cards from the Heavenly City.', 'A page for every world'],
      ['/assets/shop/trivia-p9.webp', 520, 673, 'Four passports, each with a box for every world to tick.', 'Passports to collect the worlds'],
      ['/assets/shop/trivia-p1.webp', 520, 673, 'One page of rules, with team, quiz-night and classroom versions.', 'One page of rules'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['❓', '54 question cards', '162 questions in all: 27 about each of the six worlds.'],
      ['🧒', 'Three levels', 'Easy picture questions for young children, harder ones for grown-ups, on the same card.'],
      ['✅', 'Answers on every card', 'Upside down at the bottom, so anyone can be the quizmaster.'],
      ['🛂', 'Passports', 'Tick off each world as you win its cards.'],
      ['👥', 'Ways to play', 'Teams with steals, quiz night with a quizmaster, and a classroom warm-up.'],
      ['🖨️', 'Print as often as you like', 'For your home or your classroom.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'Rules, the three levels, and ways to play'],
      ['2 to 7', '54 question cards, nine to a page: Ancient Egypt, Ancient Rome, Modern Town, Green World, Robotic Future and the Heavenly City'],
      ['8', 'Card backs, for printing on both sides'],
      ['9', 'Four passports'],
    ], 'A PDF of 9 pages, in US Letter and A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['Can young children really play?', 'Yes. Level 1 only asks them to name the place in a picture, and the name is often something they will have seen on this site. A grown-up reads the card.'],
      ['Are the questions about real places?', 'Each question is about a place on The Atlas of Cities: real ones from Egypt, Rome and today, and imagined ones from the green, future and heavenly worlds. Every answer is explained on the site.'],
      ['What do I need?', 'Scissors, a pencil, and thick paper if you have it. Cards last longer on card stock or in sleeves.'],
      ['Can I print more copies?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);

/* ---------- Atlas Word Wall ---------- */
shop_page('wordwall', [
  'title' => 'Atlas Word Wall: vocabulary cards for how cities work',
  'desc' => 'A printable word wall for grades 2 to 8: 144 big vocabulary cards with simple meanings and pictures, a banner for each world and a 661-word glossary.',
  'tag' => 'Print at home · For teachers and homeschool',
  'lead' => 'Big, clear word cards that students can read from across the room, each with a definition written for children and a picture of the place the word belongs to.',
  'facts' => ['Grades 2 to 8', '144 word cards', '6 world banners', '661-word glossary'],
  'perfect' => ['classroom word walls', 'vocabulary centers', 'homeschool units', 'test review'],
  'pic' => '<img src="/assets/shop/wordwall-fan.webp" width="1100" height="697" alt="Atlas Word Wall: the teacher\'s guide, a page of word cards such as Pharaoh and Sphinx, and the world banners.">',
  'again' => shop_open('wordwall') ? 'A word wall your class will actually read' : 'The Atlas Word Wall is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Print and cut.', 'Card stock is best. Four cards to a page, two banners to a page.'],
      ['Put it up by world.', 'A banner heads each world, and the colored edge shows where every card belongs.'],
      ['Use it every day.', 'Word of the day, sorting, matching and more: ideas are in the guide.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the word wall">'
    . shop_gallery([
      ['/assets/shop/wordwall-p5.webp', 520, 673, 'Four word cards from Ancient Egypt: Pharaoh, Sphinx, Obelisk and Bastet, each with a definition and a picture.', 'Four big cards to a page'],
      ['/assets/shop/wordwall-p2.webp', 520, 673, 'Two world banners, Ancient Egypt and Ancient Rome, with a landmark picture.', 'A banner for every world'],
      ['/assets/shop/wordwall-p41.webp', 520, 673, 'The first glossary page: every word, its meaning and the place it comes from, A to Z.', 'A glossary of 661 words'],
      ['/assets/shop/wordwall-p1.webp', 520, 673, 'The teacher\'s guide: how to make the wall and ways to use it.', 'Ideas for using it'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🔤', '144 word cards', '24 for each world, from pharaoh and hypocaust to hydroponics.'],
      ['🖼️', 'A picture on every card', 'The place where the word belongs, so students remember it.'],
      ['🏷️', '6 world banners', 'In each world\'s color, to head its part of the wall.'],
      ['📖', 'A 661-word glossary', 'Every word on The Atlas of Cities, by world and A to Z: your answer list.'],
      ['💡', 'Ideas for using it', 'Word of the day, sorting by world or need, and matching games.'],
      ['🔗', 'Linked to the site', 'Every word comes from a page students can visit for pictures and more facts.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'Teacher\'s guide: making the wall and ways to use it'],
      ['2 to 4', 'Six world banners, two to a page'],
      ['5 to 40', '144 word cards, four to a page, six pages for each world'],
      ['41 to 49', 'The glossary: all 661 words by world, A to Z, with the place each comes from'],
    ], 'A PDF of 49 pages in US Letter, or 48 in A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What grades is it for?', 'Grades 2 to 8. The definitions are short and written for children; older students can use the glossary for research.'],
      ['Does it go with the Classroom Pack?', 'Yes. The words come from the same places as the Classroom Pack\'s fact cards and worksheets, so the two work well together.'],
      ['Can I copy it for my students?', 'Yes, as many copies as your class needs. One purchase is for one teacher\'s classroom or one home; please don\'t share the file online.'],
    ]) . '</section>',
]);

/* ---------- 2027 Calendar ---------- */
shop_page('calendar', [
  'title' => 'The Atlas of Cities 2027 Calendar: a wall calendar to print',
  'desc' => 'A printable 2027 wall calendar: a cover, a page for every month with a landmark from one of six worlds and a fact about it, and the year at a glance.',
  'tag' => 'Print at home · For your wall, your fridge or a gift',
  'lead' => 'Twelve months, six worlds. Every month brings a new landmark in its own landscape, from the pyramid in January to the palace of light in December, with big boxes to write in.',
  'facts' => ['14 pages', 'Weeks start Sunday (Letter) or Monday (A4)', 'Room to write'],
  'perfect' => ['kitchens and classrooms', 'family planning', 'gifts'],
  'pic' => '<img src="/assets/shop/calendar-fan.webp" width="1100" height="697" alt="The 2027 calendar: the cover with six landmarks, January with the pyramid and June with the tree of life.">',
  'again' => shop_open('calendar') ? 'A new world every month' : 'The 2027 Calendar is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Download.', 'You get the PDF right after paying.'],
      ['Print.', 'All at once, or one month at a time. Matte paper looks best.'],
      ['Hang it up.', 'Clip, pin or bind it, and write in the big day boxes.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the calendar">'
    . shop_gallery([
      ['/assets/shop/calendar-p2.webp', 520, 673, 'January 2027: the pyramid in its desert landscape above the month\'s grid.', 'January: the pyramid'],
      ['/assets/shop/calendar-p7.webp', 520, 673, 'June 2027: the tree of life above the clouds.', 'June: the tree of life'],
      ['/assets/shop/calendar-p14.webp', 520, 673, 'The year at a glance: all twelve months of 2027 on one page.', 'The year at a glance'],
      ['/assets/shop/calendar-p1.webp', 520, 673, 'The cover: 2027, with a landmark from each of the six worlds.', 'The cover'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🗓️', '12 month pages', 'A landmark from a different world every month, each in its own landscape.'],
      ['💡', 'A fact every month', 'A line about the month\'s landmark. Learn more on the site.'],
      ['✏️', 'Room to write', 'Big day boxes for birthdays, school days and plans.'],
      ['📅', 'The year at a glance', 'All of 2027 on one page.'],
      ['🌍', 'Sunday or Monday', 'The Letter version starts weeks on Sunday, the A4 version on Monday.'],
      ['🎁', 'An easy gift', 'Print it on good paper and bind it for grandparents, teachers or friends.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'The cover'],
      ['2 to 13', 'January to December: the pyramid, the amphitheater, the skyscraper, the treetop village, the spaceport, the tree of life, the Great Sphinx, the Pantheon, the public library, the great tree hall, the space elevator anchor and the palace of light'],
      ['14', '2027 at a glance'],
    ], 'A PDF of 14 pages, in US Letter and A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['Does it show holidays?', 'No, so it works in any country. Write in the days that matter to you.'],
      ['Can I print it more than once?', 'Yes, for your own home or classroom. Please don\'t share the file online.'],
      ['How do I hang it?', 'Punch two holes at the top and tie with string, use a clip, or take it to a print shop to have it bound.'],
    ]) . '</section>',
]);

/* ---------- Build-a-City Play Set ---------- */
shop_page('playset', [
  'title' => 'Build-a-City Play Set: a play mat and stand-up city to print',
  'desc' => 'A printable play set for ages 4 and up: a big play mat with a district for each of six worlds, and 96 stand-up buildings, people and vehicles to cut out and fold.',
  'tag' => 'Print at home · For young builders',
  'lead' => 'Turn the kitchen table into a city. Tape the mat together, fold the stand-ups, and build a Roman street, a Mars base, a city in the clouds, or all of them at once.',
  'facts' => ['Ages 4 and up', 'Mat about 16 by 21 inches', '96 stand-ups'],
  'perfect' => ['imaginative play', 'rainy days', 'storytelling', 'classroom centers'],
  'pic' => '<img src="/assets/shop/playset-mat.webp" width="760" height="1001" alt="The play mat: six districts, one for each world, each with its own ground and crossing streets.">',
  'again' => shop_open('playset') ? 'Build a city on the kitchen table' : 'The Build-a-City Play Set is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Print and tape the mat.', 'Four ordinary pages make one big mat with a district for every world.'],
      ['Cut and fold.', 'Each stand-up folds into a little tent with its picture on both sides. Card stock makes them sturdy.'],
      ['Build and play.', 'Build each world, mix them together, and tell the story of the people who live there.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the play set">'
    . shop_gallery([
      ['/assets/shop/playset-p6.webp', 520, 673, 'Six stand-up buildings from Ancient Egypt to cut out and fold, such as the granary and the House of Life.', 'Six buildings from every world'],
      ['/assets/shop/playset-p7.webp', 520, 673, 'Six people and four vehicles from Ancient Egypt: a chariot, a camel rider, an ox cart and a stone sledge.', 'People and vehicles'],
      ['/assets/shop/playset-p1.webp', 520, 673, 'The guide: how to make the set, ways to play and a checklist of ten things every city needs.', 'Ideas for play'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['🗺️', 'A big play mat', 'Four pages, about 16 by 21 inches together, with six districts and their streets.'],
      ['🏛️', '36 buildings', 'Six from every world, each with its name, from homes to the grandest landmarks.'],
      ['🧍', '36 people', 'Six from every world, ready to walk your streets.'],
      ['🚗', '24 vehicles', 'Chariots, taxis, hover cars, swan boats and more: four from every world.'],
      ['✅', 'A city checklist', 'Does your city have water, homes, food and the other things people need?'],
      ['🖨️', 'Print as often as you like', 'Make a whole city of copies, or a new set when the old one is loved to pieces.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'The guide: making the set, ways to play, and the ten needs checklist'],
      ['2 to 5', 'The play mat, in four parts to tape together'],
      ['6 to 17', 'Stand-ups, two pages for each world: six buildings, then six people and four vehicles'],
    ], 'A PDF of 17 pages, in US Letter and A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What age is it for?', 'Ages 4 and up with a grown-up to help cut; children from about 7 can make it themselves.'],
      ['What do I need?', 'Scissors, tape, and card stock for the stand-ups if you have it. Plain paper works for the mat.'],
      ['Can I print more?', 'Yes, as often as you like for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);

/* ---------- Activity Book ---------- */
shop_page('activity', [
  'title' => 'The Atlas of Cities Activity Book: 24 puzzles to print',
  'desc' => 'A printable 30-page activity book for ages 6 to 10: a crossword, a maze, a word scramble and an odd-one-out for each of six worlds, with the answers.',
  'tag' => 'Print at home · For ages 6 to 10',
  'lead' => 'Rainy day, long trip, quiet hour: hand over 30 pages of puzzles that teach a little about six cities as children solve them, with all the answers at the back.',
  'facts' => ['Ages 6 to 10', '30 pages', '24 puzzles', 'Answers included'],
  'perfect' => ['rainy days', 'travel', 'early finishers', 'homeschool'],
  'pic' => '<img src="/assets/shop/activity-fan.webp" width="1100" height="697" alt="The Activity Book: a crossword, the cover with six landmarks, and a maze.">',
  'again' => shop_open('activity') ? 'Thirty pages of quiet, happy puzzling' : 'The Activity Book is coming soon',
  'body' => '<section class="wrap section" aria-labelledby="how-h"><div class="sec-head"><h2 id="how-h">How it works</h2></div>'
    . shop_steps([
      ['Download.', 'You get the PDF right after paying, in US Letter and A4 sizes.'],
      ['Print a book, or one page.', 'Staple it into a book, or print a single puzzle when you need one.'],
      ['Puzzle and learn.', 'Every world has four puzzles; the answers are at the back.'],
    ]) . '</section>'
    . '<section class="wrap section" aria-label="Pages from the book">'
    . shop_gallery([
      ['/assets/shop/activity-p3.webp', 520, 673, 'A crossword with clues from Ancient Egypt.', 'A crossword for every world'],
      ['/assets/shop/activity-p4.webp', 520, 673, 'A maze: help an Egyptian child find the way to the lotus garden.', 'A maze for every world'],
      ['/assets/shop/activity-p5.webp', 520, 673, 'A word scramble: six places with their letters mixed up, and pictures as clues.', 'Word scrambles'],
      ['/assets/shop/activity-p6.webp', 520, 673, 'Which one doesn\'t belong? Rows of four places; one comes from a different world.', 'Which one doesn\'t belong?'],
      ['/assets/shop/activity-p27.webp', 520, 673, 'A drawing page: design a building your city needs.', 'Draw and design'],
      ['/assets/shop/activity-p1.webp', 520, 673, 'The cover, with a place from each of the six worlds and a line for the owner\'s name.', 'The cover'],
    ]) . '</section>'
    . '<section class="band" aria-labelledby="inc-h"><div class="wrap"><div class="sec-head"><h2 id="inc-h">What\'s inside</h2></div>'
    . shop_feats([
      ['✏️', '6 crosswords', 'With clues from each world\'s places, written for children.'],
      ['🌀', '6 mazes', 'Help someone from each world reach a landmark, and learn a fact about it.'],
      ['🔤', '6 word scrambles', 'Six places each, with pictures as clues.'],
      ['🔍', '6 "which one doesn\'t belong?"', 'Spot the place that comes from a different world.'],
      ['🎨', '2 drawing pages', 'Design a building your city needs, and plan your own city.'],
      ['✅', 'All the answers', 'At the back, for grown-ups.'],
    ]) . '</div></section>'
    . shop_pages([
      ['1', 'The cover, with a line for the owner\'s name'],
      ['2', 'Welcome page, contents and tips'],
      ['3 to 26', 'Four puzzles for each world: a crossword, a maze, a word scramble and which one doesn\'t belong'],
      ['27 and 28', 'Draw and design: a building your city needs, and your own city plan'],
      ['29 and 30', 'All the answers'],
    ], 'A PDF of 30 pages, in US Letter and A4.')
    . '<section class="wrap section narrow" aria-labelledby="faq-h"><h2 id="faq-h">Questions</h2>'
    . shop_faq([
      ['What age is it for?', 'Ages 6 to 10. Younger children enjoy the mazes and drawing pages with a little help; the crosswords suit confident readers.'],
      ['Do children need to know the website?', 'No. Every puzzle works on its own, with pictures and clues. The site is there if they want to know more.'],
      ['Can I print more copies?', 'Yes, as often as you like for your own home or classroom. Please don\'t share the file online.'],
    ]) . '</section>',
]);
