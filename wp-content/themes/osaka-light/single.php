<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Osaka
 */

get_header();
?>

	<section class="section-content">
        <div class="container">
            <div class="content">
            	<div class="blog-single">

					<?php while ( have_posts() ) { the_post();

						get_template_part( 'template-parts/content', 'single' );

						the_post_navigation();

						get_template_part( 'template-parts/author','bio' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						}
					?>

                </div><!-- /.blog-single -->
            </div><!-- /.content -->
        </div><!-- /.container -->
    </section><!-- /.section-content -->


<?php
get_footer();
