<?php

/**
 * Remove all default WC css
*/
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Loop Products 
 * Remove Shop Title
 *
*/
add_filter('woocommerce_show_page_title', function(){ return false;});

/**
 * Archive product 
 * Wrap Result Count and Catalog Ordering
 * Hook: woocommerce_before_shop_loop.
 *
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
*/
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
add_action('woocommerce_before_shop_loop','theclick_woocommerce_count_ordering', 11);

function theclick_woocommerce_count_ordering(){
	?>
	<div class="ef5-woo-count-order d-flex justify-content-between align-items-center">
		<?php if ( wc_get_loop_prop( 'is_paginated' ) || woocommerce_products_will_display() ) { ?>
		<div class="count-order-wrap">
			<div class="d-flex">
			<div class="ordering">
				<?php woocommerce_catalog_ordering(); ?>
			</div>
			<div class="result-count">
				<?php 
				$args = array(
					'total'    => wc_get_loop_prop( 'total' ),
					'per_page' => wc_get_loop_prop( 'per_page' ),
					'current'  => wc_get_loop_prop( 'current_page' ),
				);
				$total    = wc_get_loop_prop( 'total' );
				$per_page = wc_get_loop_prop( 'per_page' );
				$current  = wc_get_loop_prop( 'current_page' );
				echo '<p class="ef5-result-count">';
					if ( $total <= $per_page || - 1 === $per_page ) {  
						printf( _n( '(%d Product)', '(%d Products)', $total, 'theclick' ), $total );
					} else {
						printf( _n( '(<span>%d</span> Products)', '(<span>%d</span> Products)', $total, 'theclick' ), $total );
					}
				echo '</p>';
				?>
			</div>
			</div>
		</div>
		<?php } ?>
		<div class="filter-icon"><a href="javascript:void(0);" class="woo-filter-toggle"><?php echo esc_html__('Filter by','theclick') ?><span><?php echo theclick_get_svg('outline-tune') ?></span></a></div>
	</div>
<?php
}


/**
 * Add an action to call all TheClick function
 * before shop loop
 *
*/
if(!function_exists('theclick_woocommerce_before_shop_loop')){
	add_action('woocommerce_before_shop_loop', 'theclick_woocommerce_before_shop_loop', 12);
	function theclick_woocommerce_before_shop_loop(){
		do_action('theclick_woocommerce_before_shop_loop');
	}
}


/**
 * Change number of column that are displayed per page (shop page)
 * Return column number
*/
add_filter( 'loop_shop_columns', 'theclick_loop_shop_columns', 20 );
function theclick_loop_shop_columns() {
  $columns = theclick_get_opts('products_columns', 4);  
  return $columns;
}

/**
 * Change number of products that are displayed per page (shop page)
 * $limit contains the current number of products per page based on the value stored on Options -> Reading
 * Return the number of products you wanna show per page.
 * 
 */
add_filter( 'loop_shop_per_page', 'theclick_loop_shop_per_page', 20 );
function theclick_loop_shop_per_page( $limit ) {
  $limit = theclick_get_opts('products_per_page', 12);
  return $limit;
}

/**
 * Paginate
*/
add_filter('woocommerce_pagination_args','theclick_woocommerce_pagination_args');
function theclick_woocommerce_pagination_args($args){
	$custom = [
		'type'      => 'plain',
        'prev_text' => '<span class="prev"><span>'.apply_filters('theclick_loop_pagination_prev_text', esc_html__('Previous', 'theclick')).'</span></span>',
        'next_text' => '<span class="next"><span>'.apply_filters('theclick_loop_pagination_next_text', esc_html__('Next', 'theclick')).'</span></span>'
    ];
	$args = array_merge($args, $custom);
	return $args;
}
if ( ! function_exists( 'woocommerce_pagination' ) ) {
	/**
	 * Output the pagination.
	 */
	function woocommerce_pagination() {
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}

		$args = array(
			'total'   => wc_get_loop_prop( 'total_pages' ),
			'current' => wc_get_loop_prop( 'current_page' ),
			'base'    => esc_url_raw( add_query_arg( 'product-page', '%#%', false ) ),
			'format'  => '?product-page=%#%',
		);

		if ( ! wc_get_loop_prop( 'is_shortcode' ) ) {
			$args['format'] = '';
			$args['base']   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
		}
		$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
		$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
		$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
		$format  = isset( $format ) ? $format : '';

		if ( $total <= 1 ) {
			return;
		}
	?>
	<div class="ef5-loop-pagination">
		<div class="nav-links">
			<?php
				echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
					'base'         => $base,
					'format'       => $format,
					'add_args'     => false,
					'current'      => max( 1, $current ),
					'total'        => $total,
					'prev_text'    => '&larr;',
					'next_text'    => '&rarr;',
					'type'         => 'list',
					'end_size'     => 3,
					'mid_size'     => 3,
				) ) );
			?>
		</div>
	</div>
	<?php
	}
}