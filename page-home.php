<?php /* Template name: Homepage */ ?>

<?php get_header(); ?>

	<main class="contain-width" id="main">

		<h1 class="alpha-heading"><?php the_title(); ?></h1>

		<div class="copy">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

			<?php endwhile; else: ?>

				<p>Pagina niet gevonden.</p>

			<?php endif; ?>
		</div>

	</main>

<?php get_footer(); ?>
