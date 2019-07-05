<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Osaka
 */

if ( ! is_active_sidebar( 'footer-sidebar' ) ) {
	return;
}

dynamic_sidebar( 'footer-sidebar' );
	