<?php
/**
 * TheClick functions and definitions
 *
 * @package EF5 Theme
 * @subpackage TheClick
 * @since 1.0.0
 * @author EF5 Team
 *
*/
 
if(!function_exists('theclick_configs')){
    function theclick_configs($value){
        $configs = [
            'primary_color'         => '#111111',
            'accent_color'          => '#777777',
            'darkent_accent_color'  => '#303030',
            'lightent_accent_color' => '#999999',
            'invalid_color'         => 'red',
            'color_red'             => 'red',
            'color_green'           => 'green',
            'white'                 => 'white',
            // Typo
            'google_fonts'          => '',
            'body_bg'               => '#fff',
            'body_font'             => '\'futura-pt\'',
            'body_font_size'        => '15px',
            'body_font_size_large'  => '18px',
            'body_font_size_medium' => '16px',
            'body_font_size_small'  => '14px',
            'body_font_size_xsmall' => '13px',
            'body_font_size_xxsmall'=> '12px',
            'body_font_color'       => '#111111',
            'body_line_height'      => '1.6',
            'content_width'         => 1170,
            'h1_size'               => '36px',
            'h2_size'               => '30px',
            'h3_size'               => '20px',
            'h4_size'               => '18px',
            'h5_size'               => '16px',
            'h6_size'               => '15px',
            'heading_font'          => '\'futura-pt\'',
            'heading_color'         => 'var(--primary-color)',
            'heading_color_hover'   => 'var(--accent-color)',
            'heading_font_weight'   => 400,
            'meta_font'             => '\'futura-pt\'',    
            'meta_color'            => '#777777',    
            'meta_color_hover'      => 'var(--accent-color)',
            'text-grey'            => '#b0b0b0',
            // Boder
            'main_border'           => '1px solid #D8D8D8', 
            'main_border2'          => '2px solid #D8D8D8', 
            'main_border_color'     => '#D8D8D8', 
            // Thumbnail Size
            'large_size_w'                    => 810,
            'large_size_h'                    => 500,
            'medium_size_w'                   => 570,
            'medium_size_h'                   => 570,
            'thumbnail_size_w'                => 90,
            'thumbnail_size_h'                => 90,
            'post_thumbnail_size_w'           => 1170,
            'post_thumbnail_size_h'           => 938,
            'theclick_default_post_thumbnail' => true,
            'theclick_thumbnail_is_bg'        => true,
            // Header 
            'logo_width'       => '108',
            'logo_height'      => '42',
            'logo_units'       => 'px',
            'main_menu_height' => '102px',
            'header_sidewidth' => '370px',
            // Menu Color
            'menu_link_color_regular' => 'var(--primary-color)',
            'menu_link_color_hover' => 'var(--accent-color)',
            'menu_link_color_active' => 'var(--accent-color)',
            // Menu Ontop Color
            'ontop_link_color_regular' => '#ffffff',
            'ontop_link_color_hover' => 'rgba(255,255,255,0.8)',
            'ontop_link_color_active' => 'rgba(255, 255, 255, 0.8)',
            // Menu Sticky Color
            'sticky_link_color_regular' => '#ffffff',
            'sticky_link_color_hover' => 'rgba(255, 255, 255, 0.8)',
            'sticky_link_color_active' => 'rgba(255, 255, 255, 0.8)',
            // Dropdown
            'dropdown_bg'      => 'var(--primary-color)',
            'dropdown_regular' => '#ffffff',
            'dropdown_hover'   => 'rgba(255, 255, 255, 0.8)',
            'dropdown_active'  => 'rgba(255, 255, 255, 0.8)',
            // Comments 
            'cmt_avatar_size'  => 64,
            'cmt_border'       => '1px solid #D8D8D8',

            // WooCommerce,
            // product single image size
            'theclick_product_single_image_w' => theclick_get_theme_opt('product_single_image_size',['width' => '455'])['width'],
            'theclick_product_single_image_h' => theclick_get_theme_opt('product_single_image_size',['height' => '605'])['height'],
            'theclick_product_single_gallery_w' => theclick_get_theme_opt('theclick_product_single_gallery_w',['width' => '570px'])['width'],
            // loop product image size
            'theclick_product_loop_image_w' => theclick_get_theme_opt('product_loop_image_size',['width' => '640'])['width'],
            'theclick_product_loop_image_h' => theclick_get_theme_opt('product_loop_image_size',['height' => '860'])['height'],
            // product default gallery thumbnail size
            'theclick_product_gallery_thumbnail_w' => theclick_get_theme_opt('product_gallery_thumbnail_size',['width' => '115'])['width'],
            'theclick_product_gallery_thumbnail_h' => theclick_get_theme_opt('product_gallery_thumbnail_size',['height' => '140'])['height'],
            // product vertical gallery thumbnail size
            'theclick_product_gallery_thumbnail_v_w' => theclick_get_theme_opt('product_gallery_thumbnail_v_size',['width' => '115'])['width'],
            'theclick_product_gallery_thumbnail_v_h' => theclick_get_theme_opt('product_gallery_thumbnail_v_size',['height' => '140'])['height'],
            // product horizontal gallery thumbnail size
            'theclick_product_gallery_thumbnail_h_w' => theclick_get_theme_opt('product_gallery_thumbnail_h_size',['width' => '115'])['width'],
            'theclick_product_gallery_thumbnail_h_h' => theclick_get_theme_opt('product_gallery_thumbnail_h_size',['height' => '140'])['height'],
            // product gallery thumbnail space
            'theclick_product_gallery_thumbnail_space' => theclick_get_theme_opt('product_gallery_thumbnail_space',['width' => '15px'])['width'],
            // cart item thumbnail size 
            'theclick_woocommerce_cart_item_thumbnail_size' => theclick_get_theme_opt('theclick_woocommerce_cart_item_thumbnail_size',['width' => '100px', 'height'=> '115px']),

            // API 
            'google_api_key' => apply_filters('ef5systems-google-api-key', false)

        ];
        $header_layout = theclick_get_opts('header_layout', '1');
        switch ($header_layout) {
            case '14':
                $configs['main_menu_height'] = '66px';
                break;
        }
        return $configs[$value];
    }
}
function theclick_relative_path(){
    if(is_ssl())
        return 'https://';
    else 
        return 'http://';
}
if (!function_exists('theclick_setup')) {
    function theclick_setup()
    {
        // Make theme available for translation.
        load_theme_textdomain('theclick', get_template_directory() . '/languages');

        // Custom Header
        add_theme_support("custom-header");

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');
        
        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails'); 
        set_post_thumbnail_size(theclick_configs('post_thumbnail_size_w'), theclick_configs('post_thumbnail_size_h'), 1);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'ef5-primary'     => esc_html__('Primary Menu', 'theclick'),
            'ef5-menu-icon'   => esc_html__('Menu with Icon', 'theclick')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('theclick_custom_background_args', array(
            'default-color' => '#ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
            'width'       => theclick_configs('logo_width'),
            'height'      => theclick_configs('logo_height'),
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('post-formats', array(
            'gallery',
            'video',
            'audio',
            'quote',
            'link',
            'image'
        ));

        /* WooCommerce */
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');    
        /*
         * Add style for editor
        */
        theclick_require_folder( '/inc/editor',get_template_directory());
        /**
         * Load custom font icon
        */
        theclick_require_folder( '/assets/icon_fonts',get_template_directory());
    }
    add_action('after_setup_theme', 'theclick_setup');
}

function theclick_update(){
    /* Change default image thumbnail sizes in wordpress */
    $thumbnail_size = array(
        'large_size_w'        => theclick_configs('large_size_w'),
        'large_size_h'        => theclick_configs('large_size_h'),
        'large_crop'          => 1, 
        'medium_size_w'       => theclick_configs('medium_size_w'),
        'medium_size_h'       => theclick_configs('medium_size_h'),
        'medium_crop'         => 1, 
        'thumbnail_size_w'    => theclick_configs('thumbnail_size_w'),
        'thumbnail_size_h'    => theclick_configs('thumbnail_size_h'),
        'thumbnail_crop'      => 1,
    );
    foreach ($thumbnail_size as $option => $value) {
        if (get_option($option, '') != $value)
            update_option($option, $value);
    }
}
add_action('after_switch_theme', 'theclick_update');

/* add editor styles */
function theclick_editor_styles()
{
    add_editor_style('assets/admin/css/editor.css');
}
add_action('admin_init', 'theclick_editor_styles');

/* add admin styles */
function theclick_admin_style()
{
    wp_enqueue_style('theclick', get_template_directory_uri() . '/assets/admin/css/admin.css');
}
add_action('admin_enqueue_scripts', 'theclick_admin_style');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width))
    $content_width = apply_filters('theclick_content_width', 1170);
