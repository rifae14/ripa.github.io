<?php

/**
 * Single Post Options
 *
 * @package wedding_ceremony
 */

$wp_customize->add_section(
	'wedding_ceremony_single_post_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'wedding-ceremony' ),
		'panel' => 'wedding_ceremony_theme_options',
	)
);


// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'wedding_ceremony_single_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_single_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_single_post_options',
		)
	)
);

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'wedding_ceremony_single_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_single_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_single_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'wedding_ceremony_single_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_single_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_single_post_options',
		)
	)
);

// Post Options - Show / Hide Tag.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_tags',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_tags',
		array(
			'label'   => esc_html__( 'Show / Hide Tag', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_single_post_options',
		)
	)
);



// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_related_post_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_related_post_separator', array(
	'label' => __( 'Enable / Disable Related Post Section', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_single_post_options',
	'settings' => 'wedding_ceremony_related_post_separator',
) ) );

// Post Options - Show / Hide Related Posts.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_related_posts',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_related_posts',
		array(
			'label'   => esc_html__( 'Show / Hide Related Posts', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_single_post_options',
		)
	)
);

// Register setting for number of related posts
$wp_customize->add_setting(
    'wedding_ceremony_related_posts_count',
    array(
        'default'           => '',
        'sanitize_callback' => 'absint', // Ensure it's an integer
    )
);

// Add control for number of related posts
$wp_customize->add_control(
    'wedding_ceremony_related_posts_count',
    array(
        'type'        => 'number',
        'label'       => esc_html__( 'Number of Related Posts to Display', 'wedding-ceremony' ),
        'section'     => 'wedding_ceremony_single_post_options',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 5, // Adjust maximum based on your preference
            'step' => 1,
        ),
    )
);

// Post Options - Related Post Label.
$wp_customize->add_setting(
	'wedding_ceremony_post_related_post_label',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_post_related_post_label',
	array(
		'label'    => esc_html__( 'Related Posts Label', 'wedding-ceremony' ),
		'section'  => 'wedding_ceremony_single_post_options',
		'settings' => 'wedding_ceremony_post_related_post_label',
		'type'     => 'text',
	)
);