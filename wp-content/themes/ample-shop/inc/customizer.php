<?php
/**
 * Ample Shop Theme Customizer
 *
 * @package Ample_Shop
 */


require get_template_directory() . '/inc/customizer-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ample_shop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    $default= ample_shop_get_default_theme_options();

    require get_template_directory() . '/inc/amplethemes/customizer/bannar-section/bannar.php';
    require get_template_directory() . '/inc/amplethemes/customizer/layout-design/layout-customization.php';
    require get_template_directory() . '/inc/amplethemes/customizer/company-info/company-info.php';
    require get_template_directory() . '/inc/amplethemes/customizer/footer-option/footer-option-customizer.php';
    require get_template_directory() . '/inc/amplethemes/customizer/color-customize/color.php';
    require get_template_directory() . '/inc/amplethemes/customizer/theme-options-customizer/theme-options-customizer.php';


    if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ample_shop_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ample_shop_customize_partial_blogdescription',
		) );
	}

}
add_action( 'customize_register', 'ample_shop_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ample_shop_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ample_shop_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ample_shop_customize_preview_js() {
	wp_enqueue_script( 'ample-shop-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ample_shop_customize_preview_js' );
