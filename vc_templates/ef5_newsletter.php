<?php
if(!class_exists('NewsletterWidgetMinimal') && !class_exists('NewsletterWidget')) return;
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $wrapper_class = array('ef5-newsletter', $layout_mode, 'ef5-newsletter-'.$layout_template, $el_class);

    $default_form = '[newsletter_form button_label="'.esc_attr($btn_text).'" class="'.esc_attr($el_class).'"]';
    if($show_name) $default_form .= '[newsletter_field name="name" label="" placeholder="'.esc_attr($name_text).'"]';
    $default_form .= '[newsletter_field name="email" label="" placeholder="'.esc_attr($email_text).'"]';
    $default_form .= '[/newsletter_form]';
?>
<div class="<?php echo trim(implode(' ',$wrapper_class)); ?>">
    <?php $this->title($atts); ?>
    <?php switch ($layout_mode) {
        case 'minimal':
            echo do_shortcode('[newsletter_form type="minimal" button="'.esc_attr($btn_text).'" placeholder="'.esc_attr($email_text).'"  class="'.esc_attr($el_class).'"][/newsletter_form]');
            break;
        default:
            echo do_shortcode($default_form);
            break;
    } ?>
</div>