<?php
// Enable Instagram Widget
if(!function_exists('enable_instagram_widget')){
    add_filter('enable_instagram_widget', 'theclick_instagram');
    function theclick_instagram(){
        return true;
    }
}
// Update Instagrame username from theme options to widget
if(!function_exists('theclick_instagram_api_username')){
    add_filter('ef5_instagram_api_username', 'theclick_instagram_api_username');
    function theclick_instagram_api_username(){
        return theclick_get_theme_opt('instagram_api_username','');
    }
}

// Update Instagrame api key from theme options to widget
if (!function_exists('theclick_instagram_api_key')) {
    add_filter('ef5systems_instagram_api_key', 'theclick_instagram_api_key');
    function theclick_instagram_api_key(){
        return theclick_get_theme_opt('instagram_api_key', '');
    }
}
/**
 * Custom layout 
 * add_filter('ef5systems_instagram_custom_layout','theclick_instagram_custom_layout');
 */
if(!function_exists('theclick_instagram_custom_layout')){
    function theclick_instagram_custom_layout(){
        return [
            '1' => esc_html__('Layout 1','theclick'),
            '2' => esc_html__('Layout 2','theclick'),
            '3' => esc_html__('Layout 3','theclick'),
        ];
    }
}
// Output HTML 
if(!function_exists('theclick_instagram_html_output')){
    add_filter('ef5systems_instagram_output_html','theclick_instagram_html_output', 10, 12);
    function theclick_instagram_html_output($layout_mode, $span, $columns_space, $media_array, $size, $target, $show_like, $show_cmt, $show_author, $author_text, $show_author_name, $username){
        switch ($layout_mode) {
            default:
                echo '<div class="ef5-instagram layout'.$layout_mode.'">'; 
                    ?>
                    <div class="row grid-gutters-<?php echo esc_attr($columns_space);?> clearfix">
                    <?php
                    foreach ($media_array as $item) {
                    ?>
                        <div class="<?php echo trim(implode(' ', array('instagram-item', $span, 'overlay-wrap')));?>">
                            <a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target );?>">
                                <img src="<?php echo esc_url($item[$size]);?>" alt="<?php echo esc_attr(get_bloginfo('name'));?>" />
                            </a>
                            <div class="overlay d-flex align-items-center animated" data-animation-in="zoomIn" data-animation-out="zoomOut">
                                <div class="overlay-inner col-12 text-center">
                                    <a class="d-block" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target );?>"><span class="fa fa-instagram"></span></a>
                                    <?php if( $show_like):?><a class="like" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target );?>"><span class="fa fa-heart-o"></span>&nbsp;<?php echo esc_html($item['likes']);?></a><?php endif; ?>
                                    <?php if( $show_cmt):?><a class="comments" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target ) ;?>"><span class="fa fa-comments-o"></span>&nbsp;<?php echo esc_html($item['comments']);?></a><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                    <?php

                if ($show_author) {
                    ?><div class="user">
                        <a href="//instagram.com/<?php echo trim($username); ?>" target="<?php echo esc_attr( $target ); ?>"><?php if(!empty($author_text)) echo '<span class="author-text">'.esc_html($author_text).'</span>'; ?> <?php if($show_author_name) echo '<span class="author-name">@'. trim($username).'</span>'; ?></a></div><?php
                }
                echo '</div>';
                break;
                
        }
    }
}