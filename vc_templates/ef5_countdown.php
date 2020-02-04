<?php
	if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_countdown
 * HTML Output
 	<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
		<div class="ef5-cxountdown-bar ef5-countdown-time is-countdown" data-count="2030,11,10,00,00,00" data-format="1" data-label="Years, Month, Week, Days, Hours, Mins, Secs" data-timezone="0">
			<span class="item year"><span class="item-inner">
				<span class="item-content">
					<span class="amount">11</span>
					<span class="title">Years</span>
				</span>
			</span></span>
			<span class="item month"><span class="item-inner">
				<span class="item-content">
					<span class="amount">09</span>
					<span class="title"> Month</span>
				</span>
			</span></span>
			<span class="item week"><span class="item-inner">
				<span class="item-content">
					<span class="amount">03</span>
					<span class="title"> Week</span>
				</span>
			</span></span>
			<span class="item day"><span class="item-inner">
				<span class="item-content">
					<span class="amount">02</span>
					<span class="title"> Days</span>
				</span>
			</span></span>
			<span class="item hour"><span class="item-inner">
				<span class="item-content">
					<span class="amount">15</span>
					<span class="title"> Hours</span>
				</span>
			</span></span>
			<span class="item minute"><span class="item-inner">
				<span class="item-content">
					<span class="amount">59</span>
					<span class="title"> Mins</span>
				</span>
			</span></span>
			<span class="item second"><span class="item-inner">
				<span class="item-content">
					<span class="amount">55</span>
					<span class="title"> Secs</span>
				</span>
			</span></span>
		</div>
	</div>
 */
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

         


