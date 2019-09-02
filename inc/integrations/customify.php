<?php
/**
 * Gema Customizer Options Config
 *
 * @package Gema Lite
 * @since 1.2.3
 */

/**
 * Hook into the Customify's fields and settings.
 *
 * The config can turn to be complex so is better to visit:
 * https://github.com/pixelgrade/customify
 *
 * @param $options array - Contains the plugin's options array right before they are used, so edit with care
 *
 * @return mixed The return of options is required, if you don't need options return an empty array
 *
 */


add_filter( 'customify_filter_fields', 'gema_lite_add_customify_options', 11, 1 );
add_filter( 'customify_filter_fields', 'gema_lite_add_customify_style_manager_section', 12, 1 );

add_filter( 'customify_filter_fields', 'gema_lite_fill_customify_options', 20 );

define( 'GEMALITE_SM_COLOR_PRIMARY', '#e03a3a' );
define( 'GEMALITE_SM_COLOR_SECONDARY', '#f75034' );
define( 'GEMALITE_SM_COLOR_TERTIARY', '#ad2d2d' );

define( 'GEMALITE_SM_DARK_PRIMARY', '#000000' );
define( 'GEMALITE_SM_DARK_SECONDARY', '#000000' );
define( 'GEMALITE_SM_DARK_TERTIARY', '#a3a3a1' );

define( 'GEMALITE_SM_LIGHT_PRIMARY', '#ffffff' );
define( 'GEMALITE_SM_LIGHT_SECONDARY', '#f7f5f5' );
define( 'GEMALITE_SM_LIGHT_TERTIARY', '#f7f2f2' );

function gema_lite_add_customify_options( $options ) {
	$options['opt-name'] = 'gema_options';

	$options['sections'] = array();

	return $options;
}

/**
 * Add the Style Manager cross-theme Customizer section.
 *
 * @param array $options
 *
 * @return array
 */
function gema_lite_add_customify_style_manager_section( $options ) {
	// If the theme hasn't declared support for style manager, bail.
	if ( ! current_theme_supports( 'customizer_style_manager' ) ) {
		return $options;
	}


	if ( ! isset( $options['sections']['style_manager_section'] ) ) {
		$options['sections']['style_manager_section'] = array();
	}

	$new_config = array(
		'options' => array(
			// Color Palettes Assignment.
			'sm_color_primary'   => array(
				'default' => GEMALITE_SM_COLOR_PRIMARY,
			),
			'sm_color_secondary' => array(
				'default' => GEMALITE_SM_COLOR_SECONDARY,
			),
			'sm_color_tertiary'  => array(
				'default' => GEMALITE_SM_COLOR_TERTIARY,
			),
			'sm_dark_primary'    => array(
				'default'          => GEMALITE_SM_DARK_PRIMARY,
				'connected_fields' => array(
					// medium
					'main_content_page_title_color',
					'header_links_active_color',

					// high
					'blog_item_title_color',
					'pxg_nothing1',

					// striking
					'header_navigation_links_color',
					'pxg_nothing2',

					// always dark
					'pxg_nothing3',
					'pxg_nothing4',
				),
			),
			'sm_dark_secondary'  => array(
				'default'          => GEMALITE_SM_DARK_SECONDARY,
				'connected_fields' => array(
					// medium
					'footer_body_text_color',
					'main_content_heading_1_color',

					// high
					'main_content_heading_2_color',
					'main_content_heading_3_color',

					// striking
					'main_content_heading_4_color',
					'main_content_heading_5_color',

					// always dark
					'main_content_heading_6_color',
					'main_content_body_text_color',
				),
			),
			'sm_dark_tertiary'   => array(
				'default'          => GEMALITE_SM_DARK_TERTIARY,
				'connected_fields' => array(
					// medium
					'main_content_body_link_color',

					// high
					'blog_item_meta_secondary_color',
					'main_content_body_link_active_color',

					// striking
					'footer_links_color',
					'blog_item_meta_primary_color',
				),
			),
			'sm_light_primary'   => array(
				'default'          => GEMALITE_SM_LIGHT_PRIMARY,
				'connected_fields' => array(
					'main_content_background_color',
					'blog_item_background_color',
					'footer_background',
				),
			),
			'sm_light_secondary' => array(
				'connected_fields' => array(
					'main_content_border_color',
				),
				'default'          => GEMALITE_SM_LIGHT_SECONDARY,
			),
			'sm_light_tertiary'  => array(
				'default' => GEMALITE_SM_LIGHT_TERTIARY,
			),
		),
	);

	// The section might be already defined, thus we merge, not replace the entire section config.
	if ( class_exists( 'Customify_Array' ) && method_exists( 'Customify_Array', 'array_merge_recursive_distinct' ) ) {
		$options['sections']['style_manager_section'] = Customify_Array::array_merge_recursive_distinct( $options['sections']['style_manager_section'], $new_config );
	} else {
		$options['sections']['style_manager_section'] = array_merge_recursive( $options['sections']['style_manager_section'], $new_config );
	}

	return $options;
}

