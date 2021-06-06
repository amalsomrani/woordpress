<?php
/**
 * Breadcrumb  display option options
 * @param null
 * @return array $ample_shop_show_breadcrumb_option
 *
 */
if (!function_exists('ample_shop_show_breadcrumb_option')) :
    function ample_shop_show_breadcrumb_option()
    {
        $ample_shop_show_breadcrumb_option = array(
            'enable' => esc_html__('Enable', 'ample-shop'),
            'disable' => esc_html__('Disable', 'ample-shop')
        );
        return apply_filters('ample_shop_show_breadcrumb_option', $ample_shop_show_breadcrumb_option);
    }
endif;


/**
 * Reset Option
 *
 *
 * @param null
 * @return array $ample_shop_reset_option
 *
 */
if (!function_exists('ample_shop_reset_option')) :
    function ample_shop_reset_option()
    {
        $ample_shop_reset_option = array(
            'do-not-reset' => esc_html__('Do Not Reset', 'ample-shop'),
            'reset-all' => esc_html__('Reset All', 'ample-shop'),
        );
        return apply_filters('ample_shop_reset_option', $ample_shop_reset_option);
    }
endif;



/**
 * Sanitize Multiple Category
 * =====================================
 */

if ( !function_exists('ample_shop_sanitize_multiple_category') ) :

    function ample_shop_sanitize_multiple_category( $values )
    {

        $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

        return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }

endif;
/**
 * Blog/Archive Description Option
 *
 * @since shop  1.0.0
 *
 *
 *
 * @param null
 * @return array $ample_shop_blog_excerpt
 *
 */
if (!function_exists('ample_shop_layout_design')) :
    function ample_shop_layout_design()
    {
        $ample_shop_layout_design = array(
            'full-width' => esc_html__('Full Layout', 'ample-shop'),
            'boxed' => esc_html__('Box Layout', 'ample-shop'),

        );
        return apply_filters('ample_shop_layout_design', $ample_shop_layout_design);
    }
endif;



if (!function_exists('ample_shop_menu_option')) :
    function ample_shop_menu_option()
    {
        $ample_shop_menu_option = array(
            'default' => esc_html__('Default Categories Menu', 'ample-shop'),
            'custom-menu' => esc_html__('Custom Categories Menu', 'ample-shop'),

        );
        return apply_filters('ample_shop_menu_option', $ample_shop_menu_option);
    }
endif;
