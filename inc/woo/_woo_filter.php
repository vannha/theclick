<?php
/**
 * add filter bar
*/
add_action('theclick_woocommerce_before_shop_loop','theclick_woocommerce_filter_bar');
function theclick_woocommerce_filter_bar(){
    $attribute_array = [];
    $attribute_taxonomies = wc_get_attribute_taxonomies();
    if (!empty($attribute_taxonomies)) {
        foreach ($attribute_taxonomies as $tax) {
            if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) {
                $attribute_array[$tax->attribute_name] = $tax->attribute_label;
            }
        }
    }
    $filter_widget_display = theclick_get_theme_opt('filter_widget_display',array());
    ?>

	<div class="ef5-woo-filters-wrap">
    <div class="ef5-woo-filters row gutter-xxxl-50">
		<?php 
        if(!empty($filter_widget_display['enabled'])){
            $filtered_args = [
                'title' => '<h3 class="ef5-heading widgettitle">'.esc_html__('Active Filters','theclick').'</h3>',
                'class' => 'widget widget_layered_nav_filters col-12',
            ];
            theclick_woo_filtered_list($filtered_args);

            do_action('theclick_woocommerce_filter_orderby');

            foreach ($filter_widget_display['enabled'] as $key => $value) {

                if($key == 'category'){
                    $filter_category_args = [
                        'title'           => esc_html__('Categories','theclick'),
                        'show_count'      => true,
                        'hierarchical'    => 0
                    ];
                    the_widget(
                        'WC_Widget_Product_Categories',
                        $filter_category_args,
                        array(
                            'before_widget' => '<div class="widget widget_product_categories col">',
                            'after_widget'  => '</div>',
                            'before_title'  => '<h3 class="ef5-heading widgettitle">',
                            'after_title'   => '</h3>',
                        ) 
                    );
                }
                if($key == 'type'){
                    $filter_type_args = [
                        'title'           => esc_html__('Type','theclick'),
                    ];
                    the_widget(
                        'TheClick_Woo_Filter_Type_Widget',
                        $filter_type_args,
                        array(
                            'before_widget' => '<div class="widget widget_woo_filter_type_filter col">',
                            'after_widget'  => '</div>',
                            'before_title'  => '<h3 class="ef5-heading widgettitle">',
                            'after_title'   => '</h3>',
                        ) 
                    );
                }
                if (!empty($attribute_array)) {
                    foreach ($attribute_array as $tax_key => $tax_value) {
                        if ($tax_key == $key) {
                            $filter_attr_args = [
                                'title'           => esc_html($tax_value),
                                'attribute'       => $tax_key,
                                'display_type'    => 'list',
                                'query_type'      => 'and'
                            ];
                            the_widget(
                                'WC_Widget_Layered_Nav',
                                $filter_attr_args,
                                array(
                                    'before_widget' => '<div class="widget widget_layered_nav col">',
                                    'after_widget'  => '</div>',
                                    'before_title'  => '<h3 class="ef5-heading widgettitle">',
                                    'after_title'   => '</h3>',
                                ) 
                            );
                        }
                    }
                }
                if($key == 'rating'){
                    $filter_rating_args = [
                        'title'           => esc_html__('Average Rating','theclick'),
                    ];
                    the_widget(
                        'WC_Widget_Rating_Filter',
                        $filter_rating_args,
                        array(
                            'before_widget' => '<div class="widget widget_rating_filter col">',
                            'after_widget'  => '</div>',
                            'before_title'  => '<h3 class="ef5-heading widgettitle">',
                            'after_title'   => '</h3>',
                        ) 
                    );
                }
                if($key == 'price'){
                    $filter_by_price_args = [
                        'title'           => esc_html__('Filter by Price','theclick'),
                    ];
                    the_widget(
                        'WC_Widget_Price_Filter',
                        $filter_by_price_args,
                        array(
                            'before_widget' => '<div class="widget widget_price_filter col">',
                            'after_widget'  => '</div>',
                            'before_title'  => '<h3 class="ef5-heading widgettitle">',
                            'after_title'   => '</h3>',
                        ) 
                    );
                }
            }
        }
        ?>
	</div>
    </div>
<?php
}