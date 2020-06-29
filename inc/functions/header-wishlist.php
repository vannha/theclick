<?php

/**
 * Header WC Wishlist
 * Need WooCommerce and WooCommerce Smart Wishlist to work 
 * https://wordpress.org/plugins/woo-smart-wishlist/
 * @since 1.0.0
 * get the wishlist count
 * echo WPcleverWoosw::get_count();
 * get the wishlist URL
 * echo WPcleverWoosw::get_url();
 */
if (!function_exists('theclick_header_wishlist')) {
	function theclick_header_wishlist($args = [])
	{
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => '',
			'icon'	 => theclick_get_svg('heart'),
			'class'	 => ''
		]);
		$classes = ['ef5-header-wishlist-icon header-icon has-badge', $args['class']];
		$show_wishlist = theclick_get_opts('header_wishlist', '0');
		if( class_exists('WooCommerce') && ( is_product_category() || is_product_tag() || is_singular('product')) ) { 
            $woo_header_attr_archive = theclick_get_theme_opt('woo_header_attr_archive','');
            $show_wishlist = in_array('wishlist', $woo_header_attr_archive) ? '1' : $show_wishlist;
        }
		if (!class_exists('WooCommerce') || !class_exists('WPcleverWoosw') || '0' === $show_wishlist) return;
		echo wp_kses_post($args['before']);
		?>
		<a href="<?php echo WPcleverWoosw::get_url(); ?>" class="<?php echo trim(implode(' ', $classes)); ?>"><?php echo theclick_html($args['icon']); ?><span class="header-count wishlist-count" data-count="0"><?php echo WPcleverWoosw::get_count(); ?></span></a>
<?php
		echo wp_kses_post($args['after']);
	}
}
