<?php
// Shared facts about each world, used on the home page cards, navigation and world pages.
// Each world's building pages live in build/worlds/{world}.php.
// Ancient Egypt and Rome are historical settings; the modern town, Green World and future are imagined or
// speculative, and the Heavenly City is imagined, inspired by the Bible, and tells the story of Jesus.

$WORLDS = [
  'egypt' => [
    'name' => 'Ancient Egypt', 'short' => 'Egyptian', 'type' => 'Historical setting',
    'lead' => 'A real civilization on the Nile. Open any of 37 places to learn how it worked, with photos of real Egyptian sites.',
    'card' => 'pharaohs-palace', 'ground' => 'ground-grass',
  ],
  'heaven' => [
    'name' => 'Heavenly City', 'short' => 'Heavenly', 'type' => 'Imagined setting, inspired by the Bible',
    'lead' => 'An imagined city of gold and light. Explore its 35 places to follow the story of Jesus, as the Bible tells it, with photos of the real places.',
    'card' => 'palace-of-light', 'ground' => 'ground-grass',
  ],
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
  'green' => [
    'name' => 'Green World', 'short' => 'Green', 'type' => 'Imaginative design setting',
    'face' => 'flower-cart',   // no people live here: this picture stands for the world
    'lead' => 'An imagined city that grows with the forest. Each of 35 buildings is paired with real nature-based technology.',
    'card' => 'treetop-village', 'ground' => 'ground-meadow',
  ],
  'future' => [
    'name' => 'Robotic Future', 'short' => 'Future', 'type' => 'Speculative design setting',
    'lead' => 'One possible future on the Moon and Mars. Each of 34 buildings explains the real space technology behind it.',
    'card' => 'greenhouse-dome', 'ground' => 'ground-plaza',
  ],
];

// Compare page: one shared question per theme, one picture per world.
// Each cell: [image name, label, prompt, building page it links to (optional)].
$COMPARE = [
  ['water', 'Water', 'Where does clean water come from, and how does it reach people?', [
    'egypt'  => ['lotus-pool', 'Lotus pool', 'Almost all water came from the Nile, carried by hand or lifted with a shaduf. What happens to a land that depends on one river?'],
    'heaven' => ['fountain-of-life', 'Fountain of life', 'Here the water never runs out and never makes anyone sick. What would it take to make that true everywhere?'],
    'roman'  => ['aqueduct', 'Aqueduct', 'Water travels downhill along a channel. What happens if the slope is wrong?'],
    'modern' => ['plaza-fountain', 'Plaza fountain', 'Most of a modern water system is hidden. What pipes, pumps or treatment might be out of sight?', 'water-system'],
    'green'  => ['spring-circle', 'Spring circle', 'The spring is protected by stones. What could harm a water source?'],
    'future' => ['indoor-farm', 'Indoor farm', 'Indoor farms could reuse water. Is that worth the energy they need?'],
  ]],
  ['gather', 'Places to gather', 'Where do people meet, celebrate and make decisions together?', [
    'egypt'  => ['feast-hall', 'Feast hall', 'Banquets had music, dancing and plenty of food. Who was invited, and who did the work?'],
    'heaven' => ['banquet-hall', 'Banquet hall', 'A table with a seat for everyone. Who might be missing from the table in your town?'],
    'roman'  => ['amphitheater', 'Amphitheater', 'Thousands watched together, seated by rank. Who was welcome, and where?'],
    'modern' => ['community-center', 'Community center', 'What would make everyone in the neighborhood feel welcome here?'],
    'green'  => ['gathering-circle', 'Warm gathering circle', 'Imagined as warmed by heat from deep in the ground. Where could your town find clean warmth?'],
    'future' => ['public-plaza', 'Public plaza', 'If more life happens online, does a city still need squares like this?'],
  ]],
  ['travel', 'Safe travel', 'How do people cross the city safely, on foot and on wheels?', [
    'egypt'  => ['ground-crossroads', 'Sandstone crossroads', 'Most Egyptians traveled by boat on the Nile. Why might a river be easier than a road?', 'sailing-boat'],
    'heaven' => ['ground-crossroads', 'Golden crossroads', 'Streets of gold with crossings of pearl. What makes a street feel safe and welcoming?'],
    'roman'  => ['ground-crossroads', 'Stone crossroads', 'Look at the stone stripes crossing the road. What might they be for?'],
    'modern' => ['ground-crossroads', 'Crosswalks', 'Painted crosswalks mark where to cross. What else helps people cross safely?', 'streets-crosswalks'],
    'green'  => ['ground-crossroads', 'Garden paths', 'There are no cars here. How would people carry heavy things?'],
    'future' => ['ground-crossroads', 'Lit roadway', 'Glowing crossings light the way. Who might these lights help, and who might they not?'],
  ]],
  ['goods', 'Moving goods', 'How do food, parcels and supplies reach the people who need them?', [
    'egypt'  => ['stone-sledge', 'Stone sledge', 'Giant stones moved on sledges, boats and ramps. How would you move a load as heavy as a truck without engines?'],
    'heaven' => ['fruit-donkey', 'Donkey with fruit', 'Everything here is free to share. How could your town share more of what it has?'],
    'roman'  => ['donkey-cart', 'Donkey cart', 'Carts were banned from Rome\'s streets by day. When would you allow deliveries?'],
    'modern' => ['delivery-van', 'Delivery van', 'Online shopping brings vans to every street. How could deliveries cause less traffic?'],
    'green'  => ['flower-cart', 'Flower cart', 'A pony pulls the cart to market. When is slow transport the better choice?'],
    'future' => ['cargo-pod', 'Cargo pod', 'No driver at all. Which jobs should robots do, and which should people keep?'],
  ]],
  ['nature', 'Room for nature', 'Where do plants, animals and open land fit in the city?', [
    'egypt'  => ['date-palm', 'Date palm', 'Palms gave food, shade, rope and roof beams. Which plant gives your town the most?', 'palm-grove'],
    'heaven' => ['golden-tree', 'Golden tree', 'The Bible begins in a garden and ends in a city with a river and the tree of life. Why do trees and water make a place feel good?', 'tree-of-life'],
    'roman'  => ['olive-tree', 'Olive tree', 'Olive trees give shade and food. What else could a city tree provide?', 'olive-grove'],
    'modern' => ['community-garden', 'Community garden', 'Gardens take up space that could hold housing. How would you balance the two?'],
    'green'  => ['flower-meadow', 'Flower meadow', 'Flowers feed pollinators. Could your street have a meadow?'],
    'future' => ['tree-pod-habitat', 'Tree pod habitat', 'Homes are built around the tree. Is that sharing space, or taking it over?'],
  ]],
];
