<?php
defined( 'ABSPATH' ) || exit;
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Neatly
 */




/*ヘッダーメニュー*/
if ( ! function_exists( 'neatly_primary_menu' ) ) :

	function neatly_primary_menu() {?>

		<div><nav id="nav_h" class="wrap_frame nav_h">
			<?php wp_nav_menu( array(
				'theme_location'  => 'primary',
				'menu_class'      => 'menu_h menu_a f_box f_wrap f_col100 ai_c m16 lsn',
				'menu_id'         => 'menu_header',
				'container'       => 'ul',
				'fallback_cb'     => '__return_false',
				'walker'            => new NEATLY_WALKER_NAV_MENU,
			));
			?>
		</nav></div>
		<?php
	}

endif;

/*フッターメニュー*/
if ( ! function_exists( 'neatly_footer_menu' ) ) :
	function neatly_footer_menu(){
		echo '<div id="menu_f" class="p16_0"><nav id="nav_f" class="wrap_frame nav_f f_box jc_c p16_0">';
		wp_nav_menu( array(
			'theme_location'  => 'secondary',
			'menu_class'      => 'menu_f menu_a menu_s o_s_t f_box ai_c m0 lsn',
			'menu_id'         => 'menu_footer',
			'container'       => 'ul',
			'fallback_cb'     => '__return_false',
			'walker'            => new NEATLY_WALKER_NAV_MENU,
		));
		echo '</nav></div>';
	}
endif;

/*フッターメニュー*/
if ( ! function_exists( 'neatly_credit_menu' ) ) :
	function neatly_credit_menu(){
		echo '<div id="menu_c" class="mb_L"><nav id="nav_c" class="wrap_frame nav_f f_box jc_c">';
		wp_nav_menu( array(
			'theme_location'  => 'credit',
			'menu_class'      => 'menu_f menu_a menu_s o_s_t f_box ai_c m0 lsn',
			'menu_id'         => 'menu_credit',
			'container'       => 'ul',
			'fallback_cb'     => '__return_false',
			'walker'            => new NEATLY_WALKER_NAV_MENU,
		));
		echo '</nav></div>';
	}
endif;

/*ヘッダーウィジェット*/
if ( ! function_exists( 'neatly_header_widget' ) ) :
	function neatly_header_widget(){
		echo '<div id="header_widget" class="f_box f_col100 ai_c">';
		dynamic_sidebar('header_widget');
		echo '</div>';
	}
endif;

if ( ! function_exists( 'neatly_header_logo_title' ) ) :
	function neatly_header_logo_title () {

		if ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			echo '<img src="' . esc_url( $logo[0] ) . '" class="header_logo mb_S" alt="' . get_bloginfo( 'name' , 'display' ) . '" width="'.esc_attr( $logo[1] ).'" height="'.esc_attr( $logo[2] ).'" decoding="async" />';
		} else {
			$title_tag = 'p';
			if ( is_home() ) $title_tag = 'h1';
			echo '<'.$title_tag.' class="title_text fs24 fw_bold">'.get_bloginfo( 'name' , 'display' ).'</'.$title_tag.'>';
		}


	}
endif;

if ( ! function_exists( 'neatly_header_logo_icon' ) ) :
	function neatly_header_logo_icon () {

		$header_icon = get_theme_mod( 'neatly_header_icon','');

		if($header_icon !== '' ){
			$header_icon_size = wp_get_attachment_metadata( attachment_url_to_postid($header_icon) );
			echo '<img src="' . esc_url( $header_icon ) . '" class="header_icon mr8" width="'.$header_icon_size['width'].'" height="'.$header_icon_size['height'].'" alt="' . get_bloginfo( 'name' , 'display' ) . '" decoding="async" />';
		}

	}
endif;

/*時差*/
if ( ! function_exists( 'neatly_human_time_diff' ) ) :
	function neatly_human_time_diff($time) {

		$tzstring = get_option( 'timezone_string' );
		$offset   = get_option( 'gmt_offset' );

    //Manual offset...
    //@see http://us.php.net/manual/en/timezones.others.php
    //@see https://bugs.php.net/bug.php?id=45543
    //@see https://bugs.php.net/bug.php?id=45528
    //IANA timezone database that provides PHP's timezone support uses POSIX (i.e. reversed) style signs
		if( empty( $tzstring ) && 0 != $offset && floor( $offset ) == $offset ){
			$offset_st = $offset > 0 ? "-$offset" : '+'.absint( $offset );
			$tzstring  = 'Etc/GMT'.$offset_st;
		}

    //Issue with the timezone selected, set to 'UTC'
		if( empty( $tzstring ) ){
			$tzstring = 'UTC';
		}

		$now = new DateTime('', new DateTimeZone( $tzstring ) );

		$interval = $now->diff(new DateTime($time, new DateTimeZone( $tzstring ) ));

		//if ($interval->invert == 0) return __('just now','neatly');//'just now';
		if ($interval->y == 1) return __('a year ago','neatly');
		/* translators: %s: years */
		if ($interval->y > 1) return  sprintf( __( '%s years ago' , 'neatly' ), $interval->format('%y') );
		if ($interval->m == 1) return __('a month ago','neatly');
		/* translators: %s: months */
		if ($interval->m > 1) return  sprintf( __( '%s months ago' , 'neatly' ), $interval->format('%m') );
		/* translators: %s: week */
		if ($interval->d > 13) return sprintf( __('%s weeks ago','neatly'), intval($interval->d / 7) );
		if ($interval->d == 7) return __('a week ago','neatly');
		/* translators: %s: time */
		if ($interval->d == 1) return sprintf( __('yesterday at %s','neatly'), get_post_time('h:i a') );
		/* translators: %s: date */
		if ($interval->d > 1) return  sprintf( __( '%s days ago' , 'neatly' ), $interval->format('%d') );
		if ($interval->h == 1) return __('an hour ago','neatly');
		/* translators: %s: hour */
		if ($interval->h > 1) return sprintf( __( '%s hours ago' , 'neatly' ), $interval->format('%h') );
		if ($interval->i == 1) return __('a minute ago','neatly');
		/* translators: %s: minute */
		if ($interval->i > 1) return sprintf( __( '%s minutes ago' , 'neatly' ), $interval->format('%i') );
		return __('just now','neatly');//$interval->format('just now');
	}
