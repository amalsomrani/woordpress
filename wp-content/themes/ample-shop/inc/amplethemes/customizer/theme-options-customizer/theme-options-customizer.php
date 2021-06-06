<?php
/**
 * Theme Option
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'ample_shop_theme_options',
    array(
        'priority' => 23,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Theme Option', 'ample-shop'),
    )
);




/*-------------------------------------------------------------------------------------------*/
/**
 * Hide Static page in Home page
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'ample_shop_front_page_option',
    array(
        'title' => esc_html__('Front Page Options', 'ample-shop'),
        'panel' => 'ample_shop_theme_options',
        'priority' => 6,
    )
);

/**
 *   Show/Hide Static page/Posts in Home page
 */
$wp_customize->add_setting(
    'ample_shop_front_page_hide_option',
    array(
        'default' => $default['ample_shop_front_page_hide_option'],
        'sanitize_callback' => 'ample_shop_sanitize_checkbox',
    )
);
$wp_customize->add_control('ample_shop_front_page_hide_option',
    array(
        'label' => esc_html__('Hide Blog Posts or Static Page on Front Page', 'ample-shop'),
        'section' => 'ample_shop_front_page_option',
        'type' => 'checkbox',
        'priority' => 10
    )
);


/*-------------------------------------------------------------------------------------------*/
/**
 * Breadcrumb Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'ample_shop_breadcrumb_option',
    array(
        'title' => esc_html__('Breadcrumb Options', 'ample-shop'),
        'panel' => 'ample_shop_theme_options',
        'priority' => 6,
    )
);

/**
 * Breadcrumb Option
 */
$wp_customize->add_setting(
    'ample_shop_breadcrumb_setting_option',
    array(
        'default' => $default['ample_shop_breadcrumb_setting_option'],
        'sanitize_callback' => 'ample_shop_sanitize_select',

    )
);
$hide_show_breadcrumb_option = ample_shop_show_breadcrumb_option();
$wp_customize->add_control('ample_shop_breadcrumb_setting_option',
    array(
        'label' => esc_html__('Breadcrumb Options', 'ample-shop'),
        'section' => 'ample_shop_breadcrumb_option',
        'choices' => $hide_show_breadcrumb_option,
        'type' => 'select',
        'priority' => 10
    )
);


  /**
   *   Show/Hide Breadcrumb in Home page
   */
    $wp_customize->add_setting(
        'ample_shop_hide_breadcrumb_front_page_option',
        array(
            'default' => $default['ample_shop_hide_breadcrumb_front_page_option'],
            'sanitize_callback' => 'ample_shop_sanitize_checkbox',
        )
    );
    $wp_customize->add_control('ample_shop_hide_breadcrumb_front_page_option',
        array(
            'label' => esc_html__('Show/Hide Breadcrumb in Home page', 'ample-shop'),
            'section' => 'ample_shop_breadcrumb_option',
            'type' => 'checkbox',
            'priority' => 10
        )
    );
