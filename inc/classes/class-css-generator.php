<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) )
{
    return;
}

class TheClick_CSS_Generator
{
    /**
     * Compiler class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null; 
    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

    /*
     * Theme Color
    */

    /**
     * Constructor
     */
    function __construct()
    {
        $this->opt_name = theclick_get_theme_opt_name();
 
        if ( empty( $this->opt_name ) )
        {
            return;
        }
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
        /* save option generate css */
        add_action("redux/options/{$this->opt_name}/saved", array($this, 'generate_file'));
    }
    /**
     * init hook - 10
     */
    function init()
    {
        if ( ! class_exists( '\Leafo\ScssPhp\Compiler' ) )
        {
            return;
        }
        $this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );
        if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework )
        {
            return;
        }
        $this->dev_mode = theclick_get_theme_opt('dev_mode', false);

        if ( $this->dev_mode )
        {
            $this->generate_file();
            $this->generate_min_file();
            $this->generate_editor_style();
        }
        else
        {
            add_action( "redux/options/{$this->opt_name}/saved", array( $this, 'generate_file' ) );
        }
    }

    /**
     * Generate options and css files
     */
    function generate_file()
    {    
        if(!class_exists('\Leafo\ScssPhp\Compiler')) return;
        // Theme
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';
        $css_file = $css_dir . 'theme.css';
        // Child Theme
        $child_scss_dir = get_stylesheet_directory() . '/assets/scss/';
        $child_css_dir  = get_stylesheet_directory() . '/assets/css/';
        $child_css_file = $child_css_dir . 'child-theme.css';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $_options = $scss_dir . 'options.scss';

        $this->redux->filesystem->execute( 'put_contents', $_options, array( 
            'content' => $this->options_output()
        ) );
            
        /**
         * build source map
         * this used for load scss file when dev_mode is on
         * @source: https://github.com/leafo/scssphp/wiki/Source-Maps
        */
        $this->scssc->setSourceMap(\Leafo\ScssPhp\Compiler::SOURCE_MAP_FILE);
        if(is_child_theme()){
            $this->scssc->setSourceMapOptions(array(
                'sourceMapWriteTo'  => $child_css_file . ".map",
                'sourceMapURL'      => "child-theme.css.map",
                'sourceMapFilename' => $child_css_file,
                'sourceMapBasepath' => $child_scss_dir,
                'sourceRoot'        => $child_scss_dir,
            ));
        } else {
            $this->scssc->setSourceMapOptions(array(
                'sourceMapWriteTo'  => $css_file . ".map",
                'sourceMapURL'      => "theme.css.map",
                'sourceMapFilename' => $css_file,
                'sourceMapBasepath' => $scss_dir,
                'sourceRoot'        => $scss_dir,
            ));
        }
        // end build source map
        
        /* $this->scssc->setFormatter('Leafo\ScssPhp\Formatter\Nested'); */
        $this->scssc->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
        
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $this->scssc->compile( '@'.'import "theme.scss"' )
        ) );
        if(is_child_theme()){
            $this->redux->filesystem->execute( 'put_contents', $child_css_file, array(
                'content' => $this->scssc->compile( '@'.'import "child-theme.scss"' )
            ) );
        }
    }

    /**
     * Generate options and css files
     */
    function generate_min_file()
    {   
        // Theme
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';
        $css_file = $css_dir . 'theme.min.css';
        // Child Theme
        $child_scss_dir = get_stylesheet_directory() . '/assets/scss/';
        $child_css_dir  = get_stylesheet_directory() . '/assets/css/';
        $child_css_file = $child_css_dir . 'child-theme.min.css';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $_options = $scss_dir . 'options.scss';

        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => $this->options_output()
        ) );
        $this->scssc->setFormatter( 'Leafo\ScssPhp\Formatter\Crunched' );
        
        // Theme
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $this->scssc->compile( '@'.'import "theme.scss"' )
        ) );
        // Child Theme
        if(is_child_theme()){
            $this->redux->filesystem->execute( 'put_contents', $child_css_file, array(
                'content' => $this->scssc->compile( '@'.'import "child-theme.scss"' )
            ) );
        }
    }
    
    /**
     * Generate Editor css files
     */
    function generate_editor_style()
    {   
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/admin/css/';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $editor_file = $css_dir . 'editor.css';
        $admin_file = $css_dir . 'admin.css';
        $this->scssc->setFormatter( 'Leafo\ScssPhp\Formatter\Crunched' );
        
        $this->redux->filesystem->execute( 'put_contents', $editor_file, array(
            'content' => $this->scssc->compile( '@'.'import "editor.scss"' )
        ) );
        $this->redux->filesystem->execute( 'put_contents', $admin_file, array(
            'content' => $this->scssc->compile( '@'.'import "admin.scss"' )
        ) );
    }
    /**
     * Output options to _variables.scss
     *
     * @access protected
     * @return string
     */
    protected function options_output()
    {
        ob_start();
        //Colors
        $primary_color  = 'var(--primary-color)';
        $accent_color  = 'var(--accent-color)';
        $darkent_accent_accent  = 'var(--darkent-accent-color)';
        $lightent_accent_accent  = 'var(--lightent-accent-color)';
        printf('$primary_color:%s;',$primary_color);
        printf('$accent_color:%s;',$accent_color);
        printf('$darkent_accent_accent:%s;',$darkent_accent_accent);
        printf('$lightent_accent_accent:%s;',$lightent_accent_accent);
        printf('$invalid_color:%s;',theclick_configs('invalid_color'));
        printf('$color_red:%s;',theclick_configs('color_red'));
        printf('$color_green:%s;',theclick_configs('color_green'));
        printf('$white:%s;',theclick_configs('white'));
        
        // Theme Color 
        printf('$ef5-colors:(%s);',ef5systems_colors_option_for_scss());
        // Theme Spacings
        printf('$ef5-spacings:(%s);',ef5systems_spacing_option_for_scss());
        // Theme Gutters
        printf('$ef5-gutters:(%s);',ef5systems_gutter_option_for_scss());
        // Typography 
        printf( '$BodyBG: %s;', theclick_configs('body_bg'));
        printf( '$BodyFont: %s;', theclick_configs('body_font'));
        printf( '$BodyFontSize: %s;', theclick_configs('body_font_size'));
        printf( '$BodyLineHeight: %s;',theclick_configs('body_line_height'));
        printf( '$BodyFontSizeL: %s;', theclick_configs('body_font_size_large'));
        printf( '$BodyFontSizeM: %s;', theclick_configs('body_font_size_medium'));
        printf( '$BodyFontSizeS: %s;', theclick_configs('body_font_size_small'));
        printf( '$BodyFontSizeXS: %s;', theclick_configs('body_font_size_xsmall'));
        printf( '$BodyFontSizeXXS: %s;', theclick_configs('body_font_size_xxsmall'));
        printf( '$BodyColor: %s;', theclick_configs('body_font_color'));
        printf( '$H1Size: %s;', theclick_configs('h1_size'));
        printf( '$H2Size: %s;', theclick_configs('h2_size'));
        printf( '$H3Size: %s;', theclick_configs('h3_size'));
        printf( '$H4Size: %s;', theclick_configs('h4_size'));
        printf( '$H5Size: %s;', theclick_configs('h5_size'));
        printf( '$H6Size: %s;', theclick_configs('h6_size'));
        printf( '$HeadingFont: %s;', theclick_configs('heading_font'));
        printf( '$HeadingColor: %s;', theclick_configs('heading_color'));
        printf( '$HeadingColorHover: %s;', theclick_configs('heading_color_hover'));
        printf( '$HeadingFontW: %s;', theclick_configs('heading_font_weight'));
        printf( '$MetaFont : %s;', theclick_configs('meta_font'));
        printf( '$MetaColor: %s;', theclick_configs('meta_color'));
        printf( '$MetaColorHover: %s;', theclick_configs('meta_color_hover'));
        // Border
        printf( '$MainBorder: %s;', theclick_configs('main_border'));
        printf( '$MainBorder2: %s;', theclick_configs('main_border2'));
        printf( '$MainBorderColor: %s;', theclick_configs('main_border_color'));
        // Comments
        printf( '$cmt_avatar_size: %s;', theclick_configs('cmt_avatar_size'));
        printf( '$cmt_border: %s;', theclick_configs('cmt_border'));
        /* Main Menu Height */
        printf('$main_menu_height:%s;', 'var(--main-menu-height)');
        
        /* Header side width */
        $header_sidewidth = theclick_get_theme_opt('header_sidewidth',['width' => apply_filters('theclick_header_sidewidth',theclick_configs('header_sidewidth'))]);
        printf('$header_sidewidth: %s;', esc_attr($header_sidewidth['width']));

        /* menu parent arrow icon after */
        $menu_parent_icon_after = theclick_get_theme_opt('menu_parent_icon_after', '0'); 
        $menu_arrow_icon = 'none';
        $menu_arrow_icon_rtl = 'none';

        if($menu_parent_icon_after == '1'){ 
            $menu_arrow_icon = '\'\00a0\00a0\00a0\f107\'';
            $menu_arrow_icon_rtl = '\'\f107\00a0\00a0\00a0\'';
        }
        printf('$menu_arrow_icon: %s;', esc_attr($menu_arrow_icon));
        printf('$menu_arrow_icon_rtl: %s;', esc_attr($menu_arrow_icon_rtl));

        /* Default Header Color */
        $header_link_color = theclick_get_theme_opt('header_link_colors',apply_filters('theclick_header_link_color', ['regular' => theclick_configs('menu_link_color_regular'), 'hover' => theclick_configs('menu_link_color_hover'), 'active' => theclick_configs('menu_link_color_active')]) );
        printf( '$header_regular: %s;', esc_attr( $header_link_color['regular'] ) );
        printf( '$header_hover: %s;', esc_attr( $header_link_color['hover'] ) );
        printf( '$header_active: %s;', esc_attr( $header_link_color['active'] ) );

        /* Ontop Header Color */
        $ontop_link_color = theclick_get_theme_opt('ontop_link_colors', apply_filters('theclick_ontop_link_color', ['regular' => theclick_configs('ontop_link_color_regular'), 'hover' => theclick_configs('ontop_link_color_hover'), 'active' => theclick_configs('ontop_link_color_active')]) );
        printf( '$ontop_regular: %s;', esc_attr( $ontop_link_color['regular'] ) );
        printf( '$ontop_hover: %s;', esc_attr( $ontop_link_color['hover'] ) );
        printf( '$ontop_active: %s;', esc_attr( $ontop_link_color['active'] ) );

        /* Sticky Header Color */
        $sticky_link_color = theclick_get_theme_opt('sticky_link_colors',apply_filters('theclick_sticky_link_color',['regular' => theclick_configs('sticky_link_color_regular'), 'hover' => theclick_configs('sticky_link_color_hover'), 'active' => theclick_configs('sticky_link_color_active')]));
        printf( '$sticky_regular: %s;', esc_attr( $sticky_link_color['regular'] ) );
        printf( '$sticky_hover: %s;', esc_attr( $sticky_link_color['hover'] ) );
        printf( '$sticky_active: %s;', esc_attr( $sticky_link_color['active'] ) );

        /* Dropdown && Mobile */
        $dropdown_bg_opt = theclick_get_theme_opt('dropdown_bg',['rgba' => apply_filters('theclick_dropdown_bg', theclick_configs('dropdown_bg'))]);
        printf('$dropdown_bg: %s;', esc_attr($dropdown_bg_opt['rgba']));
        $dropdown_link_colors = theclick_get_theme_opt('dropdown_link_colors', apply_filters('theclick_dropdown_link_colors',['regular' => theclick_configs('dropdown_regular'), 'hover' => theclick_configs('dropdown_hover'), 'active' => theclick_configs('dropdown_active')]) );
        printf( '$dropdown_regular: %s;', esc_attr( $dropdown_link_colors['regular'] ) );
        printf( '$dropdown_hover: %s;', esc_attr( $dropdown_link_colors['hover'] ) );
        printf( '$dropdown_active: %s;', esc_attr( $dropdown_link_colors['active'] ) );
  
        /* WooCommerce */
        printf( '$theclick_product_single_image_w: %s;', theclick_configs('theclick_product_single_image_w') );
        printf( '$theclick_product_single_image_h: %s;', theclick_configs('theclick_product_single_image_h') );
        
        printf( '$theclick_product_loop_image_w: %s;', theclick_configs('theclick_product_loop_image_w') );
        printf( '$theclick_product_loop_image_h: %s;', theclick_configs('theclick_product_loop_image_h') );

        printf( '$theclick_product_gallery_thumbnail_w: %s;', theclick_configs('theclick_product_gallery_thumbnail_w') );
        printf( '$theclick_product_gallery_thumbnail_h: %s;', theclick_configs('theclick_product_gallery_thumbnail_h') );

        printf( '$theclick_product_gallery_thumbnail_v_w: %s;', theclick_configs('theclick_product_gallery_thumbnail_v_w') );
        printf( '$theclick_product_gallery_thumbnail_v_h: %s;', theclick_configs('theclick_product_gallery_thumbnail_v_h') );

        printf( '$theclick_product_gallery_thumbnail_h_w: %s;', theclick_configs('theclick_product_gallery_thumbnail_h_w') );
        printf( '$theclick_product_gallery_thumbnail_h_h: %s;', theclick_configs('theclick_product_gallery_thumbnail_h_h') );

        printf( '$theclick_product_gallery_thumbnail_space: %s;', theclick_configs('theclick_product_gallery_thumbnail_space') );


        return ob_get_clean();
    }

    /**
     * Hooked wp_enqueue_scripts - 20
     * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
     */
    function enqueue()
    {
        $css = $this->inline_css();

        if ( $css )
        {
            wp_add_inline_style( 'theclick', $css );
        }
    }

    /**
     * Generate inline css based on theme options
     */
    protected function inline_css()
    {
        ob_start();
        $primary_color = theclick_get_theme_opt( 'primary_color', apply_filters('theclick_primary_color', theclick_configs('primary_color')) );
        $accent_color  = theclick_get_theme_opt( 'accent_color', apply_filters('theclick_accent_color', theclick_configs('accent_color')) );
        $darken_color  = theclick_get_theme_opt( 'darkent_accent_color', apply_filters('theclick_darkent_accent_color', theclick_configs('darkent_accent_color')) );
        $lighten_color  = theclick_get_theme_opt( 'lightent_accent_color', apply_filters('theclick_lightent_accent_color', theclick_configs('lightent_accent_color')) );
        $preset_primary_color = theclick_get_opts( 'primary_color', apply_filters('theclick_primary_color', theclick_configs('primary_color')) );
        $preset_accent_color  = theclick_get_opts( 'accent_color', apply_filters('theclick_accent_color', theclick_configs('accent_color')) );
       

        // Menu links color for options page
        //--------------------------------------------------
        $header_link_colors = theclick_get_page_opt( 'header_link_colors', ['regular' => '', 'hover' => '', 'active' => ''] );
        // menu regular
        if(!empty($header_link_colors['regular'])){
            printf(
                '.menu-default > li > a,
                .header-default a{
                    color: %s!important;
                }',
                esc_attr($header_link_colors['regular'])
            );
            printf(
                '.header-default a:hover{
                    color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
            printf(
                '.header-default a:active,
                .header-default a.active{
                    color: %s!important;
                }',
                esc_attr($header_link_colors['active'])
            );
            // Mobile Menu Icon
            printf(
                '.header-default .btn-nav-mobile:before, 
                .header-default .btn-nav-mobile:after, 
                .header-default .btn-nav-mobile span{
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['regular'])
            );
            printf(
                '.header-default .btn-nav-mobile:hover:before, 
                .header-default .btn-nav-mobile:hover:after, 
                .header-default .btn-nav-mobile:hover span{
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
        }
        // menu hover
        if(!empty($header_link_colors['hover'])){
            printf(
                '.menu-default > li:hover > a,
                .menu-default > li:focus > a,
                .menu-default a:hover,
                .menu-default a:focus,
                .nav-extra .header-icon:hover {
                    color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
            printf(
                '.menu-default > li:hover > a:after,
                .menu-default > li:focus > a:after {
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
        }
        // menu active
        if(!empty($header_link_colors['active'])){
            printf(
                '.menu-default li.current_page_item > a,
                .menu-default li.current-menu-item > a,
                .menu-default li.current_page_ancestor > a,
                .menu-default li.current-menu-ancestor > a,
                .menu-default a:active,
                .nav-extra .header-icon:active {
                    color: %s!important;
                }',
                esc_attr($header_link_colors['active'])
            );
            printf(
                '.menu-default li.current_page_item > a:after,
                .menu-default li.current-menu-item > a:after,
                .menu-default li.current_page_ancestor > a:after,
                .menu-default li.current-menu-ancestor > a:after {
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['active'])
            );
        }
        // OnTop Menu
        $ontop_link_colors = theclick_get_page_opt( 'ontop_link_colors', ['regular' => '', 'hover' => '', 'active' => ''] );
        // menu regular
        if(!empty($ontop_link_colors['regular'])){
            printf(
                '.menu-ontop > li > a{
                    color: %s!important;
                }',
                esc_attr($ontop_link_colors['regular'])
            );
        }
        // menu hover
        if(!empty($ontop_link_colors['hover'])){
            printf(
                '.menu-ontop > li:hover > a,
                .menu-ontop > li:focus > a,
                .menu-ontop a:hover,
                .menu-ontop a:focus,
                .nav-extra .header-icon:hover {
                    color: %s!important;
                }',
                esc_attr($ontop_link_colors['hover'])
            );
            printf(
                '.menu-ontop > li:hover > a:after,
                .menu-ontop > li:focus > a:after {
                    background-color: %s!important;
                }',
                esc_attr($ontop_link_colors['hover'])
            );
        }
        // menu active
        if(!empty($ontop_link_colors['active'])){
            printf(
                '.menu-ontop li.current_page_item > a,
                .menu-ontop li.current-menu-item > a,
                .menu-ontop li.current_page_ancestor > a,
                .menu-ontop li.current-menu-ancestor > a,
                .menu-ontop a:active,
                .nav-extra .header-icon:active {
                    color: %s!important;
                }',
                esc_attr($ontop_link_colors['active'])
            );
            printf(
                '.menu-ontop li.current_page_item > a:after,
                .menu-ontop li.current-menu-item > a:after,
                .menu-ontop li.current_page_ancestor > a:after,
                .menu-ontop li.current-menu-ancestor > a:after {
                    background-color: %s!important;
                }',
                esc_attr($ontop_link_colors['active'])
            );
        }
        /**
         * Header side menu 
         *
        */
        $header_sidewidth = theclick_get_theme_opt('header_sidewidth', ['width' => ''] );
        $header_sidewidth_page = theclick_get_page_opt('header_sidewidth', ['width' => ''] );
        if($header_sidewidth_page['width'] !== 'px' && $header_sidewidth_page['width'] !== $header_sidewidth['width']){
            $header_sidewidth['width'] = $header_sidewidth_page['width'];
        }
        if('' !== $header_sidewidth['width'] && 'px' !== $header_sidewidth['width']){
            echo '@media (min-width: 1200px){';
                printf(
                    'body.header-3:not(.side-header-ontop){
                        padding-%s: %s !important;
                    }', theclick_align(), esc_attr($header_sidewidth['width'])
                );
                //  Header side menu width
                printf(
                    '.side-header{
                        width: %s !important;
                    }', esc_attr($header_sidewidth['width'])
                );
                //  Fix loading position
                printf(
                    'body.header-3 #ef5-loading{
                        margin-%s: calc(%s / -2) !important;
                    }', theclick_align(), esc_attr($header_sidewidth['width'])
                );
            echo '}';
        }
        /**
         * Site Bordered
        */
        $site_layout = theclick_get_opts('site_layout', '');
        $site_bordered = theclick_get_opts('site_bordered_w',['padding-top'=>'30px','padding-right'=>'30px','padding-bottom'=>'30px','padding-left'=>'30px','units'=>'px']);
        $_site_bordered = $site_bordered['padding-top'].' '.$site_bordered['padding-right'].' '.$site_bordered['padding-bottom'].' '.$site_bordered['padding-left'];
        if($site_layout === 'bordered'){
            echo '@media (min-width: 1200px){';
                printf(
                    '.site-bordered{
                        padding: %s !important;
                    }', esc_attr($_site_bordered)
                );
            echo '}';
        }

        return ob_get_clean();
    }
}

new TheClick_CSS_Generator();