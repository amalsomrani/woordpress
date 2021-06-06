<?php
/**
 * Functions for get_theme_mod()
 *

 */
if (!function_exists('ample_shop_get_option')) :

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function ample_shop_get_option($key = '')
    {
        if (empty($key)) {
            return;
        }
        $ample_shop_default_options = ample_shop_get_default_theme_options();

        $default = (isset($ample_shop_default_options[$key])) ? $ample_shop_default_options[$key] : '';

        $theme_option = get_theme_mod($key, $default);

        return $theme_option;

    }

endif;



//=============================================================================================================

/**
 * Slider  options
 * @param null
 * @return array $ample_shop_slider_option
 *
 */
if (!function_exists('ample_shop_slider_option')) :
    function ample_shop_slider_option()
    {
        $ample_shop_slider_option = array(
            'show' => esc_html__('Show', 'ample-shop'),
            'hide' => esc_html__('Hide', 'ample-shop')
        );
        return apply_filters('ample_shop_slider_option', $ample_shop_slider_option);
    }
endif;