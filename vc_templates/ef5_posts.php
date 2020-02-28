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
    <?php $this->title($atts);?>
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
        <div class="row ef5-blog-wrap">
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
                        <?php theclick_vc_post_layout2($atts);?>
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
        <div class="row ef5-blog-wrap">
            <?php
            $d = 0;
            while ($posts->have_posts()) {
                $d++;
                $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php theclick_vc_post_layout3($atts);?>
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
$this->view_all($atts);
?>
</div>
