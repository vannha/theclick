<?php
$titles = theclick_get_page_titles();
$show_breadcrumb = theclick_get_opts('breadcrumb_on', '1');
$ptitle_align = theclick_get_theme_opt('ptitle_align', 'text-center');
$pt_cls = array(
    'ef5-pagetitle',
    'ptitle-layout-2'
);
$title_css_class = ['col-12'];


if (!$show_breadcrumb) {
    $pt_cls[] = 'no-breadcrumb';
}

$title_css_class[] = $ptitle_align;

ob_start();
if ($titles['title']) {
    printf('<div class="page-title h1">%s</div>', $titles['title']);
}

if ($titles['desc']) {
    printf('<div class="page-desc">%s</div>', $titles['desc']);
}

$titles_html = ob_get_clean();

if (!$titles_html) {
    return;
}
?>
<div class="ef5-pagetitle-wrap">
    <div class="<?php echo implode(' ', $pt_cls); ?>">
        <?php theclick_ptitle_parallax_image(); ?>

        <div class="<?php theclick_ptitle_inner_class(); ?>">
            <div class="row align-items-center">
                <div class="col-12">
                    <?php theclick_ptitle_logo(); ?>
                </div>
                <div class="<?php echo trim(implode(' ', $title_css_class)); ?>">
                    <?php printf('%s', $titles_html); ?>
                </div>
                <?php if ($show_breadcrumb && (!is_home() || !is_front_page())) { ?>
                    <div class="ef5-breadcrumb">
                        <?php theclick_breadcrumb(['class' => 'h5']); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>