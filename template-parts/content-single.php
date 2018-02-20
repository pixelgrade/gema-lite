<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gema
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="entry-featured  entry-thumbnail">
			<?php the_post_thumbnail( 'gema-single-' . gema_get_post_thumbnail_aspect_ratio_class() ); ?>
		</div>

	<?php endif; ?>

	<div class="entry-header">
		<?php the_title('<h1 class="entry-title"><span>', '</span></h1>'); ?>

		<div class="entry-meta">
			<?php gema_cats_list(); ?>
			<?php gema_posted_on(); ?>
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'gema' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				), '<span class="edit-link-separator"></span>'
			);
			?>
		</div><!-- .entry-meta -->
	</div>

	<div class="post__content">

		<div class="entry-content">

			<?php the_content(); ?>

			<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'gema'),
				'after' => '</div>',
			));
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php gema_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .post__content -->

</div><!-- #post-## -->
