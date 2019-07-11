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
            $media = gema_lite_video_attachment();

            if ( $media ) : ?>

                <div class="card__wrap">
                    <div class="card__shadow">
                        <div class="card__image">
                            <?php echo $media; ?>
                        </div>
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
                                                esc_html__( 'Edit %s', 'gema-lite' ),
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
                                            esc_html__( 'Edit %s', 'gema-lite' ),
                                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                    ), '<span class="edit-link-separator"></span>'
                            );
                            ?>

                        </div>

                        <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        <?php the_excerpt(); ?>

                        <a class="btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More', 'gema-lite' ); ?></a>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</article><!-- #post-## -->
