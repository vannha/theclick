<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EF5 Theme
 * @subpackage TheClick
 * @since 1.0.0
 * @author EF5 Team
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}
?>
<div class="row">
    <div class="col-12 col-xl-8 offset-xl-2">
		<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?> clearfix">
			<?php if ( have_comments() ) : ?>
				<div class="commentlist-wrap">
					<div class="comments-title h3"><?php
						$comments_number = get_comments_number();
						printf(
							_nx(
								'%1$s %2$s',
								'%1$s %3$s',
								$comments_number,
								'comments title',
								'theclick'
							),
							number_format_i18n( $comments_number ),
							esc_html__('Comment','theclick'),
							esc_html__('Comments','theclick')
						);
					?></div>
					<ol class="commentlist">
						<?php
							wp_list_comments(
								theclick_wp_list_comments_args()
							);
						?>
					</ol>
					<?php
						theclick_comment_pagination_loadmore();
					?>
				</div>
			<?php
			endif;  
			// Show comment form at bottom if showing newest comments at the bottom.
			if ( comments_open() ) :
				?>
				<div class="ef5-comment-form-flex">
					<?php theclick_comment_form('asc'); ?>
				</div>
				<?php
			endif;	
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<div class="ef5-no-comments required">
					<?php esc_html_e( 'Comments are closed.', 'theclick' ); ?>
				</div>
				<?php
			endif; 
			?>
		</div>
	</div>
</div>