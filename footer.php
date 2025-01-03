
	<nav id="nav-main" class="nav-main js-nav-main">
		<?php wp_nav_menu(array(
			'container' => false,                           // remove nav container
			'menu' => __( 'Hoofdmenu', 'stickyricetheme' ), // nav name
			'menu_class' => 'nav-main__list contain-width',               // adding custom nav class
			'theme_location' => 'nav-main',                 // where it's located in the theme
		)); ?>
		<a href="#page-top" class="nav-main-toggle nav-main-toggle--close js-nav-main-hide">
			<span class="nav-main-toggle__label">
				<?php _e( 'Terug naar boven', 'stickyrice' ); ?>
			</span>
			<span class="nav-main-toggle__icon" aria-hidden="true">
				<?php echo icon_close(); ?>
			</span>
		</a>
	</nav>
	<div class="footer">
		<footer role="contentinfo" class="contain-width contentinfo">
			<p>&copy; <?php echo get_bloginfo('name'); ?></p>
		</footer>
	</div>

	<?php $theme_data = sr_get_theme_data(); ?>

	<script src="<?php echo get_template_directory_uri() . '/dist/main' . $theme_data['env_suffix'] . '.js?v=' .$theme_data['version']; ?>" async></script>

	<?php wp_footer(); ?>

</body>
</html>
