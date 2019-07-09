<?php
/**
 * Gema functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gema Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'gema_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function gema_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Gema, use a find and replace
	 * to change 'gema' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '__theme_txtd', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	//used as featured image for posts on home page and archive pages
	add_image_size( 'gema-super-small', 10, 10, false );
	add_image_size( 'gema-archive-landscape', 432, 9999, false );
	add_image_size( 'gema-archive-portrait', 396, 9999, false );

	//used for the single post featured image
	add_image_size( 'gema-single-landscape', 1120, 9999, false );
	add_image_size( 'gema-single-portrait', 660, 9999, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', '__theme_txtd' ),
		'footer'  => esc_html__( 'Footer Menu', '__theme_txtd' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Gema 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 220,
		'width'       => 710,
		'flex-height' => true,
		'header-text' => array(
			'site-title',
			'site-description-text',
		)
	) );

	add_image_size( 'gema-site-logo', 710, 220, false );

	/*
	 * Add editor styles and fonts
	 */
	add_editor_style( array( gema_lite_montserrat_font_url() ) );
	add_editor_style( array( 'editor-style.css' ) );
}
endif; // gema_lite_setup
add_action('after_setup_theme', 'gema_lite_setup' );

/*
 * Enable support for Post Formats.
 * See https://developer.wordpress.org/themes/functionality/post-formats/
 */
add_theme_support( 'post-formats', array( 'quote', 'gallery', 'video', 'audio', 'image', 'link' ) );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gema_lite_content_width() {
    $GLOBALS['content_width'] = apply_filters('gema_content_width', 660);
}
add_action('after_setup_theme', 'gema_lite_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function gema_lite_scripts() {
	$theme = wp_get_theme( get_template() );

	// The main theme stylesheet
	wp_enqueue_style( 'gema-style', get_parent_theme_file_uri( 'style.css' ), array(), $theme->get( 'Version' ) );
	wp_style_add_data( 'gema-style', 'rtl', 'replace' );

	/* Default Self-hosted Fonts */
	wp_enqueue_style( 'gema-fonts-montserrat', gema_lite_montserrat_font_url() );
	wp_enqueue_style( 'gema-fonts-butler', gema_lite_butler_font_url() );

	wp_register_script('bricklayer', get_parent_theme_file_uri( 'js/bricklayer.js' ), array(), '20170421', true);
	wp_enqueue_script('gema-modernizr', get_parent_theme_file_uri( 'js/modernizr-custom.js' ), array(), '20160322', true);

	/* Enqueue the main theme script file */
	wp_enqueue_script( 'gema-scripts', get_parent_theme_file_uri( 'assets/js/main.js' ), array( 'jquery', 'bricklayer', 'imagesloaded', 'hoverIntent' ), $theme->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'gema_lite_scripts' );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Gema Lite 1.0.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function gema_lite_content_image_sizes_attr( $sizes, $size ) {
	$sizes = '(max-width: 600px) 91vw, (max-width: 900px) 600px, (max-width: 1060px) 50vw, (max-width: 1200px) 520px, (max-width: 1400px) 43vw, 600px';
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'gema_lite_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Gema Lite 1.0.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array A source size value for use in a post thumbnail 'sizes' attribute.
 */
function gema_lite_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	switch ($size) {
		case 'gema-single-landscape':
		case 'gema-single-portrait':
			$attr['sizes'] = '(max-width: 900px) 100vw, (max-width: 1260px) 920px, 1060px';
			break;
		case 'gema-portrait':
			$attr['sizes'] = '(max-width: 470px) 100vw, 432px';
			break;
		case 'gema-landscape':
			$attr['sizes'] = '(max-width: 470px) 100vw, 396px';
			break;
		default:
			break;
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'gema_lite_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load the Hybrid Media Grabber class
 */
require get_template_directory() . '/inc/hybrid-media-grabber.php';