endif;


if ( ! function_exists( 'neatly_get_thumbnail' ) ) :
	function neatly_get_thumbnail($post_id = '' , $size = 'thumbnail') {

		/*
	     * @param string $post_id Post ID.
	     * @param string $size thumbnail, middle ,large etc.
	    */
		$thumbnail = array();

		if( has_post_thumbnail($post_id) ) {/*サムネイルがある場合*/
			/*配列で返す*/
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post_id) , $size );
			$thumbnail['has_image'] = true;

			return $thumbnail;

		}else{

			preg_match("/<img[^>]+src=[\"'](s?https?:\/\/[\-_\.!~\*'()a-z0-9;\/\?:@&=\+\$,%#]+\.(jpg|jpeg|png|gif))[\"'][^>]+>/i", get_post($post_id)->post_content, $thumurl);

			if(isset($thumurl[1])){

				$img_id = attachment_url_to_postid($thumurl[1]);
				$img_data = wp_get_attachment_metadata ($img_id);

				/*サイト内の画像であれば*/
				if(!empty($img_data) ){
					$thumbnail[0] = $thumurl[1];
					$thumbnail[1] = $img_data['width'];
					$thumbnail[2] = $img_data['height'];
					$thumbnail['has_image'] = true;
					return $thumbnail;
				}

			}

		}

		$thumbnail[0] = $thumbnail[1] = $thumbnail[2] = '';
		$thumbnail['has_image'] = false;

		return $thumbnail;

	}
endif;


if ( ! function_exists( 'neatly_comment_author_anchor' ) ) :
	function neatly_comment_author_anchor( $author_link ){
		return str_replace( "<a", "<a target='_blank'", $author_link );
	}
endif;
add_filter( "get_comment_author_link", "neatly_comment_author_anchor" );

if ( ! function_exists( 'neatly_comment' ) ) :
	function neatly_comment($comment, $args, $depth) {

		switch ( $comment->comment_type ) :

			case 'pingback':
			case 'trackback':
			?>
			<li class="pingback">
				<p class="mb8"><span class="fa-caret-right mr4"></span><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'neatly' ), ' <span class="fa-pencil"></span><span class="edit-link">', '</span>' ); ?></p>

				<?php

				break;
				default:

				$comment_author = '';
				$comment_author_right = '';
				if ( false !== strpos( comment_class('',null,null,false), 'bypostauthor' ) ) {
					$comment_author = 'author ';
					$comment_author_right = ' ta_r';
					$comment_author_left = ' ta_l';
				}

				?>



				<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
					<div class="comment_body mb_M<?php echo esc_attr($comment_author_right); ?>" itemscope itemtype="https://schema.org/UserComments">

						<div class="<?php echo esc_attr($comment_author); ?>comment_data f_box ai_c mb8">
							<div class="comment_avatar br50 of_h m4">
								<?php echo get_avatar( $comment->comment_author_email, 60 ); ?>
							</div>

							<div class="comment_meta">
								<span class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person"><?php echo get_comment_author_link(); ?></span>
								<div>
									<time><?php comment_date(get_option( 'date_format' )); ?></time>
									<span class="comment_reply">
										<?php comment_reply_link(array_merge( $args, array('reply_text' => '<span class="fa-reply"></span> '.__('Reply', 'neatly'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
									</span>
									<span class="comment_edit">
										<?php edit_comment_link('<span class="fa-pencil"></span> '.__('Edit', 'neatly'),'  ','') ?>
									</span>
								</div>
							</div>
						</div>



						<div class="<?php echo esc_attr($comment_author); ?>comment_text br4 dib p12 posi_re" itemprop="commentText">
							<?php comment_text() ?>
						</div>


						<?php if ($comment->comment_approved == '0') : ?>
							<span><?php esc_html_e('*Your comment is awaiting moderation.*', 'neatly') ?></span>
						<?php endif; ?>
					</div>


					<?php
					break;
				endswitch;

			}
		endif;

		function neatly_move_comment_field_to_bottom( $fields ) {

			if(get_theme_mod( 'neatly_post_comments_bottom',false) ){
				$order = array('author','email','url','comment','cookies');

				uksort($fields, function($key1, $key2) use ($order) {
					return (array_search($key1, $order) > array_search($key2, $order));
				});
			}

			return $fields;
		}

		add_filter( 'comment_form_fields', 'neatly_move_comment_field_to_bottom' );


		if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 */
		do_action( 'wp_body_open' );
	}
endif;
