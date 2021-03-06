<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_fancy_icon
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);
// Wrap css class
$wrap_css_class = ['ef5-fancybox','ef5-fancybox-'.$layout_template, 'transition', $el_class];
$wrap_css_class = [
    'ef5-fancybox',
    'ef5-fancybox-'.$layout_template,
    'transition',
    $this->getCSSAnimation($atts['fancy_css_animation']),
    $el_class
];

$fancy_style = [];
$fancy_style[] = (!empty($bg_color)) ? 'background-color:'.$bg_color.';' : '';

$fancy_attrs[] = 'class="'.trim(implode(' ', $wrap_css_class)).'"';
$fancy_attrs[] = 'style="'.trim(implode(' ', $fancy_style)).'"';
?>
<div <?php echo trim(implode(' ', $fancy_attrs));?>>
	<?php switch ($layout_template) {
		default:
        	echo $this->ef5_fancy_box_icon($atts,['class' => '']);
        	echo $this->ef5_fancy_box_heading($atts,['class'=> '']);
        	echo $this->ef5_fancy_box_desc($atts);
        	echo $this->ef5_fancy_box_link($atts);
     	break;
	} ?>
</div>