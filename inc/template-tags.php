<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gema Lite
 */

if ( ! function_exists( 'gema_lite_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Gema Lite 1.0
	 */
	function gema_lite_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		$author_name = get_the_author();

		$byline = sprintf(
			/* translators: %s: The post author name. */
			esc_html_x( 'by %s', 'post author', 'gema-lite' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( $author_name ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	} #function

endif;

if ( ! function_exists( 'gema_lite_get_cats_list' ) ) :

	/**
	 * Returns HTML with comma separated category links
	 *
	 * @since Gema Lite 1.0
	 *
	 * @param int|WP_Post $post_ID Optional. Post ID or post object.
	 *
	 * @return string
	 */
	function gema_lite_get_cats_list( $post_ID = null ) {

		//use the current post ID is none given
		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}

		//obviously pages don't have categories
		if ( 'page' == get_post_type( $post_ID ) ) {
			return '';
		}

		$cats = '';
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'gema-lite' ), '', $post_ID );
		if ( $categories_list && gema_lite_categorized_blog() ) {
			$cats = '<span class="cat-links">' . $categories_list . '</span>';
		}

		return $cats;

	} #function

endif;

if ( ! function_exists( 'gema_lite_cats_list' ) ) :

	/**
	 * Prints HTML with comma separated category links
	 *
	 * @since Gema Lite 1.0
	 *
	 * @param int|WP_Post $post_ID Optional. Post ID or post object.
	 */
	function gema_lite_cats_list( $post_ID = null ) {

		echo gema_lite_get_cats_list( $post_ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	} #function

endif;

if ( ! function_exists( 'gema_lite_the_posts_navigation' ) ) :

	/**
	 * Prints the HTML of the posts navigation
	 * It will display both prev/next and page numbers (i.e « Prev 1 … 3 4 5 6 7 … 9 Next » )
	 *
	 * @since Gema Lite 1.0
	 */
	function gema_lite_the_posts_navigation() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer
		$a11y_text = esc_html__( 'Page', 'gema-lite' ); // Accessibility improvement

		$links = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_next' => true,
			'prev_text' => esc_html__( 'Prev', 'gema-lite' ),
			'next_text' => esc_html__( 'Next', 'gema-lite' ),
			'before_page_number' => '<span class="screen-reader-text">' . $a11y_text . ' </span>',
		) );

		// Wrap the links in a standard navigational markup
		echo _navigation_markup( $links, 'archive-navigation' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} #function
endif;

if ( ! function_exists( 'gema_lite_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 *
	 * @since Gema Lite 1.0
	 */
	function gema_lite_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) {
				echo '<div class="tags">' . $tags_list . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	} #function
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since Gema Lite 1.0
 *
 * @return bool
 */
function gema_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'gema_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'gema_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so gema_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so gema_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in gema_categorized_blog.
 *
 * @since Gema Lite 1.0
 */
function gema_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'gema_categories' );
}
add_action( 'edit_category', 'gema_lite_category_transient_flusher' );
add_action( 'save_post', 'gema_lite_category_transient_flusher' );

/**
 * Display the classes for the post thumbnail div.
 *
 * @since Gema Lite 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post $post_id Optional. Post ID or post object.
 */
function gema_lite_the_post_thumbnail_class( $class = '', $post_id = null ) {
	// Separates classes with a single space, collates classes for post thumbnail DIV
	echo 'class="' . esc_attr( join( ' ', gema_lite_get_post_thumbnail_class( $class, $post_id ) ) ) . '"';
}

if ( ! function_exists( 'gema_lite_get_post_thumbnail_class' ) ) :

	/**
	 * Retrieve the classes for the post_thumbnail,
	 * depending on the aspect ratio of the featured image
	 *
	 * @since Gema Lite 1.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @param int|WP_Post $post_id Optional. Post ID or post object.
	 * @return array Array of classes.
	 */
	function gema_lite_get_post_thumbnail_class( $class = '', $post_id = null ) {

		$post = get_post( $post_id );

		$classes = array();

		if ( empty( $post ) ) {
			return $classes;
		}

		//get the aspect ratio specific class
		$classes[] = 'entry-image--' . gema_lite_get_post_thumbnail_aspect_ratio_class( $post );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		/**
		 * Filter the list of CSS classes for the current post thumbnail.
		 *
		 * @param array  $classes An array of post classes.
		 * @param string $class   A comma-separated list of additional classes added to the post.
		 * @param int    $post_id The post ID.
		 */
		$classes = apply_filters( 'gema_post_thumbnail_class', $classes, $class, $post->ID );

		return array_unique( array_map( 'esc_attr', $classes ) );
	} #function

endif;

