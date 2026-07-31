<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg" role="main">
	<?php do_action('scalernews_before_single'); ?>

	<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">

		<div class="md:col-span-8">
			<?php
			while (have_posts()):
				the_post();

				get_template_part('template-parts/content', 'single');

				// Post navigation.
				the_post_navigation(array(
					'prev_text' => '<span class="nav-subtitle font-label-caps text-label-caps uppercase opacity-60 block mb-1">' . esc_html__('Previous', 'scalernews') . '</span> <span class="nav-title font-headline-md text-primary hover:underline">%title</span>',
					'next_text' => '<span class="nav-subtitle font-label-caps text-label-caps uppercase opacity-60 block mb-1 text-right">' . esc_html__('Next', 'scalernews') . '</span> <span class="nav-title font-headline-md text-primary hover:underline block text-right">%title</span>',
					'class' => 'border-t border-b border-outline-variant py-8 my-8 flex justify-between'
				));

				// Related posts.
				do_action('scalernews_related_posts');

				// Comments.
				if (comments_open() || get_comments_number()):
					comments_template();
				endif;

			endwhile;
			?>
		</div>

		<aside class="md:col-span-4 space-y-6">
			<h3 class="font-label-caps text-label-caps border-b-2 border-primary pb-1 mb-4 uppercase">Sidebar</h3>
			<?php get_sidebar(); ?>
		</aside>

	</div>

	<?php do_action('scalernews_after_single'); ?>
</main><!-- #primary -->

<?php
get_footer();
