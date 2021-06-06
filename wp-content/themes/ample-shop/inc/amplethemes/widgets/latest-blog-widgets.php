<?php
if (!class_exists('Ample_Shop_Recent_Post_Widget')) {
    class Ample_Shop_Recent_Post_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => 0,
                'title' => esc_html__('Latest Blogs', 'ample-shop'),


            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'ample-shop-recent-post-widget',
                esc_html__(' AT : Latest Blog Widget', 'ample-shop'),
                array('description' => esc_html__('Business Latest Blog Section', 'ample-shop'))
            );
        }

        public function form($instance)
        {

            $instance = wp_parse_args((array )$instance, $this->defaults());
            $catid = absint($instance['cat_id']);
            $title = esc_attr($instance['title']);


            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'ample-shop'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       value="<?php echo esc_attr($title); ?>">
            </p>


            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id')); ?>">
                    <?php esc_html_e('Select Category', 'ample-shop'); ?>
                </label><br/>
                <?php
                $business_con_dropown_cat = array(
                    'show_option_none' => esc_html__('From Recent Posts', 'ample-shop'),
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
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($business_con_dropown_cat);
                ?>
            </p>
            <hr>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint($new_instance['cat_id']) : '';
            $instance['title'] = sanitize_text_field($new_instance['title']);


            return $instance;

        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $catid = absint($instance['cat_id']);
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);


                ?>


                <!-- category area start -->
                <div class="latest-wrapper">
                <div class="container-fluid">
                <div id="latest-news" class="news">
                <div class="page-header">
                    <h2><?php echo esc_html($title); ?></h2>
                </div>
                <div class="slider-items-products">
                <div id="latest-news-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col6 owl-carousel">

                <?php
                $i = 0;
                $sticky = get_option('sticky_posts');
                if ($catid != -1) {
                    $home_recent_post_section = array(
                        'ignore_sticky_posts' => true,
                        'post__not_in' => $sticky,
                        'cat' => $catid,
                        'posts_per_page' => 4,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                    );
                } else {
                    $home_recent_post_section = array(
                        'ignore_sticky_posts' => true,
                        'post__not_in' => $sticky,
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                    );
                }

                $home_recent_post_section_query = new WP_Query($home_recent_post_section);

                if ($home_recent_post_section_query->have_posts()) {
                    while ($home_recent_post_section_query->have_posts()) {
                        $home_recent_post_section_query->the_post();
                        ?>
                        <!-- Single blog item -->

                        <!-- Item -->
                        <div class="item">
                        <div class="ample-blog">
                        <div class="blog-img"> <a href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) {
                            $image_id = get_post_thumbnail_id();
                            $image_url = wp_get_attachment_image_src($image_id, 'large', true);
                            ?>

                            <img class="primary-img" src="<?php echo esc_url($image_url[0]); ?>"
                                 alt="<?php the_title_attribute(); ?>"></a> <span class="moretag"></span> </div>
                            <div class="blog-content-ample">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <span><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></span>
                                <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
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


                    <!-- latest-wrapper    -->


                    <?php
                    echo $args['after_widget'];
                }
            }

        }
    }}
add_action('widgets_init', 'ample_shop_recent_post_widget');
function ample_shop_recent_post_widget()
{
    register_widget('Ample_Shop_Recent_Post_Widget');

}
