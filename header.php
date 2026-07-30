<?php
/**
 * The header for ScalerNews theme
 *
 * @package ScalerNews
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<style>
		/* Ensure header is not sticky but nav IS sticky */
		.sn-header {
			position: relative !important;
			top: auto !important;
			z-index: 99 !important;
		}

		.sn-nav {
			position: sticky !important;
			top: 0 !important;
			z-index: 1000 !important;
			box-shadow: var(--sn-shadow-md);
		}
	</style>
</head>

<body <?php body_class('has-sticky-menu'); ?>>
	<?php wp_body_open(); ?>

	<?php do_action('scalernews_before_site'); ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text"
			href="#primary"><?php esc_html_e('Skip to content', 'scalernews'); ?></a>

		<?php do_action('scalernews_before_header'); ?>

		<!-- Top Bar -->
		<div class="sn-header__top-bar">
			<div class="sn-container">
				<div class="sn-header__date"><?php echo esc_html(date_i18n(get_option('date_format'))); ?></div>
				<div class="sn-header__top-links">
					<?php if (has_nav_menu('social')): ?>
						<?php wp_nav_menu(array('theme_location' => 'social', 'menu_class' => 'sn-social-menu', 'depth' => 1, 'container' => false)); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- Main Header -->
		<header id="masthead" class="sn-header" role="banner">
			<div class="sn-header__main">
				<div class="sn-container"
					style="display: flex; align-items: center; justify-content: flex-start; gap: 16px;">
					<div class="sn-header__branding" style="display: flex; align-items: center; gap: 12px; margin: 0;">
						<div class="sn-header__logo-placeholder"
							style="width: 48px; height: 48px; min-width: 48px; background-color: var(--sn-color-primary); border-radius: 4px; display: flex; align-items: center; justify-content: center;">
							<svg width="24" height="24" fill="none" stroke="var(--sn-color-white)" stroke-width="2"
								viewBox="0 0 24 24">
								<path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8l-4 4v14a2 2 0 0 0 2 2z"></path>
								<path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
								<path d="M12 18v-6"></path>
								<path d="M9 15h6"></path>
							</svg>
						</div>
						<div class="sn-header__titles">
							<h1 class="sn-header__site-title" style="margin: 0; line-height: 1;">
								<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
									scaler<span>news</span>
								</a>
							</h1>
							<?php
							$description = get_bloginfo('description', 'display');
							if ($description):
								?>
								<p class="sn-header__tagline" style="margin: 0; font-size: 0.85em; opacity: 0.8;">
									<?php echo esc_html($description); ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->

		<!-- Primary Navigation (Sticky) -->
		<nav id="site-navigation" class="sn-nav" role="navigation"
			aria-label="<?php esc_attr_e('Primary Navigation', 'scalernews'); ?>">
			<div class="sn-container" style="display: flex; align-items: center; justify-content: flex-start;">
				<button class="sn-nav__toggle" aria-controls="primary-menu" aria-expanded="false"
					style="display: flex; align-items: center; gap: 8px;">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="3" y1="12" x2="21" y2="12" />
						<line x1="3" y1="6" x2="21" y2="6" />
						<line x1="3" y1="18" x2="21" y2="18" />
					</svg>
					<?php esc_html_e('Menu', 'scalernews'); ?>
				</button>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'menu_class' => 'sn-nav__menu',
					'container' => false,
					'fallback_cb' => 'scalernews_primary_menu_fallback',
				));
				?>
			</div>
		</nav><!-- #site-navigation -->

		<?php do_action('scalernews_after_header'); ?>

		<!-- Breaking News Ticker -->
		<?php
		$breaking_args = array(
			'posts_per_page' => 5,
			'category_name' => 'breaking',
			'orderby' => 'date',
			'order' => 'DESC',
		);
		$breaking_query = new WP_Query($breaking_args);

		if (!$breaking_query->have_posts()) {
			$breaking_args = array(
				'posts_per_page' => 5,
				'orderby' => 'date',
				'order' => 'DESC',
			);
			$breaking_query = new WP_Query($breaking_args);
		}

		if ($breaking_query->have_posts()):
			?>
			<div class="sn-breaking-news"
				style="background-color: var(--sn-color-primary); color: white; display: flex; align-items: center;">
				<div class="sn-container sn-breaking-news__inner"
					style="width: 100%; display: flex; align-items: center; gap: 16px; overflow: hidden; padding: 4px 16px;">
					<span class="sn-breaking-news__label"
						style="background-color: var(--sn-color-secondary); color: white; padding: 4px 12px; border-radius: 4px; font-weight: bold; text-transform: uppercase; font-size: 0.75rem; white-space: nowrap;">Breaking</span>
					<div class="sn-breaking-news__ticker" style="flex: 1; overflow: hidden; white-space: nowrap;">
						<div class="sn-breaking-news__ticker-track"
							style="display: inline-block; animation: ticker 20s linear infinite;">
							<?php while ($breaking_query->have_posts()):
								$breaking_query->the_post(); ?>
								<a href="<?php the_permalink(); ?>"
									style="color: white; margin-right: 32px; font-size: 0.9rem; font-weight: 500; text-decoration: none;"><?php the_title(); ?></a>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<?php wp_reset_postdata(); endif; ?>

		<div id="content" class="site-content">
			<div class="sn-container">
				<?php do_action('scalernews_before_content'); ?>