<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of #content div and all content after.
 * Styled using the injected Stitch Tailwind framework.
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<?php do_action('scalernews_after_content'); ?>

</div><!-- .sn-container -->
</div><!-- #content -->

<?php do_action('scalernews_before_footer'); ?>

<!-- Legacy Widget Area (Pre-Footer) to retain WP functionality without altering Stitch main footer -->
<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')): ?>
	<div class="bg-surface-container py-8 border-t border-outline-variant">
		<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
				<?php if (is_active_sidebar('footer-1')): ?>
					<div><?php dynamic_sidebar('footer-1'); ?></div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-2')): ?>
					<div><?php dynamic_sidebar('footer-2'); ?></div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-3')): ?>
					<div><?php dynamic_sidebar('footer-3'); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<footer id="colophon"
	class="bg-primary dark:bg-tertiary w-full border-t-4 border-secondary dark:border-secondary-container mt-stack-xl"
	role="contentinfo">
	<?php do_action('scalernews_footer'); ?>

	<div
		class="flex flex-col md:flex-row justify-between items-center py-stack-xl px-margin-desktop max-w-container-max mx-auto text-on-primary dark:text-on-tertiary">
		<div class="flex flex-col items-center md:items-start mb-8 md:mb-0">
			<h2 class="font-headline-md text-headline-md mb-2"><?php echo esc_html(get_bloginfo('name')); ?></h2>
			<p class="font-label-caps text-[10px] opacity-60">ESTABLISHED 1894</p>
		</div>
		<div class="flex flex-wrap justify-center gap-8 mb-8 md:mb-0">
			<?php
			if (has_nav_menu('footer')) {
				wp_nav_menu(array(
					'theme_location' => 'footer',
					'menu_class' => 'flex flex-wrap justify-center gap-8',
					'depth' => 1,
					'container' => false,
					'fallback_cb' => false,
				));
			} else {
				?>
				<a class="font-body-md text-body-md text-surface-variant opacity-80 hover:text-secondary-fixed transition-colors"
					href="#">About</a>
				<a class="font-body-md text-body-md text-surface-variant opacity-80 hover:text-secondary-fixed transition-colors"
					href="#">Privacy</a>
				<a class="font-body-md text-body-md text-surface-variant opacity-80 hover:text-secondary-fixed transition-colors"
					href="#">Contact</a>
				<a class="font-body-md text-body-md text-surface-variant opacity-80 hover:text-secondary-fixed transition-colors"
					href="#">Archive</a>
			<?php } ?>
		</div>
		<?php
		$copyright = get_theme_mod('scalernews_footer_copyright', '');
		if (!empty($copyright)) {
			echo '<p class="font-body-md text-body-md opacity-60">' . wp_kses_post($copyright) . '</p>';
		} else {
			?>
			<p class="font-body-md text-body-md opacity-60">© <?php echo esc_html(date_i18n('Y')); ?> THE GAZETTE. ALL
				RIGHTS RESERVED.</p>
		<?php } ?>
	</div>
</footer><!-- #colophon -->

<!-- Removed Bottom Mobile Navigation Shell as per user request -->

<?php do_action('scalernews_after_footer'); ?>

</div><!-- #page -->

<?php do_action('scalernews_after_site'); ?>

<?php if (get_theme_mod('scalernews_totop_enable', true)): ?>
	<?php
	$icon_choice = get_theme_mod('scalernews_totop_icon', 'arrow-up');
	$icon_svg = '';

	switch ($icon_choice) {
		case 'chevron-up':
			$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="text-primary" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>';
			break;
		case 'angle-up':
			$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="text-primary" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15L12 9L6 15"/></svg>';
			break;
		case 'long-arrow':
			$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="text-primary" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>';
			break;
		case 'arrow-up':
		default:
			$icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="text-primary" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>';
			break;
	}
	?>
	<a href="#" id="scroll-to-top"
		class="fixed bottom-20 right-4 p-2 bg-surface border border-outline-variant shadow rounded-full z-40 hidden"
		aria-label="<?php esc_attr_e('Scroll to top', 'scalernews'); ?>" style="display: none;">
		<?php echo $icon_svg; ?>
	</a>
<?php endif; ?>


<?php wp_footer(); ?>
</body>

</html>