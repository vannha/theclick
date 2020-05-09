<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$cl_group_1 = (array) vc_param_group_parse_atts( $cl_group_1 );
if(empty($cl_group_1[0])) {
    echo '<p class="require required">'.esc_html__('Please add a Category item!','theclick').'</p>';
    return;
}
?>
<div class="<?php $this->theclick_catalog_menu_wrap_css_class($atts);?>">
    <ul class="catalog-parent no-padding">
    <?php 
        foreach($cl_group_1 as $group_1){
            $catalog_img = isset($group_1['image']) ? $group_1['image'] : '';
            $cl_group_2 = (array) vc_param_group_parse_atts( $group_1['cl_group_2'] );
            if(!empty($group_1['title_1'])){
                echo '<li class="list-item">';
                    echo '<div class="col-12 col-xl-4">';
                    echo '<a href="#">'.$group_1['title_1'].'</a>';
                    echo '</div>';
                    if(!empty($cl_group_2[0])){
                        echo '<div class="col-12 col-xl-4">';
                        echo '<ul class="catalog-child no-padding">';
                        foreach($cl_group_2 as $group_2){
                            if(!empty($group_2['title_2'])){
                            echo '<li class="list-item-child">';
                                echo '<a href="#">'.$group_2['title_2'].'</a>';
                            echo '</li>';
                            }
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                    if(!empty($catalog_img)){
                        echo '<div class="d-none d-xl-block col-12 col-xl-4">';
                        theclick_image_by_size([
                            'id'    => $catalog_img,
                            'size'  => $atts['thumbnail_size'],
                            'class' => 'img-static w-auto'
                        ]);
                        echo '</div>';
                    }
                echo '</li>';
            }
        }
    ?>
    </ul>
</div>