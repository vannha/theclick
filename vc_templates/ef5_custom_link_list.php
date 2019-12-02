<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$wrap_css_class = array('ef5-custom-link-list-wrap', $el_class);
$cl_lists = (array) vc_param_group_parse_atts($cl_list);
?>
<?php if (count($cl_lists) > 0) : ?>
    <?php if ( !empty($wgtitle)) echo '<div class="widgettitle">'. $wgtitle.'</div>'; ?>
        <div class="<?php echo trim(implode(' ', $wrap_css_class)); ?>">
            <ul>
                <?php
                    foreach ($cl_lists as $value) {
                        $link = false;
                        if (isset($value['item_link'])) {
                            $item_link = vc_build_link($value['item_link']);
                            $item_link = ($item_link == '||') ? '' : $item_link;
                            if (strlen($item_link['url']) > 0) {
                                $link = true;
                                $a_href = $item_link['url'];
                                $a_title = $item_link['title'] ? $item_link['title'] : $value['title'];
                                $a_target = strlen($item_link['target']) > 0 ? str_replace(' ', '', $item_link['target']) : '_self';
                            }
                        }

                        if ($link) {
                            echo '<li>';
                            echo '<a class="client-logo" href="' . esc_url($a_href) . '" title="' . esc_attr($a_title) . '" target="' . esc_attr($a_target) . '">' . esc_html($a_title) . '</a>';
                            echo '</li>';
                        }
                    } ?>

            </ul>
        </div>
    <?php endif; ?>