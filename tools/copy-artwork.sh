#!/usr/bin/env bash
# Copies EVERY supplied artwork into public/assets/artwork/{world}/ for the Artwork page:
#   {name}.webp       full size (as large as the original) for viewing, saving and printing
#   {name}-thumb.webp 480px wide for the gallery grid
# Names: buildings keep their source name (business_1 -> business-1), ground art gets "ground-",
# construction art gets "construction-". Source folders are only read, never changed.
# Usage: bash tools/copy-artwork.sh   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
SRC="${ART_SOURCE:-/c/Users/ax707/Documents/Codex/2026-10-25/referenced-chatgpt-conversation-this-is-an/outputs}"
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
declare -A PREFIX=([life-rpg-art-batch-01/art/inbox]="" [life-rpg-ground-batch-01/raw/art/inbox]="ground-" [life-rpg-construction-batch-01/art/inbox]="construction-")
for world in roman modern elven future; do
  mkdir -p "$ROOT/public/assets/artwork/$world"
  for batch in "${!PREFIX[@]}"; do
    for f in "$SRC/$batch/$world/"*.png; do
      stem=$(basename "$f" .png); name="${PREFIX[$batch]}${stem//_/-}"
      out="$ROOT/public/assets/artwork/$world/$name"
      [ -f "$out.webp" ] && continue
      ffmpeg -nostdin -loglevel error -y -i "$f" -c:v libwebp -quality 88 -compression_level 4 "$out.webp"
      ffmpeg -nostdin -loglevel error -y -i "$f" -vf "scale=480:-2:flags=lanczos" -c:v libwebp -quality 80 -compression_level 4 "$out-thumb.webp"
      echo "ok $world/$name"
    done
  done
done
# Ancient Egypt and the Heavenly City: every picture in one folder of the Life RPG game (its full-size originals),
# named the same way. The horizon comes from the game's own cut-out, since the original still has its magenta sky.
# People and vehicles are copied by tools/copy-people-vehicles.sh.
for world in egypt heaven; do
  mkdir -p "$ROOT/public/assets/artwork/$world"
  for f in "$LRPG/inbox/done/$world/"*.png; do
    stem=$(basename "$f" .png)
    case "$stem" in *.src|people_*|worker_*|car_*|horizon) continue ;; tex_*|tree_*) pre=ground- ;; crane|materials) pre=construction- ;; *) pre= ;; esac
    out="$ROOT/public/assets/artwork/$world/$pre${stem//_/-}"
    [ -f "$out.webp" ] && continue
    ffmpeg -nostdin -loglevel error -y -i "$f" -c:v libwebp -quality 88 -compression_level 4 "$out.webp"
    ffmpeg -nostdin -loglevel error -y -i "$f" -vf "scale=480:-2:flags=lanczos" -c:v libwebp -quality 80 -compression_level 4 "$out-thumb.webp"
    echo "ok $world/$pre${stem//_/-}"
  done
  out="$ROOT/public/assets/artwork/$world/ground-horizon"
  if [ ! -f "$out.webp" ]; then
    ffmpeg -nostdin -loglevel error -y -i "$LRPG/$world/horizon.webp" -c:v libwebp -quality 88 -compression_level 4 "$out.webp"
    ffmpeg -nostdin -loglevel error -y -i "$LRPG/$world/horizon.webp" -vf "scale=480:-2:flags=lanczos" -c:v libwebp -quality 80 -compression_level 4 "$out-thumb.webp"
  fi
done
