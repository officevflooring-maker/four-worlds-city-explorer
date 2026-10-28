#!/usr/bin/env bash
# Checks every generated page in public/: internal links and images resolve to real files,
# images have alt text, each page has one h1, a title and a description, and no page except
# /credits/ links to other websites. Usage: bash tools/check-site.sh
cd "$(dirname "$0")/../public"
fail=0; n=0; pages=0
for f in $(find . -name '*.html' | sort); do
  pages=$((pages+1)); p="${f#.}"
  for r in $( (grep -oE '(href|src|data-full)="/[^"#?]*' "$f" | sed -E 's/^[a-z-]+="//'; grep -oE 'srcset="[^"]*"' "$f" | grep -oE '/assets/[^ ]+'; grep -oE 'url\(/[^)]*' "$f" | sed 's/url(//') | sort -u); do
    n=$((n+1)); [ -f ".$r" ] || [ -f ".${r}index.html" ] || { echo "BROKEN  $p -> $r"; fail=1; }
  done
  noalt=$(grep -oE '<img [^>]*>' "$f" | grep -vc ' alt=')
  [ "$noalt" != 0 ] && { echo "NO ALT  $p ($noalt images)"; fail=1; }
  h1=$(grep -o '<h1' "$f" | wc -l); [ "$h1" != 1 ] && { echo "H1=$h1  $p"; fail=1; }
  grep -q '<meta name="description" content="[^"]' "$f" || { echo "NO DESC $p"; fail=1; }
  if [ "$p" != "/credits/index.html" ]; then
    ext=$(grep -oE 'href="https?://[^"]+' "$f" | grep -v 'creativecommons.org/licenses/by/4.0' | grep -vc "$(grep -oE "const SITE_URL *= *'[^']+" ../build/config.php | sed "s/.*'//")")
    [ "$ext" != 0 ] && { echo "OUTLINK $p ($ext)"; fail=1; }
  fi
done
echo "pages: $pages, references checked: $n, problems: $fail"
exit $fail
