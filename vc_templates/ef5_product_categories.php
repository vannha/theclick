<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	$terms = get_terms(['slug' => $taxonomies_arr, 'taxonomy' => 'product_cat']);
	
	foreach ($terms as $cat) {
		var_dump($cat);
		
    }  
}
?>