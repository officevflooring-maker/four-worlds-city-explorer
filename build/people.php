<?php
// People of each world, from the supplied people art (people-batch-03): one pose cut from each walk strip.
// Images: public/assets/worlds/{world}/{people-1..6,worker-1..2}-{256,512}.webp, copied by
// tools/copy-people-vehicles.sh. Each world gets a page at /worlds/{world}/people/.
// Each person: [name, short role, text, building pages where you might meet them].

$PEOPLE_INTRO = [
  'roman'  => ['People of Ancient Rome', 'Who lived and worked in a Roman city? At its height Rome may have had around a million people, from senators to enslaved workers. Their clothes often showed who they were.', 'history'],
  'modern' => ['People of the Modern Town', 'A town has to work for everyone: children walking to school, runners, older people, dog walkers and workers. Each person uses the same streets in a different way.', 'real'],
  'elven'  => ['People of the Elven World', 'The elves are imagined. Their roles, though, are real ones every community needs: elders, gardeners, makers, keepers of knowledge and protectors.', 'imagined'],
  'future' => ['People and robots of the Future', 'An imagined Moon and Mars settlement. Every person has an important job, and robots do the dull, dirty and dangerous work. The jobs are based on real space careers.', 'speculative'],
];

$PEOPLE = [
'roman' => [
  'people-1' => ['Roman woman', 'Citizen in a stola', 'A married Roman woman wore a long dress called a stola, often with a shawl called a palla over her head and shoulders when she went out. Women could own property and run businesses, but could not vote or hold office.', ['domus', 'temple-of-vesta', 'public-baths']],
  'people-2' => ['Senator', 'Lawmaker in a toga', 'Only Roman citizens could wear the toga, a big piece of wool wrapped around the body. Senators had a broad purple stripe on their tunic. They met in the Curia to debate and advise.', ['curia', 'forum', 'basilica']],
  'people-3' => ['Roman boy', 'Child in a tunic', 'Children wore simple tunics. Boys from families who could pay went to a teacher from about age seven to learn reading, writing and arithmetic; many children worked instead.', ['school', 'apartment-block', 'circus']],
  'people-4' => ['Merchant', 'Trader carrying amphorae', 'Merchants bought and sold goods such as olive oil, wine and grain, which arrived by ship and were stored in warehouses. Trade linked Rome with the whole Mediterranean.', ['warehouse', 'shop', 'donkey-cart']],
  'people-5' => ['Girl going to market', 'Shopper with a basket', 'Most Romans in the city lived in apartments without kitchens, so they bought food every day from shops, markets and snack bars, and fetched water from public fountains.', ['street-food', 'public-fountain', 'shop']],
  'people-6' => ['Legionary', 'Soldier with a shield', 'Legionaries were professional soldiers who served for about 25 years. As well as fighting, they built roads, bridges, forts and walls.', ['city-walls', 'triumphal-arch', 'victory-column']],
  'worker-1' => ['Stone carrier', 'Builder at work', 'Huge building projects needed thousands of workers, both free laborers and enslaved people. They quarried, carried and lifted stone, with cranes for the heaviest blocks.', ['crane', 'building-materials', 'amphitheater']],
  'worker-2' => ['Carpenter', 'Worker carrying timber', 'Carpenters made roofs, scaffolding, cranes and the wooden molds used to shape concrete arches and domes.', ['crane', 'pantheon', 'aqueduct']],
],
'modern' => [
  'people-1' => ['Neighbor out walking', 'Walking to the shops', 'Walking is the oldest way to get around, and every trip starts and ends on foot. Wide sidewalks, shade trees and short crossings make walking easier and safer.', ['streets-crosswalks', 'mixed-use-building', 'corner-store']],
  'people-2' => ['Office worker', 'Commuting with a briefcase', 'Many people travel into the center each day for work. How they get there, by car, bus, train, bike or on foot, shapes traffic and air quality.', ['office-building', 'skyscraper', 'taxi']],
  'people-3' => ['Teen with a backpack', 'On the way to school', 'Children and teens can\'t drive, so they depend on safe walking and cycling routes, buses and nearby schools, parks and libraries.', ['school', 'public-library', 'recreation-center']],
  'people-4' => ['Runner', 'Out for exercise', 'Parks, paths and sports fields make it easy for people to stay active close to home.', ['park-pond', 'sports-field', 'recreation-center']],
  'people-5' => ['Older neighbor', 'Walking with a cane', 'Benches, curb ramps, even sidewalks and long enough crossing times help older people stay independent. Good design for them helps everyone.', ['health-clinic', 'community-center', 'streets-crosswalks']],
  'people-6' => ['Dog walker', 'Walking the dog', 'Dog walkers are out in every season and often know the neighborhood best. Parks and green spaces matter to them and their dogs.', ['park-pond', 'community-garden', 'playground']],
  'worker-1' => ['Construction worker', 'Carrying supplies', 'Builders wear hard hats and high-visibility vests to stay safe on site.', ['tower-crane', 'building-materials', 'pickup-truck']],
  'worker-2' => ['Carpenter', 'Carrying lumber', 'Carpenters frame houses, build stairs and fit doors and windows.', ['single-family-house', 'building-materials', 'warehouse']],
],
'elven' => [
  'people-1' => ['Elder', 'Keeper of memory', 'Elders remember how the forest has changed over many years. In the real world, long-term observations, such as records of when blossoms open, help scientists track climate change.', ['weather-tower', 'council-terrace', 'tree-library']],
  'people-2' => ['Forest ranger', 'Watcher of the woods', 'Rangers know every path and animal. Real rangers protect wildlife, guide visitors and help prevent wildfires.', ['wild-grove', 'stag-monument', 'canopy-walkway']],
  'people-3' => ['Young elf', 'Learning outdoors', 'Young elves learn in the forest itself. Real forest schools teach children outdoors in all weather.', ['treehouse-school', 'flower-meadow', 'forest-gym']],
  'people-4' => ['Crystal keeper', 'Scholar with a glowing staff', 'In this imagined world, crystals glow with light. Real scientists are studying plants and fungi that glow, and how to store energy from the sun.', ['crystal-tower', 'domed-observatory', 'tree-library']],
  'people-5' => ['Gardener', 'Watering the plants', 'Gardeners keep the city green and fed. Real community gardeners grow food, compost waste and support bees.', ['garden-court', 'flower-meadow', 'market-hall']],
  'people-6' => ['Guardian', 'Protector with a leaf shield', 'Guardians protect the forest and its people. Every community needs people who keep others safe.', ['elven-palace', 'council-terrace', 'deer-statue']],
  'worker-1' => ['Woodworker', 'Carrying a bundle of wood', 'Woodworkers use fallen and carefully chosen timber, and repair things instead of throwing them away.', ['woodworking-workshop', 'timber-house', 'living-crane']],
  'worker-2' => ['Crystal gatherer', 'Carrying glowing crystals', 'An imagined job. In the real world, miners and recyclers recover the metals and minerals that technology depends on.', ['crystal-fountain', 'crystal-waterfall', 'market-hall']],
],
'future' => [
  'people-1' => ['Settler', 'In a light pressure suit', 'Settlers would need suits whenever they went outside. Real spacesuits provide air, pressure, warmth and protection from dust and radiation.', ['airlock-hangar', 'habitat-cluster', 'lunar-base']],
  'people-2' => ['Engineer', 'In an orange flight suit', 'Engineers would keep life support, power and machines running. Astronauts spend a lot of their time on maintenance and repairs.', ['water-recycler', 'power-tower', 'fab-shop']],
  'people-3' => ['Pilot', 'With a visor and flight gear', 'Pilots and rover drivers would move people and cargo safely between landing pads, bases and work sites.', ['spaceport', 'pressurized-rover', 'launch-pad']],
  'people-4' => ['Security robot', 'Armored helper', 'An imagined robot in protective armor. Real robots are mostly used for inspection and dangerous jobs, and people decide what robots are allowed to do.', ['operations-center', 'robot-helpers', 'civic-dome']],
  'people-5' => ['Doctor', 'Scientist in a lab coat', 'Far from Earth, the crew must handle medical problems themselves, with help from doctors on Earth by video and ultrasound guidance.', ['medical-bay', 'science-lab', 'gravity-gym']],
  'people-6' => ['Helper robot', 'Round assistant', 'Small robots like the Astrobee free-flyers on the space station take inventory, film experiments and save astronauts\' time.', ['robot-helpers', 'telepresence', 'habitat-cluster']],
  'worker-1' => ['Cargo robot', 'Carrying a container', 'Robots that lift and carry would move supplies, ice and parts around the base.', ['robotics-factory', 'ice-mine', 'cargo-pod']],
  'worker-2' => ['Cart robot', 'Pushing a supply cart', 'Robots that push carts would move heavy equipment so people don\'t have to.', ['robotic-crane', 'fab-shop', 'building-materials']],
],
];
