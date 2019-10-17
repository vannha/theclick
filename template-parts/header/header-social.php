<?php
/**
 * OverCome
 */
$header_social = theclick_get_opts( 'header_social', '0' );

if($header_social === '0') return;

$header_layout = theclick_get_opts('header_layout', '1');
$classes = ['header-socials col-auto'];

if(!empty(theclick_get_theme_opt('social_facebook_url')) || !empty(theclick_get_theme_opt('social_twitter_url')) || !empty(theclick_get_theme_opt('social_inkedin_url')) || !empty(theclick_get_theme_opt('social_instagram_url')) || !empty(theclick_get_theme_opt('social_google_url')) || !empty(theclick_get_theme_opt('social_pinterest_url')) || !empty(theclick_get_theme_opt('social_skype_url')) || !empty(theclick_get_theme_opt('social_vimeo_url')) || !empty(theclick_get_theme_opt('social_youtube_url')) || !empty(theclick_get_theme_opt('social_yelp_url')) || !empty(theclick_get_theme_opt('social_tumblr_url')) || !empty(theclick_get_theme_opt('social_tripadvisor_url')) ) :
?>
    <?php
    if(!empty(theclick_get_theme_opt('social_facebook_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Facebook','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_facebook_url')); ?>" target="_blank">
            <i class="fab fa-facebook"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_twitter_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Twitter','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_twitter_url')); ?>" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_pinterest_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Pinterest','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_pinterest_url')); ?>" target="_blank">
            <i class="fab fa-pinterest"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_dribbble_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Dribbble','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_dribbble_url')); ?>" target="_blank">
            <i class="fab fa-dribbble"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_inkedin_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Linkedin','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_inkedin_url')); ?>" target="_blank">
            <i class="fab fa-linkedin"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_instagram_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Instagram','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_instagram_url')); ?>" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_google_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Google plus','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_google_url')); ?>" target="_blank">
            <i class="fab fa-google-plus"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_skype_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Skype','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_skype_url')); ?>" target="_blank">
            <i class="fab fa-heart"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_vimeo_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Vimeo','theclick');?>" href="http://<?php echo esc_url(theclick_get_theme_opt('social_vimeo_url')); ?>" target="_blank">
            <i class="fab fa-tumblr"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_youtube_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Youtube','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_youtube_url')); ?>" target="_blank">
            <i class="fab fa-youtube"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_yelp_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Yelp','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_yelp_url')); ?>" target="_blank">
            <i class="fab fa-yelp"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_tumblr_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Tumblr','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_tumblr_url')); ?>" target="_blank">
            <i class="fab fa-tumblr"></i>
        </a>
    <?php }
    if(!empty(theclick_get_theme_opt('social_tripadvisor_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Tripadvisor','theclick');?>" href="<?php echo esc_url(theclick_get_theme_opt('social_tripadvisor_url')); ?>" target="_blank">
            <i class="fab fa-tripadvisor"></i>
        </a>
    <?php } 
endif;