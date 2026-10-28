<?php
// Finds problems tools/check-site.sh cannot see, in every generated page under public/:
// duplicate ids, broken JSON-LD, stray escape characters, doubled words, empty captions,
// over-long titles and descriptions, and sitemap entries that do not match a page.
// Usage: php tools/deep-check.php   (exit code 1 if anything is found)
$pub = dirname(__DIR__) . '/public';
$problems = 0;
function ulen($s) { return preg_match_all("/./us", $s); }
function report($page, $msg) { global $problems; $problems++; echo "$page: $msg\n"; }

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pub));
$pages = [];
foreach ($it as $f) if (substr($f, -5) === '.html') $pages[] = (string)$f;
sort($pages);

foreach ($pages as $file) {
  $p = str_replace([$pub, '\\', 'index.html'], ['', '/', ''], $file);
  $html = file_get_contents($file);

  preg_match_all('/\sid="([^"]+)"/', $html, $m);
  foreach (array_count_values($m[1]) as $id => $n) if ($n > 1) report($p, "duplicate id \"$id\" ($n times)");

  preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $m);
  foreach ($m[1] as $json) if (json_decode($json) === null) report($p, 'invalid JSON-LD');

  $text = strip_tags(preg_replace('#<(script|style)[^>]*>.*?</\1>#s', '', $html));
  $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  if (preg_match('/\\\\[\'"n]|&amp;|&#0?39;/', $text, $x)) report($p, "stray escape in text: " . $x[0]);
  if (preg_match('/\b(\w+) \1\b/i', $text, $x) && !in_array(strtolower($x[1]), ['that', 'had', 'very'])) report($p, "doubled word: \"$x[0]\"");
  if (preg_match('/ ,|\.\.(?!\.)| \.(?=\s)/', $text, $x)) report($p, "odd punctuation: \"$x[0]\"");

  if (preg_match('#<figcaption>\s*<span#', $html)) report($p, 'photo with empty caption');
  if (preg_match('#<title>([^<]*)</title>#', $html, $t)) {
    $title = html_entity_decode($t[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $core = explode(' | ', $title)[0];
    if (ulen($core) > 70) report($p, 'title longer than 70 characters (' . ulen($core) . ')');
  }
  if (preg_match('#<meta name="description" content="([^"]*)"#', $html, $d)) {
    $len = ulen(html_entity_decode($d[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    if ($len < 50 || $len > 300) report($p, "description length $len");
  }
}

// Sitemap entries must point to real pages, and every indexable page should be listed.
$sitemap = file_get_contents("$pub/sitemap.xml");
preg_match_all('#<loc>([^<]+)</loc>#', $sitemap, $m);
$listed = [];
foreach ($m[1] as $loc) {
  $path = preg_replace('#^https?://[^/]+#', '', $loc);
  $listed[$path] = true;
  if (!is_file($pub . $path . 'index.html') && !is_file($pub . $path)) report('sitemap.xml', "points to missing page $path");
}
foreach ($pages as $file) {
  $p = str_replace([$pub, '\\', 'index.html'], ['', '/', ''], $file);
  if (strpos(file_get_contents($file), 'content="noindex') !== false) continue;
  if (!isset($listed[$p])) report('sitemap.xml', "missing indexable page $p");
}
echo "pages: " . count($pages) . ", problems: $problems\n";
exit($problems ? 1 : 0);
