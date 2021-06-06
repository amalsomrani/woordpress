<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ample_Shop
 */

get_header();
$ample_shop_hide_breadcrump_option = ample_shop_get_option('ample_shop_breadcrumb_setting_option');

if( ($ample_shop_hide_breadcrump_option == 'enable')) {
    global $post_id;
    ample_shop_breadcrumb_type($post_id);
}
?>
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ample_Shop
 */

get_header();
$blog_page_title = ample_shop_get_option('ample_shop_blog_title_option');

?>
    <!-- Start inner pager banner page -->
    <div class="<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
                if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');}?>">
        <div class="entry-title">

            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

        </div>
    </div>



    <section class="blog_post blog">
        <div class="<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
                if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');}?>">
            <?php
            $sidebardesignlayout = esc_attr( get_post_meta(get_the_ID(), 'ample_shop_sidebar_layout', true) );
            if (is_singular() && $sidebardesignlayout != "default-sidebar")
            {
                $sidebardesignlayout = esc_attr( get_post_meta(get_the_ID(), 'ample_shop_sidebar_layout', true) );

            } else
            {
                $sidebardesignlayout = esc_attr(ample_shop_get_option('ample_shop_sidebar_layout_option' ));
            }


            if($sidebardesignlayout == 'left-sidebar'){
            ?>
            <div class="flex-row-reverse clearfix">
                <?php } else{?>
                <div class="row"><?php } ?>
                <div id='primary'  class="asiderl col-xs-12 col-sm-9">

                    <?php /* Start the Loop */
                    if ( have_posts() ) :

                        while ( have_posts() ) :
                            the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part( 'template-parts/content', get_post_type() );

                        endwhile;

                        the_posts_navigation();

                    else :

                        get_template_part( 'template-parts/content', 'none' );

                    endif;
                    ?>


                </div>
                <!-- right colunm -->
                <aside id='secondary' class="sidebar col-xs-12 col-sm-3">
                    <?php get_sidebar(); ?>

                </aside>
                <!-- ./right colunm -->
            </div>
        </div>
    </section>


<?php

get_footer();
?>

