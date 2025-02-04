<?php

/**
 * Header Options
 *
 * @package wedding_ceremony
 */


// ---------------------------------------- GENERAL OPTIONBS ----------------------------------------------------


// ---------------------------------------- PRELOADER ----------------------------------------------------\

$wp_customize->add_section(
	'wedding_ceremony_general_options',
	array(
		'panel' => 'wedding_ceremony_theme_options',
		'title' => esc_html__( 'General Options', 'wedding-ceremony' ),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_preloader_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_preloader_separator', array(
	'label' => __( 'Enable / Disable Site Preloader Section', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_general_options',
	'settings' => 'wedding_ceremony_preloader_separator',
) ) );

// General Options - Enable Preloader.
$wp_customize->add_setting(
	'wedding_ceremony_enable_preloader',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_preloader',
		array(
			'label'   => esc_html__( 'Enable Preloader', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_general_options',
		)
	)
);

// Preloader Style Setting
$wp_customize->add_setting(
    'wedding_ceremony_preloader_style',
    array(
        'default'           => 'style1',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'wedding_ceremony_preloader_style',
    array(
        'type'     => 'select',
        'label'    => esc_html__('Select Preloader Styles', 'wedding-ceremony'),
		'active_callback' => 'wedding_ceremony_is_preloader_style',
        'section'  => 'wedding_ceremony_general_options',
        'choices'  => array(
            'style1' => esc_html__('Style 1', 'wedding-ceremony'),
            'style2' => esc_html__('Style 2', 'wedding-ceremony'),
            'style3' => esc_html__('Style 3', 'wedding-ceremony'),
        ),
    )
);


// ---------------------------------------- PAGINATION ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_pagination_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_pagination_separator', array(
	'label' => __( 'Enable / Disable Pagination Section', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_general_options',
	'settings' => 'wedding_ceremony_pagination_separator',
) ) );


// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'wedding_ceremony_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'wedding-ceremony' ),
			'section'  => 'wedding_ceremony_general_options',
			'settings' => 'wedding_ceremony_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'wedding_ceremony_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'wedding_ceremony_sanitize_select',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'wedding-ceremony' ),
		'section'         => 'wedding_ceremony_general_options',
		'settings'        => 'wedding_ceremony_pagination_type',
		'active_callback' => 'wedding_ceremony_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'wedding-ceremony' ),
			'numeric' => __( 'Numeric', 'wedding-ceremony' ),
		),
	)
);


// ---------------------------------------- BREADCRUMB ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_breadcrumb_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_breadcrumb_separators', array(
	'label' => __( 'Enable / Disable Breadcrumb Section', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_general_options',
	'settings' => 'wedding_ceremony_breadcrumb_separators',
)));



// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'wedding_ceremony_enable_breadcrumb',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_general_options',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'wedding_ceremony_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'wedding-ceremony' ),
		'active_callback' => 'wedding_ceremony_is_breadcrumb_enabled',
		'section'         => 'wedding_ceremony_general_options',
	)
);



// ---------------------------------------- Website layout ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_layuout_separator', array(
	'label' => __( 'Website Layout Setting', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_general_options',
	'settings' => 'wedding_ceremony_layuout_separator',
)));


$wp_customize->add_setting(
	'wedding_ceremony_website_layout',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_website_layout',
		array(
			'label'   => esc_html__('Boxed Layout', 'wedding-ceremony'),
			'section' => 'wedding_ceremony_general_options',
		)
	)
);


$wp_customize->add_setting('wedding_ceremony_layout_width_margin', array(
	'default'           => 50,
	'sanitize_callback' => 'absint', // Sanitize as an integer
	'transport'         => 'postMessage', // Enable live preview
));

$wp_customize->add_control(new WP_Customize_Control(
	$wp_customize,
	'wedding_ceremony_layout_width_margin',
	array(
		'label'       => __('Set Width', 'wedding-ceremony'),
		'description' => __('Adjust the width around the website layout by moving the slider. Use this setting to customize the appearance of your site to fit your design preferences.', 'wedding-ceremony'),
		'section'     => 'wedding_ceremony_general_options',
		'settings'    => 'wedding_ceremony_layout_width_margin',
		'type'        => 'range',
		'active_callback' => 'wedding_ceremony_is_layout_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 130,
			'step' => 1,
		),
	)
));


// ---------------------------------------- HEADER OPTIONS ----------------------------------------------------


// Header Options
$wp_customize->add_section(
	'wedding_ceremony_header_options',
	array(
		'panel' => 'wedding_ceremony_theme_options',
		'title' => esc_html__( 'Header Options', 'wedding-ceremony' ),
	)
);


// Add setting for sticky header
$wp_customize->add_setting(
	'wedding_ceremony_enable_sticky_header',
	array(
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
		'default'           => false,
	)
);

// Add control for sticky header setting
$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_sticky_header',
		array(
			'label'   => esc_html__( 'Enable Sticky Header', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_header_options',
		)
	)
);

