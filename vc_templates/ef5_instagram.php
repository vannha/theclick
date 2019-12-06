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
        $span = "col-6 col-sm-3 col-lg-3 col-xl-1/8";
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
$args = [
    'layout_mode'   => $layout_mode,
    'span'          => $span,
    'columns_space' => $columns_space,
    'media_array'   => $media_array,
    'size'          => $size,
    'target'        => $target,
    'show_like'     => $show_like,
    'show_cmt'      => $show_cmt,
    'show_author'   => $show_author,
    'author_text'   => $author_text,
    'username'      => $username
];

$html = apply_filters('ef5systems_instagram_output_html', $args);
echo theclick_html($html);
