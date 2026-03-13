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

		// Sticky header/menu scroll effect
		const header = document.querySelector( '.sn-header' );
		const nav = document.querySelector( '.sn-nav' );
		if ( header || nav ) {
			let lastScroll = 0;
			window.addEventListener( 'scroll', function() {
				const currentScroll = window.pageYOffset;
				if ( currentScroll > 50 ) {
					if ( header ) header.classList.add( 'is-scrolled' );
					if ( nav ) nav.classList.add( 'is-scrolled' );
				} else {
					if ( header ) header.classList.remove( 'is-scrolled' );
					if ( nav ) nav.classList.remove( 'is-scrolled' );
				}
				lastScroll = currentScroll;
			}, { passive: true } );
		}

		// Search toggle
		const searchToggle = document.querySelector( '.sn-nav__search-toggle' );
		const searchClose = document.querySelector( '.sn-search-close' );
		const searchForm = document.querySelector( '.sn-search-overlay' );
		
		if ( searchToggle && searchForm ) {
			searchToggle.addEventListener( 'click', function() {
				searchForm.classList.add( 'is-active' );
				const input = searchForm.querySelector( 'input[type="search"]' );
				if ( input ) {
					// Small timeout to allow transition before focus
					setTimeout(() => input.focus(), 100);
				}
			} );
		}

		if ( searchClose && searchForm ) {
			searchClose.addEventListener( 'click', function(e) {
				e.preventDefault();
				searchForm.classList.remove( 'is-active' );
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

		// Scroll to Top Button Logic
		const scrollToTopBtn = document.getElementById( 'scroll-to-top' );
		if ( scrollToTopBtn ) {
			window.addEventListener( 'scroll', function() {
				if ( window.scrollY > 300 ) {
					scrollToTopBtn.classList.add( 'is-visible' );
				} else {
					scrollToTopBtn.classList.remove( 'is-visible' );
				}
			} );

			scrollToTopBtn.addEventListener( 'click', function( e ) {
				e.preventDefault();
				window.scrollTo( {
					top: 0,
					behavior: 'smooth'
				} );
			} );
		}

		// Remove no-js class
		document.documentElement.classList.remove( 'no-js' );
		document.documentElement.classList.add( 'js' );

	} );
} )();
