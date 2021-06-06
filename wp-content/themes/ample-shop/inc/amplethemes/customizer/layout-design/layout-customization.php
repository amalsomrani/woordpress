<?php
/**
 * Layout/Design Option
 *
 */

/*-------------------------------------------------------------------------------------------*/
/**
 * Sidebar Option
 *
 */
$wp_customize->add_section(
    'ample_shop_default_sidebar_layout_option',
    array(
        'title' => esc_html__('Default Sidebar Layout Option', 'ample-shop'),
        'priority' => 6,
        'panel' => 'ample_shop_theme_options',
    )
);

/**
 * Sidebar Option
 */
$wp_customize->add_setting(
    'ample_shop_sidebar_layout_option',
    array(
        'default' => $default['ample_shop_sidebar_layout_option'],
        'sanitize_callback' => 'ample_shop_sanitize_select',
    )
);


$layout = ample_shop_sidebar_layout();
$wp_customize->add_control('ample_shop_sidebar_layout_option',
    array(
        'label' => esc_html__('Default Sidebar Layout', 'ample-shop'),
        'description' => esc_html__('Home/front page does not have sidebar. Inner pages like blog, archive single page/post Sidebar Layout. However single page/post sidebar can be overridden.', 'ample-shop'),
        'section' => 'ample_shop_default_sidebar_layout_option',
        'type' => 'select',
        'choices' => $layout,
        'priority' => 10
    )
);


/*-------------------------------------------------------------------------------------------*/

/**
 * Blog/Archive Layout Option
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'ample_shop_blog_archive_layout_option',
    array(
        'title' => esc_html__('Blog/Archive Layout Option', 'ample-shop'),
        'panel' => 'ample_shop_theme_options',
        'priority' => 7,
    )
);


/**
 * Blog Page Title
 */
$wp_customize->add_setting(
    'ample_shop_blog_title_option',
    array(
        'default' => $default['ample_shop_blog_title_option'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('ample_shop_blog_title_option',
    array(
        'label' => esc_html__('Blog Page Title', 'ample-shop'),
        'section' => 'ample_shop_blog_archive_layout_option',
        'type' => 'text',
        'priority' => 11
    )
);

/**
 * Blog/Archive excerpt option
 */
$wp_customize->add_setting(
    'ample_shop_blog_excerpt_option',
    array(
        'default' => $default['ample_shop_blog_excerpt_option'],
        'sanitize_callback' => 'ample_shop_sanitize_select',
    )
);
$blogexcerpt = ample_shop_blog_excerpt();
$wp_customize->add_control('ample_shop_blog_excerpt_option',
    array(
        'choices' => $blogexcerpt,
        'label' => esc_html__('Show Description From', 'ample-shop'),
        'section' => 'ample_shop_blog_archive_layout_option',
        'type' => 'select',
        'priority' => 8
    )
);

/**
 * Description Length In Words
 */
$wp_customize->add_setting(
    'ample_shop_description_length_option',
    array(
        'default' => $default['ample_shop_description_length_option'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('ample_shop_description_length_option',
    array(
        'label' => esc_html__('Description Length In Words', 'ample-shop'),
        'section' => 'ample_shop_blog_archive_layout_option',
        'type' => 'number',
        'priority' => 12
    )
);
/*-------------------------------------------------------------------------------------------*/
/**
 * Feature Image Option
 *
 */
$wp_customize->add_section(
    'ample_shop_feature_image_info_option',
    array(
        'title' => esc_html__('Feature Image Option For Single post / Page', 'ample-shop'),
        'panel' => 'ample_shop_theme_options',
        'priority' => 6,
    )
);


/**
 * Feature Image Option Single page
 */
$wp_customize->add_setting(
    'ample_shop_show_feature_image_single_option',
    array(
        'default' => $default['ample_shop_show_feature_image_single_option'],
        'sanitize_callback' => 'ample_shop_sanitize_select',
    )
);

$hide_show_feature_image_option = ample_shop_show_feature_image_option();
$wp_customize->add_control(
    'ample_shop_show_feature_image_single_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Show/Hide Feature Image For Single Page/post', 'ample-shop'),
        'section' => 'ample_shop_feature_image_info_option',
        'choices' => $hide_show_feature_image_option,
        'priority' => 5
    )
);





/*Site Layout Options*/
$wp_customize->add_section( 'ample_shop_design_options', array(
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Site Layout', 'ample-shop' ),
    'panel'          => 'ample_shop_homepage_settings_panel',
) );


/**
 * Site layout Option
 */
$wp_customize->add_setting(
    'ample_shop_site_layout_options',
    array(
        'default' => $default['ample_shop_site_layout_options'],
        'sanitize_callback' => 'ample_shop_sanitize_select',
    )
);


$site_layout = ample_shop_layout_design();
$wp_customize->add_control('ample_shop_site_layout_options',
    array(
        'label' => esc_html__('Site Layout', 'ample-shop'),
        'description' => esc_html__('Choose layout', 'ample-shop'),
        'section' => 'ample_shop_design_options',
        'type' => 'select',
        'choices' => $site_layout,
        'priority' => 10
    )
);





/*Site menu Options*/
$wp_customize->add_section( 'ample_shop_menu_options', array(
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Categories Menu Option', 'ample-shop' ),
    'panel'          => 'ample_shop_homepage_settings_panel',
) );


/**
 * Site layout Option
 */
$wp_customize->add_setting(
    'ample_shop_menu_options',
    array(
        'default' => $default['ample_shop_menu_options'],
        'sanitize_callback' => 'ample_shop_sanitize_select',
    )
);


$site_menu_option = ample_shop_menu_option();
$wp_customize->add_control('ample_shop_menu_options',
    array(
        'label' => esc_html__('Categories Menu Option', 'ample-shop'),
        'description' => esc_html__('Choose Categories Menu Option', 'ample-shop'),
        'section' => 'ample_shop_menu_options',
        'type' => 'select',
        'choices' => $site_menu_option,
        'priority' => 11
    )
);
