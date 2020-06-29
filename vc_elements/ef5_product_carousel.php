<?php
if(!class_exists('WooCommerce')) return;
vc_map(array(
		'name' => 'TheClick Product Carousel',
	    'base' => 'ef5_product_carousel',
	    'icon' => 'icon-wpb-application-icon-large',
	    'category'      => esc_html__('TheClick', 'theclick'),
	    "params" => array_merge(
	        array(
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Title', 'theclick' ),
	                'param_name'  => 'title',
	                'value'       => '',
	            ),
	            array(
	    			'type' => 'dropdown',
	    			'class' => '',
	    			'heading' => esc_html__( 'Type', 'theclick' ),
	    			'param_name' => 'type',
	    			'value' => array(
							esc_html__( 'Best Selling', 'theclick' )          => 'best_selling',
							esc_html__( 'Featured Products', 'theclick' )     => 'featured_product',
							esc_html__( 'Top Rate', 'theclick' )              => 'top_rate',
							esc_html__( 'Recent Products', 'theclick' )       => 'recent_product',
							esc_html__( 'On Sale', 'theclick' )               => 'on_sale',
							esc_html__( 'Recent Review', 'theclick' )         => 'recent_review',
							esc_html__( 'Product Deals', 'theclick' )         => 'deals',
							esc_html__( 'Product separate', 'theclick' )      => 'separate',
	    				),
	    		), 
	            array(
	                'type'       => 'autocomplete',
	                'heading'    => esc_html__( 'Narrow data source', 'theclick' ),
	                'param_name' => 'taxonomies',
	                'settings'   => array(
	                    'multiple'       => true,
	                    'min_length'     => 1,
	                    'groups'         => true,
	                    'unique_values'  => true,
	                    'display_inline' => true,
	                    'delay'          => 500,
	                    'auto_focus'     => true,
	                    'values'         => theclick_get_product_categories_for_autocomplete(),
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
	            ),
	    		array(
	    			'type' => 'textfield',
	    			'class' => '',
	    			'heading' => esc_html__( 'Product id (123,124,135...)', 'theclick' ),
	                'description' => esc_html__( 'Enter the product id separated by commas', 'theclick' ),
	    			'param_name' => 'product_ids',
	    			'value' => '',
	                'dependency' => array(
	                    'element' => 'type',
	                    'value' => array(
	                        'separate',
	                    ),
	                ),
	    		),
	            array(
	    			'type' => 'textfield',
	    			'class' => '',
	    			'heading' => esc_html__( 'Number of products to show', 'theclick' ),
	    			'param_name' => 'number',
	    			'value' => '10',
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
		        ),
		        array(
	                'type'       => 'img',
	                'heading'    => esc_html__('Layout Template','theclick'),
	                'param_name' => 'layout_template',
	                'value' =>  array(
	                    '1' => get_template_directory_uri().'/vc_elements/layouts/product-carousel-layout1.jpg'
	                ),
	                'std'   => '1',
	                'group' => esc_html__('Layouts','theclick'),
	            ),
	        ),
 			array(
	            array(
	                'param_name'  => 'grid_settings',
	                'type'        => 'custom_markup',
	                'value'       => '<strong>'.esc_html__('Carousel Settings','theclick').'</strong>',
	                'std'         => '<strong>'.esc_html__('Carousel Settings','theclick').'</strong>',
	                'group'       => esc_html__('Layouts','theclick'),
	            )
	        ),
	        ef5systems_owl_settings(array(
	            'group'      => esc_html__('Layouts','theclick'), 
	            'param_name' => 'layout_type', 
	            'value'      => 'carousel'
	        )), 
	        array(
	        	array(
	                'type'       => 'dropdown',
	                'param_name' => 'review_ratings',
	                'value'      => array(
	                    esc_html__('Default','theclick')    => '',
	                    esc_html__('Disable','theclick') 	=> 'disable' 
	                ),
	                'std'        => '',
	                'heading'    => esc_html__('Review Ratings','theclick'),
	                'group'      => esc_html__('Post Meta','theclick'),
	            ),
	            array(
	                'type'       => 'dropdown',
	                'param_name' => 'show_shop_more',
	                'value'      => array(
	                    esc_html__('None','theclick')          => 'none',
	                    esc_html__('Select a Page','theclick') => 'page' 
	                ),
	                'std'        => 'none',
	                'heading'    => esc_html__('Show Shop More','theclick'),
	                'group'      => esc_html__('Post Meta','theclick'),
	            ),
	            array(
	                'type'       => 'dropdown',
	                'param_name' => 'shop_more_page',
	                'value'      => ef5systems_vc_list_page(['default' => false]),
	                'std'        => '',
	                'dependency'    => array(
	                    'element'   => 'show_shop_more',
	                    'value'     => 'page',
	                ),
	                'heading'    => esc_html__('Choose a Page for view all!','theclick'),
	                'group'      => esc_html__('Post Meta','theclick'),
	            ),
	            array(
	                'type'       => 'textfield',
	                'param_name' => 'shop_more_text',
	                'value'      => 'Shop More',
	                'std'        => 'Shop More',
	                'dependency'    => array(
	                    'element'   => 'show_shop_more',
	                    'value'     => 'page',
	                ),
	                'heading'    => esc_html__('Shop More Text','theclick'),
	                'group'      => esc_html__('Post Meta','theclick'),
	            ),
	            array(
			        'type'         => 'checkbox',
			        'param_name'   => 'show_number_total',
			        'value'        => array(
			            esc_html__('Show number total','theclick') => '1'
			        ),
			        'std'          => '0',
			        'group'      => esc_html__('Post Meta','theclick'),
			    ), 
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
class WPBakeryShortCode_ef5_product_carousel extends WPBakeryShortCode{
	protected function content($atts, $content = null){
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        $atts['layout_style'] = 'carousel';
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
	}
	 
}
