<?php 
    $atts = vc_map_get_attributes($this->getShortcode(), $atts);
    extract($atts);

    $el_id = !empty($el_id) ? 'ef5-product-grid' . $el_id : uniqid('ef5-product-grid');
    $product_ids = '';

    $filter_request = ( !empty($_GET['filter_type']) && $_GET['filter_type'] !='all' ) ? $_GET['filter_type'] : '';

    $taxs = (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) ? $_GET['product_cat'] : $taxonomies;

    $loop = theclick_woocommerce_query($filter_request,$post_per_page,$product_ids,$taxs,$taxonomies_exclude);

    $grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation($css_animation), 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];

    $item_css_class = ['product-grid-item', 'ef5-product-item-layout-' . $layout_template, 'transition'];

    $filter_type=(array) vc_param_group_parse_atts($filter_type );
    
    $default_title = array(
		'all'              => esc_html__( 'All Products', 'theclick' ),    
		'best_selling'     => esc_html__( 'Best Sellers', 'theclick' ),    
		'recent_product'   => esc_html__( 'New Products', 'theclick' ),    
		'on_sale'          => esc_html__( 'Sale Products', 'theclick' ),   
		'featured_product' => esc_html__( 'Featured Products', 'theclick'), 
		'top_rate'         => esc_html__( 'Top Rate', 'theclick' ),        
		'recent_review'    => esc_html__( 'New Review', 'theclick' ),      
		'deals'            => esc_html__( 'Product Deals', 'theclick' )   
    );

?>

<div class="ef5-posts ef5-product-grid grid-filter <?php $this->theclick_products_wrap_css_class($atts);?>" id="<?php echo esc_attr($el_id); ?>">
	<?php if(!empty($filter_type)): ?>
		<div class="filter-type d-flex justify-content-between align-items-center gutter-30">
			<div class="filter-left">
            <?php 
            foreach($filter_type as $ft): 
                if( !empty($ft['filter_type_item']) ){
                	if( $filter_request == $ft['filter_type_item'] )
                		$active_cls = 'active';
                	elseif(empty($filter_request) && $ft['filter_type_item'] == 'all')
                		$active_cls = 'active';
                	else
                		$active_cls = '';

                	$title = !empty($ft['filter_title_item']) ? $ft['filter_title_item'] : $default_title[$ft['filter_type_item']];
                	$link  = add_query_arg( 'filter_type',$ft['filter_type_item'], get_page_link(false) );
                    echo '<span><a href="'.esc_url($link).'" class="filter-link '.$active_cls.'">'.$title.'</a></span>';
                }
            endforeach; 
            ?>
        	</div>
        	<div class="filter-right">
        		<a href="javascript:void(0);" class="filter-tune"><?php echo esc_html__('Filter by','theclick') ?><span><?php echo theclick_get_svg('outline-tune') ?></span></a>
        	</div>
		</div>
	<?php endif; ?>
	<div class="filter-by-sidebar">
		<div class="overlay-wrap"></div>
		<div class="panel-wrap">
			<div class="panel-header">
				<div class="d-flex justify-content-between align-items-center">
					<h3><?php echo esc_html__( 'Filter By', 'theclick' ) ?></h3>
					<span class="button-close-x"><?php echo theclick_get_svg('close') ?></span>
				</div>
			</div>
			<div class="panel-content">
			 	<?php theclick_product_filter_sidebar($atts); ?>
			</div>
		</div>
	</div>
    <div class="ef5-product-grid-content">
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
        <?php 
        $pagin_type = 'infinite';
        if($pagin_type == 'infinite'){
            echo '<div class="woocommerce-infinite d-flex justify-content-center text-center infinite-btn load-on-infinite">';
                next_posts_link( $loadmore_text ); 
            echo '</div>';     
        }  ?>
    </div>
<?php 
 
wp_reset_query();
?>
</div>