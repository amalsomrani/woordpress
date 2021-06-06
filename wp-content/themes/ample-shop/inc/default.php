<?php
/**
 * ample shop default theme options.
 *
 *
 * @subpackage Ample Shop
 */

if ( !function_exists('ample_shop_get_default_theme_options' ) ) :

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function ample_shop_get_default_theme_options()
    {

        $default = array();

        //header option

        $default['ample_shop_info_header_section']='show';
        $default['ample_shop_info_header_section_location_icon']='fa-home';
        $default['ample_shop_info_header_location']='';
        $default['ample_shop_info_header_section_phone_number_icon']='fa-phone';
        $default['ample_shop_info_header_phone_no']='';
        $default['ample_shop_email_icon']='fa-envelope-o';
        $default['ample_shop_info_header_email']='';
// footer copyright.
        $default['ample_shop_copyright'] = esc_html__('Copyright Text', 'ample-shop');


        // Homepage Slider Section
        $default['ample_shop_homepage_slider_option']='show';
        $default['ample_shop_slider_promotion_title']= esc_html__('Shopping With US', 'ample-shop');
        $default['ample_shop_slider_cat_id'] = -1;
        $default['ample_shop_no_of_slider'] = 3;
        $default['ample_shop_slider_get_started_txt'] = esc_html__('Shop Now', 'ample-shop');
        $default['ample_shop_slider_get_started_link'] = '#';
        $default['ample_shop_homepage_feature_option']='show';
        $default['ample_shop_product_cat_id']=-1;
        $default['ample_shop_product_link_txt']=esc_html__('Shop Now', 'ample-shop');
        $default['ample_shop_product_link_url']='';

        $default['ample_shop_sidebar_layout_option']='left-sidebar';
        $default['ample_shop_blog_title_option']=esc_html__('Latest Blog', 'ample-shop');
        $default['ample_shop_blog_excerpt_option']= 'excerpt';
        $default['ample_shop_description_length_option']=35;
        $default['ample_shop_show_feature_image_single_option']='show';

        $default['ample_shop_front_page_hide_option']=1;
        $default['ample_shop_breadcrumb_setting_option']='enable';

        $default['ample_shop_primary_color']='#b5012a';
        $default['ample_shop_top_header_background_color']='#000';
        $default['ample_shop_bottom_footer_background_color']='';
        $default['ample_shop_hide_breadcrumb_front_page_option']=1;
        $default['ample_shop_primary_hover_color']='#000';

        $default['ample_shop_site_layout_options']='boxed';
        $default['ample_shop_menu_options']='custom-menu';
        // Pass through filter.
        $default = apply_filters( 'ample_shop_get_default_theme_options', $default );
        return $default;
    }
endif;