<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_heading
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$wrapper_class = array('ef5-user-block', $el_class);
?>
<div class="<?php echo trim(implode(' ',$wrapper_class)); ?>"> 
	<?php
	$userinstant = [];
	$config = wp_parse_args($userinstant, array(
            'title'                => 'Login Register',
            'title_login'          => 'Login',
            'title_register'       => 'Register',
        ));

        if (is_user_logged_in()) {
        	echo 'abbbb';
            echo fsUser()->get_template_file__('logout', array('atts' => $config), '', 'flex-login');

            //return;
        }
        wp_enqueue_style('fs-user-form.css', fsUser()->plugin_url . 'assets/css/fs-user-form.css', array(), '', 'all');
        wp_enqueue_script('jquery.validate.js', fsUser()->plugin_url . 'assets/vendor/jquery.validate.js', array(), '', true);
        wp_enqueue_script('fs-login.js', fsUser()->plugin_url . 'assets/js/fs-login.js', array(), '', true);
        wp_localize_script('fs-login.js', 'fs_login', array(
            'action' => 'fs_login',
            'url'    => admin_url('admin-ajax.php'),
        ));
        wp_enqueue_script('fs-register.js', fsUser()->plugin_url . 'assets/js/fs-register.js', array(), '', true);
        wp_localize_script('fs-register.js', 'fs_register', array(
            'action' => 'fs_register',
            'url'    => admin_url('admin-ajax.php'),
        ));
        echo fsUser()->get_template_file__('auth_form', array('atts' => $config), '', 'flex-login');
    ?>
</div>