<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_wp_menu
*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if(empty($nav_menu)) return;

$wrap_css_class = ['ef5-wp-menu'];
if( $layout_type !== 'default') {
	$wrap_css_class[] = $layout_type;
	$wrap_css_class[] = 'ef5-toggle-block-wrap';
}
$wrap_css_class[] = $el_class;

$menu_title = get_term_by('slug',$nav_menu,'nav_menu');

$menu_container_class = ['ef5-menu-container'];
if($layout_type === 'toggle') $menu_container_class[] = 'ef5-wrap-menu-toggle ef5-toggle-block-content';

$menu_class = ['menu', $layout_mode];
if($add_divider === '1'){
	$menu_class[] = 'add-divider';
	$menu_class[] = 'divider-'.$divider_style;
}
$menu_class[] = $el_class;

$nav_menu_args = array(
	'fallback_cb'     => '',
	'container_class' => trim(implode(' ', $menu_container_class)),
	'menu'            => $nav_menu,
	'menu_class'      => trim(implode(' ', $menu_class)),
	'walker'          => new OverCome_Menu_Walker()
);
// Title
$title = '';
if(!empty($el_title)){
    vc_icon_element_fonts_enqueue($title_icon_type);
    $title_iconClass = ${'title_icon_icon_'.$title_icon_type};
    $el_title_icon = !empty($title_iconClass) && $add_title_icon ? '<span class="title-icon '.$title_iconClass.'"></span>' : '';
    $title = '<span class="ef5-el-title">'.$el_title_icon.$el_title.'</span>';
}
?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<?php switch ($layout_type) {
			case 'toggle':
			?>
				<div class="ef5-toggle-block">
					<?php echo theclick_html($title); ?>
				</div>
			<?php
				break;
			default:
			?>
				<?php $this->title($atts);?>
			<?php
			break;
		}
		wp_nav_menu($nav_menu_args);
	?>
</div>