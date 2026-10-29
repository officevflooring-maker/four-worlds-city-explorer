#!/usr/bin/env bash
# Checks every generated page in public/: internal links and images resolve to real files,
# images have alt text, each page has one h1, a title and a description, and no page except
# /credits/ and /support/ links to other websites. The checks live in check-site.php, which runs
# them in one PHP process (seconds instead of minutes). Usage: bash tools/check-site.sh
exec php "$(dirname "$0")/check-site.php"
