#!/usr/bin/env bash
# Copies the supplied people and vehicle art. Source folders are only read, never changed.
#   People: the first pose (left 512 x 512 frame) of each walk strip in people-batch-03
#     -> public/assets/worlds/{world}/{people-1..6,worker-1..2}-{256,512}.webp   (site use)
#     -> public/assets/artwork/{world}/{name}.webp and {name}-thumb.webp      (Artwork page)
#   Vehicles: vehicle-batch-01 car_N (front view) and car_N_back (back view)
#     -> public/assets/worlds/{world}/{slug}-{480,960}.webp and rear-{slug}-{480,960}.webp
#     -> public/assets/artwork/{world}/vehicle-car-N[-back].webp and -thumb.webp
# Usage: bash tools/copy-people-vehicles.sh   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
SRC="${ART_SOURCE:-/c/Users/ax707/Documents/Codex/2026-10-25/referenced-chatgpt-conversation-this-is-an/outputs}"
webp() { # in, out, filter, quality
  [ -f "$2" ] && return
  ffmpeg -nostdin -loglevel error -y -i "$1" -vf "$3" -c:v libwebp -quality "$4" -compression_level 4 "$2"; }
# Vehicle page slugs, in source order car_1..car_4.
declare -A CARS=(
  [roman]="ox-cart chariot donkey-cart litter"
  [modern]="family-car taxi pickup-truck delivery-van"
  [elven]="deer-sleigh flower-cart mushroom-carriage beetle-rider"
  [future]="hover-car pressurized-rover cargo-pod drone-taxi"
)
for world in roman modern elven future; do
  W="$ROOT/public/assets/worlds/$world"; A="$ROOT/public/assets/artwork/$world"
  mkdir -p "$W" "$A"
  for f in "$SRC/people-batch-03/art/inbox/$world/"*.png; do
    name=$(basename "$f" .png); name="${name//_/-}"
    pose="crop=512:512:0:0,format=rgba"
    webp "$f" "$W/$name-256.webp" "$pose,scale=256:-1:flags=lanczos" 82
    webp "$f" "$W/$name-512.webp" "$pose" 85
    webp "$f" "$A/$name.webp" "$pose" 90
    webp "$f" "$A/$name-thumb.webp" "$pose,scale=480:-1:flags=lanczos" 80
  done
  n=1
  for slug in ${CARS[$world]}; do
    for side in "" "_back"; do
      in="$SRC/vehicle-batch-01/art/inbox/$world/car_$n$side.png"
      out="$W/$slug"; [ -n "$side" ] && out="$W/rear-$slug"
      webp "$in" "$out-480.webp" "format=rgba,scale=480:-1:flags=lanczos" 82
      webp "$in" "$out-960.webp" "format=rgba,scale=960:-1:flags=lanczos" 82
      art="$A/vehicle-car-$n${side//_/-}"
      webp "$in" "$art.webp" "format=rgba" 88
      webp "$in" "$art-thumb.webp" "format=rgba,scale=480:-1:flags=lanczos" 80
    done
    n=$((n + 1))
  done
  echo "ok $world"
done
