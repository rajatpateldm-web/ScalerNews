<?php
/**
 * Template part for displaying search results
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sn-search-result' ); ?> style="display:flex;gap:var(--sn-space-lg);padding:var(--sn-space-lg);border-bottom:1px solid var(--sn-color-gray-200);">
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="sn-search-result__thumbnail" style="flex-shrink:0;width:180px;">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'scalernews-thumbnail', array( 'style' => 'border-radius:var(--sn-border-radius);width:100%;height:auto;' ) ); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="sn-search-result__body">
		<header>
			<?php the_title( '<h3 class="sn-search-result__title" style="margin-bottom:var(--sn-space-sm);"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
		</header>
		<div class="sn-search-result__excerpt" style="color:var(--sn-color-text-secondary);font-size:var(--sn-text-sm);margin-bottom:var(--sn-space-sm);">
			<?php the_excerpt(); ?>
		</div>
		<div class="sn-search-result__meta" style="font-size:var(--sn-text-xs);color:var(--sn-color-text-light);">
			<span><?php echo esc_html( get_the_date() ); ?></span>
			<span>&middot;</span>
			<span><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
		</div>
	</div>
</article>
