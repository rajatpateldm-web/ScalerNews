<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="sn-sidebar widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'scalernews' ); ?>">
	<div class="sn-sidebar__inner">
		<?php
		/**
		 * Hook: scalernews_before_sidebar.
		 */
		do_action( 'scalernews_before_sidebar' );

		dynamic_sidebar( 'sidebar-1' );

		/**
		 * Hook: scalernews_after_sidebar.
		 */
		do_action( 'scalernews_after_sidebar' );
		?>
	</div>
</aside><!-- #secondary -->
