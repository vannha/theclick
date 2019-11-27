<?php

/**
 * Template part for displaying default header layout
 */
?>
<header id="ef5-header" <?php theclick_header_class(); ?>>
    <div id="ef5-headroom" class="main-header">
        <div class="<?php theclick_header_inner_class(); ?>">
            <div class="row justify-content-between align-items-center">
                <?php theclick_header_side_nav_icon(['class' => 'd-none d-sm-block']); ?>
                <div class="ef5-logo col-auto">
                    <?php get_template_part('template-parts/header/header-logo'); ?>
                </div>
                <div class="ef5-navigation-wrap col">
                    <?php theclick_header_helper_menu(); ?>
                    <div class="d-flex align-items-center justify-content-end">
                        <?php theclick_header_menu(['class' => 'ef5-navs']); ?>
                        <div class="header-attrs">
                            <div class="header-attr-wrap nav-extra">
                                <?php
                                get_template_part('template-parts/header/header-social');
                                theclick_header_signin_signup(['class' => 'd-none d-sm-block']);
                                theclick_header_search(['type' => 'popup', 'class' => 'd-none d-sm-block']);
                                theclick_header_wishlist(['class' => 'd-none d-sm-block']);
                                theclick_header_compare(['class' => 'd-none d-sm-block']);
                                theclick_header_cart(['class' => 'd-none d-sm-block']);
                                theclick_header_popup_nav_icon(['class' => 'd-none d-sm-block']);
                                theclick_header_mobile_menu_icon();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>