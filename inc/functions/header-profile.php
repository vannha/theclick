<?php
/**
 * Header SignIn / SignUp Button
 * @since 1.0.0
*/
if(!function_exists('theclick_header_signin_signup')){
	function theclick_header_signin_signup($args = []){
		if(!class_exists('FlexUser')) return;
		
		$authid = rand(4,9999);
		echo do_shortcode( '[fu_auth el_id="'.$authid.'"]' );
	}
}