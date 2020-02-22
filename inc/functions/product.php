<?php
function theclick_woocommerce_query($type='recent_product',$post_per_page=-1,$product_ids='',$taxonomies=''){
    
	$args = theclick_woocommerce_query_args($type,$post_per_page,$product_ids,$taxonomies, $product_cat);
    if (get_query_var('paged')){ 
        $paged = get_query_var('paged'); 
    }elseif(get_query_var('page')){ 
        $paged = get_query_var('page'); 
    }else{ 
        $paged = 1; 
    }
    if($paged > 1){
        $args['paged'] = $paged;
    }
    $loop = new WP_Query($args);
	return $loop;
}
 
function theclick_woocommerce_query_args($type='recent_product',$post_per_page=-1,$product_ids='',$taxonomies=''){
	$product_visibility_term_ids = wc_get_product_visibility_term_ids();
     
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
		'date_query' => array(
			array(
			   'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
			)
	    ),
	    'tax_query' => array(
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
				'operator' => 'NOT IN',
			)
	    ),
	    'post_parent' => 0
    );
    if(!empty($taxonomies) || !empty($taxonomies_exclude)){
        $tax_query = ef5systems_tax_query('product', $taxonomies, '');
        $args['tax_query']= $tax_query;
    }
    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            $args['meta_query'] = array();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            $args['meta_query'] = array();
            $args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['featured'],
			);
            break;
        case 'top_rate':
            $args['meta_key']='_wc_average_rating';
            $args['orderby']='meta_value_num';
            $args['order']='DESC';
            $args['meta_query'] = array();
            break;
        case 'recent_product':
            $args['meta_query'] = array();
            break;
        case 'on_sale':
            $args['meta_query'] = array();
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'recent_review':
            if($post_per_page == -1) $_limit = 4;
            else $_limit = $post_per_page;
            global $wpdb;
            $query = $wpdb->prepare("SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC LIMIT 0, %d", $_limit);
            $results = $wpdb->get_results($query, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                $_pids[] = $re->comment_post_ID;
            }

            $args['meta_query'] = array();
            $args['post__in'] = $_pids;
            break;
        case 'deals':
            $args['meta_query'] = array();
            $args['meta_query'][] = array(
                                 'key' => '_sale_price_dates_to',
                                 'value' => '0',
                                 'compare' => '>');
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'separate':
            $args['meta_query'] = array();
            if ( ! empty( $product_ids ) ) {
    			$ids = array_map( 'trim', explode( ',', $product_ids ) );
    			if ( 1 === count( $ids ) ) {
    				$args['p'] = $ids[0];
    			} else {
    				$args['post__in'] = $ids;
    			}
    		}
            break;
        /*case 'category':
            if(!empty($taxonomies) || !empty($taxonomies_exclude)){
                $tax_query = ef5systems_tax_query('product', $taxonomies, '');
                $args['tax_query']= $tax_query;
            }
            break;
        case 'category_slug':
            if($product_cat != ''){
                $args['tax_query'] = array(
        			array(
        				'taxonomy' => 'product_cat',
        				'field' => 'slug',
        				'terms' => $product_cat
        			)
        		);
            }
            break;*/
    }
    return $args;
}