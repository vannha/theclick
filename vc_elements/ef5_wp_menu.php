<?php
vc_map(array(
    'name'        => 'OverCome Custom Menu',
    'base'        => 'ef5_wp_menu',
    'category'    => esc_html__('OverCome', 'theclick'),
    'description' => esc_html__('Use this element to add one of your custom menus', 'theclick'),
    'icon'        => 'icon-wpb-wp',
    'params'      => array_merge(
    	array(
	        array(
			    'type'        => 'dropdown',
			    'heading'     => esc_html__( 'Menu', 'theclick' ),
			    'param_name'  => 'nav_menu',
			    'value'       => ef5systems_options_menu_list_for_vc(),
			    'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'theclick' ) : esc_html__( 'Select menu to display.', 'theclick' ),
			    'admin_label' => true,
			    'save_always' => true,
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Type','theclick'),
                'param_name' => 'layout_type',
                'value'      =>  array(
                    esc_html__('Default','theclick')  => 'default',
                    esc_html__('Toggle','theclick')   => 'toggle',
                ),
                'std'        => 'default',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Title','theclick'),
                'description'   => esc_html__('What text use as a title?','theclick'),
                'param_name'    => 'el_title',
                'value'         => '',
                'admin_label'   => true
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'add_title_icon',
                'value'         => array(
                    esc_html__('Add title icon?','theclick') => '1'
                ),
                'std'           => '0',
                'dependency'    => array(
                    'element'   => 'el_title',
                    'not_empty' => true
                ),
            ),
        ),
        ef5systems_icon_libs([
            'group'        => '',
            'field_prefix' => 'title_icon_',
            'dependency'   => 'add_title_icon',
            'dependency_value'  => '1' 
        ]),
        ef5systems_icon_libs_icon([
            'group'        => '',
            'field_prefix' => 'title_icon_',
        ]),
        array(
			array(
				'type'        => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'theclick' ),
				'param_name'  => 'el_id',
				'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'theclick' ), '//w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'theclick' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theclick' ),
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Mode','theclick'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    esc_html__('Vertical','theclick')   => 'vertical',
                    esc_html__('Vertical (2 Columns)','theclick')   => 'vertical two-col',
                    esc_html__('Horizontal','theclick') => 'horizontal',
                    esc_html__('Horizontal and Center','theclick') => 'horizontal justify-content-center',
                ),
                'std'        => 'vertical',
                'admin_label' => true,
                'group' => esc_html__('Layout','theclick')
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'add_divider',
                'value'      => array(
                    esc_html__('Add Divider','theclick') => '1'
                ),
                'std'        => '0',
                'dependency'    => array(
                    'element' => 'layout_mode',
                    'value'   => array('horizontal', 'horizontal justify-content-center')
                ),
                'group' => esc_html__('Layout','theclick')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Divider Style','theclick'),
                'param_name' => 'divider_style',
                'value'      =>  array(
                    esc_html__('Horizontal','theclick') => 'horizontal',
                    esc_html__('Vertical','theclick')   => 'vertical',
                    esc_html__('Circle','theclick')     => 'circle',
                ),
                'std'        => 'horizontal',
                'dependency'    => array(
                    'element' => 'add_divider',
                    'value'   => '1'
                ),
                'group' => esc_html__('Layout','theclick')
            ),
    	)
    )
));
class WPBakeryShortCode_ef5_wp_menu extends WPBakeryShortCode
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