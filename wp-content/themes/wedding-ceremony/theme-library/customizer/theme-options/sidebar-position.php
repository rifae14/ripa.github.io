<?php

/**
 * Sidebar Position
 *
 * @package wedding_ceremony
 */

$wp_customize->add_section(
	'wedding_ceremony_sidebar_position',
	array(
		'title' => esc_html__( 'Sidebar Position', 'wedding-ceremony' ),
		'panel' => 'wedding_ceremony_theme_options',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_global_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_global_sidebar_separator', array(
	'label' => __( 'Global Sidebar Position', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_sidebar_position',
	'settings' => 'wedding_ceremony_global_sidebar_separator',
)));


// Sidebar Position - Global Sidebar Position.
$wp_customize->add_setting(
	'wedding_ceremony_sidebar_position',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'wedding-ceremony' ),
		'section' => 'wedding_ceremony_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'wedding-ceremony' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'wedding-ceremony' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'wedding-ceremony' ),
		),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_post_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_post_sidebar_separator', array(
	'label' => __( 'Post Sidebar Position', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_sidebar_position',
	'settings' => 'wedding_ceremony_post_sidebar_separator',
)));

// Sidebar Position - Post Sidebar Position.
$wp_customize->add_setting(
	'wedding_ceremony_post_sidebar_position',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'wedding-ceremony' ),
		'section' => 'wedding_ceremony_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'wedding-ceremony' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'wedding-ceremony' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'wedding-ceremony' ),
		),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_page_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_page_sidebar_separator', array(
	'label' => __( 'Page Sidebar Position', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_sidebar_position',
	'settings' => 'wedding_ceremony_page_sidebar_separator',
)));

// Sidebar Position - Page Sidebar Position.
$wp_customize->add_setting(
	'wedding_ceremony_page_sidebar_position',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'wedding-ceremony' ),
		'section' => 'wedding_ceremony_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'wedding-ceremony' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'wedding-ceremony' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'wedding-ceremony' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_sidebar_width_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_sidebar_width_separator', array(
	'label' => __( 'Sidebar Width Setting', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_sidebar_position',
	'settings' => 'wedding_ceremony_sidebar_width_separator',
)));


$wp_customize->add_setting( 'wedding_ceremony_sidebar_width', array(
	'default'           => '30',
	'sanitize_callback' => 'wedding_ceremony_sanitize_range_value',
) );

$wp_customize->add_control(new Wedding_Ceremony_Customize_Range_Control($wp_customize, 'wedding_ceremony_sidebar_width', array(
	'section'     => 'wedding_ceremony_sidebar_position',
	'label'       => __( 'Adjust Sidebar Width', 'wedding-ceremony' ),
	'description' => __( 'Adjust the width of the sidebar.', 'wedding-ceremony' ),
	'input_attrs' => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
)));

$wp_customize->add_setting( 'wedding_ceremony_sidebar_widget_font_size', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'wedding_ceremony_sidebar_widget_font_size', array(
    'type'        => 'number',
    'section'     => 'wedding_ceremony_sidebar_position',
    'label'       => __( 'Sidebar Widgets Heading Font Size ', 'wedding-ceremony' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));