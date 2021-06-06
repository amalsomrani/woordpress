<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 11/5/2018
 * Time: 6:31 PM
 */
get_header();
$ample_shop_hide_front_page_content = ample_shop_get_option('ample_shop_front_page_hide_option');

if (!is_home()) {

    ?>
    <!-- Main Slider Area -->
    <div class="main-slider-area clearfix">
        <div class="container-fluid">
            <div class="row">
                <?php

                $ample_shop_slider_section_option = ample_shop_get_option('ample_shop_homepage_slider_option');
                $ample_shop_feature_section_option = ample_shop_get_option('ample_shop_homepage_feature_option');

                if ($ample_shop_slider_section_option != 'hide') {

                    $ample_shop_slider_section_cat_id = ample_shop_get_option('ample_shop_slider_cat_id');

                    $ample_shop_get_started_text = ample_shop_get_option('ample_shop_slider_get_started_txt');

                    $ample_shop_get_started_text_link = ample_shop_get_option('ample_shop_slider_get_started_link');
                    $ample_shop_slider_promotion = ample_shop_get_option('ample_shop_slider_promotion_title');

                    $ample_shop_slider_category = get_category($ample_shop_slider_section_cat_id);

                    if (!empty($ample_shop_slider_section_cat_id)) {
                        $no_of_slider = ample_shop_get_option('ample_shop_no_of_slider');

                        ?>
                        <div class="col-sm-12 <?php if($ample_shop_feature_section_option == 'hide'){ echo esc_attr('col-md-12 height'); }else{echo esc_attr('col-md-9');} ?> col-xs-12 gab">
                        <!-- Main Slider -->
                        <div class="main-slider">
                        <?php
                        $sticky = get_option('sticky_posts');

                        if (ample_shop_is_woocommerce_active()) {
                            $query_args = array(
                                'posts_per_page' => $no_of_slider,
                                'post_status' => 'publish',
                                'post_type' => 'product',
                                'no_found_rows' => 1,
                                'meta_query' => array(),
                                'tax_query' => array(
                                    'relation' => 'AND',
                                )
                            );
                            if (0 != $ample_shop_slider_section_cat_id) {
                                $query_args['tax_query'][] = array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $ample_shop_slider_section_cat_id,
                                );
                            }
                        } else {
                            $query_args = array(
                                'posts_per_page' => $no_of_slider,
                                'no_found_rows' => true,
                                'post_status' => 'publish',
                                'ignore_sticky_posts' => true,
                                'post__not_in' => $sticky
                            );

                        }

                        $slider_query = new WP_Query($query_args);
                        while ($slider_query->have_posts()): $slider_query->the_post();
                            ?>

                            <div class="slider">
                                <div id="mainSlide" class="slider-image">
                                    <div class="image-part">
                                        <?php if (has_post_thumbnail()) {
                                            $image_id = get_post_thumbnail_id();
                                            $image_url = wp_get_attachment_image_src($image_id, 'ample-magazine-shop', true); ?>
                                            <img src="<?php echo esc_url($image_url[0]); ?>"
                                                 class="img-responsive"
                                                 alt="<?php the_title_attribute(); ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="main-slid caption-1">
                                    <div class="slide-texts">
                                        <div class="middle-text">
                                            <div class="cap-dec">
                                                <?php
                                                if (!empty($ample_shop_slider_promotion)) { ?>
                                                    <h2 class="flipX"><?php echo esc_html($ample_shop_slider_promotion); ?></h2>
                                                <?php } ?>
                                                <h3 class="lineUp"><?php the_title() ?></h3>
                                                <strong
                                                        class="pop-outin"><?php echo esc_html(wp_trim_words(get_the_content(), 10)); ?></strong>

                                                <?php
                                                if (!empty($ample_shop_get_started_text)) {
                                                    ?>
                                                    <div class="button">
                                                        <a href="<?php echo esc_url($ample_shop_get_started_text_link); ?>"
                                                           class="read-more-background"><?php echo esc_html($ample_shop_get_started_text) ?></a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        endwhile;
                        wp_reset_postdata();



                    ?>


                   
                </div>
                    <!-- End Main Slider -->
                    <!-- ample-ad -->

                    <!-- ample-ad -->
                    </div>
                    <?php

                }
                if ($ample_shop_feature_section_option != 'hide') {
                ?>
                <div class=" col-md-3 col-sm-12 col-xs-12 feature">
                    <div class="banner-ample">
                        <?php
                        $ample_shop_product_cat_id = ample_shop_get_option('ample_shop_product_cat_id');

                        $ample_shop_product_cat_text = ample_shop_get_option('ample_shop_product_link_txt');

                        $ample_shop_product_cat_link = ample_shop_get_option('ample_shop_product_link_url');
                        ?>
                        <div class="feature-slider">
                            <?php

                            $i = 0;

                            $sticky = get_option('sticky_posts');

                            if (ample_shop_is_woocommerce_active()) {
                                $query_args = array(
                                    'posts_per_page' => 5,
                                    'post_status' => 'publish',
                                    'post_type' => 'product',
                                    'no_found_rows' => 1,
                                    'meta_query' => array(),
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                    )
                                );
                                if (0 != $ample_shop_product_cat_id) {
                                    $query_args['tax_query'][] = array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'term_id',
                                        'terms' => $ample_shop_product_cat_id,
                                    );
                                }
                            } else {
                                $query_args = array(
                                    'posts_per_page' => 2,
                                    'no_found_rows' => true,
                                    'post_status' => 'publish',
                                    'ignore_sticky_posts' => true,
                                    'post__not_in' => $sticky
                                );

                            }

                            $slider_query = new WP_Query($query_args);
                            while ($slider_query->have_posts()): $slider_query->the_post();
                                ?>


                                <div class="banner-box">
                                    <?php if (has_post_thumbnail()) {
                                        $image_id = get_post_thumbnail_id();
                                        $image_url = wp_get_attachment_image_src($image_id, 'ample-magazine-shop', true); ?>
                                        <a href="<?php the_permalink(); ?>"><img alt=""
                                                                                 src="<?php echo esc_url($image_url[0]); ?>"></a>
                                    <?php } ?>
                                    <div class="banner-text"><span class="first-text"><?php the_title(); ?></span></div>
                                    <a class="shop-now"
                                       href="<?php the_permalink(); ?>"><?php echo esc_html($ample_shop_product_cat_text); ?></a>
                                </div>


                            <?php
                            endwhile;
                            wp_reset_postdata();



                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
    <!-- End Main Slider Area -->



    <!-- main container -->
    <?php
    if( is_active_sidebar('home-sections-1')){ ?>
        <div class=" gab-10 <?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
        if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');}?>">
                <?php dynamic_sidebar('home-sections-1'); ?>
                <!-- end main container -->
            </div>
        <?php
    }
    if (is_active_sidebar('home-sections')) {
        ?>

        <div class="main-container col2-left-layout">
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
                    <div id='primary' class="col-main col-md-9 col-sm-8 col-xs-12 col-sm-push-4 col-md-push-3">


                        <?php dynamic_sidebar('home-sections'); ?>
                        <!-- Home Tabs  -->

                    </div>
                    <aside id='secondary' class="sidebar col-md-3 col-sm-4 col-xs-12 col-sm-pull-8 col-md-pull-9">

                        <?php if (is_active_sidebar('shop-widget')) {

                            dynamic_sidebar('shop-widget');
                        }else {
                            get_sidebar();
                        }?>

                    </aside>
                </div>
            </div>
        </div>
        <?php
    }if (is_active_sidebar('home-sections-2')) {
        ?>
        <div class="<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
        if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');}?>">
                <?php dynamic_sidebar('home-sections-2'); ?>
                <!-- end main container -->
        </div>

    <?php } }

if ('posts' == get_option('show_on_front')) {

    include(get_home_template());
} else {
    if (1 != $ample_shop_hide_front_page_content) {
        include(get_page_template());


    }
}
?>


<?php
get_footer();?>
