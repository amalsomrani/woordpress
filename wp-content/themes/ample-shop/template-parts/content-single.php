<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ample_Shop
 */
$hide_show_feature_image = ample_shop_get_option('ample_shop_show_feature_image_single_option');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-detail under">
        <div class="page-title">
            <h1><?php
                if ( is_singular() ) :
                    the_title( '<h1 class="entry-title">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif; ?>

            </h1>
            <span class="date-title"><?php
                $post_date = get_the_date( 'l F j, Y' );

                echo $post_date;?>
  |

              <?php  ample_shop_posted_by();
                   ?></span>
                 
        </div>
        <div class="entry-photo">
            <figure> <?php
                if (has_post_thumbnail() && $hide_show_feature_image == 'show') {
                    $image_id = get_post_thumbnail_id();
                    $image_url = wp_get_attachment_image_src($image_id, 'large', true);
                    ?>
                    <a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>"/></a>

                <?php }
                ?></figure>
        </div>
        
        <div class="content-text clearfix">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ample-shop' ),
                'after'  => '</div>',
            ) );
            ?>
    </div>

   
</article><!-- #post-<?php the_ID(); ?> -->
