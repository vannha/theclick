<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	foreach ($taxonomies_arr as $tax) {
		$term = get_term_by('slug', $tax, 'product_cat');
		var_dump($cat);
	}
	//$terms = get_terms(['slug' => $taxonomies_arr, 'taxonomy' => 'product_cat']);
	
	/*foreach ($terms as $cat) {
		var_dump($cat);
		term_id.
		name
		slug
		description
    } */ 
}
?>