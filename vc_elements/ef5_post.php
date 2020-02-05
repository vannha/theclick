<?php
vc_map(array(
    'name'          => 'TheClick Post',
    'base'          => 'ef5_post',
    'category'      => esc_html__('TheClick', 'theclick'),
    'description'   => esc_html__('Display your post with single layout', 'theclick'),
    'icon'         => 'icon-wpb-application-icon-large',
    'params'        => array(
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Post ID','theclick'),
            'param_name' => 'post_id',
            'value'      => '',
            'description' => esc_html__('Enter the single post id', 'theclick')
        ), 
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Excerpt number word','theclick'),
            'param_name' => 'number_word',
            'value'      => '40',
            'description' => esc_html__('Enter the excerpt word for display', 'theclick')
        ),
        array(
            'type'          => 'textfield',
            'param_name'    => 'thumbnail_size',
            'heading'       => esc_html__('Thumbnail Size (Leave blank to use default size)','theclick'),
            'description'   => esc_html__('Enter our defined size: "thumbnail", "medium", "large", "post-thumbnail", "full". Or alternatively enter size in pixels (Example: 200x100 (Width x Height)).','theclick'),
            'std'           => ''
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Extra Class','theclick'),
            'param_name' => 'el_class',
            'value'      => '',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick'),
        ) 
    )
));

class WPBakeryShortCode_ef5_post extends WPBakeryShortCode{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
     
}
