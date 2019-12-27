<?php
// silent is the golden
add_filter('ef5systems_vc_column_width','testfix');
function testfix(){
	return [
		esc_html__( '43%', 'theclick' ) => '29/509',
		esc_html__( '57%', 'theclick' ) => '70/491'
	];
}