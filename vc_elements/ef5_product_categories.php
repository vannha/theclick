<?php
if(!class_exists('WooCommerce')) return;
vc_map(array(
		'name' => 'TheClick Product Categories',
	    'base' => 'ef5_product_categories',
	    'icon' => 'icon-wpb-application-icon-large',
	    'category'      => esc_html__('TheClick', 'theclick'),
	    "params" => array(  
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
	            'type'          => 'textfield',
	            'heading'       => esc_html__('Image size','theclick'),
	            'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','theclick'),
	            'param_name'    => 'image_size',
	            'value'         => '',
	            'std'           => '',
	            'group'      => esc_html__('Media', 'theclick')
	        ),    
	    )
	)
);
class WPBakeryShortCode_ef5_product_categories extends WPBakeryShortCode{
	protected function content($atts, $content = null){
		 
        return parent::content($atts, $content);
	}
}
