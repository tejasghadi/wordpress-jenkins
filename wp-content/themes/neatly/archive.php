<?php
defined( 'ABSPATH' ) || exit;
get_header();
get_template_part( 'template-parts/index/format', 'archive_title' );
?>

<div class="main_wrap wrap_frame f_box f_col110 <?php echo esc_attr(NEATLY_SIDEBAR_STYLE); ?>">
  <main class="main_contents index_contents">
    <header class="archive_header mb_L">
      <?php
      the_archive_title( '<h1 class="archive_title fsL f_box ai_c">', '</h1>' );
      the_archive_description( '<div class="archive_description">', '</div>' );
      ?>
    </header>
    <?php
    if(have_posts()):

      get_template_part( 'template-parts/index/content' );

    else:

      get_template_part( 'template-parts/index/content', 'none' );

    endif;

    /*pagination*/
    the_posts_pagination( array(
      'mid_size' => 2,
      'prev_text' => '&lt;',
      'next_text' => '&gt;',
    ) );
    ?>
  </main>
  <?php if(NEATLY_SIDEBAR)get_sidebar(); ?>
</div>



<?php get_footer();
