<?php
/**
 * Post Header
 *
 * Showing post header in loop / single
 *
**/
if(!function_exists('theclick_post_header')){
	function theclick_post_header($args=[]){
		$args = wp_parse_args($args, [
            'heading_tag' => 'h3',
            'class'       => '',
		]);
        $classes = ['ef5-post-header',$args['class']];
        $title_classes = ['ef5-heading',$args['heading_tag']];
        $stick_icon = ( is_sticky() && is_home() && ! is_paged()) ? '<span class="sticky-post"><span class="sticky-post-inner">Featured</span></span>' : '';
        $link_open = is_singular() ? '' : '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        $link_close = is_singular() ? '' : '</a>';

	?>
		<div class="<?php echo trim(implode(' ', $classes));?>">
            <div class="ef5-before-title empty-none"><?php do_action('theclick_before_loop_title'); ?></div>
	        <?php the_title( '<div class="'.trim(implode(' ', $title_classes)).'">'.$link_open.$stick_icon, $link_close.'</div>'); ?>
            <?php if(!is_singular()) theclick_post_excerpt(); ?>
            <div class="ef5-after-title empty-none"><?php do_action('theclick_after_loop_title'); ?></div>
	    </div>
	<?php
	}
}
if(!function_exists('theclick_post_extra_link')){
	function theclick_post_extra_link(){
        $post_extra_link        = theclick_get_theme_opt('post_extra_link','');
        $post_number_extra_link = theclick_get_theme_opt('post_number_extra_link', '2');
        $post_extra_post_id     = theclick_get_theme_opt('post_extra_post_id', '');
        $pids = explode(',',$post_extra_post_id);
        if(empty($post_extra_link)) return;
        $recent_posts = $custom_posts = [];
        if($post_extra_link == 'recent'){
            $recent_posts = wp_get_recent_posts(['numberposts'=> $post_number_extra_link,'exclude' => get_the_ID()]);
            ?>
            <div class="ef5-post-extra-link">
            <ul>
            <?php 
            foreach ($recent_posts as $extra) {
                printf(
                    '<li><a href="%1$s">%2$s</a></li>',
                    esc_url(get_permalink($extra['ID'])),
                    apply_filters('the_title', $extra['post_title'], $extra['ID'])
                );
            }
            ?>
            </ul>	
            </div>
        <?php
        }else{
            $args = array(
                'post__in' => $pids
            );
            $custom_posts = new WP_Query($args);
            if ($custom_posts->have_posts()) {
                ?>
                <div class="ef5-post-extra-link">
                <ul>
                <?php
                while ($custom_posts->have_posts()){
                    $custom_posts->the_post();
                    printf('<li><a href="%1$s">%2$s</a></li>',get_the_permalink(),get_the_title());
                }
                wp_reset_postdata();
                ?>
                </ul>	
                </div>
                <?php 
            }
        }
	}
}

if(!function_exists('theclick_post_title')){
    function theclick_post_title($args=[]){
        $args = wp_parse_args($args, [
            'heading_tag' => 'h4',
            'class'       => '',
            'echo'        => true  
        ]);
        $title_classes = ['ef5-heading',$args['heading_tag'], $args['class']];
        $stick_icon = ( is_sticky() && is_home() && ! is_paged()) ? '<span class="fa fa-thumb-tack"></span>&nbsp;&nbsp;' : '';
        $link_open = is_singular() ? '' : '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        $link_close = is_singular() ? '' : '</a>';
        if($args['echo']){
            the_title( '<div class="'.trim(implode(' ', $title_classes)).'">'.$link_open.$stick_icon, $link_close.'</div>' ); 
        } else {
            return '<div class="'.trim(implode(' ', $title_classes)).'">'.$link_open.$stick_icon .get_the_title().$link_close.'</div>'; 
        }
    }
}

