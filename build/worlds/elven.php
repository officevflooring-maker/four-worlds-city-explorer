<?php
// Elven Green World: one page per building. Every building is imagined, and each page says so.
// Each page pairs the fantasy with REAL nature-based technology (marked "Real world") and with
// ideas still being researched (marked "Possible future"). Sources are shown as plain text.

$ELVEN_SOURCES = [
  'benyus'     => 'Janine Benyus, "Biomimicry: Innovation Inspired by Nature" (1997)',
  'asknature'  => 'Biomimicry Institute, AskNature database of nature-inspired design',
  'roots'      => 'UNESCO World Heritage Centre, tentative list: "Jingkieng Jri: Living Root Bridge Cultural Landscapes" (2022)',
  'ludwig'     => 'Ferdinand Ludwig and colleagues, research on Baubotanik (building with living trees)',
  'boeri'      => 'Stefano Boeri Architetti, "Bosco Verticale" (Vertical Forest), Milan, 2014',
  'metropol'   => 'Metropol Parasol, Seville, designed by J. Mayer H. (completed 2011)',
  'epa-heat'   => 'US Environmental Protection Agency, "Heat Island Effect" and "Using Trees and Vegetation to Reduce Heat Islands"',
  'epa-green'  => 'US Environmental Protection Agency, "Green Infrastructure": rain gardens and green roofs',
  'epa-wetland'=> 'US Environmental Protection Agency, "Constructed Treatment Wetlands"',
  'arcata'     => 'City of Arcata, California, "Arcata Marsh and Wildlife Sanctuary"',
  'nyc-water'  => 'New York City Department of Environmental Protection, watershed protection program',
  'ipbes'      => 'IPBES, "Assessment Report on Pollinators, Pollination and Food Production" (2016)',
  'xerces'     => 'Xerces Society for Invertebrate Conservation, pollinator habitat guidance',
  'parks-ca'   => 'Parks Canada, "Making roads safer for wildlife" (Banff National Park crossing structures)',
  'knepp'      => 'Isabella Tree, "Wilding" (2018), on the Knepp Estate rewilding project',
  'miyawaki'   => 'Akira Miyawaki, research on native forest restoration; Earthwatch Europe "Tiny Forest" programme',
  'darksky'    => 'DarkSky International (formerly the International Dark-Sky Association)',
  'seedvault'  => 'Crop Trust and the Norwegian Government, "Svalbard Global Seed Vault" (opened 2008), including the first withdrawal of seeds in 2015',
  'unep-food'  => 'United Nations Environment Programme, "Food Waste Index Report 2024"',
  'fao-food'   => 'Food and Agriculture Organization of the United Nations, "Global Food Losses and Food Waste" (2011)',
  'brit-photo' => 'Encyclopaedia Britannica, "Photosynthesis"',
  'nrel'       => 'US National Renewable Energy Laboratory, solar cell efficiency research',
  'kew'        => 'Royal Botanic Gardens, Kew, "Millennium Seed Bank"',
  'forest-sch' => 'Forest School Association (UK), history and principles of forest school',
  'shinrin'    => 'Research reviews on shinrin-yoku ("forest bathing"), a term introduced in Japan in 1982',
  'stri'       => 'Smithsonian Tropical Research Institute, forest canopy research and canopy cranes',
  'epidaurus'  => 'UNESCO World Heritage Centre, "Sanctuary of Asklepios at Epidaurus"',
  'redrocks'   => 'City and County of Denver, "Red Rocks Park and Amphitheater"',
  'pearce'     => 'Mick Pearce, architect, project information on the Eastgate Centre, Harare (1996)',
  'iceland'    => 'Government of Iceland, information on geothermal energy and district heating',
  'doe-hydro'  => 'US Department of Energy, Energy Saver, "Microhydropower Systems"',
  'doe-earth'  => 'US Department of Energy, Energy Saver, "Earth-Sheltered Houses"',
  'ulrich'     => 'Roger Ulrich, "View through a window may influence recovery from surgery", Science (1984)',
  'wilson'     => 'Edward O. Wilson, "Biophilia" (1984)',
  'hyfi'       => 'The Living, "Hy-Fi" mycelium brick tower, MoMA PS1 Young Architects Program (2014)',
  'mycelium'   => 'Research reviews on mycelium-based composite materials',
  'lightbio'   => 'US Department of Agriculture, Animal and Plant Health Inspection Service, review of Light Bio\'s "Firefly Petunia" (2023)',
  'biq'        => 'Arup and IBA Hamburg, "BIQ House" algae bioreactor facade (2013)',
  'ostrom'     => 'Elinor Ostrom, "Governing the Commons" (1990); Nobel Prize in Economic Sciences (2009)',
  'phenology'  => 'USA National Phenology Network and the Woodland Trust "Nature\'s Calendar"; Kyoto cherry blossom records',
  'wales'      => 'Welsh Government, "Well-being of Future Generations (Wales) Act 2015"',
  'fsc'        => 'Forest Stewardship Council (founded 1993)',
  'repair'     => 'Repair Café Foundation (first Repair Café, Amsterdam, 2009)',
  'inbar'      => 'International Bamboo and Rattan Organization (INBAR)',
  'timber'     => 'Council on Tall Buildings and Urban Habitat, data on tall timber buildings (Mjøstårnet, Ascent)',
  'strawbale'  => 'International Code Council, International Residential Code, Appendix on strawbale construction',
  'isa'        => 'International Society of Arboriculture, tree care guidance',
  'lotus'      => 'Wilhelm Barthlott and Christoph Neinhuis, "Purity of the sacred lotus" (1997), on the lotus effect',
  'nps-beaver' => 'US National Park Service, "Beavers" and their role as ecosystem engineers',
];

$ELVEN_CATEGORIES = [
  'grow'    => ['Living buildings', 'Imagined buildings grown from living trees and plants, and the real science of building with them.'],
  'homes'   => ['Homes in the forest', 'Cozy homes that stay comfortable with the help of earth, wood, plants and air.'],
  'water'   => ['Water and energy', 'Springs, wetlands, falling water and the warmth of the earth.'],
  'wild'    => ['Wildlife and wild places', 'Making room for bees, deer, forests and night skies.'],
  'learn'   => ['Learning and gathering', 'Places to learn outdoors, store seeds, watch the seasons and make decisions together.'],
  'make'    => ['Making and trading', 'Markets, workshops and materials that waste little and borrow ideas from nature.'],
];

// Common words for the three kinds of section on these pages.
const ELVEN_IMAGINE = ['tag' => 'imagined'];
const ELVEN_REAL = ['tag' => 'real'];
const ELVEN_NEXT = ['tag' => 'speculative'];

$ELVEN = [

// ---------------- Living buildings ----------------
'great-tree-hall' => [
  'name' => 'Great tree hall', 'latin' => 'grown architecture', 'cat' => 'grow', 'src' => 'art/business_3.png',
  'summary' => 'An imagined hall grown from a living tree. In the real world, people already shape living roots and trunks into bridges and buildings.',
  'facts' => ['Imagined as' => 'A meeting hall grown, not built', 'Real-world idea' => 'Living architecture', 'Real example' => 'Living root bridges, Meghalaya, India', 'Status' => 'Small structures exist; whole halls are imagined'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a hall whose walls are a living trunk and whose roof is a canopy of leaves. It would grow stronger every year, repair its own bark, shade its visitors in summer and let in light in winter as leaves fall. Instead of being knocked down at the end of its life, it would simply keep living.',
    ]],
    ['Living root bridges', ELVEN_REAL, [
      'In the hills of Meghalaya in north-east India, Khasi and Jaintia communities have for generations guided the aerial roots of rubber fig trees (Ficus elastica) across streams. Over many years the roots thicken and fuse into bridges strong enough to walk on, some with two levels. These "living root bridges" can last for centuries and get stronger as they age. In 2022 they were added to UNESCO\'s tentative list for World Heritage status.',
    ]],
    ['Building with trees today', ELVEN_REAL, [
      'Architects and scientists are exploring "Baubotanik", a German word for building with living plants. Young trees are planted in a frame and grafted together so that, as they grow, they become a living structure such as a footbridge or tower. The challenges are time (decades), predicting how trees grow, and keeping them healthy.',
    ]],
  ],
  'art' => 'This illustration shows a hall rising out of a giant tree, with glowing windows and a stairway. It is fantasy, but the idea echoes real living architecture.',
  'look' => ['Find where the building and the tree trunk become one.', 'Notice the roots spreading at the base.'],
  'questions' => ['Would you trust a bridge made of living roots? What would make you feel safe?', 'What are the advantages of a building that grows? What are the problems?', 'Why might it be worth waiting decades for a structure to grow?'],
  'words' => ['Living architecture' => 'Structures made partly from living plants.', 'Grafting' => 'Joining parts of plants so they grow together.', 'Aerial root' => 'A root that grows above the ground.'],
  'sources' => ['roots', 'ludwig', 'benyus'],
  'related' => ['grand-tree-hall', 'treetop-village', 'living-crane'],
],

'grand-tree-hall' => [
  'name' => 'Sunlight hall', 'latin' => 'photosynthetic building', 'cat' => 'grow', 'src' => 'art/shared_3.png',
  'summary' => 'An imagined hall that feeds on sunlight like a leaf. Real buildings already grow algae in their walls to make heat and fuel.',
  'facts' => ['Imagined as' => 'A building powered like a plant', 'Real-world idea' => 'Algae bioreactor facades', 'Real example' => 'BIQ House, Hamburg (2013)', 'Status' => 'Experimental'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Leaves are tiny solar factories: using sunlight, they turn water and carbon dioxide from the air into sugar and oxygen. Imagine a hall whose leaf-covered walls did the same, taking carbon out of the air, making its own energy and breathing out fresh oxygen for the people inside.',
    ]],
    ['A building with algae in its walls', ELVEN_REAL, [
      'In 2013, the BIQ House in Hamburg, Germany, was built with a facade of glass panels filled with water and living microalgae. The algae grow in sunlight and absorb carbon dioxide. Some algae are harvested to make biogas, and the panels also capture heat from the sun and provide shade.',
      'It is a pioneering experiment. Its designers reported that the facade could supply part of the building\'s heat, but the system is complex and expensive, and engineers had to fix problems such as clogged pipes.',
    ]],
    ['Plants versus solar panels', ELVEN_REAL, [
      'Plants are amazing, but they are not very efficient at turning sunlight into stored energy: most crops store only one or two percent of the sunlight that falls on them, while ordinary solar panels convert around a fifth into electricity. Scientists are studying "artificial photosynthesis", which tries to copy the way leaves split water using sunlight, to make clean fuels.',
    ]],
  ],
  'art' => 'This illustration shows a grand hall wrapped in trees, with flowers and waterfalls. Here we imagine it running on sunlight like a leaf.',
  'look' => ['Find the leafy canopy over the roof.', 'Where does water flow around the building?'],
  'questions' => ['If a building could breathe like a plant, what would change about cities?', 'Why might scientists copy leaves even though solar panels are more efficient?', 'Would you want algae in the walls of your home?'],
  'words' => ['Photosynthesis' => 'How plants use sunlight to make food from water and carbon dioxide.', 'Algae' => 'Simple plant-like living things that grow in water.', 'Bioreactor' => 'A container where living things are grown to make something useful.'],
  'sources' => ['biq', 'brit-photo', 'nrel'],
  'related' => ['great-tree-hall', 'crystal-tower', 'leafy-cottage'],
],

