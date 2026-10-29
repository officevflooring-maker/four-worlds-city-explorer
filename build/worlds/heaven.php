<?php
// The Heavenly City: an imagined city of gold and light that tells the story of Jesus, as the Bible tells it.
// Each page (and each vehicle in build/vehicles.php) tells one part of the story, in order: 'part' => [number,
// title]. The categories are the story's chapters. Section kinds: Gospel (the story, quoted from the Berean
// Standard Bible with chapter and verse), Bible (other passages), Imagined (the artist's city) and Real world
// (places, history and science today, with sources). The art is the Life RPG game's Heaven set (tools/assets.txt).

const HEAVEN_GOSPEL  = ['tag' => 'gospel'];
const HEAVEN_BIBLE   = ['tag' => 'bible'];
const HEAVEN_IMAGINE = ['tag' => 'imagined'];
const HEAVEN_REAL    = ['tag' => 'real'];

$HEAVEN_SOURCES = [
  'bible-genesis'   => 'The Bible, Genesis',
  'bible-kings'     => 'The Bible, 2 Kings',
  'bible-psalms'    => 'The Bible, Psalms',
  'bible-isaiah'    => 'The Bible, Isaiah',
  'bible-micah'     => 'The Bible, Micah',
  'bible-zechariah' => 'The Bible, Zechariah',
  'bible-matthew'   => 'The Bible, Gospel of Matthew',
  'bible-mark'      => 'The Bible, Gospel of Mark',
  'bible-luke'      => 'The Bible, Gospel of Luke',
  'bible-john'      => 'The Bible, Gospel of John',
  'bible-acts'      => 'The Bible, Acts of the Apostles',
  'bible-romans'    => 'The Bible, Letter to the Romans',
  'bible-1cor'      => 'The Bible, First Letter to the Corinthians',
  'bible-1thess'    => 'The Bible, First Letter to the Thessalonians',
  'bible-1peter'    => 'The Bible, First Letter of Peter',
  'bible-rev'       => 'The Bible, Book of Revelation',
  'brit-aspirin'    => 'Encyclopaedia Britannica, "Aspirin"',
  'nci-taxol'       => 'National Cancer Institute, "Success Story: Taxol"',
  'usfs-bristlecone'=> 'U.S. Forest Service, Great Basin bristlecone pine',
  'noaa-rainbow'    => 'NOAA SciJinks, "What causes a rainbow?"',
  'angel-north'     => 'Gateshead Council, "The Angel of the North"',
  'brit-augustus'   => 'Encyclopaedia Britannica, "Augustus"',
  'unesco-nativity' => 'UNESCO World Heritage Centre, "Birthplace of Jesus: Church of the Nativity and the Pilgrimage Route, Bethlehem"',
  'brit-bell'       => 'Encyclopaedia Britannica, "Bell"',
  'brit-carillon'   => 'Encyclopaedia Britannica, "Carillon"',
  'nps-liberty'     => 'National Park Service, Independence National Historical Park, "The Liberty Bell"',
  'brit-herod'      => 'Encyclopaedia Britannica, "Herod" (king of Judaea)',
  'imj-herod'       => 'The Israel Museum, Jerusalem, "Herod the Great: The King\'s Final Journey" (2013)',
  'brit-frankincense' => 'Encyclopaedia Britannica, "Frankincense" and "Myrrh"',
  'brit-temple'     => 'Encyclopaedia Britannica, "Temple of Jerusalem" and "Western Wall"',
  'iaa-nazareth'    => 'Israel Antiquities Authority, remains of a dwelling from the time of Jesus found in Nazareth (2009)',
  'unesco-baptism'  => 'UNESCO World Heritage Centre, "Baptism Site \'Bethany Beyond the Jordan\' (Al-Maghtas)"',
  'brit-pigeon'     => 'Encyclopaedia Britannica, "Homing pigeon"',
  'un-fez'          => 'UNESCO World Heritage Centre, "Medina of Fez"',
  'brit-lighthouse' => 'Encyclopaedia Britannica, "Lighthouse" and "Pharos of Alexandria"',
  'who-water'       => 'WHO and UNICEF Joint Monitoring Programme, "Progress on household drinking water, sanitation and hygiene 2000–2022" (2023)',
  'brit-deadsea'    => 'Encyclopaedia Britannica, "Dead Sea Scrolls"',
  'imj-scrolls'     => 'The Israel Museum, Jerusalem, the Shrine of the Book and the Dead Sea Scrolls Digital Project',
  'brit-sermon'     => 'Encyclopaedia Britannica, "Sermon on the Mount"',
  'krisciunas'      => 'Kevin Krisciunas and Don Carona, "At what distance can the human eye detect a candle flame?" (2015)',
  'brit-lordsprayer'=> 'Encyclopaedia Britannica, "Lord\'s Prayer"',
  'brit-sundayschool' => 'Encyclopaedia Britannica, "Sunday school"',
  'fao-pollinators' => 'Food and Agriculture Organization of the United Nations, "Why bees matter" (2018)',
  'brit-pisa'       => 'Encyclopaedia Britannica, "Leaning Tower of Pisa"',
  'brit-amish'      => 'Encyclopaedia Britannica, "Amish"',
  'gibson'          => 'Shimon Gibson, "The Final Days of Jesus: The Archaeological Evidence" (2009)',
  'feeding-america' => 'Feeding America, "What is a food bank?"',
  'muller'          => 'Müllers (the George Müller Charitable Trust), Bristol, the history of the orphan houses',
  'ioc-redmond'     => 'International Olympic Committee, Olympics.com, Derek Redmond at the Barcelona 1992 Games',
  'brit-jericho'    => 'Encyclopaedia Britannica, "Jericho"',
  'dunn'            => 'Dunn, Aknin and Norton, "Spending money on others promotes happiness", Science (2008)',
  'brit-passover'   => 'Encyclopaedia Britannica, "Passover"',
  'brit-lastsupper' => 'Encyclopaedia Britannica, "Last Supper", the painting by Leonardo da Vinci',
  'habitat'         => 'Habitat for Humanity, "History of Habitat"',
  'brit-gethsemane' => 'Encyclopaedia Britannica, "Gethsemane"',
  'cnr-olives'      => 'National Research Council of Italy (CNR), study of the olive trees of Gethsemane (2012)',
  'brit-pilate'     => 'Encyclopaedia Britannica, "Pontius Pilate"',
  'imj-pilate'      => 'The Israel Museum, Jerusalem, the Pilate inscription from Caesarea',
  'brit-sepulchre'  => 'Encyclopaedia Britannica, "Church of the Holy Sepulchre"',
  'brit-gold'       => 'Encyclopaedia Britannica, "Gold"',
  'brit-marble'     => 'Encyclopaedia Britannica, "Marble"',
  'brit-easter'     => 'Encyclopaedia Britannica, "Easter"',
  'gardentomb'      => 'The Garden Tomb (Jerusalem) Association',
  'usgs-clouds'     => 'U.S. Geological Survey, Water Science School, "How much does a cloud weigh?"',
  'unesco-philippi' => 'UNESCO World Heritage Centre, "Archaeological Site of Philippi"',
  'oxyrhynchus'     => 'The Oxyrhynchus Papyri, volume 15 (1922), no. 1786: a Christian hymn with musical notation',
  'brit-pearl'      => 'Encyclopaedia Britannica, "Pearl"',
  'brit-swan'       => 'Encyclopaedia Britannica, "Swan"',
  'wachsmann'       => 'Shelley Wachsmann, "The Sea of Galilee Boat: A 2000-Year-Old Discovery from the Sea of Legends" (1995)',
  'iucn-ass'        => 'IUCN Red List of Threatened Species, "African Wild Ass" (Equus africanus)',
  'brit-kush'       => 'Encyclopaedia Britannica, "Kush"',
];

// The chapters of the story: category => [label, short description].
$HEAVEN_CATEGORIES = [
  'promise' => ['1. The promise', 'God makes a good world, people turn away from him, and God promises a rescuer.'],
  'born'    => ['2. Jesus is born', 'An angel brings the news, and God\'s Son is born in Bethlehem.'],
  'young'   => ['3. Growing up', 'Jesus grows up in Nazareth and is baptized in the Jordan River.'],
  'begins'  => ['4. Jesus begins his work', 'His first sign, his first followers and good news for everyone.'],
  'teaches' => ['5. Jesus teaches', 'The Sermon on the Mount: how to live, how to pray and how to trust God.'],
  'helps'   => ['6. Jesus heals and welcomes', 'Healing, feeding, welcoming children and finding the lost.'],
  'week'    => ['7. The last week', 'Jesus rides into Jerusalem, shares a last supper and is arrested.'],
  'cross'   => ['8. The cross and the empty tomb', 'Jesus dies on the cross, and on the third day he rises again.'],
  'news'    => ['9. The good news spreads', 'Jesus goes up into heaven, and his followers carry the good news to the world.'],
  'new'     => ['10. Everything new', 'Jesus will come again, and God will make all things new.'],
];

