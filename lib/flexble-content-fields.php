<?php
/**
 * ----------------------------------------------------------------------------
 * Flexible content fields
 * ----------------------------------------------------------------------------
 * If you use flexible content fields by ACF, set them here and include them
 * like this: <?php include('lib/flexible-content-fields.php'); ?>
 */
?>

<?php if( get_row_layout() == 'text' ): ?>
	<div class="content-block copy">
		<?php the_sub_field('content'); ?>
	</div>
<?php endif; ?>
