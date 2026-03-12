<?php
/**
 * The header for ScalerNews theme
 *
 * Displays all of the <head> section and everything up until main content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
/**
 * Hook: scalernews_before_site.
 */
do_action( 'scalernews_before_site' );
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'scalernews' ); ?>
	</a>

	<?php
	/**
	 * Hook: scalernews_before_header.
	 */
	do_action( 'scalernews_before_header' );
	?>

	<!-- Top Bar -->
	<div class="sn-header__top-bar">
		<div class="sn-container">
			<div class="sn-header__date">
				<?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?>
			</div>
			<div class="sn-header__top-links">
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'sn-social-menu',
						'depth'          => 1,
						'container'      => false,
					) );
					?>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Main Header -->
	<header id="masthead" class="sn-header" role="banner">
		<?php
		/**
		 * Hook: scalernews_header.
		 */
		do_action( 'scalernews_header' );
		?>

		<div class="sn-header__main">
			<div class="sn-container">
				<div class="sn-header__branding">
					<?php if ( has_custom_logo() ) : ?>
						<div class="sn-header__logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php endif; ?>
					<div class="sn-header__titles">
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="sn-header__site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php
									$site_title = get_bloginfo( 'name' );
									// Split "ScalerNews" to color "News" differently
									if ( strpos( $site_title, 'News' ) !== false ) {
										$parts = explode( 'News', $site_title, 2 );
										echo esc_html( $parts[0] ) . '<span>News</span>';
									} else {
										echo esc_html( $site_title );
									}
									?>
								</a>
							</h1>
						<?php else : ?>
							<p class="sn-header__site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php
									$site_title = get_bloginfo( 'name' );
									if ( strpos( $site_title, 'News' ) !== false ) {
										$parts = explode( 'News', $site_title, 2 );
										echo esc_html( $parts[0] ) . '<span>News</span>';
									} else {
										echo esc_html( $site_title );
									}
									?>
								</a>
							</p>
						<?php endif; ?>

						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
						?>
							<p class="sn-header__tagline"><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>
					</div>
				</div>

				<?php
				/**
				 * Hook: scalernews_header_ad.
				 * Used for ad space in the header area.
				 */
				do_action( 'scalernews_header_ad' );
				?>
			</div>
		</div>
	</header><!-- #masthead -->

	<!-- Primary Navigation -->
	<nav id="site-navigation" class="sn-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'scalernews' ); ?>">
		<div class="sn-container">
			<button class="sn-nav__toggle" aria-controls="primary-menu" aria-expanded="false">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
				<?php esc_html_e( 'Menu', 'scalernews' ); ?>
			</button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'sn-nav__menu',
				'container'      => false,
				'fallback_cb'    => false,
			) );
			?>
			<div class="sn-nav__search">
				<button class="sn-nav__search-toggle" aria-label="<?php esc_attr_e( 'Open search', 'scalernews' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				</button>
			</div>
		</div>
	</nav><!-- #site-navigation -->

	<?php
	/**
	 * Hook: scalernews_after_header.
	 *
	 * @hooked scalernews_breaking_news_ticker - 10
	 */
	do_action( 'scalernews_after_header' );
	?>

	<!-- Breaking News Ticker -->
	<?php if ( get_theme_mod( 'scalernews_breaking_news', true ) ) : ?>
		<?php
		$breaking_args = array(
			'posts_per_page' => 5,
			'meta_key'       => '_scalernews_breaking',
			'meta_value'     => '1',
			'orderby'        => 'date',
			'order'          => 'DESC',
		);
		$breaking_query = new WP_Query( $breaking_args );

		// Fallback to latest posts if no breaking news tagged.
		if ( ! $breaking_query->have_posts() ) {
			$breaking_args = array(
				'posts_per_page' => 5,
				'orderby'        => 'date',
				'order'          => 'DESC',
			);
			$breaking_query = new WP_Query( $breaking_args );
		}

		if ( $breaking_query->have_posts() ) :
		?>
		<div class="sn-breaking-news">
			<div class="sn-container sn-breaking-news__inner">
				<span class="sn-breaking-news__label"><?php esc_html_e( 'Breaking', 'scalernews' ); ?></span>
				<div class="sn-breaking-news__ticker">
					<div class="sn-breaking-news__ticker-track">
						<?php while ( $breaking_query->have_posts() ) : $breaking_query->the_post(); ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="sn-container">

			<?php
			/**
			 * Hook: scalernews_before_content.
			 *
			 * @hooked scalernews_breadcrumbs - 10
			 */
			do_action( 'scalernews_before_content' );
			?>
