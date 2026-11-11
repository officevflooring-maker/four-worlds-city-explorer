#!/usr/bin/env bash
# A small size of every building, vehicle and tree picture, for places that show them small (the home page's city,
# the world maps on phones): {name}-240.webp, half as wide as {name}-480.webp. build.php's img() offers it to
# browsers next to the larger sizes, and they pick the smallest one that is sharp enough.
# Usage: bash tools/make-small.sh   (needs ffmpeg with libwebp; skips pictures that already have their small size)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
n=0
for big in "$ROOT"/public/assets/worlds/*/*-480.webp; do
  small="${big%-480.webp}-240.webp"
  # a retaken picture gets a new small size too
  [ -f "$small" ] && [ "$small" -nt "$big" ] && continue
  ffmpeg -nostdin -loglevel error -y -i "$big" -vf "format=rgba,scale=iw/2:-1:flags=lanczos" -c:v libwebp -quality 80 -compression_level 4 "$small"
  n=$((n + 1))
done
echo "made $n small pictures"
