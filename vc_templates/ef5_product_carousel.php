<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');

    /* get value for Design Tab */
    $css_classes = array(
        'ef5-product-carousel',
        'ef5-product-carousel-'.$layout_template,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    if(!empty($category_slug)) $category_slug = explode(',',$category_slug);
 
    $loop = theclick_woocommerce_query($type,$number,$product_ids,$taxonomies,$category_slug); 
    $count = $loop->post_count;

    $grid_item_css_class = ['ef5-post-item', 'ef5-post-item-layout-'.$layout_template, 'ef5-carousel-item'];
    
    $item_css_class = ['ef5-post-item-inner','transition'];
    
?>  
<div class="ef5-posts <?php echo esc_attr(trim($css_class));?>">
	<div class="title-shop-more d-flex justify-content-between align-items-center gutter-30">
        <div class="title text-xs-40 text-xl-50 lh-1/28"><?php echo theclick_html($title)?></div>
        <?php if($show_shop_more != 'none'): ?>
        <div class="shop-more">
        	<a href="<?php echo get_permalink($shop_more_page);?>" class="link-shop-more"><?php echo esc_html($shop_more_text);?></a>
    	</div> 
    	<?php endif; ?>
    </div>
    <?php 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
    ?>
    <div class="ef5-owl-wrap-inner relative">
        <div id="<?php echo esc_attr($el_id);?>" class="ef5-owl owl-carousel">
        <?php 
            while($loop->have_posts()){
            	$loop->the_post(); 
            	global $product;
                $price_html = $product->get_price_html(); 
            ?>
            <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>">
            <?php
            switch ($layout_template) {
                case '1':
                ?>
                <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                    <div class="ef5-owl-item-title">
                    	<div class="ef5-heading ef5-loop-product-title"><a href="<?php the_permalink()?>"><?php the_title()?></a></div>
                    	<div class="wc-loop-rating-price">
	                    	<div class="ef5-loop-products-price ef5-heading"><?php printf('%1$s', $product->get_price_html());?></div> 
	                    	<?php  
	                    	if ( wc_review_ratings_enabled() && $review_ratings == '') {
	                    		echo wc_get_rating_html( $product->get_average_rating() );
							}
	                    	?>
                    	</div>
                    </div> 
                 	<div class="ef5-owl-product-add-to-cart">
						<?php do_action('theclick_woocommerce_loop_product_add_to_cart'); ?>
					</div>
                </div>
            <?php
                break;
            }
            ?>
            </div>
            <?php
            } // end while
            wp_reset_query();
        ?>
        </div>
        <?php 
            theclick_loading_animation('three-dot-bounce'); 
            ef5systems_owl_dots_container($atts);
        ?>
        <div class="ef5-owl-nav-total d-flex justify-content-between align-items-center">
        	<div class="ef5-owl-navs">
	           <?php ef5systems_owl_nav_container($atts); ?>
	        </div>
            <?php if(isset($show_number_total) && $show_number_total == '1'): ?>
    	        <div class="ef5-owl-total">
    	        	<div class="owl-num-count">
            			<span class="current">1</span> / <span class="total"><?php echo esc_html($count);?></span>	
            		</div>
    	        </div>
            <?php endif; ?>
        </div>
        <?php 
            ef5systems_owl_dots_in_nav_container($atts);
        ?>
    </div>  
</div>
