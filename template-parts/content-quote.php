<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gema Lite
 */

?>

<?php
/* translators: %s: Name of the current post */
$content = get_the_content( sprintf(
	esc_html__( 'Continue reading %s', 'gema' ),
	the_title( '<span class="screen-reader-text">', '</span>', false )
) );

//now we need to test for the length of the quote so we can decide on a class
$quote_length = mb_strlen( strip_tags( $content ) );
$quote_class = 'entry-quote--long';
if ( $quote_length < 50 ) {
	$quote_class = 'entry-quote--short';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card--text'); ?>>
    <div class="card__mask">
	    <div class="card__hover">
		<div class="card__shadow">
			<div class="card__wrap">
				<div class="card__meta  entry-meta">

                    <?php gema_lite_post_meta(); ?>
					<?php
					edit_post_link(
						sprintf(
						/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'gema' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						), '<span class="edit-link-separator"></span>'
					);
					?>

				</div>

				<div class="content-quote <?php echo esc_attr( $quote_class ); ?>">

					<?php
					//test if there is a </blockquote> tag in here
					if ( false !== strpos( $content,'</blockquote>' ) ) {
						echo $content;
					} else {
						//we will wrap the whole content in blockquote since this is definitely intended as a quote
						echo '<blockquote>' . $content . '</blockquote>';
					} ?>

				</div>

			</div>
		</div>
	</div>
    </div>
</article><!-- #post-## -->
