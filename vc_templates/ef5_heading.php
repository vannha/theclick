<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_heading
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="<?php $this->theclick_heading_wrap_css_class($atts); ?>">
	<?php 
		switch ($layout_template) {
			case '3':
				$this->ef5_heading_small_heading($atts, ['class' => 'text-22 text-uppercase text-white']);
				$this->ef5_heading_main_heading_icon($atts);
				$this->ef5_heading_main_heading($atts,['class' => 'text-48 font-style-700 ef5-heading text-white']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22 text-white']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent outline ef5-btn-md']);
				break;
			default:
				$this->ef5_heading_small_heading($atts, ['class' => 'text-22 text-uppercase ef5-text-accent']);
				$this->ef5_heading_main_heading_icon($atts);
				$this->ef5_heading_main_heading($atts,['class' => 'text-36 font-style-700 ef5-heading']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent fill ef5-btn-md']);
				break;
		}
	?>
</div>