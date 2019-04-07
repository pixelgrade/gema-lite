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
