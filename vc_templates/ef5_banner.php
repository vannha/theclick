<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

?>
<div class="<?php $this->theclick_banner_wrap_css_class($atts); ?>">
    <?php 
    switch ($atts['banner_style']) {
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
  