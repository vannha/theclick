<?php
vc_map(array(
    'name'        => 'TheClick Fancy Box',
    'base'        => 'ef5_fancy_box',
    'category'    => esc_html__('TheClick', 'theclick'),
    'description' => esc_html__('Add fancy boxes', 'theclick'),
    'icon'        => 'icon-wpb-ui-icon',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','theclick'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/fancy-box1.png',
                ),
                'std'        => '1',
                'admin_label' => true
            ),
	        array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Element Class','theclick'),
				'param_name' => 'el_class',
				'std'		 => ''
			)
        ),
        // Content
        array(
        	array(
        		'type'       => 'textarea',
                'heading'    => esc_html__('Heading','theclick'),
                'param_name' => 'heading',
                'value'      => 'CMS Fancy Icon Box',
                'holder' 	 => 'h3',
                'group'	     => esc_html__('Content','theclick')	
        	),
        	array(
        		'type'       => 'textarea',
                'heading'    => esc_html__('Description','theclick'),
                'param_name' => 'desc',
                'value'      => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit sit amet justo Suspendisse et justo.',
                'holder' 	 => 'div',
                'group'	     => esc_html__('Content','theclick')	
        	),
        	array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Choose your link','theclick'),
				'param_name' => 'button_link',
	            'group'	     => esc_html__('Content','theclick')
		    )
        ),
        // Icon
        array(
        	array(
        		'type'       => 'dropdown',
                'param_name' => 'add_icon',
                'heading'    => esc_html__('Add Icon?','theclick'),
                'value'      => array(
                    esc_html__('None','theclick')          => 'none',
                    esc_html__('Font Icon?','theclick')    => 'true',
                    esc_html__('Image Icon?','theclick')   => 'image',
                    esc_html__('Upload Icon ?','theclick') => 'upload'
                ),
                'std'		 => 'true',
                'group'	     => esc_html__('Icon','theclick')
        	),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Choose our existing image','theclick'),
                'param_name' => 'icon_existing',
                'value'      =>  array(
                    '1'   => get_template_directory_uri().'/vc_elements/icons/1.png',
                ),
                'std'        => '',
                'dependency' => array(
                    'element' => 'add_icon',
                    'value'   => 'image',
                ),
                'group'      => esc_html__('Icon','theclick'),
                'edit_field_class' => 'ef5-vc-list-icon'
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Upload your own image?','theclick'),
                'param_name' => 'icon_upload',
                'value'      => '',
                'std'        => '',
                'dependency' => array(
                    'element' => 'add_icon',
                    'value'   => 'upload',
                ),
                'group'      => esc_html__('Icon','theclick')
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Icon Size','theclick'),
                'description'   => esc_html__('Enter image size defined by theme (Example: "thumbnail", "medium", "large","post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','theclick'),
                'param_name'    => 'icon_size',
                'value'         => '60',
                'std'           => '60',
                'group'         => esc_html__('Image', 'theclick'),
                'dependency'    => array(
                  'element'   => 'icon_upload',
                  'not_empty' => true,
                ),
            ),
        ),
        // icon list 
        ef5systems_icon_libs(),
        ef5systems_icon_libs_icon()
    )
));
class WPBakeryShortCode_ef5_fancy_box extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		/* Call icon font stylesheet */
		vc_icon_element_fonts_enqueue( $atts['i_type'] );
        return parent::content($atts, $content);
    }
    protected function ef5_fancy_box_icon($atts, $args=[]){
        extract($atts);
        if($add_icon === 'none') return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-fancybox-icon', 'transition', $args['class']];
        $icon_name = "i_icon_" . $i_type;
        $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name]: '';
        if(empty($iconClass)) return;
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>">
                <?php switch ($add_icon) {
                    case 'upload':
                        theclick_image_by_size([
                            'id'    => $icon_upload,
                            'size'  => $icon_size,
                            'class' => 'ef5-fancybox-img'
                        ]);
                        break;
                    case 'image':
                ?>
                    <img src="<?php echo esc_url(get_template_directory_uri().'/vc_elements/icons/png/'.$icon_existing.'.png');?>" alt="<?php echo esc_attr($heading);?>">
                <?php
                        break;
                    default:
                ?>
                    <span class="<?php echo esc_attr($iconClass); ?>"></span>
                <?php
                        break;
                } 
                ?>
            </div>
        <?php
    }
    protected function ef5_fancy_box_heading($atts, $args=[]){
        extract($atts);
        if(empty($heading)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-heading','ef5-fancybox-heading', $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>"><?php echo theclick_html($heading); ?></div>
        <?php
    }
    protected function ef5_fancy_box_desc($atts, $args=[]){
        extract($atts);
        if(empty($desc)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-fancybox-desc', $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>"><?php echo theclick_html($desc); ?></div>
        <?php
    }
    protected function ef5_fancy_box_link($atts, $args=[]){
        extract($atts);
        /* parse button link */
        $use_link = false;
        if(!empty($atts['button_link'])){
            $button_link = vc_build_link( $atts['button_link'] );
            $button_link = ( $button_link == '||' ) ? '' : $button_link;
            if ( strlen( $button_link['url'] ) > 0 ) {
                $use_link = true; 
                $a_href = $button_link['url'];
                $a_title = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read more','theclick') ;
                $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
            }
        }
        if(!($use_link)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-fancybox-link', $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>">
                <a href="<?php echo esc_url($a_href) ?>" target="<?php echo esc_attr($a_target);?>">
                    <?php echo esc_html($a_title);?>
                </a>
            </div>
        <?php
    }
}