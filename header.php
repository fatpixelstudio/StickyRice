<?php
// Theme name / location
// Put the exact foldername of your theme in here
$theme_location = 'stickyrice';

if(strpos($_SERVER['SERVER_NAME'],'local.') !== false || strpos($_SERVER['SERVER_NAME'],'.local') !== false || strpos($_SERVER['SERVER_NAME'],'staging.domain.dev') !== false):
	$env_suffix = '';
else:
	$env_suffix = '.min';
endif;

// Get variables form package.json
$packagefile = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/' . $theme_location . '/package.json');
$packagejson = json_decode($packagefile, true);

// Variable to set 'critical' css file name to link to on a template basis.
// By default the varibale is set to 'default'. To link to another 'critical'
// css file, add name of another file to the include snippet (at the top
// of the template), like this:
// global $criticalcss; $criticalcss = 'home';
global $criticalcss; // Set as global, if defined in page template
$criticalcss = (isset($criticalcss)) ? $criticalcss : 'default';

// Mobile detect
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/' . $theme_location . '/lib/Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'computer');

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />

	<title><?php wp_title('&mdash;'); ?></title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0" />

	<!-- Prefetch DNS lookups -->
	<link rel="dns-prefetch" href="https://www.googletagmanager.com" />

	<!-- Preload assets (fonts, stylesheets, etc.) -->
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/dist/fonts/roboto-v29-latin-regular.woff2" as="font" type="font/woff2" crossorigin />

	<!-- Site icons -->
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png" /><?php // Touch icons, iOS and Android, 180x180 pixels in size (http://j.mp/2fnrQmw, http://j.mp/2gpJVVF) ?>
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png" /><?php // For Firefox, Chrome, Safari, IE 11+ and Opera, 192x192 pixels in size ?>
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/pinned-icon.svg" color="#141414" /><?php // For Safari 9+ pinned tab (http://j.mp/2gpNiw9) ?>

	<!-- Scripts and Stylesheets -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/dist/main' . $env_suffix . '.css?v='.$packagejson['version']; ?>" />
	<?php // Add print stylesheet if you want, because you should ?>
	<?php /*<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/stylesheets/print' . $env_suffix . '.css'; ?>" media="print" />*/ ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head functions ?>

	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/head' . $env_suffix . '.js'; ?>" async></script>

</head>
<body <?php body_class(); ?>>
	<!--[if lte IE 9]>
	<p class="oldie-message">Let op! U gebruikt Internet Explorer 9 of lager (een <strong>sterk verouderd</strong> internetprogramma) om deze website te bekijken. <br /> <a href="http://browsehappy.com/">Download gratis een snellere en veiligere versie</a> om deze website optimaal te ervaren.</p>
	<![endif]-->

	<header role="banner" id="page-top" class="banner">
		<<?php echo (is_front_page()) ? 'h1': 'p'; ?> class="masthead">
			<?php if(!is_front_page()): ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php endif; ?>
				<span class="masthead__label"><?php echo get_bloginfo('name'); ?></span>
				<span class="masthead__logo" aria-hidden="true"><?php echo logo(); ?></span>
			<?php if(!is_front_page()): ?></a><?php endif; ?>
		</<?php echo (is_front_page()) ? 'h1': 'p'; ?>>
		<a href="#nav-main" class="nav-main-toggle nav-main-toggle--open js-nav-main-show">Naar menu</a>
	</header>
