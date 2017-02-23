<?php get_header(); ?>

	<main class="contain-padding">

		<div class="copy">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>

			<?php endwhile; else: ?>

				<p>Pagina niet gevonden.</p>

			<?php endif; ?>
		</div>

	</main>

<?php get_footer(); ?>
