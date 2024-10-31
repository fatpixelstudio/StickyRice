<?php

/**
 * This file contains helper functions that are used throughout the theme.
 */

/**
 * Dumps one or more variables
 */
function sr_dump( ...$variables ) {
    foreach ($variables as $var) {
        echo '<pre style="padding:24px;margin:0;background-color:#f0f0f0">' . print_r($var, true) . '</pre>';
    }
}

/**
 * Returns the contents of an SVG file from the /images directory
 */
function get_svg( string $filename, ?string $class = '' ) {
	$svg = @file_get_contents( get_theme_file_path( 'assets/images/svg/' . $filename . '.svg' ) ) ?: '';

	if ( $class ) {
		$svg = str_replace( '<svg', '<svg class="' . $class . '"', $svg );
	}

	return $svg;
}


/**
 * Return the environment suffix, subfolder and version from package.json based on the theme and environment
 */

function sr_get_theme_data($theme_location = null, $staging_domain = null) {
	// Get the slug of the current theme
	if(!isset($theme_location)) {
		$theme_location = get_template();
	}
	if(!isset($staging_domain)) {
		$staging_domain = 'staging.domain.dev';
	}

	if(strpos($_SERVER['SERVER_NAME'],'local.') !== false || strpos($_SERVER['SERVER_NAME'],'.local') !== false || strpos($_SERVER['SERVER_NAME'],$staging_domain) !== false ) {
		$env_suffix = '';
		$subfolder = '';
	}
	else {
		$env_suffix = '.min';
		$subfolder = '';
	}

	$packagefile = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . $subfolder . '/wp-content/themes/' . $theme_location . '/package.json' );
	$packagejson = json_decode( $packagefile, true );

	return [
		'env_suffix' => $env_suffix,
		'subfolder' => $subfolder,
		'version' => $packagejson['version'],
	];
}


/**
 * Returns whether the user has filtered by given fields
 */
function user_has_filtered_by( ...$fields ) {
	$output = false;

	foreach ( $fields as $field ) {
		if ( ! empty( $_GET[ $field ] ) ) {
			$output = true;
			break;
		}
	}

	return $output;
}
