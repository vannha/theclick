<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_socials
 */
/* get Shortcode custom value */
    $styles = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $values = (array) vc_param_group_parse_atts( $values );
    $wrap_css_classes = array(
        'ef5-social',
        'ef5-social-'.$layout_template,
        'text-'.$el_content_align
    );
    if($ef5_padding !== 'default') $wrap_css_classes[] = 'ef5-padding-'.$ef5_padding;
    if($ef5_margin !== 'default') $wrap_css_classes[]  = 'ef5-padding-'.$ef5_margin;
    $hint_pos = isset($el_icon_hint_pos) ? $el_icon_hint_pos : '';

    switch ($layout_template) {
        case '1':
            $wrap_css_classes[] = 'text-12';
            break;
    }
     
?>
<div class="ef5-social-wraps">
    <div class="<?php echo trim(implode(' ', $wrap_css_classes)); ?>">
    <?php
        if(!empty($el_title)) echo '<span class="ef5-el-title">' . $el_title . '</span>';
        switch ($source) {
            case 'custom':
                foreach($values as $value){
                    vc_icon_element_fonts_enqueue( $value['i_type'] );  /* Call icon font libs */
                    $iconClass = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : ''; /* get icon class */
                    $link_open = '<a href="javascript:void(0)" data-hint="'.esc_html__('Follow Us','theclick').'">';
                    $link_close = '</a>';           
                    if (isset($value['icon_link'])){  
                        $link = vc_build_link($value['icon_link']);
                        $link = ( $link == '||' ) ? '' : $link;
                        if ( strlen( $link['url'] ) > 0 ) {
                            $a_href    = $link['url'];
                            $a_title   = isset($link['title']) && !empty($link['title']) ? $link['title'] : esc_html__('Follow Us','theclick');
                            $a_target  = strlen( $link['target'] ) > 0 ? str_replace(' ', '', $link['target']) : '_blank';

                            $link_open = '<a class="hint--'.$hint_pos.'" data-hint="'.esc_attr($a_title).'" href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'" '.$styles.'>';
                            $link_close = '</a>';
                        }
                    }
                    
                    if($iconClass) {
                        echo theclick_html($link_open); 
                        echo '<span class="'.esc_attr($iconClass).'"></span>';
                        echo theclick_html($link_close); 
                    }
                }
                break;
             
            default:
                break;
         } 
    ?>
    </div>
</div>