/**
 * Post Meta
 * Prints HTML with meta information for the current post.
*/
if ( ! function_exists( 'theclick_post_meta_category' ) ) {
    add_action('theclick_before_loop_title','theclick_post_meta_category');
    function theclick_post_meta_category($args = [])
    {
        if ( is_singular() ) {            
            $cats_on     = !empty($args['show_cat']) ? $args['show_cat'] : theclick_get_theme_opt( 'post_categories_on', '0' );
        }  else {
            $cats_on     = !empty($args['show_cat']) ? $args['show_cat'] : theclick_get_theme_opt( 'archive_categories_on', '0' );
        }

        $args = wp_parse_args($args, [
            'class'           => '',
            'show_cat'        => $cats_on,
            'show_edit'       => false,
            'stretch_content' => false,
            'sep'             => '',
        ]);
        $metas = [];
        if($args['show_cat']) 
            $metas[] = theclick_posted_in(['show_cat' => $args['show_cat'], 'echo' => false]);
        if($args['show_edit']) 
            $metas[] = theclick_edit_link(['show_edit' => $args['show_edit'], 'echo' => false]);

        $output = implode($args['sep'], $metas);
        $css_classes = ['ef5-meta', $args['class'], 'd-flex', 'align-items-center'];
        if($args['stretch_content']) $css_classes[] = 'justify-content-between';
        $classes = trim(implode(' ',$css_classes ));
        if ( $output )
        {
            printf( '<div class="%s">%s</div>', $classes ,$output);
        }
    }
}
if ( ! function_exists( 'theclick_post_meta' ) ) {
    add_action('theclick_after_loop_title','theclick_post_meta');
    function theclick_post_meta($args = [])
    {
        if ( is_singular() ) {
            $author_on   = !empty($args['show_author']) ? $args['show_author'] : theclick_get_theme_opt( 'post_author_on', '1' );
            $date_on     = !empty($args['show_date']) ? $args['show_date'] : theclick_get_theme_opt( 'post_date_on', '1' );
            $comments_on = !empty($args['show_cmt']) ? $args['show_cmt'] : theclick_get_theme_opt( 'post_comments_on', '1' );
            $show_view   = !empty($args['show_view']) ? $args['show_view'] : theclick_get_theme_opt( 'post_view_on', '0' );
            $show_like   = !empty($args['show_like']) ? $args['show_like'] : theclick_get_theme_opt( 'post_like_on', '0' );
        }  else {
            $author_on   = !empty($args['show_author']) ? $args['show_author'] : theclick_get_theme_opt( 'archive_author_on', '1' );
            $date_on     = !empty($args['show_date']) ? $args['show_date'] : theclick_get_theme_opt( 'archive_date_on', '1' );
            $comments_on = !empty($args['show_cmt']) ? $args['show_cmt'] : theclick_get_theme_opt( 'archive_comments_on', '1' );
            $show_view   = !empty($args['show_view']) ? $args['show_view'] : theclick_get_theme_opt( 'archive_view_on', '0' );
            $show_like   = !empty($args['show_like']) ? $args['show_like'] : theclick_get_theme_opt( 'archive_like_on', '0' );
        }

        $args = wp_parse_args($args, [
            'class'           => '',
            'show_author'     => $author_on,
            'show_date'       => $date_on,
            'show_cmt'        => $comments_on,
            'show_view'       => $show_view,
            'show_like'       => $show_like,
            'show_edit'       => false,
            'stretch_content' => false,
            'sep'             => '',
        ]);
        $metas = [];
        if($args['show_date']) 
            $metas[] = theclick_posted_on(['show_date' => $args['show_date'], 'echo' => false]);
        if($args['show_author']) 
            $metas[] = theclick_posted_by(['show_author' => $args['show_author'], 'echo' => false, 'author_avatar' => false]);
        if($args['show_cmt'] && comments_open()) 
            $metas[] = theclick_comments_popup_link(['show_cmt' => $args['show_cmt'], 'echo' => false]);
        if($args['show_view']) 
            $metas[] = theclick_post_count_view(['show_view' => $args['show_view'], 'echo' => false]);
        if($args['show_like']) 
            $metas[] = theclick_post_count_like(['show_like' => $args['show_like'], 'echo' => false]);
        if($args['show_edit']) 
            $metas[] = theclick_edit_link(['show_edit' => $args['show_edit'], 'echo' => false]);

        $output = implode($args['sep'], $metas);
        $css_classes = ['ef5-meta', $args['class'], 'd-flex', 'align-items-center'];
        if($args['stretch_content']) $css_classes[] = 'justify-content-between';
        $classes = trim(implode(' ',$css_classes ));
        if ( $output )
        {
            printf( '<div class="%s">%s</div>', $classes ,$output);
        }
    }
}
/**
 * Post Excerpt
*/
if(!function_exists('theclick_post_excerpt')){
	function theclick_post_excerpt($args =[]){
		$args = wp_parse_args($args,[
            'show_excerpt' => '1',
            'class'        => '',
            'length'       => apply_filters('theclick_excerpt_length', 37),
            'more'         => '&hellip;',
            'echo'         => true 
		]);
        if($args['show_excerpt'] !== '1') return;
        $classes   = ['ef5-excerpt', $args['class']];
        $content      = get_the_excerpt();
        $excerpt_more = apply_filters('theclick_excerpt_more', $args['more']);
        $excerpt      = wp_trim_words($content, $args['length'], $excerpt_more);
        if($args['echo']){
	?>
	<div class="<?php echo trim(implode(' ', $classes));?>">
		<?php printf('%s', $excerpt); ?>
	</div>
	<?php
        } else {
            return '<div class="'.trim(implode(' ', $classes)).'">'. $excerpt .'</div>';
        }
	}
}

