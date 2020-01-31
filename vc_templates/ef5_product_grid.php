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
    var_dump(is_front_page());
    /*if(is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    }else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }*/
    //preg_match('%/page/([0-9]+)%', $_SERVER['REQUEST_URI'], $matches );
    //$paged = isset( $matches[1] ) ? $matches[1] : 1;
    

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
    global $wp_query;
    $products = $wp_query = new WP_Query($products_args);

    $grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation($css_animation), 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];

    $item_css_class = ['product-grid-item', 'ef5-product-item-layout-' . $layout_template, 'transition'];

?>
<div class="ef5-posts ef5-product-grid <?php echo esc_attr($el_class); ?>" id="<?php echo esc_attr($el_id); ?>">
    
<?php
$show_pagination = ($pagination == 'pagin') ? '1' : '0';
var_dump(is_front_page());
if(is_front_page()) 
    echo '<div id="pagination" class="home-pagination">' . theclick_home_pagination($wp_query) . '</div></div>';
else
    theclick_loop_pagination(['show_pagination' => $show_pagination, 'style' => '3']);
$this->view_all($atts);
$this->loadmore($atts);
?>
</div>