<?php
// Vehicles: four per world, from the supplied vehicle art (vehicle-batch-01, car_1..car_4 with back views).
// Each vehicle becomes a normal page of its world in a new "Vehicles and getting around" group.
// Image files: public/assets/worlds/{world}/{slug}-*.webp (front) and rear-{slug}-*.webp (back),
// copied by tools/copy-people-vehicles.sh. Included from build.php after the world files.

const VEHICLE_CAT = ['Vehicles and getting around', 'How people and goods move around the city.'];

$VEHICLE_SOURCES = [
  'roman' => [
    'brit-roads'   => 'Encyclopaedia Britannica, "Roman road system"',
    'lex-julia'    => 'Tabula Heracleensis (Lex Julia Municipalis, about 45 BC), rules on wagons in the streets of Rome',
    'juvenal'      => 'Juvenal, Satires, Book 1, Satire 3 (on traffic noise in Rome at night)',
    'brit-chariot' => 'Encyclopaedia Britannica, "Chariot" and "Triumph"',
    'diocles'      => 'Inscription honoring the charioteer Gaius Appuleius Diocles (CIL VI 10048), 2nd century AD',
    'brit-cursus'  => 'Encyclopaedia Britannica, "Cursus publicus" (the Roman state transport service)',
    'testaccio'    => 'University of Barcelona, CEIPAC research project on Monte Testaccio and Roman amphorae',
    'brit-litter'  => 'Encyclopaedia Britannica, "Litter" (sedan chair)',
    'suetonius'    => 'Suetonius, "The Life of Julius Caesar", chapter 43',
  ],
  'modern' => [
    'brit-auto'    => 'Encyclopaedia Britannica, "Automobile" and "Model T"',
    'shoup'        => 'Donald Shoup, "The High Cost of Free Parking" (2005)',
    'iea-ev'       => 'International Energy Agency, "Global EV Outlook"',
    'nhtsa-belt'   => 'US National Highway Traffic Safety Administration, "Seat Belts"',
    'brit-taxi'    => 'Encyclopaedia Britannica, "Taxicab" and "Taximeter"',
    'nyc-tlc'      => 'New York City Taxi and Limousine Commission, history and accessible vehicle rules',
    'iihs'         => 'Insurance Institute for Highway Safety, research on vehicle height, front-end design and pedestrian safety',
    'wef-lastmile' => 'World Economic Forum, "The Future of the Last-Mile Ecosystem" (2020)',
    'usps-ngdv'    => 'United States Postal Service, Next Generation Delivery Vehicle program',
  ],
  'elven' => [
    'brit-sami'    => 'Encyclopaedia Britannica, "Sami" and "Reindeer"',
    'horse-log'    => 'Forestry England and the British Horse Loggers, guidance on working horses in woodland',
    'henryford'    => 'The Henry Ford museum, "Soybean Car" (1941)',
    'natfiber'     => 'Research reviews on natural-fiber composites (flax, hemp and kenaf) in car parts',
    'dacke'        => 'Dacke and colleagues, "Dung beetles use the Milky Way for orientation", Current Biology (2013)',
    'legged'       => 'Research on legged and insect-inspired robots, including the Biomimicry Institute\'s AskNature database',
  ],
  'future' => [
    'maglev'       => 'Central Japan Railway Company, SCMaglev (603 km/h test run, 2015), and Shanghai Maglev Transportation, line opened 2004',
    'cockerell'    => 'Encyclopaedia Britannica, "Hovercraft" (Christopher Cockerell, 1950s)',
    'jaxa-rover'   => 'JAXA and NASA, 2024 agreement for a Japanese pressurized lunar rover for Artemis',
    'nasa-sev'     => 'NASA, "Space Exploration Vehicle" concept and tests',
    'autohaul'     => 'Rio Tinto, autonomous haul trucks in the Pilbara iron ore mines of Western Australia',
    'nasa-clps'    => 'NASA, Commercial Lunar Payload Services (CLPS) robotic Moon deliveries',
    'ingenuity'    => 'NASA Jet Propulsion Laboratory, Ingenuity Mars Helicopter (first flight April 19, 2021; 72 flights)',
    'dragonfly'    => 'NASA and Johns Hopkins Applied Physics Laboratory, Dragonfly rotorcraft mission to Titan',
  ],
];

