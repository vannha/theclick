<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
 
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	
	foreach ($taxonomies_arr as $tax) {
		$terms_args['slug'] = $tax;
		$terms_args =  [
	        'taxonomy' => 'product_cat'
	    ];
		$cat_obj = get_terms(['slug' => $tax, 'taxonomy' => 'product_cat']);
		var_dump($cat_obj);
	}
}
?>