<?php
function theclick_woocommerce_query($type='recent_product',$post_per_page=-1,$product_ids='',$taxonomies='',$taxonomies_exclude=''){
    global $wp_query;
	$args = theclick_woocommerce_query_args($type,$post_per_page,$product_ids,$taxonomies,$taxonomies_exclude);
    if (get_query_var('paged')){ 
        $paged = get_query_var('paged'); 
    }elseif(get_query_var('page')){ 
        $paged = get_query_var('page'); 
    }else{ 
        $paged = 1; 
    }
    if($paged > 1){
        $args['paged'] = $paged;
    }
 
    $loop = $wp_query = new WP_Query($args);
	return $loop;
}
 
function theclick_woocommerce_query_args($type='recent_product',$post_per_page=-1,$product_ids='',$taxonomies='',$taxonomies_exclude=''){
	$product_visibility_term_ids = wc_get_product_visibility_term_ids();
     
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
	    'post_parent' => 0
    );
    if(!empty($taxonomies) || !empty($taxonomies_exclude)){
        $tax_query = ef5systems_tax_query('product', $taxonomies, $taxonomies_exclude);
        $args['tax_query']= $tax_query;
    }
    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            $args['meta_query'] = array();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            $args['meta_query'] = array();
            $args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['featured'],
			);
            break;
        case 'top_rate':
            $args['meta_key']   ='_wc_average_rating';
            $args['orderby']    ='meta_value_num';
            $args['order']      ='DESC';
            $args['meta_query'] = array();
            break;
        case 'recent_product':
            $args['orderby']    = 'date';
            $args['order']      = 'DESC';
            $args['meta_query'] = array();
            break;
        case 'on_sale':
            $args['meta_query'] = array();
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'recent_review':
            if($post_per_page == -1) $_limit = 4;
            else $_limit = $post_per_page;
            global $wpdb;
            $query = $wpdb->prepare("SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC LIMIT 0, %d", $_limit);
            $results = $wpdb->get_results($query, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                $_pids[] = $re->comment_post_ID;
            }

            $args['meta_query'] = array();
            $args['post__in'] = $_pids;
            break;
        case 'deals':
            $args['meta_query'] = array();
            $args['meta_query'][] = array(
                                 'key' => '_sale_price_dates_to',
                                 'value' => '0',
                                 'compare' => '>');
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'separate':
            $args['meta_query'] = array();
            if ( ! empty( $product_ids ) ) {
    			$ids = array_map( 'trim', explode( ',', $product_ids ) );
    			if ( 1 === count( $ids ) ) {
    				$args['p'] = $ids[0];
    			} else {
    				$args['post__in'] = $ids;
    			}
    		}
            break;
    }
    return $args;
}