function theclick_content_width()
{
    $GLOBALS['content_width'] = apply_filters('theclick_content_width', 1170);
}
add_action('after_setup_theme', 'theclick_content_width', 0);

/**
 * Incudes file
 *
*/
if(!function_exists('theclick_require_folder')){
    function theclick_require_folder($foldername,$path)
    {
        $dir = $path . DIRECTORY_SEPARATOR . $foldername;
        if (!is_dir($dir)) {
            return;
        }
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $file) {
            $patch = $dir . DIRECTORY_SEPARATOR . $file;
            if (file_exists($patch) && strpos($file, ".php") !== false) {
                require_once $patch;
            }
        }
    }
}

/**
 * Register widget area.
 */
function theclick_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Blog Widgets', 'theclick'),
        'id'            => 'sidebar-main',
        'description'   => esc_html__('Add widgets here to appear below Blog content.', 'theclick'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="ef5-heading h3 widgettitle">',
        'after_title'   => '</div>',
    ));
    if(class_exists('EF5Systems')){
        register_sidebar(array(
            'name'          => esc_html__('Blog Single Widgets', 'theclick'),
            'id'            => 'sidebar-single',
            'description'   => esc_html__('Add widgets here to appear below Blog Single content.', 'theclick'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="ef5-heading h3 widgettitle">',
            'after_title'   => '</div>',
        ));
        register_sidebar(array(
            'name'          => esc_html__('Hidden Navigation Menu', 'theclick'),
            'id'            => 'sidebar-nav',
            'description'   => esc_html__('Add widgets here to appear when click on Hidden Navigation Icon.', 'theclick'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="ef5-heading h3 widgettitle">',
            'after_title'   => '</div>',
        ));
        
    }
    if(class_exists('WooCommerce')){
        register_sidebar(array(
            'name'          => esc_html__('Shop Widgets', 'theclick'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Add widgets here to appear in widget area of single product', 'theclick'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="ef5-heading h3 widgettitle">',
            'after_title'   => '</div>',
        ));
    }
     
}
add_action('widgets_init', 'theclick_widgets_init');
/**
 * Script Debug
 * Add suffix '.min' to scripts file
 *
*/
if(!function_exists('theclick_script_debug')){
    function theclick_script_debug() {
        $suffix   = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
        $dev_mode = theclick_get_opts('dev_mode', true);
        if(!$dev_mode) $suffix = '.min';
        return apply_filters( 'theclick_get_dev_mode', $suffix );
    }
}
/**
 * Enqueue scripts and styles.
 */
add_action('wp_footer', 'theclick_scripts', 0);
function theclick_scripts()
{
    $min = theclick_script_debug();
    // Comment
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    // Custom Options
    $filter_reset = function_exists('ef5systems_uri') ? ef5systems_uri() : '';
    $theclick_ajax_opts = array(
        'ajaxurl'             => admin_url( 'admin-ajax.php' ),
        'primary_color'       => theclick_configs('primary_color'),
        'accent_color'        => theclick_configs('accent_color'),
        'darkent_accent_color'        => theclick_configs('darkent_accent_color'),
        'lightent_accent_color'        => theclick_configs('lightent_accent_color'),
        'shop_url'            => function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id( 'shop' )) : '',
        'filter_reset'        => ( strpos($filter_reset,'filter_') !== false || strpos($filter_reset,'min_price') !== false || strpos($filter_reset,'max_price') || strpos($filter_reset, 'rating_filter')) ? 'true' : 'false',
        'filter_clear_text'   => esc_html__('Clear All', 'theclick'),
        'has_select2'         => class_exists('Woocommerce') ? true : false,
        'is_rtl'              => is_rtl() ? 'true' : 'false'
    );
    if(class_exists('Woocommerce')) {
        wp_enqueue_script( 'selectWoo' );
        wp_enqueue_style( 'select2' ); 
    }

    // Scripts
    wp_enqueue_script('theclick', get_template_directory_uri() . '/assets/js/theme'.$min.'.js', array('jquery'), '', true);
    wp_localize_script( 'theclick', 'theclick_ajax_opts', $theclick_ajax_opts);
}

add_action('wp_enqueue_scripts', 'theclick_styles', 0);
function theclick_styles()
{
    $min = theclick_script_debug();
    // Theme Style
    wp_enqueue_style('theclick', get_template_directory_uri() . '/assets/css/theme'.$min.'.css', array(), wp_get_theme()->get( 'Version' ) );
    // add CSS Variations
    $theclick_inline_styles = theclick_inline_styles();
    wp_add_inline_style( 'theclick', $theclick_inline_styles );
    
}

add_action('wp_footer', 'theclick_ef5systems_styles');
function theclick_ef5systems_styles(){
    if(wp_script_is('font-awesome5')){
        // Call libs css
        wp_enqueue_style('font-awesome5');
        wp_enqueue_style('font-awesome5-shim');
        wp_enqueue_style('hint');
    } else {
        wp_enqueue_style('font-awesome5', get_template_directory_uri() . '/assets/icon_fonts/awesome5/css/all..css', array(), wp_get_theme()->get( 'Version' ));
        wp_enqueue_style('font-awesome5-shim', get_template_directory_uri() . '/assets/icon_fonts/awesome5/css/v4-shims.min.css', array('font-awesome5'), wp_get_theme()->get( 'Version' ));
        wp_enqueue_style('font-theclick', get_template_directory_uri() . '/assets/icon_fonts/theclick/theclick.css', array(), wp_get_theme()->get( 'Version' ));
    }
}
function theclick_inline_styles() {
    ob_start();
    $preset_primary_color = $primary_color = theclick_get_opts( 'primary_color', apply_filters('theclick_primary_color', theclick_configs('primary_color')) );
    $preset_accent_color  = $accent_color= theclick_get_opts( 'accent_color', apply_filters('theclick_accent_color', theclick_configs('accent_color')) );
    $darkent_accent_color = theclick_get_opts( 'darkent_accent_color', apply_filters('theclick_darkent_accent_color', theclick_configs('darkent_accent_color')) );
    $lightent_accent_color = theclick_get_opts( 'lightent_accent_color', apply_filters('theclick_lightent_accent_color', theclick_configs('lightent_accent_color')) );
    $main_menu_height = theclick_get_opts( 'main_menu_height', ['height' => theclick_configs('main_menu_height')]);
 
    // CSS Variable
    printf(':root{
        --primary-color:%s;
        --accent-color:%s;
        --accent-color-05:%s;
        --accent-color-03:%s;
        --darkent-accent-color:%s;
        --lightent-accent-color:%s;
        }', 
        $preset_primary_color,
        $preset_accent_color,
        theclick_hex2rgba($preset_accent_color, 0.5),
        theclick_hex2rgba($preset_accent_color, 0.3),
        $darkent_accent_color,
        $lightent_accent_color
    );
    // Header Variable
    $header_bg = theclick_get_opts('header_bg',[
        'background-color'      => '#fff',
        'background-image'      => 'inherit',
        'background-size'       => 'inherit',
        'background-repeat'     => 'inherit',
        'background-attachment' => 'inherit', 
        'background-position'   => 'inherit' 
    ]);
    $header_text_color = theclick_get_opts('header_text_color',['color' => '', 'alpha' => '', 'rgba' => 'inherit']);
    $header_ontop_top_space = theclick_get_opts('header_ontop_top_space',['height' => '']);
    printf(
        ':root{
            --main-menu-height:%s;
            --header-text-color: %s;
            --header-bg-color: %s;
            --header-bg-image: %s;
            --header-bg-size: %s;
            --header-bg-repeat: %s;
            --header-bg-attachment: %s;
            --header-bg-position: %s;
            --header_ontop_top_space: %s;
        }',
        $main_menu_height['height'],
        $header_text_color['rgba'],
        $header_bg['background-color'],
        $header_bg['background-image'],
        $header_bg['background-size'],
        $header_bg['background-repeat'],
        $header_bg['background-attachment'],
        $header_bg['background-position'],
        $header_ontop_top_space['height']
    );
    /* Default Header Color */
    $header_link_color = theclick_get_opts('header_link_colors',apply_filters('theclick_header_link_color', ['regular' => $primary_color, 'hover' => $accent_color, 'active' => $accent_color]) );
    
    printf(':root{
            --header_regular: %1$s;
            --header_hover: %2$s;
            --header_active: %3$s;
        }', 
        $header_link_color['regular'],
        $header_link_color['hover'],
        $header_link_color['active']
    );
    /* Ontop Header Color */
    $ontop_link_color = theclick_get_opts('ontop_link_colors', apply_filters('theclick_ontop_link_color', ['regular' => theclick_configs('ontop_link_color_regular'), 'hover' => theclick_configs('ontop_link_color_hover'), 'active' => theclick_configs('ontop_link_color_active')]) );
    printf(':root{
            --ontop_regular: %1$s;
            --ontop_hover: %2$s;
            --ontop_active: %3$s;
        }', 
        $ontop_link_color['regular'],
        $ontop_link_color['hover'],
        $ontop_link_color['active']
    );
    /* Sticky Header Color */
    $sticky_link_color = theclick_get_opts('sticky_link_colors',apply_filters('theclick_sticky_link_color',['regular' => theclick_configs('sticky_link_color_regular'), 'hover' => theclick_configs('sticky_link_color_hover'), 'active' => theclick_configs('sticky_link_color_active')]));    
    printf(':root{
            --sticky_regular: %1$s;
            --sticky_hover: %2$s;
            --sticky_active: %3$s;
        }', 
        $sticky_link_color['regular'],
        $sticky_link_color['hover'],
        $sticky_link_color['active']
    );
    /* Dropdown && Mobile */
    $dropdown_bg_opt = theclick_get_opts('dropdown_bg',['rgba' => apply_filters('theclick_dropdown_bg', theclick_configs('dropdown_bg'))]);
    $dropdown_link_colors = theclick_get_opts('dropdown_link_colors', apply_filters('theclick_dropdown_link_colors',['regular' => theclick_configs('dropdown_regular'), 'hover' => theclick_configs('dropdown_hover'), 'active' => theclick_configs('dropdown_active')]) );
    printf(':root{
            --dropdown_regular: %1$s;
            --dropdown_hover: %2$s;
            --dropdown_active: %3$s;
            --dropdown_bg: %4$s;
        }', 
        $dropdown_link_colors['regular'],
        $dropdown_link_colors['hover'],
        $dropdown_link_colors['active'],
        $dropdown_bg_opt['rgba']
    );
    return ob_get_clean();
}
 
