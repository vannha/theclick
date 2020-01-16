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
                '1' => get_template_directory_uri().'/vc_elements/layouts/banner-style1.jpg', 
            ),
            'param_name' => 'banner_style',
            "admin_label" => true
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'banner_css_animation'
        ]), 
        array(
            "type" => "textfield",
            "heading" => esc_html__("Class",'theclick'),
            "param_name" => "el_class",
            "value" => "",
        ), 
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Item",'theclick'),
            "param_name" => "bn_image",
            'group'      => esc_html__('Media', 'theclick')
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'media_css_animation',
            'group'      => esc_html__('Media', 'theclick')
        ]), 
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'theclick' ),
            'param_name' => 'link',
            'group'      => esc_html__('Link', 'theclick')
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'button_link_css_animation',
            'group'      => esc_html__('Link', 'theclick')
        ]), 


        array(
        	"type" => "textfield",
            "heading" => esc_html__("Main Title",'theclick'),
            "param_name" => "main_title",
            "value" => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "1"
                ),
            ),
            "group" => esc_html__("Main Title", 'theclick'),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 1 color", 'theclick'),
            "param_name" => "main_title_color",
            "value"      => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "1"
                ),
            ),
            "group" => esc_html__("Main Title", 'theclick'),
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'main_title_css_animation',
            'group'      => esc_html__('Main Title', 'theclick')
        ]), 
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Sub Title",'theclick'),
            "param_name" => "sub_title",
            "value" => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "1"
                ),
            ),
            "group" => esc_html__("Sub Title", 'theclick'),
        ),
        array(
            "type"       => "colorpicker",
            "heading"    => esc_html__("Title 2 color", 'theclick'),
            "param_name" => "sub_title_color",
            "value"      => "", 
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "1"
                ),
            ),
            "group" => esc_html__("Sub Title", 'theclick'),
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'sub_title_css_animation',
            'group'      => esc_html__('Sub Title', 'theclick')
        ]), 
           
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
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }
    protected function theclick_banner_wrap_css_class($atts){ 
        extract( $atts );

        $el_class = $this->getExtraClass( $el_class );
        $wrap_css_class = [
            'ef5-banner-wrap',
            'ef5-banner-'.$banner_style,
            $this->getCSSAnimation($atts['banner_css_animation']),
            $el_class
        ];
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $wrap_css_class ) ), $this->settings['base'], $atts ) );
        echo trim(implode(' ', $css_class));
    }
    protected function ef5_banner_main_media($atts,$args = []){ 
        extract( $atts );
        $args = wp_parse_args($args, [
            'class' => ''        
        ]);
        $image_url = '';
        if (!empty($bn_image)) {
            $attachment_image = wp_get_attachment_image_src($bn_image, 'full');
            $image_url = $attachment_image[0];
        }
        if(empty($image_url)) return;

        $link     = (isset($link)) ? $link : '';
        $link     = vc_build_link( $link );
        $use_link = false;
        if ( strlen( $link['url'] ) > 0 ) {
            $use_link = true;
            $a_href   = $link['url'];
            $a_title  = !empty($link['title'])?$link['title']: esc_html__('Explore Now','theclick');
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }

        $banner_attrs = [];
        $banner_css_class = [
            'main-media',
            $this->getCSSAnimation($atts['media_css_animation']),
            $args['class']
        ];
        $banner_attrs[] = 'class="'.trim(implode(' ', $banner_css_class)).'"';
         
        ?>
        <div <?php echo trim(implode(' ', $banner_attrs));?>>
            <?php if($use_link) echo '<a href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'">'; ?>
            <img src="<?php echo esc_url($image_url);?>" class="media-img" alt="<?php echo esc_attr($a_title);?>">
            <?php if($use_link) echo '</a>'; ?>
        </div>
        <?php 
    }
    protected function ef5_banner_main_title($atts,$args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        if(empty($main_title)) return;

        $link     = (isset($link)) ? $link : '';
        $link     = vc_build_link( $link );
        $use_link = false;
        if ( strlen( $link['url'] ) > 0 ) {
            $use_link = true;
            $a_href   = $link['url'];
            $a_title  = !empty($link['title'])?$link['title']: esc_html__('Explore Now','theclick');
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }

        $main_title_attrs = [];
        $main_title_css_class = [
            'main-title',
            $this->getCSSAnimation($atts['main_title_css_animation']),
            $args['class']
        ];

        $main_title_style = [];
        $main_title_style[] = (!empty($main_title_color)) ? 'color:'.$main_title_color.';' : '';

        $main_title_attrs[] = 'class="'.trim(implode(' ', $main_title_css_class)).'"';
        $main_title_attrs[] = 'style="'.trim(implode(' ', $main_title_style)).'"';
        ?>
        <div <?php echo trim(implode(' ', $main_title_attrs));?>><?php 
            if($use_link) echo '<a href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'">';
                echo esc_html($main_title);
            if($use_link) echo '</a>'; 
            ?></div><?php 
    }
    protected function ef5_banner_sub_title($atts,$args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        if(empty($sub_title)) return;

        $sub_title_attrs = [];
        $sub_title_css_class = [
            'sub-title',
            $this->getCSSAnimation($atts['sub_title_css_animation']),
            $args['class']
        ];

        $sub_title_style = [];
        $sub_title_style[] = (!empty($sub_title_color)) ? 'color:'.$sub_title_color.';' : '';

        $sub_title_attrs[] = 'class="'.trim(implode(' ', $sub_title_css_class)).'"';
        $sub_title_attrs[] = 'style="'.trim(implode(' ', $sub_title_style)).'"';
        ?>
        <span <?php echo trim(implode(' ', $sub_title_attrs));?>><?php echo esc_html($sub_title); ?></span>
        <?php 
    }
    protected function ef5_banner_button($atts,$args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );

        $link     = (isset($link)) ? $link : '';
        $link     = vc_build_link( $link );
        $use_link = false;
        if ( strlen( $link['url'] ) > 0 ) {
            $use_link = true;
            $a_href   = $link['url'];
            $a_title  = !empty($link['title'])?$link['title']: esc_html__('Explore Now','theclick');
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }

        if(!$use_link) return;

        $banner_btn_link_attrs = [];
        $banner_btn_link_css_class = [
            'banner_btn_link',
            $this->getCSSAnimation($atts['button_link_css_animation']),
            $args['class']
        ];

        $banner_btn_link_attrs[] = 'class="'.trim(implode(' ', $banner_btn_link_css_class)).'"';

        echo '<a href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'" class="'.trim(implode(' ', $banner_btn_link_css_class)).'">'.esc_html($a_title).'</a>';
    }
    
}