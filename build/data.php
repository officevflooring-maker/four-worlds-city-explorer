<?php
// Shared facts about each world, used on the home page cards, navigation and world pages.
// Each world's building pages live in build/worlds/{world}.php.
// Rome is a historical setting; the other worlds are imagined or speculative.

$WORLDS = [
  'roman' => [
    'name' => 'Ancient Rome', 'short' => 'Roman', 'type' => 'Historical setting',
    'lead' => 'A real city. Open any of 35 buildings to learn how it worked, with photos of real Roman sites.',
    'card' => 'amphitheater', 'ground' => 'ground-plaza',
  ],
  'modern' => [
    'name' => 'Modern Town', 'short' => 'Modern', 'type' => 'Imaginative design setting',
    'lead' => 'An imagined town of real buildings. Open any of 36 to learn why towns need it, how it is built and who it serves.',
    'card' => 'mixed-use-building', 'ground' => 'ground-plaza',
  ],
  'elven' => [
    'name' => 'Elven Green World', 'short' => 'Elven', 'type' => 'Imaginative design setting',
    'lead' => 'A fantasy city that grows with the forest. Each of 35 buildings is paired with real nature-based technology.',
    'card' => 'treetop-village', 'ground' => 'ground-meadow',
  ],
  'future' => [
    'name' => 'Robotic Future', 'short' => 'Future', 'type' => 'Speculative design setting',
    'lead' => 'One possible future on the Moon and Mars. Each of 34 buildings explains the real space technology behind it.',
    'card' => 'greenhouse-dome', 'ground' => 'ground-plaza',
  ],
];

// Compare page: one shared question, four themes, one picture per world.
// Each cell: [image name, label, prompt, building page it links to (optional)].
$COMPARE = [
  ['water', 'Water', 'Where does clean water come from, and how does it reach people?', [
    'roman'  => ['aqueduct', 'Aqueduct', 'Water travels downhill along a channel. What happens if the slope is wrong?'],
    'modern' => ['plaza-fountain', 'Plaza fountain', 'Most of a modern water system is hidden. What pipes, pumps or treatment might be out of sight?', 'water-system'],
    'elven'  => ['spring-circle', 'Spring circle', 'The spring is protected by stones. What could harm a water source?'],
    'future' => ['indoor-farm', 'Indoor farm', 'Indoor farms could reuse water. Is that worth the energy they need?'],
  ]],
  ['gather', 'Places to gather', 'Where do people meet, celebrate and make decisions together?', [
    'roman'  => ['amphitheater', 'Amphitheater', 'Thousands watched together, seated by rank. Who was welcome, and where?'],
    'modern' => ['community-center', 'Community center', 'What would make everyone in the neighborhood feel welcome here?'],
    'elven'  => ['gathering-circle', 'Warm gathering circle', 'Imagined as warmed by heat from deep in the ground. Where could your town find clean warmth?'],
    'future' => ['public-plaza', 'Public plaza', 'If more life happens online, does a city still need squares like this?'],
  ]],
  ['travel', 'Safe travel', 'How do people cross the city safely, on foot and on wheels?', [
    'roman'  => ['ground-crossroads', 'Stone crossroads', 'Look at the stone stripes crossing the road. What might they be for?'],
    'modern' => ['ground-crossroads', 'Crosswalks', 'Painted crosswalks mark where to cross. What else helps people cross safely?', 'streets-crosswalks'],
    'elven'  => ['ground-crossroads', 'Garden paths', 'There are no cars here. How would people carry heavy things?'],
    'future' => ['ground-crossroads', 'Lit roadway', 'Glowing crossings light the way. Who might these lights help, and who might they not?'],
  ]],
  ['goods', 'Moving goods', 'How do food, parcels and supplies reach the people who need them?', [
    'roman'  => ['donkey-cart', 'Donkey cart', 'Carts were banned from Rome\'s streets by day. When would you allow deliveries?'],
    'modern' => ['delivery-van', 'Delivery van', 'Online shopping brings vans to every street. How could deliveries cause less traffic?'],
    'elven'  => ['flower-cart', 'Flower cart', 'A pony pulls the cart to market. When is slow transport the better choice?'],
    'future' => ['cargo-pod', 'Cargo pod', 'No driver at all. Which jobs should robots do, and which should people keep?'],
  ]],
  ['nature', 'Room for nature', 'Where do plants, animals and open land fit in the city?', [
    'roman'  => ['olive-tree', 'Olive tree', 'Olive trees give shade and food. What else could a city tree provide?', 'olive-grove'],
    'modern' => ['community-garden', 'Community garden', 'Gardens take up space that could hold housing. How would you balance the two?'],
    'elven'  => ['flower-meadow', 'Flower meadow', 'Flowers feed pollinators. Could your street have a meadow?'],
    'future' => ['tree-pod-habitat', 'Tree pod habitat', 'Homes are built around the tree. Is that sharing space, or taking it over?'],
  ]],
];
