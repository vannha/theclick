<?php
    
    global $wp_query; 
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 8,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $wp_query = new WP_Query($args);
    //$wp_query = theclick_woocommerce_query($type,$number,$product_ids,$taxonomies, $taxonomies_exclude,$category_slug); 
    //$count = $wp_query->post_count;
    //var_dump($count);
    //$grid_item_css_class = ['ef5-post-item', 'ef5-post-item-layout-'.$layout_template, 'ef5-carousel-item'];
    
    $item_css_class = ['ef5-post-item-inner','transition'];

    echo 'aaaaaaaaaaa';
    
    /*while($posts->have_posts()){
      
	    switch ($layout_template) {
	        case '1':
	        echo 'bbbbbb';
	        break;
	        default:
	        echo 'aaaaaaaa';
	        break;
	    }
    
    }  
    wp_reset_postdata();*/
?>  

