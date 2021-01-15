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
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8" />

	<title><?php wp_title('&mdash;'); ?></title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0" />

	<!-- Prefetch DNS lookups -->
	<link rel="dns-prefetch" href="https://www.googletagmanager.com" />

	<!-- Preload assets (fonts, stylesheets, etc.) -->
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/firasans/firasans-bold.woff2" as="font" type="font/woff2" crossorigin />

	<!-- Site icons -->
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png" /><?php // Touch icons, iOS and Android, 180x180 pixels in size (http://j.mp/2fnrQmw, http://j.mp/2gpJVVF) ?>
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png" /><?php // For Firefox, Chrome, Safari, IE 11+ and Opera, 192x192 pixels in size ?>
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/pinned-icon.svg" color="#141414" /><?php // For Safari 9+ pinned tab (http://j.mp/2gpNiw9) ?>

	<!-- Scripts and Stylesheets -->
	<meta name="full_css" content="<?php echo get_template_directory_uri() . '/assets/stylesheets/main' . $env_suffix . '.css?v='.$packagejson['version']; ?>; ?>" />
	<meta name="full_js" content="<?php echo get_template_directory_uri() . '/assets/javascript/main' . $env_suffix . '.js'; ?>" />
	<script><?php include_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/' . $theme_location . '/assets/javascript/head' . $env_suffix . '.js'); ?></script>
	<?php if(isset($_COOKIE['full_css']) && $_COOKIE['full_css'] == 'true'): ?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/stylesheets/main' . $env_suffix . '.css?v='.$packagejson['version']; ?>; ?>" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/stylesheets/print' . $env_suffix . '.css'; ?>" media="print" />
	<?php else: ?>
		<style><?php if($env_suffix == 'dev'): echo '/* ' . $criticalcss . ' css */' . "\n"; endif; include_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/' . $theme_location . '/assets/stylesheets/critical/' . $criticalcss . '.css'); ?></style>
		<noscript><link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/stylesheets/main' . $env_suffix . '.css'; ?>"></noscript>
	<?php endif; ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head functions ?>

</head>
<body <?php body_class(); ?>>
	<!--[if lte IE 9]>
	<p class="oldie-message">Let op! U gebruikt Internet Explorer 9 of lager (een <strong>sterk verouderd</strong> internetprogramma) om deze website te bekijken. <br /> <a href="http://browsehappy.com/">Download gratis een snellere en veiligere versie</a> om deze website optimaal te ervaren.</p>
	<![endif]-->

	<header role="banner" id="page-top" class="banner">
		<<?php echo (is_front_page()) ? 'h1': 'p'; ?> class="masthead">
			<?php if(!is_front_page()): ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php endif; ?>
				<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php echo get_bloginfo('name'); ?>"/>
			<?php if(!is_front_page()): ?></a><?php endif; ?>
		</<?php echo (is_front_page()) ? 'h1': 'p'; ?>>
		<a href="#nav-main" class="nav-main-toggle nav-main-toggle--open js-nav-main-show">Naar menu</a>
	</header>
