<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img_sizes = !empty($image_size) ? $image_size : 'medium';
if(!empty($taxonomies)){
	$taxonomies_arr = explode(',', $taxonomies);
	echo '<div class="ef5-categorys-wrap">';
	echo '<div class="row product-cats-row gutter-xl-50">';
	$i=0;
	foreach ($taxonomies_arr as $tax) {
		$i++;
		$item_cls = 'col-23 col-md-4';
		$img_size = $img_sizes;
		if( $i == 1 ){
			$item_cls = 'col-12 col-lg-10 offset-lg-1 col-one';
			$img_size = '1000x500';
		}
		if( $i == 2 || $i == 3 ){
			$item_cls = 'col-12 col-md-6 col-two';
			$img_size = '800x500';
		}
		echo '<div class="'.$item_cls.'">';
			$cat = get_term_by('slug', $tax, 'product_cat');
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
			$bg_attr = 'style="background: url('.theclick_get_image_url_by_size(['id'=>$thumbnail_id,'size'=> 'full', 'default_thumb' => true]).') center center; background-size: cover;"';
			if(!empty($thumbnail_id)){
			echo '<div class="pcats-wrap">'; 
				echo '<a href="'.esc_url(get_term_link($cat->term_id,'product_cat')).'">';
		    	 	theclick_image_by_size([
			            'id'    => $thumbnail_id,
			            'size'  => $img_size,
			            'class' => 'cat-img'
			        ]);
		        	echo '<div class="gradient"></div>';
			        echo '<div class="content-wrap">';
			        	if(!empty($cat->name))
			        	echo '<span class="main-title">'.$cat->name.'</span>';
			        	if(!empty($cat->description))
			        	echo '<p class="sub-title">'.$cat->description.'</p>';
			        	echo '<span class="cat-btn-link">'.esc_html__( 'Shop Now','theclick' ).'</span>';
	 				echo '</div>';
	            echo '</a>';
		    echo '</div>';
			}
	    echo '</div>';
	}
	echo '</div>';
	echo '</div>';
}
