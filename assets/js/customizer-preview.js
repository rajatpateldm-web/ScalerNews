/**
 * ScalerNews - Customizer Preview
 *
 * Live preview updates for customizer settings.
 *
 * @package ScalerNews
 * @since 1.0.0
 */
( function( $ ) {
	'use strict';

	// Site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.sn-header__site-title a' ).text( to );
		} );
	} );

	// Site description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.sn-header__tagline' ).text( to );
		} );
	} );

	// Primary Color
	wp.customize( 'scalernews_primary_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty( '--sn-color-primary', to );
		} );
	} );

	// Secondary Color
	wp.customize( 'scalernews_secondary_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty( '--sn-color-secondary', to );
		} );
	} );

	// Accent Color
	wp.customize( 'scalernews_accent_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty( '--sn-color-accent', to );
		} );
	} );

	// Text Color
	wp.customize( 'scalernews_text_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty( '--sn-color-text', to );
		} );
	} );

} )( jQuery );
