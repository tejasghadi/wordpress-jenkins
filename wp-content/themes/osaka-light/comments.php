<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Osaka
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

<div id="comments" class="comments">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
		?>
		<h4 class="title">
			<?php comments_number( esc_html('0 Comment' ,'osaka-light') , esc_html('1 Comment' ,'osaka-light'), esc_html('% Comments' ,'osaka-light') );?>			
		</h4>

		<ol class="comment-list">
			<?php
                wp_list_comments( array(
                    'style'       	=> 'li',
                    'short_ping'  	=> true,
                    'callback' 		=> 'osaka_light_comment',
                    'avatar_size' 	=> 90
                ) );
                paginate_comments_links();
            ?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'osaka-light' ); ?></p>
		
		<?php } else {

					$commenter = wp_get_current_commenter();
					$req = get_option( 'require_name_email' );
					$aria_req = ( $req ? " required" : '' );
					$fields =  array(

						'author' => '<p class="form-input"><label for="name">' . esc_html__('Name', 'osaka-light') . '</label><input id="author" class="wpcf7-form-control" name="author" type="text" placeholder="' . esc_html__('Name*', 'osaka-light') . '" value="" size="30"' . $aria_req . '/></p>',
						'email'  => '<p class="form-input"><label for="email">' . esc_html__('Email', 'osaka-light') . '</label><input id="email" class="wpcf7-form-control" name="email" type="email" placeholder="' . esc_html__('Email*', 'osaka-light') . '" value="" size="30"' . $aria_req . '/></p>',
						'url'  => '<p class="form-input"><label for="subject">' . esc_html__('Website', 'osaka-light') . '</label><input id="url" class="wpcf7-form-control" name="url" type="url" placeholder="' . esc_html__('Website', 'osaka-light') . '" ></p>'
					);

					$comments_args = array(
						'fields' =>  $fields,
						'logged_in_as' => '<div class="logged-in-as">' .
						    sprintf(
						    esc_html__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' , 'osaka-light'),
						      admin_url( 'profile.php' ),
						      $user_identity,
						      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
						    ) . '</div>',
						'id_form'          			=> 'commentform',
						'title_reply_before'		=> '<h4 class="title">',
						'title_reply'       		=> esc_html__( 'Leave a Comment', 'osaka-light' ),
						'title_reply_to'    		=> esc_html__( 'Leave a Comment to %s', 'osaka-light' ),
						'title_reply_after'			=> '</h4>',
						'cancel_reply_link' 		=> esc_html__( 'Cancel Comment', 'osaka-light' ),
						'label_submit'      		=> esc_html__( 'Submit Comment', 'osaka-light' ),
						'class_submit'      		=> 'wpcf7-form-control btn',
						'comment_notes_before'      => '',
						'comment_notes_after' 		=> '',
						'id_submit'					=> 'submit',
						'comment_field'             => '<p class="form-input"><label for="message">' . esc_html__('Comment', 'osaka-light') . '</label><textarea 
						name="message" id="message" class="wpcf7-form-control" cols="30" rows="5" 
						placeholder="' . esc_html__('Your Comment', 'osaka-light') . '" required></textarea></p>',
						'label_submit'              => esc_html__( 'Submit Comment' , 'osaka-light' )
						);


					ob_start();
					comment_form( $comments_args);

		}

	} // Check for have_comments().

	?>

</div><!-- #comments -->
