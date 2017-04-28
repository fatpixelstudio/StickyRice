<?php

/**
 * ----------------------------------------------------------------------------
 * Stuff we'll be adding here:
 * ----------------------------------------------------------------------------
 */

// Head cleanup
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
	// remove WP version from css
	add_filter( 'style_loader_src', 'stickyrice_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'stickyrice_remove_wp_ver_css_js', 9999 );

} // End head cleanup


// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
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
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end A better title

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


/**
 * ----------------------------------------------------------------------------
 * Scripts and enqueueing
 * ----------------------------------------------------------------------------
 */

// loading enqueued scripts and styles (if needed)
function stickyrice_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {

  	// Register scripts and styles here

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		  wp_enqueue_script( 'comment-reply' );
    }

		// Enqueue styles and scripts here

	}
} // End loading enqueued scripts and styles

// function to add async and defer attributes
function defer_js_async($tag){

	## 1: list of scripts to defer.
	$scripts_to_defer = array();
	## 2: list of scripts to async.
	$scripts_to_async = array('wp-embed.min.js', 'comment-reply.min.js');

	#defer scripts
	foreach($scripts_to_defer as $defer_script){
		if(true == strpos($tag, $defer_script ) )
			return str_replace( ' src', ' defer="defer" src', $tag );
	}
	#async scripts
	foreach($scripts_to_async as $async_script){
		if(true == strpos($tag, $async_script ) )
			return str_replace( ' src', ' async="async" src', $tag );
	}
	return $tag;
} // End async and defer attributes

add_filter( 'script_loader_tag', 'defer_js_async', 10 );

/**
 * ----------------------------------------------------------------------------
 * Theme support
 * ----------------------------------------------------------------------------
 */

// Adding theme support (WP 3+ Functions & Theme Support)
function stickyrice_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => '',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	// add_theme_support( 'post-formats',
	// 	array(
	// 		'aside',             // title less blurb
	// 		'gallery',           // gallery of images
	// 		'link',              // quick link to other site
	// 		'image',             // an image
	// 		'quote',             // a quick quote
	// 		'status',            // a Facebook like status update
	// 		'video',             // video
	// 		'audio',             // audio
	// 		'chat'               // chat transcript
	// 	)
	// );

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'Hoofdmenu', 'stickyricetheme' ),   // main nav in header
			'func-nav' => __( 'Copyright menu', 'stickyricetheme' ),   // main nav in header
			// 'foot-nav' => __( 'Footermenu', 'stickyricetheme' ),   // main nav in header
		)
	);
} /* end adding theme support */


/**
 * ----------------------------------------------------------------------------
 * Related posts
 * ----------------------------------------------------------------------------
 */

// Related Posts Function, call in your theme using stickyrice_related_posts();
function stickyrice_related_posts() {
	echo '<ul id="related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'stickyricetheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} // end related posts function

/**
 * ----------------------------------------------------------------------------
 * Paging navigation
 * ----------------------------------------------------------------------------
 */

// Numeric Page Navi
function stickyrice_page_navi() {
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
		'prev_text'    => '&larr;',
		'next_text'    => '&rarr;',
		'type'         => 'list',
		'end_size'     => 3,
		'mid_size'     => 3
		) );
	echo '</nav>';
} // End numeric Page Navi

/**
 * ----------------------------------------------------------------------------
 * More cleaning up
 * ----------------------------------------------------------------------------
 */

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function stickyrice_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function stickyrice_excerpt_more($more) {
	global $post;
	return '&hellip;';
}

// Set custom excerpt length, if needed
function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * ----------------------------------------------------------------------------
 * Custom functions
 * ----------------------------------------------------------------------------
 * Place any theme specific functions you need in this place
 */

// Featured item excerpts
function get_featured_excerpt_by_id($post_id){
	$the_post = get_post($post_id); //Gets post ID
	$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = custom_excerpt_length(15); //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '…');
		$the_excerpt = implode(' ', $words);
	endif;
	$the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
} // End featured item excerpts


// Content read more 'tag' button
add_filter( 'the_content_more_link', 'modify_read_more_link' );

function modify_read_more_link() {
	return '<p class="content-more"><a href="' . get_permalink() . '" class="button">Show full story</a></p>';
} // End more tag button


// Shuffle associative arrays
function shuffle_assoc(&$array) {
	$keys = array_keys($array);

	shuffle($keys);

	foreach($keys as $key) {
		$new[$key] = $array[$key];
	}

	$array = $new;

	return true;
} // End shuflle


/**
 * Get top page.
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

?>
