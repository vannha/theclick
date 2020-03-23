<?php
if ( !class_exists( 'FlexUser' ) ) return;
vc_map(array(
    'name'        => 'TheClick User Block',
    'base'        => 'ef5_user_block',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add user block', 'theclick'),
    'icon'        => 'icon-wpb-ui-icon',
    'params'      => array(
        array(
            'type'       => 'dropdown',
            'param_name' => 'type',
            'heading'    => esc_html__('Type','theclick'),
            'value'      => array(
                esc_html__('Login','theclick')    => 'login',
                esc_html__('Register','theclick') => 'register',
                esc_html__('Both','theclick')     => 'both'
            ),
            'std'        => 'both',
        ),
         
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Element Class','theclick'),
            'param_name' => 'el_class',
            'value'      => '',
            'std'        => ''
        )
    )
));
class WPBakeryShortCode_ef5_user_block extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
    protected function theclick_user_register_render($atts){
        extract($atts);
        $config =  array(
            'title'                => 'Login Register',
            'title_login'          => 'Login',
            'title_register'       => 'Register',
            'type'     => 'both',
            'num_link' => '2',
        );

        if (is_user_logged_in()) {
            echo fsUser()->get_template_file__('logout', array('atts' => $config), '', 'flex-login');
        }else{
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
        }
    }
}