function gema_lite_fill_customify_options( $options ) {
	$new_config = array(
		// Header
		'blog_grid_section' => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'blog_item_title_color'          => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Item Title Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.card h2',
						),
					),
				),
				'blog_item_meta_primary_color'   => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Meta Primary', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_TERTIARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.card__meta-primary',
						),
					),
				),
				'blog_item_meta_secondary_color' => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Meta Secondary', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_TERTIARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.card__meta-secondary',
						),
					),
				),
				'blog_item_background_color'     => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Card Background Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '
							#sb_instagram #sbi_images .sbi_photo,
							.content-quote:before,
							.singular .entry-header, 
							.attachment .entry-header,
							.widget,
							.card--text .card__wrap,
							.card__image,
							.card__title,
							.sticky.card--text .card__wrap:before,
                            .jetpack_subscription_widget.widget:before,
                            .widget_blog_subscription.widget:before,
                            .card--text .card__meta,
                            input[type="text"],
							input[type="password"],
							input[type="datetime"],
							input[type="datetime-local"],
							input[type="date"],
							input[type="month"],
							input[type="time"],
							input[type="week"],
							input[type="number"],
							input[type="email"],
							input[type="url"],
							input[type="search"],
							input[type="tel"],
							input[type="color"],
							select,
							textarea',
						),
					),
				),
			)
		),

		'header_section' => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'header_navigation_links_color' => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Navigation Links Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.main-navigation li a, .main-navigation li:after',
						),
						array(
							'property' => 'background-color',
							'selector' => '.nav-menu ul li.hover > a',
							'media'    => 'only screen and (min-width: 900px)',
						),

						array(
							'property' => 'border-color',
							'selector' => '.nav-menu ul',
							'media'    => 'only screen and (min-width: 900px)',
						),
					),
				),
				'header_links_active_color'     => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Links Active Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.main-navigation .nav-menu > li[class*="current-menu"] > a, 
								.main-navigation .nav-menu > li[class*="current-menu"]:after,
								.jetpack-social-navigation li[class*="current-menu"] > a,
								.main-navigation .nav-menu > li:hover > a, 
								.main-navigation .nav-menu > li:hover:after,
								.jetpack-social-navigation li:hover > a',
						),
						array(
							'property' => 'border-bottom-color',
							'selector' => '.main-navigation.main-navigation .nav-menu > li > a:after',
						),
					),
				),
			)
		),

		'main_content_section' => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'main_content_border_color'           => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Site Border Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_LIGHT_SECONDARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => 'html',
						),
					),
				),
				'main_content_page_title_color'       => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Page Title Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.entry-header .entry-title',
						),
					),
				),
				'main_content_body_text_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Body Text Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'body',
						),
						array(
							'property' => 'background-color',
							'selector' => 'input[type="submit"], .btn, .search-submit, div#infinite-handle span button, div#infinite-handle span button:hover, .more-link,
								.sticky.card--text .card__wrap:after,
								.sticky.card--text .card__meta,
								body div.sharedaddy div.sd-social-icon div.sd-content ul li[class*="share-"] a.sd-button:hover',
						),
						array(
							'property'        => 'border-color',
							'selector'        => 'input[type="text"], 
								input[type="password"], 
								input[type="datetime"], 
								input[type="datetime-local"], 
								input[type="date"], 
								input[type="month"], 
								input[type="time"], 
								input[type="week"], 
								input[type="number"], 
								input[type="email"], 
								input[type="url"], 
								input[type="search"], 
								input[type="tel"], 
								input[type="color"], 
								select, 
								textarea',
							'callback_filter' => 'gema_color_opacity_adjust_cb'
						),
						array(
							'property' => 'border-color',
							'selector' => 'body div.sharedaddy div.sd-social-icon div.sd-content ul li[class*="share-"] a.sd-button:hover',
						),
						array(
							'property'        => 'border-bottom-color',
							'selector'        => '.singular .site-header, .attachment .site-header',
							'callback_filter' => 'gema_color_opacity_adjust_cb'
						),
					),
				),
				'main_content_body_link_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Body Link Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_TERTIARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.entry-content a, 
								.comment__content a',
						),
					),
				),
				'main_content_body_link_active_color' => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Body Link Active Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_TERTIARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.entry-content a:hover, 
								.entry-content a:focus, 
								.comment__content a:hover, 
								.comment__content a:focus',
						),
					),
				),
				'main_content_heading_1_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Heading 1', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h1',
						),
					),
				),
				'main_content_heading_2_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Heading 2', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h2',
						),
					),
				),
				'main_content_heading_3_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Heading 3', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h3'
						),
					),
				),
				'main_content_heading_4_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Heading 4', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h4',
						),
					),
				),
				'main_content_heading_5_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Heading 5', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h5',
						),
					),
				),
				'main_content_heading_6_color'        => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Heading 6', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h6',
						),
					),
				),
				'main_content_background_color'       => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Content Background Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'selector' => '
	                            .comment__avatar, 
	                            .sticky, 
	                            body.singular .nav-menu > li > a:before, 
                                .bypostauthor > .comment__article .comment__avatar,
                                .overlay-shadow',
							'property' => 'background-color',
						),
						array(
							'selector' => '
								body, 
	                            .mobile-header-wrapper, 
	                            .main-navigation',
							'property' => 'background'
						),
						array(
							'selector' => '.nav-menu ul',
							'media'    => 'only screen and (min-width: 900px)',
							'property' => 'background'
						),
						array(
							'selector' => '.widget-area',
							'media'    => 'not screen and (min-width: 900px)',
							'property' => 'background'
						),
						array(
							'property' => 'color',
							'selector' => '
								input[type="submit"], 
	                            .btn, 
	                            div#infinite-handle span button, 
	                            div#infinite-handle span button:hover, 
	                            .more-link, 
	                            .comment__content a,
	                            .nav-menu ul li.hover:after,
	                            div#subscribe-text p,
	                            .jetpack_subscription_widget .widget__title, 
	                            .widget_blog_subscription .widget__title,
	                            .jetpack_subscription_widget p,
	                            .jetpack_subscription_widget input[type="submit"],
	                            .widget_blog_subscription input[type="submit"],
	                            .sticky.card--text .card__wrap,
	                            .sticky.card--text .card__meta,
	                            .sticky.card--text .cat-links, 
	                            .sticky.card--text .byline .author, 
	                            .sticky.card--text .post-edit-link,
	                            .sticky.card--text.card h2',
						),
						array(
							'property' => 'border-color',
							'selector' => '
                            .jetpack_subscription_widget input[type=\'submit\'],
                            .sticky.card--text .btn, 
                            .sticky.card--text .search-submit, 
                            .sticky.card--text div#infinite-handle span button, 
                            div#infinite-handle span .sticky.card--text button, 
                            .sticky.card--text .more-link'
						),
						array(
							'property' => 'border-right-color',
							'selector' => '.nav-menu:before'
						),
						array(
							'property' => 'border-left-color',
							'selector' => '.nav-menu:before'
						),
						array(
							'property'        => 'color',
							'selector'        => 'body div.sharedaddy div.sd-social-icon div.sd-content ul li[class*="share-"] a.sd-button:hover',
							'callback_filter' => 'gema_important_rule'
						),
						array(
							'selector'        => '.is--webkit .dropcap',
							'property'        => 'background-image',
							'callback_filter' => 'gema_dropcap_style'
						),
					),
				),
			)
		),

		'footer_section' => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'footer_body_text_color' => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Body Text Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.site-footer',
						),
					),
				),
				'footer_links_color'     => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Links Color', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_DARK_TERTIARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.site-footer a',
						),
					),
				),
				'footer_background'      => array(
					'type'    => 'hidden_control',
					'label'   => esc_html__( 'Footer Background', 'gema-lite' ),
					'live'    => true,
					'default' => GEMALITE_SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'property' => 'background',
							'selector' => '.site-footer',
						),
					),
				),
			)
		)
	);

	if ( class_exists( 'Customify_Array' ) && method_exists( 'Customify_Array', 'array_merge_recursive_distinct' ) ) {
		$options['sections'] = Customify_Array::array_merge_recursive_distinct( $options['sections'], $new_config );
	} else {
		$options['sections'] = array_merge_recursive( $options['sections'], $new_config );
	}

	return $options;
}

