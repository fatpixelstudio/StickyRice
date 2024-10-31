<?php

/**
 * ----------------------------------------------------------------------------
 * Default stickyrice functions
 * ----------------------------------------------------------------------------
 */

/**
 * Cleanup functions
 */

function stickyrice_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// a better title
	add_filter( 'wp_title', 'stickyrice_nice_title', 10, 3 );
	// remove WP version from css
	add_filter( 'style_loader_src', 'stickyrice_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'stickyrice_remove_wp_ver_css_js', 9999 );
	// remove WP version from RSS
	add_filter( 'the_generator', 'stickyrice_rss_version' );
	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'stickyrice_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action( 'wp_head', 'stickyrice_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	add_filter( 'gallery_style', 'stickyrice_gallery_style' );

}

// remove WP version from RSS
function stickyrice_rss_version() { return ''; }

// remove WP version from scripts
function stickyrice_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function stickyrice_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function stickyrice_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function stickyrice_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

// A better title
function stickyrice_nice_title( $title, $sep, $seplocation ) {
	global $page, $paged;

	// Don't affect in feeds.
	if ( is_feed() ) return $title;

	// Add the blog's name
	if ( 'right' == $seplocation ) {
		$title .= get_bloginfo( 'name' );
	} else {
		$title = get_bloginfo( 'name' ) . $title;
	}

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " {$sep} {$site_description}";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " {$sep} " . sprintf( __( 'Page %s', 'stickyrice' ), max( $paged, $page ) );
	}

	return $title;
}

/**
 * Enqueue block editor and front-end styles for the theme.
 *
 * This function enqueues a stylesheet for both the block editor and the front end.
 * The stylesheet, 'style-blocks.css', should be located in the root of your theme directory.
 *
 * If you wish to enqueue styles exclusively for the editor, you can use the is_admin()
 * function to conditionally load assets.
 *
 * @since 1.0.0
 */
function sr_enqueue_block_styles() {

    // If you want to add styles exclusively for the block editor, you can use:
    if ( is_admin() ) {
        // Register the editor stylesheet located in the theme's root directory.
        wp_register_style(
            'sr-editor-styles',
            get_theme_file_uri('editor-blocks.css'),
            [],
            '1.2'
        );

        // Enqueue editor styles.
        wp_enqueue_style( 'sr-editor-styles' );
    }
}
// Hook the function to 'enqueue_block_assets' to load the stylesheet in the block editor and the front end.
add_action( 'enqueue_block_assets', 'sr_enqueue_block_styles' );


/**
 * ----------------------------------------------------------------------------
 * Excerpts
 * ----------------------------------------------------------------------------
 */

// Featured item excerpts
function get_excerpt_by_id($post_id, $length = 16){
	$the_post = get_post($post_id); //Gets post ID
	$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = $length; //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '…');
		$the_excerpt = implode(' ', $words);
	endif;
	$the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
}

function get_excerpt_from_flex_blocks($post_id) {
	$excerpt = '';
	if( have_rows('page_blocks', $post_id) ) {
		while( have_rows('page_blocks', $post_id) ) {
			the_row();
			 if( get_row_layout() == 'text_header' || get_row_layout() == 'text_col' ) {
				$text = get_sub_field('text');
				$excerpt = wp_trim_words($text, 16, ' &hellip;');
				break;
			 }
		}
	}

	return $excerpt;
}

/**
 * ----------------------------------------------------------------------------
 * Page hierarchy
 * ----------------------------------------------------------------------------
 */

function get_top_parent_page_id($id) {
	$menupost = get_post($id);
	return $menupost->post_parent;
}

function get_top_ancestor_page_id($id) {
	$menupost = get_post($id);
	if ($menupost->post_parent && $menupost->ancestors) {
		$top_post = get_post(end($menupost->ancestors));
		return $top_post;
	}
	else {
		return $false;
	}
}


/**
 * ----------------------------------------------------------------------------
 * Custom functions
 * ----------------------------------------------------------------------------
 * Place any theme specific functions you need in this place
 */

 function sticky_page_nav() {
	global $wp_query;
	$bignum = 999999999;

	if ( $wp_query->max_num_pages <= 1 )
		return;

	echo '<nav class="pagination">';
	echo paginate_links( array(
		'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format'       => '',
		'current'      => max( 1, get_query_var('paged') ),
		'total'        => $wp_query->max_num_pages,
		'prev_text'    => get_svg('icon-chevron-left'),
		'next_text'    => get_svg('icon-chevron-right'),
		'type'         => 'list',
		'end_size'     => 3,
		'mid_size'     => 3
		) );
	echo '</nav>';
}
