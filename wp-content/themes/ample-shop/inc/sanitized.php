<?php
/**
 * Sanitizing the select callback example
 *
 * @since 1.0.0
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 */
if ( !function_exists('ample_shop_sanitize_select') ) :
    function ample_shop_sanitize_select( $input, $setting ) {
        

        // Ensure input is a slug.
        $input = sanitize_text_field( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;



/**
 * Sanitize choices
 * @since ample shop
 * @param null
 * @return
 *
 */
if ( ! function_exists( 'ample_shop_sanitize_choice_options' ) ) :
    function ample_shop_sanitize_choice_options( $value, $choices, $default ) {
        $input = sanitize_text_field( $value );
        $output = array_key_exists( $input, $choices ) ? $input : $default;
        return $output;
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
 * Sanitize checkbox field
 *
 * @param $checked
 * @return Boolean
 */
if ( !function_exists('ample_shop_sanitize_checkbox') ) :
    function ample_shop_sanitize_checkbox( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
endif;
