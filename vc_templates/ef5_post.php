<?php  
	$atts = vc_map_get_attributes($this->getShortcode(), $atts);
	extract($atts);
	if(empty($post_id)) return;
 
	$terms = get_the_term_list( $post_id , 'category', '', ' ', '' );
 	
	$post   = get_post( $post_id );
?>
<div class="ef5-post <?php echo esc_attr($el_class);?>">
    <?php 
    if(has_post_thumbnail() ){
    	theclick_image_by_size(['id' => $post_id,'size' => $thumbnail_size, 'class' => $args['img_class']]);
    }
     
    ?>
    <div class="ef5-post-info">
    	<div class="ef5-post-cat"><?php echo theclick_html($terms); ?></div>
    	<div class="ef5-post-title"><?php echo theclick_html($post->post_title); ?></div>
    	<?php
        $content      = $post->post_content;
        $excerpt_more = apply_filters('theclick_excerpt_more', '&hellip;');
        $excerpt      = wp_trim_words($content, '30', $excerpt_more);
        ?>
        <div class="ef5-post-excerpt"><?php echo theclick_html($excerpt); ?></div>
        <a href="<?php echo get_post_permalink( $post_id, false, false )?>"><?php echo esc_html__('Continue Reading') ?></a>
    </div>
</div>