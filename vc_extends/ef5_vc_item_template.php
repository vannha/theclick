<?php
function theclick_vc_post_layout2($atts){
    theclick_post_media(['thumbnail_size' => $atts['thumbnail_size']]);
	theclick_post_meta_category(['class' => 'meta-category']);
    the_title( '<div class="ef5-heading text-20"><a href="' . esc_url( get_permalink() ) . '">','</a></div>' );
    theclick_post_excerpt(['show_excerpt' => '1', 'length' => '30' ]);
    theclick_post_meta(['class' => '','show_author' => '1','show_date' => '1','show_cmt' => '1']);
}
function theclick_vc_post_layout3($atts){
    theclick_post_media(['thumbnail_size' => $atts['thumbnail_size']]);
    the_title( '<div class="ef5-heading text-20"><a href="' . esc_url( get_permalink() ) . '">','</a></div>' );
    theclick_post_excerpt(['show_excerpt' => '1', 'length' => '30' ]);
    printf('<div class="ef5-readmore text-center"><a href="%1$s" title="%2$s" class="ef5-btn btn-alt">%3$s</a></div>',
        esc_url( get_the_permalink() ),
        esc_attr( get_the_title() ),
        esc_html__('Continue Reading','theclick')
    );
    theclick_post_meta(['class' => '','show_author' => '1','show_date' => '1','show_cmt' => '1']);
}
