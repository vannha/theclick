<?php
/**
 * Template part for displaying default header layout
 */
?>
<header id="ef5-header" <?php theclick_header_class(); ?>>
    <div class="main-header">
        <div class="<?php theclick_header_inner_class(); ?>">
            <div class="header-inner-wrap">
                <div class="row justify-content-between align-items-center">
                    <div class="ef5-header-left col">
                        <div class="nav-extra align-items-center">
                            <?php
                            theclick_header_side_nav_icon(['class' => 'd-none d-xl-block']);
                            theclick_header_search(['class' => '', 'label' => esc_html__('Search Blog', 'theclick'), 'display' => '0']);
                            ?>
                        </div>
                    </div>
                    <div class="ef5-navigation-wrap col-auto">
                        <?php theclick_header_blog_menu(['class' => 'ef5-navs']); ?>
                    </div>
                    <div class="header-attrs col">
                        <div class="header-attr-wrap nav-extra justify-content-end">
                            <?php
                            theclick_header_signin_signup(['class' => 'd-none d-md-block']);
                            theclick_header_wishlist(['class' => 'd-none d-md-block']);
                            theclick_header_compare(['class' => 'd-none d-md-block']);
                            theclick_header_cart(['class' => 'd-none d-md-block']);
                            theclick_header_social(['class' => 'd-none d-md-block']);
                            theclick_header_popup_nav_icon(['class' => 'd-none d-md-block']);
                            theclick_header_mobile_menu_icon();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="header-logo">
    <?php get_template_part('template-parts/header/header-logo'); ?>
</div>