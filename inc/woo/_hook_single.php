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

        $gallery_layout = theclick_get_opts('product_gallery_layout','simple');
        $gallery_layout = (isset($_GET['gallery_layout']) && !empty($_GET['gallery_layout'])) ? $_GET['gallery_layout'] : $gallery_layout;
        if( $product_style == 'slider' || $product_style == 'grid')
			$classes = ['ef5-wc-img-summary','product-style-'.$product_style];
		else
			$classes = ['ef5-wc-img-summary', $gallery_layout,'product-style-'.$product_style];
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
		add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_video_feature', 4);
    }elseif($product_style == 'slider'){
		add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_single_gallery_slider', 3);
		add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_video_feature', 4);
		$class = '';
    }elseif($product_style == 'grid'){
		add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_single_gallery_grid', 3);
		$class = '';
    }else{
		add_action('theclick_woocommerce_single_gallery', 'woocommerce_show_product_images', 3);
		add_action('theclick_woocommerce_single_gallery', 'theclick_woocommerce_video_feature', 4);
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
	$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
	$image_single      = wp_get_attachment_image_src( $post_thumbnail_id, 'woocommerce_single' );
	if ( $product->get_image_id() ) { 
	?>
	<div class="main-img-sticky">
		 
		<?php
		
		$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		 
		//echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );  
		if(has_post_thumbnail()){
            $attributes_main = array(
                'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
                'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
                'data-src'                => $image_single[0],
                'data-large_image'        => $full_size_image[0],
                'data-zoom-image'         => $full_size_image[0],  
                'data-large_image_width'  => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2],
                'srcset'                  => ''  
            );

            $html = '<a href="' . esc_url( $full_size_image[0] ) . '" class="p-thumb thumbnail-slider-item idx-0" data-idx="0">';
            $html .= get_the_post_thumbnail( $post->ID, apply_filters( 'theclick_single_product_sticky_main_img_size', 'woocommerce_single' ), $attributes_main );
            $html .= '</a>';
            
            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,get_post_thumbnail_id( $post->ID ) );
        }

		$attachment_ids = $product->get_gallery_image_ids();

		if ( $attachment_ids ) {
			foreach ( $attachment_ids as $k => $attachment_id ) {
				$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
				$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
				$image_single      = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
				$attributes_gal      = array(
                    'title'                   => get_post_field( 'post_title', $attachment_id ),
                    'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
                    'data-src'                => $image_single[0],
                    'data-zoom-image'         => $full_src[0],  
                    'data-large_image'        => $full_src[0],
                    'data-large_image_width'  => $full_src[1],
                    'data-large_image_height' => $full_src[2],
                );
                $html = '<a href="' . esc_url( $full_src[0] ) . '" class="thumbnail-slider-item idx-'.esc_attr($k+1).'" data-idx="'.esc_attr($k+1).'">';
                $html .= wp_get_attachment_image( $attachment_id, 'woocommerce_single',false, $attributes_gal );
                $html .= '</a>';

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		}
		?>
		 
	</div>
	<?php
	}
}

