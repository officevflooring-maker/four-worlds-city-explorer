<?php
// The Medieval Kingdom: a market town of medieval Europe (roughly AD 1000 to 1500), one page per building (see the
// shared page format at the end of build/worlds/roman.php). Facts are kept to well-established points from the
// sources in $MEDIEVAL_SOURCES (shown on each page as plain text, not links). "art" says what is the artist's
// interpretation. The art is the Life RPG game's Medieval set (tools/assets.txt); photos come from
// build/photos/medieval.json.

$MEDIEVAL_SOURCES = [
  'brit-castle'     => 'Encyclopaedia Britannica, "Castle" and "Motte-and-bailey"',
  'brit-knight'     => 'Encyclopaedia Britannica, "Knight" and "Chivalry"',
  'brit-tournament' => 'Encyclopaedia Britannica, "Tournament" and "Heraldry"',
  'brit-longbow'    => 'Encyclopaedia Britannica, "Longbow"',
  'brit-monastic'   => 'Encyclopaedia Britannica, "Monasticism", "Benedictine" and "Cistercian"',
  'brit-gothic'     => 'Encyclopaedia Britannica, "Gothic architecture" and "Cathedral"',
  'brit-parish'     => 'Encyclopaedia Britannica, "Parish" and "Tithe"',
  'brit-bell'       => 'Encyclopaedia Britannica, "Bell" and "Carillon"',
  'brit-curfew'     => 'Encyclopaedia Britannica, "Curfew"',
  'brit-university' => 'Encyclopaedia Britannica, "University"',
  'brit-manuscript' => 'Encyclopaedia Britannica, "Illuminated manuscript", "Scriptorium" and "Parchment"',
  'brit-gutenberg'  => 'Encyclopaedia Britannica, "Johannes Gutenberg"',
  'brit-guild'      => 'Encyclopaedia Britannica, "Guild" and "Apprenticeship"',
  'brit-fair'       => 'Encyclopaedia Britannica, "Fair" and "Market"',
  'brit-hansa'      => 'Encyclopaedia Britannica, "Hanseatic League"',
  'brit-manor'      => 'Encyclopaedia Britannica, "Manorialism" and "Serfdom"',
  'brit-openfield'  => 'Encyclopaedia Britannica, "Open-field system" and "Three-field system"',
  'brit-blackdeath' => 'Encyclopaedia Britannica, "Black Death"',
  'brit-windmill'   => 'Encyclopaedia Britannica, "Windmill" and "Mill"',
  'brit-banalite'   => 'Encyclopaedia Britannica, "Banalité"',
  'brit-timber'     => 'Encyclopaedia Britannica, "Half-timbering", "Wattle and daub" and "Thatching"',
  'brit-iron'       => 'Encyclopaedia Britannica, "Blacksmith" and "Wrought iron"',
  'brit-hildegard'  => 'Encyclopaedia Britannica, "Saint Hildegard"',
  'brit-wool'       => 'Encyclopaedia Britannica, "Wool" and "Woolen industry"',
  'brit-hall'       => 'Encyclopaedia Britannica, "Hall" and "Hammer-beam roof"',
  'brit-crane'      => 'Encyclopaedia Britannica, "Crane" (machine)',
  'brit-mason'      => 'Encyclopaedia Britannica, "Masonry" and "Mortar"',
  'un-gwynedd'      => 'UNESCO World Heritage Centre, "Castles and Town Walls of King Edward in Gwynedd"',
  'un-carcassonne'  => 'UNESCO World Heritage Centre, "Historic Fortified City of Carcassonne"',
  'un-lubeck'       => 'UNESCO World Heritage Centre, "Hanseatic City of Lübeck"',
  'un-bryggen'      => 'UNESCO World Heritage Centre, "Bryggen"',
  'un-belfries'     => 'UNESCO World Heritage Centre, "Belfries of Belgium and France"',
  'un-canterbury'   => 'UNESCO World Heritage Centre, "Canterbury Cathedral, St Augustine\'s Abbey, and St Martin\'s Church"',
  'un-fountains'    => 'UNESCO World Heritage Centre, "Studley Royal Park including the Ruins of Fountains Abbey"',
  'un-montstmichel' => 'UNESCO World Heritage Centre, "Mont-Saint-Michel and its Bay"',
  'un-sangimignano' => 'UNESCO World Heritage Centre, "Historic Centre of San Gimignano"',
  'un-krakow'       => 'UNESCO World Heritage Centre, "Historic Centre of Kraków"',
  'un-cologne'      => 'UNESCO World Heritage Centre, "Cologne Cathedral"',
  'un-stgall'       => 'UNESCO World Heritage Centre, "Abbey of St Gall"',
  'stgall-plan'     => 'The Plan of Saint Gall (about AD 820), Abbey Library of St. Gallen, Cod. Sang. 1092',
  'rule-benedict'   => 'The Rule of Saint Benedict (6th century)',
  'tna-domesday'    => 'The National Archives (UK), "Domesday Book"',
  'bl-luttrell'     => 'British Library, "The Luttrell Psalter" (about 1325 to 1340)',
  'bl-lindisfarne'  => 'British Library, "The Lindisfarne Gospels"',
  'tcd-kells'       => 'Trinity College Dublin, "The Book of Kells"',
  'morgan-windmill' => 'The Morgan Library & Museum, "The Windmill Psalter" (England, about 1270 to 1280)',
  'ox-history'      => 'University of Oxford, "Introduction and history"',
  'winchester'      => 'Winchester College, history of the school (founded 1382)',
  'parl-westminster'=> 'UK Parliament, "Westminster Hall"',
  'parl-woolsack'   => 'UK Parliament, "The Woolsack"',
  'nt-bodiam'       => 'National Trust, "History of Bodiam Castle"',
  'eh-stokesay'     => 'English Heritage, "History of Stokesay Castle"',
  'eh-wharram'      => 'English Heritage, "History of Wharram Percy Deserted Medieval Village"',
  'eh-rievaulx'     => 'English Heritage, "History of Rievaulx Abbey"',
  'ra-armour'       => 'Royal Armouries, Leeds, collections of medieval armor and the fencing manual MS I.33 (about 1300)',
  'york-guild'      => 'The Company of Merchant Adventurers of the City of York, history of the Merchant Adventurers\' Hall (built 1357 to 1361)',
  'york-plays'      => 'York Mystery Plays: the plays of the city\'s guilds, from the 1370s',
  'glastonbury'     => 'Glastonbury Abbey, "The Abbot\'s Kitchen"',
  'forme-cury'      => 'The Forme of Cury (about 1390), the recipe book of the cooks of King Richard II',
  'assize-bread'    => 'The Assize of Bread and Ale (England, about 1266)',
  'eadwine'         => 'Trinity College, Cambridge, the Eadwine Psalter (about 1150s to 1160s) and its plan of Canterbury Cathedral\'s water supply',
  'gdansk-crane'    => 'National Maritime Museum in Gdańsk, "The Crane" (Żuraw), built in the 15th century',
  'archery-1363'    => 'King Edward III\'s order of 1363 that men in England practice archery on holidays',
  'mw-costard'      => 'Merriam-Webster, "costermonger" (word history: from "costard", a kind of apple)',
];

// category => [label, short description]
$MEDIEVAL_CATEGORIES = [
  'castle' => ['Castle and defense', 'How a medieval town and its lord kept people safe.'],
  'church' => ['Churches and abbeys', 'Places of prayer that were also places of learning, care and work.'],
  'learn'  => ['Learning and books', 'Schools, universities and the workshops where books were made by hand.'],
  'trade'  => ['Markets, crafts and guilds', 'Where goods were made, bought and sold, and how workers organized.'],
  'land'   => ['Farms and food', 'Fields, mills, orchards and gardens that fed the town.'],
  'homes'  => ['Homes', 'How people lived, from one-room cottages to manor houses.'],
  'hall'   => ['Halls, kitchens and wells', 'Where people ate, met, cooked and fetched water.'],
  'fun'    => ['Tournaments and training', 'Where knights and townspeople practiced and competed.'],
  'build'  => ['Building the town', 'The machines and materials medieval builders used.'],
];

