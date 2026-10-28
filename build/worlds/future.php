<?php
// Robotic Future: one page per building, imagined as part of a settlement on the Moon or Mars.
// Each page explains how the building could work, the real technology that exists today (marked
// "Real world"), and what is still speculative (marked "Possible future"). Sources are plain text.

$FUTURE_SOURCES = [
  'nasa-eclss'   => 'NASA, "Environmental Control and Life Support System" and the 2023 announcement of 98% water recovery on the International Space Station',
  'nasa-moxie'   => 'NASA Jet Propulsion Laboratory, MOXIE (Mars Oxygen In-Situ Resource Utilization Experiment) results, 2021-2023',
  'nasa-isru'    => 'NASA, "In-Situ Resource Utilization" (using local resources on the Moon and Mars)',
  'nasa-fsp'     => 'NASA and US Department of Energy, Kilopower/KRUSTY test (2018) and the Fission Surface Power project',
  'nasa-veggie'  => 'NASA, "Veggie" plant growth system on the International Space Station',
  'nasa-chapea'  => 'NASA, Crew Health and Performance Exploration Analog (CHAPEA) and the Mars Dune Alpha habitat',
  'nasa-3dp'     => 'NASA Centennial Challenges, "3D-Printed Habitat Challenge" (2015-2019)',
  'nasa-beam'    => 'NASA, Bigelow Expandable Activity Module (BEAM) on the International Space Station (2016)',
  'nasa-artemis' => 'NASA, Artemis program overview, including Gateway and plans for a lunar base camp',
  'nasa-ice'     => 'NASA, LCROSS mission (2009) and studies of water ice in permanently shadowed lunar craters',
  'nasa-dsn'     => 'NASA, "Deep Space Network" and Mars relay orbiters',
  'nasa-ultra'   => 'NASA, "Advanced Diagnostic Ultrasound in Microgravity" (ADUM) experiment on the International Space Station',
  'nasa-holo'    => 'NASA, first "holoportation" of a doctor to the International Space Station (2021)',
  'nasa-hrp'     => 'NASA Human Research Program, hazards of human spaceflight (radiation, isolation, distance, gravity, hostile environments)',
  'nasa-exercise'=> 'NASA, exercise on the International Space Station (treadmill, cycle and ARED)',
  'nasa-dust'    => 'NASA, studies of lunar dust from the Apollo missions',
  'nasa-robots'  => 'NASA and Canadian Space Agency, Canadarm2, Robonaut 2 and Astrobee robots',
  'nasa-ingenuity' => 'NASA Jet Propulsion Laboratory, Perseverance rover and Ingenuity Mars Helicopter (first powered flight on another planet, 2021)',
  'nasa-pp'      => 'NASA Office of Planetary Protection and the COSPAR planetary protection policy',
  'nasa-mcc'     => 'NASA, history of Mission Control at Johnson Space Center, Houston',
  'nasa-lrv'     => 'NASA, Apollo Lunar Roving Vehicle and the Artemis Lunar Terrain Vehicle',
  'nasa-sls'     => 'NASA Kennedy Space Center, Launch Complex 39 history and sound suppression systems',
  'noaa-swpc'    => 'NOAA Space Weather Prediction Center, space weather and the 1859 Carrington Event',
  'esa-melissa'  => 'European Space Agency, MELiSSA (Micro-Ecological Life Support System Alternative) project',
  'esa-moon'     => 'European Space Agency, research on building with lunar regolith',
  'b2'           => 'University of Arizona, history of Biosphere 2 (first closed mission 1991-1993)',
  'mars500'      => 'European Space Agency and Institute of Biomedical Problems, Mars-500 isolation study (2010-2011)',
  'ost'          => 'United Nations Office for Outer Space Affairs, "Outer Space Treaty" (1967)',
  'accords'      => 'NASA, "The Artemis Accords" (2020) and list of signatories',
  'cn-change4'   => 'China National Space Administration, Chang\'e 4 far-side landing (2019) and Queqiao relay satellite',
  'iss-3dp'      => 'NASA and Made In Space, first 3D printer on the International Space Station (2014)',
  'elevator'     => 'Research and review articles on the space elevator concept and the strength of carbon nanotube materials',
  'artgrav'      => 'NASA and research reviews on artificial gravity and rotating spacecraft',
  'falcon'       => 'SpaceX, first landing of an orbital-class rocket booster (December 2015) and reuse of boosters',
];

$FUTURE_CATEGORIES = [
  'live'    => ['Homes beyond Earth', 'How people could live safely where there is no air, little gravity and harsh radiation.'],
  'support' => ['Air, water and food', 'Life support: making, recycling and growing everything people need to stay alive.'],
  'power'   => ['Power, factories and building', 'Energy, robots and local materials to build and run a settlement.'],
  'health'  => ['Health and community', 'Keeping bodies strong, minds healthy and decisions fair, far from home.'],
  'science' => ['Science and communication', 'Studying new worlds and staying in touch across millions of kilometers.'],
  'travel'  => ['Travel and operations', 'Getting there, moving around and keeping everything running.'],
];

const FUT_WOULD = ['tag' => 'speculative'];
const FUT_REAL = ['tag' => 'real'];

$FUTURE = [

// ---------------- Homes beyond Earth ----------------
'inflatable-habitat' => [
  'name' => 'Pod home', 'latin' => 'expandable habitat', 'cat' => 'live', 'src' => 'art/family_1.png',
  'summary' => 'A compact home that could be launched folded up and inflated on arrival, giving astronauts much more space for its weight.',
  'facts' => ['Purpose' => 'A home for a small crew', 'Real test' => 'BEAM module on the ISS (2016)', 'Made of' => 'Layers of tough fabric', 'Main challenge' => 'Protection from radiation and impacts'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'Rockets can only carry objects of a certain size. An expandable habitat is packed tightly for launch, then filled with air at its destination, swelling into a roomy home. Inside, the crew would sleep, eat, work and relax, with plants and a small garden near the entrance.',
    ]],
    ['Technology we already have', FUT_REAL, [
      'In 2016, an expandable module called BEAM (Bigelow Expandable Activity Module) was attached to the International Space Station and inflated. It was designed as a two-year test, but it performed so well that NASA kept it attached for years as a storage room. Its walls are made of many layers of strong fabrics, such as Kevlar-like materials, that protect against small space debris and keep air in.',
    ]],
    ['Building and maintaining it', FUT_WOULD, [], ['list' => [
      'Land the folded habitat with a robotic lander.',
      'Inflate it slowly, checking for leaks.',
      'Cover it with a thick layer of local soil (regolith) to block radiation and small meteorites.',
      'Connect it to power, life support and an airlock.',
      'Inspect the walls regularly for wear and repair any leaks.',
    ]]],
  ],
  'art' => 'This illustration shows a rounded pod home with glowing windows and plants by the door.',
  'look' => ['Find the round door and windows.', 'What could the pipes on the roof be for?'],
  'questions' => ['Would you trade space for convenience?', 'Why might a fabric wall be safer than it sounds?', 'What would you need in a home with no way to pop outside?'],
  'words' => ['Expandable habitat' => 'A home that is launched folded and inflated later.', 'Regolith' => 'The loose, dusty soil on the Moon or Mars.', 'Micrometeoroid' => 'A tiny, fast-moving piece of space rock.'],
  'sources' => ['nasa-beam', 'nasa-hrp'],
  'related' => ['lunar-base', 'printed-habitat', 'airlock-hangar'],
],

'lunar-base' => [
  'name' => 'Moon base home', 'latin' => 'surface habitat', 'cat' => 'live', 'src' => 'art/family_2.png',
  'summary' => 'Linked domes where a crew could live on the Moon, shielded from radiation and connected by pressurized tunnels.',
  'facts' => ['Purpose' => 'Long stays on the Moon', 'Likely place' => 'Near the lunar south pole', 'Biggest dangers' => 'Radiation, dust, extreme cold and heat', 'Status' => 'Being planned under Artemis'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'A Moon base would be made of several connected modules: sleeping quarters, a kitchen, labs, a gym and storage. If one module sprang a leak, hatches could seal it off, keeping the rest safe. Most of the base would be covered with meters of lunar soil to block radiation.',
    ]],
    ['Why the south pole?', FUT_REAL, [
      'The Moon turns slowly: a full day-and-night cycle lasts about a month, so most places have about two weeks of sunlight followed by two weeks of freezing darkness. Near the poles, some mountain peaks are lit almost all the time, which is good for solar power, while nearby craters stay permanently shadowed and may hold water ice. NASA\'s Artemis program is focusing on the south polar region for this reason.',
    ]],
    ['The challenges', FUT_REAL, [], ['list' => [
      'Radiation: the Moon has no magnetic field or thick atmosphere to block cosmic rays and solar storms.',
      'Temperature: surfaces in sunlight become hotter than boiling water, while shadows plunge far below freezing.',
      'Dust: lunar dust is sharp and clingy, scratching seals and irritating lungs.',
      'Distance: help is days away, so the base must be largely self-sufficient.',
    ]]],
  ],
  'art' => 'This illustration shows several domes joined together with glowing windows and plants. Its design is imagined.',
  'look' => ['Count the domes and find the links between them.', 'Where is the main entrance?'],
  'questions' => ['Why might it be safer to build several small modules than one big one?', 'How would you spend two weeks of darkness on the Moon?', 'What would you miss most about Earth?'],
  'words' => ['Module' => 'One section of a larger structure.', 'Pressurized' => 'Filled with air at a pressure people can breathe.', 'Permanently shadowed crater' => 'A crater where sunlight never reaches the floor.'],
  'sources' => ['nasa-artemis', 'nasa-hrp', 'nasa-ice'],
  'related' => ['habitat-cluster', 'storm-shelter', 'ice-mine'],
],

