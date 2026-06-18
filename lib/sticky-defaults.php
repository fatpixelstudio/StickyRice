<?php

/**
 * This file contains settings that will only rarely need to be changed.
 * They are probably the going to be the same for 99% of all sites.
 */

/**
 * Limit the formatting options in TinyMCE
 */
add_filter( 'tiny_mce_before_init', function ( $settings ) {
	$settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;';

	return $settings;
} );

/**
 * Limit the upload size for non-administrators
 */
add_filter( 'upload_size_limit', function ( $size ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		$size = 16 * 1024 * 1024;
	}

	return $size;
}, 20 );

/**
 * Make embeds responsive
 */
add_filter( 'embed_oembed_html', function ( $html ) {
	return '<div class="fluid-embed">' . $html . '</div>';
} );

/**
 * Move the Yoast meta box to the bottom
 */
add_filter( 'wpseo_metabox_prio', function () {
	return 'low';
} );

/**
 * Move RankMath meta box to the bottom
 */
add_filter( 'rank_math/metabox/priority', function () {
	return 'low';
} );

// Allow SVG's to be uploaded
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Remove the users endpoint from the REST API
 * If a plugin needs to use the users endpoint, comment this block
 */
add_filter('rest_endpoints', function($endpoints) {
	if (isset($endpoints['/wp/v2/users'])) {
		unset($endpoints['/wp/v2/users']);
	}
	if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
		unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
	}
	return $endpoints;
});

// disable XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );
