<?php

function osaka_light_theme_options(){
    $GLOBALS['osaka_light_options'] = osaka_light_get_theme_options();    
}

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Osaka
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function osaka_light_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'osaka_light_body_classes' );



/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function osaka_light_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'osaka_light_pingback_header' );





/**
 * Returns Custom Blog Posts Pagination
 * @author ProWPTheme
 * @since v1.0.0
 */

if(!( function_exists('osaka_light_pagination') )){
	function osaka_light_pagination($pages = '', $range = 2){
		$showitems = ($range * 1)+1;

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}

		if(1 != $pages){
			echo '<div class="post-navigation">';

				if($paged > 1 && $paged > $range+1 && $showitems < $pages){
					echo '<a href="' . esc_attr( get_pagenum_link(1) ) . '" aria-label="Previous" class="float-left"> ' . esc_html__('Older Posts', 'osaka-light') . '</a>';
				}

				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
					echo '<a href="' . esc_attr( get_pagenum_link($pages) ) . '" class="float-right">' . esc_html__('Newest Posts', 'osaka-light') . ' </a>';
				}


				echo "</div>";
		}
	}
}




function osaka_light_read_more(){
    global $osaka_light_options;

	?>
		<a href="<?php esc_url( the_permalink() );?>" class="btn">            
            <?php echo esc_html( $osaka_light_options['read_more'] );?>
        </a>
<?php }



// Excerpt More
function osaka_light_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'osaka_light_excerpt_more' );


// Excerpt Length
function osaka_light_excerpt_length( $length ) {
    global $osaka_light_options;
    return $osaka_light_options['excerpt_length'];
}
add_filter( 'excerpt_length', 'osaka_light_excerpt_length', 999 );


// Osaka Sidebar
function osaka_light_sidebar(){?>
    <div class="col-md-3">
        <?php if ( is_active_sidebar( 'footer-sidebar' ) ) {
            dynamic_sidebar('footer-sidebar');
        }?>
    </div>
<?php }


/*===================================================================================
 * Osaka Comments
 * =================================================================================*/

if(!function_exists('osaka_light_comment')){

    function osaka_light_comment($comment, $args, $depth){

        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

        <p><?php esc_html('Pingback:','osaka-light');?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'osaka-light' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
        break;
        default :

        global $post;
        ?>

        <li <?php comment_class('comment media'); ?> id="li-comment-<?php comment_ID(); ?>">

                <?php echo get_avatar( $comment, 90, null, null, array( 'class' => array( 'rounded-circle' ) ) ); ?>

                <div class="comment-details media-body">
                    
                    <h4 class="name">
                    	<a href="<?php esc_url( comment_author_link() ); ?>">
                    		<?php esc_html( comment_author() ); ?>                    			
                    	</a>
                    </h4>

                    <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) );?>">
                    	<?php echo get_the_date('M j, Y'); ?> <?php echo esc_html__('at','osaka-light');?> <?php echo esc_html( get_comment_time() ); ?>                    		
                    </time>

                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'osaka-light' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

                    <p>
                    	<?php esc_attr( comment_text() ); ?>
                    </p>	
                    
                </div><!--/.comment-body-->


            <?php
            break;
            endswitch;
        }

}


// Add Class on Comment Reply Link
add_filter('comment_reply_link', 'osaka_light_comments_reply_link_class');

function osaka_light_comments_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='btn", $class);
    return $class;
}



function osaka_light_header_banner(){ 
    global $post, $page;
    
    $image_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'osaka-light-portfolio-single' ) );

    if( is_singular( array( 'post' ) )) { ?>

    <section class="page-header style-01 background-bg" data-image-src="<?php echo esc_url_raw( $image_url );?>">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-texts text-left">
                            <h2 class="header-title">
                                <?php echo esc_html( get_the_title() ); ?>
                            </h2>
                        </div><!-- /.header-texts -->
                    </div>
                    
                    <div class="col-lg-6">                        
                        <?php osaka_light_breadcrumbs(); ?>
                    </div>
                </div>
            </div><!-- /.container -->
        </div><!-- /.overlay -->
    </section><!-- /.page-header -->

<?php } }





function osaka_light_brand_logo(){ ?>


            <?php 
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                
                if( has_custom_logo() ){
                    echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) .'"><img src="'. esc_url( $logo[0] ) . '" alt="' . esc_attr( get_bloginfo('name') ) . '"></a>';
                } else{ ?>
                    <div class="d-flex flex-column">
                        <a class="navbar-brand hidden-xs site-title p-2" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_html(bloginfo( 'name' )); ?> - <?php esc_html(bloginfo( 'description' )); ?>">
                            <?php esc_html(bloginfo( 'name' )); ?>
                        </a>
                        <p class="site-description p-2">
                            <?php esc_html(bloginfo( 'description' )); ?>                            
                        </p>                    
                    </div>
                <?php }
            ?>

    
    <?php
}



