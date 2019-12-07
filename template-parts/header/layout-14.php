<?php
/**
 * Template part for displaying default header layout
 */
?>
<header id="ef5-header" <?php theclick_header_class(); ?>>
    <div id="ef5-headroom" class="main-header">
        <div class="<?php theclick_header_inner_class(); ?>">
            <div class="row justify-content-between align-items-center">
                <div class="ef5-header-left col">
                    <div class="d-flex align-items-center nav-extra">
                        <?php 
                        theclick_header_side_nav_icon(['class' => '']);
                        theclick_header_search(['type' => 'popup', 'class' => '']); 
                        ?>
                    </div>
                </div>
                <div class="ef5-navigation-wrap col-auto">
                    <?php theclick_header_menu(['class' => 'ef5-navs']); ?>
                </div>
                <div class="header-attrs col">
                    <div class="header-attr-wrap nav-extra">
                        <?php
                        theclick_header_signin_signup(['class' => 'd-none d-sm-block']);
                        theclick_header_wishlist(['class' => 'd-none d-sm-block']);
                        theclick_header_compare(['class' => 'd-none d-sm-block']);
                        theclick_header_cart(['class' => 'd-none d-sm-block']);
                        theclick_header_social(['class' => 'd-none d-sm-block']);
                        theclick_header_popup_nav_icon(['class' => 'd-none d-sm-block']);
                        theclick_header_mobile_menu_icon();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>