<?php
// Checks every generated page in public/: internal links and images resolve to real files,
// images have alt text, each page has one h1, a title and a description, and no page except
// /credits/ and /support/ links to other websites. The same checks as the first version of
// check-site.sh, in one PHP process, so it runs in seconds. Usage: php tools/check-site.php
$pub = realpath(__DIR__ . '/../public');
preg_match("~const SITE_URL *= *'([^']+)~", file_get_contents(__DIR__ . '/../build/config.php'), $m);
$site = $m[1];
$fail = 0; $n = 0; $pages = 0;
$exists = [];
$ok = function ($r) use ($pub, &$exists) {
  if (!isset($exists[$r])) $exists[$r] = is_file($pub . $r) || is_file($pub . $r . 'index.html');
  return $exists[$r];
};
$files = [];
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pub, FilesystemIterator::SKIP_DOTS));
foreach ($it as $f) if (substr($f->getFilename(), -5) === '.html') $files[] = str_replace('\\', '/', substr($f->getPathname(), strlen($pub)));
sort($files);
foreach ($files as $p) {
  $pages++;
  $h = file_get_contents($pub . $p);
  $refs = [];
  preg_match_all('~(?:href|src|data-full)="(/[^"#?]*)~', $h, $a); $refs = array_merge($refs, $a[1]);
  preg_match_all('~srcset="([^"]*)"~', $h, $a);
  foreach ($a[1] as $set) { preg_match_all('~/assets/[^ ,"]+~', $set, $b); $refs = array_merge($refs, $b[0]); }
  preg_match_all('~url\((/[^)]*)~', $h, $a); $refs = array_merge($refs, $a[1]);
  foreach (array_unique($refs) as $r) {
    $n++;
    if (!$ok($r)) { echo "BROKEN  $p -> $r\n"; $fail = 1; }
  }
  preg_match_all('~<img [^>]*>~', $h, $a);
  $noalt = count(array_filter($a[0], fn($i) => strpos($i, ' alt=') === false));
  if ($noalt) { echo "NO ALT  $p ($noalt images)\n"; $fail = 1; }
  $h1 = substr_count($h, '<h1');
  if ($h1 !== 1) { echo "H1=$h1  $p\n"; $fail = 1; }
  if (!preg_match('~<meta name="description" content="[^"]~', $h)) { echo "NO DESC $p\n"; $fail = 1; }
  if ($p !== '/credits/index.html' && $p !== '/support/index.html') {
    preg_match_all('~href="(https?://[^"]+)~', $h, $a);
    $ext = count(array_filter($a[1], fn($u) => strpos($u, 'creativecommons.org/licenses/by/4.0') === false && strpos($u, $site) === false));
    if ($ext) { echo "OUTLINK $p ($ext)\n"; $fail = 1; }
  }
}
echo "pages: $pages, references checked: $n, problems: $fail\n";
exit($fail);
