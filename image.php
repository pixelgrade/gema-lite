<?php
/**
 * The template for displaying image attachments
 *
 * @package Gema Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $content_width;

$content_width = 1050; /* pixels */

get_header();

get_template_part('template-parts/content', 'header'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'attachment' );
				gema_lite_the_image_navigation();

				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// The parent post link.
				the_post_navigation( array(
						/* translators: %s: The post title. */
						'prev_text' => sprintf( esc_html__( 'Published in %s', 'gema-lite' ), '<span class="post-title">%title</span>' ),
					)
				);
			endwhile; // End the loop. ?>

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php get_footer();
