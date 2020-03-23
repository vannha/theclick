<?php
/**
 * Custom Woocommerce shop page.
 *
 * @package EF5 Theme
 * @subpackage TheClick
 * @since 1.0.0
 * @author EF5 Team
 *
 */
get_header();
?>
    <div class="container">
        <div class="row gutter-lg-60">
            <div id="ef5-content-area" class="<?php theclick_content_css_class();?>">
                <div id="ef5-posts" class="ef5-posts ef5-blogs">
                    <?php woocommerce_content(); ?>
                </div>
            </div>
            <?php theclick_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();