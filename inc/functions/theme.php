<?php
/**
 * Language direction 
*/
function theclick_direction($return = true){
    $theclick_direction = is_rtl() ? 'dir-right' : 'dir-left';
    if($return)
        return $theclick_direction;
    else 
        echo esc_attr($theclick_direction);
}
/**
 * get text-align left / right for RTL language 
*/
function theclick_align($return = true){
    $theclick_align = is_rtl() ? 'right' : 'left';
    if($return)
        return $theclick_align;
    else 
        echo esc_attr($theclick_align);
}
function theclick_align2($return = true){
    $theclick_align = is_rtl() ? 'left' : 'right';
    if($return)
        return $theclick_align;
    else 
        echo esc_attr($theclick_align);
}
// Custom space
function theclick_spacing($mode = '',$dir = '',$space = '', $echo = true){
    if(empty($mode) || empty($space) || empty($dir)) return;
    if(is_rtl() && $dir = 'r'){
        $_dir = 'l';
    } elseif (is_rtl() && $dir = 'l') {
        $_dir = 'r';
    } else {
        $_dir = $dir;
    }
    if($echo) {
        echo esc_attr($mode.$_dir.'-'.$space);
    } else {
        return esc_attr($mode.$_dir.'-'.$space);
    }
}
// Optimize CSS class
function theclick_optimize_css_class($string){
    $string = preg_replace('!\s+!', ' ', $string);
    return $string;
}
/**
 * Page CSS Class
*/
function theclick_page_css_class($class = ''){
    $cls = apply_filters('theclick_page_css_class',[]);
    $classes = array_merge(
        [
            'ef5-page',
            'page-header-'.theclick_get_opts('header_layout', '1'),
            $class
        ], 
        $cls
    );
    if(theclick_get_opts('header_ontop', '0') === '1' || theclick_get_opts('header_sticky', '0') === '1'){
       $classes[] = 'page-header-ontop';
    }

    $show_sidenav = theclick_get_opts('header_side_nav', '0');
    if('0' !== $show_sidenav && is_active_sidebar('sidebar-nav')){
        if('-1' === $show_sidenav)
            $side_pos = theclick_get_theme_opt('header_side_nav_pos','pos-left');
        else
            $side_pos = theclick_get_opts('header_side_nav_pos','pos-left');
            
        $classes[] = 'sidenav-' . $side_pos;
    }
    
    
    echo trim(implode(' ', $classes));
}

/*
 * Archive sidebar position 
*/
function theclick_archive_sidebar_position(){
    return apply_filters('theclick_archive_sidebar_position','bottom');
}
/*
 * Page sidebar position 
*/
function theclick_page_sidebar_position(){
    return apply_filters('theclick_page_sidebar_position','bottom');
}
/*
 * Archive content  grid column
*/
function theclick_archive_grid_col(){
    return apply_filters('theclick_archive_grid_col', '8');
}
/*
 * Single Post sidebar position 
*/
function theclick_post_sidebar_position(){
    return apply_filters('theclick_post_sidebar_position','bottom');
}
/*
 * Single Portfolio sidebar position 
*/
function theclick_portfolio_sidebar_position(){
    return apply_filters('theclick_portfolio_sidebar_position','bottom');
}
/*
 * Content area css class
*/
function theclick_get_sidebar($check = true){
    $sidebar = 'none';
    if(is_post_type_archive('post') || is_home()){
        $sidebar = 'sidebar-main';
    }elseif (is_singular('post')) {
        $sidebar = 'sidebar-single';
    }elseif (is_post_type_archive('portfolio') || is_singular('ef5_portfolio')) {
        $sidebar = 'sidebar-portfolio';
    } elseif (is_page()) {
        if (class_exists('WooCommerce') && (is_checkout() || is_cart())) {
            $sidebar = 'sidebar-shop';
        } else {
            $sidebar = 'sidebar-page';
        }
    } elseif (class_exists('WooCommerce') && (is_woocommerce() || is_post_type_archive('product') || is_singular('product') ) ) {
        $sidebar = 'sidebar-shop';
    } elseif(class_exists('Tribe__Events__Main')){
        $sidebar = 'sidebar-tribe-event';
    } elseif (is_archive() || is_search()){
        $sidebar = 'sidebar-main';
    }
    if($check)
        return is_active_sidebar($sidebar);
    else 
        return $sidebar;
}
function theclick_sidebar_position(){
    if((is_archive() || is_post_type_archive('post') || is_home() || is_search()) && !is_post_type_archive('product')){
        $sidebar_position = theclick_get_opts('archive_sidebar_pos', theclick_archive_sidebar_position());
    } elseif(is_post_type_archive('portfolio')){
        $sidebar_position = theclick_get_opts('portfolio_archive_sidebar_pos', theclick_archive_sidebar_position());
    } elseif(is_page()){
        if (class_exists('WooCommerce') && (is_checkout() || is_cart())) {
            $sidebar_position = theclick_get_opts('page_sidebar_pos',theclick_shop_sidebar_position());
        } else {
            $sidebar_position = theclick_get_opts('page_sidebar_pos',theclick_page_sidebar_position());
        }
    } elseif (is_singular('post')) {
        $sidebar_position = theclick_get_opts('post_sidebar_pos',theclick_post_sidebar_position());
    } elseif (is_singular('ef5_portfolio')) {
        $sidebar_position = theclick_get_opts('portfolio_sidebar_pos',theclick_portfolio_sidebar_position());
    } elseif (class_exists('WooCommerce') && is_post_type_archive('product')) {
        $sidebar_position = theclick_get_opts('shop_sidebar_pos',theclick_shop_sidebar_position());
    } elseif (is_singular('product')) {
        $sidebar_position = theclick_get_opts('product_sidebar_pos',theclick_product_sidebar_position());
    } elseif (class_exists('Tribe__Events__Main') && is_post_type_archive('tribe_events')) {
        $sidebar_position = theclick_get_opts('trible_events_sidebar_pos','right');
    } else {
        $sidebar_position = 'none';
    }
    return $sidebar_position;
}

