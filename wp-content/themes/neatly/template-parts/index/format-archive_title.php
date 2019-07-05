<?php
defined( 'ABSPATH' ) || exit;
/**
 * Archive title
 *
 * @package Neatly
 */

if ( ! function_exists( 'neatly_get_the_archive_title' ) ) :
  /*アーカイブページのタイトル*/
  function neatly_get_the_archive_title($title) {
    if ( is_category() ) {
      $title = single_cat_title( '<span class="fa-folder-open-o fsM mt4 mr4"></span>', false );
    }elseif ( is_tag() ) {
      $title = single_tag_title( '<span class="fa-tag fsM mt4 mr4"></span>', false );
    } elseif ( is_author() ) {
      $title = '<span class="fa-user fsM mt4 mr4"></span>'. get_the_author();

    } elseif ( is_year() || is_month() || is_day() ) {
     $title = '<span class="fa-calendar fsM mr4"></span>'. $title;
   }
   return $title;
 }
endif;
add_filter( 'get_the_archive_title', 'neatly_get_the_archive_title');
