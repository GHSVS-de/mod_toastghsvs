# mod_toastghsvs for Joomla 3/Joomla 4

Joomla site module. Bootstrap 5 toast in module position. Hour intervall setting when to display again.

## Be aware for versions lower than 2023.10.22
- Doesn't use Web Asset Manager to load the necessary BS5-Javascript ([Toast Component](https://getbootstrap.com/docs/5.1/components/toasts/))
- Toast CSS and Toast JS must be loaded already otherwise. Again: Bootstrap 5!
  - Since version 2023.10.22: Loads Toast JS with WAM.
- Maybe that will be changed if Joomla 3 has reached EOL.

-----------------------------------------------------

# My personal build procedure (WSL 1, Debian, Win 10)

**@since version 2022-07-06: Build procedure uses local repo fork of https://github.com/GHSVS-de/buildKramGhsvs**

- Prepare/adapt `./package.json`.
- `cd /mnt/z/git-kram/mod_toastghsvs`

## node/npm updates/installation
- `npm run updateCheck` or (faster) `npm outdated`
- `npm run update` (if needed) or (faster) `npm update --save-dev`
- `npm install` (if needed)

## Build installable ZIP package
- `node build.js`
- New, installable ZIP is in `./dist` afterwards.
- All packed files for this ZIP can be seen in `./package`. **But only if you disable deletion of this folder at the end of `build.js`**.

### For Joomla update and changelog server
- Create new release with new tag.
  - See release description in `dist/release.txt`.
- Extracts(!) of the update and changelog XML for update and changelog servers are in `./dist` as well. Copy/paste and necessary additions.
