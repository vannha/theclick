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
			'icon'	 => '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/svg/wishlist.svg') . '">'
		]);
		$show_wishlist = theclick_get_opts('header_wishlist', '0');
		if (!class_exists('WooCommerce') || !class_exists('WPcleverWoosw') || '0' === $show_wishlist) return;
		echo wp_kses_post($args['before']);
		?>
		<a href="<?php echo WPcleverWoosw::get_url(); ?>" class="ef5-header-wishlist-icon header-icon has-badge"><?php echo theclick_html($args['icon']); ?><span class="header-count wishlist-count" data-count="0"><?php echo WPcleverWoosw::get_count(); ?></span></a>
<?php
		echo wp_kses_post($args['after']);
	}
}
