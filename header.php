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
	<link
		href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400..900;1,400..900&amp;family=Libre+Franklin:ital,wght@0,100..900;1,100..900&amp;family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&amp;display=swap"
		rel="stylesheet" />
	<link
		href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
		rel="stylesheet" />
	<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
	<script id="tailwind-config">
		tailwind.config = {
			darkMode: "class",
			theme: {
				extend: {
					"colors": {
						"primary-container": "#1a2b3c",
						"secondary-fixed": "#ffdad6",
						"surface-variant": "#e1e3e4",
						"on-tertiary-fixed-variant": "#3c475a",
						"on-secondary-fixed-variant": "#930010",
						"on-surface-variant": "#44474c",
						"background": "#f8f9fa",
						"surface-container-low": "#f3f4f5",
						"primary-fixed-dim": "#b7c8de",
						"on-tertiary": "#ffffff",
						"error-container": "#ffdad6",
						"tertiary-container": "#1f2a3b",
						"surface-container": "#edeeef",
						"surface-bright": "#f8f9fa",
						"on-error": "#ffffff",
						"on-tertiary-container": "#8691a6",
						"primary-fixed": "#d2e4fb",
						"secondary-container": "#da3433",
						"on-primary": "#ffffff",
						"surface": "#f8f9fa",
						"on-error-container": "#93000a",
						"inverse-primary": "#b7c8de",
						"surface-container-lowest": "#ffffff",
						"surface-dim": "#d9dadb",
						"tertiary": "#0a1526",
						"on-primary-fixed-variant": "#38485a",
						"on-primary-container": "#8192a7",
						"surface-container-high": "#e7e8e9",
						"on-primary-fixed": "#0b1d2d",
						"inverse-on-surface": "#f0f1f2",
						"tertiary-fixed": "#d8e3fa",
						"on-tertiary-fixed": "#111c2c",
						"outline-variant": "#c4c6cd",
						"secondary-fixed-dim": "#ffb3ac",
						"on-secondary-container": "#fffbff",
						"surface-container-highest": "#e1e3e4",
						"on-secondary": "#ffffff",
						"secondary": "#b6171e",
						"surface-tint": "#4f6073",
						"error": "#ba1a1a",
						"outline": "#74777d",
						"on-surface": "#191c1d",
						"tertiary-fixed-dim": "#bcc7dd",
						"on-secondary-fixed": "#410003",
						"inverse-surface": "#2e3132",
						"on-background": "#191c1d",
						"primary": "#041627"
					},
					"borderRadius": {
						"DEFAULT": "0.25rem",
						"lg": "0.5rem",
						"xl": "0.75rem",
						"full": "9999px"
					},
					"spacing": {
						"stack-md": "16px",
						"container-max": "1280px",
						"stack-xl": "64px",
						"margin-mobile": "16px",
						"stack-lg": "32px",
						"margin-desktop": "32px",
						"stack-sm": "8px",
						"gutter": "24px"
					},
					"fontFamily": {
						"headline-lg": ["Bodoni Moda"],
						"body-lg": ["Libre Franklin"],
						"headline-md": ["Bodoni Moda"],
						"label-caps": ["Archivo Narrow"],
						"body-md": ["Libre Franklin"],
						"headline-lg-mobile": ["Bodoni Moda"],
						"display-xl": ["Bodoni Moda"]
					},
					"fontSize": {
						"headline-lg": ["40px", { "lineHeight": "1.2", "fontWeight": "700" }],
						"body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
						"headline-md": ["28px", { "lineHeight": "1.3", "fontWeight": "700" }],
						"label-caps": ["12px", { "lineHeight": "1.0", "letterSpacing": "0.05em", "fontWeight": "700" }],
						"body-md": ["16px", { "lineHeight": "1.5", "fontWeight": "400" }],
						"headline-lg-mobile": ["32px", { "lineHeight": "1.2", "fontWeight": "700" }],
						"display-xl": ["64px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800" }]
					}
				},
			},
		}
	</script>
	<style>
		.ticker-scroll {
			animation: ticker 30s linear infinite;
		}

		@media (prefers-reduced-motion: reduce) {
			.ticker-scroll {
				animation: none;
			}
		}

		@keyframes ticker {
			0% {
				transform: translateX(100%);
			}

			100% {
				transform: translateX(-100%);
			}
		}

		.material-symbols-outlined {
			font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
		}

		body {
			background-color: #f8f9fa;
			color: #191c1d;
		}

		/* Add targeted styling for standard wp_nav_menu output */
		#primary-menu li a {
			color: #44474c;
			/* text-on-surface-variant */
			font-family: 'Archivo Narrow', sans-serif;
			font-size: 12px;
			font-weight: 700;
			line-height: 1;
			letter-spacing: 0.05em;
			text-transform: uppercase;
			transition: color 0.2s;
		}

		#primary-menu li a:hover {
			color: #041627;
			/* text-primary */
		}
	</style>
</head>

<body <?php body_class('bg-background text-on-background'); ?>>
	<?php wp_body_open(); ?>

	<?php do_action('scalernews_before_site'); ?>

	<div id="page" class="site bg-background text-on-background">
		<a class="skip-link screen-reader-text"
			href="#primary"><?php esc_html_e('Skip to content', 'scalernews'); ?></a>

		<?php do_action('scalernews_before_header'); ?>

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
			$breaking_args = array('posts_per_page' => 5, 'orderby' => 'date', 'order' => 'DESC');
			$breaking_query = new WP_Query($breaking_args);
		}

		if ($breaking_query->have_posts()):
			?>
			<div class="w-full bg-secondary text-on-secondary py-2 overflow-hidden whitespace-nowrap z-[60] sticky top-0">
				<div class="flex items-center">
					<span
						class="px-4 font-label-caps text-label-caps bg-secondary font-bold z-10 uppercase shrink-0">Breaking
						News</span>
					<div class="ticker-scroll flex space-x-12 font-label-caps text-label-caps items-center">
						<?php while ($breaking_query->have_posts()):
							$breaking_query->the_post(); ?>
							<a href="<?php the_permalink(); ?>"
								class="text-on-secondary hover:underline"><?php the_title(); ?></a>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Top App Bar -->
		<header id="masthead" class="bg-surface border-b-2 border-primary docked full-width z-50">
			<div class="flex flex-col w-full px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto py-4">
				<div class="flex justify-between items-center mb-4">
					<button
						class="material-symbols-outlined text-primary p-2 hover:bg-surface-variant transition-colors"
						data-icon="menu">menu</button>
					<h1
						class="font-headline-lg-mobile text-headline-lg-mobile md:text-headline-lg font-bold text-primary uppercase tracking-tighter">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo esc_html(get_bloginfo('name')); ?></a>
					</h1>
					<button
						class="bg-primary text-on-primary font-label-caps text-label-caps px-6 py-2 transition-all active:scale-95">SUBSCRIBE</button>
				</div>
				<!-- Desktop Navigation Links -->
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'menu_class' => 'hidden md:flex justify-center space-x-8 pb-2',
					'container' => 'nav',
					'fallback_cb' => 'scalernews_primary_menu_fallback',
				));
				?>
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content">
			<div class="sn-container">
				<?php do_action('scalernews_before_content'); ?>