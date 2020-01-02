<?php
vc_map(array(
    'name'        => 'TheClick Heading',
    'base'        => 'ef5_heading',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add your custom heading', 'theclick'),
    'icon'        => 'icon-wpb-ui-custom_heading',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','theclick'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'  => get_template_directory_uri().'/vc_elements/layouts/heading-1.png',
                    '2'  => get_template_directory_uri().'/vc_elements/layouts/heading-2.png',
                    //'3'  => get_template_directory_uri().'/vc_elements/layouts/heading-3.png',
                ),
                'std'              => '1',
                'admin_label'      => true,
                'edit_field_class' => 'ef5-select-img-2col'
            ),
            ef5systems_content_align_option_for_vc(),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Element Class','theclick'),
                'param_name' => 'el_class',
                'value'      => '',
                'std'        => ''
            ),
            // Heading 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','theclick'),
                'param_name' => 'heading_text',
                'value'      => '',
                'std'        => '',
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','theclick')   
            ),
            array(
                'param_name'  => 'heading_font_sizes',
                'type'        => 'custom_markup',
                'value'       => '<strong>'.esc_html__('Font Size (ex:24)','theclick').'</strong>',
                'std'         => '<strong>'.esc_html__('Font Size (ex:24)','theclick').'</strong>',
                'group'      => esc_html__('Heading','theclick')    
            ),
            array(
                'type'             => 'textfield',
                'description'      => esc_html__('Small Devices','theclick'),
                'param_name'       => 'heading_text_sm',
                'edit_field_class' => 'vc_col-sm-3',
                'value'            => '',
                'std'              => '',
                'dependency' => array(
                    'element' => 'heading_text',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Heading','theclick')   
            ),
            array(
                'type'             => 'textfield',
                'description'      => esc_html__('Medium Devices','theclick'),
                'param_name'       => 'heading_text_md',
                'edit_field_class' => 'vc_col-sm-3',
                'value'            => '',
                'std'              => '',
                'dependency' => array(
                    'element' => 'heading_text',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Heading','theclick')   
            ),
            array(
                'type'             => 'textfield',
                'description'      => esc_html__('Large Devices','theclick'),
                'param_name'       => 'heading_text_lg',
                'edit_field_class' => 'vc_col-sm-3',
                'value'            => '',
                'std'              => '',
                'dependency' => array(
                    'element' => 'heading_text',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Heading','theclick')   
            ),
            array(
                'type'             => 'textfield',
                'description'      => esc_html__('Extra Large Devices','theclick'),
                'param_name'       => 'heading_text_xl',
                'edit_field_class' => 'vc_col-sm-3',
                'value'            => '',
                'std'              => '',
                'dependency' => array(
                    'element' => 'heading_text',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Heading','theclick')   
            ),
            array(
                'type'             => 'textfield',
                'heading'      => esc_html__('Line height (ex: 1 or 1.2 or 36px)','theclick'),
                'param_name'       => 'heading_lh',
                'value'            => '',
                'std'              => '',
                'dependency' => array(
                    'element' => 'heading_text',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Heading','theclick')   
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__('Choose color of heading', 'theclick'),
                'param_name'    => 'heading_color',
                'value'         => '',
                'dependency' => array(
                    'element' => 'heading_text',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Heading', 'theclick')   
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'heading_css_animation',
                'group'      => esc_html__('Heading', 'theclick'),
                'dependency' => array(
                    'element'   => 'heading_text',
                    'not_empty' => true
                ),
            ]),
            
            // Sub Heading 
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Text', 'theclick'),
                'param_name' => 'subheading_text',
                'value'      => '',
                'std'        => '',
                'holder'     => 'h3',
                'group'      => esc_html__('Sub Heading', 'theclick')
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'subheading_text_css_animation',
                'group'      => esc_html__('Sub Heading', 'theclick'),
                'dependency' => array(
                    'element'   => 'subheading_text',
                    'not_empty' => true
                )
            ]),
            // Description 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text', 'theclick'),
                'param_name' => 'desc_text',
                'value'      => '',
                'holder'     => 'div',
                'group'      => esc_html__('Description', 'theclick'),
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'desc_text_css_animation',
                'group'      => esc_html__('Description', 'theclick'),
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                )
            ]),
            // Link 
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__('Link', 'theclick'),
                'description' => esc_html__('Add your custom link', 'theclick'),
                'param_name' => 'button_link',
                'group'      => esc_html__('Link', 'theclick')
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'button_link_css_animation',
                'group'      => esc_html__('Link', 'theclick')
            ]),
        )
    )
));
class WPBakeryShortCode_ef5_heading extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
    protected function theclick_heading_wrap_css_class($atts, $class = ''){
        extract( $atts );
        $wrap_css_class = ['ef5-heading-wrap','ef5-heading-'.$layout_template, $content_align, $class, $el_class];
        echo trim(implode(' ', $wrap_css_class));
    }
    
    protected function ef5_heading_main_heading($atts,$args = []){
        if(empty($atts['heading_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
         
        // Heading 
        $heading_attrs = [];

        $heading_css_class = [
            'main-heading',
            $args['class']
        ];
        
        $heading_attrs[] = 'class="'.trim(implode(' ', $heading_css_class)).'"';
        $heading_attrs[] = (!empty($heading_color)) ? 'style="color:'.$heading_color.';"' : '';
        $heading_attrs[] = (!empty($heading_lh)) ? 'style="line-height:'.$heading_lh.';"' : '';
        ?>
            <div <?php echo trim(implode(' ', $heading_attrs));?>><?php 
                echo theclick_html($heading_text); 
            ?></div>
        <?php 
    }
    protected function ef5_heading_sub_heading($atts,$args = []){
        if(empty($atts['subheading_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        // SubHeading
        $subheading_attrs = [];
        $subheading_css_class = [
            'subheading',
            $args['class']
        ];
        $subheading_attrs[] = 'class="'.trim(implode(' ', $subheading_css_class)).'"';
        ?>
            <div <?php echo implode(' ', $subheading_attrs);?>><?php 
                echo theclick_html($subheading_text); 
            ?></div>
        <?php
    }
    protected function ef5_heading_desccription($atts,$args = []){
        if(empty($atts['desc_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        // Description 
        $desc_attrs = [];
        $desc_css_class = [
            'desc',
            $args['class']
        ];
        $desc_attrs[] = 'class="'.trim(implode(' ', $desc_css_class)).'"';
        ?>
            <div <?php echo trim(implode(' ', $desc_attrs));?>><?php 
                echo theclick_html($desc_text);
            ?></div>
        <?php
    }
    protected function ef5_heading_button($atts,$args = []){
        $args = wp_parse_args($args, [
            'before' => '',
            'after'  => '',
            'class'  => ''
        ]);
        extract( $atts );
        //  Button Link
        $use_link = false;
        $button_link = vc_build_link( $atts['button_link'] );
        $button_link = ( $button_link == '||' ) ? '' : $button_link;
        if ( strlen( $button_link['url'] ) > 0 ) {
            $use_link = true; 
            $a_href   = $button_link['url'];
            $a_title  = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read More','theclick') ;
            $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
        }
        if(!$use_link) return;
            $html = $args['before'];
                $html .= '<a href="'.esc_url($a_href).'" class="'.$args['class'].'" target="'.esc_attr($a_target).'">'.$a_title.'</a>';
            $html .= $args['after'];
            echo theclick_html($html);
    }
}