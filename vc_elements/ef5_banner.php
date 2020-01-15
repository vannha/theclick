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
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Item",'theclick'),
            "param_name" => "bn_image",
            'group'      => esc_html__('Media', 'theclick')
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'banner_css_animation',
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
                    "style-1"
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
                    "style-1"
                ),
            ),
            "group" => esc_html__("Title 1", 'theclick'),
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'title_1_css_animation',
            'group'      => esc_html__('Title 1', 'theclick')
        ]), 
        array(
        	"type" => "textfield",
            "heading" => esc_html__("Title 2",'theclick'),
            "param_name" => "title2",
            "value" => "",
            "dependency" => array(
                "element" => 'banner_style',
                "value" => array(
                    "style-1"
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
                    "style-1"
                ),
            ),
            "group" => esc_html__("Title 2", 'theclick'),
        ),
        ef5systems_vc_map_add_css_animation([
            'param_name' => 'title_2_css_animation',
            'group'      => esc_html__('Title 2', 'theclick')
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
        $wrap_css_class = ['ef5-banner-wrap','ef5-banner-'.$banner_style, $el_class];
        echo trim(implode(' ', $wrap_css_class));
    }
    protected function ef5_banner_main_banner($atts,$args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        if (!empty($bn_image)) {
            $attachment_image = wp_get_attachment_image_src($bn_image, 'full');
            $image_url = $attachment_image[0];
        }
        var_dump($link);
       /* $link     = (isset($link)) ? $link : '';

        $link     = vc_build_link( $link );
        $use_link = false;
        if ( strlen( $link['url'] ) > 0 ) {
            $use_link = true;
            $a_href   = $link['url'];
            $a_title  = !empty($link['title'])?$link['title']: esc_html__('Take a look','theclick');
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }*/

        $banner_attrs = [];

        $banner_css_class = [
            'main-banner',
            $this->getCSSAnimation($atts['banner_css_animation']),
            $args['class']
        ];
 
        $banner_attrs[] = 'class="'.trim(implode(' ', $banner_css_class)).'"';
         
        ?>
        <div <?php echo trim(implode(' ', $heading_attrs));?>><?php 
            echo 'aaaaaaa';
            //echo theclick_html($heading_text); 
        ?></div>
        <?php 
    }
    protected function ef5_banner_title_1($atts,$args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
    }
    protected function ef5_banner_title_2($atts,$args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
    }
    protected function ef5_banner_button($atts,$args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
    }
    
}