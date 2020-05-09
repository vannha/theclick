<?php
 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$cl_group_1 = (array) vc_param_group_parse_atts( $cl_group_1 );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add a client logo!','theclick').'</p>';
    return;
}
$count = count($values);
$i=1;
$j=0;

$owl_item_space = '';
$dot_thumbnail_size = '50';
$item_attrs = [];

if(!empty($atts['margin']) && $atts['number_row'] > 1 ) {
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
if(count($cl_group_1) <=0 ) return;
?>
<div class="<?php $this->theclick_catalog_menu_wrap_css_class($atts);?>">
    <div class="<?php //$this->theclick_clients_css_class($atts);?>">
        <ul class="catalog-parent">
        <?php 
            foreach($cl_group_1 as $group_1){
                echo '<li>';
                if(!empty($group_1['title_1'])){
                    $echo  '<div class="ef5-list-item">'.$group_1['title_1'];
                }
                echo '</li>';
            }
        ?>
        </ul>
    </div>
</div>