<?php
/**
 * Template Name: Gutenberg Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Osaka
 */

get_header();
?>

    <section class="section-content">

		<?php while ( have_posts() ) { the_post();

				get_template_part( 'template-parts/content-gutenberg', 'page' );

				if ( comments_open() || get_comments_number() ) { comments_template(); }

			}
		?>

    </section><!-- /.section-content -->



<?php
get_footer();
