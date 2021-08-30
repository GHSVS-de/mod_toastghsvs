# mod_toastghsvs for Joomla 3/Joomla 4

## DE
- Mehr für mich und meine Projekte als für irgendjemand anderen. Der einfachste Weg, es out-of-the-box zu benutzen, ist, es nicht zu benutzen ;-)
- Bisher nur in deutscher Sprache, vielleicht für immer.
- Kein Luxus.
- Rudimentärer Code. Ich würde sagen, man braucht ein eigenes Template-Override.
- - Hilfreich?: https://getbootstrap.com/docs/5.0/components/toasts/
- Zeigt einen Bootstrap 5 Toast in Modulposition an.
- Lädt aber nicht BS 5 CSS/JS. Feuert einfach das Toast-Init-Skript im Layout `default.php`.
- Man kann ein Zeitintervall festlegen (Cookie und Session-basiert), wann das Toast wieder angezeigt werden soll.
- Man kann das Toast für Bots, Suchmaschinen usw. ausblenden. Verwendet aber nur eine einfache Prüfung wie hier beschrieben: https://ghsvs.de/programmierer-schnipsel/joomla/134-ist-der-gast-ein-robot

## EN
- More for me and my projects than for anybody else. The easiest way to use it out-of-the-box is not to use it ;-)
- Only german language yet, maybe forever.
- No luxury.
- Rudimentary code. I would say you need a custom template override.
- - Helpful?: https://getbootstrap.com/docs/5.0/components/toasts/
- Displays a Bootstrap 5 toast in module position.
- but doesn't load BS 5 CSS/JS for you. Just fires the toast init script in layout `default.php`.
- You can set a time intervall (Cookie and Session based) when to display the toast again.
- You can hide the toast for bots, search engines etc. but uses just a simple check like described here: https://ghsvs.de/programmierer-schnipsel/joomla/134-ist-der-gast-ein-robot

## Questions/Fragen (DE and/und EN)
- https://github.com/GHSVS-de/mod_toastghsvs/issues
- https://ghsvs.de/kontakt

-----------------------------------------------------

# My personal build procedure (WSL 1, Debian, Win 10)
- Prepare/adapt `./package.json`.
- `cd /mnt/z/git-kram/mod_toastghsvs`

## node/npm updates/installation
- `npm run g-npm-update-check` or (faster) `ncu`
- `npm run g-ncu-override-json` (if needed) or (faster) `ncu -u`
- `npm install` (if needed)

## Build installable ZIP package
- `node build.js`
- New, installable ZIP is in `./dist` afterwards.
- All packed files for this ZIP can be seen in `./package`. **But only if you disable deletion of this folder at the end of `build.js`**.s

### For Joomla update and changelog server
- Create new release with new tag.
- - See release description in `dist/release.txt`.
- Extracts(!) of the update and changelog XML for update and changelog servers are in `./dist` as well. Copy/paste and necessary additions.
