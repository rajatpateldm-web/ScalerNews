<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

		<section class="sn-error-404" style="text-align:center;padding:var(--sn-space-3xl) 0;">
			<header class="sn-error-404__header">
				<h1 class="sn-error-404__title" style="font-size:6rem;color:var(--sn-color-primary);margin-bottom:var(--sn-space-md);">
					<?php esc_html_e( '404', 'scalernews' ); ?>
				</h1>
				<h2 style="margin-bottom:var(--sn-space-lg);">
					<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'scalernews' ); ?>
				</h2>
				<p style="color:var(--sn-color-text-secondary);max-width:500px;margin:0 auto var(--sn-space-xl);">
					<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search or check out the latest news below.', 'scalernews' ); ?>
				</p>
			</header>

			<div class="sn-error-404__search" style="max-width:500px;margin:0 auto var(--sn-space-2xl);">
				<?php get_search_form(); ?>
			</div>

			<div class="sn-error-404__latest">
				<div class="sn-section-heading" style="justify-content:center;">
					<h3 class="sn-section-heading__title"><?php esc_html_e( 'Latest News', 'scalernews' ); ?></h3>
				</div>

				<?php
				$latest = new WP_Query( array(
					'posts_per_page' => 3,
					'orderby'        => 'date',
					'order'          => 'DESC',
				) );

				if ( $latest->have_posts() ) :
				?>
				<div class="sn-posts-grid" style="max-width:960px;margin:0 auto;">
					<?php
					while ( $latest->have_posts() ) :
						$latest->the_post();
						get_template_part( 'template-parts/post-card' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php endif; ?>
			</div>
		</section>

	</main><!-- #primary -->
</div><!-- .sn-content-area -->

<?php
get_footer();
