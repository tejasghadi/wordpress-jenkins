<?php
defined( 'ABSPATH' ) || exit;

define( 'NEATLY_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'NEATLY_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );


require_once NEATLY_THEME_DIR . 'inc/lib/setup.php' ;

require_once NEATLY_THEME_DIR . 'inc/lib/widgets.php' ;

require_once NEATLY_THEME_DIR . 'inc/template-tags.php' ;

require_once NEATLY_THEME_DIR . 'inc/content-replace.php' ;

if ( ! function_exists( 'neatly_after_setup_theme' ) ) :
	function neatly_after_setup_theme() {
		/*----SETUP-----*/
		require_once NEATLY_THEME_DIR . 'inc/lib/after_setup_theme.php' ;
	}
endif;
add_action( 'after_setup_theme', 'neatly_after_setup_theme' );

if ( ! function_exists( 'neatly_scripts_styles' ) ) :
	function neatly_scripts_styles() {

		//wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'neatly_style', NEATLY_THEME_URI . 'assets/css/style.min.css',array() );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			 // Load comment-reply.js (into footer)
			wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
		}

	}
endif;
add_action( 'wp_enqueue_scripts', 'neatly_scripts_styles' );

if ( ! function_exists( 'neatly_footer_scripts_styles' ) ) :
	function neatly_footer_scripts_styles() {

		wp_enqueue_style( 'neatly_fontawesome', NEATLY_THEME_URI . 'assets/font/fontawesome/style.min.css',array() );

		wp_enqueue_style( 'neatly_keyframes', NEATLY_THEME_URI . 'assets/css/keyframes.css',array() );

		wp_enqueue_style( 'neatly_printer', NEATLY_THEME_URI . 'assets/css/printer.css',array() );

	};
endif;
add_action( 'wp_footer', 'neatly_footer_scripts_styles' );

if ( is_admin() ){

	require_once NEATLY_THEME_DIR . 'inc/lib/admin_page.php' ;

}



