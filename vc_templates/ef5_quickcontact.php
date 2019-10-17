<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_quickcontact
 */
/* get Shortcode custom value */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$wrap_css_class = [
    'ef5-qc', 
    'ef5-qc-'.$layout_template, 
    $content_align, 
    $content_color,
    $el_class 
];
$wrap_inner_css_class = ['row'];
$item_class = ['qc-item'];
$item_inner_class = ['row'];
switch ($layout_template) {
    case '1':
        $wrap_css_class[] = 'text-12 font-style-500';
        $item_class[] = 'col-12';
        $item_inner_class[] = 'gutter-10 align-items-center';
    break;
}
$qc_infos = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $qc_infos['values'] );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add your contact info','theclick').'</p>';
    return;
}
$qc_icon = $qc_text = '';
$icon_color = !empty($icon_color) ? $icon_color : '';
$icon_classes = ['qc-icon', $icon_color];
?>
<div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <?php 
        if(!empty($img_id)) theclick_image_by_size([
            'id'     => $img_id, 
            'size'   => '270x184',
            'class'  => 'image-fit',
            'before' =>'<div class="qc-image col-12">',
            'after'  => '</div>'
        ]);
        if(!empty($el_title)) echo '<div class="ef5-el-title ef5-heading qc-heading">'.esc_html($el_title).'</div>'; 
    ?>
    <div class="<?php echo trim(implode(' ', $wrap_inner_css_class));?>">
        <?php
            ob_start();
            if($layout_template === '2'){
                $this->theclick_qc_direction($atts);
            }
            foreach($values as $value){
                $this->theclick_qc_item_render($atts, $value);
            }
            echo ob_get_clean();
        ?>
    </div>
</div>
