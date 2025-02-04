<?php

/**
 * Excerpt
 *
 * @package wedding_ceremony
 */

$wp_customize->add_section(
	'wedding_ceremony_excerpt_options',
	array(
		'panel' => 'wedding_ceremony_theme_options',
		'title' => esc_html__( 'Excerpt', 'wedding-ceremony' ),
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'wedding_ceremony_excerpt_length',
	array(
		'default'           => 20,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'wedding-ceremony' ),
		'section'     => 'wedding_ceremony_excerpt_options',
		'settings'    => 'wedding_ceremony_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 1,
		),
	)
);