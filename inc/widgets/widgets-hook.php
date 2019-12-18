<?php 
/**
 * Custom output HTML of some widget 
*/
/**
 * Widget Categories
 * Custom HTML output
*/
if(!function_exists('theclick_widget_categories_args')){
    add_filter('widget_categories_args', 'theclick_widget_categories_args');
    function theclick_widget_categories_args($cat_args){
        $cat_args['walker'] = new TheClick_Categories_Walker;
        $cat_args['orderby'] = 'count';
        return $cat_args; 
    }
}

/** 
 * Custom Widget Archive 
 * This code filters the Archive widget to include the post count inside the link 
 * @since 1.0.0
*/
if(!function_exists('theclick_get_archives_link_text')){
    add_filter('get_archives_link', 'theclick_get_archives_link_text', 10, 6);
    function theclick_get_archives_link_text($link_html, $url, $text, $format, $before, $after ){
        $text = wptexturize( $text );
        $url  = esc_url( $url );
     
        if ( 'link' == $format ) {
            $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
        } elseif ( 'option' == $format ) {
            $link_html = "\t<option value='$url'>$before $text $after</option>\n";
        } elseif ( 'html' == $format ) {
            $link_html = "\t<li>$before<a href='$url'><span class='title'>$text</span></a>$after</li>\n";
        } else { // custom
            $link_html = "\t$before<a href='$url'><span class='title'>$text</span>$after</a>\n";
        }
        return $link_html;
    }
}

if(!function_exists('theclick_archive_count_span')){
    add_filter('get_archives_link', 'theclick_archive_count_span');
    function theclick_archive_count_span($links) {
        $links = str_replace('<li>', '<li class="ef5-menu-item">', $links);
        $links = str_replace('</a>&nbsp;(', ' <span class="count">', $links);
        $links = str_replace(')</li>', '</span></a></li>', $links);
        return $links;
    }
}

/**
 * Widget Page
 * Custom output HTMl
*/
if(!function_exists('theclick_widget_page_args')){
    add_filter('widget_pages_args', 'theclick_widget_page_args');
    function theclick_widget_page_args($page_args){
        $page_args['walker'] = new TheClick_Page_Walker;
        return $page_args; 
    }
}

/**
 * Widget Navigation
 * Custom HTML Output
 * 
*/
if(!function_exists('theclick_widget_navigation_menu')){
    add_filter('widget_nav_menu_args', 'theclick_widget_navigation_menu');
    function theclick_widget_navigation_menu($nav_menu_args){
        $nav_menu_args['walker'] = new TheClick_Menu_Walker();
        return $nav_menu_args;
    }
}

/**
 * Widget Tag Cloud WP / WooCommerce
 * Change separator text, font size, ...
 * Hook filter: widget_tag_cloud_args, woocommerce_product_tag_cloud_widget_args
*/
if(!function_exists('theclick_widget_tag_cloud_args')){
    add_filter('widget_tag_cloud_args', 'theclick_widget_tag_cloud_args');
    function theclick_widget_tag_cloud_args($args){
        $_args =[
            'smallest'  => '12',
            'largest'   => '12',
            'unit'      => 'px',
            'separator' => ''
        ];
        $args = wp_parse_args($args, $_args);
        return $args;
    }
}
if(!function_exists('theclick_woocommerce_widget_tag_cloud_args')){
    add_filter('woocommerce_product_tag_cloud_widget_args', 'theclick_woocommerce_widget_tag_cloud_args');
    function theclick_woocommerce_widget_tag_cloud_args($args){
        $_args =[
            'smallest'  => '12',
            'largest'   => '12',
            'unit'      => 'px',
            'separator' => ''
        ];
        $args = wp_parse_args($args, $_args);
        return $args;
    }
}