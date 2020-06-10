<?php
/**
 * Build Single Product Gallery and Summary layout 
 *
*/

if(!function_exists('theclick_woocommerce_before_single_product_summary')){
	add_action('woocommerce_before_single_product_summary','theclick_woocommerce_before_single_product_summary', 0);
	function theclick_woocommerce_before_single_product_summary(){
		$product_style = theclick_get_theme_opt('product_style','default');
        $product_style = (isset($_GET['style']) && !empty($_GET['style'])) ? $_GET['style'] : $product_style;
		$classes = ['ef5-wc-img-summary', theclick_get_opts('product_gallery_layout','simple'),'product-style-'.$product_style];
		echo '<div class="'.trim(implode(' ', $classes)).'">';
	}
}
if(!function_exists('theclick_woocommerce_after_single_product_summary')){
	add_action('woocommerce_after_single_product_summary','theclick_woocommerce_after_single_product_summary', 0);
	function theclick_woocommerce_after_single_product_summary(){
		echo '</div>';
	}
}
 
/**
 * Wrap Product Image / Gallery in a Div
 * add new acction to add new content
 * new acction: theclick_before_single_product_gallery, theclick_after_single_product_gallery
*/
add_action('woocommerce_before_single_product_summary', function() {
	echo '<div class="ef5-product-gallery-wrap"><div class="ef5-product-gallery-inner">';
}, 0);

add_action('woocommerce_before_single_product_summary', function() { 
	do_action('theclick_before_single_product_gallery');
}, 1);
add_action('woocommerce_before_single_product_summary', function() { 
	do_action('theclick_after_single_product_gallery');
}, 999);

add_action('woocommerce_before_single_product_summary', function() {
	echo '</div></div>';
}, 1000);

/**
 * Wrap gallery in div
*/
/**
 * Add product attributes to inside gallery
 * 
 * add product badge: hot, new, sale, ...
 * Hook: woocommerce_product_thumbnails
*/
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images', 20);

add_action('woocommerce_before_single_product_summary','theclick_woocommerce_single_gallery', 1);
 
function theclick_woocommerce_single_gallery(){
	$class = theclick_get_opts('product_gallery_thumb_position', 'thumb-right');
	$product_style = theclick_get_theme_opt('product_style','default');
    $product_style = (isset($_GET['style']) && !empty($_GET['style'])) ? $_GET['style'] : $product_style;
    add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_sale', 1);
	add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_show_product_loop_badges', 2);
    if($product_style == 'sticky'){
		add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_single_gallery_sticky', 3);
    }else{
		add_action('theclick_woocommerce_single_gallery', 'woocommerce_show_product_images', 3);
	}

	?>
	<div class="ef5-single-product-gallery-wraps <?php echo esc_attr($class);?>">
	<div class="ef5-single-product-gallery-wraps-inner">
		<?php do_action('theclick_woocommerce_single_gallery'); ?>
	</div>
	</div>
	<?php
}
function theclick_woocommerce_single_gallery_sticky(){
	global $post, $product; 
	 
	$post_thumbnail_id = $product->get_image_id();
	if ( $product->get_image_id() ) { 
	?>
	<div class="main-img-sticky">
		 
		<?php
		
		$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		 
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );  

		$attachment_ids = $product->get_gallery_image_ids();

		if ( $attachment_ids ) {
			foreach ( $attachment_ids as $k => $attachment_id ) {
				$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
				$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
				$attributes      = array(
                    'title'                   => get_post_field( 'post_title', $attachment_id ),
                    'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
                    'data-src'                => $full_src[0],
                    'data-zoom-image'         => $full_src[0],  
                    'data-large_image'        => $full_src[0],
                    'data-large_image_width'  => $full_src[1],
                    'data-large_image_height' => $full_src[2],
                );
                $html = '<a href="' . esc_url( $full_src[0] ) . '" class="thumbnail-slider-item idx-'.esc_attr($k+1).'" data-idx="'.esc_attr($k+1).'">';
                $html .= wp_get_attachment_image( $attachment_id, 'woocommerce_single',false, $attributes );
                $html .= '</a>';

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		}
		//do_action( 'woocommerce_product_thumbnails' );
		?>
		 
	</div>
	<?php
	}
}

/**
 * Add Custom CSS class to Gallery
*/
add_filter('woocommerce_single_product_image_gallery_classes','theclick_woocommerce_single_product_image_gallery_classes');
function theclick_woocommerce_single_product_image_gallery_classes($class){
	$class[] = 'ef5-'.theclick_get_opts('product_gallery_layout', 'simple');
	$class[] = theclick_get_opts('product_gallery_thumb_position', 'thumb-right');
	return $class;
}

