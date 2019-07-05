<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif;

wp_head();

?>
</head>
<body <?php body_class(); ?> ontouchstart="">
	<?php wp_body_open(); ?>
	<header id="h_wrap" class="h_wrap f_box f_col w100">

		<div class="wrap_frame w100 f_box f_col">
			<input type="checkbox" id="mh" class="dn" />
			<div class="h_top<?php if ( !has_nav_menu( 'primary' ) ) echo ' no_menu'; ?> f_box ai_c jc_sb f_col100 w100">
				<div class="f_box ai_c jc_c100 w100 posi_re">
					<div class="f_box ai_c jc_c100 w100">
						<div class="h_logo_wrap">
							<div class="h_logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="f_box ai_c jc_c100" rel="home">
									<?php neatly_header_logo_icon(); ?>
									<?php neatly_header_logo_title(); ?>
								</a>

							</div>
							<?php if(get_theme_mod( 'neatly_tagline_display',true)): ?>
								<div class="description fs12 sub_fc">
									<?php echo get_bloginfo('description' , 'display'); ?>
								</div>
							<?php endif; ?>
						</div>
						<?php
						if ( has_nav_menu( 'primary' ) ) : ?>

							<div class="mh posi_ab right0">
								<label for="mh" id="toggle-menu" class="m0"><span class="fa-bars fs24"></span></label>
							</div>

						<?php endif; ?>

					</div>
				</div>
				<?php neatly_header_widget(); ?>
			</div>
			<?php neatly_primary_menu(); ?>

		</div>
	</header>
