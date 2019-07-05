<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template for displaying comments.
 *
 * @package NEATLY
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area post_item mb_L">

	<?php
	/* You can start editing here -- including this comment!*/
	if ( have_comments() ) :

		$comments_number = get_comments_number();
		$ping_count = get_comments( array( 'status' => 'approve', 'post_id'=> get_the_ID(), 'type'=> 'pings', 'count' => true, ) );
		$comments_number = $comments_number - $ping_count;

		if($comments_number != 0): ?>
			<h4 class="comments-title">

				<?php
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					echo '<span class="fa-comment-o"></span> '. esc_html__( 'One Comment', 'neatly' );

				} else {
					printf('<span class="fa-comments-o"></span> '.
						/* translators: 1: number of comments, 2: post title */
						esc_html(__('%1$s Comments','neatly')),
						absint(number_format_i18n( $comments_number ))
					);
				}
				?>
			</h4>

			<ul class="comment-list mb_L">
				<?php wp_list_comments( array(
					'type' => 'comment',
					'callback' => 'neatly_comment',
				) ); ?>
				<?php
				//wp_list_comments( array('avatar_size' => 100,'style'       => 'ol',					'short_ping'  => true,				) );
				?>
			</ul>
			<?php
		endif;

		if($ping_count != 0): ?>
			<h4 class="ping-title mb_M">
				<span class="fa-link"></span>
				<?php
				if ( 1 === $ping_count ) {
					esc_html_e( 'One Pingback', 'neatly' );

				} else {
					/* translators: 1: number of comments, 2: post title */
					printf(esc_html(__('%1$s Pingbacks','neatly')),
						absint(number_format_i18n( $ping_count ))
					);
				}
				?>
			</h4>
			<ul class="ping-list">
				<?php wp_list_comments( array(
					'type' => 'pings',
					'callback' => 'neatly_comment',
					'short_ping'  => true,
				) ); ?>
			</ul>

			<?php
		endif;

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav>
				<ul class="comment_pager f_box jc_sb">
					<li class="comment_previous"><?php previous_comments_link( '<span class="fw_bold fs24">&lsaquo;</span> '.__( 'Older Comments', 'neatly' ) ); ?></li>
					<li class="comment_next"><?php next_comments_link( __( 'Newer Comments', 'neatly' ).' <span class="fw_bold fs24">&rsaquo;</span>' ); ?></li>
				</ul>
			</nav>
			<!-- .comment-navigation -->
		  <?php } // Check for comment navigation

		endif; /* Check for have_comments().*/

		/* If comments are closed and there are comments, let's leave a little note, shall we?*/
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'neatly' ); ?></p>
		<?php
	endif;
	if ( !class_exists('YAHMAN_ADDONS_AMP')):
		comment_form( neatly_comment_custom_fields() );
		elseif (comments_open()): ?>
			<a class="comment_button_amp" rel="nofollow" href="<?php echo esc_url(get_the_permalink())  ?>#respond"><?php esc_html_e( 'Write a comment', 'neatly' ); ?></a>
			<?php else: ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'neatly' ); ?></p>
			<?php endif;
			?>

		</div><!-- #comments -->

		<?php

		function neatly_comment_custom_fields(){
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$placeholder_req  = ( $req ? " *" : '' );
			$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
			return array(
            // change the title of send button
				'label_submit'=> esc_html__('Post Comment', 'neatly'),
            // change the title of the reply section
				'title_reply'=> esc_html__('Leave a Comment', 'neatly'),
            // redefine your own textarea (the comment body)
				'comment_field' => '
				<div class="form-group"><div class="input-field"><textarea class="materialize-textarea" type="text" rows="10" id="textarea1" name="comment" aria-required="true" placeholder="'. esc_attr__('Comments', 'neatly') .'"></textarea></div></div>',

				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' =>'' .
					'<div class="form-group"><div class="input-field">' .
					'<input class="validate" id="name" name="author" placeholder="'. esc_attr__('Name', 'neatly') .$placeholder_req.'" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' /></div></div>',

					'email' =>'' .
					'<div class="form-group"><div class="input-field">' .
					'<input class="validate" id="email" name="email" placeholder="'. esc_attr__('Email', 'neatly') .$placeholder_req.'" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' /></div></div>',

					'url' => get_theme_mod( 'neatly_post_comments_website',false) ? '' :
					'<div class="form-group"><div class="input-field"><input class="validate" placeholder="'. esc_attr__('Website', 'neatly') .'" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" /></div></div>',

					'cookies' => get_option( 'show_comments_cookies_opt_in' ) ? '<p class="comment-form-cookies-consent f_box ai_c mb8"><input id="wp-comment-cookies-consent" class="mr8" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
					'<label for="wp-comment-cookies-consent" class="fsS m0">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'neatly' ) . '</label></p>' : '',
				)
			),
			);
		}


