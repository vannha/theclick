<?php
if(!class_exists('Newsletter')) return;
vc_map(array(
	'name'        => 'TheClick Newsletter',
	'base'        => 'ef5_newsletter',
	'icon'        => 'ef5-icon-newsletter',
	'category'    => esc_html__('TheClick', 'theclick'),
	'description' => esc_html__('Add Newsletter Form.', 'theclick'),
	'params'      => array(
		array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','theclick'),
            'param_name' => 'layout_template',
            'value'      =>  array(
				'1' => get_template_directory_uri().'/vc_elements/layouts/newsletter-1.png',
				'2' => get_template_directory_uri() . '/vc_elements/layouts/newsletter-2.png',
				'3' => get_template_directory_uri() . '/vc_elements/layouts/newsletter-3.png',
            ),
            'std'        => '1',
            'admin_label'=> true
        ),
        array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Layout Mode', 'theclick' ),
			'description' => esc_html__( 'Choose Layout mode you want to show', 'theclick' ),
			'param_name'  => 'layout_mode',
			'value'       => array(
				esc_html__('Newsletter','theclick')         => 'default',
				esc_html__('Newsletter Minimal','theclick') => 'minimal',
			),
			'std'		  => 'minimal',
			'admin_label' => true,
    	),
    	array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Item",'theclick'),
            "param_name" => "nsl_image",
            'dependency'    => array(
				'element'   => 'layout_template',
				'value'     => '3',
			)
        ),
        array(
            'type'          => 'textfield',
            'param_name'    => 'thumbnail_size',
            'heading'       => esc_html__('Thumbnail Size (Leave blank to use default size)','theclick'),
            'description'   => esc_html__('Enter our defined size: "thumbnail", "medium", "large", "post-thumbnail", "full". Or alternatively enter size in pixels (Example: 200x100 (Width x Height)).','theclick'),
            'std'           => '',
            'dependency'    => array(
				'element'   => 'layout_template',
				'value'     => '3',
			)
        ),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Element Title', 'theclick' ),
			'description' => esc_html__( 'Enter the text you want to show as title', 'theclick' ),
			'param_name'  => 'el_title',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
    	),
        array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Sub Title', 'theclick' ),
			'description' => esc_html__( 'Enter the text you want to show as sub title', 'theclick' ),
			'param_name'  => 'el_sub_title',
			'value'       => '',
			'std'		  => '',
			'dependency'    => array(
				'element'   => 'layout_template',
				'value'     => '3',
			),
    	),
        array(
			'type'        => 'checkbox',
			'description' => esc_html__( 'Show field name', 'theclick' ),
			'param_name'  => 'show_name',
			'value'       => array(
				esc_html__( 'Show Name', 'theclick' ) => '1'
			),
			'std'		  => '0',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
		),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Name Text', 'theclick' ),
			'description' => esc_html__( 'Enter name text', 'theclick' ),
			'param_name'  => 'name_text',
			'value'       => 'Your Name',
			'std'		  => 'Your Name',
			'dependency'    => array(
				'element'   => 'show_name',
				'value'     => '1',
			),
    	),
        array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Email Text', 'theclick' ),
			'description' => esc_html__( 'Enter email text', 'theclick' ),
			'param_name'  => 'email_text',
			'value'       => 'E-mail address',
			'std'		  => 'E-mail address',
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Button Text', 'theclick' ),
			'description' => esc_html__( 'Enter button text', 'theclick' ),
			'param_name'  => 'btn_text',
			'value'       => 'Subscribe',
			'std'		  => 'Subscribe',
    	),
    	ef5systems_vc_map_add_css_animation([
            'param_name' => 'nsl_css_animation'
        ]), 
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'theclick' ),
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick' ),
			'param_name'  => 'el_class',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
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
        	'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'theclick' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design', 'theclick' ),
        )
    ) 
));

class WPBakeryShortCode_ef5_newsletter extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
    protected function theclick_title($atts, $args=[]){
    	if(empty($atts['el_title'])) return;
    	$args = wp_parse_args($args, [
    		'class' => ''
    	]);
    	$classes = ['ef5-el-title', 'ef5-heading', $args['class']];
    	?>
		<div class="<?php echo trim(implode(' ', $classes));?>"><?php echo esc_html($atts['el_title']); ?></div>
    	<?php
    }
    protected function theclick_sub_title($atts, $args=[]){
    	if(empty($atts['el_title'])) return;
    	$args = wp_parse_args($args, [
    		'class' => ''
    	]);
    	$classes = ['sub-title', $args['class']];
    	?>
		<div class="<?php echo trim(implode(' ', $classes));?>"><?php echo esc_html($atts['el_sub_title']); ?></div>
    	<?php
    }
    protected function theclick_nsl_media($atts,$args = []){ 
        extract( $atts );
        $args = wp_parse_args($args, [
            'class' => ''        
        ]);
        $image_url = '';
        if (!empty($nsl_image)) {
            $attachment_image = wp_get_attachment_image_src($nsl_image, 'full');
            $image_url = $attachment_image[0];
        }
        if(empty($image_url)) return;

  		theclick_image_by_size(['id' => $nsl_image,'size' => $thumbnail_size, 'class' => 'nsl-img']);
        ?>
        
        <?php 
    }
   
}