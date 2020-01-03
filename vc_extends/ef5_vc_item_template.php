<?php
function theclick_vc_post_layout2($atts){
    theclick_post_media(['thumbnail_size' => $atts['thumbnail_size']]);
	theclick_post_meta_category(['class' => 'meta-category']);
    the_title( '<div class="ef5-heading text-20"><a href="' . esc_url( get_permalink() ) . '">','</a></div>' );
    theclick_post_excerpt(['show_excerpt' => '1', 'length' => '30' ]);
    theclick_post_meta(['class' => '','show_author' => '1','show_date' => '1','show_cmt' => '1']);
}