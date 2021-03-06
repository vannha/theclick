<?php
vc_map(array(
    'name'        => 'TheClick Catalog Menu',
    'base'        => 'ef5_catalog_menu',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add product category list with custom link', 'theclick'),
    'icon'        => '',
    'params'      => array(
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','theclick'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1'         => get_template_directory_uri().'/vc_elements/layouts/catalog-menu-1.jpg',
            ),
            'std'        => '1'
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Upload image size','theclick'),
            'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','theclick'),
            'param_name'    => 'thumbnail_size',
            'value'         => '760',
            'std'           => '530',
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Column 2 background", 'theclick'),
            "param_name" => "col2_bg",
            "value"      => "",
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Extra Class','theclick'),
            'param_name' => 'el_class',
            'value'      => '',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick'),
        ),
        array(
            'type'       => 'param_group',
            'heading'    => esc_html__( 'Add catalog items', 'theclick' ),
            'param_name' => 'cl_group_1',
            'value'      =>  urlencode( json_encode( array())),
            'params'     => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Title", 'theclick'),
                    "param_name"    => "title_1",
                    "value"         => '',
                    'admin_label'   => true
                ),
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__( 'Category Image', 'theclick' ),
                    'param_name'  => 'image',
                    'admin_label' => true,
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Link', 'theclick' ),
                    'param_name'  => 'category_link_1'
                ),
                array(
                    'type'       => 'param_group',
                    'heading'    => esc_html__( 'Add catalog child items', 'theclick' ),
                    'param_name' => 'cl_group_2',
                    'value'      =>  urlencode( json_encode( array())),
                    'params'     => array(
                        array(
                            'type'        => 'vc_link',
                            'heading'     => esc_html__( 'Link', 'theclick' ),
                            'param_name'  => 'category_link_2'
                        ),
                    ),
                ),
            ),
            'group'     => 'Catalog'
        ),
    )         
));

class WPBakeryShortCode_ef5_catalog_menu extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
    protected function theclick_catalog_menu_wrap_css_class($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => '',
            'echo'  => true
        ]);
        
        $wrap_css_class = ['ef5-catalog-menu', 'layout-'.$layout_template, $args['class']];

        if($args['echo']){
            echo trim(implode(' ', $wrap_css_class));
        } else {
            return trim(implode(' ', $wrap_css_class));
        }
    }
    
}