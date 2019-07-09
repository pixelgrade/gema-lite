<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gema Lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card__mask">
        <div class="card__hover">

            <?php
            $first_image = gema_lite_get_post_format_first_image();
            $linked = ( false === strpos( $first_image, '</a>' ) ) ? false : true ;

            if ( has_post_thumbnail() || ! empty( $first_image ) ) : ?>

                <div class="card__wrap">
                    <div class="card__shadow">
                        <?php if ( ! empty( $first_image ) ) : ?>
	                        <div class="card__image">
		                        <?php if ( $linked ) : ?>
			                        <?php echo $first_image; ?>
		                        <?php else: ?>
			                        <a href="<?php the_permalink(); ?>">
				                        <?php echo $first_image; ?>
			                        </a>
		                        <?php endif; ?>
	                        </div>
                        <?php elseif ( has_post_thumbnail() ) : ?>
	                        <a href="<?php the_permalink(); ?>" <?php gema_lite_the_post_thumbnail_class( 'card__image' ); ?>>
		                        <?php
		                        $attachment = get_post_thumbnail_id( get_the_ID() );
		                        $image_alt = get_post_meta($attachment, '_wp_attachment_image_alt', TRUE);
		                        $image      = wp_get_attachment_image_src( $attachment, 'full' );
		                        $padding    = $image[2] * 100 / $image[1];
		                        $thumb_src  = get_the_post_thumbnail_url( get_the_ID(), 'gema-super-small' );
		                        $src        = get_the_post_thumbnail_url( get_the_ID(), 'gema-archive-' . gema_lite_get_post_thumbnail_aspect_ratio_class() );
		                        ?>
		                        <div class="card__image-wrap" style="padding-top: <?php echo esc_html( $padding ) . '%'; ?>;">
                                    <img class="card__thumb" src="<?php echo esc_url( $thumb_src ); ?>" alt="<?php echo esc_attr($image_alt) ?>">
			                        <div class="card__image--large" data-src="<?php echo esc_url( $src ); ?>"></div>
		                        </div>
	                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-title-wrap">
                        <div class="card__title">
                            <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
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
                        </div>
                    </div>
                </div>

            <?php else: ?>

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

                        <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        <?php the_excerpt(); ?>

                        <a class="btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More', 'gema' ); ?></a>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</article><!-- #post-## -->
