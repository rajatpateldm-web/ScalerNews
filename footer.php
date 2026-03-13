<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

			<?php
			/**
			 * Hook: scalernews_after_content.
			 */
			do_action( 'scalernews_after_content' );
			?>

		</div><!-- .sn-container -->
	</div><!-- #content -->

	<?php
	/**
	 * Hook: scalernews_before_footer.
	 */
	do_action( 'scalernews_before_footer' );
	?>

	<footer id="colophon" class="sn-footer" role="contentinfo">
		<?php
		/**
		 * Hook: scalernews_footer.
		 */
		do_action( 'scalernews_footer' );
		?>

		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
		<div class="sn-footer__widgets">
			<div class="sn-container">
				<div class="sn-footer__widgets-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--sn-space-2xl);">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<div class="sn-footer__widget-area">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<div class="sn-footer__widget-area">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<div class="sn-footer__widget-area">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="sn-footer__bottom">
			<div class="sn-container" style="display:flex; flex-direction:column; align-items:center; gap:var(--sn-space-md); text-align:center;">
				<div class="sn-footer__nav" style="margin-bottom: var(--sn-space-sm);">
					<?php
					if ( has_nav_menu( 'footer' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'menu_class'     => 'sn-footer__menu',
							'depth'          => 1,
							'container'      => false,
						) );
					}
					?>
				</div>
				<div class="sn-footer__copyright">
					<?php
					$copyright = get_theme_mod( 'scalernews_footer_copyright', '' );
					if ( ! empty( $copyright ) ) {
						echo wp_kses_post( $copyright );
					} else {
						printf(
							/* translators: 1: Copyright year, 2: Site name */
							esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'scalernews' ),
							esc_html( date_i18n( 'Y' ) ),
							esc_html( get_bloginfo( 'name' ) )
						);
					}
					?>
					<span class="sn-footer__credit" style="margin-left: 10px; opacity: 0.8;">
						| <?php esc_html_e( 'Powered by', 'scalernews' ); ?> <a href="https://teckscaler.com/" target="_blank" rel="noopener" style="color: inherit; text-decoration: underline;">TeckScaler.com</a>
					</span>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->

	<?php
	/**
	 * Hook: scalernews_after_footer.
	 */
	do_action( 'scalernews_after_footer' );
	?>

</div><!-- #page -->

<?php
/**
 * Hook: scalernews_after_site.
 */
do_action( 'scalernews_after_site' );
?>

<?php if ( get_theme_mod( 'scalernews_totop_enable', true ) ) : ?>
	<?php
		$icon_choice = get_theme_mod( 'scalernews_totop_icon', 'arrow-up' );
		$icon_svg    = '';

		switch ( $icon_choice ) {
			case 'chevron-up':
				$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>';
				break;
			case 'angle-up':
				$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15L12 9L6 15"/></svg>';
				break;
			case 'long-arrow':
				$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>';
				break;
			case 'arrow-up':
			default:
				$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>';
				break;
		}
	?>
	<a href="#" id="scroll-to-top" class="sn-scroll-to-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'scalernews' ); ?>">
		<?php echo $icon_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
