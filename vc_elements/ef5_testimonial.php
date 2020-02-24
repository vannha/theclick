<?php
vc_map(array(
    'name'        => 'Theclick Testimonial',
    'base'        => 'ef5_testimonial',
    'icon'        => 'ef5-icon-quote',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add clients testimonial', 'theclick'),
    'params'      => array_merge(
        array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'theclick' ),
                'param_name'  => 'title',
                'value'       => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Align','theclick'),
                'param_name'    => 'content_align',
                'value'         => array(
                    'Default'       => '',
                    'Text Left'     => 'text-start',
                    'Text Right'    => 'text-end',
                    'Text Center'   => 'text-center',
                ),
                'std'           => '',
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','theclick'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/testimonial-1.jpg',
                ),
                'std'         => '1',
                'admin_label' => true
            ),
            // Text Color
            array(
                'type'         => 'dropdown',
                'heading'      => esc_html__( 'Text Color', 'theclick' ),
                'param_name'   => 'text_color_opts',
                'value'        => ef5systems_colors_option_for_vc([
                    esc_html__('Custom','theclick') => 'custom'
                ]),
                'std'          => '',
                'description'  => esc_html__( 'Choose color for this row', 'theclick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'         => 'colorpicker',
                'heading'      => esc_html__( 'Custom Text Color', 'theclick' ),
                'param_name'   => 'text_color',
                'description'  => esc_html__( 'Choose your color for this row', 'theclick' ),
                'dependency' => array(
                    'element'   => 'text_color_opts',
                    'value'     => 'custom'
                ),
                'edit_field_class' => 'vc_col-sm-6',
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
                'heading'    => esc_html__('Element Class','theclick'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick'),
            ),
            /* Testimonial Settings */
            array(
                'type'          => 'param_group',
                'heading'       => esc_html__( 'Add your testimonial', 'theclick' ),
                'param_name'    => 'testimonials',
                'value'         => urlencode( json_encode( array(
                    array(
                        'author_name'          => 'Andrew Bright',
                        'author_position'      => 'CEO & Founder',
                        'author_url'           => '#',
                        'author_avatar'        => '',
                        'text'                 => '',
                        'text_bg'              => '' 
                    ),
                    array(
                        'author_name'          => 'Conrad Smith',
                        'author_position'      => 'Volunteer',
                        'author_url'           => '#',
                        'author_avatar'        => '',
                        'text'                 => '',
                        'text_bg'              => ''
                    ),
                    array(
                        'author_name'          => 'Belle Hill',
                        'author_position'      => 'Volunteer',
                        'author_url'           => '#',
                        'author_avatar'        => '',
                        'text'                 => '',
                        'text_bg'              => ''
                    )
                ) ) ),
                'params' => array(
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author name', 'theclick' ),
                        'param_name'    => 'author_name',
                        'std'			=> 'John Smith',
                        'admin_label'   => true,
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author Position', 'theclick' ),
                        'param_name'    => 'author_position',
                        'std'			=> 'Project Manager',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author URL', 'theclick' ),
                        'param_name'    => 'author_url',
                        'std'			=> '#',
                    ),
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Author Image', 'theclick' ),
                        'param_name'    => 'author_avatar',
                        'value'         => '',
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
		                'type'          => 'dropdown',
		                'heading'       => esc_html__( 'Star Rate', 'theclick' ),
		                'param_name'    => 'author_rate',
		                'value'         => array('','1','2','3','4','5'),
		                'std'           => ''
		            ),
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'Testimonial text', 'theclick' ),
                        'description'   => esc_html__('Press double ENTER to get line-break','theclick'),
                        'param_name'    => 'text',
                        'std'           => 'Donec euismod sem ac urna finibus, sit amet efficitur erat tem pus. Ut dapibus dictum turpis, vel faucibus erat posuere vitae icitur erat tem puna'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Background text color','theclick'),
                        'param_name' => 'text_bg',
                        'std'        => ''
                    ),
                ),
                'group' => esc_html__('Testimonial Item','theclick')
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
                'admin_label'=> true
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

class WPBakeryShortCode_ef5_testimonial extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
    protected function theclick_tm_text_color($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'echo' => true
        ]);
        $color = (!empty($text_color_opts) && !empty($text_color)) ? 'style="color:'.$text_color.'"' : '';
        if($args['echo'])
            echo theclick_html($color);
        else 
            return $color;
    }
    protected function theclick_tm_text($testimonial, $atts, $args=[]){
        if(empty($testimonial['text'])) return;
        extract($atts);
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $ttmn_text_style = [];
        $ttmn_text_style[] = (!empty($testimonial['text_bg'])) ? 'background-color:'.$testimonial['text_bg'].';' : '';
        $ttmn_text_style[] = (!empty($text_color_opts) && !empty($text_color)) ? 'color:'.$text_color.';' : '';
          

        $ttmn_text_attrs = 'style="'.trim(implode(' ', $ttmn_text_style)).'"';

        $classes = ['ttmn-text', 'text-'.$text_color_opts, $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $classes));?>" <?php echo esc_attr($ttmn_text_attrs);?>><?php echo theclick_html($testimonial['text']);?></div>
        <?php
    }
    protected function theclick_tm_name($testimonial, $atts, $args=[]){
        if(empty($testimonial['author_name'])) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $classes = ['ttmn-name', 'text-'.$atts['text_color_opts'], $args['class']];
        $author_link_open = $author_link_close = '';
        if(!empty($testimonial['author_url'])){
            $author_link_open = '<a class="ef5-text-inherit" href="'.esc_url($testimonial['author_url']).'" target="_blank">';
            $author_link_close = '</a>';
        }
        ?>
            <span class="<?php echo trim(implode(' ', $classes));?>" <?php $this->theclick_tm_text_color($atts);?>>
                <?php echo theclick_html($author_link_open.$testimonial['author_name'].$author_link_close);?>
            </span>
        <?php
    }
    protected function theclick_tm_position($testimonial, $args=[]){
        if(empty($testimonial['author_position'])) return;
        $args = wp_parse_args($args,[
            'class' => 'ef5-text-accent'
        ]);
        $classes = ['ttmn-position', $args['class']];
        ?>
            <span class="<?php echo trim(implode(' ', $classes));?>">
                <?php echo theclick_html($testimonial['author_position']);?>
            </span>
        <?php
    }
    protected function theclick_tm_rate($testimonial,$atts, $args=[]){
        if(empty($testimonial['author_rate'])) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $classes = ['ttmn-rate', $args['class']];
        $author_rate = ($testimonial['author_rate']/5)*100;
        ?>
            <div class="<?php echo trim(implode('', $classes));?>"><span class="ttmn-rated" style="width:<?php echo esc_attr($author_rate);?>%"></span></div>
        <?php
    }
    protected function theclick_tm_avatar($testimonial,$atts, $args=[]){
        $testimonial['author_avatar'] = isset($testimonial['author_avatar']) ? $testimonial['author_avatar'] : null;
        $args = wp_parse_args($args,[
            'img_class' => '',
            'size'      => '90',
            'before'    => '<div class="tm-avatar">',
            'after'     => '</div>'
        ]);
        $classes = ['avatar w-auto', $args['img_class']];

        theclick_image_by_size([
            'id'      => $testimonial['author_avatar'],
            'size'    => $args['size'],
            'class'   => trim(implode(' ', $classes)),
            'default' => true,
            'before'  => $args['before'],
            'after'   => $args['after']  
        ]);
    }
}