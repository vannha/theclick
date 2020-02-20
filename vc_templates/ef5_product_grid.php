<?php 

    $atts = vc_map_get_attributes($this->getShortcode(), $atts);
    extract($atts);

    $el_id = !empty($el_id) ? 'ef5-product-grid' . $el_id : uniqid('ef5-product-grid');

    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }

    $tax_query = array();
    $select_terms = array();
    if ( ! empty( $atts['taxonomies'] ) ) {
        $terms = get_terms( array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ) );

        $elected_taxs = explode(',', str_replace(' ','',$atts['taxonomies'])); 
        foreach ( $terms as $t ) {  
            if(in_array($t->slug,$elected_taxs)){
                $select_terms[] = $t; 
            }
        }
        $tax_query = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $elected_taxs,
            ),
        );
    } 

    $products_args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => $tax_query,
        'paged' => $paged,
    );

    $ifp = is_front_page();
    global $wp_query;

    $wp_query = new WP_Query($products_args);

    $grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation($css_animation), 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];

    $item_css_class = ['product-grid-item', 'ef5-product-item-layout-' . $layout_template, 'transition'];

?>
