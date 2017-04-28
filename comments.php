<?php
/*
The stickyrice comments page
*/

// don't load it if you can't comment
if ( post_password_required() ) {
	return;
}

?>

<div class="comments">

<?php // You can start editing here. ?>

	<?php if ( have_comments() ) : ?>

		<h3 id="comments-title" class="comments__title"><?php comments_number( __( '<span>Nog geen</span> reacties', 'stickyricetheme' ), __( '<span>1</span> reactie', 'stickyricetheme' ), __( '<span>%</span> reacties', 'stickyricetheme' ) );?></h3>

		<section class="commentslist">
			<?php
				wp_list_comments( array(
					'style'             => 'div',
					'short_ping'        => true,
					'avatar_size'       => 40,
					'callback'          => 'stickyrice_comments',
					'type'              => 'all',
					'reply_text'        => 'Reply',
					'page'              => '',
					'per_page'          => '',
					'reverse_top_level' => null,
					'reverse_children'  => ''
				) );
			?>
		</section>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="comment-navigation" role="navigation">
				<div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Eerdere reacties', 'stickyricetheme' ) ); ?></div>
				<div class="comment-nav-next"><?php next_comments_link( __( 'Meer reacties &rarr;', 'stickyricetheme' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php _e( 'Reageren niet mogelijk.' , 'stickyricetheme' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<div class="commentform">
		<?php comment_form(); ?>
	</div>

</div>
