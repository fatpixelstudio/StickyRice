<?php
/*
Author: Marijn Tijhuis, Fat Pixel
URL: https://fatpixel.nl

Setting the basics, thumbnails, comments, load stuff
*/

require 'lib/stickyrice.php';
require 'lib/sticky-helpers.php';
require 'lib/sticky-defaults.php';
require 'lib/sticky-roles-and-caps.php';
require 'lib/sticky-icons.php';
require 'lib/custom-post-types.php';

/**
 * ----------------------------------------------------------------------------
 * Let's cook some sticky rice, initialize the theme
 * ----------------------------------------------------------------------------
 */

 function stickyrice_cook() {
	/**
	 * Set up theme defaults and register support for various WordPress features
	 */
	// TODO: determine how themes are going to be translated: through a .pot file or through a plugin like Polylang
	// load_theme_textdomain( 'stickyrice', get_template_directory() . '/languages' );

	// launching operation cleanup
	add_action( 'init', 'stickyrice_head_cleanup' );

	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'full' );

	remove_theme_support( 'widgets-block-editor' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'menus' );
	add_theme_support( 'editor-styles' );

	register_nav_menus( [
		'nav-main' => __( 'Hoofdmenu', 'stickyrice' ),
		'nav-foot' => __( 'Footermenu', 'stickyricetheme' ),
		'nav-bottom' => __( 'Juridisch menu', 'stickyricetheme' ),
	] );

	// Enable support for editor styles
	add_editor_style( 'editor-style.css' );
}

// Hook stickyrice into theme load
add_action( 'after_setup_theme', 'stickyrice_cook' );


/**
 * ----------------------------------------------------------------------------
 * Enqueue scripts and styles
 * ----------------------------------------------------------------------------
 */

// add_action( 'wp_enqueue_scripts', function () {
// 	$css_url = get_theme_file_uri( 'dist/styles/main.styles.css' );
// 	$css_path = get_theme_file_path( 'dist/styles/main.styles.css' );

// 	wp_enqueue_style( 'stickyrice', $css_url, [], filemtime( $css_path ) );

// 	$js_url = get_theme_file_uri( 'dist/scripts/main.scripts.js' );
// 	$js_path = get_theme_file_path( 'dist/scripts/main.scripts.js' );

// 	wp_enqueue_script( 'stickyrice', $js_url, [], filemtime( $js_path ), true );
// 	wp_localize_script( 'stickyrice', 'urls', [ 'ajax' => admin_url( 'admin-ajax.php' ) ] );
// } );


/**
 * ----------------------------------------------------------------------------
 * Thumbnail size options
 * ----------------------------------------------------------------------------
 */

/*
WordPress already generates thumbnail, medium, medium_large, large, 1536x1536
and 2048x2048 for every upload, and uses them in srcset. Only add sizes the
design actually needs, since every size is generated for every upload.

Cropped sizes only end up in the same srcset when they share an aspect ratio,
so add them in pairs: a large and a smaller version of the same crop.
*/

// add_image_size( 'header-page', 2400, 1200, true );
// add_image_size( 'header-page-small', 1200, 600, true );

/*
 * ----------------------------------------------------------------------------
 * Advance Custom Fields
 * ----------------------------------------------------------------------------
 */

// Define your ACF Pro license key
//define('ACF_PRO_LICENSE', 'xxxx');

// Hide the ACF menu item if not WP DEBUG
if ( ! WP_DEBUG ) add_filter( 'acf/settings/show_admin', '__return_false' );

// function stickyrice_acf_google_api_key() {
// 	acf_update_setting('google_api_key', 'xxxx');
// }
// add_action('acf/init', 'stickyrice_acf_google_api_key');

// Add ACF options page
// add_action( 'acf/init', function () {
// 	acf_add_options_page( [
// 		'page_title' => 'Site-opties',
// 		'menu_title' => 'Site-opties',
// 		'menu_slug'  => 'site-options',
// 		'icon_url'   => 'dashicons-admin-generic',
// 	] );
// }, 5 );

// Add ACF options subpages
// add_action( 'acf/init', function () {
// 	acf_add_options_sub_page( [
// 		'page_title'  => 'Algemeen',
// 		'menu_title'  => 'Algemeen',
// 		'parent_slug' => 'site-options',
// 	] );
// 	acf_add_options_sub_page( [
// 		'page_title'  => '404 pagina',
// 		'menu_title'  => '404 pagina',
// 		'parent_slug' => 'site-options',
// 	] );
// }, 10 );