'habitat-cluster' => [
  'name' => 'Life support dome', 'latin' => 'ECLSS', 'cat' => 'support', 'src' => 'art/family_3.png',
  'summary' => 'The machinery that keeps air breathable, removes carbon dioxide and controls temperature: the beating heart of any space home.',
  'facts' => ['Purpose' => 'Clean air, water and comfortable temperature', 'Real system' => 'ECLSS on the International Space Station', 'Oxygen from' => 'Splitting water with electricity', 'Rule' => 'Always have a backup'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'Every breath a person takes uses oxygen and adds carbon dioxide. In a sealed home, both must be managed all the time. A life support dome would hold the machines that make oxygen, scrub carbon dioxide, filter dust and germs, control humidity and keep the temperature steady.',
    ]],
    ['How the space station does it today', FUT_REAL, [
      'On the International Space Station, the Environmental Control and Life Support System (ECLSS) makes oxygen by splitting water into hydrogen and oxygen using electricity, a process called electrolysis. Carbon dioxide is removed by special materials that absorb it, and some of it is combined with the leftover hydrogen to make water again.',
      'Fans keep air moving, because in weightlessness warm air does not rise and carbon dioxide can build up around a sleeping astronaut\'s face.',
    ]],
    ['Maintaining it', FUT_WOULD, [
      'Life support must never fail, so critical parts are doubled or tripled. Crews carry spare parts, track every filter, and practice emergencies such as fires, leaks and toxic spills. On Mars, where resupply could take many months, crews would need to repair almost anything themselves.',
    ]],
  ],
  'art' => 'This illustration shows a cluster of linked domes with glowing windows and pipes. Here we imagine it as the settlement\'s life support center.',
  'look' => ['Follow the pipes between the domes.', 'Which dome would you put the backup machines in?'],
  'questions' => ['Sealed homes control air and temperature. What might residents miss?', 'Why is it important to have backups for life support?', 'How is the air in your classroom kept fresh?'],
  'words' => ['Life support' => 'Systems that keep people alive in a hostile place.', 'Electrolysis' => 'Splitting a substance using electricity.', 'Redundancy' => 'Having spare systems in case one fails.'],
  'sources' => ['nasa-eclss', 'nasa-hrp'],
  'related' => ['water-recycler', 'oxygen-factory', 'lunar-base'],
],

'printed-habitat' => [
  'name' => 'Printed shelter', 'latin' => '3D-printed habitat', 'cat' => 'live', 'src' => 'art/home_b.png',
  'summary' => 'A dome-shaped home built by robots that 3D print walls from local soil, so heavy materials do not have to be launched from Earth.',
  'facts' => ['Purpose' => 'Strong, shielded homes from local materials', 'Real tests' => 'NASA 3D-Printed Habitat Challenge (2015-2019)', 'Earth test home' => 'Mars Dune Alpha, Houston', 'Status' => 'Tested on Earth'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'Robots would arrive before people. They would scoop up regolith, mix it with a binder, and print thick, curved walls layer by layer, like a giant 3D printer squeezing out icing. Domes and arches are strong shapes for holding back air pressure and carrying the weight of protective soil.',
    ]],
    ['Technology we already have', FUT_REAL, [
      'NASA ran a 3D-Printed Habitat Challenge from 2015 to 2019, inviting teams to design and print habitats using materials that could be found on Mars. On Earth, companies already 3D print concrete houses.',
      'At NASA\'s Johnson Space Center in Houston, a 3D-printed habitat called Mars Dune Alpha, about 160 square meters in size, hosts long simulated Mars missions. In its first mission, four volunteers lived inside for 378 days, from June 2023 to July 2024.',
    ]],
    ['Challenges to solve', FUT_WOULD, [
      'Lunar and Martian soils are different from earth and sand, so engineers are testing ways to bind them: melting them with heat or microwaves (sintering), or mixing them with small amounts of binder brought from Earth. Printed walls may crack in extreme temperature swings, so they would need inner airtight liners and regular inspection.',
    ]],
  ],
  'art' => 'This illustration shows a low, armoured dome with a heavy door. Here we imagine it printed by robots from local soil.',
  'look' => ['Notice how low and rounded the shelter is.', 'Find the heavy door.'],
  'questions' => ['Why might it be better to build from local soil than bring materials from Earth?', 'What would robots need to know to build a home without people?', 'Would you volunteer to live in a simulated Mars base for a year?'],
  'words' => ['3D printing' => 'Building an object layer by layer from a digital design.', 'Sintering' => 'Heating powder until its grains fuse together.', 'Analogue mission' => 'A practice mission on Earth that copies conditions in space.'],
  'sources' => ['nasa-3dp', 'nasa-chapea', 'esa-moon'],
  'related' => ['robotics-factory', 'building-materials', 'inflatable-habitat'],
],

'storm-shelter' => [
  'name' => 'Radiation storm shelter', 'latin' => 'solar storm refuge', 'cat' => 'live', 'src' => 'art/floor_s.png',
  'summary' => 'A heavily shielded bunker where everyone could shelter for hours or days during a dangerous burst of radiation from the Sun.',
  'facts' => ['Purpose' => 'Protection during solar storms', 'Danger' => 'Solar particle events', 'Best shielding' => 'Water, soil, plastics', 'Real example' => 'Orion crews build a shelter from stowed supplies'],
  'sections' => [
    ['Why a shelter is needed', FUT_REAL, [
      'Earth\'s magnetic field and thick atmosphere protect us from most space radiation. On the Moon and Mars, that protection is missing or weak. Every so often, the Sun blasts out huge clouds of energetic particles in a "solar particle event". Without shelter, astronauts outside could receive a dangerous dose in hours.',
    ]],
    ['How it would work', FUT_WOULD, [
      'The shelter would be a small, central room buried deep under soil or surrounded by water tanks. Materials containing a lot of hydrogen, like water and plastic, are especially good at slowing down the particles. Space weather forecasters would give warnings, and everyone would move inside until the storm passed, with food, water, air supply and communications ready.',
    ]],
    ['Real solutions today', FUT_REAL, [
      'NASA\'s Orion spacecraft, built to carry astronauts around the Moon, has a plan for solar storms: the crew packs stowage bags and supplies around themselves in a central area to build a temporary shelter. On the International Space Station, astronauts move to better-shielded parts of the station during strong solar storms.',
    ]],
  ],
  'art' => 'This illustration shows a squat armoured bunker with thick walls, a heavy door and warning stripes.',
  'look' => ['Notice the thick, sloping walls.', 'Find the warning stripes. Why might they be there?'],
  'questions' => ['How would you keep spirits up while sheltering for two days?', 'Why might water be a good radiation shield?', 'How do we prepare for storms on Earth?'],
  'words' => ['Radiation' => 'Energy that travels as waves or fast particles.', 'Solar particle event' => 'A burst of energetic particles from the Sun.', 'Shielding' => 'Material placed between people and danger.'],
  'sources' => ['nasa-hrp', 'noaa-swpc'],
  'related' => ['space-weather-station', 'lunar-base', 'medical-bay'],
],

'airlock-hangar' => [
  'name' => 'Airlock and suit hangar', 'latin' => 'dust control', 'cat' => 'live', 'src' => 'art/home_a.png',
  'summary' => 'The doorway between the habitat and the outside, where spacesuits are stored and the clingy, sharp dust is kept out.',
  'facts' => ['Purpose' => 'Getting in and out safely', 'Biggest enemy' => 'Lunar and Martian dust', 'Apollo lesson' => 'Dust got everywhere', 'Idea' => 'Suitports: suits that stay outside'],
  'sections' => [
    ['How an airlock works', FUT_REAL, [
      'An airlock is a small room with two doors. To go outside, an astronaut in a spacesuit enters, closes the inner door, and the air is pumped out. Then the outer door opens. Coming back, the steps are reversed. Only one door is ever open at a time, so the habitat never loses its air.',
    ]],
    ['The dust problem', FUT_REAL, [
      'The Apollo astronauts discovered that lunar dust is a serious problem. Because there is no wind or water on the Moon to wear it smooth, the grains are jagged like broken glass. The dust clung to suits, scratched visors, clogged joints and seals, and some astronauts reported sneezing and irritated eyes after taking off their suits inside the lander.',
    ]],
    ['How a future hangar could solve it', FUT_WOULD, [], ['list' => [
      'Suitports: spacesuits stay attached to the outside wall, and astronauts climb in from inside through a hatch in the back, so dusty suits never enter.',
      'Dust-repelling coatings and electric fields that push dust off surfaces.',
      'Brushes, air jets and a "mud room" between outside and living areas.',
      'Hangars to service rovers and suits away from living spaces.',
    ]]],
  ],
  'art' => 'This illustration shows a hangar-like building with a large armoured door and a satellite dish. Here we imagine it as the settlement\'s airlock and suit hangar.',
  'look' => ['Find the big door. What size of vehicle could use it?', 'Where might suits be stored?'],
  'questions' => ['Why must only one airlock door open at a time?', 'How do you keep mud out of your home on rainy days? Could that help on the Moon?', 'What would you design to clean a dusty spacesuit?'],
  'words' => ['Airlock' => 'A small room with two doors for moving between different air pressures.', 'Suitport' => 'A hatch where a spacesuit attaches to the outside of a vehicle or habitat.', 'Abrasive' => 'Rough enough to scratch or wear things down.'],
  'sources' => ['nasa-dust', 'nasa-hrp'],
  'related' => ['rover-track', 'inflatable-habitat', 'printed-habitat'],
],

// ---------------- Air, water and food ----------------
'water-recycler' => [
  'name' => 'Water recycler', 'latin' => 'closed-loop water', 'cat' => 'support', 'src' => 'art/fountain.png',
  'summary' => 'A system that cleans and reuses almost every drop of water, including sweat and urine, because water is too precious to waste.',
  'facts' => ['Purpose' => 'Reuse water again and again', 'ISS record' => 'About 98% of water recovered (2023)', 'Sources of water' => 'Sinks, showers, sweat, breath, urine', 'Why it matters' => 'Water is heavy to launch'],
  'sections' => [
    ['Why recycle water?', FUT_REAL, [
      'Every kilogram launched into space costs a lot, and each person needs several liters of water a day for drinking, food and washing. Instead of bringing new water, space stations recycle it.',
      'On the International Space Station, humidity from breath and sweat is collected from the air, and urine is distilled and filtered. In 2023 NASA announced that, with a new brine processor, the station could recover about 98 percent of the water crews bring aboard.',
    ]],
    ['How the system works', FUT_REAL, [], ['list' => [
      'Collect: water from sinks, condensed humidity and urine.',
      'Distil: urine is boiled at low pressure and the vapor is collected.',
      'Filter: water passes through filters and beds that remove impurities.',
      'Clean: a high-temperature reactor breaks down remaining contaminants.',
      'Check: sensors test the water before anyone drinks it.',
    ]]],
    ['A future fountain', FUT_WOULD, [
      'In a Moon or Mars settlement, a fountain could be the visible end of this system: a reminder that every drop has been cleaned and reused many times. Water from local ice could top up the system to replace the small amount lost.',
    ]],
  ],
  'art' => 'This illustration shows a glowing fountain in a plaza. Here we imagine it as the visible part of the settlement\'s water recycling.',
  'look' => ['Find the glowing column of water.', 'Where could the cleaned water flow next?'],
  'questions' => ['Would you drink recycled water if you knew it was cleaner than tap water?', 'How much water do you use in a day?', 'What could cities on Earth learn from space water recycling?'],
  'words' => ['Closed loop' => 'A system that reuses its materials over and over.', 'Distillation' => 'Boiling a liquid and collecting the vapor to purify it.', 'Brine' => 'Very salty leftover water.'],
  'sources' => ['nasa-eclss'],
  'related' => ['habitat-cluster', 'ice-mine', 'indoor-farm'],
],

