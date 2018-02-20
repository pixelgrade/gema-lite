<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gema
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Gema 1.0
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function gema_body_classes( $classes ) {
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

        if ( is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'has-active-sidebar';
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
add_filter( 'body_class', 'gema_body_classes' );

/**
 * Add custom classes for individual posts
 *
 * @since Gema 1.0
 *
 * @param array $classes
 *
 * @return array
 */
function gema_post_classes( $classes ) {

	if ( is_archive() || is_home() || is_search() ) {
		$classes[] = 'grid__item  card';

		// add a dedicated class for the presence of a featured image - when no featured image we treat it as text
		if ( has_post_thumbnail() && get_post_format() !== "quote") {
			$classes[] = 'card--image card--' . gema_get_post_thumbnail_aspect_ratio_class();
		} else {
			$classes[] = 'card--text card--portrait';
		}
	} else {
		$classes[] = 'entry-image--' . gema_get_post_thumbnail_aspect_ratio_class();
	}

	return $classes;
}
add_filter( 'post_class', 'gema_post_classes' );

/**
 * Wrap the current page number for single post/page navigation
 *
 * @since Gema 1.0
 *
 * @param string $link
 * @param int $i
 *
 * @return string
 */
function gema_wrap_current_pages_link( $link, $i ) {
	global $page;

	if ( $i == $page ) {
		$link = '<span class="current">' . $link . '</span>';
	}

	return $link;
}
add_filter( 'wp_link_pages_link', 'gema_wrap_current_pages_link', 10, 2 );

/**
 * Use a template for individual comment output
 *
 * @since Gema 1.0
 *
 * @param object $comment Comment to display.
 * @param int    $depth   Depth of comment.
 * @param array  $args    An array of arguments.
 */
function gema_comment_markup( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			?>
			<li class="post pingback parent">
			<article>
				<div class="media__body">
					<header class="comment__meta">
						<span class="comment__author"><?php esc_html_e( 'Pingback:', 'gema' ); ?></span>
						<div class="comment__links">
							<?php
							//we need some space before Edit
							edit_comment_link( esc_html__( 'Edit', 'gema' ), '  ' );
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

				<aside class="comment__avatar  media__img"><?php echo $avatar; ?></aside>

				<div class="media__body">
					<header class="comment__meta">
						<?php printf( '<span class="comment__author">%s</span>', get_comment_author_link() ) ?>
						<time class="comment__time" datetime="<?php comment_time( 'c' ); ?>">
							<a href="<?php echo esc_url( get_comment_link( get_comment_ID() ) ) ?>" class="comment__timestamp"><?php printf( esc_html__( 'on %s at %s', 'gema' ), get_comment_date(), get_comment_time() ); ?> </a>
						</time>
						<div class="comment__links">
							<?php
							//we need some space before Edit
							edit_comment_link( esc_html__( 'Edit', 'gema' ), '  ' );

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
							<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'gema' ) ?></p>
						</div>
					<?php endif; ?>
				</div>
			</article>
			<!-- </li> is added by WordPress automatically -->
			<?php
			break;
	endswitch;
}

/**
 * Generate the Montserrat font URL
 *
 * @since Gema 1.0
 *
 * @return string
 */
function gema_montserrat_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by Montserrat, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$montserrat = esc_html_x( 'on', 'Montserrat font: on or off', 'gema' );
	if ( 'off' !== $montserrat ) {
		return get_stylesheet_directory_uri() . '/assets/fonts/montserrat/stylesheet.css';
	}

	return '';
}

/**
 * Generate the Butler font URL
 *
 * @since Gema 1.0
 *
 * @return string
 */
function gema_butler_font_url() {

	/* Translators: If there are characters in your language that are not
	* supported by Butler, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$butler = esc_html_x( 'on', 'Butler font: on or off', 'gema' );
	if ( 'off' !== $butler ) {
		return get_stylesheet_directory_uri() . '/assets/fonts/butler/stylesheet.css';
	}

	return '';
}

/**
 * Remove 'Category', 'Tag' etc. from archive titles
 *
 * @since Gema 1.0
 *
 * @param string $title The archive title
 *
 * @return string
 */
function gema_cleanup_archive_title( $title ) {

	if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = '<span class="vcard">' . get_the_author() . '</span>' ;

	}

	return $title;

}
add_filter( 'get_the_archive_title', 'gema_cleanup_archive_title', 10, 1 );