<?php
/**
 * Template part for displaying single post content
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sn-single-post' ); ?>>
	<header class="sn-single-post__header">
		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) :
		?>
			<a class="sn-single-post__category" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
				<?php echo esc_html( $categories[0]->name ); ?>
			</a>
		<?php endif; ?>

		<?php the_title( '<h1 class="sn-single-post__title">', '</h1>' ); ?>

		<?php
		$show_author = get_theme_mod( 'scalernews_single_show_author', true );
		if ( $show_author ) :
		?>
		<div class="sn-single-post__meta">
			<span class="sn-single-post__author">
				<?php
				printf(
					/* translators: %s: post author */
					esc_html__( 'By %s', 'scalernews' ),
					'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
				);
				?>
			</span>
			<span class="sn-single-post__date">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</span>
			<span class="sn-reading-time">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
				<?php echo esc_html( scalernews_reading_time() ); ?>
			</span>
			<?php if ( comments_open() ) : ?>
			<span class="sn-single-post__comments-count">
				<?php comments_popup_link(
					esc_html__( 'No Comments', 'scalernews' ),
					esc_html__( '1 Comment', 'scalernews' ),
					esc_html__( '% Comments', 'scalernews' )
				); ?>
			</span>
			<?php endif; ?>
		</div>
		<?php else: ?>
		<div class="sn-single-post__meta">
			<span class="sn-single-post__date">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</span>
			<span class="sn-reading-time">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
				<?php echo esc_html( scalernews_reading_time() ); ?>
			</span>
			<?php if ( comments_open() ) : ?>
			<span class="sn-single-post__comments-count">
				<?php comments_popup_link(
					esc_html__( 'No Comments', 'scalernews' ),
					esc_html__( '1 Comment', 'scalernews' ),
					esc_html__( '% Comments', 'scalernews' )
				); ?>
			</span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</header>

	<?php
	$fi_display = get_theme_mod( 'scalernews_single_featured_image', 'content' );
	if ( 'hidden' !== $fi_display && has_post_thumbnail() ) :
		$fi_class = 'sn-single-post__featured-image ' . ( 'full' === $fi_display ? 'alignwide' : '' );
	?>
	<div class="<?php echo esc_attr( $fi_class ); ?>">
		<?php the_post_thumbnail( 'scalernews-hero' ); ?>
		<?php
		$caption = get_the_post_thumbnail_caption();
		if ( $caption ) :
		?>
			<p class="wp-caption-text"><?php echo esc_html( $caption ); ?></p>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div class="sn-single-post__content entry-content">
		<?php
		the_content( sprintf(
			/* translators: %s: Name of current post. Only visible to screen readers */
			wp_kses( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'scalernews' ), array( 'span' => array( 'class' => array() ) ) ),
			wp_kses_post( get_the_title() )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'scalernews' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<footer class="sn-single-post__footer">
		<?php
		$tags_list = get_the_tag_list( '', '' );
		if ( $tags_list ) :
		?>
		<div class="sn-single-post__tags">
			<?php echo $tags_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
		<?php endif; ?>

		<?php if ( get_edit_post_link() ) : ?>
		<div class="sn-single-post__edit">
			<?php
			edit_post_link(
				sprintf(
					wp_kses( __( 'Edit <span class="screen-reader-text">%s</span>', 'scalernews' ), array( 'span' => array( 'class' => array() ) ) ),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</div>
		<?php endif; ?>

		<?php
		/**
		 * Hook: scalernews_single_post_footer.
		 *
		 * @hooked scalernews_social_share_buttons - 10
		 * @hooked scalernews_author_box - 20
		 */
		do_action( 'scalernews_single_post_footer' );
		?>
	</footer>
</article>
