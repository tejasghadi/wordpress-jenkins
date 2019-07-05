<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package Neatly
 */
/*link pages*/


$next_heading = $link_pages = '';

$judge = preg_match_all('/<!--nextpage-->.*?<h[1-6].*?>(.*?)<\/h[1-6].*?>/is', $post->post_content, $match);
if($judge){
  $str = array();
  $count = 0;
  foreach ($match[0] as $key => $value) {
    $count += substr_count( $value, '<!--nextpage-->' );
    $str[$count] = $match[1][$key];
  }

  if ( get_query_var('paged') ) { $paged_num = get_query_var('paged'); }
  elseif ( get_query_var('page') ) { $paged_num = get_query_var('page'); }
  else { $paged_num = 1; }

  if(isset($str[$paged_num])){
    $next_heading = $str[$paged_num];
  }



  $link_pages = wp_link_pages( array(
    'before'      => '',
    'after'       => '',
    'next_or_number'   => 'next',
    'nextpagelink'     => '<div class="next_heading">'.esc_html($next_heading).'</div><div class="next_arrow f_box ai_c bg_fff posi_ab right0 fs14">'.esc_html__( 'Next Page', 'neatly' ).'&nbsp;<span class="fw_bold fs24 db mb4 lh_1">&rsaquo;</span></div>',
    'previouspagelink' => '',
    'echo'             => 0
  ) );

  $link_pages =  preg_replace('/<a href=".*?"><\/a>/i', '' , $link_pages);
  $link_pages =  str_replace(' class="post-page-numbers"', '', $link_pages);/*WP5.0以降挿入されるクラス対策*/

  $link_pages =  str_replace('<a', '<a class="page_link_next post_item mb_L p16_0 f_box ai_c posi_re" ', $link_pages);
}









$link_pages .= wp_link_pages( array(
  'before'      => '<nav class="page-links post_item mb_L ta_c">' . esc_html__( 'Pages:', 'neatly' ),
  'after'       => '</nav>',
  'link_before' => '<span class="page-number p4_8 mr8">',
  'link_after'  => '</span>',
  'echo'             => 0
) );



echo $link_pages;


