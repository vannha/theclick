<?php 
defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 *
 * @package EF5 Theme
 * @version 1.0
 */

add_action('widgets_init', 'TheClick_Recent_Posts_Widget');
function TheClick_Recent_Posts_Widget() {
    register_ef5_widget('TheClick_Recent_Posts_Widget');
}

class TheClick_Recent_Posts_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'theclick_recent_posts',
            esc_html__( '[TheClick] Recent Posts', 'theclick' ),
            array(
                'description' => __( 'Shows your most recent posts.', 'theclick' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array $args An array of standard parameters for widgets in this theme
     * @param array $instance An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => esc_html__( 'Recent Posts', 'theclick' ),
            'post_type'     => 'post',
            'thumbnail_size'=> '80x80',
            'number'        => 4,
            'layout'        => 1,
            'showtype'        => 1,
            'show_author'   => true,
            'show_date'     => true,
            'show_comments' => true,
            'show_cat'      => false,
        ) );

        $title = empty( $instance['title'] ) ? esc_html__( 'Recent Posts', 'theclick' ) : $instance['title'];
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
 
        $number = absint( $instance['number'] );
        if ( $number <= 0 || $number > 10)
        {
            $number = 5;
        }

        $layout         = absint($instance['layout']);
        $showtype       = absint($instance['showtype']);
        $post_type      = $instance['post_type'];
        $thumbnail_size = $instance['thumbnail_size'];
        $show_author    = (bool)$instance['show_author'];
        $show_date      = (bool)$instance['show_date'];
        $show_comments  = (bool)$instance['show_comments'];
        $show_cat       = (bool)$instance['show_cat'];

        if($showtype == '1'){
            $args_sql = array(
                'posts_per_page' => $number,
                'post_type' => $post_type,
                'post_status' => 'publish',
                'no_found_rows'       => true,
                'ignore_sticky_posts' => true,
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => 1
            );
        }else{
            $args_sql = array(
                'post_type' => $post_type,
                'posts_per_page' => $number,
                'post_status' => array('publish', 'future'),
                'orderby'   => 'meta_value_num',
                'order'     => 'DESC',
                'meta_key' => 'post_views_count'
            );
        }
        $r = new WP_Query($args_sql);

        printf('%s', $args['before_widget']);
        printf('%s', $args['before_title'] . $title . $args['after_title']);
        if ( $r->have_posts() )
        {
            echo '<div class="posts-list layout-'.esc_attr($layout).'">';

            while ( $r->have_posts() )
            {
                $r->the_post();

                printf(
                    '<div class="post-list-entry transition %s"><div class="row gutters-20">',
                    ( has_post_thumbnail() ? 'has-post-thumbnail' : '' )
                );

                
                $thumbnail_url = theclick_get_image_url_by_size([
                    'size'          => $thumbnail_size,
                    'default_thumb' => true,
                ]);
                if($layout == '1'){
                    printf(
                        '<div class="ef5-featured col-auto">' .
                            '<a href="%1$s" title="%2$s" class="ef5-thumbnail">' .
                                '<img src="%3$s" alt="%2$s" />' .
                            '</a>' .
                        '</div>',
                        esc_url( get_permalink() ),
                        esc_attr( get_the_title() ),
                        esc_url( $thumbnail_url )
                    );
                }
                echo '<div class="ef5-brief col">';
                if ( $show_cat ){
                    theclick_posted_in();
                }
                printf(
                    '<h4 class="ef5-heading"><a href="%1$s" title="%2$s">%3$s</a></h4>',
                    esc_url( get_permalink() ),
                    esc_attr( get_the_title() ),
                    get_the_title()
                );

                if ( $show_author || $show_comments || $show_date )
                {
                    ob_start();
                    if($show_date) theclick_posted_on();
                    if($show_author) theclick_posted_by(['author_avatar' => false]);
                    if($show_comments) theclick_comments_popup_link(['show_text'=> true]);
                    $post_meta = ob_get_clean();

                    if ( $post_meta )
                    {
                        printf( '<div class="ef5-meta row gutter-20 justify-content-between">%s</div>', $post_meta );
                    }
                }
                echo '</div>';

                echo '</div></div>';
            } // while

            echo '</div>';
        } // have_posts

        wp_reset_postdata();

        printf('%s', $args['after_widget']);
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance )
    {
        $instance                   = $old_instance;
        $instance['title']          = sanitize_text_field( $new_instance['title'] );
        $instance['post_type']      = sanitize_text_field( $new_instance['post_type'] );
        $instance['thumbnail_size'] = sanitize_text_field( $new_instance['thumbnail_size'] );
        $instance['number']         = absint( $new_instance['number'] );
        $instance['layout']         = absint($new_instance['layout']) ;
        $instance['showtype']       = absint($new_instance['showtype']) ;
        $instance['show_author']    = (bool)$new_instance['show_author'] ;
        $instance['show_date']      = (bool)$new_instance['show_date'] ;
        $instance['show_comments']  = (bool)$new_instance['show_comments'];
        $instance['show_cat']       = (bool)$new_instance['show_cat'];
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array $instance An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'          => esc_html__( 'Recent Posts', 'theclick' ),
            'post_type'      => 'post',
            'thumbnail_size' => '80x80',
            'number'         => 4,
            'layout'         => 1,
            'showtype'       => 1,
            'show_author'    => true,
            'show_date'      => true,
            'show_comments'  => true,
            'show_cat'       => false
        ) );

        $title          = $instance['title'] ? esc_attr( $instance['title'] ) : esc_html__( 'Recent Posts', 'theclick' );
        $post_type      = $instance['post_type'] ? $instance['post_type']  : 'post';
        $thumbnail_size = $instance['thumbnail_size'] ? $instance['thumbnail_size']  : '80x80';
        $number         = absint( $instance['number'] );
        $layout         = absint($instance['layout']);
        $showtype       = absint($instance['showtype']);
        $show_author    = (bool) $instance['show_author'];
        $show_date      = (bool) $instance['show_date'];
        $show_comments  = (bool) $instance['show_comments'];
        $show_cat       = (bool) $instance['show_cat'];

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'theclick' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Emter custom post type slug. Default \'post\'', 'theclick' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" type="text" value="<?php echo esc_attr( $post_type ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>"><?php esc_html_e( 'Thumbnail Size', 'theclick' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_size' ) ); ?>" type="text" value="<?php echo esc_attr( $thumbnail_size ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'theclick' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
                <option value="1" <?php if( $layout == '1' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Layout 1', 'theclick');?></option>
                <option value="2" <?php if( $layout == '2' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Layout 2', 'theclick');?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'showtype' ) ); ?>"><?php esc_html_e( 'Type', 'theclick' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'showtype' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showtype' ) ); ?>">
                <option value="1" <?php if( $showtype == '1' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Recent Post', 'theclick');?></option>
                <option value="2" <?php if( $showtype == '2' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Popular', 'theclick');?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'theclick' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_author ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_author' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>"><?php esc_html_e( 'Display post Author?', 'theclick' ); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'theclick' ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_cat ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cat' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_cat' ) ); ?>"><?php esc_html_e( 'Display post Category?', 'theclick' ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_comments ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>"><?php esc_html_e( 'Display post comments?', 'theclick' ); ?></label>
        </p>
        <?php
    }
}