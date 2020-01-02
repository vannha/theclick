<?php
    $lists = $icon = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');
    /* get value for Design Tab */
    $css_classes = array(
        'ef5-posts-carousel',
        'ef5-posts-'.$layout_template,
        'ef5-owl',
        'owl-carousel',
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    /* Post query */
    $tax_query = ef5systems_tax_query($post_type, $taxonomies, $taxonomies_exclude);
    if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    $postin = !empty($ids) ? explode(',', $ids) : [];
    $posts_args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'post__in'       => $postin,
        'post_status'    => 'publish',
        'tax_query'      => $tax_query,
        'paged'          => $paged,
    );
    global $wp_query;
    $posts = $wp_query = new WP_Query($posts_args);
    // Grid columns css class
    $grid_item_css_class = ['ef5-post-item', 'ef5-post-item-layout-'.$layout_template, 'ef5-carousel-item', $this->getCSSAnimation( $css_animation )];
    // Items CSS Classes
    $item_css_class = ['ef5-post-item-inner','transition'];

    // Thumbnail Size
    $d = 0;
    $thumbnail_size_index = -1;
    $large_item_class = '';
    $thumbnail_size = explode(',', $thumbnail_size);
?>
<div class="ef5-posts <?php echo ef5systems_owl_css_class($atts);?>">
    <?php 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
    ?>
    <div class="ef5-owl-wrap-inner relative">
        <div id="<?php echo esc_attr($el_id);?>" class="<?php echo esc_attr(trim($css_class));?>">
        <?php 
            while($posts->have_posts()){
                $d++;
                // Thumbnail Size
                $thumbnail_size_index++;
                if($thumbnail_size_index >= count($thumbnail_size)){
                    $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                }
                $posts->the_post();
                // Post Metas
                $post_metas   = [];
                $post_metas[] = theclick_posted_on(['show_date'=>'1','echo' => false]);
                $post_metas[] = theclick_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
            ?>
            <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
            <?php
            switch ($layout_template) {
                case '4':
                $large_item_class = ($thumbnail_size_index === 0) ? 'ef5-large-item' : 'ef5-small-item';
                $heading_class = ($thumbnail_size_index === 0) ? 'text-22 pb-8' : 'text-16';
                ?>
                <div class="<?php echo trim(implode(' ', $item_css_class)). ' '.$large_item_class; ?>">
                    <?php 
                        theclick_post_media([
                            'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                            'default_thumb'  => true,
                            'img_class'      => 'w-auto ef5-rounded-10',   
                        ]);
                    ?>
                    <div class="overlay ef5-bg-gradient-1 ef5-post-info ef5-rounded-10">
                        <div class="row h-100">
                            <div class="col-12 align-self-start">
                            <?php 
                                theclick_posted_in([
                                    'show_cat' => '1',
                                    'class'    => '',
                                    'icon'     => '' 
                                ]);
                            ?>
                            </div>
                            <div class="col-12 align-self-end">
                                <?php 
                                    theclick_posted_on([
                                        'class' => 'text-white text-13 font-style-400i pb-10',
                                        'icon'  => '',
                                        'date_format' => 'd M, Y'
                                    ]);
                                    the_title( '<div class="ef5-heading h2 text-white"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></div>' );
                                    if($thumbnail_size_index === 0){
                                        theclick_post_read_more([
                                            'readmore_class' => 'text-14 ef5-text-accent font-style-500',
                                            'icon_right'     => is_rtl() ? 'text-12 flaticon-go-back-left-arrow' : 'flaticon-right-arrow-forward text-12'
                                        ]);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
                case '3':
                ?>
                <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                    <?php 
                        theclick_post_media([
                            'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                            'default_thumb'  => true,
                            'img_class'      => 'w-auto',   
                            'after'          => '<div class="overlay ef5-bg-overlay"><div class="overlay-inner center-align"></div></div>'
                        ]);
                    ?>
                    <div class="overlay ef5-bg-gradient-1 ef5-post-info">
                        <div class="row">
                            <div class="col-12 align-self-start">
                            <?php 
                                theclick_posted_in([
                                    'show_cat' => '1',
                                    'class'    => '' 
                                ]);
                            ?>
                            </div>
                            <div class="col-12 align-self-end">
                                <?php 
                                    theclick_post_title([
                                        'heading_tag' => 'text-20'
                                    ]);
                                    theclick_post_excerpt([
                                        'show_excerpt' => '1', 
                                        'length'       => '16', 
                                        'more'         => ''
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
                case '1':
                ?>	
            	<div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                    <?php 
                        theclick_post_media([
                            'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                            'default_thumb'  => true,
                            'img_class'      => 'w-auto',   
                            'after'          => ''
                        ]);
                    ?>
                    <div class="ef5-post-info">
                        <?php 
                            theclick_post_meta_category(['class' => 'meta-category justify-content-center']);
                            the_title( '<div class="ef5-heading text-20 text-white text-center"><a href="' . esc_url( get_permalink() ) . '">','</a></div>' );
                            theclick_post_meta(['class' => 'justify-content-center','show_author' => '1','show_date' => '1','show_cmt' => '1']);
                        ?>
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
            theclick_loading_animation(); 
            ef5systems_owl_dots_container($atts);
            ef5systems_owl_nav_container($atts);
            ef5systems_owl_dots_in_nav_container($atts);
        ?>
    </div>  
    <?php echo theclick_html($this->view_all($atts)); ?>
</div>
