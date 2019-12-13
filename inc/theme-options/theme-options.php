<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    //remove_ef5_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}
$opt_name = theclick_get_theme_opt_name();
$theme = wp_get_theme();
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => class_exists('EF5Systems') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'theclick'),
    'page_title'           => esc_html__('Theme Options', 'theclick'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
//    'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => class_exists('EF5Systems') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'theclick'),
    'icon'   => 'el-icon-home',
    'fields' => array_merge(
        theclick_general_opts()
    )
));

/*--------------------------------------------------------------
# Header Top
--------------------------------------------------------------*/
Redux::setSection($opt_name, theclick_header_top_opts());
/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Header', 'theclick'),
    'icon'   => 'el-icon-website',
    'fields' => array_merge(
        theclick_header_opts(),
        theclick_header_theme_opts(),
        theclick_header_atts()
    )
));

Redux::setSection($opt_name, theclick_header_main_logo());
/* Ontop Header */
Redux::setSection($opt_name, theclick_ontop_header_opts());
/* Sticky Header */
Redux::setSection($opt_name, theclick_sticky_header_opts());

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Dropdown & Mobile Menu', 'theclick'),
    'icon'       => 'el-icon-lines',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'dropdown_bg',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Dropdown Background', 'theclick'),
            'subtitle' => esc_html__('Choose dropdown background color', 'theclick'),
            'output'   => array(
                'background-color' => '.oc-header-menu .sub-menu',
            )
        ),
        array(
            'id'          => 'dropdown_text_color',
            'type'        => 'color_rgba',
            'title'       => esc_html__('Text Color', 'theclick'),
            'default'     => '',
            'output'      => array('.oc-header-menu ul'),
        ),
        array(
            'id'    => 'dropdown_link_colors',
            'type'  => 'link_color',
            'title' => esc_html__('Link colors', 'theclick'),
            'output' => array(
                'color' => '.oc-header-menu ul a'
            ),
        ),
    )
));
/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Page Title', 'theclick'),
    'icon'   => 'el-icon-map-marker',
    'fields' => theclick_page_title_opts()
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'theclick'),
    'icon'  => 'el-icon-pencil'
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive', 'theclick'),
    'icon'       => 'el-icon-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'archive_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Widget Position', 'theclick'),
            'subtitle' => esc_html__('Select a sidebar position for blog home, archive, search...', 'theclick'),
            'options'  => theclick_sidebar_position_opts(),
            'default'  => theclick_archive_sidebar_position()
        ),
        array(
            'id'       => 'archive_nav_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Posts Navigation Type', 'theclick'),
            'subtitle' => esc_html__('Set posts navigation type on all archive pages', 'theclick'),
            'options'  => array(
                '1' => esc_html__('Older / Newer', 'theclick'),
                //'2' => esc_html__('Paged', 'theclick'),
                '3' => esc_html__('Paged', 'theclick'),
                '4' => esc_html__('Next / Preview', 'theclick'),
                //'5' => esc_html__('Next / Preview', 'theclick')
            ),
            'default'  => apply_filters('theclick_loop_pagination', '3')
        ),
        array(
            'id'       => 'archive_author_on',
            'title'    => esc_html__('Author', 'theclick'),
            'subtitle' => esc_html__('Show author name on each post.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_date_on',
            'title'    => esc_html__('Date', 'theclick'),
            'subtitle' => esc_html__('Show date posted on each post.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_categories_on',
            'title'    => esc_html__('Categories', 'theclick'),
            'subtitle' => esc_html__('Show category names on each post.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_tags_on',
            'title'    => esc_html__('Tags', 'theclick'),
            'subtitle' => esc_html__('Show tag names on each post.', 'theclick'),
            'type'     => 'switch',
            'default'  => '0',
        ),
        array(
            'id'       => 'archive_comments_on',
            'title'    => esc_html__('Comments', 'theclick'),
            'subtitle' => esc_html__('Show comments count on each post.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_share_on',
            'title'    => esc_html__('Share', 'theclick'),
            'subtitle' => esc_html__('Show share post to some socials network on each post.', 'theclick'),
            'type'     => 'switch',
            'default'  => '0',
        ),
        array(
            'id'       => 'archive_readmore',
            'title'    => esc_html__('Read more', 'theclick'),
            'subtitle' => esc_html__('Show readmore button on archive page.', 'theclick'),
            'type'     => 'switch',
            'default'  => '0',
        )
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Page', 'theclick'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array_merge(
        theclick_page_opts()
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'theclick'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'post_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Layouts', 'theclick'),
            'subtitle' => esc_html__('select a layout for single...', 'theclick'),
            'options'  => theclick_sidebar_position_opts(),
            'default'  => theclick_post_sidebar_position()
        ),
        array(
            'id'       => 'psingle_ptitle_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Layout', 'theclick'),
            'subtitle' => esc_html__('Select a layout for page title.', 'theclick'),
            'options'  => array(
                '1' => get_template_directory_uri() . '/assets/images/page-title/01.png',
                '2' => get_template_directory_uri() . '/assets/images/page-title/02.png',
            ),
            'default'  => '1'
        ),
        array(
            'id'      => 'psingle_ptitle_ontop',
            'type'    => 'button_set',
            'options' => array(
                '1'  => esc_html__('Yes', 'theclick'),
                '0'  => esc_html__('No', 'theclick'), 
            ),
            'title'   => esc_html__('Post Title On Top', 'theclick'),
            'default' => '0'
        ),
        array(
            'id'       => 'post_single_custom_title',
            'title'    => esc_html__('Custom the post single title text', 'theclick'),
            'type'     => 'text',
            'default'  => ''
        ),
        array(
            'id'       => 'post_date_on',
            'title'    => esc_html__('Date', 'theclick'),
            'subtitle' => esc_html__('Show date posted.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_author_on',
            'title'    => esc_html__('Author', 'theclick'),
            'subtitle' => esc_html__('Show author name.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_categories_on',
            'title'    => esc_html__('Categories', 'theclick'),
            'subtitle' => esc_html__('Show category names.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_tags_on',
            'title'    => esc_html__('Tags', 'theclick'),
            'subtitle' => esc_html__('Show tag names.', 'theclick'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_comments_on',
            'title'    => esc_html__('Comments Count', 'theclick'),
            'subtitle' => esc_html__('Show comments count.', 'theclick'),
            'type'     => 'switch',
            'default'  => '0'
        ),
        array(
            'id'       => 'post_share_on',
            'title'    => esc_html__('Share', 'theclick'),
            'subtitle' => esc_html__('Show share post to some socials network on each post.', 'theclick'),
            'type'     => 'switch',
            'default'  => '0',
        ),
        array(
            'id'       => 'post_author_info',
            'title'    => esc_html__('About Author', 'theclick'),
            'subtitle' => esc_html__('Show author bio.', 'theclick'),
            'type'     => 'switch',
            'default'  => '0'
        ),
        array(
            'id'       => 'post_related_on',
            'title'    => esc_html__('Related Post', 'theclick'),
            'subtitle' => esc_html__('Show related post by post tag.', 'theclick'),
            'type'     => 'switch',
            'default'  => '0'
        ),
        array(
            'id'       => 'post_extra_link',
            'type'     => 'button_set',
            'title'    => esc_html__('Extra post link', 'theclick'),
            'subtitle' => esc_html__('Show extra post link', 'theclick'),
            'options'  => array(
                ''        => esc_html__('Default', 'theclick'),
                'recent'  => esc_html__('Recent', 'theclick'),
                'custom'  => esc_html__('Custom', 'theclick'),
            ),
            'default'  => ''
        ),
        array(
            'id'       => 'post_number_extra_link',
            'title'    => esc_html__('Enter the number of recent post for extra link', 'theclick'),
            'type'     => 'text',
            'default'  => '2',
            'required' => array('post_extra_link', '=', 'recent')
        ),
        array(
            'id'       => 'post_extra_post_id',
            'title'    => esc_html__('Enter the id for posts to show, separate by comma (230,231,233...)', 'theclick'),
            'type'     => 'text',
            'default'  => '',
            'required' => array('post_extra_link', '=', 'custom')
        )
    )
));

/*--------------------------------------------------------------
# Portfolio
--------------------------------------------------------------*/
do_action('theclick_portfolio_theme_opts','theclick_portfolio_theme_opts');
/*Redux::setSection($opt_name, array(
    'title'  => esc_html__('Portfolio', 'theclick'),
    'icon'   => 'el el-th',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'portfolio_slug',
            'type'    => 'text',
            'title'   => esc_html__('Portfolio slug rewrite', 'theclick'),
            'default' => esc_html__('portfolio', 'theclick')
        ),
        array(
            'id'      => 'portfolio_page',
            'type'    => 'select',
            'title'   => esc_html__('Portfolio Page', 'theclick'),
            'options' => theclick_list_page(['value' => '-1', 'label' => esc_html__('Archive page','theclick')]),
            'default' => esc_html__('-1', 'theclick')
        ),
    )
));*/
/*--------------------------------------------------------------
# Service
--------------------------------------------------------------*/
//Redux::setSection($opt_name, theclick_service_theme_opts());

/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Colors', 'theclick'),
    'icon'   => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'theclick'),
            'transparent' => false,
        ),
        array(
            'id'          => 'accent_color',
            'type'        => 'color',
            'title'       => esc_html__('Accent Color', 'theclick'),
            'transparent' => false,
        ),
        array(
            'id'          => 'darkent_accent_color',
            'type'        => 'color',
            'title'       => esc_html__('Darkent Accent Color', 'theclick'),
            'transparent' => false,
        ),
        array(
            'id'          => 'lightent_accent_color',
            'type'        => 'color',
            'title'       => esc_html__('Lightent Accent Color', 'theclick'),
            'transparent' => false,
        ) 
    )
));

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'theclick'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'          => 'font_main',
            'type'        => 'typography',
            'title'       => esc_html__('Main Font', 'theclick'),
            'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('body'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h1',
            'type'        => 'typography',
            'title'       => esc_html__('H1', 'theclick'),
            'subtitle'    => esc_html__('Heading 1 typography.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('h1', '.h1'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h2',
            'type'        => 'typography',
            'title'       => esc_html__('H2', 'theclick'),
            'subtitle'    => esc_html__('Heading 2 typography.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('h2', '.h2'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h3',
            'type'        => 'typography',
            'title'       => esc_html__('H3', 'theclick'),
            'subtitle'    => esc_html__('Heading 3 typography.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('h3', '.h3'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h4',
            'type'        => 'typography',
            'title'       => esc_html__('H4', 'theclick'),
            'subtitle'    => esc_html__('Heading 4 typography.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('h4', '.h4'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h5',
            'type'        => 'typography',
            'title'       => esc_html__('H5', 'theclick'),
            'subtitle'    => esc_html__('Heading 5 typography.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('h5', '.h5'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h6',
            'type'        => 'typography',
            'title'       => esc_html__('H6', 'theclick'),
            'subtitle'    => esc_html__('Heading 6 typography.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('h6', '.h6'),
            'units'       => 'px'
        )
    )
));

$custom_font_selectors_1 = Redux::getOption($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Extra Fonts', 'theclick'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_1',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'theclick'),
            'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'theclick'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => $custom_font_selectors_1,
            'units'       => 'px',

        ),
        array(
            'id'       => 'custom_font_selectors_1',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'theclick'),
            'subtitle' => esc_html__('Add css selectors to apply above font.', 'theclick'),
            'validate' => 'no_html'
        )
    )
));

