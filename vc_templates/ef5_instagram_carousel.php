<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract( $atts );
$el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');
$css_classes = array(
    'ef5-instagram-carousel',
    'ef5-instagram-wrap',
    'ef5-owl',
    'owl-carousel'
);

$username = theclick_get_theme_opt('instagram_api_username', '');

$media_array = ef5systems_instagram_data();

if (is_wp_error($media_array)) {
    echo esc_html($media_array->get_error_message());
    return;
}
$media_array['images'] = array_slice($media_array['images'], 0, $number);

$username     = $media_array['user']['username'];  
$display_name = $media_array['user']['display_name'];  
$avatar_src   = $media_array['user']['avatar'];
$follower     = $media_array['user']['follower'];
$following    = $media_array['user']['following'];

switch ($layout_mode) {
    case 'default':
        echo '<div class="ef5-posts ef5-instagram layout-' . $layout_mode . '">'; 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
        ?>
        <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $css_classes));?>">
            <?php
            foreach ($media_array['images'] as $item) {
                ?>
                <div class="<?php echo trim(implode(' ', array('instagram-item ef5-carousel-item', 'overlay-wrap'))); ?>">
                    <a class="ins-img" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>">
                        <img src="<?php echo esc_url($item[$size]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                    </a>
                    <div class="overlay d-flex align-items-center animated" data-animation-in="zoomIn" data-animation-out="zoomOut">
                        <div class="overlay-inner col-12 text-center">
                            <a class="ins-icon" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-instagram"></span></a>
                            <?php if ($show_like) : ?><a class="like" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-heart-o"></span><span><?php echo esc_html($item['likes']); ?></span></a><?php endif; ?>
                            <?php if ($show_cmt) : ?><a class="comments" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-comments-o"></span><span><?php echo esc_html($item['comments']); ?></span></a><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($show_author) { ?>
            <div class="user"><a href="//instagram.com/<?php echo trim($username); ?>" target="<?php echo esc_attr($target); ?>"><?php if (!empty($author_text)) echo '<span class="author-text">' . esc_html($author_text) . '</span>';
                else echo '<span class="author-text">' . $display_name . '</span>';
            echo '<span class="author-name">@' . trim($username) . '</span>'; ?></a></div>
        <?php
        }
         
        theclick_loading_animation('three-dot-bounce'); 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);
        
        echo '</div>';
    break;
}