'greenhouse-dome' => [
  'name' => 'Greenhouse dome', 'latin' => 'bioregenerative life support', 'cat' => 'support', 'src' => 'art/growth_1.png',
  'summary' => 'A sealed dome where plants grow food, recycle water and turn carbon dioxide back into oxygen, like a small piece of Earth.',
  'facts' => ['Purpose' => 'Food, oxygen and recycling', 'Earth experiment' => 'Biosphere 2, Arizona (1991-1993)', 'Space research' => 'ESA\'s MELiSSA project', 'Big challenge' => 'Keeping the balance stable'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'Plants take in carbon dioxide and release oxygen, and they can turn waste into food when combined with composting and microbes. A greenhouse dome would combine growing beds, fish tanks or algae and recycling systems into a living life support system, cutting the need for supplies from Earth.',
    ]],
    ['Lessons from Biosphere 2', FUT_REAL, [
      'From 1991 to 1993, eight people lived sealed inside Biosphere 2, a huge glass-and-steel complex in Arizona with a rainforest, ocean, desert and farm. It taught scientists a lot, partly through problems: oxygen levels fell over time, partly because microbes in the rich soil used it up and the concrete absorbed carbon dioxide, and extra oxygen had to be pumped in. Growing enough food was hard work.',
    ]],
    ['Research today', FUT_REAL, [
      'The European Space Agency\'s MELiSSA project is studying a loop of compartments in which microbes break down waste, algae and plants grow, and the crew is the final step. The goal is a system that recycles almost everything. It is still being developed in the lab.',
    ]],
  ],
  'art' => 'This illustration shows a glass dome full of trees and plants, with machinery around its base.',
  'look' => ['Look through the glass. What is growing inside?', 'Find the pipes and tanks around the edge.'],
  'questions' => ['What problems could growing food in a dome solve, and what might it cost?', 'What could go wrong if one part of a living system failed?', 'What did Biosphere 2 teach about how complicated nature is?'],
  'words' => ['Bioregenerative' => 'Using living things to recycle air, water and food.', 'Ecosystem' => 'Living things and their environment working together.', 'Biosphere' => 'All the parts of the Earth where life exists.'],
  'sources' => ['b2', 'esa-melissa'],
  'related' => ['indoor-farm', 'tree-pod-habitat', 'water-recycler'],
],

'indoor-farm' => [
  'name' => 'Indoor farm', 'latin' => 'hydroponics', 'cat' => 'support', 'src' => 'art/nt_garden.png',
  'summary' => 'Rows of plants grown under lights in water instead of soil, producing fresh food year-round in a small space.',
  'facts' => ['Purpose' => 'Fresh food in space', 'First space salad' => 'Lettuce eaten on the ISS, 2015', 'Grown in' => 'Water and nutrients, under LEDs', 'Also used on Earth' => 'Vertical farms in cities'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'An indoor farm would grow leafy greens, herbs, tomatoes, peppers and more in stacked trays, watered with nutrient solution and lit by LEDs tuned to the colors plants use best. Computers would control temperature, humidity and light. Fresh food would add vitamins and variety to packaged meals.',
    ]],
    ['Plants in space today', FUT_REAL, [
      'NASA\'s Veggie system on the International Space Station grows plants under red, blue and green LEDs. In 2015, astronauts ate red romaine lettuce grown on the station, the first time NASA astronauts ate food grown in space. Since then crews have grown cabbage, mustard greens, chilli peppers and flowers.',
      'Growing plants in weightlessness has surprises: water does not drain downward, so roots can drown or dry out, and plants rely on light rather than gravity to know which way to grow.',
    ]],
    ['Indoor farms on Earth', FUT_REAL, [
      '"Vertical farms" in cities grow crops indoors in stacked layers, using much less water than fields because water is recycled. They are good for leafy greens but use a lot of electricity for lights, so engineers are working to make them more efficient.',
    ]],
  ],
  'art' => 'This illustration shows raised trays of green plants under lights, surrounded by machinery.',
  'look' => ['Notice the lights above the plants.', 'Find the tanks that might hold water and nutrients.'],
  'questions' => ['Should food be grown inside cities? What would it need?', 'Why might astronauts value fresh food more than people on Earth?', 'Which foods would be hardest to grow indoors?'],
  'words' => ['Hydroponics' => 'Growing plants in water and nutrients without soil.', 'LED' => 'A light-emitting diode, an efficient kind of light.', 'Vertical farm' => 'An indoor farm with crops in stacked layers.'],
  'sources' => ['nasa-veggie'],
  'related' => ['greenhouse-dome', 'water-recycler', 'tree-pod-habitat'],
],

'tree-pod-habitat' => [
  'name' => 'Tree pod habitat', 'latin' => 'nature in space', 'cat' => 'support', 'src' => 'art/shared_2.png',
  'summary' => 'Living pods around a real tree, bringing the calm of nature to people living far from Earth.',
  'facts' => ['Purpose' => 'Wellbeing and connection to nature', 'Real finding' => 'Astronauts value caring for plants', 'Isolation studies' => 'Mars-500, Antarctic bases', 'Status' => 'Imagined'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'At the heart of the settlement, a real tree would grow in a tall, sealed atrium, with homes and gathering pods arranged around it. It would add oxygen, humidity and green views, but mostly it would remind people of home.',
    ]],
    ['Why nature matters to astronauts', FUT_REAL, [
      'Astronauts living for months on the International Space Station often say how much they enjoy tending plants, and photos of Earth from the station\'s windows are among their favorite views. Long isolation, small spaces and the same faces every day can be stressful.',
      'Studies on Earth that copy long space missions, such as the 520-day Mars-500 isolation study in Russia (2010-2011) and research at remote Antarctic stations, look at how crews cope. Contact with nature, privacy, light that changes like a day, and meaningful work all seem to help.',
    ]],
    ['Could a tree grow on Mars?', FUT_WOULD, [
      'A tree would need protection from radiation, a sealed room with air, warmth, water, soil and good light, plus space to grow tall in Mars\' lower gravity. It would be an expensive luxury, which makes it a good question: how much is wellbeing worth?',
    ]],
  ],
  'art' => 'This illustration shows a great tree with glowing pods built around its trunk and branches.',
  'look' => ['Find the tree trunk at the center.', 'Count the pods around it.'],
  'questions' => ['Can technology and nature share the same space?', 'What would you bring to remind you of home?', 'Is a tree on Mars a luxury or a need?'],
  'words' => ['Isolation' => 'Being cut off from other people and places.', 'Analogue study' => 'A study on Earth that copies space conditions.', 'Atrium' => 'A tall, open central space in a building.'],
  'sources' => ['mars500', 'nasa-hrp', 'nasa-veggie'],
  'related' => ['greenhouse-dome', 'public-plaza', 'medical-bay'],
],

'ice-mine' => [
  'name' => 'Ice mine and water works', 'latin' => 'resource extraction', 'cat' => 'support', 'src' => 'art/growth_2.png',
  'summary' => 'A plant that would dig up frozen water from shadowed craters and turn it into drinking water, oxygen and rocket fuel.',
  'facts' => ['Purpose' => 'Water, oxygen and fuel from ice', 'Evidence' => 'LCROSS found water at the lunar south pole (2009)', 'Turns into' => 'Hydrogen and oxygen by electrolysis', 'Status' => 'Being studied'],
  'sections' => [
    ['Why ice is so valuable', FUT_REAL, [
      'Water is the most useful resource beyond Earth: people drink it, plants need it, it shields against radiation, and splitting it gives oxygen to breathe and hydrogen and oxygen for rocket fuel. In 2009 NASA\'s LCROSS mission crashed a spent rocket stage into a permanently shadowed crater near the Moon\'s south pole and detected water in the plume of debris.',
    ]],
    ['How it would work', FUT_WOULD, [], ['list' => [
      'Robotic diggers would work inside dark craters colder than anywhere on Earth.',
      'Icy soil would be heated in sealed ovens so the water turns to vapor.',
      'The vapor would be captured, frozen again and cleaned.',
      'Electrolysis would split some water into hydrogen and oxygen.',
      'Gases would be chilled into liquids and stored as rocket fuel.',
    ]]],
    ['Challenges', FUT_WOULD, [
      'No one yet knows exactly how much ice there is, how deep, or how mixed with soil. Machines must work in extreme cold and darkness, powered by cables or nuclear power. There are also questions about who may use these resources, which nations are discussing under agreements such as the Artemis Accords.',
    ]],
  ],
  'art' => 'This illustration shows a spherical building with a large window, pipes and a pool. Here we imagine it as a works that turns ice into water.',
  'look' => ['Find the pool of water.', 'Follow the pipes from the sphere.'],
  'questions' => ['Who should be allowed to mine ice on the Moon?', 'Why is water useful for so many things in space?', 'How would you dig in a crater that never sees sunlight?'],
  'words' => ['Electrolysis' => 'Splitting water into hydrogen and oxygen with electricity.', 'Propellant' => 'Fuel and oxygen burned by a rocket.', 'Resource' => 'Something useful that can be gathered.'],
  'sources' => ['nasa-ice', 'nasa-isru', 'accords'],
  'related' => ['oxygen-factory', 'water-recycler', 'spaceport'],
],

