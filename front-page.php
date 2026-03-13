<?php
/**
 * The front page template
 *
 * Displays the news homepage with hero banner, category sections, and sidebar.
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

<div class="sn-content-area<?php if ( ! get_theme_mod( 'scalernews_homepage_sidebar', true ) ) echo ' sn-content-area--full'; ?>">
	<main id="primary" class="sn-main" role="main">
		<?php
		/**
		 * Hook: scalernews_before_front_page.
		 */
		do_action( 'scalernews_before_front_page' );
		?>

		<!-- Hero Banner -->
		<?php get_template_part( 'template-parts/hero-banner' ); ?>

		<!-- Latest News Section -->
		<section class="sn-section sn-section--latest">
			<div class="sn-section-heading">
				<h2 class="sn-section-heading__title"><?php esc_html_e( 'Latest News', 'scalernews' ); ?></h2>
				<span class="sn-section-heading__line"></span>
			</div>

			<?php
			$latest_args = array(
				'posts_per_page' => get_theme_mod( 'scalernews_homepage_posts_count', 6 ),
				'offset'         => get_theme_mod( 'scalernews_hero_count', 3 ), // Skip hero posts
				'orderby'        => 'date',
				'order'          => 'DESC',
			);
			$latest_query = new WP_Query( $latest_args );

			if ( $latest_query->have_posts() ) :
			?>
			<div class="sn-posts-grid">
				<?php
				while ( $latest_query->have_posts() ) :
					$latest_query->the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php endif; ?>
		</section>

		<!-- Featured Category Section -->
		<?php
		$featured_cat = get_theme_mod( 'scalernews_featured_category', '' );
		if ( ! empty( $featured_cat ) ) :
			$cat_obj = get_category( $featured_cat );
			if ( $cat_obj && ! is_wp_error( $cat_obj ) ) :
		?>
		<section class="sn-section sn-section--featured-cat">
			<div class="sn-section-heading">
				<h2 class="sn-section-heading__title"><?php echo esc_html( $cat_obj->name ); ?></h2>
				<span class="sn-section-heading__line"></span>
			</div>

			<?php
			$cat_args = array(
				'posts_per_page' => 4,
				'cat'            => $featured_cat,
				'orderby'        => 'date',
				'order'          => 'DESC',
			);
			$cat_query = new WP_Query( $cat_args );

			if ( $cat_query->have_posts() ) :
			?>
			<div class="sn-posts-grid">
				<?php
				while ( $cat_query->have_posts() ) :
					$cat_query->the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php endif; ?>
		</section>
		<?php
			endif;
		endif;
		?>

		<?php
		/**
		 * Hook: scalernews_after_front_page.
		 */
		do_action( 'scalernews_after_front_page' );
		?>
	</main><!-- #primary -->

	<?php
	if ( get_theme_mod( 'scalernews_homepage_sidebar', true ) ) {
		get_sidebar();
	}
	?>
</div><!-- .sn-content-area -->

<?php
get_footer();
