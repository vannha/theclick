<?php
add_action('vc_after_init', 'theclick_vc_row');
function theclick_vc_row() {   
    $param = WPBMap::getParam('vc_row', 'full_width');
    $param['value'][esc_html__('Stretch row and content 2','theclick')] = 'stretch_row_content2';
    $param['std'] = 'stretch_row_content2';
    vc_update_shortcode_param('vc_row', $param);
}
   