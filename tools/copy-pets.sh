#!/usr/bin/env bash
# Copies the Life RPG game's pets: six kinds at three ages (pet_{kind}_{baby|young|grown}, 1024 x 1024, see-through).
# Source folders are only read, never changed. Each picture is cut to the animal (w:h:x:y below, measured where the
# picture is clearly not see-through, plus a small margin).
#   -> public/assets/pets/{kind}-{age}-{256,512}.webp   (256 and 512 px wide)
# Used by the passport pet (/play/passport/) and the Life RPG page.
# Usage: bash tools/copy-pets.sh   (needs ffmpeg with libwebp; skips files that already exist)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LRPG="${LRPG_ART:-/c/Users/ax707/OneDrive/Desktop/Stuff/Life Game/life-rpg/art}"
P="$LRPG/inbox/done/pets"
OUT="$ROOT/public/assets/pets"
webp() { # in, out, filter, quality
  [ -f "$2" ] && return
  ffmpeg -nostdin -loglevel error -y -i "$1" -vf "$3" -c:v libwebp -quality "$4" -compression_level 6 "$2"; echo "ok ${2#$ROOT/}"; }
mkdir -p "$OUT"
declare -A FIG=(
  [dog_baby]=722:728:142:121 [dog_young]=758:920:108:42 [dog_grown]=794:944:97:41
  [cat_baby]=706:732:162:111 [cat_young]=738:806:162:89 [cat_grown]=760:898:132:16
  [lamb_baby]=744:806:148:72 [lamb_young]=788:878:120:49 [lamb_grown]=796:902:113:52
  [horse_baby]=654:918:140:40 [horse_young]=628:826:176:98 [horse_grown]=690:932:126:45
  [robodog_baby]=700:760:166:139 [robodog_young]=818:832:93:79 [robodog_grown]=808:822:98:99
  [fox_baby]=772:810:102:66 [fox_young]=774:814:106:66 [fox_grown]=820:896:79:47
)
for pet in "${!FIG[@]}"; do
  kind="${pet%_*}"; age="${pet#*_}"
  fig="crop=${FIG[$pet]},format=rgba"
  webp "$P/pet_$pet.png" "$OUT/$kind-$age-256.webp" "$fig,scale=256:-2:flags=lanczos" 82
  webp "$P/pet_$pet.png" "$OUT/$kind-$age-512.webp" "$fig,scale=512:-2:flags=lanczos" 85
done
