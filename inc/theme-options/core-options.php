<?php
/**
 * Theme Options 
 * Site Boxed
 * Add option repeated Boxed theme/ meta option
*/
if(!function_exists('theclick_general_opts')){
    function theclick_general_opts($args = []){
        $args = wp_parse_args($args, [
            'default'   => false
        ]);
        $default_value              = $args['default'] ? '-1' : '0';
        $force_output               = $args['default'] ? true : false;
        $default_dropdown_opts      = $args['default'] ? array('-1' => esc_html__('Default','theclick')) : array();
        $default_page_loading_value = $args['default'] ? '-1' : 'fading-circle';

        if($args['default'] === true){
            $options_layout = array(
                '-1'       => esc_html__('Default','theclick'),
                'boxed'    => esc_html__('Boxed','theclick'),
                'bordered' => esc_html__('Bordered','theclick'),
            );
            $default_layout = '-1';

            $options_boxed = array(
                '-1' => esc_html__('Default','theclick'),
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
        } else {
            $options_layout = array(
                '-1'       => esc_html__('Default','theclick'),
                'boxed'    => esc_html__('Boxed','theclick'),
                'bordered' => esc_html__('Bordered','theclick'),
            );
            $default_layout = '-1';
            
            $options_boxed = array(
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
        }
        return array(
            array(
                'id'       => 'body_bg',
                'type'     => 'background',
                'title'    => esc_html__('Body Background', 'theclick'),
                'subtitle' => esc_html__('Choose background style for body', 'theclick'),
                'output'   => array('body')
            ),       
            array(
                'id'       => 'site_layout',
                'type'     => 'button_set',
                'title'    => esc_html__('Layout', 'theclick'),
                'subtitle' => esc_html__('Choose site layout', 'theclick'),
                'options'  => $options_layout,
                'default'  => $default_layout,
            ),
            array(
                'id'       => 'boxed_content_bg',
                'type'     => 'background',
                'title'    => esc_html__('Boxed Content Background', 'theclick'),
                'subtitle' => esc_html__('Choose background style for boxed content', 'theclick'),
                'required' => array(
                    array('site_layout', '=', 'boxed')
                ),
                'output'   => array('.site-boxed .ef5-page'),
                'force_output' => $force_output
            ),
            array(
                'id'       => 'site_bordered_w',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__('Bordered Width', 'theclick'),
                'subtitle' => esc_html__('Enter bordered with.', 'theclick'),
                'units'    => array('px'),
                'default'  => array(
                    'padding-top'    => '50px',
                    'padding-right'  => '50px',
                    'padding-bottom' => '50px',
                    'padding-left'   => '50px',
                    'units'          => 'px'
                ),
                'required' => array(
                    array('site_layout', '=', 'bordered')
                ),
                'force_output' => $force_output,
                //'output'       => array('.site-bordered')
            ),
            array(
                'id'       => 'bordered_content_bg',
                'type'     => 'background',
                'title'    => esc_html__('Bordered Content Background', 'theclick'),
                'subtitle' => esc_html__('Choose background style for bordered content', 'theclick'),
                'required' => array(
                    array('site_layout', '=', 'bordered')
                ),
                'output'   => array('.site-bordered .ef5-page'),
                'force_output' => $force_output
            ),
            array(
                'id'       => 'show_page_loading',
                'type'     => 'button_set',
                'title'    => esc_html__('Enable Page Loading', 'theclick'),
                'subtitle' => esc_html__('Enable Page Loading Effect When You Load Site', 'theclick'),
                'options'  => $options_boxed,
                'default'  => $default_value,
            ),
            array(
                'title'     => esc_html__('Page Loadding Style','theclick'),
                'subtitle'  => esc_html__('Select Style Page Loadding.','theclick'),
                'id'        => 'page_loading_style',
                'type'      => 'select',
                'options'   => theclick_page_loading_styles($args['default']),
                'default'   => $default_page_loading_value,
                'required'  => array('show_page_loading', '=', '1' )
            ),
            array(
                'id'       => 'back_totop_on',
                'type'     => 'button_set',
                'title'    => esc_html__('Back to Top Button', 'theclick'),
                'subtitle' => esc_html__('Show back to top button when scrolled down.', 'theclick'),
                'options'  => $options_boxed,
                'default'  => $default_value,
            )
        );
    }
}

/**
 * Theme Options 
 * Header Top Area 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('theclick_header_top_opts')){
    function theclick_header_top_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = $args['default'] ? '-1' : '';
        return array(
            'title'  => esc_html__('Header Top', 'theclick'),
            'icon'   => 'el el-website',
            'fields' => array(
                array(
                    'id'          => 'header_top',
                    'type'        => 'image_select',
                    'title'       => esc_html__('Layout', 'theclick'),
                    'subtitle'    => esc_html__('Select a layout for upper header top area.', 'theclick'),
                    'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom header layout first.','theclick'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=ef5_header_top' ) ) . '">','</a>'),
                    'options'     => theclick_list_post_thumbnail('ef5_header_top', $args['default']),
                    'default'     => $default_value
                )
            )
        );
    }
}

/**
 * Theme Options 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('theclick_header_layout')){
    function theclick_header_layout($default = false){
        $layouts = [];
        if($default){
            $layouts['-1'] = get_template_directory_uri() . '/assets/images/default.png';
            $layouts['none'] = get_template_directory_uri() . '/assets/images/none.png';
        }
        $layouts['1'] = get_template_directory_uri() . '/assets/images/header/header-1.png';
        $layouts['2'] = get_template_directory_uri() . '/assets/images/header/header-2.png';
        $layouts['3'] = get_template_directory_uri() . '/assets/images/header/header-3.png';
        $layouts['4'] = get_template_directory_uri() . '/assets/images/header/header-4.png';
        $layouts['5'] = get_template_directory_uri() . '/assets/images/header/header-5.png';
        $layouts['6'] = get_template_directory_uri() . '/assets/images/header/header-6.png';
        $layouts['7'] = get_template_directory_uri() . '/assets/images/header/header-7.png';
        $layouts['8'] = get_template_directory_uri() . '/assets/images/header/header-8.png';
        $layouts['9'] = get_template_directory_uri() . '/assets/images/header/header-9.png';
        $layouts['10'] = get_template_directory_uri() . '/assets/images/header/header-10.png';
        $layouts['11'] = get_template_directory_uri() . '/assets/images/header/header-11.png';
        $layouts['12'] = get_template_directory_uri() . '/assets/images/header/header-12.png';
        $layouts['13'] = get_template_directory_uri() . '/assets/images/header/header-13.png';
        $layouts['14'] = get_template_directory_uri() . '/assets/images/header/header-14.png';
        return $layouts;
    }
}

if(!function_exists('theclick_header_opts')){
    function theclick_header_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = '1';
        $default_menu = '0';
        if($args['default'] === true){
            $options_width = array(
                '-1' => esc_html__('Default','theclick'),
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            
            $default_value = $default_menu = $default_width_value = '-1';
        } else {
            $options_width = array(
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            $default_width_value = '0';
        }
        return array(
            array(
                'id'       => 'header_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'theclick'),
                'subtitle' => esc_html__('Select a layout for header.', 'theclick'),
                'options'  => theclick_header_layout($args['default']),
                'default'  => $default_value
            ),
            array(
                'id'       => 'header_menu',
                'type'     => 'select',
                'options'  => theclick_get_nav_menu(['default' => $args['default'],'none' => true]),
                'default'  => $default_menu,
                'title'    => esc_html__('Header Menu', 'theclick'),
                'subtitle' => esc_html__('Choose a menu to show', 'theclick'),
            ),
            array(
                'id'       => 'header_design',
                'type'     => 'info',
                'style'    => 'success',
                'title'    => esc_html__('Header Design', 'theclick'),
                'subtitle' => esc_html__('Custom header style like: background, text color, link color, border style, ...', 'theclick'),
            ),
            array(
                'title'    => esc_html__('Header Width', 'theclick'),
                'subtitle' => esc_html__('Make header content full width or not', 'theclick'),
                'id'       => 'header_fullwidth',
                'type'     => 'button_set',
                'options'  => $options_width,
                'default'  => $default_width_value
            ),
            array(
                'title'    => esc_html__('Menu Height', 'theclick'),
                'subtitle' => esc_html__('Enter the height for Menu', 'theclick'),
                'id'       => 'main_menu_height',
                'type'     => 'dimensions',
                'width'    => false,
                'units'    => array('px'),
                'default'  => array(),
                'force_output' => true
            ),
            array(
                'title'    => esc_html__('Hidden Side Width', 'theclick'),
                'subtitle' => esc_html__('Enter the width for hidden side', 'theclick'),
                'id'       => 'header_sidewidth',
                'type'     => 'dimensions',
                'height'   => false,
                'units'     => array('px'),
                'required' => array(
                    array('header_layout' ,'=', array('1','2','6','7','8','10','11'))
                ),
                'force_output' => true
            ),
            array(
                'id'     => 'header_bg',
                'type'   => 'background',
                'title'  => esc_html__('Background', 'theclick'),
                'output' => array('.header-default')
            ),
            array(
                'id'          => 'header_text_color',
                'type'        => 'color_rgba',
                'title'       => esc_html__('Text Color', 'theclick'),
                'default'     => '',
                'output'      => array('.header-default')
            ),
            array(
                'id'    => 'header_link_colors',
                'type'  => 'link_color',
                'title' => esc_html__('Link colors', 'theclick'),
            ),
            array(
                'id'       => 'header_border',
                'type'     => 'border',
                'all'      => false,
                'color'    => false,
                'title'    => esc_html__('Border Style', 'theclick'),
                'subtitle' => esc_html__('Add your custom border design', 'theclick'),
                'output'   => array('.header-default')
            ),
            array(
                'id'       => 'header_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Border Color', 'theclick'),
                'subtitle' => esc_html__('Add your custom border color', 'theclick'),
                'output'   => array(
                    'border-color' => '.header-default'
                )
            )
        ); 
    }
}
if(!function_exists('theclick_header_theme_opts')){
    function theclick_header_theme_opts(){
        return array(
            array(
                'title'    => esc_html__('Menu parent arrow icon', 'theclick'),
                'id'       => 'menu_parent_arrow_icon',
                'type'     => 'button_set',
                'options'  => array(
                    '1'  => esc_html__('Show','theclick'),
                    '0'  => esc_html__('Hide','theclick')
                ),
                'default'  => '0'
            )
        ); 
    }
}
/**
 * Theme Option:
 * Header Attributes 
 *
*/
if(!function_exists('theclick_header_atts')){
    function theclick_header_atts($default = false){
        $header_side_nav_pos = array(
            'pos-left'            => esc_html__('Position left','theclick'),
            'pos-right' => esc_html__('Position right','theclick'),
        );
        $header_popup_nav_icon_type = array(
            'text'            => esc_html__('Text','theclick'),
            'icon'            => esc_html__('Icon Only','theclick'),
        );
        $header_mobile_nav_icon_type = array(
            'icon' => esc_html__('Icon','theclick'),
            'text' => esc_html__('Text','theclick'),
        );
        if($default){
            $options = array(
                '-1' => esc_html__('Default','theclick'),
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            $default_value = $default_helper_menu_value = $default_popup_menu = $header_mobile_nav_icon_type_value = $header_side_nav_pos_value = $header_popup_nav_icon_type_value = $header_atts_icon_style_value = '-1';
            $default_helper_menu = [
                'default' => true,
                'none'    => true
            ];
            $header_mobile_nav_icon_type['-1'] = esc_html__('Default','theclick');
            $header_side_nav_pos['-1']   = esc_html__('Default','theclick');
            $header_popup_nav_icon_type['-1']  = esc_html__('Default','theclick');
        } else {
            $options = array(
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            $default_value = '0';
            
            $default_helper_menu_value = '';
            $default_helper_menu  = [];
            $default_popup_menu = '0';
            $header_mobile_nav_icon_type_value = 'icon';
            $header_side_nav_pos_value = 'pos-left';
            $header_popup_nav_icon_type_value = 'text';
        }
        return array_merge(
            array(
                array(
                    'id'       => 'header_attr',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Header Attributes', 'theclick'),
                    'subtitle' => esc_html__('Choose header attributes to show', 'theclick'),
                ),
                array(
                    'title'    => esc_html__('Show Search', 'theclick'),
                    'subtitle' => esc_html__('Show/Hide search icon', 'theclick'),
                    'id'       => 'header_search',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ), 
                array(
                    'title'    => esc_html__('Search Popup', 'theclick'),
                    'subtitle' => esc_html__('Popup/toggle display', 'theclick'),
                    'id'       => 'search_display',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                    'required' => array('header_search', '=', '1'),
                )
            ),
            theclick_header_wc_attrs($options, $default_value),
            theclick_header_signin_signup_opts($options, $default_value),
            array(
                array(
                    'title'    => esc_html__('Show Social', 'theclick'),
                    'subtitle' => esc_html__('Show/Hide social icon', 'theclick'),
                    'id'       => 'header_social',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Show Nav Widget', 'theclick'),
                    'subtitle' => esc_html__('Show/Hide side menu', 'theclick'),
                    'desc'     => sprintf(esc_html__('When this option is YES, you need add widget to %sNav Widget%s area','theclick'),'<a href="' . esc_url( admin_url( 'widgets.php#sidebar-nav' ) ) . '" target="_blank">','</a>'),
                    'id'       => 'header_side_nav',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Nav Widget Position Style', 'theclick'),
                    'subtitle' => esc_html__('Choose style of side menu position', 'theclick'),
                    'id'       => 'header_side_nav_pos',
                    'type'     => 'select',
                    'options'  => $header_side_nav_pos,
                    'default'  => $header_side_nav_pos_value,
                    'required' => array('header_side_nav', '=', '1'),
                ),
                array(
                    'title'    => esc_html__('Show Popup Menu', 'theclick'),
                    'subtitle' => esc_html__('Show/Hide poup menu', 'theclick'),
                    'id'       => 'header_popup_nav',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Popup Menu Icon Style', 'theclick'),
                    'subtitle' => esc_html__('Choose style of icon: Text or Icon', 'theclick'),
                    'id'       => 'header_popup_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_popup_nav_icon_type,
                    'default'  => $header_popup_nav_icon_type_value,
                    'required' => array('header_popup_nav', '=', '1'),
                ),
                array(
                    'id'       => 'header_popup_menu',
                    'type'     => 'select',
                    'options'  => theclick_get_nav_menu(['default' => $default, 'none' => true]),
                    'default'  => $default_popup_menu,
                    'required' => array('header_popup_nav', '=', '1'),
                    'title'    => esc_html__('Popup Menu', 'theclick'),
                    'subtitle' => esc_html__('Choose a menu to show', 'theclick'),
                ),
                array(
                    'title'    => esc_html__('Mobile Menu Icon Style', 'theclick'),
                    'subtitle' => esc_html__('Choose style of mobile menu icon', 'theclick'),
                    'id'       => 'header_mobile_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_mobile_nav_icon_type,
                    'default'  => $header_mobile_nav_icon_type_value,
                ),
                array(
                    'title'    => esc_html__('Helper Menu', 'theclick'),
                    'subtitle' => esc_html__('Show/Hide helper menu', 'theclick'),
                    'id'       => 'header_helper_menu',
                    'type'     => 'select',
                    'options'  => theclick_get_nav_menu($default_helper_menu),
                    'default'  => $default_helper_menu_value
                )
            ),
            theclick_header_social_counter($options, $default_value),
            array(
                array(
                    'id'       => 'header_side_copyright',
                    'type'     => 'textarea',
                    'default'  => sprintf('&copy; TheClick. by <a href="%s">SpyroPress</a>', esc_url('spyropress.com')),
                    'required' => array('header_layout', '=', '3'),
                    'title'    => esc_html__('Copyright Text', 'theclick'),
                    'subtitle' => esc_html__('Enter your copyright text', 'theclick'),
                )
            )

        );
    }
}

/**
 * Theme Options 
 * Show cart, wishlist, ... icon
 * Require WooCommerce, WooCommerce Smash Wishlist, and more to work
 *
*/
function theclick_header_wc_attrs($options, $default_value){
    if(!class_exists('WooCommerce')) return array();
    $opts = [
        array(
            'title'    => esc_html__('Show Cart', 'theclick'),
            'subtitle' => esc_html__('Show/Hide cart icon', 'theclick'),
            'id'       => 'header_cart',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        )
    ];
    if(class_exists('WPcleverWoosw')){
        $opts[] = array(
            'title'    => esc_html__('Show Wishlist', 'theclick'),
            'subtitle' => esc_html__('Show/Hide Wishlist icon', 'theclick'),
            'id'       => 'header_wishlist',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        );
    }
    if(class_exists('WPcleverWooscp')){
        $opts[] = array(
            'title'    => esc_html__('Show Compare', 'theclick'),
            'subtitle' => esc_html__('Show/Hide Compare icon', 'theclick'),
            'id'       => 'header_compare',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        );
    }
    return $opts;
}

/**
 * Theme Options 
 * Show SingIn / SingUp button
 * Require CSH Login Plugin
 *
*/
if(!function_exists('theclick_header_signin_signup_opts')){
    function theclick_header_signin_signup_opts($options, $default_value){
        if(!class_exists('FlexUser')) return array();
        $can_register = get_option('users_can_register');
        $opts = [
            array(
                'title'    => esc_html__('Show User Login', 'theclick'),
                'subtitle' => esc_html__('Show/Hide User Login', 'theclick'),
                'id'       => 'login_register',
                'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
            )
        ];
         
        if ($can_register) {
            $opts[] = array(
                'id'      => 'login_regis_type',
                'type'    => 'select',
                'title'   => esc_html__('Type', 'theclick'),
                'options' => array(
                    'both'     => esc_html__('Both login and register', 'theclick'),
                    'login'    => esc_html__('Only login', 'theclick'),             
                    'register' => esc_html__('Only register', 'theclick')          
                ),
                'default'        => 'both',
                'required' => array('login_register', '=', '1')
            );
            $opts[] = array(
                'id'      => 'login_regis_num_link',
                'type'    => 'select',
                'title'   => esc_html__('Number link', 'theclick'),
                'options' => array(
                    '1' => esc_html__('One', 'theclick'),
                    '2' => esc_html__('Two', 'theclick') 
                ),
                'default'  => '2',
                'required' => array('login_regis_type', '=', 'both')
            );
            $opts[] = array(
                'id'      => 'login_regis_active',
                'type'    => 'select',
                'title'   => esc_html__('Active Form', 'theclick'),
                'options' => array(
                    'all' => esc_html__('Both login and register', 'theclick'),
                    'login' => esc_html__('Only login', 'theclick'),
                    'register' => esc_html__('Only register', 'theclick')
                ),
                'default'  => 'login',
                'required' => array('login_regis_num_link', '=', '1')
            );
            
        }
        $opts[] = array(
            'id' => 'login_description',
            'type' => 'textarea',
            'title' => esc_html__('Login Description', 'theclick'),
            'validate' => 'html_custom',
            'default' => '',
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            ),
            'required' => array('login_regis_type', '=', array('both', 'login'))
        );
        if ($can_register) {
            $opts[] = array(
                'id' => 'register_description',
                'type' => 'textarea',
                'title' => esc_html__('Register Description', 'theclick'),
                'validate' => 'html_custom',
                'default' => '',
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array()
                ),
                'required' => array('login_regis_type', '=', array('both', 'register'))
            );
        }
        return $opts;
          
    }
}
if (!function_exists('theclick_header_social_counter')) {
    function theclick_header_social_counter($options, $default_value)
    {
        if (!class_exists('SC_Class')) return array();
        return array(
            array(
                'title'    => esc_html__('Show Social Counter', 'theclick'),
                'subtitle' => esc_html__('Show/Hide social counter', 'theclick'),
                'id'       => 'header_social_counter',
                'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
            )
        );
    }
}

/**
 * Main Logo
*/
if(!function_exists('theclick_header_main_logo')){
    function theclick_header_main_logo($args = []){
        $args = wp_parse_args($args, [
            'subsection' => true
        ]);
        return array(
            'title'      => esc_html__('Logo', 'theclick'),
            'icon'       => 'el-icon-picture',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'             => 'logo',
                    'type'           => 'media',
                    'library_filter' => array('gif','jpg','jpeg','png','svg'),
                    'title'          => esc_html__('Logo', 'theclick'),
                    'subtitle'       => esc_html__('Choose your logo. If not set, default Logo will be used', 'theclick')
                ),
                array(
                    'id'       => 'logo_size',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'theclick'),
                    'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'theclick'),
                    'units'     => array('px'),
                    'default'   => array(),
                ),
            )
        );
    }
}

