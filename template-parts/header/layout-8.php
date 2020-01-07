<?php
/**
 * Template part for displaying default header layout
 */
?>
<header id="ef5-header" <?php theclick_header_class(); ?>>
    <div class="main-header">
        <div class="<?php theclick_header_inner_class(); ?>">
            <div class="header-inner-wrap">
            	<div class="row align-items-center justify-content-between">
	            	<div class="nav-extra align-items-center col">
	            		<div class="d-xl-none">
	            			<?php get_template_part('template-parts/header/header-logo'); ?>
	            		</div>
	                    <?php
	                    theclick_header_side_nav_icon(['class' => 'd-none d-xl-block']);
	                    theclick_header_search(['class' => '', 'label' => esc_html__('Search', 'theclick'), 'display' => '0']);
	                    ?>
	                </div>
	                <div class="col-auto">
		            	<div class="row align-items-center justify-content-between justify-content-xl-center">
		            		<div class="ef5-header-left col-auto">
		            			<?php theclick_header_menu_left(['class' => 'ef5-navs']);?>
							</div>
							<div class="d-none d-xl-block col-auto">
								<?php get_template_part('template-parts/header/header-logo'); ?>
							</div>
							<div class="ef5-navigation-right col-auto">
								<?php theclick_header_menu_right(['class' => 'ef5-navs']);?>
							</div>
						</div>
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
				<div id="ef5-navigation" class="join-menu"><div class="ef5-main-navigation"></div></div>
            </div>
        </div>
    </div>
</header>

