#!/usr/bin/env bash
# The Green World's buildings redrawn on 2026-11-07 without crystals or a magic look (34 pictures in the Life RPG
# game's art/inbox/done/elven/, the ones changed since that day; 1024 x 1024, see-through; the game names the Green World "elven"). Writes over the old
# pictures made from them:
#   public/assets/worlds/green/{slug}-{480,960}.webp   building pages (names from tools/assets.txt)
#   public/assets/artwork/green/{name}{,-thumb}.webp   the Artwork page
# then removes the thumbnails and sharing pictures made from the old ones, so tools/make-thumbs.sh and
# tools/make-og-places.php green make them again. Source files are only read, never changed.
# Usage: bash tools/copy-green-redraw.sh && bash tools/make-thumbs.sh && php tools/make-og-places.php green
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LRPG="${LRPG_ART:-/c/Users/ax707/Projects/life-game/life-rpg/art}"
IN="$LRPG/inbox/done/elven"
W="$ROOT/public/assets/worlds/green"; A="$ROOT/public/assets/artwork/green"
webp() { ffmpeg -nostdin -loglevel error -y -i "$1" -vf "$3" -c:v libwebp -quality "$4" -compression_level 4 "$2"; }
find "$IN" -maxdepth 1 -name "*.png" -newermt 2026-11-07 | sort | while read -r f; do
  stem=$(basename "$f" .png)
  # the Artwork page keeps every picture under its source name
  webp "$f" "$A/${stem//_/-}.webp" "format=rgba" 88
  webp "$f" "$A/${stem//_/-}-thumb.webp" "format=rgba,scale=480:-2:flags=lanczos" 80
  # the building page that uses it, if any
  slug=$(grep "^green|art|$stem.png|" "$ROOT/tools/assets.txt" | cut -d'|' -f4 || true)
  if [ -n "$slug" ]; then
    webp "$f" "$W/$slug-480.webp" "format=rgba,scale=480:-1:flags=lanczos" 82
    webp "$f" "$W/$slug-960.webp" "format=rgba,scale=960:-1:flags=lanczos" 82
    rm -f "$ROOT/public/assets/thumbs/green/$slug.webp" "$ROOT/public/assets/og/green/$slug.jpg"
    echo "ok $stem -> $slug"
  else
    echo "ok $stem (Artwork page only)"
  fi
done
