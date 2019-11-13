<?php
if ( !class_exists( 'FlexUser' ) ) return;
vc_map(array(
    'name'        => 'TheClick User Block',
    'base'        => 'ef5_user_block',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add user block', 'theclick'),
    'icon'        => 'icon-wpb-ui-icon',
    'params'      => array(
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Element Class','theclick'),
            'param_name' => 'el_class',
            'value'      => '',
            'std'        => ''
        )
    )
));
class WPBakeryShortCode_ef5_user_block extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}