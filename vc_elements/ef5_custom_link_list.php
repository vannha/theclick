<?php
vc_map(array(
    'name'        => 'Custom link list',
    'base'        => 'ef5_custom_link_list',
    'icon'         => '',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add title and title link with custom link', 'theclick'),
    'params'      => array(
        array(
            'type'       => 'param_group',
            'heading'    => esc_html__('Add link', 'theclick'),
            'param_name' => 'cl_list',
            'value'      =>  '',
            'params'     => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Title", 'theclick'),
                    "param_name"    => "title",
                    "value"         => '',
                    'admin_label'   => true
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__('Link', 'theclick'),
                    'param_name'  => 'item_link',
                    'description' => esc_html__('Enter link for title.', 'theclick'),
                )
            ),
        ),
        array(
            'type'             => 'textfield',
            'heading'          => esc_html__('Extra Class', 'theclick'),
            'param_name'       => 'el_class',
            'value'            => '',
            'description'      => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick'),
        )
    )
));

class WPBakeryShortCode_ef5_custom_link_list extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
