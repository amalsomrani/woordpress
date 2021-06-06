<?php
if (!class_exists('Ample_Shop_All_Product_Widget')) {
    class Ample_Shop_All_Product_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => 0,
                'title' => esc_html__('Collection Title', 'ample-shop'),
                'product_number'=>10,
                'view' => esc_html__('View All', 'ample-shop'),
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'ample-shop-all-product-widget',
                esc_html__(' AT : Each Cat Product Widget', 'ample-shop'),
                array('description' => esc_html__('select woocommerce category', 'ample-shop'))
            );
        }

        public function form($instance)
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $catid = absint($instance['cat_id']);
            $title = esc_attr($instance['title']);
            $product_number   = absint( $instance[ 'product_number' ] );
            $view = esc_attr($instance['view']);



            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'ample-shop'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>">
            </p>



            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id')); ?>">
                    <?php esc_html_e('Select Category', 'ample-shop'); ?>
                </label><br/>
                <?php
                $ample_shop_con_dropown_cat = array(
                    'show_option_none' => esc_html__('Choose product Categories', 'ample-shop'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $catid,
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id')),
                    'id' => esc_attr($this->get_field_name('cat_id')),
                    'class' => 'widefat',
                    'taxonomy' => 'product_cat',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($ample_shop_con_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>"><?php esc_html_e( 'Number of Products:', 'ample-shop' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'product_number' ) ); ?>" type="number" value="<?php echo esc_attr( $product_number ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('view') ); ?>">
                    <?php esc_html_e( 'Change View All Text Change', 'ample-shop'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('view')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('view')); ?>" value="<?php echo $view; ?>">
            </p>
            <hr>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint($new_instance['cat_id']) : '';
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance[ 'product_number' ] = absint( $new_instance[ 'product_number' ] );
            $instance['view'] = sanitize_text_field($new_instance['view']);



            return $instance;

        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $catid = absint($instance['cat_id']);
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $product_number   = isset( $instance[ 'product_number' ] ) ? $instance[ 'product_number' ] : '';
                $view = esc_html($instance['view']);



                ?>
                <div class="best-selling-slider all-product">
                    <div class="container-fluid">
                    <h3 class="products_title"><?php echo esc_html($title); ?>

            <?php
            if(!empty($view)){
                ?>
                <div class="view-all">
                    <div class="lds-dual-ring"></div>
                    <?php

                    if( absint( $catid ) > 0 ){

                        $cat_link = get_category_link( $catid );

                    }else{

                        $cat_link = '';

                    } ?>

                    <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $view); ?></a>

                    <?php

                    ?>
                </div>
            <?php } ?>
                        </h3>

            <div class="slider-items-products">
                        <div id="best-selling-slider-1" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col4">
                                <div class="row">


                                <?php
                                $i = 0;
                                if ($catid != -1) {
                                    $home_product_section = array(
                                        'post_type' => 'product',
                                        'post_status' => 'publish',
                                        'posts_per_page'   => absint( $product_number ),
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'terms' => $catid,
                                            )
                                        )
                                    );
                                } else {
                                    $home_product_section = array(
                                        'post_type' => 'product',
                                        'post_status' => 'publish',
                                        'terms' => $catid,
                                        'posts_per_page'   => absint( $product_number ),
                                        'orderby' => 'post_date',
                                        'order' => 'DESC',
                                    );
                                }

                                $home_product_section_query = new WP_Query($home_product_section);

                                if ($home_product_section_query->have_posts()) {
                                    while ($home_product_section_query->have_posts()) {
                                        $home_product_section_query->the_post();
                                        $product = wc_get_product($home_product_section_query->post->ID);
                                        $image_id = get_post_thumbnail_id();
                                        $image_url = wp_get_attachment_image_src($image_id, 'ample-shop-shop', false);
                                        if ($i % 3 == 0) { ?>
                                            <div class="clearfix"></div>
                                        <?php }
                                        ?>


                                        <div class="product-item col-sm-4">
                                            <div class="item-inner">
                                                <div class="product-thumbnail">
                                                    <?php if( $product->is_on_sale() ){ ?>
                                                    <div class="icon-sale-label sale-left"><?php esc_html_e('Sale', 'ample-shop'); ?></div>

                                                    <?php  }

                                                   if ($image_url[0]) { ?>
                                                        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
                                                           class="product-item-photo"><img class="product-image-photo"
                                                                                           src="<?php echo esc_url($image_url[0]); ?>"
                                                                                           alt="<?php the_title_attribute(); ?>"></a>
                                                    <?php } ?>
                                                    <div class="pro-box-info">
                                                        <div class="item-info">
                                                            <div class="info-inner">
                                                                <div class="item-title"><a
                                                                        href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
                                                                </div>
                                                                <div class="item-content">
                                                                    <div class="rating">
                                                                        <?php
                                                                        if ($rating_html = wc_get_rating_html($product->get_average_rating())) { ?>
                                                                            <?php echo wp_kses_post($rating_html); ?>
                                                                        <?php } else {
                                                                            echo '<div class="star-rating"></div>';
                                                                        } ?>                                                        </div>
                                                                    <div class="item-price ">
                                                                        <?php if ($price_html = $product->get_price_html()) : ?>
                                                                            <div class="price-box"><span
                                                                                    class="regular-price <?php if (function_exists('YITH_WCWL')) { echo esc_attr('price'); }else {echo esc_attr('center-price');} ?>"> <span
                                                                                        class="price"><?php echo wp_kses_post($price_html); ?></span> </span>

                                                                                <?php
                                                                                if (function_exists('YITH_WCWL')) {
                                                                                    $url = add_query_arg('add_to_wishlist', $product->get_id());
                                                                                    ?>

                                                                                    <span class="btn-cart clearfix">
                                                                                    <a href="<?php echo esc_url($url); ?>"
                                                                                       class="single_add_to_wishlist"><i
                                                                                                class="fa fa-heart"></i>
                                                                                        <?php esc_html_e('Add to Wishlist', 'ample-shop'); ?>
                                                                                    </a>
                                                                                </span>
                                                                                <?php } ?>



                                                                                <div class="clearfix"></div>
                                                                                <?php
                                                                                woocommerce_template_loop_add_to_cart($product);

                                                                                ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <?php
                                        $i++;
                                    }

                                    wp_reset_postdata();
                                } ?>



                            </div>
                        </div>
                    </div>
                     </div>
                </div>
            </div>



                <?php
                echo $args['after_widget'];
            }
        }

    }
}
add_action('widgets_init', 'ample_shop_all_product_widget');
function ample_shop_all_product_widget()
{
    register_widget('Ample_Shop_All_Product_Widget');

}
