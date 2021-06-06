<?php
if (!function_exists('ample_shop_sidebar_layout')) :
    function ample_shop_sidebar_layout()
    {
        $ample_shop_sidebar_layout = array(
            'right-sidebar' => esc_html__('Right Sidebar', 'ample-shop'),
            'left-sidebar' => esc_html__('Left Sidebar', 'ample-shop'),
            'no-sidebar' => esc_html__('No Sidebar', 'ample-shop'),
        );
        return apply_filters('ample_shop_sidebar_layout', $ample_shop_sidebar_layout);
    }
endif;

/**
 * Blog/Archive Description Option
 *
 * @since shop agency 1.0.0
 *
 *
 * 
 * @param null
 * @return array $ample_shop_blog_excerpt
 *
 */
if (!function_exists('ample_shop_blog_excerpt')) :
    function ample_shop_blog_excerpt()
    {
        $ample_shop_blog_excerpt = array(
            'excerpt' => esc_html__('Excerpt', 'ample-shop'),
            'content' => esc_html__('Content', 'ample-shop'),

        );
        return apply_filters('ample_shop_blog_excerpt', $ample_shop_blog_excerpt);
    }
endif;

/**
 * Show/Hide Feature Image  options
 *
 * @since shop agency 1.0.0
 *
 * @param null
 * @return array $ample_shop_show_feature_image_option
 *
 */
if (!function_exists('ample_shop_show_feature_image_option')) :
    function ample_shop_show_feature_image_option()
    {
        $ample_shop_show_feature_image_option = array(
            'show' => esc_html__('Show', 'ample-shop'),
            'hide' => esc_html__('Hide', 'ample-shop')
        );
        return apply_filters('ample_shop_show_feature_image_option', $ample_shop_show_feature_image_option);
    }
endif;
