<?php
// Titles for every supplied artwork shown on the Artwork page, keyed by world then by file name
// in public/assets/artwork/{world}/ (without .webp). Titles were chosen by looking at each image.
// Roman building titles come from build/roman.php so they match the building pages.

$ART_GROUPS = [
  'buildings'    => 'Buildings',
  'construction' => 'Construction',
  'trees'        => 'Trees',
  'ground'       => 'Landscapes and ground',
  'people'       => 'People',
  'vehicles'     => 'Vehicles',
];

$ART_TITLES = [
  'modern' => [
    'business-1' => 'Corner store', 'business-2' => 'Office building', 'business-3' => 'Art deco skyscraper',
    'family-1' => 'Family house with porch', 'family-2' => 'Modern family home', 'family-3' => 'White church',
    'fitness-1' => 'Gym', 'fitness-2' => 'Sports field', 'fitness-3' => 'Stadium',
    'floor-l' => 'Glass tower', 'floor-m' => 'Apartment building', 'floor-s' => 'Shops with homes above',
    'fountain' => 'Plaza fountain', 'growth-1' => 'Park and pond', 'growth-2' => 'Pagoda-style pavilion', 'growth-3' => 'Lighthouse',
    'home-a' => 'House with garage', 'home-b' => 'Brick family house',
    'knowledge-1' => 'Public library', 'knowledge-2' => 'School', 'knowledge-3' => 'Science center and observatory',
    'monument' => 'Obelisk monument', 'nt-garden' => 'Community garden', 'nt-statue' => 'Statue on a plinth',
    'nt-tower' => 'Lookout tower', 'nt-workshop' => 'Workshop and warehouse',
    'shared-1' => 'Fire pit gathering place', 'shared-2' => 'Treehouse', 'shared-3' => 'Community center',
    'town-1' => 'Town hall', 'town-2' => 'Clock tower', 'town-3' => 'Capitol building',
    'tree-1' => 'Oak tree', 'tree-2' => 'Red maple', 'tree-3' => 'Fir tree', 'tree-4' => 'Round leafy tree',
  ],
  'green' => [
    'business-1' => 'Canopy market', 'business-2' => 'Market hall', 'business-3' => 'Great tree hall',
    'family-1' => 'Hillside home', 'family-2' => 'Timber family house', 'family-3' => 'Tree tower home',
    'fitness-1' => 'Archery grove', 'fitness-2' => 'Climbing course', 'fitness-3' => 'Open-air arena',
    'floor-l' => 'Spire house', 'floor-m' => 'Tall cottage', 'floor-s' => 'Cottage',
    'fountain' => 'Wetland fountain', 'growth-1' => 'Garden court', 'growth-2' => 'Spring circle', 'growth-3' => 'Waterfall tower',
    'home-a' => 'Leafy cottage', 'home-b' => 'Mushroom cottage',
    'knowledge-1' => 'Tree library', 'knowledge-2' => 'Treehouse school', 'knowledge-3' => 'Domed observatory',
    'monument' => 'Stag monument', 'nt-garden' => 'Flower meadow', 'nt-statue' => 'Deer statue',
    'nt-tower' => 'Firefly tower', 'nt-workshop' => 'Woodworking workshop',
    'shared-1' => 'Gathering circle', 'shared-2' => 'Treetop village', 'shared-3' => 'Grand tree hall',
    'town-1' => 'Council terrace', 'town-2' => 'Seasons tower', 'town-3' => 'Palace', 'trees' => 'Wild grove',
    'tree-1' => 'Great oak', 'tree-2' => 'Blossom tree', 'tree-3' => 'Willow tree', 'tree-4' => 'Lantern tree',
  ],
  'future' => [
    'business-1' => 'Tech shop', 'business-2' => 'Corporate tower', 'business-3' => 'Spire tower',
    'family-1' => 'Pod home', 'family-2' => 'Twin-dome home', 'family-3' => 'Dome housing',
    'fitness-1' => 'Fitness center', 'fitness-2' => 'Race track', 'fitness-3' => 'Domed arena',
    'floor-l' => 'Antenna tower', 'floor-m' => 'Factory', 'floor-s' => 'Bunker',
    'fountain' => 'Energy fountain', 'growth-1' => 'Greenhouse dome', 'growth-2' => 'Sphere house with pool', 'growth-3' => 'Power tower',
    'home-a' => 'Hangar home', 'home-b' => 'Dome home',
    'knowledge-1' => 'Research lab', 'knowledge-2' => 'Glass lab', 'knowledge-3' => 'Radio telescope',
    'monument' => 'Robot monument', 'nt-garden' => 'Indoor farm', 'nt-statue' => 'Hologram statue',
    'nt-tower' => 'Communication tower', 'nt-workshop' => 'Robotics factory',
    'shared-1' => 'Public plaza', 'shared-2' => 'Tree pod habitat', 'shared-3' => 'Civic dome',
    'town-1' => 'Command center', 'town-2' => 'Launch pad', 'town-3' => 'Spaceport',
    'tree-1' => 'Pine tree', 'tree-2' => 'Planter cypress', 'tree-3' => 'Ringed tree', 'tree-4' => 'Light tree',
  ],
  // pictures with no page of their own (the other Egypt and Heaven pictures are titled by their pages)
  'egypt' => [
    'floor-l' => 'Tower house',
    'tree-1' => 'Date palm', 'tree-2' => 'Doum palm', 'tree-3' => 'Sycamore fig', 'tree-4' => 'Papyrus reeds',
    'horizon' => 'Desert horizon with pyramids', 'tex-grass' => 'Ground: sand and grass', 'tex-far' => 'Ground: desert dunes',
    'tex-water' => 'Ground: the Nile', 'tex-plaza' => 'Ground: painted sandstone paving', 'tex-road' => 'Ground: sandstone road',
  ],
  'heaven' => [
    'floor-s' => 'Little domed house', 'floor-m' => 'Marble house with balconies', 'floor-l' => 'Spire tower',
    'home-a' => 'Round domed house', 'home-b' => 'Villa with a gold roof', 'island-2' => 'Floating tower island',
    'tree-1' => 'Cypress tree', 'tree-2' => 'White blossom tree', 'tree-3' => 'Golden tree', 'tree-4' => 'Tree of flowering vines',
    'horizon' => 'Horizon: a sea of clouds', 'tex-grass' => 'Ground: clouds', 'tex-far' => 'Ground: a sea of clouds',
    'tex-water' => 'Ground: clear water', 'tex-plaza' => 'Ground: marble with gold stars', 'tex-road' => 'Ground: golden street',
    'tex-cross' => 'Ground: golden crossroads', 'tex-lot' => 'Ground: marble building lot',
  ],
  'roman' => [
    'tree-1' => 'Cypress tree', 'tree-2' => 'Umbrella pine', 'tree-3' => 'Olive tree', 'tree-4' => 'Fig tree',
  ],
];

// Titles shared by every world.
$ART_COMMON = [
  'construction-crane' => 'Construction crane', 'construction-materials' => 'Building materials', 'construction-aqueduct' => 'Aqueduct',
  'ground-horizon' => 'Landscape horizon', 'ground-tex-cross' => 'Ground: crossroads', 'ground-tex-far' => 'Ground: distant countryside',
  'ground-tex-grass' => 'Ground: grass', 'ground-tex-lot' => 'Ground: building lot', 'ground-tex-plaza' => 'Ground: plaza paving',
  'ground-tex-road' => 'Ground: road', 'ground-tex-water' => 'Ground: water',
];
