<?php
defined( 'ABSPATH' ) || exit;

load_theme_textdomain( 'neatly', NEATLY_THEME_DIR . 'languages' );
add_theme_support( 'post-thumbnails' );/*サムネイル有効化*/
add_theme_support( 'title-tag' );/*自動的にhead内にタイトル挿入*/
add_theme_support( 'automatic-feed-links' );/*RSSフィード有効*/

add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ) );

/*Switch default core output valid HTML5.*/
add_theme_support( 'html5', array(
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
) );

/*テストで落ちる必須*/
global $content_width;
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'neatly_content_width', 610 );
}

add_theme_support( 'custom-background', array(/*カスタム背景有効化*/
	'default-color'          => '',
	'default-image'          => '',
	'default-repeat'         => 'repeat',
	'default-position-x'     => 'left',
	'default-position-y'     => 'top',
	'default-size'           => 'auto',
	'default-attachment'     => 'scroll',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
));

/*----カスタマイザー-----*/
   // Indicate widget sidebars can use selective refresh in the Customizer.(WP4.7)
add_theme_support( 'customize-selective-refresh-widgets' );

add_theme_support( 'custom-logo', array(
	'height'      => 80,
	'width'       => 320,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => false,
	//'header-text' => array( 'site-title', 'site-description' ),
));


/*gutenberg*/
add_theme_support( 'wp-block-styles' );
add_theme_support( 'align-wide' );

add_theme_support( 'responsive-embeds' );

/*メニュー*/
register_nav_menu( 'primary' , __( 'Header Menu', 'neatly' ) );
register_nav_menu( 'secondary' , __( 'Footer Menu', 'neatly' ));
register_nav_menu( 'credit' , __( 'Credit Menu', 'neatly' ));

/*カスタマイザー*/
require_once NEATLY_THEME_DIR . 'inc/customizer/customizer.php';
		// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'NEATLY_CUSTOMIZER' , 'register' ) );
