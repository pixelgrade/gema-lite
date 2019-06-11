<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

if ( have_posts() ) : ?>

	<div id="primary" class="content-area">
		<main id="main" role="main">
			<div class="grid">
				<div class="header grid__item">

					<?php get_template_part( 'template-parts/content', 'header' ); ?>

				</div><!-- .header -->

				<div class="grid__item">
					<div class="card  card--text"><?php the_archive_title( '<h1 class="archive-title"><span>', '</span></h1>' ); ?>
					<?php
						if( is_category() || is_tag() ) {
							the_archive_description();
						} elseif ( is_author() ) {
							echo '<p>' . wp_kses_post( get_the_author_meta('description') ) . '</p>';
						}
					?>
					</div>
				</div>
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile;
				?>
			</div>
		</main><!-- #main -->

		<?php gemalite_the_posts_navigation(); ?>

	</div><!-- #primary -->
<?php else :

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();
