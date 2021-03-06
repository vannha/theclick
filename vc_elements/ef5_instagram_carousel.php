<?php
if (!class_exists('EF5Systems')) return;

vc_map(array(
    'name'          => 'TheClick Instagram Carousel',
    'base'          => 'ef5_instagram_carousel',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Show your Instagram image', 'theclick'),
    'icon'        => 'icon-wpb-ui-icon',
    'params'      => array_merge(
        array(
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Layout', 'theclick'),
                'param_name'    => 'layout_mode',
                'value'         => array(
                    esc_html__('Default', 'theclick') => 'default'
                ),
                'std'           => 'default'
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Number Image', 'theclick'),
                'param_name'    => 'number',
                'std'           => '4',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Image Size', 'theclick'),
                'param_name'    => 'size',
                'value'         => array(
                    esc_html__('Thumbnail (150x150)', 'theclick')       => 'thumbnail',
                    esc_html__('Small (320x320)', 'theclick')           => 'small',
                    esc_html__('Large (640x640)', 'theclick')           => 'large',
                    esc_html__('Original (640x640)', 'theclick')        => 'original',
                ),
                'std'           => 'thumbnail',
                'description'   => esc_html__('Auto-detect means that the plugin automatically sets the image resolution based on the size of your feed.', 'theclick')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_like',
                'value'         => array(
                    esc_html__('Show like count?', 'theclick') => true
                ),
                'std'           => false,
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_cmt',
                'value'         => array(
                    esc_html__('Show comment count?', 'theclick') => true
                ),
                'std'           => false,
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Show Author', 'theclick'),
                'param_name'    => 'show_author',
                'std'           => 'true'
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Author Text', 'theclick'),
                'param_name'    => 'author_text',
                'value'         => esc_html__('Follow Us Now', 'theclick'),
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick'),
                'dependency'    => array(
                    'element'   => 'show_author',
                    'value'     => 'true',
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Open Link in?', 'theclick'),
                'param_name'    => 'target',
                'value'         => array(
                    esc_html__('Current window', 'theclick')       => '_self',
                    esc_html__('New Window ', 'theclick')      => '_blank',
                ),
                'std'           => '_self',
                'dependency'    => array(
                    'element'   => 'show_author',
                    'value'     => 'true',
                ),
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
        ),
        ef5systems_owl_settings(array(
            'group'      => esc_html__('Carousel Layout','theclick'), 
            'param_name' => 'layout_type', 
            'value'      => 'carousel'
        ))
    )
));
class WPBakeryShortCode_ef5_instagram_carousel extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes($this->getShortcode(), $atts);
        $atts['layout_style'] = 'carousel';
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
    
}
