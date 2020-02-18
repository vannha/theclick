<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);

$el_id = !empty($el_id) ? 'ef5-banner-' . $el_id : uniqid('ef5-banner-');
?>
<div id="<?php echo esc_attr($el_id); ?>" class="<?php $this->theclick_banner_wrap_css_class($atts); ?>">
    <?php 
    switch ($banner_style) {
        case '2': 
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_main_media($atts,['class' => '']);
            break;
        case '1':
            $this->ef5_banner_main_media($atts,['class' => '']);
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_sub_title($atts,['class' => '']);
            $this->ef5_banner_button($atts,['class' => '']);
            break;
        default:
            $this->ef5_banner_main_media($atts,['class' => '']);
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_sub_title($atts,['class' => '']);
            $this->ef5_banner_button($atts,['class' => '']);
            break;
    }
    ?>
</div>
  