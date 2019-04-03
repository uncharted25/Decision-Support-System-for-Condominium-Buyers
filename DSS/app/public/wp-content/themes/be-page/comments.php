<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Be_Page
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
		<h5 class="upper">
			<?php
			$be_page_comment_count = get_comments_number();
			if ( '1' === $be_page_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'be-page' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $be_page_comment_count, 'comments title', 'be-page' ) ),
					number_format_i18n( $be_page_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'short_ping' => true,
				'callback' => 'be_page_walker_comment',
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'be-page' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	?>
    
    <?php
	
	$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="form-group col-md-6 col-sm-6">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'be-page'  ) . '" name="author"  type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" class="form-control" />'.
				( $req ? '<span class="required">*</span>' : '' )  .
				'</div>'
				,
			'email'  => '<div class="form-group col-md-6 col-sm-6">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'be-page'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" class="form-control"   />'  .
				( $req ? '<span class="required">*</span>' : '' ) 
				 .
				'</div>',
			'url'    => '<div class="form-group col-md-12 col-sm-12">' .
			 '<input id="url" name="url" placeholder="' . esc_html__( 'Website', 'be-page' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" class="form-control"   /> ' .
	           '</div>',
			   
		)
	),
	 'comment_field' =>  '<div class="form-group col-md-12 col-sm-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'be-page' ) . '" class="form-control"  >' .
    '</textarea></div>',
	
    'comment_notes_after' => '',
	'class_form'      => 'row ',
	'title_reply_before'	=> ' <div class="section-header comment_reply_header"><h5 class="upper">',
	'title_reply_after'	=>	'</h5></div>',
	 'logged_in_as' => '<div class="logged-in-as col-md-12 col-sm-12">' .
    sprintf(
	/* translators:straing */
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','be-page' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', esc_url( get_permalink( ) ) ) )
    ) . '</div>',
	'must_log_in' => '<div class="must-log-in col-md-12 col-sm-12">' .
    sprintf(
		/* translators:straing */
      __( 'You must be <a href="%s">logged in</a> to post a comment.','be-page' ),
      wp_login_url( apply_filters( 'the_permalink', esc_url( get_permalink( ) ) ) )
    ) . '</div>',
	'comment_notes_before' => '<div class="comment-notes col-md-12 col-sm-12">' .
	/* translators:straing */
    __( 'Your email address will not be published.','be-page' ) .
    '</div>',
	 'class_submit'      => 'btn btn-color',
	'submit_button' => '<div class="form-group col-md-12">
            <input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />
        </div>'
	
	
);
		comment_form( $args );
		
	?>
	
</div><!-- #comments -->
