<?php
if (!class_exists('Ample_Shop_Testimonials_Widget')) {
    class Ample_Shop_Testimonials_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title' => esc_html__('what our clients say about us ?', 'ample-shop'),
                'resources' => '',


            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'ample_shop_testimonials_widget',
                esc_html__('AT : Testimonials Widget', 'ample-shop'),
                array('description' => esc_html__(' Testimonials Section', 'ample-shop'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $resources   = ( ! empty( $instance['resources'] ) ) ? $instance['resources'] : array();
            $title = esc_attr($instance['title']);


            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'ample-shop'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>">
            </p>

            <span class="at-ample-additional">
            <!--repeater-->
            <label><?php _e( 'Select Pages', 'ample-shop' ); ?>:</label>
            <br/>
            <small><?php _e( 'Add Page and Remove. Please do not forget to add Icon on selected pages.', 'ample-shop' ); ?></small>

                <?php
                if  ( count( $resources ) >=  1 && is_array( $resources ) )
                {

                    $selected = $resources['main'];

                }

                else
                {
                    $selected = "";
                }

                $repeater_id   = $this->get_field_id( 'resources' ).'-main';
                $repeater_name = $this->get_field_name( 'resources'). '[main]';

                $args = array(
                    'selected'          => $selected,
                    'name'              => $repeater_name,
                    'id'                => $repeater_id,
                    'class'             => 'widefat pt-select',
                    'show_option_none'  => __( 'Select Page', 'ample-shop'),
                    'option_none_value' => 0 // string
                );
                wp_dropdown_pages( $args );
                ?>

                <?php

                $counter = 0;

                if ( count( $resources ) > 0 )
                {
                    foreach( $resources as $resource )
                    {

                        if ( isset( $resource['page_ids'] ) )

                        { ?>
                            <div class="at-ample-sec">

                                <?php

                                $repeater_id     = $this->get_field_id( 'resources' ) .'-'. $counter.'-page_ids';
                                $repeater_name   = $this->get_field_name( 'resources' ) . '['.$counter.'][page_ids]';

                                $args = array(
                                    'selected'          => $resource['page_ids'],
                                    'name'              => $repeater_name,
                                    'id'                => $repeater_id,
                                    'class'             => 'widefat pt-select',
                                    'show_option_none'  => __( 'Select Page', 'ample-shop'),
                                    'option_none_value' => 0 // string
                                );
                                wp_dropdown_pages( $args );
                                ?>
                                <a class="at-ample-remove delete"><?php esc_html_e('Remove Section','ample-shop') ?></a>

                            </div>
                            <?php
                            $counter++;
                        }
                    }
                }

                ?>

            </span>
            <a class="at-ample-add button" data-id="ample-shop_resource_widget" id="<?php echo  esc_attr( $repeater_id); ?>"><?php _e('Add New Section', 'ample-shop'); ?></a>

            <hr/>


            <hr>

            <?php
        }
        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);


            if (isset($new_instance['resources']))
            {
                foreach($new_instance['resources'] as $resource){

                    $resource['page_ids'] = absint($resource['page_ids']);
                }
                $instance['resources'] = $new_instance['resources'];
            }
            return $instance;

        }
        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);

                $resources = (!empty($instance['resources'])) ? $instance['resources'] : array();

                echo $args['before_widget'];
                ?>

                <!-- Testimonials Box -->
                <div class="testimonials">
                <div class="container-fluid">
                    <div id="testimonial-slider" class="product-flexslid">
                        <h2 class="heading-title"><?php echo esc_html($title); ?></h2>
                        <div class="slider-items-wrapper owl-carousel">

                            <?php if (isset($resources) && !empty($resources['main'])) { ?>
                                <?php
                                $post_in = array();

                                if (count($resources) > 0 && is_array($resources)) {

                                    $post_in[0] = $resources['main'];

                                    foreach ($resources as $our_resource) {

                                        if (isset($our_resource['page_ids']) && !empty($our_resource['page_ids'])) {

                                            $post_in[] = $our_resource['page_ids'];

                                        }
                                    }


                                }

                                if (!empty($post_in)) :
                                    $resources_page_args = array(
                                        'post__in' => $post_in,
                                        'orderby' => 'post__in',
                                        'posts_per_page' => count($post_in),
                                        'post_type' => 'page',
                                        'no_found_rows' => true,
                                        'post_status' => 'publish'
                                    );

                                    $resources_query = new WP_Query($resources_page_args);

                                    /*The Loop*/
                                    if ($resources_query->have_posts()):
                                        $i = 1;
                                        while ($resources_query->have_posts()):$resources_query->the_post();

                                            ?>



                                            <div class="holder">

                                                <div class="thumb">
                                                    <?php
                                                    if (has_post_thumbnail()) {
                                                        $image_id = get_post_thumbnail_id();
                                                        $image_url = wp_get_attachment_image_src($image_id, 'small', true);
                                                        ?>
                                                        <img src="<?php echo esc_url($image_url[0]); ?>" class="testimonial-img" alt="<?php the_title_attribute(); ?>">
                                                    <?php } ?>

                                                </div>
                                                <div class="author"> <p>"<?php echo esc_html(wp_trim_words(get_the_content(), 30)); ?> " </p>
                                                    <strong class="name"><?php the_title(); ?></strong> <strong class="designation"></strong></div>
                                            </div>


                                        <?php
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();
                                endif;
                            }
                            ?>


                        </div>
                    </div>

                </div>
                <!-- category-area end -->







                <?php
                echo $args['after_widget'];
            }
        }

    }
}

add_action('widgets_init', 'Ample_Shop_testimonials_widget');
function ample_shop_testimonials_widget()
{
    register_widget('Ample_Shop_Testimonials_Widget');

}

