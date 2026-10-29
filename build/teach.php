<?php
// Teachers & Schools: 20 guides, lessons and explainers built around the questions teachers,
// students and families search for. Each guide has a quick answer, sections, an FAQ (also
// published as FAQPage structured data), links into the building pages and plain-text sources.
//
// 'kind'  : Lesson, Project, Explainer or Guide (shown as a label)
// 'grades': suggested US grade range;  'time': classroom time;  'subjects': subject areas
// 'links' : building pages this guide uses, as 'world/slug'

// Illustrations on the Artwork page, for the free images guide.
$ART_COUNT = count(glob(__DIR__ . '/../public/assets/artwork/*/*-thumb.webp'));

$TEACH_SOURCES = [
  'brit-aqueduct' => 'Encyclopaedia Britannica, "Aqueduct"',
  'frontinus'     => 'Frontinus, The Aqueducts of Rome (about AD 97)',
  'vitruvius'     => 'Vitruvius, On Architecture (1st century BC)',
  'teachengineering' => 'TeachEngineering (University of Colorado Boulder), "Do as the Romans: Construct an Aqueduct!"',
  'sh-insula'     => 'Smarthistory, "Roman domestic architecture: the insula"',
  'sh-pantheon'   => 'Smarthistory, "The Pantheon, Rome"',
  'brit-thermae'  => 'Encyclopaedia Britannica, "Thermae"',
  'masic'         => 'Seymour, Masic and others, "Hot mixing: Mechanistic insights into the durability of ancient Roman concrete", Science Advances (2023)',
  'jackson'       => 'Jackson and others, study of Roman marine concrete, American Mineralogist (2017)',
  'cdc-water'     => 'US Centers for Disease Control and Prevention, "Water Treatment"',
  'epa-water'     => 'US Environmental Protection Agency, drinking water and wastewater overviews',
  'who-jmp'       => 'WHO/UNICEF Joint Monitoring Programme for Water Supply, Sanitation and Hygiene',
  'un-wup'        => 'United Nations, "World Urbanization Prospects: The 2018 Revision"',
  'apa'           => 'American Planning Association, "What Is Planning?" and "City by Design" resources for young people',
  'bls-planners'  => 'US Bureau of Labor Statistics, Occupational Outlook Handbook, "Urban and Regional Planners"',
  'uli'           => 'Urban Land Institute, "UrbanPlan" program for high schools',
  'pbs-e2'        => 'PBS, "e2 design" teacher guide, "Re-design your community" project',
  'nlc'           => 'National League of Cities, "Forms of Municipal Government"',
  'c3'            => 'National Council for the Social Studies, "College, Career, and Civic Life (C3) Framework"',
  'ngss'          => 'Next Generation Science Standards, MS-ETS1 Engineering Design',
  'benyus'        => 'Janine Benyus, "Biomimicry: Innovation Inspired by Nature" (1997)',
  'asknature'     => 'Biomimicry Institute, AskNature database and Youth Design Challenge',
  'epa-green'     => 'US Environmental Protection Agency, "Green Infrastructure"',
  'epa-heat'      => 'US Environmental Protection Agency, "Heat Island Effect"',
  'nasa-mars'     => 'NASA, Mars facts (atmosphere, gravity, temperature and day length)',
  'nasa-moxie'    => 'NASA Jet Propulsion Laboratory, MOXIE results (2021-2023)',
  'nasa-eclss'    => 'NASA, "Environmental Control and Life Support System" and 98% water recovery (2023)',
  'nasa-iss'      => 'NASA, "International Space Station facts and figures"',
  'nasa-veggie'   => 'NASA, "Veggie" plant growth system',
  'nasa-hrp'      => 'NASA Human Research Program, five hazards of human spaceflight',
  'nasa-chapea'   => 'NASA, Crew Health and Performance Exploration Analog (CHAPEA)',
  'cc'            => 'Creative Commons, "Recommended practices for attribution" and the CC BY 4.0 license',
  'oldenburg'     => 'Ray Oldenburg, "The Great Good Place" (1989)',
  'jacobs'        => 'Jane Jacobs, "The Death and Life of Great American Cities" (1961)',
  'ostrom'        => 'Elinor Ostrom, "Governing the Commons" (1990)',
];