if ( ! function_exists( 'gema_lite_get_post_thumbnail_aspect_ratio_class' ) ) :

	/**
	 * Get the aspect ratio of the post featured image
	 *
	 * @since Gema Lite 1.0
	 *
	 * @param int|WP_Post $post_id Optional. Post ID or post object.
	 *
	 * @return string Aspect ratio specific class.
	 */
	function gema_lite_get_post_thumbnail_aspect_ratio_class( $post_id = null ) {

		$post = get_post( $post_id );

		$class = '';

		//bail if no post
		if ( empty( $post ) ) {
			return $class;
		}

		//$image_data[1] is width
		//$image_data[2] is height
		// we use the full image size to avoid the Photon messing around with the data - at least for now
		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

		//we default to a landscape aspect ratio
		$class = 'landscape';
		if ( ! empty( $image_data[1] ) && ! empty( $image_data[2] ) ) {
			$image_aspect_ratio = $image_data[1] / $image_data[2];

			// now let's begin to see what kind of featured image we have
			// first portrait images
			if ( $image_aspect_ratio <= 1 ) {
				$class = 'portrait';
			}
		}

		return $class;
	} #function

endif;

if ( ! function_exists( 'gema_lite_the_image_navigation' ) ) :

	/**
	 * Display navigation to next/previous image attachment
	 *
	 * @since Gema Lite 1.0
	 */
	function gema_lite_the_image_navigation() {
		global $post;

		if ( $post->post_parent ) : ?>

		<nav class="navigation post-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Image navigation', 'gema-lite' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous">

					<?php //the previous image link
					adjacent_image_link( true ); ?>

				</div>
				<div class="nav-next">

					<?php //the next image link
					adjacent_image_link( false ); ?>

				</div>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->

		<?php endif;
	} #function

endif;


if ( ! function_exists( 'gema_lite_first_category' ) ) :

	/**
	 * Prints HTML with the category of a certain post, with the most posts in it
	 * The most important category of a post
	 *
	 * @since Gema Lite 1.1.8
	 *
	 * @param int|WP_Post $post_ID Optional. Post ID or post object.
	 */
	function gema_lite_first_category( $post_ID = null) {
		global $wp_rewrite;

		//use the current post ID is none given
		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}

		//obviously pages don't have categories
		if ( 'page' == get_post_type( $post_ID ) ) {
			return;
		}

		//first get all categories ordered by count
		$all_categories = get_categories( array(
			'orderby' => 'count',
			'order' => 'DESC',
		) );

		//get the post's categories
		$categories = get_the_category( $post_ID );
		if ( empty( $categories ) ) {
			//get the default category instead
			$categories = array( get_term( get_option( 'default_category' ), 'category' ) );
		}

		//now intersect them so that we are left with a descending ordered array of the post's categories
		$categories = array_uintersect( $all_categories, $categories, 'gema_lite_compare_categories' );

		if ( ! empty ( $categories ) ) {
			$category = array_shift( $categories );
			$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

			echo '<span class="cat-links"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . esc_html( $rel ) . '>' . esc_html( $category->name ) . '</a></span>';
		}

	} #function
endif;

if ( ! function_exists( 'gema_lite_compare_categories' ) ) :

	/**
	 * Compares 2 categories by term_id
	 *
	 * @since Gema Lite 1.1.8
	 *
	 * @param object $a1
	 * @param object $a2
	 *
	 * @return int
	 */
	function gema_lite_compare_categories( $a1, $a2 ) {
		if ( $a1->term_id == $a2->term_id ) {
			return 0; //we are only interested by equality but PHP wants the whole thing
		}

		if ( $a1->term_id > $a2->term_id ) {
			return 1;
		}
		return -1;
	} #function

endif;

if ( ! function_exists( 'gema_lite_post_meta' ) ) {
	function gema_lite_post_meta() {
		$meta = gema_lite_get_post_meta();
		$items_primary_meta   = 'category';
		$items_secondary_meta = 'date';

		echo '<span class="card__meta-primary">' . $meta[ $items_primary_meta ] . '</span>' .
		     '<span class="card__meta-secondary">' . $meta[ $items_secondary_meta ] . '</span>';
	}
}

