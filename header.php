<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package EF5 Theme
 * @subpackage TheClick
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
    <?php theclick_page_loading(); ?>
    <div id="ef5-page" class="<?php theclick_page_css_class();?>">
    <?php theclick_header_top(); ?>
    <?php 
        /*$ptitle_ontop = theclick_get_opts('ptitle_ontop','0');
        if(is_singular('post'))
        $ptitle_ontop = theclick_get_theme_opt('psingle_ptitle_ontop', '0');
        if($ptitle_ontop == '1')
            theclick_page_title();*/
    ?>
    <div id="ef5-header-wrap">
        <?php
        $ptitle_ontop = theclick_get_opts('ptitle_ontop','0');
        if(is_singular('post'))
        $ptitle_ontop = theclick_get_theme_opt('psingle_ptitle_ontop', '0');
        if($ptitle_ontop == '1')
            theclick_page_title();

            theclick_header_main(); 
            
        if($ptitle_ontop != '1')
            theclick_page_title();
        ?>
    </div>
    <?php 
        /*if($ptitle_ontop != '1')
            theclick_page_title();*/
    ?>
    <main id="ef5-main" class="ef5-main">
