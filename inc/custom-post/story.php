<?php
/**
 * Custom post type Story
 * 
 * This custom make some custom to Story
 *
 */
add_filter('ef5_extra_post_type_stories', '__return_true');

add_filter('ef5_extra_post_types', 'theclick_cpts_stories', 10 , 1);
function theclick_cpts_stories($post_types) {
	$supported_stories = apply_filters('ef5_extra_post_type_stories', false);
    if($supported_stories) {
	    $post_types['ef5_stories'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('TheClick Stories', 'theclick'),
			'singular_name' => esc_html__('TheClick Story', 'theclick'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-universal-access-alt',
				'rewrite'       => array(
					'slug'       => theclick_get_theme_opt('stories_slug','ef5_stories'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
add_filter('ef5_extra_taxonomies', 'theclick_cpts_stories_tax', 10 , 1);
function theclick_cpts_stories_tax($taxo) {
	$supported_stories = apply_filters('ef5_extra_post_type_stories', false);
    if($supported_stories) {
	    $taxo['stories_cat'] = array(
	    	'status'     => true,
    		'post_type'  => array('ef5_stories'),
	        'taxonomy'   => esc_html__('Category', 'theclick'),
	        'taxonomies' => esc_html__('Categories', 'theclick'),
	        'args'       => array(),
        	'labels'     => array()
	    );
	    $taxo['stories_tag'] = array(
	    	'status'     => true,
	    	'post_type'  => array('ef5_stories'),
	        'taxonomy'   => esc_html__('Tag', 'theclick'),
	        'taxonomies' => esc_html__('Tags', 'theclick'),
	        'args'       => array(
	        	'hierarchical' => false,
	        ),
        	'labels'     => array()
	    );
	}
    return $taxo;
}

// Support Payment 
add_filter('ef5payments_post_type_support','ef5payments_post_type_stories');
add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_stories');
add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_stories');

function ef5payments_post_type_stories($post_type){
	$post_type[] = 'ef5_stories';
	return $post_type;
}

// Elements function
function theclick_story_goal($args = []){
    $post_type = get_post_type(get_the_ID());
    if($post_type !== 'ef5_stories') return;

    $args = wp_parse_args($args,[
        'label' => esc_html__('Donation Goal:','theclick'),
        'class' => ''
    ]);
    $post_type = get_post_type(get_the_ID());
    if($post_type !== 'ef5_stories') return;

    $meta = apply_filters('ef5payments_get_post_meta',[],get_the_ID(),false);
    $donation_goal = (int)$meta['donation_goal'];
    $params = [
        'currency'    => $meta['currency'],
        'amount_mask' => $meta['amount_mask']
    ];
    $goal = apply_filters('ef5payments_payment_create_amount', '', $donation_goal, $params);
    $goal = '<span class="ef5-value">'.$goal.'</span>';
    $args['label'] = '<span class="ef5-label">'.$args['label'].'</span>';

    $classes = ['ef5-donation-goal', $args['class']];
    ?>
        <span class="<?php echo trim(implode(' ', $classes)); ?>"><?php
                echo apply_filters('theclick_story_goal_html', $args['label'].' '.$goal, $goal);
            ?></span>
    <?php
}

//add_filter('theclick_story_goal_html','theclick_story_goal_html', 10, 2);
function theclick_story_goal_html($args, $goal){
    $args = [
        'label' => 'label',
        'before' => 'before',
        'after' => 'after'
    ];
    return $args['label']. $args['before'] . $goal . $args['after'];
}

function theclick_story_raised($args = []){
    $post_type = get_post_type(get_the_ID());
    if($post_type !== 'ef5_stories') return;

    $args = wp_parse_args($args,[
        'label' => esc_html__('Donate so far:','theclick'),
        'class' => ''
    ]);
    $meta = apply_filters('ef5payments_get_post_meta',[],get_the_ID(),false);
    $donation_raised = (int)$meta['donation_raised'];
    $params = [
        'currency'    => $meta['currency'],
        'amount_mask' => $meta['amount_mask']
    ];
    $raised = apply_filters('ef5payments_payment_create_amount', '', $donation_raised, $params);
    $raised = '<span class="ef5-value">'.$raised.'</span>';
    $args['label'] = '<span class="ef5-label">'.$args['label'].'</span>';
    $classes = ['ef5-donation-raised', $args['class']];

    ?>
        <span class="<?php echo trim(implode(' ', $classes));?>"><?php
                echo apply_filters('theclick_story_raised_html', $args['label'].' '.$raised, $raised);
            ?></span>
    <?php
}

//add_filter('theclick_story_raised_html','theclick_story_raised_html', 10, 2);
function theclick_story_raised_html($args, $raised){
    $args = [
        'label' => 'label',
        'before' => 'before',
        'after' => 'after'
    ];
    return $args['label']. $args['before']. $raised . $args['after'];
}

// Loop story info
function theclick_loop_story_info(){
	$post_type = get_post_type(get_the_ID());
    if(class_exists('EF5Payments') && in_array($post_type, apply_filters('ef5payments_payment_attach_post_types',['ef5_donation']))){
	?>
		<div class="ef5-loop-story-info row justify-content-between">
			<div class="col-md-6">
				<?php theclick_story_raised(); ?>
			</div>
			<div class="col-md-6">
				<?php 
					theclick_story_donate_button(); 
					theclick_post_share(['show_share' => '1','title'=>esc_html__('Share:','theclick')]);
				?>
			</div>
		</div>
	<?php
	} else {
		theclick_post_read_more(['show_readmore' => '1']); 
	}
}
function theclick_story_donate_button($args = [])
{   
    wp_enqueue_script('bootstrap');
    $params = wp_parse_args($args,[
        'id'     => '',
        'title'  => esc_html__('Donate Now','theclick'),
        'class'  => 'ef5-btn',
        'url'    => '#',
        'target' => '_self',
        'echo'   => true
    ]);
    $post_id = !empty($params['id']) ? $params['id'] : get_the_ID();
    $data = apply_filters('ef5payments_get_payment_form_data',[
        'class'        => '',
        'data-options' => '',
        'data-target'  => ''
    ],$post_id);
    $class = $params['class'].' '.$data['class'] ;
    $url = !empty($params['url']) ? $params['url'] : '#';
    $target = !empty($params['target']) ? $params['target'] : '_self';
    if($params['echo']){
    ?>
    <a class="<?php echo esc_attr($class) ?>"
       data-options="<?php echo esc_attr($data['data-options']) ?>"
       data-target="<?php echo esc_attr($data['data-target']) ?>"
       href="<?php echo esc_attr($url) ?>" target="<?php echo esc_attr($target) ?>" ><?php echo wp_kses_post($params['title']) ?></a>
    <?php
    } else {
        return '<a class="'.esc_attr($class).'"
       data-options="'.esc_attr($data['data-options']).'"
       data-target="'.esc_attr($data['data-target']).'"
       href="'.esc_attr($url).'" target="'.esc_attr($target).'" >'.esc_html($params['title']).'</a>';
    } 
}
