<?php
add_action('vc_after_init', 'theclick_vc_row');
function theclick_vc_row() {   
    $param = WPBMap::getParam('vc_row', 'full_width');
    $param['value'][esc_html__('Stretch row and content 2','theclick')] = 'stretch_row_content2';
    $param['std'] = 'stretch_row_content2';
    vc_update_shortcode_param('vc_row', $param);
}

add_filter('vc_shortcode_output', 'unbreak_vc_shortcode_output', 10, 3);
function unbreak_vc_shortcode_output($html = '', $sc_obj = '', $atts = [])
{
	var_dump($atts);  
    extract($atts);
    //modify shortcode use div as container
    $shortcode_modify = ['vc_row'];
    $shortcode_name = $sc_obj->getShortcode();
    if (!in_array($shortcode_name, $shortcode_modify))
        return $html;
    //
    $modify = [
        'attrs'       => [], // for add attrs can use string or array
        'before'      => '',
        'after'       => '',
        'first-child' => '',
        'last-child'  => '',
        'vc-pie-icon' => ''
    ];
    switch ($shortcode_name) {
        //case for $shortcode_modify element
        
        case 'vc_row':
            $container_class = [];
         
            // Stretch row style 2
            if(isset($full_width) && $full_width === 'stretch_row_content2'){
                $container_class[] = 'container-wide';
                $modify['first-child'] .= '<div class="'.implode(' ', $container_class).'"><div class="row">';
                $modify['last-child']  .= '</div></div>';
            }
            break;
        default:
            return $html;
            break;
    }
    //begin modify
    if (!empty($modify['attrs'])) {
        if (is_array($modify['attrs']))
        {
            $custom_attr_str =[];
            foreach ($modify['attrs'] as $key => $value) {
                $value = esc_attr($value);
                $custom_attr_str[] = "{$key}=\"{$value}\"";
            }
            $custom_attr_str = join(' ',$custom_attr_str);
        }
        else
            $custom_attr_str = $modify['attrs'];
        $html = '<div ' . $custom_attr_str . substr($html, 4);
    }
    if (!empty($modify['first-child'])) {
        $html_exp = explode('>', $html);
        $html_exp[1] = $modify['first-child'] . $html_exp[1];
        $html = join('>', $html_exp);
    }
    if (!empty($modify['last-child'])) {
        $html_exp = explode('</div>', $html);
        if (count($html_exp) > 2) {
            for ($index = count($html_exp) - 1; $index > 0; $index--) {
                if (empty(trim($html_exp[$index - 1])))
                    break;
            }
            $html_exp[$index - 1] .= $modify['last-child'];
            $html = join('</div>', $html_exp);
        } else
            $html = substr($html, 0, -6) . $modify['last-child'] . '</div>';
    }
    if (!empty($modify['before']))
        $html = $modify['before'] . $html;
    if (!empty($modify['after']))
        $html = $html . $modify['after'];
 
    return $html;
}
   