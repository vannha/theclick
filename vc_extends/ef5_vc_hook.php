<?php
// silent is the golden
add_filter('ef5systems_vc_column_width','theclick_update_vc_grid_column_width');
function theclick_update_vc_grid_column_width(){
	return [
		esc_html__( '43%', 'theclick' ) => '29/509',
		esc_html__( '57%', 'theclick' ) => '70/491'
	];
}