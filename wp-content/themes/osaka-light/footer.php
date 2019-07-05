<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Osaka
 */
global $osaka_light_options;
$copyright = wp_kses_post($osaka_light_options['copyright_text']);
?>

    <footer class="site-footer black-bg">
        <div class="container">
            <div class="content">

                <?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>

                    <div class="footer-top">
                        <div class="row">

                            <div class="col-lg-9">

                                <?php dynamic_sidebar( 'footer-sidebar' ); ?>

                            </div>

                            <div class="col-lg-3">
                                <?php osaka_light_footer_social(); ?>                            
                            </div>

                        </div>
                    </div><!-- /.footer-top -->

                <?php } ?>

                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="copy-right float-left">                                
                                <?php osaka_light_copyrights_text();?>
                            </div><!-- /.copy-right -->
                        </div>
                        
                        <div class="col-lg-6 text-right">                                    
                            <?php osaka_light_footer_links_menu();?>
                        </div>
                        
                    </div><!-- /.row -->
                </div><!-- /.footer-bottom -->
                
            </div><!-- /.content -->
        </div><!-- /.container -->
    </footer><!-- /.site-footer -->

    <?php wp_footer(); ?>

</body>
</html>