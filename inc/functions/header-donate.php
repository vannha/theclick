<?php
function theclick_header_donate_button(){
	if(!function_exists('ef5payments_donation_donate_button') || theclick_get_opts('header_donate', '0') === '0') return;
	/*ef5payments_donation_donate_button([
		'id'    => ef5payments_default_donation(theclick_get_id_by_slug(theclick_get_opts('header_donate_item',''),'ef5_donation')),
		'title' => theclick_get_opts('header_donate_label', esc_html__('Donate Now','theclick')),
		'class' => 'ef5-btn donate-'.ef5payments_default_donation(theclick_get_id_by_slug(theclick_get_opts('header_donate_item',''),'ef5_donation'))
	]);*/
}