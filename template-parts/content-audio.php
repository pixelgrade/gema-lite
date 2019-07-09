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
	        // Grab the audio media details from the content, if it exists
	        $media_details = gema_lite_audio_attachment( true );

            // Determine if this doesn't have a visual representation and should sit in the title not in the "image"
            $visual_media = gema_lite_is_visual_media( 'audio', $media_details );


            if ( ! empty( $media_details['content'] ) )  {

                if ( $visual_media || has_post_thumbnail() ) { ?>

                    <div class="card__wrap">
                        <div class="card__shadow">
                            <a href="<?php the_permalink(); ?>" <?php gema_lite_the_post_thumbnail_class( 'card__image' ); ?>>
                                <?php

                                if ( $visual_media ) {
                                    echo $media_details['content'];
                                } else if ( has_post_thumbnail() ) {
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
                                <?php } ?>
                            </a>
                        </div>
                        <div class="card-title-wrap">
                            <div class="card__title">
                                <div class="card__audio">
                                    <?php
                                    if ( ! empty( $media_details['content'] ) && ! $visual_media ) {
                                        echo $media_details['content'];
                                    }
                                    ?>
                                    <div>
                                        <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                                        <div class="card__meta  entry-meta">
                                            <?php gema_lite_post_meta(); ?>
                                            <?php edit_post_link(
                                                    sprintf(
                                                    /* translators: %s: Name of current post */
                                                            esc_html__( 'Edit %s', 'gema' ),
                                                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                                    ), '<span class="edit-link-separator"></span>'
                                            ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>

                    <div class="card__shadow">
                        <div class="card__wrap">
                            <div class="card__meta  entry-meta">
                                <?php gema_lite_post_meta(); ?>
                                <?php edit_post_link(
                                        sprintf(
                                        /* translators: %s: Name of current post */
                                                esc_html__( 'Edit %s', 'gema' ),
                                                the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                        ), '<span class="edit-link-separator"></span>'
                                ); ?>
                            </div>
                            <div class="card__audio">
                                <?php echo $media_details['content']; ?>
                                <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                            </div>
                        </div>
                    </div>

                <?php }
	        } else { ?>

                <div class="card__shadow">
                    <div class="card__wrap">
                        <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</article><!-- #post-## -->
