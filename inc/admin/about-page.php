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
					'title'       => esc_html__( 'Daring Design for Devoted Readers', 'gema-lite' ),
					'description' => esc_html__( 'With a unique grid layout, balanced range of diverse post layouts, and thoughtful choice of type and whitespace, Gema has a sharp and lightweight look. Precise animations set the right tone for your stories.', 'gema-lite' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Mobile-Ready For All Devices', 'gema-lite' ),
					'description' => esc_html__( 'Gema makes room for your readers to enjoy your articles on the go, no matter the device their using. We lend a hand by showcasing it beautifully to your audience.', 'gema-lite' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Widgetized Sidebar To Keep Attention', 'gema-lite' ),
					'description' => esc_html__( 'Gema allows you to add your favorite widgets to the right side of your articles. Newsletter, categories, comments, you have them all at your fingertips.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Social Icons for Stronger Bonds', 'gema-lite' ),
					'description' => esc_html__( 'Gema\'s your go-to product if you really care about being easy to found on social media. By using them you could efficiently direct your audience towards your social activity where they can connect with you and become loyal followers.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Adaptive Layouts For Your Posts', 'gema-lite' ),
					'description' => esc_html__( 'Gema adjusts the post layout so that you can display the featured image in portrait and landscape mode by the blink of an eye. This way, you can always make the most out of your visual look-and-feel.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Post Formats', 'gema-lite' ),
					'description' => esc_html__( 'Gema makes the most out of the wide range of post formats to help you pack your stories beautifully. Text, image, video, audio, everything works flawlessly.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Social Sharing Features To Boost Traffic', 'gema-lite' ),
					'description' => esc_html__( 'Gema comes with a subtle approach on helping you increase engagement by displaying social sharing buttons at the end of each post. This way, you give people a handy option to spread the word about your content right on time.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Premium Support and Assistance', 'gema-lite' ),
					'description' => esc_html__( 'We offer customer support and assistance to help you get the best results in due time. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => __( 'Friendly Self-Service', 'gema-lite' ),
					'description' => __( 'We give you full access to an in-depth documentation to get the job done as quickly as possible. We don\'t stay in your way because we know you can make it too.','gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'No Credit Footer Link', 'gema-lite' ),
					'description' => esc_html__( 'You can easily remove the “Theme: Gema Lite by Pixelgrade” copyright from the footer area and make the theme yours from start to finish.', 'gema-lite' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
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
