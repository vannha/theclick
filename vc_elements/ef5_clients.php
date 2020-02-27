<?php
vc_map(array(
    'name'        => 'TheClick Clients',
    'base'        => 'ef5_clients',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add clients image with custom link', 'theclick'),
    'icon'        => '',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','theclick'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'         => get_template_directory_uri().'/vc_elements/layouts/client-layout-1.png',
                ),
                'std'        => '1',
                'admin_label' => true
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Hover Style','theclick'),
                'param_name' => 'hover_style',
                'value'      =>  array(
                    esc_html__('Grow Up','theclick')    => 'grow-up',
                    esc_html__('Slide Up','theclick')   => 'slide-up',
                    esc_html__('Slide Down','theclick') => 'slide-down',
                    esc_html__('Fade in','theclick')    => 'fade-in',
                ),
                'std'        => 'grow-up',
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
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','theclick'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick'),
            ),
            /* Clients Settings */
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Client image size','theclick'),
                'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','theclick'),
                'param_name'    => 'thumbnail_size',
                'value'         => '210',
                'std'           => '210',
                'group'         => esc_html__('Clients','theclick'),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add Clients', 'theclick' ),
                'param_name' => 'values',
                'value'      =>  urlencode( json_encode( array(
                    array(
                        'image_link' => 'title:Client 1||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 2||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 3||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 4||url:#||target="_blank"',
                    )
                ))),
                'params'     => array(
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__( 'Client Image', 'theclick' ),
                        'param_name'  => 'image',
                        'admin_label' => true,
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__( 'Client Image on Hover', 'theclick' ),
                        'param_name'  => 'image_hover',
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
                        'type'        => 'vc_link',
                        'heading'     => esc_html__( 'Link', 'theclick' ),
                        'param_name'  => 'image_link',
                        'description' => esc_html__( 'Enter link for image.', 'theclick' ),
                    ),
                ),
                'group'     => 'Clients'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','theclick'),
                'param_name' => 'layout_style',
                'value'      =>  array(
                    esc_html__('Grid','theclick')     => 'grid',
                    esc_html__('Carousel','theclick') => 'carousel'
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','theclick'),
            )
        ),
        /* Grid settings */
        ef5systems_grid_settings(array(
            'group'                  => esc_html__('Layout Settings','theclick'), 
            'dependency_element'     => 'layout_style', 
            'dependency_value_value' => 'grid'
            )
        ),
        /* Carousel Settings */
        ef5systems_owl_settings(array(
            'group'      => esc_html__('Layout Settings','theclick'), 
            'param_name' => 'layout_style', 
            'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_ef5_clients extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
    protected function theclick_clients_wrap_css_class($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => '',
            'echo'  => true
        ]);
        $el_id = !empty($el_id) ? $el_id : uniqid();
        $wrap_css_class = ['ef5-clients', 'client-layout-'.$layout_template, 'layout-type-'.$layout_style, $args['class'], 'ef5-clients-'.$el_id];

        if($args['echo']){
            echo trim(implode(' ', $wrap_css_class));
        } else {
            return trim(implode(' ', $wrap_css_class));
        }
    }
    protected function theclick_clients_css_class($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => '',
            'echo'  => true
        ]);
        $el_id = !empty($el_id) ? $el_id : uniqid();
        $wrap_css_class = [$atts['el_class']];
        switch ($layout_style) {
            case 'carousel':
                $wrap_css_class[] = 'ef5-owl owl-carousel';
                break;
            
            default:
                $wrap_css_class[] = 'ef5-grid row justify-content-center align-items-center';
                break;
        }
        $wrap_css_class[] = 'img-hover-'.$atts['hover_style'];
        if($args['echo']){
            echo trim(implode(' ', $wrap_css_class));
        } else {
            return trim(implode(' ', $wrap_css_class));
        }
    }
    protected function theclick_clients_item_css_class($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => '',
            'echo'  => true
        ]);
        $item_css_class = ['ef5-item ef5-client', $args['class']];
        switch ($layout_style) {
            case 'carousel':
                $item_css_class[] = 'ef5-carousel-item';
                break;
            
            default:
                $item_css_class[] = 'ef5-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
                break;
        }
        
        if($args['echo']){
            echo trim(implode(' ', $item_css_class));
        } else {
            return trim(implode(' ', $item_css_class));
        }
    }
    protected function theclick_client_render($atts, $value, $args = []){
        $args = wp_parse_args($args,[
            'class' => '',
            'thumbnail_class' => ''
        ]);
        $classes = ['client-logo image-hover', $args['class']];
        // image
        $value['image'] = isset($value['image']) ? $value['image'] : '';
        /* parse image_link */
        $link = false;
        $link_open = '<span class="'.trim(implode(' ', $classes)).'" data--hint="No Title"><span>';
        $link_close = '</span></span>';
        if(isset($value['image_link'])){
            $image_link = vc_build_link( $value['image_link']);
            $image_link = ( $image_link == '||' ) ? '' : $image_link;
            if ( strlen( $image_link['url'] ) > 0 ) {
                $link = true;
                $a_href = $image_link['url'];
                $a_title = $image_link['title'] ? $image_link['title'] : '';
                $a_target = strlen( $image_link['target'] ) > 0 ? str_replace(' ','',$image_link['target']) : '_self';
                $link_open = '<a class="'.trim(implode(' ', $classes)).'" href="'.esc_url($a_href).'" data-hint="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'"><span>';
                $link_close = '</span></a>';
            }
        }
        echo theclick_html($link_open);
            theclick_image_by_size([
                'id'    => $value['image'],
                'size'  => $atts['thumbnail_size'],
                'class' => trim($args['thumbnail_class'].' img-static w-auto')
            ]);
            theclick_image_by_size([
                'id'    => isset($value['image_hover']) ? $value['image_hover'] : $value['image'],
                'size'  => $atts['thumbnail_size'],
                'class' => trim($args['thumbnail_class'].' img-hover w-auto')
            ]);
        echo theclick_html($link_close);
    }
}