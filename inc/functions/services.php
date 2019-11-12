<?php
/**
 * Get Servive Menu
*/
if(!function_exists('theclick_service_menu')){
	function theclick_service_menu($args=[]){
		$menu = theclick_get_post_format_value('service_menu','-1');
		if($menu === '-1') $menu = theclick_get_theme_opt('service_menu','');
		if($menu === 'none' || $menu === '') return;
		if($menu === '0') $menu = '';
		$args = wp_parse_args($args, [
			'title'          => esc_html__('Service Menu','theclick'),
			'menu'			 => $menu,		
			'theme_location' => 'ef5-primary',
			'walker'         => new TheClick_Menu_Walker(),
			'fallback_cb'    => ''
		]);
	?>
	<div class="pf-sidebar-box pf-featured-box ef5-sidebar-area">
        <div class="ef5-heading h3"><?php echo theclick_html($args['title']); ?></div>
        <div class="inner widget feature-post-inner ef5-box-shadow ef5-bg-white transition">
			<?php 
				wp_nav_menu([
					'menu'           => $args['menu'],
					'theme_location' => $args['theme_location'],
					'walker'         => $args['walker'],
					'fallback_cb'    => $args['fallback_cb']
				]);
			?>
		</div>
	</div>
	<?php
	}
}
/**
 * Get Featured Service
 * @param: $posts_per_page  // Number of post to show
*/
if(!function_exists('theclick_service_featured')){
	function theclick_service_featured($args = []){
		$args = wp_parse_args($args, [
			'title'          => esc_html__('Featured Service','theclick'),
			'posts_per_page' => '3'
		]);
		if($args['posts_per_page'] === '0' || $args['posts_per_page'] === '') return;
		$r = new WP_Query( array(
            'post_type'           => 'service',
            'posts_per_page'      => $args['posts_per_page'],
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__not_in'		  => array( get_the_ID() )	
        ) );
		$thumbnail_size = [86,66];
        if ( $r->have_posts() ) {
        ?>
            <div class="pf-sidebar-box pf-featured-box">
            	<div class="ef5-heading h3"><?php echo theclick_html($args['title']); ?></div>
	        	<div class="inner feature-post-inner ef5-box-shadow ef5-bg-white transition">
		            <?php while ( $r->have_posts() ) {
		                $r->the_post();
		                $thumbnail_url = theclick_get_image_url_by_size( ['size' => implode('x', $thumbnail_size), 'default_thumb' => true,'class'=>'d-block'] );
		                echo '<div class="pf-feature-item ef5-shadow-hover transition"><div class="row gutters-20 ">';
			                printf(
			                    '<div class="ef5-featured col-auto">' .
			                        '<a href="%1$s" title="%2$s" class="ef5-thumbnail d-block">' .
			                            '<img src="%3$s" alt="%2$s" />' .
			                        '</a>' .
			                    '</div>',
			                    esc_url( get_permalink() ),
			                    esc_attr( get_the_title() ),
			                    esc_url( $thumbnail_url )
			                );
			                echo '<div class="ef5-brief col" style="max-width: calc(100% - '.((int)$thumbnail_size[0]+20).'px);">';
				                printf(
				                    '<div class="ef5-heading h4"><a href="%1$s" title="%2$s">%3$s</a></div>',
				                    esc_url( get_permalink() ),
				                    esc_attr( get_the_title() ),
				                    get_the_title()
				                );
				                printf(
				                	'<div class="ef5-meta">%s</div>',
				                	get_the_term_list( get_the_ID(), theclick_get_post_taxonomies(), '', ', ', '' )
				                );
			                echo '</div>';
		                echo '</div></div>';
		            } ?>
            	</div>
            </div>
        <?php }
        wp_reset_postdata();
	}
}

