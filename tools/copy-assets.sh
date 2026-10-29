#!/usr/bin/env bash
# Copies selected artwork from the read-only source folders into public/assets/worlds/{world}/
# and writes web-sized WebP files (transparency kept). Source files are only read, never changed.
# Usage: bash tools/copy-assets.sh [world]   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
SRC="${ART_SOURCE:-/c/Users/ax707/Documents/Codex/2026-10-25/referenced-chatgpt-conversation-this-is-an/outputs}"
declare -A BATCH=([art]="life-rpg-art-batch-01/art/inbox" [ground]="life-rpg-ground-batch-01/raw/art/inbox" [build]="life-rpg-construction-batch-01/art/inbox")
# Ancient Egypt and the Heavenly City come from the Life RPG game's art folder: the full-size originals the game keeps
# in art/inbox/done/{world}/ (lrpg), and for the horizons the game's own cut-outs in art/{world}/ (lrpgweb), since the
# originals still have their flat magenta sky.
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
webp() { # in, out, filter
  ffmpeg -nostdin -loglevel error -y -i "$1" -vf "$3" -c:v libwebp -quality 82 -compression_level 4 "$2"; }
grep -v '^#' "$ROOT/tools/assets.txt" | while IFS='|' read -r world batch file name kind; do
  [ -z "$world" ] && continue
  [ -n "${1:-}" ] && [ "$world" != "$1" ] && continue
  ls "$ROOT/public/assets/worlds/$world/$name"*.webp >/dev/null 2>&1 && continue
  case "$batch" in
    lrpg)    in="$LRPG/inbox/done/$world/$file" ;;
    lrpgweb) in="$LRPG/$world/$file" ;;
    *)       in="$SRC/${BATCH[$batch]}/$world/$file" ;;
  esac
  out="$ROOT/public/assets/worlds/$world/$name"
  case "$kind" in
    tile|tree) webp "$in" "$out-480.webp" "format=rgba,scale=480:-1:flags=lanczos"
               webp "$in" "$out-960.webp" "format=rgba,scale=960:-1:flags=lanczos" ;;
    tall)      webp "$in" "$out-480.webp" "format=rgba,scale=320:-1:flags=lanczos"
               webp "$in" "$out-960.webp" "format=rgba,scale=640:-1:flags=lanczos" ;;
    wide)      webp "$in" "$out-960.webp" "format=rgba,scale=960:-1:flags=lanczos"
               webp "$in" "$out-1600.webp" "format=rgba,scale='min(1600,iw)':-1:flags=lanczos" ;;
    tex)       webp "$in" "$out.webp" "scale=512:-1:flags=lanczos" ;;
  esac
  echo "ok $world/$name ($file)"
done
