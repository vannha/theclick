<?php 
defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 *
 * @package EF5 Theme
 * @version 1.0
 */

add_action('widgets_init', 'TheClick_Featured_Posts_Widget');
function TheClick_Featured_Posts_Widget() {
    register_ef5_widget('TheClick_Featured_Posts_Widget');
}

class TheClick_Featured_Posts_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'theclick_featured_posts',
            esc_html__( '[TheClick] Featured Posts', 'theclick' ),
            array(
                'description' => __( 'Shows your most Featured posts.', 'theclick' ),
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
            'title'         => esc_html__( 'Featured Posts', 'theclick' ),
            'post_type'     => 'post',
            'number'        => 6,
        ) );

        $title = empty( $instance['title'] ) ? esc_html__( 'Featured Posts', 'theclick' ) : $instance['title'];
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $post_type = empty( $instance['post_type'] ) ? 'post' : $instance['post_type'];

        printf('%s', $args['before_widget']);

        printf('%s', $args['before_title'] . $title . $args['after_title']);

        $number = absint( $instance['number'] );
        if ( $number <= 0 || $number > 10)
        {
            $number = 4;
        }

        $thumbnail_size = [118,118];
        $r = new WP_Query( array(
            'post_type'           => $post_type,
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) );

        if ( $r->have_posts() )
        {
            echo '<div class="featured-list row gutters-4">';

            while ( $r->have_posts() )
            {
                $r->the_post();

                printf(
                    '<div class="col-4 %s">',
                    ( has_post_thumbnail() ? 'has-post-thumbnail' : '' )
                );
                if(has_post_thumbnail())
                	$thumbnail_url = theclick_get_image_url_by_size( null, implode('x', $thumbnail_size), true );
                else 
                	$thumbnail_url = theclick_default_image_thumbnail_url(['size'=>implode('x', $thumbnail_size)]);
                printf(
                    '<a href="%1$s" class="ef5-thumbnail hint--top" data-hint="%2$s">' .
                        '<img src="%3$s" alt="%2$s" />' .
                    '</a>', 
                    esc_url( get_permalink() ),
                    esc_attr( get_the_title() ),
                    esc_url( $thumbnail_url )
                );
                echo '</div>';
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
        $instance = $old_instance;
        $instance['title']         = sanitize_text_field( $new_instance['title'] );
        $instance['post_type']     = sanitize_text_field( $new_instance['post_type'] );
        $instance['number']        = absint( $new_instance['number'] );
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
            'title'         => esc_html__( 'Featured Posts', 'theclick' ),
            'post_type'     => 'post',
            'number'        => 6,
        ) );

        $title         = $instance['title'] ? esc_attr( $instance['title'] ) : esc_html__( 'Featured Posts', 'theclick' );
        $post_type         = $instance['post_type'] ? esc_attr( $instance['post_type'] ) : 'post';
        $number        = absint( $instance['number'] );

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'theclick' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Emter custom post type slug. Default \'post\'', 'theclick' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" type="post_type" value="<?php echo esc_attr( $post_type ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'theclick' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        <?php
    }
}