'treetop-village' => [
  'name' => 'Treetop village', 'latin' => 'tree-friendly building', 'cat' => 'grow', 'src' => 'art/shared_2.png',
  'summary' => 'An imagined village of homes and bridges among the branches, built so lightly that the trees stay healthy.',
  'facts' => ['Imagined as' => 'Homes high in the canopy', 'Real-world idea' => 'Building that protects trees', 'Real tools' => 'Special treehouse bolts, flexible joints', 'Watch out for' => 'Tree health and access for everyone'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a village where homes rest on branches, linked by rope bridges, leaving the forest floor free for plants and animals. Rainwater would be gathered from leaves, and residents would look after the trees that hold them up.',
    ]],
    ['How to build in a tree without hurting it', ELVEN_REAL, [
      'Trees are living things that grow and sway. Good treehouse builders work with arborists, who are tree-care experts, to choose healthy, strong trees. They use a few large, specially designed bolts instead of many nails, because each wound is a place where disease can enter. Joints are made to slide or flex so that the tree can move in the wind and keep growing without being strangled.',
    ]],
    ['Lessons for real cities', ELVEN_REAL, [
      'The idea of "touching the ground lightly" is used in real architecture: buildings raised on posts or piles disturb less soil, let water flow underneath and protect tree roots. But building high up raises a big question of fairness: rope bridges and ladders shut out people who use wheelchairs, older people and young children. A real treetop village would need ramps or elevators.',
    ]],
  ],
  'art' => 'This illustration shows wooden homes and walkways built around a huge tree trunk, with lanterns and stairways.',
  'look' => ['Follow the bridges and stairs between the homes.', 'Find where the homes rest on the tree.'],
  'questions' => ['Bridges between trees save ground space. Who might find them hard to use?', 'How could a treetop village include everyone?', 'What would it be like to sleep in a home that sways in the wind?'],
  'words' => ['Arborist' => 'A person trained to care for trees.', 'Canopy' => 'The top layer of a forest, formed by branches and leaves.', 'Footprint' => 'The area of ground a building covers.'],
  'sources' => ['isa', 'stri'],
  'related' => ['canopy-walkway', 'great-tree-hall', 'tree-tower-home'],
],

'tree-tower-home' => [
  'name' => 'Tree tower home', 'latin' => 'vertical forest', 'cat' => 'grow', 'src' => 'art/family_3.png',
  'summary' => 'An imagined tower wrapped in trees. Real "vertical forests" plant hundreds of trees on the balconies of city apartment blocks.',
  'facts' => ['Imagined as' => 'A home inside a tower of trees', 'Real-world idea' => 'Trees on tall buildings', 'Real example' => 'Bosco Verticale, Milan (2014)', 'Benefits' => 'Shade, wildlife, cleaner air nearby'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a tall home where every floor opens onto a balcony of trees. Leaves would shade the windows in summer and drop in winter to let the sun in. Birds and insects would live alongside the family, high above the ground.',
    ]],
    ['A real vertical forest', ELVEN_REAL, [
      'In 2014 two apartment towers called Bosco Verticale ("Vertical Forest") opened in Milan, Italy. Their balconies hold hundreds of trees and thousands of shrubs and plants. The plants shade the apartments, reduce noise, create homes for birds and insects, and make a gray city greener.',
    ]],
    ['How it works', ELVEN_REAL, [], ['list' => [
      'Deep concrete planters, built into the balconies, hold the soil.',
      'Trees were grown in a nursery for years to get used to the conditions.',
      'Strong cables tie trees down in case of high wind.',
      'An automatic watering system uses filtered water.',
      'Specialist gardeners abseil down the building to prune the trees.',
    ]], [
      'Vertical forests are heavy and expensive to build and maintain, so planting trees at ground level, in streets and parks, is usually cheaper. But where space is tight, they show how buildings can make room for nature.',
    ]],
  ],
  'art' => 'This illustration shows a home rising inside a tall tree, with glowing windows among the branches.',
  'look' => ['Count the levels of windows in the tree.', 'Where could birds nest?'],
  'questions' => ['Would you like to live in a building covered in trees? What would be good and hard about it?', 'Who should look after trees on a tall building?', 'Is it better to put trees on buildings or in streets and parks?'],
  'words' => ['Vertical forest' => 'A tall building planted with many trees.', 'Planter' => 'A container for growing plants.', 'Abseil' => 'To lower yourself down on a rope.'],
  'sources' => ['boeri', 'epa-heat'],
  'related' => ['treetop-village', 'leafy-cottage', 'wild-grove'],
],

'living-crane' => [
  'name' => 'Living crane', 'latin' => 'bamboo building', 'cat' => 'grow', 'src' => 'build/crane.png',
  'summary' => 'An imagined crane woven from vines. In the real world, fast-growing bamboo is strong enough to build scaffolding and houses.',
  'facts' => ['Imagined as' => 'A crane grown from vines', 'Real-world idea' => 'Building with bamboo', 'Real example' => 'Bamboo scaffolding in Hong Kong', 'Why bamboo' => 'Strong, light and fast-growing'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a crane grown from twisted vines, with a basket of woven branches to lift stone. When the building was finished, the crane could be planted again, or composted to feed the soil.',
    ]],
    ['The real "living" building material: bamboo', ELVEN_REAL, [
      'Bamboo is a giant grass. Some species can grow tens of centimetres in a single day and reach full height in a few months, and the plant regrows from its roots after it is cut. For its weight, bamboo is remarkably strong, especially when pulled.',
      'In Hong Kong, skilled workers still put up tall scaffolding from bamboo poles tied together, even around skyscrapers. In many tropical countries, bamboo is used for houses, bridges and furniture.',
    ]],
    ['Limits and new ideas', ELVEN_REAL, [
      'Natural bamboo can rot or be eaten by insects if it is not treated, and every pole is a slightly different size, which makes engineering harder. Researchers are developing engineered bamboo, glued into standard beams and boards, and building codes for bamboo structures are being written so that it can be used more safely and widely.',
    ]],
  ],
  'art' => 'This illustration shows a crane made of twisting vines, lifting a carved stone with a glowing basket. The glow is part of the original artwork.',
  'look' => ['Follow the vine from the arm to the stone block.', 'Find the lanterns hanging from the crane.'],
  'questions' => ['What would it take to build with materials that grow back?', 'Why might bamboo be a good material in some places but not others?', 'What happens to a crane, or a building, at the end of its life?'],
  'words' => ['Bamboo' => 'A fast-growing giant grass with strong, hollow stems.', 'Scaffolding' => 'A temporary frame that builders stand on.', 'Renewable' => 'Able to grow back or be replaced naturally.'],
  'sources' => ['inbar'],
  'related' => ['building-materials', 'woodworking-workshop', 'great-tree-hall'],
],

// ---------------- Homes in the forest ----------------
'hillside-home' => [
  'name' => 'Hillside home', 'latin' => 'earth-sheltered house', 'cat' => 'homes', 'src' => 'art/family_1.png',
  'summary' => 'A home tucked into a grassy hill. Real earth-sheltered homes use the soil around them to stay cool in summer and warm in winter.',
  'facts' => ['Imagined as' => 'A cozy home inside a hill', 'Real-world idea' => 'Earth-sheltered design', 'Works because' => 'Soil temperature stays steady', 'Watch out for' => 'Damp and good drainage'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a round door in a grassy bank, opening into a warm home where the hill itself is the roof. Wildflowers grow overhead, rabbits graze on the roof, and the home barely shows in the landscape.',
    ]],
    ['Why the earth keeps homes comfortable', ELVEN_REAL, [
      'A few meters below the surface, the temperature of the ground stays fairly steady all year, while the air above swings from hot to cold. Soil around a home acts like a thick, heavy blanket: it slows heat leaving in winter and entering in summer. This is called thermal mass. Earth-sheltered houses can need much less heating and cooling than ordinary houses.',
    ]],
    ['How they are built', ELVEN_REAL, [], ['list' => [
      'Strong walls and roofs, usually of reinforced concrete, hold back the weight of the soil.',
      'Waterproofing and drainage stop damp, which is the biggest risk.',
      'Large windows face the sun, often on one open side, to bring in light.',
      'A green roof of soil and plants tops it off.',
    ]]],
  ],
  'art' => 'This illustration shows a round-doored home set into a grassy mound with glowing windows and a mossy roof.',
  'look' => ['Find the round door and the windows in the hill.', 'Where does the roof end and the hill begin?'],
  'questions' => ['What would be good and hard about living inside a hill?', 'Why might a home in the ground need less heating?', 'How would you bring daylight into an underground room?'],
  'words' => ['Thermal mass' => 'Heavy material that stores heat and slows temperature change.', 'Earth-sheltered' => 'Partly covered by soil.', 'Drainage' => 'Carrying water away.'],
  'sources' => ['doe-earth', 'epa-green'],
  'related' => ['green-roof-cottage', 'natural-cottage', 'gathering-circle'],
],

'timber-house' => [
  'name' => 'Timber family house', 'latin' => 'mass timber', 'cat' => 'homes', 'src' => 'art/family_2.png',
  'summary' => 'An imagined house carved from wood. Real engineered timber now builds homes and towers that store carbon instead of releasing it.',
  'facts' => ['Imagined as' => 'A carved wooden family home', 'Real-world idea' => 'Engineered "mass" timber', 'Tall examples' => 'Mjøstårnet, Norway (2019); Ascent, USA (2022)', 'Big benefit' => 'Wood stores carbon'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a family home where every beam is carved with leaves and every room smells of fresh wood. Elven builders would take only fallen or carefully chosen trees and plant more for every one they used.',
    ]],
    ['Why build with wood?', ELVEN_REAL, [
      'As trees grow, they take carbon dioxide from the air and lock carbon into their wood. If that wood becomes a building, the carbon stays stored for as long as the building lasts. Making wood products also usually needs much less energy than making steel or cement.',
    ]],
    ['Tall buildings made of wood', ELVEN_REAL, [
      'Engineered timbers such as cross-laminated timber are made by gluing layers of boards together, each layer at right angles to the last. The panels are strong, stable and surprisingly fire-resistant, because thick wood chars on the outside and protects the inside. Wooden towers of more than 80 meters have been built, such as Mjøstårnet in Norway and Ascent in Milwaukee, USA.',
      'It only helps the planet if forests are managed well, with trees replanted and wildlife protected. Certification schemes such as the Forest Stewardship Council help buyers find wood from responsible sources.',
    ]],
  ],
  'art' => 'This illustration shows a timber-framed house with a steep teal roof, carved details and glowing windows.',
  'look' => ['Find the carved wooden details.', 'How steep is the roof? Why might that help in a forest?'],
  'questions' => ['Would you live in a tall building made of wood? Why or why not?', 'How can we use wood without harming forests?', 'Why does it matter how long a building lasts?'],
  'words' => ['Mass timber' => 'Large panels and beams made from layers of wood.', 'Carbon storage' => 'Keeping carbon locked away instead of in the air.', 'Certification' => 'Proof that something meets certain standards.'],
  'sources' => ['timber', 'fsc'],
  'related' => ['woodworking-workshop', 'natural-cottage', 'building-materials'],
],

