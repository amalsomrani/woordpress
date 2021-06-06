<?php
/**
 * Dynamic css
 *
 * @package Ample Themes
 * @subpackage shop agency
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('ample_shop_dynamic_css') ):
    function ample_shop_dynamic_css(){

        $ample_shop_top_header_color = esc_attr( ample_shop_get_option('ample_shop_top_header_background_color') );

        $ample_shop_top_footer_color = esc_attr( ample_shop_get_option('ample_shop_top_footer_background_color') );


        $ample_shop_primary_color = esc_attr( ample_shop_get_option('ample_shop_primary_color') );
        $ample_shop_primary_hover_color = esc_attr( ample_shop_get_option('ample_shop_primary_hover_color') );

        $ample_shop_bottom_footer_color = esc_attr( ample_shop_get_option('ample_shop_bottom_footer_background_color') );


        $custom_css = '';


        /*====================Dynamic Css =====================*/
        $custom_css .= ".header-top{
         background-color: " . $ample_shop_top_header_color . ";}
    ";




        $custom_css .= ".ample-shop-topfooter,.slide-texts .button{
         background-color: " . $ample_shop_top_footer_color . ";}
    ";





            $custom_css .= " .text1 a, a.edit, a.wishlist-btn, h2.flipX, .product-item .item-inner .pro-box-info span.btn-cart a{
    
           color: " . $ample_shop_primary_color . ";}
    ";
        $custom_css .= ".tnp-widget input.tnp-submit, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.banner-ample .banner-box .shop-now
    
 {
    
           background-color: " . $ample_shop_primary_color .'!important'. ";}
           
    ";


        $custom_css .= "a.meta-more, span.page-numbers.current, .wpcf7 .wpcf7-submit, input.tnp-submit, aside.sidebar .input-group button.btn-search, .widget h2 span,.meta-more a,.side-details li a, a.scrollup, button.single_add_to_cart_button.button.alt,.text3 a,.woocommerce span.onsale, a.button.product_type_variable.add_to_cart_button, #search button, .advance-search-form button.btn-search, .icon-sale-label, a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart, a.added_to_cart.wc-forward, .ample-service-area .block-wrapper, .headerlinkmenu div.links div a span, .advance-search-form button.btn-search, .mini-cart .basket a .fa-shopping-cart:before,.slide-texts .button{
           background: " . $ample_shop_primary_color . ";}
           
    ";




        $custom_css .= "..icon-box--description .fa{
         border-color: " . $ample_shop_primary_color .'!important'. ";}
    ";
        


        $custom_css .= "footer{
           background: " . $ample_shop_bottom_footer_color . ";}
           
    ";

        $custom_css .= ".block-wrapper.support:hover, .menu.category .accordion-toggle:hover,.slide-texts .button:hover , a.shop-now:hover, .advance-search-form button.btn-search:hover, woocommerce a.button:hover,a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart:hover, a.added_to_cart.wc-forward:hover{
           background: " . $ample_shop_primary_hover_color .'!important'. ";}
           
    ";
        $custom_css .= ".item-title a:hover,.site-branding a:hover, a.single_add_to_wishlist:hover,a.edit:hover, a.wishlist-btn:hover, h2.flipX:hover, .product-item .item-inner .pro-box-info span.btn-cart a:hover,a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart :hover{
           color: " . $ample_shop_primary_hover_color .'!important'. ";}
           
    ";

        /*------------------------------------------------------------------------------------------------- */

        /*custom css*/


        wp_add_inline_style('ample-shop-style', $custom_css);

    }
endif;
add_action('wp_enqueue_scripts', 'ample_shop_dynamic_css', 99);