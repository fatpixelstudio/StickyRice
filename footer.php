
	<nav id="nav-main" class="nav-main js-nav-main" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'stickyrice' ); ?>">
		<?php wp_nav_menu(array(
			'container' => false,                           // remove nav container
			'menu' => __( 'Hoofdmenu', 'stickyricetheme' ), // nav name
			'menu_class' => 'nav-main__list',               // adding custom nav class
			'theme_location' => 'nav-main',                 // where it's located in the theme
		)); ?>
		<button type="button" class="nav-main-toggle nav-main-toggle--close js-nav-main-close">
			<span class="nav-main-toggle__label">
				<?php _e( 'Menu sluiten', 'stickyrice' ); ?>
			</span>
			<span class="nav-main-toggle__icon" aria-hidden="true">
				<?php echo icon_close(); ?>
			</span>
		</button>
	</nav>
	<div class="footer">
		<footer role="contentinfo" class="contain-width contentinfo">
			<p>&copy; <?php echo get_bloginfo('name'); ?></p>
		</footer>
	</div>

	<?php wp_footer(); ?>

</body>
</html>
