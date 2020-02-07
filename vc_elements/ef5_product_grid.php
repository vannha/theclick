<?php
vc_map(array(
		'name' => 'TheClick Product Grid',
	    'base' => 'ef5_product_grid',
	    'icon' => 'icon-wpb-application-icon-large',
	    'category'      => esc_html__('TheClick', 'theclick'),
	    "params" => array_merge(
	        array(
	        	array(
	                'type'       => 'img',
	                'heading'    => esc_html__('Layout Mode','theclick'),
	                'param_name' => 'layout_template',
	                'value'      =>  array(
	                    '1'          => get_template_directory_uri().'/vc_elements/layouts/product-layout1.jpg',
	                    '2'          => get_template_directory_uri().'/vc_elements/layouts/product-layout2.jpg'
	                ),
	                'std'        => '1',
	            ),
	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Title', 'theclick' ),
	                'param_name'  => 'title',
	                'value'       => '',
	                'dependency'    => array(
	                    'element'   => 'layout_template',
	                    'value'     => '2',
	                ),
	            ),
	            array(
	                'type'       => 'textarea',
	                'heading'    => esc_html__('Text', 'theclick'),
	                'param_name' => 'desc_text',
	                'value'      => '',
	                'dependency'    => array(
	                    'element'   => 'layout_template',
	                    'value'     => '2',
	                ),
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
	                'std'           => '8',
	            ),
	             
	            array(
	                'type'       => 'dropdown',
	                'param_name' => 'pagination',
	                'value'      => array(
						esc_html__('None','theclick')              => 'none',
						esc_html__('Pagination','theclick')        => 'pagin',
						esc_html__('View all page','theclick') 	   => 'view_all',
						esc_html__('Load More','theclick')         => 'loadmore',
	                ),
	                'std'        => 'none',
	                'heading'    => esc_html__('Pagination','theclick'),
	            ),
	            array(
	                'type'       => 'dropdown',
	                'param_name' => 'view_all_page',
	                'value'      => ef5systems_vc_list_page(['default' => false]),
	                'std'        => '',
	                'dependency'    => array(
	                    'element'   => 'pagination',
	                    'value'     => 'view_all',
	                ),
	                'heading'    => esc_html__('Choose a Page for view all!','theclick'),
	            ),
	            array(
	                'type'       => 'textfield',
	                'param_name' => 'view_all_text',
	                'value'      => 'View All',
	                'std'        => 'View All',
	                'dependency'    => array(
	                    'element'   => 'pagination',
	                    'value'     => 'view_all',
	                ),
	                'heading'    => esc_html__('View All Text','theclick'),
	            ),
	            array(
	                'type'       => 'textfield',
	                'param_name' => 'loadmore_text',
	                'value'      => 'Load More',
	                'std'        => 'Load More',
	                'dependency'    => array(
	                    'element'   => 'pagination',
	                    'value'     => 'loadmore',
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
class WPBakeryShortCode_ef5_product_grid extends WPBakeryShortCode{
	protected function content($atts, $content = null){
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	    wp_enqueue_script('slick-js',get_template_directory_uri().'/assets/js/slick.min.js',array('jquery'),'',true);
        wp_enqueue_style('slick-css',get_template_directory_uri().'/assets/css/slick.css');
        return parent::content($atts, $content);
	}
	protected function theclick_products_wrap_css_class($atts){
        extract($atts);

        $css_classes = array(
            'ef5-product-grid-'.$layout_template,
            vc_shortcode_custom_css_class( $css ),
        );

        $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

        echo trim($css_class);
    }
    protected function view_all($atts = ''){
        extract($atts);
        if($pagination !== 'view_all') return;
        ?>
            <div class="view-all-wrap text-center">
                <a href="<?php echo get_permalink($view_all_page);?>" class="ef5-btn outline"><?php echo esc_html($view_all_text);?></a>
            </div>
        <?php
    }
    protected function loadmore($atts = ''){
        extract($atts);
        if($pagination !== 'loadmore') return;
        ?>
        	<div class="loadmore text-center"><div class="cms_pagination grid-loadmore"></div></div>
        <?php
    }
}
