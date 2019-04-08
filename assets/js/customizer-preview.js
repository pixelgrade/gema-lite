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
			$.Gema.Logo.adjustSiteTitle();
			$.Gema.Logo.adjustArchiveTitle();
			$.Gema.Logo.prepare();
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( text ) {
			$( '.site-description-text' ).text( text );
		} );
	} );

	wp.customize( 'jetpack_fonts[selected_fonts]', function( value ) {
		value.bind( function( to ) {
			setTimeout(function() {
				$.Gema.Logo.adjustSiteTitle();
				$.Gema.Logo.adjustArchiveTitle();
				$.Gema.Logo.prepare();
			}, 1);
		} );
	} );

} )( jQuery );
