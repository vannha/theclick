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

$style_inline = '';
if($layout_template == '2'){
    $image_url = '';
	if (!empty($cd_image)) {
	    $attachment_image = wp_get_attachment_image_src($cd_image, 'full');
	    $image_url = $attachment_image[0];
	}
    $thumbnail_size = $thumbnail_size != '' ? $thumbnail_size : 'full';

    $link     = (isset($link)) ? $link : '';
    $link     = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href   = $link['url'];
        $a_title  = !empty($link['title']) ? $link['title'] : esc_html__('Shop Now','theclick');
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
	
	$wrap_css_class[] = 'text-center'; 

	$style_inline = 'style="background:url('.esc_url($image_url).') no-repeat; background-size: cover;"';

}
?>
<div class="<?php echo theclick_optimize_css_class(implode(' ', $wrap_css_class));?>" <?php echo theclick_html($style_inline) ?>>
	<?php 
	if($layout_template == '2' && !empty($cd_image)) 
		theclick_image_by_size(['id' => $cd_image,'size' => $thumbnail_size, 'class' => 'cd-img']);

	if($layout_template == '2'): 
		echo '<div class="cd-content-wrap">';
		echo '<div class="cd-sub-title">'.esc_html($sub_title).'</div>';
		echo '<div class="cd-main-title">'.esc_html($main_title).'</div>';
		if($use_link) echo '<a href="'.esc_url($a_href).'" class="link-shop-more" target="'.esc_attr($a_target).'">'.esc_html($a_title).'</a>'; 
	endif;
	?>
	<div class="ef5-countdown-bar ef5-countdown-time" data-count="<?php echo esc_attr(date('Y,m,d,H,i,s', $time)); ?>" data-format="<?php echo esc_attr($time_format);?>" data-label="<?php echo esc_attr($time_label);?>" data-timezone="<?php echo esc_attr($gmt_offset); ?>"></div> 

	<?php if($layout_template == '2') echo '</div>'; ?>
</div>

         


