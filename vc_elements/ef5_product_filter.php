<?php
vc_map(array(
		'name' => 'TheClick Product Filter',
	    'base' => 'ef5_product_filter',
	    'icon' => 'icon-wpb-application-icon-large',
	    'category'      => esc_html__('TheClick', 'theclick'),
	    "params" => array_merge(
	        array(
	        	array(
	                'type'       => 'img',
	                'heading'    => esc_html__('Layout Mode','theclick'),
	                'param_name' => 'layout_template',
	                'value'      =>  array(
	                    '1'          => get_template_directory_uri().'/vc_elements/layouts/product-tabs-layout1.jpg'
	                ),
	                'std'        => '1',
	            ),
	            array(
	                'type'       => 'param_group',
	                'heading'    => esc_html__( 'Add Filter Type', 'theclick' ),
	                'param_name' => 'filter_type',
	                'value'      =>  urlencode( json_encode( array())),
	                'params'     => array(
	                    array(
			                'type'       => 'dropdown',
			                'heading'    => esc_html__('Select Type','theclick'),
			                'param_name' => 'filter_type_item',
			                'value'      =>  array(
			                    esc_html__( 'All Products', 'theclick' )      => 'all',
								esc_html__( 'Best Sellers', 'theclick' )      => 'best_selling',
								esc_html__( 'New Products', 'theclick' )      => 'recent_product',
								esc_html__( 'Sale Products', 'theclick' )     => 'on_sale',
								esc_html__( 'Featured Products', 'theclick' ) => 'featured_product',
								esc_html__( 'Top Rate', 'theclick' )          => 'top_rate',
								esc_html__( 'New Review', 'theclick' )        => 'recent_review',
								esc_html__( 'Product Deals', 'theclick' )     => 'deals'
			                ),
							'std'              => 'all',
							'admin_label'      => true,
							'edit_field_class' => 'vc_col-sm-6'
			            ),
			            array(
			                'type'        => 'textfield',
			                'heading'     => esc_html__( 'Filter Title', 'theclick' ),
			                'param_name'  => 'filter_title_item',
			                'value'       => '',
			            ),
	                     
	                ),
	            ),
	             
	            array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Narrow data source', 'theclick' ),
					'param_name' => 'taxonomies',
					'settings' => array(
						'multiple'       => true,
						'min_length'     => 2,
						'groups'         => true,
						'unique_values'  => true,
						'display_inline' => true,
						'delay'          => 500,
						'auto_focus'     => true,
						'values'   =>  theclick_get_product_categories_for_autocomplete(),
					),
					'description' => esc_html__( 'Enter categories.', 'theclick' ),
				),
	            array(
	                'type'       => 'autocomplete',
	                'heading'    => esc_html__( 'Exclude from Content and filter list', 'theclick' ),
	                'param_name' => 'taxonomies_exclude',
	                'settings'   => array(
	                    'multiple'       => true,
	                    'min_length'     => 2,
	                    'groups'         => true,
	                    'unique_values'  => true,
	                    'display_inline' => true,
	                    'delay'          => 500,
	                    'auto_focus'     => true,
	                    'values'         => theclick_get_product_categories_for_autocomplete(),
	                ),
	                'description' => esc_html__( 'Enter categories won\'t be shown in the content and filters list', 'theclick' ),
	                'admin_label' => true
	            ),
	    		 
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Post per page', 'theclick' ),
	                'param_name'  => 'post_per_page',
	                'value'       => '',
	                'std'           => '8',
	            ),
	            array(
	                'type'          => 'checkbox',
	                'param_name'    => 'show_loadmore',
	                'heading'       => esc_html__( 'Show Load More', 'theclick' ),
	                'std'           => 'true',
	            ), 
	            array(
	                'type'       => 'textfield',
	                'param_name' => 'loadmore_text',
	                'value'      => 'Load More',
	                'std'        => 'Load More',
	                'dependency'    => array(
	                    'element'   => 'show_loadmore',
	                    'value'     => 'true',
	                ),
	                'heading'    => esc_html__('Load More Text','theclick'),
	            ),
	            array(
	                'type'       => 'textfield',
	                'heading'    => esc_html__('Extra Class','theclick'),
	                'param_name' => 'el_class',
	                'value'      => '',
	                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick'),
	            ),
	      		array(
		            'type'        => 'el_id',
		            'settings' => array(
		                'auto_generate' => true,
		            ),
		            'heading'     => esc_html__( 'Element ID', 'theclick' ),
		            'param_name'  => 'el_id',
		            'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'theclick' ), '//w3schools.com/tags/att_global_id.asp' ),
		        )
	        ),
			ef5systems_grid_settings([
                'group'                  => esc_html__('Grid Settings','theclick'),
                'dependency_element'     => 'layout_template', 
                'dependency_value'       => 'value_not_equal_to',
                'dependency_value_value' => ['0']
        	]),
	        array(
	        	array(
		            "type" => "dropdown",
		            "heading" => esc_html__("Column XL Gutter",'theclick'),
		            "param_name" => "column_xl_gutter",
		            "value" => array(
		            	"30px" => "gutter-xl-30",
		            	"40px" => "gutter-xl-40"
	            	),
	            	'std'        => 'gutter-xl-40',
		            "group" => esc_html__("Grid Settings", 'theclick')
		        ),
		         
		        ef5systems_vc_map_add_css_animation([
		            'param_name' => 'css_animation',
		            "group" => esc_html__("Grid Settings", 'theclick')
		        ]), 
	        ),

	        array(
	            array(
	                'type'       => 'css_editor',
	                'heading'    => '',
	                'param_name' => 'css',
	                'value'      => '',
	                'group'      => esc_html__('Design Options','theclick'),
	            )
	        )
	    )
	)
);
class WPBakeryShortCode_ef5_product_filter extends WPBakeryShortCode{
	protected function content($atts, $content = null){
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		wp_enqueue_script('infinite-scroll',get_template_directory_uri().'/assets/js/infinite-scroll.pkgd.min.js',array('jquery'),'3.0.5',true);
	    wp_enqueue_script('slick-js',get_template_directory_uri().'/assets/js/slick.min.js',array('jquery'),'',true);
        wp_enqueue_style('slick-css',get_template_directory_uri().'/assets/css/slick.css');
        return parent::content($atts, $content);
	}
	protected function theclick_products_wrap_css_class($atts){
        extract($atts);

        $css_classes = array(
            'ef5-product-filter-'.$layout_template,
            vc_shortcode_custom_css_class( $css ),
        );

        $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

        echo trim($css_class);
    }
    
}
