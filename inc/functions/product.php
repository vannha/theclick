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
	    'post_parent' => 0,
        'date_query' => array(
            array(
               'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
            )
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                'operator' => 'NOT IN',
            )
        ),
    );

    $args['meta_query'] = array(
        'relation'    => 'AND'
    );
    /*$meta_query[] = wc_get_min_max_price_meta_query(array(
        'min_price' => 39,
        'max_price' => 41,
    ));*/
    if(!empty($taxonomies) || !empty($taxonomies_exclude)){
        $tax_query = ef5systems_tax_query('product', $taxonomies, $taxonomies_exclude);
        $args['tax_query'][]= $tax_query;
    }
    $args_arr = theclick_product_filter_type_args($type,$args);
     
    return $args_arr;
}
function theclick_product_filter_type_args($type,$args){
    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            //$args['meta_query'] = array();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            //$args['meta_query'] = array();
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
            //$args['meta_query'] = array();
            break;
        case 'recent_product':
            $args['orderby']    = 'date';
            $args['order']      = 'DESC';
            //$args['meta_query'] = array();
            break;
        case 'on_sale':
            //$args['meta_query'] = array();
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

            //$args['meta_query'] = array();
            $args['post__in'] = $_pids;
            break;
        case 'deals':
            //$args['meta_query'] = array();
            $args['meta_query'][] = array(
                                 'key' => '_sale_price_dates_to',
                                 'value' => '0',
                                 'compare' => '>');
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'separate':
            //$args['meta_query'] = array();
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

function theclick_product_filter_sidebar($atts = [],$default_title=[]){
    global $wpdb;
    extract($atts);
    $current_url = theclick_get_current_page_url();
    $product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
    $attribute_taxonomies = wc_get_attribute_taxonomies();
    $filter_type=(array) vc_param_group_parse_atts($filter_type );

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
            <div class="filter product-cat">
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
            <?php if(!empty($filter_type)): ?>
            <div class="filter sort-type">
                <span class="filter-name"><?php echo esc_html__( 'Type', 'theclick' ) ?></span>
                <div class="filter-control">
                    <select name="filter_type" tabindex="-1" class="select2" aria-hidden="true">
                        <?php 
                        foreach($filter_type as $ft){ 
                            if( !empty($ft['filter_type_item']) ){
                                $title = !empty($ft['filter_title_item']) ? $ft['filter_title_item'] : $default_title[$ft['filter_type_item']];
                                echo '<option value="'.$ft['filter_type_item'].'">'.$title.'</option>';
                            }
                        }?>
                    </select>
                </div>
            </div>
            <?php endif; ?>
            <?php 
            if(!empty($att_data)): 
                $att_data_serial = [];
                foreach($att_data as $key => $att_dt){
                    $att_data_serial[]= 'pa_'.$key;
                ?>
                <div class="filter product-<?php echo esc_attr($key)?>">
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
            wp_register_script( 'accounting', WC()->plugin_url() . '/assets/js/accounting/accounting.min.js', array( 'jquery' ), '0.4.2', true );
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
            wp_enqueue_script( 'wc-price-slider' );

            $step = max( apply_filters( 'woocommerce_price_filter_widget_step', 10 ), 1 );
   
            $meta_query = new WP_Meta_Query(array());
            $tax_query  = new WP_Tax_Query(array());

            $meta_query_sql   = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
            $tax_query_sql    = $tax_query->get_sql( $wpdb->posts, 'ID' );

            $sql = "
                SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
                FROM {$wpdb->wc_product_meta_lookup}
                WHERE product_id IN (
                    SELECT ID FROM {$wpdb->posts}
                    " . $tax_query_sql['join'] . $meta_query_sql['join'] . "
                    WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
                    AND {$wpdb->posts}.post_status = 'publish'
                    " . $tax_query_sql['where'] . $meta_query_sql['where'] . '
                )';

            $sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );
            $prices = $wpdb->get_row( $sql );

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

            if ( $min_price !== $max_price ) {  
                $current_min_price = isset( $_GET['min_price'] ) ? floor( floatval( wp_unslash( $_GET['min_price'] ) ) / $step ) * $step : $min_price;  
                $current_max_price = isset( $_GET['max_price'] ) ? ceil( floatval( wp_unslash( $_GET['max_price'] ) ) / $step ) * $step : $max_price; 
                ?>
                <div class="filter widget_price_filter mt-30">
                    <div class="price_slider_wrapper">
                        <div class="price_slider" style="display:none;"></div>
                        <div class="price_slider_amount" data-step="<?php echo esc_attr( $step ); ?>">
                            <input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" placeholder="<?php echo esc_attr__( 'Min price', 'theclick' ); ?>" />
                            <input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" placeholder="<?php echo esc_attr__( 'Max price', 'theclick' ); ?>" />
                            <div class="price_label" style="display:none;">
                                <?php echo esc_html__( 'Price:', 'theclick' ); ?> <span class="from"></span> &mdash; <span class="to"></span>
                            </div>
                            <?php //echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php 
            if(!empty($att_data_serial)){ 
                $att_data_serial_str = json_encode($att_data_serial);   
                echo "<input type='hidden' name='att_data_serial' value='".$att_data_serial_str."'>";        
            }
            if(!empty($atts)){ 
                $atts_str = json_encode($atts);   
                echo "<input type='hidden' name='atts_str' value='".$atts_str."'>";        
            }
        ?>
        <input type="hidden" name="post_per_page" value="<?php echo esc_attr($post_per_page) ?>">
        <input type="hidden" name="page_id" value="<?php echo esc_attr(get_the_ID()) ?>">
        <input type="hidden" name="action" value="ef5_product_filter_action" />
        <?php wp_nonce_field('ajax_filter_action', '_acf_nonce', false, true); ?>
        <button type="button" value="Filter" class="ef5-btn primary fill ef5-ajax-filter"><?php echo esc_html__( 'Filter', 'theclick' ) ?></button>
        <span class="products-loader"><span class="spinner"></span></span>
    </form>
    <?php
}

add_action( 'wp_ajax_ef5_product_filter_action', 'theclick_ef5_product_filter_action_callback',9 );
add_action( 'wp_ajax_nopriv_ef5_product_filter_action', 'theclick_ef5_product_filter_action_callback',9 );
function theclick_ef5_product_filter_action_callback(){
    global $paged, $wp_query;
    if ( ! isset( $_POST['_acf_nonce'] ) || ! wp_verify_nonce( $_POST['_acf_nonce'], 'ajax_filter_action' ) ) {
       echo esc_html__( 'Sorry, your nonce did not verify.','theclick');
       exit;
    } else {

        $array_param = [
            'post_per_page'   => $_POST['post_per_page'],
            'product_cat'     => $_POST['product_cat'],
            'filter_type'     => $_POST['filter_type'],
            'min_price'       => $_POST['min_price'],
            'max_price'       => $_POST['max_price'],
            'atts_str'        => $_POST['atts_str'],
            'att_data_serial' => $_POST['att_data_serial'],
            'page_id'         => $_POST['page_id']  
        ];
        $array_param['atts_str'] = str_replace('\"', '"',$array_param['atts_str']);
        $atts = (array)json_decode( $array_param['atts_str'] );

        extract($atts);
        
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => $array_param['post_per_page'],
            'post_status'    => 'publish',
            'post_parent'    => 0,
            'date_query' => array(
                array(
                   'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
                )
             ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                )
            ),
        );
        $link_params = []; 
        $link_params[] = !empty($array_param['page_id']) ? 'page_id='.$array_param['page_id'] : '';

        if(!empty($array_param['product_cat'])){
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $array_param['product_cat']
            );
            $link_params[] = 'product_cat='.$array_param['product_cat'];
        }
        if(!empty($array_param['att_data_serial'])){
            $array_param['att_data_serial'] = str_replace('\"', '"',$array_param['att_data_serial']);
            $att_data_serial = (array)json_decode( $array_param['att_data_serial'] );
            foreach ($att_data_serial as $att_tax) {
                if(!empty($_POST[$att_tax])){
                    $args['tax_query'][] = array(
                        'taxonomy' => $att_tax,
                        'field' => 'slug',
                        'terms' => $_POST[$att_tax]
                    );
                    $link_params[] = $att_tax.'='.$_POST[$att_tax];
                }
            }
        }
        

        $args['meta_query'] = array(
            'relation'    => 'AND'
        );

        $args['meta_query'][] = wc_get_min_max_price_meta_query(array(
            'min_price' => $array_param['min_price'],
            'max_price' => $array_param['max_price']
        ));

        $link_params[] = 'min_price='.$array_param['min_price'];
        $link_params[] = 'max_price='.$array_param['max_price'];

        if(!empty($array_param['filter_type'])){
            $args = theclick_product_filter_type_args($array_param['filter_type'],$args);  
            $link_params[] = 'filter_type='.$array_param['filter_type'];
        }
  
        $loop = $wp_query = new WP_Query($args);

        echo $loop->found_posts;
        if($loop->found_posts > 0){
            $grid_item_css_class = ['ef5-grid-item-wrap', 'col-' . $col_sm, 'col-md-' . $col_md, 'col-lg-' . $col_lg, 'col-xl-' . $col_xl];
            $item_css_class = ['product-grid-item', 'ef5-product-item-layout-' . $layout_template, 'transition'];
            ?>
            <div class="row ef5-product-grid-wrap <?php echo esc_attr($column_xl_gutter)?>">
            <?php 
            while ($loop->have_posts()) {
                $loop->the_post();
                global $product;
                $d++;
                ?>
                <div class="<?php echo trim(implode(' ', $grid_item_css_class)); ?>" style="animation-delay: <?php echo esc_html($d * 100); ?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                    <?php
                        do_action( 'woocommerce_before_shop_loop_item' );
                        do_action( 'woocommerce_before_shop_loop_item_title' );
                        do_action( 'woocommerce_shop_loop_item_title' );
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                        do_action( 'woocommerce_after_shop_loop_item' );
                    ?>
                    </div>
                </div>
            <?php 
            } 
            wp_reset_postdata();
            ?>
            </div>
            <?php
            $max_page = $wp_query->max_num_pages;
            if ( ! $paged ) {
                $paged = 1;
            }

            $nextpage = intval( $paged ) + 1;
            $link_param_str = implode('&', $link_params);

            if($nextpage <= $max_page){
                
                echo '<div class="woocommerce-infinite d-flex justify-content-center text-center infinite-btn load-on-infinite">';
                    $new_link = str_replace('wp-admin/admin-ajax.php?','?'.$link_param_str.'&', next_posts( $max_page, false ));
                    echo '<a href="' . $new_link .'" >' .  $loadmore_text . '</a>';
                echo '</div>';     
            }
        }
        
        wp_reset_query();
         
        exit();
    }
}