$MEDIEVAL = [

// ---------------- Castle and defense ----------------
'royal-castle' => [
  'name' => 'Royal castle', 'latin' => 'keep and bailey', 'cat' => 'castle', 'src' => 'art/town_3.png',
  'summary' => 'A fortified home for a king or lord: thick stone walls, towers and a gate that could be shut tight.',
  'facts' => ['Used for' => 'Defense, a home for the lord and the center of local rule', 'Built in Europe' => 'From about the 900s to the 1400s', 'Made of' => 'Earth and timber at first, then stone', 'Still standing' => 'Caernarfon (Wales), Windsor (England), Carcassonne (France)'],
  'sections' => [
    ['What it was', [
      'A castle was a private fortress and a home at the same time. A king or lord lived there with his family, servants and soldiers, and ran the land around it: collecting rents, holding courts and keeping order. Castles spread across Europe from about the 900s.',
      'After the Normans conquered England in 1066, they built hundreds of quick castles called motte-and-baileys: a wooden tower on a tall earth mound (the motte) above a fenced yard (the bailey). Over time many were rebuilt in stone.',
    ]],
    ['How it worked', [
      'A stone castle was built in rings. In the middle stood the keep or great tower, the strongest place. Around it ran a high curtain wall with towers that let defenders shoot along the wall. Outside there was often a ditch or a moat full of water.',
    ], ['list' => [
      'Round towers were harder to knock down than square corners.',
      'Battlements on top had gaps to shoot through and solid parts to hide behind.',
      'Narrow slits in the walls let archers shoot out while staying protected.',
      'The gate was the weakest spot, so it got the strongest defenses.',
    ]]],
    ['Places you can still see', [
      'Caernarfon Castle in Wales was begun in 1283 for King Edward I, with towers of different shapes and bands of colored stone. It is part of a World Heritage Site with other castles and town walls in the area. Windsor Castle in England, begun by William the Conqueror around 1070, is still a home of the royal family today.',
    ]],
  ],
  'art' => 'This castle is a storybook version with blue cone roofs and red and gold flags. Real castles had cone roofs on some towers, but most were plainer and built for war.',
  'look' => ['Find the portcullis, the iron-tipped gate behind the drawbridge.', 'Count the round towers.'],
  'questions' => ['Why would a lord want his home to be a fortress?', 'Why is the gate the weakest part of a castle?', 'Is there a building in your town that people go to for safety?'],
  'words' => ['Keep' => 'The strongest tower in a castle.', 'Bailey' => 'The yard inside a castle\'s walls.', 'Battlements' => 'The notched top of a wall that protected defenders.'],
  'sources' => ['brit-castle', 'un-gwynedd', 'un-carcassonne'],
  'related' => ['gatehouse', 'great-hall', 'watchtower'],
],

'gatehouse' => [
  'name' => 'Gatehouse', 'latin' => 'portcullis and drawbridge', 'cat' => 'castle', 'src' => 'art/town_1.png',
  'summary' => 'A fortified gate between two towers, where guards decided who could come in and collected tolls.',
  'facts' => ['Used for' => 'Guarding the way in', 'Key defense' => 'A heavy grille called a portcullis', 'Also used for' => 'Collecting tolls on goods', 'Still standing' => 'Bodiam Castle (England), the Holstentor (Lübeck, Germany)'],
  'sections' => [
    ['What it was', [
      'Every castle and walled town had to let people in and out, so the gate was its weak spot. Builders turned it into a small fortress of its own: a gatehouse, with towers on both sides of a long passage.',
      'In a walled town, the gatehouse also controlled trade. Carts of goods paid a toll at the gate, and the gates were shut at night.',
    ]],
    ['How it worked', [
      'A gatehouse had layers of defense. A drawbridge could be raised over the ditch. Behind it, a portcullis, a heavy grille of wood and iron, slid down in grooves in the walls. Behind that were thick wooden doors. Some gatehouses had openings in the ceiling of the passage so defenders could drop things on attackers.',
      'Bodiam Castle in England, built in the 1380s, still has an original wooden portcullis, one of the oldest in the country.',
    ]],
    ['Town gates', [
      'Many towns had several gates, each named after the road or town it led to. The Holstentor in Lübeck, Germany, finished in 1478, became a symbol of the city. In Carcassonne, France, the double ring of walls still has its gates and 52 towers.',
    ]],
  ],
  'art' => 'This gatehouse shows the portcullis raised. Its banners and neat stonework are the artist\'s design.',
  'look' => ['Find the portcullis. Is it up or down?', 'Where would a guard stand to watch the road?'],
  'questions' => ['Why have several defenses one behind another instead of one strong door?', 'Why would a town shut its gates at night?', 'Where do people pay a toll today?'],
  'words' => ['Portcullis' => 'A heavy grille that slides down to block a gateway.', 'Drawbridge' => 'A bridge that can be raised.', 'Toll' => 'A fee paid to use a road, bridge or gate.'],
  'sources' => ['brit-castle', 'nt-bodiam', 'un-lubeck', 'un-carcassonne'],
  'related' => ['royal-castle', 'watchtower', 'market-hall'],
],

'watchtower' => [
  'name' => 'Watchtower', 'latin' => 'wall tower and watch', 'cat' => 'castle', 'src' => 'art/nt_tower.png',
  'summary' => 'A lookout where watchmen kept an eye on the roads and the town, day and night.',
  'facts' => ['Used for' => 'Watching for danger and fire', 'Who kept watch' => 'Townsmen taking turns, and paid watchmen', 'At night' => 'A curfew bell, then the night watch', 'Still standing' => 'The town walls of Conwy (Wales) and York (England)'],
  'sections' => [
    ['What it was', [
      'Towns and castles needed to see trouble coming. Towers along the walls gave watchmen a view far down the roads. In Conwy, Wales, the town walls built in the 1280s still run for about 1.3 kilometers with 21 towers.',
    ]],
    ['The night watch', [
      'In the evening a bell rang the curfew. The word comes from the French for "cover the fire": people were expected to cover their hearths for the night, because a fire left burning in a timber town could spread fast. After curfew, watchmen walked the streets and called out if they saw fire or trouble.',
      'Fire was one of the biggest dangers in a medieval town, so watchmen in towers looked out for smoke as much as for enemies.',
    ]],
  ],
  'art' => 'This is a simple timber watchtower on stone legs. Towers on real town walls were usually built of stone.',
  'look' => ['Find the platform where the watchman stands.', 'Which way would you look first?'],
  'questions' => ['What dangers do you think a watchman feared most?', 'Who keeps watch over your town at night today?', 'Why might fire spread so quickly in a medieval town?'],
  'words' => ['Curfew' => 'A time when everyone must be indoors; first, the time to cover the fire.', 'Watchman' => 'A person who guards a place, often at night.', 'Lookout' => 'A high place to watch from.'],
  'sources' => ['un-gwynedd', 'brit-curfew', 'brit-castle'],
  'related' => ['gatehouse', 'bell-tower', 'royal-castle'],
],

'great-hall' => [
  'name' => 'Great hall', 'latin' => 'hall', 'cat' => 'castle', 'src' => 'art/family_3.png',
  'summary' => 'The big room at the heart of a castle or manor, where the household ate, met and held court.',
  'facts' => ['Used for' => 'Meals, meetings, courts and celebrations', 'Heated by' => 'A fire in the middle of the floor, later a fireplace', 'Famous example' => 'Westminster Hall, London, built in 1097', 'Roof' => 'Huge timber beams'],
  'sections' => [
    ['What it was', [
      'For much of the Middle Ages, the hall was the most important room in any big house. The lord, his family, guests, servants and soldiers ate there together. At one end stood a raised platform, the dais, with the lord\'s table. Some of the household slept on benches in the hall at night.',
      'The hall was also where the lord did business: listening to complaints, settling quarrels and holding the manor court.',
    ]],
    ['How it was built', [
      'A wide hall needed a strong roof. Early halls had a fire in the middle of the floor and a vent in the roof to let the smoke out. Later, fireplaces with chimneys in the walls became common.',
      'Westminster Hall in London was built in 1097 for King William II. In the 1390s, King Richard II gave it a new hammer-beam roof, one of the largest medieval timber roofs in northern Europe. For centuries England\'s main law courts met in the hall, and it still stands beside the Houses of Parliament.',
    ]],
  ],
  'art' => 'The banners and courtyard well are the artist\'s design. Real halls were often part of a larger castle or manor house.',
  'look' => ['Find the big doors. Why would a hall need such wide doors?', 'Look for the banners.'],
  'questions' => ['Why might everyone in a household eat together in one room?', 'Where are disagreements settled in your town today?', 'How did people heat a big room before chimneys?'],
  'words' => ['Dais' => 'A raised platform at one end of a hall.', 'Hammer-beam roof' => 'A wooden roof that uses short beams to span a wide space.', 'Manor court' => 'A meeting where a lord or his steward settled local matters.'],
  'sources' => ['brit-hall', 'parl-westminster', 'brit-manor'],
  'related' => ['feast-hall', 'manor-house', 'kitchen'],
],

'knight-statue' => [
  'name' => 'Knight statue', 'latin' => 'knight and chivalry', 'cat' => 'castle', 'src' => 'art/nt_statue.png',
  'summary' => 'A stone knight with a shield: a reminder of the soldiers on horseback who served kings and lords.',
  'facts' => ['A knight was' => 'A trained soldier who fought on horseback', 'Training' => 'Page, then squire, then knight', 'Armor' => 'Chain mail, later plates of steel', 'Ideal' => 'Chivalry: brave, loyal and kind to the weak'],
  'sections' => [
    ['Who knights were', [
      'Knights were soldiers who fought on horseback in heavy armor. Horses, armor and weapons cost a great deal, so a knight was usually given land in return for serving his lord in war.',
      'A boy from a noble family might start as a page in a lord\'s household, learning manners and riding. As a teenager he became a squire, looking after a knight\'s horse and armor. When he was ready, often around the age of 21, he was knighted in a ceremony.',
    ]],
    ['Armor', [
      'Early knights wore chain mail: a shirt of thousands of small linked iron rings. By the 1400s the best-equipped knights wore full suits of steel plates. A full suit was spread over the whole body, so a fit knight could still run and climb in it, as collections like the Royal Armouries in Leeds show.',
    ]],
    ['Chivalry', [
      'Chivalry was the code knights were supposed to follow: to be brave, loyal and generous, to protect the church and people who could not protect themselves. Real knights did not always live up to it, but the idea of chivalry shaped stories and manners for centuries.',
    ]],
  ],
  'art' => 'This statue is the artist\'s own. In real churches you can see stone or brass figures of knights lying on their tombs.',
  'look' => ['Look at the shield. Which animal is on it?', 'Find the sword.'],
  'questions' => ['Which of the knightly virtues matter most to you?', 'Why would armor and horses make knights expensive?', 'Who do we put up statues of today, and why?'],
  'words' => ['Squire' => 'A young man who served a knight while training.', 'Chain mail' => 'Armor made of small linked iron rings.', 'Chivalry' => 'The ideal code of conduct for knights.'],
  'sources' => ['brit-knight', 'ra-armour'],
  'related' => ['tournament-field', 'training-yard', 'royal-castle'],
],

// ---------------- Churches and abbeys ----------------
'abbey' => [
  'name' => 'Abbey', 'latin' => 'monastery', 'cat' => 'church', 'src' => 'art/growth_3.png',
  'summary' => 'A community of monks or nuns who lived by a rule of prayer and work, with a great church at its center.',
  'facts' => ['Who lived there' => 'Monks or nuns, led by an abbot or abbess', 'Daily life' => 'Prayer, work and study', 'Also ran' => 'Farms, schools, guesthouses and care for the sick', 'Still standing' => 'Mont-Saint-Michel (France), Fountains and Rievaulx abbeys (England)'],
  'sections' => [
    ['What it was', [
      'An abbey was a monastery: a community of monks (or of nuns, in a convent) who gave their lives to God. Many followed the Rule of Saint Benedict, written in the 500s, which shaped a day of prayer, work and reading. The monks met in the church several times a day and night to pray and sing the psalms.',
      'At the center stood the abbey church. Beside it was the cloister, a covered walkway around a garden, which linked the dormitory, the dining hall and the chapter house where the monks met.',
    ]],
    ['More than a church', [
      'Abbeys were among the busiest places in medieval Europe. Monks farmed large estates, kept bees, brewed and baked, copied books, taught boys, gave food to the poor and looked after travelers and the sick. Cistercian monks became famous farmers and sheep keepers.',
    ]],
    ['Places you can still see', [
      'Fountains Abbey and Rievaulx Abbey in Yorkshire, England, were founded in 1132 and grew into some of the largest in the country. Their roofless walls stand today because English monasteries were closed in the 1530s under King Henry VIII. The abbey of Mont-Saint-Michel in France rises on a rocky island that the tide surrounds.',
    ]],
  ],
  'art' => 'The colored windows, bell tower and cloister garden are drawn in a simplified storybook style.',
  'look' => ['Find the cross on top of the tower.', 'Where is the cloister garden?'],
  'questions' => ['Why might a community choose to share its work and its meals?', 'Which jobs of an abbey are done by other places in your town today?', 'Why do you think so many abbeys were built in quiet valleys?'],
  'words' => ['Abbot' => 'The leader of an abbey of monks (abbess for nuns).', 'Cloister' => 'A covered walkway around a garden in a monastery.', 'Monk' => 'A man who lives in a religious community under vows.'],
  'sources' => ['brit-monastic', 'rule-benedict', 'un-fountains', 'eh-rievaulx', 'un-montstmichel'],
  'related' => ['scriptorium', 'herb-garden', 'chapel'],
],

'chapel' => [
  'name' => 'Stone chapel', 'latin' => 'parish church', 'cat' => 'church', 'src' => 'art/growth_2.png',
  'summary' => 'A small stone church where the village gathered on Sundays and feast days.',
  'facts' => ['Used for' => 'Worship, baptisms, weddings and funerals', 'Served' => 'A parish: one village or part of a town', 'Paid for by' => 'A tithe, one tenth of what people produced', 'Oldest still in use' => 'St Martin\'s Church, Canterbury (England)'],
  'sections' => [
    ['The heart of the village', [
      'Most villages in medieval Europe had a parish church, and it was often the only stone building around. Here people were baptized, married and buried. On Sundays and on the church\'s feast days, the whole village came to worship together.',
      'The church year shaped the calendar: Christmas, Easter and saints\' days were holidays (holy days), when people did not work in the fields.',
    ]],
    ['How it was paid for', [
      'Each household was expected to give a tithe, one tenth of its crops, animals or earnings, to support the church and its priest. Barns built to store this grain were called tithe barns, and some huge ones still stand.',
    ]],
    ['Places you can still see', [
      'St Martin\'s Church in Canterbury, England, has been used for Christian worship since the 500s and is described as the oldest church in the English-speaking world still in use. Thousands of small medieval parish churches are still used across Europe.',
    ]],
  ],
  'art' => 'This chapel is drawn small and neat. Many real parish churches grew bigger over the centuries as villages added towers, aisles and windows.',
  'look' => ['Find the bell cote, the little arch for the bell.', 'Look at the shape of the windows.'],
  'questions' => ['Why might a village build its strongest building as a church?', 'Where does your community gather for big events?', 'What does the word "holiday" tell us about where holidays came from?'],
  'words' => ['Parish' => 'The area served by one church and its priest.', 'Tithe' => 'One tenth of produce or earnings given to the church.', 'Bell cote' => 'A small frame for hanging a bell on a roof.'],
  'sources' => ['brit-parish', 'un-canterbury'],
  'related' => ['bell-tower', 'abbey', 'market-cross'],
],

'bell-tower' => [
  'name' => 'Bell tower', 'latin' => 'belfry', 'cat' => 'church', 'src' => 'art/town_2.png',
  'summary' => 'A tall tower whose great bell told the town the time, called people together and warned of fire.',
  'facts' => ['Used for' => 'Telling the time, calling meetings, giving alarms', 'Bells made of' => 'Bronze: copper and tin', 'Town belfries' => 'Built by towns in Flanders and northern France', 'Famous example' => 'The Belfry of Bruges (Belgium)'],
  'sections' => [
    ['The voice of the town', [
      'Before clocks and phones, bells told everyone what was happening. They rang for church services, for the start and end of the working day, for the curfew at night and for markets. A fast, wild ringing meant danger: fire, flood or attack.',
      'Bells were cast in bronze, a mix of copper and tin, by pouring hot metal into a mold, often right beside the church because big bells were so hard to move.',
    ]],
    ['Towers of freedom', [
      'In the towns of Flanders and northern France, citizens built their own belfries, separate from the church. A belfry showed that a town had won the right to run its own affairs. Its strongroom kept the town\'s charters and money safe. A group of 56 belfries in Belgium and France is now a World Heritage Site.',
      'The Belfry of Bruges, begun in the 1200s, is about 83 meters tall and has a carillon of 47 bells that plays tunes.',
    ]],
  ],
  'art' => 'Here the bell hangs in an open belfry on the tower of a small stone church. Town belfries in Flanders were often much taller and stood apart from the church.',
  'look' => ['Find the bell.', 'How would someone climb up to ring it?'],
  'questions' => ['What sounds tell you the time or warn you of danger today?', 'Why would a town want its own tower, not just the church\'s?', 'How far do you think a big bell could be heard?'],
  'words' => ['Belfry' => 'A bell tower, or the room in it where bells hang.', 'Carillon' => 'A set of bells played from a keyboard.', 'Bronze' => 'A metal made from copper and tin.'],
  'sources' => ['brit-bell', 'un-belfries', 'brit-curfew'],
  'related' => ['chapel', 'watchtower', 'market-cross'],
],

'market-cross' => [
  'name' => 'Market cross', 'latin' => 'market cross', 'cat' => 'trade', 'src' => 'art/monument.png',
  'summary' => 'A stone cross in the market square that marked where trading happened and reminded people to deal honestly.',
  'facts' => ['Used for' => 'Marking the market place', 'Also used for' => 'Announcements, meetings and preaching', 'Stood in' => 'The middle of the market square', 'Still standing' => 'Chichester, Malmesbury and Salisbury (England)'],
  'sections' => [
    ['What it was', [
      'Many market towns in Britain set up a stone cross in the market square. It marked the spot where trading took place, and the cross reminded buyers and sellers that God saw whether they dealt fairly.',
      'The cross was also where people gathered for news. Town criers read out announcements there, and preachers spoke to the crowds on market days.',
    ]],
    ['Places you can still see', [
      'Later market crosses grew into small open shelters where traders could keep dry. The market cross in Chichester, England, built around 1501, is a grand stone shelter with arches on eight sides. Malmesbury and Salisbury also have tall stone market crosses from the late Middle Ages.',
    ]],
  ],
  'art' => 'This cross stands on a stepped stone base, like many real ones. Its carving is the artist\'s design.',
  'look' => ['Count the steps of the base.', 'Who might sit on those steps on market day?'],
  'questions' => ['Why would a cross help remind people to be honest?', 'Where are announcements made in your town today?', 'What makes a good meeting place?'],
  'words' => ['Market square' => 'An open space where a market is held.', 'Town crier' => 'A person who called out news in the streets.', 'Charter' => 'A written grant of rights, like the right to hold a market.'],
  'sources' => ['brit-fair'],
  'related' => ['market-hall', 'bell-tower', 'chapel'],
],

// ---------------- Learning and books ----------------
'village-school' => [
  'name' => 'Village school', 'latin' => 'grammar school', 'cat' => 'learn', 'src' => 'art/knowledge_1.png',
  'summary' => 'A small school where boys learned Latin, reading, writing and singing, often taught by a priest.',
  'facts' => ['Taught' => 'Latin grammar, reading, writing and church music', 'Teachers' => 'Often priests or monks', 'Pupils' => 'Mostly boys, from about age 7', 'Old school still open' => 'Winchester College, England, founded in 1382'],
  'sections' => [
    ['Who went to school', [
      'Most medieval children never went to school. They learned at home, in the fields or as apprentices. But churches, abbeys and towns did run schools, and their number grew through the Middle Ages.',
      'Grammar schools taught Latin, the language of the church, the law and books all across Europe. Song schools taught boys to sing in church. Some girls learned to read at home or in convents.',
    ]],
    ['A school day', [
      'Pupils learned by repeating and remembering. Books were rare and costly, so the teacher often read aloud while pupils copied onto wax tablets with a pointed stick. Lessons could start at dawn and run most of the day.',
      'Winchester College in England was founded in 1382 by William of Wykeham, a bishop, to give 70 poor scholars a free education. It is still a school today.',
    ]],
  ],
  'art' => 'This small timber schoolhouse with benches and a slate board is the artist\'s own design.',
  'look' => ['Find the board by the door.', 'Where are the benches?'],
  'questions' => ['Why might Latin have been so important to learn?', 'How is your school day different from a medieval one?', 'What would you lose if you could not read?'],
  'words' => ['Grammar school' => 'A school that taught Latin grammar.', 'Wax tablet' => 'A wooden board covered with wax to write on and rub out.', 'Scholar' => 'A student.'],
  'sources' => ['winchester', 'brit-university'],
  'related' => ['scriptorium', 'university', 'chapel'],
],

'scriptorium' => [
  'name' => 'Scriptorium', 'latin' => 'scriptorium', 'cat' => 'learn', 'src' => 'art/knowledge_2.png',
  'summary' => 'The room where monks copied books by hand, letter by letter, before printing was invented.',
  'facts' => ['Used for' => 'Copying and decorating books by hand', 'Written on' => 'Parchment, made from animal skin', 'One book took' => 'Months or even years', 'Famous books' => 'The Book of Kells and the Lindisfarne Gospels'],
  'sections' => [
    ['What it was', [
      'Before printing, every book had to be written by hand. In monasteries, monks and nuns worked in a scriptorium, a writing room with good light, copying the Bible, prayer books and works of history, medicine and science. Much of what we know about the ancient world survives because they copied it.',
    ]],
    ['How a book was made', [
      'Pages were made of parchment, animal skin that was soaked, scraped and stretched until it was thin and smooth. Scribes wrote with quill pens made from feathers, dipped in ink made from things like oak galls and soot.',
    ], ['list' => [
      'Scribes ruled faint lines so the writing stayed straight.',
      'They copied the text, leaving spaces for pictures and big letters.',
      'Artists painted colorful pictures and borders, sometimes with gold leaf, which is why these books are called illuminated: they seem to shine.',
      'The pages were sewn together and bound between wooden boards covered in leather.',
    ]]],
    ['Books you can still see', [
      'The Lindisfarne Gospels, made in England around 700, are kept at the British Library. The Book of Kells, made around 800, is at Trinity College Dublin. Both are copies of the four Gospels about Jesus. Hand copying slowly gave way after Johannes Gutenberg began printing with movable type in the 1450s.',
    ]],
  ],
  'art' => 'The shelves of books and open door are drawn in a cozy storybook style. Real scriptoria were often part of a cloister.',
  'look' => ['Find the tall windows. Why would scribes want them?', 'Look for the shelves of books.'],
  'questions' => ['How long do you think it would take you to copy one book by hand?', 'Why was printing such a big change?', 'Which book would you choose to save for the future?'],
  'words' => ['Parchment' => 'Writing material made from animal skin.', 'Quill' => 'A pen made from a bird\'s feather.', 'Illuminated' => 'Decorated with bright colors and gold.'],
  'sources' => ['brit-manuscript', 'bl-lindisfarne', 'tcd-kells', 'brit-gutenberg'],
  'related' => ['abbey', 'university', 'village-school'],
],

'university' => [
  'name' => 'University hall', 'latin' => 'university and college', 'cat' => 'learn', 'src' => 'art/knowledge_3.png',
  'summary' => 'A college where students from many lands studied law, medicine, the arts and the Bible.',
  'facts' => ['First universities' => 'Bologna, Paris and Oxford, from the 1100s', 'Language of teaching' => 'Latin', 'Subjects' => 'Arts, law, medicine and theology', 'Oldest college buildings' => 'Merton College, Oxford, from the 1260s'],
  'sections' => [
    ['A new kind of school', [
      'Universities began in the Middle Ages. In cities such as Bologna, Paris and Oxford, teachers and students formed guilds to protect themselves and organize their studies. Teaching already existed at Oxford in some form by 1096. Because all lessons were in Latin, students could travel to study anywhere in Europe.',
      'Students first studied the arts: grammar, logic, rhetoric, arithmetic, geometry, music and astronomy. Then they could go on to law, medicine or theology, the study of God and the Bible.',
    ]],
    ['Colleges', [
      'At first students rented rooms around town. Then wealthy founders built colleges where students and teachers lived, ate and studied together around a courtyard. Merton College in Oxford was founded in 1264, and its Mob Quad, built in the 1300s, is one of the oldest college courtyards. The words "bachelor", "master" and "doctor" for degrees all come from medieval universities.',
    ]],
  ],
  'art' => 'This college with its cloister walks and clock tower is the artist\'s design, inspired by real old colleges.',
  'look' => ['Find the clock tower.', 'Where could students walk out of the rain?'],
  'questions' => ['Why would a common language like Latin help students travel?', 'What would you most like to study, and why?', 'Which words from medieval universities do we still use?'],
  'words' => ['University' => 'A community of teachers and students; it comes from the Latin for "the whole".', 'College' => 'A place where students live and study together.', 'Theology' => 'The study of God and religious belief.'],
  'sources' => ['brit-university', 'ox-history'],
  'related' => ['scriptorium', 'village-school', 'guild-hall'],
],

// ---------------- Markets, crafts and guilds ----------------
'market-hall' => [
  'name' => 'Market hall', 'latin' => 'market and fair', 'cat' => 'trade', 'src' => 'art/business_3.png',
  'summary' => 'An open hall on arches where traders sold their goods, with a meeting room upstairs.',
  'facts' => ['Market day' => 'Usually once a week', 'Right to hold one' => 'Granted by a charter from the king or a lord', 'Bigger events' => 'Fairs, a few times a year', 'Still standing' => 'The Cloth Hall in Kraków (Poland), Thaxted Guildhall (England)'],
  'sections' => [
    ['Market day', [
      'A town needed a market. On market day, usually once a week, farmers brought eggs, cheese, grain and animals into town, and townspeople sold cloth, shoes, pots and tools. In England a town needed a charter, a written grant from the king or a lord, to hold a market, and the lord collected fees from the traders.',
      'Officials checked that weights and measures were honest, and sellers who cheated could be fined or shamed in public.',
    ]],
    ['Halls on arches', [
      'Many towns built market halls: an open space under arches on the ground floor, where traders set up stalls in the dry, and a room above for the town council or a guild. Thaxted Guildhall in England, from the 1400s, is built this way.',
      'Big trading cities built grand cloth halls. The Cloth Hall in the main square of Kraków, Poland, began as a covered market in the 1200s.',
    ]],
    ['Fairs', [
      'A few times a year, bigger fairs drew merchants from far away with spices, silk, wine and fine cloth. The fairs of Champagne in France linked traders from Italy and northern Europe.',
    ]],
  ],
  'art' => 'This hall with its stalls under stone arches is the artist\'s design, close to real market halls.',
  'look' => ['Find the stalls under the arches.', 'What might be sold here?'],
  'questions' => ['Why would traders want to sell in a covered hall?', 'Why was it important to check weights and measures?', 'Where does your family buy food, and how often?'],
  'words' => ['Charter' => 'A written grant of rights, such as the right to hold a market.', 'Fair' => 'A large market held a few times a year.', 'Stall' => 'A table or booth for selling goods.'],
  'sources' => ['brit-fair', 'un-krakow'],
  'related' => ['market-cross', 'guild-hall', 'bakery'],
],

'bakery' => [
  'name' => 'Bakery', 'latin' => 'bakehouse', 'cat' => 'trade', 'src' => 'art/business_1.png',
  'summary' => 'A bakehouse with a big oven, where bread, the most important food of all, was baked every day.',
  'facts' => ['Main food' => 'Bread, eaten at every meal', 'Grains' => 'Wheat, rye, barley and oats', 'Rules' => 'Laws fixed the weight and price of a loaf', 'In villages' => 'Often one shared oven owned by the lord'],
  'sections' => [
    ['Daily bread', [
      'Bread was the main food for most people in medieval Europe. Wealthy people ate fine white wheat bread; poorer people ate darker bread of rye, barley or mixed grains.',
      'Big ovens needed lots of fuel, and fires were dangerous in timber towns, so many families did not bake at home. In towns they bought from bakers. In many villages, the lord owned the only oven and the mill, and villagers had to pay to use them, a right called banalité in France.',
    ]],
    ['Honest loaves', [
      'Because bread was so important, it was strictly controlled. In England, the Assize of Bread and Ale tied the weight of a loaf to the price of wheat. Bakers who sold loaves that were too light could be fined or put in the pillory. Some people think this is why bakers began giving 13 loaves for a dozen, the "baker\'s dozen", to be safe.',
    ]],
  ],
  'art' => 'The round oven, loaves on the counter and bread sign are drawn in a friendly storybook way.',
  'look' => ['Find the oven.', 'Look at the sign. How does it show what is sold without any words?'],
  'questions' => ['Why would a shop sign use a picture instead of words?', 'Why did the price and weight of bread matter so much?', 'What food do you eat at almost every meal?'],
  'words' => ['Assize' => 'A law setting standards, such as the weight of bread.', 'Pillory' => 'A wooden frame that held a person for public shaming.', 'Rye' => 'A grain that grows well in cold places.'],
  'sources' => ['assize-bread', 'brit-banalite'],
  'related' => ['windmill', 'market-hall', 'kitchen'],
],

'guild-hall' => [
  'name' => 'Guild hall', 'latin' => 'guild', 'cat' => 'trade', 'src' => 'art/business_2.png',
  'summary' => 'The meeting place of a guild, a group of craftsmen or merchants who set rules for their trade.',
  'facts' => ['A guild was' => 'An association of people in the same trade', 'Ranks' => 'Apprentice, journeyman, master', 'Guilds also' => 'Helped members who were sick or poor, and put on plays', 'Still standing' => 'The Merchant Adventurers\' Hall in York (England)'],
  'sections' => [
    ['What guilds did', [
      'In medieval towns, people who did the same work often joined a guild: bakers, weavers, goldsmiths, masons and many more. Merchant guilds organized traders. Guilds set prices and standards of quality, checked work, and decided who could practice the trade in town.',
      'Guilds also looked after their members. They helped families when someone was sick or died, paid for funerals and prayers, and held feasts on their saint\'s day.',
    ]],
    ['From apprentice to master', [
      'A boy, and sometimes a girl, learned a trade as an apprentice, living with a master\'s family for several years, often seven. Next he worked for wages as a journeyman. To become a master with his own workshop, he might have to show the guild a fine piece of work: his "masterpiece".',
    ]],
    ['Halls and plays', [
      'Rich guilds built halls for their meetings. The Merchant Adventurers\' Hall in York, England, built from 1357, is one of the finest timber-framed guild halls in Europe. In York, the guilds also put on the Mystery Plays: each guild acted one scene from the Bible on a wagon stage, from the creation of the world to the story of Jesus.',
    ]],
  ],
  'art' => 'The carved beams and painted shields with tool shapes are the artist\'s design. Real guilds did use coats of arms with the tools of their trade.',
  'look' => ['Look at the shields. Which tools can you see?', 'Count the floors.'],
  'questions' => ['Why might people in the same job want to work together?', 'What would you choose as your masterpiece?', 'What groups today do the jobs that guilds once did?'],
  'words' => ['Apprentice' => 'A young person learning a trade from a master.', 'Journeyman' => 'A trained worker paid by the day.', 'Masterpiece' => 'A piece of work that proves a person has mastered a craft.'],
  'sources' => ['brit-guild', 'york-guild', 'york-plays'],
  'related' => ['market-hall', 'blacksmith', 'merchants-house'],
],

'blacksmith' => [
  'name' => 'Blacksmith', 'latin' => 'smithy and forge', 'cat' => 'trade', 'src' => 'art/nt_shop.png',
  'summary' => 'A forge where the smith heated iron until it glowed and hammered it into tools, nails and horseshoes.',
  'facts' => ['Made' => 'Tools, nails, hinges, horseshoes and plow parts', 'Tools of the trade' => 'Forge, bellows, anvil, hammer and tongs', 'Metal' => 'Wrought iron', 'A name that lasts' => 'Smith is one of the most common surnames in English'],
  'sections' => [
    ['What a smith did', [
      'Almost every village had a smith. Farmers needed plowshares, sickles and scythes; builders needed nails and hinges; horses needed shoes. The smith made and mended them all.',
      'The word "black" refers to iron, the black metal, while goldsmiths and silversmiths worked with bright metals.',
    ]],
    ['How it worked', [
      'The smith heated iron in a charcoal fire, blowing air in with leather bellows to make it hotter. When the iron glowed orange it became soft enough to shape. On the anvil, the smith hammered it, bent it and cut it, then plunged it into water to cool it.',
      'Two pieces of hot iron could be joined by hammering them together, called forge welding. A good smith could judge the heat just from the color of the glowing metal.',
    ]],
  ],
  'art' => 'This forge with its glowing furnace, anvil and tools on the wall is drawn in an open, cozy style.',
  'look' => ['Find the anvil.', 'Where is the fire?'],
  'questions' => ['Which iron things would a village need most?', 'Why do you think "Smith" became such a common name?', 'What metal objects do you use every day?'],
  'words' => ['Anvil' => 'A heavy iron block on which metal is hammered.', 'Bellows' => 'A tool that blows air into a fire.', 'Forge' => 'A furnace for heating metal, or a smith\'s workshop.'],
  'sources' => ['brit-iron'],
  'related' => ['guild-hall', 'farmstead', 'horse-and-rider'],
],

'merchants-house' => [
  'name' => 'Merchant\'s house', 'latin' => 'town merchant', 'cat' => 'trade', 'src' => 'art/home_b.png',
  'summary' => 'A comfortable town house where a trader lived above the shop and stored goods below.',
  'facts' => ['Ground floor' => 'Shop or counting room', 'Below' => 'A cellar for storing goods', 'Upstairs' => 'The family\'s rooms', 'Trading networks' => 'The Hanseatic League linked towns from London to Novgorod'],
  'sections' => [
    ['Living above the shop', [
      'Merchants bought goods in one place and sold them in another: wool, cloth, wine, salt, fish, spices and timber. A successful merchant lived in a solid house in the center of town. The family lived upstairs, the shop faced the street, and goods were kept safe and cool in a cellar or undercroft.',
    ]],
    ['Trade across Europe', [
      'From the 1200s, merchant towns around the North Sea and the Baltic Sea joined in the Hanseatic League to protect their trade. Lübeck in Germany was its leading city. In Bergen, Norway, the old Hanseatic wharf called Bryggen still has rows of wooden merchant buildings, now a World Heritage Site.',
      'Merchants kept careful accounts. Bills of exchange, early forms of checks, let them pay for goods without carrying chests of coins on dangerous roads.',
    ]],
  ],
  'art' => 'The flower boxes and bench by the door are the artist\'s cheerful design.',
  'look' => ['Find the window boxes.', 'Where might the goods be stored?'],
  'questions' => ['Why might merchants want to live right above their shops?', 'Why was carrying lots of coins on the road risky?', 'Where do the things in your home come from?'],
  'words' => ['Merchant' => 'A person who buys and sells goods.', 'Undercroft' => 'A cellar under a building, often vaulted.', 'League' => 'A group that joins together for a shared purpose.'],
  'sources' => ['brit-hansa', 'un-lubeck', 'un-bryggen'],
  'related' => ['guild-hall', 'market-hall', 'covered-wagon'],
],

// ---------------- Farms and food ----------------
'windmill' => [
  'name' => 'Windmill', 'latin' => 'post mill', 'cat' => 'land', 'src' => 'art/nt_workshop.png',
  'summary' => 'A mill whose big sails caught the wind to turn heavy stones and grind grain into flour.',
  'facts' => ['Used for' => 'Grinding grain into flour', 'In Europe from' => 'The late 1100s', 'Powered by' => 'Wind (watermills used rivers)', 'The miller was paid' => 'With a share of the grain'],
  'sections' => [
    ['From grain to flour', [
      'Bread needs flour, and grinding grain by hand is slow, hard work. Mills used the power of water or wind instead. When England\'s great survey, the Domesday Book, was made in 1086, it already listed thousands of watermills.',
      'Windmills appeared in northwestern Europe in the late 1100s. They were useful where rivers were slow or froze in winter.',
    ]],
    ['How a post mill worked', [
      'The earliest European windmills were post mills. The whole wooden body of the mill sat on one strong upright post, so the miller could push it around with a long tail pole to face the wind.',
    ], ['list' => [
      'The wind turned the sails, which were wooden frames covered with cloth.',
      'The sails turned a shaft and wooden gears inside the mill.',
      'The gears turned a heavy upper millstone against a lower one that stayed still.',
      'Grain poured in through a hole in the top stone and came out at the edge as flour.',
    ]]],
    ['The miller', [
      'Millers were usually paid by keeping a share of the grain, called multure. In many places the lord owned the mill and tenants had to grind there. A picture of a windmill in an English prayer book from around 1270 gave it its name: the Windmill Psalter.',
    ]],
  ],
  'art' => 'This mill is drawn as a stone tower mill, a type that became common later. Early medieval windmills were wooden post mills.',
  'look' => ['Count the sails.', 'Find the sacks of flour by the door.'],
  'questions' => ['Why would a miller need to turn a mill to face the wind?', 'What other jobs could wind or water power do?', 'Where does the flour in your kitchen come from?'],
  'words' => ['Millstone' => 'A heavy round stone used for grinding grain.', 'Post mill' => 'A windmill that turns on a single upright post.', 'Multure' => 'The share of grain kept by a miller as payment.'],
  'sources' => ['brit-windmill', 'tna-domesday', 'morgan-windmill', 'brit-banalite'],
  'related' => ['bakery', 'farmstead', 'hay-cart'],
],

'farmstead' => [
  'name' => 'Farmstead', 'latin' => 'open fields', 'cat' => 'land', 'src' => 'art/family_1.png',
  'summary' => 'A family farm with chickens, a cart and strips of land in the big open fields around the village.',
  'facts' => ['Most people were' => 'Farmers', 'Fields' => 'Large open fields split into long strips', 'Crop plan' => 'Three fields: wheat, then peas or oats, then rest', 'Plowing' => 'With teams of oxen'],
  'sections' => [
    ['Life on the land', [
      'Nine out of ten people in medieval Europe lived in the countryside, and most were farmers. Many were serfs, or villeins, who were tied to the lord\'s land: they farmed their own strips but also had to work on the lord\'s fields for part of the week.',
    ]],
    ['Open fields', [
      'Around many villages lay two or three huge open fields without hedges. Each field was divided into long, narrow strips, and each family farmed strips scattered across the fields, so everyone shared good and poor land.',
      'Fields took turns. In the three-field system, one field grew wheat or rye, the second grew peas, beans, oats or barley, and the third rested, so the soil could recover. Plowing the strips year after year left a pattern of ridges you can still see in some English fields today, called ridge and furrow.',
      'A beautiful English prayer book, the Luttrell Psalter, from around 1330, shows farm life in its margins: plowing with oxen, sowing, harvesting and carting.',
    ]],
    ['The Black Death', [
      'From 1347 to 1351, a terrible plague, the Black Death, swept across Europe and killed perhaps a third or more of the people. With so few workers left, the survivors could ask for better pay, and the old ties of serfdom began to break down.',
    ]],
  ],
  'art' => 'This cozy cottage with a chicken coop and cart stands for a family farm. Real farmhouses usually stood together in the village, with the fields outside.',
  'look' => ['Find the chicken coop.', 'What is the cart for?'],
  'questions' => ['Why would families share good and poor land?', 'Why let a field rest for a year?', 'How did the Black Death change life for workers who survived?'],
  'words' => ['Serf' => 'A farmer tied to a lord\'s land.', 'Fallow' => 'Plowed land left unplanted for a season to rest.', 'Ridge and furrow' => 'Long ridges left in fields by medieval plowing.'],
  'sources' => ['brit-openfield', 'brit-manor', 'bl-luttrell', 'brit-blackdeath'],
  'related' => ['windmill', 'peasant-cottage', 'hay-cart'],
],

'shepherds-cottage' => [
  'name' => 'Shepherd\'s cottage', 'latin' => 'wool trade', 'cat' => 'land', 'src' => 'art/floor_s.png',
  'summary' => 'A small stone cottage for a shepherd, who looked after the sheep whose wool made England rich.',
  'facts' => ['Sheep gave' => 'Wool, milk, meat and manure for the fields', 'Main export' => 'English wool, sold to weavers in Flanders and Italy', 'Shearing time' => 'Early summer', 'A seat of wool' => 'The Woolsack in the House of Lords'],
  'sections' => [
    ['Sheep and wool', [
      'Sheep were some of the most useful animals on a medieval farm. They gave wool for clothes, milk for cheese, meat, and manure that made the fields richer. Shepherds watched the flocks on hills and commons, protecting them from wolves and thieves and helping with lambing in spring.',
    ]],
    ['Wealth from wool', [
      'For centuries, English wool was famous across Europe. Merchants shipped it to the busy weaving towns of Flanders and Italy, and taxes on wool helped pay for the king\'s government.',
      'Since the 1300s, the Lord Speaker in the House of Lords has sat on the Woolsack, a large cushion stuffed with wool, as a reminder of how important wool was to England.',
      'In towns like Lavenham in Suffolk, rich wool and cloth merchants paid for grand churches, sometimes called wool churches.',
    ]],
  ],
  'art' => 'This small stone cottage with a thatched roof is the artist\'s design. Shepherds on high pastures often lived in simple huts.',
  'look' => ['Find the flower box.', 'What is the roof made of?'],
  'questions' => ['How many different things did sheep give a village?', 'Why might a government care so much about wool?', 'What are your clothes made of?'],
  'words' => ['Shearing' => 'Cutting the wool off a sheep.', 'Flock' => 'A group of sheep.', 'Woolsack' => 'The wool-stuffed seat of the Lord Speaker in the House of Lords.'],
  'sources' => ['brit-wool', 'parl-woolsack'],
  'related' => ['farmstead', 'merchants-house', 'market-hall'],
],

'orchard' => [
  'name' => 'Orchard', 'latin' => 'orchard', 'cat' => 'land', 'src' => 'art/nt_garden.png',
  'summary' => 'Rows of apple and pear trees that gave fruit to eat fresh, dry for winter or press into cider.',
  'facts' => ['Fruit' => 'Apples, pears, cherries, plums and quinces', 'Kept for winter' => 'Dried, stored or pressed into cider', 'Often found at' => 'Monasteries, manors and castles', 'Old apple word' => '"Costard", a big apple, gave us "costermonger"'],
  'sections' => [
    ['Fruit for the year', [
      'Medieval orchards grew apples, pears, cherries, plums, quinces and medlars. Fresh fruit was a treat in late summer and autumn. To make it last, people dried it, stored hard apples in cool lofts, and pressed apples into cider and pears into perry.',
      'Monasteries, manors and castles often had orchards inside or beside their walls, which kept the fruit safe from thieves and animals.',
    ]],
    ['Apples with names', [
      'People already grew different kinds of apples with their own names. One was the costard, a large apple. Street sellers of apples were called costardmongers, which became "costermonger", an English word still used for someone who sells fruit from a cart or stall.',
      'Gardeners knew how to graft: they joined a twig from a good tree onto the roots of another, so the new tree gave the same fruit. Fruit growers still do this today.',
    ]],
  ],
  'art' => 'The three apple trees, ladder and basket are drawn full of ripe red apples at harvest time.',
  'look' => ['Find the ladder.', 'How many apples can you count in the basket?'],
  'questions' => ['How could a family keep fruit for the winter without a fridge?', 'Why would an abbey or castle grow its orchard inside its walls?', 'What fruit grows near where you live?'],
  'words' => ['Graft' => 'To join part of one plant onto another so they grow together.', 'Cider' => 'A drink made from pressed apples.', 'Costermonger' => 'A person who sells fruit and vegetables from a cart.'],
  'sources' => ['mw-costard', 'stgall-plan'],
  'related' => ['herb-garden', 'kitchen', 'farmstead'],
],

'herb-garden' => [
  'name' => 'Herb garden', 'latin' => 'physic garden', 'cat' => 'land', 'src' => 'art/growth_1.png',
  'summary' => 'Neat beds of herbs grown for cooking, medicine and sweet smells, with beehives for honey and wax.',
  'facts' => ['Grew' => 'Sage, rosemary, mint, fennel, lavender and more', 'Used for' => 'Medicine, cooking and freshening rooms', 'Beehives gave' => 'Honey for sweetening and wax for candles', 'Early plan' => 'The Plan of Saint Gall, about 820'],
  'sections' => [
    ['A garden that healed', [
      'Monasteries cared for the sick, and their gardens were their pharmacy. Monks and nuns grew herbs in small, neat beds and made them into drinks, ointments and medicines. A famous plan for an ideal monastery, drawn around 820 and kept at the abbey library of St. Gallen in Switzerland, shows a medicine garden with 16 beds, each labeled with a plant, next to the doctor\'s house.',
      'The abbess Hildegard of Bingen, who lived from 1098 to 1179, wrote books about plants, animals and healing, as well as music and visions.',
    ]],
    ['Bees', [
      'Most gardens had beehives woven from straw, called skeps. Honey was the main sweetener before sugar became common, and churches needed beeswax for candles.',
    ]],
  ],
  'art' => 'The walled garden with herb beds, a stone path, beehives and a bench is the artist\'s design, much like real monastery gardens.',
  'look' => ['Find the beehives.', 'Count the herb beds.'],
  'questions' => ['Why might a garden be the first place to look for medicine?', 'Which herbs do you know? What are they used for?', 'Why were bees so valuable?'],
  'words' => ['Herb' => 'A plant used for flavor, scent or medicine.', 'Skep' => 'A woven straw beehive.', 'Infirmary' => 'A place in a monastery for caring for the sick.'],
  'sources' => ['stgall-plan', 'un-stgall', 'brit-hildegard'],
  'related' => ['abbey', 'orchard', 'kitchen'],
],

// ---------------- Homes ----------------
'peasant-cottage' => [
  'name' => 'Peasant cottage', 'latin' => 'cruck house', 'cat' => 'homes', 'src' => 'art/home_a.png',
  'summary' => 'A thatched home of timber and woven sticks plastered with mud, with a vegetable patch outside.',
  'facts' => ['Walls' => 'Wattle and daub: woven sticks covered in clay', 'Roof' => 'Thatch of straw or reeds', 'Heating' => 'An open fire in the middle of the floor', 'Can be explored at' => 'Wharram Percy, a deserted village in England'],
  'sections' => [
    ['How it was built', [
      'Most families lived in small houses made from local materials. The frame was timber, often made from pairs of curved beams called crucks. Between the posts, builders wove thin sticks into panels (wattle) and covered them with a sticky mix of clay, dung and straw (daub). The roof was thatched with straw or reeds.',
      'A thatched roof kept the rain out well, but it could catch fire easily, so towns sometimes made rules against thatch.',
    ]],
    ['Inside', [
      'Many cottages had just one or two rooms. A fire burned on a hearth in the middle of the floor, for warmth and cooking, and smoke drifted up through the thatch. Furniture was simple: a table, benches, a chest and straw-filled mattresses. In some longhouses, the family lived at one end and the animals at the other in winter.',
      'Outside was a yard and garden for vegetables like cabbage, onions, leeks and beans.',
    ]],
    ['What archaeologists found', [
      'At Wharram Percy in Yorkshire, archaeologists spent decades studying a village that was abandoned around 1500. They found that peasant houses were rebuilt every generation or so, because timber and clay did not last forever.',
    ]],
  ],
  'art' => 'This cottage, with smoke curling from a chimney, is a cozy storybook version. Many real peasant homes had no chimney at all.',
  'look' => ['Find the vegetable patch.', 'Where is the smoke coming from?'],
  'questions' => ['Why build with local materials like clay, sticks and straw?', 'What would it be like to live in one room with a fire in the middle?', 'Why might a house need rebuilding every generation?'],
  'words' => ['Wattle and daub' => 'Woven sticks covered in clay, used for walls.', 'Thatch' => 'A roof made of straw or reeds.', 'Hearth' => 'The floor of a fireplace, or a fire on the floor.'],
  'sources' => ['brit-timber', 'eh-wharram', 'brit-manor'],
  'related' => ['farmstead', 'town-house', 'kitchen'],
],

'town-house' => [
  'name' => 'Town house', 'latin' => 'timber-framed house', 'cat' => 'homes', 'src' => 'art/floor_m.png',
  'summary' => 'A tall timber-framed house with upper floors that jut out over the street.',
  'facts' => ['Frame' => 'Oak beams, with plaster between them', 'Upper floors' => 'Jutting out, called jetties', 'Ground floor' => 'Often a shop or workshop', 'Still standing' => 'The Shambles in York (England), Rothenburg (Germany)'],
  'sections' => [
    ['Building up', [
      'Inside a town\'s walls, land was scarce and expensive, so houses were built narrow and tall. Many were timber-framed: a skeleton of oak beams fitted together with wooden pegs, with the gaps filled by wattle and daub or brick and covered in white plaster. The dark beams and white panels are why some people call them black-and-white houses.',
    ]],
    ['Jetties', [
      'In many towns, each upper floor stuck out a little further than the one below. These overhangs are called jetties. They gave more room upstairs without taking more land, and the weight of the overhang helped hold the floor beams steady.',
      'In the Shambles, an old street in York, England, some houses from the 1300s lean so far over the street that people upstairs could almost shake hands across it. Its name comes from the "shambles", the benches where butchers once sold meat.',
    ]],
  ],
  'art' => 'The stone ground floor, white plaster, dark beams and red tile roof follow real timber-framed houses.',
  'look' => ['Find the floors that jut out.', 'Count the windows.'],
  'questions' => ['Why do you think the upper floors stick out?', 'What problems might narrow streets with overhanging houses cause?', 'Are there old buildings in your town? What are they made of?'],
  'words' => ['Timber-framed' => 'Built with a frame of wooden beams.', 'Jetty' => 'An upper floor that sticks out over the one below.', 'Plaster' => 'A smooth coating for walls.'],
  'sources' => ['brit-timber'],
  'related' => ['merchants-house', 'tower-house', 'peasant-cottage'],
],

'tower-house' => [
  'name' => 'Tower house', 'latin' => 'tower house', 'cat' => 'homes', 'src' => 'art/floor_l.png',
  'summary' => 'A tall, narrow stone home built like a small fortress, with a room on each floor.',
  'facts' => ['Shape' => 'Tall and narrow, a room on each floor', 'Built for' => 'Safety, and to show off a family\'s wealth', 'Famous town of towers' => 'San Gimignano, Italy', 'Also found in' => 'Ireland and Scotland'],
  'sections' => [
    ['Homes like towers', [
      'In some places, wealthy families built their homes as tall stone towers. Each floor held one room, linked by a stair. The door was often high above the ground, and the thick walls had small windows, so a family could shelter from raids or feuding neighbors.',
    ]],
    ['Towns of towers', [
      'In the Italian town of San Gimignano, rich families competed to build the tallest towers as a sign of their power. There were once about 72; 14 still stand today, and the town\'s historic center is a World Heritage Site. In Bologna, the Asinelli tower, built in the 1100s, is about 97 meters tall.',
      'In Ireland and Scotland, thousands of smaller tower houses were built in the late Middle Ages as homes for local lords.',
    ]],
  ],
  'art' => 'This tower house has a blue slate cone roof and a pennant, a fairy-tale touch. Real tower houses usually had flat or pitched roofs behind battlements.',
  'look' => ['Find the battlements near the top.', 'Look at the small arched windows. Why are they so small?'],
  'questions' => ['Would you like to live in a tower? Why or why not?', 'Why might families show off by building taller?', 'What do tall buildings in your city say about the people who built them?'],
  'words' => ['Tower house' => 'A tall fortified home.', 'Feud' => 'A long quarrel between families.', 'Spiral stair' => 'A stair that winds around a central post.'],
  'sources' => ['un-sangimignano', 'brit-castle'],
  'related' => ['royal-castle', 'town-house', 'watchtower'],
],

'manor-house' => [
  'name' => 'Manor house', 'latin' => 'manor', 'cat' => 'homes', 'src' => 'art/family_2.png',
  'summary' => 'The home of the lord of the manor, the center of a farming estate and its village.',
  'facts' => ['Lived there' => 'The lord of the manor and his household', 'A manor was' => 'An estate with a village, fields and woods', 'Held there' => 'The manor court', 'Still standing' => 'Stokesay Castle, a fortified manor house in England'],
  'sections' => [
    ['The manor', [
      'Much of the countryside was divided into manors. Each manor had a lord, who might be a knight, a noble, a bishop or an abbey. The lord kept some land for himself, called the demesne, and let the rest to villagers in return for rent, crops or work.',
      'The manor house was the lord\'s home and the center of the estate, with its hall, kitchen, barns, stables and often a chapel and a dovecote.',
    ]],
    ['A fortified home', [
      'Stokesay Castle in Shropshire, England, is one of the best-preserved medieval manor houses. It was built in the 1280s by Laurence of Ludlow, a rich wool merchant, with a great hall and a strong tower, and a moat around it for safety.',
    ]],
  ],
  'art' => 'This stone manor with a timber upper floor, walled garden and gate is the artist\'s design.',
  'look' => ['Find the chimneys.', 'Where is the gate in the garden wall?'],
  'questions' => ['What did villagers give the lord, and what did the lord give them?', 'Why would a rich merchant want a home that looked like a castle?', 'Who looks after the land around your town?'],
  'words' => ['Manor' => 'An estate run by a lord, with a village and land.', 'Demesne' => 'The part of a manor the lord kept for himself.', 'Dovecote' => 'A building for keeping doves and pigeons.'],
  'sources' => ['brit-manor', 'eh-stokesay'],
  'related' => ['great-hall', 'farmstead', 'peasant-cottage'],
],

// ---------------- Halls, kitchens and wells ----------------
'feast-hall' => [
  'name' => 'Feast hall', 'latin' => 'feast', 'cat' => 'hall', 'src' => 'art/shared_3.png',
  'summary' => 'A hall with a long table set for a feast, when a lord or guild celebrated with music and many dishes.',
  'facts' => ['Feast days' => 'Christmas, Easter and saints\' days', 'Plates' => 'Often thick slices of old bread called trenchers', 'Eaten with' => 'Knives, spoons and fingers', 'Recipe book' => 'The Forme of Cury, about 1390'],
  'sections' => [
    ['A medieval feast', [
      'On great feast days like Christmas and Easter, lords, abbeys and guilds held feasts. The lord and important guests sat at the high table, and everyone else at long tables down the hall. Musicians played, and servants carried in course after course: roast meats, pies, fish on fasting days, soups, jellies and sweet dishes spiced with ginger, cinnamon and saffron.',
      'People ate with knives, spoons and their fingers; forks were rare. Food was often served on trenchers, thick slices of stale bread that soaked up the juices and could be given to the poor afterward.',
    ]],
    ['Recipes', [
      'Around 1390, the cooks of King Richard II wrote down their recipes in a book called The Forme of Cury ("the method of cooking"). It is one of the oldest cookbooks in English and has recipes for things like blancmange, a dish of rice, almond milk and chicken.',
    ]],
  ],
  'art' => 'The open doors show the long feast table inside. The banners and windows are the artist\'s design.',
  'look' => ['Find the long table through the doors.', 'Look at the banners.'],
  'questions' => ['How was a feast day different from an ordinary day?', 'Why do you think trenchers made of bread were useful?', 'What special meals does your family share, and when?'],
  'words' => ['Trencher' => 'A thick slice of bread used as a plate.', 'High table' => 'The table for the most important people at a feast.', 'Course' => 'One part of a meal, served at one time.'],
  'sources' => ['forme-cury', 'brit-hall'],
  'related' => ['great-hall', 'kitchen', 'guild-hall'],
],

'kitchen' => [
  'name' => 'Kitchen and hearth', 'latin' => 'kitchen', 'cat' => 'hall', 'src' => 'art/shared_1.png',
  'summary' => 'An open cooking hearth with a big pot. Big houses often built their kitchens apart, in case of fire.',
  'facts' => ['Everyday food' => 'Bread and pottage, a thick soup', 'Cooked over' => 'An open fire', 'Built apart' => 'To keep fire away from the hall', 'Still standing' => 'The Abbot\'s Kitchen at Glastonbury Abbey (England)'],
  'sections' => [
    ['Cooking over fire', [
      'All cooking was done over open fire. Cooks hung iron pots on chains or hooks over the flames, roasted meat on long spits that someone had to turn by hand, and baked in brick or stone ovens.',
      'For most families, the everyday meal was bread and pottage: a thick soup of grains, beans, peas and vegetables like leeks and cabbage, with a little meat or fish when they could get it.',
    ]],
    ['Kitchens apart', [
      'In castles, manors and abbeys, the kitchen was often a separate building or stood at the end of the hall, so that if it caught fire the rest would be safe. The Abbot\'s Kitchen at Glastonbury Abbey in England, built in the 1300s, is a stone building with a fireplace in each corner and a tall roof that let out the heat and smoke.',
    ]],
  ],
  'art' => 'This open-sided shelter with a stone fireplace, benches and cooking pot is the artist\'s design.',
  'look' => ['Find the cooking pot.', 'Where would the smoke go?'],
  'questions' => ['Why build a kitchen away from the main house?', 'What could you cook with only a fire and one pot?', 'What do you think pottage tasted like?'],
  'words' => ['Pottage' => 'A thick soup of grains and vegetables.', 'Spit' => 'A long rod for roasting meat over a fire.', 'Hearth' => 'The floor of a fireplace.'],
  'sources' => ['glastonbury', 'forme-cury'],
  'related' => ['feast-hall', 'bakery', 'village-well'],
],

'village-well' => [
  'name' => 'Village well', 'latin' => 'well and conduit', 'cat' => 'hall', 'src' => 'art/fountain.png',
  'summary' => 'A stone well with a roof, rope and bucket, where people drew water every day.',
  'facts' => ['Water came from' => 'Wells, springs and rivers', 'Fetched by' => 'Often women and children, every day', 'Piped water' => 'Some abbeys and towns built lead pipes', 'Early plan' => 'Canterbury Cathedral\'s water system, drawn in the 1100s'],
  'sections' => [
    ['Drawing water', [
      'Every household needed water for drinking, cooking, washing and animals. Villages dug wells down to the water underground and lined them with stone. A rope and bucket, sometimes wound up on a wooden roller, lifted the water. Fetching it was a daily job, and the well was a place where neighbors met and talked.',
      'People also drank weak ale, which was made by boiling, but water was used every day too.',
    ]],
    ['Water in pipes', [
      'Some abbeys and towns built water systems with lead pipes. A drawing from the 1100s, in a prayer book called the Eadwine Psalter, shows how Canterbury Cathedral brought spring water through pipes to its buildings, with tanks to let the water settle. In London, from 1245, a conduit piped spring water to a fountain house in Cheapside.',
    ]],
  ],
  'art' => 'This round well with a little wooden roof is drawn much like real village wells.',
  'look' => ['Find the bucket.', 'What is the roof for?'],
  'questions' => ['How much water do you think a family needed each day?', 'Why would a town build pipes instead of more wells?', 'Where is the nearest place to get water if your taps stopped?'],
  'words' => ['Well' => 'A deep hole dug to reach water underground.', 'Conduit' => 'A pipe or channel that carries water.', 'Windlass' => 'A roller turned by a handle to wind up a rope.'],
  'sources' => ['eadwine'],
  'related' => ['kitchen', 'abbey', 'market-cross'],
],

// ---------------- Tournaments and training ----------------
'tournament-field' => [
  'name' => 'Tournament field', 'latin' => 'the lists', 'cat' => 'fun', 'src' => 'art/fitness_3.png',
  'summary' => 'A field with a fence down the middle where knights jousted, charging at each other with blunted lances.',
  'facts' => ['Events' => 'Jousts and mock battles called mêlées', 'The field was called' => 'The lists', 'Safety' => 'Blunted lances, and later a barrier called a tilt', 'Coats of arms' => 'Showed who was inside the armor'],
  'sections' => [
    ['What a tournament was', [
      'Tournaments were contests where knights trained for war and showed off their skill. Early tournaments were rough mock battles, called mêlées, across open country. Later, the favorite event was the joust: two knights on horseback charged at each other with long lances, trying to break the lance on the other\'s shield or knock him from the saddle.',
    ]],
    ['Making it safer', [
      'Tournaments were dangerous, and knights were hurt and even killed. Over time, organizers used blunted lances with crown-shaped tips and, in the 1400s, added a wooden barrier, called the tilt, down the middle of the lists so the horses could not crash into each other.',
    ]],
    ['Heralds and coats of arms', [
      'In full armor with a closed helmet, every knight looked alike. So knights painted their shields with bright designs called coats of arms. Heralds learned them all, announced the knights and kept score. Heraldry is still used today in flags, badges and logos.',
    ]],
  ],
  'art' => 'The striped tents, flags, wooden stands and fence are the artist\'s design, close to pictures of real tournaments.',
  'look' => ['Find the fence down the middle.', 'Where would the people watch?'],
  'questions' => ['Why would knights need a way to practice for battle?', 'How did rules make the joust safer?', 'What symbols show which team you support?'],
  'words' => ['Joust' => 'A contest between two knights on horseback with lances.', 'Lists' => 'The fenced field where a tournament took place.', 'Herald' => 'An officer who announced knights and knew coats of arms.'],
  'sources' => ['brit-tournament', 'brit-knight'],
  'related' => ['knight-statue', 'training-yard', 'horse-and-rider'],
],

'archery-butts' => [
  'name' => 'Archery butts', 'latin' => 'butts', 'cat' => 'fun', 'src' => 'art/fitness_1.png',
  'summary' => 'A practice ground with straw targets where townsmen trained with the longbow.',
  'facts' => ['Butts were' => 'Mounds of earth or straw with targets', 'The longbow' => 'About as tall as the archer, often of yew', 'The law' => 'In 1363, King Edward III ordered archery practice on holidays', 'Still in place names' => 'Streets called "Butts" in English towns'],
  'sections' => [
    ['Practice for everyone', [
      'In England, the longbow was a powerful weapon, but it took years of practice to draw and aim well. So kings wanted ordinary men to train. In 1363, King Edward III ordered that men practice archery on holidays instead of playing games like football.',
      'Towns and villages set up butts: mounds of earth or banks of straw with targets in front. Many English towns still have a street or field called the Butts.',
    ]],
    ['The longbow', [
      'A longbow was made from a single piece of wood, often yew, and was about as tall as the archer. Pulling it back took great strength, and the skeletons of archers sometimes show bigger bones in one arm from years of practice.',
    ]],
  ],
  'art' => 'The round straw targets, rack of bows and covered stand are the artist\'s design.',
  'look' => ['Find the targets.', 'Where are the bows kept?'],
  'questions' => ['Why would a king order people to practice instead of play?', 'Which sports or skills take years of practice?', 'Are there street names in your town that tell you what once happened there?'],
  'words' => ['Butts' => 'Mounds with targets for archery practice.', 'Longbow' => 'A tall bow made from one piece of wood.', 'Yew' => 'A tree whose wood is strong and springy.'],
  'sources' => ['brit-longbow', 'archery-1363'],
  'related' => ['training-yard', 'tournament-field', 'watchtower'],
],

'training-yard' => [
  'name' => 'Training yard', 'latin' => 'quintain and practice', 'cat' => 'fun', 'src' => 'art/fitness_2.png',
  'summary' => 'A fenced yard where squires practiced with wooden swords, shields and a spinning target called a quintain.',
  'facts' => ['Practice weapons' => 'Wooden swords and blunt blades', 'Target' => 'The quintain, a swinging arm on a post', 'Oldest fencing book' => 'Royal Armouries MS I.33, about 1300', 'Trained' => 'Pages and squires, from boyhood'],
  'sections' => [
    ['Learning to fight', [
      'Squires spent years training. They practiced with wooden swords and blunt blades, wrestled, ran and climbed, and learned to ride and fight in heavy armor. Masters of defense taught sword fighting, and some wrote books about it. The oldest surviving European fighting manual, now in the Royal Armouries in Leeds, England, was made around 1300 and shows a priest teaching a student with sword and small shield.',
    ]],
    ['The quintain', [
      'To practice with a lance, riders charged at a quintain: a target on an arm that turned on a post. If the rider hit the target badly, the arm swung around and could knock him off his horse, so he had to strike cleanly and ride on fast. A rare quintain still stands on the village green at Offham in Kent, England.',
    ]],
  ],
  'art' => 'The practice posts, climbing frame and rack of wooden swords and shields are the artist\'s design.',
  'look' => ['Find the rack of wooden swords.', 'What could you practice on the climbing frame?'],
  'questions' => ['Why practice with wooden swords?', 'How does a quintain teach a rider to be accurate?', 'Where do people practice skills safely today?'],
  'words' => ['Quintain' => 'A target on a turning arm, used for lance practice.', 'Page' => 'A boy serving in a noble household, the first step to knighthood.', 'Manual' => 'A book that teaches a skill.'],
  'sources' => ['ra-armour', 'brit-knight'],
  'related' => ['knight-statue', 'tournament-field', 'archery-butts'],
],

// ---------------- Building the town ----------------
'crane' => [
  'name' => 'Treadwheel crane', 'latin' => 'treadwheel crane', 'cat' => 'build', 'src' => 'build/crane.png',
  'summary' => 'A wooden crane powered by people walking inside a giant wheel, used to lift stone for castles and cathedrals.',
  'facts' => ['Powered by' => 'People walking inside a wheel', 'Lifted' => 'Stone blocks, timber and bells', 'Used on' => 'Cathedrals, castles and harbors', 'Still standing' => 'The Crane in Gdańsk (Poland), and wheels in some cathedral roofs'],
  'sections' => [
    ['How it worked', [
      'Medieval builders lifted heavy stones with treadwheel cranes. One or two workers walked inside a big wooden wheel, like a giant hamster wheel. As the wheel turned, it wound a rope around its axle, and the rope ran up over the jib to lift the load.',
      'Because the wheel was much wider than the axle, the walkers could lift far more than they could carry. The idea goes back to the Romans.',
    ]],
    ['Cranes that survive', [
      'Some treadwheels still sit inside the roofs and towers of English cathedrals, where they were used for building and repairs. In Gdańsk, Poland, the Crane (Żuraw), built in the 1400s, is a huge wooden harbor crane between two brick towers. Its treadwheels lifted cargo from ships and set up the masts of new ones.',
    ]],
  ],
  'art' => 'This crane is drawn with its wooden wheel at the bottom and a long jib lifting a stone block.',
  'look' => ['Find the big wheel. Where would the walkers be?', 'Follow the rope from the wheel to the stone.'],
  'questions' => ['Why does a big wheel make lifting easier?', 'What machines lift heavy things on building sites today?', 'How would it feel to walk in the wheel all day?'],
  'words' => ['Treadwheel' => 'A wheel turned by people walking inside it.', 'Jib' => 'The arm of a crane.', 'Axle' => 'The rod at the center of a wheel.'],
  'sources' => ['brit-crane', 'gdansk-crane'],
  'related' => ['building-materials', 'abbey', 'royal-castle'],
],

'building-materials' => [
  'name' => 'Building materials', 'latin' => 'stone, timber and thatch', 'cat' => 'build', 'src' => 'build/materials.png',
  'summary' => 'Cut stone, oak beams and bundles of thatch: the materials that built castles, churches and homes.',
  'facts' => ['Stone' => 'Cut by masons, joined with lime mortar', 'Timber' => 'Mostly oak', 'Roofs' => 'Thatch, clay tiles, slate or lead', 'Took longest' => 'Cologne Cathedral: begun 1248, finished 1880'],
  'sections' => [
    ['Stone and mortar', [
      'Castles, churches and bridges were built of stone, cut from quarries and shaped by skilled masons. They set the blocks in mortar made from lime, sand and water, which slowly hardened. Many masons cut a small personal mark into the stones they shaped, and these marks can still be found on old buildings.',
      'Great churches took a very long time. Cologne Cathedral in Germany was begun in 1248, stopped for centuries, and was only finished in 1880, following the original plans.',
    ]],
    ['Timber and roofs', [
      'Oak was the main building timber in much of northern Europe: strong, long-lasting and good for frames and roof beams. Ordinary houses were roofed with thatch, while better buildings used clay tiles, stone slates or, on churches, sheets of lead.',
    ]],
  ],
  'art' => 'The stacked stone blocks, beams, thatch bundle and bucket of tools are the artist\'s picture of a medieval building site.',
  'look' => ['Find the bundle of thatch.', 'Which tools can you see in the bucket?'],
  'questions' => ['Which materials could be found close to a village, and which had to come from far away?', 'Why would a cathedral take so long to build?', 'What is your home made of?'],
  'words' => ['Mason' => 'A worker who cuts and builds with stone.', 'Mortar' => 'A paste that sets hard and joins stones or bricks.', 'Quarry' => 'A place where stone is cut from the ground.'],
  'sources' => ['brit-mason', 'un-cologne', 'brit-timber'],
  'related' => ['crane', 'town-house', 'abbey'],
],
];

