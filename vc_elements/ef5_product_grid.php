<?php
vc_map(array(
		'name' => 'TheClick Product Grid',
	    'base' => 'ef5_product_grid',
	    'icon' => 'icon-wpb-application-icon-large',
	    'category'      => esc_html__('TheClick', 'theclick'),
	    "params" => array(
	        array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','theclick'),
                'param_name' => 'layout_mode',
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
	            'type' => 'checkbox',
	            'heading' => esc_html__("Show Read More", 'theclick'),
	            'param_name' => 'show_read_more',
	            'value' => array(
	                'Yes' => true
	            ),
	            'std' => false,
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
class WPBakeryShortCode_ef5_product_grid extends WPBakeryShortCode{
	protected function content($atts, $content = null){
		global $wp_query,$post;
		$atts_extra = shortcode_atts(array(
            'col_lg' => 4,
            'col_md' => 3,
            'col_sm' => 2,
            'col_xs' => 1,
            'layout' => 'basic',
            'filter' => 'true',
            'class' => '',
        ), $atts);
		$atts = array_merge($atts_extra, $atts);

		//media script
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement' );
		 
        $html_id = cmsHtmlID('cms-grid');

        if (get_query_var('paged')){ 
        	$paged = get_query_var('paged'); 
        }
	    elseif(get_query_var('page')){ 
	    	$paged = get_query_var('page'); 
	    }
	    else{ 
	    	$paged = 1; 
	    }
	    $tax_query = array();
	    $select_terms = array();
        if ( ! empty( $atts['taxonomies'] ) ) {

 			$terms = get_terms( array(
			    'taxonomy' => 'product_cat',
			    'hide_empty' => false,
			) );
			 
 			$elected_taxs = explode(',', str_replace(' ','',$atts['taxonomies'])); 
 			 
	        foreach ( $terms as $t ) {	
	        	if(in_array($t->slug,$elected_taxs)){
	        		$select_terms[] = $t; 
	        	}
	        }
	        $tax_query = array(
		        array(
		            'taxonomy' => 'product_cat',
		            'field'    => 'slug',
		            'terms'    => $elected_taxs,
		        ),
		    );
 
        }
       
       $post_per_page = isset($atts['post_per_page']) ? $atts['post_per_page'] : 16;
       if(intval($post_per_page) > 0) $size = $post_per_page;
       else $size = -1;
        $args = array(
            'posts_per_page' => $size,
            'post_type' => 'product',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1,
            'tax_query' => $tax_query,
        );
        
        $wp_query = new WP_Query( $args );

	    if($paged > 1){
	    	$args['paged'] = $paged;
	    	$wp_query = new WP_Query($args);
	    }

        $atts['cat'] = $select_terms;
        $atts['limit'] = isset($args['posts_per_page'])?$args['posts_per_page']:5;
        /* get posts */
        $atts['posts'] = $wp_query;
        
        
        $col_lg = 12 / $atts['col_lg'];
        $col_md = 12 / $atts['col_md'];
        $col_sm = 12 / $atts['col_sm'];
        $col_xs = 12 / $atts['col_xs'];

        $align_center = (isset($atts['align_center']) && $atts['align_center']) ? 'text-center' : '';
        $atts['item_class'] = "cms-grid-item {$align_center} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
        $atts['grid_class'] = "cms-grid-products";
        if ($atts['layout'] == 'masonry') {
            wp_enqueue_script('cms-jquery-shuffle');
            $atts['grid_class'] .= " cms-grid-{$atts['layout']}";
        }
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
	}
}

?>