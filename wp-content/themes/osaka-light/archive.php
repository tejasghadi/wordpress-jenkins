<?php
/**
 * The template for displaying archive pages
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
