<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="sn-content-area">
	<main id="primary" class="sn-main" role="main">
		<?php
		/**
		 * Hook: scalernews_before_single.
		 */
		do_action( 'scalernews_before_single' );
		?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			// Post navigation.
			the_post_navigation( array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'scalernews' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'scalernews' ) . '</span> <span class="nav-title">%title</span>',
			) );

			// Related posts.
			/**
			 * Hook: scalernews_related_posts.
			 *
			 * @hooked scalernews_display_related_posts - 10
			 */
			do_action( 'scalernews_related_posts' );

			// Comments.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		<?php
		/**
		 * Hook: scalernews_after_single.
		 */
		do_action( 'scalernews_after_single' );
		?>
	</main><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .sn-content-area -->

<?php
get_footer();
