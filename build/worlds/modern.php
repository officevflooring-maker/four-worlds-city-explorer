<?php
// Modern Town: one page per building. The town is imagined, but every page explains real buildings:
// why cities need them, how they are built and run, and what they do for people.
// Facts are kept to well-established points from the sources below (shown as plain text, not links).

$MODERN_SOURCES = [
  'un-wup'      => 'United Nations, Department of Economic and Social Affairs, "World Urbanization Prospects: The 2018 Revision"',
  'un-habitat'  => 'UN-Habitat, "World Cities Report"',
  'jacobs'      => 'Jane Jacobs, "The Death and Life of Great American Cities" (1961)',
  'oldenburg'   => 'Ray Oldenburg, "The Great Good Place" (1989), on "third places"',
  'ifla'        => 'IFLA-UNESCO Public Library Manifesto (2022)',
  'carnegie'    => 'Digital Public Library of America, exhibition "A History of US Public Libraries: Carnegie Libraries"',
  'crc'         => 'United Nations Convention on the Rights of the Child (1989), Articles 28, 29 and 31',
  'unesco-edu'  => 'UNESCO, "The right to education"',
  'who-phc'     => 'World Health Organization, "Primary health care" fact sheet and the Declaration of Astana (2018)',
  'chc-history' => 'Massachusetts League of Community Health Centers, "History of Community Health Centers"',
  'cdc-water'   => 'US Centers for Disease Control and Prevention, "Water Treatment" (community water systems)',
  'epa-water'   => 'US Environmental Protection Agency, drinking water and wastewater treatment overviews',
  'who-jmp'     => 'WHO/UNICEF Joint Monitoring Program for Water Supply, Sanitation and Hygiene',
  'who-road'    => 'World Health Organization, "Global status report on road safety"',
  'nacto'       => 'National Association of City Transportation Officials, "Urban Street Design Guide"',
  'ada'         => 'US Department of Justice, "2010 ADA Standards for Accessible Design"',
  'brit-sky'    => 'Encyclopaedia Britannica, "Skyscraper" and "Elevator"',
  'ctbuh'       => 'Council on Tall Buildings and Urban Habitat, tall building data and research',
  'icc'         => 'International Code Council, "International Building Code" (overview)',
  'nfpa'        => 'National Fire Protection Association, information on sprinklers and fire safety in buildings',
  'doe-energy'  => 'US Department of Energy, Energy Saver guides on insulation, air sealing and heat pumps',
  'iea-build'   => 'International Energy Agency, "Buildings" (energy use and emissions)',
  'epa-lead'    => 'US Environmental Protection Agency, "Protect Your Family from Sources of Lead"',
  'epa-heat'    => 'US Environmental Protection Agency, "Heat Island Effect"',
  'who-pa'      => 'World Health Organization, "Guidelines on physical activity and sedentary behavior" (2020)',
  'tpl'         => 'Trust for Public Land, ParkScore and the "10-minute walk" research',
  'olmsted'     => 'National Park Service, "Frederick Law Olmsted" and Central Park history',
  'cpsc'        => 'US Consumer Product Safety Commission, "Public Playground Safety Handbook"',
  'emdrup'      => 'Danish Architecture Centre and the Adventure Play movement, on the Emdrup junk playground (1943)',
  'usda-food'   => 'US Department of Agriculture, Economic Research Service, "Food Access Research Atlas"',
  'acga'        => 'American Community Gardening Association',
  'bls-ware'    => 'US Bureau of Labor Statistics, "Warehousing and Storage" industry overview',
  'brit-cont'   => 'Encyclopaedia Britannica, "Containerization" and "Bar code"',
  'uscg'        => 'US Coast Guard, aids to navigation and lighthouse history',
  'nps-light'   => 'National Park Service, "Maritime Heritage: Lighthouses" and the Fresnel lens',
  'usfs'        => 'US Forest Service and Forest History Society, history of fire lookouts and the Osborne Fire Finder',
  'nifc'        => 'National Interagency Fire Center, wildfire information',
  'time'        => 'National Institute of Standards and Technology, history of time zones and standard time (1883)',
  'parliament'  => 'UK Parliament, "The Elizabeth Tower" (Big Ben)',
  'nlc'         => 'National League of Cities, "Forms of Municipal Government"',
  'aoc'         => 'Architect of the Capitol, history of the United States Capitol and its dome',
  'ncsl'        => 'National Conference of State Legislatures, how state legislatures work',
  'icom'        => 'International Council of Museums, museum definition (2022)',
  'exploratorium' => 'Exploratorium, San Francisco, history of the museum (founded 1969)',
  'percent'     => 'City of Philadelphia, "Percent for Art" program history (1959)',
  'nps-memorial'=> 'National Park Service, Vietnam Veterans Memorial and Washington Monument',
  'pew'         => 'Pew Research Center, studies of religion and community life',
  'brit-stained' => 'Encyclopaedia Britannica, "Stained glass"',
  'osha'        => 'US Occupational Safety and Health Administration, "Cranes and Derricks in Construction"',
  'chatham'     => 'Chatham House, "Making Concrete Change: Innovation in Low-carbon Cement and Concrete" (2018)',
  'brit-mat'    => 'Encyclopaedia Britannica, "Concrete", "Steel" and "Building construction"',
  'mass-timber' => 'US Forest Service, Forest Products Laboratory, research on cross-laminated timber',
  'levittown'   => 'Encyclopaedia Britannica, "Levittown" and US suburban history',
  'brit-stadium'=> 'Encyclopaedia Britannica, "Stadium"',
  'vision-zero' => 'Swedish Transport Administration, "Vision Zero" road safety policy (1997)',
  'brit-vvm'     => 'Encyclopaedia Britannica, "Vietnam Veterans Memorial" and "Washington Monument"',
  'afta'         => 'Americans for the Arts, Public Art Network: public art programs in the United States',
  'nrpa'         => 'National Recreation and Park Association, research on park and recreation services',
  'whyte'        => 'William H. Whyte, "The Social Life of Small Urban Spaces" (1980) and the Street Life Project',
];

$MODERN_CATEGORIES = [
  'homes'  => ['Homes and neighborhoods', 'Where people live, from houses with yards to towers in the sky.'],
  'civic'  => ['Government and public services', 'How a town makes decisions and looks after people\'s health.'],
  'infra'  => ['Streets, water and safety', 'The systems most people only notice when they stop working.'],
  'learn'  => ['Learning and culture', 'Places to learn, explore and share ideas, free or nearly free.'],
  'work'   => ['Work and shopping', 'Where people earn a living and get the things they need.'],
  'gather' => ['Gathering and community', 'Spaces that bring neighbors together and help them remember.'],
  'play'   => ['Parks, sport and play', 'Green space, games and exercise, for health and for fun.'],
  'build'  => ['Building the town', 'The machines and materials that make modern buildings possible.'],
];

