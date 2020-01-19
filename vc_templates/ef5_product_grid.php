<?php 
    $taxo = 'product_cat';
    $atts['categories'] = $atts['cat'];
    if(isset($atts['show_read_more']) && $atts['show_read_more']):  
        wp_register_script( 'cms-loadmore-js', get_template_directory_uri().'/assets/js/cms_loadmore.js', array('jquery') ,'1.0',true);
        // What page are we on? And what is the pages limit?
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $limit = $atts['limit'];
        $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
        // Add some parameters for the JS.
        $current_id =  str_replace('-','_',$atts['html_id']);
        wp_localize_script(
            'cms-loadmore-js',
            'cms_more_obj'.$current_id,
            array(
                'startPage' => $paged,
                'maxPages' => $max,
                'total' => $wp_query->found_posts,
                'perpage' => $limit,
                'nextLink' => next_posts($max, false),
                'masonry' => $atts['layout'],
                'loadmore_text' => esc_html__('Load More','theclick')
            )
        );
        wp_enqueue_script( 'cms-loadmore-js' ); 
    endif;
    $layout_mode = !empty($atts['layout_mode']) ? $atts['layout_mode'] : '1';
    $layout_mode_cls = !empty($atts['layout_mode']) ? 'layout-'.$atts['layout_mode'] : '';
?>
<div class="cms-grid-wraper cms-grid-products <?php echo esc_attr($layout_mode_cls);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
        <div class="cms-grid-filter text-center">
            <ul class="cms-filter-category list-unstyled list-inline">
                <li><a class="active" href="#" data-group="all"><?php echo esc_html('All'); ?></a></li>
                <?php 
                if(is_array($atts['categories']))
                foreach($atts['categories'] as $category):?>
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
     
    <div class="row cms-grid products loop-products <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = 'large';
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="cms-grid-item product <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <?php 
                    if($layout_mode == '1'){
                        do_action( 'woocommerce_before_shop_loop_item' );
                        do_action( 'woocommerce_before_shop_loop_item_title' );
                        do_action( 'woocommerce_shop_loop_item_title' );
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                        do_action( 'woocommerce_after_shop_loop_item' );
                    }else{
                        //$thumb_img = get_the_post_thumbnail( get_the_id(), '400x400', array( 'class' => 'thumb-image' ) );
                         
                        $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        $img = wpb_getImageBySize( array(
                            'attach_id' => $post_thumbnail_id,
                            'thumb_size' => '400x400',
                            'class' => 'thumb-image',
                        ));
                        $thumbnail = $img['thumbnail'];
                        //echo wp_kses_post($thumbnail);

                        echo '<a href="' . esc_url( get_permalink() ) . '" class="product-link">';
                        echo wp_kses_post( $thumbnail );
                        echo '</a>';
                    }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    
    <?php
    if(isset($atts['show_read_more']) && $atts['show_read_more'])
        echo '<div class="loadmore text-center"><div class="cms_pagination grid-loadmore"></div></div>';
    ?>
</div>