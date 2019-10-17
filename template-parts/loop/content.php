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
$classes = ['ef5-list'];
if(is_archive() || is_home() || is_front_page() || is_search()) $classes[] = 'ef5-archive';
?>

<div <?php post_class(trim(implode(' ', $classes))); ?>>
    <?php theclick_post_media(['thumbnail_size' => 'large']); ?>
    <div class="ef5-loop-info"><?php
            theclick_post_header(['class' => 'loop ef5-loop-header']);
            theclick_post_excerpt();
            theclick_link_pages();
        ?>
        <div class="ef5-loop-footer row justify-content-between align-items-center empty-none"><?php 
            do_action('theclick_loop_footer'); 
            theclick_tagged_in(['before' => '<div class="col-auto">','after'=>'</div>']);
            theclick_post_share(['class' => 'col-auto']); 
        ?></div>
        <div class="ef5-loop-readmore"><?php theclick_post_read_more(); ?></div>
    </div>
</div>