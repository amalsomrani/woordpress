<?php


/*----------------------------------------------------------------------------------------------*/
/**
 * Color Options
 *
 * @since 1.0.0
 */


$wp_customize->add_setting(
    'ample_shop_primary_color',
    array(
        'default' => $default['ample_shop_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ample_shop_primary_color', array(
    'label' => esc_html__('Primary Color', 'ample-shop'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'ample-shop'),
    'section' => 'colors',
    'priority' => 14,

)));

/*-----------------------------------------------------------------------------*/
/**
 * Top Header Background Color
 *
 * @since 1.0.0
 */

$wp_customize-> add_setting(
    'ample_shop_top_header_background_color',
    array(
        'default' => $default['ample_shop_top_header_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize-> add_control( new WP_Customize_Color_Control( $wp_customize, 'ample_shop_top_header_background_color', array(
    'label' => esc_html__('Top Header Background Color', 'ample-shop'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'ample-shop'),
    'section' => 'colors',
    'priority' => 14,

)));



/*-----------------------------------------------------------------------------*/
/**
 * Bottom Footer Background Color
 *
 * @since 1.0.0
 */

$wp_customize->add_setting(
    'ample_shop_bottom_footer_background_color',
    array(
        'default' => $default['ample_shop_bottom_footer_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'ample_shop_bottom_footer_background_color', array(
    'label' => esc_html__('Bottom Footer Background Color', 'ample-shop'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'ample-shop'),
    'section' => 'colors',
    'priority' => 14,

)));




$wp_customize->add_setting(
    'ample_shop_primary_hover_color',
    array(
        'default' => $default['ample_shop_primary_hover_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ample_shop_primary_hover_color', array(
    'label' => esc_html__('Primary Hover Color', 'ample-shop'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'ample-shop'),
    'section' => 'colors',
    'priority' => 14,

)));