<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Osaka
 */

get_header();
?>

    <section class="section-content page-contents">
        <div class="container">
        	<div class="content mb-0">

				<?php while ( have_posts() ) { the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) { comments_template(); }

					}
				?>
				
			</div>
        </div><!-- /.container -->
    </section><!-- /.section-content -->



<?php
get_footer();
