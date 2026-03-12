/**
 * ScalerNews - Navigation
 *
 * Handles mobile menu toggle and dropdown behavior.
 *
 * @package ScalerNews
 * @since 1.0.0
 */
( function() {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function() {
		const toggle = document.querySelector( '.sn-nav__toggle' );
		const menu   = document.querySelector( '.sn-nav__menu' );

		if ( ! toggle || ! menu ) {
			return;
		}

		// Mobile menu toggle
		toggle.addEventListener( 'click', function( e ) {
			e.preventDefault();
			const isExpanded = toggle.getAttribute( 'aria-expanded' ) === 'true';
			toggle.setAttribute( 'aria-expanded', ! isExpanded );
			menu.classList.toggle( 'is-active' );
		} );

		// Close menu when clicking outside
		document.addEventListener( 'click', function( e ) {
			if ( ! toggle.contains( e.target ) && ! menu.contains( e.target ) ) {
				toggle.setAttribute( 'aria-expanded', 'false' );
				menu.classList.remove( 'is-active' );
			}
		} );

		// Handle keyboard navigation
		menu.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Escape' ) {
				toggle.setAttribute( 'aria-expanded', 'false' );
				menu.classList.remove( 'is-active' );
				toggle.focus();
			}
		} );

		// Handle dropdown submenus on touch devices
		const menuItemsWithChildren = menu.querySelectorAll( '.menu-item-has-children > a' );
		menuItemsWithChildren.forEach( function( link ) {
			link.addEventListener( 'touchstart', function( e ) {
				const parent  = link.parentElement;
				const submenu = parent.querySelector( '.sub-menu' );
				if ( submenu && window.innerWidth <= 768 ) {
					if ( ! parent.classList.contains( 'submenu-open' ) ) {
						e.preventDefault();
						// Close other open submenus
						menu.querySelectorAll( '.submenu-open' ).forEach( function( item ) {
							item.classList.remove( 'submenu-open' );
						} );
						parent.classList.add( 'submenu-open' );
					}
				}
			} );
		} );
	} );
} )();
