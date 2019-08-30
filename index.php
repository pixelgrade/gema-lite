<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gema Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

// If we have posts display the masonry archive
if ( have_posts() ) : ?>

	<div id="primary" class="content-area">
		<main id="main" role="main">
			<div class="grid">
				<div class="header grid__item">
					<?php get_template_part( 'template-parts/content', 'header' ); ?>
				</div><!-- .header -->
				<?php if ( is_search() ) : ?>
					<div class="grid__item">
						<div class="card  card--text"><h1 class="archive-title  archive-title--search"><?php
							/* translators: %s: The search query. */
							printf( esc_html__( 'Search Results for: %s', 'gema-lite' ), '<span class="search-query">' . esc_html( get_search_query() ) . '</span>' );
						?></h1></div>
					</div>
				<?php endif; ?>

				<?php
				if ( is_home() && ! is_front_page() ) { ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php }

				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile; ?>
			</div>
		</main><!-- #main -->

		<?php gema_lite_the_posts_navigation(); ?>

	</div><!-- #primary -->

<?php
// If there are no posts display a page layout
// similar to the 404 one for all the other cases:
// no search results / no existing posts / etc
else :

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();
