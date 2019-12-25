<?php

/**
 * The template for displaying single post
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
    <div class="row gutter-30 gutter-lg-50">
        <div id="ef5-content-area" class="<?php theclick_content_css_class(); ?>">
            <div class="ef5-blogs">
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/single/content', get_post_format());
                endwhile; // End of the loop.
                ?>
            </div>
        </div>
        <?php theclick_sidebar(); ?>
    </div>
    <div class="row">
        <div class="col-12 col-xl-8 offset-xl-2">
        <?php theclick_comment(); ?>
        </div>
    </div>
    <?php theclick_post_related(); ?>
</div>
<?php
get_footer();
