<?php
// Ancient Rome: one page per building (see the shared page format at the end of this file).
// Facts are kept to well-established points from the
// sources listed in $ROMAN_SOURCES (shown on each page as plain text, not links).
// "art" describes what is the artist's interpretation. Photos come from build/photo-credits.json.

$ROMAN_SOURCES = [
  'brit-aqueduct'  => 'Encyclopaedia Britannica, "Aqueduct"',
  'brit-thermae'   => 'Encyclopaedia Britannica, "Thermae" and "Baths of Caracalla"',
  'brit-circus'    => 'Encyclopaedia Britannica, "Circus" and "Chariot racing"',
  'brit-basilica'  => 'Encyclopaedia Britannica, "Basilica" and "Basilica Ulpia"',
  'brit-arch'      => 'Encyclopaedia Britannica, "Arch of Titus", "Arch of Constantine" and "Arch of Septimius Severus"',
  'brit-vesta'     => 'Encyclopaedia Britannica, "Vesta"',
  'brit-aerarium'  => 'Encyclopaedia Britannica, "Aerarium"',
  'brit-forum'     => 'Encyclopaedia Britannica, "Roman Forum"',
  'brit-colosseum' => 'Encyclopaedia Britannica, "Colosseum"',
  'brit-ephesus'   => 'Encyclopaedia Britannica, "Ephesus"',
  'brit-pantheon'  => 'Encyclopaedia Britannica, "Pantheon"',
  'brit-trajan'    => 'Encyclopaedia Britannica, "Trajan\'s Column"',
  'brit-walls'     => 'Encyclopaedia Britannica, "Aurelian Wall" and "Hadrian\'s Wall"',
  'brit-concrete'  => 'Encyclopaedia Britannica, "Pozzolana" and "Concrete"',
  'sh-colosseum'   => 'Smarthistory, "The Colosseum"',
  'sh-pantheon'    => 'Smarthistory, "The Pantheon, Rome"',
  'sh-insula'      => 'Smarthistory, "Roman domestic architecture: the insula"',
  'sh-domus'       => 'Smarthistory, "Roman domestic architecture: the domus"',
  'sh-forum'       => 'Smarthistory, "The Roman Forum (Forum Romanum)"',
  'sh-portunus'    => 'Smarthistory, "Temple of Portunus, Rome"',
  'sh-constantine' => 'Smarthistory, "Arch of Constantine"',
  'sh-caracalla'   => 'Smarthistory, "Baths of Caracalla"',
  'sh-villa'       => 'Smarthistory, "The villa" and "A virtual tour of Hadrian\'s Villa"',
  'sh-domusaurea'  => 'Smarthistory, "The Domus Aurea, Nero\'s Golden Palace"',
  'sh-haterii'     => 'Smarthistory, "Roman funeral rituals and social status: the Amiternum tomb and the Tomb of the Haterii"',
  'sh-augustus'    => 'Smarthistory, "Augustus of Primaporta"',
  'sh-ostia'       => 'Smarthistory, "Ostia: an introduction"',
  'un-hercules'    => 'UNESCO World Heritage Centre, "Tower of Hercules"',
  'un-pontdugard'  => 'UNESCO World Heritage Centre, "Pont du Gard (Roman Aqueduct)"',
  'un-segovia'     => 'UNESCO World Heritage Centre, "Old Town of Segovia and its Aqueduct"',
  'un-hadrianvilla'=> 'UNESCO World Heritage Centre, "Villa Adriana (Tivoli)"',
  'un-casale'      => 'UNESCO World Heritage Centre, "Villa Romana del Casale"',
  'un-pompeii'     => 'UNESCO World Heritage Centre, "Archaeological Areas of Pompei, Herculaneum and Torre Annunziata"',
  'un-rome'        => 'UNESCO World Heritage Centre, "Historic Centre of Rome"',
  'un-ephesus'     => 'UNESCO World Heritage Centre, "Ephesus"',
  'un-frontiers'   => 'UNESCO World Heritage Centre, "Frontiers of the Roman Empire"',
  'un-maison'      => 'UNESCO World Heritage Centre, "Maison Carrée of Nîmes"',
  'un-elJem'       => 'UNESCO World Heritage Centre, "Amphitheatre of El Jem"',
  'pk-colosseo'    => 'Parco archeologico del Colosseo, "Gladiators in the Arena: between Colosseum and Ludus Magnus"',
  'pk-pompeii'     => 'Parco Archeologico di Pompei, announcements on the Regio V thermopolium (2020)',
  'anc-vitruvius'  => 'Vitruvius, On Architecture (1st century BC), Books 2, 5, 8 and 10',
  'anc-frontinus'  => 'Frontinus, The Aqueducts of Rome (about AD 97)',
  'anc-seneca'     => 'Seneca, Letters to Lucilius, Letter 56 (on the noise of a bathhouse)',
  'anc-pliny'      => 'Pliny the Younger, Letters, Book 2, Letter 17 (his villa at Laurentum)',
  'anc-cato'       => 'Cato the Elder, On Agriculture; Columella, On Agriculture',
  'anc-quintilian' => 'Quintilian, The Orator\'s Education, Book 1',
  'anc-suetonius'  => 'Suetonius, Lives of the Caesars: Augustus, Claudius and Nero',
  'brit-appia'     => 'Encyclopaedia Britannica, "Appian Way"',
  'brit-edu'       => 'Encyclopaedia Britannica, "Education": the Roman world',
  'brit-tombs'     => 'Encyclopaedia Britannica, "Mausoleum of Augustus" and "Castel Sant\'Angelo"',
  'anc-strabo'     => 'Strabo, Geography, Book 5',
];

// category => [label, short description]
$ROMAN_CATEGORIES = [
  'water'   => ['Water and health', 'How the city brought in clean water and kept people clean.'],
  'govern'  => ['Government, law and money', 'Where Romans debated, judged, kept records and stored public money.'],
  'belief'  => ['Temples and memorials', 'Places of worship and monuments that told the city\'s story.'],
  'fun'     => ['Shows and games', 'Where huge crowds gathered to watch races and contests.'],
  'homes'   => ['Homes', 'How Romans lived, from crowded apartments to palaces.'],
  'trade'   => ['Food, work and trade', 'Shops, snack bars, inns and warehouses that kept the city fed.'],
  'learn'   => ['Learning', 'Schools, libraries and the city\'s written records.'],
  'land'    => ['Gardens and farmland', 'Plants, farms and the food that came from the land.'],
  'safety'  => ['Defence and travel', 'Walls that protected the city and lights that guided ships.'],
  'build'   => ['Building the city', 'The machines and materials Roman builders used.'],
];

