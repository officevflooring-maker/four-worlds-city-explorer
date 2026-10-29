<?php
// Ancient Egypt: one page per place (same page format as build/worlds/roman.php).
// Facts are kept to well-established points from the sources listed in $EGYPT_SOURCES (shown on each page as
// plain text, not links). "art" describes what is the artist's interpretation. The art is the Life RPG game's
// Egypt set (tools/assets.txt); two pictures (the boats) are not on the map but have pages.

$EGYPT_SOURCES = [
  'brit-egypt'    => 'Encyclopaedia Britannica, "Ancient Egypt"',
  'brit-giza'     => 'Encyclopaedia Britannica, "Pyramids of Giza"',
  'brit-khufu'    => 'Encyclopaedia Britannica, "Khufu"',
  'brit-sphinx'   => 'Encyclopaedia Britannica, "Great Sphinx"',
  'brit-obelisk'  => 'Encyclopaedia Britannica, "Obelisk"',
  'brit-hatshepsut' => 'Encyclopaedia Britannica, "Hatshepsut"',
  'brit-karnak'   => 'Encyclopaedia Britannica, "Karnak"',
  'brit-pylon'    => 'Encyclopaedia Britannica, "Pylon"',
  'brit-memnon'   => 'Encyclopaedia Britannica, "Colossi of Memnon"',
  'brit-amarna'   => 'Encyclopaedia Britannica, "Tell el-Amarna"',
  'brit-bastet'   => 'Encyclopaedia Britannica, "Bastet"',
  'brit-scribe'   => 'Encyclopaedia Britannica, "Scribe" and "Hieratic script"',
  'brit-papyrus'  => 'Encyclopaedia Britannica, "Papyrus"',
  'brit-library'  => 'Encyclopaedia Britannica, "Library of Alexandria"',
  'brit-nile'     => 'Encyclopaedia Britannica, "Nile River"',
  'brit-shaduf'   => 'Encyclopaedia Britannica, "Shaduf"',
  'brit-punt'     => 'Encyclopaedia Britannica, "Punt"',
  'brit-nubia'    => 'Encyclopaedia Britannica, "Nubia"',
  'un-memphis'    => 'UNESCO World Heritage Centre, "Memphis and its Necropolis – the Pyramid Fields from Giza to Dahshur"',
  'un-thebes'     => 'UNESCO World Heritage Centre, "Ancient Thebes with its Necropolis"',
  'un-nubia'      => 'UNESCO World Heritage Centre, "Nubian Monuments from Abu Simbel to Philae"',
  'sh-karnak'     => 'Smarthistory, "Temple of Amun-Re and the Hypostyle Hall, Karnak"',
  'sh-scribe'     => 'Smarthistory, "Seated Scribe"',
  'memphis-hall'  => 'University of Memphis, Karnak Great Hypostyle Hall Project',
  'met-meketre'   => 'The Metropolitan Museum of Art, models from the tomb of Meketre (granary, garden and boats), about 1980 BC',
  'bm-nebamun'    => 'British Museum, paintings from the tomb-chapel of Nebamun (garden pool, banquet and marsh hunt)',
  'bm-nakht'      => 'British Museum, the Book of the Dead of Nakht (EA 10471)',
  'bm-cat'        => 'British Museum, the Gayer-Anderson cat',
  'whe-deir'      => 'World History Encyclopedia, "Deir el-Medina"',
  'whe-life'      => 'World History Encyclopedia, "House of Life"',
  'zinn'          => 'Katharina Zinn, "Libraries, Pharaonic Egypt", The Encyclopedia of Ancient History (2013)',
  'ramesseum'     => 'Egyptian Ministry of Tourism and Antiquities, announcement of a House of Life found at the Ramesseum, Luxor (2025)',
  'merer'         => 'Pierre Tallet and colleagues, the Wadi al-Jarf papyri ("the diary of Merer"), found in 2013',
  'aera'          => 'Ancient Egypt Research Associates (Mark Lehner), excavations of the pyramid builders\' town at Giza',
  'lehner'        => 'Mark Lehner, The Complete Pyramids (1997)',
  'arnold'        => 'Dieter Arnold, Building in Egypt: Pharaonic Stone Masonry (1991)',
  'wilkinson'     => 'Richard H. Wilkinson, The Complete Temples of Ancient Egypt (2000)',
  'kemp'          => 'Barry Kemp, The City of Akhenaten and Nefertiti: Amarna and Its People (2012)',
  'shaw'          => 'Ian Shaw (editor), The Oxford History of Ancient Egypt (2000)',
  'herodotus'     => 'Herodotus, Histories, Book 2 (about 430 BC)',
  'kheti'         => 'The Instruction of Khety ("The Satire of the Trades"), Middle Kingdom',
  'amenhotep2'    => 'Stela of Amenhotep II near the Great Sphinx, about 1420 BC (his feats of archery and rowing)',
  'amarna-letters'=> 'The Amarna letters (about 1360 to 1335 BC), letters between the pharaohs and foreign rulers',
  'turin-strike'  => 'The Turin Strike Papyrus (about 1157 BC), records of the workers of Deir el-Medina',
  'rekhmire'      => 'Tomb of the vizier Rekhmire (TT100), Thebes: painted scenes of brickmaking and building, about 1450 BC',
  'hierakonpolis' => 'Van Neer and colleagues, "More evidence for cat taming at the Predynastic elite cemetery of Hierakonpolis", Journal of Archaeological Science (2014)',
  'stevens'       => 'Anna Stevens and colleagues, "From representation to reality: ancient Egyptian wax head cones from Amarna", Antiquity (2019)',
  'tut-carter'    => 'Griffith Institute, University of Oxford, Howard Carter\'s records of the tomb of Tutankhamun',
  'soulhouse'     => 'Petrie Museum of Egyptian Archaeology, University College London, pottery "soul house" models',
  'gawasis'       => 'Kathryn Bard and Rodolfo Fattovich, excavations at the harbor of Mersa/Wadi Gawasis on the Red Sea (2001 to 2011)',
  'turin-map'     => 'Museo Egizio, Turin, the Turin Papyrus Map (about 1160 BC)',
  'met-collar'    => 'The Metropolitan Museum of Art, floral collars from Tutankhamun\'s embalming cache',
  'ra2'           => 'Kon-Tiki Museum, Oslo, "Ra, 1969 - Ra II, 1970"',
  'mesehti'       => 'Egyptian Museum, Cairo, wooden model soldiers from the tomb of Mesehti, Asyut, about 2000 BC',
  'tt104'         => 'Tomb of Djehutynefer (TT104), Thebes: painting of his house, about 1420 BC',
  'hatnub'        => 'French Institute for Oriental Archaeology (IFAO) and University of Liverpool, the ramp at the Hatnub quarry (2018)',
  'meketre-cattle' => 'Egyptian Museum, Cairo, model of a cattle count from the tomb of Meketre, about 1980 BC',
  'brit-eratosthenes' => 'Encyclopaedia Britannica, "Eratosthenes"',
];

// category => [label, short description]
$EGYPT_CATEGORIES = [
  'monuments' => ['Pyramids and monuments', 'Giant monuments built to last forever.'],
  'temples'   => ['Pharaohs and temples', 'Where the king lived and ruled, and where the gods were honored.'],
  'learn'     => ['Writing and learning', 'Where scribes learned to write and knowledge was kept.'],
  'trade'     => ['Food, work and trade', 'Markets, granaries, workshops and journeys that kept Egypt fed and busy.'],
  'nile'      => ['Gardens and the Nile', 'The river that gave Egypt life, and the gardens it watered.'],
  'fun'       => ['Sports and feasts', 'Archery, rowing, chariots and banquets.'],
  'homes'     => ['Homes', 'How Egyptians lived, from village houses to villas with gardens.'],
  'build'     => ['Building and defense', 'How Egyptians built in mud and stone, and kept watch on their borders.'],
];

