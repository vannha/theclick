<?php 
    $atts = vc_map_get_attributes($this->getShortcode(), $atts);
    extract($atts);

    $el_id = !empty($el_id) ? 'ef5-product-grid' . $el_id : uniqid('ef5-product-grid');
    $product_ids = '';
    $loop = theclick_woocommerce_query('all',$post_per_page,$product_ids,$taxonomies,$taxonomies_exclude);

    $grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation($css_animation), 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];

    $item_css_class = ['product-grid-item', 'ef5-product-item-layout-' . $layout_template, 'transition'];
?>

<div class="ef5-posts ef5-product-grid <?php echo esc_attr($el_class); ?>" id="<?php echo esc_attr($el_id); ?>">
    <div class="<?php $this->theclick_products_wrap_css_class($atts);?>">
        <div class="row ef5-product-grid-wrap <?php echo esc_attr($column_xl_gutter)?>">
            <?php
            switch ($layout_template) {
                case '1':
                $d = 0;
                while ($loop->have_posts()) {
                    $loop->the_post();
                    global $product;
                    $d++;
                    ?>
                    <div class="<?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                        <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php
                            do_action( 'woocommerce_before_shop_loop_item' );
                            do_action( 'woocommerce_before_shop_loop_item_title' );
                            do_action( 'woocommerce_shop_loop_item_title' );
                            do_action( 'woocommerce_after_shop_loop_item_title' );
                            do_action( 'woocommerce_after_shop_loop_item' );
                        ?>
                        </div>
                    </div>
                <?php 
                }  
                break;
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php 
$pagin_type = 'infinite';
if($pagin_type == 'infinite'){
    $args = array(
        'total'   => wc_get_loop_prop( 'total_pages' ),
        'current' => wc_get_loop_prop( 'current_page' ),
        'base'    => esc_url_raw( add_query_arg( 'product-page', '%#%', false ) ),
        'format'  => '?product-page=%#%',
    );
    var_dump($args);
    if ( ! wc_get_loop_prop( 'is_shortcode' ) ) {
        $args['format'] = '';
        $args['base']   = esc_url_raw( str_replace( 999999999, $args['base'], remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
    }

    $loadmore_url = esc_url_raw( str_replace( 999999999, $args['current']+1, remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
    if($args['total'] >= $args['current']+1){
        echo '<div class="woocommerce-infinite text-center">';
        echo '<a href="'. esc_url( $loadmore_url).'" class="infinite-btn load-on-infinite">'.esc_html('loadmore_text').'</a>';
        echo '</div>';
    }
}
?>
</div>