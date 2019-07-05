<?php
defined( 'ABSPATH' ) || exit;

add_action( 'wp', 'neatly_define_sidebar');
/*parse_queryではカスタマイザーで反映されない*/

if ( ! function_exists( 'neatly_define_sidebar' ) ) :
  /*サイドバーの設定*/
  function neatly_define_sidebar() {
    $sidebar = false;
    $sidebar_style = 'jc_c';
    if(get_theme_mod( 'neatly_sidebar_display','all') !== 'none'){
      if(is_active_sidebar( 'sidebar-1' ) ){
        if(get_theme_mod( 'neatly_sidebar_display','all') === 'all' || !is_singular() ){
          $sidebar = true;
          $sidebar_style = 'jc_sb';
        }
      }

    }
    if (!defined('NEATLY_SIDEBAR'))
      define( 'NEATLY_SIDEBAR', $sidebar );
    if (!defined('NEATLY_SIDEBAR_STYLE'))
      define( 'NEATLY_SIDEBAR_STYLE', $sidebar_style );




    if ( ! function_exists( 'neatly_gutenberg_front_styles' ) ) :
      function neatly_gutenberg_front_styles(){
        if ( function_exists( 'has_block' ) ){
          if( has_blocks() ){
            if(!NEATLY_SIDEBAR || is_page_template( 'template-title_content_no_sidebar.php' )){
              wp_enqueue_style( 'neatly_gutenberg_style', NEATLY_THEME_URI . 'assets/css/gutenberg_style.css',array( 'neatly_style' ) );
            }else{
              wp_enqueue_style( 'neatly_gutenberg_style', NEATLY_THEME_URI . 'assets/css/gutenberg_sidebar.css',array( 'neatly_style' ) );
            }
            return;
          }
        }
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
      }
    endif;

    /*フロントエンド*/
    add_action( 'enqueue_block_assets', 'neatly_gutenberg_front_styles' );

    /*管理画面のみ*/
    if(is_admin()){
      /*編集画面*/
      add_action('enqueue_block_editor_assets', 'neatly_gutenberg_front_styles');


    }





  }
endif;





class NEATLY_WALKER_NAV_MENU extends Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = Array() ) {
    $output .= "";
  }
  function end_lvl( &$output, $depth = 0, $args = Array() ) {
    $output .= "";
  }
  function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {

    $menu_class = '';

    foreach ($item->classes as $key => $value) {
      $menu_class .= ' ' . $value;
    }

    if (in_array('menu-item-has-children', $item->classes)) {
        // parent

      $input_id = "nav-".$item->ID;
      $caption = $item->title;
      $label = '';

      if($args->theme_location === 'primary'){

        $label = '<label class="drop_icon f_box ai_c fs16 m0" for="'.$input_id.'">';
        if($depth !== 0){
          $label .= "\n" . '<span class="fa-caret-right"></span>';
        }else{
          $label .= "\n" . '<span class="fa-caret-down"></span>';
        }

        $label .= "\n" . '</label>';
      }

      $output .= "\n" . '<li id="menu-item-'.$item->ID.'" class="menu-item-'.$item->ID.$menu_class.' posi_re fs24 fw_bold">';
      $output .= $this->create_a_tag($item, $depth, $args , $label);

      $output .= "\n" . '<input type="checkbox" id="'.$input_id.'" class="dn">';
      $output .= "\n" . '<ul id="sub-'.$input_id.'" class="sub-menu posi_ab p12">';


    }
    else {
        // child
      $label = '';
      $output .= '<li id="menu-item-'.$item->ID.'"  class="menu-item-'.$item->ID.$menu_class.' posi_re fs24 fw_bold">';
      $output .= $this->create_a_tag($item, $depth, $args , $label);
    }
  }
  function end_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {
    if (in_array('menu-item-has-children', $item->classes)) {
        // parent
      $output .= "\n".'</li></ul></li>';
    }
    else {
        // child
      $output .= "\n".'</li>';
    }
  }

  private function create_a_tag($item, $depth, $args , $label) {
        // link attributes
    $attributes = ' class="menu_s_a f_box jc_sb ai_c sub_fc m0a"';
    $attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        //$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
      $args->before,
      $attributes,
      $args->link_before,
      apply_filters( 'the_title', $item->title, $item->ID ),
      $args->link_after,
      $label,
      $args->after
    );
    return apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}
