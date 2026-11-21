# Pinterest pins

309 tall pins (1000 x 1500): every lesson guide, the seven worlds, the guided tours and every building page.
Pictures: `public/assets/pins/` (served at atlasofcities.org/assets/pins/, so Pinterest can fetch them).
Upload files: `week-01.csv` ... `week-09.csv`, 35 pins each (about 5 a day). Lessons, worlds and tours come first,
then the buildings, taking turns between the worlds.

## The boards (all made, Nov 20, 2026)

The upload puts each pin on a board by name (PIN_BOARDS in build/build.php), spelled exactly as on the account:

- Free Lessons for Teachers and Homeschool (lessons)
- Ancient Egypt for Kids, Ancient Rome for Kids, Medieval Kingdom for Kids, Heavenly City for Kids
- How a Town Works (Modern Town), Imagined Cities: Nature and Hope (Green World),
  Space for Kids: Moon and Mars (Robotic Future): older boards, kept rather than doubled

## Each week

Pinterest (business account) > Create > Create Pins in bulk > upload the next `week-NN.csv`. The "Publish date"
column is empty, so the pins go out as soon as they are uploaded. To spread a week over 5 days, fill that column
with dates (`2026-11-24T09:00:00`) before uploading.

## Remaking

The pin words come from the site's own data: `php build/build.php` writes `pins.json`, then
`php tools/make-pins.php` draws the missing pictures and rewrites the weekly files (`--redo` redraws them all).
Don't upload a week twice.

## Uploaded

- week-01: Nov 20, 2026 (Settings > Bulk create Pins, "Upload .csv file"; Pinterest says pins appear within about 2 hours)
