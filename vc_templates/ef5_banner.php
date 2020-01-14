<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
?>
<div class="<?php $this->theclick_banner_wrap_css_class($atts); ?>">
    <?php 
        switch ($atts['banner_style']) {
            case '1':
                $this->ef5_banner_main_banner($atts,['class' => '']);
                $this->ef5_banner_title_1($atts,['class' => '']);
                $this->ef5_banner_title_2($atts,['class' => '']);
                $this->ef5_banner_button($atts,['class' => 'ef5-btn accent fill ef5-btn-md']);
                break;
            default:
                $this->ef5_banner_main_banner($atts,['class' => '']);
                $this->ef5_banner_title_1($atts,['class' => '']);
                $this->ef5_banner_title_2($atts,['class' => '']);
                $this->ef5_banner_button($atts,['class' => 'ef5-btn accent fill ef5-btn-md']);
                break;
        }
    ?>
</div>
  