function theclick_woocommerce_single_gallery_slider(){
	global $post, $product; 
	 
	$post_thumbnail_id = $product->get_image_id();
	$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
	$image_single      = wp_get_attachment_image_src( $post_thumbnail_id, 'woocommerce_single' );
	if ( $product->get_image_id() ) { 
	?>
	<div class="main-img-slider">
		<?php
		$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		if(has_post_thumbnail()){
            $attributes_main = array(
                'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
                'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
                'data-src'                => $image_single[0],
                'data-large_image'        => $full_size_image[0],
                'data-zoom-image'         => $full_size_image[0],  
                'data-large_image_width'  => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2],
                'srcset'                  => ''  
            );

            $html = '<a href="' . esc_url( $full_size_image[0] ) . '" class="thumbnail-slider-item idx-0" data-idx="0">';
            $html .= get_the_post_thumbnail( $post->ID, apply_filters( 'theclick_single_product_slider_main_img_size', 'woocommerce_single' ), $attributes_main );
            $html .= '</a>';
            
            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,get_post_thumbnail_id( $post->ID ) );
        }

		$attachment_ids = $product->get_gallery_image_ids();

		if ( $attachment_ids ) {
			foreach ( $attachment_ids as $k => $attachment_id ) {
				$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
				$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
				$image_single      = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
				$attributes_gal      = array(
                    'title'                   => get_post_field( 'post_title', $attachment_id ),
                    'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
                    'data-src'                => $image_single[0],
                    'data-zoom-image'         => $full_src[0],  
                    'data-large_image'        => $full_src[0],
                    'data-large_image_width'  => $full_src[1],
                    'data-large_image_height' => $full_src[2],
                );
                $html = '<a href="' . esc_url( $full_src[0] ) . '" class="thumbnail-slider-item idx-'.esc_attr($k+1).'" data-idx="'.esc_attr($k+1).'">';
                $html .= wp_get_attachment_image( $attachment_id, 'woocommerce_single',false, $attributes_gal );
                $html .= '</a>';

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		}
		?>
		 
	</div>
	<?php
	}
}
function theclick_woocommerce_single_gallery_grid(){
	global $post, $product; 
	$post_thumbnail_id = $product->get_image_id();
	$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
	$image_single      = wp_get_attachment_image_src( $post_thumbnail_id, 'woocommerce_single' );
	if ( $product->get_image_id() ) { 
	?>
	<div class="main-img-grid">
	<div class="row text-center">
		<?php
		$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		if(has_post_thumbnail()){
            $attributes_main = array(
                'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
                'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
                'data-src'                => $image_single[0],
                'data-large_image'        => $full_size_image[0],
                'data-zoom-image'         => $full_size_image[0],  
                'data-large_image_width'  => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2],
                'srcset'                  => ''  
            );

            echo '<div class="p-thumb col-12">';
            echo '<a href="' . esc_url( $full_size_image[0] ) . '" class="thumbnail-slider-item idx-0" data-idx="0">';
            echo get_the_post_thumbnail( $post->ID, apply_filters( 'theclick_single_product_slider_main_img_size', 'woocommerce_single' ), $attributes_main );
            echo '</a>';
            theclick_woocommerce_video_feature();
            echo '</div>';
            
            //echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,get_post_thumbnail_id( $post->ID ) );
        }

		$attachment_ids = $product->get_gallery_image_ids();
		  
		if ( $attachment_ids ) {
			foreach ( $attachment_ids as $k => $attachment_id ) {
				$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
				$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
				$image_single      = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
				$attributes_gal      = array(
                    'title'                   => get_post_field( 'post_title', $attachment_id ),
                    'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
                    'data-src'                => $image_single[0],
                    'data-zoom-image'         => $full_src[0],  
                    'data-large_image'        => $full_src[0],
                    'data-large_image_width'  => $full_src[1],
                    'data-large_image_height' => $full_src[2],
                );
                $html = '<div class="p-gal col-12 col-md-6"><a href="' . esc_url( $full_src[0] ) . '" class="thumbnail-slider-item idx-'.esc_attr($k+1).'" data-idx="'.esc_attr($k+1).'">';
                $html .= wp_get_attachment_image( $attachment_id, 'woocommerce_single',false, $attributes_gal );
                $html .= '</a></div>';

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
 
			}
		}
		?>
	</div>	 
	</div>
	<?php
	}
}
function theclick_woocommerce_video_feature(){
	$video_type  = theclick_get_page_opt('video_type',''); 
	$video_url   = theclick_get_page_opt('product-video-url',''); 
	$video_file  = theclick_get_page_opt('product-video-file',''); 
	$video_embed = theclick_get_page_opt('product-video-html',''); 
     
	if( !empty($video_type) && ($video_type == 'url' || $video_type == 'file')){
		$video_source_url = $video_type == 'url' ? $video_url : $video_file['url'];
        if(!empty($video_source_url)){
            echo '<a href="'.esc_url($video_source_url).'" class="video-feature"><i class="fa fa-play"></i>'.esc_html__( 'Play video','bixbang' ).'</a>';
        }
    }
    if( !empty($video_type) && $video_type == 'embed' && !empty($video_embed ) ){
    	 
        echo '<a href="#ef5-video-embed" class="ef5-video-embed"><i class="fa fa-play"></i>'.esc_html__( 'Play video','bixbang' ).'</a>';
        
        ?>
        <div id="ef5-video-embed" class="mfp-hide fall-perspective text-center"><?php echo theclick_html($video_embed) ?></div>
         
        <?php
    }
}
/**
 * Add Custom CSS class to Gallery
*/
add_filter('woocommerce_single_product_image_gallery_classes','theclick_woocommerce_single_product_image_gallery_classes');
function theclick_woocommerce_single_product_image_gallery_classes($class){
	$gallery_layout = theclick_get_opts('product_gallery_layout','simple');
    $gallery_layout = (isset($_GET['gallery_layout']) && !empty($_GET['gallery_layout'])) ? $_GET['gallery_layout'] : $gallery_layout;
	$class[] = 'ef5-'.$gallery_layout;
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
        $gallery_layout = (isset($_GET['gallery_layout']) && !empty($_GET['gallery_layout'])) ? $_GET['gallery_layout'] : $gallery_layout;
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
        if( $product_style == 'slider' || $product_style == 'grid') return;
		$gallery_layout = theclick_get_opts('product_gallery_layout', 'simple');
		$gallery_layout = (isset($_GET['gallery_layout']) && !empty($_GET['gallery_layout'])) ? $_GET['gallery_layout'] : $gallery_layout;
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
	            <?php foreach ( $attachment_ids as $k => $attachment_id ) { ?>
	                <div class="wc-gallery-sync-slide flex-control-thumb thumbnail-slider-item idx-<?php echo esc_attr($k)?>" data-idx="<?php echo esc_attr($k)?>"><?php theclick_image_by_size(['id' => $attachment_id, 'size' => $thumbnail_size]);?></div>
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
	function woocommerce_template_single_title() {
		the_title( '<div class="product-single-title ef5-heading h2">', '</div>' );
	}
}

/**
 * Single Product Price
**/
if ( ! function_exists( 'woocommerce_template_single_price' ) ) {
	function woocommerce_template_single_price() {
		global $product;
		echo theclick_html($product->get_price_html());
	}
}
/**
 * Single Product variation attribute
**/
add_filter('woocommerce_dropdown_variation_attribute_options_html','theclick_wc_dropdown_variation_filter_pa_size_add_custom_field',11,2);
function theclick_wc_dropdown_variation_filter_pa_size_add_custom_field($html,$args)
{
    if ($args['attribute'] !== 'pa_size')
        return $html;
    $product = $args['product'];
    $terms = wc_get_product_terms($product->get_id(), 'pa_size', array('fields' => 'all'));
    ob_start(); ?>
    <div class="theclick-auto_refill" data-id="pa_size">
        <?php foreach ($terms as $term): ?>
            <a href="#" onclick="return false;" class="auto_refill-element auto_refill-enabled single-size-att" data-value="<?php echo esc_attr($term->slug) ?>">
                <?php echo esc_html($term->name) ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean().$html;
}
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'theclick_wc_dropdown_variation_filter_pa_color_add_custom_field', 11, 2);
function theclick_wc_dropdown_variation_filter_pa_color_add_custom_field($html, $args)
{
    
    $product_style = theclick_get_theme_opt('product_style','default');
    $product_style = (isset($_GET['style']) && !empty($_GET['style'])) ? $_GET['style'] : $product_style;

    if ($args['attribute'] !== 'pa_color')
        return $html;
    $product = $args['product'];
    $available_variations = $product->get_available_variations();
    $terms = wc_get_product_terms($product->get_id(), 'pa_color', array('fields' => 'all'));
    $terms_and_meta = [];
    foreach ($terms as $term) {
        $terms_and_meta[] = array(
            'term'   => $term,
            'color_value' => theclick_get_custom_meta_pa_color($term->term_id)
        );
    };
    $image_attach_color = array();
    $image_attach_full_color = array();

    $thumbnail_id = get_post_thumbnail_id( $product->get_id() );
    foreach ($available_variations as $variation){
        if(empty($variation['attributes']) || empty($variation['attributes']['attribute_pa_color']))
            continue;
        $color =  $variation['attributes']['attribute_pa_color'];
        if( !empty($variation['image_id']) ){
        	if( $variation['image_id'] != $thumbnail_id ){
	            $image_attach_color[$color] = wp_get_attachment_image_src($variation['image_id'],'shop_single');
	        }else{
	        	$image_attach_color[$color] = '';
	        }
            $image_attach_full_color[$color] = wp_get_attachment_image_src($variation['image_id'],'full');
        }
        
        if(is_array($image_attach_color[$color])){
            $image_attach_color[$color] = $image_attach_color[$color][0];
            $image_attach_full_color[$color] = $image_attach_full_color[$color][0];
        }else{
            $image_attach_color[$color] = ''; 
            $image_attach_full_color[$color] = '';
        }
    } 
    ob_start(); ?>
    <div id="theclick-auto_refill" class="theclick-auto_refill" data-id="pa_color">
        <?php 
        	foreach ($terms_and_meta as $term_and_meta):
	            extract($term_and_meta);
	            $bg_css = "background-color:" . (!empty($color_value) ? $color_value : $term->slug);

	            $image_attach = !empty($image_attach_color[$term->slug]) ? $image_attach_color[$term->slug] : '';
	            $image_attach_full = !empty($image_attach_full_color[$term->slug]) ? $image_attach_full_color[$term->slug] : '';

	            $variations_img_cls = '';
	            if(!empty($image_attach)){
	                $bg_css = "background-image:url({$image_attach}); background-size: cover; background-position-y: center;";
	                $variations_img_cls = 'variations-img';
	            }

	            ?>
	            <a href="#" onclick="return false;" aria-label="<?php echo esc_html($term->name) ?>"  class="auto_refill-element auto_refill-enabled product_refill-image single-color-att hint--top <?php echo esc_attr($variations_img_cls)?>" data-original-title="<?php echo esc_html($term->name) ?>" data-image="<?php echo esc_attr($image_attach) ?>" data-value="<?php echo esc_attr($term->slug) ?>" data-img-full="<?php echo esc_attr($image_attach_full)?>"
	                 style="<?php echo esc_attr($bg_css) ?>"><span class="fa fa-check"></span>
	            </a>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean().$html;
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
 