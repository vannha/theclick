<?php
/**
 * Change cart item thumbnail size 
*/
if(!function_exists('theclick_woocommerce_cart_item_thumbnail')){
	add_filter('woocommerce_cart_item_thumbnail','theclick_woocommerce_cart_item_thumbnail', 10, 3);
	function  theclick_woocommerce_cart_item_thumbnail($thumbnail, $cart_item, $cart_item_key){
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$thumbnail_id = get_post_thumbnail_id($product_id);
		// thumbnail size
		$thumbnail_size_w = str_replace('px', '', theclick_configs('theclick_woocommerce_cart_item_thumbnail_size')['width']);
		$thumbnail_size_h = str_replace('px', '', theclick_configs('theclick_woocommerce_cart_item_thumbnail_size')['height']);
		$thumbnail_size = implode('x',[$thumbnail_size_w, $thumbnail_size_h]);
		
		$thumbnail = theclick_image_by_size([
			'id' => $thumbnail_id, 
			'size' => $thumbnail_size,
			'echo' => false
		]);
		return $thumbnail;
	}
}

/**
 * Change Cart Item Name output
 *
 * Add Product Brand at Top
 * Filter: woocommerce_cart_item_name
*/

if(!function_exists('theclick_woocommerce_cart_item_name')){
	add_filter('woocommerce_cart_item_name','theclick_woocommerce_cart_item_name', 10, 3);
	function theclick_woocommerce_cart_item_name($name, $cart_item, $cart_item_key){
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

		$terms = get_the_terms($product_id, 'pa_brand');
        if(!is_wp_error($terms)){
            $count = count($terms);
        } else {
            $count = 0;
        }
        $brand = '';
        if(is_array($terms) && $count > 0) {
        	$brand = '<div class="cart-item-brand">';       
            foreach ( $terms as $term ) {
                $brand .=  '<div class="wc-brand '.strtolower(str_replace(array(' ','&','amp;'), '-', $term->name)).'">'.$term->name.'</div>';
            }
         	$brand .= '</div>';
        }

		$name = '<div class="cart-item-name-wrap">';
			$name .= $brand;

			if ( ! $product_permalink ) {
				$name .= $_product->get_name();
			} else {
				$name .= sprintf( '<a class="cart-item-name" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() );
			}
		$name .= '</div>';
		return $name;
	}
}

/**
 * Custom Cart Actions Layout
*/
if(!function_exists('theclick_woocommerce_cart_actions')){
	add_action('woocommerce_cart_actions','theclick_woocommerce_cart_actions', 10);
	remove_action('woocommerce_cart_collaterals','woocommerce_cart_totals',10);
	function theclick_woocommerce_cart_actions(){
		?>
		<div class="ef5-cart-actions-wrap row justify-content-between">
			<div class="col-12 col-lg-auto empty-none"><div class="ef5-cart-action-col ef5-cart-action-left d-flex gutters-30 justify-content-center justify-content-lg-start"><?php do_action('theclick_woocommerce_cart_actions_left'); ?></div></div>
			<div class="col-12 col-lg-auto empty-none"><div class="ef5-cart-action-col ef5-cart-action-right d-flex gutters-10 justify-content-center justify-content-lg-end"><?php do_action('theclick_woocommerce_cart_actions_right'); ?></div></div>
		</div>
		<?php
	}
}
/* Return Shop Button */
if(!function_exists('theclick_woocommerce_return_shop')){
	add_action('theclick_woocommerce_cart_actions_left', 'theclick_woocommerce_return_shop', 1);
	function theclick_woocommerce_return_shop(){
		if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<div class="ef5-return-shop">
				<a class="ef5-btn accent fill ef5-btn-xmd" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
					<span class="ef5-return-shop-icon"></span>
					<span><?php esc_html_e( 'Continue Shopping', 'theclick' ); ?></span>
				</a>
			</div>
		<?php endif; 
	}
}
// Coupon
add_action('theclick_woocommerce_cart_actions_left', 'theclick_woocommerce_cart_coupon', 2);
function theclick_woocommerce_cart_coupon(){
	if ( wc_coupons_enabled() ) { 
	?>
	<div class="ef5-cart-coupon coupon d-flex justify-content-center">
		<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter your coupon', 'theclick' ); ?>" />
		<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Confirm', 'theclick' ); ?>"><?php esc_attr_e( 'Confirm', 'theclick' ); ?></button>
		<?php do_action( 'woocommerce_cart_coupon' ); ?>
	</div>
	<?php 
	} 
}

/**
 * After Cart Table 
 *
 * Add Back to Shop button
 * Add Clear Cart Button
 * Add Update Cart Button
 * Add Process to Checkout button
 *
*/
if(!function_exists('theclick_woocommerce_after_cart_table')){
	//add_action('woocommerce_after_cart_table','theclick_woocommerce_after_cart_table', 1);
	/**
	 * Change proceed to checkout button position
	*/
	remove_action('woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);

	function theclick_woocommerce_after_cart_table(){
	?>
	<div class="ef5-after-cart-table row justify-content-between gutters-30">
		<div class="col-lg-6 col-left align-items-center d-md-flex justify-content-lg-start justify-content-center text-center">
			<?php do_action('theclick_woocommerce_after_cart_table_left'); ?>
		</div>
		<div class="col-lg-6 col-right align-items-center d-md-flex justify-content-lg-end justify-content-center">
		</div>
	</div>
	<?php
	}
}


// check for empty-cart get param to clear the cart
if(!function_exists('theclick_woocommerce_clear_cart_url')){
	add_action( 'init', 'theclick_woocommerce_clear_cart_url' );
	function theclick_woocommerce_clear_cart_url() {
		if ( isset( $_GET['empty-cart'] ) ) {
			WC()->cart->empty_cart();
		}
	}
}
if(!function_exists('theclick_woocommerce_clear_cart_button')){
	add_action('theclick_woocommerce_cart_actions_right', 'theclick_woocommerce_clear_cart_button', 1);
	function theclick_woocommerce_clear_cart_button(){
		$link = wc_get_cart_url();
        $link = add_query_arg( 'empty-cart', '', $link );
		?>
			<div class="ef5-clear-cart">
				<a class="ef5-btn accent outline2 ef5-btn-xmd minw-180" href="<?php echo esc_url($link);?>"><span class="ef5-clear-cart-icon"></span><span><?php esc_html_e( 'Clear Cart', 'theclick' ); ?></span></a>
			</div>
		<?php
	}
}

// Update Cart 
if(!function_exists('theclick_woocommerce_cart_update')){
	add_action('theclick_woocommerce_cart_actions_right','theclick_woocommerce_cart_update', 2);
	function theclick_woocommerce_cart_update(){
		?>
		<div class="ef5-update-cart">
			<button type="submit" class="ef5-btn ef5-btn-xmd accent fill minw-180" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'theclick' ); ?>"><span class="ef5-update-cart-icon"></span><span><?php esc_html_e( 'Update cart', 'theclick' ); ?></span></button>
		</div>
		<?php
	}
}

// Cart Totals
if(!function_exists('theclick_woocommerce_cart_collaterals')){
	remove_action('woocommerce_cart_collaterals','woocommerce_cart_totals',10);
	add_action('woocommerce_cart_collaterals', 'theclick_woocommerce_cart_collaterals');
	add_action('theclick_woocommerce_cart_collaterals', 'woocommerce_cart_totals', 1);
	function theclick_woocommerce_cart_collaterals(){
		?>
		<div class="row justify-content-end">
			<div class="col-12 col-md-auto">
				<?php do_action('theclick_woocommerce_cart_collaterals'); ?>
			</div>
		</div>
		<?php
	}
}

// Checkout button
if(!function_exists('theclick_woocommerce_cart_checkout_button')){
	add_action('theclick_woocommerce_cart_collaterals','theclick_woocommerce_cart_checkout_button', 2);
	function theclick_woocommerce_cart_checkout_button(){
		?>
		<div class="ef5-cart-checkout-btn">
			<a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="ef5-btn accent fill w-100 ef5-btn-xmd">
					<span class="ef5-cart-checkout-icon"></span><span><?php esc_html_e( 'Checkout', 'theclick' ); ?></span>
				</a>
		</div>
		<?php
	}
}

/**
 * Custom Cross Sells Columns and Limit
 * 
*/
add_filter('woocommerce_cross_sells_columns', function() { return apply_filters('theclick_woocommerce_cross_sells_columns', '4');});
add_filter('woocommerce_cross_sells_total', function() { return apply_filters('theclick_woocommerce_cross_sells_columns', '4');});