/**
 * Post Content
*/
if(!function_exists('theclick_post_content')){
    function theclick_post_content($args = []){
        $show_share = theclick_get_theme_opt( 'post_share_on', '0' );
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $classes = [
            'ef5-content',
            'ef5-content-'.get_post_type(),
        ];
        if(is_singular() && $show_share == '1') $classes[] = 'd-flex';
        if(is_singular()) $classes[] = 'ef5-single-content';
        $classes[] = 'clearfix';
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>">
            <?php if(is_singular() && $show_share == '1'):?>
                <?php theclick_post_share(['class' => 'single-col-left d-none d-md-block','hint_pos' => 'hint--right']); ?>
                <div class="single-col-right">
            <?php endif; ?>
            <?php the_content(); ?>
            <?php if(is_singular() && $show_share == '1'):?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
}
if(!function_exists('theclick_single_post_content')){
    function theclick_single_post_content($args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $classes = [
            'ef5-content',
            'ef5-content-'.get_post_type(),
            $args['class']
        ];
        ?>
        <div class="<?php echo trim(implode(' ', $classes));?>">
            <?php the_content(); ?> 
        </div>
        <?php
   }
}

 

/**
 * Loop Pagination 
*/
if(!function_exists('theclick_loop_pagination')){
    function theclick_loop_pagination($args=[]){
        if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) return;
        $args = wp_parse_args($args, [
            'show_pagination' => '1',
            'style'           => theclick_get_theme_opt('archive_nav_type', apply_filters('theclick_loop_pagination', '4')),
            'class'           => ''
        ]);
        if($args['show_pagination'] !== '1'){
            wp_reset_query();
            return;
        }
        $paginate_links = ['nav-links','layout-'.$args['style'],$args['class']];
        printf('%s','<div class="ef5-loop-pagination layout-type-'.esc_attr($args['style']).'">');
        switch ($args['style']) {
            case '5':
                previous_posts_link(
                    apply_filters('theclick_loop_pagination_prev_text', esc_html__('Previous', 'theclick'))
                );
                next_posts_link(
                    apply_filters('theclick_loop_pagination_next_text', esc_html__('Next', 'theclick'))
                );
                break;
            case '4':
                posts_nav_link(
                    apply_filters('theclick_loop_pagination_sep_text', '<span class="d-none"></span>'),
                    apply_filters('theclick_loop_pagination_prev_text', esc_html__('Previous', 'theclick')),
                    apply_filters('theclick_loop_pagination_next_text', esc_html__('Next', 'theclick'))
                );
                break;
            case '3':
                echo '<div class="'.trim(implode(' ', $paginate_links)).'">';
                    echo paginate_links([
                        'prev_text' => '<span class="prev hint--top" data-hint="'.apply_filters('theclick_loop_pagination_prev_text', esc_html__('Previous', 'theclick')).'"><span class="flaticon-arrow-pointing-to-left"></span></span>',
                        'next_text' => '<span class="next hint--top" data-hint="'.apply_filters('theclick_loop_pagination_next_text', esc_html__('Next', 'theclick')).'"><span class="flaticon-arrow-pointing-to-right"></span></span>'
                    ]); 
                echo '</div>';
                break;
            case '2':
                the_posts_pagination([
                    'prev_text' => '<span class="prev hint--top" data-hint="'.apply_filters('theclick_loop_pagination_prev_text', esc_html__('Previous', 'theclick')).'"><span>'.apply_filters('theclick_loop_pagination_prev_text', esc_html__('Previous', 'theclick')).'</span></span>',
                    'next_text' => '<span class="next hint--top" data-hint="'.apply_filters('theclick_loop_pagination_next_text', esc_html__('Next', 'theclick')).'"><span>'.apply_filters('theclick_loop_pagination_next_text', esc_html__('Next', 'theclick')).'</span></span>'
                ]);
                break;
            default:
                the_posts_navigation();
                break;
        }
        printf('%s','</div>');
        wp_reset_query();
    }
}

