<?php
add_action( 'tgmpa_register', 'theclick_required_redux_plugins' );
function theclick_required_redux_plugins() {
    $config = array(
        'default_path' => theclick_relative_path().'untheme.net/plugins/',
        'is_automatic' => true
    );
    $plugins = array(
        array(
            'name'               => esc_html__('Redux Framework','theclick'),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),
    );
    tgmpa( $plugins, $config );
}
if(class_exists('ReduxFrameworkPlugin')){
    add_action( 'tgmpa_register', 'theclick_required_theme_plugins' );
    function theclick_required_theme_plugins() {
        $config = array(
            'default_path' => theclick_relative_path().'untheme.net/plugins/',
        );
        $plugins = array(
            array(
                'name'               => esc_html__('EF5 Systems','theclick'),
                'slug'               => 'ef5-systems',
                'source'             => 'ef5-systems.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('EF5 Import & Export','theclick'),
                'slug'               => 'ef5-import-export',
                'source'             => 'ef5-import-export.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('WPBakery Page Builder','theclick'),
                'slug'               => 'js_composer',
                'source'             => 'js_composer.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Slider Revolution','theclick'),
                'slug'               => 'revslider',
                'source'             => 'revslider.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Flex Login','theclick'),
                'slug'               => 'flex-user',
                'source'             => 'flex-user.zip', 
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WooCommerce','theclick'),
                'slug'               => 'woocommerce',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Compare for WooCommerce','theclick'),
                'slug'               => 'woo-smart-compare',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Wishlist for WooCommerce','theclick'),
                'slug'               => 'woo-smart-wishlist',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Quick View for WooCommerce','theclick'),
                'slug'               => 'woo-smart-quick-view',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Contact Form 7','theclick'),
                'slug'               => 'contact-form-7',
                'required'           => false,
            ),
            
            array(
                'name'               => esc_html__('Newsletter','theclick'),
                'slug'               => 'newsletter',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WP User Avatars','theclick'),
                'slug'               => 'wp-user-avatars',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Classic Editor','theclick'),
                'slug'               => 'classic-editor',
                'required'           => false,
            ),
        );
        tgmpa( $plugins, $config );
    }
}
if(class_exists('VC_Manager')){
    add_action( 'tgmpa_register', 'theclick_required_vc_plugins' );
    function theclick_required_vc_plugins(){
        $config = array(
            'default_path' => theclick_relative_path().'untheme.net/plugins/',
        );
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Templatera','theclick'),
                'slug'               => 'templatera',
                'source'             => 'templatera.zip',
                'required'           => true,
            ),
        );
        tgmpa( $plugins, $config );
    }
}