<?php
// The Heavenly City: an imagined city of goodness and happiness, inspired by how many faiths picture heaven
// (mostly the Bible's Book of Revelation). One page per place, in the same format as the other worlds.
// Every page has three kinds of section: Imagined (the artist's city), Belief (what a faith teaches, quoted
// with chapter and verse, never stated as fact) and Real world (people, places and science today, with
// sources). Pages stay gentle: nothing about who goes to heaven, or about hell.
// The art is the Life RPG game's Heaven set (tools/assets.txt).

const HEAVEN_IMAGINE = ['tag' => 'imagined'];
const HEAVEN_BELIEF  = ['tag' => 'belief'];
const HEAVEN_REAL    = ['tag' => 'real'];

$HEAVEN_SOURCES = [
  'bible-genesis'   => 'The Bible, Book of Genesis (chapters 2, 8, 9, 18 and 28)',
  'bible-kings'     => 'The Bible, Second Book of Kings, chapter 2',
  'bible-nehemiah'  => 'The Bible, Book of Nehemiah, chapter 2',
  'bible-psalms'    => 'The Bible, Book of Psalms (Psalms 23, 104, 119 and 150)',
  'bible-proverbs'  => 'The Bible, Book of Proverbs, chapter 3',
  'bible-ecclesiastes' => 'The Bible, Book of Ecclesiastes, chapter 12',
  'bible-isaiah'    => 'The Bible, Book of Isaiah (chapters 11, 25, 56 and 65)',
  'bible-micah'     => 'The Bible, Book of Micah, chapter 4',
  'bible-zechariah' => 'The Bible, Book of Zechariah, chapter 9',
  'bible-samuel'    => 'The Bible, First Book of Samuel, chapter 16',
  'bible-matthew'   => 'The Bible, Gospel of Matthew (chapters 3, 5, 6 and 21)',
  'bible-luke'      => 'The Bible, Gospel of Luke (chapters 2 and 13)',
  'bible-john'      => 'The Bible, Gospel of John (chapters 4, 5, 8, 12 and 14)',
  'bible-acts'      => 'The Bible, Acts of the Apostles (chapters 1 and 4)',
  'bible-corinthians' => 'The Bible, First Letter to the Corinthians, chapter 9',
  'bible-timothy'   => 'The Bible, Second Letter to Timothy, chapter 4',
  'bible-hebrews'   => 'The Bible, Letter to the Hebrews (chapters 12 and 13)',
  'bible-james'     => 'The Bible, Letter of James, chapter 1',
  'bible-rev'       => 'The Bible, Book of Revelation (chapters 4, 7, 14, 21 and 22)',
  'quran-rivers'    => 'The Quran, Surah Muhammad (47), verse 15',
  'quran-light'     => 'The Quran, Surah An-Nur (24), verse 35, "the Verse of Light"',
  'quran-read'      => 'The Quran, Surah Al-Alaq (96), verse 1',
  'hadith-rayyan'   => 'Sahih al-Bukhari, the hadith of al-Rayyan, the gate of paradise for those who fast',
  'hadith-tuba'     => 'Sahih al-Bukhari and Sahih Muslim, hadiths on the great tree of paradise',
  'brit-heaven'     => 'Encyclopaedia Britannica, "Heaven"',
  'brit-paradise'   => 'Encyclopaedia Britannica, "Paradise"',
  'brit-pureland'   => 'Encyclopaedia Britannica, "Pure Land Buddhism"',
  'brit-bifrost'    => 'Encyclopaedia Britannica, "Bifrost"',
  'brit-chinvat'    => 'Encyclopaedia Britannica, "Chinvat Bridge"',
  'brit-angel'      => 'Encyclopaedia Britannica, "Angel"',
  'brit-gabriel'    => 'Encyclopaedia Britannica, "Gabriel"',
  'brit-bodhi'      => 'Encyclopaedia Britannica, "Bodhi tree"',
  'brit-yggdrasil'  => 'Encyclopaedia Britannica, "Yggdrasill"',
  'brit-diwali'     => 'Encyclopaedia Britannica, "Diwali" and "Hanukkah"',
  'brit-hagia'      => 'Encyclopaedia Britannica, "Hagia Sophia" and "Dome of the Rock"',
  'brit-lighthouse' => 'Encyclopaedia Britannica, "Lighthouse" and "Pharos of Alexandria"',
  'brit-prayer'     => 'Encyclopaedia Britannica, "Prayer"',
  'brit-bell'       => 'Encyclopaedia Britannica, "Bell"',
  'brit-carillon'   => 'Encyclopaedia Britannica, "Carillon"',
  'brit-picasso'    => 'Encyclopaedia Britannica, "Pablo Picasso"',
  'brit-pigeon'     => 'Encyclopaedia Britannica, "Homing pigeon"',
  'brit-langar'     => 'Encyclopaedia Britannica, "Langar" and "Golden Temple"',
  'brit-zakat'      => 'Encyclopaedia Britannica, "Zakat"',
  'brit-lantern'    => 'Encyclopaedia Britannica, "Lantern Festival"',
  'brit-deadsea'    => 'Encyclopaedia Britannica, "Dead Sea Scrolls"',
  'brit-olympics'   => 'Encyclopaedia Britannica, "Olympic Games"',
  'brit-crane'      => 'Encyclopaedia Britannica, "Crane (machine)"',
  'brit-gold'       => 'Encyclopaedia Britannica, "Gold"',
  'brit-marble'     => 'Encyclopaedia Britannica, "Marble"',
  'brit-pearl'      => 'Encyclopaedia Britannica, "Pearl"',
  'brit-aspirin'    => 'Encyclopaedia Britannica, "Aspirin"',
  'nci-taxol'       => 'National Cancer Institute, "Success Story: Taxol"',
  'usfs-bristlecone'=> 'U.S. Forest Service, Great Basin bristlecone pine',
  'usgs-clouds'     => 'U.S. Geological Survey, Water Science School, "How much does a cloud weigh?"',
  'usgs-springs'    => 'U.S. Geological Survey, Water Science School, "Springs and the water cycle"',
  'noaa-rainbow'    => 'NOAA SciJinks, "What causes a rainbow?"',
  'who-water'       => 'WHO and UNICEF Joint Monitoring Programme, "Progress on household drinking water, sanitation and hygiene 2000–2022" (2023)',
  'who-green'       => 'World Health Organization, Regional Office for Europe, "Urban green spaces and health" (2016)',
  'un-persian'      => 'UNESCO World Heritage Centre, "The Persian Garden"',
  'un-fez'          => 'UNESCO World Heritage Centre, "Medina of Fez"',
  'un-peace'        => 'United Nations, "International Day of Peace, 21 September"',
  'unhcr'           => 'UNHCR, the UN Refugee Agency, "Mid-Year Trends 2024"',
  'fao-pollinators' => 'Food and Agriculture Organization of the United Nations, "Why bees matter" (2018)',
  'sgpc'            => 'Shiromani Gurdwara Parbandhak Committee, the langar at the Golden Temple (Harmandir Sahib), Amritsar',
  'feeding-america' => 'Feeding America, "What is a food bank?"',
  'dunn'            => 'Dunn, Aknin and Norton, "Spending money on others promotes happiness", Science (2008)',
  'loc'             => 'Library of Congress, "About the Library"',
  'imj-scrolls'     => 'The Israel Museum, Jerusalem, the Shrine of the Book and the Dead Sea Scrolls Digital Project',
  'bm-ur'           => 'British Museum, the Queen\'s Lyre from the Royal Cemetery at Ur',
  'guinness-uni'    => 'Guinness World Records, "Oldest existing, and continually operating educational institution in the world"',
  'guinness-bridge' => 'Guinness World Records, "Longest bridge"',
  'ipc'             => 'International Paralympic Committee, "History of the Paralympic Movement"',
  'parkrun'         => 'parkrun, "About us"',
  'habitat'         => 'Habitat for Humanity, "History of Habitat"',
  'whr'             => 'World Happiness Report (Sustainable Development Solutions Network), chapters on social connection and trust',
  'angel-north'     => 'Gateshead Council, "The Angel of the North"',
  'rothko'          => 'Rothko Chapel, Houston, "About the Chapel"',
  'nps-liberty'     => 'National Park Service, Independence National Historical Park, "The Liberty Bell"',
  'unhcr'           => 'UNHCR, the UN Refugee Agency, "Global Trends" report',
  'un-swords'       => 'United Nations, "Let Us Beat Swords into Plowshares", sculpture by Evgeny Vuchetich (1959)',
  'un-persian'      => 'UNESCO World Heritage Centre, "The Persian Garden"',
  'brit-amish'      => 'Encyclopaedia Britannica, "Amish"',
  'epa-ewaste'      => 'US Environmental Protection Agency, "Electronics Donation and Recycling"',
  'usgs-cloud'      => 'US Geological Survey, Water Science School, on how much a cloud weighs',
  'brit-swan'       => 'Encyclopaedia Britannica, "Swan"',
  'iucn-ass'        => 'IUCN Red List of Threatened Species, "African Wild Ass" (Equus africanus)',
  'brit-earth'      => 'Encyclopaedia Britannica, "Earth" (rotation and the day)',
];

// category => [label, short description]
$HEAVEN_CATEGORIES = [
  'welcome' => ['Gates and welcome', 'How the city greets everyone who arrives.'],
  'light'   => ['Light and peace', 'Places of light, prayer and peace.'],
  'life'    => ['Water, trees and gardens', 'The river, the trees and the gardens that so many pictures of paradise share.'],
  'share'   => ['Sharing and feasts', 'Where everything is shared and everyone has enough.'],
  'learn'   => ['Wisdom and music', 'Where people keep learning, and the city fills with music.'],
  'joy'     => ['Play and celebration', 'Running, games and joy.'],
  'homes'   => ['Homes', 'A home for everyone.'],
  'build'   => ['Building the city', 'The tools and treasures that build it.'],
];