$ROMAN = [

// ---------------- Water and health ----------------
'aqueduct' => [
  'name' => 'Aqueduct', 'latin' => 'aquaeductus', 'cat' => 'water', 'src' => 'build/aqueduct.png',
  'summary' => 'A channel that carried fresh water from hills and springs many kilometres away into the city, using only gravity.',
  'facts' => ['Used for' => 'Bringing clean water into the city', 'First in Rome' => 'Aqua Appia, 312 BC', 'Powered by' => 'Gravity and a gentle downhill slope', 'Still standing' => 'Pont du Gard (France), Segovia (Spain)'],
  'sections' => [
    ['What it was', [
      'An aqueduct is a man-made channel for moving water. The Romans did not invent the idea, but they built aqueducts on a scale no one had before. The first one to supply the city of Rome, the Aqua Appia, was built in 312 BC. Over the following centuries more were added, and by the 3rd century AD the city was served by eleven major aqueducts.',
      'Most people picture tall stone arches, but arches were only a small part of the story. Most of a Roman aqueduct ran underground in a covered channel, which kept the water clean, cool and safe from attack.',
    ]],
    ['How it worked', [
      'Water flows downhill, so engineers surveyed the land carefully and built the channel with a very slight, steady slope all the way from the source to the city. If the slope was too steep the water would rush and wear away the channel; too gentle and it would stop flowing.',
      'When the route had to cross a valley, builders raised the channel on rows of arches so the slope could stay the same. The arched bridges we see today, such as the Pont du Gard in France, are these valley crossings.',
    ], ['list' => [
      'Water was collected at a spring, river or lake in the hills.',
      'It ran through a covered channel lined with waterproof mortar, mostly below ground.',
      'Settling tanks let mud and sand sink to the bottom.',
      'In the city, the water reached a distribution building (a castellum) that split it into pipes.',
      'Lead or clay pipes carried it to public fountains, baths and some private houses.',
    ]]],
    ['Who looked after it', [
      'Aqueducts needed constant care: cleaning out mineral deposits, fixing leaks and stopping people from secretly tapping the pipes. Around AD 97, a senator named Frontinus was put in charge of Rome\'s water supply. He wrote a detailed book describing each aqueduct, how much water it carried and the problems of theft and poor repair. It is one of the best sources we have on how the system was run.',
    ]],
    ['Places you can still see', [
      'The Pont du Gard in southern France carried water to the Roman city of Nîmes and is almost 50 metres high, with three levels of arches. The aqueduct of Segovia in Spain still crosses the middle of the town, built from granite blocks fitted together without mortar. Near Rome, the Park of the Aqueducts preserves long stretches of arches marching across the countryside.',
    ]],
  ],
  'art' => 'This short arched section is a simplified illustration. Real aqueduct bridges were much longer, and most of the channel was hidden underground.',
  'look' => ['Find the water channel running along the top of the arches.', 'Notice how the arches keep the channel level across the gap.'],
  'questions' => ['Why might engineers keep most of the channel underground?', 'Where does the water in your home come from, and how does it get there?', 'What would happen to a city if its aqueduct were cut off?'],
  'words' => ['Gradient' => 'How steeply something slopes.', 'Castellum' => 'A building where incoming water was divided into pipes.', 'Arcade' => 'A row of arches.'],
  'sources' => ['brit-aqueduct', 'anc-frontinus', 'anc-vitruvius', 'un-pontdugard', 'un-segovia'],
  'related' => ['public-fountain', 'public-baths', 'building-materials'],
],

'public-fountain' => [
  'name' => 'Public fountain', 'latin' => 'lacus', 'cat' => 'water', 'src' => 'art/fountain.png',
  'summary' => 'A stone basin on a street corner where anyone could collect fresh water from the aqueducts.',
  'facts' => ['Used for' => 'Drinking, cooking and washing water', 'Who used it' => 'Most city households', 'Water supply' => 'Aqueduct water flowing all the time', 'Best seen at' => 'Pompeii and Herculaneum'],
  'sections' => [
    ['What it was', [
      'Only wealthy households could pay for water piped straight into their homes. Everyone else collected water from public fountains. In Roman towns these were usually simple rectangular basins made of stone slabs, placed at street corners with a spout that poured water in continuously.',
      'In Pompeii, archaeologists have found street fountains spread across the town so that most homes were only a short walk from one. Some basins still have smooth, worn spots on the rim where people leaned to fill their jars.',
    ]],
    ['How it worked', [
      'Roman fountains had no taps. Water from the aqueduct ran into the basin day and night, and the overflow spilled into the street. This running water helped wash the streets and drains clean. Public fountains were given first claim on the water supply, ahead of baths and private homes, so ordinary people would not go without.',
      'Many spouts were carved with faces of gods, animals or masks, which made each fountain a small landmark people could use to give directions.',
    ]],
    ['Life at the fountain', [
      'Fetching water was a daily job, often done by children, servants or enslaved workers. Carrying heavy jars meant the fountain was a meeting place where neighbours talked and news spread. In the city of Rome, the water commissioner Frontinus wrote about the importance of keeping the public basins supplied.',
    ]],
  ],
  'art' => 'This fountain is grander than the plain street basins found in Pompeii. Its design is the artist\'s own.',
  'look' => ['Find where the water pours in and where it overflows.', 'Look at the carved stone around the spout.'],
  'questions' => ['Who would use a public fountain, and how often?', 'How would daily life change if your home had no running water?', 'Why did Romans let the water run all the time instead of turning it off?'],
  'words' => ['Lacus' => 'Latin for a public water basin.', 'Overflow' => 'Extra water that spills over the edge.'],
  'sources' => ['anc-frontinus', 'brit-aqueduct', 'un-pompeii'],
  'related' => ['aqueduct', 'apartment-block', 'public-baths'],
],

'public-baths' => [
  'name' => 'Public baths', 'latin' => 'thermae', 'cat' => 'water', 'src' => 'art/fitness_1.png',
  'summary' => 'A huge bathhouse with hot, warm and cold pools where Romans washed, exercised, relaxed and met friends.',
  'facts' => ['Used for' => 'Bathing, exercise and socialising', 'Main rooms' => 'Cold, warm and hot rooms', 'Heating' => 'Hypocaust (hot air under the floor)', 'Famous example' => 'Baths of Caracalla, Rome (opened AD 216)'],
  'sections' => [
    ['What it was', [
      'Going to the baths was part of everyday Roman life. Small neighbourhood baths (balneae) were everywhere, and emperors built enormous public baths (thermae) that could serve thousands of people a day. The entry fee was very low, so rich and poor alike could visit.',
      'The largest baths were more like leisure centres. Besides pools, they could include exercise yards, gardens, meeting halls and even libraries.',
    ]],
    ['How it worked', [
      'A visit usually followed a route through rooms of different temperatures.',
    ], ['list' => [
      'Apodyterium: changing room with shelves for clothes.',
      'Palaestra: open courtyard for exercise and ball games.',
      'Tepidarium: warm room to get used to the heat.',
      'Caldarium: hot room with a hot pool, like a steam room.',
      'Frigidarium: cold room with a cold plunge pool to finish.',
    ]], [
      'Romans did not use soap as we do. They rubbed olive oil onto their skin and then scraped off the oil, sweat and dirt with a curved metal tool called a strigil.',
    ]],
    ['Heating the water and floors', [
      'The hot rooms were heated by a system called a hypocaust. A furnace, kept burning by workers, pushed hot air into a hollow space under the floor, which was raised on short stacks of tiles. The hot air also rose through hollow clay pipes inside the walls, so the whole room was warmed. The floors could get so hot that bathers wore wooden-soled sandals.',
    ]],
    ['Noisy neighbours', [
      'The Roman writer Seneca once lived above a bathhouse and complained in a letter about the noise: people grunting as they lifted weights, splashing into the pool, and sellers calling out to sell snacks. His letter shows that the baths were busy, lively social places.',
    ]],
  ],
  'art' => 'The layout and decoration here are imagined. Real imperial baths were far larger, with vaulted halls and many separate rooms.',
  'look' => ['Notice the steam rising from the pool.', 'Find where water flows into the building.'],
  'questions' => ['Romans went to the baths to wash and to meet people. What places today do both jobs?', 'What would it take to heat so much water without electricity or gas?', 'Why do you think entry was kept cheap?'],
  'words' => ['Hypocaust' => 'An underfloor heating system using hot air.', 'Strigil' => 'A curved tool for scraping oil and dirt off skin.', 'Caldarium' => 'The hot room.', 'Frigidarium' => 'The cold room.'],
  'sources' => ['brit-thermae', 'sh-caracalla', 'anc-seneca', 'anc-vitruvius'],
  'related' => ['aqueduct', 'public-fountain', 'gladiator-school'],
],

// ---------------- Shows and games ----------------
'amphitheater' => [
  'name' => 'Amphitheater', 'latin' => 'amphitheatrum', 'cat' => 'fun', 'src' => 'art/fitness_3.png',
  'summary' => 'A giant oval arena where crowds watched animal hunts and gladiator contests.',
  'facts' => ['Used for' => 'Public shows and gladiator contests', 'Most famous' => 'The Colosseum, Rome', 'Colosseum opened' => 'About AD 80', 'Colosseum crowd' => 'About 50,000 people'],
  'sections' => [
    ['What it was', [
      'An amphitheater ("theater on both sides") is an oval arena surrounded by rising rows of seats. Amphitheaters were built across the Roman world, from Britain to North Africa. The oldest surviving stone example is in Pompeii, built around 70 BC.',
      'The most famous is the Flavian Amphitheater in Rome, now called the Colosseum. It was begun under the emperor Vespasian and dedicated by his son Titus around AD 80. Its later name probably came from a colossal statue that stood nearby.',
    ]],
    ['How it worked', [
      'The Colosseum had 80 entrance arches, most of them numbered so that spectators could find their section quickly, a little like gates at a modern stadium. Seating was arranged by social rank: the emperor and senators sat closest to the arena, and women, the poor and enslaved people sat high at the top.',
      'Below the arena floor was the hypogeum, a maze of tunnels and rooms where animals and performers waited. Lifts worked by ropes and pulleys raised them up through trapdoors into the arena. On hot days, sailors stretched a huge canvas awning called the velarium over part of the seating to give shade.',
    ]],
    ['What happened there', [
      'A day of games might begin with animal hunts in the morning and end with gladiator contests in the afternoon. These shows were paid for by emperors and wealthy citizens to win popularity. Many of the contests were violent and cruel, and they were part of how Roman leaders showed their power.',
    ]],
    ['Places you can still see', [
      'The Colosseum still stands in the centre of Rome. The Arena di Verona in Italy is still used for opera performances, and the amphitheater at El Jem in Tunisia is one of the best preserved in Africa.',
    ]],
  ],
  'art' => 'This arena resembles the Colosseum but is an artistic illustration, smaller and simplified.',
  'look' => ['Count the levels of arches around the outside.', 'Look at how the seats rise in rings around the arena.'],
  'questions' => ['Seats were arranged by social rank. How do stadiums decide who sits where today?', 'Why would leaders pay for huge free shows?', 'How did 50,000 people get in and out without modern technology?'],
  'words' => ['Arena' => 'The sandy floor where the shows took place (from the Latin for sand).', 'Hypogeum' => 'The underground rooms below the arena.', 'Velarium' => 'A giant awning for shade.'],
  'sources' => ['brit-colosseum', 'sh-colosseum', 'un-elJem', 'un-pompeii'],
  'related' => ['gladiator-school', 'circus', 'building-materials'],
],

'circus' => [
  'name' => 'Chariot racetrack (circus)', 'latin' => 'circus', 'cat' => 'fun', 'src' => 'art/fitness_2.png',
  'summary' => 'A long racetrack where crowds cheered for chariot teams racing around a central barrier.',
  'facts' => ['Used for' => 'Chariot races', 'Most famous' => 'Circus Maximus, Rome', 'A race' => 'Usually seven laps', 'Teams' => 'Red, White, Blue and Green'],
  'sections' => [
    ['What it was', [
      'The circus was Rome\'s home of chariot racing, the most popular sport in the Roman world. The biggest was the Circus Maximus, in the valley between the Palatine and Aventine hills. It was rebuilt and enlarged many times and held a vast crowd: estimates range from about 150,000 to more than 200,000 people, several times the Colosseum\'s capacity.',
    ]],
    ['How a race worked', [], ['list' => [
      'Chariots, usually pulled by four horses, lined up in starting gates called carceres.',
      'When a cloth was dropped, the gates opened at once.',
      'Drivers raced around a long central barrier called the spina, turning sharply at posts at each end.',
      'Lap counters shaped like eggs and dolphins showed the crowd how many laps were left.',
      'A race was usually seven laps.',
    ]], [
      'The tight turns were the most dangerous part. Drivers wrapped the reins around their bodies to steer by leaning, and are said to have carried a knife to cut themselves free if they crashed.',
    ]],
    ['Teams and fans', [
      'Under the empire, racing was organised into four teams, or factions, each with its own colour: Red, White, Blue and Green. Fans were fiercely loyal, and rivalries sometimes led to fights. Successful drivers became famous and wealthy, much like sports stars today.',
      'Races cost less to stage than gladiator games, so they could be held more often, and chariot racing continued long after gladiator fights ended.',
    ]],
    ['Places you can still see', [
      'Today the Circus Maximus is a long grassy park in Rome whose shape still shows the track. The Circus of Maxentius, beside the Via Appia outside Rome, is better preserved and shows the starting gates and the central barrier. An Egyptian obelisk that the emperor Augustus placed on the central barrier now stands in Rome\'s Piazza del Popolo.',
    ]],
  ],
  'art' => 'The track shown here is much smaller and shorter than the real Circus Maximus.',
  'look' => ['Find the central barrier down the middle of the track.', 'Look for the starting gates at one end.'],
  'questions' => ['Why might a long, narrow shape suit chariot racing?', 'Why do you think fans felt so loyal to a team colour?', 'What makes a sport popular enough to fill a stadium?'],
  'words' => ['Spina' => 'The central barrier the chariots raced around.', 'Carceres' => 'The starting gates.', 'Faction' => 'A racing team.'],
  'sources' => ['brit-circus'],
  'related' => ['amphitheater', 'gladiator-school', 'victory-column'],
],

'gladiator-school' => [
  'name' => 'Gladiator school', 'latin' => 'ludus', 'cat' => 'fun', 'src' => 'art/nt_workshop.png',
  'summary' => 'A training camp with its own small arena where gladiators lived, practised and prepared for the games.',
  'facts' => ['Used for' => 'Training and housing gladiators', 'Best known' => 'Ludus Magnus, next to the Colosseum', 'Built under' => 'Emperor Domitian', 'Practice weapon' => 'Wooden sword (rudis)'],
  'sections' => [
    ['What it was', [
      'Gladiators were trained fighters who performed in the amphitheater. Most were enslaved people or prisoners of war, though some free men signed up for the money and fame. They lived and trained in schools called ludi.',
      'In Rome, the emperor Domitian built four gladiator schools near the Colosseum. The largest and best preserved is the Ludus Magnus ("Great School"), whose remains can still be seen beside the Colosseum.',
    ]],
    ['How it worked', [
      'The Ludus Magnus was built around a courtyard holding a small oval training arena, a reduced version of the Colosseum\'s arena. Around it were rows of seats for up to about 3,000 spectators, who could watch training sessions. Small rooms around the courtyard housed the gladiators, and a tunnel connected the school to the Colosseum.',
      'Gladiators practised with wooden swords and heavy training weapons under expert trainers. They specialised in different fighting styles, each with its own armour and weapons, and were matched against opponents with a different style.',
    ]],
    ['A hard life', [
      'Gladiators were expensive to train and feed, so their owners did not want them killed carelessly, but the life was dangerous and most gladiators had no choice about it. A gladiator who survived many fights might be awarded a wooden sword, the rudis, as a sign of release from fighting.',
    ]],
  ],
  'art' => 'This building is an artistic illustration of a training school with its own small arena, inspired by the Ludus Magnus.',
  'look' => ['Find the small sandy arena in the middle.', 'Notice the seats around it. Who might have watched?'],
  'questions' => ['Most gladiators had no choice about fighting. How does that change how you see the games?', 'Why might an emperor build training schools right next to the Colosseum?', 'Why would audiences watch practice sessions?'],
  'words' => ['Ludus' => 'A gladiator training school (also the Latin word for game).', 'Rudis' => 'A wooden practice sword.', 'Lanista' => 'The owner or manager of a troupe of gladiators.'],
  'sources' => ['pk-colosseo', 'brit-colosseum', 'sh-colosseum'],
  'related' => ['amphitheater', 'circus', 'public-baths'],
],

// ---------------- Government, law and money ----------------
'forum' => [
  'name' => 'Forum', 'latin' => 'forum', 'cat' => 'govern', 'src' => 'art/shared_2.png',
  'summary' => 'The central open square of a Roman town, surrounded by temples, law courts, shops and government buildings.',
  'facts' => ['Used for' => 'Politics, law, religion, business and meeting', 'Most famous' => 'Roman Forum (Forum Romanum)', 'Speakers\' platform' => 'The Rostra', 'Every town had' => 'Its own forum'],
  'sections' => [
    ['What it was', [
      'The forum was the heart of every Roman town. It was a large open square, usually paved, surrounded by the most important public buildings. People came here to shop, hear speeches, attend trials, take part in religious festivals, vote and catch up on news.',
      'In Rome, the Roman Forum grew up in a low valley between the Palatine and Capitoline hills. The area was once marshy, and it was drained by a great sewer, the Cloaca Maxima, before it could be built on.',
    ]],
    ['What you would find there', [], ['list' => [
      'Temples to gods such as Saturn, Castor and Pollux, and Vesta.',
      'Basilicas: large halls for law courts and business.',
      'The Curia, where the Senate met.',
      'The Rostra, a raised platform for public speeches, decorated with the bronze prows of captured warships.',
      'Statues and monuments honouring famous people.',
      'The Sacred Way (Via Sacra), the main street through the forum, used for processions.',
    ]]],
    ['A growing city', [
      'As Rome grew, the old forum became too crowded. Julius Caesar, Augustus and later emperors built new forums nearby, known as the Imperial Fora. The largest was the Forum of Trajan, built in the early 2nd century AD.',
      'Smaller Roman towns copied the pattern. In Pompeii, the forum is a long open square with a temple at one end and civic buildings along the sides.',
    ]],
  ],
  'art' => 'This illustration shows a forum as a courtyard surrounded by buildings, with a temple at the back. Real forums were usually larger, fully paved open squares.',
  'look' => ['Find the temple at the back of the square.', 'Look for colonnades where people could walk in the shade.'],
  'questions' => ['Where is the "heart" of your town or city? What happens there?', 'Why might it help to put courts, temples and shops in one place?', 'Where do people today go to hear speeches or share news?'],
  'words' => ['Forum' => 'A town\'s main public square.', 'Rostra' => 'The speakers\' platform in the Roman Forum.', 'Colonnade' => 'A row of columns, often with a roof.'],
  'sources' => ['brit-forum', 'sh-forum', 'un-rome', 'un-pompeii'],
  'related' => ['basilica', 'curia', 'treasury'],
],

'basilica' => [
  'name' => 'Basilica', 'latin' => 'basilica', 'cat' => 'govern', 'src' => 'art/business_2.png',
  'summary' => 'A large covered hall used as a law court and for banking and business.',
  'facts' => ['Used for' => 'Law courts, banking and business', 'Shape' => 'Long hall with rows of columns', 'In the Roman Forum' => 'Basilica Julia, Basilica Aemilia', 'Later became' => 'The model for early churches'],
  'sections' => [
    ['What it was', [
      'A basilica was a large roofed hall built beside a forum. It gave Romans a dry, shaded place to do business, settle legal cases and meet in any weather. It was not a religious building in Roman times.',
    ]],
    ['How it worked', [
      'A typical basilica was a long rectangle divided by rows of columns into a wide central space (the nave) and narrower side aisles. The central roof was often higher than the side roofs, so windows near the top could let light in.',
      'At one or both ends there was often a raised platform where magistrates sat to hear cases. Over time this platform was set inside a curved, half-domed space called an apse. Busy trials drew crowds of onlookers, and lawyers gave dramatic speeches.',
    ]],
    ['Places you can still see', [
      'In the Roman Forum you can see the floor and column bases of the Basilica Julia and the Basilica Aemilia. Nearby, three enormous vaults survive from the Basilica of Maxentius, finished under Constantine in the early 4th century AD. The Basilica Ulpia stood in the Forum of Trajan, with apses at each end that served as courtrooms.',
    ]],
    ['A lasting design', [
      'When Christians began building large churches in the 4th century, they used the basilica plan: a long nave, side aisles and an apse at one end. Many churches today still follow this shape and are still called basilicas.',
    ]],
  ],
  'art' => 'This is a general illustration of a basilica, not a specific building.',
  'look' => ['Notice the long rows of columns. What do they hold up?', 'Find the windows that would let light into the hall.'],
  'questions' => ['Why might a city want courts and business in one central building?', 'Which buildings near you are used for many different purposes?', 'Why do you think churches borrowed this design?'],
  'words' => ['Nave' => 'The wide central space of a hall.', 'Aisle' => 'A side passage separated by columns.', 'Apse' => 'A curved, half-domed space at the end of a building.'],
  'sources' => ['brit-basilica', 'brit-forum', 'sh-forum'],
  'related' => ['forum', 'curia', 'records-office'],
],

'curia' => [
  'name' => 'Senate house (curia)', 'latin' => 'curia', 'cat' => 'govern', 'src' => 'art/shared_3.png',
  'summary' => 'The meeting hall of the Roman Senate, where senators debated laws, wars and the running of the state.',
  'facts' => ['Used for' => 'Meetings of the Senate', 'Best known' => 'Curia Julia, Roman Forum', 'Completed' => '29 BC, under Augustus', 'Why it survived' => 'It was later turned into a church'],
  'sections' => [
    ['What it was', [
      'The Senate was a council of experienced and mostly wealthy men who advised Rome\'s leaders. During the Republic it was very powerful, guiding war, foreign affairs and public money. Under the emperors it kept its prestige, though real power moved to the emperor.',
      'The Senate met in a building called the curia. The best-known is the Curia Julia in the Roman Forum. It was begun by Julius Caesar and completed by Augustus, his adopted heir, in 29 BC.',
    ]],
    ['How it worked', [
      'Inside, the hall was tall and plain, with broad, low steps along both long walls where senators sat. At the far end was a platform for the presiding officials. Senators spoke in turn, often in order of rank, and voted by moving to one side of the hall or the other.',
      'In front of the curia was the Comitium, an open meeting place where citizens gathered and where speeches were made to the people.',
    ]],
    ['What you can see today', [
      'The building standing today is a rebuilding ordered by the emperor Diocletian after a fire in the late 3rd century AD. It survived because, in the Middle Ages, it was turned into a church. The original bronze doors were moved to the church of St John Lateran in Rome in the 1600s; the doors on the building now are copies.',
    ]],
  ],
  'art' => 'This building\'s columns, banners and golden doors are the artist\'s interpretation. The real Curia Julia has a plain brick front.',
  'look' => ['Find the large doors at the top of the steps.', 'Notice the statues and banners. What do they tell visitors?'],
  'questions' => ['How does your country or city make its laws? Where do lawmakers meet?', 'Why might a meeting hall be designed to look grand?', 'Who was left out of the Roman Senate?'],
  'words' => ['Senate' => 'A council of leading citizens (from senex, old man).', 'Senator' => 'A member of the Senate.', 'Comitium' => 'An open meeting space in front of the curia.'],
  'sources' => ['brit-forum', 'sh-forum', 'un-rome'],
  'related' => ['forum', 'basilica', 'treasury'],
],

'treasury' => [
  'name' => 'Treasury (Temple of Saturn)', 'latin' => 'aerarium Saturni', 'cat' => 'govern', 'src' => 'art/town_1.png',
  'summary' => 'Rome\'s state treasury was kept in the Temple of Saturn, where public money and official records were stored.',
  'facts' => ['Used for' => 'Storing state money and records', 'Location' => 'Temple of Saturn, Roman Forum', 'Run by' => 'Officials called quaestors', 'Coins' => 'Denarius (silver), aureus (gold)'],
  'sections' => [
    ['What it was', [
      'Every government needs somewhere safe to keep its money. In Rome, the state treasury (the aerarium) was kept in the Temple of Saturn in the Roman Forum, together with a nearby records office. The first temple on the site dates back to the early years of the Republic, around 497 BC.',
      'The treasury was more than a vault. It also kept copies of laws, decisions of the Senate and other official documents, so it worked as an archive too.',
    ]],
    ['How it worked', [
      'During the Republic the treasury was managed by junior officials called quaestors, under the control of the Senate. Money came in from taxes, from the provinces and from the spoils of war, and went out to pay for armies, roads, buildings and public games.',
      'In AD 6 the emperor Augustus set up a separate military treasury to pay soldiers\' pensions. The old treasury, still known as the aerarium Saturni, later became mainly the treasury of the city of Rome.',
    ]],
    ['Roman money', [
      'Romans paid with coins. The silver denarius was the everyday coin of value, the gold aureus was worth much more, and smaller coins of bronze and brass were used for daily shopping. Coins carried the portrait of the emperor and short messages, so they also spread news and propaganda across the empire.',
    ]],
    ['What you can see today', [
      'Eight tall columns of the Temple of Saturn still stand at the edge of the Roman Forum. They belong to a rebuilding from the 4th century AD.',
    ]],
  ],
  'art' => 'This illustration stands for the treasury. Its banners and decoration are the artist\'s own; the real Temple of Saturn was a tall columned temple on a high base.',
  'look' => ['Look for the strong doors and high steps.', 'What makes a building look safe and important?'],
  'questions' => ['Why might Romans keep public money in a temple?', 'What does a government spend money on today?', 'Why would a ruler put their own face on coins?'],
  'words' => ['Aerarium' => 'The state treasury.', 'Quaestor' => 'An official in charge of public money.', 'Denarius' => 'A Roman silver coin.'],
  'sources' => ['brit-aerarium', 'sh-forum', 'brit-forum'],
  'related' => ['records-office', 'forum', 'curia'],
],

// ---------------- Temples and memorials ----------------
'temple' => [
  'name' => 'Temple', 'latin' => 'templum', 'cat' => 'belief', 'src' => 'art/business_3.png',
  'summary' => 'A house for a god\'s statue, raised on a high platform with steps and a porch of columns at the front.',
  'facts' => ['Used for' => 'Housing a god\'s statue and offerings', 'Shape' => 'High platform, front steps, columned porch', 'Worship took place' => 'At an altar outside', 'Well preserved' => 'Maison Carrée, Nîmes (France)'],
  'sections' => [
    ['What it was', [
      'Romans worshipped many gods and goddesses, and a temple was thought of as the home of a particular god. Inside, a room called the cella held the god\'s statue and valuable gifts. Ordinary people did not gather inside for services as in many modern places of worship.',
    ]],
    ['How it worked', [
      'Roman temples usually stood on a tall platform called a podium, reached by a flight of steps at the front only. This made the temple face one direction, looking out over a square or forum. A deep porch of columns led to the doors of the cella.',
      'Religious ceremonies, including prayers and animal sacrifices, took place at an altar outside, in front of the steps, where crowds could watch. Priests and officials led the rituals on festival days.',
    ]],
    ['Places you can still see', [
      'The Maison Carrée in Nîmes, France, built around the turn of the 1st century AD, is one of the best-preserved Roman temples anywhere and still has its roof. In Rome, the Temple of Portunus beside the river Tiber shows the same plan on a small scale. The most important temple in Rome stood on the Capitoline Hill, dedicated to Jupiter, Juno and Minerva.',
    ]],
  ],
  'art' => 'The golden statue on the roof and the colours are the artist\'s interpretation, though Roman temples were often brightly painted and decorated with statues.',
  'look' => ['Count the columns across the front.', 'Find the statue on top of the roof.'],
  'questions' => ['Why might a temple be built on a high platform?', 'How is this different from places of worship you know?', 'Why do you think public ceremonies happened outside?'],
  'words' => ['Cella' => 'The inner room holding the god\'s statue.', 'Podium' => 'The high platform a temple stands on.', 'Pediment' => 'The triangle shape above the columns at the front.'],
  'sources' => ['sh-portunus', 'un-maison', 'brit-forum'],
  'related' => ['pantheon', 'temple-of-vesta', 'forum'],
],

'pantheon' => [
  'name' => 'The Pantheon', 'latin' => 'Pantheon', 'cat' => 'belief', 'src' => 'art/family_3.png',
  'summary' => 'A temple with a vast concrete dome and an open circle at the top, still standing and still in use in Rome.',
  'facts' => ['Used for' => 'Temple, later a church', 'Built' => 'Early 2nd century AD, under Hadrian', 'Dome width' => 'About 43 metres', 'Light source' => 'The oculus, an open circle in the roof'],
  'sections' => [
    ['What it was', [
      'The Pantheon was a temple in the centre of Rome. Its name comes from Greek words meaning "all the gods". The building standing today was begun under the emperor Trajan and completed under Hadrian in the early 2nd century AD. The inscription on the front names Marcus Agrippa, who built an earlier temple on the same spot more than a century before.',
    ]],
    ['How it worked', [
      'The Pantheon has a traditional columned porch at the front, but behind it is a huge round hall covered by a dome. The dome is about 43 metres across, the same as the height from the floor to the top, so a giant ball could fit perfectly inside.',
      'The dome is made of Roman concrete. Builders used heavier stone in the concrete near the bottom and lighter volcanic stone near the top to reduce the weight. Sunken square panels, called coffers, cut into the inside of the dome also make it lighter.',
      'At the top is the oculus ("eye"), an open circle about 9 metres wide. It is the building\'s main source of direct light, and a circle of sunlight moves around the walls as the day passes. When it rains, water falls in and drains away through small holes in the gently sloping floor.',
    ]],
    ['Why it survived', [
      'In AD 609 the Pantheon was turned into a church, which meant it was cared for when many other ancient buildings were taken apart for stone. Nearly 1,900 years after it was built, it remains one of the largest unreinforced concrete domes in the world.',
    ]],
  ],
  'art' => 'This temple is inspired by the Pantheon but is not an exact copy. The garden setting is imagined.',
  'look' => ['Look at the very top of the dome.', 'Compare the square porch with the round building behind it.'],
  'questions' => ['How else could a building without windows let in light?', 'Why might builders use lighter material at the top of a dome?', 'Why do you think this building has lasted so long?'],
  'words' => ['Dome' => 'A rounded roof like half a ball.', 'Oculus' => 'A round opening at the top of a dome.', 'Coffer' => 'A sunken panel in a ceiling.'],
  'sources' => ['sh-pantheon', 'brit-pantheon', 'brit-concrete'],
  'related' => ['temple', 'building-materials', 'temple-of-vesta'],
],

'temple-of-vesta' => [
  'name' => 'Temple of Vesta', 'latin' => 'aedes Vestae', 'cat' => 'belief', 'src' => 'art/shared_1.png',
  'summary' => 'A small round temple in the Roman Forum where a sacred fire was kept burning for the safety of the city.',
  'facts' => ['Goddess' => 'Vesta, goddess of the hearth', 'Shape' => 'Round', 'Inside' => 'A sacred fire that was never allowed to go out', 'Cared for by' => 'The Vestal Virgins, six priestesses'],
  'sections' => [
    ['What it was', [
      'Vesta was the Roman goddess of the hearth, the fireplace at the centre of every home. Her temple in the Roman Forum held a sacred fire that stood for the hearth of the whole city. Romans believed that if the fire went out, disaster could follow.',
      'Unlike most Roman temples, which were rectangular, the Temple of Vesta was round. Some historians think the round shape recalls the round huts of Rome\'s earliest settlers.',
    ]],
    ['The Vestal Virgins', [
      'The fire was tended by six priestesses called the Vestal Virgins. They were chosen as young girls and served for 30 years: ten years learning, ten years performing the duties, and ten years teaching. They lived in a large house right next to the temple, the House of the Vestals, and had special honours and privileges, such as front-row seats at the games.',
    ]],
    ['What you can see today', [
      'The temple was damaged by fire and rebuilt several times. The section standing in the Roman Forum today was partly reconstructed in the 1930s. The courtyard of the House of the Vestals, with its long pools and statues of senior Vestals, can be seen next to it. A well-preserved round temple, also linked to Vesta, stands at Tivoli near Rome.',
    ]],
  ],
  'art' => 'The flame shown in the doorway and the decoration are the artist\'s interpretation. The real sacred fire was kept inside, out of public view.',
  'look' => ['Look between the columns. What is burning inside?', 'Notice the round shape.'],
  'questions' => ['Why might a shared flame matter to a whole city?', 'What symbols do cities or countries use today to show they are united?', 'Why would a temple be round instead of rectangular?'],
  'words' => ['Hearth' => 'A fireplace, the centre of a home.', 'Vestal' => 'A priestess of Vesta.', 'Tholos' => 'A round building with columns.'],
  'sources' => ['brit-vesta', 'sh-forum', 'brit-forum'],
  'related' => ['temple', 'forum', 'pantheon'],
],

'mausoleum' => [
  'name' => 'Mausoleum (round tomb)', 'latin' => 'mausoleum', 'cat' => 'belief', 'src' => 'art/growth_2.png',
  'summary' => 'A grand tomb built outside the city walls so that families and passers-by would remember the dead.',
  'facts' => ['Used for' => 'Burial and remembrance', 'Where' => 'Outside the city, along roads', 'Famous examples' => 'Mausoleum of Augustus, Mausoleum of Hadrian', 'Word comes from' => 'King Mausolus\'s tomb in Halicarnassus'],
  'sections' => [
    ['What it was', [
      'Roman law forbade burials inside the city, so tombs were built outside the walls, often lining the main roads. Travellers on the Via Appia passed mile after mile of tombs, from simple markers to huge monuments. Wealthy families built impressive tombs so that their names would be seen and remembered.',
      'A mausoleum is a large, grand tomb. The word comes from the tomb of Mausolus, a ruler in what is now Turkey, which was so famous that its name became the general word.',
    ]],
    ['Round tombs', [
      'Some of the grandest Roman tombs were round drums of stone, sometimes topped with earth and trees. The emperor Augustus built a vast round mausoleum for himself and his family in Rome, begun in 28 BC. On the Via Appia, the round Tomb of Caecilia Metella still stands, built for a woman from a noble family in the late 1st century BC.',
      'The emperor Hadrian built an even larger round mausoleum beside the river Tiber. Later it was turned into a fortress and then a castle for the popes, and today it is known as Castel Sant\'Angelo.',
    ]],
    ['Remembering the dead', [
      'Romans believed it was important to keep the memory of the dead alive. Families visited tombs on special days, bringing food, flowers and offerings, and held a festival for the dead each February.',
    ]],
  ],
  'art' => 'This round building is an artistic illustration. Real round tombs were usually more solid, with few windows.',
  'look' => ['Notice the round shape and the single doorway.', 'How does this building look different from a temple?'],
  'questions' => ['Why might Romans build tombs along busy roads?', 'How do people remember those who have died today?', 'Why do you think a tomb became a castle?'],
  'words' => ['Mausoleum' => 'A large, grand tomb.', 'Necropolis' => 'A "city of the dead", a large cemetery.', 'Epitaph' => 'Words written on a tomb.'],
  'sources' => ['brit-tombs', 'sh-haterii', 'un-rome'],
  'related' => ['inn', 'triumphal-arch', 'victory-column'],
],

'triumphal-arch' => [
  'name' => 'Triumphal arch', 'latin' => 'arcus triumphalis', 'cat' => 'belief', 'src' => 'art/town_2.png',
  'summary' => 'A grand stone archway built to celebrate a victory or honour an emperor.',
  'facts' => ['Used for' => 'Celebrating victories and honouring leaders', 'Oldest surviving in Rome' => 'Arch of Titus (after AD 81)', 'Largest in Rome' => 'Arch of Constantine (AD 315)', 'Decorated with' => 'Carvings and inscriptions'],
  'sections' => [
    ['What it was', [
      'When a Roman general won an important war, he could be honoured with a triumph: a grand parade through the city with soldiers, prisoners and captured treasure. Triumphal arches were built to remember these victories and other important events. They were often free-standing monuments rather than gates in a wall.',
      'By the 4th century AD, more than 30 arches had been built in Rome.',
    ]],
    ['Reading an arch', [
      'Arches were covered in carved pictures and inscriptions that told a story. Inside the Arch of Titus, carved panels show Roman soldiers carrying treasures taken from the Temple in Jerusalem in AD 70, including a large menorah. The Arch of Constantine reuses carvings taken from older monuments, mixed with new ones.',
      'Coins show that many arches once carried bronze statues on top, such as a chariot pulled by four horses. These statues have not survived.',
    ]],
    ['Places you can still see', [
      'Three triumphal arches survive in and near the Roman Forum: the Arch of Titus, the Arch of Septimius Severus (AD 203) and the Arch of Constantine beside the Colosseum. The idea was copied much later, for example in the Arc de Triomphe in Paris.',
    ]],
  ],
  'art' => 'The golden chariot group on top is the artist\'s interpretation, based on the bronze statues that once stood on arches.',
  'look' => ['Find the chariot and horses on top.', 'Look for carved pictures on the sides.'],
  'questions' => ['What does a city choose to remember with monuments, and who decides?', 'How might people who were defeated feel about these arches?', 'What monuments in your area celebrate events or people?'],
  'words' => ['Triumph' => 'A victory parade for a Roman general.', 'Inscription' => 'Words carved into stone.', 'Quadriga' => 'A chariot pulled by four horses.'],
  'sources' => ['brit-arch', 'sh-constantine', 'sh-forum'],
  'related' => ['victory-column', 'imperial-statue', 'forum'],
],

'victory-column' => [
  'name' => 'Victory column', 'latin' => 'columna', 'cat' => 'belief', 'src' => 'art/monument.png',
  'summary' => 'A tall column carved with a spiral picture story of an emperor\'s wars.',
  'facts' => ['Used for' => 'Celebrating victories and honouring an emperor', 'Most famous' => 'Trajan\'s Column, Rome', 'Dedicated' => 'AD 113', 'Inside' => 'A spiral staircase'],
  'sections' => [
    ['What it was', [
      'Romans set up columns to honour important people and victories. The most famous is Trajan\'s Column, dedicated in AD 113 in the Forum of Trajan. It celebrates the emperor Trajan\'s two wars against the Dacians, who lived in what is now Romania.',
    ]],
    ['How it works', [
      'A band of carved pictures winds around the column from bottom to top, like a ribbon, telling the story of the wars. It shows soldiers marching, building forts and bridges, crossing rivers and fighting, with more than 2,000 carved figures. Historians study it to learn about Roman army equipment and life on campaign.',
      'The column is made of large drums of marble stacked on top of each other. Inside is a spiral staircase lit by small slit windows, leading to a platform at the top. Trajan\'s ashes were placed in the base after his death.',
    ]],
    ['What you can see today', [
      'Trajan\'s Column still stands in Rome almost complete. A statue of Trajan originally stood on top; in 1588 it was replaced by a statue of Saint Peter. A similar column, the Column of Marcus Aurelius, stands in Rome\'s Piazza Colonna.',
    ]],
  ],
  'art' => 'The winged figure on top is the artist\'s interpretation; Trajan\'s Column was topped by a statue of the emperor.',
  'look' => ['Follow the carved spiral up the column.', 'What stands on top?'],
  'questions' => ['Why tell a story in pictures instead of words?', 'Who could actually see the carvings near the top?', 'What stories does your community tell through monuments?'],
  'words' => ['Relief' => 'A carving that stands out from a flat surface.', 'Frieze' => 'A long band of carved or painted decoration.', 'Dacia' => 'An ancient kingdom in what is now Romania.'],
  'sources' => ['brit-trajan', 'un-rome'],
  'related' => ['triumphal-arch', 'imperial-statue', 'forum'],
],

'imperial-statue' => [
  'name' => 'Statue of the emperor', 'latin' => 'statua', 'cat' => 'belief', 'src' => 'art/nt_statue.png',
  'summary' => 'Statues of emperors stood in forums and public places across the empire, showing people who ruled them.',
  'facts' => ['Used for' => 'Showing the emperor\'s image and power', 'Materials' => 'Marble, bronze, sometimes gilded', 'Famous example' => 'Augustus of Primaporta', 'Bronze survivor' => 'Marcus Aurelius on horseback'],
  'sections' => [
    ['What it was', [
      'In a world without photographs or television, most people in the Roman Empire would never see their emperor in person. Statues, along with portraits on coins, showed everyone what the ruler looked like and what he stood for. They were placed in forums, temples, baths and theatres across the empire.',
    ]],
    ['Sending a message', [
      'Statues were carefully designed to send a message. The marble statue known as the Augustus of Primaporta shows the first emperor as a young, calm commander, with carvings on his armour celebrating a diplomatic victory. Many statues were originally painted in bright colours, though the paint has mostly worn away.',
      'Bronze statues were sometimes covered in a thin layer of gold. Most ancient bronzes were later melted down for their metal. The bronze statue of the emperor Marcus Aurelius on horseback survived because, for centuries, people believed it showed Constantine, the first Christian emperor. The original is now in Rome\'s Capitoline Museums.',
    ]],
    ['Giant statues', [
      'Some statues were enormous. Pieces of a colossal statue of Constantine, including a head more than two metres tall and a giant hand, can be seen in the courtyard of the Capitoline Museums.',
    ]],
  ],
  'art' => 'This golden statue is the artist\'s interpretation of an imperial statue on a decorated base.',
  'look' => ['Notice the pose: the raised arm and the armour.', 'Why might the statue be golden?'],
  'questions' => ['How do leaders today make sure people know what they look like?', 'Why would a statue show a ruler as young and strong?', 'What happens to statues of leaders when opinions about them change?'],
  'words' => ['Portrait' => 'An image of a real person.', 'Gilded' => 'Covered with a thin layer of gold.', 'Propaganda' => 'Images or messages designed to shape what people think.'],
  'sources' => ['sh-augustus', 'un-rome'],
  'related' => ['triumphal-arch', 'victory-column', 'imperial-palace'],
],

// ---------------- Homes ----------------
'imperial-palace' => [
  'name' => 'Imperial palace', 'latin' => 'palatium', 'cat' => 'homes', 'src' => 'art/town_3.png',
  'summary' => 'The emperors lived and ruled from huge palaces on the Palatine Hill, which gave us the word "palace".',
  'facts' => ['Used for' => 'Home and offices of the emperor', 'Location' => 'Palatine Hill, Rome', 'Word origin' => '"Palace" comes from "Palatine"', 'Famous palace' => 'Nero\'s Golden House'],
  'sections' => [
    ['What it was', [
      'The Palatine Hill rises above the Roman Forum. In the Republic it was a neighbourhood of wealthy homes. The first emperor, Augustus, lived there in a fairly modest house, and later emperors built ever larger palaces until the palace complex covered much of the hill. The word "palace" comes from the name of this hill.',
    ]],
    ['How it worked', [
      'An imperial palace was a home, a government office and a stage for ceremonies all at once. It had private living rooms, gardens and baths for the emperor\'s family, but also grand reception halls where the emperor met officials and foreign visitors, and banquet halls for huge dinners. Hundreds of officials, guards and enslaved workers kept it running.',
      'The emperor Domitian, at the end of the 1st century AD, built a vast palace on the Palatine with two main parts, one for public business and one for private life, plus a sunken garden shaped like a racetrack.',
    ]],
    ['The Golden House', [
      'After a great fire burned much of Rome in AD 64, the emperor Nero built an enormous new palace called the Domus Aurea, or Golden House, with gardens and an artificial lake. Later emperors filled it in and built over it; the Colosseum stands where its lake once was. Its painted underground rooms can still be visited.',
    ]],
  ],
  'art' => 'The golden dome and purple banners are the artist\'s interpretation of imperial luxury, not a copy of a real palace.',
  'look' => ['Find the golden dome and the purple banners.', 'Count the staircases and terraces.'],
  'questions' => ['Why might rulers build such huge homes?', 'What is the difference between a home and a palace?', 'How do leaders today mix home and office?'],
  'words' => ['Palatine' => 'One of Rome\'s seven hills.', 'Domus Aurea' => 'Nero\'s "Golden House".', 'Purple' => 'An expensive dye linked with emperors.'],
  'sources' => ['sh-domusaurea', 'anc-suetonius', 'un-rome'],
  'related' => ['domus', 'villa', 'imperial-statue'],
],

'apartment-block' => [
  'name' => 'Apartment block (insula)', 'latin' => 'insula', 'cat' => 'homes', 'src' => 'art/floor_m.png',
  'summary' => 'A building of several floors with shops on the ground floor and rented flats above, where most city people lived.',
  'facts' => ['Used for' => 'Homes and shops', 'Who lived there' => 'Most ordinary city dwellers', 'Best seen at' => 'Ostia, Rome\'s port town', 'Biggest danger' => 'Fire'],
  'sections' => [
    ['What it was', [
      'Most people in Rome did not live in houses. They rented rooms in apartment blocks called insulae ("islands"), several storeys high, packed along narrow streets. Rome was one of the most crowded cities in the ancient world.',
    ]],
    ['How it worked', [
      'The ground floor usually held shops opening onto the street, with the shopkeepers often living in a room behind or above. Stairs led to the flats upstairs. Many blocks were built around a central courtyard that let light and air into the lower floors.',
      'Unlike today, the best flats were on the lower floors. The upper floors were cheaper because they were smaller, hotter, harder to reach and more dangerous. There was no running water upstairs, so residents fetched water from public fountains and used public toilets.',
    ]],
    ['Dangers', [
      'Apartment blocks were sometimes badly built, and fire was a constant danger, especially for people on the top floors. After the great fire of AD 64, rules were introduced for wider streets and more fire-resistant building. The emperor Augustus also set a height limit for new buildings, recorded by the ancient writer Strabo as about 70 Roman feet (about 20 metres).',
    ]],
    ['Places you can still see', [
      'The best surviving examples are in Ostia, Rome\'s ancient port, where whole streets of apartment buildings stand several storeys high. In Rome itself, the Insula dell\'Ara Coeli at the foot of the Capitoline Hill still shows several floors of a block.',
    ]],
  ],
  'art' => 'The bright colours, plants and balconies are the artist\'s interpretation of a cheerful apartment block.',
  'look' => ['Find the shops at street level.', 'Count the floors. Which would you want to live on?'],
  'questions' => ['What would make living on an upper floor easier or harder?', 'Why do you think the best Roman flats were on the lower floors?', 'How do modern apartment buildings handle water, fire and stairs?'],
  'words' => ['Insula' => 'An apartment block (Latin for island).', 'Storey' => 'One floor of a building.', 'Landlord' => 'Someone who rents out property.'],
  'sources' => ['sh-insula', 'sh-ostia', 'anc-strabo'],
  'related' => ['shop', 'public-fountain', 'domus'],
],

'domus' => [
  'name' => 'Town house (domus)', 'latin' => 'domus', 'cat' => 'homes', 'src' => 'art/family_1.png',
  'summary' => 'A private family house that faced inward, built around open-air halls and gardens.',
  'facts' => ['Who lived there' => 'Wealthy families and their households', 'Centre of the house' => 'The atrium, with an opening in the roof', 'Decoration' => 'Wall paintings and floor mosaics', 'Best seen at' => 'Pompeii and Herculaneum'],
  'sections' => [
    ['What it was', [
      'Wealthier Romans lived in a domus, a single-family house. From the street a domus looked plain, often with shops built into the front wall. Inside, it opened up into bright, decorated rooms arranged around open spaces.',
    ]],
    ['A walk through a domus', [], ['list' => [
      'Fauces ("jaws"): the narrow entrance passage.',
      'Atrium: a large hall with an opening in the roof. Rain fell through into a shallow pool, the impluvium, and was stored in a tank below.',
      'Tablinum: the owner\'s office, between the atrium and the garden.',
      'Triclinium: the dining room, where diners reclined on couches.',
      'Cubicula: small bedrooms.',
      'Peristyle: a garden surrounded by a covered colonnade.',
    ]]],
    ['A home and a workplace', [
      'A domus was not only a private home. Each morning, people who depended on the owner, called clients, came to greet him and ask for help or favours. The atrium was designed to impress them, with family portraits, fine paintings and a view straight through the house to the garden.',
      'The household included the family, but also enslaved workers who cooked, cleaned and served.',
    ]],
    ['Places you can still see', [
      'Pompeii and Herculaneum, buried by the eruption of Mount Vesuvius in AD 79, preserve many town houses. The House of the Faun in Pompeii is named after a bronze dancing statue found in its atrium, and the House of the Tragic Poet has a famous floor mosaic of a dog with the words "cave canem" ("beware of the dog").',
    ]],
  ],
  'art' => 'This is a general illustration of a domus, not a specific house. Real town houses were usually squeezed tightly between neighbours.',
  'look' => ['Find the pool in the middle of the house.', 'Where does the light come in?'],
  'questions' => ['This house faces inward. What are the benefits of that?', 'Why would a home be designed to impress visitors?', 'How is collecting rainwater useful?'],
  'words' => ['Atrium' => 'The main hall, open to the sky.', 'Impluvium' => 'The pool that catches rainwater.', 'Peristyle' => 'A garden surrounded by columns.'],
  'sources' => ['sh-domus', 'un-pompeii'],
  'related' => ['villa', 'garden', 'apartment-block'],
],

'villa' => [
  'name' => 'Country villa', 'latin' => 'villa', 'cat' => 'homes', 'src' => 'art/family_2.png',
  'summary' => 'A luxurious country house where wealthy Romans escaped the noise of the city.',
  'facts' => ['Used for' => 'Rest, leisure and entertaining', 'Who owned them' => 'The very wealthy', 'Famous example' => 'Hadrian\'s Villa, Tivoli', 'Known for' => 'Gardens, pools, mosaics and paintings'],
  'sections' => [
    ['What it was', [
      'Wealthy Romans often owned houses outside the city, by the sea or in the hills. These villas were places for rest and leisure, which Romans called otium. They could be very large, with gardens, pools, private baths and rooms with views.',
      'Some villas were also working farms, but the grandest were built mainly for pleasure.',
    ]],
    ['Life at a villa', [
      'The writer Pliny the Younger described one of his villas near the sea in a letter. He wrote about rooms planned to catch the winter sun or the summer breeze, a dining room looking out over the waves, a library and gardens. Owners invited friends to stay, read, write, hunt and enjoy long dinners.',
      'Villas were run by large staffs of servants and enslaved workers who lived on the property.',
    ]],
    ['Places you can still see', [
      'Hadrian\'s Villa at Tivoli, near Rome, built for the emperor Hadrian in the 2nd century AD, is a huge complex of palaces, baths, theatres and pools. The Villa Romana del Casale in Sicily is famous for its colourful floor mosaics. Near Pompeii, the Villa of the Mysteries is known for its brilliant red wall paintings.',
    ]],
  ],
  'art' => 'This villa is an illustration combining features found in many villas, not a specific site.',
  'look' => ['Find the pools and gardens.', 'How many separate wings can you count?'],
  'questions' => ['Why might people want a second home away from the city?', 'Who did the work to keep a villa running?', 'What makes a place feel restful?'],
  'words' => ['Villa' => 'A country house.', 'Otium' => 'Leisure time for rest, reading and thinking.', 'Mosaic' => 'A picture made of small coloured stones or glass.'],
  'sources' => ['sh-villa', 'anc-pliny', 'un-hadrianvilla', 'un-casale'],
  'related' => ['farmhouse', 'domus', 'garden'],
],

'farmhouse' => [
  'name' => 'Farmhouse (villa rustica)', 'latin' => 'villa rustica', 'cat' => 'land', 'src' => 'art/home_a.png',
  'summary' => 'A working farm in the countryside that grew the grain, olives and grapes that fed the city.',
  'facts' => ['Used for' => 'Farming and storing produce', 'Main crops' => 'Grain, olives and grapes', 'Storage' => 'Large clay jars called dolia', 'Ancient guides' => 'Cato and Columella'],
  'sections' => [
    ['What it was', [
      'Most people in the Roman world lived and worked in the countryside. A villa rustica was a farmhouse at the centre of a working farm, with rooms for the farm manager and workers, barns, animal pens and areas for pressing grapes and olives.',
      'Farms ranged from small family plots to huge estates owned by wealthy landowners and worked largely by enslaved people.',
    ]],
    ['How it worked', [
      'The three most important crops of the Mediterranean world were grain (for bread), olives (for oil) and grapes (for wine). After harvest, grapes and olives were crushed in presses, and the juice or oil was stored in huge clay jars called dolia, often partly sunk into the ground to keep them cool.',
      'Roman writers left practical guides to farming. Cato the Elder and, later, Columella explained how to choose land, plant vines, look after animals and organise workers.',
    ]],
    ['Feeding the city', [
      'A big city like Rome could not grow enough food for itself. Grain came from farms across Italy and from overseas, especially Egypt and North Africa, while wine and oil came from farms all around the Mediterranean.',
    ]],
  ],
  'art' => 'This small, cosy farmhouse is the artist\'s interpretation. Real villa rustica farms usually had several buildings and work yards.',
  'look' => ['Find the olive tree and storage jars.', 'Notice the covered porch with columns.'],
  'questions' => ['Where does the food in your kitchen come from?', 'Why might farmers store oil and wine underground?', 'How did food get from farms to the city?'],
  'words' => ['Dolium' => 'A very large clay storage jar (plural dolia).', 'Estate' => 'A large area of land owned by one person or family.', 'Harvest' => 'Gathering ripe crops.'],
  'sources' => ['anc-cato'],
  'related' => ['olive-grove', 'warehouse', 'villa'],
],

// ---------------- Food, work and trade ----------------
'shop' => [
  'name' => 'Street shop (taberna)', 'latin' => 'taberna', 'cat' => 'trade', 'src' => 'art/business_1.png',
  'summary' => 'A small one-room shop opening straight onto the street, selling food, tools or services.',
  'facts' => ['Used for' => 'Selling and making goods', 'Size' => 'Usually one room with a wide opening', 'Often found' => 'On the ground floor of apartment blocks', 'Famous shopping complex' => 'Trajan\'s Market, Rome'],
  'sections' => [
    ['What it was', [
      'Roman streets were lined with small shops called tabernae. Each was usually a single room with a wide doorway that could be closed at night with wooden shutters. Many were built into the ground floors of apartment blocks and town houses.',
    ]],
    ['How it worked', [
      'Shopkeepers sold goods from a counter at the front, and often made them on the spot. A shop might be a bakery, a cloth seller, a metalworker, a barber or a wine seller. Some families lived in a small room at the back or on a mezzanine floor above.',
      'In Pompeii, bakeries still have their stone millstones, which were turned by donkeys or workers to grind grain into flour, and their big brick ovens. Painted signs and slogans on walls advertised goods and even election candidates.',
    ]],
    ['Places you can still see', [
      'Trajan\'s Market in Rome, built in the early 2nd century AD, is a multi-level complex of shops and offices curving along the side of a hill. In Ostia and Pompeii, whole streets of shop fronts survive, with counters and grooves where the shutters slid into place.',
    ]],
  ],
  'art' => 'The striped awning, jars and goods are the artist\'s interpretation.',
  'look' => ['What goods can you see? How are they stored?', 'Find the awning that shades the counter.'],
  'questions' => ['Where do people near you buy everyday things, and how far do they travel?', 'What are the advantages of living above or behind your shop?', 'How did shops advertise without screens or printing?'],
  'words' => ['Taberna' => 'A shop or workshop.', 'Mezzanine' => 'A low floor between two main floors.', 'Millstone' => 'A heavy stone used to grind grain.'],
  'sources' => ['sh-insula', 'sh-ostia', 'un-pompeii'],
  'related' => ['street-food', 'apartment-block', 'warehouse'],
],

'street-food' => [
  'name' => 'Snack bar (thermopolium)', 'latin' => 'thermopolium', 'cat' => 'trade', 'src' => 'art/floor_s.png',
  'summary' => 'A street counter selling hot food and drinks to people who had no kitchen at home.',
  'facts' => ['Used for' => 'Selling ready-to-eat food and drinks', 'Counter' => 'Stone, with jars set into it', 'Customers' => 'Workers, travellers and city residents', 'Famous find' => 'Painted counter in Pompeii, excavated 2019-2020'],
  'sections' => [
    ['What it was', [
      'Many people living in crowded apartment blocks had no kitchen, and cooking fires upstairs were a danger. So they bought ready-made food and drinks from street counters. Pompeii had dozens of these snack bars.',
    ]],
    ['How it worked', [
      'A typical snack bar had an L-shaped stone counter facing the street, with large jars set into the top. The jars held food and drink, which could be served hot or cold. Behind the counter there might be a small room for customers to sit.',
      'Between 2019 and 2020, archaeologists in Pompeii uncovered a snack bar with its counter painted with bright pictures, including ducks and a rooster. Traces of food were found in the jars, giving clues about what people ate.',
    ]],
    ['Eating out', [
      'Popular foods included bread, cheese, lentils, beans, olives, fish sauce and spiced wine. Snack bars were busy, noisy places, and wealthy writers sometimes looked down on them, but for ordinary people they were an important part of daily life.',
    ]],
  ],
  'art' => 'This illustration shows a shop with a home above. Real snack bars had a stone counter with jars set into it.',
  'look' => ['Find the counter and the storage jars.', 'Where might the family who runs it live?'],
  'questions' => ['Why might people in apartment blocks rely on street food?', 'What street food is popular where you live?', 'What can food remains tell archaeologists?'],
  'words' => ['Thermopolium' => 'A modern name for a Roman snack bar (from Greek for "hot drink shop").', 'Archaeologist' => 'Someone who studies the past by digging up objects and places.'],
  'sources' => ['pk-pompeii', 'un-pompeii'],
  'related' => ['shop', 'apartment-block', 'inn'],
],

'inn' => [
  'name' => 'Roadside inn', 'latin' => 'caupona / mansio', 'cat' => 'safety', 'src' => 'art/home_b.png',
  'summary' => 'A place for travellers to eat, sleep and rest their animals along Rome\'s great roads.',
  'facts' => ['Used for' => 'Food, beds and stabling for travellers', 'Found along' => 'Roman roads and near city gates', 'Famous road' => 'Via Appia, begun 312 BC', 'Distance markers' => 'Milestones'],
  'sections' => [
    ['What it was', [
      'The Romans built a network of paved roads across their empire to move armies, officials, traders and messages. Travelling was slow, so roads were lined with places to stop. A caupona was an inn or tavern offering food, drink and a bed. A mansio was an official stopping place where government messengers could rest and change horses.',
    ]],
    ['How it worked', [
      'A roadside inn was often built around a courtyard, with rooms for guests on two floors, a kitchen, a dining area and stables for horses and mules. Travellers paid for a meal, a bed and food for their animals.',
      'Stone milestones along the roads told travellers how far they had come. Roman maps were usually lists of towns and stopping places with the distances between them, rather than drawings of the land.',
    ]],
    ['Roman roads', [
      'The Via Appia, begun in 312 BC by Appius Claudius, ran south from Rome and became known as the "queen of roads". Long stretches of its paving stones can still be walked today, lined with ancient tombs.',
    ]],
  ],
  'art' => 'This building is used to illustrate an inn built around a courtyard. Its design is the artist\'s own.',
  'look' => ['Find the courtyard and fountain in the middle.', 'Where might travellers sleep?'],
  'questions' => ['How long might it take to travel 100 kilometres on foot, or with a mule?', 'Why would an empire build roads and inns?', 'Where do travellers rest today on long journeys?'],
  'words' => ['Caupona' => 'An inn or tavern.', 'Mansio' => 'An official rest stop for government travellers.', 'Milestone' => 'A stone marking distance along a road.'],
  'sources' => ['brit-appia', 'un-rome', 'un-pompeii'],
  'related' => ['mausoleum', 'street-food', 'city-walls'],
],

'warehouse' => [
  'name' => 'Warehouse (horrea)', 'latin' => 'horrea', 'cat' => 'trade', 'src' => 'art/floor_l.png',
  'summary' => 'A strong storehouse built around a courtyard, where grain, oil and wine for the city were kept safe.',
  'facts' => ['Used for' => 'Storing food and goods', 'Stored' => 'Grain, olive oil, wine and more', 'Best seen at' => 'Ostia, Rome\'s port', 'Containers' => 'Amphorae (two-handled clay jars)'],
  'sections' => [
    ['What it was', [
      'A city of perhaps a million people needed enormous amounts of food, most of it shipped in from across the Mediterranean. Goods arriving at the port were stored in warehouses called horrea before being sold or handed out.',
    ]],
    ['How it worked', [
      'Many warehouses were built around a central courtyard, with rows of storerooms on one or two floors. Thick walls, small windows and raised floors helped keep grain dry, cool and safe from thieves and pests. Heavy doors could be locked.',
      'In Ostia, the Horrea Epagathiana, a two-storey warehouse from the 2nd century AD, still has its decorated brick entrance with an inscription naming its owners.',
    ]],
    ['Feeding Rome', [
      'The Roman government organised a regular grain supply for the city, and for long periods free or cheap grain was handed out to many citizens. Olive oil and wine travelled in clay jars called amphorae. In Rome, so many broken oil jars were thrown away near the warehouses by the river that they formed a whole hill, Monte Testaccio, which still stands today.',
    ]],
  ],
  'art' => 'This illustration is grander than a typical warehouse. It is used here to show the courtyard plan many warehouses shared.',
  'look' => ['Find the courtyard in the middle.', 'Notice how the rooms surround it.'],
  'questions' => ['How does food reach the shops in your town?', 'Why would a city government care about its food supply?', 'What would happen if the grain ships stopped coming?'],
  'words' => ['Horrea' => 'Warehouses or storehouses.', 'Amphora' => 'A two-handled clay jar for oil or wine.', 'Port' => 'A town with a harbour for ships.'],
  'sources' => ['sh-ostia', 'brit-aerarium'],
  'related' => ['olive-grove', 'shop', 'lighthouse'],
],

// ---------------- Learning ----------------
'school' => [
  'name' => 'School', 'latin' => 'ludus litterarius', 'cat' => 'learn', 'src' => 'art/knowledge_1.png',
  'summary' => 'Roman children learned reading, writing and arithmetic from teachers who often taught in open rooms facing the street.',
  'facts' => ['Who went' => 'Children whose families could pay', 'Lessons' => 'Reading, writing, arithmetic, later literature and speaking', 'Writing tools' => 'Wax tablets and a stylus', 'Writer on teaching' => 'Quintilian'],
  'sections' => [
    ['What it was', [
      'Rome had no public school system. Families who could afford it paid a teacher to educate their children, and many children, especially from poor families, received little or no schooling. Wealthy families sometimes hired a tutor at home instead.',
    ]],
    ['Stages of learning', [], ['list' => [
      'From about age seven, a primary teacher taught reading, writing and counting.',
      'Older pupils studied Latin and Greek literature with a teacher called a grammaticus.',
      'Some young men went on to a rhetor to learn public speaking, needed for law and politics.',
    ]]],
    ['How lessons worked', [
      'Classes were often held in a rented shop or a covered space open to the street, sometimes just behind a curtain. Pupils wrote on wooden tablets coated with wax, using a pointed stylus; the flat end could smooth the wax to start again. Ink and papyrus were used for more permanent writing. Counting might be done on fingers, with pebbles or on a counting board.',
      'In the 1st century AD, the teacher Quintilian wrote a long book on education. He argued that teachers should be patient, that pupils learn better when encouraged than when punished, and that learning should start early.',
    ]],
  ],
  'art' => 'This open hall with shelves of scrolls is the artist\'s interpretation of a place of learning.',
  'look' => ['Find the shelves of scrolls.', 'Notice the open arches. Could people passing by hear the lessons?'],
  'questions' => ['Who was left out of Roman education, and why does that matter?', 'How is your school different from a Roman one?', 'Do you agree with Quintilian that encouragement works better than punishment?'],
  'words' => ['Stylus' => 'A pointed tool for writing on wax.', 'Grammaticus' => 'A teacher of literature and language.', 'Rhetoric' => 'The art of persuasive speaking.'],
  'sources' => ['brit-edu', 'anc-quintilian'],
  'related' => ['library', 'records-office', 'domus'],
],

'library' => [
  'name' => 'Library', 'latin' => 'bibliotheca', 'cat' => 'learn', 'src' => 'art/knowledge_2.png',
  'summary' => 'A building where scrolls were stored in wall cupboards and read by scholars and citizens.',
  'facts' => ['Used for' => 'Storing and reading books', 'Books were' => 'Scrolls of papyrus or parchment', 'Famous example' => 'Library of Celsus, Ephesus', 'Dedicated' => 'AD 110'],
  'sections' => [
    ['What it was', [
      'Roman books were scrolls: long strips of papyrus or parchment rolled around a stick. Wealthy Romans collected private libraries, and from the late 1st century BC public libraries were built in Rome. Emperors added more, often in pairs, one for Greek books and one for Latin. The Forum of Trajan had twin libraries beside Trajan\'s Column, and some large public baths had libraries too.',
    ]],
    ['How it worked', [
      'Scrolls were kept in wooden cupboards set into niches in the walls. Readers asked library staff for the scrolls they wanted and read them in the hall or nearby colonnades. Every copy was written out by hand, often by trained enslaved scribes, so books were valuable.',
    ]],
    ['Places you can still see', [
      'The Library of Celsus at Ephesus, in modern Turkey, was dedicated around AD 110 in memory of a Roman governor, Celsus. Its two-storey marble front has been rebuilt and is one of the most photographed Roman buildings in the world.',
      'At Herculaneum, a villa buried by Mount Vesuvius in AD 79 held a library of scrolls that were turned to charcoal by the heat. Today scientists are using scanning and computer techniques to read some of them without unrolling them.',
    ]],
  ],
  'art' => 'This domed building with shelves of scrolls is the artist\'s interpretation of a library.',
  'look' => ['Find the shelves of scrolls through the arches.', 'Notice the dome on top.'],
  'questions' => ['How would it change things if every book had to be copied by hand?', 'Who could use a public library in Rome? Who can use yours?', 'Why might emperors build libraries?'],
  'words' => ['Scroll' => 'A long rolled-up sheet used as a book.', 'Papyrus' => 'A paper-like material made from a river plant.', 'Scribe' => 'Someone who copies texts by hand.'],
  'sources' => ['brit-ephesus', 'un-ephesus', 'un-pompeii'],
  'related' => ['school', 'records-office', 'public-baths'],
],

'records-office' => [
  'name' => 'Records office (tabularium)', 'latin' => 'tabularium', 'cat' => 'learn', 'src' => 'art/knowledge_3.png',
  'summary' => 'Rome\'s official archive, where laws and public records were kept, built into the hillside above the Forum.',
  'facts' => ['Used for' => 'Keeping official records', 'Location' => 'Capitoline Hill, above the Roman Forum', 'Built' => 'Around 78 BC', 'Today' => 'Part of the Capitoline Museums'],
  'sections' => [
    ['What it was', [
      'A government needs records: laws, treaties, decisions, lists of citizens and accounts. In Rome these were kept in archives, and the most famous building linked with them is the Tabularium. Its name comes from tabula, meaning a tablet, because many records were written on tablets of wax, wood or bronze.',
    ]],
    ['How it worked', [
      'The Tabularium was built around 78 BC on the slope of the Capitoline Hill, facing down over the Roman Forum. An inscription names the consul Quintus Lutatius Catulus as responsible for it. Its strong stone walls and vaulted rooms helped protect documents from fire.',
      'Important laws were also engraved on bronze tablets and displayed in public so that everyone could read them. Some of these bronze tablets survive in museums today.',
    ]],
    ['What you can see today', [
      'The lower part of the Tabularium still forms the base of Rome\'s city hall on the Capitoline Hill. Visitors to the Capitoline Museums can walk through its arched gallery and enjoy one of the best views over the Roman Forum.',
    ]],
  ],
  'art' => 'This domed building with desks and scroll shelves is the artist\'s interpretation of a records office.',
  'look' => ['Find the desks and shelves.', 'Why might records need a strong building?'],
  'questions' => ['What records does your government keep about you?', 'Why was it important to display laws in public?', 'What happens when records are lost or destroyed?'],
  'words' => ['Archive' => 'A collection of records.', 'Tabula' => 'A writing tablet.', 'Consul' => 'One of the two highest officials of the Roman Republic.'],
  'sources' => ['brit-aerarium', 'sh-forum', 'un-rome'],
  'related' => ['treasury', 'library', 'forum'],
],

// ---------------- Gardens and farmland ----------------
'garden' => [
  'name' => 'Garden courtyard', 'latin' => 'peristylium / hortus', 'cat' => 'land', 'src' => 'art/growth_1.png',
  'summary' => 'A green garden surrounded by covered walkways, with plants, fountains and statues, at the heart of many homes.',
  'facts' => ['Used for' => 'Rest, beauty, herbs and vegetables', 'Shape' => 'Garden surrounded by columns', 'Features' => 'Fountains, pools, statues, paintings', 'Best seen at' => 'Pompeii'],
  'sections' => [
    ['What it was', [
      'Many Roman homes had a garden at their centre. In larger houses it was surrounded by a colonnade, a covered walkway on columns, forming a peristyle. Smaller homes might have a simple yard for vegetables and herbs, called a hortus.',
    ]],
    ['What grew there', [
      'Gardens mixed beauty and usefulness: shady trees, flowers such as roses and violets, herbs for cooking and medicine, and vegetables. Owners added fountains, pools, statues and painted walls showing even more plants and birds, making small gardens feel bigger.',
      'In Pompeii, the archaeologist Wilhelmina Jashemski studied gardens by filling the holes left by ancient roots with plaster, then identifying the plants from the casts. Her work showed how carefully gardens were planned.',
    ]],
    ['Places you can still see', [
      'The House of the Vettii in Pompeii has a replanted peristyle garden with its fountains and statues. In Rome\'s Palazzo Massimo museum, a whole room of wall paintings from the villa of Livia, wife of Augustus, shows a lush garden full of trees, flowers and birds. In England, Fishbourne Roman Palace has a replanted formal garden.',
    ]],
  ],
  'art' => 'This garden courtyard is an illustration of a peristyle garden. The plants and fountain layout are the artist\'s own.',
  'look' => ['Find the fountain and the paths.', 'Notice the covered walkway around the edge.'],
  'questions' => ['How could gardens collect and use rainwater?', 'Why might city people want a garden at home?', 'What plants would you grow, and why?'],
  'words' => ['Peristyle' => 'A garden surrounded by a colonnade.', 'Hortus' => 'A garden, often for vegetables and herbs.', 'Fresco' => 'A painting made on fresh, wet plaster.'],
  'sources' => ['sh-domus', 'un-pompeii'],
  'related' => ['domus', 'villa', 'olive-grove'],
],

'olive-grove' => [
  'name' => 'Olive grove', 'latin' => 'olivetum', 'cat' => 'land', 'src' => 'art/nt_garden.png',
  'summary' => 'Groves of olive trees produced oil used for cooking, lighting lamps, washing and medicine.',
  'facts' => ['Product' => 'Olive oil', 'Used for' => 'Cooking, lamps, bathing, medicine', 'Stored in' => 'Amphorae', 'Monte Testaccio' => 'A hill made of broken oil jars'],
  'sections' => [
    ['What it was', [
      'Olive trees grow well in the hot, dry summers of the Mediterranean and can live for hundreds of years. Olive oil was one of the most important products of the Roman world, alongside grain and wine.',
    ]],
    ['How oil was made', [], ['list' => [
      'Olives were picked or shaken from the trees in late autumn and winter.',
      'They were crushed in a stone mill to make a paste.',
      'The paste was squeezed in a press to release oil and water.',
      'The oil was left to separate from the water, then stored in jars.',
    ]]],
    ['Oil in everyday life', [
      'Romans used olive oil for cooking and eating, as fuel in clay lamps to light their homes, and at the baths to clean their skin. It was also used in medicines and perfumes.',
      'Huge amounts of oil were shipped to Rome from Spain and North Africa in clay jars. Once empty, the jars were hard to reuse, so they were broken and piled up near the river warehouses. Over centuries the pieces formed Monte Testaccio, an artificial hill of pottery that still stands in Rome.',
    ]],
  ],
  'art' => 'This grove is an illustration. Real olive groves were usually planted in neat rows across hillsides.',
  'look' => ['Notice the silvery-green leaves and twisted trunks.', 'What other plants grow among the trees?'],
  'questions' => ['How many different uses for olive oil can you think of?', 'Why might a tree that lives for centuries be valuable to a farming family?', 'What happens to packaging today when it is empty?'],
  'words' => ['Grove' => 'A small group of trees.', 'Press' => 'A machine for squeezing out liquid.', 'Amphora' => 'A two-handled clay jar.'],
  'sources' => ['anc-cato', 'sh-ostia'],
  'related' => ['farmhouse', 'warehouse', 'garden'],
],

// ---------------- Defence and travel ----------------
'city-walls' => [
  'name' => 'City walls and towers', 'latin' => 'moenia, turris', 'cat' => 'safety', 'src' => 'art/nt_tower.png',
  'summary' => 'Strong walls with towers and gates protected Roman cities, including Rome itself in later centuries.',
  'facts' => ['Used for' => 'Defence and controlling who entered', 'Rome\'s great wall' => 'Aurelian Walls, AD 271-275', 'Length' => 'About 19 kilometres', 'Frontier wall' => 'Hadrian\'s Wall, Britain'],
  'sections' => [
    ['What it was', [
      'Walls protected cities from attack and let guards control who came in and out through the gates. Rome had early walls, but as the empire grew strong and its borders far away, the city spread far beyond them and for centuries had no need for new defences.',
      'In the 3rd century AD, the empire faced invasions and civil wars. Between AD 271 and 275, the emperor Aurelian built a new wall around Rome, about 19 kilometres long, with a square tower roughly every 30 metres.',
    ]],
    ['How it worked', [
      'Towers stuck out from the wall so that defenders could shoot along its face at attackers trying to climb it. Gates were the weakest points, so they were usually flanked by two strong towers. Walls were later made taller and stronger as threats grew.',
    ]],
    ['Places you can still see', [
      'Long stretches of the Aurelian Walls still surround central Rome. The Porta San Sebastiano, where the Via Appia leaves the city, is one of the best-preserved gates and houses a small museum of the walls. In Britain, Hadrian\'s Wall, begun in AD 122, marked the empire\'s northern frontier.',
    ]],
  ],
  'art' => 'This single tower is an illustration. Real Roman city walls were long continuous circuits with many towers.',
  'look' => ['Find the battlements at the top of the tower.', 'Why might the tower have so few windows?'],
  'questions' => ['Why did Rome go for centuries without needing new walls?', 'How do cities protect people today?', 'What might it feel like to live inside city walls?'],
  'words' => ['Battlements' => 'The notched top of a wall for defenders to shelter behind.', 'Gate' => 'An opening in a wall that can be closed.', 'Frontier' => 'The edge of a country or empire.'],
  'sources' => ['brit-walls', 'un-frontiers', 'un-rome'],
  'related' => ['lighthouse', 'inn', 'triumphal-arch'],
],

'lighthouse' => [
  'name' => 'Lighthouse', 'latin' => 'pharus', 'cat' => 'safety', 'src' => 'art/growth_3.png',
  'summary' => 'A tall tower with a fire on top that guided ships safely into harbour at night.',
  'facts' => ['Used for' => 'Guiding ships into port', 'Light from' => 'A fire on top (smoke by day)', 'Still in use' => 'Tower of Hercules, Spain', 'Also surviving' => 'Roman lighthouse at Dover, England'],
  'sections' => [
    ['What it was', [
      'Sea trade was vital to the Roman Empire, and harbours needed lights so that ships could find their way at night and avoid rocks. The Romans were inspired by the famous lighthouse of Alexandria in Egypt, the Pharos, and the Latin word for lighthouse, pharus, comes from its name.',
    ]],
    ['How it worked', [
      'A fire was kept burning at the top of the tower at night, and its smoke could help guide ships by day. Keepers had to carry fuel up to the top and tend the flame. Lighthouses were built on headlands and at harbour entrances, where their light could be seen far out to sea.',
      'At Portus, Rome\'s great harbour near Ostia, the emperor Claudius built a lighthouse on an artificial island in the harbour entrance.',
    ]],
    ['Places you can still see', [
      'The Tower of Hercules in A Coruña, Spain, was built in the late 1st century AD and is still a working lighthouse today, the only Roman lighthouse still used for its original purpose. Its Roman core was encased in new stone in the 18th century. At Dover in England, part of a Roman lighthouse still stands beside a church inside Dover Castle.',
    ]],
  ],
  'art' => 'This tower is an illustration, not the Tower of Hercules.',
  'look' => ['Find where the fire burns at the top.', 'Notice the walls around the base.'],
  'questions' => ['How did sailors find a safe harbour before electric lights?', 'Why would an empire invest in lighthouses?', 'What guides ships and planes today?'],
  'words' => ['Pharos' => 'A lighthouse, named after the one at Alexandria.', 'Headland' => 'A point of land sticking out into the sea.', 'Harbour' => 'A sheltered place where ships can stay safely.'],
  'sources' => ['un-hercules', 'anc-suetonius'],
  'related' => ['warehouse', 'city-walls', 'aqueduct'],
],

// ---------------- Building the city ----------------
'crane' => [
  'name' => 'Treadwheel crane', 'latin' => 'polyspastos', 'cat' => 'build', 'src' => 'build/crane.png',
  'summary' => 'A wooden crane with pulleys and a giant wheel that workers walked inside to lift heavy stone blocks.',
  'facts' => ['Used for' => 'Lifting heavy building materials', 'Power' => 'People walking inside a large wheel', 'Described by' => 'Vitruvius, 1st century BC', 'Shown on' => 'A carved relief from the Tomb of the Haterii'],
  'sections' => [
    ['What it was', [
      'Roman builders lifted huge stone blocks, columns and beams without engines. They used wooden cranes with ropes and pulleys. For the heaviest loads, the crane was powered by a large wooden wheel. Workers walked inside the wheel like a hamster in a wheel, turning it and winding up the rope.',
    ]],
    ['How it worked', [
      'Pulleys make lifting easier. By running a rope through several wheels, a small pulling force can lift a much heavier load, though the rope has to be pulled further. A big treadwheel added even more power, because the wide wheel turned a narrow drum that wound the rope.',
      'The Roman architect Vitruvius described several lifting machines in his book On Architecture, including cranes with many pulleys and one turned by men walking inside a drum-wheel.',
    ]],
    ['Evidence', [
      'A carved stone relief from the Tomb of the Haterii, a family tomb near Rome, shows a large crane with a treadwheel being used to build a monument. It is now in the Vatican Museums. Modern engineers have built working copies of Roman treadwheel cranes to test how they lifted stone.',
    ]],
  ],
  'art' => 'This crane is an artistic illustration. The soft glow around it is part of the original artwork.',
  'look' => ['Follow the rope from the wheel to the stone block.', 'Find the pulleys at the top of the arm.'],
  'questions' => ['How does a big wheel make a heavy stone easier to lift?', 'What machines do builders use today instead?', 'What would it be like to work inside the wheel?'],
  'words' => ['Pulley' => 'A wheel with a rope that helps lift loads.', 'Treadwheel' => 'A wheel turned by people or animals walking inside it.', 'Relief' => 'A carving that stands out from a flat surface.'],
  'sources' => ['anc-vitruvius', 'sh-haterii'],
  'related' => ['building-materials', 'amphitheater', 'pantheon'],
],

'building-materials' => [
  'name' => 'Building materials', 'latin' => 'materia', 'cat' => 'build', 'src' => 'build/materials.png',
  'summary' => 'Concrete, brick, stone, marble and clay tiles: the materials that built Rome.',
  'facts' => ['Secret ingredient' => 'Volcanic ash (pozzolana) in concrete', 'Roof tiles' => 'Flat tegulae and curved imbrices', 'Fine stone' => 'Marble from Luna (Carrara) and overseas', 'Famous boast' => 'Augustus "left Rome a city of marble"'],
  'sections' => [
    ['Roman concrete', [
      'The Romans made a strong concrete by mixing lime, water and a volcanic ash called pozzolana with chunks of stone or broken brick. It could be poured into wooden frames to make walls, vaults and domes, and some mixtures even set underwater, which helped in building harbours. The Pantheon\'s great dome is made of Roman concrete.',
      'Concrete walls were usually faced with brick or stone. One pattern, called opus reticulatum, used small square stones set diagonally like a net.',
    ]],
    ['Brick and tile', [
      'Fired clay bricks were made in large numbers. Many bricks were stamped by the workshop that made them, and these stamps help archaeologists date buildings. Roofs were covered with flat clay tiles (tegulae) with curved tiles (imbrices) over the joints to keep out rain.',
    ]],
    ['Stone and marble', [
      'Builders used local stone such as travertine, a hard pale limestone used for much of the Colosseum, and tuff, a softer volcanic stone. For the grandest buildings they used marble, white from Luna (modern Carrara) in Italy and coloured marbles shipped from Greece, Egypt and North Africa. The writer Suetonius reported that Augustus boasted he had found Rome a city of brick and left it a city of marble.',
      'The Roman architect Vitruvius wrote about choosing and preparing building materials, from sand and lime to timber.',
    ]],
  ],
  'art' => 'The stacked stone blocks, curved roof tiles and tools are the artist\'s interpretation of a Roman building site.',
  'look' => ['Find the curved roof tiles.', 'Which tools can you spot in the box?'],
  'questions' => ['Which of these materials could be found nearby, and which would need to be carried far?', 'Why might it matter that Roman concrete could set underwater?', 'What materials are buildings near you made from?'],
  'words' => ['Pozzolana' => 'Volcanic ash used in Roman concrete.', 'Travertine' => 'A hard, pale limestone.', 'Imbrex' => 'A curved roof tile (plural imbrices).'],
  'sources' => ['brit-concrete', 'anc-vitruvius', 'anc-suetonius', 'sh-pantheon'],
  'related' => ['crane', 'pantheon', 'aqueduct'],
],
];

