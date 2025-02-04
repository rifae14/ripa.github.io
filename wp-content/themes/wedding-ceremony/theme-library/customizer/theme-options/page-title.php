<?php

/**
 * Pige Title Options
 *
 * @package wedding_ceremony
 */



$wp_customize->add_section(
	'wedding_ceremony_page_title_options',
	array(
		'panel' => 'wedding_ceremony_theme_options',
		'title' => esc_html__( 'Page Title', 'wedding-ceremony' ),
	)
);

$wp_customize->add_setting(
    'wedding_ceremony_page_header_visibility',
    array(
        'default'           => 'all-devices',
        'sanitize_callback' => 'wedding_ceremony_sanitize_select',
    )
);

$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'wedding_ceremony_page_header_visibility',
        array(
            'label'    => esc_html__( 'Page Header Visibility', 'wedding-ceremony' ),
            'type'     => 'select',
            'section'  => 'wedding_ceremony_page_title_options',
            'settings' => 'wedding_ceremony_page_header_visibility',
            'priority' => 10,
            'choices'  => array(
                'all-devices'        => esc_html__( 'Show on all devices', 'wedding-ceremony' ),
                'hide-tablet'        => esc_html__( 'Hide on Tablet', 'wedding-ceremony' ),
                'hide-mobile'        => esc_html__( 'Hide on Mobile', 'wedding-ceremony' ),
                'hide-tablet-mobile' => esc_html__( 'Hide on Tablet & Mobile', 'wedding-ceremony' ),
                'hide-all-devices'   => esc_html__( 'Hide on all devices', 'wedding-ceremony' ),
            ),
        )
    )
);


$wp_customize->add_setting( 'wedding_ceremony_page_title_background_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_page_title_background_separator', array(
	'label' => __( 'Page Title BG Image & Color Setting', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_page_title_options',
	'settings' => 'wedding_ceremony_page_title_background_separator',
)));


$wp_customize->add_setting(
	'wedding_ceremony_page_header_style',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
		'default'           => False,
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_page_header_style',
		array(
			'label'   => esc_html__('Page Title Background Image', 'wedding-ceremony'),
			'section' => 'wedding_ceremony_page_title_options',
		)
	)
);

$wp_customize->add_setting( 'wedding_ceremony_page_header_background_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wedding_ceremony_page_header_background_image', array(
    'label'    => __( 'Background Image', 'wedding-ceremony' ),
    'section'  => 'wedding_ceremony_page_title_options',
	'description' => __('Choose either a background image or a color. If a background image is selected, the background color will not be visible.', 'wedding-ceremony'),
    'settings' => 'wedding_ceremony_page_header_background_image',
	'active_callback' => 'wedding_ceremony_is_pagetitle_bcakground_image_enabled',
)));


$wp_customize->add_setting('wedding_ceremony_page_header_image_height', array(
	'default'           => 200,
	'sanitize_callback' => 'wedding_ceremony_sanitize_range_value',
));

$wp_customize->add_control(new Wedding_Ceremony_Customize_Range_Control($wp_customize, 'wedding_ceremony_page_header_image_height', array(
		'label'       => __('Image Height', 'wedding-ceremony'),
		'section'     => 'wedding_ceremony_page_title_options',
		'settings'    => 'wedding_ceremony_page_header_image_height',
		'active_callback' => 'wedding_ceremony_is_pagetitle_bcakground_image_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 5,
		),
)));


$wp_customize->add_setting('wedding_ceremony_page_title_background_color_setting', array(
    'default' => '#f5f5f5',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wedding_ceremony_page_title_background_color_setting', array(
    'label' => __('Page Title Background Color', 'wedding-ceremony'),
    'section' => 'wedding_ceremony_page_title_options',
)));

$wp_customize->add_setting('wedding_ceremony_pagetitle_height', array(
    'default'           => 50,
    'sanitize_callback' => 'wedding_ceremony_sanitize_range_value',
));

$wp_customize->add_control(new Wedding_Ceremony_Customize_Range_Control($wp_customize, 'wedding_ceremony_pagetitle_height', array(
    'label'       => __('Set Height', 'wedding-ceremony'),
    'description' => __('This setting controls the page title height when no background image is set. If a background image is set, this setting will not apply.', 'wedding-ceremony'),
    'section'     => 'wedding_ceremony_page_title_options',
    'settings'    => 'wedding_ceremony_pagetitle_height',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 300,
        'step' => 5,
    ),
)));


$wp_customize->add_setting( 'wedding_ceremony_page_title_style_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_page_title_style_separator', array(
	'label' => __( 'Page Title Styling Setting', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_page_title_options',
	'settings' => 'wedding_ceremony_page_title_style_separator',
)));


$wp_customize->add_setting( 'wedding_ceremony_page_header_heading_tag', array(
	'default'   => 'h1',
	'sanitize_callback' => 'wedding_ceremony_sanitize_select',
) );

$wp_customize->add_control( 'wedding_ceremony_page_header_heading_tag', array(
	'label'   => __( 'Page Title Heading Tag', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_page_title_options',
	'type'    => 'select',
	'choices' => array(
		'h1' => __( 'H1', 'wedding-ceremony' ),
		'h2' => __( 'H2', 'wedding-ceremony' ),
		'h3' => __( 'H3', 'wedding-ceremony' ),
		'h4' => __( 'H4', 'wedding-ceremony' ),
		'h5' => __( 'H5', 'wedding-ceremony' ),
		'h6' => __( 'H6', 'wedding-ceremony' ),
		'p' => __( 'p', 'wedding-ceremony' ),
		'a' => __( 'a', 'wedding-ceremony' ),
		'div' => __( 'div', 'wedding-ceremony' ),
		'span' => __( 'span', 'wedding-ceremony' ),
	),
) );



$wp_customize->add_setting('wedding_ceremony_page_header_layout', array(
	'default' => 'left',
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('wedding_ceremony_page_header_layout', array(
	'label' => __('Style', 'wedding-ceremony'),
	'section' => 'wedding_ceremony_page_title_options',
	'description' => __('"Flex Layout Style" wont work below 600px (mobile media)', 'wedding-ceremony'),
	'settings' => 'wedding_ceremony_page_header_layout',
	'type' => 'radio',
	'choices' => array(
		'left' => __('Classic', 'wedding-ceremony'),
		'right' => __('Aligned Right', 'wedding-ceremony'),
		'center' => __('Centered Focus', 'wedding-ceremony'),
		'flex' => __('Flex Layout', 'wedding-ceremony'),
	),
));