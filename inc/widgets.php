<?php
/**
 * ScalerNews Widget Areas
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register widget areas.
 */
function scalernews_widgets_init() {
	// Main Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'scalernews' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in the sidebar.', 'scalernews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Header Ad Space
	register_sidebar( array(
		'name'          => esc_html__( 'Header Ad Space', 'scalernews' ),
		'id'            => 'header-ad',
		'description'   => esc_html__( 'Ad banner area in the header (recommended: 728x90).', 'scalernews' ),
		'before_widget' => '<div id="%1$s" class="widget sn-header-ad %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="screen-reader-text">',
		'after_title'   => '</span>',
	) );

	// After Post
	register_sidebar( array(
		'name'          => esc_html__( 'After Post Content', 'scalernews' ),
		'id'            => 'after-post',
		'description'   => esc_html__( 'Widgets displayed after single post content.', 'scalernews' ),
		'before_widget' => '<div id="%1$s" class="widget sn-after-post-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer Columns (1-3)
	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf(
				/* translators: %d: footer column number */
				esc_html__( 'Footer Column %d', 'scalernews' ),
				$i
			),
			'id'            => 'footer-' . $i,
			'description'   => sprintf(
				/* translators: %d: footer column number */
				esc_html__( 'Add widgets here for footer column %d.', 'scalernews' ),
				$i
			),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'scalernews_widgets_init' );
