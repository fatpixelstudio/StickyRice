# StickyRice

StickyRice is a Wordpress starter kit by [Fat Pixel](https://fatpixel.nl).

It's a very minimal theme, and is suited for the developer that wants to build from scratch.

## Styling and assets

StickyRice assumes that you'll use stylesheets, javascript and other assets like in the [NoodleSoup](https://github.com/fatpixelstudio/NoodleSoup/) front-end starterkit.

If you install this theme and find yourself baffled by the **StickyRice couldn't find your JSON hash files for CSS or JS** warning, it means that the CSS and JS assets (of NoodleSoup) couldn't be found.

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