if ( ! function_exists( 'gema_lite_get_post_meta' ) ) {
	/**
	 * Get all the needed meta for a post.
	 *
	 * @return array
	 */
	function gema_lite_get_post_meta() {
		// Gather up all the meta we might need to display
		// But first initialize please
		$meta = array(
			'category' => false,
			'tags'     => false,
			'author'   => false,
			'date'     => false,
			'comments' => false,
		);

		// And get the options
		$items_primary_meta   = 'category';
		$items_secondary_meta = 'date';

		$meta['category'] = gema_lite_get_first_category() . sprintf(
				esc_html_x( ' by %s', 'post author', 'gema-lite' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

		if ( 'tags' == $items_primary_meta || 'tags' == $items_secondary_meta ) {
			$post_tags = get_the_terms( get_the_ID(), 'post_tag' );
			$tags      = '';
			if ( ! is_wp_error( $post_tags ) && ! empty( $post_tags ) ) {
				$tags .= '<span class="screen-reader-text">' . esc_html__( 'Tags', 'gema-lite' ) . '</span><ul class="tags">' . PHP_EOL;
				foreach ( $post_tags as $post_tag ) {
					$tags .= '<li><a href="' . esc_url( get_term_link( $post_tag ) ) . '" rel="tag">' . $post_tag->name . '</a></li>' . PHP_EOL;
				};
				$tags .= '</ul>' . PHP_EOL;
			}
			$meta['tags'] = $tags;
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		$meta['date']   = '<span class="posted-on">' . $posted_on . '</span>';

		$comments_number = get_comments_number(); // get_comments_number returns only a numeric value
		if ( comments_open() ) {
			if ( $comments_number == 0 ) {
				$comments = esc_html__( 'No Comments', 'gema-lite' );
			} else {
				$comments = sprintf( _n( '%d Comment', '%d Comments', $comments_number, 'gema-lite' ), $comments_number );
			}
			$meta['comments'] = '<a href="' . esc_url( get_comments_link() ) . '">' . esc_html( $comments ) . '</a>';
		} else {
			$meta['comments'] = '';
		}

		return $meta;
	}
}

if ( ! function_exists( 'gema_lite_get_first_category' ) ) :

	/**
	 * Prints HTML with the category of a certain post, with the most posts in it
	 * The most important category of a post
	 *
	 * @since Gema Lite 1.1.8
	 *
	 * @param int|WP_Post $post_ID Optional. Post ID or post object.
	 * @return string
	 */
	function gema_lite_get_first_category( $post_ID = null) {
		global $wp_rewrite;

		//use the current post ID is none given
		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}

		//obviously pages don't have categories
		if ( 'page' == get_post_type( $post_ID ) ) {
			return '';
		}

		//first get all categories ordered by count
		$all_categories = get_categories( array(
			'orderby' => 'count',
			'order' => 'DESC',
		) );

		//get the post's categories
		$categories = get_the_category( $post_ID );
		if ( empty( $categories ) ) {
			//get the default category instead
			$categories = array( get_term( get_option( 'default_category' ), 'category' ) );
		}

		//now intersect them so that we are left with a descending ordered array of the post's categories
		$categories = array_uintersect( $all_categories, $categories, 'gema_lite_compare_categories' );

		if ( ! empty ( $categories ) ) {
			$category = array_shift( $categories );
			$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

			return '<span class="cat-links"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name . '</a></span>';
		}

	} #function
endif;

if ( ! function_exists( 'gema_lite_compare_categories' ) ) :

	/**
	 * Compares 2 categories by term_id
	 *
	 * @since Gema Lite 1.1.8
	 *
	 * @param object $a1
	 * @param object $a2
	 *
	 * @return int
	 */
	function gema_lite_compare_categories( $a1, $a2 ) {
		if ( $a1->term_id == $a2->term_id ) {
			return 0; //we are only interested by equality but PHP wants the whole thing
		}

		if ( $a1->term_id > $a2->term_id ) {
			return 1;
		}
		return -1;
	} #function

endif;

if ( ! function_exists( 'gema_lite_get_post_format_first_image' ) ) :

	function gema_lite_get_post_format_first_image() {
		global $post;

		$output = '';
		$pattern = get_shortcode_regex();

		//first search for an image with a caption shortcode
		if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
		     && array_key_exists( 2, $matches )
		     && in_array( 'caption', $matches[2] ) ) {

			$key = array_search( 'caption', $matches[2] );
			if ( false !== $key ) {
				$output = do_shortcode( $matches[0][ $key ] );
			}
		} else {
			//find regular images
			preg_match( '/<img [^\>]*\ \/>/i', $post->post_content, $matches );

			if ( ! empty( $matches[0] ) ) {
				$output = $matches[0];
			}
		}

		return $output;
	} #function

endif;

/**
 * Handles the output of the media for audio attachment posts. This should be used within The Loop.
 *
 * @param bool $extra_details
 * @return string|array
 */
function gema_lite_audio_attachment( $extra_details = false ) {
	return hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true, 'extra_details' => $extra_details ) );
}

if ( ! function_exists( 'gema_lite_is_visual_media' ) ) :

	function gema_lite_is_visual_media( $post_format, $media_details ) {
		$visual_media = true;

		if ( 'audio' == $post_format ) {
			// Determine if this doesn't have a visual representation and should sit in the title not in the "image"
			if ( $media_details['content'] && in_array( 'audio_shortcode', $media_details['format'] ) ) {
				$visual_media = false;
			}
		}

		return $visual_media;
	}
endif;

/**
 * Handles the output of the media for video attachment posts. This should be used within The Loop.
 *
 * @return string
 */
function gema_lite_video_attachment() {
	return hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) );
}

if ( ! function_exists( 'gema_lite_get_post_format_link_url' ) ) :

	/**
	 * Returns the URL to use for the link post format.
	 *
	 * First it tries to get the first URL in the content; if not found it uses the permalink instead
	 *
	 * @return string URL
	 */
	function gema_lite_get_post_format_link_url() {
		$has_url = get_url_in_content( get_the_content() );

		return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}

endif;
