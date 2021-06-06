<?php
/**
 * Product search template.
 *
 * @package Ample Shop
 */
?>
	<?php $args = array(
		'number'     => '',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true
	);
	$product_categories = get_terms( 'product_cat', $args );
	$categories_show    = '<option value="">' . __( 'All Categories', 'ample-shop' ) . '</option>';
	$check              = '';
	if ( is_search() ) {
		if ( isset( $_GET['term'] ) && $_GET['term'] != '' ) {
			$check = sanitize_text_field(sanitize_text_field($_GET['term']));
		}
	}
	$checked = '';

	foreach ( $product_categories as $category ) {
		if ( isset( $category->slug ) ) {
			if ( trim( $category->slug ) == trim( $check ) ) {
				$checked = 'selected="selected"';
			}
			$categories_show .= '<option ' . $checked . ' value="' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</option>';
			$checked         = '';
		}
	}

	$form = '<form role="search" class="woocommerce-product-search" method="get" id="searchform" action="' .  esc_url( home_url( '/' ) ) . '">
			<div class="advance-search-wrap">

	            <select id="search-from-categories" class="select_products" name="term">' . $categories_show . '</select>
	        </div>
            <div class="advance-search-form">
	          	<input type="search" value="' . get_search_query() . '" name="s" id="s" class="search-input typeahead" placeholder="' . esc_attr__( 'Search for products', 'ample-shop' ) . '" />
	             <input type="hidden" name="post_type" value="product" />
	             <input type="hidden" name="taxonomy" value="product_cat" />
                 <button type="submit" class="btn-search" ><i class="fa fa-search"></i></button>            </div>
            </form>';
	echo $form;

	?>