<?php
/**
 * ScalerNews Dynamic CSS Generator
 *
 * Extracts settings from the Customizer and outputs dynamic CSS in the head.
 *
 * @package ScalerNews
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output dynamic CSS variables and styles based on Customizer settings.
 */
function scalernews_dynamic_css() {
	$css = ':root {';

	// Typography
	$base_font    = get_theme_mod( 'scalernews_base_font', 'Inter' );
	$heading_font = get_theme_mod( 'scalernews_heading_font', 'Outfit' );
	$base_size    = get_theme_mod( 'scalernews_base_font_size', 16 );

	// Basic fallback mapping for standard fonts
	$font_map = array(
		'Inter'      => "'Inter', sans-serif",
		'Roboto'     => "'Roboto', sans-serif",
		'Open Sans'  => "'Open Sans', sans-serif",
		'Lato'       => "'Lato', sans-serif",
		'Outfit'     => "'Outfit', sans-serif",
		'Montserrat' => "'Montserrat', sans-serif",
		'Poppins'    => "'Poppins', sans-serif",
		'Oswald'     => "'Oswald', sans-serif",
		'Georgia'    => "Georgia, serif",
	);

	$css .= '--sn-font-primary: ' . ( isset( $font_map[ $base_font ] ) ? $font_map[ $base_font ] : $font_map['Inter'] ) . ';';
	$css .= '--sn-font-heading: ' . ( isset( $font_map[ $heading_font ] ) ? $font_map[ $heading_font ] : $font_map['Outfit'] ) . ';';
	$css .= '--sn-text-base-size: ' . absint( $base_size ) . 'px;';

	// Colors
	$colors = array(
		'primary_color'   => array( 'var' => '--sn-color-primary', 'default' => '#e63946' ),
		'secondary_color' => array( 'var' => '--sn-color-secondary', 'default' => '#1d3557' ),
		'accent_color'    => array( 'var' => '--sn-color-accent', 'default' => '#f4a261' ),
		'bg_color'        => array( 'var' => '--sn-color-bg', 'default' => '#ffffff' ),
		'text_color'      => array( 'var' => '--sn-color-text', 'default' => '#212529' ),
		'heading_color'   => array( 'var' => '--sn-color-heading', 'default' => '#1d3557' ),
		'link_color'      => array( 'var' => '--sn-color-link', 'default' => '#e63946' ),
		'button_bg'       => array( 'var' => '--sn-color-button-bg', 'default' => '#e63946' ),
		'button_text'     => array( 'var' => '--sn-color-button-text', 'default' => '#ffffff' ),
	);

	foreach ( $colors as $id => $data ) {
		$val = get_theme_mod( 'scalernews_' . $id, $data['default'] );
		$css .= $data['var'] . ': ' . esc_attr( $val ) . ';';
	}

	// Layout Spacing
	$container_width = get_theme_mod( 'scalernews_container_width', 1200 );
	$content_width   = get_theme_mod( 'scalernews_content_width', 800 );
	$css .= '--sn-container-width: ' . absint( $container_width ) . 'px;';
	$css .= '--sn-content-width: ' . absint( $content_width ) . 'px;';

	$logo_width = get_theme_mod( 'scalernews_logo_width', 180 );
	$css .= '--sn-logo-width: ' . absint( $logo_width ) . 'px;';

	$css .= '}';

	// Logo Custom CSS
	$css .= ' .sn-header__logo img { max-width: var(--sn-logo-width); } ';

	// Custom Grid Columns Override
	$grid_cols = get_theme_mod( 'scalernews_grid_columns', 3 );
	if ( 3 !== $grid_cols ) {
		$css .= '@media(min-width: 992px) { .sn-posts-grid { grid-template-columns: repeat(' . absint( $grid_cols ) . ', 1fr); } }';
	}

	// Footer Widget Columns Override
	$footer_cols = get_theme_mod( 'scalernews_footer_widget_columns', 3 );
	if ( 3 !== $footer_cols ) {
		$css .= '@media(min-width: 768px) { .sn-footer__widgets { grid-template-columns: repeat(' . absint( $footer_cols ) . ', 1fr); } }';
	}

	echo '<style id="scalernews-custom-dynamic-css">' . $css . '</style>'; // phpcs:ignore
}
add_action( 'wp_head', 'scalernews_dynamic_css', 99 );

/**
 * Enqueue Google Fonts dynamically based on Customizer typography settings.
 */
function scalernews_dynamic_google_fonts() {
	$base_font    = get_theme_mod( 'scalernews_base_font', 'Inter' );
	$heading_font = get_theme_mod( 'scalernews_heading_font', 'Outfit' );

	$fonts_to_load = array();

	// Add Base Font
	if ( 'Inter' === $base_font ) {
		$fonts_to_load['Inter'] = 'Inter:wght@300;400;500;600;700';
	} elseif ( 'Roboto' === $base_font ) {
		$fonts_to_load['Roboto'] = 'Roboto:wght@300;400;500;700';
	} elseif ( 'Open Sans' === $base_font ) {
		$fonts_to_load['Open Sans'] = 'Open+Sans:wght@300;400;600;700';
	} elseif ( 'Lato' === $base_font ) {
		$fonts_to_load['Lato'] = 'Lato:wght@300;400;700';
	}

	// Add Heading Font
	if ( 'Outfit' === $heading_font ) {
		$fonts_to_load['Outfit'] = 'Outfit:wght@400;500;600;700;800';
	} elseif ( 'Montserrat' === $heading_font ) {
		$fonts_to_load['Montserrat'] = 'Montserrat:wght@400;500;600;700';
	} elseif ( 'Poppins' === $heading_font ) {
		$fonts_to_load['Poppins'] = 'Poppins:wght@400;500;600;700';
	} elseif ( 'Oswald' === $heading_font ) {
		$fonts_to_load['Oswald'] = 'Oswald:wght@400;500;600;700';
	}

	if ( ! empty( $fonts_to_load ) ) {
		$font_family_string = implode( '&family=', $fonts_to_load );
		wp_enqueue_style(
			'scalernews-dynamic-fonts',
			'https://fonts.googleapis.com/css2?family=' . $font_family_string . '&display=swap',
			array(),
			null
		);
	}
}
add_action( 'wp_enqueue_scripts', 'scalernews_dynamic_google_fonts' );
