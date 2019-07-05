<?php
/**
 * Osaka Theme Customizer
 *
 * @package Osaka
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


if ( !function_exists('osaka_light_default_theme_options') ) :
    function osaka_light_default_theme_options() {
        $default_theme_options = array(

            'read_more'  			=> esc_html__('Read More','osaka-light'), 
            'excerpt_length'  		=> 45, 
            'settings_404_title'    => esc_html__( '404', 'osaka-light'), 
            'settings_404_heading'  => esc_html__( 'Page Not Found', 'osaka-light'), 
            'copyright_text'        => '<span>Copyright &copy;' . date('Y') . ' <a href="' . esc_url( 'https://prowptheme.com/themes/osaka-gutenberg-wordpress-theme/', 'osaka-light' ) . '" target="_blank" rel="nofollow">' . esc_html__('Osaka','osaka-light') . '</a> ' . esc_html__( ' | All rights reserved ','osaka-light') . '</span>',
            'facebook'              => '',
            'twitter'               => '',
            'instagram'             => '',
            'skype'                 => '',
            'dribbble'              => '',
            'vimeo'                 => ''

        );    	
    	return apply_filters( 'osaka_light_default_theme_options', $default_theme_options );
    }
endif;


if ( !function_exists('osaka_light_get_theme_options') ) :
    function osaka_light_get_theme_options() {

        $osaka_light_default_theme_options = osaka_light_default_theme_options();

        $osaka_light_get_theme_options = get_theme_mod( 'osaka_light_options');
        if( is_array( $osaka_light_get_theme_options )){
            return array_merge( $osaka_light_default_theme_options, $osaka_light_get_theme_options );
        }
        else{
            return $osaka_light_default_theme_options;
        }

    }
endif;



function osaka_light_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_section('header_image');


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'osaka_light_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'osaka_light_customize_partial_blogdescription',
		) );
	}


	$default = osaka_light_get_theme_options();



	$wp_customize->add_section( 'theme_detail', array(
            'title'    => esc_html__( 'About Osaka', 'osaka-light' ),
            'priority' => 9
        ) );



    // $wp_customize->add_setting( 'upgrade_text', array(
    //     'default' => '',
    //     'sanitize_callback' => '__return_false'
    // ) );

    // $wp_customize->add_control( new osaka_light_Customize_Static_Text_Control( $wp_customize, 'upgrade_text', array(
    //     'section'     => 'theme_detail',
    //     'label'       => esc_html__( 'Upgrade to PRO', 'osaka-light' ),
    //     'description' => array('')
    // ) ) );


    $wp_customize->add_panel( 'osaka_light_panel', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'title' => esc_html__( 'Osaka Theme Options', 'osaka-light' ),
    ) );

	/*Blog Page Options*/
	$wp_customize->add_section( 'osaka_light_blog_section', array(
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Blog Section Options', 'osaka-light' ),
	    'panel' 		 => 'osaka_light_panel',
	) );

	/*Read More Text*/
	$wp_customize->add_setting( 'osaka_light_options[read_more]', array(
	    'capability'        => 'edit_theme_options',
	    'transport' 		=> 'refresh',
	    'default'           => $default['read_more'],
	    'sanitize_callback' => 'sanitize_text_field'
	) );
    $wp_customize->add_control( 'osaka_light_options[read_more]', array(
        'label'     => esc_html__( 'Read More Text', 'osaka-light' ),
        'description' => esc_html__('Enter Your Custom Read More Text', 'osaka-light'),
        'section'   => 'osaka_light_blog_section',
        'settings'  => 'osaka_light_options[read_more]',
        'type'      => 'text',
        'priority'  => 10
    ) );


    /* Excerpt Length */
	$wp_customize->add_setting( 'osaka_light_options[excerpt_length]', array(
	    'capability'        => 'edit_theme_options',
	    'transport' 		=> 'refresh',
	    'default'           => $default['excerpt_length'],
	    'sanitize_callback' => 'absint'
	) );


    $wp_customize->add_control( 'osaka_light_options[excerpt_length]', array(
        'label'     => esc_html__( 'Excerpt Length', 'osaka-light' ),
        'description' => esc_html__('Enter Your Excerpt Content Length', 'osaka-light'),
        'section'   => 'osaka_light_blog_section',
        'settings'  => 'osaka_light_options[excerpt_length]',
        'type'      => 'number',
        'priority'  => 10
    ) );

    /*404 Page*/
    $wp_customize->add_section( 'osaka_light_404_section', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__( '404 Page', 'osaka-light' ),
        'panel'          => 'osaka_light_panel',
    ) );

    /*404 Title*/
    $wp_customize->add_setting( 'osaka_light_options[settings_404_title]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['settings_404_title'],
        'sanitize_callback' => 'sanitize_text_field'
    ) );    
    $wp_customize->add_control( 'osaka_light_options[settings_404_title]', array(
        'label'    => esc_html__( '404 Title', 'osaka-light' ),
        'description' => esc_html__('Enter 404 Page Title', 'osaka-light'),
        'section'  => 'osaka_light_404_section',
        'settings' => 'osaka_light_options[settings_404_title]',
        'type'     => 'text',
        'priority'  => 9
    ) );

    /*404 Heading*/
    $wp_customize->add_setting( 'osaka_light_options[settings_404_heading]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['settings_404_heading'],
        'sanitize_callback' => 'sanitize_text_field'
    ) );    
    $wp_customize->add_control( 'osaka_light_options[settings_404_heading]', array(
        'label'    => esc_html__( '404 Heading', 'osaka-light' ),
        'description' => esc_html__('Enter 404 Page Heading', 'osaka-light'),
        'section'  => 'osaka_light_404_section',
        'settings' => 'osaka_light_options[settings_404_heading]',
        'type'     => 'text',
        'priority'  => 9
    ) );


    /*Footer*/
    $wp_customize->add_section( 'osaka_light_footer_section', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__( 'Footer Options', 'osaka-light' ),
        'panel'          => 'osaka_light_panel',
    ) );

    $wp_customize->add_setting( 'osaka_light_options[facebook]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['facebook'],
        'sanitize_callback' => 'esc_url_raw'
    ) );

    /*Social Networks*/
    $wp_customize->add_control( 'osaka_light_options[facebook]', array(
        'label'    => esc_html__( 'Facebook URL', 'osaka-light' ),
        'description' => esc_html__('Facebook URL', 'osaka-light'),
        'section'  => 'osaka_light_footer_section',
        'settings' => 'osaka_light_options[facebook]',
        'type'     => 'url',
        'priority'  => 9
    ) );

    $wp_customize->add_setting( 'osaka_light_options[twitter]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['twitter'],
        'sanitize_callback' => 'esc_url_raw'
    ) );

    $wp_customize->add_control( 'osaka_light_options[twitter]', array(
        'label'    => esc_html__( 'Twitter URL', 'osaka-light' ),
        'description' => esc_html__('Twitter URL', 'osaka-light'),
        'section'  => 'osaka_light_footer_section',
        'settings' => 'osaka_light_options[twitter]',
        'type'     => 'url',
        'priority'  => 9
    ) );

    $wp_customize->add_setting( 'osaka_light_options[skype]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['skype'],
        'sanitize_callback' => 'esc_url_raw'
    ) );

    $wp_customize->add_control( 'osaka_light_options[skype]', array(
        'label'    => esc_html__( 'Skype URL', 'osaka-light' ),
        'description' => esc_html__('Skype URL', 'osaka-light'),
        'section'  => 'osaka_light_footer_section',
        'settings' => 'osaka_light_options[skype]',
        'type'     => 'url',
        'priority'  => 9
    ) );

    $wp_customize->add_setting( 'osaka_light_options[instagram]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['instagram'],
        'sanitize_callback' => 'esc_url_raw'
    ) );

    $wp_customize->add_control( 'osaka_light_options[instagram]', array(
        'label'    => esc_html__( 'Instagram URL', 'osaka-light' ),
        'description' => esc_html__('Instagram URL', 'osaka-light'),
        'section'  => 'osaka_light_footer_section',
        'settings' => 'osaka_light_options[instagram]',
        'type'     => 'url',
        'priority'  => 9
    ) );

    $wp_customize->add_setting( 'osaka_light_options[vimeo]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['vimeo'],
        'sanitize_callback' => 'esc_url_raw'
    ) );

    $wp_customize->add_control( 'osaka_light_options[vimeo]', array(
        'label'    => esc_html__( 'Vimeo URL', 'osaka-light' ),
        'description' => esc_html__('Vimeo URL', 'osaka-light'),
        'section'  => 'osaka_light_footer_section',
        'settings' => 'osaka_light_options[vimeo]',
        'type'     => 'url',
        'priority'  => 9
    ) );

    $wp_customize->add_setting( 'osaka_light_options[dribbble]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['dribbble'],
        'sanitize_callback' => 'esc_url_raw'
    ) );

    $wp_customize->add_control( 'osaka_light_options[dribbble]', array(
        'label'    => esc_html__( 'Dribbble URL', 'osaka-light' ),
        'description' => esc_html__('Dribbble URL', 'osaka-light'),
        'section'  => 'osaka_light_footer_section',
        'settings' => 'osaka_light_options[dribbble]',
        'type'     => 'url',
        'priority'  => 9
    ) );

    /*Copyright Text*/
    $wp_customize->add_setting( 'osaka_light_options[copyright_text]', array(
        'capability'        => 'edit_theme_options',
        'transport'         => 'refresh',
        'default'           => $default['copyright_text'],
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'osaka_light_options[copyright_text]', array(
        'label'     => esc_html__( 'Copyright Text', 'osaka-light' ),
        'description' => esc_html__('Enter your own copyright Text.', 'osaka-light'),
        'section'   => 'osaka_light_footer_section',
        'settings'  => 'osaka_light_options[copyright_text]',
        'type'      => 'textarea',
        'priority'  => 10
    ) );






}
add_action( 'customize_register', 'osaka_light_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function osaka_light_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function osaka_light_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function osaka_light_customize_preview_js() {
	wp_enqueue_script( 'osaka-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'osaka_light_customize_preview_js' );
