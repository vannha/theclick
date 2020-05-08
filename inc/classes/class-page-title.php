<?php
/**
 * Page title class for the theme.
 * 
 * @package EF5 Theme
 * @subpackage TheClick
 * @since 1.0.0
 * @author EF5 Team
 */

if ( ! defined( 'ABSPATH' ) )
{
    die();
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title' and 'desc'
 */
function theclick_get_page_titles()
{
    $title = $desc = '';
    $post_single_custom_title = theclick_get_theme_opt('post_single_custom_title', '');
    // Default titles
    if (!is_archive()) {
        // Posts / page view
        if (is_home()) {
            $page_for_posts = get_option('page_for_posts');
            
            // Only available if posts page is set.
            if (!is_front_page() && $page_for_posts ) {
                $title = get_the_title($page_for_posts);
                $desc = get_post_meta($page_for_posts, 'page_desc', true);
            } else {
                $title = get_bloginfo('name');
                $desc = get_bloginfo('description');
            }
        }
        // Single page view
        elseif (is_singular()) {
            $title = get_post_meta(get_the_ID(), 'custom_title', true);
            if (!$title) {
                $title = get_the_title();
                if(is_singular('post') && !empty($post_single_custom_title)){
                    $title = $post_single_custom_title;
                }
            }
            $desc = get_post_meta(get_the_ID(), 'custom_desc', true);
        } 
        // 404
        elseif (is_404()) {
            $title = theclick_get_opts('ptitle_404_title', esc_html__('Error 404', 'theclick'));
        } 
        // Search result
        elseif (is_search()) {
            $title = esc_html__('Search results', 'theclick');
            $desc = esc_html__('You searched for:','theclick').' "'. get_search_query(). '" ';
        } 
        // Anything else
        else {
            $title = get_the_title();
        }
    } elseif (function_exists('is_shop') && is_shop()){
        $shop_page_id = get_option('woocommerce_shop_page_id');
        $title = get_the_title(get_option('woocommerce_shop_page_id'));
        $desc = get_post_meta($shop_page_id, 'custom_desc', true);
        //$desc  = get_the_archive_description();
    } else {
		$title = get_the_archive_title();
		$desc  = get_the_archive_description();
    }
    return array(
        'title' => $title,
        'desc'  => $desc
    );
}