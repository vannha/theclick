<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);

$el_id = !empty($el_id) ? 'ef5-banner-' . $el_id : uniqid('ef5-banner-');
?>
<div id="<?php echo esc_attr($el_id); ?>" class="<?php $this->theclick_banner_wrap_css_class($atts); ?>">
    <?php 
    switch ($banner_style) {
        case '1':
            $this->ef5_banner_main_media($atts,['class' => '']);
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_sub_title($atts,['class' => '']);
            $this->ef5_banner_button($atts,['class' => '']);
            break;
        case '2': 
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_main_media($atts,['class' => '']);
            break;
        case '3': 
            $this->ef5_banner_main_media($atts,['class' => '']);
            echo '<div class="gradient"></div><div class="content-wrap">';
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_sub_title($atts,['class' => '']);
            $this->ef5_banner_button($atts,['class' => '']);
            echo '</div>';
            break;
        case '4': 
            $this->ef5_banner_main_media($atts,['class' => '']);
            echo '<div class="content-wrap">'; 
            $this->ef5_banner_sub_title($atts,['class' => '']);
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_button($atts,['class' => 'ef5-btn outline']);
            echo '</div>';
            break;
        case '2': 
        default:
            $this->ef5_banner_main_media($atts,['class' => '']);
            $this->ef5_banner_main_title($atts,['class' => '']);
            $this->ef5_banner_sub_title($atts,['class' => '']);
            $this->ef5_banner_button($atts,['class' => '']);
            break;
    }
    ?>
</div>
  