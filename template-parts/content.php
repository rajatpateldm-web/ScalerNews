<?php
/**
 * Template part for displaying post cards in loops
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group cursor-pointer mb-8'); ?>>
	<?php if (has_post_thumbnail()): ?>
		<div class="relative aspect-video bg-surface-container mb-4 overflow-hidden shadow-sm">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
			</a>
			<?php
			$categories = get_the_category();
			if (!empty($categories)):
				?>
				<a class="absolute top-2 left-2 bg-primary text-on-primary font-label-caps text-[10px] px-2 py-1 uppercase tracking-wider"
					href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
					<?php echo esc_html($categories[0]->name); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php else: ?>
		<div
			class="relative aspect-video bg-surface-variant mb-4 overflow-hidden rounded group-hover:opacity-90 transition-opacity">
			<?php
			$categories = get_the_category();
			if (!empty($categories)):
				?>
				<a class="absolute top-2 left-2 bg-primary text-on-primary font-label-caps text-[10px] px-2 py-1 uppercase tracking-wider"
					href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
					<?php echo esc_html($categories[0]->name); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="flex flex-col">
		<div
			class="flex items-center space-x-2 font-label-caps text-[10px] text-on-surface-variant uppercase mb-2 tracking-wide font-bold">
			<span><?php echo esc_html(get_the_date()); ?></span>
			<span class="text-outline">&bull;</span>
			<span class="flex items-center gap-1">
				<span class="material-symbols-outlined text-[14px]" data-icon="schedule">schedule</span>
				<?php echo esc_html(scalernews_reading_time()); ?>
			</span>
		</div>
		<h3 class="font-headline-md text-[22px] leading-tight mb-2 group-hover:underline decoration-primary">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<p class="font-body-md text-on-surface-variant line-clamp-3 leading-relaxed">
			<?php echo esc_html(get_the_excerpt()); ?>
		</p>
	</div>
</article>