'oxygen-factory' => [
  'name' => 'Oxygen factory', 'latin' => 'in-situ resource utilization', 'cat' => 'support', 'src' => 'art/floor_m.png',
  'summary' => 'A factory that would pull oxygen out of the Martian air or Moon rock, so settlers can breathe and rockets can fly home.',
  'facts' => ['Purpose' => 'Make oxygen from local materials', 'Real test' => 'MOXIE on Mars, 2021-2023', 'MOXIE made' => '122 grams of oxygen in total', 'Moon rock' => 'Contains lots of oxygen bound in minerals'],
  'sections' => [
    ['Living off the land', FUT_REAL, [
      'Bringing everything from Earth is extremely expensive. "In-situ resource utilization", or ISRU, means using what is already there. Oxygen is a top priority: people need it to breathe, and rockets need large amounts of it to burn their fuel.',
    ]],
    ['Making oxygen on Mars, for real', FUT_REAL, [
      'Mars\' thin air is mostly carbon dioxide. NASA\'s Perseverance rover carried a lunchbox-sized experiment called MOXIE that heated Martian air and split carbon dioxide into oxygen and carbon monoxide using electricity. Between 2021 and 2023 it ran 16 times and produced 122 grams of oxygen, about what a small dog breathes in ten hours, at its best making 12 grams an hour. It proved the idea works on Mars.',
    ]],
    ['A full-size factory', FUT_WOULD, [
      'A future factory would be hundreds of times bigger, running for months before astronauts arrive to fill tanks for breathing and for the trip home. On the Moon, oxygen could be released from rock by heating it with chemicals or electricity, since oxygen makes up roughly 40 to 45 percent of lunar soil by weight, locked inside minerals. These factories would need lots of steady power.',
    ]],
  ],
  'art' => 'This illustration shows an industrial building with chimneys, tanks and pipes. Here we imagine it as a factory making oxygen.',
  'look' => ['Find the chimneys and storage tanks.', 'Where would the oxygen be stored?'],
  'questions' => ['Why would astronauts want the oxygen factory running before they arrive?', 'What else could be made from local materials?', 'What would happen to the settlement if the factory broke down?'],
  'words' => ['ISRU' => 'In-situ resource utilization: using local resources.', 'Carbon dioxide' => 'A gas made of carbon and oxygen; most of Mars\' air.', 'Oxidiser' => 'The oxygen a rocket burns with its fuel.'],
  'sources' => ['nasa-moxie', 'nasa-isru'],
  'related' => ['ice-mine', 'power-tower', 'habitat-cluster'],
],

// ---------------- Power, factories and building ----------------
'power-tower' => [
  'name' => 'Power tower', 'latin' => 'fission surface power', 'cat' => 'power', 'src' => 'art/growth_3.png',
  'summary' => 'A compact nuclear reactor and power station that could provide steady electricity through the long lunar night or a Martian dust storm.',
  'facts' => ['Purpose' => 'Reliable power day and night', 'Real test' => 'KRUSTY reactor test (2018)', 'NASA goal' => 'About 40 kilowatts for a Moon base', 'Also needed' => 'Solar panels and batteries'],
  'sections' => [
    ['Why not just solar?', FUT_REAL, [
      'Solar panels work well in space, and the International Space Station runs on them. But much of the Moon has about two weeks of darkness at a time, and Mars is further from the Sun, with dust storms that can block sunlight for weeks. A settlement needs power for life support at every moment.',
    ]],
    ['A small nuclear reactor', FUT_REAL, [
      'In 2018, NASA and the US Department of Energy tested a small reactor called KRUSTY, part of the Kilopower project, in Nevada. It ran successfully through a full power cycle. NASA\'s Fission Surface Power project builds on this, aiming for a reactor that could provide around 40 kilowatts on the Moon, enough for several homes on Earth, for about ten years.',
    ]],
    ['Building and maintaining it', FUT_WOULD, [], ['list' => [
      'The reactor would be landed and placed away from the habitat, or buried, so soil blocks its radiation.',
      'Radiators, like big fins, would get rid of waste heat into space.',
      'Cables would carry power to the base.',
      'It would be designed to run for years with very little maintenance.',
      'Solar panels and batteries would provide backup.',
    ]]],
  ],
  'art' => 'This illustration shows a tall tower crackling with blue energy. Here we imagine it as the settlement\'s power plant.',
  'look' => ['Follow the cables from the tower.', 'Find the coils at the top.'],
  'questions' => ['Where should a city\'s energy come from, and who decides?', 'What are the risks and benefits of nuclear power in space?', 'Why does a settlement need power every single minute?'],
  'words' => ['Fission' => 'Splitting atoms to release energy.', 'Kilowatt' => 'A unit of power: 1,000 watts.', 'Radiator' => 'A panel that gets rid of heat.'],
  'sources' => ['nasa-fsp'],
  'related' => ['oxygen-factory', 'robotics-factory', 'storm-shelter'],
],

'robotics-factory' => [
  'name' => 'Robotics factory', 'latin' => 'autonomous construction', 'cat' => 'power', 'src' => 'art/nt_workshop.png',
  'summary' => 'A factory where robots build, repair and maintain the settlement, working in conditions too dangerous or tiring for people.',
  'facts' => ['Purpose' => 'Robots that build and repair', 'Works in' => 'Vacuum, dust, cold, radiation', 'Big challenge' => 'Fixing things far from help', 'Status' => 'Early research'],
  'sections' => [
    ['Why robots first?', FUT_WOULD, [
      'Building a settlement involves heavy, dangerous work in a spacesuit, which is slow and tiring. Robots could arrive years before people, preparing landing pads, digging, printing shelters and setting up power, then keep working day and night while people focus on science and living.',
    ]],
    ['Robots in space today', FUT_REAL, [
      'Robotic arms such as Canadarm2 on the International Space Station move cargo and help astronauts. Rovers on Mars drive themselves partway, choosing safe paths between commands from Earth. Factories on Earth already use robots to weld, assemble and inspect.',
    ]],
    ['Building and maintaining robots far from home', FUT_WOULD, [
      'Robots on the Moon or Mars must survive sharp dust, huge temperature swings and radiation that can scramble electronics. They would need to be repairable, ideally by other robots, using standard parts, and a factory with 3D printers and machine tools to make spares. Engineers dream of a factory that could build most of its own parts from local materials, but that is a very hard problem.',
    ]],
  ],
  'art' => 'This illustration shows a factory with glass walls, robotic arms and machinery inside.',
  'look' => ['Look for robotic arms through the windows.', 'Where would finished parts come out?'],
  'questions' => ['If robots build things, who checks they are safe and fair?', 'What jobs should robots do, and what jobs should people keep?', 'How would you repair a robot millions of kilometers from a shop?'],
  'words' => ['Autonomous' => 'Able to work without being controlled step by step.', 'Robotic arm' => 'A machine arm that can grip, lift and move things.', 'Spare part' => 'A replacement for a broken piece.'],
  'sources' => ['nasa-robots', 'nasa-isru'],
  'related' => ['robot-helpers', 'fab-shop', 'printed-habitat'],
],

'fab-shop' => [
  'name' => 'Fabrication shop', 'latin' => '3D printing spare parts', 'cat' => 'power', 'src' => 'art/business_1.png',
  'summary' => 'A workshop where residents 3D print tools and spare parts on demand, and recycle broken items into new ones.',
  'facts' => ['Purpose' => 'Make what you need, when you need it', 'First in space' => '3D printer on the ISS (2014)', 'Recycling' => 'Old plastic into new printer material', 'Benefit' => 'Fewer spare parts to launch'],
  'sections' => [
    ['Why make things on site?', FUT_WOULD, [
      'A Mars settlement could not order spare parts and have them arrive tomorrow: supply ships might come only every couple of years. Instead of carrying a spare for every possible breakdown, residents would carry printers and raw materials and make what they need.',
    ]],
    ['Printing in space today', FUT_REAL, [
      'In 2014, the first 3D printer was installed on the International Space Station, built by the company Made In Space with NASA. Among its first prints was a part of its own faceplate, and later it printed a ratchet wrench from a design emailed from Earth. Experiments have since tested recycling used plastic into new printer filament in space.',
    ]],
    ['What a fabrication shop would need', FUT_WOULD, [], ['list' => [
      'Printers for plastic, metal and local-soil materials.',
      'Machine tools to cut and finish parts accurately.',
      'A digital library of designs, checked and tested.',
      'Recyclers to turn packaging and broken parts into raw material.',
      'Skilled people who can design, print and test replacements.',
    ]]],
  ],
  'art' => 'This illustration shows a high-tech shop with a large glowing screen and machinery.',
  'look' => ['Find the glowing screen.', 'What might be made in this shop?'],
  'questions' => ['What would you print if you had a 3D printer at home?', 'Why might it be safer to carry printers than spare parts?', 'How could printing help reduce waste on Earth?'],
  'words' => ['3D printer' => 'A machine that builds objects layer by layer.', 'Filament' => 'The plastic thread a 3D printer melts.', 'On demand' => 'Made when needed.'],
  'sources' => ['iss-3dp'],
  'related' => ['robotics-factory', 'building-materials', 'science-lab'],
],

'robotic-crane' => [
  'name' => 'Robotic crane', 'latin' => 'building in low gravity', 'cat' => 'power', 'src' => 'build/crane.png',
  'summary' => 'A self-guided crane that lifts modules and soil on the Moon, where things weigh less but are just as hard to stop.',
  'facts' => ['Purpose' => 'Lifting and placing heavy parts', 'Moon gravity' => 'About one sixth of Earth\'s', 'Key physics' => 'Less weight, same mass', 'Status' => 'Concept'],
  'sections' => [
    ['How it would work', FUT_WOULD, [
      'A robotic crane would unload landers, stack habitat modules and pile soil over shelters, guided by cameras and sensors and supervised by people from inside the base.',
    ]],
    ['Lighter, but not easier', FUT_REAL, [
      'On the Moon, gravity is about one sixth as strong as on Earth, so a load weighs only a sixth as much: a crane can lift much heavier objects. But an object\'s mass, its amount of matter, stays the same. A heavy module swinging on a cable is just as hard to start and stop as on Earth, so it could swing for a long time and crash into things. Cranes would need to move slowly and carefully, with ways to damp the swinging.',
      'Lower gravity also means less grip: a crane needs a wide base or anchors, so it does not tip or slide when it swings a load.',
    ]],
    ['Building and maintaining it', FUT_WOULD, [
      'The crane would be designed to fold for launch and set itself up on arrival. Its motors and joints would need sealing against dust, and its cables would need regular inspection. Remote operators could control it from inside the base, or even from Earth for slow, careful jobs.',
    ]],
  ],
  'art' => 'This illustration shows a red and gray robotic crane lifting a glowing module. The glow is part of the original artwork.',
  'look' => ['Is anyone operating it? How can you tell?', 'Find the glowing module on the hook.'],
  'questions' => ['If machines did most building work, what work would people still choose to do?', 'Why might a swinging load be dangerous on the Moon?', 'What is the difference between weight and mass?'],
  'words' => ['Mass' => 'How much matter an object has.', 'Weight' => 'The force of gravity pulling on an object.', 'Inertia' => 'An object\'s resistance to starting or stopping.'],
  'sources' => ['nasa-robots', 'nasa-artemis'],
  'related' => ['building-materials', 'robotics-factory', 'printed-habitat'],
],