/**
 * Single Product 
 *
 * Gallery style with thumbnail carousel in bottom
 *
*/
if(!function_exists('theclick_wc_single_product_gallery_layout')){
	add_filter('woocommerce_single_product_carousel_options', 'theclick_wc_single_product_gallery_layout' );
    function theclick_wc_single_product_gallery_layout($options){
        $gallery_layout = theclick_get_opts('product_gallery_layout', 'simple');

        $options['prevText']     = '<span class="flex-prev-icon"></span>';
		$options['nextText']     = '<span class="flex-next-icon"></span>';

        switch ($gallery_layout) {
	        case 'thumbnail_v':
				$options['directionNav'] = true;
				$options['controlNav']   = false;
	            $options['sync'] = '.wc-gallery-sync';
	            break;
	    
	        case 'thumbnail_h':
	            $options['directionNav'] = true;
				$options['controlNav']   = false;
	            $options['sync'] = '.wc-gallery-sync';
	            break;
	    }
	    return $options;
    }
}

/**
 * Single Product Gallery
 *
 * Add thumbnail product gallery 
 *
*/
if(!function_exists('theclick_product_gallery_thumbnail_sync')){
	add_action('theclick_after_single_product_gallery', 'theclick_product_gallery_thumbnail_sync');
	function theclick_product_gallery_thumbnail_sync($args=[]){
		global $product;
		$product_style = theclick_get_theme_opt('product_style','default');
        $product_style = (isset($_GET['style']) && !empty($_GET['style'])) ? $_GET['style'] : $product_style;

		$gallery_layout = theclick_get_opts('product_gallery_layout', 'simple');
		$product_gallery_thumb_position = theclick_get_opts('product_gallery_thumb_position', 'thumb-right');
        $args = wp_parse_args($args, [
            'gallery_layout' => $gallery_layout
        ]);
        $post_thumbnail_id = $product->get_image_id();
    	$attachment_ids = array_merge( (array)$post_thumbnail_id , $product->get_gallery_image_ids() );
 
        if('simple' === $args['gallery_layout'] || empty($attachment_ids[0])) return;
        $flex_class = '';

        $thumb_v_w = theclick_configs('theclick_product_gallery_thumbnail_v_w');
        $thumb_v_h = theclick_configs('theclick_product_gallery_thumbnail_v_h');

        $thumb_h_w = round((theclick_configs('theclick_product_single_image_w') - theclick_configs('theclick_product_gallery_thumbnail_space')*4)/4);
        $thumb_h_h = theclick_configs('theclick_product_gallery_thumbnail_h_h');

        $thumb_margin = theclick_configs('theclick_product_gallery_thumbnail_space');

        switch ($args['gallery_layout']) {
	        case 'thumbnail_v':
				$thumbnail_size = $thumb_v_w.'x'.$thumb_v_h;
				$thumb_w        = $thumb_v_w;
				$thumb_h        = $thumb_v_h;
				$flex_class     = 'flex-vertical';
	            break;
	    
	        case 'thumbnail_h':
	            $thumbnail_size = $thumb_h_w.'x'.$thumb_h_h;
	            $thumb_w = $thumb_h_w;
	            $thumb_h = $thumb_h_h;
	            $flex_class = 'flex-horizontal';
	            break;

	    }
	    if( $product_style == 'sticky'){
	    	$gallery_css_class = ['wc-gallery-sync wc-gallery-sticky-wrap'];
	    	$gal_cls = 'wc-gallery-sticky';
	    }else{
	    	$gallery_css_class = ['wc-gallery-sync', $gallery_layout, $product_gallery_thumb_position];
	    	$gal_cls = 'wc-gallery-sync-slides flexslider '.$flex_class;
	    }
	    
    ?>
    	<div class="<?php echo trim(implode(' ', $gallery_css_class));?>" data-thumb-w="<?php echo esc_attr($thumb_w);?>" data-thumb-h="<?php echo esc_attr($thumb_h);?>" data-thumb-margin="<?php echo esc_attr($thumb_margin); ?>">
			<div class="<?php echo esc_attr($gal_cls);?>">
	            <?php foreach ( $attachment_ids as $attachment_id ) { ?>
	                <div class="wc-gallery-sync-slide flex-control-thumb"><?php theclick_image_by_size(['id' => $attachment_id, 'size' => $thumbnail_size]);?></div>
	            <?php } ?>
	        </div>
	    </div>
    <?php
	}
}

/**
 * single product submmary wrap
 */
