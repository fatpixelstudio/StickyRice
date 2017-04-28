
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

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-XXXXXXXX-XX', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>
