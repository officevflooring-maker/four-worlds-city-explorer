<?php
// IndexNow ping (owner, Nov 20, 2026). Tells Bing and the other IndexNow engines (Yandex, Seznam, Naver; Google does
// not use IndexNow) that pages are new or changed, so they recrawl them in days instead of weeks. Bing's index feeds
// Copilot and ChatGPT search. Run it AFTER a push is live, with the pages that changed:
//
//   php tools/indexnow.php /teachers/what-does-a-city-need/ /play/city-builder/    the changed pages
//   php tools/indexnow.php --all       every URL in the LIVE sitemap.xml (first ping, or after a big change)
//   add --dry to see what would be sent without sending
//
// Key: INDEXNOW_KEY in build/config.php, written by the build as public/<key>.txt. Uses curl (the local PHP has no
// https). Answers: 200 OK, 202 accepted (key check pending), 400 bad request, 403 key not valid, 422 URL not ours,
// 429 too many requests.
require __DIR__ . '/../build/config.php';

$args = array_slice($argv, 1);
$dry  = in_array('--dry', $args, true);
$all  = in_array('--all', $args, true);
$args = array_values(array_filter($args, fn($a) => strpos($a, '--') !== 0));
$key  = INDEXNOW_KEY;
$host = parse_url(SITE_URL, PHP_URL_HOST);

function curl_get(array $curlArgs) {
  $out = (string) shell_exec('curl -s -w "\n%{http_code}" ' . implode(' ', array_map('escapeshellarg', $curlArgs)));
  $pos = strrpos($out, "\n");
  return [(int) substr($out, $pos + 1), substr($out, 0, (int) $pos)];
}

$urls = [];
if ($all) {
  [$code, $xml] = curl_get([SITE_URL . '/sitemap.xml?v=' . time()]);
  if ($code !== 200 || !preg_match_all('~<loc>([^<]+)</loc>~', $xml, $m)) { fwrite(STDERR, "Could not read the live sitemap (HTTP $code).\n"); exit(1); }
  $urls = array_map(fn($u) => html_entity_decode($u, ENT_QUOTES | ENT_XML1), $m[1]);
}
foreach ($args as $a) {
  // Git Bash turns "/play/" into "C:/Program Files/Git/play/" (MSYS path conversion): undo that.
  $a = preg_replace('~^[A-Za-z]:/(?:Program Files/)?Git(?=/|$)~', '', str_replace('\\', '/', $a)) ?: '/';
  $urls[] = strpos($a, 'http') === 0 ? $a : SITE_URL . '/' . ltrim($a, '/');
}
$urls = array_values(array_unique($urls));
$bad  = array_filter($urls, fn($u) => parse_url($u, PHP_URL_HOST) !== $host);
if (!$urls || $bad) { fwrite(STDERR, $urls ? 'Not our domain: ' . implode(', ', $bad) . "\n" : "Give the changed pages (e.g. /play/) or --all.\n"); exit(1); }
if (count($urls) > 10000) { fwrite(STDERR, "More than 10,000 URLs; IndexNow takes at most 10,000 per call.\n"); exit(1); }

$body = json_encode(['host' => $host, 'key' => $key, 'keyLocation' => SITE_URL . "/$key.txt", 'urlList' => $urls], JSON_UNESCAPED_SLASHES);
echo count($urls) . " URL(s)" . (count($urls) <= 20 ? ":\n  " . implode("\n  ", $urls) : '') . "\n";
if ($dry) { echo "--dry: nothing sent.\n"; exit(0); }

// IndexNow must be able to read the key file on the live site first.
[$code, $live] = curl_get([SITE_URL . "/$key.txt"]);
if ($code !== 200 || trim($live) !== $key) { fwrite(STDERR, "The live site doesn't serve /$key.txt yet (HTTP $code). Push and wait until it's live.\n"); exit(1); }

$tmp = tempnam(sys_get_temp_dir(), 'indexnow');
file_put_contents($tmp, $body);
[$code, $resp] = curl_get(['-X', 'POST', '-H', 'Content-Type: application/json; charset=utf-8', '--data-binary', '@' . $tmp, 'https://api.indexnow.org/indexnow']);
unlink($tmp);
$meaning = [200 => 'OK', 202 => 'accepted (key check pending)', 400 => 'bad request', 403 => 'key not valid', 422 => 'URL not ours or key mismatch', 429 => 'too many requests'];
echo "IndexNow answered HTTP $code: " . ($meaning[$code] ?? 'unexpected') . ($resp !== '' ? "\n$resp" : '') . "\n";
exit(in_array($code, [200, 202], true) ? 0 : 1);
