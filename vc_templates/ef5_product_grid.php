<?php 
    $atts = vc_map_get_attributes($this->getShortcode(), $atts);
    extract($atts);

    $el_id = !empty($el_id) ? 'ef5-product-grid' . $el_id : uniqid('ef5-product-grid');

    /*if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }*/

    //$tax_query = array();
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
        /*$tax_query = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $elected_taxs,
            ),
        );*/
    } 

    /*$products_args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => $tax_query,
        'paged' => $paged,
    );
    */
    //if(!empty($category_slug)) $category_slug = explode(',',$category_slug);
 
    $loop = theclick_woocommerce_query($type,$post_per_page,$product_ids,$taxonomies,$taxonomies_exclude);

    $ifp = is_front_page();

    /*global $wp_query;
    $wp_query = new WP_Query($products_args);*/

    $grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation($css_animation), 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];

    $item_css_class = ['product-grid-item', 'ef5-product-item-layout-' . $layout_template, 'transition'];

?>
<div class="ef5-posts ef5-product-grid <?php echo esc_attr($el_class); ?>" id="<?php echo esc_attr($el_id); ?>">
    <div class="<?php $this->theclick_products_wrap_css_class($atts);?>">
        <?php if( $filter=="true" && count($select_terms) > 0 && $layout=='masonry'):?>
            <div class="ef5-grid-filter">
                <ul class="ef5-filter-category">
                    <li><a class="active" href="#" data-group="all"><?php echo esc_html__('All','theclick'); ?></a></li>
                    <?php 
                    foreach($select_terms as $category):?>
                        <?php $term = get_term( $category, $taxo );?>
                        <?php if(isset($term) && $term):?>
                        <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                                <?php echo esc_html($term->name);?>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>
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
                case '2':
                $d = 0;
                ?>
                <div class="title-wrap <?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <div class="title"><?php echo theclick_html($title)?></div>
                        <div class="desc"><?php echo theclick_html($desc_text)?></div> 
                    </div>
                </div>
                <?php 
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
$show_pagination = ($pagination == 'pagin') ? '1' : '0';
if($ifp)
    theclick_loop_pagination(['show_pagination' => $show_pagination, 'style' => '1']);
else
    theclick_loop_pagination(['show_pagination' => $show_pagination, 'style' => '3']);
$this->view_all($atts);
$this->loadmore($atts);
?>
</div>