'spire-house' => [
  'name' => 'Breathing spire', 'latin' => 'natural ventilation', 'cat' => 'homes', 'src' => 'art/floor_l.png',
  'summary' => 'An imagined tower that breathes like a termite mound, pulling cool air in and letting warm air out with no machines.',
  'facts' => ['Imagined as' => 'A tower that breathes', 'Real-world idea' => 'Passive cooling and ventilation', 'Real example' => 'Eastgate Centre, Harare, Zimbabwe (1996)', 'Inspired by' => 'Termite mounds'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a slender spire that stays fresh on the hottest day. Warm air rises up and out of its tall chimney, drawing cool air in from shaded gardens below, so the rooms breathe without fans or air conditioners.',
    ]],
    ['Copying termites', ELVEN_REAL, [
      'Some African termites build huge mounds with networks of tunnels. In the 1990s, architect Mick Pearce studied them when designing the Eastgate Centre, an office and shopping building in Harare, Zimbabwe. It uses heavy concrete to store the night\'s coolness, fans to flush air at night, and tall chimneys that let warm air rise out. The architect\'s firm reports that it uses about a third less energy than similar buildings with full air conditioning.',
      'Since then, scientists have learned that termite mounds work in more complicated ways than first thought, but the building still shows how passive design can save energy.',
    ]],
    ['The stack effect', ELVEN_REAL, [
      'Warm air is lighter than cool air, so it rises. In a tall space with openings at the top and bottom, rising warm air pulls fresh air in below. This "stack effect" has been used for centuries, for example in the wind-catcher towers of the Middle East and Iran, which catch breezes and push air through buildings.',
    ]],
  ],
  'art' => 'This illustration shows a slender stone spire with leaf-covered walls. Here we imagine it breathing like a termite mound.',
  'look' => ['Find openings near the top where warm air could escape.', 'Notice the plants at the base. How might they cool the air?'],
  'questions' => ['How do you keep cool on a hot day without electricity?', 'Why might copying termites be useful for architects?', 'What other animals build clever homes?'],
  'words' => ['Passive cooling' => 'Keeping cool without machines.', 'Stack effect' => 'Warm air rising and drawing cool air in below.', 'Biomimicry' => 'Copying ideas from nature.'],
  'sources' => ['pearce', 'asknature', 'benyus'],
  'related' => ['hillside-home', 'leafy-cottage', 'weather-tower'],
],

'green-roof-cottage' => [
  'name' => 'Green-roof cottage', 'latin' => 'living roof', 'cat' => 'homes', 'src' => 'art/floor_m.png',
  'summary' => 'A tall cottage crowned with plants. Real green roofs soak up rain, cool buildings and feed insects.',
  'facts' => ['Imagined as' => 'A cottage with a garden roof', 'Real-world idea' => 'Green roofs', 'Benefits' => 'Less runoff, cooler roofs, wildlife', 'Watch out for' => 'Extra weight and leaks'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a cottage whose roof is a meadow, where bees hum among flowers and rain is drunk by plants instead of rushing down gutters. In summer the plants keep the rooms below cool; in winter the soil helps keep warmth in.',
    ]],
    ['Real green roofs', ELVEN_REAL, [
      'A green roof is a roof covered with plants growing in a thin layer of special soil. Cities around the world, especially in Germany, Switzerland and Scandinavia, have encouraged them. The US Environmental Protection Agency explains that green roofs can be much cooler than ordinary dark roofs on hot days, helping fight the urban heat island effect.',
    ], ['list' => [
      'They hold rainwater and release it slowly, reducing flooding.',
      'They protect the roof from sun damage, so it can last longer.',
      'They provide food and shelter for insects and birds.',
      'They make a city more pleasant to look at.',
    ]]],
    ['How a green roof is built', ELVEN_REAL, [
      'From the bottom up: a strong roof deck, a waterproof layer, a root barrier, a drainage layer, a filter fabric, a lightweight growing medium, then the plants. Hardy, low-growing plants such as sedums are common because they survive drought. Engineers must check that the roof can carry the extra weight of wet soil.',
    ]],
  ],
  'art' => 'This illustration shows a tall timber cottage with a purple slate roof and plants climbing its walls. Here we imagine its roof as a living garden.',
  'look' => ['Find the plants growing on the walls and roof edge.', 'Where would rainwater go?'],
  'questions' => ['How could gardens on roofs help a city?', 'Why might a green roof be harder to build than an ordinary one?', 'Which buildings near you could have a green roof?'],
  'words' => ['Green roof' => 'A roof covered with growing plants.', 'Runoff' => 'Rainwater that flows over surfaces instead of soaking in.', 'Sedum' => 'A tough, low-growing plant often used on green roofs.'],
  'sources' => ['epa-green', 'epa-heat'],
  'related' => ['hillside-home', 'garden-court', 'flower-meadow'],
],

'natural-cottage' => [
  'name' => 'Forest cottage', 'latin' => 'natural building', 'cat' => 'homes', 'src' => 'art/floor_s.png',
  'summary' => 'An imagined cottage made of earth, straw, stone and wood. Real natural building uses these same simple materials.',
  'facts' => ['Imagined as' => 'A cottage built from the land around it', 'Real-world idea' => 'Natural building', 'Materials' => 'Cob, straw bale, timber, stone', 'Benefit' => 'Low energy, local, non-toxic'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a cottage built from what the forest floor offers: clay, straw, fallen timber and stone. When it is no longer needed, it could slowly return to the earth.',
    ]],
    ['Real natural building', ELVEN_REAL, [], ['list' => [
      'Cob: a mix of clay soil, sand and straw, built up in thick, sculpted walls. Some cob houses in England are hundreds of years old.',
      'Straw bale: bales of straw stacked like big bricks and plastered. They insulate very well. In the United States, the International Residential Code includes an appendix on straw bale construction.',
      'Rammed earth: damp soil packed hard into frames to make strong, striped walls.',
      'Timber and stone gathered locally, cutting transport.',
    ]], [
      'These materials need little energy to make, can often be found near the building site, and contain few harmful chemicals.',
    ]],
    ['The secret: "good boots and a good hat"', ELVEN_REAL, [
      'Earth and straw buildings must be kept dry. Natural builders say a cottage needs "good boots", a stone or concrete base that lifts walls off damp ground, and "a good hat", a wide roof overhang that keeps rain off the walls. Breathable lime or clay plasters let any moisture escape.',
    ]],
  ],
  'art' => 'This illustration shows a small timber-framed cottage with a teal roof and a garden. Here we imagine it built from natural materials.',
  'look' => ['Find the roof overhang. How does it protect the walls?', 'What could the walls be made of?'],
  'questions' => ['What materials could you find within a few kilometers of your home to build with?', 'Why might natural materials be healthier to live with?', 'What are the downsides of building with earth and straw?'],
  'words' => ['Cob' => 'A building mix of clay, sand and straw.', 'Straw bale' => 'A tight block of straw used like a giant brick.', 'Lime plaster' => 'A breathable plaster made from lime.'],
  'sources' => ['strawbale', 'benyus'],
  'related' => ['timber-house', 'hillside-home', 'mushroom-cottage'],
],

'leafy-cottage' => [
  'name' => 'Leafy cottage', 'latin' => 'biophilic design', 'cat' => 'homes', 'src' => 'art/home_a.png',
  'summary' => 'An imagined cottage wrapped in climbing plants. Real research suggests that seeing nature helps people feel and heal better.',
  'facts' => ['Imagined as' => 'A home covered in living leaves', 'Real-world idea' => 'Biophilic design and living walls', 'Famous study' => 'Hospital window view study (1984)', 'Benefits' => 'Wellbeing, shade, cleaner local air'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a cottage where leaves cover the walls and flowers frame every window. Inside, there is always a view of green, the sound of birds and the smell of plants.',
    ]],
    ['Why nature makes us feel better', ELVEN_REAL, [
      'The biologist E. O. Wilson used the word "biophilia" to describe the idea that humans have a deep connection to nature. In a famous 1984 study, researcher Roger Ulrich found that hospital patients recovering from surgery whose windows looked onto trees went home sooner and needed fewer strong painkillers than similar patients who looked at a brick wall.',
      'Architects now use "biophilic design": daylight, plants, natural materials, views of nature and water, to make homes, schools and hospitals more pleasant.',
    ]],
    ['Living walls', ELVEN_REAL, [
      'A green or living wall is a wall covered with plants, either climbers rooted in the ground or plants growing in panels with built-in watering. They shade and cool walls in summer, support insects and birds, and soften hard city streets.',
    ]],
  ],
  'art' => 'This illustration shows a small cottage with leafy vines, flower boxes and a teal roof.',
  'look' => ['Find the climbing plants on the walls.', 'How many windows look out on greenery?'],
  'questions' => ['Where do you feel calmest, and is nature part of it?', 'How could your classroom or bedroom bring in more nature?', 'Why might a view of trees help someone heal?'],
  'words' => ['Biophilia' => 'A love of, or need for, the natural world.', 'Living wall' => 'A wall covered with growing plants.', 'Wellbeing' => 'Feeling healthy and happy.'],
  'sources' => ['ulrich', 'wilson'],
  'related' => ['tree-tower-home', 'green-roof-cottage', 'forest-gym'],
],

