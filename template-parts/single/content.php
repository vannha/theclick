<?php
/**
 * Template part for displaying posts in loop
 *
 * @package EF5 Theme
 * @subpackage TheClick
 * @since 1.0.0
 * @author EF5 Team
 *
 */
$show_share = theclick_get_theme_opt( 'post_share_on', '0' );
?>

<div <?php post_class('ef5-single clearfix'); ?>>
    <?php 
        theclick_post_header(['class' => 'ef5-single-header']);
        theclick_post_extra_link();
        theclick_post_media(); 
        theclick_post_content(['class' => 'ef5-single-content']);
        theclick_link_pages(['class' => 'ef5-single-page-links']);
    ?>

    <?php 
    if($show_share == '1'):
        echo '<div class="ef5-single-content-wrap d-flex">';
        theclick_post_share(['class' => 'single-col-left d-none d-md-block','hint_pos' => 'hint--right']);
        echo '<div class="single-col-right d-flex">';
    endif;  
        theclick_single_post_content(['class' => 'ef5-single-content']);
        theclick_link_pages(['class' => 'ef5-single-page-links']);
    ?>
    <div class="ef5-single-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('theclick_single_post_footer');
        theclick_tagged_in(['class' => 'col-auto']);
        theclick_post_share(['class' => 'col-auto d-md-none d-lg-none d-xl-none','hint_pos' => 'hint--top']);
    ?></div>
    <?php 
        theclick_post_author();
        theclick_post_navigation();
        if($show_share == '1'):
            echo '</div></div>';
        endif;  
    ?>
</div>