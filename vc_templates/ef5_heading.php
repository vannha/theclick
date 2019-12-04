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
			case '2':
				$this->ef5_heading_main_heading($atts,['class' => 'text-24 ef5-heading lh-32']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22 text-white']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent outline ef5-btn-md']);
				break;
			default:
				$this->ef5_heading_main_heading($atts,['class' => 'text-36 text-lg-50 ef5-heading']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent fill ef5-btn-md']);
				break;
		}
	?>
</div>