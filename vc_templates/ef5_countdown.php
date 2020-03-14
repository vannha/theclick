<?php
	if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$time = strtotime($time);
$date_sever = date_i18n('Y-m-d G:i:s');   
$gmt_offset = get_option( 'gmt_offset' );
/* check if current time from config is empty or less than current time 
 * && (strtotime($time) < strtotime('now'))
 */
if(empty($time)) $time = strtotime("+22 days 18 hours 30 minutes 55 seconds");

$wrap_css_class = ['ef5-countdown','ef5-countdown-layout-'.$layout_template, $color, $shape, $size, $this->getCSSAnimation( $css_animation) ];	
?>
<div class="<?php echo theclick_optimize_css_class(implode(' ', $wrap_css_class));?>">
	<div class="ef5-countdown-bar ef5-countdown-time" data-count="<?php echo esc_attr(date('Y,m,d,H,i,s', $time)); ?>" data-format="<?php echo esc_attr($time_format);?>" data-label="<?php echo esc_attr($time_label);?>" data-timezone="<?php echo esc_attr($gmt_offset); ?>"></div> 
</div>

         