/* Social Media */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Social Media', 'theclick'),
    'desc'       => esc_html__('Add your socials network', 'theclick'),
    'icon'       => 'el el-twitter',
    'subsection' => false,
    'fields'     => array(
        array(
            'id'      => 'social_facebook_url',
            'type'    => 'text',
            'title'   => esc_html__('Facebook URL', 'theclick'), 
            'default' => '',
        ),
        array(
            'id'      => 'social_twitter_url',
            'type'    => 'text',
            'title'   => esc_html__('Twitter URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_pinterest_url',
            'type'    => 'text',
            'title'   => esc_html__('Pinterest URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_dribbble_url',
            'type'    => 'text',
            'title'   => esc_html__('Dribbble URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_inkedin_url',
            'type'    => 'text',
            'title'   => esc_html__('Inkedin URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_rss_url',
            'type'    => 'text',
            'title'   => esc_html__('Rss URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_instagram_url',
            'type'    => 'text',
            'title'   => esc_html__('Instagram URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_google_url',
            'type'    => 'text',
            'title'   => esc_html__('Google URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_skype_url',
            'type'    => 'text',
            'title'   => esc_html__('Skype URL', 'theclick'),
            'default' => '',
        ),
        
        array(
            'id'      => 'social_vimeo_url',
            'type'    => 'text',
            'title'   => esc_html__('Vimeo URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_youtube_url',
            'type'    => 'text',
            'title'   => esc_html__('Youtube URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_yelp_url',
            'type'    => 'text',
            'title'   => esc_html__('Yelp URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tumblr_url',
            'type'    => 'text',
            'title'   => esc_html__('Tumblr URL', 'theclick'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tripadvisor_url',
            'type'    => 'text',
            'title'   => esc_html__('Tripadvisor URL', 'theclick'),
            'default' => '',
        ),
    )
));

/**
 * Social API
 *
 * @author CMSSuperHeroes
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('API', 'theclick'),
    'icon'   => 'dashicons dashicons-share',
    'fields' => array()
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Google Maps', 'theclick'),
    'icon'       => 'dashicons dashicons-googleplus',
    'desc'      => sprintf(__('Click here to <a href="%s" target="_blank">Get your google API key</a>','theclick'), 'https://developers.google.com/maps/documentation/javascript/get-api-key'),
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('API Key', 'theclick'),
            'id'        => 'google_api_key',
            'type'      => 'text',
            'default'   => '',
        )
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Twitter', 'theclick'),
    'icon'       => 'dashicons dashicons-twitter',
    'subsection' => true,
    'fields'     => array(
        
        array(
            'title'     => esc_html__('Consumer Key (API Key)', 'theclick'),
            'id'        => 'twitter_api_consumer_key',
            'type'      => 'text',
            'default'   => 'i90SevLFwZDscXPo3Wj89Y4eO',
        ),
        array(
            'title'     => esc_html__('Consumer Secret (API Secret)', 'theclick'),
            'id'        => 'twitter_api_consumer_secret',
            'type'      => 'text',
            'default'   => '61AmOoAxacZeQneXjCOzKZGRwXwcRFgMsIhhYnQ5JTAOvMdlmL',
        ),
        array(
            'title'     => esc_html__('Access Token', 'theclick'),
            'id'        => 'twitter_api_access_key',
            'type'      => 'text',
            'default'   => '107960275-v9RLlUdpW7xW0wbh0Xtg8X2mVFbaCDtFNAs8vwAc',
        ),
        array(
            'title'     => esc_html__('Access Token Secret', 'theclick'),
            'id'        => 'twitter_api_access_secret',
            'type'      => 'text',
            'default'   => 'VewAXAcJEyDpqlrDfDO40HbRq6rzkYPEHgXz3WNhxAbSv',
        ),
        array(
            'id'        => 'twitter_api_dasboard',
            'type'      => 'info',
            'style'     => 'warning',
            'desc'      => sprintf(__('These details are available in <a href="%s" target="_blank">Your Twitter dashboard</a>','theclick'), 'https://dev.twitter.com/apps')
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Instagram', 'theclick'),
    'icon'       => 'el el-instagram',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('User ID', 'theclick'),
            'desc'      => esc_html__('Ex: https://www.instagram.com/theclick.studio/. Get theclick.studio','theclick'),
            'id'        => 'instagram_api_username',
            'type'      => 'text',
            'default'   => 'theclick.studio'
        ),
        array(
            'title'     => esc_html__('API Key', 'theclick'),
            'subtitle'      => sprintf(__('Generate YOUR Instagram Access Token <a href="%s" target="_blank">Click Here</a>','theclick'), 'http://instagram.pixelunion.net/'),
            'desc'      => esc_html__('Copy and Paste YOUR Instagram Access Token here!','theclick'),
            'id'        => 'instagram_api_key',
            'type'      => 'text',
            'default'   => '25613480134.1677ed0.6f0e0cf4d9934d19bd05c2d8398d2973'
        )
    )
));

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection($opt_name, theclick_footer_opts());

/**
 # WooCommerce
*/
Redux::setSection($opt_name, theclick_woocommerce_theme_opts());

/*--------------------------------------------------------------
# Development
--------------------------------------------------------------*/
$gutenberg_opts = array();
if(!class_exists('Classic_Editor')){
    $gutenberg_opts = array(
        'id'       => 'gutenberg',
        'type'     => 'switch',
        'title'    => esc_html__('Gutenberg Editor', 'theclick'),
        'subtitle' => esc_html__('Choose Default to use default Editor from WordPress or other plugin like Visual Composer, WPBakery Page Builder, Classic Editor,...', 'theclick'),
        'description' => esc_html__('Disable option will remove Gutenberg Editor', 'theclick'),
        'on'       => esc_html__('Default', 'theclick'),
        'off'      => esc_html__('Disable', 'theclick'),
        'default'  => true
    );
}
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Development Tools', 'theclick'),
    'icon'   => 'el-icon-edit',
    'fields' => array(
        $gutenberg_opts,
        array(
            'id'          => 'dev_mode',
            'type'        => 'switch',
            'default'     => false,
            'title'       => esc_html__('Development Mode', 'theclick'),
            'subtitle'    => esc_html__('Not Recommended', 'theclick'),
            'description' => esc_html__('When it is ON, the css will be passed from sccc in all time.', 'theclick'),
        )
    ),
));