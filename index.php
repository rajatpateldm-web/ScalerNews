<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files (the other being style.css).
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

<div class="sn-content-area">
	<main id="primary" class="sn-main" role="main">
		<?php
		/**
		 * Hook: scalernews_before_main_content.
		 */
		do_action( 'scalernews_before_main_content' );
		?>

		<?php if ( have_posts() ) : ?>

			<header class="sn-archive-header">
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<h1 class="sn-archive-header__title"><?php single_post_title(); ?></h1>
				<?php endif; ?>
			</header>

			<?php
			$layout_style  = get_theme_mod( 'scalernews_archive_layout', 'grid' );
			$card_style    = get_theme_mod( 'scalernews_card_style', 'flat' );
			$wrapper_class = 'sn-posts-' . esc_attr( $layout_style ) . ' sn-card-style-' . esc_attr( $card_style );
			?>
			<div class="<?php echo esc_attr( $wrapper_class ); ?>">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div>

			<nav class="sn-pagination" aria-label="<?php esc_attr_e( 'Posts navigation', 'scalernews' ); ?>">
				<?php
				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) );
				?>
			</nav>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		<?php
		/**
		 * Hook: scalernews_after_main_content.
		 */
		do_action( 'scalernews_after_main_content' );
		?>
	</main><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .sn-content-area -->

<?php
get_footer();
