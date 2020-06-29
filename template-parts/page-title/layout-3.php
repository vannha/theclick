<?php
if(isset($args)){
    $titles = [
        'title' => $args['title'],
        'desc'  => $args['desc']
    ];
    $show_breadcrumb = $args['show_breadcrumb'];
    $ptitle_layout = $args['ptitle_layout'];
} else {
   $titles = theclick_get_page_titles();
   $show_breadcrumb = theclick_get_opts( 'breadcrumb_on', '1' );
   $ptitle_layout = theclick_get_opts('ptitle_layout','1');
}

$pt_cls = array(
    'ef5-pagetitle',
    'ptitle-layout-'.$ptitle_layout,
);

if(!$show_breadcrumb) $pt_cls[] = 'no-breadcrumb';

ob_start();
    if ( $titles['title'] )
    {
        printf( '<div class="page-title h1">%s</div>', theclick_html($titles['title']) );
    }

    if ( $titles['desc'] )
    {
        printf( '<div class="page-desc">%s</div>', theclick_html( $titles['desc'] ) );
    }
    if ( $show_breadcrumb ) {
        theclick_breadcrumb(['class'=>'h5']);
    }

$titles_html = ob_get_clean();

if ( ! $titles_html )
{
    return;
}
?>
<div class="ef5-pagetitle-wrap">
    <div class="<?php echo implode(' ', $pt_cls);?>">
        <?php theclick_ptitle_parallax_image(); ?>
        <div class="<?php theclick_ptitle_inner_class();?>">
            <?php printf( '%s', theclick_html($titles_html)); ?>
        </div>
    </div>
</div>