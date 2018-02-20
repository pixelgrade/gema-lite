<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gema
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<button class="overlay-toggle  sidebar-toggle  right-close-button" aria-expanded="false">
		<span class="screen-reader-text"><?php esc_html_e( 'Close Sidebar', 'gema' ); ?></span>
	</button>
</aside><!-- #secondary -->
