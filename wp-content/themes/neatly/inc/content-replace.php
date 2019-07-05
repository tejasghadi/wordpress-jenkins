<?php
defined( 'ABSPATH' ) || exit;
/**
 * Extra content
 *
 * @package Neatly
 */

add_filter('the_content','neatly_content_replace',99999999999999);

function neatly_content_replace($the_content) {


  $format = get_post_format();
  if($format === 'chat'){
    get_template_part( 'template-parts/single/format','chat' );
    $the_content = neatly_content_format_chat($the_content);
  }

  /*投稿h2前に挿入*/
  if ( is_single() && (is_active_sidebar( 'post_before_h2_no_1' ) || is_active_sidebar( 'post_before_h2_no_2' ) ||is_active_sidebar( 'post_before_h2_no_3' ))) { //is_single()
    $pattern = '{<h2.*?>.+?<\/h2>}ismu';/*H2見出しのパターン*/

    if ( preg_match_all( $pattern, $the_content, $result )) {/*H2見出しが本文中にあるかどうか*/
      if ( $result[0] ) {
        if ( isset($result[0][0]) && is_active_sidebar( 'post_before_h2_no_1' )) {
          ob_start();
          dynamic_sidebar( 'post_before_h2_no_1' );
          $before_h2 = ob_get_clean();
          $the_content  = str_replace($result[0][0], $before_h2.$result[0][0], $the_content);

        }
        if ( isset($result[0][1]) && is_active_sidebar( 'post_before_h2_no_2' )) {
          ob_start();
          dynamic_sidebar( 'post_before_h2_no_2' );
          $before_h2 = ob_get_clean();
          $the_content  = str_replace($result[0][1], $before_h2.$result[0][1], $the_content);
        }
        if ( isset($result[0][2]) && is_active_sidebar( 'post_before_h2_no_3' ) ) {
          ob_start();
          dynamic_sidebar( 'post_before_h2_no_3' );
          $before_h2 = ob_get_clean();
          $the_content  = str_replace($result[0][2], $before_h2.$result[0][2], $the_content);
        }
      }
    }
  }






  /*固定ページh2前に挿入*/
  if ( is_page() && (is_active_sidebar( 'page_before_h2_no_1' ) || is_active_sidebar( 'page_before_h2_no_2' ) ||is_active_sidebar( 'page_before_h2_no_3' ))) { //is_single()
    $pattern = '/^<h2.*?>.+?<\/h2>$/im';/*H2見出しのパターン*/
    if ( preg_match_all( $pattern, $the_content, $result )) {/*H2見出しが本文中にあるかどうか*/
      if ( $result[0] ) {
        if ( isset($result[0][0]) && is_active_sidebar( 'page_before_h2_no_1' )) {
          ob_start();
          dynamic_sidebar( 'page_before_h2_no_1' );
          $before_h2 = ob_get_clean();
          $the_content  = str_replace($result[0][0], $before_h2.$result[0][0], $the_content);

        }
        if ( isset($result[0][1]) && is_active_sidebar( 'page_before_h2_no_2' )) {
          ob_start();
          dynamic_sidebar( 'page_before_h2_no_2' );
          $before_h2 = ob_get_clean();
          $the_content  = str_replace($result[0][1], $before_h2.$result[0][1], $the_content);
        }
        if ( isset($result[0][2]) && is_active_sidebar( 'page_before_h2_no_3' ) ) {
          ob_start();
          dynamic_sidebar( 'page_before_h2_no_3' );
          $before_h2 = ob_get_clean();
          $the_content  = str_replace($result[0][2], $before_h2.$result[0][2], $the_content);
        }
      }
    }
  }

return $the_content;
}

