<?php
/**
 * The front page template
 *
 * Displays the news homepage with hero banner, category sections, and sidebar.
 * Styled using the injected Stitch Tailwind framework.
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary"
	class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg space-y-stack-xl" role="main">
	<?php do_action('scalernews_before_front_page'); ?>

	<!-- Hero Section & Sidebar -->
	<section class="grid grid-cols-1 md:grid-cols-12 gap-gutter">

		<!-- Left Col: Top Story (Latest Post) -->
		<div class="md:col-span-8">
			<?php
			$hero_args = array(
				'posts_per_page' => 1,
				'ignore_sticky_posts' => 1,
			);
			$hero_query = new WP_Query($hero_args);
			if ($hero_query->have_posts()):
				while ($hero_query->have_posts()):
					$hero_query->the_post();
					?>
					<article <?php post_class('group cursor-pointer'); ?>>
						<div class="relative overflow-hidden mb-4 aspect-video bg-surface-container">
							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail()): ?>
									<?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105')); ?>
								<?php else: ?>
									<div
										class="w-full h-full bg-surface-variant transition-transform duration-500 group-hover:scale-105">
									</div>
								<?php endif; ?>
							</a>
							<div class="absolute top-4 left-4">
								<span class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-1 uppercase">Top
									Story</span>
							</div>
						</div>
						<h2
							class="font-headline-lg text-headline-lg-mobile md:text-headline-lg mb-3 leading-tight decoration-primary group-hover:underline">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						<div class="font-body-lg text-body-lg text-on-surface-variant mb-4 line-clamp-3">
							<?php the_excerpt(); ?>
						</div>
						<div class="flex items-center space-x-4">
							<span
								class="font-label-caps text-label-caps text-secondary font-bold uppercase"><?php $cats = get_the_category();
								if (!empty($cats))
									echo esc_html($cats[0]->name);
								else
									echo 'NEWS'; ?></span>
							<span class="text-outline text-xs">&bull;</span>
							<span
								class="font-label-caps text-label-caps text-on-surface-variant opacity-70 uppercase"><?php echo get_the_date(); ?></span>
						</div>
					</article>
				<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>

		<!-- Right Col: Sidebar Top Stories / Native Widgets -->
		<aside class="md:col-span-4 space-y-6">
			<h3 class="font-label-caps text-label-caps border-b-2 border-primary pb-1 mb-4 uppercase">Sidebar</h3>
			<?php
			if (get_theme_mod('scalernews_homepage_sidebar', true)) {
				get_sidebar();
			}
			?>

			<!-- Advertisement Space Replica -->
			<div
				class="bg-surface-container-highest p-6 border border-outline-variant flex flex-col items-center text-center mt-8">
				<span class="font-label-caps text-[10px] text-outline mb-2">ADVERTISEMENT</span>
				<p class="font-headline-md text-[20px] mb-4">Invest in the Future of Clean Energy.</p>
				<button
					class="border-2 border-primary text-primary font-label-caps text-label-caps px-4 py-1 hover:bg-primary hover:text-on-primary transition-all">LEARN
					MORE</button>
			</div>
		</aside>

	</section>

	<!-- Video Reports (Converted to Latest News Grid) -->
	<?php
	$latest_args = array(
		'posts_per_page' => 4,
		'offset' => 1, // Skip the hero post
		'ignore_sticky_posts' => 1,
	);
	$latest_query = new WP_Query($latest_args);
	if ($latest_query->have_posts()):
		?>
		<section class="bg-primary p-margin-desktop text-on-primary">
			<div class="flex justify-between items-center mb-stack-lg border-b border-on-primary/20 pb-2">
				<h3 class="font-label-caps text-headline-md uppercase tracking-widest flex items-center">
					<span class="material-symbols-outlined mr-2" data-icon="play_circle">play_circle</span> Latest News
				</h3>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
				<?php while ($latest_query->have_posts()):
					$latest_query->the_post(); ?>
					<article class="group cursor-pointer">
						<div class="relative aspect-video bg-tertiary-container mb-3 overflow-hidden">
							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail()): ?>
									<?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all')); ?>
								<?php else: ?>
									<div
										class="w-full h-full bg-surface-variant opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all">
									</div>
								<?php endif; ?>
							</a>
						</div>
						<h5 class="font-body-md font-bold leading-tight line-clamp-2"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					</article>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- Opinion Section (Converted to Featured Category) -->
	<?php
	$featured_cat = get_theme_mod('scalernews_featured_category', '');
	if (!empty($featured_cat)):
		$cat_obj = get_category($featured_cat);
		if ($cat_obj && !is_wp_error($cat_obj)):
			$cat_args = array(
				'posts_per_page' => 4,
				'cat' => $featured_cat,
			);
			$cat_query = new WP_Query($cat_args);

			if ($cat_query->have_posts()):
				?>
				<section class="grid grid-cols-1 md:grid-cols-3 gap-gutter py-stack-lg border-y border-outline-variant">
					<div class="md:col-span-1">
						<h3 class="font-headline-lg italic border-b-4 border-secondary inline-block mb-8">
							<?php echo esc_html($cat_obj->name); ?></h3>
						<?php $desc = category_description($featured_cat);
						if ($desc): ?>
							<div class="font-body-md text-on-surface-variant mb-6"><?php echo wp_kses_post($desc); ?></div>
						<?php endif; ?>
					</div>
					<div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-8">
						<?php while ($cat_query->have_posts()):
							$cat_query->the_post(); ?>
							<article class="flex flex-col space-y-4 group cursor-pointer">
								<div class="flex items-center space-x-4">
									<div class="w-16 h-16 rounded-full overflow-hidden bg-surface-variant">
										<a href="<?php get_author_posts_url(get_the_author_meta('ID')); ?>">
											<?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('class' => 'w-full h-full object-cover')); ?>
										</a>
									</div>
									<div>
										<span
											class="font-label-caps text-label-caps font-bold uppercase"><?php echo get_the_author(); ?></span>
										<span class="block text-xs text-outline italic"><?php echo get_the_date(); ?></span>
									</div>
								</div>
								<h4
									class="font-headline-md text-[22px] leading-tight group-hover:text-secondary transition-colors italic">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
							</article>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</div>
				</section>
			<?php
			endif;
		endif;
	endif;
	?>

	<!-- Newsletter / Promotion Static Block -->
	<section class="bg-surface-container py-stack-xl px-margin-desktop text-center border-2 border-primary">
		<h2 class="font-display-xl text-[32px] md:text-display-xl mb-4 text-primary uppercase">Information is Agency
		</h2>
		<p class="max-w-2xl mx-auto font-body-lg text-body-lg text-on-surface-variant mb-8">Get the morning edition of
			The Gazette delivered directly to your inbox. No fluff, no bias, just the facts that matter.</p>
		<form class="flex flex-col md:flex-row max-w-lg mx-auto gap-4" onsubmit="event.preventDefault();">
			<input
				class="flex-grow border border-outline px-4 py-3 font-label-caps focus:border-primary focus:ring-0 outline-none uppercase text-xs"
				placeholder="ENTER YOUR EMAIL" type="email" style="background-color: white; color: black;" />
			<button
				class="bg-primary text-on-primary font-label-caps text-label-caps px-8 py-3 hover:opacity-90 transition-all uppercase tracking-widest"
				type="submit">SIGN UP</button>
		</form>
	</section>

	<?php do_action('scalernews_after_front_page'); ?>

</main><!-- #primary -->

<?php
get_footer();

