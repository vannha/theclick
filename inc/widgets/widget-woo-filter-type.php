<?php 
defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 *
 * @package EF5 Theme
 * @version 1.0
 */

add_action('widgets_init', 'TheClick_Woo_Filter_Type_Widget');
function TheClick_Woo_Filter_Type_Widget() {
    register_ef5_widget('TheClick_Woo_Filter_Type_Widget');
}

class TheClick_Woo_Filter_Type_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'theclick_woo_filter_type',
            esc_html__( '[TheClick] Woo Filter Type', 'theclick' ),
            array(
                'description' => __( 'Shows filter type link', 'theclick' ),
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
            'title'      => esc_html__( 'Type', 'theclick' ),
        ) );

        $title = empty( $instance['title'] ) ? esc_html__( 'Type', 'theclick' ) : $instance['title'];
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        printf('%s', $args['before_widget']);
        printf('%s', $args['before_title'] . $title . $args['after_title']);
        
        $filter_type = array(
            'all'              => esc_html__( 'All Products', 'theclick' ),    
            'best_selling'     => esc_html__( 'Best Sellers', 'theclick' ),    
            'recent_product'   => esc_html__( 'New Products', 'theclick' ),    
            'on_sale'          => esc_html__( 'Sale Products', 'theclick' ),   
            'featured_product' => esc_html__( 'Featured Products', 'theclick'), 
            'top_rate'         => esc_html__( 'Top Rate', 'theclick' ),        
            'recent_review'    => esc_html__( 'New Review', 'theclick' ),      
            'deals'            => esc_html__( 'Product Deals', 'theclick' )   
        );
        ?>
        <div class="filter-type d-flex gutter-10">
        <?php 
        $filter_request = !empty($_GET['filter_type']) ? $_GET['filter_type'] : 'all';
        foreach($filter_type as $key => $ft): 
             
            if( $filter_request == $key )
                $active_cls = 'active';
            else
                $active_cls = '';
             
            $link  = add_query_arg( 'filter_type',$key, get_page_link(false) );
            echo '<a href="'.esc_url($link).'" class="filter-link filter-link-'.$key.' '.$active_cls.'">'.$ft.'</a>';
             
        endforeach; 
        
        ?>  
        </div>
        <?php 
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
            'title'          => esc_html__( 'Recent Posts', 'theclick' )
        ) );

        $title          = $instance['title'] ? esc_attr( $instance['title'] ) : esc_html__( 'Type', 'theclick' );

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'theclick' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }
}