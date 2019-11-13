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
$wrapper_class = array('ef5-user-block', $el_class);
?>
<div class="<?php echo trim(implode(' ',$wrapper_class)); ?>">xxx
	<?php
	
    ?>
</div>