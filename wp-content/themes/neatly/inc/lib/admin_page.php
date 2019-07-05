<?php
defined( 'ABSPATH' ) || exit;

function neatly_tiny_mce_before_init_custom( $mceInit ) {
  /*ビジュアルエディタ用にクラス追加*/
  $mceInit['body_class'] .= ' post_body';
  return $mceInit;
}
//add_filter( 'tiny_mce_before_init', 'neatly_tiny_mce_before_init_custom' );