$HEAVEN = [

// ---------------- Gates and welcome ----------------
'pearl-gate' => [
  'name' => 'Pearl gate', 'latin' => 'Revelation 21:21', 'cat' => 'welcome', 'src' => 'art/town_1.png',
  'summary' => 'A gate made of one giant pearl. In the Bible\'s Book of Revelation, the heavenly city has twelve gates, each made of a single pearl.',
  'facts' => ['Inspired by' => 'Revelation 21:21 and 21:25', 'In the vision' => 'Twelve gates, each one pearl, never shut', 'The saying' => '"The pearly gates"', 'Real pearls grow in' => 'Oysters and mussels'],
  'sections' => [
    ['The gate', HEAVEN_IMAGINE, [
      'A giant shining pearl stands in a white marble wall between two golden towers. The gate is open all day and all night, and every visitor is greeted by name.',
    ]],
    ['Gates of pearl', HEAVEN_BELIEF, [
      'The Book of Revelation, the last book of the Christian Bible, describes a vision of a new, heavenly Jerusalem: "The twelve gates were twelve pearls, each gate made of a single pearl" (Revelation 21:21), and "on no day will its gates ever be shut" (Revelation 21:25). From this picture comes the saying "the pearly gates".',
      'Islamic tradition also speaks of the gates of paradise. A well-known saying of the Prophet Muhammad names one of them al-Rayyan, the gate for those who fast.',
    ]],
    ['How pearls grow', HEAVEN_REAL, [
      'A pearl forms inside an oyster or a mussel when something gets in that the animal cannot push out. The animal covers it, layer by layer, with nacre, the same shiny material that lines its shell. A pearl takes years to grow, which is one reason pearls have always been precious.',
    ]],
  ],
  'art' => 'The artist imagined a gate that is one giant shining pearl, set in a white marble wall with golden towers on both sides.',
  'look' => ['Find the pearl in the middle of the gate.', 'How many towers can you count?'],
  'questions' => ['What would a city whose gates never close be like?', 'How does it feel to be welcomed somewhere new?', 'How could your school or town welcome newcomers?'],
  'words' => ['Pearl' => 'A shiny gem that grows inside an oyster or mussel.', 'Nacre' => 'The shiny material that makes pearls and lines shells.', 'Vision' => 'Something seen in a dream or in the mind, often with a special meaning.'],
  'sources' => ['bible-rev', 'hadith-rayyan', 'brit-pearl'],
  'related' => ['welcome-hall', 'sky-bridge', 'building-materials'],
],

'welcome-hall' => [
  'name' => 'Welcome hall', 'latin' => 'Hebrews 13:2', 'cat' => 'welcome', 'src' => 'art/business_2.png',
  'summary' => 'A hall where every newcomer is welcomed. Many faiths teach that welcoming strangers is one of the best things a person can do.',
  'facts' => ['Inspired by' => 'Hebrews 13:2', 'The idea' => 'Hospitality: welcoming guests and strangers', 'Bible story' => 'Abraham welcomes three strangers', 'Real world' => 'Volunteers who welcome refugees'],
  'sections' => [
    ['The hall', HEAVEN_IMAGINE, [
      'In this hall, a meal, a bed and a friend are waiting for every person who arrives, whoever they are and wherever they come from.',
    ]],
    ['Welcoming strangers', HEAVEN_BELIEF, [
      'In the Bible, Abraham runs to welcome three strangers, brings water to wash their feet and cooks them a meal, and they turn out to be messengers from God (Genesis 18). The Letter to the Hebrews says: "Do not forget to show hospitality to strangers, for by so doing some people have shown hospitality to angels without knowing it" (Hebrews 13:2). Welcoming guests is also an important duty in Islam, Judaism, Sikhism and many other traditions.',
    ]],
    ['Welcome in our world', HEAVEN_REAL, [
      'Around the world, volunteers meet newcomers at airports and stations, help them find homes and schools, and teach them the local language. In 2024 the United Nations counted more than 120 million people who had been forced from their homes by war, danger or disaster.',
    ]],
  ],
  'art' => 'The illustration shows a two-story white marble hall with gold doors and gold-trimmed windows.',
  'look' => ['Find the gold doors.', 'How many windows can you count?'],
  'questions' => ['What makes someone feel welcome?', 'Why might so many faiths teach kindness to strangers?', 'How could you welcome a new student at your school?'],
  'words' => ['Hospitality' => 'Welcoming and caring for guests.', 'Refugee' => 'A person who has had to leave their country to escape danger.', 'Volunteer' => 'A person who helps without being paid.'],
  'sources' => ['bible-genesis', 'bible-hebrews', 'unhcr'],
  'related' => ['pearl-gate', 'banquet-hall', 'house-of-many-rooms'],
],

'sky-bridge' => [
  'name' => 'Sky bridge', 'latin' => 'Genesis 28:12', 'cat' => 'welcome', 'src' => 'art/bridge.png',
  'summary' => 'A golden bridge across the sky. Many traditions picture a bridge or a stairway between the earth and heaven.',
  'facts' => ['Inspired by' => 'Genesis 28:12, Jacob\'s ladder', 'Norse myth' => 'Bifrost, a rainbow bridge', 'Zoroastrian belief' => 'The Chinvat Bridge', 'Longest real bridge' => 'About 165 kilometers, in China'],
  'sections' => [
    ['The bridge', HEAVEN_IMAGINE, [
      'White marble arches carry a golden walkway between the floating islands, so no part of the city is ever cut off from another.',
    ]],
    ['Bridges to heaven', HEAVEN_BELIEF, [
      'In the Bible, Jacob dreams of a stairway reaching from the earth to heaven, with angels going up and down it (Genesis 28:12). In Norse myths, the gods\' home is reached by Bifrost, a rainbow bridge. Zoroastrianism, an ancient faith from Iran, teaches that after death each soul crosses the Chinvat Bridge. A bridge is a natural picture for a journey between two worlds.',
    ]],
    ['Bridges in our world', HEAVEN_REAL, [
      'The longest bridge in the world, the Danyang–Kunshan Grand Bridge in China, carries high-speed trains for about 165 kilometers, over rice fields, rivers and lakes. Arches like the ones in this picture push a bridge\'s weight sideways and down into the ground, which is why stone arch bridges built by the Romans are still standing.',
    ]],
  ],
  'art' => 'The illustration shows one section of a sky bridge: two white marble arches with a walkway on top, gold railings, small gold spires and flowering vines.',
  'look' => ['Count the arches.', 'Find the flowering vines.'],
  'questions' => ['Why might a bridge be a good picture for going from one world to another?', 'Which bridges are important where you live?', 'What makes an arch so strong?'],
  'words' => ['Arch' => 'A curved structure that spans an opening.', 'Myth' => 'A traditional story, often about gods or heroes.', 'Span' => 'The distance a bridge crosses.'],
  'sources' => ['bible-genesis', 'brit-bifrost', 'brit-chinvat', 'guinness-bridge'],
  'related' => ['cloud-island', 'pearl-gate', 'rainbow-pavilion'],
],

'cloud-island' => [
  'name' => 'Cloud island', 'latin' => 'Psalm 104:3', 'cat' => 'welcome', 'src' => 'art/island_1.png',
  'summary' => 'A little island of marble and cloud floating in the sky, with a waterfall pouring from its edge.',
  'facts' => ['Inspired by' => 'Pictures of heaven above the clouds', 'In many languages' => 'The same word means "sky" and "heaven"', 'A real cloud' => 'Can hold hundreds of tons of water', 'Why it floats' => 'Its droplets are tiny and spread out'],
  'sections' => [
    ['The island', HEAVEN_IMAGINE, [
      'Islands drift through the sky like boats, each with a little garden, a gazebo and a waterfall falling into the clouds below.',
    ]],
    ['Heaven and the sky', HEAVEN_BELIEF, [
      'In many languages the word for heaven is also the word for sky: shamayim in Hebrew, ouranos in Greek and sama in Arabic. Because the sky is high, bright and out of reach, people of many faiths have pictured God\'s home above it; a psalm in the Bible says God "makes the clouds his chariot" (Psalm 104:3). Many people today think of heaven as a different kind of place altogether, not somewhere you could fly to.',
    ]],
    ['Real clouds', HEAVEN_REAL, [
      'A cloud is made of billions of tiny water droplets or ice crystals. A puffy cumulus cloud can hold hundreds of tons of water, yet it floats, because the droplets are so small and so widely spread that rising warm air holds them up.',
    ]],
  ],
  'art' => 'The illustration shows a small floating island of white marble and cloud with a round gazebo, cypress trees, white flowers and a thin waterfall.',
  'look' => ['Follow the waterfall. Where does the water go?', 'Find the gazebo with the gold dome.'],
  'questions' => ['Why do you think so many people picture heaven in the sky?', 'How can something as heavy as a cloud float?', 'If you could build an island anywhere, what would you put on it?'],
  'words' => ['Cumulus' => 'A puffy, white, heaped-up cloud.', 'Droplet' => 'A very small drop of liquid.', 'Gazebo' => 'A small open garden building with a roof.'],
  'sources' => ['bible-psalms', 'brit-heaven', 'usgs-clouds'],
  'related' => ['sky-bridge', 'spring-pool', 'garden-of-light'],
],

// ---------------- Light and peace ----------------
'palace-of-light' => [
  'name' => 'Palace of light', 'latin' => 'Revelation 21:23', 'cat' => 'light', 'src' => 'art/town_3.png',
  'summary' => 'A great golden palace full of light. The Book of Revelation describes a city that needs no sun, because God\'s glory gives it light.',
  'facts' => ['Inspired by' => 'Revelation 21:23', 'The idea' => 'A city lit by God\'s glory', 'Festivals of light' => 'Diwali, Hanukkah and Christmas', 'Real domes of light' => 'Hagia Sophia, Istanbul'],
  'sections' => [
    ['The palace', HEAVEN_IMAGINE, [
      'At the heart of the city stands a palace with a huge gold dome and a star on top. Its doors glow, and light spills out from inside, so the whole city is bright even at night.',
    ]],
    ['A city with no need of the sun', HEAVEN_BELIEF, [
      'Revelation describes the heavenly city this way: "The city does not need the sun or the moon to shine on it, for the glory of God gives it light" (Revelation 21:23). In many faiths, light is a picture of goodness and of God. Hindus, Sikhs and Jains celebrate Diwali, the festival of lights; Jews light candles for eight nights at Hanukkah; and Christians call Jesus "the light of the world" (John 8:12).',
    ]],
    ['Domes of light', HEAVEN_REAL, [
      'Builders have long used domes with windows to fill holy places with light. The dome of Hagia Sophia in Istanbul, finished in AD 537, rests on a ring of 40 windows, so it seems to float on light. The golden Dome of the Rock in Jerusalem, a holy place for Muslims, shines above the city.',
    ]],
  ],
  'art' => 'The illustration shows a palace of white marble with a huge gold dome topped by a star, wide steps, glowing golden doors and small towers at the corners.',
  'look' => ['Find the star on top of the dome.', 'Where does the light come from?'],
  'questions' => ['Why do you think so many faiths use light as a picture of goodness?', 'How does light change the way a place feels?', 'Which festivals of light do people celebrate near you?'],
  'words' => ['Glory' => 'Great beauty, honor and light.', 'Dome' => 'A rounded roof shaped like half a ball.', 'Festival' => 'A day or time of celebration.'],
  'sources' => ['bible-rev', 'bible-john', 'brit-diwali', 'brit-hagia'],
  'related' => ['lamp-tower', 'prayer-chapel', 'bell-tower'],
],

'lamp-tower' => [
  'name' => 'Lamp tower', 'latin' => 'Psalm 119:105', 'cat' => 'light', 'src' => 'art/nt_tower.png',
  'summary' => 'A slim tower with a golden lamp on top, shining over the city all night long.',
  'facts' => ['Inspired by' => 'Psalm 119:105', 'The words' => '"Your word is a lamp for my feet"', 'Real towers of light' => 'Lighthouses', 'First famous lighthouse' => 'The Pharos of Alexandria, about 280 BC'],
  'sections' => [
    ['The tower', HEAVEN_IMAGINE, [
      'Lamp towers stand all over the city, so that no one ever has to walk in the dark or feel lost.',
    ]],
    ['A lamp for the path', HEAVEN_BELIEF, [
      'The Psalms, songs in the Bible, say: "Your word is a lamp for my feet, a light on my path" (Psalm 119:105), meaning that God\'s teaching shows people the way to live. In the Quran, a famous passage called the Verse of Light compares God\'s light to a lamp shining in a niche, inside a glass that shines like a brilliant star (Quran 24:35).',
    ]],
    ['Lights that keep people safe', HEAVEN_REAL, [
      'Lighthouses have guided ships for more than 2,000 years. The Pharos of Alexandria in Egypt, built around 280 BC, was one of the Seven Wonders of the Ancient World. Today street lights make towns safer at night, but too much light hides the stars, so some towns now use softer lights that point downward.',
    ]],
  ],
  'art' => 'The illustration shows a slim white marble tower with a glowing golden lamp at the top.',
  'look' => ['Find the lamp at the top.', 'How tall is the tower compared with the trees?'],
  'questions' => ['What could it mean to say that words are a lamp?', 'How do lights help people in your town?', 'Why might some people want fewer lights at night?'],
  'words' => ['Psalm' => 'A song or poem in the Bible\'s Book of Psalms.', 'Lighthouse' => 'A tower with a bright light that guides ships.', 'Light pollution' => 'Too much artificial light at night.'],
  'sources' => ['bible-psalms', 'quran-light', 'brit-lighthouse'],
  'related' => ['palace-of-light', 'lantern-circle', 'bell-tower'],
],

'prayer-chapel' => [
  'name' => 'Prayer chapel', 'latin' => 'Isaiah 56:7', 'cat' => 'light', 'src' => 'art/growth_2.png',
  'summary' => 'A small round chapel, warm with light: a quiet place to pray, think or simply be still.',
  'facts' => ['Inspired by' => 'Isaiah 56:7', 'The words' => '"A house of prayer for all nations"', 'Prayer' => 'Part of almost every faith', 'Real world' => 'Quiet rooms in hospitals and airports'],
  'sections' => [
    ['The chapel', HEAVEN_IMAGINE, [
      'A small round chapel with columns and a gold dome, where anyone can come in, sit quietly and rest.',
    ]],
    ['A house of prayer', HEAVEN_BELIEF, [
      'The prophet Isaiah, in the Hebrew Bible, describes God\'s house as "a house of prayer for all nations" (Isaiah 56:7). People pray in many ways: Muslims pray five times a day facing Mecca; Jews say set prayers three times a day; Christians pray the Lord\'s Prayer; Hindus offer puja at home and in temples; and Buddhists meditate.',
    ]],
    ['Quiet places today', HEAVEN_REAL, [
      'Many hospitals, airports and universities have quiet rooms that are open to people of every faith, or of none, where they can pray, meditate or simply sit in silence.',
    ]],
    ['A chapel for everyone', HEAVEN_REAL, [
      'The Rothko Chapel in Houston, Texas, opened in 1971, is a quiet, eight-sided room open to people of every faith or none. Its walls hold 14 large, dark paintings by the artist Mark Rothko, and visitors come to sit, think or pray in silence.',
    ]],
  ],
  'art' => 'The illustration shows a small round chapel with columns, a gold dome and warm light shining from inside.',
  'look' => ['Find the light coming from inside.', 'Count the columns.'],
  'questions' => ['Why might people want a quiet place?', 'How do people you know pray, think or reflect?', 'Where could you find a quiet moment in a busy day?'],
  'words' => ['Chapel' => 'A small place of worship.', 'Prophet' => 'A person believed to speak for God.', 'Meditate' => 'To quiet and focus the mind.'],
  'sources' => ['bible-isaiah', 'brit-prayer', 'rothko'],
  'related' => ['palace-of-light', 'bell-tower', 'garden-of-light'],
],

'bell-tower' => [
  'name' => 'Bell tower', 'latin' => 'Psalm 150', 'cat' => 'light', 'src' => 'art/town_2.png',
  'summary' => 'A tall white tower of golden bells that ring out across the city in celebration.',
  'facts' => ['Inspired by' => 'Psalm 150', 'The words' => '"Praise him with the clash of cymbals"', 'Bells call people to' => 'Worship, celebration and remembrance', 'Biggest bell' => 'The Tsar Bell in Moscow, about 200 tons, never rung'],
  'sections' => [
    ['The tower', HEAVEN_IMAGINE, [
      'When something good happens in this city, the bells ring, and everyone stops to listen and celebrate.',
    ]],
    ['Music of praise', HEAVEN_BELIEF, [
      'The last psalm in the Bible calls on "everything that has breath" to praise God with trumpets, harps, drums, dancing and cymbals (Psalm 150). Bells call people to worship in Christian churches, and in Buddhist temples in Japan a great bell is rung 108 times on New Year\'s Eve, to let go of the troubles of the old year.',
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
  'questions' => ['Why might bells be used for celebrations and remembrance?', 'What sounds mean celebration where you live?', 'How does sound travel from a bell to your ears?'],
  'words' => ['Carillon' => 'A set of at least 23 bells played from a keyboard.', 'Vibrate' => 'To shake quickly back and forth.', 'Praise' => 'To speak or sing about how good someone is.'],
  'sources' => ['bible-psalms', 'brit-bell', 'brit-carillon', 'nps-liberty'],
  'related' => ['prayer-chapel', 'harp-workshop', 'angel-statue'],
],

'angel-statue' => [
  'name' => 'Angel statue', 'latin' => 'Luke 2:13–14', 'cat' => 'light', 'src' => 'art/monument.png',
  'summary' => 'A golden angel with open wings on top of a tall column. In Judaism, Christianity and Islam, angels are God\'s messengers.',
  'facts' => ['Inspired by' => 'Luke 2:13–14', 'The word angel' => 'From the Greek for "messenger"', 'Best-known angels' => 'Gabriel and Michael', 'Real statue' => 'The Angel of the North, England, 20 meters tall'],
  'sections' => [
    ['The statue', HEAVEN_IMAGINE, [
      'A shining angel stands high above the city with open wings, as if about to bring good news.',
    ]],
    ['Messengers of God', HEAVEN_BELIEF, [
      'The word "angel" comes from the Greek angelos, meaning "messenger". In the Bible, the angel Gabriel tells Mary that she will have a son, Jesus, and on the night he is born, angels sing "peace on earth" to shepherds (Luke 2:13–14). In Islam, the angel Jibril, or Gabriel, brought the words of the Quran to the Prophet Muhammad. Artists usually give angels wings, but holy books describe them in many different ways.',
    ]],
    ['Angels in our world', HEAVEN_REAL, [
      'Angel statues stand in many cities. The Angel of the North, a steel sculpture by Antony Gormley put up near Gateshead in England in 1998, is 20 meters tall, with wings 54 meters wide, almost as wide as a jumbo jet\'s.',
    ]],
  ],
  'art' => 'The illustration shows a tall marble column with a golden angel with open wings on top.',
  'look' => ['Find the angel\'s wings.', 'What is the angel standing on?'],
  'questions' => ['Why do you think artists give angels wings?', 'What good news would you like to bring someone?', 'What statues stand in your town, and what do they mean?'],
  'words' => ['Angel' => 'A messenger of God in many faiths.', 'Scripture' => 'The holy writings of a religion.', 'Sculpture' => 'A work of art carved, cast or built in three dimensions.'],
  'sources' => ['bible-luke', 'brit-angel', 'brit-gabriel', 'angel-north'],
  'related' => ['dove-statue', 'bell-tower', 'pearl-gate'],
],

'dove-statue' => [
  'name' => 'Dove statue', 'latin' => 'Genesis 8:11', 'cat' => 'light', 'src' => 'art/nt_statue.png',
  'summary' => 'A golden dove with open wings: a picture of peace and new beginnings.',
  'facts' => ['Inspired by' => 'Genesis 8:11', 'The story' => 'A dove brings Noah an olive leaf', 'Stands for' => 'Peace, hope and gentleness', 'Famous picture' => 'Picasso\'s Dove, 1949'],
  'sections' => [
    ['The statue', HEAVEN_IMAGINE, [
      'A golden dove rises from a marble pedestal, wings open, as if setting off to carry peace across the city.',
    ]],
    ['The dove of peace', HEAVEN_BELIEF, [
      'In the Bible\'s story of the great flood, Noah sends out a dove, and it comes back with a fresh olive leaf in its beak, a sign that the waters have gone down and life can begin again (Genesis 8:11). In the Gospels, the Spirit of God comes down on Jesus "like a dove" when he is baptized (Matthew 3:16).',
    ]],
    ['Doves in our world', HEAVEN_REAL, [
      'In 1949 the artist Pablo Picasso drew a dove for a peace conference in Paris, and his dove became a famous symbol of peace. Real doves and pigeons are expert navigators: homing pigeons can find their way home from hundreds of kilometers away, and they carried messages in both World Wars.',
    ]],
  ],
  'art' => 'The illustration shows a golden dove with open wings on a white marble pedestal with gold trim.',
  'look' => ['Find the dove\'s outstretched wings.', 'Look at the pedestal. What is it made of?'],
  'questions' => ['Why might a dove be a good symbol of peace?', 'What does peace look like in a classroom or a family?', 'What other symbols of peace do you know?'],
  'words' => ['Symbol' => 'A picture or object that stands for an idea.', 'Pedestal' => 'A base that a statue stands on.', 'Homing pigeon' => 'A pigeon that can fly home from far away.'],
  'sources' => ['bible-genesis', 'bible-matthew', 'brit-picasso', 'brit-pigeon'],
  'related' => ['angel-statue', 'rainbow-pavilion', 'lily-garden'],
],

// ---------------- Water, trees and gardens ----------------
'tree-of-life' => [
  'name' => 'Tree of life', 'latin' => 'Revelation 22:2', 'cat' => 'life', 'src' => 'art/growth_3.png',
  'summary' => 'A huge tree with golden leaves and glowing fruit, its roots in a pool of clear water.',
  'facts' => ['Inspired by' => 'Genesis 2:9 and Revelation 22:2', 'In the vision' => 'Twelve kinds of fruit, and leaves that heal', 'In other traditions' => 'The Bodhi tree, the tree Tuba, Yggdrasil', 'Oldest real trees' => 'Bristlecone pines, nearly 5,000 years old'],
  'sections' => [
    ['The tree', HEAVEN_IMAGINE, [
      'At the center of the garden grows a tree that never stops giving: shade for everyone, fruit in every season and leaves that make sick people well.',
    ]],
    ['Trees of life', HEAVEN_BELIEF, [
      'In the Bible, the tree of life grows in the Garden of Eden (Genesis 2:9), and it appears again at the very end, in the heavenly city: "On each side of the river stood the tree of life, bearing twelve crops of fruit… And the leaves of the tree are for the healing of the nations" (Revelation 22:2).',
      'Islamic tradition describes a vast tree in paradise called Tuba. Buddhists honor the Bodhi tree, under which the Buddha is said to have found enlightenment, and Norse myths tell of Yggdrasil, a giant tree that holds the worlds together.',
    ]],
    ['Trees that heal', HEAVEN_REAL, [
      'Many medicines come from trees and plants. Aspirin was developed from a substance found in willow bark, and a cancer medicine called Taxol was first found in the bark of the Pacific yew tree. The oldest living trees, bristlecone pines in the mountains of California, are nearly 5,000 years old.',
    ]],
  ],
  'art' => 'The illustration shows an enormous tree with golden leaves and glowing fruit, its roots in a round marble pool of clear water.',
  'look' => ['Find the glowing fruit.', 'Follow the roots into the pool.'],
  'questions' => ['Why do you think trees appear in so many stories about paradise?', 'What do trees give to people and animals?', 'Is there a special tree in your neighborhood?'],
  'words' => ['Enlightenment' => 'In Buddhism, waking up to the truth and being freed from suffering.', 'Bark' => 'The tough outer skin of a tree.', 'Medicine' => 'Something used to treat illness.'],
  'sources' => ['bible-genesis', 'bible-rev', 'hadith-tuba', 'brit-bodhi', 'brit-yggdrasil', 'brit-aspirin', 'nci-taxol', 'usfs-bristlecone'],
  'related' => ['fountain-of-life', 'garden-of-light', 'lily-garden'],
],

'fountain-of-life' => [
  'name' => 'Fountain of life', 'latin' => 'Revelation 22:1', 'cat' => 'life', 'src' => 'art/fountain.png',
  'summary' => 'A marble fountain of sparkling water. Many pictures of paradise have a river or spring of pure, living water at their heart.',
  'facts' => ['Inspired by' => 'Revelation 22:1', 'In the Quran' => 'Rivers of water that never goes stale (47:15)', 'In Genesis' => 'A river flows out of Eden', 'Real world' => 'About 2 billion people lack safe water at home'],
  'sections' => [
    ['The fountain', HEAVEN_IMAGINE, [
      'Clear water flows from a golden top into a wide marble basin, and anyone may drink. The water never runs out and never makes anyone sick.',
    ]],
    ['Living water', HEAVEN_BELIEF, [
      'The Book of Revelation describes "the river of the water of life, as clear as crystal" flowing through the heavenly city (Revelation 22:1), and in the Gospel of John, Jesus speaks of "living water" (John 4:10). The Quran describes the gardens of paradise with rivers of water that never goes stale, and rivers of milk and honey (Quran 47:15). In Genesis, a river flows out of Eden to water the garden.',
    ]],
    ['Clean water for all', HEAVEN_REAL, [
      'Clean water is one of the most important things for good health. The World Health Organization and UNICEF reported that in 2022 about 2.2 billion people still did not have safe drinking water at home. Wells, pipes, filters and water treatment save millions of lives.',
    ]],
  ],
  'art' => 'The illustration shows a round marble fountain with clear, sparkling water flowing from a gold top.',
  'look' => ['Find where the water comes out.', 'How many levels does the fountain have?'],
  'questions' => ['Why do you think water appears in so many pictures of paradise?', 'Where does the water in your home come from?', 'What could people do so that everyone has clean water?'],
  'words' => ['Fountain' => 'A structure that sends out a stream of water.', 'Basin' => 'A wide bowl that holds water.', 'Water treatment' => 'Cleaning water so that it is safe to drink.'],
  'sources' => ['bible-rev', 'bible-john', 'quran-rivers', 'who-water'],
  'related' => ['spring-pool', 'tree-of-life', 'garden-of-light'],
],

'spring-pool' => [
  'name' => 'Spring pool', 'latin' => 'Psalm 23:2', 'cat' => 'life', 'src' => 'art/fitness_1.png',
  'summary' => 'A marble pool fed by a waterfall and shaded by cypress trees: a place to rest by quiet water.',
  'facts' => ['Inspired by' => 'Psalm 23:2', 'The words' => '"He leads me beside quiet waters"', 'Real springs' => 'Water from underground rising to the surface', 'A real healing pool' => 'The Pool of Bethesda, Jerusalem'],
  'sections' => [
    ['The pool', HEAVEN_IMAGINE, [
      'Water tumbles over marble steps into a cool, clear pool where people swim, paddle or just sit and listen.',
    ]],
    ['Beside quiet waters', HEAVEN_BELIEF, [
      'Psalm 23, one of the best-known passages in the Bible, pictures God as a shepherd who "leads me beside quiet waters" and "refreshes my soul" (Psalm 23:2–3). In the Gospel of John, Jesus heals a man at the Pool of Bethesda in Jerusalem (John 5:2–9), and archaeologists have found the remains of that pool.',
    ]],
    ['Springs and waterfalls', HEAVEN_REAL, [
      'A spring is a place where water from underground comes up to the surface. Rain soaks into the ground and can travel through the rock for years before it flows out again, often cool and clear. Waterfalls form where a river flows over hard rock onto softer rock, which wears away faster.',
    ]],
  ],
  'art' => 'The illustration shows a marble pool fed by a small waterfall over marble steps, with cypress trees.',
  'look' => ['Follow the water from the top to the pool.', 'Find the cypress trees.'],
  'questions' => ['Why do you think quiet water helps people feel calm?', 'Where does spring water come from?', 'Where do you go to feel calm?'],
  'words' => ['Spring' => 'A place where water comes up from under the ground.', 'Shepherd' => 'A person who looks after sheep.', 'Groundwater' => 'Water held in the soil and rock underground.'],
  'sources' => ['bible-psalms', 'bible-john', 'usgs-springs'],
  'related' => ['fountain-of-life', 'cloud-island', 'golden-track'],
],

'garden-of-light' => [
  'name' => 'Garden of light', 'latin' => 'Genesis 2:8', 'cat' => 'life', 'src' => 'art/growth_1.png',
  'summary' => 'A walled garden of glowing lilies, a long pool and cypress trees. The word "paradise" first meant a walled garden.',
  'facts' => ['Inspired by' => 'Genesis 2:8, the Garden of Eden', 'The word paradise' => 'From an old Persian word for a walled garden', 'In Islam' => 'Paradise is Jannah, "the garden"', 'Real gardens' => 'The Persian gardens of Iran, a World Heritage Site'],
  'sections' => [
    ['The garden', HEAVEN_IMAGINE, [
      'Glowing white lilies line a long pool, and tall cypress trees stand along the walls. Inside, it is always peaceful.',
    ]],
    ['Paradise means garden', HEAVEN_BELIEF, [
      'The Bible begins in a garden: God plants a garden in Eden and puts the first people in it (Genesis 2:8). In the Quran, paradise is called Jannah, which means "garden", a place of shade, fruit and flowing water. Our word "paradise" comes, through Greek, from an old Persian word for a walled garden or park.',
    ]],
    ['Gardens in our world', HEAVEN_REAL, [
      'Persian gardens, divided into four parts by long pools and water channels, were copied from Spain to India; the gardens of the Taj Mahal follow this plan. Research collected by the World Health Organization has found that time in parks and green spaces can lower stress and help people feel better.',
    ]],
  ],
  'art' => 'The illustration shows a walled garden with glowing white lilies, a long pool, cypress trees and a low marble wall.',
  'look' => ['Find the long pool.', 'Count the cypress trees.'],
  'questions' => ['Why do you think so many people picture paradise as a garden?', 'How does being in a garden make you feel?', 'What would you plant in a garden of peace?'],
  'words' => ['Paradise' => 'A place of perfect happiness; first, a walled garden.', 'Cypress' => 'A tall, slim evergreen tree.', 'Evergreen' => 'Keeping its leaves all year.'],
  'sources' => ['bible-genesis', 'brit-paradise', 'un-persian', 'who-green'],
  'related' => ['lily-garden', 'tree-of-life', 'garden-villa'],
],

'lily-garden' => [
  'name' => 'Lily garden', 'latin' => 'Matthew 6:28–29', 'cat' => 'life', 'src' => 'art/nt_garden.png',
  'summary' => 'A bed of white lilies and golden flowers. Jesus pointed to the flowers of the field to teach people not to worry.',
  'facts' => ['Inspired by' => 'Matthew 6:28–29', 'The words' => '"See how the flowers of the field grow"', 'In Buddhism' => 'The lotus rises clean from muddy water', 'Real world' => 'Flowers feed bees and other pollinators'],
  'sections' => [
    ['The garden', HEAVEN_IMAGINE, [
      'Flowers bloom here all year round, and no one has to worry about tomorrow.',
    ]],
    ['The flowers of the field', HEAVEN_BELIEF, [
      'In the Sermon on the Mount, Jesus tells his listeners not to worry about what they will eat or wear: "See how the flowers of the field grow. They do not labor or spin. Yet I tell you that not even Solomon in all his splendor was dressed like one of these" (Matthew 6:28–29). In Buddhism, the lotus, which grows up from the mud into a clean and beautiful flower, stands for a pure mind, and Pure Land texts describe heavenly ponds full of lotus flowers.',
    ]],
    ['Flowers and pollinators', HEAVEN_REAL, [
      'Flowers are not only beautiful. Bees, butterflies and other pollinators carry pollen from flower to flower, which helps plants make fruit and seeds. About three out of every four kinds of food crops depend at least partly on pollinators.',
    ]],
  ],
  'art' => 'The illustration shows a bed of white lilies and golden flowers with a low marble edge.',
  'look' => ['Find the white lilies.', 'Which flowers are golden?'],
  'questions' => ['What do you think Jesus meant about not worrying?', 'How do flowers help the food we eat?', 'What could you plant to help bees?'],
  'words' => ['Pollinator' => 'An animal that carries pollen from flower to flower.', 'Pollen' => 'A fine powder that flowers need to make seeds.', 'Sermon' => 'A talk about faith or how to live.'],
  'sources' => ['bible-matthew', 'brit-pureland', 'fao-pollinators'],
  'related' => ['garden-of-light', 'dove-statue', 'tree-of-life'],
],

// ---------------- Sharing and feasts ----------------
'banquet-hall' => [
  'name' => 'Banquet hall', 'latin' => 'Isaiah 25:6', 'cat' => 'share', 'src' => 'art/shared_3.png',
  'summary' => 'A long golden hall with a table set for a feast. Many faiths picture heaven as a great meal where everyone is invited.',
  'facts' => ['Inspired by' => 'Isaiah 25:6', 'The words' => '"A feast of rich food for all peoples"', 'Real world' => 'Sikh community kitchens, called langar', 'Biggest langar' => 'The Golden Temple, Amritsar: tens of thousands of free meals a day'],
  'sections' => [
    ['The hall', HEAVEN_IMAGINE, [
      'The table is so long you cannot see the end of it, with a seat for everyone and plenty for all.',
    ]],
    ['A feast for all peoples', HEAVEN_BELIEF, [
      'The prophet Isaiah describes a day when God will prepare "a feast of rich food for all peoples" and "wipe away the tears from all faces" (Isaiah 25:6–8). Jesus said that people "will come from east and west and north and south, and will take their places at the feast in the kingdom of God" (Luke 13:29). The Quran, too, describes the people of paradise sharing fruit and drink together in peace.',
    ]],
    ['Free meals for everyone', HEAVEN_REAL, [
      'In Sikh gurdwaras around the world, a community kitchen called the langar serves free meals to anyone who comes, whatever their faith or background, and everyone sits together on the floor as equals. The langar at the Golden Temple in Amritsar, India, cooked by volunteers, serves tens of thousands of people every day.',
    ]],
  ],
  'art' => 'The illustration shows a long golden hall with open arches and a long table set for a feast inside.',
  'look' => ['Find the long table.', 'How many arches can you count?'],
  'questions' => ['Why might sharing a meal bring people together?', 'Who might be missing from the table in your town?', 'How could your class share food with others?'],
  'words' => ['Banquet' => 'A big, special meal for many guests.', 'Langar' => 'A free community kitchen in a Sikh gurdwara.', 'Gurdwara' => 'A Sikh place of worship.'],
  'sources' => ['bible-isaiah', 'bible-luke', 'brit-langar', 'sgpc'],
  'related' => ['sharing-pavilion', 'welcome-hall', 'lantern-circle'],
],

'sharing-pavilion' => [
  'name' => 'Sharing pavilion', 'latin' => 'Acts 4:32', 'cat' => 'share', 'src' => 'art/business_1.png',
  'summary' => 'A golden pavilion full of fruit and flowers, where everything is free to take and free to give.',
  'facts' => ['Inspired by' => 'Acts 4:32', 'The words' => '"They shared everything they had"', 'In many faiths' => 'Zakat, tzedakah, dana: giving to people in need', 'Real world' => 'Food banks and little free pantries'],
  'sections' => [
    ['The pavilion', HEAVEN_IMAGINE, [
      'There are no prices here. People bring what they have grown or made and take what they need.',
    ]],
    ['Sharing everything', HEAVEN_BELIEF, [
      'The Book of Acts describes the first Christians in Jerusalem: "No one claimed that any of their possessions was their own, but they shared everything they had", so that "there were no needy persons among them" (Acts 4:32–34). Giving to people in need is a duty in many faiths: zakat in Islam, tzedakah in Judaism and dana in Buddhism and Hinduism.',
    ]],
    ['Sharing in our world', HEAVEN_REAL, [
      'Food banks collect food that would otherwise go to waste and give it to families who need it. In many neighborhoods, small "little free pantries" let anyone leave food or take some, no questions asked.',
    ]],
    ['A kitchen for everyone', HEAVEN_REAL, [
      'At the Golden Temple in Amritsar, India, the Sikh community kitchen, called the langar, serves free meals to tens of thousands of people every day. Volunteers cook and wash up, anyone may come, and everyone sits on the floor together, as equals.',
    ]],
  ],
  'art' => 'The illustration shows a small open marble pavilion with a gold canopy roof and baskets of fruit and flowers.',
  'look' => ['Find the baskets of fruit.', 'What else is in the pavilion?'],
  'questions' => ['What would a market with no prices be like?', 'Why do so many faiths ask people to give to others?', 'What could you share with someone this week?'],
  'words' => ['Pavilion' => 'A light, open building, often in a garden or park.', 'Zakat' => 'In Islam, giving a share of one\'s wealth to people in need.', 'Food bank' => 'A place that gives free food to people who need it.'],
  'sources' => ['bible-acts', 'brit-zakat', 'feeding-america', 'brit-langar'],
  'related' => ['banquet-hall', 'hall-of-treasures', 'tree-of-life'],
],

'hall-of-treasures' => [
  'name' => 'Hall of treasures', 'latin' => 'Matthew 6:19–21', 'cat' => 'share', 'src' => 'art/business_3.png',
  'summary' => 'A marble hall overflowing with glowing gold. Jesus taught that the real treasure is goodness, stored up in heaven.',
  'facts' => ['Inspired by' => 'Matthew 6:19–21', 'The words' => '"Store up for yourselves treasures in heaven"', 'The idea' => 'Kindness matters more than money', 'Real research' => 'Spending on others can make people happier'],
  'sections' => [
    ['The hall', HEAVEN_IMAGINE, [
      'Chests of glowing gold spill out onto the steps of this great hall, but no one guards them, because in this city no one needs to steal.',
    ]],
    ['Treasures in heaven', HEAVEN_BELIEF, [
      'Jesus told his listeners: "Do not store up for yourselves treasures on earth, where moths and vermin destroy, and where thieves break in and steal. But store up for yourselves treasures in heaven… For where your treasure is, there your heart will be also" (Matthew 6:19–21). Many Christians understand this to mean that kindness, generosity and love matter more than money.',
    ]],
    ['Giving and happiness', HEAVEN_REAL, [
      'In a study published in 2008, psychologists gave people a small amount of money in the morning. Some were told to spend it on themselves and others to spend it on someone else. By the evening, the people who had spent the money on others felt happier.',
    ]],
  ],
  'art' => 'The illustration shows a grand marble hall with tall gold doors, gold columns and open chests of glowing gold on the steps.',
  'look' => ['Find the open chests of gold.', 'Look at the doors. What are they made of?'],
  'questions' => ['What do you think is the most valuable thing a person can have?', 'Why might giving make people happy?', 'What kind of "treasure" could you give that doesn\'t cost money?'],
  'words' => ['Treasure' => 'Something very valuable.', 'Generosity' => 'Being happy to give and share.', 'Psychologist' => 'A scientist who studies how people think and feel.'],
  'sources' => ['bible-matthew', 'dunn'],
  'related' => ['sharing-pavilion', 'building-materials', 'palace-of-light'],
],

'lantern-circle' => [
  'name' => 'Lantern circle', 'latin' => 'Matthew 5:14–16', 'cat' => 'share', 'src' => 'art/shared_1.png',
  'summary' => 'A circle of marble benches around a great golden lamp, where people gather in the evening to talk and share stories.',
  'facts' => ['Inspired by' => 'Matthew 5:14–16', 'The words' => '"You are the light of the world"', 'Lantern festivals' => 'The Chinese Lantern Festival and Diwali', 'Real world' => 'Talking circles where everyone has a turn'],
  'sections' => [
    ['The circle', HEAVEN_IMAGINE, [
      'Every evening, people gather around the great lamp. No one sits at the head of a circle, so everyone can see and hear everyone else.',
    ]],
    ['Let your light shine', HEAVEN_BELIEF, [
      'In the Sermon on the Mount, Jesus tells his followers: "You are the light of the world… let your light shine before others, that they may see your good deeds" (Matthew 5:14–16). Light shared in the dark is a picture of hope in many traditions, from the oil lamps of Diwali to the candles of Hanukkah.',
    ]],
    ['Gathering in a circle', HEAVEN_REAL, [
      'People have gathered around fires to share food and stories for hundreds of thousands of years. Many schools and communities still talk things through in circles, where everyone has a turn to speak, and at the Chinese Lantern Festival, on the 15th day of the New Year, families light lanterns together.',
    ]],
  ],
  'art' => 'The illustration shows a circle of marble benches around a tall, glowing golden lamp.',
  'look' => ['Find the glowing lamp.', 'How many benches are there?'],
  'questions' => ['Why might sitting in a circle feel different from sitting in rows?', 'What does it mean to "let your light shine"?', 'Where do people in your town gather in the evening?'],
  'words' => ['Lantern' => 'A lamp with a protective cover.', 'Hope' => 'The feeling that good things can happen.', 'Tradition' => 'A custom handed down over many years.'],
  'sources' => ['bible-matthew', 'brit-lantern', 'brit-diwali'],
  'related' => ['lamp-tower', 'banquet-hall', 'rainbow-pavilion'],
],

'rainbow-pavilion' => [
  'name' => 'Rainbow pavilion', 'latin' => 'Genesis 9:13', 'cat' => 'share', 'src' => 'art/shared_2.png',
  'summary' => 'An open pavilion of flowers under a soft rainbow, a sign of promise and peace.',
  'facts' => ['Inspired by' => 'Genesis 9:13', 'The story' => 'After the flood, a rainbow is a promise', 'In Revelation' => 'A rainbow shines around God\'s throne', 'Science' => 'Sunlight split into colors by raindrops'],
  'sections' => [
    ['The pavilion', HEAVEN_IMAGINE, [
      'Under the arch of a rainbow, a white pavilion stands among flowers: a place to make promises and keep them.',
    ]],
    ['A sign of promise', HEAVEN_BELIEF, [
      'In the Bible, after the great flood, God sets a rainbow in the clouds as the sign of a promise never to flood the whole earth again (Genesis 9:13). In Revelation, a rainbow "shone like an emerald" around God\'s throne (Revelation 4:3). In Norse myths, the rainbow is Bifrost, the bridge to the home of the gods.',
    ]],
    ['How rainbows form', HEAVEN_REAL, [
      'A rainbow appears when sunlight shines into falling raindrops. Each drop bends the light, splits it into its colors, from red to violet, and reflects it back toward you. That is why you can only see a rainbow with the sun behind you and rain in front of you.',
    ]],
  ],
  'art' => 'The illustration shows an open marble pavilion with flowers under a soft rainbow arch.',
  'look' => ['Find the rainbow.', 'Name the colors you can see.'],
  'questions' => ['Why might a rainbow be a good sign of hope after a storm?', 'What promises are important to keep?', 'Where should you stand to see a rainbow?'],
  'words' => ['Promise' => 'Saying you will certainly do something.', 'Refraction' => 'The bending of light as it passes from one material into another.', 'Spectrum' => 'The band of colors that white light splits into.'],
  'sources' => ['bible-genesis', 'bible-rev', 'brit-bifrost', 'noaa-rainbow'],
  'related' => ['dove-statue', 'sky-bridge', 'lantern-circle'],
],

// ---------------- Wisdom and music ----------------
'hall-of-wisdom' => [
  'name' => 'Hall of wisdom', 'latin' => 'Proverbs 3:13–14', 'cat' => 'learn', 'src' => 'art/knowledge_3.png',
  'summary' => 'A domed library of light where learning never ends, inspired by faiths that treasure wisdom and by the great libraries of today.',
  'facts' => ['Inspired by' => 'Proverbs 3:13–14', 'The words' => '"Blessed are those who find wisdom"', 'Largest real library' => 'The Library of Congress, Washington, D.C.', 'Its collection' => 'More than 170 million items'],
  'sections' => [
    ['The hall', HEAVEN_IMAGINE, [
      'Every question anyone has ever asked has an answer waiting somewhere on these shelves, and there is always time to read it.',
    ]],
    ['Wisdom more precious than silver', HEAVEN_BELIEF, [
      'The Book of Proverbs says: "Blessed are those who find wisdom, those who gain understanding, for she is more profitable than silver and yields better returns than gold" (Proverbs 3:13–14). Many faiths treasure learning: the first word of the Quran to be revealed was "Read!" (Quran 96:1), and Jewish tradition honors a lifetime of study of the Torah.',
    ]],
    ['Great libraries', HEAVEN_REAL, [
      'The Library of Congress in Washington, D.C., is the largest library in the world, with more than 170 million items, from books and maps to recordings and photographs. Public libraries lend books for free, so anyone can keep learning all their life.',
    ]],
  ],
  'art' => 'The illustration shows a domed marble library with a columned porch, a gold dome and glowing windows.',
  'look' => ['Find the columned porch.', 'Where does the light shine out?'],
  'questions' => ['What is the difference between knowing facts and being wise?', 'What would you love to learn if you had all the time in the world?', 'Why are free public libraries important?'],
  'words' => ['Wisdom' => 'Knowing how to use what you know well.', 'Proverb' => 'A short, wise saying.', 'Torah' => 'The first five books of the Hebrew Bible, and Jewish teaching more broadly.'],
  'sources' => ['bible-proverbs', 'quran-read', 'loc'],
  'related' => ['scroll-library', 'school-of-wisdom', 'palace-of-light'],
],

'scroll-library' => [
  'name' => 'Scroll library', 'latin' => 'Ecclesiastes 12:12', 'cat' => 'learn', 'src' => 'art/knowledge_1.png',
  'summary' => 'A small marble library of scrolls. Some of the oldest scrolls in the world are copies of holy books.',
  'facts' => ['Inspired by' => 'Ecclesiastes 12:12', 'The words' => '"Of making many books there is no end"', 'Famous find' => 'The Dead Sea Scrolls, found in 1947', 'Their age' => 'About 2,000 years or more'],
  'sections' => [
    ['The library', HEAVEN_IMAGINE, [
      'In this library every story, song and prayer is kept safe, and anyone may unroll a scroll and read.',
    ]],
    ['Many books', HEAVEN_BELIEF, [
      'The Book of Ecclesiastes says, with a smile, "Of making many books there is no end, and much study wearies the body" (Ecclesiastes 12:12). Holy books were copied by hand for centuries. Jewish scribes still copy the Torah onto scrolls with great care, and Muslims honor those who learn the whole Quran by heart.',
    ]],
    ['The Dead Sea Scrolls', HEAVEN_REAL, [
      'In 1947, young shepherds exploring caves near the Dead Sea found clay jars holding ancient scrolls. Over the next years nearly a thousand scrolls were found, some more than 2,000 years old, including the oldest known copies of books of the Hebrew Bible. Many are kept at the Israel Museum in Jerusalem, and many can be read online.',
    ]],
  ],
  'art' => 'The illustration shows a small marble library with shelves of scrolls and a gold roof.',
  'look' => ['Find the shelves of scrolls.', 'What color is the roof?'],
  'questions' => ['Why would people copy books by hand so carefully?', 'What would you want to keep safe for people 2,000 years from now?', 'How are old books kept safe today?'],
  'words' => ['Scroll' => 'A long roll of paper or parchment with writing on it.', 'Manuscript' => 'A book or document written by hand.', 'Parchment' => 'Animal skin prepared for writing on.'],
  'sources' => ['bible-ecclesiastes', 'brit-deadsea', 'imj-scrolls'],
  'related' => ['hall-of-wisdom', 'school-of-wisdom', 'harp-workshop'],
],

'school-of-wisdom' => [
  'name' => 'School of wisdom', 'latin' => 'Isaiah 11:9', 'cat' => 'learn', 'src' => 'art/knowledge_2.png',
  'summary' => 'A school with a little gold dome and a bell, where people of every age keep learning.',
  'facts' => ['Inspired by' => 'Isaiah 11:6–9', 'The words' => '"The earth will be filled with the knowledge of the LORD"', 'Oldest school still open' => 'Al-Qarawiyyin, Fez, Morocco, founded in 859', 'Founded by' => 'Fatima al-Fihri'],
  'sections' => [
    ['The school', HEAVEN_IMAGINE, [
      'No one is ever too old or too young for this school, and every student is also a teacher of something.',
    ]],
    ['A world full of knowledge', HEAVEN_BELIEF, [
      'The prophet Isaiah imagines a peaceful world where "the wolf will live with the lamb" and "the earth will be filled with the knowledge of the LORD as the waters cover the sea" (Isaiah 11:6–9). Teaching is honored in every faith: Jesus\'s followers called him "rabbi", which means "teacher", and the Buddha spent his life teaching.',
    ]],
    ['A school that has lasted', HEAVEN_REAL, [
      'The University of al-Qarawiyyin in Fez, Morocco, was founded in 859 by Fatima al-Fihri, a woman who used her inheritance to build a mosque and a place of learning. Guinness World Records calls it the oldest educational institution in the world that is still open.',
    ]],
  ],
  'art' => 'The illustration shows a two-story hall with columns, a small gold dome and a bell.',
  'look' => ['Find the bell.', 'Where would students come in?'],
  'questions' => ['What can older people teach younger people, and the other way round?', 'Why do you think Fatima al-Fihri used her money to build a school?', 'What would you teach if you were the teacher for a day?'],
  'words' => ['Rabbi' => 'A Jewish teacher.', 'University' => 'A place of higher learning and research.', 'Inheritance' => 'Money or property received from someone who has died.'],
  'sources' => ['bible-isaiah', 'guinness-uni', 'un-fez'],
  'related' => ['hall-of-wisdom', 'scroll-library', 'bell-tower'],
],

'harp-workshop' => [
  'name' => 'Harp workshop', 'latin' => 'Revelation 14:2', 'cat' => 'learn', 'src' => 'art/nt_workshop.png',
  'summary' => 'A marble workshop where golden harps and trumpets are made for the city\'s music.',
  'facts' => ['Inspired by' => 'Revelation 14:2', 'The words' => '"Like that of harpists playing their harps"', 'Oldest real harps and lyres' => 'From Ur, in Mesopotamia, about 4,500 years old', 'How strings sing' => 'They vibrate and make sound waves'],
  'sections' => [
    ['The workshop', HEAVEN_IMAGINE, [
      'Makers here build harps, trumpets and drums, and every instrument is finished by playing it.',
    ]],
    ['The music of heaven', HEAVEN_BELIEF, [
      'Revelation describes a sound from heaven "like that of harpists playing their harps" (Revelation 14:2), and trumpets announce great moments in its visions. In the Hebrew Bible, the young shepherd David plays the lyre to soothe King Saul (1 Samuel 16:23). Music is part of worship in many faiths, from Christian hymns to the devotional singing called kirtan in Sikh and Hindu worship.',
    ]],
    ['Ancient instruments', HEAVEN_REAL, [
      'Some of the oldest stringed instruments ever found come from the royal tombs of Ur, in what is now Iraq. They were made around 2500 BC and decorated with gold and shell; one of them, the Queen\'s Lyre, is in the British Museum. A string makes a sound when it vibrates: shorter, tighter strings vibrate faster and play higher notes.',
    ]],
  ],
  'art' => 'The illustration shows a marble workshop with open arches where golden harps and trumpets are being made.',
  'look' => ['Find a golden harp.', 'Can you spot a trumpet?'],
  'questions' => ['Why do you think music is part of so many pictures of heaven?', 'How does music change the way you feel?', 'How could you make an instrument from things at home?'],
  'words' => ['Harp' => 'A stringed instrument played by plucking.', 'Lyre' => 'An ancient stringed instrument with a U-shaped frame.', 'Hymn' => 'A song of praise, often sung in worship.'],
  'sources' => ['bible-rev', 'bible-samuel', 'bm-ur'],
  'related' => ['bell-tower', 'school-of-wisdom', 'victors-arena'],
],

// ---------------- Play and celebration ----------------
'golden-track' => [
  'name' => 'Golden track', 'latin' => 'Hebrews 12:1', 'cat' => 'joy', 'src' => 'art/fitness_2.png',
  'summary' => 'An oval running track with gold lanes around a green field, where every race is run for joy.',
  'facts' => ['Inspired by' => 'Hebrews 12:1', 'The words' => '"Let us run with perseverance the race marked out for us"', 'A real track' => '400 meters around the inside lane', 'Real world' => 'The Paralympic Games'],
  'sections' => [
    ['The track', HEAVEN_IMAGINE, [
      'On this track everyone finishes, and the crowd cheers just as loudly for the last runner as for the first.',
    ]],
    ['Run the race', HEAVEN_BELIEF, [
      'Early Christian writers often compared life to a race. The Letter to the Hebrews says: "Let us run with perseverance the race marked out for us" (Hebrews 12:1), and the apostle Paul wrote near the end of his life: "I have finished the race, I have kept the faith" (2 Timothy 4:7).',
    ]],
    ['Running for everyone', HEAVEN_REAL, [
      'A standard running track is 400 meters around the inside lane. The Paralympic Games, held after each Summer and Winter Olympics, bring together athletes with disabilities from around the world. Parkrun, a free weekly 5-kilometer event held in hundreds of parks, welcomes runners and walkers of every speed.',
    ]],
    ['Helped to the finish', HEAVEN_REAL, [
      'At the 1992 Olympic Games in Barcelona, the British runner Derek Redmond tore a muscle in his leg during a 400-meter race. He kept hobbling on, and his father came out of the crowd to help him reach the finish line, while the whole stadium stood and cheered.',
    ]],
  ],
  'art' => 'The illustration shows an oval running track with gold lanes around a green field, with a small marble finish arch.',
  'look' => ['Find the finish arch.', 'How many lanes can you count?'],
  'questions' => ['What could it mean to "run the race" in life?', 'Why might cheering for the last runner matter?', 'What helps you keep going when something is hard?'],
  'words' => ['Perseverance' => 'Keeping going when things are hard.', 'Lane' => 'A strip of a track for one runner.', 'Paralympics' => 'International games for athletes with disabilities.'],
  'sources' => ['bible-hebrews', 'bible-timothy', 'ipc', 'parkrun', 'brit-olympics'],
  'related' => ['victors-arena', 'spring-pool', 'lantern-circle'],
],

'victors-arena' => [
  'name' => 'Victors\' arena', 'latin' => '1 Corinthians 9:25', 'cat' => 'joy', 'src' => 'art/fitness_3.png',
  'summary' => 'A white marble stadium crowned with golden laurel wreaths, where every effort is celebrated.',
  'facts' => ['Inspired by' => '1 Corinthians 9:25', 'The words' => '"A crown that will last forever"', 'Ancient prize' => 'A wreath of olive leaves at Olympia', 'First Olympics' => '776 BC, according to tradition'],
  'sections' => [
    ['The arena', HEAVEN_IMAGINE, [
      'In this arena the prizes never run out, and the cheers are for courage, kindness and fair play as much as for winning.',
    ]],
    ['A crown that lasts', HEAVEN_BELIEF, [
      'The apostle Paul knew the athletic games of Greece. He wrote: "Everyone who competes in the games goes into strict training. They do it to get a crown that will not last, but we do it to get a crown that will last forever" (1 Corinthians 9:25). Christians also speak of the "crown of life" promised to those who stay faithful (James 1:12).',
    ]],
    ['Olive wreaths', HEAVEN_REAL, [
      'At the ancient Olympic Games, which began in 776 BC according to tradition, winners received a simple wreath of olive leaves cut from a sacred tree at Olympia. When the Olympics returned to Athens in 2004, the winners again wore olive wreaths.',
    ]],
  ],
  'art' => 'The illustration shows a white marble stadium with tiers of arches, gold trim, a green field inside and golden laurel wreaths on top.',
  'look' => ['Find the golden wreaths.', 'How many rows of arches can you see?'],
  'questions' => ['Why might a simple wreath be worth more than gold?', 'What kind of "prize" could last forever?', 'How can you celebrate effort, not just winning?'],
  'words' => ['Wreath' => 'A ring of leaves or flowers.', 'Laurel' => 'A tree whose leaves were made into victory wreaths.', 'Apostle' => 'One of the first people sent out to spread Jesus\'s teaching.'],
  'sources' => ['bible-corinthians', 'bible-james', 'brit-olympics'],
  'related' => ['golden-track', 'harp-workshop', 'hall-of-treasures'],
],

// ---------------- Homes ----------------
'house-of-many-rooms' => [
  'name' => 'House of many rooms', 'latin' => 'John 14:2', 'cat' => 'homes', 'src' => 'art/family_3.png',
  'summary' => 'A great white mansion with many wings and gardens. Jesus told his friends that his Father\'s house has many rooms.',
  'facts' => ['Inspired by' => 'John 14:2', 'The words' => '"My Father\'s house has many rooms"', 'The idea' => 'A home for everyone', 'Real world' => 'Groups that build homes with families'],
  'sections' => [
    ['The house', HEAVEN_IMAGINE, [
      'However many people arrive, there is always another room ready, with a light in the window and a bed made up.',
    ]],
    ['Many rooms', HEAVEN_BELIEF, [
      'On the night before he died, Jesus comforted his friends: "My Father\'s house has many rooms… I am going there to prepare a place for you" (John 14:2). Christians have long read this as a promise that there is room in heaven for all whom God welcomes.',
    ]],
    ['Homes for everyone', HEAVEN_REAL, [
      'A safe home is one of the most basic human needs. Groups such as Habitat for Humanity, founded in 1976, help families build or repair homes, with volunteers working side by side with the families who will live there.',
    ]],
    ['Room for one more', HEAVEN_REAL, [
      'Around the world, more than 100 million people have been forced to leave their homes because of war, persecution or disaster, according to the United Nations refugee agency. Many families, towns and faith groups help them find a safe place to live.',
    ]],
  ],
  'art' => 'The illustration shows a large white marble mansion with many wings, balconies, gold roofs and gardens.',
  'look' => ['Count the gold roofs.', 'Find the gardens between the wings.'],
  'questions' => ['What makes a house feel like home?', 'Why might it matter that there is room for everyone?', 'How could a town make sure everyone has a home?'],
  'words' => ['Mansion' => 'A very large house.', 'Wing' => 'A part of a building that sticks out from the main part.', 'Shelter' => 'A place that protects from weather or danger.'],
  'sources' => ['bible-john', 'habitat', 'unhcr'],
  'related' => ['marble-cottage', 'garden-villa', 'welcome-hall'],
],

'marble-cottage' => [
  'name' => 'Marble cottage', 'latin' => 'Micah 4:4', 'cat' => 'homes', 'src' => 'art/family_1.png',
  'summary' => 'A family cottage of white marble with a gold roof, flowering vines and a little garden, where no one is ever afraid.',
  'facts' => ['Inspired by' => 'Micah 4:3–4', 'The words' => '"Everyone will sit under their own vine and under their own fig tree"', 'The idea' => 'Peace and safety at home', 'Real world' => 'The International Day of Peace, September 21'],
  'sections' => [
    ['The cottage', HEAVEN_IMAGINE, [
      'A small, simple house with a garden, a vine over the door and neighbors who wave as they pass.',
    ]],
    ['Under the vine and fig tree', HEAVEN_BELIEF, [
      'The prophet Micah describes a time when nations "will beat their swords into plowshares" and "everyone will sit under their own vine and under their own fig tree, and no one will make them afraid" (Micah 4:3–4). It is one of the Bible\'s best-loved pictures of peace: not riches, but a safe home, enough to eat and no fear.',
    ]],
    ['Good neighbors', HEAVEN_REAL, [
      'The World Happiness Report, which compares countries each year, finds that people are happier where they can count on others and trust their neighbors. The United Nations marks the International Day of Peace every year on September 21.',
    ]],
    ['Swords into plowshares', HEAVEN_REAL, [
      'In the garden of the United Nations headquarters in New York stands a bronze statue of a man hammering a sword into a plow. Its name, "Let Us Beat Swords into Plowshares", comes from the words of Micah and Isaiah. It was a gift from the Soviet Union in 1959.',
    ]],
  ],
  'art' => 'The illustration shows a white marble family house with a gold roof, a garden and flowering vines.',
  'look' => ['Find the flowering vines.', 'Where is the garden?'],
  'questions' => ['What makes you feel safe at home?', 'What does "beat swords into plowshares" mean?', 'How can neighbors look after each other?'],
  'words' => ['Plowshare' => 'The blade of a plow.', 'Vine' => 'A climbing plant, such as a grapevine.', 'Belonging' => 'Feeling part of a group.'],
  'sources' => ['bible-micah', 'whr', 'un-peace', 'un-swords'],
  'related' => ['house-of-many-rooms', 'garden-villa', 'dove-statue'],
],

'garden-villa' => [
  'name' => 'Garden villa', 'latin' => 'Isaiah 65:21', 'cat' => 'homes', 'src' => 'art/family_2.png',
  'summary' => 'A villa built around a courtyard with a fountain: a home where people enjoy the fruit of their own work.',
  'facts' => ['Inspired by' => 'Isaiah 65:17–21', 'The words' => '"They will build houses and dwell in them"', 'Courtyard homes' => 'Found from Rome to Morocco to China', 'Real example' => 'The riads of Fez, Morocco'],
  'sections' => [
    ['The villa', HEAVEN_IMAGINE, [
      'Every room opens onto a sunny courtyard with a fountain, where the family eats, plays and grows its own fruit.',
    ]],
    ['New heavens and a new earth', HEAVEN_BELIEF, [
      'The prophet Isaiah imagines "new heavens and a new earth" where people "will build houses and dwell in them; they will plant vineyards and eat their fruit" (Isaiah 65:17–21). In this picture, no one loses their home or the fruit of their work.',
    ]],
    ['Courtyard homes', HEAVEN_REAL, [
      'Houses built around a private courtyard are found all over the world, from the Roman domus to the courtyard houses of Beijing and the riads of Fez in Morocco. The courtyard brings light, fresh air and a safe place to play into the middle of the home.',
    ]],
    ['Paradise gardens', HEAVEN_REAL, [
      'The word "paradise" comes from an old Persian word for a walled garden. Persian gardens are often divided into four parts by channels of water, with shady trees and pools. UNESCO protects nine of these gardens in Iran as world heritage.',
    ]],
  ],
  'art' => 'The illustration shows a large white villa built around a courtyard with a fountain, with gold domes and cypress trees.',
  'look' => ['Find the fountain in the courtyard.', 'How many gold domes can you see?'],
  'questions' => ['Why might people want to enjoy the fruit of their own work?', 'What would you use a courtyard in the middle of your home for?', 'How do homes near you let in light and air?'],
  'words' => ['Courtyard' => 'An open space surrounded by buildings or walls.', 'Vineyard' => 'A field where grapes are grown.', 'Riad' => 'A traditional Moroccan house built around a courtyard garden.'],
  'sources' => ['bible-isaiah', 'un-fez', 'un-persian'],
  'related' => ['garden-of-light', 'marble-cottage', 'fountain-of-life'],
],

// ---------------- Building the city ----------------
'light-crane' => [
  'name' => 'Light crane', 'latin' => 'Nehemiah 2:18', 'cat' => 'build', 'src' => 'build/crane.png',
  'summary' => 'A golden crane that lifts marble blocks on a beam of light: the city is always being built.',
  'facts' => ['Inspired by' => 'Nehemiah 2:18', 'The words' => '"Let us start rebuilding"', 'Real cranes lift with' => 'Steel cables, pulleys and counterweights', 'Real world' => 'Volunteers who rebuild after disasters'],
  'sections' => [
    ['The crane', HEAVEN_IMAGINE, [
      'Instead of a rope, a beam of soft light holds each glowing marble block and lowers it gently into place.',
    ]],
    ['Rebuilding together', HEAVEN_BELIEF, [
      'In the Bible, Nehemiah returns to Jerusalem, finds its walls in ruins and calls to the people: "Let us start rebuilding", and they work together to raise the walls again (Nehemiah 2:18). Many faiths teach that people are called to help build a better world, not only to wait for one.',
    ]],
    ['Building after disasters', HEAVEN_REAL, [
      'After floods, storms and earthquakes, volunteers from charities and faith groups often travel to help rebuild homes and schools. Real cranes lift heavy loads with steel cables and pulleys, balanced by heavy counterweights so they don\'t tip over.',
    ]],
    ['Raising a barn together', HEAVEN_REAL, [
      'In Amish communities in the United States, neighbors gather for a "barn raising". With many hands working together, they can put up the whole frame of a barn for one family in a single day, and share a big meal afterward.',
    ]],
  ],
  'art' => 'The illustration shows a slim white marble tower with a long gold arm and a beam of light instead of a rope, lifting a glowing marble block.',
  'look' => ['Follow the beam of light to the block.', 'Find the gold arm.'],
  'questions' => ['Why might working together make a big job easier?', 'How do people help rebuild after a disaster?', 'How does a counterweight stop a crane from tipping over?'],
  'words' => ['Crane' => 'A machine for lifting heavy things.', 'Counterweight' => 'A weight that balances a load.', 'Disaster' => 'A sudden event that causes great damage.'],
  'sources' => ['bible-nehemiah', 'brit-crane', 'brit-amish'],
  'related' => ['building-materials', 'house-of-many-rooms', 'palace-of-light'],
],

'building-materials' => [
  'name' => 'Building materials', 'latin' => 'Revelation 21:18–21', 'cat' => 'build', 'src' => 'build/materials.png',
  'summary' => 'Marble blocks, gold bars, pearls and gold tiles: the materials of the heavenly city.',
  'facts' => ['Inspired by' => 'Revelation 21:18–21', 'In the vision' => 'A city of pure gold, as clear as glass', 'Why gold stays bright' => 'It does not rust', 'Marble forms from' => 'Limestone, changed by heat and pressure'],
  'sections' => [
    ['The materials', HEAVEN_IMAGINE, [
      'White marble, shining gold and glowing pearls: everything in this city is made to last and made to be beautiful.',
    ]],
    ['Gold like glass', HEAVEN_BELIEF, [
      'Revelation describes the heavenly city as "pure gold, as pure as glass", with walls of jasper and foundations decorated with every kind of precious stone (Revelation 21:18–21). The vision uses the most precious things people knew to describe something more precious still.',
    ]],
    ['The real materials', HEAVEN_REAL, [
      'Gold is one of the few metals that never rusts or tarnishes, which is why ancient gold jewelry still shines today. Marble forms deep underground when limestone is squeezed and heated over millions of years. Pearls grow inside oysters and mussels, layer by layer.',
    ]],
    ['Gold from old phones', HEAVEN_REAL, [
      'Gold can be recycled again and again. According to the US Environmental Protection Agency, recycling a million old cell phones recovers about 34 kilograms of gold, along with silver, copper and other metals that would otherwise have to be mined.',
    ]],
  ],
  'art' => 'The illustration shows a neat pile of white marble blocks, stacked gold bars, a basket of shining pearls and a few gold roof tiles.',
  'look' => ['Find the basket of pearls.', 'Which materials shine the most?'],
  'questions' => ['Why might someone describe heaven with gold and pearls?', 'Why does gold never rust?', 'What are the most precious things to you, and why?'],
  'words' => ['Marble' => 'A hard, often white stone formed from limestone.', 'Tarnish' => 'To lose shine because a dull coating forms on the surface.', 'Jasper' => 'A colorful, hard stone.'],
  'sources' => ['bible-rev', 'brit-gold', 'brit-marble', 'brit-pearl', 'epa-ewaste'],
  'related' => ['light-crane', 'pearl-gate', 'hall-of-treasures'],
],
];

$WORLD_DATA['heaven'] = [
  'title'    => 'Heavenly City: an imagined city of goodness and happiness',
  'desc'     => 'Explore an imagined heavenly city of gold and light: 31 places, each pairing a picture of heaven from many faiths with something real in our world.',
  'intro'    => 'An imagined city of goodness and happiness, inspired by how many faiths picture heaven. Each place shows the belief behind it, and something real in our world that brings a little of that goodness here.',
  'note'     => 'This city is imagined. It is inspired mostly by the Bible\'s pictures of heaven, and by ideas of paradise in other faiths. People picture heaven in many different ways, and some people don\'t believe in it. Each page marks what is imagined, what faiths teach and what is real today.',
  'aka'      => 'Inspired by',
  'akaLang'  => '',
  'pageTitle'=> '%s in the Heavenly City: belief and the real world',
  'pageTitleShort' => '%s in the Heavenly City',
  'aside'    => ['How to read these pages', 'Each page has three kinds of section. Imagined sections describe the artist\'s city. Belief sections describe what a faith teaches, in its own words where possible. Real world sections describe people, places and science in our world today, with sources.'],
  'pageDesc' => ' Explore the imagined place, the beliefs behind it and something real in our world, with questions for discussion.',
  'pageDescShort' => ' Explore the belief and something real today.',
  'sourcesIntro' => 'The beliefs and real-world facts on this page are based on these sources:',
  'about'    => 'Ideas of heaven and paradise in world religions, and kindness in community life',
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
