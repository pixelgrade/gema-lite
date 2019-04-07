<?php
/**
 * Template part for displaying the header "card".
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gema
 */

?>

<header id="masthead" class="site-header" role="banner">
	<div class="site-branding">

		<?php gemalite_the_custom_logo(); ?>

		<?php
		// on the front page and home page we use H1 for the title
		echo ( is_front_page() && is_home() ) ? '<h1 class="site-title">' : '<div class="site-title">'; ?>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span><?php bloginfo( 'name' ); ?></span>
		</a>

		<?php
		echo ( is_front_page() && is_home() ) ? '</h1>' : '</div>';

		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>

			<p class="site-description-text"><?php echo $description; /* WPCS: xss ok. */ ?></p>

		<?php endif; ?>

	</div><!-- .site-branding -->

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="overlay-toggle  menu-toggle  menu-close" aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Close Primary Menu', 'gema-lite' ); ?></span>
		</button>

		<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'nav-menu',
				'container'      => ''
		) ); ?>

		<?php if ( function_exists( 'jetpack_social_menu' ) ) jetpack_social_menu(); ?>

	</nav><!-- #site-navigation -->

</header><!-- #masthead -->
