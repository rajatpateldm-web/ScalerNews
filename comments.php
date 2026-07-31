<?php
/**
 * The template for displaying comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if (post_password_required()) {
	return;
}
?>

<section id="comments" class="sn-comments comments-area mt-stack-xl border-t-2 border-primary pt-stack-lg">

	<?php
	/**
	 * Hook: scalernews_before_comments.
	 */
	do_action('scalernews_before_comments');
	?>

	<?php if (have_comments()): ?>
		<div class="flex items-center justify-between mb-stack-md">
			<h3 class="sn-comments__title font-headline-md text-headline-md text-primary uppercase">
				<?php
				$comment_count = get_comments_number();
				printf(
					/* translators: 1: comment count */
					esc_html(_nx('COMMENTS (%1$s)', 'COMMENTS (%1$s)', $comment_count, 'comments title', 'scalernews')),
					number_format_i18n($comment_count)
				);
				?>
			</h3>
		</div>

		<ol class="comment-list list-none p-0 m-0 space-y-stack-md">
			<?php
			wp_list_comments(array(
				'style' => 'ol',
				'short_ping' => true,
				'avatar_size' => 48,
			));
			?>
		</ol>

		<?php
		the_comments_navigation(array(
			'prev_text' => esc_html__('&larr; Older Comments', 'scalernews'),
			'next_text' => esc_html__('Newer Comments &rarr;', 'scalernews'),
		));
		?>

		<?php if (!comments_open()): ?>
			<p class="sn-comments__closed mt-4 text-on-surface-variant font-label-caps">
				<?php esc_html_e('Comments are closed.', 'scalernews'); ?>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	comment_form(array(
		'title_reply' => esc_html__('JOIN THE CONVERSATION', 'scalernews'),
		'title_reply_before' => '<label id="reply-title" class="block font-label-caps text-label-caps text-primary mb-2">',
		'title_reply_after' => '</label>',
		'class_form' => 'border-2 border-primary p-margin-mobile flex flex-col mt-stack-md',
		'comment_field' => '<textarea id="comment" name="comment" class="w-full border border-outline-variant focus:border-primary focus:ring-0 text-body-md p-3 min-h-[100px] mb-4 bg-transparent text-on-surface" placeholder="' . esc_attr__('Share your thoughts respectfully...', 'scalernews') . '" required></textarea>',
		'class_submit' => 'bg-primary text-on-primary font-label-caps text-label-caps px-8 py-3 hover:opacity-90 active:scale-95 transition-all cursor-pointer border-none',
		'submit_field' => '<div class="flex justify-end mt-2">%1$s %2$s</div>',
		'label_submit' => esc_html__('POST COMMENT', 'scalernews'),
	));
	?>

	<?php
	/**
	 * Hook: scalernews_after_comments.
	 */
	do_action('scalernews_after_comments');
	?>

</section><!-- #comments -->