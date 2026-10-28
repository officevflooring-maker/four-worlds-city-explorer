#!/usr/bin/env bash
# The site's logo comes in two forms, kept as supplied in brand/: the emblem ("Atlas of Cities" on a ribbon) and the
# wordmark (big "ATLAS" letters). This makes see-through copies for the site in public/assets/brand/, taking out
# their pale background with tools/logo-alpha.html in headless Chrome, plus a square PNG of the emblem for search
# engines (public/assets/brand/atlas-logo-512.png), and full-size see-through copies in brand/*-cutout.png. The
# supplied files in brand/ are never changed.
# Usage: bash tools/make-logo.sh   (needs PHP, Chrome and ffmpeg with libwebp)
set -euo pipefail
cd "$(dirname "$0")/.."
CHROME="/c/Program Files/Google/Chrome/Application/chrome.exe"
TMP="$(mktemp -d)"; trap 'rm -rf "$TMP"' EXIT
OUT=public/assets/brand; mkdir -p "$OUT"

cutout() {   # brand/<name>.webp -> $TMP/<name>.png, see-through and trimmed
  php -r 'file_put_contents($argv[3], str_replace("@IMAGE@", "data:image/webp;base64," . base64_encode(file_get_contents($argv[2])), file_get_contents($argv[1])));' \
    tools/logo-alpha.html "brand/$1.webp" "$TMP/$1.html"
  "$CHROME" --headless=new --disable-gpu --no-first-run --user-data-dir="$(cygpath -w "$TMP/profile")" --virtual-time-budget=60000 \
    --dump-dom "file:///$(cygpath -m "$TMP/$1.html")" 2>/dev/null > "$TMP/$1.dom"
  php -r 'preg_match("~<pre id=\"out\">data:image/png;base64,([A-Za-z0-9+/=]+)</pre>~", file_get_contents($argv[1]), $m) || exit(1); file_put_contents($argv[2], base64_decode($m[1]));' \
    "$TMP/$1.dom" "$TMP/$1.png" || { echo "tools/logo-alpha.html gave no picture for $1" >&2; exit 1; }
}
webp() {   # png, width, out
  ffmpeg -nostdin -loglevel error -y -i "$1" -vf "scale=$2:-2:flags=lanczos,format=yuva420p" -c:v libwebp -quality 86 -compression_level 6 "$3"
  echo "$3 $(ffprobe -v error -show_entries stream=width,height -of csv=p=0:s=x "$3")"
}

cutout atlas-emblem
cutout atlas-wordmark
for w in 200 400 800; do webp "$TMP/atlas-emblem.png" $w "$OUT/atlas-emblem-$w.webp"; done
for w in 360 720; do webp "$TMP/atlas-wordmark.png" $w "$OUT/atlas-wordmark-$w.webp"; done
# for search engines: the emblem on white, square
ffmpeg -nostdin -loglevel error -y -f lavfi -i "color=c=white:s=512x512" -i "$TMP/atlas-emblem.png" \
  -filter_complex "[1]scale=480:480:force_original_aspect_ratio=decrease:flags=lanczos[l];[0][l]overlay=(W-w)/2:(H-h)/2" -frames:v 1 "$OUT/atlas-logo-512.png"
echo "$OUT/atlas-logo-512.png"
# full size, for the sharing pictures (tools/make-og.sh) and the printable products (../atlas-products)
cp "$TMP/atlas-emblem.png" brand/atlas-emblem-cutout.png; cp "$TMP/atlas-wordmark.png" brand/atlas-wordmark-cutout.png; echo brand/atlas-emblem-cutout.png brand/atlas-wordmark-cutout.png
