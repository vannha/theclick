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
                    <div class="ef5-header-left">
                        <div class="d-flex align-items-center">
                            <?php
                            theclick_header_menu(['class' => 'ef5-navs']); 
                            ?>
                        </div>
                    </div>
                    <div class="ef5-logo col-auto">
                        <?php get_template_part('template-parts/header/header-logo'); ?>
                    </div>
                    <div class="header-attrs col">
                        <div class="header-attr-wrap nav-extra justify-content-end">
                            <?php
                            theclick_header_signin_signup(['class' => 'd-none d-md-block']);
                            theclick_header_search(['class' => 'd-none d-md-block']);
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