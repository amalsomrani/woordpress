<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ample_Shop
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class('at-sticky-sidebar'); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
else { do_action( 'wp_body_open' ); }

global $post_id;

ample_shop_social_sharing($post_id);


?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ample-shop' ); ?></a>

<a href="#" class="scrollup"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>

<div id='scroll-cart' class="side-details">
    <?php if ( class_exists( 'WooCommerce' ) ) {
        $item_count_text = WC()->cart->get_cart_contents_count();?>
        <ul>
            <li><a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" aria-label="<?php  esc_attr_e('User Details','ample-shop');?>" >  <i class="fa fa-user" aria-hidden="true"></i> </a></li>
            <li><a href="<?php echo esc_url( wc_get_cart_url());  ?>" aria-label="<?php  esc_attr_e('Shopping Cart','ample-shop');?>" > <i class="fa fa-shopping-cart"><span class="quantity side"> <?php echo esc_html( $item_count_text ); ?> </span> </i><br/><span class="sub-total"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> </a></li>
        </ul>
    <?php } ?>
</div>
<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
?>
<div id="<?php if($section_option_layout =='boxed'){ echo esc_attr('page'); } ?>" class="site">   
    <div id="page-1">
        <header id="masthead" class="site-header">


            <div class="header-container">

                <?php
                $section_option_company_info = ample_shop_get_option('ample_shop_info_header_section');
                $location_icon = ample_shop_get_option('ample_shop_info_header_section_location_icon');
                $location = ample_shop_get_option('ample_shop_info_header_location');

                $number_icon = ample_shop_get_option('ample_shop_info_header_section_phone_number_icon');
                $number = ample_shop_get_option('ample_shop_info_header_phone_no');

                $email_icon = ample_shop_get_option('ample_shop_email_icon');
                $email = ample_shop_get_option('ample_shop_info_header_email');


                if ($section_option_company_info == 'show') {
                    ?>
                    <div class="header-top">
                        <div class="<?php
                        $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
                        if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');} ?>">
                            <div class="row">
                                <div class="col-md-8 col-sm-5">
                                    <?php if (!empty( $location)){ ?>
                                    <ul class="header-info">
                                        <li>
                                            <span class="icon-box--description"><a href="#"><i class="fa <?php echo esc_html($location_icon);?>"></i> <?php echo esc_html( $location);?></a></span>
                                        </li>
                                        <?php }if (!empty($number)){ ?>

                                            <li>
                                                <span class="icon-box--description"><a href="<?php echo esc_url('tel:' .$number) ?>"><i class="fa <?php echo  esc_html( $number_icon);?> "></i> <?php echo esc_html( $number);?></a></span>
                                            </li>
                                        <?php } if (!empty( $email)){
                                            ?>

                                            <li>
                                                <span class="icon-box--description"><a href="<?php echo esc_url('mailto:' .  $email); ?>"><i class="fa <?php echo esc_html( $email_icon);?>"></i> <?php echo esc_html( $email);?></a></span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <!-- top links -->
                                <div class="headerlinkmenu col-lg-4 col-md-4 col-sm-7  text-right">
                                    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                                        <div class="links">
                                            <div class="ample-user-info">
                                                <div class="top-account-wrapper logged-out">
                                                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <?php if ( is_user_logged_in() ) { ?>
                                                            <span class="top-log-in"><?php esc_html_e('Account Details ','ample-shop');?></span>
                                                            <?php
                                                        }else{ ?>

                                                            <span class="top-log-in"><?php esc_html_e('Login/Register','ample-shop');?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>


                <div class="<?php
                $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
                if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');} ?>">
                    <div class="row">
                        <div class="<?php if ( class_exists( 'WooCommerce' ) ) { echo  esc_attr('col-md-3'); } else{ echo  esc_attr(' logo-center col-sm-12 col-md-12');} ?> col-xs-12">
                            <!-- Header Logo -->
                            <div class="logo">
                                <div class="site-branding">
                                    <?php
                                    if (has_custom_logo()) { ?>
                                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                                            <?php the_custom_logo(); ?>
                                        </a>
                                    <?php } else {
                                        if (is_front_page() && is_home()) : ?>
                                            <h1 class="site-title">
                                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                            </h1>
                                        <?php else : ?>
                                            <h1 class="site-title">
                                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                            </h1>
                                        <?php
                                        endif;
                                        $description = get_bloginfo('description', 'display');
                                        if ($description || is_customize_preview()) : ?>
                                            <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                                        <?php
                                        endif;
                                    } ?>
                                </div><!-- .site-branding -->
                            </div>
                            <!-- End Header Logo -->
                        </div>
                        <div class="col-md-6 ">
                            <!-- Search -->
                            <div class="top-search">

                                <div id="search">
                                    <?php if ( class_exists( 'WooCommerce' ) ) { ?>

                                        <?php get_template_part( 'template-parts/product-search' ); ?>

                                    <?php }
                                    ?>


                                </div>
                            </div>
                            <!-- End Search -->

                        </div>

                        <div class="col-md-3 top-cart clearfix">
                            <div class="top-wishlist-wrapper">
                                <div class="top-icon-wrap">
                                    <?php
                                    if( class_exists( 'YITH_WCWL' ) ){
                                        $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );

                                        if ( absint( $wishlist_page_id ) > 0 ) : ?>

                                            <a class="wishlist-btn" href="<?php echo esc_url( get_permalink( $wishlist_page_id ) ); ?>"><i class="fa fa-heart" aria-hidden="true"></i><span class="wish-value"><?php echo absint( yith_wcwl_count_products() ); ?></span></a>

                                        <?php endif;
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                                <div class="top-cart-contain">

                                    <div class="mini-cart">
                                        <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#">
                                                <div class="cart-icon"><i class="fa fa-shopping-cart"></i></div>
                                                <div class="shoppingcart-inner">
                                                    <span ><?php ample_shop_woocommerce_cart_link(); ?></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div>
                                            <div class="top-cart-content">
                                                <div class="wc-cart-widget-wrapper">
                                                    <?php the_widget( 'WC_Widget_Cart', '' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end header -->
            <?php  if (has_nav_menu('menu-1')) { ?>
                <div class="main-header navbar-expand-md navbar-light bg-light">


                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  
         <i class="fa fa-bars"></i>
  </button>

                    <div id="menu-bar" class="main-menu primary">
                        <div class="container-fluid">

                            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                                <div class="menu category">
                                    <?php  $menu_option = ample_shop_get_option('ample_shop_menu_options');
                                    if($menu_option=='custom-menu'){?>
                                        <?php  if (has_nav_menu('cat-id')) { ?>
                                        <div class="nav-wrapper">

                                                <div class="all-category-nav">
                                                   
                                                         <button onclick="myFunction()" class="all-navigator"><i class="fa fa-bars"></i> <span><?php esc_html_e('categories','ample-shop'); ?></span> <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                               <i class="fa fa-angle-up"aria-hidden="true" ></i>
                                                         </button>


                                                        <!-- for toogle menu -->

                                                   
                                                             <ul id="myDropdown" class="all-category-list">

                                                            <?php
                                                            wp_nav_menu(array(
                                                                    'theme_location' => 'cat-id',
                                                                    'menu_class' => 'all-category-list-item',

                                                                )
                                                            );
                                                            ?>

                                                        </ul>
                                                
                                            
                                                </div>

                                            </div>

                                    <?php }}else{ ?>
                                    <ul class="accordion list-unstyled" id="view-all-guides">
                                        <li class="accordion-group list-unstyled">
                                            <button type="button" class="accordion-toggle" data-toggle="collapse" data-target="#collapseOne" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                <i class="fa fa-bars" aria-hidden="true"></i> <?php esc_html_e( 'All Categories', 'ample-shop' ); ?></button>
                                            <div id="collapseOne" class="accordion-body collapse">

                                                <ul class="list-unstyled">
                                                    <?php wp_list_categories( 'title_li=&taxonomy=product_cat&show_count=1' ); ?>
                                                </ul>

                                            </div>
                                        </li>
                                    </ul >
                                    <?php } ?>



                                </div>
                            <?php } ?>

                           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Start Menu Section -->
                                <div class="menu">
                                    <div class="navbar-nav">

                                        <!--<nav id="site-navigation" class="main-navigation" role="navigation"> -->
                                        <!-- for toogle menu -->
                                        <?php
                                        wp_nav_menu(array(
                                                'theme_location' => 'menu-1',
                                                'menu_class' => 'main-nav',

                                            )
                                        );
                                        ?>
                                    </div>
                                    <!-- </nav> -->
                                </div>
                                <!-- End Menu Section -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php }   ?>
        </header><!-- #masthead -->
        <div id="content" class="site-content">