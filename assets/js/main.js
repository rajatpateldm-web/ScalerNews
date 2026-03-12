/**
 * ScalerNews - Main Script
 *
 * Handles sticky header, scroll effects, and general UI interactions.
 *
 * @package ScalerNews
 * @since 1.0.0
 */
( function() {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function() {

		// Sticky header scroll effect
		const header = document.querySelector( '.sn-header' );
		if ( header ) {
			let lastScroll = 0;
			window.addEventListener( 'scroll', function() {
				const currentScroll = window.pageYOffset;
				if ( currentScroll > 50 ) {
					header.classList.add( 'is-scrolled' );
				} else {
					header.classList.remove( 'is-scrolled' );
				}
				lastScroll = currentScroll;
			}, { passive: true } );
		}

		// Search toggle
		const searchToggle = document.querySelector( '.sn-nav__search-toggle' );
		if ( searchToggle ) {
			searchToggle.addEventListener( 'click', function() {
				const searchForm = document.querySelector( '.sn-search-overlay' );
				if ( searchForm ) {
					searchForm.classList.toggle( 'is-active' );
					const input = searchForm.querySelector( 'input[type="search"]' );
					if ( input ) {
						input.focus();
					}
				}
			} );
		}

		// Smooth scroll for anchor links
		document.querySelectorAll( 'a[href^="#"]' ).forEach( function( anchor ) {
			anchor.addEventListener( 'click', function( e ) {
				const targetId = this.getAttribute( 'href' ).substring( 1 );
				if ( ! targetId ) return;
				const target = document.getElementById( targetId );
				if ( target ) {
					e.preventDefault();
					target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
				}
			} );
		} );

		// Remove no-js class
		document.documentElement.classList.remove( 'no-js' );
		document.documentElement.classList.add( 'js' );

	} );
} )();
