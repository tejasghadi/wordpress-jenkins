<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Osaka
 */

get_header();
?>

    <section class="section-content">
        <div class="container">
            <div class="content">
				<div class="blog-posts text-center">
					
					<?php if ( have_posts() ) { while ( have_posts() ) { the_post();
							
							get_template_part( 'template-parts/content');

						} } else {

    						get_template_part( 'template-parts/content', 'none' );

    					}?>

					</div><!-- /.blog-posts -->
    				
                    <?php echo function_exists('osaka_light_pagination') ? esc_html( osaka_light_pagination() ) : esc_html( posts_nav_link() ); ?>

            </div><!-- /.content -->
        </div><!-- /.container -->
    </section><!-- /.section-content -->



<?php
get_footer();
