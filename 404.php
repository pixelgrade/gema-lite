<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gema Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

	<?php get_template_part('template-parts/content', 'header'); ?>

	<div id="primary" class="content-area  content--not-found">
		<main id="main" class="site-main" role="main">

			<div class="post__content">
				<div class="entry__content">
					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'gema-lite' ); ?></h1>
						</header><!-- .page-header -->

						<p><?php esc_html_e( 'It looks like something is amiss. A quick search might help.', 'gema-lite' ); ?></p>

						<?php get_search_form(); ?>
					</section><!-- .error-404 -->
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
