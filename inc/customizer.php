<?php
/**
 * Gema Lite Theme Customizer
 * @package Gema Lite
 */


/**
 * Change some default texts and add our own custom settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gema_lite_customize_register( $wp_customize ) {

	/*
	 * Change defaults
	 */

	// Add postMessage support for site title and tagline and title color.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Rename the label to "Display Site Title & Tagline" in order to make this option clearer.
	$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'gema-lite' );

	// Add a pretty icon to Site Identity
	$wp_customize->get_section( 'title_tagline' )->title = '&#x1f465; ' . esc_html__( 'Site Identity', 'gema-lite' );

	// View Pro
	$wp_customize->add_section( 'pro__section', array(
		'title'       => '' . esc_html__( 'View PRO Version', 'gema-lite' ),
		'priority'    => 2,
		'description' => sprintf(
			/* translators: %s: The theme pro link. */
			__( '<div class="upsell-container">
					<h2>Need More? Go PRO</h2>
					<p>Take it to the next level. See the features below:</p>
					<ul class="upsell-features">
                            <li>
                            	<h4>Personalize to Match Your Style</h4>
                            	<div class="description">Having different tastes and preferences might be tricky for users, but not with Gema onboard. It has an intuitive and catchy interface which allows you to change <strong>fonts, colors or layout sizes</strong> in a blink of an eye.</div>
                            </li>

                            <li>
                            	<h4>Adaptive Layouts For Your Posts</h4>
                            	<div class="description">Whether your featured image is in portrait or landscape mode, Gema takes care of it by changing the post layout to provide the right fit.</div>
                            </li>

                            <li>
                            	<h4>Premium Customer Support</h4>
                            	<div class="description">You will benefit by priority support from a caring and devoted team, eager to help and to spread happiness. We work hard to provide a flawless experience for those who vote us with trust and choose to be our special clients.</div>
                            </li>
                            
                    </ul> %s </div>', 'gema-lite' ),
			/* translators: %1$s: The theme pro URL, %2$s: The theme pro link text.  */
			sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( gema_lite_get_pro_link() ), esc_html__( 'View Gema PRO', 'gema-lite' ) )
		),
	) );

	$wp_customize->add_setting( 'gema_lite_style_view_pro_desc', array(
		'default'           => '',
		'sanitize_callback' => '__return_true',
	) );
	$wp_customize->add_control( 'gema_lite_style_view_pro_desc', array(
		'section' => 'pro__section',
		'type'    => 'hidden',
	) );

}
add_action( 'customize_register', 'gema_lite_customize_register', 15 );

/**
 * Sanitize the Site Title Outline value.
 *
 * @param string $outline Outline thickness.
 *
 * @return string Filtered outline (0|1|2|3).
 */
function gema_lite_sanitize_site_title_outline( $outline ) {
	if ( ! in_array( $outline, array( '0', '1.2', '3', '5', '10' ) ) ) {
		$outline = '3';
	}

	return $outline;
}

/**
 * Assets that will be loaded for the customizer sidebar
 */
function gema_lite_customizer_assets() {
	wp_enqueue_style( 'gemalite-customizer-style', get_template_directory_uri() . '/inc/admin/css/customizer.css', array(), '1.1.4', false );
}
add_action( 'customize_controls_enqueue_scripts', 'gema_lite_customizer_assets' );

/**
 * JavaScript that handles the Customizer AJAX logic
 * This will be added in the preview part
 */
function gema_lite_customizer_preview_assets() {
	wp_enqueue_script( 'gema_lite_customizer_preview', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), '1.1.4', true );
}
add_action( 'customize_preview_init', 'gema_lite_customizer_preview_assets' );

/**
 * Generate a link to the Gema Lite info page.
 */
function gema_lite_get_pro_link() {
	return 'https://pixelgrade.com/themes/blogging/gema-lite?utm_source=gema-lite-clients&utm_medium=customizer&utm_campaign=gema-lite#pro';
}