$TEACH = [

// ===================== Projects and lessons =====================
'design-a-city-project' => [
  'title' => 'Design a City Project for Middle School: A Step-by-Step Guide',
  'h1' => 'Design a city: a project-based unit for grades 5 to 9',
  'desc' => 'A free, step-by-step design a city project for middle school: students plan a city that meets real needs, with roles, a timeline and a rubric.',
  'kind' => 'Project', 'grades' => '5-9', 'time' => '5 to 8 class periods', 'subjects' => 'Social studies, geography, math, civics',
  'quick' => 'Students work in teams to plan a city that provides water, homes, jobs, transportation, public spaces and room for nature. They study six example cities on this site, choose a site, draw a map, justify their choices and present to a "city council" of classmates.',
  'sections' => [
    ['Why this project works', [
      'A design a city project lets students apply geography, math, civics and science to one big question: what does a place need so that people can live well there? There is no single right answer, so students must explain trade-offs, which is where the deepest learning happens.',
      'Real planners face the same questions. Programs such as the Urban Land Institute\'s UrbanPlan for high schools and PBS\'s "Re-design your community" project show how well students respond to authentic planning challenges.',
    ]],
    ['Before you start', [], ['list' => [
      'Form teams of three or four and give each student a role: planner, engineer, environmental officer, community advocate.',
      'Give each team a large sheet of paper or a shared digital map, rulers and colored pencils.',
      'Decide the constraints: a river, a hill, a fixed budget of "building points", or a population target.',
      'Show students this site\'s six worlds as examples of very different answers to the same needs.',
    ]]],
    ['Day-by-day plan', [], ['list' => [
      'Day 1 - What does a city need? Brainstorm, then explore the Compare page: water, gathering places, safe travel and nature.',
      'Day 2 - Study an example. Each team explores one world on this site and lists five buildings and the needs they meet.',
      'Day 3 - Choose a site and draw the base map: water source, high and low ground, where flooding happens.',
      'Day 4 - Place the essentials: water supply, homes, schools, health care, food, jobs and streets. Use a scale.',
      'Day 5 - Add the good stuff: parks, public squares, libraries, places to gather. Check walking distances.',
      'Day 6 - Stress test: a heatwave, a flood, a power cut or a population boom. What changes?',
      'Day 7 - Present to the "city council" (the class). Council members ask one question each.',
      'Day 8 (optional) - Reflection: what would you change after hearing other teams?',
    ]]],
    ['Math and science connections', [
      'Use scale drawings and area: if one square is 100 meters, how much land do the homes take? Compare apartments and houses for the same number of people. Calculate walking times at about 5 kilometers per hour. Ask how many people one water tower or one school can serve.',
    ]],
    ['Assessment ideas', [], ['list' => [
      'Map (25%): clear, labeled, to scale, with a key.',
      'Needs met (25%): water, homes, food, health, learning, transportation and nature are all provided for.',
      'Reasoning (25%): each major choice is explained, including trade-offs.',
      'Fairness and access (15%): can everyone, including people who cannot drive or who use wheelchairs, reach what they need?',
      'Presentation (10%): clear, shared among the team, answers questions.',
    ]]],
  ],
  'faq' => [
    ['What grade is a design a city project best for?', 'It works well from grade 5 to grade 9. Younger students can focus on needs and maps; older students can add budgets, zoning, population growth and climate risks.'],
    ['How long does a design a city project take?', 'Plan for 5 to 8 class periods. A shorter version can fit in two periods by giving students a ready-made site and a list of buildings to place.'],
    ['Can students do this project digitally?', 'Yes. Teams can use a shared slide deck, a drawing app or even a city-building game, but paper maps make it easier to discuss and change ideas together.'],
    ['What standards does it support?', 'It supports geography, civics and economics inquiry in the C3 Framework, and engineering design practices in the Next Generation Science Standards (MS-ETS1), when students define criteria and test their designs.'],
  ],
  'links' => ['modern/streets-crosswalks', 'modern/water-system', 'modern/park-pond', 'roman/forum', 'elven/garden-court', 'future/habitat-cluster'],
  'sources' => ['uli', 'pbs-e2', 'apa', 'c3', 'ngss'],
],

'build-a-roman-aqueduct' => [
  'title' => 'Build a Model Roman Aqueduct: STEM Activity for Students',
  'h1' => 'Build a model Roman aqueduct: a hands-on STEM activity',
  'desc' => 'How to build a working model Roman aqueduct in class with simple materials: the challenge, materials, steps, the science of slope and gravity, and questions.',
  'kind' => 'Project', 'grades' => '4-8', 'time' => '2 to 3 class periods', 'subjects' => 'Science, engineering, history, math',
  'quick' => 'Teams build a channel from cardboard, tape and plastic that carries water from a high "spring" to a cup in the "city" using only gravity. The challenge is to keep a gentle, steady slope across a gap, just as Roman engineers did.',
  'sections' => [
    ['The challenge', [
      'Your city is on the other side of a valley. Using only gravity, carry one cup of water from the spring to the city, without losing more than a quarter of it. The channel must cross a gap of at least 30 centimeters (about a foot) on supports.',
    ]],
    ['Materials for each team', [], ['list' => [
      'Cardboard tubes, card or foam board, and paper cups',
      'Plastic wrap or foil to waterproof the channel',
      'Masking tape, scissors and rulers',
      'Books or boxes to build different heights',
      'A measuring cup, a tray to catch spills and water',
    ]]],
    ['Steps', [], ['list' => [
      'Plan: sketch the route, mark the start height and end height, and decide where supports go.',
      'Build the channel: fold card into a U-shape and line it with plastic wrap.',
      'Build supports: stack books or make cardboard arches to hold the channel across the gap.',
      'Set the slope: lower the channel a little at each support. Too steep and water splashes out; too flat and it stops.',
      'Test: pour exactly one cup into the spring end and measure how much reaches the city.',
      'Improve: change one thing at a time and test again. Record every result.',
    ]]],
    ['The real science: a gentle slope', [
      'Roman aqueducts worked by gravity alone. Engineers surveyed the land and kept a very slight, steady downhill slope (the gradient). The aqueduct that carried water about 50 kilometers to the Roman city of Nîmes, including the famous Pont du Gard bridge, drops only around 12 meters along its whole length.',
      'Most of a Roman aqueduct ran underground. Arches were used only where the channel had to cross a valley while keeping its slope. Students can calculate the gradient of their model: the drop in height divided by the length of the channel.',
    ]],
    ['Discussion questions', [], ['list' => [
      'Why did the Romans keep most aqueducts underground?',
      'What happened when your slope was too steep, or too flat?',
      'How does your city get its water today, and does it use pumps, gravity or both?',
      'Why might arches be a strong shape for carrying a heavy channel?',
    ]]],
  ],
  'faq' => [
    ['How did Roman aqueducts move water without pumps?', 'They used gravity. The channel sloped very gently downhill all the way from the source to the city, so water flowed on its own.'],
    ['What materials do you need to build a model aqueduct?', 'Cardboard or card, plastic wrap or foil to waterproof it, tape, cups, books or boxes for supports, and water. A tray underneath keeps the classroom dry.'],
    ['What is a good gradient for a model aqueduct?', 'Start with a drop of about 1 centimeter for every 30 centimeters of channel and adjust. Students will discover that a gentle slope gives a steadier flow than a steep one.'],
    ['Which real aqueduct can students study?', 'The Pont du Gard in France and the aqueduct of Segovia in Spain are famous survivors. See the Aqueduct page on this site for photos.'],
  ],
  'links' => ['roman/aqueduct', 'roman/public-fountain', 'roman/building-materials', 'modern/water-system', 'elven/spring-circle', 'future/water-recycler'],
  'sources' => ['teachengineering', 'brit-aqueduct', 'frontinus', 'ngss'],
],

'roman-engineering-lesson' => [
  'title' => 'Roman Engineering Lesson: Arches, Concrete, Roads and Domes',
  'h1' => 'Roman engineering: arches, concrete, roads and domes',
  'desc' => 'A ready-to-teach lesson on Roman engineering: how arches, concrete, roads, domes and cranes worked, with activities and discussion questions.',
  'kind' => 'Lesson', 'grades' => '6-10', 'time' => '1 to 2 class periods', 'subjects' => 'History, engineering, physics',
  'quick' => 'Roman engineers combined the arch, a strong concrete made with volcanic ash, careful surveying and human-powered cranes to build aqueducts, roads, domes and amphitheaters, many of which still stand nearly 2,000 years later.',
  'sections' => [
    ['Lesson goal', [
      'Students explain how four Roman engineering ideas worked, and why some Roman structures have lasted so long.',
    ]],
    ['1. The arch', [
      'An arch carries weight around its curve and down into its supports, pushing the stones together instead of pulling them apart. Stone is very strong when squeezed, so arches let Romans span gaps for bridges, aqueducts and the outer walls of the Colosseum. The central wedge-shaped stone at the top is the keystone.',
    ]],
    ['2. Roman concrete', [
      'Roman concrete was made with lime, water, volcanic ash called pozzolana, and chunks of stone or brick. It could be poured into molds to make walls, vaults and domes. The Pantheon\'s dome, about 43 meters across, is made of it and is still one of the largest unreinforced concrete domes in the world.',
      'Scientists are still studying why it lasts. A 2023 study suggested that small lumps of lime in the mix may help cracks seal themselves when water seeps in.',
    ]],
    ['3. Roads and surveying', [
      'Roman roads were built in layers, from coarse stone at the bottom to fitted paving stones on top, with a curved surface so rain drained off. Surveyors used tools such as the groma to lay out straight lines. The Via Appia, begun in 312 BC, can still be walked today.',
    ]],
    ['4. Cranes and lifting', [
      'The architect Vitruvius described cranes using pulleys and a large treadwheel that workers walked inside. Pulleys trade distance for force, so a few people could lift heavy stone blocks.',
    ]],
    ['Activity: test the arch', [
      'Give pairs a strip of card. First lay it flat across two books and add coins until it sags. Then curve it into an arch between the books, held in place at the ends, and add coins again. Which holds more, and why?',
    ]],
  ],
  'faq' => [
    ['Why do Roman buildings last so long?', 'Good design, durable materials and careful building. Arches keep stone in compression, and Roman concrete is very durable; researchers think lime lumps in the mix may help it heal small cracks.'],
    ['What is Roman concrete made of?', 'Lime, water, volcanic ash (pozzolana) and chunks of rock or broken brick. Some mixes even set underwater, which helped in building harbors.'],
    ['Did the Romans invent the arch?', 'No. Earlier peoples built arches, but the Romans used them on a huge scale in bridges, aqueducts and buildings, often together with concrete.'],
  ],
  'links' => ['roman/aqueduct', 'roman/pantheon', 'roman/amphitheater', 'roman/crane', 'roman/building-materials', 'roman/inn'],
  'sources' => ['sh-pantheon', 'masic', 'jackson', 'vitruvius', 'brit-aqueduct'],
],

'daily-life-in-ancient-rome' => [
  'title' => 'Daily Life in Ancient Rome: Homes, Food, Water and Baths',
  'h1' => 'What was daily life like in ancient Rome?',
  'desc' => 'Daily life for ordinary people in ancient Rome: apartment homes, street food, water from fountains, public toilets and baths, with classroom questions.',
  'kind' => 'Explainer', 'grades' => '5-12', 'time' => '20-minute read', 'subjects' => 'History',
  'quick' => 'Most people in the city of Rome rented rooms in crowded apartment blocks called insulae. They fetched water from street fountains, bought ready-made food from snack bars, used shared public toilets, and went to the public baths to wash and meet friends.',
  'sections' => [
    ['Where people lived', [
      'Wealthy families lived in a domus, a private house built around open courtyards. Most people lived in insulae: apartment blocks several stories high with shops on the ground floor. The best apartments were on the lower floors. Upper floors were cheaper, smaller, hotter and more dangerous, especially because of fire.',
    ]],
    ['Water and toilets', [
      'Aqueducts brought fresh water into the city, but only wealthy homes had it piped in. Everyone else filled jars at public fountains on street corners. Many people used public latrines: long stone benches with holes, shared by many people at once, with water flowing beneath to carry waste away. Well-preserved latrines can still be seen at Ostia and Pompeii.',
    ]],
    ['Food', [
      'Many apartment dwellers had no kitchen, and cooking fires upstairs were dangerous, so people bought hot food from snack bars called thermopolia, which had counters with built-in jars. Bread, porridge, beans, lentils, olives, cheese and fish sauce were everyday foods. For long periods, the government handed out free or cheap grain to many citizens.',
    ]],
    ['The baths', [
      'Going to the public baths was part of almost every Roman\'s day. Entry was cheap. Bathers moved through warm, hot and cold rooms, scraped oil off their skin with a curved tool called a strigil, exercised, met friends and did business.',
    ]],
    ['Questions for students', [], ['list' => [
      'Which part of Roman daily life would you find hardest? Why?',
      'Why were the best Roman apartments on the lower floors, when today the top floors are often the most expensive?',
      'What modern places do the same jobs as the Roman baths?',
    ]]],
  ],
  'faq' => [
    ['Did Romans have toilets?', 'Yes. Wealthy homes sometimes had private latrines, and cities had public latrines with shared seating, flushed by running water from the aqueducts.'],
    ['Did ancient Romans live in apartments?', 'Yes. Most people in Rome rented rooms in apartment blocks called insulae, which were several stories high with shops on the ground floor.'],
    ['What did ordinary Romans eat?', 'Mostly bread, porridge, beans, lentils, vegetables, olives and cheese, with fish sauce for flavor. Many bought ready-made food from street snack bars.'],
  ],
  'links' => ['roman/apartment-block', 'roman/domus', 'roman/street-food', 'roman/public-baths', 'roman/public-fountain', 'roman/shop'],
  'sources' => ['sh-insula', 'brit-thermae', 'frontinus'],
],

'how-did-roman-aqueducts-work' => [
  'title' => 'How Did Roman Aqueducts Work? Explained for Students',
  'h1' => 'How did Roman aqueducts work?',
  'desc' => 'How Roman aqueducts carried water for kilometers using only gravity: the gentle slope, underground channels, arches, settling tanks and city pipes.',
  'kind' => 'Explainer', 'grades' => '4-12', 'time' => '10-minute read', 'subjects' => 'History, science',
  'quick' => 'Roman aqueducts used gravity. Engineers built a channel that sloped very gently downhill from a spring or river in the hills to the city. Most of it ran underground; arches carried it across valleys. In the city, the water was split into pipes for fountains, baths and some homes.',
  'sections' => [
    ['Step by step', [], ['list' => [
      'Find a source: a spring, river or lake higher than the city.',
      'Survey the route so that it slopes downhill all the way, following the land\'s contours.',
      'Dig a covered channel, lined with waterproof mortar, mostly below ground.',
      'Cross valleys on arched bridges and tunnel through hills, keeping the slope.',
      'Let mud settle out in tanks along the way.',
      'Divide the water in a distribution building (castellum) into pipes for fountains, baths and paying customers.',
    ]]],
    ['How gentle was the slope?', [
      'Very gentle. The aqueduct to Nîmes in France, which crosses the Pont du Gard, runs for about 50 kilometers but drops only around 12 meters in total. Keeping such a precise slope over long distances was a remarkable feat of surveying.',
    ]],
    ['How many aqueducts did Rome have?', [
      'The first, the Aqua Appia, was built in 312 BC. By the 3rd century AD, the city of Rome was served by eleven major aqueducts. Around AD 97, the water commissioner Frontinus wrote a book describing how they were run and the problems of leaks and water theft.',
    ]],
  ],
  'faq' => [
    ['Did Roman aqueducts use pumps?', 'No. They relied on gravity and a carefully planned downhill slope.'],
    ['Why were most aqueducts underground?', 'An underground channel kept the water clean and cool, protected it from enemies and was cheaper than building arches.'],
    ['Are any Roman aqueducts still standing?', 'Yes. The Pont du Gard in France and the aqueduct of Segovia in Spain are among the best preserved, and parts of Rome\'s aqueducts survive in the Park of the Aqueducts.'],
  ],
  'links' => ['roman/aqueduct', 'roman/public-fountain', 'roman/public-baths', 'modern/water-system'],
  'sources' => ['brit-aqueduct', 'frontinus', 'vitruvius'],
],

'ancient-rome-vs-modern-cities' => [
  'title' => 'Ancient Rome vs Modern Cities: A Compare and Contrast Lesson',
  'h1' => 'Ancient Rome vs modern cities: compare and contrast',
  'desc' => 'A compare and contrast lesson on ancient Rome and modern cities: water, homes, transport, government and fun, with a comparison chart and questions.',
  'kind' => 'Lesson', 'grades' => '6-12', 'time' => '1 class period', 'subjects' => 'History, civics, geography',
  'quick' => 'Ancient Rome and modern cities solve many of the same problems: bringing in water, housing crowds, moving people and goods, governing and entertaining. Comparing them shows what has changed, mostly technology, and what has not: people\'s basic needs.',
  'sections' => [
    ['Comparison chart', [], ['list' => [
      'Water: Roman aqueducts and street fountains / modern treatment plants, pipes and taps.',
      'Housing: insulae apartment blocks / apartment buildings and towers.',
      'Entertainment: amphitheater and chariot racetrack / stadiums.',
      'Government: the Senate house and basilica law courts / city hall, capitol and courthouses.',
      'Shopping: one-room street shops and snack bars / corner stores and restaurants.',
      'Getting around: walking, carts and paved roads / sidewalks, buses, cars and bikes.',
    ]]],
    ['How to run the lesson', [], ['list' => [
      'Pairs choose one row of the chart.',
      'They read the matching Roman and modern building pages on this site (linked below).',
      'Each pair lists two similarities and two differences, with evidence.',
      'The class builds a big Venn diagram together.',
      'Close with: "What problem did Rome solve better than we do?"',
    ]]],
    ['Things students often notice', [
      'Rome had no public school system and most people could not vote, while modern cities have public schools and wider voting rights. Roman apartments had the best rooms at the bottom; modern towers often charge the most for the top. Both cities struggled with fire, traffic and crowded housing.',
    ]],
  ],
  'faq' => [
    ['How was ancient Rome like a modern city?', 'It had apartment blocks, street shops, fast food counters, public baths, paved roads, a water supply system, entertainment venues and crowded housing problems.'],
    ['How was ancient Rome different from modern cities?', 'It had no electricity, engines or public schools, enslaved people did much of the work, and most residents had little say in government.'],
  ],
  'links' => ['roman/apartment-block', 'modern/apartment-building', 'roman/amphitheater', 'modern/stadium', 'roman/curia', 'modern/town-hall'],
  'sources' => ['sh-insula', 'brit-aqueduct', 'c3'],
],

// ===================== Cities today =====================
'how-do-cities-get-clean-water' => [
  'title' => 'How Do Cities Get Clean Water? Water Treatment Explained',
  'h1' => 'How do cities get clean water?',
  'desc' => 'How a city turns river or groundwater into safe tap water: coagulation, settling, filtration and disinfection, then water towers, pipes and drains.',
  'kind' => 'Explainer', 'grades' => '4-12', 'time' => '10-minute read', 'subjects' => 'Science, health, geography',
  'quick' => 'Cities take water from rivers, lakes, reservoirs or underground aquifers, clean it in a treatment plant (coagulation, settling, filtering and disinfecting), store it in tanks and water towers, and push it through pipes under the streets to every tap.',
  'sections' => [
    ['The four main treatment steps', [], ['list' => [
      'Coagulation and flocculation: chemicals make tiny particles stick together into clumps called floc.',
      'Sedimentation: the heavy floc sinks to the bottom of big tanks.',
      'Filtration: water passes through layers of sand, gravel and charcoal, or fine membranes.',
      'Disinfection: chlorine, ultraviolet light or ozone kills remaining germs.',
    ]]],
    ['Why water towers?', [
      'A water tower stores treated water high up. Gravity creates pressure in the pipes below, so water flows out of taps even when pumps are off. Towers also provide a reserve for busy times and firefighting.',
    ]],
    ['After the drain', [
      'Used water flows through sewers to a wastewater treatment plant, where solids are removed and bacteria break down waste before the cleaned water is returned to a river or reused.',
    ]],
    ['Classroom activity: make a simple filter', [
      'Layer gravel, sand and cotton in a cut plastic bottle and pour muddy water through it. The water comes out clearer, but explain clearly that it is NOT safe to drink, because filtering alone does not kill germs. That is why the disinfection step matters.',
    ]],
  ],
  'faq' => [
    ['Where does tap water come from?', 'From rivers, lakes, reservoirs or groundwater (aquifers), depending on the city. Your local water supplier publishes where yours comes from.'],
    ['Why is chlorine added to drinking water?', 'Chlorine kills harmful germs and keeps the water safe as it travels through pipes.'],
    ['Does everyone in the world have clean water?', 'No. The WHO and UNICEF report that billions of people still lack safely managed drinking water at home.'],
  ],
  'links' => ['modern/water-system', 'roman/aqueduct', 'elven/crystal-fountain', 'future/water-recycler'],
  'sources' => ['cdc-water', 'epa-water', 'who-jmp'],
],

'what-does-a-city-need' => [
  'title' => 'What Does a City Need? Infrastructure Explained for Students',
  'h1' => 'What does a city need to work?',
  'desc' => 'The essential systems every city needs, explained simply: water, energy, transport, housing, food, health, schools, government and public space.',
  'kind' => 'Explainer', 'grades' => '3-9', 'time' => '1 class period', 'subjects' => 'Social studies, science',
  'quick' => 'Every city needs clean water and sewers, energy, ways to move people and goods, homes, food, health care, schools, safety services, a way to make decisions, and public spaces. Most of these systems, called infrastructure, are hidden until they stop working.',
  'sections' => [
    ['The essentials', [], ['list' => [
      'Water in, waste out: treatment plants, pipes and sewers.',
      'Energy: electricity and heat for homes, schools and hospitals.',
      'Transportation: streets, sidewalks, bike lanes, buses and trains.',
      'Homes: for people of every income and household size.',
      'Food: shops, markets and the trucks and warehouses that supply them.',
      'Health and safety: clinics, hospitals, fire and police services.',
      'Learning: schools and libraries.',
      'Decisions: local government, laws and a way for residents to be heard.',
      'Public space: parks and squares where people meet.',
    ]]],
    ['Sorting activity', [
      'Print the list of buildings from one world on this site. In groups, students sort each building into the categories above. Some fit in more than one; let them argue it out. Then ask: which category has the fewest buildings? What would happen if it disappeared?',
    ]],
    ['The same needs, every era', [
      'Ancient Rome, a modern town, an imagined green city and a settlement on Mars all need the same basics. Only the technology changes. On Mars, even air must be made and recycled.',
    ]],
  ],
  'faq' => [
    ['What is infrastructure?', 'The basic systems a community needs to function, such as roads, water pipes, power lines and communication networks.'],
    ['What is the most important thing a city needs?', 'Clean water is often called the most essential, because without it disease spreads quickly. But a city needs all its systems working together.'],
  ],
  'links' => ['modern/water-system', 'modern/streets-crosswalks', 'modern/health-clinic', 'modern/town-hall', 'future/habitat-cluster', 'roman/forum'],
  'sources' => ['un-wup', 'cdc-water', 'apa'],
],

'urban-planning-for-students' => [
  'title' => 'Urban Planning for Students: What Planners Do and How to Start',
  'h1' => 'Urban planning for students',
  'desc' => 'What urban planning is, what city planners do, the big ideas behind good neighborhoods, and planning as a career, with free classroom resources.',
  'kind' => 'Guide', 'grades' => '7-12', 'time' => '15-minute read', 'subjects' => 'Geography, civics, careers',
  'quick' => 'Urban planners help communities decide how land is used: where homes, shops, parks, roads and transit should go, and how to grow fairly and safely. They gather data, listen to residents and write plans that elected leaders vote on.',
  'sections' => [
    ['What planners actually do', [], ['list' => [
      'Study data on population, traffic, housing and the environment.',
      'Hold public meetings so residents can share ideas and concerns.',
      'Write long-range plans and zoning rules.',
      'Review proposals for new buildings.',
      'Work with engineers, architects, environmental scientists and elected officials.',
    ]]],
    ['Big ideas in planning', [], ['list' => [
      'Mixed use: homes, shops and jobs close together so people can walk.',
      '"Eyes on the street": Jane Jacobs\'s idea that busy, watched streets feel safer.',
      'Complete streets: designed for walking, cycling, buses and cars, not cars alone.',
      'Third places: everyday gathering spots such as libraries, cafes and parks.',
      'Green infrastructure: using trees, parks and rain gardens to handle heat and storms.',
      'Equity: making sure every neighborhood has parks, transit, clean air and services.',
    ]]],
    ['Becoming a planner', [
      'Most planners have a master\'s degree in urban or regional planning, often after studying geography, economics, environmental science or architecture. The US Bureau of Labor Statistics describes the job and its outlook. Students can start now: attend a city council meeting, volunteer on a local plan, or join a program such as UrbanPlan or the American Planning Association\'s resources for young people.',
    ]],
  ],
  'faq' => [
    ['What does an urban planner do?', 'Urban planners help communities plan how land is used and how they grow, by studying data, listening to residents and writing plans and rules that elected leaders approve.'],
    ['What should I study to become an urban planner?', 'Geography, economics, environmental science, architecture or public policy are common starting points, usually followed by a master\'s degree in planning.'],
    ['How can students learn about urban planning?', 'Attend a public planning meeting, map your neighborhood, try a design a city project, or explore programs from the American Planning Association and the Urban Land Institute.'],
  ],
  'links' => ['modern/mixed-use-building', 'modern/streets-crosswalks', 'modern/park-pond', 'modern/town-hall', 'modern/suburban-house', 'modern/community-center'],
  'sources' => ['apa', 'bls-planners', 'uli', 'jacobs', 'oldenburg', 'epa-green'],
],

'how-local-government-works' => [
  'title' => 'How Local Government Works: A Civics Lesson for Students',
  'h1' => 'How does local government work?',
  'desc' => 'A civics lesson on how local government works: mayors, councils and city managers, what they decide, and how students can take part.',
  'kind' => 'Lesson', 'grades' => '5-12', 'time' => '1 class period', 'subjects' => 'Civics, government',
  'quick' => 'Most towns are run by an elected council, often with a mayor. Councils pass local laws and budgets for things like parks, libraries, streets, trash collection and planning. Meetings are usually public, and residents can speak.',
  'sections' => [
    ['Two common forms', [
      'In a mayor-council system, voters elect a mayor who runs the city\'s day-to-day work and a council that makes laws. In a council-manager system, the elected council hires a professional city manager to run services.',
    ]],
    ['What local government decides', [], ['list' => [
      'Budgets and local taxes',
      'Streets, sidewalks and traffic safety',
      'Parks, libraries and community centers',
      'Trash, recycling and often water and sewer service',
      'Zoning: what can be built where',
      'Often police, fire and emergency services',
    ]]],
    ['Simulation: a council meeting', [
      'Choose a real local question, such as "Should a parking lot become a park?" Assign roles: mayor, council members, residents for and against, a city planner and a reporter. Hold a 20-minute meeting with public comment, then a vote. Debrief: who was heard, who was missing, and what evidence changed minds?',
    ]],
    ['How students can take part', [
      'Students can attend or watch council meetings, speak during public comment, write to council members, join youth councils, or present a class project, as some middle school classes have done with their city councils.',
    ]],
  ],
  'faq' => [
    ['What does a city council do?', 'A city council passes local laws, approves the budget and makes decisions about local services such as streets, parks, libraries and zoning.'],
    ['Can students speak at a city council meeting?', 'In most places, yes. Many councils have a public comment period open to any resident, including young people.'],
  ],
  'links' => ['modern/town-hall', 'modern/capitol', 'roman/curia', 'elven/council-terrace', 'future/civic-dome'],
  'sources' => ['nlc', 'c3', 'ostrom'],
],

// ===================== Sustainability and nature =====================
'sustainable-city-project-ideas' => [
  'title' => 'Sustainable City Project Ideas for Students (Grades 5-12)',
  'h1' => 'Sustainable city project ideas for students',
  'desc' => '12 sustainable city project ideas for students, from rain gardens and green roofs to heat maps and tiny forests, with the real science behind each.',
  'kind' => 'Project', 'grades' => '5-12', 'time' => '1 to 4 weeks', 'subjects' => 'Environmental science, geography, engineering',
  'quick' => 'Strong sustainable city projects pick one real local problem, such as heat, flooding, waste or traffic, research how nature or design could help, then build a model, map or proposal and test or present it.',
  'sections' => [
    ['12 project ideas', [], ['list' => [
      'Map the hottest and coolest spots around school with a thermometer and suggest where trees would help most.',
      'Design a rain garden for a corner of the schoolyard that floods.',
      'Build two model roofs, one plain and one planted, and compare their temperatures under a lamp.',
      'Plan a "tiny forest" of native trees for an unused patch of land.',
      'Audit the school\'s food waste for a week and design a composting plan.',
      'Design a safer route to school with crosswalks, bike lanes and lower speeds.',
      'Create a pollinator meadow plan with native flowers that bloom from spring to fall.',
      'Compare the energy use of LED and older bulbs and calculate savings.',
      'Design a repair cafe for the community.',
      'Study a real green building and present how it saves energy.',
      'Propose a wildlife crossing where animals are hit on a local road.',
      'Write a "future generations" test for a local decision: who benefits in 50 years?',
    ]]],
    ['How to make it strong', [
      'Use real data, show a before and after, explain trade-offs (cost, space, maintenance) and present to someone who can act: the principal, a parent group or the city council.',
    ]],
  ],
  'faq' => [
    ['What is a sustainable city?', 'A city that meets people\'s needs today without making it harder for future generations to meet theirs, by using less energy and water, cutting waste and pollution, and protecting nature.'],
    ['What is an easy sustainable project for middle school?', 'Comparing temperatures of a plain and a planted model roof, or mapping hot spots around school, needs simple materials and gives clear results.'],
  ],
  'links' => ['elven/garden-court', 'elven/green-roof-cottage', 'elven/wild-grove', 'elven/flower-meadow', 'elven/stag-monument', 'modern/park-pond'],
  'sources' => ['epa-green', 'epa-heat', 'asknature'],
],

'biomimicry-examples-for-students' => [
  'title' => 'Biomimicry Examples for Students: Inventions Copied from Nature',
  'h1' => 'Biomimicry examples for students',
  'desc' => 'Biomimicry examples for students: Velcro, the lotus effect, the kingfisher bullet train, termite-inspired cooling and more, plus a design challenge.',
  'kind' => 'Explainer', 'grades' => '4-12', 'time' => '1 class period', 'subjects' => 'Science, engineering, design',
  'quick' => 'Biomimicry means solving human problems by learning from nature. Famous examples include Velcro (copied from burrs), self-cleaning surfaces (from lotus leaves), Japan\'s quieter bullet train (from a kingfisher\'s beak) and naturally ventilated buildings (inspired by termite mounds).',
  'sections' => [
    ['Famous examples', [], ['list' => [
      'Velcro: engineer George de Mestral studied the tiny hooks on burrs that stuck to his dog\'s fur.',
      'Lotus effect: tiny bumps on lotus leaves make water roll off, carrying dirt; this inspired self-cleaning paints and glass.',
      'Kingfisher bullet train: Japanese engineers reshaped the Shinkansen\'s nose like a kingfisher\'s beak to make it quieter leaving tunnels.',
      'Termite-inspired building: the Eastgate Centre in Zimbabwe uses chimneys and heavy materials for natural cooling.',
      'Living root bridges: in Meghalaya, India, people guide fig tree roots into bridges that grow stronger with age.',
    ]]],
    ['Classroom design challenge', [], ['list' => [
      'Pick a problem: staying cool, keeping clean, saving water, moving quietly.',
      'Ask "How does nature do this?" and research one plant or animal that solves it.',
      'Sketch an invention or building feature based on it.',
      'Build a simple model and test it.',
      'Present: the problem, the organism, the design and the test results.',
    ]]],
  ],
  'faq' => [
    ['What is biomimicry in simple words?', 'Copying good ideas from plants and animals to solve human problems.'],
    ['What is the most famous example of biomimicry?', 'Velcro is probably the best known. It was inspired by burrs that stuck to a dog\'s fur.'],
  ],
  'links' => ['elven/building-materials', 'elven/spire-house', 'elven/great-tree-hall', 'elven/mushroom-cottage', 'elven/crystal-tower'],
  'sources' => ['benyus', 'asknature'],
],

'solarpunk-explained' => [
  'title' => 'What Is Solarpunk? A Hopeful Future City Explained for Teens',
  'h1' => 'What is solarpunk?',
  'desc' => 'Solarpunk explained: the hopeful movement that imagines green, fair future cities, with the real technologies behind it and creative prompts.',
  'kind' => 'Explainer', 'grades' => '7-12', 'time' => '10-minute read', 'subjects' => 'English, art, environmental science',
  'quick' => 'Solarpunk is an art, writing and design movement that imagines a hopeful future where cities run on clean energy, are full of plants and are shaped by their communities. It mixes real green technology with imagination and asks: what future do we want to build?',
  'sections' => [
    ['Where it came from', [
      'Solarpunk grew online in the 2010s as a reaction to gloomy science fiction full of ruined, polluted cities. Artists and writers began imagining futures where people solved problems together.',
    ]],
    ['Real technologies in solarpunk worlds', [], ['list' => [
      'Solar panels, wind and geothermal energy.',
      'Green roofs, living walls and vertical forests.',
      'Rain gardens and wetlands that clean water.',
      'Repair cafes, community gardens and shared tools.',
      'Walkable, bike-friendly streets and public transit.',
    ]]],
    ['Creative prompts for class', [], ['list' => [
      'Write a day in the life of a teenager in your town in 2075, solarpunk style.',
      'Redesign one street near school as a solarpunk street. Label every feature.',
      'Pick one building from the Elven world on this site and write how it could work in a real city.',
      'Debate: is solarpunk realistic, or just a nice dream? What would it take?',
    ]]],
  ],
  'faq' => [
    ['What does solarpunk mean?', 'A genre and movement that imagines a sustainable, community-focused future powered by clean energy and filled with nature.'],
    ['Is solarpunk real?', 'It is imaginative, but many of its ideas, such as green roofs, solar power and community gardens, already exist today.'],
  ],
  'links' => ['elven/tree-tower-home', 'elven/canopy-market', 'elven/woodworking-workshop', 'elven/crystal-waterfall', 'elven/elven-palace'],
  'sources' => ['epa-green', 'benyus'],
],

// ===================== Space =====================
'how-could-humans-live-on-mars' => [
  'title' => 'How Could Humans Live on Mars? Air, Water, Food and Shelter',
  'h1' => 'How could humans live on Mars?',
  'desc' => 'How humans could survive on Mars: making oxygen, finding water ice, growing food, shielding from radiation and building homes, with real NASA technology.',
  'kind' => 'Explainer', 'grades' => '5-12', 'time' => '15-minute read', 'subjects' => 'Science, engineering',
  'quick' => 'To live on Mars, people would need sealed, pressurized homes shielded from radiation, oxygen made from the carbon dioxide air or from water, water mined from ice, food grown indoors under lights, and reliable power. NASA has already made oxygen on Mars with an experiment called MOXIE.',
  'sections' => [
    ['Why Mars is hard', [], ['list' => [
      'The air is about 95% carbon dioxide and less than 1% as thick as Earth\'s.',
      'Average temperatures are around minus 60 degrees Celsius.',
      'No global magnetic field and a thin atmosphere mean much more radiation.',
      'Gravity is about 38% of Earth\'s.',
      'Messages take about 3 to 22 minutes to reach Earth, and a trip takes months.',
    ]]],
    ['Solving the basics', [], ['list' => [
      'Oxygen: NASA\'s MOXIE split carbon dioxide into oxygen on Mars, making 122 grams in total between 2021 and 2023.',
      'Water: ice exists on Mars and could be mined, melted and cleaned, then recycled again and again as on the space station.',
      'Food: plants grown indoors under LED lights, as in NASA\'s Veggie system.',
      'Shelter: homes covered with Martian soil or built underground to block radiation; 3D-printed habitats are being tested on Earth.',
      'Power: solar panels plus small nuclear reactors for dust storms and night.',
    ]]],
    ['Practice on Earth', [
      'NASA\'s CHAPEA mission had four volunteers live for 378 days (2023 to 2024) inside a 3D-printed Mars habitat in Houston, to study health and teamwork on long missions.',
    ]],
  ],
  'faq' => [
    ['Can humans breathe on Mars?', 'No. The air is mostly carbon dioxide and very thin. People would need spacesuits outside and sealed, pressurized homes.'],
    ['How long does it take to get to Mars?', 'Around six to nine months with current rockets, and good launch windows come about every 26 months.'],
    ['Is there water on Mars?', 'Yes, mostly as ice in the ground and at the poles. Settlers would need to mine and clean it.'],
  ],
  'links' => ['future/oxygen-factory', 'future/ice-mine', 'future/indoor-farm', 'future/printed-habitat', 'future/storm-shelter', 'future/power-tower'],
  'sources' => ['nasa-mars', 'nasa-moxie', 'nasa-eclss', 'nasa-veggie', 'nasa-chapea', 'nasa-hrp'],
],

'design-a-mars-colony-project' => [
  'title' => 'Design a Mars Colony Project for Students: Guide and Rubric',
  'h1' => 'Design a Mars colony: a student project',
  'desc' => 'A complete design a Mars colony project for students: mission brief, team roles, the needs to solve, steps, a rubric and real NASA technology to research.',
  'kind' => 'Project', 'grades' => '5-12', 'time' => '4 to 6 class periods', 'subjects' => 'Science, engineering, math, writing',
  'quick' => 'Teams design a settlement for 20 people on Mars that provides air, water, food, power, shelter, health and community. They must explain the technology for each, how it is built and maintained, and what happens if something fails.',
  'sections' => [
    ['Mission brief', [
      'Your team must plan a settlement for 20 people to live on Mars for two years. Supplies from Earth arrive only every 26 months. Choose a landing site, plan the buildings and systems, and convince "mission control" (the class) that your colony is safe.',
    ]],
    ['Team roles', [], ['list' => [
      'Life support engineer: air and water.',
      'Agriculture lead: food.',
      'Power and construction lead: energy and buildings.',
      'Health and community officer: medicine, exercise, wellbeing and rules.',
    ]]],
    ['Steps', [], ['list' => [
      'Research Mars conditions: air, temperature, gravity, radiation, dust storms.',
      'Choose a site and justify it (near ice? sunny? sheltered?).',
      'Design each system and name the real technology behind it.',
      'Draw a labeled map or build a model.',
      'Write a failure plan: what happens if the power fails, or a dust storm lasts a month?',
      'Present to mission control and answer questions.',
    ]]],
    ['Rubric', [], ['list' => [
      'Science accuracy (30%): real Mars conditions and real technology.',
      'Completeness (25%): all needs met, with backups.',
      'Creativity (15%): smart, original solutions.',
      'Community (15%): health, fairness, decision-making and wellbeing.',
      'Presentation (15%): clear, organized, answers questions.',
    ]]],
  ],
  'faq' => [
    ['What do you need for a Mars colony?', 'Pressurized shelter with radiation shielding, oxygen, water, food, power, medical care, exercise, communication with Earth and a plan for emergencies.'],
    ['How do I make my Mars colony project realistic?', 'Use real conditions and real technology such as MOXIE, water recycling, indoor farming and nuclear power, and include backups for every life-critical system.'],
  ],
  'links' => ['future/habitat-cluster', 'future/lunar-base', 'future/greenhouse-dome', 'future/medical-bay', 'future/civic-dome', 'future/public-plaza'],
  'sources' => ['nasa-mars', 'nasa-moxie', 'nasa-eclss', 'nasa-hrp', 'ngss'],
],

'life-on-the-space-station' => [
  'title' => 'How Do Astronauts Live on the ISS? Air, Water, Food and Exercise',
  'h1' => 'How do astronauts live on the International Space Station?',
  'desc' => 'How astronauts breathe, drink, eat, sleep, exercise and stay healthy on the International Space Station, explained simply with real NASA facts.',
  'kind' => 'Explainer', 'grades' => '3-12', 'time' => '10-minute read', 'subjects' => 'Science',
  'quick' => 'On the International Space Station, oxygen is made by splitting water with electricity, about 98% of water is recycled (including sweat and urine), food is mostly packaged and shipped from Earth, and astronauts exercise about two hours a day to protect their bones and muscles.',
  'sections' => [
    ['Air', [
      'The station makes oxygen by electrolysis: splitting water into hydrogen and oxygen. Carbon dioxide breathed out by the crew is removed by special filters. Fans keep air moving, because in weightlessness warm air does not rise.',
    ]],
    ['Water', [
      'Water is collected from the air (breath and sweat) and from urine, then distilled, filtered and checked. In 2023 NASA announced the station could recover about 98% of the water crews bring aboard.',
    ]],
    ['Food', [
      'Most food is shipped from Earth in packages. Astronauts have also grown and eaten fresh lettuce and other plants in NASA\'s Veggie plant growth system, first eating space-grown lettuce in 2015.',
    ]],
    ['Exercise and health', [
      'Without gravity, bones and muscles weaken. Astronauts exercise about two hours a day on a treadmill (with a harness holding them down), a bicycle and a resistance machine.',
    ]],
    ['Sleep', [
      'Astronauts sleep in small crew cabins, in sleeping bags attached to the wall so they do not float around.',
    ]],
  ],
  'faq' => [
    ['How do astronauts get oxygen on the ISS?', 'By splitting water into hydrogen and oxygen using electricity, a process called electrolysis.'],
    ['Do astronauts drink their own urine?', 'Their urine is cleaned and recycled into drinking water that is purer than much tap water on Earth.'],
    ['Why do astronauts exercise so much?', 'In weightlessness, bones and muscles weaken quickly, so about two hours of exercise a day helps keep them strong.'],
  ],
  'links' => ['future/habitat-cluster', 'future/water-recycler', 'future/indoor-farm', 'future/gravity-gym', 'future/medical-bay', 'future/fab-shop'],
  'sources' => ['nasa-iss', 'nasa-eclss', 'nasa-veggie', 'nasa-hrp'],
],

// ===================== Creative and classroom tools =====================
'fantasy-city-worldbuilding' => [
  'title' => 'How to Design a Fantasy City: Worldbuilding Guide for Students',
  'h1' => 'How to design a fantasy city: a worldbuilding guide',
  'desc' => 'A worldbuilding guide for a believable fantasy city: geography, water, food, government, buildings and culture, with prompts for writing, art and games.',
  'kind' => 'Guide', 'grades' => '6-12', 'time' => '1 to 3 class periods', 'subjects' => 'English, art, game design, geography',
  'quick' => 'A believable fantasy city starts with real questions: where does the water come from, what do people eat, how do they earn a living, who makes decisions, and what makes this place different? Answer those, then add the magic.',
  'sections' => [
    ['Start with geography', [
      'Real cities grow where there is water, food and trade: on rivers, coasts, crossroads and fertile land. Decide where your city sits and why people settled there. A city on a cliff, in a forest or on a floating island will grow differently.',
    ]],
    ['Ten questions every fantasy city should answer', [], ['list' => [
      'Where does the water come from, and where does waste go?',
      'What do people eat, and where is it grown?',
      'How do people earn a living?',
      'Who rules, and how do ordinary people have a say?',
      'Where do people gather, celebrate and worship?',
      'How do people travel and move goods?',
      'What are buildings made of, and why?',
      'Who is powerful, and who is left out?',
      'What is the city afraid of: fire, floods, enemies, monsters?',
      'What makes visitors gasp when they first arrive?',
    ]]],
    ['Use the Elven world as a model', [
      'Every building in this site\'s Elven world answers one of these questions in a fantasy way, and each page shows the real-world idea behind it: seed vaults, living bridges, geothermal heat. Students can borrow the method: start with a real solution, then imagine it with magic.',
    ]],
    ['Avoiding stereotypes', [
      'Fantasy cultures are invented, so avoid copying real cultures as costumes or making any group simply "good" or "evil". Give every group real needs, skills and disagreements.',
    ]],
  ],
  'faq' => [
    ['How do you make a fantasy city believable?', 'Base it on how real cities work: water, food, work, government and trade, then add fantasy elements on top.'],
    ['What is worldbuilding?', 'Creating an imaginary world in detail, including its places, history, peoples and rules, for stories, games or art.'],
  ],
  'links' => ['elven/treetop-village', 'elven/council-terrace', 'elven/canopy-market', 'elven/spring-circle', 'elven/elven-palace', 'elven/tree-library'],
  'sources' => ['ostrom', 'jacobs'],
],

'discussion-questions-what-makes-a-good-city' => [
  'title' => 'What Makes a Good Place to Live? Discussion Questions for Class',
  'h1' => 'What makes a good place to live? Discussion questions',
  'desc' => '30 discussion questions about cities and communities: fairness, nature, technology, history and the future, for seminars, journals and debates.',
  'kind' => 'Lesson', 'grades' => '5-12', 'time' => '1 class period', 'subjects' => 'Social studies, English, civics',
  'quick' => 'Use these open-ended questions to run a Socratic seminar, journal prompts or a debate about what makes a good city. Pair them with the Compare page and any building page for evidence.',
  'sections' => [
    ['Fairness and access', [], ['list' => [
      'Who gets the best parks, schools and air in a city, and why?',
      'Can everyone reach a grocery store, clinic and library without a car?',
      'Who was left out of decisions in ancient Rome? Who is left out today?',
      'Should cities spend money on stadiums or on libraries?',
      'What makes a public space feel welcoming, or unwelcoming?',
    ]]],
    ['Nature and the planet', [], ['list' => [
      'How much of a city should stay wild?',
      'Should trees and green roofs be required on new buildings?',
      'Is it better to improve old buildings or replace them?',
      'Who should pay to protect a city\'s water supply?',
      'What would a city designed by bees, or beavers, look like?',
    ]]],
    ['Technology and the future', [], ['list' => [
      'If robots did most work, what would people choose to do?',
      'Should humans settle Mars before solving problems on Earth?',
      'Who should own resources on the Moon?',
      'Can technology make a city fairer, or only faster?',
      'What should never be automated?',
    ]]],
    ['History', [], ['list' => [
      'What problem did ancient Rome solve better than we do?',
      'Why did Romans build monuments, and why do we?',
      'Which Roman invention do you still use?',
      'How do we know about daily life 2,000 years ago?',
      'What will historians in 2,000 years think of our cities?',
    ]]],
    ['Personal reflection', [], ['list' => [
      'Where do you feel most at home, and why?',
      'What is one thing you would change about your street?',
      'What is your favorite "third place" outside home and school?',
      'Which world on this site would you most like to live in?',
      'What makes a place feel safe to you?',
    ]]],
  ],
  'faq' => [
    ['How do you run a Socratic seminar on cities?', 'Choose 3 to 5 questions, give students a building page or the Compare page to read as evidence, sit in a circle, and let students lead while the teacher only steps in to keep it fair.'],
  ],
  'links' => ['modern/community-center', 'modern/public-library', 'roman/forum', 'elven/wild-grove', 'future/civic-dome', 'modern/stadium'],
  'sources' => ['oldenburg', 'jacobs', 'c3'],
],

'free-images-for-classroom' => [
  'title' => 'Free Images for the Classroom: How to Use and Credit CC BY Art',
  'h1' => 'Free images for the classroom: how to use and credit them',
  'desc' => 'How to use free, openly licensed images in slides, worksheets and projects, how to credit them (TASL), and ' . $ART_COUNT . ' free city illustrations.',
  'kind' => 'Guide', 'grades' => 'Teachers, 6-12', 'time' => '5-minute read', 'subjects' => 'All subjects, digital citizenship',
  'quick' => 'Images with a Creative Commons license can be reused if you follow its terms. For CC BY images, such as the ' . $ART_COUNT . ' illustrations on this site, you can use, change and share them for any purpose as long as you give credit: title, author, source and license (TASL).',
  'sections' => [
    ['What CC BY means', [
      'CC BY 4.0 (Creative Commons Attribution) lets anyone copy, share, change and use a work, even commercially, as long as they credit the creator. All illustrations on this site are shared under CC BY 4.0.',
    ]],
    ['How to credit: TASL', [], ['list' => [
      'Title: the name of the image, if it has one.',
      'Author: who made it.',
      'Source: where you found it (a link if online).',
      'License: the license name, ideally linked.',
    ]], [
      'Example: "Aqueduct" illustration by The Atlas of Cities, CC BY 4.0.',
    ]],
    ['Teaching students to credit images', [
      'Make it a habit: every slide image gets a small credit line. This builds digital citizenship and avoids copying other people\'s work without permission. Photos on this site have their own licenses, shown under each photo and on the Photo credits page.',
    ]],
    ['Using this site\'s artwork', [
      'Open the Artwork page, choose a world, and use Save, Print or Full screen. The images work well for slides, worksheets, posters, story prompts and city-design projects.',
    ]],
  ],
  'faq' => [
    ['Can teachers use images from the internet in class?', 'Only if the license allows it or an exception such as fair use applies. The safest choice is openly licensed images, such as Creative Commons or public domain, credited correctly.'],
    ['How do you credit a Creative Commons image?', 'Give the title, author, source and license (TASL). For example: "Aqueduct" by The Atlas of Cities, CC BY 4.0.'],
  ],
  'links' => ['roman/aqueduct', 'modern/public-library', 'elven/treetop-village', 'future/greenhouse-dome'],
  'sources' => ['cc'],
],

'explore-your-town-scavenger-hunt' => [
  'title' => 'Explore Your Town: Neighborhood Walk and Scavenger Hunt',
  'h1' => 'Explore your town: a neighborhood walk and scavenger hunt',
  'desc' => 'A printable neighborhood walk and scavenger hunt for classes and families: spot infrastructure, public spaces and nature, then talk about your town.',
  'kind' => 'Lesson', 'grades' => 'K-8', 'time' => '1 walk plus 1 class period', 'subjects' => 'Social studies, science, geography',
  'quick' => 'Take a walk around your school or neighborhood and find the hidden systems that make a town work: fire hydrants, storm drains, crosswalks, curb ramps, street trees and public spaces. Then discuss what is missing.',
  'sections' => [
    ['Scavenger hunt checklist', [], ['list' => [
      'A fire hydrant (part of the water system)',
      'A storm drain (where rain goes)',
      'A crosswalk and a curb ramp',
      'A bus stop, bike rack or bike lane',
      'A manhole cover (what might be under it?)',
      'A utility pole or streetlight',
      'A street tree that gives shade',
      'A bench or place to sit',
      'A public building: library, school, post office or town hall',
      'A place where people gather',
      'A sign of wildlife: birds, bees, a nest',
      'Something that needs fixing',
    ]]],
    ['Safety tips', [
      'Walk in groups with adults, stay on sidewalks, cross only at crosswalks, and agree on a meeting point. Families can do the hunt together on a weekend.',
    ]],
    ['Back in class', [], ['list' => [
      'Which item was easiest to find? Hardest?',
      'Who maintains each thing you found?',
      'What did you expect to find but did not?',
      'What one change would make the walk safer or nicer?',
      'Compare: what would a Roman, elven or Martian version of your street look like?',
    ]]],
  ],
  'faq' => [
    ['What is a neighborhood walk activity?', 'A guided walk where students observe and record features of their community, such as infrastructure, public spaces and nature, then discuss what they found.'],
  ],
  'links' => ['modern/streets-crosswalks', 'modern/water-system', 'modern/park-pond', 'modern/public-library', 'modern/plaza-fountain'],
  'sources' => ['apa', 'epa-green'],
],
];
