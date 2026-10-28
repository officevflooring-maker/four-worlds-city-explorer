<?php
// Prints tools/assets.txt lines for every building page of a world, named by page slug.
// Usage: php tools/world-asset-lines.php {world}
$w = $argv[1];
$WORLD_DATA = [];
require __DIR__ . "/../build/worlds/$w.php";
foreach ($WORLD_DATA[$w]['pages'] as $slug => $r) {
  [$b, $f] = explode('/', $r['src']);
  $kind = $b === 'build' && $f === 'crane.png' ? 'tall' : ($f === 'aqueduct.png' ? 'wide' : 'tile');
  echo "$w|$b|$f|$slug|$kind\n";
}
