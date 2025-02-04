<?php

/**
 * Post Options
 *
 * @package wedding_ceremony
 */

$wp_customize->add_section(
	'wedding_ceremony_post_options',
	array(
		'title' => esc_html__( 'Post Options', 'wedding-ceremony' ),
		'panel' => 'wedding_ceremony_theme_options',
	)
);

// Post Options - Show / Hide Feature Image.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_feature_image',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_feature_image',
		array(
			'label'   => esc_html__( 'Show / Hide Featured Image', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_post_options',
		)
	)
);

// Post Options - Show / Hide Post Heading.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_post_heading',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_post_heading',
		array(
			'label'   => esc_html__( 'Show / Hide Post Heading', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_post_options',
		)
	)
);

// Post Options - Show / Hide Post Content.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_post_content',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_post_content',
		array(
			'label'   => esc_html__( 'Show / Hide Post Content', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_post_options',
		)
	)
);

// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_post_options',
		)
	)
);

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'wedding_ceremony_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_post_options',
		)
	)
);

$wp_customize->add_setting('wedding_ceremony_blog_layout_option_setting',array(
	'default' => 'Left',
	'sanitize_callback' => 'wedding_ceremony_sanitize_choices'
  ));
  $wp_customize->add_control(new Wedding_Ceremony_Image_Radio_Control($wp_customize, 'wedding_ceremony_blog_layout_option_setting', array(
	'type' => 'select',
	'label' => __('Blog Content Alignment','wedding-ceremony'),
	'section' => 'wedding_ceremony_post_options',
	'choices' => array(
		'Left' => esc_url(get_template_directory_uri()).'/resource/img/layout-2.png',
		'Default' => esc_url(get_template_directory_uri()).'/resource/img/layout-1.png',
		'Right' => esc_url(get_template_directory_uri()).'/resource/img/layout-3.png',
))));


// ---------------------------------------- Post layout ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_archive_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_archive_layuout_separator', array(
	'label' => __( 'Archive/Blogs Layout Setting', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_post_options',
	'settings' => 'wedding_ceremony_archive_layuout_separator',
)));

// Archive Layout - Column Layout.
$wp_customize->add_setting(
	'wedding_ceremony_archive_column_layout',
	array(
		'default'           => 'column-1',
		'sanitize_callback' => 'wedding_ceremony_sanitize_select',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_archive_column_layout',
	array(
		'label'   => esc_html__( 'Select Posts Layout', 'wedding-ceremony' ),
		'section' => 'wedding_ceremony_post_options',
		'type'    => 'select',
		'choices' => array(
			'column-1' => __( 'Column 1', 'wedding-ceremony' ),
			'column-2' => __( 'Column 2', 'wedding-ceremony' ),
			'column-3' => __( 'Column 3', 'wedding-ceremony' ),
		),
	)
);

$wp_customize->add_setting('wedding_ceremony_blog_layout_option_setting',array(
	'default' => 'Left',
	'sanitize_callback' => 'wedding_ceremony_sanitize_choices'
  ));
  $wp_customize->add_control(new Wedding_Ceremony_Image_Radio_Control($wp_customize, 'wedding_ceremony_blog_layout_option_setting', array(
	'type' => 'select',
	'label' => __('Blog Content Alignment','wedding-ceremony'),
	'section' => 'wedding_ceremony_post_options',
	'choices' => array(
		'Left' => esc_url(get_template_directory_uri()).'/resource/img/layout-2.png',
		'Default' => esc_url(get_template_directory_uri()).'/resource/img/layout-1.png',
		'Right' => esc_url(get_template_directory_uri()).'/resource/img/layout-3.png',
))));


// ---------------------------------------- Read More ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_ceremony_readmore_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Ceremony_Separator_Custom_Control( $wp_customize, 'wedding_ceremony_readmore_separators', array(
	'label' => __( 'Read More Button Settings', 'wedding-ceremony' ),
	'section' => 'wedding_ceremony_post_options',
	'settings' => 'wedding_ceremony_readmore_separators',
)));


// Post Options - Show / Hide Read More Button.
$wp_customize->add_setting(
	'wedding_ceremony_post_readmore_button',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_post_readmore_button',
		array(
			'label'   => esc_html__( 'Show / Hide Read More Button', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_post_options',
		)
	)
);

$wp_customize->add_setting(
    'wedding_ceremony_readmore_btn_icon',
    array(
        'default' => 'fas fa-chevron-right', // Set default icon here
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Wedding_Ceremony_Change_Icon_Control(
    $wp_customize, 
    'wedding_ceremony_readmore_btn_icon',
    array(
        'label'    => __('Read More Icon','wedding-ceremony'),
        'section'  => 'wedding_ceremony_post_options',
        'iconset'  => 'fa',
    )
));

$wp_customize->add_setting(
	'wedding_ceremony_readmore_button_text',
	array(
		'default'           => 'Read More',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'wedding_ceremony_readmore_button_text',
	array(
		'label'           => esc_html__( 'Read More Button Text', 'wedding-ceremony' ),
		'section'         => 'wedding_ceremony_post_options',
		'settings'        => 'wedding_ceremony_readmore_button_text',
		'type'            => 'text',
	)
);