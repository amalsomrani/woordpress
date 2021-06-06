<?php
/**
 * Ample Shop functions.
 * @package Ample Shop
 * @since 1.0.0
 */

/**
 * check if WooCommerce activated
 */
function ample_shop_is_woocommerce_active() {
    return class_exists( 'WooCommerce' ) ? true : false;
}
/**
* Cart Link
*/
if ( ! function_exists( 'ample_shop_woocommerce_cart_link' ) ) :
function ample_shop_woocommerce_cart_link() {
    $ample_shop_cart_icon_title = apply_filters( 'ample_shop_cart_icon_title', esc_html__( 'View your shopping cart', 'ample-shop' ) );
    ?>
        <a class="cart-content" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr( $ample_shop_cart_icon_title ); ?>">
            <i class="la la-shopping-bag"></i>
            <?php $item_count_text = WC()->cart->get_cart_contents_count(); ?>
            <span class="count badge">
                <?php echo esc_html( $item_count_text ); ?>
            </span>
            <span class="cart-details">
                <label class="your-cart"><?php esc_html_e('Your Cart :','ample-shop') ?></label>
                <label class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></label>
            </span>
        </a>
    <?php
}
endif;
