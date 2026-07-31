<?php
/**
 * Template part for displaying single post content
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-stack-lg pb-8'); ?>>

	<?php
	$fi_display = get_theme_mod('scalernews_single_featured_image', 'content');
	if ('hidden' !== $fi_display && has_post_thumbnail()):
		?>
		<div class="relative w-full aspect-video bg-surface-container mb-stack-lg overflow-hidden">
			<?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
			<?php
			$caption = get_the_post_thumbnail_caption();
			if ($caption):
				?>
				<div class="absolute bottom-0 w-full bg-black/60 text-white p-2">
					<p class="font-label-caps text-label-caps m-0"><?php echo esc_html($caption); ?></p>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<header class="mb-stack-lg">
		<?php
		$categories = get_the_category();
		if (!empty($categories)):
			?>
			<a class="inline-block bg-primary text-on-primary font-label-caps text-label-caps px-3 py-1 uppercase mb-4"
				href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
				<?php echo esc_html($categories[0]->name); ?>
			</a>
		<?php endif; ?>

		<?php the_title('<h1 class="font-headline-lg text-[40px] md:text-display-xl tracking-tighter uppercase mb-4 leading-tight">', '</h1>'); ?>

		<div
			class="font-label-caps text-label-caps flex flex-wrap items-center gap-4 mb-8 text-on-surface-variant uppercase border-y border-outline-variant py-3">
			<?php
			$show_author = get_theme_mod('scalernews_single_show_author', true);
			if ($show_author):
				?>
				<span class="flex items-center gap-2">
					<span class="material-symbols-outlined text-[16px]" data-icon="edit">edit</span>
					<?php
					printf(
						/* translators: %s: post author */
						esc_html__('By %s', 'scalernews'),
						'<a class="hover:text-primary transition-colors font-bold" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
					);
					?>
				</span>
				<span class="text-outline">&bull;</span>
			<?php endif; ?>

			<span class="flex items-center gap-2">
				<span class="material-symbols-outlined text-[16px]" data-icon="calendar_today">calendar_today</span>
				<time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
					<?php echo esc_html(get_the_date()); ?>
				</time>
			</span>
			<span class="text-outline">&bull;</span>

			<span class="flex items-center gap-2">
				<span class="material-symbols-outlined text-[16px]" data-icon="schedule">schedule</span>
				<?php echo esc_html(scalernews_reading_time()); ?>
			</span>

			<?php if (comments_open()): ?>
				<span class="text-outline">&bull;</span>
				<span class="flex items-center gap-2">
					<span class="material-symbols-outlined text-[16px]" data-icon="chat_bubble">chat_bubble</span>
					<?php comments_popup_link(
						esc_html__('0 Comments', 'scalernews'),
						esc_html__('1 Comment', 'scalernews'),
						esc_html__('% Comments', 'scalernews')
					); ?>
				</span>
			<?php endif; ?>
		</div>
	</header>

	<div class="font-body-lg text-body-lg leading-relaxed text-on-background entry-content editorial-dropcap">
		<?php
		the_content(sprintf(
			/* translators: %s: Name of current post. Only visible to screen readers */
			wp_kses(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'scalernews'), array('span' => array('class' => array()))),
			wp_kses_post(get_the_title())
		));

		wp_link_pages(array(
			'before' => '<div class="page-links font-label-caps mt-8">' . esc_html__('Pages:', 'scalernews'),
			'after' => '</div>',
		));
		?>

		<!-- Related Data Info Box -->
		<div class="my-stack-lg bg-surface-container-low p-margin-desktop border border-outline-variant">
			<h4 class="font-label-caps text-label-caps text-secondary mb-2 uppercase">Related Data</h4>
			<div class="overflow-x-auto">
				<table class="w-full text-left font-label-caps text-label-caps border-collapse">
					<thead>
						<tr class="border-b border-outline">
							<th class="py-2">Metric</th>
							<th class="py-2">Value</th>
							<th class="py-2">Trend</th>
						</tr>
					</thead>
					<tbody>
						<tr class="border-b border-outline-variant/30 hover:bg-surface-variant/50 transition-colors">
							<td class="py-3">Page Views</td>
							<td class="py-3">124k</td>
							<td class="py-3 text-secondary">+14%</td>
						</tr>
						<tr class="border-b border-outline-variant/30 hover:bg-surface-variant/50 transition-colors">
							<td class="py-3">Engagement Score</td>
							<td class="py-3">8.2/10</td>
							<td class="py-3 text-secondary">+0.4%</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<footer class="mt-stack-lg border-t border-outline-variant pt-6">
		<div class="flex flex-col md:flex-row justify-between items-center gap-4">
			<?php
			$tags_list = get_the_tag_list('', ' ');
			if ($tags_list):
				?>
				<div class="font-label-caps text-label-caps flex gap-2 items-center flex-wrap">
					<span class="material-symbols-outlined" data-icon="tag">tag</span>
					<?php echo str_replace('a href', 'a class="bg-surface-variant hover:bg-primary hover:text-on-primary px-3 py-1 rounded transition-colors" href', $tags_list); ?>
				</div>
			<?php else: ?>
				<div></div>
			<?php endif; ?>



			<?php if (get_edit_post_link()): ?>
				<div class="mt-6 font-label-caps text-[10px] text-primary">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(__('Edit <span class="screen-reader-text">%s</span>', 'scalernews'), array('span' => array('class' => array()))),
							wp_kses_post(get_the_title())
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</div>
			<?php endif; ?>

			<?php do_action('scalernews_single_post_footer'); ?>
	</footer>
</article>