#!/usr/bin/env bash
# Makes the Life RPG pictures of three phones with the game on them and two of its heroes (tools/lrpg-phones.html):
# phones.webp, see-through, for the top of its page; phones-card.webp, on a dark background, for its shop card; and
# its sharing picture, public/assets/og/life-rpg.jpg.
# Uses the screenshots in public/assets/life-rpg/ (made by the game's dev/shots.sh) and tools/copy-heroes.sh's heroes.
# Needs Chrome and ffmpeg with libwebp.
set -euo pipefail
cd "$(dirname "$0")/.."
CHROME="/c/Program Files/Google/Chrome/Application/chrome.exe"
TMP="$(mktemp -d)"
page="file:///$(cygpath -m "$PWD/tools/lrpg-phones.html")"
shot() {   # window size, file name, query
  "$CHROME" --headless=new --disable-gpu --hide-scrollbars --allow-file-access-from-files --default-background-color=00000000 \
    --window-size="$1" --force-device-scale-factor=1 --virtual-time-budget=3000 --screenshot="$(cygpath -w "$TMP/$2.png")" "$page$3" >/dev/null 2>&1
}
shot 1400,880 phones ''
shot 1600,900 card '?card=1'
shot 1200,630 og '?og=1'
ffmpeg -nostdin -loglevel error -y -i "$TMP/phones.png" -vf "scale=1050:-1:flags=lanczos" -c:v libwebp -quality 85 public/assets/life-rpg/phones.webp
ffmpeg -nostdin -loglevel error -y -i "$TMP/card.png" -vf "scale=960:-1:flags=lanczos" -c:v libwebp -quality 82 public/assets/life-rpg/phones-card.webp
ffmpeg -nostdin -loglevel error -y -i "$TMP/og.png" -q:v 3 public/assets/og/life-rpg.jpg
rm -rf "$TMP"
ls -la public/assets/life-rpg/phones*.webp
