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

            <?php if ( has_post_thumbnail() ) : ?>

                <div class="card__wrap">
                    <div class="card__shadow">
                        <a href="<?php echo gema_lite_get_post_format_link_url(); ?>" <?php gema_lite_the_post_thumbnail_class( 'card__image' ); ?>>
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
                    </div>
                    <div class="card-title-wrap">
                        <a href="<?php echo gema_lite_get_post_format_link_url(); ?>" class="card__title">
                            <h2><?php the_title(); get_template_part( 'template-parts/svg/link-svg' ); ?></h2>
                        </a>
                    </div>
                </div>

            <?php else: ?>

                <div class="card__shadow">
                    <a href="<?php echo gema_lite_get_post_format_link_url(); ?>" class="card__wrap" rel="bookmark">
                        <h2><?php the_title(); get_template_part( 'template-parts/svg/link-svg' ); ?></h2>
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</article><!-- #post-## -->
