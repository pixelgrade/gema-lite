<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gema
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'gema-lite' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'gema-lite' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'gema-lite' ), 'Gema', '<a href="https://pixelgrade.com/" rel="designer">PixelGrade</a>' ); ?>
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