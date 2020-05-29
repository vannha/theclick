<?php
/**
 * Template part for displaying the primary menu of the site
 */
$header_menu   = theclick_get_opts('header_menu','');

if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop() || is_product_category() || is_product_tag() || is_singular('product'))) { 
    $woo_header_menu = theclick_get_theme_opt('woo_header_menu','0');
    $header_menu = $woo_header_fullwidth != 'none' ? $woo_header_menu : $header_menu;
}
if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop())) { 
    $woo_header_menu = get_post_meta(get_option('woocommerce_shop_page_id'), 'header_menu', true);
    $header_menu = $woo_header_menu != '-1' ? $woo_header_menu : $header_menu;
}
if('none' === $header_menu) return;
/* Mega Menu */
$megamenu = apply_filters('ef5_enable_megamenu', false);
$args =  array(
    'theme_location' => 'ef5-primary',
    'menu'           => $header_menu,
    'container'      => '',
    'menu_id'        => 'ef5-header-menu',
    'menu_class'     => theclick_header_menu_class(),
    'link_before'	 => '<span class="menu-title">',
    'link_after'	 => '</span>',	
    'walker'         => ($megamenu && class_exists( 'EF5Systems_MegaMenu_Walker' )) ? new EF5Systems_MegaMenu_Walker : new TheClick_Main_Menu_Walker,
    'fallback_cb' =>   'theclick_header_menu_fallback'
);
wp_nav_menu($args);
