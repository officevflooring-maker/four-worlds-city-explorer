#!/usr/bin/env bash
# Copies the Life RPG game's picture-book story panels (63 pictures, 1536 x 1152) into
# public/assets/stories/{world}/{chapter}-{panel}-{1200|600}.webp for the Stories pages (build/stories.php),
# and makes a share picture for each story: public/assets/og/stories/{world}.jpg (1200 x 630).
# The game names the Green World "elven". The originals are only read, never changed.
# Usage: bash tools/copy-story-art.sh   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
declare -A SRC=([egypt]=egypt [roman]=roman [medieval]=medieval [modern]=modern [green]=elven [future]=future [heaven]=heaven)
mkdir -p "$ROOT/public/assets/og/stories"
for world in "${!SRC[@]}"; do
  out="$ROOT/public/assets/stories/$world"
  mkdir -p "$out"
  for c in 1 2 3; do for p in 1 2 3; do
    name="${SRC[$world]}_${c}_${p}.png"
    f="$LRPG/inbox/story/$name"; [ -f "$f" ] || f="$LRPG/inbox/done/story/$name"
    [ -f "$f" ] || { echo "missing $name" >&2; continue; }
    for w in 1200 600; do
      t="$out/$c-$p-$w.webp"
      [ -f "$t" ] && continue
      ffmpeg -nostdin -loglevel error -y -i "$f" -vf "scale=$w:-2:flags=lanczos" -c:v libwebp -quality 80 -compression_level 5 "$t"
    done
  done; done
  # share picture: the end of chapter 1, cut to 1200 x 630 around the middle
  og="$ROOT/public/assets/og/stories/$world.jpg"
  if [ ! -f "$og" ]; then
    f="$LRPG/inbox/story/${SRC[$world]}_1_3.png"; [ -f "$f" ] || f="$LRPG/inbox/done/story/${SRC[$world]}_1_3.png"
    ffmpeg -nostdin -loglevel error -y -i "$f" -vf "scale=1200:-2:flags=lanczos,crop=1200:630:0:(ih-630)/2" -q:v 6 "$og"
  fi
  echo "ok $world"
done
