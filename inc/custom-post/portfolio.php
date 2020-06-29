<?php
/**
 * Custom post type Portfolio
 * 
 * This custom make some custom to Portfolio
 *
 */
add_filter( 'ef5_extra_post_types', 'theclick_add_posttype' );
function theclick_add_posttype( $postypes ) {
	$post_types['ef5_portfolio'] = array( 
    	'status'        => true,
		'item_name' => esc_html__('Portfolio', 'theclick'),
		'items_name'          => esc_html__('Portfolios', 'theclick'),
		'args'          => array(
			//'menu_position' => 15,
			'menu_icon'     => 'dashicons-portfolio',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'       => array(
				'slug'       => theclick_get_theme_opt('portfolio_slug','portfolio'), 
				'with_front' => true
            )
        ) 
    );
 
	return $post_types;
}

add_filter( 'cms_extra_taxonomies', 'theclick_add_tax' );
function theclick_add_tax( $taxonomies ) {

	$taxonomies['portfolio_cat'] = array(
		'status'     => true,
		'post_type'  => array( 'ef5_portfolio' ),
		'taxonomy' => esc_html__( 'Portfolio Category', 'theclick' ),
		'taxtheclickmy'   => esc_html__( 'Portfolio Category', 'theclick' ),
		'taxonomies' => esc_html__( 'Portfolio Categories', 'theclick' ),
		'args'       => array(),
		'labels'     => array()
	);

	$taxonomies['portfolio_tag'] = array(
		'status'     => true,
		'post_type'  => array( 'ef5_portfolio' ),
		'taxonomy' => esc_html__( 'Portfolio Tag', 'theclick' ),
		'taxtheclickmy'   => esc_html__( 'Portfolio Tag', 'theclick' ),
		'taxonomies' => esc_html__( 'Portfolio Tags', 'theclick' ),
		'args'       => array(),
		'labels'     => array()
	);
	
	return $taxonomies;
}

//add_filter('ef5_extra_post_type_portfolio', '__return_false');

/*add_filter('ef5_extra_post_types', 'theclick_cpts_portfolio', 10 , 1);
function theclick_cpts_portfolio($post_types) {
	$supported_portfolio = apply_filters('ef5_extra_post_type_portfolio', true);
    if($supported_portfolio) {
	    $post_types['ef5_portfolio'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('Theclick Portfolios', 'portfolio'),
			'singular_name' => esc_html__('Theclick Portfolio', 'portfolio'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-portfolio',
				'rewrite'       => array(
					'slug'       => theclick_get_theme_opt('portfolio_slug','portfolio'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
add_filter('ef5_extra_taxonomies', 'theclick_cpts_tax', 10 , 1);
function theclick_cpts_tax($taxo) {
	$supported_portfolio = apply_filters('ef5_extra_post_type_portfolio', true);
    if($supported_portfolio) {
	    $taxo['portfolio_cat'] = array(
	        'taxonomy'   => esc_html__('Portfolio Category', 'portfolio'),
	        'taxonomies' => esc_html__('Portfolio Categories', 'portfolio'),
	    );
	    $taxo['portfolio_tag'] = array(
	        'taxonomy'   => esc_html__('Portfolio Tag', 'portfolio'),
	        'taxonomies' => esc_html__('Portfolio Tags', 'portfolio'),
	    );
	}
    return $taxo;
}*/