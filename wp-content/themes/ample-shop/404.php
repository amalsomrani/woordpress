<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ample_Shop
 */

get_header();
global $post_id;
ample_shop_breadcrumb_type($post_id);
?>


	<section class="blog_post">
		<div class="<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
                if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');}?> ">
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
                <div id='primary' class="asiderl col-xs-12 col-sm-9">

                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ample-shop' ); ?></h1>
                    </header>
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ample-shop' ); ?></p>

                    <?php
                    get_search_form();
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
