<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Osaka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-top">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="post-meta">
				<?php
				osaka_light_posted_on();
				osaka_light_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php osaka_light_post_thumbnail(); ?>

	<div class="entry-content">
		
		<?php the_excerpt(); ?>
        
        <?php osaka_light_read_more();?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->