$MODERN = [

// ---------------- Homes and neighborhoods ----------------
'single-family-house' => [
  'name' => 'Family house', 'latin' => 'detached house', 'cat' => 'homes', 'src' => 'art/family_1.png',
  'summary' => 'A detached house with a porch and garden, built for one household. It is the most common home in many countries.',
  'facts' => ['Who lives here' => 'One household', 'Usual frame' => 'Wood or masonry', 'Takes up' => 'More land per person than apartments', 'Key systems' => 'Water, power, heating, drainage'],
  'sections' => [
    ['Why towns build them', [
      'A detached house gives a family private space indoors and out: a garden for children to play, room to grow food, and no shared walls with neighbors. For many people it is a dream home and a way to build savings, because a house can grow in value.',
      'But each house uses more land than an apartment, so neighborhoods of detached houses spread out. That means longer pipes, cables and roads per home, and often a longer trip to school, shops and work.',
    ]],
    ['How a house is built', [
      'In North America most houses are built with a light timber frame: a skeleton of sawn wooden studs, joists and rafters nailed together, then covered with sheathing boards, insulation and siding. In much of Europe, houses are more often built from brick or concrete blocks.',
    ], ['list' => [
      'Foundation: a concrete slab, crawl space or basement spreads the weight into the ground.',
      'Frame: walls, floors and roof are built as a frame that carries the loads down to the foundation.',
      'Envelope: roofing, walls, windows and insulation keep out rain, wind, heat and cold.',
      'Services: plumbing, wiring, heating and ventilation are fitted inside walls and floors.',
      'Finishes: plaster or drywall, floors, paint and fittings make it a home.',
    ]]],
    ['A house is part of a system', [
      'No house stands alone. It connects to the water main and sewer under the street, to electricity and often gas lines, and to roads and footpaths. Building codes set rules for safety, such as smoke alarms, safe stairs and fire-resistant materials, so that a home protects the people inside.',
    ]],
  ],
  'art' => 'This house is an illustration. The porch, garden and trees show some of the features people often value in a family home.',
  'look' => ['Find the porch. What is it for?', 'Look at the roof shape. How does it handle rain and snow?'],
  'questions' => ['What are the benefits and costs of every family having its own house and garden?', 'How far would you walk from this house to a shop or school?', 'Who might find it hard to afford a house like this?'],
  'words' => ['Foundation' => 'The base that spreads a building\'s weight into the ground.', 'Insulation' => 'Material that slows heat moving in or out.', 'Building code' => 'Rules that make buildings safe.'],
  'sources' => ['icc', 'doe-energy', 'un-habitat'],
  'related' => ['suburban-house', 'older-home', 'apartment-building'],
],

'suburban-house' => [
  'name' => 'Suburban house', 'latin' => 'house with garage', 'cat' => 'homes', 'src' => 'art/home_a.png',
  'summary' => 'A house with a driveway and garage on the edge of a city, designed around travel by car.',
  'facts' => ['Typical feature' => 'Garage and driveway', 'Grew fastest' => 'After the Second World War', 'Famous example' => 'Levittown, New York (1947)', 'Big question' => 'How do people get around?'],
  'sections' => [
    ['Why suburbs grew', [
      'After the Second World War, many countries faced housing shortages. In the United States, builders such as the Levitt family used assembly-line methods to put up thousands of similar houses quickly, starting with Levittown, New York, in 1947. Cheap loans, new highways and affordable cars made it possible to live further from work.',
      'Suburbs offered space, quiet streets and gardens. They also had a darker side: many early postwar suburbs, including Levittown, refused to sell homes to Black families. These rules have long-lasting effects on who owns homes and wealth today.',
    ]],
    ['Designed around the car', [
      'In many suburbs, homes, shops, schools and workplaces are kept in separate zones. Distances are long and footpaths may be missing, so most trips need a car. That can make life harder for children, older people and anyone who cannot drive, and it adds traffic and pollution.',
      'Some newer suburbs are being designed differently, with corner shops, paths and bus routes so that daily needs are closer to home.',
    ]],
    ['How it is built', [
      'Suburban houses are usually built in large batches on land divided into plots. Builders repeat a few designs to save money and time. Roads, water mains, sewers and power lines are laid first, then the houses are framed, roofed and finished. A garage is often attached to the front of the house.',
    ]],
  ],
  'art' => 'This illustration shows a typical suburban house, with a car parked in the driveway.',
  'look' => ['Find the garage and driveway. How much space do they take?', 'Is there a footpath in front of the house?'],
  'questions' => ['If you lived here, how would you get to school without a car?', 'Why might a town keep homes and shops in separate areas? What changes if they mix?', 'How did rules about who could buy homes shape cities?'],
  'words' => ['Suburb' => 'A mainly residential area on the edge of a city.', 'Zoning' => 'Rules about what can be built where.', 'Commute' => 'The regular trip between home and work.'],
  'sources' => ['levittown', 'un-habitat', 'jacobs'],
  'related' => ['single-family-house', 'streets-crosswalks', 'corner-store'],
],

'older-home' => [
  'name' => 'Older brick house', 'latin' => 'renovation and retrofit', 'cat' => 'homes', 'src' => 'art/home_b.png',
  'summary' => 'An older home that can be repaired and upgraded to use far less energy, instead of being knocked down.',
  'facts' => ['Big idea' => 'Retrofit: upgrade what already exists', 'Biggest energy use' => 'Usually heating and cooling', 'Quick wins' => 'Air sealing, insulation, better windows', 'Watch out for' => 'Old lead paint and asbestos'],
  'sections' => [
    ['Why older homes matter', [
      'Most of the homes people will live in over the next thirty years have already been built. Buildings account for a large share of the world\'s energy use, so improving existing homes is one of the biggest ways to save energy and money.',
      'Keeping an older building also saves the energy and materials that went into building it. Demolishing it and building new releases a lot of carbon.',
    ]],
    ['How a retrofit works', [
      'Heating and cooling are usually a home\'s biggest energy use. A retrofit tackles the "envelope" first, then the equipment.',
    ], ['list' => [
      'Air sealing: blocking gaps around windows, doors and pipes that leak warm or cool air.',
      'Insulation: adding it to lofts, walls and floors to slow heat loss.',
      'Windows: repairing or replacing them with double or triple glazing.',
      'Heat pumps: efficient electric systems that move heat in or out instead of burning fuel.',
      'Solar panels and smart controls: making and managing energy.',
    ]]],
    ['Working safely with old buildings', [
      'Older homes can contain hazards. In the United States, lead-based paint was banned for homes in 1978, so older houses may still have it under newer layers. Sanding or scraping it releases harmful dust, so it needs special care. Some older buildings also contain asbestos insulation. Professionals test before work begins.',
    ]],
  ],
  'art' => 'This illustration shows a solid brick house with a front porch. Its design is the artist\'s own.',
  'look' => ['Find the chimney. What did it once do?', 'Look at the windows. Where might heat escape?'],
  'questions' => ['Why might it be better to improve an old building than to replace it?', 'What could your home do to waste less energy?', 'Who should pay for upgrades: owners, tenants or government?'],
  'words' => ['Retrofit' => 'Adding new technology to an existing building.', 'Heat pump' => 'A machine that moves heat from one place to another.', 'Envelope' => 'The walls, roof, windows and floor that separate inside from outside.'],
  'sources' => ['doe-energy', 'iea-build', 'epa-lead'],
  'related' => ['single-family-house', 'building-materials', 'apartment-building'],
],

'apartment-building' => [
  'name' => 'Apartment building', 'latin' => 'mid-rise housing', 'cat' => 'homes', 'src' => 'art/floor_m.png',
  'summary' => 'A building of several floors with many homes stacked together, sharing walls, stairs and services.',
  'facts' => ['Homes per plot' => 'Many more than houses', 'Shared' => 'Entrances, stairs, elevators, heating', 'Safety' => 'Fire-resistant walls and escape routes', 'Helps support' => 'Shops and public transport nearby'],
  'sections' => [
    ['Why cities need them', [
      'More than half of the world\'s people now live in cities, and the United Nations expects that share to reach about two thirds by 2050. Apartment buildings let many households live on a small piece of land, close to jobs, schools and services.',
      'When more people live close together, it becomes worthwhile to run frequent buses, open local shops and build parks within walking distance. Shared walls also mean apartments usually need less energy to heat than detached houses.',
    ]],
    ['How they are built', [
      'Mid-rise apartment buildings are often built with a concrete or steel frame, or increasingly with engineered timber. Floors are stacked one above another, and each apartment is separated by walls and floors designed to block fire and noise.',
      'Building codes require safe ways out in a fire: protected stairways, fire doors that close by themselves, smoke alarms and, in many places, sprinklers. Larger buildings need elevators so that everyone, including people using wheelchairs, can reach every floor.',
    ]],
    ['Living together', [
      'Sharing a building means sharing decisions: who cleans the stairs, how to fix the roof, how loud is too loud. Good design helps, with bright entrances, places to store bikes and strollers, courtyards and balconies that give each home some outdoor space.',
    ]],
  ],
  'art' => 'This building is an illustration. The balconies and planting show features that make apartments more pleasant to live in.',
  'look' => ['Count the balconies.', 'Find the main entrance. Is it easy to see and reach?'],
  'questions' => ['What would you share with your neighbors if you lived here?', 'How do people using wheelchairs or strollers reach the upper floors?', 'Why might a bus route be easier to run near apartment buildings?'],
  'words' => ['Density' => 'How many people or homes are in an area.', 'Fire separation' => 'Walls and floors built to stop fire spreading.', 'Mid-rise' => 'A building of about four to twelve floors.'],
  'sources' => ['un-wup', 'icc', 'nfpa', 'ada'],
  'related' => ['residential-tower', 'mixed-use-building', 'older-home'],
],

'residential-tower' => [
  'name' => 'Residential tower', 'latin' => 'high-rise apartments', 'cat' => 'homes', 'src' => 'art/floor_l.png',
  'summary' => 'A tall glass tower of apartments that fits hundreds of homes onto a small plot of land.',
  'facts' => ['Needs' => 'Elevators, pumps and strong foundations', 'Biggest force' => 'Wind', 'Clever trick' => 'Tuned mass dampers reduce sway', 'Tallest building' => 'Burj Khalifa, Dubai (828 m)'],
  'sections' => [
    ['Why build so tall?', [
      'Where land is scarce and expensive, building upward lets a city house many people without spreading outward. Towers can leave more space at ground level for parks and streets, and residents may enjoy views and light.',
      'Tall towers also bring challenges: they cost more to build and maintain, depend on elevators and pumps, and can feel isolating if there are no shared spaces where neighbors meet.',
    ]],
    ['How a tower stands up', [
      'A tall building must carry its own weight down to the ground and resist wind pushing on its side. Most towers have a strong central core of concrete, which holds the elevators, stairs and pipes, and acts like a spine. Floors and columns spread out from the core.',
      'Deep foundations, sometimes piles driven or drilled tens of meters into the ground, anchor the tower. Engineers test models in wind tunnels, and some very tall buildings use a tuned mass damper: a huge weight near the top that moves against the sway to keep the building steady.',
    ]],
    ['Living in the sky', [
      'Water must be pumped up to the upper floors. Fast elevators are essential, and people need protected stairways for escape in a fire. Building codes for high-rises require sprinklers, fire-resistant construction and refuge floors in the tallest towers.',
    ]],
  ],
  'art' => 'This illustration shows a glass tower with a stepped top. Its design is the artist\'s own.',
  'look' => ['Look for the shape of the core and floors through the glass.', 'How does the tower get narrower toward the top?'],
  'questions' => ['Would you like to live on the 40th floor? What would be good and hard about it?', 'What happens in a tower when the power goes out?', 'How could a tower help neighbors meet each other?'],
  'words' => ['Core' => 'The strong central part holding elevators and stairs.', 'Pile' => 'A long column driven into the ground to support a building.', 'Tuned mass damper' => 'A heavy weight that reduces swaying.'],
  'sources' => ['brit-sky', 'ctbuh', 'nfpa'],
  'related' => ['skyscraper', 'apartment-building', 'tower-crane'],
],

'mixed-use-building' => [
  'name' => 'Shops with homes above', 'latin' => 'mixed-use building', 'cat' => 'homes', 'src' => 'art/floor_s.png',
  'summary' => 'A building with shops on the street and homes upstairs, keeping streets lively day and night.',
  'facts' => ['Ground floor' => 'Shops, cafés, services', 'Upper floors' => 'Homes or offices', 'Big idea' => '"Eyes on the street"', 'Old and new' => 'Common for centuries, popular again today'],
  'sections' => [
    ['Why mix homes and shops?', [
      'For most of history, people lived above or behind their workplaces. In the 20th century many cities separated homes from shops and offices with zoning rules. Today many planners are bringing back the mix.',
      'In 1961 the writer Jane Jacobs argued that lively, safe streets need "eyes on the street": people coming and going at different times of day, shopkeepers watching the sidewalk, residents looking out of windows. Mixed-use buildings help create that.',
    ]],
    ['What it does for a neighborhood', [], ['list' => [
      'Residents can walk downstairs to buy food or see a doctor.',
      'Shops get customers living right above them.',
      'Streets stay busy and feel safer in the evening.',
      'Fewer car trips are needed, cutting traffic and pollution.',
    ]]],
    ['How they are built', [
      'The ground floor usually has tall ceilings and large windows for shopfronts. Above, the structure changes to smaller rooms for homes. Builders must separate the two uses with fire-resistant floors and soundproofing, and give homes their own entrance and escape stairs.',
    ]],
  ],
  'art' => 'This illustration shows awnings over the shops and windows of the homes above.',
  'look' => ['Find the shop awnings and the homes above them.', 'Where is the door to the apartments?'],
  'questions' => ['What are the benefits of living above shops? Are there downsides?', 'What shops would you want under your home?', 'Why might a busy street feel safer than an empty one?'],
  'words' => ['Mixed-use' => 'Combining homes, shops and work in one place.', 'Eyes on the street' => 'Jane Jacobs\'s idea that watchful people make streets safer.', 'Shopfront' => 'The front of a shop facing the street.'],
  'sources' => ['jacobs', 'un-habitat', 'icc'],
  'related' => ['corner-store', 'apartment-building', 'streets-crosswalks'],
],

// ---------------- Government and public services ----------------
'town-hall' => [
  'name' => 'Town hall', 'latin' => 'city hall', 'cat' => 'civic', 'src' => 'art/town_1.png',
  'summary' => 'The home of local government, where elected leaders meet and residents get public services.',
  'facts' => ['Who works here' => 'Mayor, council and staff', 'Decides' => 'Local budgets, rules and services', 'Open to' => 'All residents', 'Common forms' => 'Mayor-council or council-manager'],
  'sections' => [
    ['What local government does', [
      'Many things that shape daily life are decided locally: trash collection, street repairs, parks, libraries, local planning, and often police, fire services and public transport. The town hall is where these decisions are debated and voted on, and where staff carry them out.',
    ]],
    ['How it works', [
      'Residents elect a council, and often a mayor. In a mayor-council system, the mayor leads the town\'s administration. In a council-manager system, the council hires a professional manager to run day-to-day services. Council meetings are usually open to the public, and many towns let residents speak during a public comment period.',
      'The town hall also handles practical services: permits to build a house extension, licenses for businesses, birth and marriage records, and paying local taxes.',
    ]],
    ['A building for everyone', [
      'Town halls are often designed to look important, with steps, columns and a clock or tower, to show that local government belongs to the whole community. Modern accessibility rules require that everyone, including people using wheelchairs, can get in and take part.',
    ]],
  ],
  'art' => 'This illustration shows a classic brick and stone town hall with a clock and flagpole.',
  'look' => ['Find the clock and the flagpole.', 'Is there a step-free way in?'],
  'questions' => ['What would you ask your local council to change?', 'How can residents who cannot attend meetings still have a say?', 'Why might a town hall be built to look grand?'],
  'words' => ['Council' => 'A group of elected people who make local decisions.', 'Mayor' => 'The leader of a town or city.', 'Permit' => 'Official permission to do something, like build.'],
  'sources' => ['nlc', 'ada'],
  'related' => ['capitol', 'community-center', 'public-library'],
],

'capitol' => [
  'name' => 'Capitol building', 'latin' => 'legislature', 'cat' => 'civic', 'src' => 'art/town_3.png',
  'summary' => 'A domed building where elected lawmakers for a state or country meet to debate and pass laws.',
  'facts' => ['Who meets here' => 'Elected legislators', 'Main job' => 'Making laws and approving budgets', 'Famous example' => 'United States Capitol', 'US Capitol dome' => 'Cast iron, completed 1866'],
  'sections' => [
    ['What a legislature does', [
      'A legislature is a group of elected representatives who make laws, decide how public money is raised and spent, and hold the government to account. Many legislatures have two chambers, which both have to agree before a bill becomes law.',
    ]],
    ['How a law is made', [], ['list' => [
      'A member introduces a proposal, called a bill.',
      'A committee studies it, hears from experts and the public, and may change it.',
      'Members debate and vote on it.',
      'If both chambers pass it, it goes to the head of government to sign or veto.',
    ]]],
    ['Why the dome?', [
      'Many capitols are built with a dome and columns, borrowing from ancient Greek and Roman architecture to suggest democracy, law and permanence. The dome of the United States Capitol in Washington, DC, was built of cast iron during the Civil War and completed in 1866. Many US state capitols copied its style.',
    ]],
  ],
  'art' => 'This illustration shows a domed capitol with columns, inspired by many real legislative buildings.',
  'look' => ['Find the dome and the columns.', 'Compare it with the Roman Pantheon. What looks similar?'],
  'questions' => ['Why do you think capitols borrow ideas from ancient Rome and Greece?', 'If you could propose one law, what would it be?', 'How can young people make their voices heard by lawmakers?'],
  'words' => ['Legislature' => 'An elected body that makes laws.', 'Bill' => 'A proposed law.', 'Veto' => 'Refusing to sign a law.'],
  'sources' => ['aoc', 'ncsl'],
  'related' => ['town-hall', 'memorial', 'clock-tower'],
],

'health-clinic' => [
  'name' => 'Health clinic', 'latin' => 'primary care center', 'cat' => 'civic', 'src' => 'art/family_2.png',
  'summary' => 'A neighborhood clinic where people see a doctor or nurse, get vaccines and stay healthy before small problems grow.',
  'facts' => ['Type of care' => 'Primary health care', 'Typical services' => 'Check-ups, vaccines, prescriptions', 'Global goal' => 'Health care for all (Declaration of Astana, 2018)', 'US community health centers began' => '1965'],
  'sections' => [
    ['Why every neighborhood needs one', [
      'Most health needs, such as check-ups, vaccinations, minor illnesses, pregnancy care and managing long-term conditions like diabetes, do not need a hospital. They are best handled close to home by a primary care team. The World Health Organization says strong primary health care is the most effective way to improve a population\'s health.',
      'When clinics are hard to reach, people delay care, and small problems can turn into emergencies.',
    ]],
    ['Health care for everyone', [
      'In 1965, two doctors, Jack Geiger and Count Gibson, helped open one of the first community health centers in the United States, at the Columbia Point housing development in Boston, with another at Mound Bayou in rural Mississippi soon after. They treated people regardless of their ability to pay and also tackled the causes of illness, such as poor housing and lack of food.',
    ]],
    ['How a clinic is designed', [
      'A clinic needs a welcoming entrance with step-free access, a waiting area, private consultation rooms with sinks for hand washing, and spaces for tests and vaccines. Good ventilation and easy-to-clean surfaces help stop infections spreading. Many new clinics include rooms for social workers, dentists or mental health support.',
    ]],
  ],
  'art' => 'This illustration shows a welcoming single-story building with big windows. We use it to represent a neighborhood health clinic.',
  'look' => ['Find the main entrance. Is it easy to reach?', 'Notice the big windows. How might daylight help people feel calmer?'],
  'questions' => ['How far is the nearest clinic from your home? How would you get there?', 'Why might it be cheaper to keep people healthy than to treat them later?', 'Besides medicine, what helps people stay healthy?'],
  'words' => ['Primary care' => 'Everyday health care, usually the first place people go.', 'Vaccine' => 'A medicine that trains the body to fight a disease.', 'Prevention' => 'Stopping illness before it starts.'],
  'sources' => ['who-phc', 'chc-history', 'ada'],
  'related' => ['community-center', 'water-system', 'recreation-center'],
],

'clock-tower' => [
  'name' => 'Clock tower', 'latin' => 'public clock', 'cat' => 'civic', 'src' => 'art/town_2.png',
  'summary' => 'A tall tower with a clock that everyone could see, from the days before every person carried the time.',
  'facts' => ['Purpose' => 'Showing everyone the same time', 'Famous example' => 'Elizabeth Tower (Big Ben), London, 1859', 'Standard time in the US' => 'Adopted by railways, 1883', 'Today' => 'Clocks sync to atomic time'],
  'sections' => [
    ['Why towns needed a public clock', [
      'Before watches were cheap, most people could not own a clock. A clock high on a tower, often with bells, let a whole town know when to start work, open markets or go to church or school. Clock towers became symbols of civic pride.',
    ]],
    ['The problem of time zones', [
      'Until the late 1800s, each town set its clocks by the sun, so noon in one town was a few minutes different from noon in the next. That was fine until railways arrived: trains needed timetables that worked across hundreds of kilometers. On 18 November 1883, the railways of the United States and Canada switched to standard time zones. Countries later agreed world time zones based on Greenwich, in London.',
    ]],
    ['How a tower clock works', [
      'A traditional tower clock is driven by heavy weights that slowly fall, with a swinging pendulum controlling the speed. Gears turn the hands on each face. Big Ben\'s clock is still wound and adjusted by hand; its keepers fine-tune it by adding or removing small coins on the pendulum. Today most public clocks are set by radio or internet signals from atomic clocks.',
    ]],
  ],
  'art' => 'This illustration shows a brick clock tower. Its design is the artist\'s own.',
  'look' => ['Find the clock faces. How many directions can you see the time from?', 'Is there a place for bells?'],
  'questions' => ['How would life be different if every town had its own time?', 'Where do you see the time each day?', 'Why do towns still build clock towers if everyone has a phone?'],
  'words' => ['Time zone' => 'A region that uses the same standard time.', 'Pendulum' => 'A swinging weight that keeps a clock steady.', 'Atomic clock' => 'An extremely accurate clock based on atoms.'],
  'sources' => ['time', 'parliament'],
  'related' => ['town-hall', 'capitol', 'lighthouse'],
],

// ---------------- Streets, water and safety ----------------
'streets-crosswalks' => [
  'name' => 'Streets and crosswalks', 'latin' => 'complete streets', 'cat' => 'infra', 'src' => 'ground/tex_cross.png',
  'summary' => 'Streets are a town\'s largest public space. Their design decides whether walking, cycling and crossing feel safe.',
  'facts' => ['Global problem' => 'Over a million road deaths a year (WHO)', 'Safety idea' => 'Vision Zero (Sweden, 1997)', 'Helps everyone' => 'Curb ramps and clear crossings', 'Street includes' => 'Sidewalk, crossing, lanes, trees, drains'],
  'sections' => [
    ['More than roads', [
      'Streets carry cars and trucks, but also people walking, cycling, pushing strollers and using wheelchairs. Under the surface they carry water, sewers, power and internet. Streets are also places to meet, shop and play.',
      'Road traffic crashes kill over a million people around the world each year, according to the World Health Organization, and are a leading cause of death for children and young people.',
    ]],
    ['Designing safer streets', [], ['list' => [
      'Clearly marked crossings, with signals where traffic is heavy.',
      'Curb extensions that shorten the distance to cross.',
      'Lower speed limits near schools and homes: a person hit at lower speed is much more likely to survive.',
      'Curb ramps and tactile paving so wheelchair users and blind people can cross.',
      'Separate lanes for bikes and buses.',
      'Street trees, lighting and benches.',
    ]]],
    ['Vision Zero and the "curb-cut effect"', [
      'In 1997 Sweden adopted Vision Zero, a policy that says no one should be killed or seriously injured on the roads, and that streets should be designed to forgive human mistakes. Many cities have since copied it.',
      'Curb ramps were first pushed for by disability campaigners, and in the United States the Americans with Disabilities Act of 1990 made them required in new work. They turned out to help almost everyone: people with strollers, suitcases, bikes and trolleys. This is sometimes called the "curb-cut effect".',
    ]],
  ],
  'art' => 'This is the crossroads ground artwork from the Modern world: a road junction with zebra crossings and corner sidewalks, seen from above.',
  'look' => ['Find the zebra crossings on all four sides.', 'Where would a wheelchair user cross the curb?'],
  'questions' => ['Is the walk to your school safe? What would make it safer?', 'Who should streets be designed for first: people walking, cycling, riding buses or driving?', 'Can you think of other designs that help one group but end up helping everyone?'],
  'words' => ['Curb ramp' => 'A slope from sidewalk to road (also called a curb cut).', 'Vision Zero' => 'A goal of no deaths or serious injuries on the roads.', 'Tactile paving' => 'Bumpy paving that blind people can feel.'],
  'sources' => ['who-road', 'nacto', 'vision-zero', 'ada'],
  'related' => ['suburban-house', 'school', 'water-system'],
],

'water-system' => [
  'name' => 'Water system', 'latin' => 'drinking water and wastewater', 'cat' => 'infra', 'src' => 'ground/tex_water.png',
  'summary' => 'Hidden pipes, pumps and treatment plants bring clean water to every tap and carry dirty water safely away.',
  'facts' => ['Clean water steps' => 'Coagulation, settling, filtering, disinfection', 'Pressure from' => 'Water towers and pumps', 'Famous lesson' => 'John Snow and cholera, London, 1854', 'Still needed' => 'Billions lack safely managed water'],
  'sections' => [
    ['Why it matters', [
      'Clean water is one of the greatest public health achievements in history. In 1854, the doctor John Snow traced a cholera outbreak in London to a single contaminated water pump on Broad Street. His work helped prove that disease could spread through dirty water and led cities to build sewers and treatment systems.',
      'Even today, the WHO and UNICEF report that billions of people do not have safely managed drinking water at home.',
    ]],
    ['From river to tap', [], ['list' => [
      'Source: water is taken from a river, lake, reservoir or underground aquifer.',
      'Coagulation and flocculation: chemicals make tiny particles clump together.',
      'Sedimentation: the clumps settle to the bottom of large tanks.',
      'Filtration: water passes through sand, gravel or membranes.',
      'Disinfection: chlorine, ultraviolet light or ozone kills germs.',
      'Storage and distribution: water towers and pumps keep it under pressure in pipes under every street.',
    ]]],
    ['After the drain', [
      'Used water from sinks and toilets flows through sewers to a wastewater treatment plant. There, solids are removed, bacteria break down waste, and the cleaned water is returned to rivers or reused. Rainwater from streets often goes through separate storm drains.',
      'Old pipes need care. In Flint, Michigan, a change of water source in 2014 caused lead to leach from old pipes, a crisis that showed why water systems need constant testing and investment.',
    ]],
  ],
  'art' => 'This is the water ground artwork from the Modern world. The pipes and plants that make water safe are usually out of sight.',
  'look' => ['Imagine the network of pipes under this water.', 'Where in your town might water come from?'],
  'questions' => ['How many times a day do you use water? For what?', 'Why do you think water systems are often invisible?', 'Who should pay to replace old pipes?'],
  'words' => ['Aquifer' => 'Underground rock or soil that holds water.', 'Disinfection' => 'Killing germs in water.', 'Wastewater' => 'Used water from homes and businesses.'],
  'sources' => ['cdc-water', 'epa-water', 'who-jmp'],
  'related' => ['plaza-fountain', 'health-clinic', 'streets-crosswalks'],
],

'lighthouse' => [
  'name' => 'Lighthouse', 'latin' => 'aid to navigation', 'cat' => 'infra', 'src' => 'art/growth_3.png',
  'summary' => 'A tower with a powerful light that warns ships of rocks and guides them safely into harbor.',
  'facts' => ['Purpose' => 'Guiding ships safely', 'Key invention' => 'Fresnel lens (1820s)', 'Each light' => 'Has its own pattern of flashes', 'Today' => 'Mostly automated'],
  'sections' => [
    ['Why lighthouses are still needed', [
      'Ships carry most of the world\'s trade. Even with satellite navigation, ships need visible markers near dangerous coasts, in case electronics fail, and to confirm their position. Lighthouses, buoys and beacons are called aids to navigation.',
    ]],
    ['How a lighthouse works', [
      'Early lighthouses burned wood, coal or oil. In the 1820s, the French physicist Augustin Fresnel designed a lens made of rings of glass prisms that bends light into a strong, narrow beam. Fresnel lenses made lights visible many kilometers out to sea and were used around the world.',
      'Each lighthouse has its own "signature": a pattern of flashes and a color, printed on nautical charts, so sailors can tell which light they are seeing at night. Painted stripes or colors help identify it by day.',
    ]],
    ['From keepers to automation', [
      'For generations, lighthouse keepers and their families lived at remote stations, trimming wicks, winding clockwork and cleaning lenses. During the 20th century, electric lamps and automatic controls replaced most keepers. Many old lighthouses are now museums, while modern LED lights do the work.',
    ]],
  ],
  'art' => 'This illustration shows a striped lighthouse on a rocky island with a keeper\'s house.',
  'look' => ['Find the lantern room at the top.', 'Why might it be painted with red and white stripes?'],
  'questions' => ['Why might ships still need lighthouses in the age of GPS?', 'What would it be like to live as a lighthouse keeper?', 'What other "signals" help keep people safe?'],
  'words' => ['Fresnel lens' => 'A lens made of rings of prisms that focuses light.', 'Nautical chart' => 'A map for sailors.', 'Aid to navigation' => 'Any marker that helps ships find their way.'],
  'sources' => ['uscg', 'nps-light'],
  'related' => ['fire-lookout', 'warehouse', 'water-system'],
],

'fire-lookout' => [
  'name' => 'Fire lookout tower', 'latin' => 'wildfire watch', 'cat' => 'infra', 'src' => 'art/nt_tower.png',
  'summary' => 'A tall tower in a forest or on a hill where a watcher scans the land for smoke from wildfires.',
  'facts' => ['Purpose' => 'Spotting wildfires early', 'Key tool' => 'The Osborne Fire Finder', 'Busiest era' => '1930s to 1950s', 'Today' => 'Towers, cameras, satellites and aircraft'],
  'sections' => [
    ['Why early warning matters', [
      'A wildfire is easiest to stop when it is small. In dry, windy weather a fire can grow very fast, threatening forests, wildlife, homes and lives. Spotting smoke early lets firefighters reach it before it spreads.',
    ]],
    ['How a lookout works', [
      'A lookout is a small cabin with windows on all sides, set on a tower or peak. The watcher scans the horizon through the day. When they see smoke, they use a sighting instrument such as the Osborne Fire Finder, developed in the 1910s by forester William Osborne, to measure its exact direction on a map. If two lookouts take a direction from different places, the fire is where the two lines cross. The lookout then radios the location to firefighters.',
    ]],
    ['Old and new technology', [
      'In the United States, fire lookouts were most common from the 1930s to the 1950s. Aircraft and satellites later took over much of the work, but many towers are still staffed in fire season. Today, networks of cameras with smart software also watch for smoke, and communities near forests practice creating defensible space around homes.',
    ]],
  ],
  'art' => 'This illustration shows a wooden lookout cabin on a tall frame with stairs.',
  'look' => ['Find the stairs and the cabin at the top.', 'Why are there windows on every side?'],
  'questions' => ['Why might a person still be useful when we have satellites and cameras?', 'How could you find a fire\'s location using two lookouts?', 'What can people living near forests do to stay safe?'],
  'words' => ['Wildfire' => 'An uncontrolled fire in nature.', 'Triangulation' => 'Finding a location from two or more directions.', 'Defensible space' => 'A cleared area around a home that slows fire.'],
  'sources' => ['usfs', 'nifc'],
  'related' => ['lighthouse', 'park-pond', 'clock-tower'],
],

// ---------------- Learning and culture ----------------
'public-library' => [
  'name' => 'Public library', 'latin' => 'library', 'cat' => 'learn', 'src' => 'art/knowledge_1.png',
  'summary' => 'Free books, internet, study space and help for everyone, with no one asked to pay at the door.',
  'facts' => ['Cost to use' => 'Free', 'Offers' => 'Books, internet, classes, quiet space', 'Global principle' => 'IFLA-UNESCO Public Library Manifesto', 'Carnegie libraries' => '2,509 built from 1883 to 1929'],
  'sections' => [
    ['Why towns have public libraries', [
      'A public library is one of the few indoor places anyone can enter and stay without buying anything. The IFLA-UNESCO Public Library Manifesto describes it as a local gateway to knowledge, open to all regardless of age, background or income.',
      'Between 1883 and 1929, the industrialist Andrew Carnegie paid for 2,509 library buildings around the world, most of them in the United States, on condition that towns provided the land and paid to run them. Many are still in use.',
    ]],
    ['What a library does today', [], ['list' => [
      'Lends books, e-books, films, music and sometimes tools or musical instruments.',
      'Provides free computers and Wi-Fi, which helps people apply for jobs and services online.',
      'Runs story times for young children and homework help for students.',
      'Offers classes in languages, digital skills and more.',
      'Gives everyone a warm, safe, quiet place to read or study.',
    ]]],
    ['Designing a library', [
      'Modern libraries mix quiet reading rooms with lively spaces for children, meeting rooms and maker spaces. They need strong floors to carry heavy shelves, good daylight without sun glare on pages, and step-free access throughout.',
    ]],
  ],
  'art' => 'This illustration shows a brick library with a carved open book above the entrance.',
  'look' => ['Find the open book above the door.', 'Is there a step-free way in?'],
  'questions' => ['Who might rely on a public library the most?', 'Why is it important that some places are free to enter?', 'What would you add to a library of the future?'],
  'words' => ['Literacy' => 'Being able to read and write.', 'Digital divide' => 'The gap between people who can and cannot get online.', 'Lending' => 'Letting people borrow things for a while.'],
  'sources' => ['ifla', 'carnegie'],
  'related' => ['school', 'community-center', 'science-center'],
],

'school' => [
  'name' => 'School', 'latin' => 'primary and secondary school', 'cat' => 'learn', 'src' => 'art/knowledge_2.png',
  'summary' => 'A building where children learn, make friends and get support, and often a hub for the whole community.',
  'facts' => ['A right' => 'Education is a right for every child (UN, 1989)', 'Spaces' => 'Classrooms, library, hall, playground', 'Also provides' => 'Meals, health checks, safety', 'Trip there' => 'Walking, cycling, bus or car'],
  'sections' => [
    ['Why every community needs schools', [
      'The United Nations Convention on the Rights of the Child (1989) says every child has a right to education, and that primary education should be free. Schools teach knowledge and skills, but also help children learn to work together, and they often provide meals, health checks and a safe place during the day.',
    ]],
    ['How a school is designed', [
      'Good school buildings have plenty of daylight and fresh air, which research links to better concentration. Classrooms need good acoustics so that everyone can hear. Spaces for science, art, music and sport, a library and outdoor play areas all support learning.',
      'Schools must be safe and accessible for every pupil, including children who use wheelchairs or have other needs. Many schools also open their halls and fields to the community in the evenings and at weekends.',
    ]],
    ['Getting to school', [
      'How children travel to school shapes their health and independence. Safe footpaths, crossings, cycle lanes and lower speed limits near schools let more children walk or cycle. Some towns run "school streets", closing roads outside the school gate to cars at the start and end of the day.',
    ]],
  ],
  'art' => 'This illustration shows a two-story brick school with a clock above the entrance.',
  'look' => ['Find the clock above the door.', 'What surrounds the school: roads, paths or green space?'],
  'questions' => ['What would make the trip to your school safer or more fun?', 'If you could redesign one room in your school, which would it be?', 'Why might a school be a good place for community events?'],
  'words' => ['Curriculum' => 'What a school teaches.', 'Acoustics' => 'How sound behaves in a space.', 'Accessible' => 'Easy for everyone to reach and use.'],
  'sources' => ['crc', 'unesco-edu', 'ada'],
  'related' => ['public-library', 'playground', 'streets-crosswalks'],
],

'science-center' => [
  'name' => 'Science center and observatory', 'latin' => 'hands-on museum', 'cat' => 'learn', 'src' => 'art/knowledge_3.png',
  'summary' => 'A museum where visitors learn by doing experiments, with a telescope dome for looking at the night sky.',
  'facts' => ['Big idea' => 'Learning by doing', 'Pioneer' => 'Exploratorium, San Francisco (1969)', 'Dome' => 'Opens and rotates to point a telescope', 'Visitors' => 'Families, schools, everyone'],
  'sections' => [
    ['Why hands-on science?', [
      'Traditional museums often keep objects behind glass. In 1969 the physicist Frank Oppenheimer opened the Exploratorium in San Francisco, where visitors could touch, build and experiment with exhibits that showed how light, sound, electricity and living things work. The idea spread worldwide, and science centers now welcome millions of school groups and families.',
    ]],
    ['How an observatory dome works', [
      'A telescope needs to point at any part of the sky but also be protected from rain and wind. The answer is a dome with a long opening called a slit. Motors rotate the dome so the slit faces the right direction, and shutters open to let the telescope see out. Observatories are best placed away from bright city lights.',
    ]],
    ['What a science center does for a town', [], ['list' => [
      'Sparks curiosity and helps people understand science in the news.',
      'Supports teachers with workshops and resources.',
      'Hosts public star-gazing nights, talks and events.',
      'Brings visitors who also spend money in local businesses.',
    ]]],
  ],
  'art' => 'This illustration shows a modern building with a white observatory dome and a telescope peeking out.',
  'look' => ['Find the slit in the dome and the telescope.', 'Notice the big glass windows. What might be inside?'],
  'questions' => ['What experiment would you most like to try?', 'Why might an observatory be better outside a big city?', 'How can museums make science welcoming to everyone?'],
  'words' => ['Observatory' => 'A building with telescopes for studying the sky.', 'Light pollution' => 'Artificial light that hides the stars.', 'Exhibit' => 'Something displayed for people to explore.'],
  'sources' => ['exploratorium', 'icom'],
  'related' => ['public-library', 'school', 'cultural-center'],
],

'cultural-center' => [
  'name' => 'Cultural center', 'latin' => 'heritage and arts center', 'cat' => 'learn', 'src' => 'art/growth_2.png',
  'summary' => 'A place where a community shares its traditions, art, food, language and history with neighbors and visitors.',
  'facts' => ['Purpose' => 'Sharing culture and heritage', 'Activities' => 'Exhibitions, classes, festivals, performances', 'Museums today' => 'Defined as open to all and inclusive (ICOM, 2022)', 'Brings together' => 'Long-time residents and newcomers'],
  'sections' => [
    ['Why towns have cultural centers', [
      'Modern towns are home to people from many backgrounds. A cultural center gives a community a place to keep its traditions alive: teaching a language to children, celebrating festivals, displaying art and telling its history. It also invites neighbors to learn and take part.',
      'In 2022 the International Council of Museums agreed a new definition of a museum, describing it as open to the public, accessible and inclusive, and working with communities.',
    ]],
    ['What happens inside', [], ['list' => [
      'Exhibitions of art, crafts and history.',
      'Classes in music, dance, cooking and languages.',
      'Performances, film screenings and talks.',
      'Festivals and celebrations open to everyone.',
      'Archives that keep photos, letters and stories safe.',
    ]]],
    ['Respect and design', [
      'A cultural center is designed with the community it serves, often using traditional forms, materials or gardens. Displays should be planned with the people whose culture is shown, so that they tell their own story.',
    ]],
  ],
  'art' => 'This illustration shows a pavilion with layered roofs in a garden. We use it to represent a cultural center; the building style is the artist\'s choice.',
  'look' => ['Notice the layered roofs and the garden around the building.', 'Where could a festival or performance take place?'],
  'questions' => ['What traditions in your family or community would you share at a cultural center?', 'Why does it matter who tells a community\'s story?', 'How can neighbors from different backgrounds get to know each other?'],
  'words' => ['Heritage' => 'Traditions and history passed down through generations.', 'Inclusive' => 'Welcoming to everyone.', 'Archive' => 'A collection of historical records.'],
  'sources' => ['icom', 'un-habitat'],
  'related' => ['community-center', 'place-of-worship', 'public-art'],
],

// ---------------- Work and shopping ----------------
'corner-store' => [
  'name' => 'Corner store', 'latin' => 'neighborhood grocery', 'cat' => 'work', 'src' => 'art/business_1.png',
  'summary' => 'A small shop within walking distance selling food and everyday items, a lifeline for many neighborhoods.',
  'facts' => ['Sells' => 'Food and everyday items', 'Big issue' => 'Food access ("food deserts")', 'Walk time' => 'Ideally a few minutes from home', 'Often run by' => 'Local families'],
  'sections' => [
    ['Why local shops matter', [
      'A corner store lets people buy milk, bread and fruit without driving. For older people, families without a car and busy parents, being able to walk to a shop makes daily life much easier.',
      'Some neighborhoods have no supermarket nearby. The US Department of Agriculture maps "low-access" areas, where many people live far from a supermarket, often called food deserts. If the only nearby shop sells mostly snacks, it is harder to eat well.',
    ]],
    ['How towns help', [], ['list' => [
      'Allowing small shops in residential areas instead of banning them through zoning.',
      'Programs that help corner stores stock fresh fruit and vegetables.',
      'Farmers\' markets and community gardens.',
      'Safe footpaths and bus routes to larger food shops.',
    ]]],
    ['A neighborhood hub', [
      'Corner shops are often family-run businesses that know their customers by name. They can be places to pick up news, leave a parcel or ask for help, part of what makes a neighborhood feel like a community.',
    ]],
  ],
  'art' => 'This illustration shows a brick corner shop with green and white striped awnings.',
  'look' => ['Find the shop awnings and windows.', 'How might customers arrive: on foot, by bike or by car?'],
  'questions' => ['What can you reach on foot from home in ten minutes?', 'Why might a small shop be important even if there is a big supermarket further away?', 'How could a town help people get healthy food?'],
  'words' => ['Food desert' => 'An area where it is hard to buy fresh, affordable food.', 'Zoning' => 'Rules about what can be built where.', 'Local business' => 'A business owned by people in the community.'],
  'sources' => ['usda-food', 'jacobs'],
  'related' => ['mixed-use-building', 'community-garden', 'warehouse'],
],

'office-building' => [
  'name' => 'Office building', 'latin' => 'workplace', 'cat' => 'work', 'src' => 'art/business_2.png',
  'summary' => 'A building of desks, meeting rooms and computers where many people do their jobs.',
  'facts' => ['Used for' => 'Desk-based work and meetings', 'Needs' => 'Light, fresh air, power, data', 'Changing' => 'More remote and hybrid work since 2020', 'Big energy users' => 'Lighting, heating, cooling, computers'],
  'sections' => [
    ['Why offices exist', [
      'Many jobs involve working with information: accounting, design, law, government, customer service and more. Offices bring teams together so that they can share ideas, meet clients and use shared equipment.',
      'Since 2020 many people have worked partly from home. That is changing how offices are designed, with more meeting and collaboration spaces and fewer rows of desks, and some empty offices are being converted into homes.',
    ]],
    ['How an office building is built', [
      'Most modern offices use a steel or concrete frame, which lets floors be open and flexible: walls can be moved as teams change. The outside is often a "curtain wall" of glass and metal panels hung on the frame. Raised floors or ceiling spaces hide cables, ducts and pipes.',
    ]],
    ['A healthy workplace', [
      'People spend many hours in offices, so daylight, fresh air, comfortable temperatures and quiet places to concentrate matter. Buildings use a lot of energy, so efficient lighting, good insulation and smart controls help cut costs and emissions. Green building rating systems reward designs that do this well.',
    ]],
  ],
  'art' => 'This illustration shows a mid-rise brick and glass office building.',
  'look' => ['Find the large windows. How might they help people working inside?', 'Where could workers park a bike or catch a bus?'],
  'questions' => ['How do people get to work here, and what does each way of traveling need?', 'Would you rather work from home or in an office? Why?', 'What could happen to empty office buildings?'],
  'words' => ['Curtain wall' => 'A non-structural outer wall, often of glass.', 'Hybrid work' => 'Splitting time between home and the workplace.', 'Open plan' => 'A large space without many walls.'],
  'sources' => ['iea-build', 'icc'],
  'related' => ['skyscraper', 'mixed-use-building', 'corner-store'],
],

'skyscraper' => [
  'name' => 'Skyscraper', 'latin' => 'high-rise tower', 'cat' => 'work', 'src' => 'art/business_3.png',
  'summary' => 'A very tall building made possible by steel frames and safe elevators, and a symbol of the modern city.',
  'facts' => ['Made possible by' => 'Steel frames and safety elevators', 'Often called the first' => 'Home Insurance Building, Chicago (1885)', 'Safety brake demonstrated' => 'Elisha Otis, 1854', 'Tallest today' => 'Burj Khalifa, 828 m'],
  'sections' => [
    ['Two inventions that changed cities', [
      'Before the 1850s, people did not want to climb more than five or six flights of stairs, and walls of thick stone limited how tall buildings could be. Two inventions changed that. In 1854 Elisha Otis demonstrated a safety brake that stopped an elevator from falling if its rope broke, making passenger elevators trustworthy. Then engineers began using frames of iron and steel to carry a building\'s weight, so walls no longer had to.',
      'The Home Insurance Building in Chicago, completed in 1885, is often called the first skyscraper because of its metal frame.',
    ]],
    ['How a skyscraper works', [], ['list' => [
      'A steel or concrete frame carries the weight down to deep foundations.',
      'A stiff core and bracing resist wind and earthquakes.',
      'Elevators are grouped into zones, with express elevators to "sky lobbies" in the tallest towers.',
      'Pumps push water to the top floors.',
      'Fire safety systems include sprinklers, fire-resistant stairs and pressurized escape routes.',
    ]]],
    ['The art deco style', [
      'Many skyscrapers of the 1920s and 1930s, such as the Chrysler Building and Empire State Building in New York, were built in the Art Deco style, with stepped tops, vertical lines and decorative metalwork. New York\'s 1916 zoning law required tall buildings to step back as they rose, so that light and air could still reach the street.',
    ]],
  ],
  'art' => 'This illustration shows a stepped Art Deco style tower with a spire.',
  'look' => ['Find the setbacks where the tower steps in as it rises.', 'Look at the spire. Is it for people or just for show?'],
  'questions' => ['Why do cities build skyscrapers?', 'How might a tall building affect the street below: light, wind, crowds?', 'What would you put at the top of a skyscraper?'],
  'words' => ['Setback' => 'A step back in the face of a building as it rises.', 'Art Deco' => 'A bold, decorative style from the 1920s and 1930s.', 'Sky lobby' => 'A floor where people change between elevators.'],
  'sources' => ['brit-sky', 'ctbuh'],
  'related' => ['residential-tower', 'office-building', 'tower-crane'],
],

'warehouse' => [
  'name' => 'Warehouse', 'latin' => 'distribution center', 'cat' => 'work', 'src' => 'art/nt_workshop.png',
  'summary' => 'A large shed where goods are stored, sorted and sent out, the hidden link between factories and shops.',
  'facts' => ['Used for' => 'Storing and sorting goods', 'Key inventions' => 'Shipping containers and barcodes', 'Busy because of' => 'Online shopping', 'Usually found' => 'Near highways, ports and railways'],
  'sections' => [
    ['Why towns need warehouses', [
      'Almost everything you buy has passed through a warehouse. Goods arrive from factories and farms in bulk, are stored, then split into smaller orders for shops or for delivery to homes. Warehouses help keep shelves stocked and smooth out the gap between when things are made and when people buy them.',
    ]],
    ['How a modern warehouse works', [
      'Goods often travel in standard shipping containers, an idea developed in the 1950s, which can move from ship to train to truck without being unpacked. Barcodes, first scanned in a shop in 1974, and computer systems track every item. Some warehouses use robots to carry shelves to workers or to sort parcels.',
      'Warehouses are simple to build: a steel frame, a wide-span roof, a concrete floor strong enough for forklifts, and loading docks for trucks. Large flat roofs are good places for solar panels.',
    ]],
    ['Effects on a town', [
      'Warehouses provide many jobs, but they also bring truck traffic, noise and pollution to nearby streets. Planners try to place them near major roads and railways, away from homes, and many now require electric vehicles and loading bays that keep trucks off residential streets.',
    ]],
  ],
  'art' => 'This illustration shows a steel warehouse with a large roller door and skylights.',
  'look' => ['Find the roller door. What size of vehicle could use it?', 'Notice the skylights in the roof.'],
  'questions' => ['Pick something you own. How many places might it have traveled through to reach you?', 'What are the good and bad effects of a warehouse next to homes?', 'How could deliveries be made cleaner and quieter?'],
  'words' => ['Logistics' => 'Organizing how goods are moved and stored.', 'Loading dock' => 'A platform where trucks load and unload.', 'Barcode' => 'Lines a scanner reads to identify a product.'],
  'sources' => ['bls-ware', 'brit-cont'],
  'related' => ['corner-store', 'office-building', 'lighthouse'],
],

// ---------------- Gathering and community ----------------
'community-center' => [
  'name' => 'Community center', 'latin' => 'neighborhood center', 'cat' => 'gather', 'src' => 'art/shared_3.png',
  'summary' => 'A shared building for classes, clubs, meetings, celebrations and support, open to the whole neighborhood.',
  'facts' => ['Used for' => 'Classes, clubs, meetings, events', 'Usually run by' => 'Local government or charities', 'Also used as' => 'Shelter in emergencies', 'Key idea' => '"Third places" outside home and work'],
  'sections' => [
    ['Why neighborhoods need them', [
      'The sociologist Ray Oldenburg described "third places": spaces outside home (the first place) and work or school (the second) where people meet, talk and build friendships. Community centers are one of the most important third places, because they are free or cheap and open to everyone.',
    ]],
    ['What happens there', [], ['list' => [
      'Classes for adults and after-school clubs for children.',
      'Lunches and activities for older people, who may otherwise be lonely.',
      'Meetings of residents\' groups, charities and clubs.',
      'Celebrations such as birthdays, weddings and festivals.',
      'Advice on jobs, benefits or housing.',
      'Shelter, warmth or cooling during storms, heatwaves and emergencies.',
    ]]],
    ['Designing for many uses', [
      'A community center needs a large hall that can be set up in different ways, smaller rooms, a kitchen, accessible toilets and storage. Movable walls, good acoustics and an entrance on the ground floor help it serve everyone.',
    ]],
  ],
  'art' => 'This illustration shows a timber and stone building with large windows and a welcoming entrance.',
  'look' => ['Notice the large windows. What activities might happen inside?', 'Find the benches and paths outside.'],
  'questions' => ['What services or activities would you put in a community center?', 'Where are the "third places" in your life?', 'Why might a community center matter during an emergency?'],
  'words' => ['Third place' => 'A social space outside home and work.', 'Volunteer' => 'Someone who helps without being paid.', 'Multi-purpose' => 'Designed for many uses.'],
  'sources' => ['oldenburg', 'un-habitat'],
  'related' => ['gathering-circle', 'public-library', 'health-clinic'],
],

'plaza-fountain' => [
  'name' => 'Public square and fountain', 'latin' => 'plaza', 'cat' => 'gather', 'src' => 'art/fountain.png',
  'summary' => 'An open square with a fountain, seating and flowers where people meet, rest and celebrate.',
  'facts' => ['Purpose' => 'Meeting, resting, events', 'Good squares have' => 'Seating, shade, things to watch', 'Water helps' => 'Cooling, sound, play', 'Open to' => 'Everyone'],
  'sections' => [
    ['Why cities need squares', [
      'Since ancient times, from the Roman forum to the market squares of medieval towns, people have gathered in open public spaces. A good square is where friends meet, children play, markets set up, and a town celebrates or protests.',
    ]],
    ['What makes a square work', [
      'Researchers who have watched how people use squares found that simple things matter most: plenty of places to sit, shade and sun, food nearby, and something to watch, such as people, water or performers. Squares surrounded by shops and homes stay busy and feel safe.',
    ], ['list' => [
      'Seating: benches, steps and movable chairs.',
      'Shade: trees and awnings for hot days.',
      'Water: fountains for cooling, sound and play.',
      'Edges: shops and cafés facing the square.',
      'Access: level paths for wheelchairs and strollers.',
    ]]],
    ['How a fountain works', [
      'Most modern fountains reuse the same water. A pump pushes water up through nozzles, it falls into the basin, is filtered and treated to keep it clean, and then pumped round again. The sound of splashing water can soften traffic noise and help people relax.',
    ]],
    ['Watching people', [
      'In the 1970s, the writer William H. Whyte and his team filmed New York City\'s plazas to find out why some were busy and others empty. The busiest had plenty of places to sit, especially chairs that people could move, and sat close to the street. He also noticed that people are drawn to places where other people already are.',
    ]],
  ],
  'art' => 'This illustration shows a round fountain with flower beds and benches.',
  'look' => ['Find the places to sit.', 'Where would you stand to feel the cool spray?'],
  'questions' => ['What makes a public square feel welcoming: seating, shade, water, quiet?', 'What events would you hold in a town square?', 'Why might some people avoid a square, and how could that change?'],
  'words' => ['Plaza' => 'An open public square.', 'Public space' => 'A place open to everyone.', 'Recirculating' => 'Water that is pumped round and reused.'],
  'sources' => ['un-habitat', 'jacobs', 'epa-heat', 'whyte'],
  'related' => ['public-art', 'gathering-circle', 'water-system'],
],

'place-of-worship' => [
  'name' => 'Church', 'latin' => 'place of worship', 'cat' => 'gather', 'src' => 'art/family_3.png',
  'summary' => 'A church with a tall spire, where Christians gather to worship God, and which often serves the whole town too.',
  'facts' => ['Used for' => 'Worship, weddings, baptisms, funerals', 'Often offers' => 'Food banks, childcare, shelter, meeting rooms', 'Design' => 'Spire, bell, nave, stained glass', 'Usually meets' => 'On Sundays'],
  'sections' => [
    ['A place to worship together', [
      'A church is where Christians meet, usually on Sundays, to worship God together: to sing, pray, read the Bible and learn from it. Churches also mark big moments in life, such as baptisms, weddings and funerals.',
      'Many churches serve the whole town, whatever people believe: running food banks, toddler groups, youth clubs and support for people in difficulty, and lending their halls for local meetings and events.',
    ]],
    ['How a church is designed', [
      'Many churches have a tall tower or spire, often with a bell to call people to services, and a long main hall called the nave, where people sit. Stained-glass windows, made from pieces of colored glass, often show stories from the Bible, so that people who could not read could still learn them.',
    ]],
    ['Part of the town\'s history', [
      'Old churches are often among the oldest buildings in a town, with records of local families going back centuries. Their towers and spires were once landmarks visible for miles.',
    ]],
  ],
  'art' => 'This illustration shows a white wooden church with a tall spire, like many churches in small American towns.',
  'look' => ['Find the spire. Why might it be so tall?', 'Notice the garden and paths around the building.'],
  'questions' => ['What churches are in your area, and what do they look like?', 'How do churches help people in their town?', 'Why do you think so many church windows tell Bible stories?'],
  'words' => ['Worship' => 'Praising and honoring God.', 'Spire' => 'A tall, pointed top of a tower.', 'Nave' => 'The long main hall of a church, where people sit.'],
  'sources' => ['pew', 'brit-stained'],
  'related' => ['cultural-center', 'community-center', 'memorial'],
],

'gathering-circle' => [
  'name' => 'Outdoor gathering circle', 'latin' => 'fire circle', 'cat' => 'gather', 'src' => 'art/shared_1.png',
  'summary' => 'A ring of benches around a fire pit in a park, a simple place for stories, music and outdoor lessons.',
  'facts' => ['Used for' => 'Gatherings, stories, outdoor learning', 'Cost' => 'Low to build', 'Safety' => 'Fire rules and supervision', 'Works best' => 'In parks near homes and schools'],
  'sections' => [
    ['Why a circle?', [
      'People have gathered around fires for hundreds of thousands of years. Sitting in a circle, everyone can see and hear each other, and no seat is more important than another. A simple ring of benches makes it easy for neighbors, scouts, school classes or families to meet outdoors.',
    ]],
    ['What it is used for', [], ['list' => [
      'Outdoor lessons and nature clubs.',
      'Story-telling, music and community celebrations.',
      'Quiet sitting and talking on summer evenings.',
      'Seasonal events like marking the longest night of the year.',
    ]]],
    ['Fire safety', [
      'Open fires need care. Fire circles need a ring of stone or metal, clear space around them, water or an extinguisher nearby, and adult supervision. In dry weather many towns ban open fires completely because of wildfire risk. Some gathering circles use a lantern or a gas fire instead.',
    ]],
  ],
  'art' => 'This illustration shows log benches around a fire pit, with lanterns and planting.',
  'look' => ['Count the benches. How many people could sit here?', 'Find the lanterns. Why might they be useful?'],
  'questions' => ['What makes an outdoor meeting place comfortable for everyone?', 'Why might sitting in a circle change how people talk?', 'What rules would keep a fire circle safe?'],
  'words' => ['Fire pit' => 'A safe, contained place for a fire.', 'Outdoor learning' => 'Lessons that happen outside.', 'Supervision' => 'Watching to keep people safe.'],
  'sources' => ['oldenburg', 'nifc'],
  'related' => ['community-center', 'park-pond', 'plaza-fountain'],
],

'memorial' => [
  'name' => 'Memorial', 'latin' => 'monument', 'cat' => 'gather', 'src' => 'art/monument.png',
  'summary' => 'A monument that helps a community remember people and events from its past.',
  'facts' => ['Purpose' => 'Remembering people and events', 'Famous obelisk' => 'Washington Monument (completed 1884)', 'Famous memorial' => 'Vietnam Veterans Memorial (1982)', 'Big question' => 'Who and what gets remembered?'],
  'sections' => [
    ['Why towns build memorials', [
      'Memorials honor people who died in wars or disasters, celebrate important events, and remind future generations of lessons from the past. Many towns have a war memorial where people gather on days of remembrance.',
    ]],
    ['Different ways to remember', [
      'Some memorials are tall and grand, like the Washington Monument, a stone obelisk in Washington, DC, completed in 1884. Construction stopped for many years, and you can still see a change in the color of the stone partway up where building began again with stone from a different quarry.',
      'Others are quiet and personal. The Vietnam Veterans Memorial, designed by Maya Lin when she was a 21-year-old architecture student and opened in 1982, is a low black wall carved with the names of more than 58,000 people. Visitors see their own reflection among the names.',
    ]],
    ['Changing memories', [
      'What a community chooses to remember can change. Some statues and monuments have been moved or explained with new signs, because people today see the people or events they honor differently. Deciding who to remember, and how, is a conversation every generation has.',
    ]],
  ],
  'art' => 'This illustration shows a tall stone obelisk in a small paved plaza with planting.',
  'look' => ['Find the obelisk shape. Where else have you seen one?', 'Where could people stand or sit to remember?'],
  'questions' => ['What would you want your town to remember, and how?', 'Why might people disagree about a monument?', 'Is a tall monument or a quiet one more powerful? Why?'],
  'words' => ['Obelisk' => 'A tall, four-sided stone pillar with a pointed top.', 'Memorial' => 'Something built to remember people or events.', 'Remembrance' => 'The act of remembering, often together.'],
  'sources' => ['nps-memorial', 'brit-vvm'],
  'related' => ['public-art', 'capitol', 'plaza-fountain'],
],

'public-art' => [
  'name' => 'Public art', 'latin' => 'statue and sculpture', 'cat' => 'gather', 'src' => 'art/nt_statue.png',
  'summary' => 'Statues, sculptures and murals in public places that anyone can enjoy, free of charge.',
  'facts' => ['Free to see' => 'Yes, it is outdoors', 'Funding idea' => '"Percent for Art"', 'First US city program' => 'Philadelphia, 1959', 'Forms' => 'Statues, murals, sculptures, light art'],
  'sections' => [
    ['Why towns invest in art', [
      'Public art makes places memorable, tells local stories, sparks conversation and gives people landmarks to meet by. Unlike art in a gallery, it is free and in everyone\'s daily path.',
    ]],
    ['Percent for Art', [
      'In 1959 Philadelphia became the first American city to require that a small share of the cost of certain new buildings, about one percent, be spent on public art. Many cities and countries have since adopted "percent for art" rules, which have paid for thousands of sculptures, murals and installations.',
    ]],
    ['Making public art', [
      'A public artwork has to survive weather, sunlight and lots of touching, so artists choose tough materials such as bronze, stone, steel or weatherproof paint. Many projects involve local people in choosing the artist, sharing stories or even helping to paint a mural, so that the art reflects the community.',
    ]],
  ],
  'art' => 'This illustration shows a bronze statue on a stone plinth, with benches and planting around it.',
  'look' => ['Look at the statue\'s pose. What do you think it means?', 'Where could people sit and look?'],
  'questions' => ['What artwork would you create for your town, and where would you put it?', 'Who should choose public art: experts, leaders or residents?', 'Can art make a place feel safer or friendlier?'],
  'words' => ['Plinth' => 'A base that a statue stands on.', 'Mural' => 'A large painting on a wall.', 'Bronze' => 'A tough metal often used for statues.'],
  'sources' => ['percent', 'afta'],
  'related' => ['memorial', 'plaza-fountain', 'cultural-center'],
],

// ---------------- Parks, sport and play ----------------
'park-pond' => [
  'name' => 'City park', 'latin' => 'urban green space', 'cat' => 'play', 'src' => 'art/growth_1.png',
  'summary' => 'Trees, grass, paths and water in the middle of town: free space to play, relax and cool down.',
  'facts' => ['Famous early park' => 'Central Park, New York (designed 1858)', 'Goal' => 'A park within a 10-minute walk of every home', 'Cools the city' => 'Shade and plants reduce heat', 'Also' => 'Soaks up rainwater'],
  'sections' => [
    ['Why parks matter', [
      'Parks give people places to exercise, play, picnic and relax, which supports both physical and mental health. Trees and plants cool the air through shade and by releasing water, helping reduce the "urban heat island" effect that makes cities hotter than the countryside.',
      'Parks also soak up rain, provide homes for birds and insects, and give neighbors a free place to meet.',
    ]],
    ['A park for everyone', [
      'In 1858 Frederick Law Olmsted and Calvert Vaux won the competition to design Central Park in New York, believing that green space should be open to people of every class. Today, organizations such as the Trust for Public Land promote the goal that everyone should live within a 10-minute walk of a good park, because in many cities poorer neighborhoods have far less green space.',
    ]],
    ['How a park is designed and cared for', [], ['list' => [
      'Paths that are level and wide enough for wheelchairs and strollers.',
      'A mix of open lawns, shady trees and quiet corners.',
      'Ponds and rain gardens that collect and clean storm water.',
      'Toilets, drinking fountains, lighting and seating.',
      'Gardeners and volunteers who plant, prune and pick up litter.',
    ]]],
  ],
  'art' => 'This illustration shows a small park with a pond, rocks, trees and a winding path.',
  'look' => ['Follow the path around the pond. Who could use it?', 'Find the places where water could collect after rain.'],
  'questions' => ['How might parks help a city with heat, rainwater and wellbeing?', 'Is there a park within a 10-minute walk of your home?', 'What would you add to make a park better for teenagers, or for older people?'],
  'words' => ['Urban heat island' => 'When cities are hotter than the surrounding countryside.', 'Rain garden' => 'A planted dip that soaks up rainwater.', 'Biodiversity' => 'The variety of living things in a place.'],
  'sources' => ['olmsted', 'tpl', 'epa-heat', 'who-pa'],
  'related' => ['playground', 'community-garden', 'gathering-circle'],
],

'playground' => [
  'name' => 'Treehouse playground', 'latin' => 'adventure playground', 'cat' => 'play', 'src' => 'art/shared_2.png',
  'summary' => 'A play space with climbing, hiding and building, where children take healthy risks and use their imagination.',
  'facts' => ['Children\'s right' => 'Play is a right (UN, 1989, Article 31)', 'First adventure playground' => 'Emdrup, Copenhagen (1943)', 'Safety' => 'Soft surfaces, safe heights', 'Daily activity goal' => '60 minutes for children (WHO)'],
  'sections' => [
    ['Why play matters', [
      'Play helps children grow strong, solve problems, make friends and manage feelings. The UN Convention on the Rights of the Child recognizes play as a right of every child, and the World Health Organization recommends that children and teenagers get an average of 60 minutes of physical activity a day.',
    ]],
    ['The adventure playground idea', [
      'In 1943 the Danish landscape architect C. Th. Sørensen noticed that children preferred playing on building sites to neat playgrounds. A "junk playground" opened at Emdrup, near Copenhagen, where children could build with wood, ropes and tools under the eye of a playworker. The idea spread to Britain and beyond as the adventure playground movement.',
    ]],
    ['Designing safe, exciting play', [
      'Good playgrounds offer challenge, such as climbing higher, balancing and swinging, while keeping serious injuries rare. Safety guides recommend shock-absorbing surfaces under equipment, safe heights and gaps, and no sharp edges. Inclusive playgrounds add ramps, wide platforms and equipment that children using wheelchairs can enjoy.',
    ]],
  ],
  'art' => 'This illustration shows a treehouse built into a large tree with ladders, platforms and rope bridges.',
  'look' => ['Find the ladders and platforms. Which way up is the most challenging?', 'Is there a way in for a child who uses a wheelchair?'],
  'questions' => ['What is the best playground you have been to, and why?', 'Why might a little risk be good for children?', 'How could a playground be fun for children of all abilities?'],
  'words' => ['Playworker' => 'An adult trained to support children\'s free play.', 'Inclusive' => 'Designed so everyone can join in.', 'Safety surfacing' => 'Soft ground that cushions falls.'],
  'sources' => ['crc', 'emdrup', 'cpsc', 'who-pa'],
  'related' => ['park-pond', 'school', 'sports-field'],
],

'sports-field' => [
  'name' => 'Sports field', 'latin' => 'playing field', 'cat' => 'play', 'src' => 'art/fitness_2.png',
  'summary' => 'An open field with goals and lights where people play soccer and other team sports.',
  'facts' => ['Used for' => 'Team sports and training', 'Surfaces' => 'Natural grass or artificial turf', 'Lights' => 'Allow evening games', 'Shared by' => 'Schools, clubs and the public'],
  'sections' => [
    ['Why towns need playing fields', [
      'Team sports keep people active, teach teamwork and build friendships. The World Health Organization recommends that adults get at least 150 minutes of moderate activity a week, and local fields make that easy and affordable.',
    ]],
    ['Grass or artificial turf?', [
      'Natural grass is cooler on hot days, soaks up rain and supports insects and soil life, but it can be damaged by heavy use and needs mowing, watering and rest. Artificial turf can be used in all weather, but it gets much hotter in the sun, does not absorb heat or water in the same way, and some types shed tiny rubber or plastic pieces. Towns weigh up these trade-offs.',
    ]],
    ['How a field is built', [
      'Under a good field is a layer of drainage: gravel and pipes that carry rainwater away so games are not canceled. Fences keep balls in, lights on tall poles allow evening games, and there are changing rooms, toilets and seating for spectators.',
    ]],
  ],
  'art' => 'This illustration shows a fenced soccer field with goals and floodlights.',
  'look' => ['Find the floodlights. When would they be used?', 'Notice the fence. What is it for?'],
  'questions' => ['Who gets to use a public field, and when?', 'Would you choose grass or artificial turf? Why?', 'How could a sports field also be used by people who do not play sport?'],
  'words' => ['Artificial turf' => 'A surface of plastic grass.', 'Drainage' => 'Removing water from the ground.', 'Floodlights' => 'Bright lights for evening play.'],
  'sources' => ['who-pa', 'epa-heat'],
  'related' => ['stadium', 'recreation-center', 'playground'],
],

'stadium' => [
  'name' => 'Stadium', 'latin' => 'arena', 'cat' => 'play', 'src' => 'art/fitness_3.png',
  'summary' => 'A huge venue where tens of thousands of fans watch sport and concerts together.',
  'facts' => ['Ancient ancestors' => 'Greek stadiums, Roman amphitheaters', 'Crowd' => 'Tens of thousands', 'Biggest challenge' => 'Moving crowds safely', 'Debate' => 'Who pays, and who benefits?'],
  'sections' => [
    ['Why cities build stadiums', [
      'Stadiums host the big moments that bring people together: championship games, concerts and festivals. The word comes from the ancient Greek "stadion", a running track, and the Roman Colosseum shows how long people have gathered in vast crowds.',
    ]],
    ['How a stadium works', [
      'The seating bowl is designed so every seat can see the field, with rows rising steeply enough to see over the people in front. Roofs or canopies protect fans from rain. Huge numbers of people must arrive and leave safely, so engineers model crowd flows and design wide stairs, many exits and links to trains and buses.',
    ], ['list' => [
      'Steel or concrete stands with clear sightlines.',
      'Floodlights, giant screens and sound systems.',
      'Kitchens, toilets, first-aid rooms and security.',
      'Grass or hybrid fields kept healthy with lighting rigs and under-soil heating in some stadiums.',
    ]]],
    ['Costs and benefits', [
      'Stadiums are very expensive. Cities sometimes pay part of the cost with public money, hoping for jobs and visitors. Researchers often find the economic benefits are smaller than promised, so many towns now debate who should pay, and how the stadium can be used on days without matches.',
    ]],
  ],
  'art' => 'This illustration shows a soccer stadium with red seats and floodlights. It is much smaller than a real stadium.',
  'look' => ['Look at how the seats rise around the field.', 'Find the floodlights.'],
  'questions' => ['Compare this with the Roman amphitheater. What is the same, and what is different?', 'Should cities pay to build stadiums for private teams?', 'How can tens of thousands of people leave a stadium safely?'],
  'words' => ['Sightline' => 'A clear view from a seat to the field.', 'Capacity' => 'How many people a place can hold.', 'Crowd management' => 'Planning how large crowds move safely.'],
  'sources' => ['brit-stadium', 'nfpa'],
  'related' => ['sports-field', 'recreation-center', 'plaza-fountain'],
],

'recreation-center' => [
  'name' => 'Recreation center', 'latin' => 'gym and fitness center', 'cat' => 'play', 'src' => 'art/fitness_1.png',
  'summary' => 'A building with gym equipment and classes where people of every age can exercise, whatever the weather.',
  'facts' => ['Used for' => 'Exercise, classes, sport', 'Adults need' => '150 minutes of moderate activity a week (WHO)', 'Children need' => 'About 60 minutes a day', 'Public centers' => 'Keep prices low'],
  'sections' => [
    ['Why exercise needs a place', [
      'Regular physical activity lowers the risk of heart disease, diabetes and some cancers, and helps mental health. The World Health Organization recommends that adults get at least 150 to 300 minutes of moderate activity each week, and that children and teenagers get an average of 60 minutes a day.',
      'Many people find it easier to exercise with equipment, classes and other people around, especially when it is dark, cold or very hot outside.',
    ]],
    ['What is inside', [], ['list' => [
      'Gym floors with weights, treadmills and bikes.',
      'Studios for dance, yoga and fitness classes.',
      'Sports halls and sometimes swimming pools.',
      'Changing rooms, showers and accessible facilities.',
    ]]],
    ['A place for everyone', [
      'Public recreation centers are often run by the town and keep prices low, with discounts for young people, older people and people on low incomes. Good design includes step-free access, equipment for different abilities, and classes for people who are new to exercise.',
    ]],
  ],
  'art' => 'This illustration shows a gym with large glass windows and exercise machines inside.',
  'look' => ['Look through the windows. What equipment can you see?', 'Find the bike rack outside.'],
  'questions' => ['What makes it easier or harder for people to exercise regularly?', 'Should public gyms be free? Who would pay?', 'How could a gym welcome people who feel nervous about exercise?'],
  'words' => ['Moderate activity' => 'Exercise that makes you breathe faster but still able to talk.', 'Cardio' => 'Exercise that works the heart and lungs.', 'Strength training' => 'Exercise that builds muscle.'],
  'sources' => ['who-pa', 'nrpa'],
  'related' => ['sports-field', 'stadium', 'health-clinic'],
],

'community-garden' => [
  'name' => 'Community garden', 'latin' => 'garden plots', 'cat' => 'play', 'src' => 'art/nt_garden.png',
  'summary' => 'Shared land where neighbors grow vegetables, fruit and flowers together.',
  'facts' => ['Grows' => 'Vegetables, fruit, herbs, flowers', 'Raised beds' => 'Easier to reach and keep clean', 'In wartime' => 'Millions of "victory gardens"', 'Brings' => 'Food, exercise, friendship, wildlife'],
  'sections' => [
    ['Why grow food in town?', [
      'Community gardens give people without gardens a place to grow fresh food. During both World Wars, governments encouraged people to plant "victory gardens" in yards, parks and empty lots, and millions did. Today community gardens provide food, exercise, outdoor learning and a way to meet neighbors.',
      'Gardens also help nature: flowers feed bees and butterflies, compost improves soil, and plants soak up rain.',
    ]],
    ['How a community garden works', [], ['list' => [
      'Members rent or share small plots and agree on rules.',
      'Raised beds make gardening easier for people who cannot kneel, and help where city soil is poor or polluted.',
      'Shared tools, water tanks and compost bins are looked after together.',
      'Many gardens donate extra food to food banks.',
    ]]],
    ['Testing city soil', [
      'Soil in cities can contain lead or other pollution from old paint, traffic or industry. Gardeners test the soil and often use raised beds filled with clean soil, especially for growing vegetables.',
    ]],
  ],
  'art' => 'This illustration shows raised beds full of vegetables and flowers, with paths and a small shed.',
  'look' => ['Find the raised beds. Why might they be raised?', 'What different plants can you spot?'],
  'questions' => ['Who should decide how shared land is used?', 'What would you grow if you had a plot?', 'How could a community garden welcome people who have never gardened?'],
  'words' => ['Raised bed' => 'A garden bed built up above the ground.', 'Compost' => 'Rotted plant waste that feeds the soil.', 'Plot' => 'A small piece of land.'],
  'sources' => ['acga', 'usda-food', 'epa-lead'],
  'related' => ['park-pond', 'corner-store', 'community-center'],
],

// ---------------- Building the town ----------------
'tower-crane' => [
  'name' => 'Tower crane', 'latin' => 'construction crane', 'cat' => 'build', 'src' => 'build/crane.png',
  'summary' => 'A tall crane that lifts steel, concrete and glass to the upper floors of new buildings.',
  'facts' => ['Elevators' => 'Steel, concrete buckets, panels', 'Balance' => 'Counterweights on the short arm', 'Grows with the building' => 'Climbing cranes add sections', 'Controlled by' => 'An operator in the cab, guided by signalers'],
  'sections' => [
    ['Why cranes are needed', [
      'Modern buildings are made of heavy parts: steel beams, bundles of reinforcing bars, concrete buckets, glass panels. Tower cranes lift these quickly and precisely to where they are needed, sometimes hundreds of meters up.',
    ]],
    ['How a tower crane works', [], ['list' => [
      'A concrete foundation or the building itself anchors the tall mast.',
      'The long working arm (the jib) carries a trolley that moves the hook in and out.',
      'The short arm carries heavy concrete counterweights to balance the load.',
      'The whole top slews (turns) on a ring.',
      'The operator sits in a cab at the top; a signaler on the ground guides them by radio.',
    ]], [
      'Many tower cranes "climb" as the building rises: the crane lifts a new mast section, slides it into place, and raises itself onto it.',
    ]],
    ['Safety', [
      'Cranes are dangerous if overloaded or used in high wind. Each crane has a load chart showing how much it can lift at each distance from the mast, and computers warn the operator if a lift is too heavy. Workers are trained and certified, and areas under the load are kept clear.',
    ]],
  ],
  'art' => 'This illustration shows a yellow tower crane lifting a load. The soft glow is part of the original artwork.',
  'look' => ['Find the counterweight on the short arm.', 'Follow the cable from the trolley to the hook.'],
  'questions' => ['Building sites can block sidewalks. How can a town keep people safe and moving while it builds?', 'Why does a crane need a counterweight?', 'How might a crane get to the top of a tall building, and back down?'],
  'words' => ['Jib' => 'The long horizontal arm of a crane.', 'Counterweight' => 'A heavy weight that balances a load.', 'Load chart' => 'A table of how much a crane can safely lift.'],
  'sources' => ['osha', 'brit-mat'],
  'related' => ['building-materials', 'skyscraper', 'residential-tower'],
],

'building-materials' => [
  'name' => 'Building materials', 'latin' => 'brick, timber, concrete and steel', 'cat' => 'build', 'src' => 'build/materials.png',
  'summary' => 'Bricks, timber, concrete and steel each have strengths, costs and effects on the planet.',
  'facts' => ['Most used' => 'Concrete', 'Cement emissions' => 'Several percent of global CO2', 'Low-carbon option' => 'Mass timber (engineered wood)', 'Reuse' => 'Saves energy and materials'],
  'sections' => [
    ['Choosing materials', [
      'Every material has strengths. Brick is durable and fire-resistant. Timber is light and renewable and stores carbon taken from the air by trees. Steel is very strong in tension and can span long distances. Concrete is cheap, strong in compression and can be poured into any shape, and with steel bars inside (reinforced concrete) it becomes strong in tension too.',
    ]],
    ['The carbon cost of building', [
      'Making cement, the glue in concrete, releases carbon dioxide, both from fuel burned in kilns and from the chemical reaction of heating limestone. A 2018 Chatham House report estimated that cement production accounts for around 8 percent of global carbon dioxide emissions; other estimates are lower, but all agree it is significant.',
      'Engineers are cutting this by using less cement, replacing some of it with other materials, designing lighter structures and reusing old buildings.',
    ]],
    ['Building with wood again', [
      'New engineered woods, such as cross-laminated timber, glue layers of boards together at right angles to make large, strong panels. These can be used to build apartment and office buildings many stories high. Wood from well-managed forests can store carbon for the life of the building.',
    ]],
  ],
  'art' => 'This illustration shows bricks, timber, cement bags and a traffic cone on a pallet, ready for a building site.',
  'look' => ['Find the bricks, timber and cement bags.', 'Why is there a traffic cone?'],
  'questions' => ['Where do building materials come from, and how do they reach the site?', 'Why might reusing an old building be better for the planet than building new?', 'Would you live in a tall building made of wood? Why or why not?'],
  'words' => ['Reinforced concrete' => 'Concrete with steel bars inside.', 'Embodied carbon' => 'The emissions from making and transporting materials.', 'Cross-laminated timber' => 'Layers of wood glued crosswise into strong panels.'],
  'sources' => ['chatham', 'brit-mat', 'mass-timber'],
  'related' => ['tower-crane', 'older-home', 'skyscraper'],
],
];

