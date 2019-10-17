<?php
/**
 * This required plugin The Events Calendar to work
 * https://wordpress.org/plugins/the-events-calendar/
*/

function theclick_tribe_events_info($args=[]){
	if(!class_exists('Tribe__Events__Main')) return;
	$args = wp_parse_args($args,[
		'class' => '',
		'echo'	=> true
	]);
	$css_classes = ['ef5-tribe-events-info','empty-none', $args['class']];
	$venue_details = tribe_get_venue_details();
	$address_delimiter = empty( $venue_address ) ? ' ' : ', ';
	
	if($args['echo']){
	?>
		<div class="<?php echo trim(implode(' ', $css_classes));?>">
			<div class="venue empty-none pb-5"><span class="flaticon-coin-1 ef5-text-accent"></span>&nbsp;&nbsp;<?php echo implode( $address_delimiter, $venue_details ); ?></div>
			<div class="date empty-none pb-5"><span class="flaticon-calendar ef5-text-accent"></span>&nbsp;&nbsp;<?php theclick_tribe_events_time(['echo' => $args['echo'] ]) ?></div>
			<div class="cost empty-none"><span class="flaticon-coin-1 ef5-text-accent"></span>&nbsp;&nbsp;<?php echo tribe_get_cost( null, true ); ?></div>
		</div>
	<?php
	} else {
		return 
		'<div class="'.trim(implode(' ', $css_classes)).'">
			<div class="venue empty-none pb-5"><span class="flaticon-maps-and-flags ef5-text-accent"></span>&nbsp;&nbsp;'.implode( $address_delimiter, $venue_details ).'</div>
			<div class="date empty-none pb-5"><span class="flaticon-calendar ef5-text-accent"></span>&nbsp;&nbsp;'.theclick_tribe_events_time(['echo' => $args['echo'] ]).'</div>
			<div class="cost empty-none"><span class="flaticon-coin-1 ef5-text-accent"></span>&nbsp;&nbsp;'.tribe_get_cost( null, true ).'</div>
		</div>';
	}
}

function theclick_tribe_events_info_hori($args=[]){
	if(!class_exists('Tribe__Events__Main')) return;
	$args = wp_parse_args($args,[
		'class' => '',
		'echo'	=> true
	]);
	$css_classes = ['ef5-tribe-events-info','empty-none', 'row', $args['class']];
	$venue_details = tribe_get_venue_details();
	$address_delimiter = empty( $venue_address ) ? ' ' : ', ';
	
	if($args['echo']){
	?>
		<div class="<?php echo trim(implode(' ', $css_classes));?>">
			<div class="date empty-none col-auto pb-5"><span class="flaticon-calendar ef5-text-accent"></span>&nbsp;&nbsp;<?php theclick_tribe_events_time(['echo' => $args['echo'] ]) ?></div>
			<div class="venue empty-none col-auto pb-5"><span class="flaticon-coin-1 ef5-text-accent"></span>&nbsp;&nbsp;<?php echo implode( $address_delimiter, $venue_details ); ?></div>
			<div class="cost empty-none col-auto"><span class="flaticon-coin-1 ef5-text-accent"></span>&nbsp;&nbsp;<?php echo tribe_get_cost( null, true ); ?></div>
		</div>
	<?php
	} else {
		return 
		'<div class="'.trim(implode(' ', $css_classes)).'">
			<div class="date empty-none col-auto pb-5"><span class="flaticon-calendar ef5-text-accent"></span>&nbsp;&nbsp;'.theclick_tribe_events_time(['echo' => $args['echo'] ]).'</div>
			<div class="venue empty-none col-auto pb-5"><span class="flaticon-maps-and-flags ef5-text-accent"></span>&nbsp;&nbsp;'.implode( $address_delimiter, $venue_details ).'</div>
			<div class="cost empty-none col-auto"><span class="flaticon-coin-1 ef5-text-accent"></span>&nbsp;&nbsp;'.tribe_get_cost( null, true ).'</div>
		</div>';
	}
}
function theclick_tribe_events_time($args=[]){
	if(!class_exists('Tribe__Events__Main')) return;
	$args = wp_parse_args($args,[
		'class' => '',
		'echo' => true
	]);
	global $post;
	$event = get_post( $post );
	$event_date_format = tribe_get_date_format( true );
	if($args['echo']){
		echo tribe_get_start_date($event, true, $event_date_format).'&nbsp;-&nbsp;'.tribe_get_end_date($event, true, $event_date_format);
	} else {
		return tribe_get_start_date($event, true, $event_date_format).'&nbsp;-&nbsp;'.tribe_get_end_date($event, true, $event_date_format);
	}
}
/**
 * Register widget area.
 */
function theclick_tribe_events_widgets()
{
	if(!class_exists('Tribe__Events__Main')) return;
    register_sidebar(array(
        'name'          => esc_html__('Events Widgets', 'theclick'),
        'id'            => 'sidebar-tribe-event',
        'description'   => esc_html__('Add widgets here to appear below Tribe Events content.', 'theclick'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="ef5-heading h3 widgettitle">',
        'after_title'   => '</div>',
    ));
}
add_action('widgets_init', 'theclick_tribe_events_widgets');

/**
 * Add support payment for post type tribe_event

*/
// Support Payment 
add_filter('ef5payments_post_type_support','ef5payments_post_type_tribe_events');
add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_tribe_events');
add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_tribe_events');

function ef5payments_post_type_tribe_events($post_type){
	$post_type[] = 'tribe_events';
	return $post_type;
}