<?php

/**
 * Add custom post type Header Top
 *
 * This custom post used for build Header Top section
 *
*/
add_filter('ef5_extra_post_types', 'theclick_cpts_header_top');
function theclick_cpts_header_top($post_types)
{   
    $post_types['ef5_header_top'] = array( 
        'status'        => true,
        'name'     => esc_html__('Header Top', 'theclick'),
        'singular_name'    => esc_html__('Headers Top', 'theclick'),
        'args'          => array(
            'description'         => 'Add custom Header Top Layout ',
            'public'              => true,
            'publicly_queryable'  => false,
            'show_ui'             => true,
            'show_in_rest'        => false,
            'rest_base'           => '',
            'has_archive'         => false,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'exclude_from_search' => true,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'hierarchical'        => false,
            'rewrite'             => false,
            'query_var'           => true,
            'menu_position'       => 20,
            'menu_icon'           => 'dashicons-editor-insertmore',
            'supports'            => array( 'title', 'editor','thumbnail' ),
        )
    );
   
    return $post_types;
}


/**
 * Add custom post type Footer 
 * 
 * This custom post used for build Footer Top section
 *
 */
add_filter('ef5_extra_post_types', 'theclick_cpts_footer');
function theclick_cpts_footer($post_types) {
    $post_types['ef5_footer'] = array( 
        'status'        => true,
        'name' => esc_html__('Footer', 'theclick'),
        'singular_name'          => esc_html__('Footers', 'theclick'),
        'args'          => array(
            'menu_icon'     => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
            ),
            'public'             => true,
            'has_archive'         => false,
            'publicly_queryable' => true,
            'rewrite'             => false,
        ) 
    );
    return $post_types;    
}
