<?php

/**
 * About Section
 *
 * @package wedding_ceremony
 */

	$wp_customize->add_section(
		'wedding_ceremony_about_section',
		array(
			'panel'    => 'wedding_ceremony_front_page_options',
			'title'    => esc_html__( 'About Section', 'wedding-ceremony' ),
			'priority' => 10,
		)
	);

	// About Section - Enable Section.
	$wp_customize->add_setting(
		'wedding_ceremony_enable_about_section',
		array(
			'default'           => true,
			'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
		)
	);

	$wp_customize->add_control(
		new Wedding_Ceremony_Toggle_Switch_Custom_Control(
			$wp_customize,
			'wedding_ceremony_enable_about_section',
			array(
				'label'    => esc_html__( 'Enable About Section', 'wedding-ceremony' ),
				'section'  => 'wedding_ceremony_about_section',
				'settings' => 'wedding_ceremony_enable_about_section',
			)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'wedding_ceremony_enable_about_section',
			array(
				'selector' => '#wedding_ceremony_about_section .section-link',
				'settings' => 'wedding_ceremony_enable_about_section',
			)
		);
	}

	// About Section - About Content Type.
	$wp_customize->add_setting(
		'wedding_ceremony_about_content_type',
		array(
			'default'           => 'post',
			'sanitize_callback' => 'wedding_ceremony_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_about_content_type',
		array(
			'label'           => esc_html__( 'Select About Content Type', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_about_content_type',
			'type'            => 'select',
			'active_callback' => 'wedding_ceremony_is_about_section_enabled',
			'choices'         => array(
				'page' => esc_html__( 'Page', 'wedding-ceremony' ),
				'post' => esc_html__( 'Post', 'wedding-ceremony' ),
			),
		)
	);

	// Service Section - Select Post.
	$wp_customize->add_setting(
		'wedding_ceremony_about_content_post_',
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_about_content_post_',
		array(
			'label'           => esc_html__( 'Select Post ', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_about_content_post_',
			'active_callback' => 'wedding_ceremony_is_about_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => wedding_ceremony_get_post_choices(),
		)
	);
	// About Section - Select About Page.
	$wp_customize->add_setting(
		'wedding_ceremony_about_content_page_',
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_about_content_page_',
		array(
			'label'           => esc_html__( 'Select Page', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_about_content_page_',
			'active_callback' => 'wedding_ceremony_is_about_section_and_content_type_page_enabled',
			'type'            => 'select',
			'choices'         => wedding_ceremony_get_page_choices(),
		)
	);

	// About Section - About Small Heading.
	$wp_customize->add_setting(
		'wedding_ceremony_about_us_left_heading',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_about_us_left_heading',
		array(
			'label'           => esc_html__( 'About Small Heading', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_about_us_left_heading',
			'type'            => 'text',
			'active_callback' => 'wedding_ceremony_is_about_section_enabled',
		)
	);

	// About Section - About Small Text.
	$wp_customize->add_setting(
		'wedding_ceremony_about_us_left_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_about_us_left_text',
		array(
			'label'           => esc_html__( 'About Small Text', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_about_us_left_text',
			'type'            => 'text',
			'active_callback' => 'wedding_ceremony_is_about_section_enabled',
		)
	);

	// About Section - Additional Title Label.
	$wp_customize->add_setting(
		'wedding_ceremony_additional_text_',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_additional_text_',
		array(
			'label'           => esc_html__( 'Additional Title', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_additional_text_',
			'type'            => 'text',
			'active_callback' => 'wedding_ceremony_is_about_section_enabled',
		)
	);

	// About Section - Button Label.
	$wp_customize->add_setting(
		'wedding_ceremony_about_button_label_',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_about_button_label_',
		array(
			'label'           => esc_html__( 'Button Label', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_about_button_label_',
			'type'            => 'text',
			'active_callback' => 'wedding_ceremony_is_about_section_enabled',
		)
	);

	// About Section - Button Link.
	$wp_customize->add_setting(
		'wedding_ceremony_about_button_link_',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_about_button_link_',
		array(
			'label'           => esc_html__( 'Button Link', 'wedding-ceremony' ),
			'section'         => 'wedding_ceremony_about_section',
			'settings'        => 'wedding_ceremony_about_button_link_',
			'type'            => 'url',
			'active_callback' => 'wedding_ceremony_is_about_section_enabled',
		)
	);

	// Image setting 1
	$wp_customize->add_setting('wedding_ceremony_custom_image_setting_3', array(
	    'default'           => '',
	    'transport'         => 'refresh',
	    'sanitize_callback' => 'esc_url_raw', // Sanitization callback function
	));

	// Image control 1
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_image_setting_control_3', array(
	    'label'    => __('Custom Image 1', 'wedding-ceremony'),
	    'section'  => 'wedding_ceremony_about_section',
	    'settings' => 'wedding_ceremony_custom_image_setting_3',
		'active_callback' => 'wedding_ceremony_is_about_section_enabled',
	)));


	$wp_customize->add_setting('wedding_ceremony_custom_image_setting_4', array(
	    'default'           => '',
	    'transport'         => 'refresh',
	    'sanitize_callback' => 'esc_url_raw', // Sanitization callback function
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wedding_ceremony_custom_image_setting_4_control', array(
	    'label' => __('Custom Image 2', 'wedding-ceremony'),
	    'section' => 'wedding_ceremony_about_section',
	    'settings' => 'wedding_ceremony_custom_image_setting_4',
		'active_callback' => 'wedding_ceremony_is_about_section_enabled',
	)));