'mushroom-cottage' => [
  'name' => 'Mushroom cottage', 'latin' => 'mycelium materials', 'cat' => 'homes', 'src' => 'art/home_b.png',
  'summary' => 'A playful toadstool home. Real scientists grow building blocks and packaging from mycelium, the root-like threads of fungi.',
  'facts' => ['Imagined as' => 'A home shaped like a mushroom', 'Real-world idea' => 'Materials grown from fungi', 'Real example' => 'Hy-Fi tower, New York (2014)', 'Status' => 'Used for packaging; buildings experimental'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a cottage grown, not built: a living fungus shaped into walls, then dried so that it stops growing. When the cottage was no longer needed, it could be broken up and composted into soil.',
    ]],
    ['The hidden part of a mushroom', ELVEN_REAL, [
      'The mushroom we see is only the fruit of a fungus. Most of the fungus is underground: a huge network of fine white threads called mycelium. Mycelium grows through soil, wood and plant waste, binding it together like a natural glue.',
    ]],
    ['Growing bricks', ELVEN_REAL, [
      'Companies and researchers mix mycelium with farm waste such as corn stalks or sawdust and let it grow in moulds for a few days. It fills the mold, then is heated to stop it growing. The result is light, insulating and compostable, and is already used for packaging instead of plastic foam.',
      'In 2014, the architecture firm The Living built "Hy-Fi", a temporary tower of mycelium bricks, at the MoMA PS1 museum in New York. After the summer, the bricks were composted. Mycelium is not yet strong or water-resistant enough for most permanent buildings, so researchers are working on that.',
    ]],
  ],
  'art' => 'This illustration shows a cottage under a red-and-white spotted mushroom cap, with round windows and a stone chimney.',
  'look' => ['Which parts look practical, and which are just for fun?', 'Find the chimney. What would it be made of in a mushroom house?'],
  'questions' => ['Should buildings be designed to delight people, not only to be useful?', 'What could you make from materials that grow?', 'Why might compostable materials help reduce waste?'],
  'words' => ['Fungus' => 'A living thing, like a mushroom or mold, that is neither plant nor animal.', 'Mycelium' => 'The network of thread-like roots of a fungus.', 'Compostable' => 'Able to break down naturally into soil.'],
  'sources' => ['hyfi', 'mycelium'],
  'related' => ['natural-cottage', 'building-materials', 'woodworking-workshop'],
],

// ---------------- Water and energy ----------------
'crystal-fountain' => [
  'name' => 'Cleansing fountain', 'latin' => 'constructed wetland', 'cat' => 'water', 'src' => 'art/fountain.png',
  'summary' => 'An imagined fountain that cleans water as it flows. Real "constructed wetlands" use plants and microbes to purify wastewater.',
  'facts' => ['Imagined as' => 'A fountain that purifies water', 'Real-world idea' => 'Constructed wetlands', 'Real example' => 'Arcata Marsh, California', 'How it works' => 'Plants, microbes, sun and time'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a fountain where used water from homes flows through pools of reeds and stones and comes out clean enough to return to the river, with the glittering spray showing everyone that the city\'s water is cared for.',
    ]],
    ['How wetlands clean water', ELVEN_REAL, [
      'Natural marshes are some of nature\'s best water filters. As water moves slowly through them, mud settles out, and bacteria living on plant roots and in the soil break down waste. Plants take up nutrients that would otherwise feed harmful algae in rivers. Sunlight helps kill germs.',
      'A constructed wetland copies this. Shallow beds of gravel and soil are planted with reeds, rushes and other wetland plants, and partly treated wastewater flows through them.',
    ]],
    ['A town that cleans its water with a marsh', ELVEN_REAL, [
      'Since the 1980s, the city of Arcata in California has used a series of ponds and marshes to finish cleaning its wastewater. The marshes are also a wildlife sanctuary with walking trails, popular with birdwatchers. Constructed wetlands need more land than a treatment plant, so they suit some places better than others.',
    ]],
  ],
  'art' => 'This illustration shows a glowing crystal fountain with tiered pools. Here we imagine it as a wetland that cleans water.',
  'look' => ['Follow the water from the top to the pool.', 'Where could reeds and plants grow?'],
  'questions' => ['How could a city make its water system visible, so people value it?', 'Why might a marsh be better than a concrete plant in some places?', 'What lives in a wetland?'],
  'words' => ['Wetland' => 'Land covered with shallow water, like a marsh.', 'Microbe' => 'A living thing too small to see without a microscope.', 'Wastewater' => 'Used water from homes and businesses.'],
  'sources' => ['epa-wetland', 'arcata'],
  'related' => ['garden-court', 'spring-circle', 'crystal-waterfall'],
],

'garden-court' => [
  'name' => 'Rain garden court', 'latin' => 'rain garden', 'cat' => 'water', 'src' => 'art/growth_1.png',
  'summary' => 'An imagined courtyard garden that drinks the rain. Real rain gardens catch storm water and stop flooding.',
  'facts' => ['Imagined as' => 'A garden that drinks rain', 'Real-world idea' => 'Rain gardens and "sponge cities"', 'Benefits' => 'Less flooding, cleaner rivers', 'Plants' => 'Deep-rooted, flood-tolerant'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a courtyard where every drop of rain from the roofs runs into a sunken garden, sinks into the soil and slowly fills a clear pool, so the garden is green even in the dry season.',
    ]],
    ['The problem with hard cities', ELVEN_REAL, [
      'In nature, most rain soaks into the ground. In cities, roofs, roads and parking lots are hard surfaces, so rain rushes into drains, picking up oil and litter. In heavy storms, drains overflow, causing floods and sometimes sending sewage into rivers.',
    ]],
    ['How a rain garden works', ELVEN_REAL, [
      'A rain garden is a shallow dip planted with tough, deep-rooted plants. Rainwater from roofs and paths is directed into it. The water pools for a short time, then soaks into the soil, which filters out pollution. The US Environmental Protection Agency promotes rain gardens as part of "green infrastructure".',
      'Some cities, especially in China, are scaling this up as "sponge cities", combining rain gardens, wetlands, permeable paving and green roofs to soak up storms.',
    ]],
  ],
  'art' => 'This illustration shows a courtyard of flowers and paths around a glowing pool, with stone arches.',
  'look' => ['Find the pool in the middle of the garden.', 'Which way would rain flow into it?'],
  'questions' => ['How could gardens collect and clean rainwater?', 'Where does the rain go when it falls on your school?', 'What would a "sponge city" look like?'],
  'words' => ['Rain garden' => 'A planted dip that soaks up rainwater.', 'Permeable' => 'Letting water pass through.', 'Green infrastructure' => 'Using plants and soil to manage water.'],
  'sources' => ['epa-green'],
  'related' => ['crystal-fountain', 'green-roof-cottage', 'flower-meadow'],
],

'spring-circle' => [
  'name' => 'Spring circle', 'latin' => 'watershed protection', 'cat' => 'water', 'src' => 'art/growth_2.png',
  'summary' => 'An imagined ring of stones guarding a sacred spring. Real cities save billions by protecting the land where their water comes from.',
  'facts' => ['Imagined as' => 'A protected spring', 'Real-world idea' => 'Protecting watersheds', 'Real example' => 'New York City\'s Catskill and Delaware watersheds', 'Big saving' => 'Avoiding a huge filtration plant'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a spring guarded by standing stones, where no one may cut trees or dump waste in the hills above, because everyone knows the city\'s water begins here.',
    ]],
    ['What is a watershed?', ELVEN_REAL, [
      'A watershed is all the land that drains into a particular river, lake or spring. Rain falling anywhere in a watershed eventually flows to the same place. What happens on that land, such as forests, farms, roads or factories, affects the quality of the water downstream.',
    ]],
    ['Paying to protect nature', ELVEN_REAL, [
      'New York City gets most of its drinking water from reservoirs in the Catskill Mountains and Delaware River area, far upstate. Instead of building an enormous filtration plant, the city chose to protect the watershed: buying land, helping farmers prevent pollution, and upgrading local sewage systems. This has let it avoid building a filtration plant that would have cost billions of dollars. Forests and wetlands do much of the cleaning for free.',
    ]],
  ],
  'art' => 'This illustration shows a ring of tall carved stones around a glowing spring, surrounded by trees and flowers.',
  'look' => ['Look at the standing stones around the water.', 'What grows around the spring?'],
  'questions' => ['How might a city protect the source of its water?', 'Where does your drinking water come from?', 'Is it cheaper to protect nature or to fix problems later?'],
  'words' => ['Watershed' => 'All the land that drains into one river or lake.', 'Reservoir' => 'A lake used to store water.', 'Source water' => 'Water before it is treated.'],
  'sources' => ['nyc-water', 'epa-green'],
  'related' => ['crystal-fountain', 'crystal-waterfall', 'wild-grove'],
],

'crystal-waterfall' => [
  'name' => 'Crystal waterfall', 'latin' => 'micro-hydropower', 'cat' => 'water', 'src' => 'art/growth_3.png',
  'summary' => 'An imagined glowing waterfall. Real micro-hydro systems turn falling water into electricity for homes and villages.',
  'facts' => ['Imagined as' => 'A waterfall that lights the city', 'Real-world idea' => 'Small-scale hydropower', 'Needs' => 'Steady flow and a drop in height', 'Works' => 'Day and night, unlike solar'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a waterfall pouring down a crystal spire, its energy captured to light lanterns all over the elven city, day and night, while the stream below stays healthy for fish.',
    ]],
    ['How falling water makes electricity', ELVEN_REAL, [
      'Water falling from a height has energy. In a hydropower system, water is channeled through a pipe to a turbine, a wheel with blades. The rushing water spins the turbine, which turns a generator to make electricity. The more water and the bigger the drop, the more power.',
      'Small "micro-hydro" systems can power a single home, farm or village from a stream. Because water usually flows all the time, they can make electricity day and night, unlike solar panels.',
    ]],
    ['Keeping rivers healthy', ELVEN_REAL, [
      'Large dams can flood valleys and block fish from swimming upstream. Small "run-of-the-river" systems take only part of the stream\'s flow and return it downstream, with less harm. Fish ladders and screens help fish get past. Engineers must leave enough water in the stream for wildlife, especially in dry seasons.',
    ]],
  ],
  'art' => 'This illustration shows a tall crystal spire with water pouring into a glowing pool. Here we imagine its falling water making power.',
  'look' => ['Follow the water from the top of the spire to the pool.', 'Where could a turbine be hidden?'],
  'questions' => ['What are the good and bad sides of getting energy from rivers?', 'Why might water power work at night when solar does not?', 'How can we share a river between people and fish?'],
  'words' => ['Turbine' => 'A wheel turned by flowing water, wind or steam.', 'Generator' => 'A machine that turns motion into electricity.', 'Run-of-the-river' => 'Hydropower without a big dam.'],
  'sources' => ['doe-hydro'],
  'related' => ['spring-circle', 'gathering-circle', 'crystal-tower'],
],