/**
 * Main Logo
*/
if(!function_exists('theclick_header_page_logo')){
    function theclick_header_page_logo($args = []){
        $args = wp_parse_args($args, [
            'subsection' => true
        ]);
        return array(
            'title'      => esc_html__('Logo', 'theclick'),
            'icon'       => 'el-icon-picture',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'             => 'logo',
                    'type'           => 'media',
                    'library_filter' => array('gif','jpg','jpeg','png','svg'),
                    'title'          => esc_html__('Main Logo', 'theclick'),
                    'subtitle'       => esc_html__('Choose your logo. If not set, default Logo will be used', 'theclick')
                ),
                array(
                    'id'             => 'sticky_logo',
                    'type'           => 'media',
                    'library_filter' => array('gif','jpg','jpeg','png','svg'),
                    'title'          => esc_html__('Sticky Logo', 'theclick'),
                    'subtitle'       => esc_html__('Choose your sticky logo. If not set, default Logo will be used', 'theclick')
                ),
                array(
                    'id'       => 'logo_size',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'theclick'),
                    'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'theclick'),
                    'units'     => array('px'),
                    'default'   => array(),
                ),
            )
        );
    }
}

/**
 * Ontop Header 
*/
if(!function_exists('theclick_ontop_header_opts')){
    function theclick_ontop_header_opts($args = []){
        $args = wp_parse_args($args, [
            'default'    => false,
            'subsection' => true
        ]);
        $force_output = $args['default'] ? true : false;
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','theclick'),
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            $default_value = '0';
        }
        return array(
            'title'      => esc_html__('On Top Header', 'theclick'),
            'icon'       => 'el-icon-credit-card ',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'       => 'header_ontop',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Header On top', 'theclick'),
                    'subtitle' => esc_html__('Header will be on top when applicable.', 'theclick'),
                    'options'  => $options,
                    'default'  => $default_value
                ),
                array(
                    'id'       => 'ontop_logo_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('On top Logo', 'theclick'),
                    'subtitle' => esc_html__('Custon Logo', 'theclick'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_logo',
                    'type'     => 'media',
                    'title'    => esc_html__('On top Logo', 'theclick'),
                    'subtitle' => esc_html__('If not set, default logo will be used.', 'theclick'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_logo_maxh',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'theclick'),
                    'subtitle' => esc_html__('Enter size for your logo in on top header, just in case the logo is too large. If not set, default size will be used', 'theclick'),
                    'units'     => array('px'),
                    'default'  => array(),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_header_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Header Design', 'theclick'),
                    'subtitle' => esc_html__('Custom on top header style like: background, color, space, ...', 'theclick'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'     => 'ontop_header_bg',
                    'type'   => 'color_rgba',
                    'title'  => esc_html__('Background', 'theclick'),
                    'output' => array(
                        'background-color' => '.header-ontop'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'          => 'ontop_header_text_color',
                    'type'        => 'color_rgba',
                    'title'       => esc_html__('Text Color', 'theclick'),
                    'default'     => '',
                    'output'      => array(
                        'color' => '.header-ontop'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'    => 'ontop_link_colors',
                    'type'  => 'link_color',
                    'title' => esc_html__('Link colors', 'theclick'),
                    'output' => array(
                        'color' => '.header-ontop a'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'header_ontop_border',
                    'type'     => 'border',
                    'all'      => false,
                    'color'    => false,
                    'title'    => esc_html__('Border Style', 'theclick'),
                    'subtitle' => esc_html__('Add your custom border design', 'theclick'),
                    'output'   => array('.header-ontop'),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'header_ontop_border_color',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Border Color', 'theclick'),
                    'subtitle' => esc_html__('Add your custom border color', 'theclick'),
                    'output'   => array(
                        'border-color' => '.header-ontop'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                )
            )
        );
    }
}

/**
 * Header Sticky Options
*/
if(!function_exists('theclick_sticky_header_opts')){
    function theclick_sticky_header_opts($args=[]){
        $args = wp_parse_args($args, [
            'default'    => false,
            'subsection' => true
        ]);
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','theclick'),
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','theclick'),
                '0'  => esc_html__('No','theclick'),
            );
            $default_value = '0';
        }
        return array(
            'title'      => esc_html__('Sticky Header', 'theclick'),
            'icon'       => 'el-icon-credit-card ',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'       => 'header_sticky',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Sticky Header', 'theclick'),
                    'subtitle' => esc_html__('Header will be sticked when applicable.', 'theclick'),
                    'options'  => $options,
                    'default'  => $default_value
                ),
                array(
                    'id'       => 'sticky_logo_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Sticky Logo', 'theclick'),
                    'subtitle' => esc_html__('Custon Logo', 'theclick'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_logo',
                    'type'     => 'media',
                    'title'    => esc_html__('Sticky Header Logo', 'theclick'),
                    'subtitle' => esc_html__('If not set, default logo will be used.', 'theclick'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_logo_maxh',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'theclick'),
                    'subtitle' => esc_html__('Enter size for your logo on sticky header, just in case the logo is too large.', 'theclick'),
                    'units'     => array('px'),
                    'default'  => array(),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_header_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Sticky Header Design', 'theclick'),
                    'subtitle' => esc_html__('Custom sticky header style like: background, color, space, ...', 'theclick'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'     => 'sticky_header_bg',
                    'type'   => 'color_rgba',
                    'title'  => esc_html__('Background', 'theclick'),
                    'output' => array(
                        'background-color' => '.header-sticky'
                    ),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'          => 'sticky_header_text_color',
                    'type'        => 'color_rgba',
                    'title'       => esc_html__('Text Color', 'theclick'),
                    'default'     => '',
                    'output'      => array('.header-sticky'),
                    'required' => array('header_sticky','=', '1')
                ),
                array(
                    'id'    => 'sticky_link_colors',
                    'type'  => 'link_color',
                    'title' => esc_html__('Link colors', 'theclick'),
                    'output' => array(
                        'color' => '.header-sticky a'
                    ),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'header_sticky_border',
                    'type'     => 'border',
                    'all'      => false,
                    'color'    => false,
                    'title'    => esc_html__('Border Style', 'theclick'),
                    'subtitle' => esc_html__('Add your custom border design', 'theclick'),
                    'output'   => array('.header-sticky'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'header_sticky_border_color',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Border Color', 'theclick'),
                    'subtitle' => esc_html__('Add your custom border color', 'theclick'),
                    'output'   => array(
                        'border-color' => '.header-sticky'
                    ),
                    'required' => array('header_sticky', '=', '1')
                )
            )
        );
    }
}
/**
 * Theme Options
 * Page title options
*/
if(!function_exists('theclick_page_title_opts')){
    function theclick_page_title_opts($args=[]){
        $args = wp_parse_args($args,[
            'default' => false
        ]);
        $force_output = $args['default'] ? true : false;
        $default_value = '1';

        $custom_title = $custom_desc = '';

        $ptitle_layout = [
            '1' => get_template_directory_uri() . '/assets/images/page-title/01.png',
            '2' => get_template_directory_uri() . '/assets/images/page-title/02.png',
        ];
        $breadcrumb_on_opts = array(
            '1'  => esc_html__('Show','theclick'), 
            '0'  => esc_html__('Hide','theclick'), 
         );
        if($args['default']){
            $default_value = '-1';
            $ptitle_layout = [
                '-1'   => get_template_directory_uri() . '/assets/images/default.png',
                'none' => get_template_directory_uri() . '/assets/images/none.png'
            ] + $ptitle_layout;

            $custom_title = array(
                'id'       => 'custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Custom Title', 'theclick'),
                'subtitle' => esc_html__('Use custom title for this page. The default title will be used on document title.', 'theclick')
            );

            $custom_desc = array(
                'id'       => 'custom_desc',
                'type'     => 'textarea',
                'title'    => esc_html__('Custom description', 'theclick'),
                'subtitle' => esc_html__('Show custom page description under page title', 'theclick')
            );

            $breadcrumb_on_opts = [
                '-1'  => esc_html__('Default','theclick')
            ] + $breadcrumb_on_opts;
        }
        return array(
            array(
                'id'       => 'ptitle_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'theclick'),
                'subtitle' => esc_html__('Select a layout for page title.', 'theclick'),
                'options'  => $ptitle_layout,
                'default'  => $default_value
            ),
            $custom_title,
            $custom_desc,
            array(
                'id'           => 'ptitle_color',
                'type'         => 'color_rgba',
                'title'        => esc_html__('Title Color', 'theclick'),
                'subtitle'     => esc_html__('Page title color.', 'theclick'),
                'output'       => array(
                    'color' => '.ef5-pagetitle .page-title'
                ),
                'force_output' => $force_output,
                'default'      => ''
            ),
            array(
                'id'       => 'ptitle_parallax',
                'type'     => 'media',
                'title'    => esc_html__('Parallax Image', 'theclick'),
                'subtitle' => esc_html__('Choose your image', 'theclick'),
            ),
            array(
                'id'       => 'ptitle_parallax_overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Parallax Overlay Color', 'theclick'),
                'subtitle' => esc_html__('Add parallax overlay color.', 'theclick'),
                'output'   => array(
                    'background-color' => '.ef5-pagetitle .parallax:before'
                ),
                'force_output' => $force_output,
                'default'      => ''
            ),
            array(
                'id'           => 'ptitle_paddings',
                'type'         => 'spacing',
                'title'        => esc_html__('Paddings', 'theclick'),
                'subtitle'     => esc_html__('Enter inner space.', 'theclick'),
                'mode'         => 'padding',
                'units'        => array('px'),
                'output'       => array('#ef5-page .ef5-pagetitle'),
                'force_output' => $force_output,
                'default'      => array()
            ),
            array(
                'id'           => 'ptitle_margins',
                'type'         => 'spacing',
                'title'        => esc_html__('Margin', 'theclick'),
                'subtitle'     => esc_html__('Enter outer space.', 'theclick'),
                'mode'         => 'margin',
                'units'        => array('px'),
                'force_output' => $force_output,
                'output'       => array('#ef5-page .ef5-pagetitle-wrap'),
                'default'      => array()
            ),
            array(
                'id'      => 'breadcrumb_on',
                'type'    => 'button_set',
                'options' => $breadcrumb_on_opts,
                'title'   => esc_html__('Breadcrumb', 'theclick'),
                'default' => $default_value
            ),
            array(
                'id'          => 'breadcrumb_color',
                'type'        => 'color',
                'title'       => esc_html__('Breadcrumb Text Color', 'theclick'),
                'subtitle'    => esc_html__('Select text color for breadcrumb', 'theclick'),
                'transparent' => false,
                'output'      => array('.ef5-pagetitle-wrap .breadcrumb'),
                'force_output'=> $force_output,
                'required'    => array('breadcrumb_on', '=', true)
            ),
            array(
                'id'           => 'breadcrumb_link_colors',
                'type'         => 'link_color',
                'title'        => esc_html__('Breadcrumb Link Colors', 'theclick'),
                'subtitle'     => esc_html__('Select link colors for breadcrumb', 'theclick'),
                'output'       => array('.ef5-pagetitle-wrap .breadcrumb a'),
                'force_output' => $force_output,
                'default'      => array(),
                'required'     => array('breadcrumb_on', '=', true)
            )
        );
    }
}
/**
 * Widget Options
 * sidebar position
*/
function theclick_sidebar_position_opts($default = false){
    $options_default = array('-1' => esc_html__('Default','theclick'));
    $options =  array(
        'none'   => esc_html__('No Widget', 'theclick'),
        'center' => esc_html__('No Widget - Content Center', 'theclick'),
        'left'   => esc_html__('Left', 'theclick'),
        'right'  => esc_html__('Right', 'theclick'),
        'bottom' => esc_html__('Below Content', 'theclick')
    );
    if($default)
        return $options_default+$options;
    else 
        return $options;
}

