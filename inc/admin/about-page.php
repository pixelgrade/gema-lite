<?php
/**
 * Gema Lite Theme About Page logic.
 *
 * @package Gema Lite
 */

function gemalite_admin_setup() {
	/**
	 * Load the About page class
	 */
	require_once 'ti-about-page/class-ti-about-page.php';

	/*
	* About page instance
	*/
	$config = array(
		// Menu name under Appearance.
		'menu_name'               => esc_html__( 'About Gema Lite', 'gema-lite' ),
		// Page title.
		'page_name'               => esc_html__( 'About Gema Lite', 'gema-lite' ),
		// Main welcome title
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %s! - Version ', 'gema-lite' ), 'Gema Lite' ),
		// Main welcome content
		'welcome_content'       => esc_html__( ' Gema Lite is a free magazine-style theme with clean type, smart layouts and a design flexibility that makes it perfect for publishers of all kinds.', 'gema-lite' ),
		/**
		 * Tabs array.
		 *
		 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
		 * the will be the name of the function which will be used to render the tab content.
		 */
		'tabs'                    => array(
			'getting_started'  => esc_html__( 'Getting Started', 'gema-lite' ),
			'recommended_actions' => esc_html__( 'Recommended Actions', 'gema-lite' ),
			'recommended_plugins' => esc_html__( 'Useful Plugins','gema-lite' ),
			'support'       => esc_html__( 'Support', 'gema-lite' ),
			'changelog'        => esc_html__( 'Changelog', 'gema-lite' ),
			'free_pro'         => esc_html__( 'Free VS PRO', 'gema-lite' ),
		),
		// Support content tab.
		'support_content'      => array(
			'first' => array (
				'title' => esc_html__( 'Contact Support','gema-lite' ),
				'icon' => 'dashicons dashicons-sos',
				'text' => __( 'We want to make sure you have the best experience using Gema Lite. If you <strong>do not have a paid upgrade</strong>, please post your question in our community forums.','gema-lite' ),
				'button_label' => esc_html__( 'Contact Support','gema-lite' ),
				'button_link' => esc_url( 'https://wordpress.org/support/theme/gema-lite' ),
				'is_button' => true,
				'is_new_tab' => true
			),
			'second' => array(
				'title' => esc_html__( 'Documentation','gema-lite' ),
				'icon' => 'dashicons dashicons-book-alt',
				'text' => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Gema Lite.','gema-lite' ),
				'button_label' => esc_html__( 'Read The Documentation','gema-lite' ),
				'button_link' => 'https://pixelgrade.com/gema-lite-documentation/',
				'is_button' => false,
				'is_new_tab' => true
			)
		),
		// Getting started tab
		'getting_started' => array(
			'first' => array(
				'title' => esc_html__( 'Go to Customizer','gema-lite' ),
				'text' => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.','gema-lite' ),
				'button_label' => esc_html__( 'Go to Customizer','gema-lite' ),
				'button_link' => esc_url( admin_url( 'customize.php' ) ),
				'is_button' => true,
				'recommended_actions' => false,
				'is_new_tab' => true
			),
			'second' => array (
				'title' => esc_html__( 'Recommended actions','gema-lite' ),
				'text' => esc_html__( 'We have compiled a list of steps for you, to take make sure the experience you will have using one of our products is very easy to follow.','gema-lite' ),
				'button_label' => esc_html__( 'Recommended actions','gema-lite' ),
				'button_link' => esc_url( admin_url( 'themes.php?page=gema-lite-welcome&tab=recommended_actions' ) ),
				'button_ok_label' => esc_html__( 'You are good to go!','gema-lite' ),
				'is_button' => false,
				'recommended_actions' => true,
				'is_new_tab' => false
			),
			'third' => array(
				'title' => esc_html__( 'Read the documentation','gema-lite' ),
				'text' => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Gema Lite.','gema-lite' ),
				'button_label' => esc_html__( 'Documentation','gema-lite' ),
				'button_link' => 'https://pixelgrade.com/gema-lite-documentation/',
				'is_button' => false,
				'recommended_actions' => false,
				'is_new_tab' => true
			)
		),
		// Free vs pro array.
		'free_pro'                => array(
			'free_theme_name'     => 'Gema Lite',
			'pro_theme_name'      => 'Gema PRO',
			'pro_theme_link'      => 'https://pixelgrade.com/themes/gema-lite/?utm_source=gema-lite-clients&utm_medium=about-page&utm_campaign=gema-lite#pro',
			'get_pro_theme_label' => sprintf( __( 'View %s', 'gema-lite' ), 'Gema Pro' ),
			'features'            => array(
				array(
					'title'       => esc_html__( 'Exquisite Design', 'gema-lite' ),
					'description' => esc_html__( 'Design is a great way to share appealing stories. Gema helps you to become a better storyteller into the digital world. Thanks to a very human approach in terms of interaction, a gentle and eye-candy typography and stylish details, you can definitely reach the right audience.', 'gema-lite' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Steady SEO', 'gema-lite' ),
					'description' => esc_html__( 'We’ve made everything it requires in terms of SEO practices so that you can have a proper start. In the end, everyone has a thing for how they show up in search engines.', 'gema-lite' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Mobile-Ready and Responsive for All Devices', 'gema-lite' ),
					'description' => esc_html__( 'One of the perks of living these days is the tremendous chance to stay connected with everything you love without boundaries. That’s why HIVE is mobile-ready and facilitates your users to easily enjoy your content, no matter the device they like to use on a daily basis.', 'gema-lite' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Smart and Customizable Type', 'gema-lite' ),
					'description' => esc_html__( 'Gema‘s elements all fit together seamlessly, and we’ve created a way to emphasize specific portions of your post and page titles.', 'gema-lite' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Social Integration', 'gema-lite' ),
					'description' => esc_html__( 'Let your voice be heard by the right people. Aim to build a strong community around your fashion blog and start a smart dialogue with those who admire your work. Facebook, Twitter, Instagram, you name it, but be aware that all can boost your content and increase awareness.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Personalize to Match Your Style', 'gema-lite' ),
					'description' => esc_html__( 'Having different tastes and preferences might be tricky for users, but not with Gema onboard. It has an intuitive and catchy interface which allows you to change fonts, colors or layout sizes in a blink of an eye.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Adaptive Layouts For Your Posts', 'gema-lite' ),
					'description' => esc_html__( 'We offer you the freedom to mix-and-match portrait images or long titles to bring extra value. Whether your featured image is in portrait or landscape mode, Gema takes care of it by changing the post layout to provide the right fit.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Post Formats', 'gema-lite' ),
					'description' => esc_html__( 'Make room for a wide range of post formats to pack your engaging stories so that people will enjoy sharing. Text, image, video, audio—you name it, and you’re covered.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => __( 'Support Best-In-Business', 'gema-lite' ),
					'description' => __( 'You will benefit by priority support from a caring and devoted team, eager to help and to spread happiness. We work hard to provide a flawless experience for those who vote us with trust and choose to be our special clients.','gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Comprehensive Help Guide', 'gema-lite' ),
					'description' => esc_html__( 'Extensive documentation that will help you get your site up quickly and seamlessly.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'No credit footer link', 'gema-lite' ),
					'description' => esc_html__( 'Remove "Theme: Gema Lite by Pixelgrade" copyright from the footer area.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				)
			),
		),
		// Plugins array.
		'recommended_plugins'        => array(
			'already_activated_message' => esc_html__( 'Already activated', 'gema-lite' ),
			'version_label' => esc_html__( 'Version: ', 'gema-lite' ),
			'install_label' => esc_html__( 'Install and Activate', 'gema-lite' ),
			'activate_label' => esc_html__( 'Activate', 'gema-lite' ),
			'deactivate_label' => esc_html__( 'Deactivate', 'gema-lite' ),
			'content'                   => array(
				array(
					'slug' => 'jetpack'
				),
				array(
					'slug' => 'wordpress-seo'
				),
//				array(
//					'slug' => 'gridable'
//				)
			),
		),
		// Required actions array.
		'recommended_actions'        => array(
			'install_label' => esc_html__( 'Install and Activate', 'gema-lite' ),
			'activate_label' => esc_html__( 'Activate', 'gema-lite' ),
			'deactivate_label' => esc_html__( 'Deactivate', 'gema-lite' ),
			'content'            => array(
				'jetpack' => array(
					'title'       => 'Jetpack',
					'description' => __( 'It is highly recommended that you install Jetpack so you can enable the <b>Portfolio</b> content type for adding and managing your projects. Plus, Jetpack provides a whole host of other useful things for you site.', 'gema-lite' ),
					'check'       => defined( 'JETPACK__VERSION' ),
					'plugin_slug' => 'jetpack',
					'id' => 'jetpack'
				),
			),
		),
	);
	TI_About_Page::init( $config );
}
add_action('after_setup_theme', 'gemalite_admin_setup');
