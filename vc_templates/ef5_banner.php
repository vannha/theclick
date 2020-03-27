<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);

$el_id = !empty($el_id) ? 'ef5-banner-' . $el_id : uniqid('ef5-banner-');
?>
<div id="<?php echo esc_attr($el_id); ?>" class="<?php $this->theclick_banner_wrap_css_class($atts); ?>">
    <?php 
    switch ($banner_style) {
        case '1':
            $this->theclick_banner_main_media($atts,['class' => '']);
            $this->theclick_banner_main_title($atts,['class' => '']);
            $this->theclick_banner_sub_title($atts,['class' => '']);
            $this->theclick_banner_button($atts,['class' => '']);
            break;
        case '2': 
            $this->theclick_banner_main_title($atts,['class' => '']);
            $this->theclick_banner_main_media($atts,['class' => '']);
            break;
        case '3': 
            $this->theclick_banner_main_media($atts,['class' => '']);
            echo '<div class="gradient"></div><div class="content-wrap">';
            $this->theclick_banner_main_title($atts,['class' => '']);
            $this->theclick_banner_sub_title($atts,['class' => '']);
            $this->theclick_banner_button($atts,['class' => '']);
            echo '</div>';
            break;
        case '4': 
            $this->theclick_banner_main_media($atts,['class' => 'col-12 col-md-6 col-lg-7 col-xxl-auto']);
            echo '<div class="content-wrap col-12 col-md-6 col-lg-5 col-xxl-auto">'; 
            $this->theclick_banner_sub_title($atts,['class' => '']);
            $this->theclick_banner_main_title($atts,['class' => '']);
            $this->theclick_banner_button($atts,['class' => 'ef5-btn primary outline2']);
            echo '</div>';
            break;
        case '2': 
        default:
            $this->theclick_banner_main_media($atts,['class' => '']);
            $this->theclick_banner_main_title($atts,['class' => '']);
            $this->theclick_banner_sub_title($atts,['class' => '']);
            $this->theclick_banner_button($atts,['class' => '']);
            break;
    }
    ?>
</div>
  