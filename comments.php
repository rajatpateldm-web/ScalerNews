<?php
/**
 * The template for displaying comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="sn-comments comments-area">

	<?php
	/**
	 * Hook: scalernews_before_comments.
	 */
	do_action( 'scalernews_before_comments' );
	?>

	<?php if ( have_comments() ) : ?>
		<h2 class="sn-comments__title">
			<?php
			$comment_count = get_comments_number();
			printf(
				/* translators: 1: comment count */
				esc_html( _nx( '%1$s Comment', '%1$s Comments', $comment_count, 'comments title', 'scalernews' ) ),
				number_format_i18n( $comment_count )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 48,
			) );
			?>
		</ol>

		<?php
		the_comments_navigation( array(
			'prev_text' => esc_html__( '&larr; Older Comments', 'scalernews' ),
			'next_text' => esc_html__( 'Newer Comments &rarr;', 'scalernews' ),
		) );
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="sn-comments__closed">
				<?php esc_html_e( 'Comments are closed.', 'scalernews' ); ?>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'        => esc_html__( 'Leave a Comment', 'scalernews' ),
		'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
		'title_reply_after'  => '</h3>',
	) );
	?>

	<?php
	/**
	 * Hook: scalernews_after_comments.
	 */
	do_action( 'scalernews_after_comments' );
	?>

</div><!-- #comments -->