function theclick_content_css_class($class=''){
    $classes = [
        'ef5-content-area',
        $class
    ];
    $sidebar            = theclick_get_sidebar();
    $sidebar_position   = theclick_sidebar_position();
    $content_grid_class = theclick_archive_grid_col();
    
    if( $sidebar_position === 'bottom' ){
        $classes[] = 'col-12 has-gtb';
    } else {
        if($sidebar && ('none' !== $sidebar_position || 'center' == $sidebar_position)){
            $classes[] = 'col-lg-'.$content_grid_class;
            if($sidebar_position == 'left') $classes[] = 'order-lg-1';
            if($sidebar_position == 'center') $classes[] = 'offset-lg-2';
        } else {
            $classes[] = 'col-12';
        }
    }

    echo theclick_optimize_css_class(implode(' ', $classes));
}
/**
 * Show Widget 
*/

function theclick_sidebar(){
    $sidebar            = theclick_get_sidebar(false);
    $sidebar_position   = theclick_sidebar_position();
    if($sidebar_position === 'none' || $sidebar_position === 'center') return;
    if( is_active_sidebar( $sidebar ) ) {
    ?>
        <div id="ef5-sidebar-area" class="<?php theclick_sidebar_css_class('col-lg-29/509'); ?>">
            <div class="sidebar-inner">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php }
}

/*
 * Widget area css class
*/
function theclick_sidebar_css_class($class=''){
    $classes = [
        'ef5-sidebar-area'
    ];
    if(!is_singular() || is_single() || !is_page_template()) $classes[] = 'ef5-blogs';
    $sidebar_position   = theclick_sidebar_position();
    if( $sidebar_position === 'bottom' ){
        $classes[] = 'col-12 has-gtb';
    } else { 
        $classes[] = $class;
        $archive_grid_col = theclick_archive_grid_col();
        $has_dash = explode('/',$archive_grid_col);
        if(count($has_dash)<=1){
            $content_grid_class = (int)theclick_archive_grid_col();
            $sidebar_grid_class = 12 - $content_grid_class;
            $classes[] = 'col-lg-'.$sidebar_grid_class; 
        }
    }

    echo theclick_optimize_css_class(implode(' ', $classes));
}

/**
 * Scan svg directory
 * @param $filename
 * @return $image
 */
if (!function_exists('theclick_get_svg')) {
    function theclick_get_svg($filename)
    {
        if(file_exists(get_template_directory() . '/assets/images/svg/' . $filename.'.svg'))
            return '<img class="ef5-svg" src="' . esc_url(get_template_directory_uri() . '/assets/images/svg/' . $filename . '.svg') . '">';
        else return; 
    }
}
 
