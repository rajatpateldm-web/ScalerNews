<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="sn-no-results" style="text-align:center;padding:var(--sn-space-3xl) 0;">
	<header class="sn-no-results__header">
		<h1 class="sn-no-results__title"><?php esc_html_e( 'Nothing Found', 'scalernews' ); ?></h1>
	</header>

	<div class="sn-no-results__content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
				<?php
				printf(
					/* translators: 1: link to create new post */
					wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'scalernews' ), array( 'a' => array( 'href' => array() ) ) ),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'scalernews' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'scalernews' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
