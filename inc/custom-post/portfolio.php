<?php
/**
 * Custom post type Portfolio
 * 
 * This custom make some custom to Portfolio
 *
 */
add_filter('ef5_extra_post_type_portfolio', '__return_false');

add_filter('ef5_extra_post_types', 'theclick_cpts_portfolio', 10 , 1);
function theclick_cpts_portfolio($post_types) {
	$supported_portfolio = apply_filters('ef5_extra_post_type_portfolio', false);
    if($supported_portfolio) {
	    $post_types['ef5_portfolio'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('TheClick Portfolios', 'theclick'),
			'singular_name' => esc_html__('TheClick Portfolio', 'theclick'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-portfolio',
				'rewrite'       => array(
					'slug'       => theclick_get_theme_opt('portfolio_slug','theclick'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
add_filter('ef5_extra_taxonomies', 'theclick_cpts_portfolio_tax', 10 , 1);
function theclick_cpts_portfolio_tax($taxo) {
	$supported_portfolio = apply_filters('ef5_extra_post_type_portfolio', false);
    if($supported_portfolio) {
	    $taxo['portfolio_cat'] = array(
	        'taxonomy'   => esc_html__('Category', 'theclick'),
	        'taxonomies' => esc_html__('Categories', 'theclick'),
	    );
	    $taxo['portfolio_tag'] = array(
	        'taxonomy'   => esc_html__('Tag', 'theclick'),
	        'taxonomies' => esc_html__('Tags', 'theclick'),
	    );
	}
    return $taxo;
}