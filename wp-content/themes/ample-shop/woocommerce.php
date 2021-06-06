<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bussiness_agency
 */


get_header();
global $post_id;
ample_shop_breadcrumb_type($post_id);
?>


<main id="main">

        <div id="content" class="site-content single-ample-page">
            <div class="<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
                if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');} ?> clearfix">


                <div class="flex-row-reverse">

                    
                        <!-- Start primary content area -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main" role="main">

                                <?php
                                    woocommerce_content();

                                ?>

                            </main><!-- #main -->
                        </div><!-- #primary -->

                        

                    </div>
                </div>
            </div>
    </main>


<?php

get_footer();
?>