$EGYPT = [

// ---------------- Pyramids and monuments ----------------
'pyramid' => [
  'name' => 'Pyramid', 'latin' => 'mer', 'cat' => 'monuments', 'src' => 'art/pyramid.png',
  'summary' => 'A giant stone tomb for a pharaoh. The Great Pyramid at Giza was the tallest building on Earth for about 3,800 years.',
  'facts' => ['Built for' => 'King Khufu', 'Finished' => 'About 2560 BC', 'Height' => 'About 146 meters when new, 138 meters today', 'Blocks' => 'About 2.3 million'],
  'sections' => [
    ['A tomb fit for a king', [
      'Egyptian kings, called pharaohs, were buried with everything they would need in the next life. The first pyramid, the Step Pyramid of King Djoser at Saqqara, was built around 2650 BC as a stack of six ever-smaller platforms. Within about fifty years, builders had learned to make the smooth-sided shape we picture today: the Red Pyramid of King Sneferu at Dahshur, built around 2600 BC, was the first true pyramid.',
      'The Great Pyramid at Giza was built for King Khufu around 2560 BC. When new it was about 146 meters tall and covered in polished white limestone that shone in the sun. Most of that outer casing was later taken away for other buildings, so today it is about 138 meters tall.',
    ]],
    ['Who built it', [
      'The pyramids were not built by slaves, as people once thought. Archaeologists have found a town beside the Giza pyramids where thousands of workers lived, with bakeries, breweries and cemeteries for workers who died. Crews of skilled builders worked all year, and farmers joined them in the flood season, when their fields were under water.',
      'In 2013 archaeologists found the oldest papyrus with writing ever found in Egypt: the diary of an official named Merer. It records his team ferrying blocks of fine white limestone across the Nile to Giza for Khufu\'s pyramid.',
    ], ['list' => [
      'Most stone was cut from quarries right next to the site.',
      'Fine white limestone for the casing came by boat from Tura, across the river.',
      'Granite for the burial chamber came from Aswan, more than 800 kilometers to the south.',
      'Blocks were dragged on wooden sledges and up ramps of mud brick and rubble.',
    ]]],
  ],
  'art' => 'The illustration shows a pyramid with smooth white sides and a golden tip, close to how the Great Pyramid may have looked when its casing was new. Whether its real top stone was covered in gold is not known.',
  'look' => ['Find the golden top stone.', 'Look at the smooth white sides. Why might they have shone in the sun?'],
  'questions' => ['Why might a king want such an enormous tomb?', 'How would you organize thousands of workers on one project?', 'The Great Pyramid is about 4,500 years old. What would you build to last that long?'],
  'words' => ['Pharaoh' => 'A king of ancient Egypt.', 'Casing' => 'The smooth outer layer of stone on a pyramid.', 'Quarry' => 'A place where stone is cut from the ground.'],
  'sources' => ['brit-giza', 'brit-khufu', 'un-memphis', 'aera', 'merer', 'lehner'],
  'related' => ['sphinx', 'building-materials', 'stone-sledge'],
],

'sphinx' => [
  'name' => 'Great Sphinx', 'latin' => 'Horemakhet', 'cat' => 'monuments', 'src' => 'art/sphinx.png',
  'summary' => 'A giant lion with the head of a king, carved out of the rock beside the pyramids of Giza about 4,500 years ago.',
  'facts' => ['Length' => 'About 73 meters', 'Height' => 'About 20 meters', 'Carved' => 'Probably for King Khafre, about 2500 BC', 'Made from' => 'The natural limestone bedrock'],
  'sections' => [
    ['A lion with a king\'s face', [
      'A sphinx has the body of a lion and the head of a person, usually a king. Lions stood for strength and guarded sacred places. The Great Sphinx at Giza is one of the largest statues in the world. It was carved straight out of the limestone bedrock, probably for King Khafre, whose pyramid stands behind it. Later Egyptians called it Horemakhet, "Horus in the horizon".',
      'Its nose was broken off long ago. Drawings made in the 1700s already show it missing, so the popular story that Napoleon\'s soldiers shot it off is not true.',
    ]],
    ['Buried by sand', [
      'Desert sand has buried the Sphinx up to its neck many times. Around 1400 BC, a prince who later became King Thutmose IV had the sand cleared away. He set up a stone slab between its paws telling how the Sphinx spoke to him in a dream and promised him the throne if he freed it. The slab, called the Dream Stela, is still there.',
    ]],
  ],
  'art' => 'This illustration shows the Sphinx on a neat sandstone base, wearing the striped royal headcloth. The real Sphinx lies in a hollow cut into the rock, and its body is much more worn.',
  'look' => ['Find the striped headcloth.', 'Compare the size of the head with the size of the body.'],
  'questions' => ['Why might a ruler want to be shown as a lion?', 'How would you protect a statue from sand and wind?', 'What stories do people tell about statues near you?'],
  'words' => ['Sphinx' => 'A creature with a lion\'s body and a human head.', 'Bedrock' => 'The solid rock under the soil and sand.', 'Stela' => 'An upright stone slab with writing or pictures.'],
  'sources' => ['brit-sphinx', 'un-memphis', 'lehner'],
  'related' => ['pyramid', 'twin-colossi', 'cat-statue'],
],

'obelisk' => [
  'name' => 'Obelisk', 'latin' => 'tekhen', 'cat' => 'monuments', 'src' => 'art/monument.png',
  'summary' => 'A tall, four-sided stone pillar with a pointed top, cut from a single piece of granite and set up in pairs at temple gates.',
  'facts' => ['Made from' => 'One piece of granite, usually from Aswan', 'Tallest in Egypt today' => 'Hatshepsut\'s obelisk at Karnak, about 29 meters', 'The tip' => 'Sometimes covered in gold or electrum', 'Also found in' => 'Rome, Paris, London and New York'],
  'sections' => [
    ['Needles of stone', [
      'Obelisks were tall, narrow pillars topped by a small pyramid. They were linked to the sun god Ra, and the top was sometimes covered in gold or electrum, a natural mix of gold and silver, so it flashed in the sunlight. They usually stood in pairs in front of temple gateways, carved with the name of the ruler who set them up.',
      'Queen Hatshepsut, one of the few women to rule Egypt as pharaoh, raised two great obelisks at Karnak around 1460 BC. One still stands, about 29 meters tall. Its inscription says their tips were covered in electrum.',
    ]],
    ['Cut from one stone', [
      'Each obelisk was carved from a single block of granite at the quarries of Aswan. Workers pounded the rock with balls of a harder stone called dolerite to free it, then floated it down the Nile on a barge. At Aswan you can still see the Unfinished Obelisk, about 42 meters long, which cracked while it was being cut and was left in the quarry.',
    ]],
    ['Obelisks around the world', [
      'Many obelisks were later carried away. Roman emperors shipped several to Rome, which now has more ancient Egyptian obelisks than any other city. In the 1800s, obelisks were moved to Paris, London and New York. The ones in London and New York are both nicknamed "Cleopatra\'s Needle", although they are about 1,400 years older than Cleopatra.',
    ]],
  ],
  'art' => 'The illustration shows a pink granite obelisk with a gold tip on a stepped base. Real obelisks were covered in hieroglyphs; here the carvings are only patterns.',
  'look' => ['Find the shining tip.', 'How many sides can you see?'],
  'questions' => ['How might workers have stood a heavy obelisk upright?', 'Should obelisks taken from Egypt be returned? Why or why not?', 'Why would a ruler put their name on a monument?'],
  'words' => ['Obelisk' => 'A tall four-sided stone pillar with a pointed top.', 'Electrum' => 'A natural mix of gold and silver.', 'Granite' => 'A very hard, speckled rock.'],
  'sources' => ['brit-obelisk', 'brit-hatshepsut', 'un-thebes', 'arnold'],
  'related' => ['temple-gateway', 'hall-of-columns', 'building-materials'],
],

'cat-statue' => [
  'name' => 'Cat statue', 'latin' => 'miu', 'cat' => 'monuments', 'src' => 'art/nt_statue.png',
  'summary' => 'A statue of a sitting cat, the sacred animal of the goddess Bastet. Egyptians loved cats, which kept homes and granaries free of mice and snakes.',
  'facts' => ['Egyptian word for cat' => 'Miu', 'Linked to' => 'Bastet, goddess of the home and protection', 'Her temple' => 'Bubastis, in the Nile Delta', 'Famous example' => 'The Gayer-Anderson cat, British Museum'],
  'sections' => [
    ['Cats in Egyptian homes', [
      'Cats were useful: they caught the mice and rats that ate stored grain and killed snakes and scorpions. Paintings show pet cats sitting under their owners\' chairs and joining bird hunts in the marshes. Some of the earliest known tame cats were buried in a cemetery at Hierakonpolis in southern Egypt around 3700 BC.',
      'The Greek writer Herodotus, who visited Egypt around 450 BC, wrote that when a family cat died, everyone in the house shaved their eyebrows in mourning.',
    ]],
    ['The goddess Bastet', [
      'The goddess Bastet was shown as a cat or as a woman with a cat\'s head. She protected homes, mothers and children. Her temple was at Bubastis in the Nile Delta, where Herodotus described a huge yearly festival. Bronze cat statues like the one in this picture were given to the goddess as gifts, and great numbers of cats were mummified as offerings to her.',
    ]],
  ],
  'art' => 'This black cat with gold earrings and a gold collar is close to real bronze cat statues, such as the Gayer-Anderson cat in the British Museum, which also wears earrings and a necklace.',
  'look' => ['Find the earrings and the collar.', 'Is the cat sitting, standing or lying down?'],
  'questions' => ['Why would a farming country value cats so much?', 'What animals do people protect or honor today?', 'How do pets help families?'],
  'words' => ['Bastet' => 'An Egyptian goddess shown as a cat.', 'Mummy' => 'A body preserved by drying and wrapping.', 'Offering' => 'A gift given to a god.'],
  'sources' => ['brit-bastet', 'bm-cat', 'herodotus', 'hierakonpolis'],
  'related' => ['granary', 'family-house', 'obelisk'],
],

// ---------------- Pharaohs and temples ----------------
'pharaohs-palace' => [
  'name' => 'Pharaoh\'s palace', 'latin' => 'per-aa', 'cat' => 'temples', 'src' => 'art/town_3.png',
  'summary' => 'The home and offices of the king. Egyptians called the palace per-aa, the "great house", and that word became our word "pharaoh".',
  'facts' => ['Egyptian name' => 'Per-aa, "great house"', 'Built of' => 'Mud brick, with stone doorways and columns', 'Famous example' => 'Malkata, palace of Amenhotep III', 'Decorated with' => 'Painted floors, walls and ceilings'],
  'sections' => [
    ['The great house', [
      'The Egyptian word for the palace was per-aa, meaning "great house". In time people began to use it for the king himself, much as people say "the White House" to mean the president. Through Hebrew and Greek, per-aa became our word "pharaoh".',
      'Temples and tombs were built of stone to last forever, but palaces were built of mud brick, like ordinary houses only far grander. Because of this, few palaces survive.',
    ]],
    ['Palaces that survive', [
      'King Amenhotep III built a palace city called Malkata on the west bank at Thebes around 1360 BC, with halls, apartments, kitchens, workshops and a large man-made harbor. Its plaster floors and ceilings were painted with marsh plants, birds and fish. At Amarna, the city of his son Akhenaten, archaeologists found painted palace floors showing ducks flying up from thickets of papyrus.',
    ]],
  ],
  'art' => 'The illustration shows a stone palace with lotus columns, blue and gold banners and two sphinxes by the steps. Real palaces were mostly mud brick and plaster, painted in bright colors.',
  'look' => ['Find the two sphinx statues.', 'Look at the banners. What colors are they?'],
  'questions' => ['Why might palaces be built of mud brick, but temples of stone?', 'What can a building\'s name tell us about who uses it?', 'What would a ruler need in a palace besides a home?'],
  'words' => ['Pharaoh' => 'A king of ancient Egypt.', 'Plaster' => 'A smooth paste spread on walls that dries hard.', 'Harbor' => 'A sheltered place where boats can stop.'],
  'sources' => ['brit-egypt', 'brit-amarna', 'kemp', 'un-thebes'],
  'related' => ['royal-treasury', 'feast-hall', 'twin-colossi'],
],

'royal-treasury' => [
  'name' => 'Royal treasury', 'latin' => 'per-hedj', 'cat' => 'temples', 'src' => 'art/business_3.png',
  'summary' => 'Where the kingdom\'s wealth was kept: gold and silver, but also grain, linen and oil collected as taxes.',
  'facts' => ['Egyptian name' => 'Per-hedj, "the white house"', 'Coins' => 'None of Egypt\'s own until the 300s BC', 'Taxes paid in' => 'Grain, cattle, linen and other goods', 'Gold came from' => 'Mines in the eastern desert and Nubia'],
  'sections' => [
    ['Wealth without coins', [
      'For almost all of its history, Egypt had no coins. Taxes were paid in goods: grain from the harvest, cattle, linen, oil and honey. Officials measured the fields after each flood to work out what every farm owed. The treasury collected these goods, stored them and paid them out as wages to workers, soldiers and officials.',
      'To compare the value of different things, Egyptians used weights of copper, silver or gold. A goat might be worth a certain weight of copper, which could then be swapped for so many sacks of grain.',
    ]],
    ['Gold of the gods', [
      'Egypt was rich in gold, which came from mines in the eastern desert and in Nubia, to the south. Gold was linked to the sun and was thought of as the flesh of the gods. Foreign kings wrote to the pharaoh asking for gold; one of these letters, found at Amarna, says that in Egypt gold was "as plentiful as dust".',
    ]],
  ],
  'art' => 'The illustration shows a sandstone hall with gold doors, guard statues and chests of gold on the steps. Real treasuries were storehouses for goods of every kind, not just gold.',
  'look' => ['Find the chests of gold.', 'Look at the guard statues by the door.'],
  'questions' => ['How would you run a country without money?', 'Why might a farmer\'s tax depend on the height of the flood?', 'What does your town pay for with taxes today?'],
  'words' => ['Tax' => 'A payment people make to the government.', 'Deben' => 'An Egyptian weight, about 91 grams, used to measure value.', 'Wages' => 'Payment for work.'],
  'sources' => ['brit-egypt', 'shaw', 'amarna-letters'],
  'related' => ['granary', 'pharaohs-palace', 'market'],
],

'temple-gateway' => [
  'name' => 'Temple gateway', 'latin' => 'bekhenet', 'cat' => 'temples', 'src' => 'art/town_1.png',
  'summary' => 'Two huge sloping towers with a doorway between them: the entrance to an Egyptian temple, called a pylon.',
  'facts' => ['Called' => 'A pylon', 'Shape' => 'Two sloping towers around a gate', 'Biggest' => 'The first pylon at Karnak, about 113 meters wide', 'Decorated with' => 'Carvings of the king and tall flagpoles'],
  'sections' => [
    ['The door to a god\'s house', [
      'A temple was thought of as the home of a god, and its front door was a pylon: two tall stone towers with sloping walls and a gateway between them. The shape echoed the Egyptian sign for the horizon, two hills with the sun rising between them.',
      'Carvings on the towers usually showed the king defeating Egypt\'s enemies, a message that chaos was kept outside. Tall wooden flagpoles with colored banners stood in grooves on the front.',
    ]],
    ['Gates within gates', [
      'Big temples grew over hundreds of years as each king added something new. The temple of Amun at Karnak has ten pylons. Its first pylon, about 113 meters wide, was never finished, and remains of the builders\' mud-brick ramp can still be seen behind it. At Edfu, a later temple from the time of the Ptolemy kings, the pylon is complete and stands about 36 meters tall.',
    ]],
  ],
  'art' => 'The illustration shows a pylon with seated statues and red and blue banners on tall poles. The bright colors are a good guess: traces of paint show that temples were once brightly painted.',
  'look' => ['Count the flagpoles.', 'Find the seated statues by the door.'],
  'questions' => ['Why might a temple have such a huge front door?', 'What do big entrances to buildings near you say to visitors?', 'Why did each king want to add to the temple?'],
  'words' => ['Pylon' => 'A temple gateway with two sloping towers.', 'Horizon' => 'The line where the land seems to meet the sky.', 'Relief' => 'A carving that stands out from a flat surface.'],
  'sources' => ['brit-pylon', 'brit-karnak', 'un-thebes', 'wilkinson'],
  'related' => ['hall-of-columns', 'obelisk', 'twin-colossi'],
],

'hall-of-columns' => [
  'name' => 'Hall of columns', 'cat' => 'temples', 'src' => 'art/growth_3.png',
  'summary' => 'A great temple hall filled with giant painted columns, like the Great Hypostyle Hall at Karnak, which has 134 of them.',
  'facts' => ['Real example' => 'The Great Hypostyle Hall, Karnak', 'Columns' => '134, in 16 rows', 'Tallest columns' => 'About 21 meters', 'Built by' => 'Seti I and Ramesses II, about 1290 to 1220 BC'],
  'sections' => [
    ['A forest of stone', [
      'A hypostyle hall is a hall whose roof rests on rows of columns. The greatest of them all is in the temple of Amun at Karnak, in the ancient city of Thebes (modern Luxor). Its 134 columns stand in 16 rows. The 12 along the middle are about 21 meters tall, with tops shaped like open papyrus flowers.',
      'The hall was begun by King Seti I and finished by his son, Ramesses II. Its walls and columns are covered with carvings of the king and the gods, and traces of the original bright paint survive high up.',
    ]],
    ['A marsh made of stone', [
      'Egyptians believed the world began as a mound of land rising from water. Columns shaped like papyrus plants turned the hall into a stone version of a Nile marsh. The middle columns were taller than the others, so stone window grilles high above the floor could let in light while the rest of the hall stayed dim.',
    ]],
  ],
  'art' => 'The illustration shows a smaller hall with painted columns and its roof partly open to the sun. The real hall at Karnak is mostly roofless today, because its stone roof fell in long ago.',
  'look' => ['Look at the tops of the columns. What plant do they look like?', 'Find where the sunlight comes in.'],
  'questions' => ['How does a building feel when it is full of tall columns?', 'Why might temple builders want parts of a temple to be dim?', 'What shapes from nature do buildings near you copy?'],
  'words' => ['Hypostyle' => 'A hall whose roof rests on many columns.', 'Capital' => 'The top part of a column.', 'Papyrus' => 'A tall reed that grew in Nile marshes.'],
  'sources' => ['brit-karnak', 'memphis-hall', 'sh-karnak', 'un-thebes'],
  'related' => ['temple-gateway', 'lotus-pavilion', 'obelisk'],
],

'twin-colossi' => [
  'name' => 'Twin colossi', 'cat' => 'temples', 'src' => 'art/town_2.png',
  'summary' => 'Two giant seated statues of a pharaoh, like the Colossi of Memnon, which have sat beside the Nile for about 3,400 years.',
  'facts' => ['Real example' => 'The Colossi of Memnon, Luxor', 'King shown' => 'Amenhotep III', 'Height' => 'About 18 meters', 'Made around' => '1350 BC'],
  'sections' => [
    ['Guards at the gate', [
      'Kings often set giant statues of themselves at temple entrances. The most famous pair, now called the Colossi of Memnon, shows King Amenhotep III seated on his throne. They guarded the entrance to his huge memorial temple on the west bank of the Nile at Thebes. The temple behind them was almost entirely destroyed by floods and later builders, but the statues survived.',
    ]],
    ['The singing statue', [
      'After an earthquake in 27 BC cracked one of the statues, it began to make a sound at dawn, perhaps as the stone warmed and dried in the morning sun. Greek and Roman visitors came to hear it and named it after Memnon, a hero of Greek legend who greeted his mother, the goddess of the dawn. Some visitors carved poems on its legs. After the statue was repaired, around AD 200, it fell silent.',
    ]],
  ],
  'art' => 'The illustration shows two seated kings in striped headcloths on a shared base. The real Colossi are weathered and stand apart, each on its own base.',
  'look' => ['Find the kings\' hands. Where are they resting?', 'Compare the statues with the doorway beside them.'],
  'questions' => ['Why would a king want giant statues of himself?', 'Why might the statues have survived when the temple did not?', 'What do statues in your town tell visitors?'],
  'words' => ['Colossus' => 'A statue much larger than life (plural colossi).', 'Memorial temple' => 'A temple where a king was honored after his death.', 'Inscription' => 'Words carved into stone.'],
  'sources' => ['brit-memnon', 'un-thebes', 'wilkinson'],
  'related' => ['temple-gateway', 'sphinx', 'pharaohs-palace'],
],

'lotus-pavilion' => [
  'name' => 'Temple kiosk', 'cat' => 'temples', 'src' => 'art/growth_2.png',
  'summary' => 'An open pavilion of columns where priests could rest a god\'s shrine during festivals, or travelers could stop by the river.',
  'facts' => ['Used for' => 'Resting a god\'s shrine during festivals', 'Famous example' => 'The White Chapel of Senusret I, Karnak', 'Later example' => 'Trajan\'s Kiosk, Philae', 'Open to' => 'Light and air on every side'],
  'sections' => [
    ['A resting place for the gods', [
      'At big festivals, priests carried a statue of the god out of the temple in a small shrine shaped like a boat. Along the route stood open pavilions, or kiosks, where they could set the shrine down and rest. The White Chapel at Karnak, built for King Senusret I around 1950 BC, is one of these way stations. Later kings took it apart and used its blocks to fill a pylon; archaeologists found the pieces and rebuilt it in the 1930s.',
    ]],
    ['Saved from the water', [
      'Kiosks also stood at temple entrances and on river banks. Trajan\'s Kiosk on the island of Philae, built when Egypt was part of the Roman Empire, has 14 tall columns with flower-shaped tops. In the 1970s, Philae\'s temples were taken apart and rebuilt, stone by stone, on a higher island to save them from the rising water behind the Aswan High Dam.',
    ]],
  ],
  'art' => 'This pavilion of lotus-topped columns around a small pool is the artist\'s idea. Real kiosks had similar columns with plant-shaped tops.',
  'look' => ['Look at the tops of the columns.', 'Find the pool in the middle.'],
  'questions' => ['Why might a festival route need resting places?', 'How would you move a whole temple to save it?', 'Where do people rest along busy routes near you?'],
  'words' => ['Kiosk' => 'An open pavilion with columns.', 'Shrine' => 'A small holy place for a god\'s statue.', 'Procession' => 'A group moving along a route for a ceremony.'],
  'sources' => ['brit-karnak', 'un-nubia', 'wilkinson'],
  'related' => ['hall-of-columns', 'lotus-pool', 'sailing-boat'],
],
// ---------------- Writing and learning ----------------
'scribe-school' => [
  'name' => 'Scribe school', 'latin' => 'sesh', 'cat' => 'learn', 'src' => 'art/knowledge_1.png',
  'summary' => 'Where boys, and a few girls, spent years learning to read and write so they could become scribes, the record keepers of Egypt.',
  'facts' => ['Learned' => 'Hieroglyphs and the faster hieratic script', 'Practiced on' => 'Flakes of stone, broken pottery and wooden boards', 'Who could read' => 'Probably only a few in every hundred people', 'Famous school text' => 'The Satire of the Trades'],
  'sections' => [
    ['Learning to write', [
      'Egyptian writing had hundreds of signs. Hieroglyphs were carved and painted on monuments; for everyday writing, scribes used a quicker, joined-up script called hieratic. Students copied texts over and over with reed pens and black or red ink, on flakes of limestone and pieces of broken pottery, because papyrus was expensive. Many of these practice pieces survive, mistakes and all.',
    ]],
    ['Be a scribe!', [
      'Scribes counted harvests, recorded taxes, wrote letters and planned building work, so they were respected and rarely did hard labor. A famous school text, the Satire of the Trades, told students how miserable other jobs were, from the potter covered in mud to the washerman, so that they would work hard at their writing.',
      'A painted statue known as the Seated Scribe, made around 2500 BC and now in the Louvre in Paris, shows a scribe sitting cross-legged with a papyrus roll open on his lap, ready to write.',
    ]],
  ],
  'art' => 'The illustration shows a small mud-brick school with a shaded courtyard, low desks and scrolls. Lessons could also take place in a temple or an office, with one scribe teaching a few students.',
  'look' => ['Find the low desks.', 'Where would students sit in the shade?'],
  'questions' => ['Why might only a few people learn to write?', 'Why did students practice on broken pottery instead of papyrus?', 'Which jobs today depend on reading and writing?'],
  'words' => ['Scribe' => 'A person whose job was writing and keeping records.', 'Hieratic' => 'A quick, joined-up form of Egyptian writing.', 'Ostracon' => 'A piece of pottery or stone used for writing (plural ostraca).'],
  'sources' => ['brit-scribe', 'kheti', 'sh-scribe', 'shaw'],
  'related' => ['house-of-life', 'great-library', 'royal-treasury'],
],

'house-of-life' => [
  'name' => 'House of Life', 'latin' => 'per ankh', 'cat' => 'learn', 'src' => 'art/knowledge_2.png',
  'summary' => 'A center of learning beside a temple, where priests and scribes copied sacred texts and studied medicine, the stars and the calendar.',
  'facts' => ['Egyptian name' => 'Per ankh, "house of life"', 'First mentioned' => 'About 2000 BC', 'Studied' => 'Writing, medicine, the calendar and temple rituals', 'Newest find' => 'At the Ramesseum, Luxor, announced in 2025'],
  'sections' => [
    ['Where knowledge lived', [
      'Big temples had a House of Life, where learned priests and scribes copied and kept important texts: prayers, rituals, medical knowledge and records of the stars. Students trained there too. Scholars still debate exactly what it was: some call it a library, others an academy with a library inside it.',
      'Egyptian medicine was famous in the ancient world. The Ebers Papyrus, written around 1550 BC, lists about 700 remedies, for everything from burns and toothache to crocodile bites.',
    ]],
    ['A school found in 2025', [
      'In 2025, Egyptian archaeologists announced that they had found a House of Life at the Ramesseum, the memorial temple of Ramesses II at Luxor. Among the finds were students\' drawings and pieces of school equipment, showing that teaching went on right next to the temple.',
    ]],
  ],
  'art' => 'The illustration shows a two-story sandstone hall with columns, a rooftop terrace and shelves of scrolls. Real Houses of Life stood inside temple grounds and were mostly built of mud brick.',
  'look' => ['Find the shelves of scrolls.', 'Where could people study in the fresh air?'],
  'questions' => ['Why might a temple want a place for books and learning?', 'How was knowledge kept before printing?', 'Where is knowledge kept in your town?'],
  'words' => ['Scroll' => 'A long roll of papyrus with writing on it.', 'Remedy' => 'A medicine or treatment.', 'Ritual' => 'A ceremony done in a set way.'],
  'sources' => ['whe-life', 'zinn', 'ramesseum', 'brit-papyrus'],
  'related' => ['scribe-school', 'great-library', 'hall-of-columns'],
],

'great-library' => [
  'name' => 'Great Library', 'cat' => 'learn', 'src' => 'art/knowledge_3.png',
  'summary' => 'The most famous library of the ancient world, founded in Alexandria around 300 BC with the dream of collecting every book.',
  'facts' => ['Founded' => 'About 300 BC, under the first Ptolemy kings', 'Part of' => 'The Mouseion, a center of research', 'Collection' => 'Papyrus scrolls, perhaps hundreds of thousands', 'Today' => 'The new Bibliotheca Alexandrina, opened in 2002'],
  'sections' => [
    ['Every book in the world', [
      'In 332 BC, Alexander the Great conquered Egypt and founded the city of Alexandria on the Mediterranean coast. After his death, his general Ptolemy became king, and his family ruled Egypt for nearly 300 years. The first Ptolemies built the Library as part of the Mouseion, a place where scholars lived and worked.',
      'The kings wanted a copy of every book. An ancient story says that books found on ships in Alexandria\'s harbor were taken and copied, and the owners were given the copies. The scholar Eratosthenes, who led the Library, used the shadows cast by the sun to work out the size of the Earth around 240 BC, and came remarkably close.',
    ]],
    ['How it ended', [
      'The Library did not vanish in a single fire. A fire during Julius Caesar\'s war in Alexandria in 48 BC may have burned some books, but the Library declined slowly over centuries, as money ran out and scholars left. In 2002, Egypt opened a new library in Alexandria, the Bibliotheca Alexandrina, in its honor.',
    ]],
  ],
  'art' => 'The illustration shows a grand sandstone library in the old Egyptian style, with scroll shelves and statues of seated scribes. The real Library stood in a Greek-style city, and no one knows exactly what it looked like.',
  'look' => ['Find the statues of seated scribes.', 'Look for the shelves of scrolls in the walls.'],
  'questions' => ['Why might a king want a copy of every book?', 'What would be lost if a big library disappeared?', 'How do libraries today keep their books safe?'],
  'words' => ['Mouseion' => 'A Greek "home of the Muses", a place of study and the origin of the word museum.', 'Scholar' => 'A person who studies a subject deeply.', 'Circumference' => 'The distance all the way around a circle or sphere.'],
  'sources' => ['brit-library', 'brit-eratosthenes', 'shaw'],
  'related' => ['house-of-life', 'scribe-school', 'temple-gateway'],
],

// ---------------- Food, work and trade ----------------
'market' => [
  'name' => 'Market', 'cat' => 'trade', 'src' => 'art/business_1.png',
  'summary' => 'Stalls of food, cloth and pottery where people swapped goods. Egyptians bartered: they traded goods for goods instead of paying with coins.',
  'facts' => ['Payment' => 'Barter: goods for goods', 'Values measured in' => 'Weights of copper (deben)', 'Oldest pictures' => 'Market scenes in tombs at Saqqara, about 2400 BC', 'Sold' => 'Bread, vegetables, fish, cloth, sandals and pots'],
  'sections' => [
    ['Swapping, not shopping', [
      'Carvings in tombs at Saqqara from around 2400 BC show busy market scenes: people swapping vegetables, fish, bread and cloth, and even a pet baboon grabbing a thief by the leg. Without coins, people agreed how much each thing was worth in weights of copper, called deben, and then traded goods of the same value.',
      'Records from the workers\' village of Deir el-Medina list the values of beds, chairs, coffins, goats and sandals, so we know roughly what everyday things cost.',
    ]],
    ['Goods from far away', [
      'Not everything came from Egypt. Cedar wood came from Lebanon and incense from the land of Punt to the south. Black peppercorns from India were even found in the nose of the mummy of Ramesses II, placed there when he was buried around 1213 BC.',
    ]],
  ],
  'art' => 'The illustration shows striped awnings over baskets of colorful spices, fruit, pots and cloth. Spices were used in Egypt, but most traded goods were everyday food and crafts.',
  'look' => ['Find the baskets of spices.', 'What else is for sale?'],
  'questions' => ['How would you agree a fair swap without money?', 'What problems could barter cause?', 'Where do the things in your kitchen come from?'],
  'words' => ['Barter' => 'Trading goods for other goods, without money.', 'Deben' => 'An Egyptian weight used to measure value.', 'Incense' => 'Sweet-smelling resin burned in temples.'],
  'sources' => ['brit-egypt', 'whe-deir', 'shaw'],
  'related' => ['granary', 'royal-treasury', 'caravan-camp'],
],

'granary' => [
  'name' => 'Granary', 'cat' => 'trade', 'src' => 'art/business_2.png',
  'summary' => 'Domed mud-brick stores for grain. Full granaries meant bread and beer all year, and protection against a poor flood.',
  'facts' => ['Built of' => 'Mud brick, often round with domed tops', 'Filled from' => 'Openings at the top, reached by ladders', 'Counted by' => 'Scribes who recorded every sack', 'Best model' => 'The granary of Meketre, about 1980 BC'],
  'sections' => [
    ['Grain is wealth', [
      'Each summer the Nile flooded, spreading water and rich black mud over the fields. A good flood meant a big harvest of wheat and barley, made into bread and beer, the everyday food and drink of Egypt. A low flood meant hunger, so storing grain from good years protected people in bad ones.',
      'Households had small granaries; temples and the state had enormous ones. The storerooms behind the Ramesseum, the memorial temple of Ramesses II, could hold enough grain to feed thousands of people.',
    ]],
    ['Counting every sack', [
      'A wooden model found in the tomb of an official named Meketre, made around 1980 BC, shows a granary at work: workers carry sacks up a stair and pour the grain into bins, while scribes sit by the door writing down every sack. The Bible tells a famous story of grain stored in Egypt: Joseph, who rose to be an official, filled the granaries during seven good years so that people could eat through seven years of famine.',
    ]],
  ],
  'art' => 'The illustration shows round domed granaries with ladders and sacks stacked in front, much like the granaries in Egyptian models and paintings.',
  'look' => ['Find the ladders. Why are they needed?', 'Count the domed stores.'],
  'questions' => ['Why is it wise to store food from good years?', 'What could spoil stored grain, and how would you stop it?', 'How do towns today make sure there is enough food?'],
  'words' => ['Granary' => 'A building for storing grain.', 'Harvest' => 'The time when crops are gathered.', 'Famine' => 'A time when there is not enough food.'],
  'sources' => ['met-meketre', 'brit-nile', 'un-thebes', 'shaw'],
  'related' => ['royal-treasury', 'market', 'palm-grove'],
],

'boat-workshop' => [
  'name' => 'Boat workshop', 'cat' => 'trade', 'src' => 'art/nt_workshop.png',
  'summary' => 'A shipyard where carpenters built the wooden boats that carried people and goods along the Nile.',
  'facts' => ['Wood' => 'Local acacia and sycamore; cedar from Lebanon', 'Joined with' => 'Wooden pegs, tenons and rope, not nails', 'Famous boat' => 'Khufu\'s boat, about 43 meters long', 'Found' => 'In a pit beside the Great Pyramid, 1954'],
  'sections' => [
    ['Boats without nails', [
      'Egypt had few tall trees, so boatbuilders often worked with short planks of local acacia wood, fitting them together like a jigsaw with wooden pegs and tenons and tying them with rope. For the biggest ships they imported long beams of cedar from Byblos, in what is now Lebanon.',
    ]],
    ['Khufu\'s boat', [
      'In 1954 archaeologists opened a sealed pit beside the Great Pyramid and found a full-size cedar boat taken apart into 1,224 pieces. It took years to put it back together. About 43 meters long and 4,500 years old, it is one of the oldest boats in the world. In 2021 it was moved to the Grand Egyptian Museum near Giza.',
    ]],
    ['Ships for the Red Sea', [
      'Some ships sailed far beyond the Nile. Archaeologists think they were built by the river, carried across the desert in pieces and put back together on the Red Sea coast. In caves at a harbor called Mersa Gawasis, they found cedar ship timbers, coils of rope and wooden cargo boxes, two of them labeled "the wonders of Punt", left there about 3,800 years ago.',
    ]],
  ],
  'art' => 'The illustration shows a shaded workshop where a wooden river boat is being built, with planks and tools around it.',
  'look' => ['Find the boat that is being built.', 'What tools can you see?'],
  'questions' => ['Why might boats be so important in a country built along a river?', 'Why would builders join planks with rope instead of nails?', 'What is built or made near where you live?'],
  'words' => ['Shipwright' => 'A person who builds ships.', 'Tenon' => 'A tongue of wood that fits into a slot to join two pieces.', 'Hull' => 'The main body of a boat.'],
  'sources' => ['lehner', 'brit-khufu', 'gawasis', 'shaw'],
  'related' => ['sailing-boat', 'papyrus-boat', 'building-materials'],
],

'caravan-camp' => [
  'name' => 'Desert camp', 'cat' => 'trade', 'src' => 'art/shared_1.png',
  'summary' => 'A shaded camp for travelers crossing the desert to mines, quarries and faraway lands.',
  'facts' => ['Pack animals' => 'Donkeys (camels came much later)', 'Went to' => 'Mines, quarries, oases and the Red Sea', 'Brought back' => 'Turquoise, copper, gold and fine stone', 'Famous journey' => 'Queen Hatshepsut\'s expedition to Punt'],
  'sections' => [
    ['Into the desert', [
      'The deserts on either side of the Nile held things Egypt needed: copper and turquoise in Sinai, gold and hard stone in the eastern desert. Kings sent expeditions of hundreds or even thousands of people, with donkeys carrying water and food. They dug wells, camped at night and carved their names on rocks along the way.',
    ]],
    ['The land of Punt', [
      'Around 1470 BC, Queen Hatshepsut sent ships down the Red Sea to the land of Punt, probably on the coast of East Africa. Carvings at her temple at Deir el-Bahari show the travelers bringing home incense trees, ebony, gold and baboons.',
    ]],
    ['The oldest map', [
      'The desert routes were known well enough to be drawn. The Turin Papyrus Map, made around 1160 BC for an expedition of King Ramesses IV, shows a desert valley with its roads, hills, a gold mine, the miners\' houses and a quarry of fine dark stone. It is the oldest known geological map, and it is kept today in the Egyptian Museum in Turin, Italy.',
    ]],
  ],
  'art' => 'The illustration shows a striped canopy over cushions and rugs around a small fire. Travelers\' camps were usually much simpler, but tents do appear in pictures of Egyptian army camps.',
  'look' => ['Find the fire in the middle.', 'Where would travelers sleep?'],
  'questions' => ['What would you need for a long journey across a desert?', 'Why might a country send people so far for stone and metal?', 'How do people travel to remote places today?'],
  'words' => ['Expedition' => 'A long journey made for a purpose.', 'Oasis' => 'A green place in a desert, with water.', 'Turquoise' => 'A blue-green stone used in jewelry.'],
  'sources' => ['brit-punt', 'brit-hatshepsut', 'turin-map', 'shaw'],
  'related' => ['market', 'watchtower', 'camel'],
],

// ---------------- Gardens and the Nile ----------------
'lotus-garden' => [
  'name' => 'Lotus garden', 'cat' => 'nile', 'src' => 'art/growth_1.png',
  'summary' => 'A walled garden with a pool, palms and flowers: the kind of garden wealthy Egyptians loved and painted on their tomb walls.',
  'facts' => ['Plants' => 'Date palms, sycamore figs, papyrus and lotus', 'Watered from' => 'The pool, filled by hand or with a shaduf', 'Famous picture' => 'The garden pool of Nebamun, about 1350 BC', 'Temple gardens' => 'Planted with incense trees from Punt'],
  'sections' => [
    ['A garden in the desert', [
      'Egypt hardly ever gets rain, so every garden had to be watered by hand. Wealthy households built walled gardens around a rectangular pool with fish, ducks and lotus flowers, shaded by palms and fig trees. A painting from the tomb of an official named Nebamun, now in the British Museum, shows such a garden: the pool seen from above, and the trees around it seen from the side.',
    ]],
    ['Gardens for the gods', [
      'Temples had gardens too, growing flowers and vegetables for offerings. At Deir el-Bahari, Queen Hatshepsut planted incense trees brought back from the land of Punt, and archaeologists have found the pits where their roots once grew.',
    ]],
    ['Flowers for a funeral', [
      'Flowers mattered at parties and at funerals. Collars made of real olive leaves, cornflowers, berries and blue beads, probably worn at the funeral feast of Tutankhamun, were buried in jars near his tomb. They survived for more than 3,300 years, and some are now in the Metropolitan Museum of Art in New York.',
    ]],
  ],
  'art' => 'The illustration shows a walled garden with a lotus pool, papyrus reeds, date palms and a shaded seat, very like the gardens in Egyptian paintings.',
  'look' => ['Find the lotus flowers in the pool.', 'Where could you sit in the shade?'],
  'questions' => ['Why would a garden be so precious in a dry land?', 'What would you plant in a garden with very little water?', 'How do gardens make people feel?'],
  'words' => ['Lotus' => 'The blue water lily of the Nile.', 'Shaduf' => 'A pole with a bucket and a weight, for lifting water.', 'Frankincense' => 'A sweet-smelling tree resin, burned as incense.'],
  'sources' => ['bm-nebamun', 'brit-hatshepsut', 'brit-shaduf', 'met-collar'],
  'related' => ['lotus-pool', 'palm-grove', 'garden-villa'],
],

'palm-grove' => [
  'name' => 'Palm grove', 'cat' => 'nile', 'src' => 'art/nt_garden.png',
  'summary' => 'Date palms beside a water channel. Palms gave Egyptians sweet fruit, shade, rope, baskets and roof beams.',
  'facts' => ['Main tree' => 'The date palm', 'Gave' => 'Fruit, shade, fiber, leaves and timber', 'Also grown' => 'Doum palms and sycamore figs', 'Farming seasons' => 'Flood, growing and harvest'],
  'sections' => [
    ['The useful palm', [
      'Dates were eaten fresh or dried, pressed into cakes and used to sweeten food, since honey was costly. Nothing went to waste: palm leaves were woven into baskets, mats, sandals and brooms, the fibers twisted into rope, and the trunks used as roof beams. The doum palm, whose trunk splits into branches, also gave fruit; doum nuts were placed in the tomb of Tutankhamun.',
    ]],
    ['Three seasons', [
      'Egyptian farmers divided the year into three seasons: the flood, when the fields lay under water; the growing season, when they plowed and sowed in the wet mud; and the harvest. Canals and basins held floodwater so that fields and palm groves could be watered for longer.',
    ]],
    ['A goddess in a tree', [
      'Trees were so precious that Egyptians linked them with the gods. Some tomb paintings show a goddess appearing out of a sycamore fig tree, pouring cool water and offering bread to the dead, just as a tree gives shade and fruit to the living.',
    ]],
  ],
  'art' => 'The illustration shows three date palms heavy with fruit beside a small water channel with a low mud-brick edge.',
  'look' => ['Find the clusters of dates.', 'Follow the water channel.'],
  'questions' => ['How many things can you make from one kind of tree?', 'Why would farmers dig canals?', 'Which plants are most useful where you live?'],
  'words' => ['Date' => 'The sweet fruit of the date palm.', 'Canal' => 'A man-made channel for water.', 'Season' => 'One of the parts of the year.'],
  'sources' => ['brit-nile', 'brit-egypt', 'shaw'],
  'related' => ['lotus-garden', 'granary', 'family-house'],
],

'lotus-pool' => [
  'name' => 'Lotus pool', 'cat' => 'nile', 'src' => 'art/fountain.png',
  'summary' => 'A small pool of blue water lilies. The lotus, which opens each morning, stood for the sun and new life.',
  'facts' => ['Flower' => 'The blue water lily, often called the blue lotus', 'Stood for' => 'The sun, rebirth and new life', 'Temples had' => 'Sacred lakes where priests washed', 'Biggest sacred lake' => 'Karnak, about 120 meters long'],
  'sections' => [
    ['Flower of the sun', [
      'The blue water lily opens in the morning and closes at night. Egyptians linked it with the sun and with creation: one story told that the young sun god rose from a lotus flower at the beginning of the world. Lotus flowers were carved on columns, painted on walls, worn at feasts and used to make perfume.',
    ]],
    ['Sacred lakes', [
      'Temples had stone-lined lakes, fed by water seeping up from the ground. Priests washed in them before ceremonies, because they had to be pure to serve the gods. The sacred lake at Karnak, about 120 meters long, can still be seen today.',
    ]],
    ['A king in a flower', [
      'Among the treasures from the tomb of Tutankhamun is a painted wooden head of the young king rising out of a blue lotus flower, like the sun god at the beginning of the world. It is one of the best-known pieces from his tomb.',
    ]],
  ],
  'art' => 'The little spout of water is the artist\'s touch: Egyptian garden pools held still water, not fountains.',
  'look' => ['Find the lotus flowers.', 'Where does the water come from?'],
  'questions' => ['Why might people link a flower that opens each morning with the sun?', 'Why would priests need to wash before a ceremony?', 'What flowers are special in your culture?'],
  'words' => ['Lotus' => 'The blue water lily of the Nile.', 'Sacred' => 'Holy, set apart for the gods.', 'Rebirth' => 'Being born again into new life.'],
  'sources' => ['brit-karnak', 'wilkinson', 'bm-nebamun', 'tut-carter'],
  'related' => ['lotus-garden', 'lotus-pavilion', 'hall-of-columns'],
],

'sailing-boat' => [
  'name' => 'Nile sailing boat', 'cat' => 'nile', 'src' => 'art/boat_1.png',
  'summary' => 'A wooden boat with a tall sail. On the Nile, boats sailed south with the wind and floated north with the current.',
  'facts' => ['Going south' => 'Sail up, pushed by the north wind', 'Going north' => 'Sail down, carried by the current', 'Carried' => 'People, grain, cattle and stone', 'In writing' => 'A boat with a sail meant "travel south"'],
  'sections' => [
    ['Egypt\'s highway', [
      'Almost everyone in Egypt lived close to the Nile, and the river was the main road. It flows from south to north, and the wind usually blows from the north. So boats raised their sail to travel south, against the current, and lowered it to float or row north. Even in writing, the sign for "travel south" was a boat with its sail up, and "travel north" a boat with its sail down.',
    ]],
    ['Boats for the next life', [
      'Wealthy Egyptians were buried with model boats so they could travel in the next life. The tomb of Meketre, from around 1980 BC, held a whole fleet of painted wooden models, with tiny sailors pulling ropes and steering.',
    ]],
    ['The sun\'s boat', [
      'Egyptians imagined that even the sun traveled by boat: the sun god Ra sailed across the sky every day and through the underworld every night. Temples kept small boat-shaped shrines for their gods, and kings were buried with boats too, like the great cedar boat found beside the pyramid of King Khufu.',
    ]],
  ],
  'art' => 'The illustration shows a wooden boat with a tall white triangular sail. Ancient Egyptian sails were tall and rectangular; triangular sails belong to later boats, like the feluccas still seen on the Nile.',
  'look' => ['Find the sailor steering at the back.', 'Which way is the wind blowing?'],
  'questions' => ['Why did the Nile make travel easy in one direction?', 'How do river boats carry goods today?', 'What is the main "highway" where you live?'],
  'words' => ['Current' => 'The flow of water in a river.', 'Upstream' => 'Against the flow of a river.', 'Rudder' => 'A paddle or blade used to steer a boat.'],
  'sources' => ['brit-nile', 'met-meketre', 'lehner', 'shaw'],
  'related' => ['papyrus-boat', 'boat-workshop', 'rowing-pool'],
],

'papyrus-boat' => [
  'name' => 'Papyrus boat', 'cat' => 'nile', 'src' => 'art/boat_2.png',
  'summary' => 'A light boat made from bundles of papyrus reeds, used for fishing and hunting birds in the marshes.',
  'facts' => ['Made of' => 'Bundles of papyrus reeds tied together', 'Used for' => 'Fishing, hunting birds and short trips', 'Seen in' => 'Tomb paintings of marsh hunts', 'Papyrus also made' => 'Paper, rope, sandals and baskets'],
  'sections' => [
    ['Boats of reeds', [
      'Papyrus grew thick in the marshes along the Nile. Tied in bundles, its stems made boats light enough for one person to carry. Fishermen cast nets from them, and paintings show wealthy Egyptians standing in papyrus boats to hunt birds in the reeds, as in the famous painting of Nebamun hunting in the marshes, in the British Museum.',
    ]],
    ['A plant of many uses', [
      'Papyrus was also turned into a writing material. Thin strips of the stem were laid side by side, a second layer was laid across them, and the sheet was pressed and dried. Our word "paper" comes from "papyrus".',
    ]],
    ['Across an ocean', [
      'How far could a reed boat go? In 1970 the Norwegian explorer Thor Heyerdahl and his crew sailed Ra II, a boat made of bundles of papyrus, across the Atlantic Ocean from Morocco to Barbados in 57 days. It was built by boatbuilders from Lake Titicaca in South America, where people still make boats of reeds.',
    ]],
  ],
  'art' => 'The illustration shows a reed boat with curled-up ends and a fisherman holding a net, very like the boats in Egyptian tomb paintings.',
  'look' => ['Find the curled-up ends of the boat.', 'What is the fisherman holding?'],
  'questions' => ['Why might reeds float so well?', 'What can people make from plants that grow near water?', 'Where does the paper you use come from?'],
  'words' => ['Papyrus' => 'A tall marsh reed, and the writing material made from it.', 'Marsh' => 'Low, wet land where reeds grow.', 'Net' => 'A mesh of knotted string for catching fish.'],
  'sources' => ['brit-papyrus', 'bm-nebamun', 'ra2', 'shaw'],
  'related' => ['sailing-boat', 'scribe-school', 'lotus-pool'],
],

// ---------------- Sports and feasts ----------------
'archery-range' => [
  'name' => 'Archery range', 'cat' => 'fun', 'src' => 'art/fitness_1.png',
  'summary' => 'A yard with straw targets where archers practiced. Egyptian kings boasted about their skill with the bow.',
  'facts' => ['Bows' => 'Simple wooden bows, later stronger composite bows', 'Composite bow arrived' => 'About 1600 BC', 'Royal boast' => 'Amenhotep II said his arrows went through copper targets', 'Found in' => 'Tutankhamun\'s tomb: dozens of bows and hundreds of arrows'],
  'sections' => [
    ['Bows for war and hunting', [
      'Archers were the backbone of Egypt\'s army, and hunting with a bow was a favorite sport of kings and nobles. Around 1600 BC, together with the horse and chariot, Egypt adopted the composite bow, made of layers of wood, horn and sinew glued together. It was harder to make but shot much farther than a simple wooden bow.',
    ]],
    ['A king\'s boast', [
      'King Amenhotep II, who ruled around 1420 BC, set up a stone slab near the Great Sphinx telling of his strength. It claims he shot arrows right through targets of copper as thick as a hand while driving his chariot. It is a royal boast rather than a measured record, but it shows how much Egyptians admired skill with the bow.',
    ]],
    ['An army of models', [
      'In the tomb of Mesehti, a governor at Asyut, archaeologists found two wooden companies of 40 soldiers each, made around 2000 BC: Egyptian spearmen with shields, and Nubian archers with bows and arrows. Nubian archers were so famous that Egyptians called Nubia Ta-Seti, "the land of the bow".',
    ]],
  ],
  'art' => 'The illustration shows a sandy yard with round straw targets, a rack of bows and a shaded stand for watchers.',
  'look' => ['Count the targets.', 'Find the rack of bows.'],
  'questions' => ['Why would an army need so many archers?', 'Why might a king want people to believe he was very strong?', 'Which sports today began as training for war or hunting?'],
  'words' => ['Composite bow' => 'A bow made of layers of wood, horn and sinew.', 'Sinew' => 'Tough tissue that joins muscle to bone.', 'Target' => 'A mark to aim at.'],
  'sources' => ['amenhotep2', 'tut-carter', 'mesehti', 'brit-nubia', 'shaw'],
  'related' => ['chariot-arena', 'watchtower', 'chariot'],
],

'rowing-pool' => [
  'name' => 'Rowing pool', 'cat' => 'fun', 'src' => 'art/fitness_2.png',
  'summary' => 'A long pool with a wooden dock for rowing practice. On the Nile, rowing was a vital skill, and kings bragged about it.',
  'facts' => ['Rowers needed' => 'To go north, and when there was no wind', 'Big ships had' => 'Dozens of rowers', 'Royal boast' => 'Amenhotep II said he rowed farther than 200 sailors', 'Temples had' => 'Stone-lined sacred lakes'],
  'sections' => [
    ['Life on the water', [
      'Boats carried almost everything in Egypt, from grain and cattle to giant blocks of stone, so the country needed many skilled rowers and sailors. Paintings and models show crews pulling long oars in time, with a steersman at the back holding a big steering oar.',
    ]],
    ['Showing off', [
      'King Amenhotep II, who ruled around 1420 BC, set up a stone slab near the Great Sphinx boasting of his strength. It says he took the steering oar of his boat and kept rowing long after a crew of 200 men had grown tired. Like his claim to have shot arrows through copper targets, it was meant to show that the king was stronger than anyone.',
    ]],
    ['Rowing for the gods', [
      'At the yearly Opet festival in Thebes, the boat-shaped shrines of the god Amun, his wife Mut and their son Khonsu traveled on great river barges from Karnak to Luxor temple, towed by boats full of rowers while crowds celebrated on the banks. Carvings in the colonnade of Luxor temple show the whole journey.',
    ]],
  ],
  'art' => 'The illustration shows a long sandstone pool with a wooden dock and a small rowing boat. A pool like this is the artist\'s idea; Egyptians learned to row on the river itself.',
  'look' => ['Find the rowing boat and its oars.', 'Where would you climb in?'],
  'questions' => ['Why must rowers pull their oars at the same time?', 'Why would rowing matter so much on the Nile?', 'What water sports do people enjoy today?'],
  'words' => ['Oar' => 'A long pole with a flat blade for rowing.', 'Crew' => 'The people who work a boat together.', 'Dock' => 'A platform where boats tie up.'],
  'sources' => ['amenhotep2', 'met-meketre', 'wilkinson', 'shaw'],
  'related' => ['sailing-boat', 'archery-range', 'lotus-pool'],
],

'chariot-arena' => [
  'name' => 'Chariot arena', 'cat' => 'fun', 'src' => 'art/fitness_3.png',
  'summary' => 'An imagined racing arena. Egyptians drove chariots in war, hunting and parades; races in a stadium came later, in Greek and Roman times.',
  'facts' => ['Chariots arrived' => 'About 1600 BC', 'Used for' => 'War, hunting and royal parades', 'Racetrack' => 'The hippodrome of Alexandria, built in Greek times', 'Famous find' => 'Six chariots in Tutankhamun\'s tomb'],
  'sections' => [
    ['Chariots come to Egypt', [
      'Light two-wheeled chariots pulled by horses reached Egypt around 1600 BC, probably with the Hyksos, rulers from western Asia who took over the north of the country. Egyptian kings soon built huge chariot forces. At the Battle of Kadesh in 1274 BC, Ramesses II fought the Hittites in one of the largest chariot battles ever recorded.',
    ]],
    ['Racing came later', [
      'No racing arena has been found from the time of the pharaohs. Chariot racing in a stadium arrived with the Greeks: after Alexander the Great, the Ptolemy kings built a hippodrome, or racetrack, at Alexandria. The Romans, who ruled Egypt after 30 BC, loved chariot racing too.',
    ]],
    ['A prince who loved horses', [
      'Horses were costly, and only kings, nobles and the army kept them. The stone slab that King Amenhotep II set up near the Great Sphinx says that as a young prince he cared for his father\'s horses at Memphis and trained them so well that they never tired.',
    ]],
  ],
  'art' => 'The oval arena with seats, banners and two racing chariots is imagined. It mixes Egyptian decoration with the kind of racetrack that Greeks and Romans built.',
  'look' => ['Find the two chariots on the track.', 'Where would the crowd sit?'],
  'questions' => ['How might the arrival of horses and chariots have changed Egypt?', 'Why do you think racing became so popular in later times?', 'What do people race today?'],
  'words' => ['Chariot' => 'A light two-wheeled vehicle pulled by horses.', 'Hippodrome' => 'A Greek racetrack for horses and chariots.', 'Hyksos' => 'Rulers from western Asia who controlled northern Egypt around 1650 to 1550 BC.'],
  'sources' => ['brit-chariot', 'tut-carter', 'amenhotep2', 'brit-library', 'shaw'],
  'related' => ['archery-range', 'chariot', 'pharaohs-palace'],
],

'feast-hall' => [
  'name' => 'Feast hall', 'cat' => 'fun', 'src' => 'art/shared_3.png',
  'summary' => 'A painted hall for banquets, with music, dancing, flowers and plenty to eat and drink.',
  'facts' => ['Seen in' => 'Tomb paintings, such as the tomb of Nebamun', 'Guests wore' => 'Fine linen, jewelry, lotus flowers and sometimes cones on their heads', 'Entertainment' => 'Harps, lutes, flutes, singers and dancers', 'Food' => 'Bread, beer, wine, roast meat, figs and dates'],
  'sections' => [
    ['A party in a painting', [
      'Tomb paintings show lively banquets: guests seated on chairs and mats, servants bringing food and drink, musicians playing harps and flutes, and dancers. Banquet scenes from the tomb of Nebamun, painted around 1350 BC and now in the British Museum, even show the guests chatting and offering each other flowers.',
    ]],
    ['Cones on their heads', [
      'In many paintings, guests wear small cones on top of their heads. For a long time people guessed they were lumps of scented fat. In 2019, archaeologists described two real cones made of wax, found in graves at Amarna, the first proof that they existed. What they were for is still a mystery.',
    ]],
    ['Songs at the party', [
      'Musicians played harps, lutes, flutes and drums while singers clapped the beat. Some paintings show a blind harpist, and the words of harpers\' songs survive. They tell guests to enjoy the day, put on perfume and fine linen, and be happy while they can.',
    ]],
  ],
  'art' => 'The illustration shows a columned hall with painted walls, banners and a long table set for a feast. Egyptian guests more often sat on chairs or mats with small tables of food.',
  'look' => ['Find the long table.', 'What decorations can you see on the walls?'],
  'questions' => ['What does a feast tell us about the people who held it?', 'Why might people paint party scenes in a tomb?', 'How do people celebrate together where you live?'],
  'words' => ['Banquet' => 'A large, special meal for many guests.', 'Lute' => 'A stringed instrument with a long neck.', 'Linen' => 'A light cloth made from the flax plant.'],
  'sources' => ['bm-nebamun', 'stevens', 'shaw'],
  'related' => ['pharaohs-palace', 'garden-villa', 'lotus-garden'],
],

// ---------------- Homes ----------------
'mud-brick-house' => [
  'name' => 'Mud-brick house', 'cat' => 'homes', 'src' => 'art/floor_s.png',
  'summary' => 'A small house of sun-dried mud brick: the home of most Egyptian farmers and workers.',
  'facts' => ['Built of' => 'Bricks of Nile mud, sand and straw', 'Dried by' => 'The sun', 'Roof' => 'Flat: palm logs, reeds and mud', 'Cool because of' => 'Thick walls and small windows'],
  'sections' => [
    ['Making mud bricks', [
      'Brickmakers mixed Nile mud with sand and chopped straw, pressed the mix into wooden molds and left the bricks to dry in the sun. A painting in the tomb of the official Rekhmire, from around 1450 BC, shows every step, from fetching water to stacking the finished bricks. Mud brick is cheap and keeps houses cool by day and warm at night, and many villages in Egypt still build with it today.',
    ]],
    ['Inside a small house', [
      'Ordinary houses had a few rooms in a row: a front room, a living room, small rooms for sleeping and storage, and a kitchen at the back, often open to the sky. A stair or ladder led to the flat roof. Families had stools, chests, baskets and pots; many people slept on mats.',
    ]],
  ],
  'art' => 'The illustration shows a small whitewashed mud-brick house with a flat roof, a striped awning over the door and clay pots by the wall.',
  'look' => ['Find the clay pots.', 'Look at the roof. Could you walk on it?'],
  'questions' => ['Why is mud brick a good building material in a hot, dry land?', 'What would happen to a mud-brick house in heavy rain?', 'What are the houses near you made of?'],
  'words' => ['Mud brick' => 'A brick made of mud and straw, dried in the sun.', 'Mold' => 'A frame that gives something its shape.', 'Whitewash' => 'A white paint made from lime.'],
  'sources' => ['rekhmire', 'whe-deir', 'kemp', 'shaw'],
  'related' => ['village-house', 'building-materials', 'family-house'],
],

'town-house' => [
  'name' => 'Town house', 'cat' => 'homes', 'src' => 'art/floor_m.png',
  'summary' => 'A tall house of two or three floors, built where towns were crowded and land was precious.',
  'facts' => ['Floors' => 'Two or three, sometimes more', 'Ground floor' => 'Workshops, storerooms or animals', 'Upper floors' => 'Living rooms and bedrooms', 'Evidence' => 'Tomb paintings and clay house models'],
  'sections' => [
    ['Building upward', [
      'In big towns like Thebes and Memphis, houses crowded together along narrow streets, and some rose several floors. Tomb paintings show tall houses with work going on downstairs and the family living above. Clay models of houses, called soul houses, were placed in tombs; some have stairs leading to an upper floor and a roof terrace.',
    ]],
    ['Lost under modern cities', [
      'We know much more about Egyptian tombs and temples than about town houses. Tombs and temples were built of stone in the dry desert, but towns stood on the river banks, were built of mud brick and often lie under modern towns today.',
    ]],
    ['A house in a painting', [
      'A painting in the tomb of Djehutynefer, a royal scribe at Thebes around 1420 BC, shows his house on three levels joined by stairs, with Djehutynefer and his scribes at work inside. It is one of very few pictures of the inside of an Egyptian town house.',
    ]],
  ],
  'art' => 'The illustration shows a three-story house of mud brick and sandstone with small windows, a painted blue band and a canopy on the roof.',
  'look' => ['Count the floors.', 'Find the canopy on the roof.'],
  'questions' => ['Why do people build upward in crowded places?', 'Why do houses last less well than temples?', 'How many floors do the homes near you have?'],
  'words' => ['Story' => 'One floor or level of a building, as in "a three-story house".', 'Soul house' => 'A clay model of a house placed in a tomb.', 'Terrace' => 'A flat outdoor space, often on a roof.'],
  'sources' => ['soulhouse', 'tt104', 'kemp', 'shaw'],
  'related' => ['rooftop-house', 'mud-brick-house', 'porch-house'],
],

'family-house' => [
  'name' => 'Family house', 'cat' => 'homes', 'src' => 'art/home_a.png',
  'summary' => 'A farming family\'s house with a palm tree, a little garden and stairs to the roof.',
  'facts' => ['Family' => 'Parents, children and often grandparents', 'Pets' => 'Cats, dogs and sometimes monkeys', 'Toys' => 'Balls, dolls, spinning tops and board games', 'Favorite game' => 'Senet, played on a board of 30 squares'],
  'sections' => [
    ['Family life', [
      'Families were the center of Egyptian life, and many generations often lived together. Children helped from an early age, carrying water, minding animals and working in the fields. Most boys learned their father\'s trade, and most girls learned to run a household.',
      'Archaeologists have found toys: balls of leather and reeds, dolls, spinning tops and wooden animals with jaws that open and shut. Adults and children played senet, a board game with 30 squares that was popular for more than 2,000 years.',
    ]],
    ['Women\'s rights', [
      'Egyptian women had more rights than in many ancient lands. They could own and inherit land, run businesses, make contracts and go to court, and some women ruled the country as queens and pharaohs.',
    ]],
    ['Growing up', [
      'Young children often wore no clothes at all in the heat. Many had their heads shaved except for one long lock of hair on the side, called the sidelock of youth, which was cut off as they grew up.',
    ]],
  ],
  'art' => 'The illustration shows a cozy mud-brick house with a palm tree, a small garden and steps up to the roof.',
  'look' => ['Find the steps to the roof.', 'Where is the palm tree?'],
  'questions' => ['How did children help their families?', 'Which toys from ancient Egypt are still played with today?', 'What rights should everyone in a family have?'],
  'words' => ['Senet' => 'An ancient Egyptian board game.', 'Inherit' => 'To receive property from someone who has died.', 'Generation' => 'People born and living at about the same time.'],
  'sources' => ['brit-egypt', 'shaw'],
  'related' => ['mud-brick-house', 'palm-grove', 'granary'],
],

'porch-house' => [
  'name' => 'House with a porch', 'cat' => 'homes', 'src' => 'art/home_b.png',
  'summary' => 'A two-story house with a columned porch, the kind of home a scribe or an official might have had.',
  'facts' => ['Owners' => 'Scribes, priests and officials', 'Columns' => 'Wood, often painted', 'Windows' => 'Small and high, to keep out heat and dust', 'Pillows' => 'Headrests of wood or stone'],
  'sections' => [
    ['A comfortable home', [
      'People with good jobs, such as scribes and officials, lived in larger houses. Walls were plastered and painted, and a main room had wooden columns holding up the roof. Furniture included beds, chairs, chests and small tables. Instead of soft pillows, people slept with their head on a curved headrest of wood or stone.',
    ]],
    ['Keeping cool', [
      'Thick walls kept out the heat, and windows were small and set high up to let out hot air and keep out dust and glare. Porches gave shade, and houses were often built to catch the cool breeze that blows from the north.',
    ]],
    ['Gods at home', [
      'Families prayed at home as well as in temples. Many houses had a niche in the wall for a small statue of a household god, such as Bes, who was thought to scare away snakes and bad dreams, or Taweret, a hippopotamus goddess who protected mothers and babies.',
    ]],
  ],
  'art' => 'The illustration shows a two-story whitewashed house with a columned porch, an awning on the roof and pots of flowers.',
  'look' => ['Find the columns of the porch.', 'Look for the flower pots.'],
  'questions' => ['How did Egyptian houses stay cool without air conditioning?', 'What would it be like to sleep on a headrest?', 'How are homes near you kept cool or warm?'],
  'words' => ['Porch' => 'A covered area at the entrance of a house.', 'Headrest' => 'A curved stand for the head, used instead of a pillow.', 'Official' => 'A person who works for the government.'],
  'sources' => ['kemp', 'brit-amarna', 'shaw'],
  'related' => ['courtyard-villa', 'scribe-school', 'town-house'],
],

'village-house' => [
  'name' => 'Village house', 'cat' => 'homes', 'src' => 'art/family_1.png',
  'summary' => 'A house in a village like Deir el-Medina, home of the workers who dug and decorated the royal tombs in the Valley of the Kings.',
  'facts' => ['Real example' => 'Deir el-Medina, near Luxor', 'Houses' => 'About 68 inside the village wall', 'Lived in' => 'About 1550 to 1070 BC', 'Famous for' => 'Thousands of notes written on pottery and stone'],
  'sections' => [
    ['The tomb builders\' village', [
      'The skilled workers who dug and decorated the royal tombs, such as stonecutters, plasterers, painters and scribes, lived with their families in a walled village called Deir el-Medina. Its houses stood in rows along a narrow street, with a front room, a living room, back rooms and a kitchen, and stairs to the roof, where people slept on hot nights. Water had to be carried up to the village by donkey.',
    ]],
    ['Notes that survive', [
      'Many villagers could read and write, and thousands of their notes survive on pieces of pottery and stone: letters, laundry lists, loans and school exercises. A list of workers even gives reasons for missing work, such as a scorpion sting or brewing beer.',
      'Around 1157 BC, when the workers\' grain was not delivered on time, they stopped work and sat down by the temples in protest. It is the first strike known in history.',
    ]],
  ],
  'art' => 'The illustration shows a mud-brick family house with a courtyard, a palm tree, a clay oven and a rooftop awning.',
  'look' => ['Find the clay oven.', 'Where would the family sleep on hot nights?'],
  'questions' => ['Why would the tomb builders live in their own village?', 'What can everyday notes tell us that monuments cannot?', 'Why might workers go on strike?'],
  'words' => ['Strike' => 'When workers stop working to protest.', 'Ostracon' => 'A piece of pottery or stone used for writing.', 'Ration' => 'A fixed amount of food given out regularly.'],
  'sources' => ['whe-deir', 'turin-strike', 'un-thebes', 'shaw'],
  'related' => ['mud-brick-house', 'scribe-school', 'granary'],
],

'courtyard-villa' => [
  'name' => 'Courtyard villa', 'cat' => 'homes', 'src' => 'art/family_2.png',
  'summary' => 'A walled villa built around courtyards, with its own well, granaries and garden, like the houses of officials at Amarna.',
  'facts' => ['Real example' => 'The villas of Amarna, about 1345 BC', 'Inside the walls' => 'House, garden, well, granaries and stables', 'Center' => 'A tall main room lit by high windows', 'Bathroom' => 'A stone slab for washing and a toilet seat'],
  'sections' => [
    ['A city built in a hurry', [
      'Around 1346 BC, King Akhenaten built a new capital, Akhetaten, now called Amarna, in honor of the sun disk, the Aten. Soon after his death the city was abandoned, so its houses were never built over. This gives archaeologists a rare view of a whole Egyptian city.',
    ]],
    ['Inside a villa', [
      'Wealthy families at Amarna lived in walled compounds. The house had a tall central room with high windows, bedrooms and even a bathroom, with a stone slab for washing and a toilet seat. Around it stood a well, a garden, round granaries, stables, kitchens and rooms for servants.',
    ]],
    ['A queen in a workshop', [
      'In 1912, archaeologists digging at Amarna found the painted bust of Queen Nefertiti, Akhenaten\'s wife, in the house and workshop of a sculptor named Thutmose. It had been left behind when the city was abandoned. Today it is in the Neues Museum in Berlin.',
    ]],
  ],
  'art' => 'The illustration shows a large villa built around a courtyard with a lotus pool and palms.',
  'look' => ['Find the pool in the courtyard.', 'How many different buildings can you see inside the walls?'],
  'questions' => ['Why might a rich family want everything inside its own walls?', 'Why is an abandoned city so useful to archaeologists?', 'What would you put in your own courtyard?'],
  'words' => ['Villa' => 'A large house, often with gardens.', 'Compound' => 'A group of buildings inside one wall.', 'Courtyard' => 'An open space surrounded by buildings or walls.'],
  'sources' => ['brit-amarna', 'kemp', 'shaw'],
  'related' => ['garden-villa', 'porch-house', 'granary'],
],

'garden-villa' => [
  'name' => 'Garden villa', 'cat' => 'homes', 'src' => 'art/family_3.png',
  'summary' => 'A large villa with shady porches, palm gardens and lotus pools: a wealthy family\'s dream home.',
  'facts' => ['Owners' => 'High officials and nobles', 'Garden' => 'Pools with fish, ducks and lotus flowers', 'Trees' => 'Date palms, sycamore figs and pomegranates', 'Model' => 'Meketre\'s porch and garden, about 1980 BC'],
  'sections' => [
    ['The good life', [
      'A wooden model from the tomb of the official Meketre, now in New York\'s Metropolitan Museum of Art, shows a porch with painted columns looking out over a pool surrounded by sycamore fig trees. It was made so that Meketre could enjoy his garden forever.',
    ]],
    ['A home for the next life', [
      'Egyptians hoped the next life would be like the best of this one. A painted scroll called the Book of the Dead of Nakht, in the British Museum, shows Nakht and his wife beside their house and garden pool, a picture of the life they hoped to go on enjoying after death.',
    ]],
    ['Food from the garden', [
      'Gardens fed the family as well as giving shade. Egyptians grew grapes for wine and raisins, figs, dates and, later, pomegranates, with vegetables such as onions, leeks, lettuce and cucumbers, all watered by hand from a pool or a well.',
    ]],
  ],
  'art' => 'The illustration shows a large villa with whitewashed walls, a palm garden, two lotus pools and shady columned porches.',
  'look' => ['Find the two pools.', 'Where would you sit to stay out of the sun?'],
  'questions' => ['What does a dream home tell us about what people value?', 'Why might someone want a model of their garden in their tomb?', 'What would your dream home look like?'],
  'words' => ['Noble' => 'A person of high rank.', 'Pomegranate' => 'A round fruit full of juicy red seeds.', 'Book of the Dead' => 'A collection of spells meant to help the dead in the next life.'],
  'sources' => ['met-meketre', 'bm-nakht', 'bm-nebamun', 'shaw'],
  'related' => ['lotus-garden', 'courtyard-villa', 'feast-hall'],
],

'rooftop-house' => [
  'name' => 'Rooftop house', 'cat' => 'homes', 'src' => 'art/shared_2.png',
  'summary' => 'A family house with a big canopy on the roof. Egyptians used their flat roofs for sleeping, working and drying food.',
  'facts' => ['Roofs were' => 'Flat, reached by stairs or ladders', 'Used for' => 'Sleeping on hot nights, drying food and storing fuel', 'Shade from' => 'Canopies of reeds or linen', 'Still seen' => 'In villages along the Nile today'],
  'sections' => [
    ['Life on the roof', [
      'In a land with almost no rain, a flat roof is an extra room. Egyptians climbed up to sleep in the cool night air, dry fish, fruit and grain, spin thread, and store fuel and animal fodder. At the workers\' village of Deir el-Medina, stairs led from the houses up to the roofs.',
    ]],
    ['Catching the breeze', [
      'The cooler wind in Egypt usually blows from the north, off the Mediterranean Sea. Houses were often built to catch it, with openings facing north, and shady canopies made the roof a pleasant place to sit in the evening.',
    ]],
    ['A roof for the next life', [
      'Clay "soul house" models placed in tombs often have stairs to the roof and a little shelter on top. They were meant to give the dead a home, with a cool roof to rest on, in the next life.',
    ]],
  ],
  'art' => 'The illustration shows a two-story family house with a big rooftop canopy, beds and cushions on the roof, and palm trees.',
  'look' => ['Find the beds on the roof.', 'What gives the roof shade?'],
  'questions' => ['Why would people sleep on the roof?', 'What could a roof be used for where you live?', 'How do the people near you cope with very hot weather?'],
  'words' => ['Canopy' => 'A cloth or reed cover that gives shade.', 'Fodder' => 'Food for farm animals.', 'Breeze' => 'A gentle wind.'],
  'sources' => ['whe-deir', 'soulhouse', 'kemp', 'shaw'],
  'related' => ['town-house', 'family-house', 'palm-grove'],
],

// ---------------- Building and defense ----------------
'watchtower' => [
  'name' => 'Watchtower', 'cat' => 'build', 'src' => 'art/nt_tower.png',
  'summary' => 'A slim lookout tower. Egypt guarded its borders with forts and watchposts, especially in the south, toward Nubia.',
  'facts' => ['Biggest forts' => 'Along the Nile in Nubia, about 1900 BC', 'Famous fort' => 'Buhen, with walls and towers of mud brick', 'Desert guards' => 'The Medjay', 'Reports' => 'Letters sent between the forts'],
  'sections' => [
    ['Guarding the south', [
      'Around 1900 BC, Egyptian kings built a chain of mud-brick forts along the Nile in Nubia, to the south. The fort at Buhen had thick walls with towers, a deep ditch and a drawbridge. Soldiers there sent letters to one another reporting everyone who passed by. Most of these forts now lie under Lake Nasser, the huge lake behind the Aswan High Dam.',
    ]],
    ['The Medjay', [
      'The Medjay were at first Nubian desert scouts who worked for Egypt. Later the name was used for a kind of police, who guarded the desert roads and the royal tombs in the Valley of the Kings.',
    ]],
    ['Saved from the lake', [
      'When the Aswan High Dam was built in the 1960s, its rising lake covered most of the old forts. Archaeologists recorded Buhen before the water came, and its stone temple, built in the time of Queen Hatshepsut, was taken apart and rebuilt in the garden of the National Museum of Sudan in Khartoum.',
    ]],
  ],
  'art' => 'The illustration shows a slim mud-brick lookout tower with a shaded top and a small banner.',
  'look' => ['Find the shaded lookout at the top.', 'Where would the guard climb up?'],
  'questions' => ['Why would a country build forts along its borders?', 'How could guards send news quickly without phones?', 'Who keeps watch over your town?'],
  'words' => ['Fort' => 'A strong building where soldiers live and keep guard.', 'Border' => 'The line where one country ends and another begins.', 'Scout' => 'A person sent ahead to look around.'],
  'sources' => ['brit-nubia', 'un-nubia', 'brit-egypt', 'shaw'],
  'related' => ['caravan-camp', 'archery-range', 'temple-gateway'],
],

'lifting-lever' => [
  'name' => 'Lifting lever', 'cat' => 'build', 'src' => 'build/crane.png',
  'summary' => 'A wooden lever with a counterweight, like the shaduf Egyptians used to lift water. Builders moved giant stones with levers, ramps and sledges.',
  'facts' => ['Shaduf' => 'A pole with a bucket and a counterweight, for water', 'In Egypt from' => 'About 1500 BC', 'Moving stone' => 'Sledges, ramps, levers and boats', 'Big cranes' => 'Came later, in Greek and Roman times'],
  'sections' => [
    ['Lifting water', [
      'A shaduf is a long pole balanced on a post, with a bucket on one end and a heavy weight of clay or stone on the other. Pulling the bucket down into the river and letting the weight swing it back up, one person could lift water all day to water gardens and fields. Shadufs appear in Egyptian tomb paintings from about 1500 BC, and some are still used today.',
    ]],
    ['Moving giant stones', [
      'Egyptian builders had no big cranes. They moved heavy blocks on wooden sledges, pulled them up ramps of mud brick and rubble, and used levers to raise them a little at a time. The Greek writer Herodotus said the pyramids were built with lifting machines made of short timbers, but he was writing about 2,000 years later, and builders still argue about exactly how the heaviest stones were raised.',
    ]],
  ],
  'art' => 'The illustration shows a tall wooden lever on a mud-brick base lifting a sandstone block on a rope, with a clay counterweight at the other end. It mixes the design of a shaduf with a building site.',
  'look' => ['Find the counterweight.', 'Follow the rope down to the stone block.'],
  'questions' => ['How does a counterweight make lifting easier?', 'Why might builders argue about how the pyramids were built?', 'What machines lift heavy things today?'],
  'words' => ['Lever' => 'A bar that turns on a fixed point to help lift a load.', 'Counterweight' => 'A weight that balances a load.', 'Ramp' => 'A sloping surface that joins a lower and a higher level.'],
  'sources' => ['brit-shaduf', 'arnold', 'herodotus', 'lehner'],
  'related' => ['building-materials', 'pyramid', 'stone-sledge'],
],

'building-materials' => [
  'name' => 'Building materials', 'cat' => 'build', 'src' => 'build/materials.png',
  'summary' => 'Sandstone blocks, mud bricks, reeds and copper tools: what Egyptians built with.',
  'facts' => ['Houses and palaces' => 'Mud brick', 'Temples and tombs' => 'Limestone, sandstone and granite', 'Tools' => 'Copper chisels and saws, stone pounders, wooden mallets', 'Iron tools' => 'Rare until about 600 BC'],
  'sections' => [
    ['Stone for eternity', [
      'Egyptians built their homes of mud brick but their temples and tombs of stone, because those were meant to last forever. Limestone came from quarries near Giza and at Tura, sandstone from Gebel el-Silsila in the south, and hard granite from Aswan.',
    ]],
    ['Tools', [
      'Stonemasons cut soft stone with copper chisels and saws. To cut hard granite they used copper saws with sand as a grinding powder, and pounded the rock with balls of even harder stone. Plumb lines and set squares helped them keep walls straight and corners square. Roofs of houses were made of palm logs, reeds and mud.',
    ]],
    ['A ramp in a quarry', [
      'In 2018, archaeologists at Hatnub, a quarry of white alabaster stone in the eastern desert, found a steep ramp with a staircase on each side and holes for wooden posts. Ropes tied around the posts could help workers haul sledges of stone up the slope. It is at least as old as the time of King Khufu, about 4,500 years ago.',
    ]],
  ],
  'art' => 'The illustration shows a neat pile of cut sandstone blocks, a stack of mud bricks, a bundle of reeds and a jar of tools.',
  'look' => ['Find the bundle of reeds.', 'Which materials would be used for a temple, and which for a house?'],
  'questions' => ['Why build temples of stone but houses of mud brick?', 'How do you cut a stone that is harder than your tools?', 'What are buildings near you made of?'],
  'words' => ['Chisel' => 'A tool with a sharp edge for cutting stone or wood.', 'Plumb line' => 'A string with a weight, used to check that something is upright.', 'Granite' => 'A very hard, speckled rock.'],
  'sources' => ['arnold', 'rekhmire', 'hatnub', 'lehner', 'brit-egypt'],
  'related' => ['lifting-lever', 'mud-brick-house', 'obelisk'],
],
];

