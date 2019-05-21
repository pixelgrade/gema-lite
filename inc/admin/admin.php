<?php
/**
 * Gema Lite Theme admin logic.
 *
 * @package Gema Lite
 */

function gemalite_admin_setup() {

	/**
	 * Load and initialize Pixelgrade Care notice logic.
	 */
	require_once 'pixcare-notice/class-notice.php'; // phpcs:ignore
	GemaLite_PixelgradeCare_DownloadNotice::init();
}
add_action('after_setup_theme', 'gemalite_admin_setup' );
