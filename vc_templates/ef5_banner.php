<?php 
$title = $el_class ='';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$classes=array('red-banner');
if(!empty($atts['css'])){
    $classes[]=vc_shortcode_custom_css_class($atts['css']);
}
$classes[]    = $el_class;
$banner_style = ( !empty($atts['banner_style']) ) ? $atts['banner_style'] : 'style-1';
$effect_cls   = !empty($atts['effect']) ? $atts['effect'] : '';
$align        = !empty($atts['align']) ? $atts['align'] : '';
$classes[] = $banner_style;
$classes[] = $effect_cls;
$classes[] = $align;
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

    if (!empty($atts['image'])) {
        $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
        $image_url = $attachment_image[0];
    }
    
    $link     = (isset($atts['link'])) ? $atts['link'] : '';
    $link     = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href   = $link['url'];
        $a_title  = !empty($link['title'])?$link['title']: esc_html__('Take a look','theclick');
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
    
    $overlay_bg_style = $title1_style = $title2_style = $title3_style = $title4_style = $desc_style = '';

    if( !empty($overlay_bg) ){
        $overlay_bg_style = 'style="background-color:'.$overlay_bg.';"';  
    } 
    $title1_style_start = '';
    $title1_style_end = '';
    if( !empty($title1_color) ){
        $title1_style_start = 'style="';
        $title1_style_end   = '"';
    } 
    $title2_style_start = '';
    $title2_style_end   = '';
    if( !empty($title2_color) ){
        $title2_style_start = 'style="';
        $title2_style_end   = '"';
    } 
    $title3_style_start = '';
    $title3_style_end   = '';
    if( !empty($title3_color) ){
        $title3_style_start = 'style="';
        $title3_style_end   = '"';
    }
    $title4_style_start = '';
    $title4_style_end   = '';
    if( !empty($title4_color) ){
        $title4_style_start = 'style="';
        $title4_style_end   = '"';
    } 
    $desc_style_start = '';
    $desc_style_end   = '';
    if( !empty($desc_color) ){
        $desc_style_start = 'style="';
        $desc_style_end   = '"';
    } 

    
    $title1_style .= $title1_style_start;
    if(!empty($title1_color)) $title1_style .= 'color:'.$title1_color.';';  
    $effect_title1 = !empty($effect_title1) ? ' red-animation '.$effect_title1 : '';
    $title1_style .= $title1_style_end;
    
    $title2_style .= $title2_style_start; 
    if(!empty($title2_color)) $title2_style .= 'color:'.$title2_color.';'; 
    $effect_title2 = !empty($effect_title2) ? ' red-animation '.$effect_title2 : '';
    $title2_style .= $title2_style_end; 
     
    $title3_style .= $title3_style_start;  
    if(!empty($title3_color)) $title3_style .= 'color:'.$title3_color.';';  
    $effect_title3 = !empty($effect_title3) ? ' red-animation '.$effect_title3 : '';
    $title3_style .= $title3_style_end; 
    
    $title4_style .= $title4_style_start;  
    if(!empty($title4_color)) $title4_style .= 'color:'.$title4_color.';';  
    $effect_title4 = !empty($effect_title4) ? ' red-animation '.$effect_title4 : '';
    $title4_style .= $title4_style_end; 

    $desc_style .= $desc_style_start;  
    if(!empty($desc_color)) $desc_style .= 'color:'.$desc_color.';';  
    $effect_desc = !empty($effect_desc) ? ' red-animation '.$effect_desc : '';
    $desc_style .= $desc_style_end;     
    
    $button_link_effect = !empty($button_link_effect) ? ' red-animation '.$button_link_effect : '';
    
    $position = !empty($position) ? $position : '';
?>
<div class="<?php echo esc_attr($css_class);?>">
    <?php
    echo '<div class="red-banner-item '.esc_attr($position).'">';
        if($use_link && empty($btn_type))
        echo '<a href="'.$a_href.'" target="'.esc_attr($a_target).'" class="banner-link">';
        
        if(!empty($atts['image']))
            echo '<img src="'.esc_url($image_url).'" class="banner-img" alt="img"/>';
            if($effect_cls == 'fade-normal' || $effect_cls == 'fade-zoom')
                echo '<div class="overlay-effect" '.$overlay_bg_style.'></div>';
            echo '<div class="banner-content">';
            if(!empty($atts['title1']))
                echo '<span class="title1 '.esc_attr($effect_title1).'" '.$title1_style.'>'.esc_html($atts['title1']).'</span>';
            
            if( $banner_style == 'style-8') echo '<div class="wrap-title-23">';
            if(!empty($atts['title2'])){
                echo '<span class="title2 '.esc_attr($effect_title2).'" '.$title2_style.'>'.esc_html($atts['title2']).'</span>';
            }
            if(!empty($atts['title3']))
                echo '<span class="title3 '.esc_attr($effect_title3).'" '.$title3_style.'>'.esc_html($atts['title3']).'</span>';
            if( $banner_style == 'style-8') echo '</div>';

            if(!empty($atts['title4']))
                echo '<span class="title4 '.esc_attr($effect_title4).'" '.$title4_style.'>'.esc_html($atts['title4']).'</span>';

            if(!empty($desc_text)) 
                echo '<p class="desc '.esc_attr($effect_desc).'" '.$desc_style.'>'.$desc_text.'</p>';

            if($use_link && !empty($btn_type))
                echo '<a href="'.$a_href.'" target="'.esc_attr($a_target).'" class="'.esc_attr($btn_type).' '.esc_attr($button_link_effect).'">'.esc_html($a_title).'</a>';
            echo '</div>';

        if($use_link && empty($btn_type))
            echo '</a>';
    echo '</div>';  
    ?>
</div>
  