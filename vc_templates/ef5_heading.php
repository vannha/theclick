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
$heading_text_clss = ['ef5-heading'];
if(!empty($heading_text_sm)) $heading_text_clss[] = 'text-'.$heading_text_sm;
if(!empty($heading_text_md)) $heading_text_clss[] = 'text-md-'.$heading_text_md;
if(!empty($heading_text_lg)) $heading_text_clss[] = 'text-lg-'.$heading_text_lg;
if(!empty($heading_text_xl)) $heading_text_clss[] = 'text-xl-'.$heading_text_xl;
$heading_text_cls = implode(' ', $heading_text_clss);
?>
<div class="<?php $this->theclick_heading_wrap_css_class($atts); ?>">
	<?php 
		switch ($layout_template) {
			case '2':
				$this->ef5_heading_main_heading($atts,['class' => $heading_text_cls]);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22 text-white']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent outline ef5-btn-md']);
				break;
			default:
				$this->ef5_heading_main_heading($atts,['class' => $heading_text_cls]);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent fill ef5-btn-md']);
				break;
		}
	?>
</div>