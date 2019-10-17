<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $video_class = ['ef5-video','ef5-hover-shadow-2', 'transition', 'overlay-wrap'];
?>
<div class="ef5-video-wrapper ef5-video-<?php echo esc_attr($layout_template);?>">
<div id="ef5-video-<?php echo esc_attr($el_id);?>">
    <?php switch ($layout_template) {
        default:
    ?>
        <div class="ef5-video-info empty-none"><?php
            $this->theclick_ef5_video_small_heading($atts,['class' => 'text-22 ef5-text-accent']);
            $this->theclick_ef5_video_heading($atts, ['class' => 'text-36 ef5-text-primary']);
            $this->theclick_ef5_video_desc($atts);
            $this->theclick_ef5_video_link($atts);
        ?></div>
        <div class="<?php echo trim(implode(' ', $video_class));?>"><?php 
            $this->theclick_ef5_video_poster($atts);
            //$this->theclick_ef5_video_play_button($atts);
            $this->theclick_ef5_video_plain($atts);
            $this->theclick_ef5_video_popup($atts,['overlay' => true]);
        ?></div>
    <?php
            break;
    } ?>
</div>
</div>