<?php get_header(); ?>

	<?php
	$news_page_id = get_option( 'page_for_posts' );
	$news_page = get_post($news_page_id);
	?>

	<main class="contain-width" id="main">

		<div class="copy">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>

			<?php endwhile; else: ?>

				<p>Pagina niet gevonden.</p>

			<?php endif; ?>

			<p>
				<a href="<?php echo get_permalink($news_page->ID); ?>">&larr; Terug naar nieuws</a>
			</p>

		</div>

	</main>

<?php get_footer(); ?>
