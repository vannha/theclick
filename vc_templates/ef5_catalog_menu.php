<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$cl_group_1 = (array) vc_param_group_parse_atts( $cl_group_1 );
if(empty($cl_group_1[0])) {
    echo '<p class="require required">'.esc_html__('Please add a Category item!','theclick').'</p>';
    return;
}
?>
<div class="<?php //$this->theclick_catalog_menu_wrap_css_class($atts);?>">
    <div class="<?php //$this->theclick_clients_css_class($atts);?>">
        <ul class="catalog-parent">
        <?php 
            foreach($cl_group_1 as $group_1){
                $cl_group_2 = (array) vc_param_group_parse_atts( $group_1['cl_group_2'] );
                if(!empty($group_1['title_1'])){
                    echo '<li>';
                    echo '<div class="list-item">'.$group_1['title_1'].'</div>';
                    if(!empty($cl_group_2[0])){
                        echo '<ul class="catalog-child">';
                        foreach($cl_group_2 as $group_2){
                            if(!empty($group_2['title_2'])){
                            echo '<li>';
                                echo '<div class="list-item">'.$group_2['title_2'].'</div>';
                            echo '</li>';
                            }
                        }
                        echo '</ul>';
                    }
                echo '</li>';
                }
            }
        ?>
        </ul>
    </div>
</div>