// Banner Section - Enable Section.
$wp_customize->add_setting(
	'wedding_ceremony_enable_header_search_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_header_search_section',
		array(
			'label'    => esc_html__( 'Enable Search Section', 'wedding-ceremony' ),
			'section'  => 'wedding_ceremony_header_options',
			'settings' => 'wedding_ceremony_enable_header_search_section',
		)
	)
);

// Banner Section - Button Label.
$wp_customize->add_setting(
	'wedding_ceremony_header_button_label_',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_header_button_label_',
	array(
		'label'           => esc_html__( 'Button Label', 'wedding-ceremony'  ),
		'section'         => 'wedding_ceremony_header_options',
		'settings'        => 'wedding_ceremony_header_button_label_',
		'type'            => 'text',
	)
);

// Banner Section - Button Link.
$wp_customize->add_setting(
	'wedding_ceremony_banner_button_link_',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_banner_button_link_',
	array(
		'label'           => esc_html__( 'Button Link', 'wedding-ceremony' ),
		'section'         => 'wedding_ceremony_header_options',
		'settings'        => 'wedding_ceremony_banner_button_link_',
		'type'            => 'url',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_menu_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_menu_separator', array(
	'label' => __( 'Menu Settings', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_header_options',
	'settings' => 'wedding_ceremony_menu_separator',
)));

$wp_customize->add_setting( 'wedding_ceremony_menu_font_size', array(
    'default'           => 15,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'wedding_ceremony_menu_font_size', array(
    'type'        => 'number',
    'section'     => 'wedding_ceremony_header_options',
    'label'       => __( 'Menu Font Size ', 'wedding-ceremony' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));

$wp_customize->add_setting( 'wedding_ceremony_menu_text_transform', array(
    'default'           => 'capitalize', 
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for menu text transform
$wp_customize->add_control( 'wedding_ceremony_menu_text_transform', array(
    'type'     => 'select',
    'section'  => 'wedding_ceremony_header_options',
    'label'    => __( 'Menu Text Transform', 'wedding-ceremony' ),
    'choices'  => array(
        'none'       => __( 'None', 'wedding-ceremony' ),
        'capitalize' => __( 'Capitalize', 'wedding-ceremony' ),
        'uppercase'  => __( 'Uppercase', 'wedding-ceremony' ),
        'lowercase'  => __( 'Lowercase', 'wedding-ceremony' ),
    ),
) );




// ----------------------------------------SITE IDENTITY----------------------------------------------------


// Site Logo - Enable Setting.
$wp_customize->add_setting(
	'wedding_ceremony_enable_site_logo',
	array(
		'default'           => false, // Default is to display the logo.
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch', // Sanitize using a custom switch function.
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_site_logo',
		array(
			'label'    => esc_html__( 'Enable Site Logo', 'wedding-ceremony' ),
			'section'  => 'title_tagline', // Section to add this control.
			'settings' => 'wedding_ceremony_enable_site_logo',
		)
	)
);

// Site Title - Enable Setting.
$wp_customize->add_setting(
	'wedding_ceremony_enable_site_title_setting',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_site_title_setting',
		array(
			'label'    => esc_html__( 'Enable Site Title', 'wedding-ceremony' ),
			'section'  => 'title_tagline',
			'settings' => 'wedding_ceremony_enable_site_title_setting',
		)
	)
);

// Tagline - Enable Setting.
$wp_customize->add_setting(
	'wedding_ceremony_enable_tagline_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_enable_tagline_setting',
		array(
			'label'    => esc_html__( 'Enable Tagline', 'wedding-ceremony' ),
			'section'  => 'title_tagline',
			'settings' => 'wedding_ceremony_enable_tagline_setting',
		)
	)
);	

$wp_customize->add_setting( 'wedding_ceremony_site_title_size', array(
    'default'           => 30, // Default font size in pixels
    'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
) );

// Add control for site title size
$wp_customize->add_control( 'wedding_ceremony_site_title_size', array(
    'type'        => 'number',
    'section'     => 'title_tagline', // You can change this section to your preferred section
    'label'       => __( 'Site Title Font Size ', 'wedding-ceremony' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
) );

$wp_customize->add_setting('wedding_ceremony_site_logo_width', array(
    'default'           => 200,
    'sanitize_callback' => 'wedding_ceremony_sanitize_range_value',
));

$wp_customize->add_control(new Wedding_Ceremony_Customize_Range_Control($wp_customize, 'wedding_ceremony_site_logo_width', array(
    'label'       => __('Adjust Site Logo Width', 'wedding-ceremony'),
    'description' => __('This setting controls the Width of Site Logo', 'wedding-ceremony'),
    'section'     => 'title_tagline',
    'settings'    => 'wedding_ceremony_site_logo_width',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 400,
        'step' => 5,
    ),
)));