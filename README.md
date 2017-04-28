# StickyRice

StickyRice is a Wordpress starter kit by (https://fatpixel.nl)[Fat Pixel].

It's a very minimal theme, and is suited for the developer that wants to build from scratch.

## Styling and assets

StickyRice assumes that you'll use stylesheets, javascript and other assets like in the (https://github.com/jolantis/altair)[Altair] starterkit.

If you install this theme and find yourself baffled by the **StickyRice couldn't find your JSON hash files for CSS or JS** warning, it means that the CSS and JS assets (of Altair) couldn't be found.

Classes on HTML elements are all in BEM notation. Javascript classes always start with ``js-``

## Header and footer

This starter kit also assumes you'll be using some sort of critical css and an asynchronous style and script loader like (https://github.com/filamentgroup/enhance)[Enhance]. The header.php and footer.php reflect that. 

If you're planning to use regular ``<link>`` and ``<script>`` tags loading these assets, feel free to do so! But you'll have to really dig into the header.php and the way it works.

## Recommended plugins

StickyRice works without any plugins, and you should use as little plugins as possible anyway. But there are some references to (https://www.advancedcustomfields.com)[Advanced Custom Fields] in the code. Other than that, you're free to use what you want.

## Thanks

A lot of inspiration for this starterkit is coming from the great (http://themble.com/bones/)[Bones theme], developed by Eddie Machado.