$VEHICLES = [
'roman' => [
'ox-cart' => [
  'name' => 'Ox cart', 'latin' => 'plaustrum', 'src' => 'vehicle/car_1.png',
  'summary' => 'A heavy wooden wagon pulled by oxen, used to haul grain, wine, building stone and other heavy loads.',
  'facts' => ['Pulled by' => 'A pair of oxen', 'Speed' => 'Walking pace', 'Carried' => 'Heavy loads: grain, stone, barrels', 'Traveled on' => 'Roman roads and farm tracks'],
  'sections' => [
    ['Slow but strong', [
      'Oxen are cattle trained to work. They are slower than horses, but strong, calm and cheaper to feed, so Romans used them to pull plows and heavy carts. A loaded ox cart moved at about walking pace.',
      'Most carts had solid wooden wheels or wheels with spokes, fixed to an axle. Without springs, the ride was bumpy, so passengers who could afford it preferred other ways to travel.',
    ]],
    ['Roads built for wheels', [
      'Romans built a network of paved roads across their empire, starting with the Via Appia in 312 BC. Roads had layers of stone and gravel, a curved surface so rain drained off, and milestones that showed the distance. They were built mainly for armies, but traders, carts and travelers used them too.',
    ]],
    ['Carts at night', [
      'Rome\'s streets were narrow and crowded. A law from the time of Julius Caesar banned most wagons from the city during the day, with exceptions such as carts carrying materials for public buildings. So deliveries happened at night, and the poet Juvenal complained that the rumble of wagons kept people awake.',
    ]],
  ],
  'art' => 'This illustration shows a cart of barrels pulled by two oxen. Barrels were used in the northern provinces, while Mediterranean traders more often used clay jars called amphorae.',
  'look' => ['How many oxen are pulling the cart?', 'Look at the wheels. What are they made of?'],
  'questions' => ['Why might a city ban delivery carts during the day?', 'What problems do delivery trucks cause in cities today?', 'Why would a farmer choose oxen instead of horses?'],
  'words' => ['Plaustrum' => 'A heavy Roman farm wagon.', 'Axle' => 'The rod that joins two wheels.', 'Milestone' => 'A stone marking the distance along a road.'],
  'sources' => ['brit-roads', 'brit-appia', 'lex-julia', 'juvenal'],
  'related' => ['farmhouse', 'warehouse', 'donkey-cart'],
],
'chariot' => [
  'name' => 'Chariot', 'latin' => 'currus', 'src' => 'vehicle/car_2.png',
  'summary' => 'A light two-wheeled vehicle pulled by horses. Romans raced chariots in the circus and rode them in victory parades.',
  'facts' => ['Wheels' => 'Two', 'Used for' => 'Racing and victory parades', 'Racing teams' => 'Red, White, Blue and Green', 'Four-horse chariot' => 'Quadriga'],
  'sections' => [
    ['Not for war', [
      'Chariots were used in battle in many ancient lands, but by the time Rome was a great power its armies fought on foot and on horseback, not in chariots. Romans used chariots for two things: racing, and the triumph, a parade for a victorious general who rode through Rome in a decorated chariot.',
    ]],
    ['Racing chariots', [
      'Racing chariots were very light, so the horses could run fast. A chariot pulled by two horses was a biga, and one pulled by four was a quadriga. Drivers wrapped the reins around their bodies and carried a knife to cut themselves free in a crash.',
      'The best drivers became rich and famous. An inscription in Rome honors Gaius Appuleius Diocles, who won 1,462 races in the 2nd century AD and earned a huge fortune in prize money.',
    ]],
  ],
  'art' => 'The driver here wears a soldier\'s helmet and cloak, which suits a parade more than a race: racing drivers wore leather caps and tunics in their team\'s color. Real racing chariots were usually pulled by two or four horses.',
  'look' => ['How many wheels does the chariot have?', 'Find the laurel wreath decoration on the side.'],
  'questions' => ['Why would a racing chariot need to be very light?', 'Which modern sports stars are as famous as Roman charioteers?', 'Why might a general want to parade through the city in a chariot?'],
  'words' => ['Biga' => 'A chariot pulled by two horses.', 'Quadriga' => 'A chariot pulled by four horses.', 'Auriga' => 'A chariot driver.'],
  'sources' => ['brit-chariot', 'brit-circus', 'diocles'],
  'related' => ['circus', 'triumphal-arch', 'amphitheater'],
],
'donkey-cart' => [
  'name' => 'Donkey cart', 'latin' => 'carrus', 'src' => 'vehicle/car_3.png',
  'summary' => 'A small cart pulled by a donkey or mule, the everyday delivery van of the Roman world.',
  'facts' => ['Pulled by' => 'Donkeys or mules', 'Carried' => 'Amphorae of oil, wine and fish sauce', 'State service' => 'Cursus publicus', 'Famous trash heap' => 'Monte Testaccio, Rome'],
  'sections' => [
    ['Donkeys and mules', [
      'Donkeys and mules carried much of the Roman world\'s goods, either in carts or with packs on their backs. A mule is the offspring of a donkey and a horse: strong, sure-footed and hardy.',
      'The emperor Augustus set up a state transport service, the cursus publicus, with stations along the main roads where officials could change animals and vehicles. It carried government messages, officials and goods.',
    ]],
    ['Jars for everything', [
      'Romans shipped olive oil, wine and fish sauce in clay jars called amphorae. They had pointed bottoms that could be pushed into sand or stacked in a ship\'s hold, and two handles for carrying.',
      'Used olive oil amphorae were often broken and thrown away. In Rome, a whole hill called Monte Testaccio is made of pieces of tens of millions of them. Stamps and writing on the pieces tell historians where the oil came from.',
    ]],
  ],
  'art' => 'This illustration shows a donkey pulling a cart full of amphorae. The bright clothes and decoration are the artist\'s interpretation.',
  'look' => ['Count the amphorae in the cart.', 'Look at the shape of the jars. How would they stand up?'],
  'questions' => ['Why would traders use clay jars instead of boxes?', 'What does a hill of old jars tell us about Roman trade?', 'What do we throw away today that could tell future historians about us?'],
  'words' => ['Amphora' => 'A two-handled clay jar for oil or wine.', 'Mule' => 'The offspring of a donkey and a horse.', 'Cursus publicus' => 'The Roman state transport service.'],
  'sources' => ['brit-cursus', 'testaccio', 'brit-roads'],
  'related' => ['shop', 'street-food', 'ox-cart'],
],
'litter' => [
  'name' => 'Litter', 'latin' => 'lectica', 'src' => 'vehicle/car_4.png',
  'summary' => 'A covered couch carried on poles by bearers. Rich Romans rode in litters through the crowded streets.',
  'facts' => ['Carried by' => 'Teams of bearers', 'Who rode' => 'Wealthy Romans', 'Bearers' => 'Usually enslaved men', 'Later version' => 'The sedan chair'],
  'sections' => [
    ['Riding above the crowd', [
      'A litter was a couch or chair with a roof and curtains, carried on long poles by bearers. Rich Romans used litters in the city, where wagons were banned by day, and on short trips. They could read, rest or talk with friends while being carried.',
      'Litters were a sign of wealth and power. Julius Caesar limited who could use them in Rome, allowing them only to certain people and on certain days.',
    ]],
    ['The bearers', [
      'Litter bearers, called lecticarii, were usually enslaved men, chosen for their strength and often dressed to match. Slavery was common in the Roman world, and much of the hard physical work of the city was done by enslaved people.',
    ]],
    ['After Rome', [
      'Litters and sedan chairs stayed in use for centuries. In the 1600s and 1700s, hired sedan chairs carried people through the streets of cities such as London and Paris, a little like taxis.',
    ]],
  ],
  'art' => 'This illustration shows a red and gold litter carried by two bearers. Real litters often needed four, six or even eight bearers.',
  'look' => ['How many bearers are carrying the litter?', 'Find the curtains. Why might riders want privacy?'],
  'questions' => ['Is it fair that some people were carried while others did the carrying?', 'What are the "litters" of today: ways only rich people travel?', 'Why would a ruler limit who could use a litter?'],
  'words' => ['Lectica' => 'A Roman litter.', 'Lecticarius' => 'A litter bearer.', 'Sedan chair' => 'A later, chair-shaped litter.'],
  'sources' => ['brit-litter', 'suetonius', 'lex-julia'],
  'related' => ['villa', 'imperial-palace', 'domus'],
],
],

'modern' => [
'family-car' => [
  'name' => 'Family car', 'latin' => 'automobile', 'src' => 'vehicle/car_1.png',
  'summary' => 'The everyday car changed how towns are built: wide roads, parking lots, drive-throughs and suburbs.',
  'facts' => ['Mass production' => 'Ford Model T, from 1908', 'Moving assembly line' => '1913', 'Parked' => 'Most of the day', 'Growing fast' => 'Electric cars'],
  'sections' => [
    ['A car for everyone', [
      'Early cars were handmade and expensive. In 1908 Ford introduced the Model T, and from 1913 built it on a moving assembly line, which cut the price so far that millions of families could buy one.',
      'Cars made it possible to live far from work and shops. Towns spread out into suburbs, with wide roads, highways and large parking lots.',
    ]],
    ['The hidden cost of parking', [
      'A private car sits parked for most of the day. The planner Donald Shoup showed how much land towns give to parking, and argued that free parking encourages more driving and makes everything else more spread out.',
    ]],
    ['Safer and cleaner', [
      'Seat belts are one of the most important safety inventions ever: they greatly reduce the risk of death in a crash. Today more and more cars are electric, which means no exhaust fumes in the street, though making electricity and batteries still has an environmental cost.',
    ]],
  ],
  'art' => 'This illustration shows a small red hatchback. The back view shows the trunk door that opens upward.',
  'look' => ['Compare the front and back views.', 'Where would a family put their shopping?'],
  'questions' => ['How would your town look if nobody owned a car?', 'What could a parking lot be used for instead?', 'Who can\'t drive, and how do they get around?'],
  'words' => ['Assembly line' => 'A factory system where a product moves past workers who each add one part.', 'Suburb' => 'A mainly residential area on the edge of a city.', 'Emissions' => 'Gases released, for example from an exhaust pipe.'],
  'sources' => ['brit-auto', 'shoup', 'nhtsa-belt', 'iea-ev'],
  'related' => ['suburban-house', 'streets-crosswalks', 'taxi'],
],
'taxi' => [
  'name' => 'Taxi', 'latin' => 'taxicab', 'src' => 'vehicle/car_2.png',
  'summary' => 'A car you hire for one trip. Taxis help people who don\'t own a car, and many cities paint them yellow.',
  'facts' => ['Name from' => 'Taximeter, which measures the fare', 'Famous color' => 'Yellow', 'Today' => 'Street taxis and ride-hailing apps', 'Accessible taxis' => 'Fit a wheelchair'],
  'sections' => [
    ['Where the name comes from', [
      'The word taxi comes from the taximeter, a device that measures the distance traveled and calculates the fare. Meters were invented in the 1890s, and motor taxis spread through cities in the early 1900s.',
    ]],
    ['Why yellow?', [
      'Yellow was made popular by the Yellow Cab Company, founded in Chicago in 1915, reportedly because yellow is easy to spot from a distance. New York City has required its licensed street taxis to be yellow since the late 1960s.',
    ]],
    ['Taxis for everyone', [
      'Taxis matter most to people who can\'t drive: children with a carer, older people, people with disabilities and visitors. Cities now require some taxis to carry wheelchairs, with ramps and space inside. Ride-hailing apps changed the business, letting people book and pay from a phone.',
    ]],
  ],
  'art' => 'This illustration shows a classic yellow taxi with a roof sign and a checkered stripe.',
  'look' => ['Find the sign on the roof. What is it for?', 'Look for the checkered stripe.'],
  'questions' => ['Who in your town most needs taxis?', 'Should taxis be required to carry wheelchairs?', 'How did apps change the way people book a ride?'],
  'words' => ['Fare' => 'The price of a trip.', 'Taximeter' => 'A device that calculates the fare.', 'Ride-hailing' => 'Booking a car ride with an app.'],
  'sources' => ['brit-taxi', 'nyc-tlc'],
  'related' => ['streets-crosswalks', 'family-car', 'office-building'],
],
'pickup-truck' => [
  'name' => 'Pickup truck', 'latin' => 'light truck', 'src' => 'vehicle/car_3.png',
  'summary' => 'A truck with an open cargo bed, used by builders, farmers and tradespeople to carry tools and materials.',
  'facts' => ['Cargo area' => 'An open bed at the back', 'Used by' => 'Builders, farmers, tradespeople', 'Popular in' => 'North America', 'Safety debate' => 'Tall fronts and blind zones'],
  'sections' => [
    ['A truck that works', [
      'A pickup truck has a cab for the driver and passengers and an open bed for cargo. Builders, farmers, plumbers and electricians use pickups to carry tools, materials and equipment to job sites, and many can tow a trailer.',
    ]],
    ['Bigger and bigger', [
      'In North America, pickup trucks are among the best-selling vehicles, and many people drive them as family cars. Over the years they have grown taller and heavier.',
      'Road safety researchers have found that vehicles with tall, flat fronts are more dangerous to people walking, and can make it hard for the driver to see a small child in front of the vehicle.',
    ]],
  ],
  'art' => 'This illustration shows a blue four-door pickup. The back view shows the open cargo bed and the tailgate.',
  'look' => ['Find the cargo bed in the back view.', 'Compare the height of the hood with the taxi.'],
  'questions' => ['What jobs really need a pickup truck?', 'Should streets have rules about vehicle size?', 'How could a vehicle be designed to protect people walking?'],
  'words' => ['Payload' => 'How much weight a vehicle can carry.', 'Tailgate' => 'The door at the back of the cargo bed.', 'Blind zone' => 'An area around a vehicle the driver can\'t see.'],
  'sources' => ['iihs'],
  'related' => ['building-materials', 'tower-crane', 'delivery-van'],
],
'delivery-van' => [
  'name' => 'Delivery van', 'latin' => 'last-mile delivery', 'src' => 'vehicle/car_4.png',
  'summary' => 'A van that brings parcels to the door. As online shopping grows, delivery vans fill more and more streets.',
  'facts' => ['Job' => 'The "last mile" to your door', 'Growing because of' => 'Online shopping', 'Cleaner options' => 'Electric vans, cargo bikes', 'Needs' => 'Places to stop and unload'],
  'sections' => [
    ['The last mile', [
      'A parcel may cross an ocean by ship and a country by truck, but the hardest part is the "last mile": the trip from a local depot to your door. It is often the most expensive part of delivery, with many stops, traffic and parking problems.',
    ]],
    ['Making delivery cleaner', [
      'The World Economic Forum has warned that without changes, growing online shopping will mean many more delivery vans, more traffic and more emissions in city centers. Solutions include electric vans, cargo bikes, parcel lockers where people collect deliveries, and loading zones so vans don\'t block lanes. The US Postal Service is replacing its old mail trucks with a new design, including many electric ones.',
    ]],
  ],
  'art' => 'This illustration shows a plain white van. The back view shows the large rear doors for loading.',
  'look' => ['Find the back doors. Why are they so big?', 'Why might so many vans be plain white?'],
  'questions' => ['How many deliveries come to your street in a week?', 'Would you walk to a parcel locker to reduce traffic?', 'Where can a van stop on your street without blocking anyone?'],
  'words' => ['Last mile' => 'The final step of a delivery, to the door.', 'Depot' => 'A place where parcels are sorted and vans are based.', 'Cargo bike' => 'A bicycle built to carry loads.'],
  'sources' => ['wef-lastmile', 'usps-ngdv'],
  'related' => ['warehouse', 'corner-store', 'streets-crosswalks'],
],
],

'elven' => [
'deer-sleigh' => [
  'name' => 'Deer sleigh', 'latin' => 'reindeer sleds', 'src' => 'vehicle/car_1.png',
  'summary' => 'An imagined sleigh drawn by deer. In the real Arctic, reindeer have pulled sleds for centuries.',
  'facts' => ['Imagined' => 'A flower-trimmed sleigh pulled by deer', 'Real' => 'Reindeer sleds in the Arctic', 'Why sleds' => 'Runners glide over snow', 'Reindeer' => 'The only widely domesticated deer'],
  'sections' => [
    ['The imagined sleigh', ELVEN_IMAGINE, [
      'In the elven world, deer pull a padded sleigh along forest paths, trimmed with flowers and lanterns. It needs no road, no fuel and no engine: just trained animals and a light vehicle.',
    ]],
    ['Real reindeer sleds', ELVEN_REAL, [
      'Reindeer are the only deer that have been widely domesticated. For centuries, Arctic peoples such as the Sámi of northern Norway, Sweden, Finland and Russia have herded reindeer for meat, milk and hides, and trained them to pull sleds over snow.',
      'Sleds work because their smooth runners slide easily over snow and ice, so even a heavy load can be pulled with little effort. On soft snow, a sled goes where a wheeled cart would sink.',
    ]],
    ['Animal power today', ELVEN_NEXT, [
      'Snowmobiles have replaced many reindeer sleds, but they are noisy and burn fuel. Some herders and tourism businesses still use reindeer, and people are testing electric snowmobiles for quieter travel in the wild.',
    ]],
  ],
  'art' => 'This illustration shows a deer with antlers pulling a sleigh decorated with flowers. It is imagined: a sleigh in the forest would need snow.',
  'look' => ['Find the lantern on the sleigh.', 'Compare the sleigh with the cart. What is different about how they touch the ground?'],
  'questions' => ['When is a sled better than a wheel?', 'What would it take to care for working animals well?', 'Which is better for a quiet forest: animals or electric vehicles?'],
  'words' => ['Runner' => 'The smooth strip a sled slides on.', 'Domesticated' => 'Tamed and bred by people over many generations.', 'Herder' => 'A person who looks after a herd of animals.'],
  'sources' => ['brit-sami'],
  'related' => ['stag-monument', 'wild-grove', 'flower-cart'],
],
'flower-cart' => [
  'name' => 'Flower cart', 'latin' => 'working horses', 'src' => 'vehicle/car_2.png',
  'summary' => 'An imagined pony cart full of flowers. Real horses still work in some forests, where they do less damage than machines.',
  'facts' => ['Imagined' => 'A pony cart carrying flowers to market', 'Real' => 'Horse logging in woodland', 'Why horses' => 'Lighter on soil than big machines', 'Clean city version' => 'Cargo bikes'],
  'sections' => [
    ['The imagined cart', ELVEN_IMAGINE, [
      'A white pony pulls a cart overflowing with lavender and wildflowers to the elven market. The cart is light, with big wheels for soft paths.',
    ]],
    ['Real working horses', ELVEN_REAL, [
      'In some woodlands, horses are still used to drag felled trees out of the forest. This is called horse logging. Heavy machines can squash the soil and damage roots and young trees, while a horse can pick its way between trees on narrow paths. Forestry organizations in Britain and elsewhere use horses in sensitive woods.',
    ]],
    ['Light vehicles in towns', ELVEN_NEXT, [
      'In cities, the closest thing to a pony cart today may be the cargo bike: a bicycle, often electric, with a box for children, shopping or deliveries. They take up little space and make no exhaust.',
    ]],
  ],
  'art' => 'This illustration shows a white pony pulling a wooden cart full of flowers, with leaf decorations on the wheels.',
  'look' => ['Find the purple flowers in the cart.', 'Look at the size of the wheels.'],
  'questions' => ['Why might a horse be better than a machine in a forest?', 'Could cargo bikes replace some vans in your town?', 'What does a working animal need to be healthy and safe?'],
  'words' => ['Horse logging' => 'Using horses to move felled trees.', 'Soil compaction' => 'Squashing soil so roots and water can\'t get through.', 'Cargo bike' => 'A bicycle built to carry loads.'],
  'sources' => ['horse-log'],
  'related' => ['market-hall', 'flower-meadow', 'canopy-market'],
],
'mushroom-carriage' => [
  'name' => 'Mushroom carriage', 'latin' => 'vehicles made from plants', 'src' => 'vehicle/car_3.png',
  'summary' => 'An imagined toadstool carriage. Real carmakers already use plant fibers, and in 1941 Ford showed a car with plant-based body panels.',
  'facts' => ['Imagined' => 'A carriage shaped like a toadstool', 'Real (1941)' => 'Ford\'s "soybean car"', 'Real today' => 'Flax, hemp and kenaf in car parts', 'Being researched' => 'Mycelium materials'],
  'sections' => [
    ['The imagined carriage', ELVEN_IMAGINE, [
      'A small deer pulls a carriage with a red-and-white toadstool roof and glowing windows. Elves imagine growing vehicles rather than building them.',
    ]],
    ['Real cars made from plants', ELVEN_REAL, [
      'In 1941 Henry Ford showed a car whose body panels were made from a plastic that used soybeans and other plant fibers. It never went into production, but the idea lasted.',
      'Today many cars contain natural fibers such as flax, hemp and kenaf inside door panels and other parts. They are light, which saves energy, and they come from plants that can be grown again.',
    ]],
    ['Grown materials', ELVEN_NEXT, [
      'Researchers are testing materials grown from mycelium, the root-like threads of fungi, for packaging, insulation and leather-like fabrics. Growing whole vehicles is still science fiction.',
    ]],
  ],
  'art' => 'This illustration shows a carriage shaped like a toadstool with a red, spotted roof, pulled by a small deer.',
  'look' => ['Find the spots on the roof.', 'Look for the glowing windows.'],
  'questions' => ['Which parts of a car could be made from plants?', 'What would happen to a plant-based car at the end of its life?', 'Is a lighter car always better?'],
  'words' => ['Natural fiber' => 'A fiber from a plant or animal, such as flax or wool.', 'Composite' => 'A material made of two or more materials combined.', 'Mycelium' => 'The root-like threads of fungi.'],
  'sources' => ['henryford', 'natfiber', 'mycelium'],
  'related' => ['mushroom-cottage', 'building-materials', 'woodworking-workshop'],
],
'beetle-rider' => [
  'name' => 'Beetle rider', 'latin' => 'insect-inspired machines', 'src' => 'vehicle/car_4.png',
  'summary' => 'An imagined giant beetle carrying a rider. Real beetles inspire scientists who build walking robots.',
  'facts' => ['Imagined' => 'A giant beetle as a mount', 'Real' => 'Beetles that steer by the stars', 'Real today' => 'Legged robots', 'Why legs' => 'They go where wheels can\'t'],
  'sections' => [
    ['The imagined beetle', ELVEN_IMAGINE, [
      'An elf rides a beetle the size of a pony, with shining green wings. It walks over roots and rocks where no cart could go, and leaves no road behind.',
    ]],
    ['Real beetle skills', ELVEN_REAL, [
      'Beetles are amazing engineers. In 2013, scientists showed that dung beetles roll their balls in straight lines at night by using the glow of the Milky Way to steer.',
      'Real insects could never grow to the size of a pony: their way of breathing and their outer skeleton only work at a small size. But their designs inspire engineers.',
    ]],
    ['Walking machines', ELVEN_NEXT, [
      'Engineers build robots with four or six legs that can climb stairs, cross rubble and walk over rough ground. Such robots are already used to inspect industrial sites. In the future, walking machines might work in forests or on other planets without needing roads.',
    ]],
  ],
  'art' => 'This illustration shows an elf riding a large beetle with shining green-blue wing cases. It is completely imagined.',
  'look' => ['Count the beetle\'s legs.', 'Find the leaves woven into the saddle.'],
  'questions' => ['Why can\'t real insects grow as big as a pony?', 'Where would a walking machine be more useful than a wheeled one?', 'What other animals could inspire a new kind of vehicle?'],
  'words' => ['Exoskeleton' => 'A hard outer skeleton, like a beetle\'s.', 'Biomimicry' => 'Design that copies ideas from nature.', 'Legged robot' => 'A robot that walks instead of rolling.'],
  'sources' => ['dacke', 'legged', 'asknature'],
  'related' => ['flower-meadow', 'wild-grove', 'deer-sleigh'],
],
],

'future' => [
'hover-car' => [
  'name' => 'Hover car', 'latin' => 'magnetic levitation', 'src' => 'vehicle/car_1.png',
  'summary' => 'A car that floats above the road. Real maglev trains already float on magnets at over 400 km/h.',
  'facts' => ['Real today' => 'Maglev trains', 'Fastest test' => '603 km/h, Japan, 2015', 'In service since' => '2004, Shanghai', 'Older idea' => 'Hovercraft, 1950s'],
  'sections' => [
    ['Floating on magnets', FUT_REAL, [
      'Maglev is short for magnetic levitation. Powerful magnets lift a train a few centimeters above its guideway and push it forward. With no wheels touching a rail, there is less friction and noise.',
      'The Shanghai Maglev has carried passengers to the city\'s airport since 2004, reaching about 430 km/h. In 2015 a Japanese test maglev reached 603 km/h, a world record for a train.',
    ]],
    ['Floating on air', FUT_REAL, [
      'In the 1950s the British engineer Christopher Cockerell developed the hovercraft, which floats on a cushion of air pushed down by fans. Hovercraft can cross water, mud and ice.',
    ]],
    ['Hovering on the Moon and Mars', FUT_WOULD, [
      'A hovercraft could not work on the Moon, because there is no air to push against. A hover car there would need a magnetic track, which would be costly to build. For now, wheels are the practical choice off Earth.',
    ]],
  ],
  'art' => 'This illustration shows a sleek white and red car with glowing blue pads instead of wheels.',
  'look' => ['Find the glowing pads underneath.', 'Compare it with the modern family car.'],
  'questions' => ['Why does a maglev train need a special track?', 'Why couldn\'t a hovercraft work on the Moon?', 'Would floating cars make streets safer or more dangerous?'],
  'words' => ['Levitation' => 'Floating in the air without support.', 'Friction' => 'The force that slows things that rub together.', 'Guideway' => 'The track a maglev train floats along.'],
  'sources' => ['maglev', 'cockerell'],
  'related' => ['spaceport', 'rover-track', 'cargo-pod'],
],
'pressurized-rover' => [
  'name' => 'Pressurized rover', 'latin' => 'mobile habitat', 'src' => 'vehicle/car_2.png',
  'summary' => 'A rugged rover with air inside, so astronauts can drive for days across the Moon without wearing spacesuits.',
  'facts' => ['Apollo rover' => 'Open-top, 1971-1972', 'Planned' => 'Japanese pressurized rover for Artemis', 'Inside' => 'Air, beds, food, toilet', 'Big challenge' => 'Dust and rough ground'],
  'sections' => [
    ['From open rovers to mobile homes', FUT_REAL, [
      'The Apollo Lunar Roving Vehicle was an open, folding electric car. Astronauts had to wear their spacesuits the whole time, so trips lasted only hours.',
      'For longer journeys, space agencies are designing pressurized rovers: closed vehicles with air inside, like small motor homes. In 2024 Japan agreed to provide a pressurized rover for NASA\'s Artemis program, for astronauts to live and work in for weeks. NASA has also tested a rover concept called the Space Exploration Vehicle.',
    ]],
    ['How it would work', FUT_WOULD, [
      'Inside, two astronauts would drive, sleep and eat in normal clothes. To go outside, they would climb into spacesuits attached to the back of the rover through suitports, keeping dust out of the cabin. Big wheels, strong suspension and a radiation shelter would help on long trips.',
    ]],
  ],
  'art' => 'This illustration shows a chunky white and red rover with big wheels and a front cabin with windows.',
  'look' => ['Look at the wheels. Why are they so big?', 'Find the windows of the driver\'s cabin.'],
  'questions' => ['What would you pack for a two-week rover trip on the Moon?', 'Why keep spacesuits outside the cabin?', 'What should happen if the rover breaks down far from base?'],
  'words' => ['Pressurized' => 'Holding air at a pressure people can breathe.', 'Suitport' => 'A hatch where a spacesuit is attached to the outside of a vehicle.', 'Suspension' => 'Springs that smooth out bumps.'],
  'sources' => ['nasa-lrv', 'jaxa-rover', 'nasa-sev', 'nasa-dust'],
  'related' => ['rover-track', 'airlock-hangar', 'lunar-base'],
],
'cargo-pod' => [
  'name' => 'Cargo pod', 'latin' => 'autonomous transport', 'src' => 'vehicle/car_3.png',
  'summary' => 'A self-driving cargo carrier. On Earth, giant trucks in some mines already drive themselves.',
  'facts' => ['Driver' => 'None: a computer drives', 'Real today' => 'Self-driving mine trucks', 'Moon deliveries' => 'Robotic landers (CLPS)', 'Why' => 'Moving supplies without risking crews'],
  'sections' => [
    ['Self-driving trucks today', FUT_REAL, [
      'In the iron ore mines of Western Australia, huge haul trucks have been driven by computers for years, following set routes and watched over from a control center far away. Mines are good places for self-driving vehicles because the routes are fixed and the public is kept out.',
      'NASA also pays companies to land robotic spacecraft on the Moon carrying science instruments and cargo, through its Commercial Lunar Payload Services program.',
    ]],
    ['Robot haulers off Earth', FUT_WOULD, [
      'On the Moon or Mars, robot cargo pods could carry ice from mines, oxygen tanks, spare parts and building materials between the landing pad and the base, day and night, without putting people at risk. Crews would step in only when something went wrong.',
    ]],
  ],
  'art' => 'This illustration shows a boxy white and red cargo vehicle with glowing blue pads underneath.',
  'look' => ['Is there a driver\'s seat?', 'Find the cargo doors in the back view.'],
  'questions' => ['Which jobs should robot vehicles do, and which should people do?', 'Who is responsible if a self-driving vehicle crashes?', 'Why are mines a good place to test self-driving trucks?'],
  'words' => ['Autonomous' => 'Able to work without a person in control.', 'Haul truck' => 'A huge truck for moving rock in a mine.', 'Payload' => 'The cargo a vehicle carries.'],
  'sources' => ['autohaul', 'nasa-clps', 'nasa-isru'],
  'related' => ['ice-mine', 'robot-helpers', 'operations-center'],
],
'drone-taxi' => [
  'name' => 'Drone taxi', 'latin' => 'rotorcraft', 'src' => 'vehicle/car_4.png',
  'summary' => 'A flying vehicle with four rotors. A small helicopter has already flown on Mars, and a drone will fly on Saturn\'s moon Titan.',
  'facts' => ['First flight on Mars' => 'Ingenuity, April 19, 2021', 'Ingenuity flights' => '72', 'Next' => 'Dragonfly, to Titan', 'On Earth' => 'Electric air taxis being tested'],
  'sections' => [
    ['Flying on Mars', FUT_REAL, [
      'On April 19, 2021, NASA\'s Ingenuity helicopter made the first powered, controlled flight on another planet. Mars\'s air is about 1% as thick as Earth\'s, so Ingenuity\'s blades had to spin very fast to lift it. Planned for five test flights, it made 72 before a damaged blade ended its mission in 2024.',
      'NASA\'s Dragonfly mission will send a car-sized drone with eight rotors to Titan, Saturn\'s largest moon, which has thick air and low gravity, ideal for flying.',
    ]],
    ['Air taxis on Earth', FUT_REAL, [
      'Several companies are testing electric aircraft that take off and land straight up, like big drones, as air taxis for short trips across cities. Noise, safety, batteries and where to land are the big questions.',
    ]],
    ['Flying around a settlement', FUT_WOULD, [
      'On Mars, drones could scout routes for rovers, carry small parcels or inspect equipment. Carrying people would need much bigger and more powerful machines, and the Moon, with no air at all, would need rockets instead of rotors.',
    ]],
  ],
  'art' => 'This illustration shows a white and red craft with four ring-shaped rotors and a small cabin.',
  'look' => ['Count the rotors.', 'Find the antenna on top.'],
  'questions' => ['Why do helicopter blades need to spin faster on Mars?', 'Would you ride in a drone taxi? Why or why not?', 'What rules should flying vehicles follow over a city?'],
  'words' => ['Rotor' => 'A set of spinning blades that lifts an aircraft.', 'Atmosphere' => 'The layer of gas around a planet or moon.', 'Rotorcraft' => 'An aircraft lifted by rotors, such as a helicopter or drone.'],
  'sources' => ['ingenuity', 'dragonfly'],
  'related' => ['spaceport', 'robot-helpers', 'launch-pad'],
],
],
];

// Add the vehicles to each world: a new category, the pages and their sources.
foreach ($VEHICLES as $w => $list) {
  $WORLD_DATA[$w]['cats']['vehicles'] = VEHICLE_CAT;
  $WORLD_DATA[$w]['sources'] += $VEHICLE_SOURCES[$w];
  foreach ($list as $slug => $r) {
    if (isset($WORLD_DATA[$w]['pages'][$slug])) fwrite(STDERR, "vehicle slug clashes with a page: $w/$slug\n");
    $WORLD_DATA[$w]['pages'][$slug] = $r + ['cat' => 'vehicles', 'vehicle' => true];
  }
}
