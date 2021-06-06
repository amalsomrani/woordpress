<?php
/**
 * Copyright Info Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'ample_shop_copyright_info_section',
    array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Footer Option', 'ample-shop'),
        'panel' => 'ample_shop_homepage_settings_panel',
    )
);

/**
 * Field for Copyright
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'ample_shop_copyright',
    array(
        'default' => $default['ample_shop_copyright'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'ample_shop_copyright',
    array(
        'type' => 'text',
        'label' => esc_html__('Copyright', 'ample-shop'),
        'section' => 'ample_shop_copyright_info_section',
        'priority' => 8
    )
);

