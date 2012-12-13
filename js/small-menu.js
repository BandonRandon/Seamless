/**
 * Handles toggling the main navigation menu for small screens.
 */
jQuery( document ).ready( function( $ ) {
	var $container = $( '#container' ),
	    timeout = false;

	$.fn.smallMenu = function() {
		$container.find( '#menu-primary' ).removeClass( 'primary-navigation' ).addClass( 'main-small-navigation' );
		$container.find( '#menu-primary h1' ).removeClass( 'assistive-text' ).addClass( 'menu-toggle' );

		$( '.menu-toggle' ).unbind( 'click' ).click( function() {
			$( this ).parents( '.site-navigation' ).find( '.menu' ).toggle();
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	// Check viewport width on first load.
	if ( $( window ).width() < 600 )
		$.fn.smallMenu();

	// Check viewport width when user resizes the browser window.
	$( window ).resize( function() {
		var browserWidth = $( window ).width();

		if ( false !== timeout )
			clearTimeout( timeout );

		timeout = setTimeout( function() {
			if ( browserWidth < 600 ) {
				$.fn.smallMenu();
			} else {
				$container.find( '#menu-primary' ).removeClass( 'main-small-navigation' ).addClass( 'primary-navigation' );
				$container.find( '#menu-primary h1' ).removeClass( 'menu-toggle' ).addClass( 'assistive-text' );
				$container.find( '.menu' ).removeAttr( 'style' );
			}
		}, 200 );
	} );
} );