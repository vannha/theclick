<?php
// silent is golden
vc_add_params('vc_column',array(
	array(
        'type'         => 'dropdown',
        'heading'      => esc_html__( 'Small screen ', 'theclick' ),
        'param_name'   => 'content_sm_alignment',
        'value'        => array(
            esc_html__('Default', 'theclick')    => '',
            esc_html__('Start', 'theclick') 	 => 'text-sm-start',
            esc_html__('Center', 'theclick') => 'text-sm-center',
            esc_html__('End', 'theclick') => 'text-sm-end'
        ),
        'edit_field_class' => 'vc_col-sm-3',
        'std'          => '',
        'group'        => esc_html__('Theme Custom','theclick'),
    ),
    array(
        'type'         => 'dropdown',
        'heading'      => esc_html__( 'Medium screen ', 'theclick' ),
        'param_name'   => 'content_md_alignment',
        'value'        => array(
            esc_html__('Default', 'theclick')    => '',
            esc_html__('Start', 'theclick') 	 => 'text-md-start',
            esc_html__('Center', 'theclick') => 'text-md-center',
            esc_html__('End', 'theclick') => 'text-md-end'
        ),
        'edit_field_class' => 'vc_col-sm-3',
        'std'          => '',
        'group'        => esc_html__('Theme Custom','theclick'),
    ),
    array(
        'type'         => 'dropdown',
        'heading'      => esc_html__( 'Large screen ', 'theclick' ),
        'param_name'   => 'content_lg_alignment',
        'value'        => array(
            esc_html__('Default', 'theclick')    => '',
            esc_html__('Start', 'theclick') 	 => 'text-lg-start',
            esc_html__('Center', 'theclick') => 'text-lg-center',
            esc_html__('End', 'theclick') => 'text-lg-end'
        ),
        'edit_field_class' => 'vc_col-sm-3',
        'std'          => '',
        'group'        => esc_html__('Theme Custom','theclick'),
    ),
    array(
        'type'         => 'dropdown',
        'heading'      => esc_html__( 'Extra Large screen ', 'theclick' ),
        'param_name'   => 'content_xl_alignment',
        'value'        => array(
            esc_html__('Default', 'theclick')    => '',
            esc_html__('Start', 'theclick') 	 => 'text-xl-start',
            esc_html__('Center', 'theclick') => 'text-xl-center',
            esc_html__('End', 'theclick') => 'text-xl-end'
        ),
        'edit_field_class' => 'vc_col-sm-3',
        'std'          => '',
        'group'        => esc_html__('Theme Custom','theclick'),
    )
));