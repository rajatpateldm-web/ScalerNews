<?php
/**
 * ScalerNews Customizer
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function scalernews_customize_register( $wp_customize ) {

	// =========================================================================
	// Panel: Design
	// =========================================================================
	$wp_customize->add_panel( 'scalernews_design_options', array(
		'title'       => esc_html__( 'Design', 'scalernews' ),
		'description' => esc_html__( 'Typography, Colors, and Layout settings.', 'scalernews' ),
		'priority'    => 20,
	) );

	// Section: Styles (Typography)
	$wp_customize->add_section( 'scalernews_styles', array(
		'title'    => esc_html__( 'Styles & Typography', 'scalernews' ),
		'panel'    => 'scalernews_design_options',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'scalernews_base_font', array(
		'default'           => 'Inter',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'scalernews_base_font', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Base Font Family', 'scalernews' ),
		'section' => 'scalernews_styles',
		'choices' => array(
			'Inter'     => 'Inter',
			'Roboto'    => 'Roboto',
			'Open Sans' => 'Open Sans',
			'Lato'      => 'Lato',
		),
	) );

	$wp_customize->add_setting( 'scalernews_heading_font', array(
		'default'           => 'Outfit',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'scalernews_heading_font', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Heading Font Family', 'scalernews' ),
		'section' => 'scalernews_styles',
		'choices' => array(
			'Outfit'      => 'Outfit',
			'Montserrat'  => 'Montserrat',
			'Poppins'     => 'Poppins',
			'Oswald'      => 'Oswald',
			'Georgia'     => 'Georgia (Serif)',
		),
	) );

	$wp_customize->add_setting( 'scalernews_base_font_size', array(
		'default'           => 16,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'scalernews_base_font_size', array(
		'type'        => 'number',
		'label'       => esc_html__( 'Base Font Size (px)', 'scalernews' ),
		'section'     => 'scalernews_styles',
		'input_attrs' => array( 'min' => 12, 'max' => 24, 'step' => 1 ),
	) );

	// Section: Colors
	$wp_customize->add_section( 'scalernews_colors_ext', array(
		'title'    => esc_html__( 'Colors', 'scalernews' ),
		'panel'    => 'scalernews_design_options',
		'priority' => 20,
	) );

	// Base Colors
	$colors = array(
		'primary_color'   => array( 'label' => 'Primary Color', 'default' => '#e63946' ),
		'secondary_color' => array( 'label' => 'Secondary Color', 'default' => '#1d3557' ),
		'accent_color'    => array( 'label' => 'Accent Color', 'default' => '#f4a261' ),
		'bg_color'        => array( 'label' => 'Background Color', 'default' => '#ffffff' ),
		'text_color'      => array( 'label' => 'Text Color', 'default' => '#212529' ),
		'heading_color'   => array( 'label' => 'Heading Color', 'default' => '#1d3557' ),
		'link_color'      => array( 'label' => 'Link Color', 'default' => '#e63946' ),
		'button_bg'       => array( 'label' => 'Button Background', 'default' => '#e63946' ),
		'button_text'     => array( 'label' => 'Button Text', 'default' => '#ffffff' ),
	);

	foreach ( $colors as $id => $color ) {
		$wp_customize->add_setting( 'scalernews_' . $id, array(
			'default'           => $color['default'],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'scalernews_' . $id, array(
			'label'   => esc_html__( $color['label'], 'scalernews' ),
			'section' => 'scalernews_colors_ext',
		) ) );
	}

	// Section: Layout
	$wp_customize->add_section( 'scalernews_layout', array(
		'title'    => esc_html__( 'Layout', 'scalernews' ),
		'panel'    => 'scalernews_design_options',
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'scalernews_container_width', array(
		'default'           => 1200,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'scalernews_container_width', array(
		'type'        => 'number',
		'label'       => esc_html__( 'Main Container Width (px)', 'scalernews' ),
		'section'     => 'scalernews_layout',
		'input_attrs' => array( 'min' => 800, 'max' => 1920, 'step' => 10 ),
	) );

	$wp_customize->add_setting( 'scalernews_content_width', array(
		'default'           => 800,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'scalernews_content_width', array(
		'type'        => 'number',
		'label'       => esc_html__( 'Single Post Content Width (px)', 'scalernews' ),
		'section'     => 'scalernews_layout',
		'input_attrs' => array( 'min' => 600, 'max' => 1200, 'step' => 10 ),
	) );


	// =========================================================================
	// Panel: Blog Display
	// =========================================================================
	$wp_customize->add_panel( 'scalernews_blog_options', array(
		'title'       => esc_html__( 'Blog / Archive Display', 'scalernews' ),
		'description' => esc_html__( 'Options for blog archives and single posts.', 'scalernews' ),
		'priority'    => 30,
	) );

	// Section: Archive
	$wp_customize->add_section( 'scalernews_archive_display', array(
		'title'    => esc_html__( 'Archive Layout', 'scalernews' ),
		'panel'    => 'scalernews_blog_options',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'scalernews_archive_layout', array(
		'default'           => 'grid',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'scalernews_archive_layout', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Post Layout Style', 'scalernews' ),
		'section' => 'scalernews_archive_display',
		'choices' => array(
			'grid' => esc_html__( 'Grid', 'scalernews' ),
			'list' => esc_html__( 'List (Horizontal)', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_card_style', array(
		'default'           => 'flat',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'scalernews_card_style', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Card Appearance', 'scalernews' ),
		'section' => 'scalernews_archive_display',
		'choices' => array(
			'flat'     => esc_html__( 'Flat (Default)', 'scalernews' ),
			'shadow'   => esc_html__( 'Soft Shadow', 'scalernews' ),
			'bordered' => esc_html__( 'Bordered Box', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_grid_columns', array(
		'default'           => 3,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'scalernews_grid_columns', array(
		'type'        => 'number',
		'label'       => esc_html__( 'Grid Columns (Desktop)', 'scalernews' ),
		'section'     => 'scalernews_archive_display',
		'input_attrs' => array( 'min' => 2, 'max' => 4, 'step' => 1 ),
	) );

	// Section: Single Post
	$wp_customize->add_section( 'scalernews_single_post', array(
		'title'    => esc_html__( 'Single Post Layout', 'scalernews' ),
		'panel'    => 'scalernews_blog_options',
		'priority' => 20,
	) );

	$wp_customize->add_setting( 'scalernews_single_featured_image', array(
		'default'           => 'content',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'scalernews_single_featured_image', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Featured Image Display', 'scalernews' ),
		'section' => 'scalernews_single_post',
		'choices' => array(
			'content' => esc_html__( 'Normal (Content Width)', 'scalernews' ),
			'full'    => esc_html__( 'Full Width (Above Title)', 'scalernews' ),
			'hidden'  => esc_html__( 'Hidden', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_single_show_author', array(
		'default'           => true,
		'sanitize_callback' => 'scalernews_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'scalernews_single_show_author', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Show Author Box', 'scalernews' ),
		'section' => 'scalernews_single_post',
	) );


	// =========================================================================
	// Panel: Header & Footer (Existing retained)
	// =========================================================================
	$wp_customize->add_panel( 'scalernews_header_footer', array(
		'title'       => esc_html__( 'Header & Footer', 'scalernews' ),
		'priority'    => 40,
	) );

	$wp_customize->add_section( 'scalernews_header', array(
		'title' => esc_html__( 'Header', 'scalernews' ),
		'panel' => 'scalernews_header_footer',
	) );
	$wp_customize->add_setting( 'scalernews_sticky_header', array( 'default' => true, 'sanitize_callback' => 'scalernews_sanitize_checkbox' ) );
	$wp_customize->add_control( 'scalernews_sticky_header', array( 'type' => 'checkbox', 'label' => esc_html__( 'Enable Sticky Header', 'scalernews' ), 'section' => 'scalernews_header' ) );
	$wp_customize->add_setting( 'scalernews_breaking_news', array( 'default' => true, 'sanitize_callback' => 'scalernews_sanitize_checkbox' ) );
	$wp_customize->add_control( 'scalernews_breaking_news', array( 'type' => 'checkbox', 'label' => esc_html__( 'Show Breaking News Ticker', 'scalernews' ), 'section' => 'scalernews_header' ) );

	$wp_customize->add_section( 'scalernews_footer', array(
		'title' => esc_html__( 'Footer', 'scalernews' ),
		'panel' => 'scalernews_header_footer',
	) );
	$wp_customize->add_setting( 'scalernews_footer_copyright', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post' ) );
	$wp_customize->add_control( 'scalernews_footer_copyright', array( 'type' => 'textarea', 'label' => esc_html__( 'Copyright Text', 'scalernews' ), 'section' => 'scalernews_footer' ) );

	// =========================================================================
	// Panel: Homepage (Existing retained)
	// =========================================================================
	$wp_customize->add_section( 'scalernews_homepage', array(
		'title'    => esc_html__( 'Homepage Settings', 'scalernews' ),
		'priority' => 50,
	) );
	$wp_customize->add_setting( 'scalernews_hero_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'scalernews_hero_count', array( 'type' => 'number', 'label' => esc_html__( 'Number of Hero Posts', 'scalernews' ), 'section' => 'scalernews_homepage', 'input_attrs' => array( 'min' => 1, 'max' => 5 ) ) );
	$wp_customize->add_setting( 'scalernews_hero_category', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'scalernews_hero_category', array( 'type' => 'select', 'label' => esc_html__( 'Hero Category', 'scalernews' ), 'section' => 'scalernews_homepage', 'choices' => scalernews_get_categories_choices() ) );
	$wp_customize->add_setting( 'scalernews_featured_category', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'scalernews_featured_category', array( 'type' => 'select', 'label' => esc_html__( 'Featured Category Section', 'scalernews' ), 'section' => 'scalernews_homepage', 'choices' => scalernews_get_categories_choices() ) );

}
add_action( 'customize_register', 'scalernews_customize_register' );

/**
 * Sanitize checkbox.
 */
function scalernews_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === $checked ) ? true : false;
}

/**
 * Get categories as choices array for Customizer select controls.
 */
function scalernews_get_categories_choices() {
	$choices    = array( '' => esc_html__( '— Select —', 'scalernews' ) );
	$categories = get_categories( array( 'hide_empty' => false ) );
	foreach ( $categories as $cat ) {
		$choices[ $cat->term_id ] = $cat->name;
	}
	return $choices;
}
