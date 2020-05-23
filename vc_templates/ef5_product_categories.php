<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	
	foreach ($taxonomies_arr as $tax) {
		$cat_obj = get_term(['slug' => $tax, 'taxonomy' => 'product_cat']);
		var_dump($cat_obj);
	}
}
?>