if ( ! function_exists( 'gema_sticky_boxshadow' ) ) {
	function gema_sticky_boxshadow( $value, $selector, $property, $unit ) {

		$border_color = pixelgrade_option( 'main_content_body_text_color' );

		$output = $selector . '{
			box-shadow: 0 0 0 8px ' . $value . ', 0 0 0 9px ' . $border_color . ";\n" .
		          "}\n";

		return $output;
	}
}

if ( ! function_exists( 'gema_dropcap_style' ) ) {

	function gema_dropcap_style( $value, $selector, $property, $unit ) {
		$output = '';

		$output .= $selector . ' {' . PHP_EOL .
		           $property . ': linear-gradient(45deg, currentColor 0%, currentColor 10%, ' . $value . ' 10%, ' . $value . ' 40%, currentColor 40%, currentColor 60%, ' . $value . ' 60%, ' . $value . ' 90%, currentColor 90%, currentColor 100%)' .
		           '}' . PHP_EOL;

		return $output;
	}
}

if ( ! function_exists( 'gema_dropcap_style_customizer_preview' ) ) {

	function gema_dropcap_style_customizer_preview() {

		$js = "
        function gema_dropcap_style( value, selector, property, unit ) {
        
            var css = '',
                style = document.getElementById('gema_dropcap_style_style_tag'),
                head = document.head || document.getElementsByTagName('head')[0];
        
            css += selector + ' {' +
                property + ': linear-gradient(45deg, currentColor 0%, currentColor 10%, ' + value + ' 10%, ' + value + ' 40%, currentColor 40%, currentColor 60%, ' + value + ' 60%, ' + value + ' 90%, currentColor 90%, currentColor 100%)' +
            '}';
        
            if ( style !== null ) {
                style.innerHTML = css;
            } else {
                style = document.createElement('style');
                style.setAttribute('id', 'gema_dropcap_style_style_tag');
        
                style.type = 'text/css';
                if ( style.styleSheet ) {
                    style.styleSheet.cssText = css;
                } else {
                    style.appendChild(document.createTextNode(css));
                }
        
                head.appendChild(style);
            }
        }" . PHP_EOL;

		wp_add_inline_script( 'customify-previewer-scripts', $js );
	}
}