/**
 * Single post Author
 *
 * @since 1.0.0
*/
if(!function_exists('theclick_post_author')){
    function theclick_post_author($args = array()){
        $args = wp_parse_args($args, array('layout' => '1','role' => false));
        extract( $args );
        $show_author = theclick_get_opts('post_author_info', '0');
        if('0' === $show_author || empty(get_the_author_meta('description'))) return;
        $user_info = get_userdata(get_the_author_meta('ID'));
    ?>
    <div class="author-box text-center text-md-<?php echo theclick_align();?>">
        <div class="row">
            <div class="author-avatar col-12 col-md-2 col-lg-auto"><?php 
                echo get_avatar(get_the_author_meta('ID'));
            ?></div>
            <div class="author-info col">
                <div class="author-name">
                    <div class="h4"><?php the_author(); ?></div>
                    <?php if($role):?>
                        <small class="author-roles d-block"><?php echo implode(' / ', $user_info->roles); ?></small>
                    <?php endif;?>
                </div>
                <div class="author-bio"><?php the_author_meta('description'); ?></div>
                <?php theclick_user_social(['class' => 'align-self-end w-100']); ?>
            </div>
        </div>
    </div>
    <?php
    }
}

/**
 * Display single post related
 * 
 * @since 1.0.0
 */