'gathering-circle' => [
  'name' => 'Warm gathering circle', 'latin' => 'geothermal energy', 'cat' => 'water', 'src' => 'art/shared_1.png',
  'summary' => 'An imagined meeting place warmed by a glow from the earth. Real geothermal energy heats most homes in Iceland.',
  'facts' => ['Imagined as' => 'A circle warmed from below', 'Real-world idea' => 'Geothermal heat', 'Real example' => 'Iceland: about 9 in 10 homes', 'Also' => 'Ground-source heat pumps work almost anywhere'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a ring of log seats around a glowing heart that never burns wood and never goes out, warmed by heat rising from deep in the earth. On cold nights, the whole village gathers here.',
    ]],
    ['Heat from inside the Earth', ELVEN_REAL, [
      'The deep inside of the Earth is very hot, and that heat slowly flows outward. In volcanic places like Iceland, hot water and steam lie close to the surface. Iceland pipes this hot water to homes through district heating networks, and about nine in ten Icelandic homes are heated by geothermal energy. It is also used to warm sidewalks, swimming pools and greenhouses.',
    ]],
    ['Earth energy everywhere', ELVEN_REAL, [
      'Even where there are no volcanoes, the ground a few meters down stays at a fairly steady temperature all year. A ground-source heat pump circulates fluid through pipes buried in the ground and uses that steady temperature to heat homes in winter and cool them in summer, using much less energy than ordinary heaters.',
    ]],
  ],
  'art' => 'This illustration shows log benches in a ring around a softly glowing center, surrounded by trees and flowers.',
  'look' => ['Find the glowing heart of the circle.', 'Count the seats around it.'],
  'questions' => ['What makes an outdoor meeting place comfortable for everyone?', 'Why might Iceland be especially good for geothermal energy?', 'Where could your town get clean heat from?'],
  'words' => ['Geothermal' => 'Heat from inside the Earth.', 'District heating' => 'Heating many buildings from one shared source.', 'Heat pump' => 'A machine that moves heat from one place to another.'],
  'sources' => ['iceland'],
  'related' => ['hillside-home', 'crystal-waterfall', 'council-terrace'],
],

// ---------------- Wildlife and wild places ----------------
'flower-meadow' => [
  'name' => 'Pollinator meadow', 'latin' => 'wildflower meadow', 'cat' => 'wild', 'src' => 'art/nt_garden.png',
  'summary' => 'Flowers planted for bees, butterflies and other insects that pollinate the crops we eat.',
  'facts' => ['Imagined as' => 'A glowing flower garden', 'Real-world idea' => 'Habitat for pollinators', 'Why it matters' => 'Most leading food crops benefit from pollinators', 'Easy to start' => 'Native flowers, no pesticides'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a meadow of glowing flowers that blooms from spring to autumn, humming with bees, where elves gather honey and seeds without ever harming the insects.',
    ]],
    ['Why pollinators matter', ELVEN_REAL, [
      'Many plants need animals, mostly insects, to carry pollen from flower to flower so that they can make fruit and seeds. In 2016, a major international assessment by IPBES found that about three quarters of the world\'s leading kinds of food crops benefit at least partly from animal pollination, including apples, almonds, coffee and chocolate.',
      'Many wild pollinators are declining because of habitat loss, pesticides, disease and climate change.',
    ]],
    ['How to help pollinators', ELVEN_REAL, [], ['list' => [
      'Plant native flowers that bloom at different times of year.',
      'Leave some areas a little wild, with bare soil and dead stems where bees can nest.',
      'Avoid pesticides, especially on flowers.',
      'Provide shallow water with stones to land on.',
      'Link meadows, gardens and verges so insects can move between them.',
    ]]],
  ],
  'art' => 'This illustration shows a raised bed of large purple and blue flowers with crystal markers.',
  'look' => ['Look at the different flower colors and shapes.', 'Where might a bee land?'],
  'questions' => ['Why might a city plant flowers for pollinators?', 'Could your school or street have a meadow?', 'What foods would we lose without pollinators?'],
  'words' => ['Pollinator' => 'An animal that carries pollen between flowers.', 'Native plant' => 'A plant that grows naturally in an area.', 'Habitat' => 'The home of a living thing.'],
  'sources' => ['ipbes', 'xerces'],
  'related' => ['wild-grove', 'garden-court', 'green-roof-cottage'],
],

'wild-grove' => [
  'name' => 'Tiny forest', 'latin' => 'urban forest', 'cat' => 'wild', 'src' => 'art/trees.png',
  'summary' => 'A patch of trees left wild in the middle of the city. Real "tiny forests" plant dense native woods in spaces the size of a tennis court.',
  'facts' => ['Imagined as' => 'A sacred grove in the city', 'Real-world idea' => 'Urban forests and tiny forests', 'Method' => 'The Miyawaki method', 'Benefits' => 'Shade, wildlife, cooler air'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a grove of ancient trees and blossoms that no one ever cuts, in the very center of the elven city, where anyone can sit in the shade and listen to birds.',
    ]],
    ['Trees cool the city', ELVEN_REAL, [
      'Trees shade streets and buildings and release water vapor through their leaves, which cools the air. The US Environmental Protection Agency explains that trees and plants help reduce the heat island effect that makes cities hotter than the countryside. Trees also soak up rain, provide homes for wildlife and make places more pleasant.',
    ]],
    ['Tiny forests', ELVEN_REAL, [
      'The Japanese botanist Akira Miyawaki developed a way to grow native forest quickly on small sites. Many different native trees and shrubs are planted very close together, in carefully prepared soil, and the young forest is looked after for its first few years. The trees compete for light and grow fast.',
      'Community groups and schools now plant "tiny forests" about the size of a tennis court in towns around the world. Researchers are studying how well they work compared with other ways of planting trees.',
    ]],
  ],
  'art' => 'This illustration shows a small grove of great trees with a pink blossom tree and twisting roots.',
  'look' => ['Notice the roots and the blossom tree.', 'How many kinds of trees can you see?'],
  'questions' => ['How much of a city should stay wild?', 'Where could a tiny forest grow near you?', 'Why might many different kinds of trees be better than just one?'],
  'words' => ['Urban forest' => 'All the trees in a town or city.', 'Native species' => 'Plants and animals that belong naturally in a place.', 'Canopy cover' => 'How much of an area is shaded by trees.'],
  'sources' => ['miyawaki', 'epa-heat'],
  'related' => ['flower-meadow', 'deer-statue', 'tree-tower-home'],
],

'stag-monument' => [
  'name' => 'Stag crossing', 'latin' => 'wildlife crossing', 'cat' => 'wild', 'src' => 'art/monument.png',
  'summary' => 'An imagined monument to the forest\'s animals. Real wildlife bridges let deer, bears and wolves cross busy roads safely.',
  'facts' => ['Imagined as' => 'A monument honouring animals', 'Real-world idea' => 'Wildlife crossings', 'Real example' => 'Banff National Park, Canada', 'Result there' => 'Collisions down by more than 80%'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a great stag carved in white stone, marking the paths where animals have always walked. Elven roads would bend around these paths, or pass beneath them, so that animals could always travel freely.',
    ]],
    ['Roads cut nature in two', ELVEN_REAL, [
      'Roads split forests and meadows into separate pieces. Animals trying to cross are hit by vehicles, which is dangerous for drivers too. Animals that cannot cross may be cut off from food, water and mates.',
    ]],
    ['Bridges for animals', ELVEN_REAL, [
      'In Banff National Park, Canada, the Trans-Canada Highway runs through the mountains. Parks Canada built fences along the road and dozens of crossing structures, including tunnels under the road and wide, planted bridges over it. Parks Canada reports that these reduced wildlife collisions by more than 80 percent, and by over 96 percent for elk and deer. Cameras show grizzly bears, wolves, cougars and moose using them, though shy animals can take years to trust a new crossing.',
    ]],
  ],
  'art' => 'This illustration shows a white stag statue with glowing antlers on a carved pedestal.',
  'look' => ['Look at the stag\'s glowing antlers.', 'What plants surround the base?'],
  'questions' => ['Why might building a bridge for animals also help people?', 'Are there places near you where animals try to cross roads?', 'How could towns be designed around animal paths?'],
  'words' => ['Wildlife corridor' => 'A strip of habitat that links wild areas.', 'Overpass' => 'A bridge that crosses over a road.', 'Fragmentation' => 'Breaking habitat into separate pieces.'],
  'sources' => ['parks-ca'],
  'related' => ['deer-statue', 'wild-grove', 'canopy-walkway'],
],

'deer-statue' => [
  'name' => 'Deer shrine', 'latin' => 'rewilding', 'cat' => 'wild', 'src' => 'art/nt_statue.png',
  'summary' => 'An imagined shrine to a gentle deer. In the real world, "rewilding" lets nature restore itself on land that was farmed.',
  'facts' => ['Imagined as' => 'A shrine to wild animals', 'Real-world idea' => 'Rewilding', 'Real example' => 'Knepp Estate, England (since 2001)', 'Key helpers' => 'Grazing animals, beavers, time'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a quiet shrine where elves leave space for the wild: a reminder that some land is not for people, but for deer, birds, insects and plants to shape as they please.',
    ]],
    ['What is rewilding?', ELVEN_REAL, [
      'Rewilding means stepping back and letting natural processes restore an area, often with a helping hand at the start, such as removing drains, letting rivers wander or bringing back missing animals. Instead of deciding exactly what should grow, rewilders let nature lead.',
    ]],
    ['A farm that went wild', ELVEN_REAL, [
      'From 2001, the owners of the Knepp Estate in southern England stopped intensive farming on their land and let it go wild, with free-roaming cattle, ponies, pigs and deer grazing as wild herds once did. The land became a patchwork of scrub, grassland and woodland, and rare species such as nightingales and purple emperor butterflies increased. In 2020, beavers were reintroduced to the estate.',
      'Beavers are called "ecosystem engineers": their dams create wetlands that store water, slow floods and provide habitat for many other species.',
    ]],
  ],
  'art' => 'This illustration shows a white deer statue on a pedestal surrounded by flowers.',
  'look' => ['Look at the deer\'s pose. Is it calm or alert?', 'Find the flowers around the base.'],
  'questions' => ['Should some land be left for nature to manage itself?', 'What might happen if beavers returned to rivers near you?', 'How do we balance land for food with land for wildlife?'],
  'words' => ['Rewilding' => 'Letting nature restore itself, often by bringing back key species.', 'Ecosystem engineer' => 'An animal that changes its habitat in big ways.', 'Biodiversity' => 'The variety of life in a place.'],
  'sources' => ['knepp', 'nps-beaver'],
  'related' => ['stag-monument', 'wild-grove', 'flower-meadow'],
],

