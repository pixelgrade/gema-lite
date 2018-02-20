<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Gema
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 *
 * @since Gema 1.0
 */
function gema_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'gema_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false,
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Jetpack Social Menu
	add_theme_support( 'jetpack-social-menu' );
} // end function gema_jetpack_setup
add_action( 'after_setup_theme', 'gema_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 *
 * @since Gema 1.0
 */
function gema_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
} // end function gema_infinite_scroll_render
