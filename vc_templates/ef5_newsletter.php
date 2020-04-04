<?php
if(!class_exists('NewsletterWidgetMinimal') && !class_exists('NewsletterWidget')) return;
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    $wrapper_class = [
        'ef5-newsletter',
        $layout_mode,
        'ef5-newsletter-'.$layout_template,
        $this->getCSSAnimation($atts['nsl_css_animation']),
        $el_class
    ];
    if(!empty($atts['css'])){
        $wrapper_class[]=vc_shortcode_custom_css_class($atts['css']);
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $wrapper_class ) ), $this->settings['base'], $atts ) );

    $wrapper_class = array('ef5-newsletter', $layout_mode, 'ef5-newsletter-'.$layout_template, $el_class);

    $default_form = '[newsletter_form button_label="'.esc_attr($btn_text).'" class="'.esc_attr($el_class).'"]';
    if($show_name) $default_form .= '[newsletter_field name="name" label="" placeholder="'.esc_attr($name_text).'"]';
    $default_form .= '[newsletter_field name="email" label="" placeholder="'.esc_attr($email_text).'"]';
    $default_form .= '[/newsletter_form]';

    $el_id = !empty($el_id) ? 'ef5-nsl-' . $el_id : uniqid('ef5-nsl-');
?>
<div id="<?php echo esc_attr($el_id); ?>" class="<?php echo esc_attr( $css_class ) ?>">
    <?php $this->theclick_nsl_media($atts,[]); ?>
    <?php if($layout_template == '3') echo '<div class="nsl-content-wrap" class="'.$inner_class.'">'; ?>
    <?php $this->theclick_title($atts,[]); ?>
    <?php $this->theclick_sub_title($atts,[]); ?>
    <?php switch ($layout_mode) {
        case 'minimal':
            echo do_shortcode('[newsletter_form type="minimal" button="'.esc_attr($btn_text).'" placeholder="'.esc_attr($email_text).'"  class="'.esc_attr($el_class).'"][/newsletter_form]');
            break;
        default:
            echo do_shortcode($default_form);
            break;
    } ?>
    <?php if($layout_template == '3') echo '</div>'; ?>
</div>