<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img_size = !empty($image_size) ? $image_size : 'medium';
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	echo '<div class="ef5-categorys-wrap">';
	echo '<div class="row">';
	$i=0;
	foreach ($taxonomies_arr as $tax) {
		$i++;
		$item_cls = 'col-4';
		if($i==1) $item_cls = 'col-12';
		if($i==2 || $i==3) $item_cls = 'col-6';
		echo '<div class="'.$item_cls.'">';
		$cat = get_term_by('slug', $tax, 'product_cat');
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
		
	    $image = wp_get_attachment_url( $thumbnail_id ); 
	    if(!empty($thumbnail_id)){
	    	echo '<img src="'.$image.'"/>';
    	 	/*theclick_image_by_size([
	            'id'    => $thumbnail_id,
	            'size'  => $img_size,
	            'class' => 'cat-img'
	        ]);*/
	    } 
	    echo '</div>';
	}
	echo '</div>';
	echo '</div>';
	 
	/*foreach ($terms as $cat) {
		var_dump($cat);
		term_id.
		name
		slug
		description
    } */ 
}
?>