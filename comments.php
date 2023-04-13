<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rt-assign
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

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<?php the_comments_navigation(); ?>

		<ul class="comment-list-custom">
			<?php
			wp_list_comments( array(
				'type' => 'comment',
				'callback' => 'it_custom_comments'
			) );
			?>
		</ul><!-- .comment-list and callback function in template-tags.php -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'initial-theme' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	?>
	<hr style="margin-top: 2rem;">
	<?php
		comment_form();
	?>

</div><!-- #comments -->