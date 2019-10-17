<?php
/**
 * Header SignIn / SignUp Button
 * @since 1.0.0
*/
if(!function_exists('theclick_header_signin_signup')){
	function theclick_header_signin_signup($args = []){
		if(!function_exists('cshlg_add_login_form')) return;
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => ''
		]);

		$header_signin = theclick_get_opts('header_signin', '0');
		$header_signup = theclick_get_opts('header_signup', '0');
		$header_signup_label = theclick_get_opts('header_signup_label', esc_html__('Sign Up','theclick'));
		$header_signin_label = theclick_get_opts('header_signin_label', esc_html__('Sign In','theclick'));
		if('0' === $header_signin && '0' === $header_signup) return;

		echo wp_kses_post($args['before']); 
		if ( is_user_logged_in() ) { 
		?>
			<a href="<?php echo esc_url(get_edit_user_link()); ?>" class="header-extra-icon btn-nav"><?php echo esc_html__('Profile', 'theclick'); ?></a>
	        <a href="<?php echo esc_url(wp_logout_url()); ?>" class="header-extra-icon btn-nav active"><?php echo esc_html__('Logout', 'theclick'); ?></a>
	    <?php 
		} else { 
	    	if($header_signin === '1') { ?>
	    		<a href="#csh-modal-login" class="go_to_login_link header-extra-icon btn-nav"><?php echo esc_html($header_signin_label); ?></a>
		    <?php 
			} 
			if ($header_signup === '1') { ?>
		    	<a href="#csh-modal-register" class="menu_register_link header-extra-icon btn-nav active"><?php echo esc_html($header_signup_label); ?></a>
		    <?php 
			} 
		}
		echo wp_kses_post($args['after']);
	}
}