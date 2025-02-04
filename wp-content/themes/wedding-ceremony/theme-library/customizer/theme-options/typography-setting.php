<?php

/**
 * Typography Settings
 *
 * @package wedding_ceremony
 */

// Typography Settings
$wp_customize->add_section(
    'wedding_ceremony_typography_setting',
    array(
        'panel' => 'wedding_ceremony_theme_options',
        'title' => esc_html__( 'Typography Settings', 'wedding-ceremony' ),
    )
);

$wp_customize->add_setting(
    'wedding_ceremony_site_title_font',
    array(
        'default'           => 'Raleway',
        'sanitize_callback' => 'wedding_ceremony_sanitize_google_fonts',
    )
);

$wp_customize->add_control(
    'wedding_ceremony_site_title_font',
    array(
        'label'    => esc_html__( 'Site Title Font Family', 'wedding-ceremony' ),
        'section'  => 'wedding_ceremony_typography_setting',
        'settings' => 'wedding_ceremony_site_title_font',
        'type'     => 'select',
        'choices'  => wedding_ceremony_get_all_google_font_families(),
    )
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'wedding_ceremony_site_description_font',
	array(
		'default'           => 'Raleway',
		'sanitize_callback' => 'wedding_ceremony_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'wedding-ceremony' ),
		'section'  => 'wedding_ceremony_typography_setting',
		'settings' => 'wedding_ceremony_site_description_font',
		'type'     => 'select',
		'choices'  => wedding_ceremony_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'wedding_ceremony_header_font',
	array(
		'default'           => 'Nanum Myeongjo',
		'sanitize_callback' => 'wedding_ceremony_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_header_font',
	array(
		'label'    => esc_html__( 'Heading Font Family', 'wedding-ceremony' ),
		'section'  => 'wedding_ceremony_typography_setting',
		'settings' => 'wedding_ceremony_header_font',
		'type'     => 'select',
		'choices'  => wedding_ceremony_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'wedding_ceremony_content_font',
	array(
		'default'           => 'Wix Madefor Display',
		'sanitize_callback' => 'wedding_ceremony_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_content_font',
	array(
		'label'    => esc_html__( 'Content Font Family', 'wedding-ceremony' ),
		'section'  => 'wedding_ceremony_typography_setting',
		'settings' => 'wedding_ceremony_content_font',
		'type'     => 'select',
		'choices'  => wedding_ceremony_get_all_google_font_families(),
	)
);