<?php defined( 'ABSPATH' ) || exit;
get_header();

?>
<div class="main_wrap wrap_frame f_box f_col110 <?php echo esc_attr(NEATLY_SIDEBAR_STYLE); ?>">
	<main id="post-<?php the_ID(); ?>" <?php post_class('main_contents post_contents page_contents'); ?>>
		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/single/single','sort_order');
			get_template_part( 'template-parts/single/single','order' );

			neatly_post_order( 'page' , neatly_sort_order_custom_page() , $post);

		endwhile; ?>
	</main>
	<?php if(NEATLY_SIDEBAR)get_sidebar(); ?>
</div>
<?php get_footer();
