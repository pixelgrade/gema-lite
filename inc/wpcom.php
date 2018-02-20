<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * @package Gema
 * @since   Gema 1.0
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function gema_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => 'ffffff',
			'border' => 'ebebeb',
			'text'   => 'aaafb3',
			'link'   => '80c9dd',
			'url'    => '80c9dd',
		);
	}
}
add_action( 'after_setup_theme', 'gema_wpcom_setup' );

/**
 * De-queue Self-Hosted fonts if custom fonts are being used instead.
 *
 * @return void
 */
function gema_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		$custom_fonts = TypekitData::get( 'families' );
		if ( $custom_fonts && $custom_fonts['headings']['id'] && $custom_fonts['body-text']['id'] ) {
			wp_dequeue_style( 'gema-fonts-montserrat' );
			wp_dequeue_style( 'gema-fonts-butler' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'gema_dequeue_fonts' );

/**
 * Disable the widont filter on WP.com to avoid stray &nbsps
 *
 * @link https://vip.wordpress.com/functions/widont/
 */
function gema_wido() {
	remove_filter( 'the_title', 'widont' );
}
add_action( 'init', 'gema_wido' );
