# StickyRice

StickyRice is a Wordpress starter kit by [Fat Pixel](https://fatpixel.nl).

It's a very minimal theme, and is suited for the developer that wants to build from scratch.

## Styling and assets

StickyRice has no styles or scripts of its own. It's built to be combined with the [NoodleSoup](https://github.com/fatpixelstudio/NoodleSoup/) front-end starterkit: copy the NoodleSoup files (`package.json`, `src/`, `dist/`, `assets/`, the webpack configs, etc.) into the root of the theme, run `yarn install` and you're good to go. Write your styles and scripts in `src/`. Webpack bundles them into `dist/`, which is what the theme loads.

The theme expects these files:

- `dist/main.css` and `dist/main.js`: the development bundles (`yarn start`).
- `dist/main.min.css` and `dist/main.min.js`: the minified production bundles (`yarn build`).
- `package.json`: its `version` is used for cache busting.
- `assets/images/`: favicons, and the SVG's optimized by NoodleSoup in `assets/images/svg/`, which you can output inline with `get_svg( 'filename' )`.

Which files are loaded is decided by `sr_get_theme_data()` in `lib/sticky-helpers.php`:

- **Environment**: on a domain containing `local.` or `.test`, or on the staging domain (`fatpixel.dev`), it loads the unminified files. Everywhere else it loads the `.min` files. So make sure you've run `yarn build` before you deploy.
- **Version**: the `version` from `package.json` is added as `?v=` to the CSS and JS URL. `yarn build` increments the patch version, so browsers get the new files after every build.

If the page has no styling, or PHP warns it can't read `package.json`, the NoodleSoup files are missing or not built yet (or, on production, `yarn build` hasn't run). `package.json` is read from the theme folder via `get_theme_root()`, so this also works when WordPress lives in a subfolder.

The block editor gets its own styles: `editor-style.css` (via `add_editor_style()` in `functions.php`) and `editor-blocks.css` (enqueued in `lib/stickyrice.php`). Both live in the theme root and aren't built by NoodleSoup.

Classes on HTML elements are all in BEM notation. Javascript classes always start with ``js-``

## Header and footer

All styles and scripts are loaded in the `<head>` of header.php. The footer.php only calls `wp_footer()`.

- **Inline head script**: a tiny inline `<script>` right after the viewport meta, *above* the stylesheets. It swaps the `no-js` class on `<html>` for `js`. Put anything else that must run immediately here, like feature detection or setting CSS variables, and keep it tiny. It's inline because an external script only runs once it's downloaded, which may be after the first paint. It's above the stylesheets because an inline script after a stylesheet has to wait for that stylesheet to load.
- **`main.css`**: a regular `<link rel="stylesheet">`.
- **`main.js`**: loaded with `defer`, right after the stylesheet. It downloads in parallel, then runs after the HTML is parsed *and* the stylesheets have loaded. No `DOMContentLoaded` wait is needed in your scripts.

## Navigation

The main navigation (`nav-main`) requires JavaScript to function. It uses `aria-expanded` on the toggle button and relies on JS to add/remove the `is-open-main-nav` class on the `<html>` element. Without JavaScript, the nav will remain visible (no toggle behavior).

The JS hooks are:
- `.js-nav-main-toggle` — the open/toggle button in the header
- `.js-nav-main` — the `<nav>` element
- `.js-nav-main-close` — the close button inside the nav

See [NoodleSoup](https://github.com/fatpixel/fp-noodlesoup) for the reference JS implementation.

## Recommended plugins

StickyRice works without any plugins, and you should use as little plugins as possible anyway. But there are some references to [Advanced Custom Fields](https://www.advancedcustomfields.com) in the code. Other than that, you're free to use what you want.

## Thanks

A lot of inspiration for this starterkit is coming from the great [Bones theme](http://themble.com/bones/), developed by Eddie Machado. Into theme development? Check that one out!
