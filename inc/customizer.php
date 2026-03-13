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
	// Site Identity Enhancements
	// =========================================================================
	$wp_customize->add_setting( 'scalernews_logo_width', array(
		'default'           => 180,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'scalernews_logo_width', array(
		'type'        => 'number',
		'label'       => esc_html__( 'Logo Max Width (px)', 'scalernews' ),
		'section'     => 'title_tagline',
		'input_attrs' => array( 'min' => 50, 'max' => 600, 'step' => 5 ),
		'priority'    => 8,
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

	// Lazy Load Images
	$wp_customize->add_setting( 'scalernews_lazy_load', array(
		'default'           => true,
		'sanitize_callback' => 'scalernews_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'scalernews_lazy_load', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Enable Image Lazy Loading', 'scalernews' ),
		'section' => 'scalernews_archive_display',
		'description' => esc_html__( 'Use native browser lazy loading for post thumbnails to improve performance.', 'scalernews' ),
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

	$wp_customize->add_setting( 'scalernews_sticky_menu', array( 'default' => false, 'sanitize_callback' => 'scalernews_sanitize_checkbox' ) );
	$wp_customize->add_control( 'scalernews_sticky_menu', array( 'type' => 'checkbox', 'label' => esc_html__( 'Enable Sticky Menu', 'scalernews' ), 'section' => 'scalernews_header' ) );

	$wp_customize->add_setting( 'scalernews_breaking_news', array( 'default' => true, 'sanitize_callback' => 'scalernews_sanitize_checkbox' ) );
	$wp_customize->add_control( 'scalernews_breaking_news', array( 'type' => 'checkbox', 'label' => esc_html__( 'Show Breaking News Ticker', 'scalernews' ), 'section' => 'scalernews_header' ) );

	// -- Logo & Nav Layout --
	$wp_customize->add_setting( 'scalernews_logo_position', array(
		'default'           => 'logo-left',
		'sanitize_callback' => 'scalernews_sanitize_select',
	) );
	$wp_customize->add_control( 'scalernews_logo_position', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Logo Position', 'scalernews' ),
		'section' => 'scalernews_header',
		'choices' => array(
			'logo-left'   => esc_html__( 'Left', 'scalernews' ),
			'logo-center' => esc_html__( 'Center', 'scalernews' ),
			'logo-right'  => esc_html__( 'Right', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_nav_layout', array(
		'default'           => 'inline',
		'sanitize_callback' => 'scalernews_sanitize_select',
	) );
	$wp_customize->add_control( 'scalernews_nav_layout', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Navigation Layout', 'scalernews' ),
		'description' => esc_html__( 'Inline: menu on separate row. Header Inline: menu merged into same row as logo.', 'scalernews' ),
		'section' => 'scalernews_header',
		'choices' => array(
			'inline'        => esc_html__( 'Inline (separate nav bar)', 'scalernews' ),
			'header-inline' => esc_html__( 'Header Inline (logo + menu together)', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_menu_alignment', array(
		'default'           => 'right',
		'sanitize_callback' => 'scalernews_sanitize_select',
	) );
	$wp_customize->add_control( 'scalernews_menu_alignment', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Menu Alignment', 'scalernews' ),
		'section' => 'scalernews_header',
		'choices' => array(
			'left'   => esc_html__( 'Left', 'scalernews' ),
			'center' => esc_html__( 'Center', 'scalernews' ),
			'right'  => esc_html__( 'Right', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_nav_search', array(
		'default'           => true,
		'sanitize_callback' => 'scalernews_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'scalernews_nav_search', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Show Search in Menu', 'scalernews' ),
		'section' => 'scalernews_header',
	) );

	$wp_customize->add_section( 'scalernews_footer', array(
		'title' => esc_html__( 'Footer', 'scalernews' ),
		'panel' => 'scalernews_header_footer',
	) );
	$wp_customize->add_setting( 'scalernews_footer_widget_columns', array(
		'default'           => 3,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'scalernews_footer_widget_columns', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Footer Widget Columns', 'scalernews' ),
		'section' => 'scalernews_footer',
		'choices' => array(
			1 => esc_html__( '1 Column', 'scalernews' ),
			2 => esc_html__( '2 Columns', 'scalernews' ),
			3 => esc_html__( '3 Columns', 'scalernews' ),
			4 => esc_html__( '4 Columns', 'scalernews' ),
		),
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

	$wp_customize->add_setting( 'scalernews_homepage_sidebar', array( 'default' => true, 'sanitize_callback' => 'scalernews_sanitize_checkbox' ) );
	$wp_customize->add_control( 'scalernews_homepage_sidebar', array( 'type' => 'checkbox', 'label' => esc_html__( 'Enable Homepage Sidebar', 'scalernews' ), 'section' => 'scalernews_homepage' ) );

	// =========================================================================
	// Panel: Scroll to Top
	// =========================================================================
	$wp_customize->add_section( 'scalernews_scroll_to_top', array(
		'title'    => esc_html__( 'Scroll to Top', 'scalernews' ),
		'priority' => 60,
	) );
	
	$wp_customize->add_setting( 'scalernews_totop_enable', array( 'default' => true, 'sanitize_callback' => 'scalernews_sanitize_checkbox' ) );
	$wp_customize->add_control( 'scalernews_totop_enable', array( 'type' => 'checkbox', 'label' => esc_html__( 'Enable Scroll to Top', 'scalernews' ), 'section' => 'scalernews_scroll_to_top' ) );

	$wp_customize->add_setting( 'scalernews_totop_icon', array( 'default' => 'arrow-up', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'scalernews_totop_icon', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Icon Style', 'scalernews' ),
		'section' => 'scalernews_scroll_to_top',
		'choices' => array(
			'arrow-up'     => esc_html__( 'Arrow Up', 'scalernews' ),
			'chevron-up'   => esc_html__( 'Chevron Up', 'scalernews' ),
			'angle-up'     => esc_html__( 'Angle Up', 'scalernews' ),
			'long-arrow'   => esc_html__( 'Long Arrow', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_totop_icon_size', array( 'default' => 24, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'scalernews_totop_icon_size', array( 'type' => 'number', 'label' => esc_html__( 'Icon Inner Size (px)', 'scalernews' ), 'section' => 'scalernews_scroll_to_top', 'input_attrs' => array( 'min' => 12, 'max' => 60 ) ) );

	$wp_customize->add_setting( 'scalernews_totop_bg_color', array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'scalernews_totop_bg_color', array(
		'label'   => esc_html__( 'Background Color', 'scalernews' ),
		'section' => 'scalernews_scroll_to_top',
	) ) );

	$wp_customize->add_setting( 'scalernews_totop_icon_color', array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'scalernews_totop_icon_color', array(
		'label'   => esc_html__( 'Icon Color', 'scalernews' ),
		'section' => 'scalernews_scroll_to_top',
	) ) );

	$wp_customize->add_setting( 'scalernews_totop_size', array( 'default' => 40, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'scalernews_totop_size', array( 'type' => 'number', 'label' => esc_html__( 'Button Container Size (px)', 'scalernews' ), 'section' => 'scalernews_scroll_to_top', 'input_attrs' => array( 'min' => 30, 'max' => 80 ) ) );

	$wp_customize->add_setting( 'scalernews_totop_position', array( 'default' => 'right', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'scalernews_totop_position', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Position', 'scalernews' ),
		'section' => 'scalernews_scroll_to_top',
		'choices' => array(
			'left'  => esc_html__( 'Left', 'scalernews' ),
			'right' => esc_html__( 'Right', 'scalernews' ),
		),
	) );

	$wp_customize->add_setting( 'scalernews_totop_offset_side', array( 'default' => 20, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'scalernews_totop_offset_side', array( 'type' => 'number', 'label' => esc_html__( 'Side Offset (px)', 'scalernews' ), 'section' => 'scalernews_scroll_to_top' ) );

	$wp_customize->add_setting( 'scalernews_totop_offset_bottom', array( 'default' => 20, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'scalernews_totop_offset_bottom', array( 'type' => 'number', 'label' => esc_html__( 'Bottom Offset (px)', 'scalernews' ), 'section' => 'scalernews_scroll_to_top' ) );

	$wp_customize->add_setting( 'scalernews_totop_visibility', array( 'default' => 'all', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'scalernews_totop_visibility', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Visibility', 'scalernews' ),
		'section' => 'scalernews_scroll_to_top',
		'choices' => array(
			'all'     => esc_html__( 'Show on All Devices', 'scalernews' ),
			'desktop' => esc_html__( 'Desktop Only', 'scalernews' ),
			'mobile'  => esc_html__( 'Mobile/Tablet Only', 'scalernews' ),
		),
	) );

}
add_action( 'customize_register', 'scalernews_customize_register' );

/**
 * Sanitize checkbox.
 */
function scalernews_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === $checked ) ? true : false;
}

/**
 * Sanitize select.
 */
function scalernews_sanitize_select( $input, $setting ) {
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return array_key_exists( $input, $choices ) ? $input : $setting->default;
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

/**
 * Enqueue scripts for Customizer controls.
 */
function scalernews_customize_controls_enqueue() {
	wp_enqueue_script(
		'scalernews-customizer-controls',
		SCALERNEWS_URI . '/assets/js/customizer-controls.js',
		array( 'jquery', 'customize-controls' ),
		SCALERNEWS_VERSION,
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'scalernews_customize_controls_enqueue' );
