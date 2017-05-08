<?php get_header(); ?>

	<div class="contain-padding" role="main">
		<h1 class="alpha-heading"><span><?php _e( 'Resulaten voor:', 'stickyricetheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('searchresult article'); ?> role="article">

				<header class="article__header">
					<h2 class="beta-heading"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<p class="searchresult__url"><a href="<?php the_permalink() ?>"><?php the_permalink() ?></a></p>
				</header>

				<section class="copy">
						<?php the_excerpt( '<span class="read-more">' . __( 'Lees verder &raquo;', 'stickyricetheme' ) . '</span>' ); ?>
				</section>

				<footer class="article__footer">

					<?php if(get_the_category_list(', ') != ''): ?>
  					<div class="article__categories"><?php printf( __( 'Geplaatst in: %1$s', 'stickyricetheme' ), get_the_category_list(', ') ); ?></div>
  					<?php endif; ?>

 					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'stickyricetheme' ) . '</span> ', ', ', '</p>' ); ?>

				</footer> <!-- end article footer -->

			</article>

		<?php endwhile; ?>

			<?php stickyrice_page_navi(); ?>

		<?php else : ?>

				<article id="post-not-found" class="hentry cf">
					<header class="article__header">
						<h1><?php _e( 'Geen resultaten.', 'stickyricetheme' ); ?></h1>
					</header>
					<section class="copy">
						<p><?php _e( 'Probeer uw zoekopdracht met een andere zoekterm.', 'stickyricetheme' ); ?></p>
					</section>
				</article>

		<?php endif; ?>
	</div>

<?php get_footer(); ?>