/**
 * Get custom post type taxonomy TAGS
 *
 * @since 1.0.0
*/
if(!function_exists('theclick_get_custom_post_tag_taxonomy')){
    function theclick_get_custom_post_tag_taxonomy()
    {
        $post = get_post();
        $tax_names = get_object_taxonomies($post);
        $result = 'post_tag';
        if(is_array($tax_names))
        {
            foreach ($tax_names as $name){
                if(strpos($name,apply_filters('theclick_post_related_by', 'cat')) !== false) {
                    $result = $name;
                }
            }
        }
        return $result;
    }
}
if(!function_exists('theclick_post_related')){
    function theclick_post_related( $args = array ()){
        global $post;
        /**
         * Parse incoming $args into an array and merge it with $defaults
         */ 
        $args = wp_parse_args($args, array(
            'title'          => esc_html__('Related Posts','theclick'), 
            'posts_per_page' => '2', 
            'columns'        => '2', 
            'carousel'       => apply_filters('theclick_post_related_carousel', false)
        ));
        extract($args);

        $show_related = theclick_get_theme_opt('post_related_on', '0');
        
        if('0' === $show_related) return;

        if($carousel) {
            $col = '';
        } else {
            $col = 'col-md-'.round(12 / $columns);
        }

        //for use in the loop, list 2 posts related to first tag on current post
        $tag_tax_name = theclick_get_custom_post_tag_taxonomy();
        $post = get_post();
        $tags = get_the_terms($post->ID,$tag_tax_name);
        $rtl = is_rtl() ? true : false;
        if ($tags && $show_related) {
            $_tag = array();
            foreach ($tags as $tag) {
                $_tag[] = $tag->slug;
            }        
            $args=array(
                'post_type' => get_post_type(),
                'tax_query' => array(
                    array(
                        'taxonomy' => $tag_tax_name,
                        'field'    => 'slug',
                        'terms'    => $_tag,
                    ),
                ),
                'post__not_in'          => array($post->ID),
                'posts_per_page'        => $posts_per_page,
                'ignore_sticky_posts'   => 1
            );
            $related_query = new WP_Query($args);
            if( $related_query->have_posts() ) {
                echo '<div class="ef5-related">';
                echo '<div class="related-title h2"><span>'.esc_html($title).'</span></div>';
                echo '<div class="ef5-grid row" id="ef5-single-post-related">';
                while ($related_query->have_posts()) : $related_query->the_post(); 
                    echo '<div class="ef5-grid-item '.esc_attr($col).'">';
                        get_template_part( 'template-parts/loop/content-related', get_post_format() );
                    echo '</div>';
                endwhile;
                echo '</div></div>';
            }
            wp_reset_postdata();
        }
    }
}
/**
 * Single Post Pagination 
*/
if(!function_exists('theclick_post_navigation')){
    function theclick_post_navigation($args = []){
        $args = wp_parse_args($args, [
            'layout' => '1'
        ]);
        //$navigation = get_the_post_navigation();
        $prevthumbnail = $nextthumbnail = $prev_thumb = $next_thumb = $pr_cats = $ne_cats = '';
        $prevPost = get_previous_post(false);
        $nextPost = get_next_post(false);
        if($prevPost) $prevthumbnail = get_the_post_thumbnail($prevPost->ID,'thumbnail');
        if($nextPost) $nextthumbnail = get_the_post_thumbnail($nextPost->ID,'thumbnail');
        if(!$prevPost && !$nextPost) return;

        $taxo = theclick_get_post_taxonomies();
        $prev_cats = get_the_terms($prevPost->ID, $taxo);
        $next_cats  = get_the_terms( $nextPost->ID, $taxo);
        if ( $prev_cats && ! is_wp_error( $prev_cats ) ){
            $p_cats = array();
            foreach ( $prev_cats as $p_cat ) {
                $p_cats[] = $p_cat->name;
            }                
            $pr_cats = join( ", ", $p_cats );
        }
        if ( $next_cats && ! is_wp_error( $next_cats ) ){
            $n_cats = array();
            foreach ( $next_cats as $n_cat ) {
                $n_cats[] = $n_cat->name;
            }                
            $ne_cats = join( ", ", $n_cats );
        }

        if(!empty($prevthumbnail)) {
            $prev_thumb = '<div class="nav-thub-img">'.$prevthumbnail.'</div>';
        }
        if(!empty($nextthumbnail)) {
            $next_thumb = '<div class="nav-thub-img">'.$nextthumbnail.'</div>';
        }
        
        $previous = get_previous_post_link(
            '<div class="nav-previous">%link</div>',
            '<div class="meta-nav">'.esc_html__('Previous Post','theclick').'</div><div class="post-nav-wrap">'.$prev_thumb.'<div class="nav-title"><div class="nav-post-cat">'.$pr_cats.'</div><div class="post-title">%title</div></div></div>'
        );
     
        $next = get_next_post_link(
            '<div class="nav-next">%link</div>',
            '<div class="meta-nav">'.esc_html__('Next Post','theclick').'</div><div class="post-nav-wrap"><div class="nav-title"><div class="nav-post-cat">'.$ne_cats.'</div><div class="post-title">%title</div></div>'.$next_thumb.'</div>'
        );
        $nav_links = ['nav-links'];
        if(empty($previous)) $nav_links[] = 'justify-content-end';
        if ( is_singular( 'attachment' ) ) {
            // Parent post navigation.
            the_post_navigation(
                array(
                    'prev_text' => _x( '<span class="meta-nav">Published in</span><br/><span class="post-title">%title</span>', 'Parent post link', 'theclick' ),
                )
            );
        } elseif ( is_singular( 'post' ) ) {
            // Previous/next post navigation.
            switch ($args['layout']) {
                default:
            ?>
                <nav class="navigation post-navigation">
                    <div class="<?php echo implode(' ', $nav_links);?>">
                        <?php echo theclick_html($previous.$next) ?>
                    </div>
                </nav>
            <?php
                break;
            }
        } elseif (is_singular('ef5_portfolio')){
            theclick_portfolio_navigation($args);
        }
    }
}

