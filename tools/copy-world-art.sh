#!/usr/bin/env bash
# Copies the Life RPG game's art for Card memory (/play/card-memory/). Source folders are only read, never changed.
#   inbox/bonus/world_{world}: the six painted world scenes (1536 x 1024), cut to the shape of a card's window
#     -> public/assets/card-memory/{world}.webp (480 x 564)
#   cards/frame_common_{world}, frame_gold: the game's painted card frames, with their windows already see-through
#     -> public/assets/card-memory/frame-{world|gold}.webp (480 wide), and frames.json (each frame's window, in %)
# The game's Hero Cards (tools/copy-card-art.sh) keep their own copies of the frames, so each game can change alone.
# The Green World's source files are named "elven".
# Usage: bash tools/copy-world-art.sh   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
OUT="$ROOT/public/assets/card-memory"
webp() { # in, out, filter, quality
  [ -f "$2" ] && return
  ffmpeg -nostdin -loglevel error -y -i "$1" -vf "$3" -c:v libwebp -quality "$4" -compression_level 6 "$2"; echo "ok ${2#$ROOT/}"; }
site() { [ "$1" = elven ] && echo green || echo "$1"; }
mkdir -p "$OUT"
# Where each scene's middle is, across its width: the temple, the town halls, the bridge, the dome, the gate.
declare -A MID=([egypt]=0.56 [roman]=0.56 [modern]=0.57 [elven]=0.5 [future]=0.46 [heaven]=0.47)
for world in egypt roman modern elven future heaven; do
  x=$(awk -v m="${MID[$world]}" 'BEGIN { x = int(1536 * m - 436); if (x < 0) x = 0; if (x > 1536 - 872) x = 1536 - 872; print x }')
  webp "$LRPG/inbox/bonus/world_$world.png" "$OUT/$(site "$world").webp" "crop=872:1024:$x:0,scale=480:564:flags=lanczos" 84
  webp "$LRPG/cards/frame_common_$world.webp" "$OUT/frame-$(site "$world").webp" "format=rgba,scale=480:-2:flags=lanczos" 86
done
webp "$LRPG/cards/frame_gold.webp" "$OUT/frame-gold.webp" "format=rgba,scale=480:-2:flags=lanczos" 86
# The windows are in % of each frame, so they hold at any size. Renamed to the site's frame names.
if [ ! -f "$OUT/frames.json" ]; then
  sed -e 's/frame_common_elven/frame-green/; s/frame_common_/frame-/; s/frame_gold/frame-gold/' "$LRPG/cards/frames.json" | grep -v '^$' > "$OUT/frames.json"
  echo "ok public/assets/card-memory/frames.json"
fi