// Custom Admin Logo Login
if(!function_exists('osaka_light_admin_logo_login')){
    function osaka_light_admin_logo_login(){
        $admin_custom_logo_id = get_theme_mod( 'custom_logo' );
        $admin_logo = wp_get_attachment_image_src( $admin_custom_logo_id , 'full' );

        if( has_custom_logo() ){ ?>

                <style type="text/css">
                   .login h1 a {
                        background-image: url("<?php echo esc_url( $admin_logo[0] );?>") !important;
                        background-position: center center !important;
                        background-size: contain !important;
                        height: inherit !important;
                        width: 100% !important;
                        font-size: inherit !important;
                    }
                </style>

            <?php } else { ?>

                <style type="text/css">
                    .login h1 a {
                        background-image: url('<?php echo esc_url_raw( admin_url('/images/wordpress-logo.png') );?>');
                    }
                </style>

            <?php }
        }
        add_action( 'login_enqueue_scripts', 'osaka_light_admin_logo_login' );
}






// Copyright Text
function osaka_light_copyrights_text(){
    global $osaka_light_options;

    $copyright_text = $osaka_light_options['copyright_text'];

    if(!empty($copyright_text)){
        echo wp_kses_post( $copyright_text );
    } elseif (is_home()  || is_front_page() || is_page()) {
        echo '<span>'. esc_html__( 'Developed by','osaka-light') . ' <a href="' . esc_url( 'https://prowptheme.com/themes/osaka-gutenberg-wordpress-theme/', 'osaka-light' ) . '" target="_blank" rel="nofollow">' . esc_html__('ProWPTheme','osaka-light') . '</a></span>';
    } else {

        echo '<span>' . esc_html__( 'Developed by ProWPTheme','osaka-light') . '</span>';

    }

}



// Footer Socials
function osaka_light_footer_social(){
    global $osaka_light_options;

    echo '<div class="footer-social">';

        if(isset($osaka_light_options['facebook']) && trim($osaka_light_options['facebook'])!="" ) { ?>
            <a href="<?php echo esc_url_raw($osaka_light_options['facebook']);?>" target="_blank"><i class="ti-facebook"></i></a>
        <?php } if(isset($osaka_light_options['skype']) && trim($osaka_light_options['skype'])!="") { ?>
            <a href="<?php echo esc_url_raw($osaka_light_options['skype']);?>" target="_blank"><i class="ti-skype"></i></a>
        <?php } if(isset($osaka_light_options['twitter']) && trim($osaka_light_options['twitter'])!="") { ?>
            <a href="<?php echo esc_url_raw($osaka_light_options['twitter']);?>" target="_blank"><i class="ti-twitter"></i></a>
        <?php } if(isset($osaka_light_options['vimeo']) && trim($osaka_light_options['vimeo'])!="") { ?>
            <a href="<?php echo esc_url_raw($osaka_light_options['vimeo']);?>" target="_blank"><i class="ti-vimeo"></i></a>
        <?php } if(isset($osaka_light_options['dribbble']) && trim($osaka_light_options['dribbble'])!="") { ?>
            <a href="<?php echo esc_url_raw($osaka_light_options['dribbble']);?>" target="_blank"><i class="ti-dribbble"></i></a>
        <?php } if(isset($osaka_light_options['instagram']) && trim($osaka_light_options['instagram'])!="") { ?>
            <a href="<?php echo esc_url_raw($osaka_light_options['instagram']);?>" target="_blank"><i class="ti-instagram"></i></a>
        <?php }

    echo '</div><!-- /.footer-social -->';

}


function osaka_light_footer_links_menu(){
    if ( is_active_sidebar( 'footer-menu' ) ) {
        dynamic_sidebar('footer-menu');
    }    
}






//404 Block
function osaka_light_404_page(){
    global $osaka_light_options;
    ?>

        <section id="error-banner" class="error-banner text-center">
            <div class="section-padding">
                <div class="banner-text">
                    <div class="text-center ">
                        <h2 class="error-title">
                            <?php if (isset($osaka_light_options['settings_404_title'])) {
                                echo esc_html( $osaka_light_options['settings_404_title'] );
                            } else {
                                echo esc_html__('404', 'osaka-light' );
                            } ?>
                        </h2><!-- /.error-title -->
                    </div><!-- /.section-top -->

                    <div class="section-border">
                        <div class="border-style">
                            <span></span>
                        </div><!-- /.border-style -->
                    </div><!-- /.section-border -->

                    <h2 class="error-sub-title">
                        <?php if (isset($osaka_light_options['settings_404_heading'])){
                            echo esc_html( $osaka_light_options['settings_404_heading'] );
                        } else{
                            echo esc_html__('Page Not Found', 'osaka-light' );
                        }
                        ?>
                    </h2><!-- /.sub-title -->
                  <div class="btn-container">
                    <a href="<?php echo esc_url( home_url( '/' ));?>" class="btn">
                        <?php echo esc_html__('Back to Home', 'osaka-light');?>
                    </a>
                  </div><!-- /.btn-container -->

                </div><!-- /.banner-text -->
            </div>

        </section><!-- /#error-banner -->


<?php }