$WORLD_DATA['roman'] = [
  'title'    => 'Ancient Roman City Explorer: 35 buildings and how they worked',
  'desc'     => 'Explore an illustrated ancient Roman city. Open any of 35 buildings, from aqueducts and baths to the Pantheon and the Senate house, to learn how it worked, with photos of real Roman sites.',
  'intro'    => 'Ancient Rome was a real city of perhaps a million people. Explore 35 of its buildings: what each one was for, how it worked and where you can still see real examples today.',
  'note'     => 'The buildings are illustrations, not exact reconstructions. Each page separates what history tells us from what the artist imagined, and lists its sources.',
  'aka'      => 'Latin',
  'akaLang'  => 'la',
  'pageTitle'=> '%s in Ancient Rome: how it worked',
  'defaultTag' => 'history',
  'aside'    => ['About dates', 'Dates marked BC count backwards from the traditional year of the birth of Jesus, so 312 BC came before 100 BC. Dates marked AD count forwards, so AD 80 came before AD 216. Many historians write BCE and CE instead; they mean the same years.'],
  'pageDesc' => ' Learn how it worked, see photos of real Roman examples, and explore questions for discussion.',
  'sourcesIntro' => 'The history on this page is a short summary based on these sources:',
  'about'    => 'Ancient Roman architecture and city life',
  // Positions on the 6 x 6 map, from the back corner (0) to the front corner (35).
  // Tall pieces stand at the back, low and wide ones at the front. 'tree' is a decorative tree.
  'map' => [
    'crane', 'lighthouse', 'victory-column', 'city-walls', 'imperial-statue', 'temple',
    'mausoleum', 'pantheon', 'imperial-palace', 'curia', 'treasury', 'temple-of-vesta',
    'amphitheater', 'circus', 'basilica', 'library', 'records-office', 'triumphal-arch',
    'villa', 'forum', 'public-baths', 'apartment-block', 'domus', 'school',
    'gladiator-school', 'warehouse', 'farmhouse', 'inn', 'shop', 'street-food',
    'olive-grove', 'garden', 'tree', 'public-fountain', 'building-materials', 'aqueduct',
  ],
  'tree'     => 'olive-tree',
  'sources'  => $ROMAN_SOURCES,
  'cats'     => $ROMAN_CATEGORIES,
  'pages'    => $ROMAN,
];
