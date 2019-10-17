<?php
function theclick_iconpicker_fontname_icons(){
	// add your icon here
	// struct ['icon-class-name' => 'icon name']
	// icon name need in array
	$default_icons = [
		['default' => 'default']
	];
	return array_merge($default_icons, apply_filters('theclick_iconpicker_fontname_icons', []));
}
//add_filter( 'vc_iconpicker-type-fontname', 'theclick_vc_iconpicker_type_fontname_icons' );
function theclick_vc_iconpicker_type_fontname_icons( $icons ) {
	$fontname_icons = theclick_iconpicker_fontname_icons();
	return array_merge( $icons, $fontname_icons );
}