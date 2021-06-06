<?php
if (!class_exists('Ample_Shop_Info_Widget')) {
    class Ample_Shop_Info_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'iconFirst' => 'fa-truck',
                'sub_titleFirst' =>esc_html__('Free Shipping With Every Order','ample-shop'),
                'titleFirst' => esc_html__('FREE SHIPPING & RETURNING','ample-shop'),

                'iconSecond' => 'fa-money',
                'sub_titleSecond' => esc_html__('100% Money Back Guarantee','ample-shop'),
                'titleSecond' => esc_html__('MONEY BACK GUARANTEE','ample-shop'),

                'iconThird' => 'fa-user',
                'sub_titleThird' => esc_html__('24/7 customer services','ample-shop'),
                'titleThird' => esc_html__('24/7 Live Support','ample-shop'),

                'layout' =>'layout1',

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'ample_shop-info-widget',
                esc_html__('AT : info Widget', 'ample-shop'),
                array('sub_title' => esc_html__(' info Section', 'ample-shop'))
            );
        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());

            $counters = array('First', 'Second', 'Third');
            $i = 0;

            foreach ($counters as $countervalue) {

                $title = esc_attr($instance['title' . $countervalue]);
                $sub_title = esc_attr($instance['sub_title' . $countervalue]);
                $icon = esc_attr($instance['icon' . $countervalue])

                ?>
                <p>
                    <label
                        for="<?php echo esc_attr($this->get_field_id('icon' . $countervalue)); ?>"><?php  esc_html_e('Icon ' . $countervalue, 'ample-shop'); ?>
                    </label><br/>
                    <small>
                        <?php
                        esc_html_e('Font Awesome Icon Used in Widgets', 'ample-shop');
                        printf(__('%1$sRefer here%2$s for icon class. For example: %3$sfa-shopping-cart%4$s', 'ample-shop'), '<br /><a href="' . esc_url('http://fontawesome.io/cheatsheet/') . '" target="_blank">', '</a>', "<code>", "</code>");
                        ?>
                    </small>
                    <strong>
                        <input type="text" name="<?php echo esc_attr($this->get_field_name('icon' . $countervalue)); ?>"
                               class="widefat"
                               id="<?php echo esc_attr($this->get_field_id('icon' . $countervalue)); ?>"
                               value="<?php echo $icon; ?>">
                    </strong>
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('title' . $countervalue)); ?>">
                        <?php  esc_html_e('Title ' . $countervalue, 'ample-shop'); ?>
                    </label><br/>
                    <input type="text" name="<?php echo esc_attr($this->get_field_name('title' . $countervalue)); ?>"
                           class="widefat"
                           id="<?php echo esc_attr($this->get_field_id('title' . $countervalue)); ?>"
                           value="<?php echo $title; ?>">
                </p>

                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('sub_title' . $countervalue)); ?>">
                        <?php  esc_html_e('Sub-title ' . $countervalue, 'ample-shop'); ?>
                    </label><br/>
                    <input type="text"
                           name="<?php echo esc_attr($this->get_field_name('sub_title' . $countervalue)); ?>"
                           class="widefat"
                           id="<?php echo esc_attr($this->get_field_id('sub_title' . $countervalue)); ?>"
                           value="<?php echo $sub_title; ?>">
                </p>
                <?php
                $i++;
            }

            ?>


            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout:', 'ample-shop' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
                    <option value="layout1" <?php selected( $instance['layout'], 'layout1'); ?>><?php esc_html_e( 'layout 1', 'ample-shop' ); ?></option>
                    <option value="layout2" <?php selected( $instance['layout'], 'layout2'); ?>><?php esc_html_e( 'layout 2 ', 'ample-shop' ); ?></option>

                </select>
            </p>

            <hr>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $counter = array('First', 'Second', 'Third');
            foreach ($counter as $counter_value) {

                $instance['title' . $counter_value] = sanitize_text_field($new_instance['title' . $counter_value]);

                $instance['sub_title' . $counter_value] = sanitize_text_field($new_instance['sub_title' . $counter_value]);
                $instance['icon' . $counter_value] = sanitize_text_field($new_instance['icon' . $counter_value]);
            }
            $instance[ 'layout' ] = ( !empty( $new_instance[ 'layout'] ) ? sanitize_text_field( $new_instance[ 'layout' ] ) :  esc_html__('','ample-shop') );



            return $instance;

        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array)$instance, $this->defaults());
                echo $args['before_widget'];
                ?>
                 <div class="ample-service-area">

              
                   
                   
                            <div class="container-fluid">
                                 <div class="row">
                        <?php
                        $layout     = isset( $instance[ 'layout' ] ) ? $instance[ 'layout' ] : '';

                        $count = 0;
                        $counter = array('First', 'Second', 'Third');
                        foreach ($counter as $counter_value) {
                            $title = esc_attr($instance['title' . $counter_value]);
                            //  $sub_title = esc_attr($instance['sub_title' . $counter_value]);
                            $icon = esc_attr($instance['icon' . $counter_value]);


                            if (!empty($icon)  && !empty($title)) {
                                $count = $count + 1;
                            }
                        }

                        foreach ($counter as $counter_value) {


                            $title = esc_attr($instance['title' . $counter_value]);
                            $sub_title = esc_attr($instance['sub_title' . $counter_value]);
                            $icon = esc_attr($instance['icon' . $counter_value]);
                            $colsm = "";
                            if (!empty($icon)  && !empty($title)) {
                               if ($count == 3) {
                                    $colsm = 4;
                                } elseif ($count == 2) {
                                    $colsm = 6;
                                } elseif ($count == 1) {
                                    $colsm = 12;
                                }

                                ?>



                                    <div class="col-xs-12 col-sm-<?php echo esc_attr($colsm);?>  col-block">
                                        <div class="block-wrapper support ">

                                            <ul class="info <?php if($layout=='layout1') { echo esc_attr('top-icon');
                                            }
                                            ?>">

                                            <li class="icon">
                                                <i class="fa <?php echo esc_html($icon); ?>"></i>
                                            </li>

                                            <li class="text-des">
                                                <h3><?php echo esc_html($title); ?></h3>
                                                <p><?php echo esc_html($sub_title); ?> </p>
                                            </li>
                                            </ul>
                                        </div>
                                    </div>


                                <?php
                            }
                        }?>
                    </div>
                </div>
                </div>
              




                <?php
                echo $args['after_widget'];
            }

        }

    }
}

add_action('widgets_init', 'ample_shop_info_widget');
function ample_shop_info_widget()
{
    register_widget('Ample_Shop_Info_Widget');

}