/* Page Options */
if(!function_exists('theclick_page_opts')){
    function theclick_page_opts($default = false){
        $default_value = theclick_page_sidebar_position();
        if($default){
            $default_value = '-1';
        }
        return array(
            array(
                'id'       => 'page_sidebar_pos',
                'type'     => 'button_set',
                'title'    => esc_html__('Layouts', 'theclick'),
                'subtitle' => esc_html__('select a layout for single...', 'theclick'),
                'options'  => theclick_sidebar_position_opts($default),
                'default'  => $default_value
            )
        );
    }
}

/**
 * WooCommerce Options
*/
if(!function_exists('theclick_woocommerce_theme_opts')){
    function theclick_woocommerce_theme_opts($default = false){
        $gallery_layout = $gallery_thumb_position        = array();
        $default_value          = 'none';
        $default_gallery_layout = 'simple';
        $default_gallery_thumb_position = 'thumb-right';
        if($default){
            $gallery_layout['-1']         = esc_html__('Default','theclick');
            $gallery_thumb_position['-1'] = esc_html__('Default','theclick');
            $default_value                = '-1';
            $default_gallery_layout       = '-1';
            $default_gallery_thumb_position       = '-1';
        }
        $gallery_layout['simple']     = esc_html__('Simple', 'theclick');
        $gallery_layout['thumbnail_v'] = esc_html__('Thumbnail Vertical', 'theclick');
        $gallery_layout['thumbnail_h'] = esc_html__('Thumbnail Horizontal', 'theclick');

        $gallery_thumb_position['thumb-left'] = esc_html__('Left','theclick');
        $gallery_thumb_position['thumb-right'] = esc_html__('Right','theclick');

        return array(
            'title'      => esc_html__('WooCommerce', 'theclick'),
            'icon'       => 'el el-shopping-cart',
            'subsection' => false,
            'fields'     => array(
                array(
                    'id'       => 'loop_product_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Loop Products Design', 'theclick'),
                    'subtitle' => esc_html__('Custom products design, ...', 'theclick'),
                ),
                array(
                    'id'       => 'products_per_page',
                    'type'     => 'slider',
                    'title'    => esc_html__('Number Products', 'theclick'),
                    'subtitle' => esc_html__('Choose number products to show on archive page, ...', 'theclick'),
                    'default'   => 12,
                    'min'       => 1,
                    'step'      => 1,
                    'max'       => 50,
                    'display_value' => 'label'
                ),
                array(
                    'id'       => 'products_columns',
                    'type'     => 'slider',
                    'title'    => esc_html__('Products Columns', 'theclick'),
                    'subtitle' => esc_html__('Choose products columns show on archive page, ...', 'theclick'),
                    'default'   => 4,
                    'min'       => 1,
                    'step'      => 1,
                    'max'       => 6,
                    'display_value' => 'label'
                ),
                array(
                    'id'       => 'shop_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'theclick'),
                    'subtitle' => esc_html__('select a layout for products page', 'theclick'),
                    'options'  => theclick_sidebar_position_opts(),
                    'default'  => theclick_shop_sidebar_position()
                ),
                array(
                    'id'       => 'single_product_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Single Product Design', 'theclick'),
                    'subtitle' => esc_html__('Custom single product design, ...', 'theclick'),
                ),
                array(
                    'id'       => 'product_gallery_layout',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'theclick'),
                    'subtitle' => esc_html__('select a layout for single...', 'theclick'),
                    'options'  => $gallery_layout,
                    'default'  => $default_gallery_layout
                ),
                array(
                    'id'       => 'product_gallery_thumb_position',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Thumbnail Position', 'theclick'),
                    'subtitle' => esc_html__('select a position for gallery thumbnail', 'theclick'),
                    'options'  => $gallery_thumb_position,
                    'default'  => $default_gallery_thumb_position,
                    'required' => array(
                        array('product_gallery_layout', '=', 'thumbnail_v')
                    )
                ),
                array(
                    'id'       => 'product_share_on',
                    'title'    => esc_html__('Share', 'theclick'),
                    'subtitle' => esc_html__('Show share product to some socials network on each post.', 'theclick'),
                    'type'     => 'switch',
                    'default'  => '0',
                ),
                array(
                    'id'       => 'product_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'theclick'),
                    'subtitle' => esc_html__('select a layout for single product page', 'theclick'),
                    'options'  => theclick_sidebar_position_opts(),
                    'default'  => theclick_product_sidebar_position()
                ),
            )
        );
    }
}

/**
 * Theme Options 
 * Footer Area 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('theclick_footer_opts')){
    function theclick_footer_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = $args['default'] ? '-1' : '';
        $force_output  = $args['default'] ? true : false;
        return array(
            'title'  => esc_html__('Footer', 'theclick'),
            'icon'   => 'el el-website',
            'fields' => array(
                array(
                    'id'          => 'footer_layout',
                    'type'        => 'image_select',
                    'title'       => esc_html__('Layout', 'theclick'),
                    'subtitle'    => esc_html__('Select a layout for upper footer area.', 'theclick'),
                    'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','theclick'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=ef5_footer' ) ) . '">','</a>'),
                    'placeholder' => esc_html__('Default','theclick'),
                    'options'     => theclick_list_post_thumbnail('ef5_footer', $args['default']),
                    'default'     => $default_value
                ),
                array(
                    'id'             => 'footer_margin',
                    'type'           => 'spacing',
                    'mode'           => 'margin',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer margin', 'theclick'),
                    'subtitle'       => esc_html__('Enter outer space', 'theclick'),
                    'force_output'   => $force_output,
                    'output'         => array(
                        '#ef5-footer'
                    )
                ),
            )
        );
    }
}