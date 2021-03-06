<?php

/**
 * Change search form
 **/
function theclick_my_search_form($form){
	$post_type = get_post_type();
	switch ($post_type) {
		case 'product':
			$search_query = '<input type="hidden" name="post_type" value="product" />';
			break;
		default:
			$search_query = '';
			break;
	}
	$form = '<form method="get" action="' . esc_url(home_url('/')) . '" class="search-form">
		<div class="searchform-wrap">
        <input type="text" value="' . get_search_query() . '" name="s" class="search-field" placeholder="' . esc_attr__("Search here...", 'theclick') . '" >';
	$form .= wp_kses_post($search_query);
	$form .= '<button type="submit" value="Search" class="search-submit">'. theclick_get_svg('search').'</button>';
	$form .= '</div></form>';
	return $form;
}
add_filter('get_search_form', 'theclick_my_search_form');
/**
 * Header Search Icon
 * @since 1.0.0 
*/
if(!function_exists('theclick_header_search')){
	function theclick_header_search($args = []){
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => '',
			'icon'	 => theclick_get_svg('search'),
			'label'  => '',
			'class'  => '',
			'display'=> ''
		]);
		$show_search = theclick_get_opts('header_search', '0');

		$search_display = ($args['display'] !='') ? $args['display'] : theclick_get_opts('search_display', '0');
		if( class_exists('WooCommerce') && ( is_product_category() || is_product_tag() || is_singular('product')) ) { 
            $woo_header_attr_archive = theclick_get_theme_opt('woo_header_attr_archive','');
            $show_search = in_array('search', $woo_header_attr_archive) ? '1' : $show_search;
        }
		if('0' === $show_search) return;

		$link_classes = ['header-icon search-icon',$args['class']];
		$label_html = !empty($args['label']) ? '<span>'.$args['label'].'</span>' : '';
		echo wp_kses_post($args['before']);
		if($search_display == '1'){
			$link_classes[] = 'ef5-header-popup ';
			add_action('wp_footer', 'theclick_header_search_popup_html');
			echo '<a href="#ef5-header-search" class="'. trim(implode(' ', $link_classes)).'">'.theclick_html($args['icon'] . $label_html).'</a>';
		} else {
			echo '<div class="' . trim(implode(' ', $link_classes)) . '">';
				echo '<div class="ef5-search-toggle">';
					echo '<a href="#ef5-header-search" class="link-search-toggle">' . theclick_html($args['icon'] . $label_html) . '</a>';
					get_search_form();
				echo '</div>';
			echo '</div>';
			
		}
		echo wp_kses_post($args['after']);
		 
	}
}

if(!function_exists('theclick_header_search_popup_html')){
	function theclick_header_search_popup_html($args = []){
		$show_search = theclick_get_opts('header_search', '0');
		if('0' === $show_search) return;
		$form_classes = ['ef5-searchform'];
		$args = wp_parse_args($args, [
			'icon'	 => 'fal fa-search',
			'type'	 => 'popup'
		]);

		if($args['type'] === 'popup'){
			$form_classes[] = 'mfp-hide container';
		}
	?>
		<div id="ef5-header-search" class="<?php echo trim(implode(' ', $form_classes));?>">
			<div class="row justify-content-center">
				<div class="col-auto">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	<?php
	}
}
