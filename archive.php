<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary"
	class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg space-y-stack-xl" role="main">

	<?php if (have_posts()): ?>

		<header class="border-b-2 border-primary pb-4 mb-stack-lg">
			<?php
			the_archive_title('<h1 class="font-headline-lg text-display-xl tracking-tighter uppercase mb-4">', '</h1>');
			$desc = get_the_archive_description();
			if ($desc) {
				echo wp_kses_post(sprintf('<div class="font-body-md text-on-surface-variant max-w-2xl">%s</div>', $desc));
			}
			?>
		</header>

		<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">

			<div class="md:col-span-8">
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-gutter">
					<?php
					while (have_posts()):
						the_post();
						get_template_part('template-parts/content', get_post_type());
					endwhile;
					?>
				</div>

				<nav class="mt-stack-xl font-label-caps text-label-caps"
					aria-label="<?php esc_attr_e('Posts navigation', 'scalernews'); ?>">
					<?php
					the_posts_pagination(array(
						'mid_size' => 2,
						'prev_text' => '<span class="px-4 py-2 border border-outline hover:bg-primary hover:text-on-primary transition-colors">&laquo; PREV</span>',
						'next_text' => '<span class="px-4 py-2 border border-outline hover:bg-primary hover:text-on-primary transition-colors">NEXT &raquo;</span>',
						'class' => 'flex justify-center',
					));
					?>
				</nav>
			</div>

			<aside class="md:col-span-4 space-y-6">
				<h3 class="font-label-caps text-label-caps border-b-2 border-primary pb-1 mb-4 uppercase">Sidebar</h3>
				<?php get_sidebar(); ?>
			</aside>

		</div>

	<?php else: ?>

		<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
			<div class="md:col-span-8">
				<?php get_template_part('template-parts/content', 'none'); ?>
			</div>
			<aside class="md:col-span-4 space-y-6">
				<h3 class="font-label-caps text-label-caps border-b-2 border-primary pb-1 mb-4 uppercase">Sidebar</h3>
				<?php get_sidebar(); ?>
			</aside>
		</div>

	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
