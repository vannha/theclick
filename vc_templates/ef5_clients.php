<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $thumbnail_size
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_clients
 */
/* get Shortcode custom value */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');
$clients = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $clients['values'] );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add a client logo!','unbreak').'</p>';
    return;
}
$count = count($values);
$i=1;
$j=0;

$owl_item_space = '';
$dot_thumbnail_size = '50';
$item_attrs = [];

if(!empty($atts['margin']) && $atts['number_row'] > 1 ) {
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
?>
<div class="<?php $this->theclick_clients_wrap_css_class($atts);?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php $this->theclick_clients_css_class($atts);?>">
        <?php 
            foreach($values as $value){
                $j++;
                if($i > $number_row) $i=1;

                $dot_img = theclick_image_by_size([
                    'id'    => isset($value['image']) ? $value['image'] : '',
                    'size'  => '50',
                    'class' => 'dot-thumb',
                    'echo'  => false
                ]);
                if($layout_style === 'carousel'){
                    $item_attrs[] = 'data-dot=\''.$dot_img.'\'';
                }

                if($i==1) { ?>
                    <div class="<?php $this->theclick_clients_item_css_class($atts);?>" <?php echo implode(' ', $item_attrs);?>>
                <?php } ?>
                    <div class="ef5-client-item-inner" <?php echo theclick_html($owl_item_space);?>> 
                        <?php $this->theclick_client_render($atts, $value); ?>
                    </div>
                <?php if($i == $number_row || $j==$count) { ?> 
                    </div>
                <?php }
                $i ++;
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel'):
        theclick_loading_animation(); 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);
    endif; ?>
</div>