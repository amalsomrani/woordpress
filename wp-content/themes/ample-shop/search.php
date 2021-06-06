<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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



    <section class="blog_post">
        <div class="<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
        if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');} ?> ">
            <div class="row">

                <div id='primary'  class="asiderl col-xs-12 col-sm-9">

                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();

                            get_template_part('template-parts/content', 'search');

                        endwhile; // End of the loop.
                    else:
                        get_template_part('template-parts/content', 'none');

                    endif;

                    ?>
                </div>

                <!-- right colunm -->
            <aside id='secondary' class="sidebar col-xs-12 col-sm-3">

                    <?php echo get_sidebar(); ?>

                </aside>
                <!-- ./right colunm -->
            </div>
        </div>
    </section>


<?php

get_footer();
