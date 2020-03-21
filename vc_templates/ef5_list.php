<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_lists
 */
/* get Shortcode custom value */
    $styles = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $values = (array) vc_param_group_parse_atts( $values );
    $wrap_css_classes = array(
        'ef5-list',
        'ef5-list-'.$layout_template
    );
    if($ef5_padding !== 'default') $wrap_css_classes[] = 'ef5-padding-'.$ef5_padding;
    if($ef5_margin !== 'default') $wrap_css_classes[]  = 'ef5-padding-'.$ef5_margin;
    $hint_pos = isset($el_icon_hint_pos) ? $el_icon_hint_pos : 'top';
    // Title
    if(!empty($el_title)){
        $el_title_icon = '';
        if($add_title_icon){
            vc_icon_element_fonts_enqueue($title_icon_type);
            $title_iconClass = ${'title_icon_icon_'.$title_icon_type};
            $el_title_icon = !empty($title_iconClass) ? '<span class="title-icon '.$title_iconClass.'"></span>' : '';
        }
        $title = '<div class="ef5-el-title">'.$el_title_icon.$el_title.'</div>';
    }
?>
<div class="ef5-list-wraps">
    <div class="<?php echo trim(implode(' ', $wrap_css_classes)); ?>">
    <?php
        if(!empty($el_title)) echo theclick_html($title);
        foreach($values as $value){
            vc_icon_element_fonts_enqueue( $value['i_type'] );  /* Call icon font libs */
            $iconClass = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : ''; /* get icon class */
            if(!empty($value['text'])){
                $output = '<div class="ef5-list-item">';
                if($iconClass) {
                    $output .= '<span class="'.esc_attr($iconClass).' ef5-list-item-icon ef5-text-accent"></span>';
                }
                $output .= $value['text'];
                $output .= '</div>';

                echo theclick_html($output);
            }
        }
    ?>
    </div>
</div>


