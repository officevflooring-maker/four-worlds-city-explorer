<?php
// Finds openly licensed photos on Wikimedia Commons for each building page of a world
// (searches in tools/photo-queries/{world}.txt), downloads a 1600px version, converts it to WebP
// into public/assets/photos/{world}/, and records credits in build/photos/{world}.json.
// Usage: php -d extension=openssl tools/fetch-photos.php {world} [page-slug]   (needs ffmpeg on PATH)
// Re-running skips pages that already have photos unless a slug is given.

const UA = 'FourWorldsCityExplorer/1.0 (educational website; office.a.builders@gmail.com)';
$root = dirname(__DIR__);
$world = $argv[1] ?? exit("Usage: php tools/fetch-photos.php {world} [page-slug]
");
$out = "$root/public/assets/photos/$world";
$creditsFile = "$root/build/photos/$world.json";
$tmp = sys_get_temp_dir() . '/fw-photos';
@mkdir($out, 0777, true);
@mkdir($tmp, 0777, true);
@mkdir(dirname($creditsFile), 0777, true);
$credits = file_exists($creditsFile) ? json_decode(file_get_contents($creditsFile), true) : [];
$only = $argv[2] ?? null;

function http_get($url) {
  $ctx = stream_context_create(['http' => ['user_agent' => UA, 'timeout' => 60]]);
  return @file_get_contents($url, false, $ctx);
}

function api($params) {
  $url = 'https://commons.wikimedia.org/w/api.php?' . http_build_query($params + ['format' => 'json']);
  return json_decode((string)http_get($url), true) ?: [];
}

function ok_license($lic) {
  if (preg_match('/\b(NC|ND)\b|non-?commercial|no.?deriv/i', $lic)) return false;
  return (bool)preg_match('/^(CC0|Public domain|PD|CC BY(-SA)? \d)/i', $lic);
}

function search($q, $quality) {
  $s = $q . ' filetype:bitmap' . ($quality ? ' incategory:Quality_images' : '');
  $d = api(['action' => 'query', 'generator' => 'search', 'gsrnamespace' => 6, 'gsrlimit' => 12, 'gsrsearch' => $s,
    'prop' => 'imageinfo', 'iiprop' => 'url|size|extmetadata', 'iiurlwidth' => 1600,
    'iiextmetadatafilter' => 'LicenseShortName|LicenseUrl|Artist|ImageDescription|ObjectName']);
  $pages = $d['query']['pages'] ?? [];
  usort($pages, fn($a, $b) => ($a['index'] ?? 0) <=> ($b['index'] ?? 0));
  return $pages;
}

// Photos checked by eye and rejected (wrong subject or unsuitable) are never picked again.
$reject = array_flip(array_filter(array_map('trim', file("$root/tools/photo-reject.txt"))));

foreach (file("$root/tools/photo-queries/$world.txt") as $line) {
  $line = trim($line);
  if ($line === '' || $line[0] === '#') continue;
  [$slug, $qs] = explode('|', $line, 2);
  if ($only && $slug !== $only) continue;
  if (!$only && !empty($credits[$slug])) continue;
  foreach ($credits[$slug] ?? [] as $old) foreach (glob("$out/{$old['img']}-*.webp") as $f) unlink($f);
  $credits[$slug] = [];
  $used = $reject;
  foreach ($credits as $list) foreach ($list as $c) $used[$c['file']] = true;
  $n = 0;
  foreach (explode(';', $qs) as $q) {
    $pick = null;
    foreach ([true, false] as $quality) {
      foreach (search($q, $quality) as $p) {
        $i = $p['imageinfo'][0] ?? null;
        if (!$i || isset($used[$p['title']])) continue;
        $m = $i['extmetadata'] ?? [];
        $lic = $m['LicenseShortName']['value'] ?? '';
        $artist = trim(preg_replace('/\s+/', ' ', strip_tags($m['Artist']['value'] ?? '')));
        if (!ok_license($lic) || strlen($artist) > 90 || $i['width'] < 1000) continue;
        if (!preg_match('/\.(jpe?g|png|tiff?)$/i', $p['title'])) continue;
        $pick = [$p, $i, $lic, $artist ?: 'Unknown author', $m['LicenseUrl']['value'] ?? ''];
        break 2;
      }
    }
    if (!$pick) { echo "  no photo for '$q'\n"; continue; }
    [$p, $i, $lic, $artist, $licUrl] = $pick;
    $n++;
    $name = "$slug-$n";
    $src = "$tmp/$name.img";
    file_put_contents($src, http_get($i['thumburl']));
    foreach ([1600, 800] as $w) {
      shell_exec('ffmpeg -nostdin -loglevel error -y -i ' . escapeshellarg($src) . " -vf \"scale='min($w,iw)':-2:flags=lanczos\" -c:v libwebp -quality 80 " . escapeshellarg("$out/$name-$w.webp"));
    }
    $desc = trim(preg_replace('/\s+/', ' ', strip_tags($m['ImageDescription']['value'] ?? '')));
    $credits[$slug][] = [
      'img' => $name, 'file' => $p['title'], 'search' => $q,
      'author' => $artist, 'license' => $lic, 'licenseUrl' => $licUrl,
      'page' => $i['descriptionurl'], 'desc' => substr($desc, 0, 300),
    ];
    $used[$p['title']] = true;
    echo "ok $name  {$p['title']}  [$lic]\n";
  }
  file_put_contents($creditsFile, json_encode($credits, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}