/**
 * Get Project Supporter
 * @param $user_ID
*/
if(!function_exists('theclick_service_supporter')){
	function theclick_service_supporter($args = []){
		$args = wp_parse_args($args, [
			'email' => theclick_get_post_format_value('post-support',''),
			'title' => esc_html__('Support','theclick')
		]);
		if(empty($args['email']) || $args['email'] = null) return;
	        $user = get_user_by( 'email', theclick_get_post_format_value('post-support','') );
	        if($user !== false){ 
	            global $wp_roles; 
	            $user_info = get_userdata($user->ID);
	            $user_role = $user_info->roles;
	            $all_meta_for_user = get_user_meta( $user->ID );
	            // get role label
	            $role_label = [];
	            foreach ($user_role as $role) {
	            	$role_label[] = translate_user_role($wp_roles->roles[$role]['name']);
	            }
	    ?>
	        <div class="pf-sidebar-box pf-supported-box">
	        	<div class="ef5-heading h3"><?php echo theclick_html($args['title']); ?></div>
	        	<div class="inner supported-inner text-center ef5-box-shadow ef5-bg-white transition">
		            <?php
		            	echo '<div class="sp-avatar">'.get_avatar($user->ID, 90, '', $user_info->display_name, ['class' => 'circle']).'</div>';
		                echo '<div class="ef3-heading h4 sp-name">' . $user_info->display_name .'</div>';
		                echo '<div class="sp-role text-xsmall">' . implode(' / ', $role_label).'</div>';
		                echo '<div class="sp-bio">'.get_user_meta($user->ID,'description', true).'</div>';
		                echo '<div class="sp-phone ef5-heading h3">'.get_user_meta($user->ID,'ef5_phone_number', true).'</div>';
		            ?>
		        </div>
	        </div>
	    
		<?php }
	}
}
/**
 * Get Project Attachment
 * @param $user_ID
*/
if(!function_exists('theclick_service_attachment')){
	function theclick_service_attachment($args = []){
		$args = wp_parse_args($args, [
			'title' => esc_html__('Download','theclick'),
			'class' => ''
		]);
		$number_of_att = apply_filters('theclick_number_of_service_attachment', 5);
		$files = [];
		for ($i=0; $i <= $number_of_att ; $i++) { 
			$att = theclick_get_post_format_value('post-attachment-'.$i,'');
			if(!empty($att)){
				$files[] = $att;
			}
		}
		if(empty($files)) return;
		?>
		<div class="pf-sidebar-box pf-attachment-box">
	        <div class="ef5-heading h3"><?php echo theclick_html($args['title']); ?></div>
	        <div class="inner attachment-inner">
	        	<?php foreach ($files as $file) {
	        		$_file = get_post($file);
	        		$file_type = wp_check_filetype($_file->guid);
	        		switch ($file_type['ext']) {
	        			case 'pdf':
	        				$icon = 'flaticon-pdf';
	        				break;
	        			case 'pptx':
	        				$icon = 'flaticon-pptx-file-format';
	        				break;
	        			case 'ppt':
	        				$icon = 'flaticon-pptx-file-format';
	        				break;
	        			case 'xlsx':
	        				$icon = 'flaticon-xlsx-file-format';
	        				break;
	        			case 'xls':
	        				$icon = 'flaticon-xlsx-file-format';
	        				break;
	        			case 'docx':
	        				$icon = 'flaticon-docx-file-format';
	        				break;
	        			case 'doc':
	        				$icon = 'flaticon-document';
	        				break;
	        			case 'txt':
	        				$icon = 'flaticon-txt-file-symbol';
	        				break;
	        			case 'html':
	        				$icon = 'flaticon-html-file-extension-interface-symbol';
	        				break;
	        			case 'ai':
	        				$icon = 'flaticon-ai-file-format';
	        				break;
	        			case 'psd':
	        				$icon = 'flaticon-photoshop-file-format';
	        				break;
	        			case 'zip':
	        				$icon = 'flaticon-document';
	        				break;
	        			default:
	        				$icon = 'flaticon-layers';
	        				break;
	        		}
					echo '<div class="pf-attachment-item ef5-box-shadow transition bg-white"><a class="ef5-heading text-uppercase row gutters-15 align-items-center" href="'.esc_url($_file->guid).'" target="_blank"><span class="att-icon '.esc_attr($icon).' col-auto"></span><span class="title col">'.esc_html($_file->post_title).'</span></a></div>'; 
	        	} ?>
	        </div>
	    </div>
		<?php
	}
}