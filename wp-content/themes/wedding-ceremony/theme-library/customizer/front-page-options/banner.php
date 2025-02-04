<?php

/**
 * Banner Section
 *
 * @package wedding_ceremony
 */

$wp_customize->add_section(
	'wedding_ceremony_banner_section',
	array(
		'panel'    => 'wedding_ceremony_front_page_options',
		'title'    => esc_html__( 'Banner Section', 'wedding-ceremony' ),
		'priority' => 10,
	)
);

// Banner Section - Enable Section.
$wp_customize->add_setting(
	'wedding_ceremony_enable_banner_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_banner_section',
		array(
			'label'    => esc_html__( 'Enable Banner Section', 'wedding-ceremony' ),
			'section'  => 'wedding_ceremony_banner_section',
			'settings' => 'wedding_ceremony_enable_banner_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'wedding_ceremony_enable_banner_section',
		array(
			'selector' => '#wedding_ceremony_banner_section .section-link',
			'settings' => 'wedding_ceremony_enable_banner_section',
		)
	);
}

// Banner Section - Banner Slider Content Type.
$wp_customize->add_setting(
	'wedding_ceremony_banner_slider_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'wedding_ceremony_sanitize_select',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_banner_slider_content_type',
	array(
		'label'           => esc_html__( 'Select Banner Slider Content Type', 'wedding-ceremony' ),
		'section'         => 'wedding_ceremony_banner_section',
		'settings'        => 'wedding_ceremony_banner_slider_content_type',
		'type'            => 'select',
		'active_callback' => 'wedding_ceremony_is_banner_slider_section_enabled',
		'choices'         => array(
			'page' => esc_html__( 'Page', 'wedding-ceremony' ),
			'post' => esc_html__( 'Post', 'wedding-ceremony' ),
		),
	)
);

// Banner Slider Category Setting.
$wp_customize->add_setting('wedding_ceremony_banner_slider_category', array(
	'default'           => 'slider',
	'sanitize_callback' => 'sanitize_text_field',
));

// Add custom control for Banner Slider Category with conditional visibility.
$wp_customize->add_control(new Wedding_Ceremony_Customize_Category_Dropdown_Control($wp_customize, 'wedding_ceremony_banner_slider_category', array(
	'label'    => __('Select Banner Category', 'wedding-ceremony'),
	'section'  => 'wedding_ceremony_banner_section',
	'settings' => 'wedding_ceremony_banner_slider_category',
	'active_callback' => function() use ($wp_customize) {
		return $wp_customize->get_setting('wedding_ceremony_banner_slider_content_type')->value() === 'post';
	},
)));

for ( $wedding_ceremony_i = 1; $wedding_ceremony_i <= 3; $wedding_ceremony_i++ ) {

	// Banner Section - Select Banner Post.
	$wp_customize->add_setting(
		'wedding_ceremony_banner_slider_content_post_' . $wedding_ceremony_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_banner_slider_content_post_' . $wedding_ceremony_i,
		array(
			/* translators: %d: Select Post Count. */
			'label'           => sprintf( esc_html__( 'Select Post %d', 'wedding-ceremony' ), $wedding_ceremony_i ),
			'description'     => sprintf( esc_html__( 'Kindly :- Select a Post based on the category selected in the upper settings', 'wedding-ceremony' ), $wedding_ceremony_i ),
			'section'         => 'wedding_ceremony_banner_section',
			'settings'        => 'wedding_ceremony_banner_slider_content_post_' . $wedding_ceremony_i,
			'active_callback' => 'wedding_ceremony_is_banner_slider_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => wedding_ceremony_get_post_choices(),
		)
	);

	// Banner Section - Select Banner Page.
	$wp_customize->add_setting(
		'wedding_ceremony_banner_slider_content_page_' . $wedding_ceremony_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_banner_slider_content_page_' . $wedding_ceremony_i,
		array(
			/* translators: %d: Select Page Count. */
			'label'           => sprintf( esc_html__( 'Select Page %d', 'wedding-ceremony' ), $wedding_ceremony_i ),
			'section'         => 'wedding_ceremony_banner_section',
			'settings'        => 'wedding_ceremony_banner_slider_content_page_' . $wedding_ceremony_i,
			'active_callback' => 'wedding_ceremony_is_banner_slider_section_and_content_type_page_enabled',
			'type'            => 'select',
			'choices'         => wedding_ceremony_get_page_choices(),
		)
	);

	// Banner Section - Button Label.
	$wp_customize->add_setting(
		'wedding_ceremony_banner_button_label_' . $wedding_ceremony_i,
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_banner_button_label_' . $wedding_ceremony_i,
		array(
			/* translators: %d: Button Label Count. */
			'label'           => sprintf( esc_html__( 'Button Label %d', 'wedding-ceremony' ), $wedding_ceremony_i ),
			'section'         => 'wedding_ceremony_banner_section',
			'settings'        => 'wedding_ceremony_banner_button_label_' . $wedding_ceremony_i,
			'type'            => 'text',
			'active_callback' => 'wedding_ceremony_is_banner_slider_section_enabled',
		)
	);

	// Banner Section - Button Link.
	$wp_customize->add_setting(
		'wedding_ceremony_banner_button_link_' . $wedding_ceremony_i,
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'wedding_ceremony_banner_button_link_' . $wedding_ceremony_i,
		array(
			/* translators: %d: Button Link Count. */
			'label'           => sprintf( esc_html__( 'Button Link %d', 'wedding-ceremony' ), $wedding_ceremony_i ),
			'section'         => 'wedding_ceremony_banner_section',
			'settings'        => 'wedding_ceremony_banner_button_link_' . $wedding_ceremony_i,
			'type'            => 'url',
			'active_callback' => 'wedding_ceremony_is_banner_slider_section_enabled',
		)
	);
}

$wp_customize->add_setting('wedding_ceremony_banner_section_custom_image', array(
    'default'           => '',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field', // Sanitization callback function
));
// Image control 1
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wedding_ceremony_banner_section_custom_image', array(
    'label'    => __('Custom Image 1', 'wedding-ceremony'),
    'section'  => 'wedding_ceremony_banner_section',
    'settings' => 'wedding_ceremony_banner_section_custom_image',
	'active_callback' => 'wedding_ceremony_is_banner_slider_section_enabled',
)));