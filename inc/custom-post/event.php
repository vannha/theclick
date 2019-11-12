<?php
/**
 * Custom post type Event
 * 
 * This custom make some custom to Event
 *
 */
add_filter('ef5_extra_post_type_event', '__return_false');

//add_filter('ef5_extra_post_types', 'theclick_cpts_event', 10 , 1);
function theclick_cpts_event($post_types) {
	$supported_event = apply_filters('ef5_extra_post_type_event', false);
    if($supported_event) {
	    $post_types['ef5_event'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('TheClick Events', 'theclick'),
			'singular_name' => esc_html__('TheClick Event', 'theclick'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-universal-access-alt',
				'rewrite'       => array(
					'slug'       => theclick_get_theme_opt('event_slug','ef5_event'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
//add_filter('ef5_extra_taxonomies', 'theclick_cpts_event_tax', 10 , 1);
function theclick_cpts_event_tax($taxo) {
	$supported_event = apply_filters('ef5_extra_post_type_event', false);
    if($supported_event) {
	    $taxo['event_cat'] = array(
	    	'status'     => true,
    		'post_type'  => array('ef5_event'),
	        'taxonomy'   => esc_html__('Category', 'theclick'),
	        'taxonomies' => esc_html__('Categories', 'theclick'),
	        'args'       => array(),
        	'labels'     => array()
	    );
	    $taxo['event_tag'] = array(
	    	'status'     => true,
	    	'post_type'  => array('ef5_event'),
	        'taxonomy'   => esc_html__('Tag', 'theclick'),
	        'taxonomies' => esc_html__('Tags', 'theclick'),
	        'args'       => array(
	        	'hierarchical' => false,
	        ),
        	'labels'     => array()
	    );
	}
    return $taxo;
}

// Support Payment 
add_filter('ef5payments_post_type_support','ef5payments_post_type_event');
add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_event');
add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_event');

function ef5payments_post_type_event($post_type){
	$post_type[] = 'ef5_event';
	return $post_type;
}