$HEAVEN = [

// ---------------- 1. The promise ----------------
'tree-of-life' => [
  'name' => 'Tree of life', 'latin' => 'Genesis 1–3', 'cat' => 'promise', 'src' => 'art/growth_3.png', 'part' => [1, 'In the beginning'],
  'summary' => 'A great tree with golden leaves and glowing fruit. The Bible begins and ends with a tree of life, and the story of Jesus begins here.',
  'facts' => ['Read it' => 'Genesis 1–3 and John 1:1–5', 'Where' => 'The garden of Eden', 'Key words' => '"It was very good"', 'Real world' => 'Bristlecone pines, nearly 5,000 years old'],
  'sections' => [
    ['In the beginning', HEAVEN_GOSPEL, [
      'The Bible begins: "In the beginning God created the heavens and the earth" (Genesis 1:1). God made light, land and sea, plants, animals and people, and "indeed, it was very good" (Genesis 1:31). In the middle of the garden of Eden grew "the tree of life" (Genesis 2:9).',
      'But the first people, Adam and Eve, disobeyed God. Wrongdoing, which the Bible calls sin, came into the world, and they had to leave the garden and the tree of life behind (Genesis 3:22–24). Ever since, the Bible says, "all have sinned and fall short of the glory of God" (Romans 3:23).',
      'God did not give up on the people he loved. The rest of the Bible tells how he made a way back to him through his Son, Jesus, who was there at the very beginning: "Through Him all things were made" (John 1:3). On the Bible\'s last page the tree of life stands again, and "the leaves of the tree are for the healing of the nations" (Revelation 22:2).',
    ]],
    ['The tree', HEAVEN_IMAGINE, [
      'At the center of the city grows a tree that never stops giving: shade for everyone, fruit in every season and leaves that make sick people well.',
    ]],
    ['Trees that heal', HEAVEN_REAL, [
      'Many medicines come from trees and plants. Aspirin was developed from a substance found in willow bark, and a cancer medicine called Taxol was first found in the bark of the Pacific yew tree. The oldest living trees, bristlecone pines in the mountains of California, are nearly 5,000 years old.',
    ]],
  ],
  'art' => 'The illustration shows an enormous tree with golden leaves and glowing fruit, its roots in a round marble pool of clear water.',
  'look' => ['Find the glowing fruit.', 'Follow the roots into the pool.'],
  'questions' => ['What do you think "very good" says about the world God made?', 'Why do you think the Bible begins and ends with a tree of life?', 'What do trees give to people and animals?'],
  'words' => ['Creation' => 'Everything God made.', 'Sin' => 'Doing wrong against God and other people.', 'Eden' => 'The garden where the Bible\'s first people lived.'],
  'sources' => ['bible-genesis', 'bible-romans', 'bible-john', 'bible-rev', 'brit-aspirin', 'nci-taxol', 'usfs-bristlecone'],
  'related' => ['rainbow-pavilion', 'garden-of-light', 'pearl-gate'],
],

'rainbow-pavilion' => [
  'name' => 'Rainbow pavilion', 'latin' => 'Genesis 9:13 and Isaiah 9:6', 'cat' => 'promise', 'src' => 'art/shared_2.png', 'part' => [2, 'A promise from God'],
  'summary' => 'An open pavilion of flowers under a soft rainbow. In the Bible, the rainbow is a sign that God keeps his promises.',
  'facts' => ['Read it' => 'Genesis 9:13, Isaiah 9:6 and Micah 5:2', 'Where' => 'The words of God\'s prophets', 'Key words' => '"For unto us a child is born"', 'Real world' => 'Sunlight split into colors by raindrops'],
  'sections' => [
    ['A promise from God', HEAVEN_GOSPEL, [
      'After the great flood in Noah\'s time, God said: "I have set My rainbow in the clouds, and it will be a sign of the covenant between Me and the earth" (Genesis 9:13). A covenant is a promise that will not be broken.',
      'God made more promises. He told Abraham that "all the families of the earth will be blessed through you" (Genesis 12:3). Through his prophets, he promised to send a King who would bring peace: "For unto us a child is born, unto us a son is given… And He will be called Wonderful Counselor, Mighty God, Everlasting Father, Prince of Peace" (Isaiah 9:6). The prophet Micah even named the little town he would come from: Bethlehem (Micah 5:2).',
      'People waited hundreds of years for these promises to come true.',
    ]],
    ['The pavilion', HEAVEN_IMAGINE, [
      'Under the arch of a rainbow, a white pavilion stands among flowers: a place to make promises and keep them.',
    ]],
    ['How rainbows form', HEAVEN_REAL, [
      'A rainbow appears when sunlight shines into falling raindrops. Each drop bends the light, splits it into its colors, from red to violet, and reflects it back toward you. That is why you can only see a rainbow with the sun behind you and rain in front of you.',
    ]],
  ],
  'art' => 'The illustration shows an open marble pavilion with flowers under a soft rainbow arch.',
  'look' => ['Find the rainbow.', 'Name the colors you can see.'],
  'questions' => ['Why might a rainbow be a good sign of a promise?', 'Which of God\'s promises in this part would you most like to remember?', 'Why does it matter to keep a promise?'],
  'words' => ['Covenant' => 'A solemn promise or agreement.', 'Prophet' => 'A person who speaks God\'s messages.', 'Spectrum' => 'The band of colors that white light splits into.'],
  'sources' => ['bible-genesis', 'bible-isaiah', 'bible-micah', 'noaa-rainbow'],
  'related' => ['tree-of-life', 'angel-statue', 'welcome-hall'],
],

// ---------------- 2. Jesus is born ----------------
'angel-statue' => [
  'name' => 'Angel statue', 'latin' => 'Luke 1:26–38', 'cat' => 'born', 'src' => 'art/monument.png', 'part' => [3, 'The angel\'s message'],
  'summary' => 'A golden angel with open wings on a tall column. In the Bible, the angel Gabriel told Mary that she would have a son, Jesus.',
  'facts' => ['Read it' => 'Luke 1:26–38 and Matthew 1:18–25', 'Where' => 'Nazareth, a town in Galilee', 'Key words' => '"His kingdom will never end!"', 'Real world' => 'The Angel of the North, England, 20 meters tall'],
  'sections' => [
    ['The angel\'s message', HEAVEN_GOSPEL, [
      'In the town of Nazareth lived a young woman named Mary, who was engaged to marry a man named Joseph. God sent the angel Gabriel to her. "Do not be afraid, Mary, for you have found favor with God," the angel said. "Behold, you will conceive and give birth to a son, and you are to give Him the name Jesus. He will be great and will be called the Son of the Most High… His kingdom will never end!" (Luke 1:30–33).',
      'Mary asked how this could be, and the angel told her the child would come from the Holy Spirit, "for no word from God will ever fail." Mary answered: "I am the Lord\'s servant. May it happen to me according to your word" (Luke 1:34–38).',
      'An angel also spoke to Joseph in a dream: "You are to give Him the name Jesus, because He will save His people from their sins" (Matthew 1:21). He would be called Immanuel, which means "God with us" (Matthew 1:23).',
    ]],
    ['The statue', HEAVEN_IMAGINE, [
      'A shining angel stands high above the city with open wings, as if about to bring good news.',
    ]],
    ['Angels in our world', HEAVEN_REAL, [
      'Angel statues stand in many cities. The Angel of the North, a steel sculpture by Antony Gormley put up near Gateshead in England in 1998, is 20 meters tall, with wings 54 meters wide, almost as wide as a jumbo jet\'s.',
    ]],
  ],
  'art' => 'The illustration shows a tall marble column with a golden angel with open wings on top.',
  'look' => ['Find the angel\'s wings.', 'What is the angel standing on?'],
  'questions' => ['How do you think Mary felt when she heard the angel\'s news?', 'What does the name Immanuel, "God with us", tell us about Jesus?', 'What good news would you like to bring someone?'],
  'words' => ['Angel' => 'A messenger from God.', 'Immanuel' => 'A name that means "God with us".', 'Servant' => 'Someone who serves and obeys another.'],
  'sources' => ['bible-luke', 'bible-matthew', 'angel-north'],
  'related' => ['rainbow-pavilion', 'welcome-hall', 'bell-tower'],
],

'welcome-hall' => [
  'name' => 'Welcome hall', 'latin' => 'Luke 2:1–7', 'cat' => 'born', 'src' => 'art/business_2.png', 'part' => [4, 'No room in the inn'],
  'summary' => 'A hall with a bed for every guest. When Jesus was born in Bethlehem, there was no room at the inn, so he was laid in a manger.',
  'facts' => ['Read it' => 'Luke 2:1–7', 'Where' => 'Bethlehem, near Jerusalem', 'Key words' => '"No room for them in the inn"', 'Real world' => 'The Church of the Nativity, Bethlehem'],
  'sections' => [
    ['No room in the inn', HEAVEN_GOSPEL, [
      '"Now in those days a decree went out from Caesar Augustus that a census should be taken of the whole empire" (Luke 2:1). Everyone had to go to their own town to be counted. Joseph belonged to the family of King David, so he and Mary traveled from Nazareth to Bethlehem, the town of David, just as the prophet Micah had said.',
      'While they were there, Mary\'s baby was born. "She wrapped Him in swaddling cloths and laid Him in a manger, because there was no room for them in the inn" (Luke 2:7). A manger is a feeding box for animals. God\'s Son was born not in a palace, but in a place where animals were fed.',
    ]],
    ['The hall', HEAVEN_IMAGINE, [
      'In this hall, a meal, a bed and a friend are waiting for every person who arrives, whoever they are and wherever they come from. Here, no one is ever told there is no room.',
    ]],
    ['The Church of the Nativity', HEAVEN_REAL, [
      'In Bethlehem, the Church of the Nativity stands over a cave that Christians have honored as the place of Jesus\'s birth since at least the 300s. Its main door is so low, about 1.2 meters, that most visitors must bow to go in. In 2012 it became a UNESCO World Heritage Site.',
    ]],
  ],
  'art' => 'The illustration shows a two-story white marble hall with gold doors and gold-trimmed windows.',
  'look' => ['Find the gold doors.', 'How many windows can you count?'],
  'questions' => ['Why do you think God\'s Son was born in such a humble place?', 'How would you have welcomed Mary and Joseph?', 'How could you make a newcomer feel welcome?'],
  'words' => ['Census' => 'An official count of the people in a country.', 'Manger' => 'A box that holds food for animals.', 'Swaddling cloths' => 'Strips of cloth wrapped snugly around a baby.'],
  'sources' => ['bible-luke', 'bible-micah', 'brit-augustus', 'unesco-nativity'],
  'related' => ['angel-statue', 'bell-tower', 'house-of-many-rooms'],
],

'bell-tower' => [
  'name' => 'Bell tower', 'latin' => 'Luke 2:8–20', 'cat' => 'born', 'src' => 'art/town_2.png', 'part' => [5, 'Good news of great joy'],
  'summary' => 'A tall white tower of golden bells that ring out across the city. On the night Jesus was born, angels told shepherds the good news.',
  'facts' => ['Read it' => 'Luke 2:8–20', 'Where' => 'The fields near Bethlehem', 'Key words' => '"Good news of great joy"', 'Real world' => 'The Liberty Bell, Philadelphia'],
  'sections' => [
    ['Good news of great joy', HEAVEN_GOSPEL, [
      'That night, shepherds were watching their sheep in the fields near Bethlehem. Suddenly an angel of the Lord stood before them, and the glory of the Lord shone around them. They were terrified, but the angel said: "Do not be afraid! For behold, I bring you good news of great joy that will be for all the people: Today in the city of David a Savior has been born to you. He is Christ the Lord!" (Luke 2:10–11).',
      'Then a great crowd of angels appeared, praising God: "Glory to God in the highest, and on earth peace to men on whom His favor rests!" (Luke 2:14). The shepherds hurried to Bethlehem and found the baby lying in the manger, just as they had been told. They went home "glorifying and praising God for all they had heard and seen" (Luke 2:20).',
    ]],
    ['The tower', HEAVEN_IMAGINE, [
      'When something good happens in this city, the bells ring, and everyone stops to listen and celebrate.',
    ]],
    ['How bells sing', HEAVEN_REAL, [
      'A bell rings when it is struck and its metal shakes, sending out waves of sound. Bell makers tune a bell by shaving metal from the inside. Some towers hold a carillon, a set of at least 23 bells played from a keyboard.',
    ]],
    ['A bell for freedom', HEAVEN_REAL, [
      'The Liberty Bell in Philadelphia carries words from the Bible: "Proclaim liberty throughout all the land" (Leviticus 25:10). It cracked and has not been rung regularly since 1846. In the 1830s, people campaigning to end slavery gave it its name and made it a symbol of freedom.',
    ]],
  ],
  'art' => 'The illustration shows a tall white tower with an open top holding golden bells, and a gold spire.',
  'look' => ['Find the golden bells.', 'Why is the top of the tower open?'],
  'questions' => ['Why do you think the angels told shepherds first?', 'Why is the birth of a Savior called "good news of great joy"?', 'What sounds mean celebration where you live?'],
  'words' => ['Savior' => 'Someone who saves or rescues.', 'Christ' => 'From the Greek for "anointed one": the King God promised to send.', 'Carillon' => 'A set of at least 23 bells played from a keyboard.'],
  'sources' => ['bible-luke', 'brit-bell', 'brit-carillon', 'nps-liberty'],
  'related' => ['welcome-hall', 'palace-of-light', 'angel-statue'],
],

'palace-of-light' => [
  'name' => 'Palace of light', 'latin' => 'Matthew 2:1–12', 'cat' => 'born', 'src' => 'art/town_3.png', 'part' => [6, 'The star and the king'],
  'summary' => 'A great golden palace with a star on its dome. Wise men followed a star to find the newborn King, Jesus.',
  'facts' => ['Read it' => 'Matthew 2:1–15', 'Where' => 'Jerusalem and Bethlehem', 'Key words' => '"We saw His star in the east"', 'Real world' => 'King Herod\'s hilltop palace, the Herodium'],
  'sections' => [
    ['The star and the king', HEAVEN_GOSPEL, [
      'Some time later, wise men called Magi came from the east to Jerusalem, asking: "Where is the One who has been born King of the Jews? We saw His star in the east and have come to worship Him" (Matthew 2:2). King Herod was troubled, and he sent them to Bethlehem, secretly planning to harm the child.',
      'The star went ahead of the Magi until it stopped over the place where Jesus was. "When they saw the star, they rejoiced with great delight" (Matthew 2:10). They bowed down and worshiped him, and gave him gifts of gold, frankincense and myrrh. Warned in a dream, they went home another way, and an angel told Joseph to take Mary and Jesus to Egypt until Herod died (Matthew 2:12–15).',
    ]],
    ['The palace', HEAVEN_IMAGINE, [
      'At the heart of the city stands a palace with a huge gold dome and a star on top. Its doors glow, and light spills out from inside, so the whole city is bright even at night.',
    ]],
    ['Herod\'s hilltop palace', HEAVEN_REAL, [
      'King Herod the Great was a famous builder. A few kilometers from Bethlehem he built the Herodium, a palace and fortress on top of a cone-shaped hill. In 2007, the archaeologist Ehud Netzer announced that he had found Herod\'s tomb on its slope.',
    ]],
    ['Gold, frankincense and myrrh', HEAVEN_REAL, [
      'Frankincense and myrrh are sweet-smelling resins, a kind of dried tree sap, from small trees that grow in southern Arabia and the Horn of Africa. In Jesus\'s time they were used in perfume and medicine, and they could be very costly.',
    ]],
  ],
  'art' => 'The illustration shows a palace of white marble with a huge gold dome topped by a star, wide steps, glowing golden doors and small towers at the corners.',
  'look' => ['Find the star on top of the dome.', 'Where does the light come from?'],
  'questions' => ['Why do you think the wise men traveled so far?', 'What gift would you bring to Jesus?', 'Why might Herod have been afraid of a baby king?'],
  'words' => ['Magi' => 'Wise men from the east who studied the stars.', 'Frankincense' => 'A sweet-smelling tree resin, burned like incense.', 'Myrrh' => 'A fragrant tree resin used in perfume and medicine.'],
  'sources' => ['bible-matthew', 'brit-herod', 'imj-herod', 'brit-frankincense'],
  'related' => ['bell-tower', 'hall-of-wisdom', 'lamp-tower'],
],

// ---------------- 3. Growing up ----------------
'hall-of-wisdom' => [
  'name' => 'Hall of wisdom', 'latin' => 'Luke 2:41–52', 'cat' => 'young', 'src' => 'art/knowledge_3.png', 'part' => [7, 'In his Father\'s house'],
  'summary' => 'A domed library full of light. When Jesus was twelve, he sat among the teachers in the temple, listening and asking questions.',
  'facts' => ['Read it' => 'Luke 2:41–52 and Mark 6:3', 'Where' => 'The temple in Jerusalem, and Nazareth', 'Key words' => '"I had to be in My Father\'s house"', 'Real world' => 'The Western Wall, Jerusalem'],
  'sections' => [
    ['In his Father\'s house', HEAVEN_GOSPEL, [
      'Jesus grew up in Nazareth. Every year his family went to Jerusalem for the Feast of the Passover. When he was twelve, his parents set off for home and did not notice that he had stayed behind. After three days of searching, "they found Him in the temple courts, sitting among the teachers, listening to them and asking them questions. And all who heard Him were astounded at His understanding and His answers" (Luke 2:46–47).',
      '"Did you not know that I had to be in My Father\'s house?" Jesus asked (Luke 2:49). Then he went home with them and obeyed them, "and Jesus grew in wisdom and stature, and in favor with God and man" (Luke 2:52). He learned a trade, and the people of Nazareth later called him "the carpenter" (Mark 6:3).',
    ]],
    ['The hall', HEAVEN_IMAGINE, [
      'Every question anyone has ever asked has an answer waiting somewhere on these shelves, and there is always time to read it.',
    ]],
    ['The temple and its wall', HEAVEN_REAL, [
      'The temple Jesus visited had been rebuilt by King Herod on a huge stone platform. Roman soldiers destroyed it in AD 70, but part of the platform\'s western wall still stands in Jerusalem. Some of its stones weigh hundreds of tons.',
    ]],
    ['A house from Jesus\'s time', HEAVEN_REAL, [
      'In 2009, archaeologists in Nazareth uncovered the remains of a small, simple house from the time of Jesus, with a pit for storing rainwater. It suggests that Nazareth was then a small village.',
    ]],
  ],
  'art' => 'The illustration shows a domed marble library with a columned porch, a gold dome and glowing windows.',
  'look' => ['Find the columned porch.', 'Where does the light shine out?'],
  'questions' => ['What questions would you have asked the teachers in the temple?', 'What do you think it means to grow "in wisdom and stature"?', 'Why might Jesus have called the temple his Father\'s house?'],
  'words' => ['Temple' => 'The great house of worship in Jerusalem.', 'Passover' => 'A yearly feast remembering how God freed Israel from slavery in Egypt.', 'Stature' => 'Height and growth.'],
  'sources' => ['bible-luke', 'bible-mark', 'brit-temple', 'iaa-nazareth'],
  'related' => ['palace-of-light', 'dove-statue', 'scroll-library'],
],

'dove-statue' => [
  'name' => 'Dove statue', 'latin' => 'Matthew 3:13–17', 'cat' => 'young', 'src' => 'art/nt_statue.png', 'part' => [8, 'The dove and the voice'],
  'summary' => 'A golden dove with open wings. When Jesus was baptized, the Spirit of God came down on him like a dove.',
  'facts' => ['Read it' => 'Matthew 3:13–4:11 and John 1:29', 'Where' => 'The Jordan River, then the wilderness', 'Key words' => '"This is My beloved Son"', 'Real world' => 'The baptism site, a World Heritage Site'],
  'sections' => [
    ['The dove and the voice', HEAVEN_GOSPEL, [
      'When Jesus was about thirty, his relative John was baptizing people in the Jordan River, calling them to turn away from their sins. When John saw Jesus coming, he said: "Look, the Lamb of God, who takes away the sin of the world!" (John 1:29).',
      'Jesus asked John to baptize him too. "As soon as Jesus was baptized, He went up out of the water. Suddenly the heavens were opened, and He saw the Spirit of God descending like a dove and resting on Him. And a voice from heaven said, \'This is My beloved Son, in whom I am well pleased!\'" (Matthew 3:16–17).',
      'Then Jesus went into the wilderness, where he fasted for forty days and was tempted by the devil. Each time, he answered with God\'s word: "Man shall not live on bread alone, but on every word that comes from the mouth of God" (Matthew 4:4).',
    ]],
    ['The statue', HEAVEN_IMAGINE, [
      'A golden dove rises from a marble pedestal, wings open, as if setting off to carry peace across the city.',
    ]],
    ['Where Jesus was baptized', HEAVEN_REAL, [
      'On the east bank of the Jordan River, archaeologists have uncovered churches, pools and caves at a place called Bethany beyond the Jordan, where Christians have remembered the baptism of Jesus since early times. In 2015 it became a UNESCO World Heritage Site.',
    ]],
    ['Doves in our world', HEAVEN_REAL, [
      'Doves and pigeons are expert navigators: homing pigeons can find their way home from hundreds of kilometers away, and they carried messages in both World Wars.',
    ]],
  ],
  'art' => 'The illustration shows a golden dove with open wings on a white marble pedestal with gold trim.',
  'look' => ['Find the dove\'s outstretched wings.', 'Look at the pedestal. What is it made of?'],
  'questions' => ['Why do you think John called Jesus "the Lamb of God"?', 'What did the voice from heaven say about Jesus?', 'How did Jesus answer when he was tempted?'],
  'words' => ['Baptize' => 'To dip in water or pour water over someone, as a sign of a new start with God.', 'Wilderness' => 'Wild, empty land where few people live.', 'Tempt' => 'To try to get someone to do wrong.'],
  'sources' => ['bible-matthew', 'bible-john', 'unesco-baptism', 'brit-pigeon'],
  'related' => ['hall-of-wisdom', 'garden-villa', 'rainbow-pavilion'],
],

// ---------------- 4. Jesus begins his work ----------------
'garden-villa' => [
  'name' => 'Garden villa', 'latin' => 'John 2:1–11', 'cat' => 'begins', 'src' => 'art/family_2.png', 'part' => [9, 'Water into wine'],
  'summary' => 'A villa built around a courtyard with a fountain. At a wedding in Cana, Jesus turned water into wine, the first of his signs.',
  'facts' => ['Read it' => 'John 2:1–11', 'Where' => 'Cana, a village in Galilee', 'Key words' => '"Do whatever He tells you"', 'Real world' => 'Courtyard homes, from Rome to Morocco'],
  'sections' => [
    ['Water into wine', HEAVEN_GOSPEL, [
      'Jesus, his mother and his first followers were invited to a wedding in the village of Cana. During the feast the wine ran out, which would have shamed the family. Mary told the servants: "Do whatever He tells you" (John 2:5).',
      'Six large stone water jars stood nearby. "Fill the jars with water," Jesus told the servants, and they filled them to the brim. When the master of the banquet tasted it, the water had become wine, better than any served before: "You have saved the fine wine until now!" (John 2:10).',
      '"Jesus performed this, the first of His signs, at Cana in Galilee. He thus revealed His glory, and His disciples believed in Him" (John 2:11).',
    ]],
    ['The villa', HEAVEN_IMAGINE, [
      'Every room opens onto a sunny courtyard with a fountain, where the family eats, plays and celebrates, and there is always enough for every guest.',
    ]],
    ['Courtyard homes', HEAVEN_REAL, [
      'Houses built around a private courtyard are found all over the world, from the Roman domus to the courtyard houses of Beijing and the riads of Fez in Morocco. The courtyard brings light, fresh air and a safe place to play into the middle of the home.',
    ]],
  ],
  'art' => 'The illustration shows a large white villa built around a courtyard with a fountain, with gold domes and cypress trees.',
  'look' => ['Find the fountain in the courtyard.', 'How many gold domes can you see?'],
  'questions' => ['Why do you think Jesus helped at a wedding?', 'What did Mary tell the servants to do?', 'What does a sign point to?'],
  'words' => ['Sign' => 'In John\'s Gospel, a miracle that points to who Jesus is.', 'Miracle' => 'An amazing act of God\'s power.', 'Courtyard' => 'An open space surrounded by buildings or walls.'],
  'sources' => ['bible-john', 'un-fez'],
  'related' => ['dove-statue', 'lamp-tower', 'banquet-hall'],
],

'lamp-tower' => [
  'name' => 'Lamp tower', 'latin' => 'John 3:1–21', 'cat' => 'begins', 'src' => 'art/nt_tower.png', 'part' => [10, 'A visitor at night'],
  'summary' => 'A slim tower with a golden lamp that shines all night. A teacher named Nicodemus came to Jesus in the dark and heard about God\'s great love.',
  'facts' => ['Read it' => 'John 3:1–21', 'Where' => 'Jerusalem, at night', 'Key words' => '"For God so loved the world"', 'Real world' => 'The Pharos of Alexandria, an ancient lighthouse'],
  'sections' => [
    ['A visitor at night', HEAVEN_GOSPEL, [
      'A leader named Nicodemus, a teacher of God\'s law, came to Jesus at night. "Rabbi," he said, "we know that You are a teacher who has come from God" (John 3:2). Jesus told him: "Truly, truly, I tell you, no one can see the kingdom of God unless he is born again" (John 3:3). He meant that a person needs a new life from God\'s Spirit.',
      'Then Jesus spoke words that many people call the heart of the whole Bible: "For God so loved the world that He gave His one and only Son, that everyone who believes in Him shall not perish but have eternal life. For God did not send His Son into the world to condemn the world, but to save the world through Him" (John 3:16–17).',
    ]],
    ['A light in the dark', HEAVEN_BIBLE, [
      'Later Jesus said: "I am the light of the world. Whoever follows Me will never walk in the darkness, but will have the light of life" (John 8:12). A psalm says to God: "Your word is a lamp to my feet and a light to my path" (Psalm 119:105).',
    ]],
    ['The tower', HEAVEN_IMAGINE, [
      'Lamp towers stand all over the city, so that no one ever has to walk in the dark or feel lost.',
    ]],
    ['Lights that keep people safe', HEAVEN_REAL, [
      'Lighthouses have guided ships for more than 2,000 years. The Pharos of Alexandria in Egypt, built around 280 BC, was one of the Seven Wonders of the Ancient World. Today street lights make towns safer at night, but too much light hides the stars, so some towns now use softer lights that point downward.',
    ]],
  ],
  'art' => 'The illustration shows a slim white marble tower with a glowing golden lamp at the top.',
  'look' => ['Find the lamp at the top.', 'How tall is the tower compared with the trees?'],
  'questions' => ['What do you think Jesus meant by being "born again"?', 'What does John 3:16 say God did because he loved the world?', 'How is Jesus like a light in the dark?'],
  'words' => ['Eternal life' => 'Life with God that never ends.', 'Perish' => 'To die or be lost.', 'Rabbi' => 'A Jewish teacher.'],
  'sources' => ['bible-john', 'bible-psalms', 'brit-lighthouse'],
  'related' => ['garden-villa', 'fountain-of-life', 'lantern-circle'],
],

'fountain-of-life' => [
  'name' => 'Fountain of life', 'latin' => 'John 4:5–42', 'cat' => 'begins', 'src' => 'art/fountain.png', 'part' => [11, 'Living water'],
  'summary' => 'A marble fountain of sparkling water. At a well in Samaria, Jesus offered a woman "living water" that would never run out.',
  'facts' => ['Read it' => 'John 4:5–42', 'Where' => 'Jacob\'s well, in Samaria', 'Key words' => '"Living water"', 'Real world' => 'About 2 billion people lack safe water at home'],
  'sections' => [
    ['Living water', HEAVEN_GOSPEL, [
      'Traveling through Samaria, Jesus sat down, tired, by Jacob\'s well. When a Samaritan woman came to draw water, he said: "Give Me a drink" (John 4:7). She was amazed, because Jews and Samaritans did not get along.',
      'Jesus answered: "If you knew the gift of God and who is asking you for a drink, you would have asked Him, and He would have given you living water… Everyone who drinks this water will be thirsty again. But whoever drinks the water I give him will never thirst" (John 4:10–14).',
      'The woman went back to her town and told everyone about him. Many came to hear Jesus for themselves and said: "We know that this man truly is the Savior of the world" (John 4:42).',
    ]],
    ['The river of life', HEAVEN_BIBLE, [
      'The last book of the Bible pictures "a river of the water of life, as clear as crystal, flowing from the throne of God and of the Lamb" through the heavenly city (Revelation 22:1).',
    ]],
    ['The fountain', HEAVEN_IMAGINE, [
      'Clear water flows from a golden top into a wide marble basin, and anyone may drink. The water never runs out and never makes anyone sick.',
    ]],
    ['Clean water for all', HEAVEN_REAL, [
      'Clean water is one of the most important things for good health. The World Health Organization and UNICEF reported that in 2022 about 2.2 billion people still did not have safe drinking water at home. Wells, pipes, filters and water treatment save millions of lives.',
    ]],
  ],
  'art' => 'The illustration shows a round marble fountain with clear, sparkling water flowing from a gold top.',
  'look' => ['Find where the water comes out.', 'How many levels does the fountain have?'],
  'questions' => ['What do you think Jesus meant by "living water"?', 'Why was the woman surprised that Jesus spoke to her?', 'What could people do so that everyone has clean water?'],
  'words' => ['Samaritan' => 'A person from Samaria, a region between Galilee and Judea.', 'Well' => 'A deep hole dug to reach water underground.', 'Thirst' => 'The need to drink.'],
  'sources' => ['bible-john', 'bible-rev', 'who-water'],
  'related' => ['lamp-tower', 'scroll-library', 'spring-pool'],
],

'scroll-library' => [
  'name' => 'Scroll library', 'latin' => 'Luke 4:16–22', 'cat' => 'begins', 'src' => 'art/knowledge_1.png', 'part' => [12, 'Good news for the poor'],
  'summary' => 'A small marble library of scrolls. In his hometown, Jesus unrolled the scroll of Isaiah and said that the prophet\'s words had come true.',
  'facts' => ['Read it' => 'Luke 4:14–22', 'Where' => 'The synagogue in Nazareth', 'Key words' => '"Today this Scripture is fulfilled"', 'Real world' => 'The Great Isaiah Scroll, more than 2,000 years old'],
  'sections' => [
    ['Good news for the poor', HEAVEN_GOSPEL, [
      'Jesus came back to Nazareth, where he had grown up. On the Sabbath he went to the synagogue, the meeting place for prayer, and stood up to read. He was handed the scroll of the prophet Isaiah. "Unrolling it, He found the place where it was written: \'The Spirit of the Lord is on Me, because He has anointed Me to preach good news to the poor. He has sent Me to proclaim liberty to the captives and recovery of sight to the blind, to release the oppressed, to proclaim the year of the Lord\'s favor\'" (Luke 4:17–19).',
      'He rolled up the scroll and sat down, and everyone stared at him. Then he said: "Today this Scripture is fulfilled in your hearing" (Luke 4:21). Jesus was saying that he was the one Isaiah had written about.',
    ]],
    ['The library', HEAVEN_IMAGINE, [
      'In this library every story, song and prayer is kept safe, and anyone may unroll a scroll and read.',
    ]],
    ['The Great Isaiah Scroll', HEAVEN_REAL, [
      'In 1947, young shepherds exploring caves near the Dead Sea found clay jars holding ancient scrolls. Among them was a complete copy of the book of Isaiah, more than 7 meters long, copied over a hundred years before Jesus was born. It is kept at the Israel Museum in Jerusalem and can be read online.',
    ]],
  ],
  'art' => 'The illustration shows a small marble library with shelves of scrolls and a gold roof.',
  'look' => ['Find the shelves of scrolls.', 'What color is the roof?'],
  'questions' => ['What good news did Isaiah say the promised one would bring?', 'Why do you think everyone stared at Jesus?', 'Why would people copy books by hand so carefully?'],
  'words' => ['Scroll' => 'A long roll of writing material.', 'Synagogue' => 'A Jewish meeting place for prayer and reading the Scriptures.', 'Sabbath' => 'The weekly day of rest.'],
  'sources' => ['bible-luke', 'bible-isaiah', 'brit-deadsea', 'imj-scrolls'],
  'related' => ['fountain-of-life', 'swan-boat', 'hall-of-wisdom'],
],

// ---------------- 5. Jesus teaches ----------------
'lantern-circle' => [
  'name' => 'Lantern circle', 'latin' => 'Matthew 5:1–16', 'cat' => 'teaches', 'src' => 'art/shared_1.png', 'part' => [14, 'The light of the world'],
  'summary' => 'Marble benches around a great golden lamp. On a mountainside, Jesus taught: "You are the light of the world. A city on a hill cannot be hidden."',
  'facts' => ['Read it' => 'Matthew 5:1–16', 'Where' => 'A mountainside in Galilee', 'Key words' => '"Blessed are the peacemakers"', 'Real world' => 'A candle can be seen 2.6 kilometers away'],
  'sections' => [
    ['The light of the world', HEAVEN_GOSPEL, [
      'Crowds followed Jesus everywhere. One day "He went up on the mountain and sat down" and began to teach (Matthew 5:1). This teaching is called the Sermon on the Mount. It begins with blessings: "Blessed are the poor in spirit, for theirs is the kingdom of heaven… Blessed are the merciful, for they will be shown mercy… Blessed are the peacemakers, for they will be called sons of God" (Matthew 5:3–9).',
      'Then Jesus told his followers: "You are the light of the world. A city on a hill cannot be hidden. Neither do people light a lamp and put it under a basket… In the same way, let your light shine before men, that they may see your good deeds and glorify your Father in heaven" (Matthew 5:14–16).',
    ]],
    ['The circle', HEAVEN_IMAGINE, [
      'Every evening, people gather around the great lamp. No one sits at the head of a circle, so everyone can see and hear everyone else.',
    ]],
    ['How far a little light shines', HEAVEN_REAL, [
      'A small light is hard to hide in the dark. In 2015, two scientists worked out that on a clear, dark night, the human eye can see a single candle flame from about 2.6 kilometers away.',
    ]],
  ],
  'art' => 'The illustration shows a circle of marble benches around a tall, glowing golden lamp.',
  'look' => ['Find the glowing lamp.', 'How many benches are there?'],
  'questions' => ['Which blessing from the Sermon on the Mount do you like best, and why?', 'What does it mean to "let your light shine"?', 'What good deed could you do this week?'],
  'words' => ['Blessed' => 'Happy because God is pleased with you.', 'Merciful' => 'Kind and forgiving to people who do not deserve it.', 'Peacemaker' => 'Someone who helps people stop fighting and get along.'],
  'sources' => ['bible-matthew', 'brit-sermon', 'krisciunas'],
  'related' => ['school-of-wisdom', 'lamp-tower', 'lily-garden'],
],

'school-of-wisdom' => [
  'name' => 'School of wisdom', 'latin' => 'Matthew 6:9–13', 'cat' => 'teaches', 'src' => 'art/knowledge_2.png', 'part' => [15, 'Teach us to pray'],
  'summary' => 'A school with a little gold dome and a bell. When his friends asked, "Lord, teach us to pray," Jesus taught them the Lord\'s Prayer.',
  'facts' => ['Read it' => 'Matthew 6:5–13 and Luke 11:1–4', 'Where' => 'Galilee', 'Key words' => '"Our Father in heaven"', 'Real world' => 'Sunday schools, since 1780'],
  'sections' => [
    ['Teach us to pray', HEAVEN_GOSPEL, [
      'Jesus taught that prayer is not for showing off. "When you pray, go into your inner room, shut your door, and pray to your Father, who is unseen" (Matthew 6:6). One day, after Jesus had finished praying, one of his disciples asked: "Lord, teach us to pray" (Luke 11:1). So he gave them the prayer now called the Lord\'s Prayer:',
      '"Our Father in heaven, hallowed be Your name. Your kingdom come, Your will be done, on earth as it is in heaven. Give us this day our daily bread. And forgive us our debts, as we also have forgiven our debtors. And lead us not into temptation, but deliver us from the evil one" (Matthew 6:9–13).',
      'Christians all over the world still pray it, in hundreds of languages.',
    ]],
    ['The school', HEAVEN_IMAGINE, [
      'No one is ever too old or too young for this school, and every student is also a teacher of something.',
    ]],
    ['Schools on Sundays', HEAVEN_REAL, [
      'In 1780, in Gloucester, England, Robert Raikes began opening schools on Sundays for poor children who worked in factories the rest of the week. The children learned to read, using the Bible. Sunday schools spread quickly, and by the 1830s more than a million children in Britain went to one.',
    ]],
  ],
  'art' => 'The illustration shows a two-story hall with columns, a small gold dome and a bell.',
  'look' => ['Find the bell.', 'Where would students come in?'],
  'questions' => ['What do you think "on earth as it is in heaven" means?', 'Which part of the Lord\'s Prayer would you most like to remember?', 'When could you find a quiet moment to pray?'],
  'words' => ['Hallowed' => 'Treated as holy and honored.', 'Debt' => 'Something owed; in the Lord\'s Prayer, the wrong we have done.', 'Temptation' => 'Something that pulls you toward doing wrong.'],
  'sources' => ['bible-matthew', 'bible-luke', 'brit-lordsprayer', 'brit-sundayschool'],
  'related' => ['lantern-circle', 'lily-garden', 'prayer-chapel'],
],

'lily-garden' => [
  'name' => 'Lily garden', 'latin' => 'Matthew 6:19–34', 'cat' => 'teaches', 'src' => 'art/nt_garden.png', 'part' => [16, 'Do not worry'],
  'summary' => 'A bed of white lilies and golden flowers. Jesus pointed to the flowers of the field to teach people to trust God and not to worry.',
  'facts' => ['Read it' => 'Matthew 6:19–34', 'Where' => 'The Sermon on the Mount', 'Key words' => '"Consider how the lilies of the field grow"', 'Real world' => 'Flowers feed bees and other pollinators'],
  'sections' => [
    ['Do not worry', HEAVEN_GOSPEL, [
      'Jesus taught that riches on earth do not last: "Store up for yourselves treasures in heaven… For where your treasure is, there your heart will be also" (Matthew 6:20–21).',
      'He told his listeners not to worry about food or clothes. "Look at the birds of the air: They do not sow or reap or gather into barns, and yet your heavenly Father feeds them… Consider how the lilies of the field grow: They do not labor or spin. Yet I tell you that not even Solomon in all his glory was adorned like one of these" (Matthew 6:26–29).',
      '"But seek first the kingdom of God and His righteousness, and all these things will be added unto you" (Matthew 6:33).',
    ]],
    ['The garden', HEAVEN_IMAGINE, [
      'Flowers bloom here all year round, and no one has to worry about tomorrow.',
    ]],
    ['Flowers and pollinators', HEAVEN_REAL, [
      'Flowers are not only beautiful. Bees, butterflies and other pollinators carry pollen from flower to flower, which helps plants make fruit and seeds. About three out of every four kinds of food crops depend at least partly on pollinators.',
    ]],
  ],
  'art' => 'The illustration shows a bed of white lilies and golden flowers with a low marble edge.',
  'look' => ['Find the white lilies.', 'Which flowers are golden?'],
  'questions' => ['What do you think Jesus meant about not worrying?', 'What are "treasures in heaven"?', 'What could you plant to help bees?'],
  'words' => ['Righteousness' => 'Being right with God and doing what is right.', 'Pollinator' => 'An animal that carries pollen from flower to flower.', 'Solomon' => 'A king of Israel famous for his wisdom and riches.'],
  'sources' => ['bible-matthew', 'fao-pollinators'],
  'related' => ['school-of-wisdom', 'light-crane', 'hall-of-treasures'],
],

'light-crane' => [
  'name' => 'Light crane', 'latin' => 'Matthew 7:24–29', 'cat' => 'teaches', 'src' => 'build/crane.png', 'part' => [17, 'The wise builder'],
  'summary' => 'A golden crane that lifts marble blocks on a beam of light. Jesus told a story about a wise man who built his house on the rock.',
  'facts' => ['Read it' => 'Matthew 7:24–29', 'Where' => 'The end of the Sermon on the Mount', 'Key words' => '"A wise man who built his house on the rock"', 'Real world' => 'The Leaning Tower of Pisa'],
  'sections' => [
    ['The wise builder', HEAVEN_GOSPEL, [
      'Jesus ended the Sermon on the Mount with a story: "Everyone who hears these words of Mine and acts on them is like a wise man who built his house on the rock. The rain fell, the torrents raged, and the winds blew and beat against that house; yet it did not fall, because its foundation was on the rock" (Matthew 7:24–25).',
      'But someone who hears his words and does not act on them is "like a foolish man who built his house on sand." When the storm came, "it fell—and great was its collapse!" (Matthew 7:26–27). The crowds "were astonished at His teaching, because He taught as one who had authority" (Matthew 7:28–29).',
    ]],
    ['The crane', HEAVEN_IMAGINE, [
      'Instead of a rope, a beam of soft light holds each glowing marble block and lowers it gently into place on solid rock.',
    ]],
    ['A tower on soft ground', HEAVEN_REAL, [
      'The bell tower of Pisa, in Italy, began to lean while it was still being built in the 1100s, because its foundation was laid in soft ground. It was closed from 1990 to 2001 while engineers worked to stop it falling, partly by removing soil from under its high side.',
    ]],
    ['Raising a barn together', HEAVEN_REAL, [
      'In Amish communities in the United States, neighbors gather for a "barn raising". With many hands working together, they can put up the whole frame of a barn for one family in a single day, and share a big meal afterward.',
    ]],
  ],
  'art' => 'The illustration shows a slim white marble tower with a long gold arm and a beam of light instead of a rope, lifting a glowing marble block.',
  'look' => ['Follow the beam of light to the block.', 'Find the gold arm.'],
  'questions' => ['What does it mean to build your life "on the rock"?', 'Why is it not enough just to hear good words?', 'Why does a building need a strong foundation?'],
  'words' => ['Foundation' => 'The solid base a building stands on.', 'Torrent' => 'A fast, powerful rush of water.', 'Authority' => 'The right and power to lead or decide.'],
  'sources' => ['bible-matthew', 'brit-pisa', 'brit-amish'],
  'related' => ['lily-garden', 'building-materials', 'house-of-many-rooms'],
],

// ---------------- 6. Jesus heals and welcomes ----------------
'spring-pool' => [
  'name' => 'Spring pool', 'latin' => 'John 5:1–9', 'cat' => 'helps', 'src' => 'art/fitness_1.png', 'part' => [18, 'Get up and walk'],
  'summary' => 'A marble pool fed by a waterfall. At the Pool of Bethesda in Jerusalem, Jesus healed a man who had been ill for 38 years.',
  'facts' => ['Read it' => 'John 5:1–9', 'Where' => 'The Pool of Bethesda, Jerusalem', 'Key words' => '"Get up, pick up your mat, and walk"', 'Real world' => 'The pool, uncovered by archaeologists'],
  'sections' => [
    ['Get up and walk', HEAVEN_GOSPEL, [
      '"Now there is in Jerusalem near the Sheep Gate a pool with five covered colonnades, which in Hebrew is called Bethesda" (John 5:2). Many people who were sick, blind or lame lay beside it. One man there had been ill for thirty-eight years.',
      'Jesus asked him: "Do you want to get well?" The man said he had no one to help him into the water. Then Jesus told him: "Get up, pick up your mat, and walk." "Immediately the man was made well, and he picked up his mat and began to walk" (John 5:6–9).',
      'Wherever Jesus went, he healed people who were sick, blind or unable to walk, showing God\'s love and power.',
    ]],
    ['Beside quiet waters', HEAVEN_BIBLE, [
      'A well-loved psalm pictures God as a shepherd: "The LORD is my shepherd; I shall not want. He makes me lie down in green pastures; He leads me beside quiet waters. He restores my soul" (Psalm 23:1–3). Jesus later said: "I am the good shepherd" (John 10:11).',
    ]],
    ['The pool, found again', HEAVEN_REAL, [
      'In the 1800s, archaeologists digging beside the Church of Saint Anne in Jerusalem\'s Old City found two large pools separated by a wall of rock. Many think that colonnades on the four sides and the middle wall made the "five covered colonnades" John described.',
    ]],
  ],
  'art' => 'The illustration shows a marble pool fed by a small waterfall over marble steps, with cypress trees.',
  'look' => ['Follow the water from the top to the pool.', 'Find the cypress trees.'],
  'questions' => ['Why do you think Jesus asked the man, "Do you want to get well?"', 'How did the man\'s life change that day?', 'Where do you go to feel calm?'],
  'words' => ['Colonnade' => 'A row of columns holding up a roof.', 'Heal' => 'To make well again.', 'Shepherd' => 'A person who looks after sheep.'],
  'sources' => ['bible-john', 'bible-psalms', 'gibson'],
  'related' => ['fountain-of-life', 'sharing-pavilion', 'marble-cottage'],
],

'sharing-pavilion' => [
  'name' => 'Sharing pavilion', 'latin' => 'John 6:1–14', 'cat' => 'helps', 'src' => 'art/business_1.png', 'part' => [19, 'Five loaves and two fish'],
  'summary' => 'A golden pavilion full of baskets of food. Jesus fed a crowd of five thousand men with one boy\'s five loaves and two fish.',
  'facts' => ['Read it' => 'John 6:1–14 and 6:35', 'Where' => 'A hillside by the Sea of Galilee', 'Key words' => '"I am the bread of life"', 'Real world' => 'Food banks'],
  'sections' => [
    ['Five loaves and two fish', HEAVEN_GOSPEL, [
      'A huge crowd followed Jesus to a hillside by the Sea of Galilee, and there was nowhere to buy food for so many people. Andrew said: "Here is a boy with five barley loaves and two small fish. But what difference will these make among so many?" (John 6:9).',
      'Jesus had the people sit down on the grass, about five thousand men. He took the loaves and the fish, gave thanks to God and shared them out. Everyone ate as much as they wanted, and the leftovers filled twelve baskets (John 6:10–13).',
      'Later Jesus said: "I am the bread of life. Whoever comes to Me will never hunger, and whoever believes in Me will never thirst" (John 6:35).',
    ]],
    ['The pavilion', HEAVEN_IMAGINE, [
      'There are no prices here. People bring what they have grown or made and take what they need, and there are always baskets left over.',
    ]],
    ['Sharing in our world', HEAVEN_REAL, [
      'Food banks collect food that would otherwise go to waste and give it to families who need it. In many neighborhoods, small "little free pantries" let anyone leave food or take some, no questions asked.',
    ]],
  ],
  'art' => 'The illustration shows a small open marble pavilion with a gold canopy roof and baskets of fruit and flowers.',
  'look' => ['Find the baskets of fruit.', 'What else is in the pavilion?'],
  'questions' => ['What did the boy share, and what did Jesus do with it?', 'What do you think Jesus meant by "I am the bread of life"?', 'What could you share with someone this week?'],
  'words' => ['Barley' => 'A grain used to make bread.', 'Leftovers' => 'Food that is left after a meal.', 'Food bank' => 'A place that gives free food to people who need it.'],
  'sources' => ['bible-john', 'feeding-america'],
  'related' => ['spring-pool', 'marble-cottage', 'banquet-hall'],
],

'marble-cottage' => [
  'name' => 'Marble cottage', 'latin' => 'Mark 10:13–16', 'cat' => 'helps', 'src' => 'art/family_1.png', 'part' => [20, 'Let the children come'],
  'summary' => 'A family cottage with a gold roof and a little garden. When his friends tried to send children away, Jesus said, "Let the little children come to Me."',
  'facts' => ['Read it' => 'Mark 10:13–16', 'Where' => 'Judea, beyond the Jordan River', 'Key words' => '"Let the little children come to Me"', 'Real world' => 'George Müller\'s orphan houses, Bristol'],
  'sections' => [
    ['Let the children come', HEAVEN_GOSPEL, [
      'People were bringing little children to Jesus so that he would bless them, but the disciples scolded them. Jesus was not pleased. "Let the little children come to Me, and do not hinder them!" he said. "For the kingdom of God belongs to such as these. Truly I tell you, anyone who does not receive the kingdom of God like a little child will never enter it" (Mark 10:14–15).',
      '"And He took the children in His arms, placed His hands on them, and blessed them" (Mark 10:16). Jesus showed that children matter to God.',
    ]],
    ['The cottage', HEAVEN_IMAGINE, [
      'A small, simple house with a garden, a vine over the door and neighbors who wave as they pass. Here, every child is welcome and safe.',
    ]],
    ['A home for thousands', HEAVEN_REAL, [
      'In 1836, George Müller, a Christian preacher in Bristol, England, opened a home for orphans. He never asked anyone for money, but prayed and trusted God to provide, and in his lifetime more than 10,000 orphans were cared for in his homes.',
    ]],
  ],
  'art' => 'The illustration shows a white marble family house with a gold roof, a garden and flowering vines.',
  'look' => ['Find the flowering vines.', 'Where is the garden?'],
  'questions' => ['Why do you think the disciples tried to send the children away?', 'What do you think it means to receive God\'s kingdom "like a little child"?', 'How can you make younger children feel welcome?'],
  'words' => ['Bless' => 'To ask for God\'s goodness on someone.', 'Hinder' => 'To get in the way or stop.', 'Orphan' => 'A child whose parents have died.'],
  'sources' => ['bible-mark', 'muller'],
  'related' => ['sharing-pavilion', 'golden-track', 'school-of-wisdom'],
],

'golden-track' => [
  'name' => 'Golden track', 'latin' => 'Luke 15:11–32', 'cat' => 'helps', 'src' => 'art/fitness_2.png', 'part' => [21, 'The father who ran'],
  'summary' => 'An oval running track with gold lanes. Jesus told a story about a father who ran to welcome home a son who had wandered away.',
  'facts' => ['Read it' => 'Luke 15', 'Where' => 'A story Jesus told', 'Key words' => '"He was lost and is found!"', 'Real world' => 'Derek Redmond and his father, 1992'],
  'sections' => [
    ['The father who ran', HEAVEN_GOSPEL, [
      'Some people grumbled that Jesus welcomed sinners and even ate with them. So Jesus told stories about things that were lost: a sheep, a coin and a son (Luke 15).',
      'A younger son took his share of his father\'s money, went far away and wasted it all. Hungry and alone, feeding pigs, he decided to go home and say: "Father, I have sinned against heaven and against you. I am no longer worthy to be called your son" (Luke 15:18–19). "But while he was still in the distance, his father saw him and was filled with compassion. He ran to his son, embraced him, and kissed him" (Luke 15:20).',
      'The father threw a feast: "For this son of mine was dead and is alive again! He was lost and is found!" (Luke 15:24). Jesus was showing how God welcomes everyone who comes back to him.',
    ]],
    ['The track', HEAVEN_IMAGINE, [
      'On this track everyone finishes, and the crowd cheers just as loudly for the last runner as for the first.',
    ]],
    ['Helped to the finish', HEAVEN_REAL, [
      'At the 1992 Olympic Games in Barcelona, the British runner Derek Redmond tore a muscle in his leg during a 400-meter race. He kept hobbling on, and his father came out of the crowd to help him reach the finish line, while the whole stadium stood and cheered.',
    ]],
  ],
  'art' => 'The illustration shows an oval running track with gold lanes around a green field, with a small marble finish arch.',
  'look' => ['Find the finish arch.', 'How many lanes can you count?'],
  'questions' => ['Why do you think the father ran?', 'What does this story show about how God feels when someone comes back to him?', 'How can you welcome someone who has said sorry?'],
  'words' => ['Compassion' => 'Deep care for someone who is hurting.', 'Parable' => 'A short story Jesus told to teach about God.', 'Sinner' => 'Someone who has done wrong against God.'],
  'sources' => ['bible-luke', 'ioc-redmond'],
  'related' => ['marble-cottage', 'hall-of-treasures', 'victors-arena'],
],

'hall-of-treasures' => [
  'name' => 'Hall of treasures', 'latin' => 'Luke 19:1–10', 'cat' => 'helps', 'src' => 'art/business_3.png', 'part' => [22, 'Zacchaeus'],
  'summary' => 'A marble hall overflowing with gold. A rich tax collector named Zacchaeus climbed a tree to see Jesus, and his life was changed.',
  'facts' => ['Read it' => 'Luke 19:1–10', 'Where' => 'Jericho', 'Key words' => '"To seek and to save the lost"', 'Real world' => 'Jericho, one of the oldest towns in the world'],
  'sections' => [
    ['Zacchaeus', HEAVEN_GOSPEL, [
      'In the city of Jericho lived Zacchaeus, a chief tax collector who was very rich. Tax collectors were disliked, because many took more money than they should. Zacchaeus wanted to see Jesus, but he was short and could not see over the crowd, so he ran ahead and climbed a sycamore tree.',
      'When Jesus reached the tree, he looked up and said: "Zacchaeus, hurry down, for I must stay at your house today" (Luke 19:5). People grumbled, but Zacchaeus welcomed him joyfully and said: "Look, Lord, half of my possessions I give to the poor, and if I have cheated anyone, I will repay it fourfold" (Luke 19:8).',
      'Jesus said: "Today salvation has come to this house… For the Son of Man came to seek and to save the lost" (Luke 19:9–10).',
    ]],
    ['The hall', HEAVEN_IMAGINE, [
      'Chests of glowing gold spill out onto the steps of this great hall, but no one guards them, because in this city no one needs to steal, and everyone is glad to give.',
    ]],
    ['Jericho', HEAVEN_REAL, [
      'Jericho, near the Jordan River, is one of the oldest towns in the world: people have lived beside its spring for more than 10,000 years. It lies about 250 meters below sea level, lower than almost any other town on Earth.',
    ]],
    ['Giving and happiness', HEAVEN_REAL, [
      'In a study published in 2008, psychologists gave people a small amount of money in the morning. Some were told to spend it on themselves and others to spend it on someone else. By the evening, the people who had spent the money on others felt happier.',
    ]],
  ],
  'art' => 'The illustration shows a grand marble hall with tall gold doors, gold columns and open chests of glowing gold on the steps.',
  'look' => ['Find the open chests of gold.', 'Look at the doors. What are they made of?'],
  'questions' => ['Why do you think Zacchaeus wanted to see Jesus so badly?', 'What changed in Zacchaeus after he met Jesus?', 'What kind of "treasure" could you give that doesn\'t cost money?'],
  'words' => ['Tax collector' => 'Someone who collects money that people must pay to the government.', 'Salvation' => 'Being saved and made right with God.', 'Fourfold' => 'Four times as much.'],
  'sources' => ['bible-luke', 'brit-jericho', 'dunn'],
  'related' => ['golden-track', 'fruit-donkey', 'lily-garden'],
],

// ---------------- 7. The last week ----------------
'banquet-hall' => [
  'name' => 'Banquet hall', 'latin' => 'Luke 22:14–20', 'cat' => 'week', 'src' => 'art/shared_3.png', 'part' => [24, 'The last supper'],
  'summary' => 'A long golden hall with a table set for a feast. On the night before he died, Jesus shared a last supper with his friends.',
  'facts' => ['Read it' => 'Luke 22:14–20 and John 13', 'Where' => 'An upstairs room in Jerusalem', 'Key words' => '"Do this in remembrance of Me"', 'Real world' => 'Passover, remembered every spring'],
  'sections' => [
    ['The last supper', HEAVEN_GOSPEL, [
      'At Passover, Jesus shared a meal with his twelve apostles. During supper he got up, wrapped a towel around his waist and washed their dusty feet, the work of a servant. "I have set you an example so that you should do as I have done for you," he said (John 13:15).',
      'Then "He took the bread, gave thanks and broke it, and gave it to them, saying, \'This is My body, given for you; do this in remembrance of Me.\' In the same way, after supper He took the cup, saying, \'This cup is the new covenant in My blood, which is poured out for you\'" (Luke 22:19–20).',
      'He gave them a new command: "Love one another. As I have loved you, so you also must love one another" (John 13:34). Jesus knew that one of the twelve, Judas, was about to betray him.',
    ]],
    ['The hall', HEAVEN_IMAGINE, [
      'The table is so long you cannot see the end of it, with a seat for everyone and plenty for all.',
    ]],
    ['Passover and the Lord\'s Supper', HEAVEN_REAL, [
      'Passover is a spring festival that remembers how God freed the Israelites from slavery in Egypt, more than a thousand years before Jesus. Christians remember the last supper by sharing bread and wine or grape juice, called Communion or the Lord\'s Supper. Around 1495 to 1498, Leonardo da Vinci painted a famous picture of the last supper on a wall in Milan, Italy.',
    ]],
  ],
  'art' => 'The illustration shows a long golden hall with open arches and a long table set for a feast inside.',
  'look' => ['Find the long table.', 'How many arches can you count?'],
  'questions' => ['Why do you think Jesus washed his friends\' feet?', 'What did Jesus ask his followers to remember?', 'What does it look like to love others the way Jesus loves?'],
  'words' => ['Apostle' => 'One of the twelve friends Jesus chose and sent out.', 'Communion' => 'Sharing bread and wine to remember Jesus\'s death.', 'Betray' => 'To turn against a friend.'],
  'sources' => ['bible-luke', 'bible-john', 'brit-passover', 'brit-lastsupper'],
  'related' => ['fruit-donkey', 'house-of-many-rooms', 'sharing-pavilion'],
],

'house-of-many-rooms' => [
  'name' => 'House of many rooms', 'latin' => 'John 14:1–6', 'cat' => 'week', 'src' => 'art/family_3.png', 'part' => [25, 'The way to the Father'],
  'summary' => 'A great white mansion with many wings. At the last supper, Jesus told his friends that his Father\'s house has many rooms.',
  'facts' => ['Read it' => 'John 14:1–6', 'Where' => 'At the last supper', 'Key words' => '"I am the way and the truth and the life"', 'Real world' => 'Habitat for Humanity, since 1976'],
  'sections' => [
    ['The way to the Father', HEAVEN_GOSPEL, [
      'Jesus\'s friends were troubled, because he had told them he would soon leave them. He comforted them: "Do not let your hearts be troubled. You believe in God; believe in Me as well. In My Father\'s house are many rooms… I am going there to prepare a place for you… I will come back and welcome you into My presence, so that you also may be where I am" (John 14:1–3).',
      '"Lord," said Thomas, "we do not know where You are going, so how can we know the way?" Jesus answered: "I am the way and the truth and the life. No one comes to the Father except through Me" (John 14:5–6).',
    ]],
    ['The house', HEAVEN_IMAGINE, [
      'However many people arrive, there is always another room ready, with a light in the window and a bed made up.',
    ]],
    ['Homes for everyone', HEAVEN_REAL, [
      'A safe home is one of the most basic human needs. Habitat for Humanity, a Christian charity founded in 1976, helps families build or repair homes, with volunteers working side by side with the families who will live there.',
    ]],
  ],
  'art' => 'The illustration shows a large white marble mansion with many wings, balconies, gold roofs and gardens.',
  'look' => ['Count the gold roofs.', 'Find the gardens between the wings.'],
  'questions' => ['How do you think Jesus\'s words comforted his friends?', 'What do you think Jesus meant when he said, "I am the way"?', 'What makes a house feel like home?'],
  'words' => ['Mansion' => 'A very large house.', 'Troubled' => 'Worried and upset.', 'Truth' => 'What is real and right.'],
  'sources' => ['bible-john', 'habitat'],
  'related' => ['banquet-hall', 'prayer-chapel', 'welcome-hall'],
],

'prayer-chapel' => [
  'name' => 'Prayer chapel', 'latin' => 'Mark 14:32–50', 'cat' => 'week', 'src' => 'art/growth_2.png', 'part' => [26, 'In the garden at night'],
  'summary' => 'A small round chapel, warm with light. In the garden of Gethsemane, Jesus prayed in the night before he was arrested.',
  'facts' => ['Read it' => 'Mark 14:32–50', 'Where' => 'Gethsemane, on the Mount of Olives', 'Key words' => '"Not what I will, but what You will"', 'Real world' => 'Olive trees in Gethsemane, about 900 years old'],
  'sections' => [
    ['In the garden at night', HEAVEN_GOSPEL, [
      'After supper, Jesus and his disciples went to a garden on the Mount of Olives called Gethsemane. "Sit here while I pray," he told them (Mark 14:32). He was deeply troubled, because he knew he was about to suffer and die. He fell to the ground and prayed: "Abba, Father, all things are possible for You. Take this cup from Me. Yet not what I will, but what You will" (Mark 14:36).',
      'Three times he came back and found his friends asleep. Then Judas arrived with a crowd armed with swords and clubs. He greeted Jesus with a kiss, the signal for the men to seize him. Jesus did not fight back, and all his disciples ran away (Mark 14:43–50).',
    ]],
    ['The chapel', HEAVEN_IMAGINE, [
      'A small round chapel with columns and a gold dome, where anyone can come in, sit quietly and pray.',
    ]],
    ['The olive trees of Gethsemane', HEAVEN_REAL, [
      'Gethsemane means "oil press". Eight very old olive trees still grow in the garden there, beside the Church of All Nations. In 2012, scientists in Italy tested three of them and found they were about 900 years old. Tests also showed that all eight grew from cuttings of the same parent tree.',
    ]],
  ],
  'art' => 'The illustration shows a small round chapel with columns, a gold dome and warm light shining from inside.',
  'look' => ['Find the light coming from inside.', 'Count the columns.'],
  'questions' => ['What did Jesus pray in the garden?', 'Why do you think Jesus did not fight back?', 'When is it hard to say "not what I want, but what you want"?'],
  'words' => ['Abba' => 'An Aramaic word for "father".', 'Arrest' => 'To take someone prisoner.', 'Olive press' => 'A machine that squeezes oil out of olives.'],
  'sources' => ['bible-mark', 'brit-gethsemane', 'cnr-olives'],
  'related' => ['house-of-many-rooms', 'victors-arena', 'school-of-wisdom'],
],

'victors-arena' => [
  'name' => 'Victors\' arena', 'latin' => 'John 18:28–19:16', 'cat' => 'week', 'src' => 'art/fitness_3.png', 'part' => [27, 'A crown of thorns'],
  'summary' => 'A white marble stadium crowned with golden wreaths. Jesus was put on trial before Pilate, and soldiers gave him a crown of thorns.',
  'facts' => ['Read it' => 'Luke 22:54–62, John 18:28–19:16 and Mark 15:1–20', 'Where' => 'Jerusalem', 'Key words' => '"My kingdom is not of this world"', 'Real world' => 'The Pilate Stone, found in 1961'],
  'sections' => [
    ['A crown of thorns', HEAVEN_GOSPEL, [
      'That night, Peter followed at a distance to the high priest\'s house. Sitting by a fire in the courtyard, he was asked three times if he knew Jesus, and three times he said no. Then the rooster crowed, and Peter remembered Jesus\'s words, "and he went outside and wept bitterly" (Luke 22:62).',
      'In the morning, Jesus was taken to Pontius Pilate, the Roman governor. "Are You the King of the Jews?" Pilate asked. Jesus answered: "My kingdom is not of this world" (John 18:33–36). Pilate found no crime in him, but the crowd shouted, "Crucify Him!" To please them, Pilate handed Jesus over to be crucified (Mark 15:13–15).',
      'The soldiers dressed him in a purple robe, "twisted together a crown of thorns, and set it on His head," and mocked him: "Hail, King of the Jews!" (Mark 15:17–18).',
    ]],
    ['A crown that lasts', HEAVEN_BIBLE, [
      'Winners at the ancient games received a crown of leaves. The apostle Paul wrote: "They do it for a crown that is perishable, but we do it for a crown that is imperishable" (1 Corinthians 9:25).',
    ]],
    ['The arena', HEAVEN_IMAGINE, [
      'In this arena the prizes never run out, and the cheers are for courage, kindness and fair play as much as for winning.',
    ]],
    ['The Pilate Stone', HEAVEN_REAL, [
      'In 1961, archaeologists working in the Roman theater at Caesarea, on the coast of Israel, found a stone carved with the name of Pontius Pilate, "Prefect of Judea". It is one of the very few objects from his own time to name him, and it is now in the Israel Museum in Jerusalem.',
    ]],
  ],
  'art' => 'The illustration shows a white marble stadium with tiers of arches, gold trim, a green field inside and golden laurel wreaths on top.',
  'look' => ['Find the golden wreaths.', 'How many rows of arches can you see?'],
  'questions' => ['How do you think Peter felt when the rooster crowed?', 'What do you think Jesus meant by "My kingdom is not of this world"?', 'Why do you think Jesus let himself be treated this way?'],
  'words' => ['Governor' => 'A ruler sent to govern a region.', 'Crucify' => 'To put to death on a wooden cross, a Roman punishment.', 'Mock' => 'To make fun of someone cruelly.'],
  'sources' => ['bible-luke', 'bible-john', 'bible-mark', 'bible-1cor', 'brit-pilate', 'imj-pilate'],
  'related' => ['prayer-chapel', 'sky-bridge', 'golden-track'],
],

// ---------------- 8. The cross and the empty tomb ----------------
'sky-bridge' => [
  'name' => 'Sky bridge', 'latin' => 'Luke 23:32–47', 'cat' => 'cross', 'src' => 'art/bridge.png', 'part' => [28, 'The cross'],
  'summary' => 'A golden bridge across the sky. Jesus died on a cross, and the Bible says his death opened the way between God and people.',
  'facts' => ['Read it' => 'Luke 23:32–49 and John 19:28–30', 'Where' => 'The Skull, also called Golgotha, near Jerusalem', 'Key words' => '"It is finished"', 'Real world' => 'The Church of the Holy Sepulchre, Jerusalem'],
  'sections' => [
    ['The cross', HEAVEN_GOSPEL, [
      'The soldiers led Jesus to a place called The Skull, and there they crucified him between two criminals. Jesus prayed: "Father, forgive them, for they do not know what they are doing" (Luke 23:34). One of the criminals said, "Jesus, remember me when You come into Your kingdom!" Jesus answered: "Truly I tell you, today you will be with Me in Paradise" (Luke 23:42–43).',
      'At noon, darkness came over the land for three hours. Then Jesus said, "It is finished" (John 19:30), and gave up his spirit. At that moment the curtain in the temple was torn in two from top to bottom. The Roman officer on guard said: "Truly this was the Son of God" (Matthew 27:51–54).',
      'The Bible explains why Jesus died: "For Christ also suffered for sins once for all, the righteous for the unrighteous, to bring you to God" (1 Peter 3:18). "God proves His love for us in this: While we were still sinners, Christ died for us" (Romans 5:8).',
    ]],
    ['The way is open', HEAVEN_BIBLE, [
      'Jesus had said: "I am the good shepherd. The good shepherd lays down His life for the sheep" (John 10:11). Long before, Jacob dreamed of a stairway between earth and heaven (Genesis 28:12), and Jesus told his first followers that they would "see heaven open and the angels of God ascending and descending on the Son of Man" (John 1:51). Like a bridge, Jesus joins people to God.',
    ]],
    ['The bridge', HEAVEN_IMAGINE, [
      'White marble arches carry a golden walkway between the floating islands, so no part of the city is ever cut off from another.',
    ]],
    ['The Church of the Holy Sepulchre', HEAVEN_REAL, [
      'In Jerusalem\'s Old City, the Church of the Holy Sepulchre was first built in the 300s over the places where many Christians believe Jesus was crucified and buried. In Jesus\'s time the spot was just outside the city wall, as the Bible describes. Pilgrims from all over the world visit it.',
    ]],
  ],
  'art' => 'The illustration shows one section of a sky bridge: two white marble arches with a walkway on top, gold railings, small gold spires and flowering vines.',
  'look' => ['Count the arches.', 'Find the flowering vines.'],
  'questions' => ['What did Jesus pray for the people who hurt him?', 'What did Jesus promise the criminal who asked to be remembered?', 'Why does the Bible say Jesus died?'],
  'words' => ['Cross' => 'Wooden beams on which the Romans put people to death.', 'Forgive' => 'To let go of a wrong someone has done.', 'Paradise' => 'A word for heaven, the garden of God.'],
  'sources' => ['bible-luke', 'bible-john', 'bible-matthew', 'bible-1peter', 'bible-romans', 'bible-genesis', 'brit-sepulchre'],
  'related' => ['victors-arena', 'building-materials', 'tree-of-life'],
],

'building-materials' => [
  'name' => 'Building materials', 'latin' => 'Matthew 27:57–28:8', 'cat' => 'cross', 'src' => 'build/materials.png', 'part' => [29, 'The stone rolled away'],
  'summary' => 'Marble blocks, gold bars and pearls. Jesus was buried in a tomb closed with a great stone, but on the third day the stone was rolled away.',
  'facts' => ['Read it' => 'Matthew 27:57–28:8 and John 20:1–8', 'Where' => 'A new tomb cut into the rock', 'Key words' => '"He is not here; He has risen"', 'Real world' => 'Rolling-stone tombs near Jerusalem'],
  'sections' => [
    ['The stone rolled away', HEAVEN_GOSPEL, [
      'That evening, a rich follower of Jesus named Joseph of Arimathea laid his body in his own new tomb, cut into the rock. "Then he rolled a great stone across the entrance" (Matthew 27:60). The leaders had the stone sealed and soldiers posted to guard it.',
      'At dawn on Sunday, the third day, Mary Magdalene and another Mary went to the tomb. Suddenly there was a great earthquake, and an angel of the Lord rolled away the stone and sat on it. The guards shook with fear. The angel said to the women: "Do not be afraid, for I know that you are looking for Jesus, who was crucified. He is not here; He has risen, just as He said! Come, see the place where He lay" (Matthew 28:5–6).',
      'The women ran to tell the disciples. Peter and another disciple ran to the tomb too, and found only the linen cloths lying there (John 20:3–8).',
    ]],
    ['The materials', HEAVEN_IMAGINE, [
      'White marble, shining gold and glowing pearls: everything in this city is made to last and made to be beautiful.',
    ]],
    ['Rolling-stone tombs', HEAVEN_REAL, [
      'Around Jerusalem, archaeologists have found many family tombs from Jesus\'s time cut into the rock. Most were closed with square stone blocks, but a few, belonging to rich families, had a large round stone that rolled along a groove in front of the doorway, like a giant wheel.',
    ]],
    ['Gold that never rusts', HEAVEN_REAL, [
      'Gold is one of the few metals that never rusts or tarnishes, which is why ancient gold jewelry still shines today. Marble forms deep underground when limestone is squeezed and heated over millions of years.',
    ]],
  ],
  'art' => 'The illustration shows a neat pile of white marble blocks, stacked gold bars, a basket of shining pearls and a few gold roof tiles.',
  'look' => ['Find the basket of pearls.', 'Which of these blocks would be hardest to move?'],
  'questions' => ['Why do you think the leaders wanted the tomb guarded?', 'How do you think the women felt when the angel spoke?', 'What does "He has risen" mean?'],
  'words' => ['Tomb' => 'A room or cave where a dead body is laid.', 'Seal' => 'A mark or fastening that shows something must not be opened.', 'Linen' => 'Cloth made from the flax plant.'],
  'sources' => ['bible-matthew', 'bible-john', 'gibson', 'brit-gold', 'brit-marble'],
  'related' => ['sky-bridge', 'garden-of-light', 'light-crane'],
],

'garden-of-light' => [
  'name' => 'Garden of light', 'latin' => 'John 20:11–18', 'cat' => 'cross', 'src' => 'art/growth_1.png', 'part' => [30, 'I have seen the Lord!'],
  'summary' => 'A walled garden of glowing lilies. In the garden by the empty tomb, Mary Magdalene met Jesus, alive again.',
  'facts' => ['Read it' => 'John 19:41–20:18 and 1 Corinthians 15:3–6', 'Where' => 'The garden of the tomb, Jerusalem', 'Key words' => '"I have seen the Lord!"', 'Real world' => 'Easter, a different date each year'],
  'sections' => [
    ['I have seen the Lord!', HEAVEN_GOSPEL, [
      'Jesus had been buried in a garden: "Now there was a garden in the place where Jesus was crucified, and in the garden a new tomb" (John 19:41). Mary Magdalene stood outside the empty tomb, crying. She turned and saw a man standing there and, thinking he was the gardener, asked him where the body had been taken.',
      'Then he said to her, "Mary." She knew his voice at once and cried out, "Rabboni!", which means "Teacher." It was Jesus, alive! She went to the disciples with the news: "I have seen the Lord!" (John 20:16–18).',
      'This is the heart of the good news. As the apostle Paul later wrote: "Christ died for our sins according to the Scriptures… He was buried… He was raised on the third day according to the Scriptures" (1 Corinthians 15:3–4). Death could not hold him.',
    ]],
    ['The garden', HEAVEN_IMAGINE, [
      'Glowing white lilies line a long pool, and tall cypress trees stand along the walls. The Bible begins in a garden and ends in a garden city, and the best news of all began in a garden too.',
    ]],
    ['Easter', HEAVEN_REAL, [
      'Christians celebrate the resurrection of Jesus at Easter. Its date changes every year: in most churches it is the first Sunday after the first full moon on or after March 21, so it always falls between March 22 and April 25.',
    ]],
    ['The Garden Tomb', HEAVEN_REAL, [
      'Outside the walls of Jerusalem\'s Old City lies the Garden Tomb, a tomb cut into the rock in a quiet garden, found in 1867. The people who look after it say they cannot be sure it is the tomb of Jesus, but it helps visitors picture the story.',
    ]],
  ],
  'art' => 'The illustration shows a walled garden with glowing white lilies, a long pool, cypress trees and a low marble wall.',
  'look' => ['Find the long pool.', 'Count the cypress trees.'],
  'questions' => ['How did Mary know it was Jesus?', 'Why is the resurrection such good news?', 'How do people you know celebrate Easter?'],
  'words' => ['Rabboni' => 'A Hebrew word meaning "my teacher".', 'Resurrection' => 'Rising from death to life again.', 'Easter' => 'The day Christians celebrate Jesus rising from the dead.'],
  'sources' => ['bible-john', 'bible-1cor', 'brit-easter', 'gardentomb'],
  'related' => ['building-materials', 'cloud-island', 'tree-of-life'],
],

// ---------------- 9. The good news spreads ----------------
'cloud-island' => [
  'name' => 'Cloud island', 'latin' => 'Acts 1:3–11', 'cat' => 'news', 'src' => 'art/island_1.png', 'part' => [31, 'Up into heaven'],
  'summary' => 'A little island of marble and cloud floating in the sky. Forty days after rising from the dead, Jesus went up into heaven, and a cloud hid him from sight.',
  'facts' => ['Read it' => 'John 20:24–29, Matthew 28:18–20 and Acts 1:3–11', 'Where' => 'The Mount of Olives', 'Key words' => '"I am with you always"', 'Real world' => 'A cloud can hold hundreds of tons of water'],
  'sections' => [
    ['Up into heaven', HEAVEN_GOSPEL, [
      'For forty days after he rose, Jesus appeared to his followers and talked with them about the kingdom of God (Acts 1:3). Once he appeared to more than five hundred people at the same time (1 Corinthians 15:6). Thomas, who had doubted, saw his hands and cried, "My Lord and my God!" Jesus told him: "Blessed are those who have not seen and yet have believed" (John 20:28–29).',
      'Jesus gave his followers a great task: "Go and make disciples of all nations… And surely I am with you always, even to the end of the age" (Matthew 28:19–20). He told them to wait in Jerusalem for the Holy Spirit. "After He had said this, they watched as He was taken up, and a cloud hid Him from their sight" (Acts 1:9).',
    ]],
    ['The island', HEAVEN_IMAGINE, [
      'Islands drift through the sky like boats, each with a little garden, a gazebo and a waterfall falling into the clouds below.',
    ]],
    ['Real clouds', HEAVEN_REAL, [
      'A cloud is made of billions of tiny water droplets or bits of ice. A puffy cumulus cloud can hold hundreds of tons of water, yet it floats, because the droplets are so small and so widely spread that rising warm air holds them up.',
    ]],
  ],
  'art' => 'The illustration shows a small floating island of white marble and cloud with a round gazebo, cypress trees, white flowers and a thin waterfall.',
  'look' => ['Follow the waterfall. Where does the water go?', 'Find the gazebo with the gold dome.'],
  'questions' => ['What task did Jesus give his followers?', 'What did Jesus promise when he said, "I am with you always"?', 'How can something as heavy as a cloud float?'],
  'words' => ['Disciple' => 'A follower and learner of Jesus.', 'Ascension' => 'Jesus going up into heaven.', 'Cumulus' => 'A puffy, white, heaped-up cloud.'],
  'sources' => ['bible-acts', 'bible-1cor', 'bible-john', 'bible-matthew', 'usgs-clouds'],
  'related' => ['garden-of-light', 'golden-chariot', 'cloud-carriage'],
],

'harp-workshop' => [
  'name' => 'Harp workshop', 'latin' => 'Acts 16:22–34', 'cat' => 'news', 'src' => 'art/nt_workshop.png', 'part' => [33, 'Songs at midnight'],
  'summary' => 'A marble workshop where golden harps and trumpets are made. In prison at midnight, Paul and Silas sang hymns to God, and a jailer\'s life was changed.',
  'facts' => ['Read it' => 'Acts 16:22–34', 'Where' => 'Philippi, a Roman city in Greece', 'Key words' => '"Believe in the Lord Jesus and you will be saved"', 'Real world' => 'The oldest Christian hymn with its music, about AD 300'],
  'sections' => [
    ['Songs at midnight', HEAVEN_GOSPEL, [
      'The good news kept spreading. The apostle Paul traveled from city to city, telling people about Jesus. In Philippi, he and his friend Silas were beaten and locked in prison, with their feet fastened in wooden stocks.',
      '"About midnight Paul and Silas were praying and singing hymns to God, and the other prisoners were listening to them" (Acts 16:25). Suddenly an earthquake shook the prison, the doors flew open and everyone\'s chains came loose. The jailer thought the prisoners had escaped, but Paul called out: "Do not harm yourself! We are all here!"',
      'Trembling, the jailer asked: "Sirs, what must I do to be saved?" They answered: "Believe in the Lord Jesus and you will be saved, you and your household" (Acts 16:30–31). That same night he and his whole family were baptized, full of joy.',
    ]],
    ['The workshop', HEAVEN_IMAGINE, [
      'Makers here build harps, trumpets and drums, and every instrument is finished by playing a song of praise.',
    ]],
    ['Philippi today', HEAVEN_REAL, [
      'The ruins of Philippi, in northern Greece, include its Roman forum, its theater and some of the earliest churches in Europe. In 2016 they became a UNESCO World Heritage Site.',
    ]],
    ['The oldest hymn with music', HEAVEN_REAL, [
      'The oldest known Christian hymn written down with its music was found on a scrap of papyrus at Oxyrhynchus in Egypt. It was copied around AD 300, and singers can still perform it today.',
    ]],
  ],
  'art' => 'The illustration shows a marble workshop with open arches where golden harps and trumpets are being made.',
  'look' => ['Find a golden harp.', 'Can you spot a trumpet?'],
  'questions' => ['Why do you think Paul and Silas sang in prison?', 'What did they tell the jailer he must do to be saved?', 'How does music change the way you feel?'],
  'words' => ['Hymn' => 'A song of praise to God.', 'Stocks' => 'A wooden frame that held a prisoner\'s feet.', 'Jailer' => 'The person in charge of a prison.'],
  'sources' => ['bible-acts', 'unesco-philippi', 'oxyrhynchus'],
  'related' => ['golden-chariot', 'bell-tower', 'cloud-carriage'],
],

// ---------------- 10. Everything new ----------------
'pearl-gate' => [
  'name' => 'Pearl gate', 'latin' => 'Revelation 21–22', 'cat' => 'new', 'src' => 'art/town_1.png', 'part' => [35, 'Everything new'],
  'summary' => 'A gate made of one giant pearl, open day and night. The Bible ends with God making all things new, and an invitation to everyone: "Come!"',
  'facts' => ['Read it' => 'Revelation 21:1–5, 21:21–27 and 22:17', 'Where' => 'The new Jerusalem, the city of God', 'Key words' => '"Behold, I make all things new"', 'Real world' => 'Pearls grow inside oysters and mussels'],
  'sections' => [
    ['Everything new', HEAVEN_GOSPEL, [
      'The last book of the Bible tells of a vision given to the apostle John: "Then I saw a new heaven and a new earth… I saw the holy city, the new Jerusalem, coming down out of heaven from God" (Revelation 21:1–2). God will live with his people, and "He will wipe away every tear from their eyes, and there will be no more death or mourning or crying or pain." The One on the throne said: "Behold, I make all things new" (Revelation 21:3–5).',
      'The city\'s twelve gates are twelve pearls, and "its gates will never be shut" (Revelation 21:21–25). It needs no sun, "because the glory of God illuminates the city, and the Lamb is its lamp" (Revelation 21:23). The Lamb is Jesus.',
      'The Bible ends with an invitation: "The Spirit and the bride say, \'Come!\'… And let the one who is thirsty come, and the one who desires the water of life drink freely" (Revelation 22:17). As Paul wrote: "If you confess with your mouth, \'Jesus is Lord,\' and believe in your heart that God raised Him from the dead, you will be saved" (Romans 10:9). That is the good news of Jesus.',
    ]],
    ['The pearl of great price', HEAVEN_BIBLE, [
      'Jesus once said: "The kingdom of heaven is like a merchant in search of fine pearls. When he found one very precious pearl, he went away and sold all he had and bought it" (Matthew 13:45–46).',
    ]],
    ['The gate', HEAVEN_IMAGINE, [
      'A giant shining pearl stands in a white marble wall between two golden towers. The gate is open all day and all night, and every visitor is greeted by name.',
    ]],
    ['How pearls grow', HEAVEN_REAL, [
      'A pearl forms inside an oyster or a mussel when something gets in that the animal cannot push out. The animal covers it, layer by layer, with nacre, the same shiny material that lines its shell. A pearl takes years to grow, which is one reason pearls have always been precious.',
    ]],
  ],
  'art' => 'The illustration shows a gate that is one giant shining pearl, set in a white marble wall with golden towers on both sides.',
  'look' => ['Find the pearl in the middle of the gate.', 'How many towers can you count?'],
  'questions' => ['What will be gone from the new city, according to Revelation?', 'Who does the Bible invite to "come"?', 'What would a city whose gates are never shut be like?'],
  'words' => ['Revelation' => 'Something made known; also the name of the Bible\'s last book.', 'Lamb' => 'A young sheep; in Revelation, a name for Jesus.', 'Nacre' => 'The shiny material that makes pearls and lines shells.'],
  'sources' => ['bible-rev', 'bible-romans', 'bible-matthew', 'brit-pearl'],
  'related' => ['cloud-carriage', 'tree-of-life', 'fountain-of-life'],
],
];

