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

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
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
