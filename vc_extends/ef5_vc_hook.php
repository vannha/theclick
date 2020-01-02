<?php
// silent is the golden
add_filter('ef5systems_vc_column_width','theclick_update_vc_grid_column_width');
add_filter('ef5systems_vc_column_width_offset','theclick_update_vc_grid_column_width');
function theclick_update_vc_grid_column_width(){
	return [
		esc_html__( '70.491%', 'theclick' ) => '70/491',
		esc_html__( '29.509%', 'theclick' ) => '29/509'
	];
}

add_filter('ef5systems_include_vc_post_type_list','theclick_vc_include_post_type_list');
function theclick_vc_include_post_type_list(){
	return [
		esc_html__( 'Custom', 'theclick' ) => 'custom'
	];
}