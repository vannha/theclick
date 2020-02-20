<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');

    /* get value for Design Tab */
    $css_classes = array(
        'ef5-product-carousel',
        'ef5-product-carousel-'.$layout_template,
        'ef5-owl',
        'owl-carousel',
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    if(!empty($category_slug)) $category_slug = explode(',',$category_slug);
 
    $loop = theclick_woocommerce_query($type,$number,$product_ids,$taxonomies, $taxonomies_exclude,$category_slug); 
    $count = $loop->post_count;

    $grid_item_css_class = ['ef5-post-item', 'ef5-post-item-layout-'.$layout_template, 'ef5-carousel-item'];
    
    $item_css_class = ['ef5-post-item-inner','transition'];

     
    $d = 0;
    
?>  
<div class="ef5-posts <?php echo ef5systems_owl_css_class($atts);?>">
    <?php 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
    ?>
    <div class="ef5-owl-wrap-inner relative">
        <div id="<?php echo esc_attr($el_id);?>" class="<?php echo esc_attr(trim($css_class));?>">
        <?php 
            while($loop->have_posts()){
            	$loop->the_post(); 
            	global $product;
                $d++;
                $price_html = $product->get_price_html(); 
            ?>
            <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
            <?php
            switch ($layout_template) {
                case '1':
                ?>
                <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                 	 
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                    <div class="ef5-owl-item-title">
                    	<div class="ef5-heading ef5-owl-product-title"><a href="<?php the_permalink()?>"><?php the_title()?></a></div>
                    	<div class="ef5-owl-products-price ef5-heading"><?php printf('%1$s', $product->get_price_html());?></div> 
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
            ef5systems_owl_nav_container($atts);
            ef5systems_owl_dots_in_nav_container($atts);
        ?>
    </div>  
    <?php //echo theclick_html($this->view_all($atts)); ?>
</div>
