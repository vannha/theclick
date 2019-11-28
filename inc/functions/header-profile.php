<?php
/**
 * Header SignIn / SignUp Button
 * @since 1.0.0
*/
if(!function_exists('theclick_header_signin_signup')){
	function theclick_header_signin_signup($args = []){
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => '',
			'class'  => ''
		]);
		if(!class_exists('FlexUser')) return;
		$login_register = theclick_get_opts('login_register','0');
		if($login_register == '0') return;
		$login_regis_type     = theclick_get_opts('login_regis_type', 'both');
		$login_regis_num_link = theclick_get_opts('login_regis_num_link', '2');
		$login_regis_active   = theclick_get_opts('login_regis_active', 'login');  
		$login_description    = theclick_get_opts('login_description','');
		$register_description = theclick_get_opts('register_description', '');
		$authid = rand(4,9999);
		echo wp_kses_post($args['before']);
		echo do_shortcode( '[fu_auth el_id="'.$authid. '" type="'.$login_regis_type.'" num_link="'.$login_regis_num_link.'" active="'.$login_regis_active.'" login_description="'.$login_description.'" register_description="'.$register_description.'" el_class="'.$args['class'].'"]' );
		echo wp_kses_post($args['after']);
	}
}