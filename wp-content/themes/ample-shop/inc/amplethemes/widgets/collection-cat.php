<?php
/**
 * Display Selected  Featured Product
 *
 * @package Ample_Shop
 */

/**
 * A widget that display categories
 */
class Ample_Shop_Categories_Collection extends WP_Widget
{

	function __construct() {

		global $control_ops;

		$widget_ops = array(
			'classname'   => 'ample-shop-categories-collection',
			'description' => esc_html__( 'Add Widget to Display Categories.', 'ample-shop' )
		);

		parent::__construct( 'Ample_Shop_categories_collection',esc_html__( 'AT: Categories Collection', 'ample-shop' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {

		$defaults[ 'orderby' ]    = '';

		for ( $i=0; $i<2; $i++ ) {
			$var = 'cat_id'.$i;
			$defaults[$var]   = '';
		}

		$instance = wp_parse_args( (array) $instance, $defaults );



		?>

		<?php for ($i=0; $i < 2 ; $i++) {

			?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'cat_id'.$i )); ?>"><?php esc_html_e( 'Category :', 'ample-shop' ); ?></label>
				<?php wp_dropdown_categories(
					array(
						'show_option_none' => ' ',
						'name'             => $this->get_field_name( 'cat_id'.$i ),
						'selected'         => $instance['cat_id'.$i],
						'taxonomy'         => 'product_cat'
					)
				);
				?>
			</p>


			<?php	next( $defaults );// forwards the key of $defaults array
		} ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By:', 'ample-shop' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
				<option value="name" <?php selected( $instance['orderby'], 'name'); ?>><?php esc_html_e( 'Title', 'ample-shop' ); ?></option>
				<option value="id" <?php selected( $instance['orderby'], 'id'); ?>><?php esc_html_e( 'ID', 'ample-shop' ); ?></option>
				<option value="count" <?php selected( $instance['orderby'], 'count'); ?>><?php esc_html_e( 'Count', 'ample-shop' ); ?></option>
				<option value="none" <?php selected( $instance['orderby'], 'none'); ?>><?php esc_html_e( 'None', 'ample-shop' ); ?></option>
			</select>
		</p>

	<?php }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'orderby' ] 	= sanitize_text_field( $new_instance[ 'orderby' ] );


		for( $i=0; $i<2; $i++ ) {
			$var = 'cat_id'.$i;
			$instance[ $var]   = absint( $new_instance[ $var ] );

		}

		return $instance;

	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );


		$orderby = isset( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';



		$cat_array = array();
		for( $i=0; $i<2; $i++ ) {
			$var = 'cat_id'.$i;

			$cat_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';



			if( !empty( $cat_id ) ) {
				array_push( $cat_array, $cat_id );// Push the category id in the array
			}


		}

		?>
		<?php $featured_cats = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => esc_attr( $orderby),
			'hide_empty'   => '0',
			'include'      => $cat_array,
		);

		if ( !empty( $cat_array ) ) { ?>




			<!-- Banner block-->
			<div class="container-fluid">
			<div class="ample-banner-block ">
				
				
						<?php $count = 0;
						$all_categories = get_categories( $featured_cats );
						foreach ($all_categories as  $key=>$term) {


							$image_size  = 'ample-shop-product-collection-medium';



							$term_id = $term->term_id;
							$term_link = get_term_link($term);

							$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
							$image_url = wp_get_attachment_image($thumbnail_id, $image_size );




							?>

							<div class="ample-subbanner1">
								<a href="<?php echo esc_url( $term_link );?>">
									<?php echo wp_kses_post($image_url); ?>

								</a>
								<div class="text-block wow animated fadeInLeft animated">
									<div class="text1"><a href="<?php echo esc_url( $term_link );?>"><?php echo esc_html( $term->name ); ?></a></div>
									<div class="text2"><a href="<?php echo esc_url( $term_link );?>"><?php echo esc_html( $term->description)?> </a></div>
									<div class="text3"><a href="<?php echo esc_url( $term_link );?>"><?php echo esc_html__( 'Shop Now', 'ample-shop' );?></a></div>
								</div>
							</div>
							
							
							
							<?php $count++;  //var_dump( $count);?>
						<?php } ?>
</div>
					</div>
				

		<?php }

	}

}

function ample_shop_action_categories_collection() {

	register_widget( 'Ample_Shop_Categories_Collection' );

}
add_action( 'widgets_init', 'ample_shop_action_categories_collection' );