$WORLD_DATA['heaven'] = [
  'title'    => 'Heavenly City: the story of Jesus in 35 places',
  'desc'     => 'Explore an imagined heavenly city of gold and light and follow the story of Jesus, as the Bible tells it, in 35 parts, with photos of the real places.',
  'intro'    => 'An imagined city of gold and light, where the story of Jesus unfolds as you explore. Each of its 35 places tells one part of the Gospel, as the Bible tells it, from the first garden to the city of God.',
  'note'     => 'The city and its art are imagined, inspired by the Bible\'s picture of the heavenly city in the Book of Revelation. Its story is the Gospel, the good news of Jesus, told in the Bible\'s own words with chapter and verse, so you can read it for yourself.',
  'aka'      => 'Read it in the Bible',
  'akaLang'  => '',
  'pageTitle'=> '%s in the Heavenly City: the story of Jesus',
  'pageTitleShort' => '%s in the Heavenly City',
  'aside'    => ['How to read these pages', 'Start with part 1 at the Tree of life and follow the links to each next part. Gospel sections tell the story of Jesus as the Bible tells it. Bible sections share more words from Scripture. Imagined sections describe the artist\'s city. Real world sections describe places, history and science today, with sources.'],
  'pageDesc' => ' Read this part of the story of Jesus, as the Bible tells it, with questions to talk about.',
  'pageDescShort' => ' A part of the story of Jesus, as the Bible tells it.',
  'sourcesIntro' => 'Bible quotations are from the Berean Standard Bible, which is in the public domain. The other facts on this page come from these sources:',
  'about'    => 'The life, death and resurrection of Jesus, as told in the Bible',
  // The story told across the pages, part by part (see story_page() in build/worldpages.php).
  'story'    => [
    'title' => 'The story of Jesus',
    'pageTitle' => 'The story of Jesus in 35 places: the Heavenly City',
    'desc' => 'Follow the story of Jesus, as the Bible tells it, through 35 places in an imagined heavenly city: from the garden of Eden to the empty tomb and the city of God.',
    'lead' => 'Each place in this city tells one part of the story of Jesus, as the Bible tells it. Start with part 1 and follow the links from place to place.',
    'intro' => 'The Gospel is the good news of Jesus. In this imagined city, each of the 35 places tells one part of his story, in order, in the Bible\'s own words with chapter and verse. Read one part a day, or the whole story at once.',
    'note' => 'Bible quotations are from the Berean Standard Bible, which is in the public domain. The city and its art are imagined; the story is told as the Bible tells it.',
  ],
  // Positions on the 6 x 6 map, from the back corner (0) to the front corner (35). Tall pieces stand at the back;
  // 'tree' is a decorative golden tree.
  'map' => [
    'light-crane', 'lamp-tower', 'bell-tower', 'angel-statue', 'palace-of-light', 'pearl-gate',
    'cloud-island', 'hall-of-wisdom', 'house-of-many-rooms', 'tree-of-life', 'school-of-wisdom', 'hall-of-treasures',
    'sky-bridge', 'victors-arena', 'welcome-hall', 'prayer-chapel', 'scroll-library', 'tree',
    'rainbow-pavilion', 'harp-workshop', 'banquet-hall', 'marble-cottage', 'garden-villa', 'dove-statue',
    'golden-track', 'tree', 'lantern-circle', 'sharing-pavilion', 'spring-pool', 'tree',
    'garden-of-light', 'lily-garden', 'tree', 'fountain-of-life', 'building-materials', 'tree',
  ],
  'tree'     => 'golden-tree',
  'sources'  => $HEAVEN_SOURCES,
  'cats'     => $HEAVEN_CATEGORIES,
  'pages'    => $HEAVEN,
];
