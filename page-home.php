<?php /* Template name: Homepage */ ?>

<?php get_header(); ?>

	<main class="contain-padding">

		<h1 class="alpha-heading">Homepage</h1>

		<div class="copy">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h2><?php the_title(); ?></h2>

				<?php the_content(); ?>

			<?php endwhile; else: ?>

				<p>Pagina niet gevonden.</p>

			<?php endif; ?>
		</div>

	</main>

<?php get_footer(); ?>
