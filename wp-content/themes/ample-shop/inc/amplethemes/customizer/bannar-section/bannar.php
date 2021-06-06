<?php
/**
 * HomePage Settings Panel on customizer
 */
$wp_customize->add_panel(
    'ample_shop_homepage_settings_panel',
    array(
        'priority' => 22,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('HomePage General Settings', 'ample-shop'),
    )
);

/*-------------------------------------------------------------------------------------------------*/
/**
 * Slider Section
 *
 */
$wp_customize->add_section(
    'ample_shop_slider_section',
    array(
        'title' => esc_html__('Slider Section', 'ample-shop'),
        'panel' => 'ample_shop_homepage_settings_panel',
        'priority' => 6,
    )
);

/**
 * Show/Hide option for Homepage Slider Section
 *
 */

$wp_customize->add_setting(
    'ample_shop_homepage_slider_option',
    array(
        'default' => $default['ample_shop_homepage_slider_option'],
        'sanitize_callback' => 'ample_shop_sanitize_select',
    )
);
$hide_show_option = ample_shop_slider_option();
$wp_customize->add_control(
    'ample_shop_homepage_slider_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Slider Option', 'ample-shop'),
        'description' => esc_html__('Show/hide option for homepage Slider Section.', 'ample-shop'),
        'section' => 'ample_shop_slider_section',
        'choices' => $hide_show_option,
        'priority' => 7
    )
);

/**
 * Dropdown available category for homepage slider
 *
 */


/**
 * Field for Get Started button Link
 *
 */
$wp_customize->add_setting(
    'ample_shop_slider_promotion_title',
    array(
        'default' => $default['ample_shop_slider_promotion_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'ample_shop_slider_promotion_title',
    array(
        'type' => 'text',
        'label' => esc_html__('Promotion Tag', 'ample-shop'),
        'description' => esc_html__('Use One Word ', 'ample-shop'),
        'section' => 'ample_shop_slider_section',
        'priority' => 7
    )
);



$wp_customize->add_setting(
    'ample_shop_slider_cat_id',
    array(
        'default' => $default['ample_shop_slider_cat_id'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(new Ample_Shop_Customize_WC_Category_Dropdown_Control(
        $wp_customize,
        'ample_shop_slider_cat_id',
        array(
            'label' => esc_html__('Slider Category', 'ample-shop'),
            'description' => esc_html__('Select Category for Homepage Slider Section', 'ample-shop'),
            'section' => 'ample_shop_slider_section',
            'priority' => 8,

        )
    )
);
/**
 * Field for no of posts to display..
 *
 */
$wp_customize->add_setting(
    'ample_shop_no_of_slider',
    array(
        'default' => $default['ample_shop_no_of_slider'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'ample_shop_no_of_slider',
    array(
        'type' => 'number',
        'label' => esc_html__('Number of Slider', 'ample-shop'),
        'section' => 'ample_shop_slider_section',
        'priority' => 10
    )
);


/**
 * Field for Get Started button text
 *
 */
$wp_customize->add_setting(
    'ample_shop_slider_get_started_txt',
    array(
        'default' => $default['ample_shop_slider_get_started_txt'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'ample_shop_slider_get_started_txt',
    array(
        'type' => 'text',
        'label' => esc_html__('Shop Now Button', 'ample-shop'),
        'section' => 'ample_shop_slider_section',
        'priority' => 11
    )
);

/**
 * Field for Get Started button Link
 *
 */
$wp_customize->add_setting(
    'ample_shop_slider_get_started_link',
    array(
        'default' => $default['ample_shop_slider_get_started_link'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'ample_shop_slider_get_started_link',
    array(
        'type' => 'url',
        'label' => esc_html__('Shop Now Button Link', 'ample-shop'),
        'description' => esc_html__('Use full url link', 'ample-shop'),
        'section' => 'ample_shop_slider_section',
        'priority' => 20
    )
);


/*-------------------------------------------Feature Product post---------------------------------------------------*/

/**
 * Show/Hide option for Homepage Slider Section
 *
 */

$wp_customize->add_setting(
    'ample_shop_homepage_feature_option',
    array(
        'default' => $default['ample_shop_homepage_feature_option'],
        'sanitize_callback' => 'ample_shop_sanitize_select',
    )
);
$hide_show_option = ample_shop_slider_option();
$wp_customize->add_control(
    'ample_shop_homepage_feature_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Feature Section Option', 'ample-shop'),
        'description' => esc_html__('Show/hide option for homepage Feature Section.', 'ample-shop'),
        'section' => 'ample_shop_slider_section',
        'choices' => $hide_show_option,
        'priority' => 20
    )
);

$wp_customize->add_setting(
    'ample_shop_product_cat_id',
    array(
        'default' => $default['ample_shop_product_cat_id'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(new Ample_Shop_Customize_WC_Category_Dropdown_Control(
        $wp_customize,
        'ample_shop_product_cat_id',
        array(
            'label' => esc_html__('Product Category', 'ample-shop'),
            'description' => esc_html__('Select Category for Feature Product', 'ample-shop'),
            'section' => 'ample_shop_slider_section',
            'priority' => 21,

        )
    )
);



/**
 * Field for Get Started button text
 *
 */
$wp_customize->add_setting(
    'ample_shop_product_link_txt',
    array(
        'default' => $default['ample_shop_product_link_txt'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'ample_shop_product_link_txt',
    array(
        'type' => 'text',
        'label' => esc_html__('Shop Now', 'ample-shop'),
        'section' => 'ample_shop_slider_section',
        'priority' => 22
    )
);

