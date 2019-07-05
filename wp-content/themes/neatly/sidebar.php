<?php
defined( 'ABSPATH' ) || exit;
if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside id="sidebar" class="sidebar f_box f_col101">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
<?php endif;/*end sidebar*/
