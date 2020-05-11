<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$cl_group_1 = (array) vc_param_group_parse_atts( $cl_group_1 );
if(empty($cl_group_1[0])) {
    echo '<p class="require required">'.esc_html__('Please add a Category item!','theclick').'</p>';
    return;
}
$has_col2 = false;
$has_col3 = false;
//continue ....
?>
<div class="<?php $this->theclick_catalog_menu_wrap_css_class($atts);?>">
    <div class="row">
        <div class="catalog-parent-wrap col-12 col-xl-3">
            <ul class="catalog-parent no-padding">
            <?php 
                foreach($cl_group_1 as $group_1){
                    $catalog_img = isset($group_1['image']) ? $group_1['image'] : '';
                    $cl_group_2 = (array) vc_param_group_parse_atts( $group_1['cl_group_2'] );
                    if(!empty($cl_group_2[0])){
                        $has_col2 = true;
                    }
                    if(!empty($catalog_img)){
                        $has_col3 = true;
                    }
                    if(!empty($group_1['title_1'])){
                        echo '<li class="list-item">';   
                            echo '<a href="#">'.$group_1['title_1'].'</a>';
                        echo '</li>';
                    }
                }
            ?>
            </ul>
        </div>
        <?php if($has_col2): ?>
        <div class="catalog-child-wrap col-12 col-xl-3">
            <?php  
            foreach($cl_group_1 as $group_1){
                $cl_group_2 = (array) vc_param_group_parse_atts( $group_1['cl_group_2'] );
                echo '<ul class="catalog-child no-padding">';
                    foreach($cl_group_2 as $group_2){
                        if(isset($group_2['category_link_2'])){
                            $cat_link = vc_build_link( $group_2['category_link_2']);
                            $cat_link = ( $cat_link == '||' ) ? '' : $cat_link;
                            if ( strlen( $cat_link['url'] ) > 0  && !empty($cat_link['title'])) {
                                $a_target = strlen( $cat_link['target'] ) > 0 ? str_replace(' ','',$cat_link['target']) : '_self';
                                echo '<li class="list-item-child">';
                                echo '<a href="'.$cat_link['url'].'" target="'.esc_attr($a_target).'">'.$cat_link['title'].'</a>';
                                echo '</li>';
                            }
                        }
                    }
                echo '</ul>';
            }
            ?>
        </div>
        <?php endif; ?>
        <?php if($has_col3): ?>
        <div class="catalog-img-wrap col-12 col-xl-6">
            <?php  
            foreach($cl_group_1 as $group_1){
                $catalog_img = isset($group_1['image']) ? $group_1['image'] : '';
                if(!empty($catalog_img)){
                    theclick_image_by_size([
                        'id'            => $catalog_img,
                        'size'          => $thumbnail_size,
                        'default_thumb' => false,
                        'class'         => 'img-static w-auto'
                    ]);
                }
            }
            ?>
        </div>
        <?php endif; ?>
    </div>
</div>