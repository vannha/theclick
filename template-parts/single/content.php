<?php
/**
 * Template part for displaying posts in loop
 *
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>

<div <?php post_class('ef5-single clearfix'); ?>>
    <?php 
        theclick_post_header(['class' => 'ef5-single-header']);
        theclick_post_media(); 
        theclick_post_content(['class' => 'ef5-single-content']);
        theclick_link_pages(['class' => 'ef5-single-page-links']);
    ?>
    <div class="ef5-single-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('theclick_single_post_footer');
        theclick_tagged_in(['class' => 'col-auto']);
        theclick_post_share(['class' => 'col-auto']); 
    ?></div>
</div>