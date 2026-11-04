#!/usr/bin/env bash
# Copies the Life RPG game's Hero Cards art used by /play/hero-cards/. Source folders are only read, never changed.
#   card_{world}_{id}: the 48 card pictures (cut-outs, 512 px wide in the game) -> public/assets/cards/{world}-{id}.webp
#   frame_common_{world}, frame_gold, frame_emerald: the painted frames, with their windows already see-through
#     -> public/assets/cards/frame-{world|gold|emerald}.webp, and frames.json (each frame's window, in %)
# The Green World's source files are named "elven". The game's own web pictures in art/cards are used (not
# inbox/done/cards), since their frame windows are already cut out of the magenta.
# Usage: bash tools/copy-card-art.sh   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
C="$LRPG/cards"
OUT="$ROOT/public/assets/cards"
webp() { # in, out, filter, quality
  [ -f "$2" ] && return
  ffmpeg -nostdin -loglevel error -y -i "$1" -vf "$3" -c:v libwebp -quality "$4" -compression_level 6 "$2"; echo "ok ${2#$ROOT/}"; }
site() { [ "$1" = elven ] && echo green || echo "$1"; }
mkdir -p "$OUT"
for f in "$C"/card_*.webp; do
  name="$(basename "$f" .webp)"; rest="${name#card_}"; world="${rest%%_*}"; id="${rest#*_}"
  webp "$f" "$OUT/$(site "$world")-$id.webp" "format=rgba,scale=384:-2:flags=lanczos" 82
done
for world in egypt roman modern elven future heaven; do
  webp "$C/frame_common_$world.webp" "$OUT/frame-$(site "$world").webp" "format=rgba,scale=480:-2:flags=lanczos" 86
done
for r in gold emerald; do webp "$C/frame_$r.webp" "$OUT/frame-$r.webp" "format=rgba,scale=480:-2:flags=lanczos" 86; done
# The windows are measured in % of each frame, so they hold at any size. Renamed to the site's frame names.
sed -e 's/frame_common_elven/frame-green/; s/frame_common_/frame-/; s/frame_\(gold\|emerald\)/frame-\1/' "$C/frames.json" > "$OUT/frames.json"
echo "ok public/assets/cards/frames.json"
