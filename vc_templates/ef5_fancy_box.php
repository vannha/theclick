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

?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<?php switch ($layout_template) {
		default:
        	echo theclick_html($this->ef5_fancy_box_icon($atts,['class' => '']));
        	echo theclick_html($this->ef5_fancy_box_heading($atts,['class'=> '']));
        	echo theclick_html($this->ef5_fancy_box_desc($atts));
        	echo theclick_html($this->ef5_fancy_box_link($atts));
         break;
	} ?>
</div>