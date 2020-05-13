<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$cl_group_1 = (array) vc_param_group_parse_atts( $cl_group_1 );
if(empty($cl_group_1[0])) {
    echo '<p class="require required">'.esc_html__('Please add a Category item!','theclick').'</p>';
    return;
}
 
$thumbnail_size = !empty($thumbnail_size) ? $thumbnail_size : 'full';
?>
<div class="<?php $this->theclick_catalog_menu_wrap_css_class($atts);?>">
    <ul class="catalog-parent no-padding">
    <?php 
    $i=0;
    foreach($cl_group_1 as $group_1){
        $i++;
        $item_child_cls = $has_child_cls = '';
        $catalog_img = isset($group_1['image']) ? $group_1['image'] : '';
        $cl_group_2 = (array) vc_param_group_parse_atts( $group_1['cl_group_2'] );
         
        $toggle_html = '';   
        if(!empty($cl_group_2[0])){
            $item_child_cls = 'menu-item-has-children';
            $has_child_cls = 'has-child';
            $toggle_html = '<span class="ef5-toggle"><span class="ef5-toggle-inner"></span></span>';   
        }
        $clss = [
            'cat-item-parent',
            'item-parent-'.$i,
            $has_child_cls
        ]; 
        if($i == 1) $clss[] = 'active';

        if(!empty($group_1['title_1'])){
            $link_open = '<a class="'.trim(implode(' ', $clss)).'" data-parent="parent-'.$i.'" href="javascript:void(0);">';
            $link_close = '</a>';
            if(isset($group_1['category_link_1'])){
                $cat_link = vc_build_link( $group_1['category_link_1']);
                $cat_link = ( $cat_link == '||' ) ? '' : $cat_link;
                if ( strlen( $cat_link['url'] ) > 0 ) {
                    $link = true;
                    $a_href = $cat_link['url'];
                    $a_title = $cat_link['title'] ? $cat_link['title'] : '';
                    $a_target = strlen( $cat_link['target'] ) > 0 ? str_replace(' ','',$image_link['target']) : '_self';
                    $link_open = '<a class="'.trim(implode(' ', $clss)).'" data-parent="parent-'.$i.'" href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'">';
                    $link_close = '</a>';

                }
            }
            
            echo '<li class="menu-item list-item '.$item_child_cls.'">';   
                echo  theclick_html($link_open.'<span class="menu-title">'.$group_1['title_1'].'</span>'.$toggle_html.$link_close);
                if(!empty($cl_group_2[0])){
                    echo '<ul class="ef5-submenu ef5-dropdown catalog-child parent-'.$i.'">';
                    $t=0;
                    foreach($cl_group_2 as $group_2){
                        $t++;
                        $link_cls = ($t == 1) ? 'active' : '';
                        if(isset($group_2['category_link_2'])){
                            $cat_link = vc_build_link( $group_2['category_link_2']);
                            $cat_link = ( $cat_link == '||' ) ? '' : $cat_link;
                            
                            if ( strlen( $cat_link['url'] ) > 0  && !empty($cat_link['title'])) {
                                $a_target = strlen( $cat_link['target'] ) > 0 ? str_replace(' ','',$cat_link['target']) : '_self';
                                echo '<li class="menu-item cata-list-item-child">';
                                echo '<a class="cat-item-child '.$link_cls.'" href="'.$cat_link['url'].'" target="'.esc_attr($a_target).'">'.$cat_link['title'].'</a>';
                                echo '</li>';
                            }
                            if ( strlen( $cat_link['url'] ) <= 0  && !empty($cat_link['title'])) {
                                echo '<li class="menu-item list-item-child">';
                                echo '<h5 class="cata-subcat-title">'.$cat_link['title'].'</h5>';
                                echo '</li>';
                            }

                        }
                    }
                    echo '</ul>';
                }

                $catalog_img = isset($group_1['image']) ? $group_1['image'] : '';
                
                if(!empty($catalog_img)){
                    $img_url = theclick_get_image_url_by_size([
                        'id'            => $catalog_img,
                        'size'          => $thumbnail_size,
                        'default_thumb' => false,
                        'class'         => 'img-bg'
                    ]);

                    $link_open = '<div class="cat-item-parent-image parent-'.$i.'" style="background: url('.$img_url.') no-repeat center center; background-size:cover;">';
                    $link_close = '</div>';
                    if(isset($group_1['category_link_1'])){
                        $cat_link = vc_build_link( $group_1['category_link_1']);
                        $cat_link = ( $cat_link == '||' ) ? '' : $cat_link;
                        if ( strlen( $cat_link['url'] ) > 0 ) {
                            $link = true;
                            $a_href = $cat_link['url'];
                            $a_title = $cat_link['title'] ? $cat_link['title'] : '';
                            $a_target = strlen( $cat_link['target'] ) > 0 ? str_replace(' ','',$image_link['target']) : '_self';
                            $link_open = '<a class="cat-item-parent-image parent-'.$i.'" href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'" style="background: url('.$img_url.') no-repeat center center; background-size:cover;">';
                            $link_close = '</a>';

                        }
                    }
                    echo theclick_html($link_open);
                    theclick_image_by_size([
                        'id'            => $catalog_img,
                        'size'          => $thumbnail_size,
                        'default_thumb' => false,
                        'class'         => 'img-static w-auto'
                    ]);
                    echo theclick_html($link_close);
                }
            echo '</li>';
        }
    }
    ?>
    </ul>
</div>