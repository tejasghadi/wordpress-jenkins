<?php
defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', 'neatly_widgets_init' );

if ( ! function_exists( 'neatly_widgets_init' ) ) :
  /*ウィジェット追加*/
  function neatly_widgets_init() {

    register_sidebar(array(
      'name' => esc_html__( 'Sidebar', 'neatly' ),
      'id' => 'sidebar-1',
      'description' => esc_html__( 'Add widgets here to appear in your sidebar.', 'neatly' ),
      'before_widget' => '<div id="%1$s" class="widget s_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title sw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_html__( 'Footer Left', 'neatly' ),
      'id' => 'footer-1',
      'description' => esc_html__( 'Add widgets here to appear in bottom footer', 'neatly' ).esc_html__( '(left side)', 'neatly' ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));
    register_sidebar(array(
      'name' => esc_html__( 'Footer Center', 'neatly' ),
      'id' => 'footer-2',
      'description' => esc_html__( 'Add widgets here to appear in bottom footer', 'neatly' ).esc_html__( '(center)', 'neatly' ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));
    register_sidebar(array(
      'name' => esc_html__( 'Footer Right', 'neatly' ),
      'id' => 'footer-3',
      'description' => esc_html__( 'Add widgets here to appear in bottom footer', 'neatly' ).esc_html__( '(right side)', 'neatly' ),
      'before_widget' => '<div id="%1$s" class="widget f_widget %2$s br4 mb_L">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title fw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => esc_html__( 'Header', 'neatly' ),
      'id' => 'header_widget',
      'description' => esc_html__( 'Add widgets here to header.', 'neatly' ),
      'before_widget' => '<div id="%1$s" class="widget h_widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title hw_title mb_S fsS fw_bold">',
      'after_title' => '</div>'
    ));

    $post_type = array(
      'post' => esc_html_x('the post', 'widget' ,'neatly' ),
      'page' => esc_html_x('the page', 'widget' ,'neatly' ),
    );
    $position_num = array(
      esc_html_x('the first', 'widget' ,'neatly' ),
      esc_html_x('the second', 'widget' ,'neatly' ),
      esc_html_x('the third', 'widget' ,'neatly' ),
    );

    foreach ($post_type as $post_type_key => $post_type_val) {
      $i = 1;
      foreach ($position_num as $position_num_key => $position_num_val) {
        register_sidebar(array(
          /* translators: %1$s: number */
          /* translators: %2$s: post type */
          'name' => sprintf( esc_html__('Before %1$s H2 of %2$s', 'neatly' ), $position_num_val, $post_type_val ),
          'id' => $post_type_key.'_before_h2_no_'.$i,
          /* translators: %1$s: number */
          /* translators: %2$s: post type */
          'description' => sprintf( esc_html__('Add widgets before %1$s H2 in the contents of %2$s', 'neatly' ), $position_num_val , $post_type_val ),
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>',
          'before_title' => '<div class="widget_title mb_S fsS">',
          'after_title' => '</div>'
        ));

        ++$i;
      }
    }

    $setting_url = esc_url(admin_url('customize.php?autofocus[section]=index_widget_sections'));

    register_sidebar(array(
      'name' => esc_html__( 'Index List', 'neatly' ),
      'id' => 'index_list',
      'description' => esc_html__( 'Add widgets here to index list insert.', 'neatly' ).' <a href="'.$setting_url.'">'.esc_html__( 'change the number of insert widget area.', 'neatly' ).'</a>',
      'before_widget' => '<div id="%1$s" class="widget %2$s i_widget">',
      'after_widget' => '</div>',
      'before_title' => '<div class="widget_title mb_S fsS">',
      'after_title' => '</div>'
    ));

    $i = 1;
    while($i<6){
      register_sidebar(array(
        'name' => esc_html__( 'Post widget', 'neatly' ).' '.$i,
        'id' => 'post_widget_'.$i,
        'description' => esc_html__( 'Add widgets in the contents of the post', 'neatly' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s post_widget mb_L">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget_title">',
        'after_title' => '</div>'
      ));
      ++$i;
    }


    $i = 1;
    while($i<6){
      register_sidebar(array(
        'name' => esc_html__( 'Page widget', 'neatly' ).' '.$i,
        'id' => 'page_widget_'.$i,
        'description' => esc_html__( 'Add widgets in the contents of the page', 'neatly' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s post_widget mb_L">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget_title">',
        'after_title' => '</div>'
      ));
      ++$i;
    }

  }
endif;

