<?php
defined( 'ABSPATH' ) || exit;
/**
 * Author profile
 *
 * @package NEATLY
 */
/*Author profile*/
function neatly_author_profile(){
  ?>
  <!--Author profile-->

  <div id="about_author" class="about_author post_item mb_L br4 p12 f_box f_col100 ai_c">

      <div class="aa_avatar p12">
        <img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>" width="96" height="96" class="br50" decoding="async" />
        <?php //echo get_avatar( get_the_author_meta('ID') , 64); ?>
      </div>






      <div class="aa_profile p12" >
        <ul class="aa_pl m0 lsn">
          <li><div class="aa_name fsL fw4 f_box jc_c100"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class=""><?php echo the_author_meta('nickname'); ?></a></div></li>
          <li class="sub_fc p12"><?php echo wpautop(get_the_author_meta('user_description')); ?></li>
          <?php
          if(function_exists('yahman_addons_user_profile_output')){
            yahman_addons_user_profile_output();
          }
          ?>
        </ul>
      </div>

    </div>
    <!--/Author profile-->
    <?php 
  }
