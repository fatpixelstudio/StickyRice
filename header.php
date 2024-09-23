<!DOCTYPE html>
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

	<?php $theme_data = sr_get_theme_data(); ?>

	<!-- Scripts and Stylesheets -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/dist/main' . $theme_data['env_suffix'] . '.css?v='.$theme_data['version']; ?>" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/head' . $theme_data['env_suffix'] . '.js'; ?>" async></script>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<meta name="theme-color" content="#000000" />

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head functions ?>

</head>
<body <?php body_class(); ?>>
	<!--[if lte IE 9]>
	<p class="oldie-message">Let op! U gebruikt Internet Explorer 9 of lager (een <strong>sterk verouderd</strong> internetprogramma) om deze website te bekijken. <br /> <a href="http://browsehappy.com/">Download gratis een snellere en veiligere versie</a> om deze website optimaal te ervaren.</p>
	<![endif]-->

	<a class="skip-link" href="#main"><?php _e( 'Direct naar inhoud', 'stickyrice' ); ?></a>

	<header role="banner" id="page-top" class="banner">
		<div class="contain-width">
			<<?php echo (is_front_page()) ? 'h1': 'p'; ?> class="masthead">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span class="masthead__label"><?php echo get_bloginfo('name'); ?></span>
					<span class="masthead__logo" aria-hidden="true"><?php echo logo(); ?></span>
				</a>
			</<?php echo (is_front_page()) ? 'h1': 'p'; ?>>
			<a href="#nav-main" class="nav-main-toggle nav-main-toggle--open js-nav-main-show"><?php _e( 'Naar menu', 'stickyrice' ); ?></a>
		</div>
	</header>
