<?php
// Makes a sharing picture (1200 x 630) for every place and vehicle page: the world's horizon, the building, its
// name and its world, in the style of tools/make-og.sh. Writes public/assets/og/{world}/{slug}.jpg and skips
// pictures that already exist (delete one to remake it).
// Usage: php tools/make-og-places.php [world]   (needs ffmpeg and Georgia Bold, as on Windows)
chdir(__DIR__ . '/../build');
require 'config.php';
require 'data.php';
const PUB = __DIR__ . '/../public';
$WORLD_DATA = [];
foreach (['egypt', 'roman', 'modern', 'elven', 'future', 'heaven'] as $w) require "worlds/$w.php";
require 'vehicles.php';

$only = $argv[1] ?? '';
$font = "fontfile='C\\:/Windows/Fonts/georgiab.ttf'";
// Background as in make-og.sh, and the world's color for the small heading.
$look = [
  'roman' => ['0xf3e2d6', '0xb3431d'], 'modern' => ['0xdde6f3', '0x2459c4'], 'elven' => ['0xdfecd9', '0x2f7d34'],
  'future' => ['0xd7e9ec', '0x00798c'], 'egypt' => ['0xf1e3c8', '0x95650f'], 'heaven' => ['0xe9e5f5', '0x6a4fb3'],
];
$tmp = sys_get_temp_dir() . '/og-text';
@mkdir($tmp);
// Breaks a name into lines of at most $max characters.
function lines($text, $max) {
  $out = [''];
  foreach (explode(' ', $text) as $word) {
    $last = count($out) - 1;
    if ($out[$last] !== '' && strlen($out[$last] . ' ' . $word) > $max) $out[] = $word;
    else $out[$last] = trim($out[$last] . ' ' . $word);
  }
  return $out;
}
// drawtext reads its words from a file, so names with quotes or colons need no escaping.
function text_file($name, $text) {
  global $tmp;
  $f = "$tmp/$name.txt";
  file_put_contents($f, $text);
  return "textfile='" . str_replace(':', '\\:', str_replace('\\', '/', $f)) . "'";
}
$made = 0;
foreach ($WORLD_DATA as $w => $D) {
  if ($only && $w !== $only) continue;
  [$bg, $accent] = $look[$w];
  @mkdir(PUB . "/assets/og/$w", 0777, true);
  foreach ($D['pages'] as $slug => $r) {
    $out = PUB . "/assets/og/$w/$slug.jpg";
    if (is_file($out)) continue;
    $pic = PUB . "/assets/worlds/$w/$slug-960.webp";
    if (!is_file($pic)) { fwrite(STDERR, "no picture for $w/$slug\n"); continue; }
    $name = lines($r['name'], 17);
    $size = count($name) > 2 ? 50 : 60;
    $draw = [
      "drawtext=$font:" . text_file('site', SITE_NAME) . ":fontsize=32:fontcolor=0x23396b:x=62:y=110",
      "drawtext=$font:" . text_file('world', strtoupper($WORLDS[$w]['name'] . ' · ' . $D['cats'][$r['cat']][0])) . ":fontsize=24:fontcolor=$accent:x=62:y=172",
    ];
    foreach ($name as $i => $line) $draw[] = "drawtext=$font:" . text_file("name$i", $line) . ":fontsize=$size:fontcolor=0x17202b:x=60:y=" . (222 + $i * round($size * 1.18));
    $filter = "[1]scale=1200:-1[h];[2]scale=480:480[b];[0][h]overlay=0:H-h+10[t];[t][b]overlay=W-w-40:H-h-30," . implode(',', $draw);
    $cmd = 'ffmpeg -nostdin -loglevel error -y -f lavfi -i ' . escapeshellarg("color=c=$bg:s=1200x630")
      . ' -i ' . escapeshellarg(PUB . "/assets/worlds/$w/horizon-1600.webp") . ' -i ' . escapeshellarg($pic)
      . ' -filter_complex ' . escapeshellarg($filter) . ' -frames:v 1 -q:v 5 ' . escapeshellarg($out);
    exec($cmd, $o, $code);
    if ($code) { fwrite(STDERR, "failed $w/$slug\n"); continue; }
    $made++;
  }
}
echo "made $made pictures\n";
