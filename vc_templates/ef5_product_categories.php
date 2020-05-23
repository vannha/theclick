<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	foreach ($taxonomies_arr as $tax) {
		$cat = get_term_by('slug', $tax, 'product_cat');
		
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
 
	    $image = wp_get_attachment_url( $thumbnail_id ); 
	    var_dump($image);
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