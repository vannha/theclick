<?php
/**
 * TheClick_Categories_Walker
 *
 * @version 1.0
 * @package EF5 Theme
 * @since   1.0.2
 *
 */

if ( ! defined( 'ABSPATH' ) )
{
    die();
}
class TheClick_Categories_Walker extends Walker_Category {
    /**
     * Starts the element output.
     *
     * @since 2.1.0
     *
     * @see Walker::start_el()
     *
     * @param string $output   Used to append additional content (passed by reference).
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );
 
        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }

        $image_url = $has_img = '';
        if(class_exists('Taxonomy_Images_Term')){
            $t = new Taxonomy_Images_Term( $category->term_id );
            $img_id = $t->get_image_id();
            if ( $img_id ) {
                $image_url = theclick_get_image_url_by_size( ['id' => $img_id, 'size'=>'310x90'] );
                $has_img = 'has-image';
            }
        }

        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            /**
             * Filters the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }
        if(!empty($has_img)) $link .= ' class="has-im"';
        $link .= '>';

        if ( $args['has_children'] && $args['hierarchical'] && ( empty( $args['max_depth'] ) || $args['max_depth'] > $depth + 1 ) ) {
            $link .= '<span class="title">'.$cat_name;
                if ( ! empty( $args['show_count'] ) ) {
                    $link .= ' <span class="count">' . number_format_i18n( $category->count ) . '</span>';
                }
            $link .= '</span>';
            $link .= theclick_widget_expander();
        } else {
            $link .= !empty($image_url) ? '<img src="'.$image_url.'"/>' : '';
            $link .= !empty($image_url) ? '<div class="title-count">' : '';
            $link .= '<span class="title">'.$cat_name.'</span>';
            if ( ! empty( $args['show_count'] ) ) {
                $link .= ' <span class="count">' . number_format_i18n( $category->count ) . '</span>';
            }
            $link .= !empty($image_url) ? '</div>' : '';
        }

        $link .= '</a>';

        if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
            $link .= ' ';
 
            if ( empty( $args['feed_image'] ) ) {
                $link .= '(';
            }
 
            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';
 
            if ( empty( $args['feed'] ) ) {
                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s','theclick' ), $cat_name ) . '"';
            } else {
                $alt = ' alt="' . $args['feed'] . '"';
                $name = $args['feed'];
                $link .= empty( $args['title'] ) ? '' : $args['title'];
            }
 
            $link .= '>';
 
            if ( empty( $args['feed_image'] ) ) {
                $link .= $name;
            } else {
                $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
            }
            $link .= '</a>';
 
            if ( empty( $args['feed_image'] ) ) {
                $link .= ')';
            }
        }
        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $css_classes = array(
                'ef5-menu-item',
                'ef5-cat-item',
                'ef5-cat-item-' . $category->term_id,
            );
            if($args['has_children']){
                $css_classes[] =  'ef5-cat-parents';
            }
            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );
 
                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }
 
            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
 
            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }
}