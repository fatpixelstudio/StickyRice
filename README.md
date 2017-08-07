# StickyRice

StickyRice is a Wordpress starter kit by [Fat Pixel](https://fatpixel.nl).

It's a very minimal theme, and is suited for the developer that wants to build from scratch.

## Styling and assets

StickyRice assumes that you'll use stylesheets, javascript and other assets like in the [Altair](https://github.com/jolantis/altair) starterkit.

If you install this theme and find yourself baffled by the **StickyRice couldn't find your JSON hash files for CSS or JS** warning, it means that the CSS and JS assets (of Altair) couldn't be found.

Classes on HTML elements are all in BEM notation. Javascript classes always start with ``js-``

## Header and footer

This starter kit also assumes you'll be using some sort of critical css and an asynchronous style and script loader like [Enhance](https://github.com/filamentgroup/enhance). The header.php and footer.php reflect that. 

If you're planning to use regular ``<link>`` and ``<script>`` tags loading these assets, feel free to do so! But you'll have to really dig into the header.php and the way it works.

## Recommended plugins

StickyRice works without any plugins, and you should use as little plugins as possible anyway. But there are some references to [Advanced Custom Fields](https://www.advancedcustomfields.com) in the code. Other than that, you're free to use what you want.

## Thanks

A lot of inspiration for this starterkit is coming from the great [Bones theme](http://themble.com/bones/), developed by Eddie Machado. Into theme development? Check that one out!
