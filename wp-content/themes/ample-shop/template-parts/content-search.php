<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ample_Shop
 */
$description_from = ample_shop_get_option( 'ample_shop_blog_excerpt_option');
$description_length = ample_shop_get_option( 'ample_shop_description_length_option');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <div class="entry-detail under">
        <div class="entry-photo">
            <figure> <?php
                if (has_post_thumbnail()) {
                    $image_id = get_post_thumbnail_id();
                    $image_url = wp_get_attachment_image_src($image_id, 'large', true);
                    ?>
                    <a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>"/></a>

                <?php }
                ?></figure>
        </div>

        <div class="page-title">
            <h1><?php
                if ( is_singular() ) :
                    the_title( '<h1 class="entry-title">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif; ?>

            </h1>
            <div class="entry-meta-data">
                <?php
                ample_shop_posted_on();
                ample_shop_posted_by();
                ?>
            </div>
            <div class="content-text clearfix">
                <?php
                if($description_from=='content')
                {
                    echo esc_html( wp_trim_words(get_the_content(),$description_length) );
                }
                else
                {

                    echo esc_html( wp_trim_words(get_the_excerpt(),$description_length) );
                }

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ample-shop' ),
                    'after'  => '</div>',
                ) );
                ?>
                <div class="meta-more">
                    <a href="<?php the_permalink();?>>"><?php esc_html__('Read More','ample-shop') ?></a>

                </div>
            </div>


        </div>


</article><!-- #post-<?php the_ID(); ?> -->

