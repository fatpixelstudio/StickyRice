<?php get_header(); ?>

	<main class="contain-padding">

		<h1 class="alpha-heading">Pagina niet gevonden</h1>
		<div class="copy">

			<p>De pagina die u probeerde te bereiken werd niet gevonden. U kunt uw weg vervolgen op een van deze pagina's:</p>

			<ul>
				<li><a href="/">Homepage</a></li>
				<li><a href="<?php echo get_permalink(3); ?>"><?php echo get_the_title(3); ?></a></li>
			</ul>
		</div>

	</main>

<?php get_footer(); ?>
