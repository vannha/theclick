<?php 
    $atts = vc_map_get_attributes($this->getShortcode(), $atts);
    extract($atts);

    $el_id = !empty($el_id) ? 'ef5-portfolio-grid' . $el_id : uniqid('ef5-portfolio-grid');

    $select_terms = array();
    if ( ! empty( $atts['taxonomies'] ) ) {
        $terms = get_terms( array(
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => false,
        ) );

        $elected_taxs = explode(',', str_replace(' ','',$atts['taxonomies'])); 
        foreach ( $terms as $t ) {  
            if(in_array($t->slug,$elected_taxs)){
                $select_terms[] = $t; 
            }
        }
    } 

    $tax_query = theclick_tax_query('ef5_portfolio', $taxonomies, $taxonomies_exclude);
    global $paged, $wp_query;
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    $posts_args = array(
        'post_type' => 'ef5_portfolio',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
        'tax_query' => $tax_query,
        'paged' => $paged,
    );

    $wp_query = new WP_Query($posts_args);
 
    $ifp = is_front_page();

    $grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation($css_animation), 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];

    $item_css_class = ['portfolio-grid-item', 'ef5-portfolio-item-layout-' . $layout_template, 'transition'];

?>
<div class="ef5-posts ef5-portfolio-grid <?php echo esc_attr($el_class); ?>" id="<?php echo esc_attr($el_id); ?>">
    <div class="<?php $this->theclick_portfolios_wrap_css_class($atts);?>">
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
        <div class="row ef5-portfolio-grid-wrap">
            <?php
            switch ($layout_template) {
                case '1':
                $d = 0;
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    $d++;
                    ?>
                    <div class="<?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                        <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                             
                            <?php theclick_post_media(['thumbnail_size' => 'medium']); ?>
                            <div class="ef5-port-content">
                                <?php
                                the_title();
                                ?>
                            </div>
                             
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