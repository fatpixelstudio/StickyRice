<?php get_header(); ?>

	<main class="contain-padding">

		<?php if (is_category()) { ?>
			<h1 class="alpha-heading">
				<span><?php _e( 'Berichten in:', 'stickyricetheme' ); ?></span> <?php single_cat_title(); ?>
			</h1>

		<?php } if(is_post_type_archive() ) { ?>
			<h1 class="alpha-heading">
				<span><?php post_type_archive_title(); ?></span>
			</h1>
		<?php } elseif (is_tag()) { ?>
			<h1 class="alpha-heading">
				<span><?php _e( 'Berichten met tag:', 'stickyricetheme' ); ?></span> <?php single_tag_title(); ?>
			</h1>

		<?php } elseif (is_author()) {
			global $post;
			$author_id = $post->post_author;
		?>
			<h1 class="alpha-heading">

				<span><?php _e( 'Berichten door:', 'stickyricetheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

			</h1>
		<?php } elseif (is_day()) { ?>
			<h1 class="alpha-heading">
				<span><?php _e( 'Archief per dag:', 'stickyricetheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
			</h1>

		<?php } elseif (is_month()) { ?>
				<h1 class="alpha-heading">
					<span><?php _e( 'Archief per maand:', 'stickyricetheme' ); ?></span> <?php the_time('F Y'); ?>
				</h1>

		<?php } elseif (is_year()) { ?>
				<h1 class="alpha-heading">
					<span><?php _e( 'Archief per jaar:', 'stickyricetheme' ); ?></span> <?php the_time('Y'); ?>
				</h1>
		<?php } ?>

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
					<div class="copy">
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
