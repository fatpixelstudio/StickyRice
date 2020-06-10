
	<nav role="navigation" id="nav-main" class="nav-main js-nav-main">
		<h2 class="is-hidden-visually">Menu</h2>
		<?php wp_nav_menu(array(
			'container' => false,                           // remove nav container
			'menu' => __( 'Hoofdmenu', 'stickyricetheme' ), // nav name
			'menu_class' => 'nav-main__list',               // adding custom nav class
			'theme_location' => 'main-nav',                 // where it's located in the theme
		)); ?>
		<a href="#page-top" class="nav-main-toggle nav-main-toggle--close js-nav-main-hide">Terug naar boven</a>
	</nav>
	<footer role="contentinfo" class="contentinfo copy">
		<p>&copy; Fat Pixel</p>
	</footer>

	<?php wp_footer(); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141682345-9"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-XXXXXXXXX-X', { 'anonymize_ip': true });
	</script>
</body>
</html>
