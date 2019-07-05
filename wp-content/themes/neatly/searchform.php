<?php
defined( 'ABSPATH' ) || exit;
/**
 * Template for displaying search forms in Neatly
 *
 * @package WordPress
 * @subpackage Neatly
 */

?>
<?php $unique_id = esc_attr( uniqid( 'search-form-' ) );
?>

<form role="search" method="get" class="search_form" action="<?php echo esc_url( home_url( '/' ) ); ?>"<?php if ( class_exists('YAHMAN_ADDONS_AMP') ){ ?> target="_blank"<?php } ?>>
	<input type="search" id="<?php echo esc_attr($unique_id); ?>" class="search_field" placeholder="<?php esc_attr_e( 'Search', 'neatly' ) ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search_submit"><span class="fa-search"></span></button>
</form>

