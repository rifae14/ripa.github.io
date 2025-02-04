<?php

/**
 * Color Option
 *
 * @package wedding_ceremony
 */

// Primary Color.
$wp_customize->add_setting(
	'primary_color',
	array(
		'default'           => '#295F98',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'primary_color',
		array(
			'label'    => __( 'Primary Color', 'wedding-ceremony' ),
			'section'  => 'colors',
			'priority' => 5,
		)
	)
);
