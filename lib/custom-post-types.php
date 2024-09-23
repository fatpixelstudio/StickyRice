<?php
/* We'll be adding custom post types here */

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'stickyrice_flush_rewrite_rules' );

// Flush your rewrite rules
function stickyrice_flush_rewrite_rules() {
	flush_rewrite_rules();
}

/**
 * Add your custom post types and taxonomies here
 * Use a tool like https://generatewp.com/ to generate the code, or write your
 * own if you're feeling lucky
 */

?>
