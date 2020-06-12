jQuery(document).ready(function($){
	$('.config_woo_color_field').each(function(){
        $(this).wpColorPicker({palettes: true});
    });
});