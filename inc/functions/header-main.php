<?php
/**
 * Header Main 
*/
if(!function_exists('theclick_header_main')){
    function theclick_header_main($class = ''){
        $header_layout = theclick_get_opts('header_layout','1');
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop() || is_product_category() || is_product_tag() || is_singular('product'))) { 
            $woo_header_layout = theclick_get_theme_opt('woo_header_layout','');
            $header_layout = !empty($woo_header_layout) ? $woo_header_layout : $header_layout;
        }
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop())) { 
            $woo_header_layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'header_layout', true);
            $header_layout = $woo_header_layout != '-1' ? $woo_header_layout : $header_layout;
        }
        
        get_template_part('template-parts/header/layout', $header_layout);
    }
}
/**
 * Header Class 
**/
if(!function_exists('theclick_header_class')){
    function theclick_header_class($class = ''){
        $classes = [];
        $classes[] = 'ef5-header';
        $header_ontop  = theclick_get_opts('header_ontop','0');
        $header_sticky = theclick_get_opts('header_sticky','0');
        $header_layout = theclick_get_opts('header_layout','1');

        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop() || is_product_category() || is_product_tag() || is_singular('product'))) { 
            $woo_header_layout = theclick_get_theme_opt('woo_header_layout','');
            $header_layout = !empty($woo_header_layout) ? $woo_header_layout : $header_layout;
        }
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop())) { 
            $woo_header_layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'header_layout', true);
            $header_layout = $woo_header_layout != '-1' ? $woo_header_layout : $header_layout;
        }

        $classes[] = 'header-layout-'.$header_layout;
        if($header_layout === '3') $classes[] = 'side-header';

        if(!$header_ontop && !$header_sticky){
            $classes[] = 'header-default';
        } elseif ($header_ontop && !$header_sticky){
            $classes[] = 'header-ontop';
        } elseif (!$header_ontop && $header_sticky){
            $classes[] = 'header-default header-default-sticky sticky-on';
        } elseif($header_ontop && $header_sticky){
            $classes[] = 'header-ontop header-ontop-sticky sticky-on';
        } elseif($header_ontop){
            $classes[] = 'header_ontop';
        } elseif($header_sticky){
            $classes[] = 'header-default header-default-sticky sticky-on';
        }

        if(!empty($class)) $classes[] = $class;
        
        echo 'class="'.trim(implode(' ', $classes)).'"';
    }
}
if(!function_exists('theclick_header_inner_class')){
    function theclick_header_inner_class($class = ''){
        $header_fullwidth = theclick_get_opts('header_fullwidth', '0');
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop() || is_product_category() || is_product_tag() || is_singular('product'))) { 
            $woo_header_fullwidth = theclick_get_theme_opt('woo_header_fullwidth','');
            $header_fullwidth = !empty($woo_header_fullwidth) ? $woo_header_fullwidth : $header_fullwidth;
        }
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop())) { 
            $woo_header_fullwidth = get_post_meta(get_option('woocommerce_shop_page_id'), 'header_fullwidth', true);
            $header_fullwidth = $woo_header_fullwidth != '-1' ? $woo_header_fullwidth : $header_fullwidth;
        }
         
        $classes = array('header-inner');
        if('1' === $header_fullwidth){
            $classes[] = 'no-container';
        } else {
            $classes[] = 'container';
        }
        if(!empty($class)) $classes[] = $class;
        echo trim(implode(' ', $classes));
    }
}

if(!function_exists('theclick_header_ontop')){
    function theclick_header_ontop(){
        $header_ontop = theclick_get_opts('header_ontop');
        return  $header_ontop;
    }
}

if(!function_exists('theclick_header_sticky')){
    function theclick_header_sticky(){
        $header_sticky = theclick_get_opts('header_sticky');
        return  $header_sticky;
    }
}