'domed-observatory' => [
  'name' => 'Star dome', 'latin' => 'dark-sky observatory', 'cat' => 'wild', 'src' => 'art/knowledge_3.png',
  'summary' => 'An imagined observatory under a sky full of stars. Real dark-sky places reduce light pollution so people and wildlife can see the night.',
  'facts' => ['Imagined as' => 'A crystal dome for star-gazing', 'Real-world idea' => 'Dark-sky protection', 'First International Dark Sky City' => 'Flagstaff, Arizona (2001)', 'Helps' => 'Stars, wildlife, sleep, energy'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a crystal dome at the edge of the forest where elves watch the stars, track the Moon to plan planting and harvest, and teach children the patterns of the night sky.',
    ]],
    ['The lost night sky', ELVEN_REAL, [
      'Bright outdoor lights make the sky glow, hiding all but the brightest stars. Many people living in cities have never seen the Milky Way. This light pollution also confuses wildlife: migrating birds can be drawn to lit buildings, newly hatched sea turtles may head toward lights instead of the sea, and many insects circle lamps until they are exhausted.',
    ]],
    ['Bringing back the dark', ELVEN_REAL, [
      'DarkSky International, founded in 1988, works to reduce light pollution. In 2001, Flagstaff, Arizona, became the first International Dark Sky City, thanks to rules on outdoor lighting. Simple changes help:',
    ], ['list' => [
      'Shield lights so they point down, not up into the sky.',
      'Use only as much light as needed, only when needed.',
      'Choose warmer-colored lights, which disturb wildlife less.',
      'Turn off decorative lighting late at night.',
    ]]],
  ],
  'art' => 'This illustration shows a turquoise glass dome on a stone tower surrounded by forest.',
  'look' => ['Find the glass dome at the top.', 'How might lights inside affect the view of the stars?'],
  'questions' => ['When did you last see the Milky Way?', 'How could your street have less light pollution and still be safe?', 'Why might animals need darkness?'],
  'words' => ['Light pollution' => 'Too much artificial light at night.', 'Shielded light' => 'A lamp covered so that light shines down.', 'Milky Way' => 'Our galaxy, seen as a band of stars.'],
  'sources' => ['darksky'],
  'related' => ['weather-tower', 'crystal-tower', 'tree-library'],
],

'crystal-tower' => [
  'name' => 'Glowing tower', 'latin' => 'bioluminescence', 'cat' => 'wild', 'src' => 'art/nt_tower.png',
  'summary' => 'An imagined tower that glows like a firefly. Real scientists have already made living plants that glow in the dark.',
  'facts' => ['Imagined as' => 'A tower lit by living light', 'Real-world idea' => 'Bioluminescence', 'Real example' => 'Glowing petunia approved for sale in the USA', 'Light source' => 'Genes from a glowing mushroom'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a tower lit not by electricity but by living things that glow, like fireflies and forest fungi, softly lighting the paths of the elven city at night.',
    ]],
    ['Nature\'s own light', ELVEN_REAL, [
      'Bioluminescence is light made by living things. Fireflies flash to find mates, many deep-sea creatures glow, and some fungi make forests glow faintly green at night, sometimes called "foxfire". The light comes from a chemical reaction in which a molecule called luciferin reacts with oxygen, helped by an enzyme called luciferase.',
    ]],
    ['Glowing plants', ELVEN_REAL, [
      'Scientists discovered how a glowing mushroom makes its light, and added those genes to plants. In 2023, the US Department of Agriculture concluded that a glowing petunia developed by the company Light Bio could be safely grown, and it went on sale in 2024. Its flowers glow softly in a dark room.',
    ]],
    ['Could living light replace lamps?', ELVEN_NEXT, [
      'Not yet. Today\'s glowing plants are far too dim to light a street. Scientists would need to make them much brighter, and people would need to think carefully about releasing modified plants outdoors. For now, living light is a beautiful glimpse of what biology might do.',
    ]],
  ],
  'art' => 'This illustration shows a tall crystal tower with blue glowing panels and vines.',
  'look' => ['Find the glowing crystal panels.', 'What color is the light?'],
  'questions' => ['Would you want a garden that glows at night?', 'What should we think about before changing the genes of plants?', 'Why do so many deep-sea animals make light?'],
  'words' => ['Bioluminescence' => 'Light made by living things.', 'Gene' => 'Instructions inside a cell that shape how a living thing grows.', 'Enzyme' => 'A molecule that speeds up a chemical reaction.'],
  'sources' => ['lightbio', 'benyus'],
  'related' => ['domed-observatory', 'grand-tree-hall', 'mushroom-cottage'],
],

// ---------------- Learning and gathering ----------------
'tree-library' => [
  'name' => 'Seed library', 'latin' => 'seed bank', 'cat' => 'learn', 'src' => 'art/knowledge_1.png',
  'summary' => 'An imagined library inside a hollow tree, storing seeds instead of books. Real seed banks protect the world\'s plants for the future.',
  'facts' => ['Imagined as' => 'A library of seeds in a tree', 'Real-world idea' => 'Seed banks', 'Real example' => 'Svalbard Global Seed Vault (opened 2008)', 'Also' => 'Kew\'s Millennium Seed Bank, UK'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a library carved into an ancient hollow tree, where shelves hold tiny jars of seeds from every plant in the forest. Anyone could borrow seeds to grow, and return new seeds at harvest.',
    ]],
    ['Why store seeds?', ELVEN_REAL, [
      'Thousands of crop varieties and wild plants are at risk from disease, climate change, war and habitat loss. Seeds are like tiny backups of a plant\'s whole genetic recipe. If they are dried and frozen, many kinds can survive for decades or even centuries, ready to be grown again.',
    ]],
    ['The world\'s seed vaults', ELVEN_REAL, [
      'The Svalbard Global Seed Vault, opened in 2008, is dug deep into a mountain on an Arctic island in Norway. It stores backup copies of seeds from gene banks around the world. In 2015, during the war in Syria, a research center that had lost access to its own seed bank withdrew seeds from Svalbard to grow new stocks: the first withdrawal in the vault\'s history.',
      'In England, the Royal Botanic Gardens, Kew, runs the Millennium Seed Bank, which focuses on wild plants. Many towns also have small "seed libraries" where gardeners share seeds from their own plants.',
    ]],
  ],
  'art' => 'This illustration shows a library built into a huge hollow tree trunk with shelves inside and a glowing doorway.',
  'look' => ['Look for shelves inside the trunk.', 'Find the door at the base of the tree.'],
  'questions' => ['Why might it be important to save seeds from plants we do not use today?', 'What seeds would you put in a seed library?', 'Why would a seed vault be built inside a frozen mountain?'],
  'words' => ['Seed bank' => 'A place where seeds are stored to protect plant varieties.', 'Variety' => 'A particular type of a plant, like a kind of apple.', 'Genetic diversity' => 'Differences in genes within a species.'],
  'sources' => ['seedvault', 'kew'],
  'related' => ['treehouse-school', 'flower-meadow', 'weather-tower'],
],

'treehouse-school' => [
  'name' => 'Forest school', 'latin' => 'outdoor learning', 'cat' => 'learn', 'src' => 'art/knowledge_2.png',
  'summary' => 'An imagined school among the trees. Real forest schools take children outdoors to learn in every season.',
  'facts' => ['Imagined as' => 'A school built into the trees', 'Real-world idea' => 'Forest school', 'Started' => 'Scandinavia, mid-1900s', 'Learn by' => 'Exploring, building, taking safe risks'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a school where classrooms perch in the branches, lessons happen on rope bridges and in clearings, and the forest itself is the textbook: counting leaves, tracking animals and watching the seasons change.',
    ]],
    ['Real forest schools', ELVEN_REAL, [
      'Forest schools began in Scandinavia in the mid-20th century, where children spend long periods playing and learning outdoors in woods, whatever the weather. The idea has spread to many countries. Children might build dens, light small fires with adult help, use simple tools, identify plants and animals, and make art from natural materials.',
      'Supporters say regular time outdoors builds confidence, teamwork, physical skills and a love of nature. Leaders are trained to help children take manageable risks safely.',
    ]],
    ['What a forest school needs', ELVEN_REAL, [], ['list' => [
      'A safe woodland or green space, regularly checked for hazards.',
      'Warm, waterproof clothing, so bad weather does not stop learning.',
      'A simple shelter, such as a tarp, for rest and storage.',
      'Trained leaders and small groups.',
      'Respect for nature: leave the woods as you found them.',
    ]]],
  ],
  'art' => 'This illustration shows a timber school built among trees, with stairs, platforms and a balcony.',
  'look' => ['Find the stairs and the platforms.', 'Where could a class meet outdoors?'],
  'questions' => ['What would learning outdoors offer? What would it need in bad weather?', 'What could you learn in a wood that you cannot learn indoors?', 'How could a forest school include children who use wheelchairs?'],
  'words' => ['Outdoor learning' => 'Lessons that happen outside.', 'Risky play' => 'Play that is exciting and a little challenging, managed safely.', 'Den' => 'A simple shelter.'],
  'sources' => ['forest-sch'],
  'related' => ['tree-library', 'canopy-walkway', 'forest-gym'],
],

'weather-tower' => [
  'name' => 'Seasons tower', 'latin' => 'phenology and weather watching', 'cat' => 'learn', 'src' => 'art/town_2.png',
  'summary' => 'An imagined tower where elves watch the weather and the seasons. Real scientists track when flowers bloom to see how climate is changing.',
  'facts' => ['Imagined as' => 'A tower for reading nature\'s signs', 'Real-world idea' => 'Phenology', 'Long record' => 'Kyoto cherry blossom dates, centuries old', 'Anyone can help' => 'Citizen science projects'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a tower where elven watchers note the first blossom of spring, the arrival of swallows and the first frost, and use these signs to know when to plant, harvest and celebrate.',
    ]],
    ['Phenology: nature\'s calendar', ELVEN_REAL, [
      'Phenology is the study of the timing of natural events: when leaves open, flowers bloom, birds migrate and insects hatch. These events are closely linked to temperature and weather, so long records show how climate is changing.',
      'One of the longest records comes from Kyoto, Japan, where the dates of cherry blossom festivals have been written down for centuries. In recent decades the cherry trees have been blooming earlier than in most of the historical record, as springs have warmed.',
    ]],
    ['You can be a scientist', ELVEN_REAL, [
      'Projects such as the USA National Phenology Network and the Woodland Trust\'s "Nature\'s Calendar" in the UK invite anyone to record what they see, such as the first frogspawn or the first bluebell. Thousands of observations together help scientists understand how nature is responding to a changing climate.',
    ]],
  ],
  'art' => 'This illustration shows a tall, slender tower with a purple roof and a glowing orb at the top, wrapped in vines.',
  'look' => ['Find the glowing orb at the top. What might it measure?', 'Notice the windows facing different directions.'],
  'questions' => ['What signs tell you the seasons are changing where you live?', 'Why might a record kept for hundreds of years be so valuable?', 'What could you observe and record each week?'],
  'words' => ['Phenology' => 'The study of when natural events happen.', 'Citizen science' => 'Research that anyone can help with.', 'Migration' => 'Animals traveling between places with the seasons.'],
  'sources' => ['phenology'],
  'related' => ['domed-observatory', 'tree-library', 'spire-house'],
],