'building-materials' => [
  'name' => 'Space building materials', 'latin' => 'regolith, metals and recycling', 'cat' => 'power', 'src' => 'build/materials.png',
  'summary' => 'Modules from Earth, soil from the Moon and Mars, and recycled packaging: the materials of a future settlement.',
  'facts' => ['From Earth' => 'Electronics, seals, machines', 'From the Moon or Mars' => 'Soil, rock, water ice, metals', 'Big idea' => 'Ship brains, build bulk locally', 'Recycle' => 'Packaging becomes building material'],
  'sections' => [
    ['What comes from Earth', FUT_REAL, [
      'Some things are very hard to make far from Earth: computer chips, precision machines, medicines and special seals. These would be shipped from Earth, packed into standard modules and containers like the ones in this picture.',
    ]],
    ['What could be made locally', FUT_WOULD, [
      'Bulk materials, such as shielding, walls, roads and landing pads, would be made from local soil. Lunar soil contains oxygen, silicon, iron, aluminum, titanium and calcium bound up in minerals, which could one day be extracted. The European Space Agency and NASA have tested ways to turn simulated lunar soil into bricks and printed structures.',
    ]],
    ['Nothing wasted', FUT_WOULD, [
      'Every container, panel and piece of packaging that arrives from Earth would be designed to be reused: crates that become furniture, tanks that become rooms, plastic that becomes printer filament. Engineers sometimes describe this goal as "ship the brains, build the bulk".',
    ]],
  ],
  'art' => 'This illustration shows stacked modules and containers with glowing panels, ready for assembly.',
  'look' => ['Notice the panels and containers.', 'Which parts look like they came from Earth?'],
  'questions' => ['Could buildings be designed to be taken apart and reused?', 'What would you ship from Earth, and what would you make locally?', 'How could packaging on Earth be reused instead of thrown away?'],
  'words' => ['Regolith' => 'Loose soil and dust covering rock on the Moon or Mars.', 'Bulk material' => 'Material needed in large amounts, like soil or concrete.', 'Simulant' => 'A material made on Earth to copy lunar or Martian soil.'],
  'sources' => ['esa-moon', 'nasa-isru'],
  'related' => ['robotic-crane', 'printed-habitat', 'fab-shop'],
],

// ---------------- Health and community ----------------
'gravity-gym' => [
  'name' => 'Low-gravity gym', 'latin' => 'exercise countermeasures', 'cat' => 'health', 'src' => 'art/fitness_1.png',
  'summary' => 'A gym where residents exercise every day to stop their bones and muscles from weakening in low gravity.',
  'facts' => ['Purpose' => 'Keep bones, muscles and heart strong', 'ISS routine' => 'About 2 hours of exercise a day', 'Problem' => 'Bones lose density without gravity', 'Equipment' => 'Treadmill, bike, resistance machine'],
  'sections' => [
    ['Why exercise is essential', FUT_REAL, [
      'On Earth, gravity loads our bones and muscles every time we stand or walk. In weightlessness, that load disappears. Astronauts can lose bone density in their hips and legs, often around one percent or more per month, and muscles weaken. Their hearts and blood vessels also adapt in ways that can make them dizzy when they return.',
    ]],
    ['The space station gym', FUT_REAL, [
      'Astronauts on the International Space Station exercise for about two hours a day. They run on a treadmill while wearing a harness that pulls them down, pedal a cycle without a seat, and lift "weights" on a machine called ARED, which uses vacuum cylinders to create resistance because ordinary weights would float.',
    ]],
    ['On the Moon and Mars', FUT_WOULD, [
      'The Moon has about one sixth of Earth\'s gravity and Mars about three eighths. Nobody yet knows whether that is enough to keep people healthy over years. A settlement gym would combine exercise machines with medical tests to track bone, muscle and heart health, and research would watch residents closely.',
    ]],
  ],
  'art' => 'This illustration shows a gym building with a glowing exercise chamber and machinery.',
  'look' => ['Find the glowing exercise chamber.', 'What equipment might be inside?'],
  'questions' => ['How would you stay fit if you could not walk normally?', 'Why might exercise be more important in space than on Earth?', 'How much exercise do you get each day?'],
  'words' => ['Bone density' => 'How solid and strong bones are.', 'Countermeasure' => 'Something done to prevent a harmful effect.', 'Resistance exercise' => 'Exercise that works muscles against a force.'],
  'sources' => ['nasa-exercise', 'nasa-hrp'],
  'related' => ['centrifuge-arena', 'medical-bay', 'tree-pod-habitat'],
],

'centrifuge-arena' => [
  'name' => 'Spinning gravity arena', 'latin' => 'artificial gravity', 'cat' => 'health', 'src' => 'art/fitness_3.png',
  'summary' => 'A huge spinning ring where the push of rotation could feel like gravity, letting people walk normally in space.',
  'facts' => ['Purpose' => 'Create gravity-like force', 'How' => 'Spinning pushes you outward', 'Famous in fiction' => 'Rotating space stations in films', 'Status' => 'Not yet built for people'],
  'sections' => [
    ['How spinning can feel like gravity', FUT_REAL, [
      'When a car turns a sharp corner, you feel pushed toward the outside. In a spinning ring, the floor is on the outside, so the ring constantly pushes you inward and you feel pressed against the floor, like gravity. The faster the spin or the bigger the ring, the stronger the effect.',
    ]],
    ['The catch', FUT_REAL, [
      'In a small ring spinning fast, your head and feet feel different forces, and turning your head can make you dizzy and sick. To feel comfortable, a ring needs to be large and spin slowly, which means it would be huge and expensive. Researchers have tested short-arm centrifuges on Earth, where people lie on a spinning bed, to study whether short daily spins could protect health.',
    ]],
    ['How it would work in a settlement', FUT_WOULD, [
      'On the Moon or Mars, a circular track could tilt and spin to add extra "gravity" for exercise or sleep. In open space, a whole station could rotate. Building one would require strong materials, balance (so it does not wobble), and a way for people and supplies to move between the spinning part and the still part.',
    ]],
  ],
  'art' => 'This illustration shows a domed arena with an oval track. Here we imagine it as a spinning ring for artificial gravity.',
  'look' => ['Find the oval track inside the dome.', 'Which way would you feel pushed as it spins?'],
  'questions' => ['Why do you feel pushed outward on a fast roundabout?', 'Would you rather exercise every day or live in a spinning station?', 'What problems would a spinning station need to solve?'],
  'words' => ['Centrifuge' => 'A machine that spins things very fast.', 'Artificial gravity' => 'A force that feels like gravity, created by spinning or speeding up.', 'Rotation' => 'Turning around a center.'],
  'sources' => ['artgrav', 'nasa-hrp'],
  'related' => ['gravity-gym', 'medical-bay', 'space-elevator'],
],

'medical-bay' => [
  'name' => 'Medical bay', 'latin' => 'space medicine', 'cat' => 'health', 'src' => 'art/knowledge_2.png',
  'summary' => 'A small hospital where crew members trained in medicine could treat illnesses and injuries with help from doctors on Earth.',
  'facts' => ['Purpose' => 'Treat illness and injury far from home', 'Help from Earth' => 'Telemedicine (with delays)', 'Crew training' => 'Medical skills for emergencies', 'Biggest risks' => 'Radiation, injuries, isolation'],
  'sections' => [
    ['Medicine far from home', FUT_REAL, [
      'On the International Space Station, a crew in trouble can return to Earth within hours. From the Moon it takes days; from Mars, many months. A settlement would need its own medical bay and crew members trained to handle emergencies.',
      'NASA\'s Human Research Program studies five main hazards of spaceflight: radiation, isolation and confinement, distance from Earth, altered gravity and hostile, closed environments. Each one affects health.',
    ]],
    ['How it would work', FUT_WOULD, [], ['list' => [
      'Compact equipment such as portable ultrasound, blood analysers and X-ray machines.',
      'Doctors on Earth giving advice over video, though messages to Mars take minutes to arrive.',
      'Artificial intelligence to help diagnose problems.',
      'A pharmacy with medicines that stay stable for years despite radiation.',
      'Care for mental health as well as physical health.',
    ]]],
    ['Learning from today', FUT_REAL, [
      'Astronauts have performed ultrasound scans on each other on the space station, guided step by step by experts on the ground. Similar telemedicine helps people in remote places on Earth, such as Antarctic research bases and rural villages.',
    ]],
  ],
  'art' => 'This illustration shows a building with glass walls and machinery. Here we imagine it as the settlement\'s medical bay.',
  'look' => ['Find the glass walls. Why might a medical bay need lots of light?', 'Where might an emergency vehicle arrive?'],
  'questions' => ['What medical skills should everyone in a settlement learn?', 'How could doctors help when messages take 20 minutes to arrive?', 'Why is mental health important on long missions?'],
  'words' => ['Telemedicine' => 'Medical care given at a distance using technology.', 'Diagnose' => 'Work out what illness someone has.', 'Ultrasound' => 'A scan that uses sound waves to see inside the body.'],
  'sources' => ['nasa-hrp', 'nasa-ultra'],
  'related' => ['gravity-gym', 'telepresence', 'storm-shelter'],
],

'public-plaza' => [
  'name' => 'Community plaza', 'latin' => 'living together in isolation', 'cat' => 'health', 'src' => 'art/shared_1.png',
  'summary' => 'A shared square where residents meet, eat and celebrate, because getting along matters as much as any machine.',
  'facts' => ['Purpose' => 'Meeting, celebrating, resting', 'Research' => 'Isolation studies on Earth', 'Helps' => 'Privacy, routine, shared goals', 'Risk' => 'Conflict in a small group'],
  'sections' => [
    ['Why a settlement needs a square', FUT_REAL, [
      'Small groups living in isolation for a long time face real challenges: boredom, homesickness, disagreements and stress. Studies at Antarctic research stations and in simulated missions on Earth, such as the 520-day Mars-500 study, show that crews do better with a mix of private space and shared activities, clear roles, and ways to talk through problems.',
    ]],
    ['How it would work', FUT_WOULD, [
      'The plaza would be the biggest open space in the settlement, under a strong dome or underground with bright, changing light that follows a day-and-night cycle. People would gather for shared meals, games, music, celebrations and meetings. A central "flame" could be a light or hologram rather than real fire, because fire is very dangerous in a sealed space.',
    ]],
    ['Building a good community', FUT_WOULD, [], ['list' => [
      'Shared meals and traditions build trust.',
      'Celebrating birthdays and holidays keeps a sense of time.',
      'Quiet places matter as much as busy ones.',
      'Fair ways to settle disagreements prevent small problems growing.',
    ]]],
  ],
  'art' => 'This illustration shows an open plaza with a central blue flame, surrounded by towers and seating.',
  'look' => ['Where could people sit or meet?', 'Find the glowing flame. Why might it be a light instead of a fire?'],
  'questions' => ['In a highly automated city, where would people meet face to face?', 'How do you get along with people when you cannot get away from them?', 'What tradition would you start in a new settlement?'],
  'words' => ['Isolation' => 'Being cut off from others.', 'Community' => 'A group of people who share a place and look out for each other.', 'Circadian rhythm' => 'The body\'s daily cycle of sleeping and waking.'],
  'sources' => ['mars500', 'nasa-hrp'],
  'related' => ['civic-dome', 'tree-pod-habitat', 'telepresence'],
],

