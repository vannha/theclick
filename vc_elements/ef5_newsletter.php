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
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Element Title', 'theclick' ),
			'description' => esc_html__( 'Enter the text you want to show as title', 'theclick' ),
			'param_name'  => 'el_title',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
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
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','theclick'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_elements/layouts/newsletter-1.png',
            ),
            'std'        => '1',
            'admin_label'=> true
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
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'theclick' ),
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick' ),
			'param_name'  => 'el_class',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
    	),
    ) 
));

class WPBakeryShortCode_ef5_newsletter extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
    protected function title($atts, $args=[]){
    	if(empty($atts['el_title'])) return;
    	$args = wp_parse_args($args, [
    		'class' => ''
    	]);
    	$classes = ['ef5-el-title', 'ef5-heading', $args['class']];
    	?>
    		<div class="<?php echo trim(implode(' ', $classes));?>">
    			<?php echo esc_html($atts['el_title']); ?>
    		</div>
    	<?php
    }
}