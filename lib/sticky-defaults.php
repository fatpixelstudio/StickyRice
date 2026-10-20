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
 * Images get a stricter limit than other files (video, PDF), so editors can't
 * upload giant photos straight from the camera. Both limits are capped by the
 * server's upload_max_filesize and post_max_size.
 */
define( 'STICKY_UPLOAD_LIMIT_IMAGE', 4 * MB_IN_BYTES );
define( 'STICKY_UPLOAD_LIMIT_FILE', 64 * MB_IN_BYTES );

add_filter( 'upload_size_limit', function ( $size ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		$size = min( $size, STICKY_UPLOAD_LIMIT_FILE );
	}

	return $size;
}, 20 );

// The uploader only knows one limit, so images are checked separately here
function sticky_limit_image_upload_size( $file ) {
	if ( current_user_can( 'manage_options' ) || ! empty( $file['error'] ) ) {
		return $file;
	}

	$filetype = wp_check_filetype( $file['name'] );

	if ( $filetype['type'] && str_starts_with( $filetype['type'], 'image/' ) && $file['size'] > STICKY_UPLOAD_LIMIT_IMAGE ) {
		$file['error'] = sprintf(
			__( 'Afbeeldingen mogen maximaal %s zijn. Verklein de afbeelding en probeer het opnieuw.' ),
			size_format( STICKY_UPLOAD_LIMIT_IMAGE )
		);
	}

	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'sticky_limit_image_upload_size' );
add_filter( 'wp_handle_sideload_prefilter', 'sticky_limit_image_upload_size' );

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
