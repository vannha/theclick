<?php
vc_map(array(
		'name' => 'TheClick Product Grid',
	    'base' => 'ef5_products',
	    'icon' => 'icon-wpb-application-icon-large',
	    'category'      => esc_html__('TheClick', 'theclick'),
	    "params" => array(
	        array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','theclick'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'          => get_template_directory_uri().'/vc_elements/layouts/red-grid-product-layout1.jpg',
                    '2'          => get_template_directory_uri().'/vc_elements/layouts/red-grid-product-layout2.jpg',
                ),
                'std'        => '1',
            ),
            array(
				'type' => 'autocomplete',
				'heading' => esc_html__( 'Narrow data source', 'theclick' ),
				'param_name' => 'taxonomies',
				'settings' => array(
					'multiple' => true,
					'min_length' => 2,
					'groups' => true,
					'unique_values' => true,
					'display_inline' => true,
					'delay' => 500,
					'auto_focus' => true,
					'values'   =>  theclick_get_product_categories_for_autocomplete(),
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => esc_html__( 'Enter categories.', 'theclick' ),
			),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Post per page', 'theclick' ),
                'param_name'  => 'post_per_page',
                'value'       => '',
            ),
	        array(
                'type'          => 'checkbox',
                'param_name'    => 'show_pagination',
                'value'         => array(
                    esc_html__( 'Show Pagination', 'theclick' ) => '1'
                ),
                'std'           => '1',
                'group'         => esc_html__('Post Meta','theclick')
            ),
	        array(
	            'type' => 'checkbox',
	            'heading' => esc_html__("Alignment Center", 'theclick'),
	            'param_name' => 'align_center',
	            'value' => array(
	                'Yes' => true
	            ),
	            'std' => false,
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
	            "type" => "dropdown",
	            "heading" => esc_html__("Layout Type",'theclick'),
	            "param_name" => "layout",
	            "value" => array(
	            	"Basic" => "basic",
	            	"Masonry" => "masonry",
	            	),
	            "group" => esc_html__("Grid Settings", 'theclick')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Columns XS Devices",'theclick'),
	            "param_name" => "col_xs",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 1,
	            "group" => esc_html__("Grid Settings", 'theclick')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Columns SM Devices",'theclick'),
	            "param_name" => "col_sm",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 2,
	            "group" => esc_html__("Grid Settings", 'theclick')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Columns MD Devices",'theclick'),
	            "param_name" => "col_md",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 3,
	            "group" => esc_html__("Grid Settings", 'theclick')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Columns LG Devices",'theclick'),
	            "param_name" => "col_lg",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 4,
	            "group" => esc_html__("Grid Settings", 'theclick')
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => esc_html__("Filter on Masonry",'theclick'),
	            "param_name" => "filter",
	            "value" => array(
	            	"Enable" => "true",
	            	"Disable" => "false"
	            	),
	            "dependency" => array(
	            	"element" => "layout",
	            	"value" => "masonry"
	            	),
	            "group" => esc_html__("Grid Settings", 'theclick')
	        )
	    )
	)
);
class WPBakeryShortCode_ef5_products extends WPBakeryShortCode{
	protected function content($atts, $content = null){
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
	}
	protected function theclick_products_wrap_css_class($atts){
        extract($atts);
        /* get value for Design Tab */
        $css_classes = array(
            'ef5-products-'.$layout_template,
            vc_shortcode_custom_css_class( $css ),
        );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

        echo trim($css_class);
    }
}