'civic-dome' => [
  'name' => 'Civic dome', 'latin' => 'governing a space settlement', 'cat' => 'health', 'src' => 'art/shared_3.png',
  'summary' => 'A domed hall where residents decide the rules of their settlement, under international agreements about space.',
  'facts' => ['Purpose' => 'Making decisions together', 'Key treaty' => 'Outer Space Treaty (1967)', 'Newer agreement' => 'Artemis Accords (2020)', 'Big question' => 'Who owns resources in space?'],
  'sections' => [
    ['The rules of space today', FUT_REAL, [
      'The Outer Space Treaty, agreed in 1967 and signed by more than a hundred countries, is the foundation of space law. It says space should be explored for the benefit of all countries, that no nation can claim the Moon or other bodies as its territory, and that nuclear weapons may not be placed in space.',
      'In 2020, the United States and other countries began signing the Artemis Accords, a set of principles for peaceful exploration that covers sharing scientific data, helping astronauts in distress, and using resources such as water ice. Dozens of countries have signed, though some major space nations have not.',
    ]],
    ['How a settlement might govern itself', FUT_WOULD, [
      'Day-to-day rules would still be needed: how to share air, water and space, how to make decisions in an emergency, how to resolve disputes. A civic dome would be where residents meet, vote and hold leaders to account, possibly with members joining by video from other settlements or from Earth.',
    ]],
    ['Questions to solve', FUT_WOULD, [], ['list' => [
      'Which country\'s laws apply in a settlement with people from many countries?',
      'Who may mine and sell resources?',
      'How should a settlement balance safety with freedom?',
      'How can everyone take part, including future generations born there?',
    ]]],
  ],
  'art' => 'This illustration shows a grand domed hall with a blue glass dome and wide steps.',
  'look' => ['Look at the wide steps to the entrance.', 'Find the glass dome.'],
  'questions' => ['Could technology help more people take part in decisions? Could it shut some out?', 'Should anyone be allowed to own land on the Moon?', 'What would be the first three rules you would make for a Mars settlement?'],
  'words' => ['Treaty' => 'A formal agreement between countries.', 'Governance' => 'How decisions are made and rules enforced.', 'Territory' => 'Land claimed by a country.'],
  'sources' => ['ost', 'accords'],
  'related' => ['public-plaza', 'operations-center', 'ice-mine'],
],

// ---------------- Science and communication ----------------
'science-lab' => [
  'name' => 'Science lab', 'latin' => 'planetary science and protection', 'cat' => 'science', 'src' => 'art/knowledge_1.png',
  'summary' => 'A laboratory to study rocks, ice and possible signs of life, while making sure Earth germs do not contaminate other worlds.',
  'facts' => ['Purpose' => 'Studying samples on site', 'Apollo brought back' => 'About 382 kg of Moon rock and soil', 'Key rule' => 'Planetary protection', 'Big question' => 'Was there ever life on Mars?'],
  'sections' => [
    ['Why study samples on site?', FUT_REAL, [
      'The Apollo missions brought back about 382 kilograms of Moon rock and soil, which scientists are still studying more than 50 years later. NASA\'s Perseverance rover has been collecting rock samples on Mars in sealed tubes. A lab on site would let scientists choose the most interesting samples to study first.',
    ]],
    ['Planetary protection', FUT_REAL, [
      'If we search for life on Mars, we must make sure we do not bring Earth microbes along by accident and then "discover" them, or harm any Martian life. We also need to protect Earth from anything brought back. International planetary protection rules, overseen by COSPAR, set cleaning standards for spacecraft depending on where they go.',
    ]],
    ['How the lab would work', FUT_WOULD, [
      'Samples would be handled in sealed glove boxes, never exposed to the habitat air. Microscopes, chemical analysers and DNA sequencers would look for clues about the planet\'s history. Careful records would track every sample, and scientists on Earth could join remotely.',
    ]],
  ],
  'art' => 'This illustration shows a research building with glowing glass panels and antennas.',
  'look' => ['Find the glowing panels.', 'Where might samples be brought in?'],
  'questions' => ['Who should benefit from discoveries made here?', 'Why must scientists be careful not to bring Earth life to Mars?', 'What would you most like to find on another world?'],
  'words' => ['Sample' => 'A small piece collected for study.', 'Planetary protection' => 'Preventing contamination between worlds.', 'Glove box' => 'A sealed box with built-in gloves for handling things safely.'],
  'sources' => ['nasa-pp', 'nasa-ingenuity'],
  'related' => ['radio-telescope', 'fab-shop', 'medical-bay'],
],

'radio-telescope' => [
  'name' => 'Far-side radio telescope', 'latin' => 'radio astronomy', 'cat' => 'science', 'src' => 'art/knowledge_3.png',
  'summary' => 'A giant dish for listening to the universe, perhaps on the far side of the Moon, the quietest place for radio in our solar system.',
  'facts' => ['Purpose' => 'Listening to radio waves from space', 'Quietest place' => 'The Moon\'s far side', 'First far-side landing' => 'Chang\'e 4 (2019)', 'Status' => 'Concept studies'],
  'sections' => [
    ['Why radio astronomy?', FUT_REAL, [
      'Stars, galaxies and the leftover glow of the Big Bang give off radio waves as well as light. Radio telescopes collect them with large dishes or arrays of antennas, revealing things invisible to the eye, such as the cold gas that forms stars.',
      'On Earth, radio telescopes struggle with interference from phones, TV, radar and satellites, and our atmosphere blocks some of the lowest radio frequencies.',
    ]],
    ['The quiet side of the Moon', FUT_REAL, [
      'The Moon always shows the same face to Earth, so its far side is shielded from Earth\'s radio noise by the Moon itself. In 2019 China\'s Chang\'e 4 made the first soft landing on the far side, sending its data home through a relay satellite called Queqiao. Scientists have proposed building radio telescopes there to listen to the early universe.',
    ]],
    ['Building and maintaining it', FUT_WOULD, [
      'One idea is to use robots to string a huge wire-mesh dish across a natural crater. Another is to spread hundreds of small antennas across the ground. It would need a relay satellite to send data to Earth and must survive the two-week lunar night.',
    ]],
  ],
  'art' => 'This illustration shows a large radio dish on a high-tech base.',
  'look' => ['Which way is the dish pointing?', 'Find the smaller dishes and antennas.'],
  'questions' => ['Why might a city spend money on looking at space?', 'What makes the far side of the Moon so quiet?', 'What questions about the universe would you want answered?'],
  'words' => ['Radio telescope' => 'A telescope that detects radio waves.', 'Interference' => 'Unwanted signals that get in the way.', 'Far side' => 'The side of the Moon that always faces away from Earth.'],
  'sources' => ['cn-change4', 'nasa-dsn'],
  'related' => ['comms-relay', 'science-lab', 'space-weather-station'],
],

'comms-relay' => [
  'name' => 'Communications relay', 'latin' => 'deep space network', 'cat' => 'science', 'src' => 'art/floor_l.png',
  'summary' => 'A tower of antennas that would keep the settlement connected to orbiting satellites, other bases and Earth.',
  'facts' => ['Purpose' => 'Staying in touch with Earth', 'Earth network' => 'NASA\'s Deep Space Network (3 stations)', 'Mars delay' => 'About 3 to 22 minutes each way', 'Relays' => 'Orbiters pass messages along'],
  'sections' => [
    ['How deep space communication works', FUT_REAL, [
      'NASA talks to distant spacecraft through the Deep Space Network: giant dish antennas at three sites, in California, Spain and Australia, spaced around the world so at least one can always see a spacecraft as Earth turns.',
      'Rovers on Mars usually send their data to orbiters passing overhead, such as the Mars Reconnaissance Orbiter, which relay it to Earth with more powerful antennas.',
    ]],
    ['The speed-of-light delay', FUT_REAL, [
      'Radio waves travel at the speed of light, but Mars is so far away that a message takes roughly 3 to 22 minutes to arrive, depending on where the planets are in their orbits. A reply takes just as long again. Live conversation is impossible; messages work more like letters.',
    ]],
    ['Building and maintaining it', FUT_WOULD, [
      'A settlement tower would hold dishes for talking to orbiters, low-power antennas for suits and rovers nearby, and perhaps lasers for very fast data. It would need to survive dust, cold and radiation, with spare antennas and automatic switching if one fails.',
    ]],
  ],
  'art' => 'This illustration shows a tall tower with antennas and dishes and glowing blue energy at its base.',
  'look' => ['Count the antennas and dishes.', 'Why might the tower be tall?'],
  'questions' => ['How would you chat with a friend on Mars if each message took 20 minutes?', 'What would happen to a settlement if communications failed?', 'Why does NASA need antennas on three continents?'],
  'words' => ['Relay' => 'Passing a message along.', 'Signal delay' => 'The time it takes for a message to arrive.', 'Bandwidth' => 'How much data can be sent at once.'],
  'sources' => ['nasa-dsn'],
  'related' => ['telepresence', 'mission-control', 'radio-telescope'],
],

'space-weather-station' => [
  'name' => 'Space weather station', 'latin' => 'solar monitoring', 'cat' => 'science', 'src' => 'art/nt_tower.png',
  'summary' => 'A tower of sensors that would watch the Sun and warn the settlement of dangerous solar storms.',
  'facts' => ['Purpose' => 'Forecasting solar storms', 'Famous storm' => 'The Carrington Event (1859)', 'Warns of' => 'Radiation and power problems', 'Real forecasters' => 'NOAA Space Weather Prediction Center'],
  'sections' => [
    ['What is space weather?', FUT_REAL, [
      'The Sun constantly sends out a stream of particles called the solar wind. Sometimes it erupts with solar flares and huge clouds of charged gas called coronal mass ejections. When these reach Earth they can cause beautiful auroras, but also disrupt satellites, radio, GPS and power grids.',
      'In 1859, a powerful solar storm, known as the Carrington Event, produced auroras seen far from the poles and caused sparks and fires on telegraph lines.',
    ]],
    ['Forecasting today', FUT_REAL, [
      'Organizations such as the US NOAA Space Weather Prediction Center use satellites that watch the Sun and measure the solar wind upstream of Earth to give warnings, from a few days to less than an hour ahead, depending on the event.',
    ]],
    ['On the Moon or Mars', FUT_WOULD, [
      'Without a protective magnetic field, a settlement would rely on warnings to send people into the storm shelter and to protect electronics. A local station would measure radiation levels and particles, and combine its readings with data from spacecraft watching the Sun.',
    ]],
  ],
  'art' => 'This illustration shows a slender tower with antennas, dishes and red warning lights.',
  'look' => ['Count the sensors and dishes on the tower.', 'Find the warning lights.'],
  'questions' => ['What would happen to a settlement if communications failed during a solar storm?', 'How could space weather affect your life on Earth?', 'Why are auroras linked to the Sun?'],
  'words' => ['Solar flare' => 'A sudden burst of energy from the Sun.', 'Coronal mass ejection' => 'A huge cloud of charged gas thrown out by the Sun.', 'Aurora' => 'Glowing lights in the sky near the poles.'],
  'sources' => ['noaa-swpc'],
  'related' => ['storm-shelter', 'comms-relay', 'radio-telescope'],
],

