#!/usr/bin/env bash
# Makes the social sharing images (public/assets/og/*.jpg, 1200 x 630) from the supplied artwork,
# with the site name drawn in. Re-run after renaming the site. Needs ffmpeg and Georgia Bold (Windows).
set -euo pipefail
cd "$(dirname "$0")/../public"
NAME='The Atlas of Cities'
mkdir -p assets/og; A=assets/worlds; F="fontfile='C\:/Windows/Fonts/georgiab.ttf'"
og(){ # world bg building title
 ffmpeg -nostdin -loglevel error -y -f lavfi -i "color=c=$2:s=1200x630" -i $A/$1/horizon-1600.webp -i $A/$1/$3-960.webp -filter_complex "[1]scale=1200:-1[h];[2]scale=470:470[b];[0][h]overlay=0:H-h+10[t];[t][b]overlay=W-w-50:H-h-40,drawtext=$F:text='$4':fontsize=60:fontcolor=0x17202b:x=60:y=200,drawtext=$F:text='$NAME':fontsize=34:fontcolor=0x23396b:x=62:y=140" -frames:v 1 -q:v 3 assets/og/$1.jpg; }
og roman 0xf3e2d6 amphitheater "Ancient Rome"
og modern 0xdde6f3 mixed-use-building "Modern Town"
og elven 0xdfecd9 treetop-village "Elven Green World"
og future 0xd7e9ec greenhouse-dome "Robotic Future"
ffmpeg -nostdin -loglevel error -y -f lavfi -i "color=c=0xf7f5f0:s=1200x630" -i $A/roman/amphitheater-480.webp -i $A/modern/public-library-480.webp -i $A/elven/treetop-village-480.webp -i $A/future/greenhouse-dome-480.webp -filter_complex "[1]scale=300:300[a];[2]scale=300:300[b];[3]scale=300:300[c];[4]scale=300:300[d];[0][a]overlay=0:300[t1];[t1][b]overlay=300:300[t2];[t2][c]overlay=600:300[t3];[t3][d]overlay=900:300,drawtext=$F:text='$NAME':fontsize=40:fontcolor=0x23396b:x=(w-tw)/2:y=70,drawtext=$F:text='Past, Present and Imagined':fontsize=28:fontcolor=0x536072:x=(w-tw)/2:y=122,drawtext=$F:text='How does a city work?':fontsize=64:fontcolor=0x17202b:x=(w-tw)/2:y=175" -frames:v 1 -q:v 3 assets/og/home.jpg
ls -la assets/og
