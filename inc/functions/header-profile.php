<?php
/**
 * Header SignIn / SignUp Button
 * @since 1.0.0
*/
if(!function_exists('theclick_header_signin_signup')){
	function theclick_header_signin_signup($args = []){
		if(!class_exists('FlexUser')) return;
		$login_register = theclick_get_opts('login_register','0');
		if($login_register == '0') return;
		$login_regis_type     = theclick_get_opts('login_regis_type', 'both');
		$login_regis_num_link = theclick_get_opts('login_regis_num_link', '2');
		$login_regis_active   = theclick_get_opts('login_regis_active', 'login');  
		$login_description    = theclick_get_opts('login_description','');
		$register_description = theclick_get_opts('register_description', '');
		$authid = rand(4,9999);
		echo do_shortcode( '[fu_auth el_id="'.$authid. '" type="both" num_link="1" active="login" login_description="desc1" register_description="desc2"]' );
	}
}