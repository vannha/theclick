<?php
vc_map(array(
    'name'        => 'TheClick List',
    'base'        => 'ef5_list',
    'icon'        => '',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add list with icon', 'theclick'),
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','theclick'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/list-1.png',
                ),
                'std'         => '1',
                'admin_label' => true,
            ),
            array(
                'type'        => 'textfield',
                'param_name'  => 'el_title',
                'heading'     => esc_html__( 'Element Title', 'theclick' ),
                'value'       => 'Our strategic priorities up to 2019 are:',
                'std'         => 'Our strategic priorities up to 2019 are:',
                'description' => esc_html__( 'Enter element title', 'theclick' ),
                'admin_label' => true,
            ),
            array(
                'type'        => 'checkbox',
                'param_name'  => 'add_title_icon',
                'value'       => array(
                    esc_html__('Add Title Icon') => 'true'
                ),
                'std'         => '0',
            )
        ),
        ef5systems_icon_libs([
            'group'        => '',
            'field_prefix' => 'title_icon_',
            'heading'      => esc_html__('Title Icon','theclick'),
            'dependency'   => 'add_title_icon' 
        ]),
        ef5systems_icon_libs_icon([
            'group'        => '',
            'field_prefix' => 'title_icon_',
            'empty_icon'   => true
        ]),
        array(
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add your lists', 'theclick' ),
                'param_name' => 'values',
                'group'      => esc_html__('Lists','theclick'),
                'value' => urlencode( json_encode( array(
                    array(
                        'i_type'             => 'theclick',
                        'i_icon_theclick' => 'flaticon-right-arrow-forward',
                        'text'               => 'Protecting charities from abuse or mismanagement'
                    ),
                    array(
                        'i_type'             => 'theclick',
                        'i_icon_theclick' => 'flaticon-right-arrow-forward',
                        'text'               => 'Enabling trustees to run their charities effectively'
                    ),
                    array(
                        'i_type'             => 'theclick',
                        'i_icon_theclick' => 'flaticon-right-arrow-forward',
                        'text'               => 'Encouraging greater transparency and accountability'
                    )
                ) ) ),
                'params' => array_merge(
                    ef5systems_icon_libs(),
                    ef5systems_icon_libs_icon(['empty_icon'=>true]),
                    array(
                        array(
                            'type'       => 'textfield',
                            'heading'    => esc_html__( 'Your text', 'theclick' ),
                            'param_name' => 'text',
                            'admin_label'=> true,
                        ),
                    )
                ),
            )
        ),
        // Design options
        array(
            array(
                'type'         => 'dropdown',
                'heading'      => esc_html__( 'Inner Space (Padding)', 'theclick' ),
                'param_name'   => 'ef5_padding',
                'value'        => ef5systems_spacing_option_for_vc(),
                'std'          => 'default',
                'description'  => esc_html__( 'Choose inner space', 'theclick' ),
                'group'        => esc_html__('Design Options','theclick'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'         => 'dropdown',
                'heading'      => esc_html__( 'Outer Space (Margin)', 'theclick' ),
                'param_name'   => 'ef5_margin',
                'value'        => ef5systems_spacing_option_for_vc(),
                'std'          => 'default',
                'description'  => esc_html__( 'Choose outer space', 'theclick' ),
                'group'        => esc_html__('Design Options','theclick'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
        )
    )
));

class WPBakeryShortCode_ef5_list extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}