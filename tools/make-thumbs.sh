#!/usr/bin/env bash
# Makes small preview images for search results, the city builder palette, the quiz and the passport:
#   public/assets/worlds/{world}/{name}-960.webp (or -512 for people) -> public/assets/thumbs/{world}/{name}.webp
# Each fits inside 200 x 200 pixels, with transparency kept. Only public/ files are read; the source art
# folders are not touched. Usage: bash tools/make-thumbs.sh   (needs ffmpeg with libwebp; skips existing files)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
for world in roman modern green future egypt heaven; do
  IN="$ROOT/public/assets/worlds/$world"; OUT="$ROOT/public/assets/thumbs/$world"
  mkdir -p "$OUT"
  for f in "$IN"/*-960.webp "$IN"/*-512.webp; do
    name=$(basename "$f" .webp); name="${name%-960}"; name="${name%-512}"
    case "$name" in horizon|rear-*) continue ;; esac
    [ -f "$OUT/$name.webp" ] && continue
    ffmpeg -nostdin -loglevel error -y -i "$f" -vf "format=rgba,scale=w=200:h=200:force_original_aspect_ratio=decrease:flags=lanczos" \
      -c:v libwebp -quality 78 -compression_level 6 "$OUT/$name.webp"
  done
  echo "$world: $(ls "$OUT" | wc -l) thumbs"
done
