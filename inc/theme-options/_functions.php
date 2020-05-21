<?php 
/**
 * Get Page List 
 * @return array
*/
if(!function_exists('theclick_list_page')){
    function theclick_list_page($default = []){
        $page_list = array();
        if(!empty($default))
            $page_list[$default['value']] = $default['label'];
        $pages = get_pages(array('hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->post_name] = $page->post_title;
        }
        return $page_list;
    }
}

/**
 * Get Post List
 * @return array
*/
if(!function_exists('theclick_list_post')){
    function theclick_list_post($post_type = 'post', $default = false){
        $post_list = array();
        if($default){
            $post_list['none'] = esc_html__('None','theclick');
            $post_list['-1']   = esc_html__('Default','theclick');
        }
        $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1'));
        foreach($posts as $post){
            $post_list[$post->post_name] = $post->post_title;
        }
        return $post_list;
    }
}

/**
 * Get post thumbnail as image options
 * @return array
 *
*/
function theclick_list_post_thumbnail($post_type = 'post', $default = false){
    $layouts = [];
    if($default){
        $layouts['-1'] = get_template_directory_uri() . '/assets/images/default.png';
    }
    $layouts['none'] = get_template_directory_uri() . '/assets/images/none.png';
    $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1','orderby' => 'date', 'order' => 'ASC'));
    foreach($posts as $post){
        $layouts[$post->post_name] = [
            'alt' => get_the_title($post->ID),
            'img' =>  get_the_post_thumbnail_url($post->ID, 'full')
        ];
    }
    return $layouts;
}

/**
 * get list menu.
 * @return array
 */
if(!function_exists('theclick_get_nav_menu')){
    function theclick_get_nav_menu($args = []){
        $args = wp_parse_args($args, [
            'default' => false, 
            'none'    => false
        ]);
        $menus = array(
            '0' => esc_html__('Primary Menu','theclick')
        );
        $obj_menus = wp_get_nav_menus();
        if($args['default']) $menus['-1'] = esc_html__('Default','theclick');
        if($args['none']) $menus['none'] = esc_html__('None','theclick');

        foreach ($obj_menus as $obj_menu){
            $menus[$obj_menu->slug] = $obj_menu->name;
        }
        return $menus;
    }
}
/**
 * Get list of user by user role for post options
 * 
 * @param $user_role
*/
function theclick_list_user_by_role_for_opts($args = []){
    $args = wp_parse_args($args, [
        'role'    => 'subcrible',
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    ]);
    $users = get_users( $args );
    $options = [];
    foreach ( $users as $user ) {
        $options[$user->user_email] = $user->display_name;
    }
    return $options;
}
/**
 * Get RevSlider List 
 * @return array
*/
if(!function_exists('theclick_get_list_rev_slider')){
    function theclick_get_list_rev_slider() {
        if (class_exists('RevSlider')) {
            $slider = new RevSlider();
            $arrSliders = $slider->getArrSliders();
            $revsliders = array();
            if ($arrSliders) {
                foreach ($arrSliders as $slider) {
                    /* @var $slider RevSlider */
                    $revsliders[$slider->getAlias()] = $slider->getTitle();
                }
            }
            return $revsliders;
        }
    }
}

/**
 * Get Contact Form 7 List
 * @return array
*/
if(!function_exists('theclick_get_list_cf7')){
    function theclick_get_list_cf7($defaule = false) {
        if(!class_exists('WPCF7')) return;
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        $contact_forms = array();
        if($defaule){
            $contact_forms['-1'] = esc_html__('Default From Theme Option','theclick');
        }

        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->post_title;
        }
        
        return $contact_forms;
    }
}
if( !function_exists('theclick_woo_filter_widget_opts')){
    function theclick_woo_filter_widget_opts(){
        if(!class_exists('WooCommerce')) return array();
        
        $attribute_taxonomies = wc_get_attribute_taxonomies();
        $opts = array(
            'category'  => esc_html__( 'Category', 'theclick' )
        );
        if (!empty($attribute_taxonomies)) {
            foreach ($attribute_taxonomies as $tax) {   
                $opts[$tax->attribute_name] = $tax->attribute_label;
            }
        }
        $opts['rating'] = esc_html__( 'Rating', 'theclick' );
        $opts['price']  = esc_html__( 'Price', 'theclick' );
        return $opts;
    }
}
 
function theclick_shop_sidebar_position(){
    return apply_filters('theclick_shop_sidebar_position','right');
}

function theclick_product_sidebar_position(){
    return apply_filters('theclick_product_sidebar_position','right');
} 