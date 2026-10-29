#!/usr/bin/env bash
# Makes the social sharing images (public/assets/og/*.jpg, 1200 x 630) from the supplied artwork,
# with the site name drawn in; the home page's uses the logo (brand/, see tools/make-logo.sh). Re-run after renaming
# the site. Needs ffmpeg and Georgia Bold (Windows).
set -euo pipefail
cd "$(dirname "$0")/../public"
NAME='The Atlas of Cities'
mkdir -p assets/og; A=assets/worlds; F="fontfile='C\:/Windows/Fonts/georgiab.ttf'"
og(){ # world bg building title
 ffmpeg -nostdin -loglevel error -y -f lavfi -i "color=c=$2:s=1200x630" -i $A/$1/horizon-1600.webp -i $A/$1/$3-960.webp -filter_complex "[1]scale=1200:-1[h];[2]scale=470:470[b];[0][h]overlay=0:H-h+10[t];[t][b]overlay=W-w-50:H-h-40,drawtext=$F:text='$4':fontsize=60:fontcolor=0x17202b:x=60:y=200,drawtext=$F:text='$NAME':fontsize=34:fontcolor=0x23396b:x=62:y=140" -frames:v 1 -q:v 3 assets/og/$1.jpg; }
og roman 0xf3e2d6 amphitheater "Ancient Rome"
og modern 0xdde6f3 mixed-use-building "Modern Town"
og green 0xdfecd9 treetop-village "Green World"
og future 0xd7e9ec greenhouse-dome "Robotic Future"
og egypt 0xf1e3c8 pharaohs-palace "Ancient Egypt"
og heaven 0xe9e5f5 palace-of-light "Heavenly City"
# the home page (and every page without its own picture): the logo, and the question the site asks
ffmpeg -nostdin -loglevel error -y -f lavfi -i "color=c=0xfbf5e8:s=1200x630" -i ../brand/atlas-wordmark-cutout.png -filter_complex "[1]scale=-1:580:flags=lanczos[l];[0][l]overlay=40:(H-h)/2,drawtext=$F:text='How does a':fontsize=74:fontcolor=0x17202b:x=640:y=150,drawtext=$F:text='city work?':fontsize=74:fontcolor=0x17202b:x=640:y=240,drawtext=$F:text='Six illustrated cities,':fontsize=34:fontcolor=0x3d4757:x=642:y=362,drawtext=$F:text='past, present and imagined.':fontsize=34:fontcolor=0x3d4757:x=642:y=410,drawtext=$F:text='Free · No ads · No sign-up':fontsize=27:fontcolor=0x23396b:x=642:y=492" -frames:v 1 -q:v 3 assets/og/home.jpg
ls -la assets/og
