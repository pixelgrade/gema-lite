<?php
/**
 * Gema Lite Theme admin logic.
 *
 * @package Gema Lite
 */

function gema_lite_admin_setup() {

	/**
	 * Load and initialize Pixelgrade Care notice logic.
	 */
	require_once 'pixcare-notice/class-notice.php';
	PixelgradeCare_Install_Notice::init();
}
add_action('after_setup_theme', 'gema_lite_admin_setup' );

function gemalite_admin_assets() {
	wp_enqueue_style( 'gemalite_admin_style', get_template_directory_uri() . '/inc/admin/css/admin.css', null, '1.1.2', false );
}
add_action( 'admin_enqueue_scripts', 'gemalite_admin_assets' );
