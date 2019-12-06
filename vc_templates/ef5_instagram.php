<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$username = theclick_get_theme_opt('instagram_api_username', '');
switch ($columns) {
    case 1:
        $span = "col-12";
        break;
    case 2:
        $span = "col-6";
        break;
    case 3:
        $span = "col-4";
        break;
    case 4:
        $span = "col-3";
        break;
    case 6:
        $span = "col-2";
        break;
    case 8:
        $span = "col-1/8";
        break;    
    case 12:
        $span = "col-1";
        break;
    default:
        $span = "col-4";
}

$media_array = ef5systems_instagram_data($username);
if (is_wp_error($media_array)) {
    echo esc_html($media_array->get_error_message());
    return;
}
 
$media_array = array_slice($media_array, 0, $number);

$wrap_css_classes = array(
    'ef5-instagram',
    'ef5-instagram-' . $layout_mode,
    $el_class
);
 
$html = apply_filters('ef5systems_instagram_output_html', $layout_mode, $span, $columns_space, $media_array, $size, $target, $show_like, $show_cmt, $show_author, $author_text, $username);
echo $html;
