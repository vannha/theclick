<?php
vc_map(array(
    'name' => 'OverCome Empty Space',
    'base' => 'ef5_emptyspace',
    'icon' => 'icon-wpb-ui-empty_space',
    'category' => esc_html__('OverCome', 'theclick'),
    'description' => esc_html__('Blank space with custom height for each screen size', 'theclick'),
    'params' => array(
        array(
            'type'       => 'param_group',
            'heading'    => esc_html__( 'Add Custom Screen Size', 'theclick' ),
            'description' => esc_html__('Enter your screen size, ex: 1920px (Note: CSS measurement units allowed).','theclick'),
            'param_name' => 'values',
            'value'      => urlencode( json_encode( array(
                array(
                    'screen_size' => '',
                ),
            ) ) ),
            'params' => array(
                array(
                    'type'             => 'textfield',
                    'heading'          => esc_html__( 'Min Screen Size', 'theclick' ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'param_name'       => 'screen_size_min',
                    'admin_label'      => true,
                ),
                array(
                    'type'             => 'textfield',
                    'heading'          => esc_html__( 'Max Screen Size', 'theclick' ),
                    'description'      => esc_html__( 'Default: 4800px', 'theclick' ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'param_name'       => 'screen_size_max',
                    'admin_label'      => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Empty space height', 'theclick' ),
                    'param_name'  => 'height',
                    'description' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).','theclick'),
                ),
            ),
        ),
        array(
            'type'       => 'el_id',
            'heading'    => esc_html__('Element ID','theclick'),
            'param_name' => 'el_id',
            'settings' => array(
                'auto_generate' => true,
            ),
            'description'   => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'theclick' ), '//w3schools.com/tags/att_global_id.asp' ),
        ),
    ),
));

class WPBakeryShortCode_ef5_emptyspace extends WPBakeryShortCode
{
    protected $atts = array();
    protected $css = '';
    protected function content($atts, $content = null)
    {
        $this->atts = $atts;
        $this->emptyspace_css(); 
        add_action('wp_footer', array($this,'emptyspace_css_render'),99);
        return  $this->loadTemplate( $atts, $content );
    }

    function emptyspace_css_render(){ 
        echo '<div class="ef5-inline-css" data-css="'.$this->css.'"></div>'; 
    }

    public function emptyspace_css() {
        $atts = $this->atts;
        extract( $atts );
        $el_id = 'esp'.$el_id ;
        $values = (array) vc_param_group_parse_atts( $atts['values'] );
        $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
        $class = $css_class = $screen_size_min_width = $screen_size_max_width = $min_width = $max_width = $and = $height_screen_size = '';
        $empty_space_css = array();
        foreach($values as $value){
            $screen_size_min = isset($value['screen_size_min']) ? $value['screen_size_min'] : '320';
            $screen_size_max = isset($value['screen_size_max']) ? $value['screen_size_max'] : '4800';
            $screen_size_height = isset($value['height']) ? $value['height'] : '';
            if(!empty($screen_size_min)){
                /* allowed metrics: //w3schools.com/cssref/css_units.asp */
                /* get screen size width */
                $regexr_screen_size_width = preg_match( $pattern, $screen_size_min, $matches );
                $value_screen_size_width  = isset( $matches[1] ) ? (float) $matches[1] : (float) WPBMap::getParam( '7emptyspace', $screen_size_min );
                $unit_screen_size_width   = isset( $matches[2] ) ? $matches[2] : 'px';
                $screen_size_min_width    = $value_screen_size_width . $unit_screen_size_width;
                $min_width = '(min-width: '.$screen_size_min_width.')';
            }
            if(!empty($screen_size_max)){
                /* allowed metrics: //w3schools.com/cssref/css_units.asp */
                /* get screen size width */
                $regexr_screen_size_max_width = preg_match( $pattern, $screen_size_max, $matches );
                $value_screen_size_max_width  = isset( $matches[1] ) ? (float) $matches[1] : (float) WPBMap::getParam( '7emptyspace', $screen_size_max );
                $unit_screen_size_max_width   = isset( $matches[2] ) ? $matches[2] : 'px';
                $screen_size_max_width        = $value_screen_size_max_width . $unit_screen_size_max_width;
                $max_width = '(max-width: '.$screen_size_max_width.')';
            }
            if(!empty($min_width) && !empty($max_width)) $and = 'and';

            /* get space height on screen size */
            if(isset($screen_size_height) && $screen_size_height !== ''){
                $regexr_screen_size_height = preg_match( $pattern, $screen_size_height, $matches );
                $value_screen_size_height  = isset( $matches[1] ) ? (float) $matches[1] : (float) WPBMap::getParam( '7emptyspace', $screen_size_height );
                $unit_screen_size_height   = isset( $matches[2] ) ? $matches[2] : 'px';
                $height_screen_size        = $value_screen_size_height . $unit_screen_size_height;
                /* Build CSS */
                $empty_space_css[]= ' @media '.$min_width.' '.$and.' '.$max_width.' {#'.$el_id.' {height:'.$height_screen_size.';}}';
            }
        }
        $css = trim(implode('', $empty_space_css));
        $this->css .= $css;
    }
}