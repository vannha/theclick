<?php  
	$atts = vc_map_get_attributes($this->getShortcode(), $atts);
	extract($atts);
	if(empty($post_id)) return;
 
	$terms = get_the_term_list( $post_id , 'category', '', ' ', '' );
 	
	$post   = get_post( $post_id );
?>
<div class="ef5-post <?php echo esc_attr($el_class);?>">
    <?php 
    $id = get_post_thumbnail_id($post_id);
    if( $id ){
    	theclick_image_by_size(['id' => $id,'size' => $thumbnail_size, 'class' => '']);
    }
     
    ?>
    <div class="ef5-post-info">
    	<div class="ef5-post-cat"><?php echo theclick_html($terms); ?></div>
    	<div class="ef5-post-title ef5-heading"><?php echo theclick_html($post->post_title); ?></div>
    	<?php
        $content      = $post->post_content;
        $excerpt_more = apply_filters('theclick_excerpt_more', '&hellip;');
        $excerpt      = wp_trim_words($content, '30', $excerpt_more);
        ?>
        <div class="ef5-post-excerpt"><?php echo theclick_html($excerpt); ?></div>
        <a class="btn-link" href="<?php echo get_post_permalink( $post_id, false, false )?>"><?php echo esc_html__('Continue Reading','theclick') ?></a>
    </div>
</div>