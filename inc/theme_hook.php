<?php
/**
 * Primary Color 
 * use filter: 'theclick_primary_color';
 * @return string
 * @example add_filter('theclick_primary_color', function(){ return '#000000';});
*/
/**
 * Accent Color 
 * use filter : theclick_accent_color
 * @return string
 * @example add_filter('theclick_accent_color', function(){ return '#25d6a2';});
*/

/**
 * Page CSS Class
 * use filter: theclick_page_css_class
 * @return array
 * @example add_filter('theclick_page_css_class', function($cls) { $cls[] = 'yout-css-class';  return $cls;});
*/

/**
 * Header link color, 
 * use filter: theclick_header_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('theclick_header_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/
/**
 * Header OnTop link color, 
 * use filter: theclick_ontop_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('theclick_ontop_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Header Sticky link color, 
 * use filter: theclick_sticky_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('theclick_sticky_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Dropdown Background color, 
 * use filter: theclick_dropdown_bg
 * 
 * @return string
 * @example add_filter('theclick_dropdown_bg', function(){ return 'rgba(#000000, 1)';})
*/

/**
 * Dropdown link color, 
 * use filter: theclick_dropdown_link_colors
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('theclick_dropdown_link_colors', function(){ return ['regular' => 'white', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Logo Size
 * use filter: theclick_logo_size
 * @return array(width, height, units)
 * @example add_filter('theclick_logo_size', function() { return ['width' => '130', 'height' => '51', 'units' => 'px'];});
*/

/**
 * Show Default Post thumbnail
 * use filter : theclick_default_post_thumbnail
 * @return bool
 * @default false
 * @example add_filter('theclick_default_post_thumbnail', function(){ return false;});
*/
add_filter('theclick_default_post_thumbnail', function(){ return theclick_configs('theclick_default_post_thumbnail');});

/**
 * Default sidebar position 
 * use filter: theclick_archive_sidebar_position
 * @return string left / right / none
 * @example add_filter('theclick_archive_sidebar_position', function(){ return 'right';});
*/
add_filter('theclick_archive_sidebar_position', function(){ return 'bottom';});
/**
 * Default Archive grid columns
 * use filter : theclick_archive_grid_col
 * @return string 1 - 12
 * @example add_filter('theclick_archive_grid_col', function(){ return '8';});
*/

/**
 * Default Archive Pagination
 * use filter: theclick_loop_pagination
 * @return string 1 - 5
 * @example: add_filter('theclick_loop_pagination', function(){ return '3';});
*/

/**
 * Default Archive Pagination Prev Text
 * use filter: theclick_loop_pagination_prev_text
 * @return string 
 * @example: add_filter('theclick_loop_pagination_prev_text', function(){ return esc_html__('Previous', 'theclick');});
*/

/**
 * Default Archive Pagination Next Text
 * use filter: theclick_loop_pagination_next_text
 * @return string 
 * @example: add_filter('theclick_loop_pagination_next_text', function(){ return esc_html__('Next', 'theclick');});
*/

/**
 * Default Archive Pagination Sep Text
 * use filter: theclick_loop_pagination_sep_text
 * @return string 
 * @example: add_filter('theclick_loop_pagination_sep_text', function(){ return '<span class="d-none"></span>';});
*/

/**
 * Show post related by taxonomy
 * use filter: theclick_post_related_by
 * @return string
 * @default cat
 * @example add_filter('theclick_post_related_by', function(){return 'cat';});
*/

/**
 * Remove Supported post type for VC Element 
 * use filter : theclick_vc_post_type_list 
 * @return array
 * @example add_filter('theclick_vc_post_type_list', function($post_type){ $post_type[] = 'ef5_header_top'; return $post_type;});
*/

// Support Portfolio or Not
add_filter('theclick_cpts_portfolio',function(){ return true;});
// Support header Top
add_filter('theclick_cpts_header_top', function(){ return true;});
// Support Footer Top
add_filter('theclick_cpts_footer', function(){ return true;});

/**
 * Custom WooCommerce
 * Custom single images, loop images, gallery thumbnail, cart thumbnail size
 * 
*/
/**
 * WooCommerce loop thumbnail size
 * use filter: 
 * width: theclick_product_loop_image_w
 * height: theclick_product_loop_image_h
 * @return string
 * @example 
 * widht : apply_filters('theclick_product_loop_image_w', funtion(){ return '400';});
 * height : apply_filters('theclick_product_loop_image_h', funtion(){ return '400';});
*/

/**
 * WooCommerce single thumbnail size
 * use filter: 
 * width: theclick_product_single_image_w
 * height: theclick_product_single_image_h
 * @return string
 * @example 
 * widht : apply_filters('theclick_product_single_image_w', funtion(){ return '600';});
 * height : apply_filters('theclick_product_single_image_h', funtion(){ return '600';});
*/

/**
 * WooCommerce gallery thumbnail size
 * use filter: 
 * width: theclick_product_gallery_thumbnail_w
 * height: theclick_product_gallery_thumbnail_h
 * @return string
 * @example 
 * widht : apply_filters('theclick_product_gallery_thumbnail_w', funtion(){ return '100';});
 * height : apply_filters('theclick_product_gallery_thumbnail_h', funtion(){ return '100';});
*/

/**
 * WooCommerce cart thumbnail size
 * use filter: 
 * size: theclick_woocommerce_cart_item_thumbnail_size
 * @return string
 * @example 
 * size : apply_filters('theclick_woocommerce_cart_item_thumbnail_size', funtion(){ return '100x100';});
 * 
*/

/**
 * Add your theme spacing
*/
add_filter('ef5systems_spacings','theclick_spacings');
function theclick_spacings(){
	return [
		'custom1 pt-8 pb-8' => ['OverCome Space 01', 'Top 8px - Bottom 8px'],
		'87-0-92'          	=> ['OverCome Space 02', 'Top 87px - Bottom 92px', '87px 0 92px 0'],
		'93-0-100'          => ['OverCome Space 03', 'Top 93px - Bottom 100px', '93px 0 100px 0'],
		'100-0'             => ['OverCome Space 04', 'Top 100px - Bottom 100px', '100px 0'],
	];
}

/**
 * Add your theme Gutter
*/
add_filter('ef5systems_gutters','theclick_gutters');
function theclick_gutters(){
	return [
		'20' => [
			'title' => 'OverCome Gutter 20', 
			'desc'  => '',
			'key'   => '20',
			'value' => '20px'
		]
	];
}

/**
 * Add your theme Color
*/
add_filter('ef5systems_colors','theclick_colors');
function theclick_colors(){
	return [
		'overlay' => ['Overlay Background', 'rgba(0,0,0,0.5)'],
		'ababab' => ['OverCome Color 01', '#ababab'],
		'f5f5f5' => ['OverCome Color 02', '#f5f5f5'],
	];
}

/**
 * Custom OWL Nav Style
*/
add_filter('ef5systems_carousel_custom_nav_style', 'theclick_owl_custom_nav_style');
function theclick_owl_custom_nav_style(){
	return [
		esc_html__('Overcome Style 01','theclick') => 'theclick-1'
	];
}
