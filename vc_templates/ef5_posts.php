<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$el_id = !empty($el_id) ? 'ef5-posts-' . $el_id : uniqid('ef5-posts-');

/* Post query */
$tax_query = theclick_tax_query($post_type, $taxonomies, $taxonomies_exclude);
if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}
$posts_args = array(
	'post_type' => $post_type,
	'posts_per_page' => $posts_per_page,
	'post_status' => 'publish',
	'tax_query' => $tax_query,
	'paged' => $paged,
);
global $wp_query;
$posts = $wp_query = new WP_Query($posts_args);
// Grid columns css class
$grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation($css_animation), 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];
// Items CSS Classes
$item_css_class = ['post-grid-item', 'ef5-post-item-layout-' . $layout_template, 'transition'];
?>

<div class="ef5-posts" id="<?php echo esc_attr($el_id); ?>">
    <div class="<?php $this->theclick_posts_wrap_css_class($atts);?>">
    <?php
    switch ($layout_template) {
    case '1':
    	$post_count = $post_count2 = 0;
    	while ($posts->have_posts()) {
    		$post_count++;
    		$posts->the_post();
    		if ($post_count === 1) {
    			$this->theclick_posts_featured_item($atts);
    		}
    	}
    	wp_reset_postdata();
    	?>
        <div class="ef5-blog-wrap">
            <?php
            while ($posts->have_posts()) {
        		$post_count2++;
        		$posts->the_post();
        		if ($post_count2 != 1) {
        			$this->theclick_posts_item($atts, ['class' => '']);
        		}
        	}
        	wp_reset_postdata();
        	?>
        </div>
    <?php
    break;
    case '2':
        $post_count = $post_count2 = 0;
        while ($posts->have_posts()) {
            $post_count++;
            $posts->the_post();
            if ($post_count === 1) {
                $this->theclick_posts_featured_item_two($atts);
            }
        }
        wp_reset_postdata();
        ?>
        <div class="row ef5-blog-wrap <?php echo esc_attr($column_xl_gutter)?>">
            <?php
        	$d = 0;
        	while ($posts->have_posts()) {
        		$d++;
                $post_count2++;
        		$posts->the_post();
                if ($post_count2 != 1) {
        		?>
                <div class="<?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                	<div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php 
                        theclick_post_media(['thumbnail_size' => $atts['thumbnail_size']]);
                        theclick_post_meta_category(['class' => 'meta-category']);
                        the_title( '<div class="ef5-heading text-20"><a href="' . esc_url( get_permalink() ) . '">','</a></div>' );
                        theclick_post_excerpt(['show_excerpt' => '1', 'length' => '30' ]);
                        theclick_post_meta(['class' => '','show_author' => '1','show_date' => '1','show_cmt' => '1']);
                        ?>
                    </div>
                </div>
                <?php
                }
            } // end while
    	    wp_reset_postdata();
        ?>
        </div>
   <?php
	break;
    case '3':
        ?>
        <div class="title-read-more d-flex justify-content-between align-items-center gutter-30">
            <?php if(!empty($el_title)): ?>
                <div class="title text-40 text-xl-50 lh-1/28"><?php echo theclick_html($el_title)?></div>
            <?php endif; ?>
            <?php if($show_view_all !== 'none'): ?>
            <div class="read-more">
                <a href="<?php echo get_permalink($show_view_all_page);?>" class="link-read-more"><?php echo esc_html($show_view_all_text);?></a>
            </div> 
            <?php endif; ?>
        </div>
        <div class="row ef5-blog-wrap <?php echo esc_attr($column_xl_gutter)?>">
            <?php
            $d = 0;
            while ($posts->have_posts()) {
                $d++;
                $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php 
                        theclick_post_media(['thumbnail_size' => $atts['thumbnail_size']]);
                        the_title( '<div class="ef5-heading"><a href="' . esc_url( get_permalink() ) . '">','</a></div>' );
                        theclick_post_excerpt(['show_excerpt' => '1', 'length' => '30' ]);
                        printf('<div class="ef5-readmore"><a href="%1$s" title="%2$s" class="ef5-btn primary outline2">%3$s</a></div>',
                            esc_url( get_the_permalink() ),
                            esc_attr( get_the_title() ),
                            esc_html__('Continue Reading','theclick')
                        );
                        ?>
                    </div>
                </div>
                <?php
            } // end while
            wp_reset_postdata();
        ?>
        </div>
    <?php
    break;
    case '4':
        ?>
        <div class="title-read-more d-flex justify-content-between align-items-center gutter-30">
            <?php if(!empty($el_title)): ?>
                <div class="title text-40 text-xl-50 lh-1/28"><?php echo theclick_html($el_title)?></div>
            <?php endif; ?>
            <?php if($show_view_all !== 'none'): ?>
            <div class="read-more">
                <a href="<?php echo get_permalink($show_view_all_page);?>" class="link-read-more"><?php echo esc_html($show_view_all_text);?></a>
            </div> 
            <?php endif; ?>
        </div>
        <div class="row ef5-blog-wrap <?php echo esc_attr($column_xl_gutter)?>">
            <?php
            $d = 0;
            while ($posts->have_posts()) {
                $d++;
                $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php 
                        theclick_post_media(['thumbnail_size' => $atts['thumbnail_size']]);
                        the_title( '<div class="ef5-heading"><a href="' . esc_url( get_permalink() ) . '">','</a></div>' );
                        theclick_post_excerpt(['show_excerpt' => '1', 'length' => '30' ]);
                        printf('<div class="ef5-readmore"><a href="%1$s" title="%2$s" class="ef5-btn primary outline2">%3$s</a></div>',
                            esc_url( get_the_permalink() ),
                            esc_attr( get_the_title() ),
                            esc_html__('Continue Reading','theclick')
                        );
                        ?>
                    </div>
                </div>
                <?php
            } // end while
            wp_reset_postdata();
        ?>
        </div>
    <?php
    break;
    }
    ?>
    </div>
<?php
theclick_loop_pagination(['show_pagination' => $show_pagination, 'style' => '3']);
if($layout_template !== '3')
$this->view_all($atts);
?>
</div>