if(!function_exists('theclick_header_menu')){
    function theclick_header_menu($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = theclick_get_opts('header_menu','ef5-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="ef5-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php get_template_part( 'template-parts/header/header-menu' ); ?>
            </nav>
        <?php
    }
}

if(!function_exists('theclick_header_blog_menu')){
    function theclick_header_blog_menu($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = theclick_get_opts('header_blog_menu','ef5-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="ef5-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php 
                $megamenu = apply_filters('ef5_enable_megamenu', false);
                $args =  array(
                    'theme_location' => 'ef5-primary',
                    'menu'           => $header_menu,
                    'container'      => '',
                    'menu_id'        => 'ef5-header-menu',
                    'menu_class'     => theclick_header_menu_class(),
                    'link_before'    => '<span class="menu-title">',
                    'link_after'     => '</span>',  
                    'walker'         => ($megamenu && class_exists( 'EF5Systems_MegaMenu_Walker' )) ? new EF5Systems_MegaMenu_Walker : new TheClick_Main_Menu_Walker,
                    'fallback_cb' =>   'theclick_header_menu_fallback'
                );
                wp_nav_menu($args);
                ?>
            </nav>
        <?php
    }
}

if(!function_exists('theclick_header_menu_left')){
    function theclick_header_menu_left($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = theclick_get_opts('header_menu_left','ef5-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="ef5-menu-left" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php 
                $megamenu = apply_filters('ef5_enable_megamenu', false);
                $args =  array(
                    'theme_location' => 'ef5-primary',
                    'menu'           => $header_menu,
                    'container'      => '',
                    'menu_id'        => '',
                    'menu_class'     => theclick_header_menu_class('menu-left-menu'),
                    'link_before'    => '<span class="menu-title">',
                    'link_after'     => '</span>',  
                    'walker'         => ($megamenu && class_exists( 'EF5Systems_MegaMenu_Walker' )) ? new EF5Systems_MegaMenu_Walker : new TheClick_Main_Menu_Walker,
                    'fallback_cb' =>   'theclick_header_menu_fallback'
                );
                wp_nav_menu($args);
                ?>
            </nav>
        <?php
    }
}

if(!function_exists('theclick_header_menu_right')){
    function theclick_header_menu_right($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = theclick_get_opts('header_menu_right','ef5-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="ef5-menu-right" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php 
                $megamenu = apply_filters('ef5_enable_megamenu', false);
                $args =  array(
                    'theme_location' => 'ef5-primary',
                    'menu'           => $header_menu,
                    'container'      => '',
                    'menu_id'        => '',
                    'menu_class'     => theclick_header_menu_class('menu-right-menu'),
                    'link_before'    => '<span class="menu-title">',
                    'link_after'     => '</span>',  
                    'walker'         => ($megamenu && class_exists( 'EF5Systems_MegaMenu_Walker' )) ? new EF5Systems_MegaMenu_Walker : new TheClick_Main_Menu_Walker,
                    'fallback_cb' =>   'theclick_header_menu_fallback'
                );
                wp_nav_menu($args);
                ?>
            </nav>
        <?php
    }
}

if(!function_exists('theclick_header_side_menu')){
    function theclick_header_side_menu($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = theclick_get_opts('header_menu','ef5-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="ef5-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php get_template_part( 'template-parts/header/header-side-menu' ); ?>
            </nav>
        <?php
    }
}

if(!function_exists('theclick_header_menu_fallback')){
    function theclick_header_menu_fallback(){
        printf(
            '<ul id="ef5-header-menu" class="%1$s"><li class="menu-item required"><a href="%2$s">%3$s</a></li></ul>',
            esc_attr(theclick_header_menu_class('primary-menu-not-set')),
            esc_url( admin_url( 'nav-menus.php?action=locations' ) ),
            esc_html__( 'Primary menu is not set, please location to "Primary Menu".', 'theclick' )
        );
    }
}

/**
 * Header Menu Class
 * add class to menu container class
 *
*/
if(!function_exists('theclick_header_menu_class')){
    function theclick_header_menu_class($class=''){
        $classes = ['ef5-menu'];
        $header_layout = theclick_get_opts('header_layout', '1');
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop() || is_product_category() || is_product_tag() || is_singular('product'))) { 
            $woo_header_layout = theclick_get_theme_opt('woo_header_layout','');
            $header_layout = !empty($woo_header_layout) ? $woo_header_layout : $header_layout;
        }
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || is_shop())) { 
            $woo_header_layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'header_layout', true);
            $header_layout = $woo_header_layout != '-1' ? $woo_header_layout : $header_layout;
        }
        $header_ontop  = theclick_get_opts('header_ontop','0');
        $header_sticky = theclick_get_opts('header_sticky','0');
        $header_helper_menu = theclick_get_opts('header_helper_menu','');

        if($header_layout === '0')
            $classes[] = 'ef5-side-menu';
        else 
            $classes[] = 'ef5-header-menu';

        if(!$header_ontop && !$header_sticky){
            $classes[] = 'menu-default';
        } elseif ($header_ontop && !$header_sticky){
            $classes[] = 'menu-ontop';
        } elseif (!$header_ontop && $header_sticky){
            $classes[] = 'menu-default';
        } elseif($header_ontop && $header_sticky){
            $classes[] = 'menu-ontop';
        }

        if(is_nav_menu($header_helper_menu)) $classes[] = 'has-helper-menu';

        $classes[] = $class;

        return trim(implode(' ', $classes));
    }
}