'telepresence' => [
  'name' => 'Hologram hall', 'latin' => 'telepresence', 'cat' => 'science', 'src' => 'art/nt_statue.png',
  'summary' => 'A place where people far apart could see each other as life-size images, and where operators could control distant robots.',
  'facts' => ['Purpose' => 'Seeing and working at a distance', 'Real use' => 'Driving Mars rovers from Earth', 'Limit' => 'The speed of light', 'Status' => 'Video calls real; holograms experimental'],
  'sections' => [
    ['Being there without going there', FUT_REAL, [
      'Telepresence means using technology to feel as if you are somewhere else. Video calls are a simple version. Engineers on Earth already operate rovers on Mars, planning each day\'s drive, and robots on the space station can be controlled from the ground.',
      'On Earth, surgeons sometimes operate remotely with robotic tools, and in 2021 NASA used "holoportation" to send a live 3D image of a flight doctor to the space station.',
    ]],
    ['The problem of distance', FUT_REAL, [
      'Because messages to Mars take minutes to arrive, nobody on Earth can drive a Mars rover in real time like a video game. Operators send a plan, the rover carries it out, and it reports back. Close to Earth, such as on the Moon, the delay is only a few seconds, so live control is easier.',
    ]],
    ['How a hologram hall would work', FUT_WOULD, [
      'Life-size 3D images would let settlers attend meetings, classes and family gatherings with people on other bases, and on the Moon even with people on Earth. Operators could use it to control robots working outside, in mines and on construction sites.',
    ]],
  ],
  'art' => 'This illustration shows a glowing blue figure on a high-tech base. Here we imagine it as a hologram for talking across space.',
  'look' => ['Look at the glowing figure. Is it a person or an image?', 'Find the projector base.'],
  'questions' => ['How would you keep in touch with family if you lived on Mars?', 'What jobs could be done from far away using robots?', 'Is talking to a hologram the same as being together?'],
  'words' => ['Telepresence' => 'Technology that makes you feel present somewhere else.', 'Hologram' => 'A 3D image made with light.', 'Latency' => 'Delay in sending and receiving signals.'],
  'sources' => ['nasa-ingenuity', 'nasa-dsn', 'nasa-holo'],
  'related' => ['comms-relay', 'robot-helpers', 'medical-bay'],
],

'robot-helpers' => [
  'name' => 'Robot monument', 'latin' => 'robots and AI in space', 'cat' => 'science', 'src' => 'art/monument.png',
  'summary' => 'A monument to the robots that went first: rovers, arms and helicopters that explore and work where people cannot yet go.',
  'facts' => ['Purpose' => 'Honouring robot explorers', 'First powered flight on another planet' => 'Ingenuity helicopter, Mars, 2021', 'Space station robots' => 'Canadarm2, Robonaut 2, Astrobee', 'Question' => 'How much should AI decide?'],
  'sections' => [
    ['Robots went first', FUT_REAL, [
      'Every place humans hope to live beyond Earth has been explored by robots first. Rovers have driven across Mars for decades, studying rocks and climate. In 2021, NASA\'s small Ingenuity helicopter made the first powered, controlled flight on another planet, and went on to fly many more times.',
      'On the International Space Station, the Canadarm2 robotic arm catches cargo ships and moves astronauts, Robonaut 2 tested a humanoid robot in space, and cube-shaped Astrobee robots float around helping with tasks.',
    ]],
    ['More independent robots', FUT_WOULD, [
      'Future robots will need to make more decisions on their own because of communication delays. Artificial intelligence could help them choose where to dig, notice broken equipment and avoid danger. Engineers must decide carefully which decisions robots can make alone and which need a human.',
    ]],
    ['Why a monument?', FUT_WOULD, [
      'People often feel fond of robot explorers: when Mars rovers finally stopped working, many people felt sad. A monument in the settlement would remember the robots that made it possible, and the engineers who built them.',
    ]],
  ],
  'art' => 'This illustration shows a large robot statue on a high-tech pedestal.',
  'look' => ['Look at the robot\'s pose and the shield.', 'Find the glowing emblem on the base.'],
  'questions' => ['What decisions should a robot be allowed to make on its own?', 'Why do people feel attached to robot explorers?', 'What job would you give a robot helper?'],
  'words' => ['Rover' => 'A vehicle that drives across another world.', 'Artificial intelligence' => 'Computer systems that can learn and make decisions.', 'Humanoid' => 'Shaped like a human.'],
  'sources' => ['nasa-ingenuity', 'nasa-robots'],
  'related' => ['robotics-factory', 'telepresence', 'rover-track'],
],

// ---------------- Travel and operations ----------------
'launch-pad' => [
  'name' => 'Launch pad', 'latin' => 'launch complex', 'cat' => 'travel', 'src' => 'art/town_2.png',
  'summary' => 'A tower and pad where rockets are prepared and launched, built to survive enormous heat, noise and force.',
  'facts' => ['Purpose' => 'Launching rockets', 'Famous pad' => 'Launch Complex 39A, Kennedy Space Center', 'Sound control' => 'Floods of water at launch', 'On the Moon' => 'Pads to stop dust blasting everywhere'],
  'sections' => [
    ['How a launch pad works', FUT_REAL, [
      'A launch pad holds a rocket upright, connects it to fuel, power and data, and lets the crew board from a tall tower. At lift-off, the engines produce extreme heat and noise. At Kennedy Space Center, systems release huge floods of water onto the pad at launch to absorb sound and heat that could otherwise damage the rocket and pad. Flame trenches direct the exhaust away.',
      'Launch Complex 39A in Florida has launched Apollo Moon missions, Space Shuttles and today\'s commercial rockets.',
    ]],
    ['Launching from the Moon or Mars', FUT_WOULD, [
      'Rockets landing and launching on the Moon blast dust and small rocks outward at high speed, which could damage nearby buildings. Settlements would need hard, flat landing pads, perhaps made by melting or binding soil, and berms (walls of soil) around them, placed well away from homes.',
    ]],
    ['Easier to leave', FUT_REAL, [
      'Escaping from the Moon takes much less energy than escaping from Earth, because the Moon\'s gravity is weaker and it has no air to push through. That is one reason people imagine the Moon as a stepping stone, with fuel made from lunar ice.',
    ]],
  ],
  'art' => 'This illustration shows a rocket beside its tall launch tower.',
  'look' => ['Look at the tower beside the rocket.', 'Where would the exhaust go at lift-off?'],
  'questions' => ['Is a launch pad a good neighbor? What trade-offs does it bring?', 'Why is it easier to launch from the Moon than from Earth?', 'How would you protect buildings from flying dust?'],
  'words' => ['Launch pad' => 'The platform a rocket lifts off from.', 'Flame trench' => 'A channel that carries rocket exhaust away.', 'Escape velocity' => 'The speed needed to break free of a world\'s gravity.'],
  'sources' => ['nasa-sls', 'nasa-artemis'],
  'related' => ['spaceport', 'mission-control', 'ice-mine'],
],

'spaceport' => [
  'name' => 'Spaceport', 'latin' => 'reusable rockets and refuelling', 'cat' => 'travel', 'src' => 'art/town_3.png',
  'summary' => 'A busy hub where reusable rockets land, are refuelled and fly again, making travel to space cheaper and more regular.',
  'facts' => ['Purpose' => 'Landing, refuelling, relaunching', 'Key step' => 'Reusable rockets', 'First orbital booster landing' => 'December 2015', 'Future idea' => 'Fuel depots in space'],
  'sections' => [
    ['Why reuse rockets?', FUT_REAL, [
      'For most of the space age, rockets were thrown away after one flight, like flying an airplane once and scrapping it. In December 2015, SpaceX landed the first stage of an orbital rocket back on Earth, and boosters have since flown many times. The Space Shuttle was also partly reusable. Reuse can make spaceflight cheaper and more frequent.',
    ]],
    ['How a spaceport would work', FUT_WOULD, [], ['list' => [
      'Landing pads where rockets touch down upright.',
      'Hangars for inspection and repair.',
      'Fuel plants and storage tanks, perhaps filled with fuel made from local ice.',
      'Passenger and cargo terminals.',
      'Control towers tracking every arrival and departure.',
    ]]],
    ['Refuelling in space', FUT_WOULD, [
      'Going far requires lots of fuel. One idea is to refuel spacecraft in orbit from tanker ships or fuel depots, like a gas station in space. Moving very cold liquid fuels between spacecraft in weightlessness is difficult and is being tested and developed.',
    ]],
  ],
  'art' => 'This illustration shows a large complex with rockets, antennas and launch towers.',
  'look' => ['Count the rockets and towers.', 'Where might passengers wait?'],
  'questions' => ['What would change if space travel became as normal as flying?', 'Why does reusing rockets matter?', 'Who should be able to travel to space?'],
  'words' => ['Reusable' => 'Able to be used more than once.', 'Booster' => 'The large first stage of a rocket.', 'Fuel depot' => 'A place to store and supply fuel.'],
  'sources' => ['falcon', 'nasa-artemis'],
  'related' => ['launch-pad', 'mission-control', 'space-elevator'],
],

