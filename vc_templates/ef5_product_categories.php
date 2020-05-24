<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img_sizes = !empty($image_size) ? $image_size : 'medium';
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	echo '<div class="ef5-categorys-wrap">';
	echo '<div class="row product-cats-row gutter-xl-50">';
	$i=0;
	foreach ($taxonomies_arr as $tax) {
		$i++;
		$item_cls = 'col-4';
		$img_size = $img_sizes;
		if( $i == 1 ){
			$item_cls = 'col-10 offset-lg-1';
			$img_size = '1000x600';
		}
		if( $i == 2 || $i == 3 ){
			$item_cls = 'col-6';
			$img_size = '1000x500';
		}
		echo '<div class="'.$item_cls.'">';
			$cat = get_term_by('slug', $tax, 'product_cat');
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
			$bg_attr = 'style="background-image: url('.theclick_get_image_url_by_size(['id'=>$thumbnail_id,'size'=> 'full', 'default_thumb' => true]).'); background-size: cover;"';
			if(!empty($thumbnail_id)){
			echo '<div class="pcats-wrap" '.$bg_attr.'>'; 
		    
	    	 	theclick_image_by_size([
		            'id'    => $thumbnail_id,
		            'size'  => $img_size,
		            'class' => 'cat-img invisible'
		        ]);
		    echo '</div>';
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
