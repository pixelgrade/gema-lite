<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gema Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', '__theme_txtd' ) ); ?>"><?php /* translators: %s: WordPress  */ printf( esc_html__( 'Proudly powered by %s', '__theme_txtd' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php /* translators: %1$s: The theme name, %2$s: The theme author name. */ printf( esc_html__( 'Theme: %1$s by %2$s.', '__theme_txtd' ), 'Gema Lite', '<a href="https://pixelgrade.com/?utm_source=gema-lite-clients&utm_medium=footer&utm_campaign=gema-lite" title="' . esc_html__( 'The Pixelgrade Website', '__theme_txtd' ) . '" rel="nofollow">Pixelgrade</a>' ); ?>
		</div><!-- .site-info -->
		<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'menu_id' => 'footer-menu',
				'menu_class' => 'footer-menu',
				'depth' => 1,
				'container' => false
		) ); ?>
	</footer><!-- #colophon -->
	<div class="overlay-shadow"></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