function theclick_google_api_key(){
    $api = theclick_get_theme_opt('google_api_key','');
    return $api;
}
add_filter('ef5-google-api-key','theclick_google_api_key');
/**
 * Remove all Font Awesome from 3rd extension 
 * to use only font-awesome latest from our theme
 * //'font-awesome',
 * //'gglcptch',
*/
add_filter('ef5_remove_styles', 'theclick_remove_styles');
function theclick_remove_styles($styles){
    $_styles = [
        'newsletter'
    ];
    $styles = array_merge($styles, $_styles);
    return $styles;
}


/**
 * Register Google Fonts
 *
 * https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
 * https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
*/
function theclick_fonts_url() {
    if(empty(theclick_configs('google_fonts'))) return '';
    $font_url = add_query_arg( 
        'family', 
        urlencode(theclick_configs('google_fonts')), 
        "//fonts.googleapis.com/css"
    );
    return $font_url;
}
function theclick_font_scripts() {
    wp_enqueue_style( 'ef5-fonts', theclick_fonts_url() );
}
add_action( 'wp_enqueue_scripts', 'theclick_font_scripts' );

function theclick_default_value($param, $default){
    return !empty($param) ? $param : $default;
}
/**
 * All Theme Function
*/
theclick_require_folder('inc', get_template_directory());
theclick_require_folder('inc/extends', get_template_directory());
theclick_require_folder('inc/classes', get_template_directory());
theclick_require_folder('inc/walker', get_template_directory());
theclick_require_folder('inc/core', get_template_directory());
theclick_require_folder('inc/functions', get_template_directory());
theclick_require_folder('inc/theme-options', get_template_directory());
theclick_require_folder('inc/custom-post', get_template_directory());
theclick_require_folder('inc/icons', get_template_directory());

if(class_exists('EF5Systems_MegaMenu_Walker')){
    theclick_require_folder('inc/mega-menu', get_template_directory());
}

if(function_exists('register_ef5_widget')){
    theclick_require_folder('inc/widgets', get_template_directory());
}

if(class_exists('VC_Manager') && class_exists('EF5Systems')){
    theclick_require_folder('vc_extends', get_template_directory());
    add_action('vc_after_init', 'theclick_vc_after_init');
    function theclick_vc_after_init(){ 
        theclick_require_folder('vc_elements', get_template_directory());
    }
}

if(class_exists('WooCommerce')){
    theclick_require_folder('inc/woo', get_template_directory());
}
/**
 * Custom Extensions
 * Custom some extension used in theme
 *
*/
theclick_require_folder('inc/extensions', get_template_directory());
