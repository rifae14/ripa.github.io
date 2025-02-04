<?php

/**
 * Footer Options
 *
 * @package wedding_ceremony
 */

$wp_customize->add_section(
	'wedding_ceremony_footer_options',
	array(
		'panel' => 'wedding_ceremony_theme_options',
		'title' => esc_html__( 'Footer Options', 'wedding-ceremony' ),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_footer_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_footer_separators', array(
	'label' => __( 'Footer Settings', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_footer_options',
	'settings' => 'wedding_ceremony_footer_separators',
)));

	// column // 
$wp_customize->add_setting(
	'wedding_ceremony_footer_widget_column',
	array(
        'default'			=> '4',
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'wedding_ceremony_sanitize_select',
		
	)
);	

$wp_customize->add_control(
	'wedding_ceremony_footer_widget_column',
	array(
	    'label'   		=> __('Select Footer Widget Column','wedding-ceremony'),
		'description' => __('Note: Default footer widgets are shown. Add your preferred widgets in (Appearance > Widgets > Footer) to see changes.', 'wedding-ceremony'),
	    'section' 		=> 'wedding_ceremony_footer_options',
		'type'			=> 'select',
		'choices'        => 
		array(
			'' => __( 'None', 'wedding-ceremony' ),
			'1' => __( '1 Column', 'wedding-ceremony' ),
			'2' => __( '2 Column', 'wedding-ceremony' ),
			'3' => __( '3 Column', 'wedding-ceremony' ),
			'4' => __( '4 Column', 'wedding-ceremony' )
		) 
	) 
);

//  BG Color // 
$wp_customize->add_setting('wedding_ceremony_footer_background_color_setting', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wedding_ceremony_footer_background_color_setting', array(
    'label' => __('Footer Background Color', 'wedding-ceremony'),
    'section' => 'wedding_ceremony_footer_options',
)));

// Footer Background Image Setting
$wp_customize->add_setting('wedding_ceremony_footer_background_image_setting', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wedding_ceremony_footer_background_image_setting', array(
    'label' => __('Footer Background Image', 'wedding-ceremony'),
    'section' => 'wedding_ceremony_footer_options',
)));


$wp_customize->add_setting('footer_text_transform', array(
    'default' => 'capitalize',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add Footer Heading Text Transform Control
$wp_customize->add_control('footer_text_transform', array(
    'label' => __('Footer Heading Text Transform', 'wedding-ceremony'),
    'section' => 'wedding_ceremony_footer_options',
    'settings' => 'footer_text_transform',
    'type' => 'select',
    'choices' => array(
        'none' => __('None', 'wedding-ceremony'),
        'capitalize' => __('Capitalize', 'wedding-ceremony'),
        'uppercase' => __('Uppercase', 'wedding-ceremony'),
        'lowercase' => __('Lowercase', 'wedding-ceremony'),
    ),
));


$wp_customize->add_setting(
	'wedding_ceremony_footer_copyright_text',
	array(
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_footer_copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'wedding-ceremony' ),
		'section'  => 'wedding_ceremony_footer_options',
		'settings' => 'wedding_ceremony_footer_copyright_text',
		'type'     => 'textarea',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_scroll_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_scroll_separators', array(
	'label' => __( 'Scroll Top Settings', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_footer_options',
	'settings' => 'wedding_ceremony_scroll_separators',
)));

// Footer Options - Scroll Top.
$wp_customize->add_setting(
	'wedding_ceremony_scroll_top',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_scroll_top',
		array(
			'label'   => esc_html__( 'Enable Scroll Top Button', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_footer_options',
		)
	)
);
// icon // 
$wp_customize->add_setting(
	'wedding_ceremony_scroll_btn_icon',
	array(
        'default' => 'fas fa-chevron-up',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Wedding_Ceremony_Change_Icon_Control($wp_customize, 
	'wedding_ceremony_scroll_btn_icon',
	array(
	    'label'   		=> __('Scroll Top Icon','wedding-ceremony'),
	    'section' 		=> 'wedding_ceremony_footer_options',
		'iconset' => 'fa',
	))  
);
$wp_customize->add_setting( 'wedding_ceremony_scroll_top_position', array(
    'default'           => 'bottom-right',
    'sanitize_callback' => 'wedding_ceremony_sanitize_scroll_top_position',
) );

// Add control for Scroll Top Button Position
$wp_customize->add_control( 'wedding_ceremony_scroll_top_position', array(
    'label'    => __( 'Scroll Top Button Position', 'wedding-ceremony' ),
    'section'  => 'wedding_ceremony_footer_options',
    'settings' => 'wedding_ceremony_scroll_top_position',
    'type'     => 'select',
    'choices'  => array(
        'bottom-right' => __( 'Bottom Right', 'wedding-ceremony' ),
        'bottom-left'  => __( 'Bottom Left', 'wedding-ceremony' ),
        'bottom-center'=> __( 'Bottom Center', 'wedding-ceremony' ),
    ),
) );

$wp_customize->add_setting( 'wedding_ceremony_scroll_top_shape', array(
    'default'           => 'box',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'wedding_ceremony_scroll_top_shape', array(
    'label'    => __( 'Scroll to Top Button Shape', 'wedding-ceremony' ),
    'section'  => 'wedding_ceremony_footer_options',
    'settings' => 'wedding_ceremony_scroll_top_shape',
    'type'     => 'radio',
    'choices'  => array(
        'box'        => __( 'Box', 'wedding-ceremony' ),
        'curved-box' => __( 'Curved Box', 'wedding-ceremony' ),
        'circle'     => __( 'Circle', 'wedding-ceremony' ),
    ),
) );