$WORLD_DATA['egypt'] = [
  'title'    => 'Ancient Egypt: 37 places and how they worked',
  'desc'     => 'Explore an illustrated city of ancient Egypt: 37 places from the pyramids to a scribe school, how each one worked, and photos of the real sites.',
  'intro'    => 'Ancient Egypt grew up along the Nile and lasted about 3,000 years. Explore 37 of its places: what each one was for, how it worked and where you can still see real examples today.',
  'note'     => 'The buildings are illustrations, not exact reconstructions. Each page separates what history tells us from what the artist imagined, and lists its sources.',
  'aka'      => 'Ancient Egyptian',
  'akaLang'  => 'egy',
  'pageTitle'=> '%s in Ancient Egypt: how it worked',
  'pageTitleShort' => '%s in Ancient Egypt',
  'defaultTag' => 'history',
  'aside'    => ['About dates', 'Ancient Egypt lasted about 3,000 years, from around 3100 BC until 30 BC, when it became part of the Roman Empire. Dates marked BC count backwards, so 2560 BC came long before 1350 BC. Many dates are only approximate.'],
  'pageDesc' => ' Learn how it worked, what history tells us and what the artist imagined, with questions for discussion.',
  'pageDescShort' => ' Learn how it worked, with questions to discuss.',
  'sourcesIntro' => 'The history on this page is a short summary based on these sources:',
  'about'    => 'Ancient Egyptian architecture and daily life',
  // Positions on the 6 x 6 map, from the back corner (0) to the front corner (35). Tall pieces stand at the back.
  // The two boats have pages but are not on the map.
  'map' => [
    'lifting-lever', 'obelisk', 'watchtower', 'pyramid', 'temple-gateway', 'twin-colossi',
    'hall-of-columns', 'pharaohs-palace', 'royal-treasury', 'great-library', 'house-of-life', 'sphinx',
    'chariot-arena', 'lotus-pavilion', 'town-house', 'rooftop-house', 'porch-house', 'scribe-school',
    'courtyard-villa', 'garden-villa', 'market', 'feast-hall', 'village-house', 'family-house',
    'granary', 'boat-workshop', 'caravan-camp', 'archery-range', 'mud-brick-house', 'cat-statue',
    'lotus-garden', 'palm-grove', 'tree', 'lotus-pool', 'building-materials', 'rowing-pool',
  ],
  'tree'     => 'date-palm',
  'sources'  => $EGYPT_SOURCES,
  'cats'     => $EGYPT_CATEGORIES,
  'pages'    => $EGYPT,
];