if ( ! function_exists( 'gema_important_rule' ) ) {

	function gema_important_rule( $value, $selector, $property, $unit ) {
		$output = '';

		$output .= $selector . ' {' . PHP_EOL .
		           $property . ': ' . $value . $unit . ' !important;' .
		           '}' . PHP_EOL;

		return $output;
	}
}

if ( ! function_exists( 'gema_important_rule_customizer_preview' ) ) {

	function gema_important_rule_customizer_preview() {

		$js = "
        function gema_important_rule( value, selector, property, unit ) {
        
            var css = '',
                style = document.getElementById('gema_important_rule_style_tag'),
                head = document.head || document.getElementsByTagName('head')[0];
        
            css += selector + ' {' +
                property + ': ' + value + unit + ' !important;' +
            '}';
        
            if ( style !== null ) {
                style.innerHTML = css;
            } else {
                style = document.createElement('style');
                style.setAttribute('id', 'gema_important_rule_style_tag');
        
                style.type = 'text/css';
                if ( style.styleSheet ) {
                    style.styleSheet.cssText = css;
                } else {
                    style.appendChild(document.createTextNode(css));
                }
        
                head.appendChild(style);
            }
        }" . PHP_EOL;

		wp_add_inline_script( 'customify-previewer-scripts', $js );
	}
}

