<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $el_id = 'esp'.$el_id;
?>
<div id="<?php echo esc_attr($el_id);?>" class="ef5-empty-space w-100"></div>