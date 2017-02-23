<?php get_header(); ?>

	<?php $news_page = get_post(get_option( 'page_for_posts' )); ?>

	<main class="contain-padding">

		<h1 class="alpha-heading"><?php echo $news_page->post_title; ?></h1>

		<div class="articlelist">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'articlelist-item article' ); ?> role="article">
					<?php if(has_post_thumbnail()): ?>
						<figure class="article-image"><?php the_post_thumbnail(); ?></figure>
					<?php endif; ?>
					<p class="article-date">
						<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
					</p>
					<h1 class="article-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>
					<div class="Copy">
						<?php the_excerpt(); ?>
					</div>
					<p class="article-readmore">
						<a href="<?php the_permalink(); ?>">Lees verder &rarr;</a>
					</p>
				</article>
			<?php endwhile; ?>

				<?php stickyrice_page_navi(); ?>

			<?php else : ?>
				<p>Geen berichten gevonden.</p>
			<?php endif; ?>
		</div>

	</main>

<?php get_footer(); ?>