$WORLD_DATA['modern'] = [
  'title'    => 'Modern Town: 36 buildings and how a town works',
  'desc'     => 'Explore an illustrated modern town: 36 buildings and systems, from libraries and clinics to water treatment, and why every town needs them.',
  'intro'    => 'An imagined modern town with real buildings. Open any of its 36 buildings and systems to learn why towns need them, how they are built and how they serve the people who live there.',
  'note'     => 'This town is imagined, not a specific real place. The facts on each page are about real buildings and systems and list their sources.',
  'aka'      => 'Topic',
  'defaultTag' => 'real',
  'aside'    => ['Look around your own town', 'Which of these buildings and systems can you find where you live? Which are missing, and who might miss them most? Try making a map of the places you use in a normal week.'],
  'akaLang'  => '',
  'pageTitle'=> '%s: why towns need it and how it works',
  'pageTitleShort' => '%s in a modern town',
  'pageDesc' => ' Learn why towns need it, how it is built and how it serves people, with photos and questions for discussion.',
  'pageDescShort' => ' Learn why towns need it and how it works.',
  'sourcesIntro' => 'The facts on this page are based on these sources:',
  'about'    => 'City design, infrastructure and public services',
  // Back corner (0) to front corner (35). Streets and water are systems, not buildings,
  // so they appear in the list below the map but not as tiles. 'tree' is a decorative street tree.
  'map' => [
    'tower-crane', 'skyscraper', 'residential-tower', 'clock-tower', 'lighthouse', 'fire-lookout',
    'capitol', 'office-building', 'apartment-building', 'stadium', 'place-of-worship', 'memorial',
    'town-hall', 'public-library', 'school', 'science-center', 'mixed-use-building', 'cultural-center',
    'health-clinic', 'community-center', 'recreation-center', 'older-home', 'single-family-house', 'suburban-house',
    'warehouse', 'corner-store', 'public-art', 'plaza-fountain', 'tree', 'playground',
    'sports-field', 'park-pond', 'community-garden', 'gathering-circle', 'building-materials', 'tree',
  ],
  'tree'     => 'street-tree',
  'sources'  => $MODERN_SOURCES,
  'cats'     => $MODERN_CATEGORIES,
  'pages'    => $MODERN,
];
