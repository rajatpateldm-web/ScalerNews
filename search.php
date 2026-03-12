<?php
/**
 * The template for displaying search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

		<header class="sn-archive-header">
			<h1 class="sn-archive-header__title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search Results for: %s', 'scalernews' ),
					'<span>' . get_search_query() . '</span>'
				);
				?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>

		<div class="sn-search-results">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;
			?>
		</div>

		<nav class="sn-pagination" aria-label="<?php esc_attr_e( 'Search results navigation', 'scalernews' ); ?>">
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

	</main><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .sn-content-area -->

<?php
get_footer();
