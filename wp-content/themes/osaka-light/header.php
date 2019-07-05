<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Osaka
 */
osaka_light_theme_options();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="masthead masthead-02">
        <div class="container">

            <nav class="navbar navbar-expand-md m-0">
                
                <?php osaka_light_brand_logo();?>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>

                <div class="collapse navbar-collapse" id="main-menu">
                    
                    <?php
                        $args = array(
                            'theme_location'    => 'main-menu',
                            'depth'             => 2,
                            'container'         => false,
                            'container'         => '',
                            'container_class'   => '',
                            'menu_class'        => 'nav navbar-nav',
                            'walker'            => new osaka_light_Navwalker(),
                            'fallback_cb'       => 'osaka_light_Navwalker::fallback',
                        );
                      wp_nav_menu($args);
                    ?>

                </div>
            </nav>

        </div><!-- /.container -->
    </header><!-- /.masthead -->




<?php osaka_light_header_banner();?>


