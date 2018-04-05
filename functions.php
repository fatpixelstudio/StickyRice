<?php
/*
Author: Marijn Tijhuis, Fat Pixel
URL: https://fatpixel.nl

Setting the basics, thumbnails, comments, load stuff
*/

// Load all the stickyrice library specifics
require_once( 'lib/stickyrice.php' );

// Load custom post types
require_once( 'lib/custom-post-type.php' );

// Customize the Wordpress admin (off by default)
// require_once( 'lib/admin.php' );

/**
 * ----------------------------------------------------------------------------
 * Let's cook some sticky rice, initialize the theme
 * ----------------------------------------------------------------------------
 */

function stickyrice_cook() {

  // Allow editor styles
  add_editor_style();

  // launching operation cleanup
  add_action( 'init', 'stickyrice_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'stickyrice_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'stickyrice_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'stickyrice_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'stickyrice_gallery_style' );

  // if you want to enqueue base scripts and styles, here's a good spot for that
  // add_action( 'wp_enqueue_scripts', 'stickyrice_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  stickyrice_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'stickyrice_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'stickyrice_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'stickyrice_excerpt_more' );

}

// Hook stickyrice into theme load
add_action( 'after_setup_theme', 'stickyrice_cook' );


/**
 * OEMBED size options
 */

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/**
 * ----------------------------------------------------------------------------
 * Thumbnail size options
 * ----------------------------------------------------------------------------
 */

// Thumbnail sizes
add_image_size( 'content-width-full', 1024, 9999 );
add_image_size( 'content-width-half', 512, 9999 );
add_image_size( 'content-width-quarter', 256, 9999 );
add_image_size( 'header-home', 1800, 1010, true );
add_image_size( 'header-page', 1800, 800, true );
add_image_size( 'article-square', 400, 400, true );

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

/**
 * ----------------------------------------------------------------------------
 * Active sidebars & widgets
 * ----------------------------------------------------------------------------
 */

// Sidebars & Widgetizes Areas
function stickyrice_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar-forum',
		'name' => __( 'Forum tools', 'stickyricetheme' ),
		'description' => __( 'The tools below the forum.', 'stickyricetheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="GammaHeading">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'stickyricetheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'stickyricetheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
}

/**
 * ----------------------------------------------------------------------------
 * Comment layout
 * ----------------------------------------------------------------------------
 */

// Comment Layout
function stickyrice_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('Comment cf'); ?>>
    <article  class="cf">
      <header class="Comment-head vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <div class="Comment-author">
          <?php
            // create variable
            $bgauthemail = get_comment_author_email();
          ?>
          <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="Comment-avatar load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
          <span class="Comment-authorName"><?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'stickyricetheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'stickyricetheme' ),'  ','') ) ?></span>
        </div>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>" class="Comment-time"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'd/m/Y H:i', 'stickyricetheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="Comment-alert alert alert-info">
          <p><?php _e( 'Je reactie wordt beoordeeld door de beheerders.', 'stickyricetheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="Comment-text Copy comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
 * ----------------------------------------------------------------------------
 * Advance Custom Fields
 * ----------------------------------------------------------------------------
 * If you're using Advanced Custom Fields, and want an options page,
 * use the code below.
 */

// function stickyrice_acf_google_api_key() {
// 	acf_update_setting('google_api_key', 'xxxx');
// }
// add_action('acf/init', 'stickyrice_acf_google_api_key');

// if( function_exists('acf_add_options_page') ) {
//   acf_add_options_page(array('page_title' => 'Site opties'));
// }

/*
 * ----------------------------------------------------------------------------
 * Remove admin bar
 * ----------------------------------------------------------------------------
 */

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}

?>