function theclick_product_filter_sidebar(){
    $current_url = theclick_get_current_page_url();
    $product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
    $attribute_taxonomies = wc_get_attribute_taxonomies();
    
    $att_tax = [];
    $att_data = [];
    if ( ! empty( $attribute_taxonomies ) ) {
        foreach ( $attribute_taxonomies as $tax ) {
            if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
                $att_tax[$tax->attribute_name] = $tax->attribute_label;
                $att_term_data = get_terms(array( 'taxonomy' => 'pa_'.$tax->attribute_name ));
                if(!empty($att_term_data))
                    $att_data[$tax->attribute_name] = $att_term_data;
            }
        }
    }

    ?>
    <form action="<?php echo esc_url($current_url) ?>" method="get" class="ajax-filter">
        <div class="filters">
            <div class="filter product_cat">
                <span class="filter-name"><?php echo esc_html__( 'Categories', 'theclick' ) ?></span>
                <div class="filter-control">
                    <select name="product_cat" tabindex="-1" class="select2" aria-hidden="true">
                        <option value=""><?php echo esc_html__( 'Select a Category', 'theclick' ) ?></option>
                        <?php 
                        foreach($product_categories as $category){
                            echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
                        } ?>
                    </select>
                </div>
            </div>
            <?php 
            if(!empty($att_data)): 
                foreach($att_data as $key => $att_dt){
                ?>
                <div class="filter product_<?php echo esc_attr($key)?>">
                    <span class="filter-name"><?php echo esc_html( $att_tax[$key]) ?></span>
                    <div class="filter-control">
                        <select name="pa_<?php echo esc_attr($key);?>" tabindex="-1" class="select2" aria-hidden="true">
                            <option value=""><?php printf(esc_html__('Select a %s','theclick'),$att_tax[$key]); ?></option>
                            <?php 
                            foreach($att_dt as $term){
                                echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
                            } ?>
                        </select>
                    </div>
                </div>
            <?php } endif; ?>
            <?php 
            $WC_Widget_Price_Filter = new WC_Widget_Price_Filter();
            /*wp_register_script( 'accounting', WC()->plugin_url() . '/assets/js/accounting/accounting.min.js', array( 'jquery' ), '0.4.2', true );
            wp_register_script( 'wc-jquery-ui-touchpunch', WC()->plugin_url() . '/assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch.min.js', array( 'jquery-ui-slider' ), WC_VERSION, true );
            wp_register_script( 'wc-price-slider', WC()->plugin_url() . '/assets/js/frontend/price-slider.min.js', array( 'jquery-ui-slider', 'wc-jquery-ui-touchpunch', 'accounting' ), WC_VERSION, true );
              
            wp_localize_script(
                'wc-price-slider',
                'woocommerce_price_slider_params',
                array(
                    'currency_format_num_decimals' => 0,
                    'currency_format_symbol'       => get_woocommerce_currency_symbol(),
                    'currency_format_decimal_sep'  => esc_attr( wc_get_price_decimal_separator() ),
                    'currency_format_thousand_sep' => esc_attr( wc_get_price_thousand_separator() ),
                    'currency_format'              => esc_attr( str_replace( array( '%1$s', '%2$s' ), array( '%s', '%v' ), get_woocommerce_price_format() ) ),
                )
            );
            wp_enqueue_script( 'wc-price-slider' );*/
            var_dump($WC_Widget_Price_Filter);
            $step = max( apply_filters( 'woocommerce_price_filter_widget_step', 10 ), 1 );
            $prices    = $WC_Widget_Price_Filter->get_filtered_price();
            $min_price = $prices->min_price;
            $max_price = $prices->max_price;
            if ( wc_tax_enabled() && ! wc_prices_include_tax() && 'incl' === $tax_display_mode ) {
                $tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' ); // Uses standard tax class.
                $tax_rates = WC_Tax::get_rates( $tax_class );

                if ( $tax_rates ) {
                    $min_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $min_price, $tax_rates ) );
                    $max_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max_price, $tax_rates ) );
                }
            }

            $min_price = apply_filters( 'woocommerce_price_filter_widget_min_amount', floor( $min_price / $step ) * $step );
            $max_price = apply_filters( 'woocommerce_price_filter_widget_max_amount', ceil( $max_price / $step ) * $step );

            // If both min and max are equal, we don't need a slider.
            if ( $min_price === $max_price ) {
                return;
            }
            $current_min_price = isset( $_GET['min_price'] ) ? floor( floatval( wp_unslash( $_GET['min_price'] ) ) / $step ) * $step : $min_price; // WPCS: input var ok, CSRF ok.
            $current_max_price = isset( $_GET['max_price'] ) ? ceil( floatval( wp_unslash( $_GET['max_price'] ) ) / $step ) * $step : $max_price; */
            $form_action = '';
            $step = '';
            $min_price = '';
            $max_price = '';
            $current_min_price = '';
            $current_max_price = '';
            ?>
            <div class="filter price_slider_wrapper">
                <div class="price_slider" style="display:none;"></div>
                <div class="price_slider_amount" data-step="<?php echo esc_attr( $step ); ?>">
                    <input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" placeholder="<?php echo esc_attr__( 'Min price', 'theclick' ); ?>" />
                    <input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" placeholder="<?php echo esc_attr__( 'Max price', 'theclick' ); ?>" />
                    <?php /* translators: Filter: verb "to filter" */ ?>
                    <button type="submit" class="button"><?php echo esc_html__( 'Filter', 'theclick' ); ?></button>
                    <div class="price_label" style="display:none;">
                        <?php echo esc_html__( 'Price:', 'theclick' ); ?> <span class="from"></span> &mdash; <span class="to"></span>
                    </div>
                    <?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </form>
    <?php
}