'council-terrace' => [
  'name' => 'Council terrace', 'latin' => 'governing the commons', 'cat' => 'learn', 'src' => 'art/town_1.png',
  'summary' => 'An imagined terrace where elves decide together how to share the forest. Real research shows communities can manage shared resources well.',
  'facts' => ['Imagined as' => 'An open-air council', 'Real-world idea' => 'Managing "the commons"', 'Key researcher' => 'Elinor Ostrom (Nobel Prize, 2009)', 'Examples' => 'Shared forests, fisheries, water'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a stone terrace in the trees where every household sends someone to talk through how much wood to cut, where to let the forest rest, and how to settle disagreements fairly.',
    ]],
    ['The tragedy of the commons?', ELVEN_REAL, [
      'A "commons" is something shared by a group, such as grazing land, a fishing ground, a forest or groundwater. For a long time, many economists believed shared resources would always be overused, because each person benefits from taking more while the cost is shared by everyone.',
    ]],
    ['How communities manage shared resources', ELVEN_REAL, [
      'The political scientist Elinor Ostrom studied communities around the world, from Swiss mountain pastures to Japanese forests and irrigation systems in Spain and Nepal, that had looked after shared resources well, sometimes for centuries. She found they shared certain features:',
    ], ['list' => [
      'Clear boundaries: everyone knows who can use the resource.',
      'Rules that fit local conditions, made by the people who use them.',
      'Monitoring, so everyone can see whether rules are followed.',
      'Fair, gradual penalties and simple ways to settle disputes.',
    ]], [
      'In 2009 Ostrom became the first woman to win the Nobel Prize in Economic Sciences.',
    ]],
  ],
  'art' => 'This illustration shows a pale stone terrace with carved seats and steps beneath a great tree.',
  'look' => ['Find the seats and the steps.', 'Where would a speaker stand?'],
  'questions' => ['How would decisions be made fairly in a place like this?', 'What "commons" do you share at school or at home?', 'What rules would you make for sharing a forest?'],
  'words' => ['Commons' => 'Resources shared by a group.', 'Monitoring' => 'Checking what is happening over time.', 'Consensus' => 'An agreement reached by a whole group.'],
  'sources' => ['ostrom'],
  'related' => ['elven-palace', 'gathering-circle', 'woodworking-workshop'],
],

'elven-palace' => [
  'name' => 'Palace of the long future', 'latin' => 'thinking for future generations', 'cat' => 'learn', 'src' => 'art/town_3.png',
  'summary' => 'An imagined palace where leaders must think a hundred years ahead. Real governments have begun to create laws for future generations.',
  'facts' => ['Imagined as' => 'A seat of long-term leadership', 'Real-world idea' => 'Laws for future generations', 'Real example' => 'Well-being of Future Generations (Wales) Act 2015', 'Big question' => 'Who speaks for people not yet born?'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine elven leaders who live for centuries and know they will see the results of every choice. In their crystal palace, no decision could be made without asking: what will this mean for the forest, and for our great-grandchildren?',
    ]],
    ['Short-term thinking', ELVEN_REAL, [
      'Many of the biggest challenges, such as climate change, losing species, building cities and caring for forests, unfold over decades or centuries. But elections, business plans and news often focus on months or a few years. Planting a tree whose shade you will never sit in requires long-term thinking.',
    ]],
    ['A law for the future', ELVEN_REAL, [
      'In 2015, Wales passed the Well-being of Future Generations Act. It requires public bodies, such as councils and health boards, to think about the long-term effects of their decisions on people, culture and the environment. It also created a Future Generations Commissioner, whose job is to stand up for the interests of people who are not yet born.',
      'Other places have experimented with similar ideas, from long-term planning councils to giving legal rights to rivers.',
    ]],
  ],
  'art' => 'This illustration shows a gleaming white palace with crystal spires and terraced gardens.',
  'look' => ['Count the crystal spires.', 'Find the terraced gardens and stairways.'],
  'questions' => ['Who speaks for people not yet born?', 'What decision today will matter most in 100 years?', 'How could your school think about the long-term future?'],
  'words' => ['Future generations' => 'People who will live after us.', 'Long-term' => 'Over a long time, such as decades.', 'Commissioner' => 'A person given a special public duty.'],
  'sources' => ['wales'],
  'related' => ['council-terrace', 'tree-library', 'wild-grove'],
],

'forest-gym' => [
  'name' => 'Forest training grove', 'latin' => 'forest bathing', 'cat' => 'learn', 'src' => 'art/fitness_1.png',
  'summary' => 'An imagined archery grove among the trees. Real research explores how time in forests may lower stress and lift mood.',
  'facts' => ['Imagined as' => 'A training ground in the forest', 'Real-world idea' => 'Shinrin-yoku ("forest bathing")', 'Named in' => 'Japan, 1982', 'Also' => 'Green exercise outdoors'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a sunny glade where elves practice archery, stretch and run among the trees, then sit quietly listening to the leaves before heading home.',
    ]],
    ['Forest bathing', ELVEN_REAL, [
      'In 1982, Japan\'s forestry agency introduced the term "shinrin-yoku", meaning "forest bathing": spending time slowly and calmly in a forest, noticing sights, sounds and smells. It is not exercise in the usual sense, but a way of relaxing in nature.',
      'Researchers have studied whether forest bathing lowers stress. Many small studies have found lower measures of stress and better mood after time in forests, compared with time in cities. Scientists say more large, careful studies are needed to know exactly how strong these effects are.',
    ]],
    ['Green exercise', ELVEN_REAL, [
      'Exercising outdoors, sometimes called "green exercise", combines the benefits of physical activity with time in nature. Parks, trails and woods give people free places to walk, run, cycle and play, and many people find exercising outdoors more enjoyable than indoors.',
    ]],
  ],
  'art' => 'This illustration shows a grove with archery targets, a timber pavilion with purple banners and flowering plants.',
  'look' => ['Find the archery targets.', 'Where could someone rest after training?'],
  'questions' => ['How do you feel after spending time outdoors?', 'Why might scientists want large studies before making health claims?', 'What outdoor place near you could be used for exercise?'],
  'words' => ['Shinrin-yoku' => 'Japanese for "forest bathing".', 'Green exercise' => 'Physical activity in natural places.', 'Stress' => 'The body\'s response to pressure or worry.'],
  'sources' => ['shinrin'],
  'related' => ['canopy-walkway', 'open-air-theater', 'leafy-cottage'],
],

'canopy-walkway' => [
  'name' => 'Canopy climbing course', 'latin' => 'canopy research', 'cat' => 'learn', 'src' => 'art/fitness_2.png',
  'summary' => 'An imagined climbing course in the treetops. Real scientists use walkways, ropes and cranes to study life in the forest canopy.',
  'facts' => ['Imagined as' => 'A treetop climbing course', 'Real-world idea' => 'Forest canopy science', 'Why study it' => 'Much forest life lives high up', 'Tools' => 'Ropes, walkways, towers, cranes, drones'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine ladders, nets and rope bridges strung through the treetops, where young elves practice balance and climbing while learning about the creatures that live high above the forest floor.',
    ]],
    ['The last frontier of the forest', ELVEN_REAL, [
      'In tropical rainforests, a huge share of life, including insects, birds, frogs, orchids and mosses, lives in the canopy, tens of meters above the ground. For a long time this world was very hard to study. Scientists have called the canopy one of the least explored habitats on land.',
    ]],
    ['How scientists get up there', ELVEN_REAL, [], ['list' => [
      'Climbing ropes, using techniques borrowed from rock climbing.',
      'Canopy walkways: rope or metal bridges between trees, some open to visitors.',
      'Towers built beside tall trees.',
      'Construction cranes: the Smithsonian Tropical Research Institute in Panama has used cranes to lift researchers into the canopy.',
      'Drones and sensors that record sounds, temperature and images.',
    ]], [
      'Treetop walkways in many countries now let visitors see the canopy too, which helps people value forests and brings money to protect them.',
    ]],
  ],
  'art' => 'This illustration shows a treetop climbing frame of logs, ropes and platforms with red flags.',
  'look' => ['Find the rope bridges and ladders.', 'What would you see from the highest platform?'],
  'questions' => ['What creatures might live in the treetops above your local park?', 'Why might the canopy be hard to study?', 'Would you walk on a rope bridge 30 meters up?'],
  'words' => ['Canopy' => 'The upper layer of a forest.', 'Epiphyte' => 'A plant that grows on another plant, such as an orchid on a branch.', 'Walkway' => 'A raised path or bridge.'],
  'sources' => ['stri'],
  'related' => ['treetop-village', 'forest-gym', 'treehouse-school'],
],

'open-air-theater' => [
  'name' => 'Open-air theater', 'latin' => 'natural amphitheater', 'cat' => 'learn', 'src' => 'art/fitness_3.png',
  'summary' => 'An imagined theater among the trees. Real open-air theaters use the shape of hills and stone to carry sound without microphones.',
  'facts' => ['Imagined as' => 'A stage in a forest bowl', 'Real-world idea' => 'Natural acoustics', 'Famous ancient example' => 'Theater of Epidaurus, Greece', 'Natural rock example' => 'Red Rocks Amphitheatre, Colorado'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a bowl of carved seats in a forest clearing where a single voice on stage can be heard in the back row, with only birdsong and wind as the background music.',
    ]],
    ['Ancient sound engineering', ELVEN_REAL, [
      'The ancient Greek theater at Epidaurus, built in the 4th century BC and part of a UNESCO World Heritage Site, is famous for its acoustics; it is often said that people in the top rows can hear a coin dropped on the stage. Researchers believe the steep, curved rows of stone seats reflect speech toward the audience while scattering lower background noise.',
    ]],
    ['Nature\'s own concert hall', ELVEN_REAL, [
      'Near Denver, Colorado, Red Rocks Amphitheatre is built between two giant red sandstone rocks that reflect sound back to the audience. Concerts have been held there for about a century.',
      'Designing an open-air theater today means choosing a site sheltered from traffic noise, shaping the slope so everyone can see and hear, and providing paths and seating for people with limited mobility.',
    ]],
  ],
  'art' => 'This illustration shows a round arena of pale stone seats among trees, with carved arches.',
  'look' => ['Look at how the seats curve around the stage.', 'Where would the audience enter?'],
  'questions' => ['Why might a curved shape help people hear?', 'What performance would you put on in a forest theater?', 'How could people with limited mobility reach the seats?'],
  'words' => ['Acoustics' => 'How sound behaves in a space.', 'Amphitheater' => 'A round or oval open-air venue with rising seats.', 'Reflect' => 'Bounce back.'],
  'sources' => ['epidaurus', 'redrocks'],
  'related' => ['forest-gym', 'gathering-circle', 'council-terrace'],
],

