/**
 * ScalerNews Customizer Controls
 *
 * Handles showing/hiding options dynamically based on other setting values.
 */
( function( $ ) {
	'use strict';

	wp.customize.bind( 'ready', function() {
		const navLayoutControl = wp.customize.control( 'scalernews_nav_layout' );
		const logoPositionControl = wp.customize.control( 'scalernews_logo_position' );
		const menuAlignmentControl = wp.customize.control( 'scalernews_menu_alignment' );

		if ( ! navLayoutControl || ! logoPositionControl || ! menuAlignmentControl ) {
			return;
		}

		function updateMenuAlignmentOptions() {
			const navLayout = navLayoutControl.setting.get();
			const logoPosition = logoPositionControl.setting.get();
			const $select = menuAlignmentControl.container.find( 'select' );

			// Show all by default
			$select.find( 'option' ).show();

			// If header-inline, restrict options based on logo position
			if ( 'header-inline' === navLayout ) {
				if ( 'logo-center' === logoPosition ) {
					// Logo centered -> Menu can only be left or right
					$select.find( 'option[value="center"]' ).hide();

					// If currently set to center, change to right
					if ( 'center' === menuAlignmentControl.setting.get() ) {
						menuAlignmentControl.setting.set( 'right' );
					}
				} else if ( 'logo-left' === logoPosition ) {
					// Logo left -> Menu can only be center or right
					$select.find( 'option[value="left"]' ).hide();

					// If currently set to left, change to right
					if ( 'left' === menuAlignmentControl.setting.get() ) {
						menuAlignmentControl.setting.set( 'right' );
					}
				} else if ( 'logo-right' === logoPosition ) {
					// Logo right -> Menu can only be left or center
					$select.find( 'option[value="right"]' ).hide();

					// If currently set to right, change to left
					if ( 'right' === menuAlignmentControl.setting.get() ) {
						menuAlignmentControl.setting.set( 'left' );
					}
				}
			}
		}

		// Initial check
		updateMenuAlignmentOptions();

		// Update when layout or logo position changes
		navLayoutControl.setting.bind( updateMenuAlignmentOptions );
		logoPositionControl.setting.bind( updateMenuAlignmentOptions );
	} );

} )( jQuery );
