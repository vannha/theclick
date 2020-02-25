<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_testimonial
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');
$wrap_css_class = ['ef5-testimonial-wrap','ef5-owl-wrap-inner relative'];
$css_class_attr = $item_class = array();
$css_class_attr[] = 'ef5-testimonial ef5-testimonial-layout-'.$layout_template;
$item_class[] = 'testimonial-item';

if($layout_style === 'carousel'){
    $wrap_css_class[] = ef5systems_owl_css_class($atts);
    $css_class_attr[] = 'ef5-owl testimonial-carousel owl-carousel';
    $item_class[] = 'ef5-carousel-item';
} else {
    $css_class_attr[] = 'ef5-grid row justify-content-center';
    $item_class[] = 'ef5-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}

$css_class_attr[] = $content_align;
$css_class_attr[] = $el_class;

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
// get testinomial data
$testimonials = (array) vc_param_group_parse_atts( $atts['testimonials'] );
// avatar size
switch ($layout_template) {
	default:
		$dot_thumbnail_size = '70';
		break;
}
$count = count($testimonials);
$i=1;
$j=0;

$inner_css_classes = ['ttmn-inner','transition'];

$ttmn_wrap_classes = ['ef5-testimonials', ef5systems_owl_css_class($atts)];

if(empty($atts['content_align']) && !in_array($atts['layout_template'],['2','5','6'])) $ttmn_wrap_classes[] = 'text-center';
?>
<div class="<?php echo theclick_optimize_css_class(implode(' ', $ttmn_wrap_classes));?>">
    <div class="title-shop-more d-flex justify-content-between align-items-center gutter-30">
        <div class="title text-xs-40 text-xl-50 lh-1/28"><?php echo theclick_html($title)?></div>
        <?php if($show_shop_more != 'none'): ?>
        <div class="shop-more">
            <a href="<?php echo get_permalink($shop_more_page);?>" class="link-shop-more"><?php echo esc_html($shop_more_text);?></a>
        </div> 
        <?php endif; ?>
    </div>
    <?php 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
    ?>
    <div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
        <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ',$css_class_attr));?>"> 
            <?php
                foreach($testimonials as $testimonial){
                    $j++;
                    if($i > $number_row) $i=1;

                    if(isset($testimonial['author_name'])) {
                    	// dot image
                    	$dot_image = theclick_image_by_size([
    						'id'    => isset($testimonial['author_avatar']) ? $testimonial['author_avatar'] : null,
    						'size'  => $dot_thumbnail_size, 
    						'class' => 'dot-thumb circle', 
    						'echo'  => false
                    	]);
                        // star rating
                        $testimonial['author_rate'] = isset($testimonial['author_rate']) ? $testimonial['author_rate'] : '';
                        if($i==1) : ?>
                            <div class="<?php echo join(' ',$item_class);?>" data-dot='<?php echo theclick_html($dot_image); ?>'>
                        <?php  
                            endif;
                            echo '<div class="'.trim(implode(' ', $inner_css_classes)).'" '.$owl_item_space.'>';
                            	switch ($layout_template) {
                            		default:
                                        $this->theclick_tm_text($testimonial, $atts,['class' => 'text-16 lh-26']);

                            			$this->theclick_tm_avatar($testimonial,$atts,['size' => '70', 'img_class' => 'mb-20 circle ml-auto mr-auto']);

                                        $this->theclick_tm_name($testimonial, $atts,['class' => 'font-style-500 d-block text-16 lh-26 mb-5']);

                                        $this->theclick_tm_position($testimonial,['class' => 'text-16 lh-26 ef5-text-accent d-block']);

                                        $this->theclick_tm_rate($testimonial, $atts);
                            		break;
                            	}
                            echo '</div>';
                        if($i == $number_row || $j==$count) echo '</div>';
                        $i ++;
                    }
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
</div>
