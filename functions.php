<?php
/*
Author: Marijn Tijhuis, Fat Pixel
URL: https://fatpixel.nl

Setting the basics, thumbnails, comments, load stuff
*/

require 'lib/stickyrice.php';
require 'lib/sticky-helpers.php';
require 'lib/sticky-defaults.php';
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

	register_nav_menus( [
		'nav-main' => __( 'Hoofdmenu', 'stickyrice' ),
		'nav-foot' => __( 'Footermenu', 'stickyricetheme' ),
		'nav-bottom' => __( 'Juridisch menu', 'stickyricetheme' ),
	] );

	// Enable support for editor styles
	add_editor_style();
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

// Thumbnail sizes
add_image_size( 'content-width-full', 1024, 9999 );
add_image_size( 'content-width-half', 512, 9999 );
add_image_size( 'content-width-quarter', 256, 9999 );
add_image_size( 'header-page', 2400, 1200, true );
add_image_size( 'article-square', 800, 800, true );
add_image_size( 'article-landscape', 1200, 800, true );
add_image_size( 'article-portrait', 960, 1600, true );
add_image_size( 'article-full', 2400, 1800, true );

/*
The function below adds the ability to use the dropdown menu to select
the new images sizes you have just created above, from within the media manager
when you add media to your content blocks.
*/

// Hook custom image sizes to Wordpress
add_filter( 'image_size_names_choose', 'stickyrice_custom_image_sizes' );

// Image sizes in editor
function stickyrice_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'content-width-full' => __('100% breed'),
		'content-width-half' => __('50% breed'),
		'content-width-quarter' => __('25% breed'),
	) );
}

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
