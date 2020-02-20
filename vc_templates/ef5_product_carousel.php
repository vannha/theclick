<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');
    /* get value for Design Tab */
    $css_classes = array(
        'ef5-posts-carousel',
        'ef5-posts-carousel-'.$layout_template,
        'ef5-owl',
        'owl-carousel',
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

  
    if(!empty($category_slug)) $category_slug = explode(',',$category_slug);

    global $wp_query; 
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 8,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $wp_query = new WP_Query($args);
    $wp_query = theclick_woocommerce_query($type,$number,$product_ids,$taxonomies, $taxonomies_exclude,$category_slug); 
    $count = $wp_query->post_count;
    var_dump($count);
    $grid_item_css_class = ['ef5-post-item', 'ef5-post-item-layout-'.$layout_template, 'ef5-carousel-item'];
    
    $item_css_class = ['ef5-post-item-inner','transition'];

    
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

