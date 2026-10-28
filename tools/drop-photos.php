<?php
// Removes photos that were checked by eye and found unsuitable, renumbers nothing, and adds them
// to tools/photo-reject.txt so they are never picked again.
// Usage: php tools/drop-photos.php {world} {img} [{img} ...]   e.g. php tools/drop-photos.php modern stadium-2
$root = dirname(__DIR__);
$w = $argv[1];
$drop = array_slice($argv, 2);
$file = "$root/build/photos/$w.json";
$c = json_decode(file_get_contents($file), true);
foreach ($c as $slug => $list) {
  $c[$slug] = array_values(array_filter($list, function ($p) use ($drop, $root, $w) {
    if (!in_array($p['img'], $drop)) return true;
    foreach (glob("$root/public/assets/photos/$w/{$p['img']}-*.webp") as $f) unlink($f);
    file_put_contents("$root/tools/photo-reject.txt", $p['file'] . "\n", FILE_APPEND);
    echo "dropped $w/{$p['img']} ({$p['file']})\n";
    return false;
  }));
}
file_put_contents($file, json_encode($c, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
