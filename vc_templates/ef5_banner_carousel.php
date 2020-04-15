<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);

$el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');
$banner_carousels = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $banner_carousels['values'] );
?>
<div class="ef5-posts ef5-owl-wrap <?php $this->theclick_banner_carousel_wrap_css_class($atts);?>">
    <div class="ef5-owl-wrap-inner relative">
    <?php 
        //ef5systems_owl_nav_top($atts);
        //ef5systems_owl_dots_top($atts); 
    ?>
    <div id="<?php echo esc_attr($el_id) ?>" class="ef5-posts-carousel ef5-posts-carousel-3 ef5-owl owl-carousel owl-loaded owl-drag">
        <?php 
        foreach($values as $value){
        ?>
            <div class="ef5-banner-carousel-item"> 
                <?php $this->theclick_banner_carousel_render($atts, $value); ?>
            </div>
        <?php
        }
        ?>
         
    </div>
    <?php 
        theclick_loading_animation('three-dot-bounce'); 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);
    ?>
    </div>
</div>
  