#!/usr/bin/env bash
# Copies the Life RPG heroes for its page (public/assets/life-rpg/heroes/): all twelve in everyday clothes, and
# hero 4 in the outfits of four more worlds. They were painted in ChatGPT and cut out by the game's art/tools/heroes.php.
# The Green World outfit is left out: it has elf ears. Reads the game's art folder and never changes it; bits left
# over from the sheets are cleared by tools/keep-figure.php. Needs ffmpeg with libwebp, and PHP's gd extension.
set -euo pipefail
cd "$(dirname "$0")/.."
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
OUT=public/assets/life-rpg/heroes
TMP="$(mktemp -d)"
mkdir -p "$OUT"
pic() {
  ffmpeg -nostdin -loglevel error -y -i "$LRPG/heroes/$1.webp" -vf "scale=-1:400:flags=lanczos" "$TMP/$1.png"
  php -d extension_dir="$(dirname "$(command -v php)")/ext" -d extension=gd tools/keep-figure.php "$TMP/$1.png" "$TMP/$1-kept.png"
  ffmpeg -nostdin -loglevel error -y -i "$TMP/$1-kept.png" -c:v libwebp -quality 85 "$OUT/$1.webp"
}
for n in 01 02 03 04 05 06 07 08 09 10 11 12; do pic "h${n}_casual"; done
for o in toga egypt space heaven; do pic "h04_$o"; done
rm -rf "$TMP"
ls "$OUT" | wc -l
