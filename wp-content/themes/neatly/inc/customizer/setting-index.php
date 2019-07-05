<?php
defined( 'ABSPATH' ) || exit;
/**
 * Index Settings
 *
 * @package Neatly
 */

/*Neatly サムネイルのサイズ*/
$wp_customize->add_section('index_thumbnail_sections',array(
	'title' => esc_html__('Thumbnail','neatly'),
	'panel' => 'index_panel',
));
$wp_customize->add_setting( 'neatly_index_thum_size', array(
  'default'           => 'large',
  'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_index_thum_size', array(
  'label'    => esc_html__( 'Original size of thumbnail', 'neatly' ),
  'section'  => 'index_thumbnail_sections',
  'type'     => 'select',
  'choices'  => array(
    'thumbnail' => esc_html__( 'Thumbnail', 'neatly' ),
    'medium' => esc_html__( 'Medium', 'neatly' ),
    'large' => esc_html__( 'Large', 'neatly' ),
    'full' => esc_html__( 'Full', 'neatly' ),
  ),
));

/*Neatly INDEXのウェイジェット*/
$wp_customize->add_section('index_widget_sections',array(
	'title' => esc_html__('Widget','neatly'),
	'panel' => 'index_panel',
));

$wp_customize->add_setting( 'neatly_index_widget', array(
	'default'           => 'after',
	'sanitize_callback' => 'neatly_sanitize_radio',
));
$wp_customize->add_control( 'neatly_index_widget', array(
	'label'    => esc_html__( 'How to Insert Index list widget area', 'neatly' ),
	'section'  => 'index_widget_sections',
	'type'     => 'radio',
	'choices'  => array(
		'after' => esc_html__( 'Just after post', 'neatly' ),
		'every' => esc_html__( 'Every post', 'neatly' ),
	),
));

$wp_customize->add_setting( 'neatly_index_widget_num', array(
	'default' => 3,
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control( 'neatly_index_widget_num', array(
	'label' => esc_html__( 'Count of post for above configuring', 'neatly' ),
    'section' => 'index_widget_sections', // Add a default or your own section
    'type' => 'number',
    'input_attrs' => array(
    	'min' => 1, 'step' => 1, 'max' => 10,
    ),
));






