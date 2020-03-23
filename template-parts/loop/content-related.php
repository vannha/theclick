<?php
/**
 * Template part for displaying posts in loop
 *
 * @package EF5 Theme
 * @subpackage TheClick
 */
?>

<div <?php post_class('related-item'); ?>>
    <?php 
        theclick_post_media(['thumbnail_size'=>'medium']);
        theclick_post_header(['after_title'=>false])
    ?>
</div>