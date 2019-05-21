<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="mobile-header-wrapper">

		<div class="mobile-logo"></div>

		<button class="overlay-toggle  menu-toggle  menu-open" aria-controls="primary-menu" aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'gema-lite' ); ?></span>
		</button>
		<button class="overlay-toggle  sidebar-toggle  sidebar-open"<?php if( ! is_single() ) echo ' disabled="disabled"'; ?> aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Open Sidebar', 'gema-lite' ); ?></span>
		</button>
	</div>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gema-lite' ); ?></a>

		<div id="content" class="site-content">
