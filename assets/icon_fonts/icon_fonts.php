<?php
define('THECLICK_ICON_FONT_DIR' , get_template_directory_uri() . '/assets/icon_fonts/');
/**
 * EF5 Systems supported some icon font
 * like: Elegant, ET Line, Flaticon, Linear, Pe7 Stroke, Simple Line
 * use filter: ef5systems_default_extra_icons
 * example: 
 	add_filter('ef5systems_default_extra_icons','custom_ef5systems_default_extra_icons');
	function custom_ef5systems_default_extra_icons(){
		return ['flaticon','linear'];
	}
*/
add_filter('ef5systems_default_extra_icons','theclick_ef5systems_default_extra_icons');
function theclick_ef5systems_default_extra_icons(){
	return [
		'elegant',
		'et-line',
		'flaticon',
		'linear',
		'pe7',
		'simple-line'
	];
}
//pe-icon-7-stroke
/**
 * Add filter to support your icon font in Mega Menu and VC 
 * user filter: ef5systems_extra_icons
 * @structure add_filter('ef5systems_extra_icons','theclick_extras_icons');
 * function theclick_extras_icons(){
	return [
		'fontname' => [
			'title'   => 'Font Name',
			'icon'    => theclick_iconpicker_fontname_icons(), // icons list
			'css'     => THECLICK_ICON_FONT_DIR . 'fontname/fontname.css',
			'version' => '1.0'
		]
	];
 }
 * NOTE: replace 'theclick', 'Font Name' with your font name
*/
add_filter('ef5systems_extra_icons','theclick_extras_icons');
function theclick_extras_icons(){
	return [
		'theclick' => [
			'title'   => 'Over Come',
			'icon'    => theclick_iconpicker_theclick_icons(), // icons list
			'css'     => THECLICK_ICON_FONT_DIR.'theclick/theclick.css',
			'version' => '1.0'
		]
	];
}