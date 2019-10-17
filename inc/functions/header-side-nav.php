<?php
/**
 * Add Header Side Nav Icon
 * @since 1.0
*/
if(!function_exists('theclick_header_side_nav_icon')){
	function theclick_header_side_nav_icon($args = []){
		$show_sidenav = theclick_get_opts('header_side_nav', '0');
		if('0' === $show_sidenav || !is_active_sidebar('sidebar-nav')) return;

		if('-1' === $show_sidenav)
			$icon_type = theclick_get_theme_opt('header_side_nav_icon_type','icon');
		else
			$icon_type = theclick_get_opts('header_side_nav_icon_type','icon');

		$args = wp_parse_args($args, [
			'before'    => '<span id="ef5-main-sidenav" class="header-extra-icon">',
			'after'     => '</span>',
			'icon_type' => $icon_type
		]);
		echo wp_kses_post($args['before']);
			theclick_header_mobile_nav_icon(['title' => esc_html__('Show Widget','theclick'), 'class' => $args['icon_type']]);
		echo wp_kses_post($args['after']);
	}
}

if(!function_exists('theclick_side_nav')){
	function theclick_side_nav($args = []){
		$show_sidenav = theclick_get_opts('header_side_nav', '0');
		if('0' === $show_sidenav || !is_active_sidebar('sidebar-nav')) return;
		$args = wp_parse_args($args, [
			'before' => '<div id="ef5-sidenav"><div id="ef5-close-sidenav" class="ef5-close"></div><div class="ef5-mousewheel"><div class="ef5-mousewheel-inner">',
			'after'  => '</div></div></div>',
			'class'  => ''
		]);
		echo wp_kses_post($args['before']);
			dynamic_sidebar('sidebar-nav');
		echo wp_kses_post($args['after']);
	}
}
add_action('wp_footer','theclick_side_nav', 1);