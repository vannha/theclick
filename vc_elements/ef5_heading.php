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
                    //'2'  => get_template_directory_uri().'/vc_elements/layouts/heading-2.png',
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
            // Small Heading 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','theclick'),
                'param_name' => 'small_heading_text',
                'value'      => 'Small Heading',
                'std'        => 'Small Heading',
                'holder'     => 'div',
                'group'      => esc_html__('Small Heading','theclick'),
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'small_css_animation',
                'group'      => esc_html__('Small Heading','theclick'),
                'dependency' => array(
                    'element'   => 'small_heading_text',
                    'not_empty' => true
                ),
            ]),
            // Heading 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','theclick'),
                'param_name' => 'heading_text',
                'value'      => 'This is TheClick custom heading element',
                'std'        => 'This is TheClick custom heading element',
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','theclick')   
            )
        ),
        ef5systems_icon_libs([
            'dependency'        => 'heading_text',
            'dependency_option' => 'not_empty',
            'dependency_value'  => true,
            'group'             => esc_html__('Heading','theclick') 
        ]),
        ef5systems_icon_libs_icon([
            'group'             => esc_html__('Heading','theclick') 
        ]),
        array(
            // Heading part 2 
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_heading2',
                'value'      => array(
                    esc_html__('Show Heading Part 2','theclick') => '1',
                ),
                'std'        => '0',
                'group'      => esc_html__('Heading','theclick'),
                'dependency' => array(
                    'element'   => 'heading_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','theclick'),
                'param_name' => 'heading2_text',
                'dependency' => array(
                    'element' => 'show_heading2',
                    'value'   => array('1')
                ),
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','theclick')   
            ),
            // Heading Part 3
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_heading3',
                'value'      => array(
                    esc_html__('Show Heading Part 3','theclick') => '1',
                ),
                'std'        => '0',
                'group'      => esc_html__('Heading','theclick'),
                'dependency' => array(
                    'element'   => 'heading_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','theclick'),
                'param_name' => 'heading3_text',
                'dependency' => array(
                    'element' => 'show_heading3',
                    'value'   => array('1')
                ),
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','theclick')   
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'heading_css_animation',
                'group'      => esc_html__('Heading','theclick'),
                'dependency' => array(
                    'element'   => 'heading_text',
                    'not_empty' => true
                ),
            ]),
            // Sub Heading 
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Text','theclick'),
                'param_name' => 'subheading_text',
                'value'      => 'Sub Heading',
                'std'        => 'Sub Heading',
                'holder'     => 'h3',
                'group'      => esc_html__('Sub Heading','theclick')
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'subheading_text_css_animation',
                'group'      => esc_html__('Sub Heading','theclick'),
                'dependency' => array(
                    'element'   => 'subheading_text',
                    'not_empty' => true
                )
            ]),
            // Description 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','theclick'),
                'param_name' => 'desc_text',
                'value'      => 'This is TheClick custom description. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo.',
                'holder'     => 'div',
                'group'      => esc_html__('Description','theclick'),
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'desc_text_css_animation',
                'group'      => esc_html__('Description','theclick'),
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                )
            ]),
            // Link 
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__('Link','theclick'),
                'description'=> esc_html__('Add your custom link','theclick'),
                'param_name' => 'button_link',
                'group'      => esc_html__('Link','theclick')
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'button_link_css_animation',
                'group'      => esc_html__('Link','theclick')
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
    protected function ef5_heading_small_heading($atts,$args = []){
        if(empty($atts['small_heading_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        $small_heading_attrs = $small_heading_css = [];
        $small_heading_css_class = [
            'small-heading',
            $args['class']
        ];
        $small_heading_attrs[] = 'class="'.trim(implode(' ', $small_heading_css_class)).'"';
    ?>
        <div <?php echo trim(implode(' ', $small_heading_attrs));?>><?php 
            echo theclick_html($small_heading_text); 
        ?></div>
    <?php
    }
    protected function ef5_heading_main_heading($atts,$args = []){
        if(empty($atts['heading_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        if(!empty($heading2_text)) $heading2_text = '<span class="part2">'.$heading2_text.'</span>';
        if(!empty($heading3_text)) $heading3_text = '<span class="part3">'.$heading3_text.'</span>';

        $heading_string = trim(implode(' ',[$heading_text, $heading2_text, $heading3_text]));
        // Heading 
        $heading_attrs = [];

        $heading_css_class = [
            'main-heading',
            $args['class']
        ];
        
        $heading_attrs[] = 'class="'.trim(implode(' ', $heading_css_class)).'"';
        ?>
            <div <?php echo trim(implode(' ', $heading_attrs));?>><?php 
                echo theclick_html($heading_string); 
            ?></div>
        <?php 
    }
    protected function ef5_heading_main_heading_icon($atts, $args=[]){
        extract($atts);
        if(empty($atts['heading_text']) || $atts['layout_template'] !== '3') return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-heading-icon', $args['class']];
        $icon_name = "i_icon_" . $i_type;
        $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name]: '';
        if(empty($iconClass)) return;
        vc_icon_element_fonts_enqueue($i_type);
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>">
                <span class="<?php echo esc_attr($iconClass); ?>"></span>
            </div>
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