/**
 * Single portfolio navigation 
 *
 * @since 1.0.0
*/
if(!function_exists('theclick_portfolio_navigation')){
    function theclick_portfolio_navigation($args = array()){
        $args = wp_parse_args($args, array('layout' => '1'));
        extract( $args );
        $prevthumbnail = $nextthumbnail = '';
        $prevPost = get_previous_post();
        $nextPost = get_next_post();
        if(!$prevPost && !$nextPost) return;

        $portfolio_archive_page = theclick_get_opts('portfolio_page','-1');

        if($portfolio_archive_page === '-1')
            $portfolio_archive_link = get_post_type_archive_link( 'ef5_portfolio' );
        else 
            $portfolio_archive_link = theclick_get_link_by_slug($portfolio_archive_page, 'page');

        switch ($layout) {
            case '2':
                if($prevPost) { ?>
                    <a href="<?php the_permalink($prevPost->ID);?>" class="hint--top" data-hint="<?php echo get_the_title($prevPost->ID); ?>"><span class="flaticon-left-arrow-1"></span></a>            
                <?php } ?>
                <a href="<?php echo esc_url($portfolio_archive_link); ?>" class="archive-link hint--top" data-hint="<?php esc_html_e('View All Projects','theclick');?>"><span class="flaticon-menu"></span></a>
                <?php if($nextPost) { ?>
                    <a href="<?php the_permalink($nextPost->ID);?>" class="hint--top" data-hint="<?php echo get_the_title($nextPost->ID); ?>">
                    <span class="flaticon-right-arrow-1"></span></a>   
                <?php }
            break;
            default:
        ?>
        <nav class="post-navigation portfolio-navigation">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-2 order-md-2 text-center">
                    <a href="<?php echo esc_url($portfolio_archive_link); ?>" class="archive-link"><span class="fa fa-th-large"></span></a>
                </div>
                <div class="nav-box previous col-sm-auto col-md-5 order-md-1 text-<?php echo theclick_align();?>">
                    <?php if($prevPost) { ?>
                        <a class="nav-link" href="<?php the_permalink($prevPost->ID);?>">
                            <div class="meta-nav"><?php esc_html_e('Previous Post','theclick'); ?></div>
                            <div class="post-title h6"><?php echo get_the_title($prevPost->ID); ?></div>
                        </a>            
                    <?php } ?>
                </div>
                <div class="nav-box next col-sm-auto col-md-5 order-md-3 text-<?php echo theclick_align2();?>">
                    <?php if($nextPost) { ?>
                        <a class="nav-link" href="<?php the_permalink($nextPost->ID);?>">
                            <div class="meta-nav"><?php esc_html_e('Next Post','theclick'); ?></div>
                            <div class="post-title h6"><?php echo get_the_title($nextPost->ID); ?></div>
                        </a>   
                    <?php } ?>
                </div>
            </div>
        </nav>
        <?php
            break;
        }
    }
}