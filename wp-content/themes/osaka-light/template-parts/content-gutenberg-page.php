<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Osaka
 */

?>

<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'osaka-light' ),
			'after'  => '</div>',
		) );
	?>

</div><!-- #post-<?php the_ID(); ?> -->
