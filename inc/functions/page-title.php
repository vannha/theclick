<?php
/**
 * All function for page title
*/

/**
 * Page title Layout
*/
function theclick_page_title(){
    $ptitle_layout = theclick_get_opts('ptitle_layout', '1');
    if($ptitle_layout === 'none' || is_404() ) return;
    get_template_part('template-parts/page-title/layout', $ptitle_layout);
}

/**
 * Page title inner class
*/
function theclick_ptitle_inner_class($class=''){
	$classes = ['ef5-pagetitle-inner'];
	$full = theclick_get_opts('ptitle_full_width', '0');
	if($full === '1')
		$classes[] = 'container-fluid';
	else 
		$classes[] = 'container';

	$classes[] = $class;

	echo trim(implode(' ', $classes));
}
/**
 * Prints HTML for breadcrumbs.
 */
function theclick_breadcrumb($args = [])
{
    if ( ! class_exists( 'TheClick_Breadcrumb' ) )
    {
        return;
    }
    $args = wp_parse_args($args, [
        'class'     => '',
        'separator' => ''
    ]);
    $breadcrumb = new TheClick_Breadcrumb();
    $entries = $breadcrumb->get_entries();

    if ( empty( $entries ) )
    {
        return;
    }
    $separator = apply_filters('theclick_breadcrumb_separator', $args['separator']);
    ob_start();
    $count = count($entries);
    $d = 0;
    foreach ( $entries as $entry )
    {
    	$d++;
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) )
        {
            continue;
        }

        if ( ! empty( $entry['url'] ) )
        {
            printf(
                '<a class="item link" href="%1$s">%2$s</a>',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] )
            );
        }
        else
        {
            printf( '<span class="item title" >%s</span>', esc_html( $entry['label'] ) );
        }
        if($d < $count ) echo '<span class="separator">'.$separator.'</span>';
    }

    $output = ob_get_clean();

    if ( $output )
    {
        printf( '<div class="breadcrumb %1$s">%2$s</div>', $args['class'], $output );
    }
}

/**
 * Parallax Image
 * // default background: get_template_directory_uri().'/assets/images/page-title/bg-pagetitle.jpg'
*/
function theclick_ptitle_parallax_image(){
    $parallax_url = theclick_get_opts('ptitle_parallax',['url'=> '']);
    if(empty($parallax_url['url'])) return;
    $titles = theclick_get_page_titles();
    echo '<div class="parallax"><img src="'.esc_url($parallax_url['url']).'" alt="'.esc_attr($titles['title']).'" /></div>';
}

function theclick_ptitle_logo(){
    $ptitle_logo = theclick_get_theme_opt('ptitle_logo', ['url' => '']);
    if (empty($ptitle_logo['url'])) return;
    printf(
        '<a class="ptitle-logo" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%4$s"/></a>',
        esc_url(home_url('/')),
        esc_attr(get_bloginfo('name')),
        esc_url($ptitle_logo['url']),
        esc_attr(get_bloginfo('name'))
    );
}