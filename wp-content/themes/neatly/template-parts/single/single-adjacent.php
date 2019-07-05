<?php
defined( 'ABSPATH' ) || exit;
/**
 *
 * @package NEATLY
 */
/*adjacent*/

echo '<nav class="adjacents p16_0 f_box jc_sb ai_c mb_L posi_re">';

$prevpost = get_adjacent_post('', '', true); /*前の記事*/
$nextpost = get_adjacent_post('', '', false); /*次の記事*/

if ($prevpost) { /*前の記事が存在しているとき*/
	$thumurl = neatly_get_thumbnail( $prevpost->ID , 'thumbnail');
        //wp_get_attachment_image_src (get_post_thumbnail_id ($prevpost->ID,  true));

	echo '<a href="' . esc_url(get_permalink($prevpost->ID)) . '" title="' . get_the_title($prevpost->ID) . '" class="adjacent adjacent_L f_box ai_c f_col100">';
	if ($thumurl['has_image']){
		echo '<div class="adjacent_thum adjacent_thum_L f_box ai_c mr8">';
		echo '<img src="'.esc_url( $thumurl[0] ).'" width="48" height="48" alt="'. get_the_title($prevpost->ID) .'" decoding="async" />';
		echo '</div>';
	}
	echo '<div><p class="adjacent_title adjacent_title_L p10 fsMS">' . esc_html(mb_strimwidth(get_the_title($prevpost->ID), 0, 80, "...", 'UTF-8')) . '</p></div>';
	echo '</a>';
	echo '<div class="adjacent_info adjacent_prev posi_ab fsS f_box ai_c left0 bg_fff"><span class="fw_bold fs24 mr4 lh_1 db mb6">&lsaquo;</span><span class="fw_bold fsS lh_1 db">'.esc_html__( 'Prev', 'neatly' ).'</span></div>';
}else{

	echo '<a href="' . esc_url(home_url()) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="adjacent adjacent_L f_box ai_c">';
	echo '<p class="adjacent_title adjacent_title_L p10"><span class="fa-home sub_fc" style="font-size:36px;"></span></p>';
	echo '</a>';
}

if ( $nextpost ) { /*次の記事が存在しているとき*/
	$thumurl = neatly_get_thumbnail( $nextpost->ID , 'thumbnail');
        //$thumurl = wp_get_attachment_image_src (get_post_thumbnail_id ($nextpost->ID,  true));


	echo '<a href="' . esc_url(get_permalink($nextpost->ID)) . '" title="'. get_the_title($nextpost->ID) . '" class="adjacent adjacent_R f_box ai_c jc_fe f_col_r100">';

	echo '<div class="ta_r"><p class="adjacent_title adjacent_title_R p10 fsMS">' . esc_html(mb_strimwidth(get_the_title($nextpost->ID), 0, 80, "...", 'UTF-8')) . '</p></div>';
	if ($thumurl['has_image']){
		echo '<div class="adjacent_thum adjacent_thum_R f_box ai_c ml8">';
		echo '<img src="'.esc_url( $thumurl[0] ).'" width="48" height="48" alt="'. get_the_title($nextpost->ID) .'" decoding="async" />';
		echo '</div>';
	}
	echo '</a>';
	echo '<div class="adjacent_info adjacent_next posi_ab f_box ai_c right0 bg_fff"><span class="fw_bold fsS lh_1 db">'.esc_html__( 'Next', 'neatly' ).'</span><span class="fw_bold fs24 ml4 lh_1 db mb6">&rsaquo;</span></div>';
}else{

	echo '<a href="' . esc_url(home_url()) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="adjacent adjacent_R f_box ai_c jc_fe">';

	echo '<p class="adjacent_title adjacent_title_R p10"><span class="fa-home sub_fc" style="font-size:36px;"></span></p>';
	echo '</a>';
}

echo '</nav>';


