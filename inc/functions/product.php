<?php
function theclick_woocommerce_query($type='recent_product',$post_per_page=-1,$product_ids='',$taxonomies='', $taxonomies_exclude='', $product_cat=''){
    global $wp_query;
	$args = theclick_woocommerce_query_args($type,$post_per_page,$product_ids,$taxonomies, $taxonomies_exclude, $product_cat);

    if (get_query_var('paged')){ 
    	$paged = get_query_var('paged'); 
    }
    elseif(get_query_var('page')){ 
    	$paged = get_query_var('page'); 
    }
    else{ 
    	$paged = 1; 
    }
    if($paged > 1){
    	$args['paged'] = $paged;
    }


    $wp_query = new WP_Query($args);
	return $wp_query;
}
 
function theclick_woocommerce_query_args($type='recent_product',$post_per_page=-1,$product_ids='',$taxonomies='', $taxonomies_exclude='', $product_cat=''){
	global $woocommerce;
     
	//$product_visibility_term_ids = wc_get_product_visibility_term_ids();
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
		'date_query' => array(
			array(
			   'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
			)
	    ),
	    
	    'post_parent' => 0
    );
    
    return $args;
}