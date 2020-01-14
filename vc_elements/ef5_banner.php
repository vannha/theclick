<?php
vc_map(array(
    "name" => 'TheClick Banner',
    "base" => "ef5_banner",
    "icon" => "icon-wpb-single-image",
    'category'      => esc_html__('TheClick', 'theclick'),
    "params" => array(
        array(
            'type' => 'img',
            'heading' => esc_html__( 'Banner style', 'theclick' ),
            'value' => array(
                'style-1' => get_template_directory_uri().'/vc_elements/layouts/banner-style1.jpg', 
                'style-2' => get_template_directory_uri().'/vc_elements/layouts/banner-style2.jpg',
                'style-3' => get_template_directory_uri().'/vc_elements/layouts/banner-style3.jpg',    
                'style-4' => get_template_directory_uri().'/vc_elements/layouts/banner-style4.jpg',
                'style-5' => get_template_directory_uri().'/vc_elements/layouts/banner-style5.jpg', 
                'style-6' => get_template_directory_uri().'/vc_elements/layouts/banner-style6.jpg',
                'style-7' => get_template_directory_uri().'/vc_elements/layouts/banner-style7.jpg',    
                'style-8' => get_template_directory_uri().'/vc_elements/layouts/banner-style8.jpg',
                'style-9' => get_template_directory_uri().'/vc_elements/layouts/banner-style9.jpg',
                'style-10' => get_template_directory_uri().'/vc_elements/layouts/banner-style10.jpg',
                'style-11' => get_template_directory_uri().'/vc_elements/layouts/banner-style11.jpg',
                'style-12' => get_template_directory_uri().'/vc_elements/layouts/banner-style12.jpg',
                'style-13' => get_template_directory_uri().'/vc_elements/layouts/banner-style13.jpg',
                'style-14' => get_template_directory_uri().'/vc_elements/layouts/banner-style14.jpg',
            ),
            'param_name' => 'banner_style',
            "admin_label" => true,
            "group" => esc_html__("Layout", 'theclick'),
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Item",'theclick'),
            "param_name" => "image",
        ),
        array(
        	'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'theclick' ),
            'param_name' => 'link',
        ),
        array(
            'type'          => 'dropdown',
            'param_name'    => 'btn_type',
            'heading'       => esc_html__( 'Button Type', 'theclick' ),
            'value'         => array(
                esc_html__('None', 'theclick' ) => '',
                esc_html__('Default', 'theclick')     => 'btn',
                esc_html__('Primary', 'theclick')     => 'btn-primary',
                esc_html__('Default Alt', 'theclick') => 'btn btn-alt',
                esc_html__('Primary Alt', 'theclick') => 'btn-primary btn-alt',
                esc_html__('White', 'theclick')       => 'btn btn-white',
                esc_html__('Alt White', 'theclick')   => 'btn btn-white btn-alt',
                esc_html__('Simple Link', 'theclick') => 'simple',
            ),
            'std'           => '',
        ),
        array(
            'type' => 'dropdown',
            'class' => '',
            'heading' => esc_html__( 'Button Link Effect', 'theclick' ),
            'param_name' => 'button_link_effect',
            'value' => array(
                esc_html__( 'None', 'theclick' ) => '',
                esc_html__( 'Fade in', 'theclick' ) => 'fade-in',
                esc_html__( 'Move Up', 'theclick' ) => 'move-up',
                esc_html__( 'Move Down', 'theclick' ) => 'move-down',
                esc_html__( 'Move Left', 'theclick' ) => 'move-left',
                esc_html__( 'Move Right', 'theclick' ) => 'move-right',
                esc_html__( 'Scale Up', 'theclick' ) => 'scale-up',
                esc_html__( 'Fall Perspective', 'theclick' ) => 'fall-perspective',
                esc_html__( 'Fly', 'theclick' ) => 'fly',
                esc_html__( 'Flip', 'theclick' ) => 'flip',
                esc_html__( 'Helix', 'theclick' ) => 'helix',
                esc_html__( 'Popup', 'theclick' ) => 'pop-up',
            ),
            "dependency" => array(
                "element" => 'btn_type',
                "value" => array(
                    "btn",
                    "btn-primary",
                    "btn btn-alt",
                    "btn-primary btn-alt",
                    "btn btn-white",
                    "btn btn-white btn-alt",
                    "simple",
                ),
            ),
        ),
        array(
            'type' => 'dropdown',
        	'heading' => esc_html__( 'Banner hover effect', 'theclick' ),
            'description' => esc_html__( 'Apply for banner with url link', 'theclick' ),
        	'value' => array(
                esc_html__( 'None', 'theclick' ) => '',
        		esc_html__( 'Fade', 'theclick' ) => 'fade-normal',
        		esc_html__( 'Zoom', 'theclick' ) => 'zoom-normal',
        		esc_html__( 'Fade Zoom', 'theclick' ) => 'fade-zoom',
        	),
        	'param_name' => 'effect',
            'std' => 'fade-zoom',
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Overlay background hover", 'theclick'),
            "param_name" => "overlay_bg",
            "value"      => "",
            "dependency" => array(
                "element" => 'effect',
                "value" => array(
                    "fade-normal",
                    "fade-zoom",
                ),
            ),
        ),
        array(
            'type'          => 'dropdown',
            'param_name'    => 'position',
            'heading'       => esc_html__( 'Content Position', 'theclick' ),
            'value'         => array(
                esc_html__('Default', 'theclick') => '',
                esc_html__('Top', 'theclick')     => 'top',
                esc_html__('Middle', 'theclick')  => 'middle',
                esc_html__('Bottom', 'theclick')  => 'bottom',
            ),
            'std'           => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Alignment', 'theclick' ),
            'description' => esc_html__( 'Apply for banner with url link', 'theclick' ),
            'value' => array(
                esc_html__( 'Default', 'theclick' ) => '',
                esc_html__( 'Left', 'theclick' ) => 'text-left',
                esc_html__( 'Right', 'theclick' ) => 'text-right',
                esc_html__( 'Center', 'theclick' ) => 'text-center',
            ),
            'param_name' => 'align',
            'std' => '',
        ),
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Class",'theclick'),
            "param_name" => "el_class",
            "value" => "",
        ), 
        
         
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title 1",'theclick'),
            "param_name" => "title1",
            "value" => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-9","style-10","style-11","style-12","style-13","style-14"
                ),
            ),
            "group" => esc_html__("Title 1", 'theclick'),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 1 color", 'theclick'),
            "param_name" => "title1_color",
            "value"      => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-9","style-10","style-11","style-12","style-13","style-14"
                ),
            ),
            "group" => esc_html__("Title 1", 'theclick'),
        ),
        array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__( 'Effect title 1', 'theclick' ),
			'param_name' => 'effect_title1',
			'value' => array(
                esc_html__( 'None', 'theclick' ) => '',
                esc_html__( 'Fade in', 'theclick' ) => 'fade-in',
                esc_html__( 'Move Up', 'theclick' ) => 'move-up',
                esc_html__( 'Move Down', 'theclick' ) => 'move-down',
                esc_html__( 'Move Left', 'theclick' ) => 'move-left',
                esc_html__( 'Move Right', 'theclick' ) => 'move-right',
                esc_html__( 'Scale Up', 'theclick' ) => 'scale-up',
                esc_html__( 'Fall Perspective', 'theclick' ) => 'fall-perspective',
                esc_html__( 'Fly', 'theclick' ) => 'fly',
                esc_html__( 'Flip', 'theclick' ) => 'flip',
                esc_html__( 'Helix', 'theclick' ) => 'helix',
                esc_html__( 'Popup', 'theclick' ) => 'pop-up',
            ),
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-9","style-10","style-11","style-12","style-13","style-14"
                ),
            ),
            "group" => esc_html__("Title 1", 'theclick'),
		),
        
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title 2",'theclick'),
            "param_name" => "title2",
            "value" => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-9","style-13","style-14"
                ),
            ),
            "group" => esc_html__("Title 2", 'theclick'),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 2 color", 'theclick'),
            "param_name" => "title2_color",
            "value"      => "", 
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-9","style-13","style-14"
                ),
            ),
            "group" => esc_html__("Title 2", 'theclick'),
        ),
        array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__( 'Effect title 2', 'theclick' ),
			'param_name' => 'effect_title2',
			'value' => array(
                esc_html__( 'None', 'theclick' ) => '',
                esc_html__( 'Fade in', 'theclick' ) => 'fade-in',
                esc_html__( 'Move Up', 'theclick' ) => 'move-up',
                esc_html__( 'Move Down', 'theclick' ) => 'move-down',
                esc_html__( 'Move Left', 'theclick' ) => 'move-left',
                esc_html__( 'Move Right', 'theclick' ) => 'move-right',
                esc_html__( 'Scale Up', 'theclick' ) => 'scale-up',
                esc_html__( 'Fall Perspective', 'theclick' ) => 'fall-perspective',
                esc_html__( 'Fly', 'theclick' ) => 'fly',
                esc_html__( 'Flip', 'theclick' ) => 'flip',
                esc_html__( 'Helix', 'theclick' ) => 'helix',
                esc_html__( 'Popup', 'theclick' ) => 'pop-up',
            ),
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-9","style-13","style-14"
                ),
            ),
            "group" => esc_html__("Title 2", 'theclick'),
		),
        
        
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title 3",'theclick'),
            "param_name" => "title3",
            "value" => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-4","style-6","style-8"
                ),
            ),
            "group" => esc_html__("Title 3", 'theclick'),
        ), 
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 3 color", 'theclick'),
            "param_name" => "title3_color",
            "value"      => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-4","style-6","style-8"
                ),
            ),
            "group" => esc_html__("Title 3", 'theclick'),
        ),
        array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__( 'Effect title 3', 'theclick' ),
			'param_name' => 'effect_title3',
			'value' => array(
                esc_html__( 'None', 'theclick' ) => '',
                esc_html__( 'Fade in', 'theclick' ) => 'fade-in',
                esc_html__( 'Move Up', 'theclick' ) => 'move-up',
                esc_html__( 'Move Down', 'theclick' ) => 'move-down',
                esc_html__( 'Move Left', 'theclick' ) => 'move-left',
                esc_html__( 'Move Right', 'theclick' ) => 'move-right',
                esc_html__( 'Scale Up', 'theclick' ) => 'scale-up',
                esc_html__( 'Fall Perspective', 'theclick' ) => 'fall-perspective',
                esc_html__( 'Fly', 'theclick' ) => 'fly',
                esc_html__( 'Flip', 'theclick' ) => 'flip',
                esc_html__( 'Helix', 'theclick' ) => 'helix',
                esc_html__( 'Popup', 'theclick' ) => 'pop-up',
            ),
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-4","style-6","style-8"
                ),
            ),
            "group" => esc_html__("Title 3", 'theclick'),
		), 
        
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title 4",'theclick'),
            "param_name" => "title4",
            "value" => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-6"
                ),
            ),
            "group" => esc_html__("Title 4", 'theclick'),
        ), 
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 4 color", 'theclick'),
            "param_name" => "title4_color",
            "value"      => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-6"
                ),
            ),
            "group" => esc_html__("Title 4", 'theclick'),
        ),
        array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__( 'Effect title 4', 'theclick' ),
			'param_name' => 'effect_title4',
			'value' => array(
                esc_html__( 'None', 'theclick' ) => '',
                esc_html__( 'Fade in', 'theclick' ) => 'fade-in',
                esc_html__( 'Move Up', 'theclick' ) => 'move-up',
                esc_html__( 'Move Down', 'theclick' ) => 'move-down',
                esc_html__( 'Move Left', 'theclick' ) => 'move-left',
                esc_html__( 'Move Right', 'theclick' ) => 'move-right',
                esc_html__( 'Scale Up', 'theclick' ) => 'scale-up',
                esc_html__( 'Fall Perspective', 'theclick' ) => 'fall-perspective',
                esc_html__( 'Fly', 'theclick' ) => 'fly',
                esc_html__( 'Flip', 'theclick' ) => 'flip',
                esc_html__( 'Helix', 'theclick' ) => 'helix',
                esc_html__( 'Popup', 'theclick' ) => 'pop-up',
            ),
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-6"
                ),
            ),
            "group" => esc_html__("Title 4", 'theclick'),
		), 
        array(
            'type'        => 'textarea',
            'heading'     => esc_html__( 'Description text', 'theclick' ),
            'param_name'  => 'desc_text',
            'value'       => '',
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-12"
                ),
            ),
            'group'         => esc_html__('Description','theclick')
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Description color", 'theclick'),
            "param_name" => "desc_color",
            "value"      => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-12"
                ),
            ),
            "group" => esc_html__("Description", 'theclick'),
        ),
        array(
            'type' => 'dropdown',
            'class' => '',
            'heading' => esc_html__( 'Effect Description', 'theclick' ),
            'param_name' => 'effect_desc',
            'value' => array(
                esc_html__( 'None', 'theclick' ) => '',
                esc_html__( 'Fade in', 'theclick' ) => 'fade-in',
                esc_html__( 'Move Up', 'theclick' ) => 'move-up',
                esc_html__( 'Move Down', 'theclick' ) => 'move-down',
                esc_html__( 'Move Left', 'theclick' ) => 'move-left',
                esc_html__( 'Move Right', 'theclick' ) => 'move-right',
                esc_html__( 'Scale Up', 'theclick' ) => 'scale-up',
                esc_html__( 'Fall Perspective', 'theclick' ) => 'fall-perspective',
                esc_html__( 'Fly', 'theclick' ) => 'fly',
                esc_html__( 'Flip', 'theclick' ) => 'flip',
                esc_html__( 'Helix', 'theclick' ) => 'helix',
                esc_html__( 'Popup', 'theclick' ) => 'pop-up',
            ),
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-12"
                ),
            ),
            "group" => esc_html__("Description", 'theclick'),
        ), 
        array(
        	'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'theclick' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design', 'theclick' ),
        )
    )
));
class WPBakeryShortCode_ef5_banner extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}