add_action( 'woocommerce_single_product_summary', 'theclick_wrap_start_single_product_summary',1);
function theclick_wrap_start_single_product_summary(){
	echo '<div class="single-product-summary-wrap">';
}
add_action( 'woocommerce_single_product_summary', 'theclick_wrap_end_single_product_summary',99);
function theclick_wrap_end_single_product_summary(){
	echo '</div>';
}
/*
 * Single Product title
*/
if ( ! function_exists( 'woocommerce_template_single_title' ) ) {

	/**
	 * Output the product title.
	 */
	function woocommerce_template_single_title() {
		the_title( '<div class="product-single-title ef5-heading h2">', '</div>' );
	}
}
/**
 * Single Product Price
**/
if ( ! function_exists( 'woocommerce_template_single_price' ) ) {
	/**
	 * Output the product price.
	 */
	function woocommerce_template_single_price() {
		global $product;
		echo theclick_html($product->get_price_html());
	}
}
/**
 * Single Product Quantity Form
*/
if(!function_exists('theclick_woocommerce_quantity_input_args')){
	add_filter('woocommerce_quantity_input_args','theclick_woocommerce_quantity_input_args');
	function theclick_woocommerce_quantity_input_args($args){
		$args['product_name'] = '';
		return $args;
	}
}
/**
 * Single Product Meta
*/
if ( ! function_exists( 'woocommerce_template_single_meta' ) ) {

	/**
	 * Output the product meta.
	 */
	function woocommerce_template_single_meta() {
		global $product;
	?>
	<div class="ef5-product-meta">
		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

			<span class="ef5-sku-wrapper meta-item">
				<span class="ef5-heading font-style-700 text-uppercase"><?php esc_html_e( 'SKU:', 'theclick' ); ?></span> <span class="sku"><?php if($sku = $product->get_sku() ) echo esc_html( $sku); else  echo esc_html__( 'N/A', 'theclick' ); ?></span>
			</span>

		<?php endif; ?>

		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted-in meta-item"><span class="ef5-heading font-style-700 text-uppercase">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'theclick' ) . '</span> ', '</span>' ); ?>

		<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged-as meta-item"><span class="ef5-heading font-style-700 text-uppercase">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'theclick' ) . '</span> ', '</span>' ); ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	</div>
	<?php
	}
}
// Product meta share
if(!function_exists('theclick_woocommerce_product_meta_end')){
	add_action('woocommerce_product_meta_end','theclick_woocommerce_product_meta_end', 0);
	function theclick_woocommerce_product_meta_end(){
		$show_share = theclick_get_theme_opt( 'product_share_on', '0');
		if(!$show_share) return;
        wp_enqueue_script('sharethis');
        global $product;
        $url   = get_the_permalink();
        $image = get_the_post_thumbnail_url($product->get_id());
        $title = get_the_title();
		?>
		<span class="meta-item product-sharing">
			<span class="ef5-heading font-style-700 text-uppercase"><?php esc_html_e('Share:','theclick'); ?></span>
			<span class="meta-share">
                <a data-hint="<?php esc_attr_e('Share this post to Facebook','theclick'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="facebook" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce facebook st-custom-button"><span class="fab fa-facebook-f"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to Twitter','theclick'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="twitter" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce twitter st-custom-button"><span class="fab fa-twitter"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to Google Plus','theclick'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="googleplus" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce googleplus st-custom-button"><span class="fab fa-google-plus"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to Pinterest','theclick'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="pinterest" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce pinterest st-custom-button"><span class="fab fa-pinterest"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to','theclick'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="sharethis" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce sharethis st-custom-button"><span class="fa fa-share-alt"></span></a>
			</span>
		</span>
		<?php
	}
}

/**
 * Product Tabs
 * 
 * remove description/additional info heading
*/
add_filter('woocommerce_product_description_heading', function(){ return false;});
add_filter('woocommerce_product_additional_information_heading', function(){ return false;});

// Add on off related
add_action( 'the_post', 'theclick_empty_related_array' );
function theclick_empty_related_array($array){
	$single_product_related = theclick_get_theme_opt('single_product_related','0');
	if($single_product_related == '0')
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
/*
 * Change column of related product
 * https://docs.woocommerce.com/document/change-number-of-related-products-output/
*/
if(!function_exists('theclick_woocommerce_output_related_products_args')){
	add_filter( 'woocommerce_output_related_products_args', 'theclick_woocommerce_output_related_products_args', 20 );
	function theclick_woocommerce_output_related_products_args($args){
		$related_numbers = theclick_get_theme_opt('single_product_related_number', 4); 
		$related_columns = theclick_get_theme_opt('single_product_related_columns', 4); 
		$args['posts_per_page'] = $related_numbers;  
		$args['columns'] = $related_columns;  
		return $args;
	}
}
// Add carousel to related
if(!function_exists('theclick_single_product_scripts')){
	add_action('wp_enqueue_scripts', 'theclick_single_product_scripts');
	function theclick_single_product_scripts(){ 
		$product_related_type = theclick_get_theme_opt('single_product_related_type','grid'); 
		if( is_singular('product') && $product_related_type == 'carousel'){
			wp_enqueue_script('owl-carousel');
			wp_enqueue_style('owl-carousel');
		}
	}
}
 