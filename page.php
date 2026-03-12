<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="sn-content-area sn-content-area--full">
	<main id="primary" class="sn-main" role="main">
		<?php
		while ( have_posts() ) :
			the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'sn-page' ); ?>>
			<header class="sn-page__header">
				<?php the_title( '<h1 class="sn-page__title">', '</h1>' ); ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="sn-page__featured-image">
					<?php the_post_thumbnail( 'scalernews-hero' ); ?>
				</div>
			<?php endif; ?>

			<div class="sn-page__content sn-single-post__content">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'scalernews' ),
					'after'  => '</div>',
				) );
				?>
			</div>

			<?php if ( get_edit_post_link() ) : ?>
				<footer class="sn-page__footer">
					<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post. Only visible to screen readers */
							wp_kses( __( 'Edit <span class="screen-reader-text">%s</span>', 'scalernews' ), array( 'span' => array( 'class' => array() ) ) ),
							wp_kses_post( get_the_title() )
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer>
			<?php endif; ?>
		</article>

		<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>
	</main><!-- #primary -->
</div><!-- .sn-content-area -->

<?php
get_footer();
