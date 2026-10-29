<?php
// Keeps only the figure in a cut-out picture: the largest connected shape, and a soft edge of 2 pixels around it.
// Bits of other figures or glow left over from the sheet it was cut from become transparent.
// Usage: php -d extension_dir=<php>/ext -d extension=gd tools/keep-figure.php in.png out.png   (see copy-heroes.sh)
[, $in, $out] = $argv;
$im = imagecreatefrompng($in);
imagealphablending($im, false);
imagesavealpha($im, true);
$w = imagesx($im); $h = imagesy($im);
$seen = array_fill(0, $w * $h, 0);   // 0 not visible or not looked at, else the number of its shape
$visible = fn($x, $y) => ((imagecolorat($im, $x, $y) >> 24) & 127) < 120;
$best = 0; $bestSize = 0; $label = 0;
for ($y = 0; $y < $h; $y++) for ($x = 0; $x < $w; $x++) {
  if ($seen[$y * $w + $x] || !$visible($x, $y)) continue;
  $label++; $size = 0; $stack = [[$x, $y]]; $seen[$y * $w + $x] = $label;
  while ($stack) {
    [$cx, $cy] = array_pop($stack); $size++;
    foreach ([[1, 0], [-1, 0], [0, 1], [0, -1]] as [$dx, $dy]) {
      $nx = $cx + $dx; $ny = $cy + $dy;
      if ($nx < 0 || $ny < 0 || $nx >= $w || $ny >= $h || $seen[$ny * $w + $nx] || !$visible($nx, $ny)) continue;
      $seen[$ny * $w + $nx] = $label; $stack[] = [$nx, $ny];
    }
  }
  if ($size > $bestSize) { $best = $label; $bestSize = $size; }
}
$clear = imagecolorallocatealpha($im, 0, 0, 0, 127);
$removed = 0;
for ($y = 0; $y < $h; $y++) for ($x = 0; $x < $w; $x++) {
  if ($seen[$y * $w + $x] === $best || ((imagecolorat($im, $x, $y) >> 24) & 127) === 127) continue;
  $near = false;   // within 2 pixels of the figure: part of its soft edge
  for ($dy = -2; $dy <= 2 && !$near; $dy++) for ($dx = -2; $dx <= 2; $dx++) {
    $nx = $x + $dx; $ny = $y + $dy;
    if ($nx >= 0 && $ny >= 0 && $nx < $w && $ny < $h && $seen[$ny * $w + $nx] === $best) { $near = true; break; }
  }
  if (!$near) { imagesetpixel($im, $x, $y, $clear); $removed++; }
}
imagepng($im, $out);
fwrite(STDERR, basename($in) . ": $removed pixels cleared\n");