'space-elevator' => [
  'name' => 'Space elevator anchor', 'latin' => 'beyond rockets', 'cat' => 'travel', 'src' => 'art/business_3.png',
  'summary' => 'The base of an imagined cable stretching into space, which climbers could ride up instead of using rockets.',
  'facts' => ['Purpose' => 'Reaching orbit without rockets', 'Needs' => 'A cable stronger than any material made in bulk', 'Easier on' => 'The Moon or Mars', 'Status' => 'A concept, not yet possible on Earth'],
  'sections' => [
    ['The idea', FUT_WOULD, [
      'A space elevator would be a cable anchored at the equator and stretching tens of thousands of kilometers up to a counterweight in space. As the planet spins, the counterweight keeps the cable tight. Electric "climbers" would ride up and down, carrying cargo and people into orbit without burning rocket fuel.',
    ]],
    ['Why it is not built yet', FUT_REAL, [
      'On Earth, the cable would need to be far stronger for its weight than any material we can make in long lengths. Carbon nanotubes and graphene are very strong in tiny samples, but making them flawlessly over tens of thousands of kilometers is far beyond today\'s technology. The cable would also need to survive lightning, storms, space debris and radiation.',
    ]],
    ['Maybe on the Moon first', FUT_WOULD, [
      'Because the Moon\'s gravity is weaker, a lunar elevator might be possible with materials that exist today, such as strong plastic fibers. Engineers have studied the idea, though it would still be a huge project. Like many great ideas, it may take a long time, or turn out to be impractical.',
    ]],
  ],
  'art' => 'This illustration shows a tall spire with glowing rings. Here we imagine it as the anchor station of a space elevator.',
  'look' => ['Find the glowing rings near the top.', 'Where would the cable start?'],
  'questions' => ['Why might a space elevator be easier to build on the Moon than on Earth?', 'What would change if getting to space were as easy as a lift ride?', 'What other "impossible" ideas later became real?'],
  'words' => ['Tether' => 'A long, strong cable.', 'Carbon nanotube' => 'A tiny tube of carbon atoms that is extremely strong.', 'Counterweight' => 'A weight that balances another.'],
  'sources' => ['elevator'],
  'related' => ['spaceport', 'launch-pad', 'centrifuge-arena'],
],

'rover-track' => [
  'name' => 'Rover test track', 'latin' => 'surface transport', 'cat' => 'travel', 'src' => 'art/fitness_2.png',
  'summary' => 'A track where crews test and train with rovers, the cars and trucks of the Moon and Mars.',
  'facts' => ['Purpose' => 'Testing and training with rovers', 'Apollo rover' => 'Lunar Roving Vehicle, 1971-1972', 'Coming next' => 'Lunar Terrain Vehicle for Artemis', 'Big challenges' => 'Dust, rocks, cold, batteries'],
  'sections' => [
    ['Driving on the Moon', FUT_REAL, [
      'On the last three Apollo missions, in 1971 and 1972, astronauts drove a folding electric car called the Lunar Roving Vehicle. It let them travel kilometers from the lander and collect far more samples. Its wire-mesh wheels coped with soft dust, and its fenders were essential: when one broke, the astronauts were showered with dust.',
      'NASA\'s Artemis program plans a new Lunar Terrain Vehicle that astronauts can drive, and that can also be driven remotely when no crew is present.',
    ]],
    ['How the track would work', FUT_WOULD, [
      'Before driving out into rough country, crews would test rovers on a track with slopes, rocks, soft sand and craters. They would practice steering in low gravity, where vehicles bounce and skid more easily, and rehearse emergencies such as a breakdown far from base.',
    ]],
    ['Pressurized rovers', FUT_WOULD, [
      'For long trips, future rovers would be pressurized, like small mobile homes, so astronauts could drive in normal clothes and only suit up to go outside. Some designs include suitports on the back.',
    ]],
  ],
  'art' => 'This illustration shows an oval track inside a high-tech arena with vehicles on it. Here we imagine it as a rover test track.',
  'look' => ['Find the vehicles on the track.', 'Where might spectators or trainers watch?'],
  'questions' => ['How would you design wheels for soft, sharp dust?', 'Why would a rover need to be able to drive itself?', 'What should every rover carry in case of emergency?'],
  'words' => ['Rover' => 'A vehicle for driving on another world.', 'Pressurized' => 'Holding air at a pressure people can breathe.', 'Traction' => 'Grip between wheels and ground.'],
  'sources' => ['nasa-lrv', 'nasa-dust'],
  'related' => ['airlock-hangar', 'robot-helpers', 'operations-center'],
],

'mission-control' => [
  'name' => 'Mission control', 'latin' => 'flight operations', 'cat' => 'travel', 'src' => 'art/business_2.png',
  'summary' => 'The control center where teams of experts watch over every spacecraft, ready to help the crew around the clock.',
  'facts' => ['Purpose' => 'Monitoring and supporting missions', 'Famous center' => 'Mission Control, Houston', 'Works' => '24 hours a day in shifts', 'Changes on Mars' => 'Crews must act on their own'],
  'sections' => [
    ['How mission control works', FUT_REAL, [
      'At NASA\'s Johnson Space Center in Houston, Mission Control has guided human spaceflights since the Gemini program in the 1960s, including the Apollo Moon landings. Each console is staffed by a specialist responsible for one system, such as power, life support or communications, and a flight director leads the team. The space station is watched over 24 hours a day.',
      'Mission Control famously helped save the crew of Apollo 13 in 1970, after an oxygen tank exploded on the way to the Moon, by working out how to use the lunar module as a lifeboat.',
    ]],
    ['Changing roles far from Earth', FUT_REAL, [
      'Near Earth, Mission Control can talk to the crew almost instantly. On Mars missions, with delays of up to about 20 minutes each way, ground teams cannot respond in an emergency in time. Crews will need to make many decisions themselves, with Mission Control acting more like a support team.',
    ]],
    ['Building and running it', FUT_WOULD, [
      'A future control center would need reliable power, backup sites in case of disaster, secure computer networks and staff who work in shifts. Simulations, where teams practice emergencies again and again, are a key part of the job.',
    ]],
  ],
  'art' => 'This illustration shows a tall tower with screens and a glowing globe. Here we imagine it as a mission control center.',
  'look' => ['Find the glowing globe display.', 'How many floors of consoles might there be?'],
  'questions' => ['What makes a team work well under pressure?', 'Why do flight controllers practice emergencies so often?', 'How should decisions be shared between a crew and Mission Control?'],
  'words' => ['Flight director' => 'The leader of a mission control team.', 'Console' => 'A workstation with screens and controls.', 'Simulation' => 'A practice exercise that imitates a real situation.'],
  'sources' => ['nasa-mcc'],
  'related' => ['operations-center', 'comms-relay', 'launch-pad'],
],

'operations-center' => [
  'name' => 'Settlement operations center', 'latin' => 'local control', 'cat' => 'travel', 'src' => 'art/town_1.png',
  'summary' => 'The local control room that runs the settlement\'s power, air, water and traffic, and takes charge in emergencies.',
  'facts' => ['Purpose' => 'Running the settlement day to day', 'Why local' => 'Earth is too far to help in real time', 'Watches' => 'Power, life support, robots, weather', 'In emergencies' => 'Coordinates the response'],
  'sections' => [
    ['Why a local control center?', FUT_WOULD, [
      'A Moon or Mars settlement would be like a small town, a factory and a spacecraft all at once. Someone must keep track of every system: power, life support, water, robots working outside, people on the surface, and incoming ships. Because Earth is minutes away by radio from Mars, this must be done locally.',
    ]],
    ['How it would work', FUT_WOULD, [], ['list' => [
      'Screens showing the status of every system in real time.',
      'Software that spots problems early and suggests fixes.',
      'Staff working in shifts, with clear roles like a mission control team.',
      'Direct links to the storm shelter, medical bay and emergency teams.',
      'A backup control room in a separate building.',
    ]]],
    ['Lessons from Earth', FUT_REAL, [
      'Remote research stations in Antarctica, offshore oil platforms and the International Space Station all rely on careful monitoring, checklists and drills. Experience shows that clear communication, well-practiced procedures and a culture where anyone can raise a safety concern are as important as technology.',
    ]],
  ],
  'art' => 'This illustration shows a large command building with a glass dome, antennas and dishes.',
  'look' => ['Find the glass dome. What might be beneath it?', 'Count the antennas and dishes.'],
  'questions' => ['What would you check first every morning in a space settlement?', 'Why should anyone be able to raise a safety concern?', 'How is your town\'s power and water monitored?'],
  'words' => ['Operations' => 'The day-to-day running of something.', 'Checklist' => 'A list of steps to follow.', 'Drill' => 'A practice of an emergency procedure.'],
  'sources' => ['nasa-hrp', 'nasa-mcc'],
  'related' => ['mission-control', 'civic-dome', 'habitat-cluster'],
],
];

$WORLD_DATA['future'] = [
  'title'    => 'Future City Explorer: 34 buildings for living on the Moon and Mars',
  'desc'     => 'Explore a speculative robotic city and how humanity might live on the Moon and Mars. Each of 34 buildings explains how it could work, the real space technology behind it, and how it would be powered, built and maintained.',
  'intro'    => 'One possible future: a settlement on the Moon or Mars. Each building explains how it could work, the real space technology that exists today, and how it would be powered, built and kept running.',
  'note'     => 'This is speculative design, not a prediction. Each page marks what is real today and what is still a possible future.',
  'aka'      => 'Topic',
  'aside'    => ['Why the Moon and Mars?', 'The Moon is about 384,000 kilometers away, a trip of about three days. Mars is much further: between about 55 and 400 million kilometers, depending on where the two planets are, and a trip takes around six to nine months. Good launch windows to Mars come only about every 26 months, so a Mars settlement would need to look after itself for a long time.'],
  'akaLang'  => '',
  'pageTitle'=> '%s: how it could work on the Moon and Mars',
  'pageDesc' => ' Learn how it could work beyond Earth, the real technology behind it, and how it would be powered, built and maintained.',
  'sourcesIntro' => 'The real-world facts on this page are based on these sources:',
  'about'    => 'Space exploration, space settlements and future technology',
  'map' => [
    'launch-pad', 'space-elevator', 'comms-relay', 'power-tower', 'space-weather-station', 'robotic-crane',
    'spaceport', 'mission-control', 'operations-center', 'radio-telescope', 'robot-helpers', 'telepresence',
    'robotics-factory', 'oxygen-factory', 'science-lab', 'medical-bay', 'civic-dome', 'tree-pod-habitat',
    'centrifuge-arena', 'rover-track', 'airlock-hangar', 'storm-shelter', 'habitat-cluster', 'lunar-base',
    'greenhouse-dome', 'gravity-gym', 'fab-shop', 'printed-habitat', 'inflatable-habitat', 'ice-mine',
    'tree', 'indoor-farm', 'water-recycler', 'public-plaza', 'building-materials', 'tree',
  ],
  'tree'     => 'light-tree',
  'sources'  => $FUTURE_SOURCES,
  'cats'     => $FUTURE_CATEGORIES,
  'pages'    => $FUTURE,
];
