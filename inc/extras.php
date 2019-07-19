<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gema Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Gema Lite 1.0
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function gema_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_singular( array( 'post', 'page', 'jetpack-portfolio' ) ) ) {
		$classes[] = 'singular';

		//add a dedicated class for the presence of a featured image
		if ( has_post_thumbnail() ) {
			$classes[] = 'has-featured-image';
		} else {
			$classes[] = 'no-featured-image';
		}

	} else {
		// Adds a class of hfeed to non-singular pages.
		$classes[] = 'hfeed';
	}

	if ( is_404() ) {
		$classes[] = 'singular';
	}

	// Search - no results, No posts page
	if ( ! have_posts() ) {
		$classes[] = 'singular';
	}

	return $classes;
}
add_filter( 'body_class', 'gema_lite_body_classes' );

/**
 * Add custom classes for individual posts
 *
 * @since Gema Lite 1.0
 *
 * @param array $classes
 *
 * @return array
 */
function gema_lite_post_classes( $classes ) {

	if ( is_archive() || is_home() || is_search() ) {
		$classes[] = 'grid__item  card';

		// add a dedicated class for the presence of a featured image - when no featured image we treat it as text
		$post_format = get_post_format();

		if ( has_post_thumbnail() || ( $post_format === 'gallery' && get_post_gallery() ) || $post_format === 'video' ) {
			$classes[] = 'card--image card--' . gema_lite_get_post_thumbnail_aspect_ratio_class();
		} elseif ( 'image' == $post_format ) {
			// Search for the content image
			$first_image = gema_lite_get_post_format_first_image();
			if ( ! empty( $first_image ) ) {
				$classes[] = 'card--image card--portrait';
			} else {
				$classes[] = 'card--text card--portrait';
			}
		} elseif ( 'audio' == $post_format ) {
			// We need to treat the audio post format a little differently due to the fact that it can sit in the title also (without a visual representation)
			// Grab the audio media details from the content, if it exists
			$media_details = gema_lite_audio_attachment( true );
			// Determine if this doesn't have a visual representation and should sit in the title not in the "image"
			$visual_media = gema_lite_is_visual_media( 'audio', $media_details );
			if ( ! $visual_media ) {
				$classes[] = 'card--text';
			} else {
				$classes[] = 'card--image card--' . gema_lite_get_post_thumbnail_aspect_ratio_class();
			}

			// Send a "signal" that this is an embed and should not cover it's controls
			if ( in_array( 'embed', $media_details['format'] ) ) {
				$classes[] = 'card--audio-embed';
			}
		} else {
			$classes[] = 'card--text card--portrait';
		}

	} else {
		$classes[] = 'entry-image--' . gema_lite_get_post_thumbnail_aspect_ratio_class();
	}

	return $classes;
}
add_filter( 'post_class', 'gema_lite_post_classes' );

/**
 * Wrap the current page number for single post/page navigation
 *
 * @since Gema Lite 1.0
 *
 * @param string $link
 * @param int $i
 *
 * @return string
 */
function gema_lite_wrap_current_pages_link( $link, $i ) {
	global $page;

	if ( $i == $page ) {
		$link = '<span class="current">' . $link . '</span>';
	}

	return $link;
}
add_filter( 'wp_link_pages_link', 'gema_lite_wrap_current_pages_link', 10, 2 );

/**
 * Use a template for individual comment output
 *
 * @since Gema Lite 1.0
 *
 * @param object $comment Comment to display.
 * @param int    $depth   Depth of comment.
 * @param array  $args    An array of arguments.
 */
function gema_lite_comment_markup( $comment, $args, $depth ) {
	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			?>
			<li class="post pingback parent">
			<article>
				<div class="media__body">
					<header class="comment__meta">
						<span class="comment__author"><?php esc_html_e( 'Pingback:', 'gema-lite' ); ?></span>
						<div class="comment__links">
							<?php
							//we need some space before Edit
							edit_comment_link( esc_html__( 'Edit', 'gema-lite' ), '  ' );
							?>
						</div>
					</header>
					<!-- .comment-meta -->
					<section class="comment__content">
						<?php comment_author_link(); ?>
					</section>
				</div>
			</article>
			<!-- </li> is added by WordPress automatically -->
			<?php
			break;

		default : ?>

			<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID() ?>" class="comment__article  media">
				<?php
				// grab the avatar - by default the Mystery Man
				$avatar = get_avatar( $comment, $args['avatar_size'] ); ?>

				<aside
					class="comment__avatar  media__img"><?php echo wp_kses( $avatar, array_merge_recursive( wp_kses_allowed_html( 'post' ), array( 'img' => array( 'srcset' => true, ), ) ) ); ?></aside>

				<div class="media__body">
					<header class="comment__meta">
						<?php printf( '<span class="comment__author">%s</span>', get_comment_author_link() ) ?>
						<time class="comment__time" datetime="<?php comment_time( 'c' ); ?>">
							<a href="<?php echo esc_url( get_comment_link( get_comment_ID() ) ) ?>"
							   class="comment__timestamp"><?php
								printf(
								/* translators: %1$s: The comment date, %2$s: The comment time. */
									esc_html__( 'on %1$s at %2$s', 'gema-lite' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?> </a>
						</time>
						<div class="comment__links">
							<?php
							//we need some space before Edit
							edit_comment_link( esc_html__( 'Edit', 'gema-lite' ), '  ' );

							comment_reply_link( array_merge( $args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
							) ) );
							?>
						</div>
					</header>
					<!-- .comment-meta -->
					<section class="comment__content">
						<?php comment_text() ?>
					</section>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<div class="comment__alert">
							<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'gema-lite' ) ?></p>
						</div>
					<?php endif; ?>
				</div>
			</article>
			<!-- </li> is added by WordPress automatically -->
			<?php
			break;
	}
}

/**
 * Generate the Butler font URL
 *
 * @since Gema Lite 1.0
 *
 * @return string
 */
function gema_lite_butler_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by Butler, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$butler = esc_html_x( 'on', 'Butler font: on or off', 'gema-lite' );
	if ( 'off' !== $butler ) {
		return get_parent_theme_file_uri( '/assets/fonts/butler/stylesheet.css' );
	}

	return '';
}

/**
 * Remove 'Category', 'Tag' etc. from archive titles
 *
 * @since Gema Lite 1.0
 *
 * @param string $title The archive title
 *
 * @return string
 */
function gema_lite_cleanup_archive_title( $title ) {

	if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = '<span class="vcard">' . get_the_author() . '</span>' ;

	}

	return $title;
}
add_filter( 'get_the_archive_title', 'gema_lite_cleanup_archive_title', 10, 1 );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function gema_lite_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
// We will put this script inline since it is so small.
add_action( 'wp_print_footer_scripts', 'gema_lite_skip_link_focus_fix' );

if ( ! function_exists( 'gema_lite_google_fonts_url' ) ) :
	/**
	 * Register Google fonts for Gema Lite.
	 *
	 * @since Gema Lite 1.2.1
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function gema_lite_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* Translators: If there are characters in your language that are not
		* supported by Montserrat, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== esc_html_x( 'on', 'Montserrat font: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i, 600,600i,700,700i,800,800i,900,900i';
		}

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = esc_html_x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', '__theme_txtd' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => rawurlencode( implode( '|', $fonts ) ),
				'subset' => rawurlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	} #function
endif;