// ---------------- Making and trading ----------------
'canopy-market' => [
  'name' => 'Canopy market', 'latin' => 'natural shade', 'cat' => 'make', 'src' => 'art/business_1.png',
  'summary' => 'Market stalls under giant mushroom-shaped canopies. Real shade structures, and real trees, cool hot city squares.',
  'facts' => ['Imagined as' => 'A market under living canopies', 'Real-world idea' => 'Shade to cool cities', 'Real example' => 'Metropol Parasol, Seville (2011)', 'Best shade' => 'Trees'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine market stalls sheltered by giant living canopies that open their caps in the heat of the day and close them at night, keeping fruit fresh and shoppers cool without any machines.',
    ]],
    ['Why shade matters', ELVEN_REAL, [
      'Cities get much hotter than the countryside because dark roofs and paving soak up sunlight. Heatwaves are dangerous, especially for older people, babies and outdoor workers. Shade can make a big difference: surfaces in shade can be many degrees cooler than surfaces in full sun.',
      'Trees are the best shade-makers, because they also cool the air by releasing water through their leaves.',
    ]],
    ['A giant wooden "mushroom"', ELVEN_REAL, [
      'In Seville, Spain, one of Europe\'s hottest cities, the Metropol Parasol was completed in 2011. It is a huge wooden structure of six mushroom-like parasols that shades a public square, with a market beneath and a walkway on top. Locals nicknamed it "Las Setas", the mushrooms.',
    ]],
  ],
  'art' => 'This illustration shows market stalls under large mushroom-shaped canopies, with lanterns and baskets of goods.',
  'look' => ['Notice how the canopies shade the stalls.', 'What goods are for sale?'],
  'questions' => ['How could shade reduce a city\'s need for cooling?', 'Where would shade help most in your town?', 'Why might trees be better than umbrellas for shade?'],
  'words' => ['Urban heat island' => 'When cities are hotter than the countryside around them.', 'Parasol' => 'A shade, like an umbrella.', 'Heatwave' => 'A period of unusually hot weather.'],
  'sources' => ['metropol', 'epa-heat'],
  'related' => ['market-hall', 'wild-grove', 'tree-tower-home'],
],

'market-hall' => [
  'name' => 'Harvest market hall', 'latin' => 'local, zero-waste food', 'cat' => 'make', 'src' => 'art/business_2.png',
  'summary' => 'An imagined market where nothing is wasted. Real towns cut waste by selling local food and composting what is left.',
  'facts' => ['Imagined as' => 'A market that wastes nothing', 'Real-world idea' => 'Local food and composting', 'Problem' => 'A large share of food is wasted', 'Solution' => 'Refill, share, compost'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a market hall where every fruit is sold, shared or turned into jam, every peel goes back to the gardens as compost, and goods are carried home in woven baskets instead of plastic.',
    ]],
    ['The problem of waste', ELVEN_REAL, [
      'Around the world, a large share of the food that is grown is lost or thrown away, along with the water, land and energy used to grow it. The UN Environment Program estimated that in 2022 about a fifth of the food available to shoppers, shops and restaurants was wasted. Food rotting in landfill also releases methane, a powerful greenhouse gas.',
    ]],
    ['Ideas towns are using', ELVEN_REAL, [], ['list' => [
      'Farmers\' markets that sell food grown nearby, often with less packaging.',
      'Refill shops where customers bring their own containers.',
      'Food-sharing schemes that pass unsold food to people who need it.',
      'Composting food scraps to feed the soil, closing the loop.',
      'Selling "wonky" fruit and vegetables that look odd but taste fine.',
    ]], [
      'Local food is not always lower-carbon: how food is grown can matter more than how far it travels. But local markets help small farmers and connect people to where food comes from.',
    ]],
  ],
  'art' => 'This illustration shows a large timber market hall with purple banners, stalls and trees growing through it.',
  'look' => ['Find the stalls and the goods for sale.', 'How do the trees fit into the building?'],
  'questions' => ['What happens to food that is not sold where you live?', 'How could a market produce less waste?', 'Is food grown nearby always better for the planet? Why or why not?'],
  'words' => ['Compost' => 'Rotted plant waste that feeds the soil.', 'Zero waste' => 'Aiming to send nothing to landfill.', 'Methane' => 'A powerful greenhouse gas.'],
  'sources' => ['unep-food', 'fao-food'],
  'related' => ['canopy-market', 'woodworking-workshop', 'flower-meadow'],
],

'woodworking-workshop' => [
  'name' => 'Repair workshop', 'latin' => 'circular economy', 'cat' => 'make', 'src' => 'art/nt_workshop.png',
  'summary' => 'An imagined workshop where nothing is thrown away. Real repair cafés and well-managed forests keep materials in use.',
  'facts' => ['Imagined as' => 'A workshop that mends everything', 'Real-world idea' => 'Repair, reuse, responsible forestry', 'First Repair Café' => 'Amsterdam, 2009', 'Wood label' => 'Forest Stewardship Council (1993)'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine a workshop where elven carpenters mend broken chairs, turn fallen branches into bowls, and keep every scrap of wood in use until it finally becomes compost or warms a home.',
    ]],
    ['A circular economy', ELVEN_REAL, [
      'Most of what we buy follows a straight line: take materials, make a product, use it, throw it away. A "circular economy" tries to keep things in use for as long as possible by designing them to last, sharing them, repairing them and recycling the materials at the end.',
      'In 2009 the first Repair Café opened in Amsterdam: a free event where volunteers help people mend clothes, toasters, bikes and toys. There are now thousands of repair cafés around the world. Some countries have also introduced "right to repair" rules that require spare parts and repair information.',
    ]],
    ['Wood from healthy forests', ELVEN_REAL, [
      'Wood is renewable only if forests are managed well. The Forest Stewardship Council, founded in 1993, certifies forests that are managed to protect wildlife, workers and local communities. Its label helps shoppers choose responsibly sourced wood and paper.',
    ]],
  ],
  'art' => 'This illustration shows a timber workshop with a teal roof, stacked logs and woodworking benches.',
  'look' => ['Look for stacked timber and tools.', 'What might be being made or mended?'],
  'questions' => ['How could a city reuse wood instead of cutting new trees?', 'What have you repaired, or could you repair?', 'Why are some products hard to fix?'],
  'words' => ['Circular economy' => 'Keeping materials in use instead of throwing them away.', 'Right to repair' => 'Rules that make it easier to fix things you own.', 'Certified' => 'Checked to meet a standard.'],
  'sources' => ['repair', 'fsc'],
  'related' => ['timber-house', 'market-hall', 'building-materials'],
],

'building-materials' => [
  'name' => 'Nature\'s materials', 'latin' => 'biomimicry', 'cat' => 'make', 'src' => 'build/materials.png',
  'summary' => 'Stone, timber and crystals for elven builders, and the real inventions engineers have copied from nature.',
  'facts' => ['Imagined as' => 'Materials gathered from the forest', 'Real-world idea' => 'Biomimicry', 'Famous copies' => 'Velcro, self-cleaning surfaces, bullet-train nose', 'Key book' => 'Janine Benyus, "Biomimicry" (1997)'],
  'sections' => [
    ['What it could do', ELVEN_IMAGINE, [
      'Imagine builders who take only what the forest can spare: fallen timber, loose stone and crystals grown slowly in caves, and who ask of every material, "how would nature do this?"',
    ]],
    ['Learning from 3.8 billion years of design', ELVEN_REAL, [
      'Life on Earth has been solving problems for billions of years. Biomimicry is the practice of learning from nature\'s designs to solve human problems. The biologist Janine Benyus made the word popular in her 1997 book.',
    ], ['list' => [
      'Velcro: invented after the engineer George de Mestral looked closely at burrs that stuck to his dog\'s fur.',
      'The lotus effect: lotus leaves stay clean because tiny bumps make water roll off, carrying dirt. This inspired self-cleaning paints and glass.',
      'The bullet train: Japan\'s Shinkansen engineers reshaped a train\'s nose to be more like a kingfisher\'s beak, making it quieter when leaving tunnels.',
      'Termite-inspired cooling: see the Breathing spire page.',
    ]]],
    ['Low-carbon materials', ELVEN_REAL, [
      'The materials a building is made from carry hidden "embodied carbon" from mining, making and transport. Timber, straw, earth, reused bricks and recycled steel usually carry much less than new concrete and steel. Choosing them, and designing buildings to be taken apart and reused, can cut a building\'s climate impact.',
    ]],
  ],
  'art' => 'This illustration shows carved white stone, timber logs and a basket of glowing crystals.',
  'look' => ['Which materials here would grow back, and which would not?', 'Find the basket of crystals.'],
  'questions' => ['What problem could you solve by copying a plant or animal?', 'How could builders take only what nature can replace?', 'Why might a material made nearby be better for the planet?'],
  'words' => ['Biomimicry' => 'Learning from nature\'s designs to solve human problems.', 'Embodied carbon' => 'Emissions from making and moving materials.', 'Lotus effect' => 'Self-cleaning caused by water rolling off a bumpy surface.'],
  'sources' => ['benyus', 'asknature', 'lotus'],
  'related' => ['living-crane', 'mushroom-cottage', 'spire-house'],
],
];

$WORLD_DATA['elven'] = [
  'title'    => 'Elven City Explorer: imagined buildings, real nature technology',
  'desc'     => 'Explore an imagined elven city that lives in harmony with nature. Each of 35 buildings pairs a fantasy idea with real nature-based technology, from living root bridges and seed vaults to glowing plants and algae buildings.',
  'intro'    => 'A fantasy city that grows with the forest. Every building is imagined, but each page shows the real science and nature-based technology that could make parts of it possible.',
  'note'     => 'This world is imagined and does not describe any real culture. Each page marks what is imagined, what is real today and what is still being researched.',
  'aka'      => 'Real-world idea',
  'akaLang'  => '',
  'pageTitle'=> '%s: elven idea, real nature technology',
  'aside'    => ['How to read these pages', 'Each page has three kinds of section. Imagined sections describe the fantasy building. Real world sections describe science, places and technology that exist today, with sources. Possible future sections describe ideas still being researched, which may or may not work.'],
  'pageDesc' => ' Explore the imagined idea, the real science behind it, and questions for discussion.',
  'sourcesIntro' => 'The real-world facts on this page are based on these sources:',
  'about'    => 'Ecological design, biomimicry and nature-based technology',
  'map' => [
    'crystal-tower', 'weather-tower', 'living-crane', 'elven-palace', 'crystal-waterfall', 'tree-tower-home',
    'spire-house', 'great-tree-hall', 'grand-tree-hall', 'treetop-village', 'domed-observatory', 'stag-monument',
    'green-roof-cottage', 'timber-house', 'market-hall', 'tree-library', 'treehouse-school', 'deer-statue',
    'open-air-theater', 'council-terrace', 'canopy-walkway', 'woodworking-workshop', 'forest-gym', 'leafy-cottage',
    'natural-cottage', 'canopy-market', 'spring-circle', 'crystal-fountain', 'mushroom-cottage', 'hillside-home',
    'wild-grove', 'garden-court', 'gathering-circle', 'flower-meadow', 'building-materials', 'tree',
  ],
  'tree'     => 'blossom-tree',
  'sources'  => $ELVEN_SOURCES,
  'cats'     => $ELVEN_CATEGORIES,
  'pages'    => $ELVEN,
];
