<?php
/**
 * ScalerNews Theme Functions
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants.
 */
define( 'SCALERNEWS_VERSION', '1.0.0' );
define( 'SCALERNEWS_DIR', get_template_directory() );
define( 'SCALERNEWS_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function scalernews_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'scalernews', SCALERNEWS_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Custom image sizes for news layouts.
	add_image_size( 'scalernews-hero', 1200, 630, true );
	add_image_size( 'scalernews-card', 600, 400, true );
	add_image_size( 'scalernews-thumbnail', 150, 150, true );

	// Register navigation menus.
	register_nav_menus( array(
		'primary'  => esc_html__( 'Primary Menu', 'scalernews' ),
		'footer'   => esc_html__( 'Footer Menu', 'scalernews' ),
		'social'   => esc_html__( 'Social Links Menu', 'scalernews' ),
	) );

	// HTML5 support.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
		'navigation-widgets',
	) );

	// Custom logo support.
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Custom header support.
	add_theme_support( 'custom-header', array(
		'default-image'      => '',
		'default-text-color' => '1d3557',
		'width'              => 1920,
		'height'             => 400,
		'flex-height'        => true,
		'flex-width'         => true,
	) );

	// Custom background support.
	add_theme_support( 'custom-background', array(
		'default-color' => 'f8f9fa',
	) );

	// Gutenberg block editor support.
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'appearance-tools' );

	// Editor stylesheet.
	add_editor_style( 'assets/css/editor.css' );

	// Gutenberg color palette.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'Primary Red', 'scalernews' ),
			'slug'  => 'primary',
			'color' => '#e63946',
		),
		array(
			'name'  => esc_html__( 'Secondary Navy', 'scalernews' ),
			'slug'  => 'secondary',
			'color' => '#1d3557',
		),
		array(
			'name'  => esc_html__( 'Accent Orange', 'scalernews' ),
			'slug'  => 'accent',
			'color' => '#f4a261',
		),
		array(
			'name'  => esc_html__( 'Light Gray', 'scalernews' ),
			'slug'  => 'light-gray',
			'color' => '#f8f9fa',
		),
		array(
			'name'  => esc_html__( 'Dark', 'scalernews' ),
			'slug'  => 'dark',
			'color' => '#212529',
		),
		array(
			'name'  => esc_html__( 'White', 'scalernews' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
	) );

	// Gutenberg font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => esc_html__( 'Small', 'scalernews' ),
			'slug' => 'small',
			'size' => 14,
		),
		array(
			'name' => esc_html__( 'Normal', 'scalernews' ),
			'slug' => 'normal',
			'size' => 16,
		),
		array(
			'name' => esc_html__( 'Large', 'scalernews' ),
			'slug' => 'large',
			'size' => 20,
		),
		array(
			'name' => esc_html__( 'Extra Large', 'scalernews' ),
			'slug' => 'extra-large',
			'size' => 28,
		),
	) );

	// Content width.
	if ( ! isset( $content_width ) ) {
		$content_width = 780;
	}
}
add_action( 'after_setup_theme', 'scalernews_setup' );

/**
 * Enqueue scripts and styles.
 */
function scalernews_scripts() {
	// Google Fonts are loaded dynamically via inc/customizer-dynamic-css.php

	// Main theme stylesheet.
	wp_enqueue_style(
		'scalernews-style',
		get_stylesheet_uri(),
		array(),
		SCALERNEWS_VERSION
	);

	// Additional CSS.
	wp_enqueue_style(
		'scalernews-main',
		SCALERNEWS_URI . '/assets/css/main.css',
		array( 'scalernews-style' ),
		SCALERNEWS_VERSION
	);

	// Block styles.
	wp_enqueue_style(
		'scalernews-blocks',
		SCALERNEWS_URI . '/assets/css/blocks.css',
		array( 'scalernews-style' ),
		SCALERNEWS_VERSION
	);

	// RTL stylesheet.
	if ( is_rtl() ) {
		wp_enqueue_style(
			'scalernews-rtl',
			SCALERNEWS_URI . '/rtl.css',
			array( 'scalernews-style' ),
			SCALERNEWS_VERSION
		);
	}

	// Navigation script.
	wp_enqueue_script(
		'scalernews-navigation',
		SCALERNEWS_URI . '/assets/js/navigation.js',
		array(),
		SCALERNEWS_VERSION,
		true
	);

	// Main theme script.
	wp_enqueue_script(
		'scalernews-main',
		SCALERNEWS_URI . '/assets/js/main.js',
		array(),
		SCALERNEWS_VERSION,
		true
	);

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'scalernews_scripts' );

/**
 * Enqueue block editor assets.
 */
function scalernews_editor_assets() {
	wp_enqueue_style(
		'scalernews-editor-style',
		SCALERNEWS_URI . '/assets/css/editor.css',
		array(),
		SCALERNEWS_VERSION
	);
}
add_action( 'enqueue_block_editor_assets', 'scalernews_editor_assets' );

/**
 * Register widget areas.
 */
require SCALERNEWS_DIR . '/inc/widgets.php';

/**
 * Custom template tags.
 */
require SCALERNEWS_DIR . '/inc/template-tags.php';

/**
 * Custom template functions.
 */
require SCALERNEWS_DIR . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require SCALERNEWS_DIR . '/inc/customizer.php';
require SCALERNEWS_DIR . '/inc/customizer-dynamic-css.php';

/**
 * Block patterns.
 */
require SCALERNEWS_DIR . '/inc/block-patterns.php';

/**
 * Customizer preview script.
 */
function scalernews_customize_preview_js() {
	wp_enqueue_script(
		'scalernews-customizer-preview',
		SCALERNEWS_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		SCALERNEWS_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'scalernews_customize_preview_js' );

/**
 * Add preconnect for Google Fonts.
 */
function scalernews_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
			'crossorigin',
		);
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'scalernews_resource_hints', 10, 2 );

/**
 * Add custom body classes.
 */
function scalernews_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( is_singular() && ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}
	if ( get_theme_mod( 'scalernews_sticky_header', true ) ) {
		$classes[] = 'has-sticky-header';
	}
	if ( get_theme_mod( 'scalernews_sticky_menu', false ) ) {
		$classes[] = 'has-sticky-menu';
	}

	// Header layout classes
	$logo_position  = get_theme_mod( 'scalernews_logo_position', 'logo-left' );
	$nav_layout     = get_theme_mod( 'scalernews_nav_layout', 'inline' );
	$menu_alignment = get_theme_mod( 'scalernews_menu_alignment', 'right' );

	$classes[] = 'sn-logo-' . sanitize_html_class( $logo_position );
	$classes[] = 'sn-nav-layout-' . sanitize_html_class( $nav_layout );
	$classes[] = 'sn-menu-' . sanitize_html_class( $menu_alignment );

	return $classes;
}
add_filter( 'body_class', 'scalernews_body_classes' );

/**
 * Excerpt length.
 */
function scalernews_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'scalernews_excerpt_length' );

/**
 * Excerpt more.
 */
function scalernews_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'scalernews_excerpt_more' );
