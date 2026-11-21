<?php
// Pinterest pins (owner, Nov 20, 2026): a tall picture (1000 x 1500) for every lesson, world, tour and building, and
// the files for Pinterest's bulk upload (Create > Create Pins in bulk > upload a .csv). See pinterest/README.md.
//   php tools/make-pins.php          draws the missing pictures and rewrites the upload files
//   php tools/make-pins.php --redo   draws every picture again
// Reads pinterest/pins.json (written by build/build.php). Pictures go to public/assets/pins/, so they have a public
// address for the upload file once pushed. Needs ffmpeg and Georgia (Windows), like tools/make-og-places.php.
chdir(__DIR__ . '/../build');
require 'config.php';
const PUB = __DIR__ . '/../public';
const PER_WEEK = 35;   // 5 pins a day: Pinterest favors a steady trickle over a big batch

$redo = in_array('--redo', $argv, true);
$pins = json_decode(file_get_contents(__DIR__ . '/../pinterest/pins.json'), true);
$bold = "fontfile='C\\:/Windows/Fonts/georgiab.ttf'";
$plain = "fontfile='C\\:/Windows/Fonts/georgia.ttf'";
// Background and the world's color (as in make-og-places.php).
$look = [
  'roman' => ['0xf3e2d6', '0xb3431d'], 'modern' => ['0xdde6f3', '0x2459c4'], 'green' => ['0xdfecd9', '0x2f7d34'],
  'future' => ['0xd7e9ec', '0x00798c'], 'egypt' => ['0xf1e3c8', '0x95650f'], 'heaven' => ['0xe9e5f5', '0x6a4fb3'],
  'medieval' => ['0xf3e1e4', '0x9b1c3c'],
];
$tmp = sys_get_temp_dir() . '/pin-text';
@mkdir($tmp);
@mkdir(PUB . '/assets/pins', 0777, true);
function lines($text, $max) {
  $out = [''];
  foreach (explode(' ', $text) as $word) {
    $last = count($out) - 1;
    if ($out[$last] !== '' && strlen($out[$last] . ' ' . $word) > $max) $out[] = $word;
    else $out[$last] = trim($out[$last] . ' ' . $word);
  }
  return $out;
}
// drawtext reads its words from a file, so quotes and colons need no escaping.
function text_file($name, $text) {
  global $tmp;
  $f = "$tmp/$name.txt";
  file_put_contents($f, $text);
  return "textfile='" . str_replace(':', '\\:', str_replace('\\', '/', $f)) . "'";
}

$made = 0;
foreach ($pins as $p) {
  $out = PUB . "/assets/pins/{$p['file']}.jpg";
  if (!$redo && is_file($out)) continue;
  [$bg, $accent] = $look[$p['world']];
  // The heading: as big as fits in four lines.
  foreach ([[84, 17], [70, 21], [58, 26]] as [$size, $max]) { $big = lines($p['big'], $max); if (count($big) <= 4) break; }
  $y = 150;
  $draw = ["drawtext=$bold:" . text_file('site', strtoupper(SITE_NAME)) . ":fontsize=30:fontcolor=0x23396b:x=(w-text_w)/2:y=80"];
  foreach ($big as $i => $line) { $draw[] = "drawtext=$bold:" . text_file("big$i", $line) . ":fontsize=$size:fontcolor=0x17202b:x=(w-text_w)/2:y=$y"; $y += round($size * 1.2); }
  $draw[] = "drawtext=$plain:" . text_file('small', $p['small']) . ":fontsize=36:fontcolor=$accent:x=(w-text_w)/2:y=" . ($y + 20);
  // The picture, as big as fits between the words and the address band, centered in that space.
  $room = 1380 - ($y + 90) - 20;
  $picSize = min(820, $room);
  $picTop = $y + 90 + intdiv($room - $picSize, 2);
  // A white band at the bottom with the address, so the pin says where it leads.
  $draw[] = "drawbox=x=0:y=1380:w=1000:h=120:color=white@0.92:t=fill";
  $draw[] = "drawtext=$bold:" . text_file('url', 'Free at atlasofcities.org') . ":fontsize=40:fontcolor=0x23396b:x=(w-text_w)/2:y=1420";
  $filter = "[1]scale=1000:-1[h];[2]scale={$picSize}:{$picSize}[b];[0][h]overlay=0:H-h-110[t];[t][b]overlay=(W-w)/2:$picTop," . implode(',', $draw);
  $cmd = 'ffmpeg -nostdin -loglevel error -y -f lavfi -i ' . escapeshellarg("color=c=$bg:s=1000x1500")
    . ' -i ' . escapeshellarg(PUB . "/assets/worlds/{$p['world']}/horizon-1600.webp")
    . ' -i ' . escapeshellarg(PUB . "/assets/worlds/{$p['world']}/{$p['pic']}-960.webp")
    . ' -filter_complex ' . escapeshellarg($filter) . ' -frames:v 1 -q:v 8 ' . escapeshellarg($out);
  exec($cmd, $o, $code);
  if ($code) { fwrite(STDERR, "failed {$p['file']}\n"); continue; }
  $made++;
}
echo "made $made pictures\n";

// The upload files, one per week. Pinterest's columns; Title up to 100 characters, Description up to 500. The
// boards must already exist on the account with exactly these names.
$dir = __DIR__ . '/../pinterest';
foreach (glob("$dir/week-*.csv") as $old) unlink($old);
foreach (array_chunk($pins, PER_WEEK) as $n => $chunk) {
  $f = fopen(sprintf('%s/week-%02d.csv', $dir, $n + 1), 'w');
  fputcsv($f, ['Title', 'Media URL', 'Pinterest board', 'Thumbnail', 'Description', 'Link', 'Publish date', 'Keywords'], ',', '"', '');
  foreach ($chunk as $p) fputcsv($f, [substr($p['title'], 0, 100), SITE_URL . "/assets/pins/{$p['file']}.jpg", $p['board'], '', substr($p['desc'], 0, 500), $p['link'], '', ''], ',', '"', '');
  fclose($f);
}
echo 'wrote ' . ceil(count($pins) / PER_WEEK) . " weekly upload files\n";
