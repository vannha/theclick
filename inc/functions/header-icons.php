<?php
/**
 * All header icon
 *
*/
if(!function_exists('theclick_header_mobile_menu_icon')){
	function theclick_header_mobile_menu_icon(){
		$header_menu = theclick_get_opts('header_menu');
		if($header_menu === 'none') return;
		if('-1' === theclick_get_page_opt('header_mobile_nav_icon_type','icon'))
			$icon_style = theclick_get_theme_opt('header_mobile_nav_icon_type','icon');
		else 
			$icon_style = theclick_get_opts('header_mobile_nav_icon_type','icon');

		switch ($icon_style) {
			case 'text':
				echo '<span id="ef5-main-menu-mobile" class="header-icon text d-inline d-xl-none"><span class="btn-nav-mobile open-menu">'.esc_html__('Menu','theclick').'</span></span>';
				break;
			default:
				theclick_header_mobile_nav_icon(['id' => 'ef5-main-menu-mobile','class' => 'header-icon d-inline d-xl-none']);
			break;
		}
	}
}

/**
 * Add Header Mobile Nav Icon 
 * @since 1.0
*/
if(!function_exists('theclick_header_mobile_nav_icon')){
	function theclick_header_mobile_nav_icon($args = []){
		$args = wp_parse_args($args, [
			'before'    => '',
			'after'     => '',
			'id' 		=> '',
			'class' 	=> '',
			'title'     => esc_html__('Show menu','theclick')
		]);
		echo wp_kses_post($args['before']);
		$wrap_classes = ['btn-nav-mobile-wrap'];
		$classes = ['btn-nav-mobile open-menu', $args['class']];
	?>
		<span <?php if(!empty($args['id'])) : ?> id="<?php echo esc_attr($args['id']);?>" <?php endif; ?> class="<?php echo trim(implode(' ', $wrap_classes)); ?>" title="<?php echo esc_attr($args['title']);?>">
	        <span class="<?php echo trim(implode(' ', $classes)); ?>" data-pos="<?php echo esc_attr($args['class']);?>">
	            <span></span>
	        </span>
	    </span>
	<?php
		echo wp_kses_post($args['after']);
	}
}