$WORLD_DATA['medieval'] = [
  'title'    => 'Medieval Kingdom: 34 places and how they worked',
  'desc'     => 'Explore an illustrated medieval town: 34 places from a royal castle and an abbey to a guild hall and a windmill, how each worked, and photos of real medieval sites.',
  'intro'    => 'For about a thousand years, from around AD 500 to 1500, Europe was a land of castles, abbeys, market towns and farming villages. Explore 34 places in a medieval town: what each one was for, how it worked and where you can still see real examples today.',
  'note'     => 'The buildings are illustrations in a bright storybook style, not exact reconstructions. Each page separates what history tells us from what the artist imagined, and lists its sources.',
  'aka'      => 'Also called',
  'akaLang'  => '',
  'pageTitle'=> '%s in a medieval town: how it worked',
  'pageTitleShort' => '%s in a medieval town',
  'defaultTag' => 'history',
  'aside'    => ['About the Middle Ages', 'The Middle Ages, or medieval period, is the time in European history between the end of the Roman Empire in the west, around AD 500, and about 1500. Life changed a great deal over those thousand years, and from place to place, so this town mixes things from different centuries, mostly from about 1100 to 1450.'],
  'pageDesc' => ' Learn how it worked, see photos of real medieval places, and explore questions for discussion.',
  'pageDescShort' => ' See how it worked, with photos of real places.',
  'sourcesIntro' => 'The history on this page is a short summary based on these sources:',
  'about'    => 'Medieval European architecture and daily life',
  // Positions on the 6 x 6 map, from the back corner (0) to the front corner (35). Tall pieces stand at the back.
  'map' => [
    'crane', 'watchtower', 'bell-tower', 'royal-castle', 'tower-house', 'gatehouse',
    'knight-statue', 'abbey', 'great-hall', 'university', 'chapel', 'windmill',
    'tournament-field', 'scriptorium', 'guild-hall', 'market-hall', 'town-house', 'feast-hall',
    'manor-house', 'merchants-house', 'market-cross', 'bakery', 'village-school', 'blacksmith',
    'training-yard', 'archery-butts', 'farmstead', 'peasant-cottage', 'shepherds-cottage', 'kitchen',
    'orchard', 'herb-garden', 'tree', 'village-well', 'building-materials', 'tree',
  ],
  'tree'     => 'oak-tree',
  'sources'  => $MEDIEVAL_SOURCES,
  'cats'     => $MEDIEVAL_CATEGORIES,
  'pages'    => $MEDIEVAL,
];
