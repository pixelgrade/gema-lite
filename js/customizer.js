/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Change site title and description when they are typed
	wp.customize( 'blogname', function( value ) {
		value.bind( function( text ) {
			$( '.site-title a span, .site-title text' ).text( text );
			Logo.init();
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( text ) {
			$( '.site-description' ).text( text );
		} );
	} );

	wp.customize( 'jetpack_fonts[selected_fonts]', function( value ) {
		value.bind( function( to ) {
			setTimeout(function() {
				Logo.onResize();
			}, 1);
		} );
	} );

} )( jQuery );
