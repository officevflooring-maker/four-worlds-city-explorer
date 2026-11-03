#!/usr/bin/env bash
# Copies the Life RPG game's "bonus" art used on the site. Source folders are only read, never changed.
#   guide_elven: the Green World's gardener, who guides its tour (cut to the figure)
#     -> public/assets/worlds/green/gardener-{256,512}.webp
#   cert_{world}: the certificate frames, and seal: the gold seal, for the tour certificates
#     -> public/assets/certificates/{world}-{768,1536}.webp and seal-{160,320}.webp
# Usage: bash tools/copy-bonus-art.sh   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
B="$LRPG/inbox/done/bonus"
webp() { # in, out, filter, quality
  [ -f "$2" ] && return
  ffmpeg -nostdin -loglevel error -y -i "$1" -vf "$3" -c:v libwebp -quality "$4" -compression_level 4 "$2"; echo "ok ${2#$ROOT/}"; }
W="$ROOT/public/assets/worlds/green"; C="$ROOT/public/assets/certificates"
mkdir -p "$W" "$C"
# The figure fills x 93-966, y 31-1013 of the 1024 x 1024 picture.
fig="crop=874:983:93:31,format=rgba"
webp "$B/guide_elven.png" "$W/gardener-256.webp" "$fig,scale=256:-2:flags=lanczos" 82
webp "$B/guide_elven.png" "$W/gardener-512.webp" "$fig,scale=512:-2:flags=lanczos" 85
# The Green World's source files are named "elven".
for world in roman modern green future egypt heaven; do
  src="$world"; [ "$world" = green ] && src=elven
  webp "$B/cert_$src.png" "$C/$world-768.webp" "format=rgba,scale=768:-2:flags=lanczos" 85
  webp "$B/cert_$src.png" "$C/$world-1536.webp" "format=rgba" 88
done
seal="crop=712:986:149:16,format=rgba"
webp "$B/seal.png" "$C/seal-160.webp" "$seal,scale=160:-2:flags=lanczos" 85
webp "$B/seal.png" "$C/seal-320.webp" "$seal,scale=320:-2:flags=lanczos" 88