add_action( 'customize_preview_init', 'gema_important_rule_customizer_preview', 20 );

if ( ! function_exists( 'gema_color_opacity_adjust_cb' ) ) {
	function gema_color_opacity_adjust_cb( $value, $selector, $property, $unit ) {

		// Get our color
		if ( empty( $value ) || ! preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) {
			return '';
		}

		$r = hexdec( $value[1] . $value[2] );
		$g = hexdec( $value[3] . $value[4] );
		$b = hexdec( $value[5] . $value[6] );

		// if it is not a dark color, just go for the default way
		$output = $selector . ' {' .
		          $property . ': rgba(' . $r . ',' . $g . ',' . $b . ', 0.25);
		}';

		return $output;
	}
}

if ( ! function_exists( 'gema_color_opacity_adjust_cb_customizer_preview' ) ) {

	function gema_color_opacity_adjust_cb_customizer_preview() {
		$js = "
        function hexdec(hexString) {
            hexString = (hexString + '').replace(/[^a-f0-9]/gi, '');
            return parseInt(hexString, 16)
        }

        function gema_color_opacity_adjust_cb( value, selector, property, unit ) {
            var css = '',
                style = document.getElementById('gema_color_opacity_adjust_cb_style_tag'),
                head = document.head || document.getElementsByTagName('head')[0],
                r = hexdec(value[1] + '' + value[2]),
                g = hexdec(value[3] + '' + value[4]),
                b = hexdec(value[5] + '' + value[6]);

            css += selector + ' { ' + property + ': rgba(' + r + ',' + g + ',' + b + ',0.2); } ';
            
            if ( style !== null ) {
                style.innerHTML = css;
            } else {
                style = document.createElement('style');
                style.setAttribute('id', 'gema_color_opacity_adjust_cb_style_tag');

                style.type = 'text/css';
                if ( style.styleSheet ) {
                    style.styleSheet.cssText = css;
                } else {
                    style.appendChild(document.createTextNode(css));
                }

                head.appendChild(style);
            }
        }" . PHP_EOL;

		wp_add_inline_script( 'customify-previewer-scripts', $js );
	}

	add_action( 'customize_preview_init', 'gema_color_opacity_adjust_cb_customizer_preview' );
}

function gema_lite_add_default_color_palette( $color_palettes ) {

	$color_palettes = array_merge( array(
		'default' => array(
			'label'   => esc_html__( 'Theme Default', 'gema-lite' ),
			'preview' => array(
				'background_image_url' => 'https://cloud.pixelgrade.com/wp-content/uploads/2018/05/gema-theme-palette.jpg',
			),
			'options' => array(
				'sm_color_primary'   => GEMALITE_SM_COLOR_PRIMARY,
				'sm_color_secondary' => GEMALITE_SM_COLOR_SECONDARY,
				'sm_color_tertiary'  => GEMALITE_SM_COLOR_TERTIARY,
				'sm_dark_primary'    => GEMALITE_SM_DARK_PRIMARY,
				'sm_dark_secondary'  => GEMALITE_SM_DARK_SECONDARY,
				'sm_dark_tertiary'   => GEMALITE_SM_DARK_TERTIARY,
				'sm_light_primary'   => GEMALITE_SM_LIGHT_PRIMARY,
				'sm_light_secondary' => GEMALITE_SM_LIGHT_SECONDARY,
				'sm_light_tertiary'  => GEMALITE_SM_LIGHT_TERTIARY,
			),
		),
	), $color_palettes );

	return $color_palettes;
}

add_filter( 'customify_get_color_palettes', 'gema_lite_add_default_color_palette' );
