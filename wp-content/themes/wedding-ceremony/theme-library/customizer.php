<?php

/**
 * Wedding Ceremony Theme Customizer
 *
 * @package wedding_ceremony
 */

// Sanitize callback.
require get_template_directory() . '/theme-library/customizer/sanitize-callback.php';

// Active Callback.
require get_template_directory() . '/theme-library/customizer/active-callback.php';

// Custom Controls.
require get_template_directory() . '/theme-library/customizer/custom-controls/custom-controls.php';

// Icon Controls.
require get_template_directory() . '/theme-library/customizer/custom-controls/icon-control.php';

function wedding_ceremony_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wedding_ceremony_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wedding_ceremony_customize_partial_blogdescription',
			)
		);
	}

	// Upsell Section.
	$wp_customize->add_section(
		new Wedding_Ceremony_Upsell_Section(
			$wp_customize,
			'upsell_section',
			array(
				'title'            => __( 'Wedding Ceremony Pro', 'wedding-ceremony' ),
				'button_text'      => __( 'Buy Pro', 'wedding-ceremony' ),
				'url'              => 'https://asterthemes.com/products/ceremony-wordpress-theme',
				'background_color' => '#295F98',
				'text_color'       => '#fff',
				'priority'         => 0,
			)
		)
	);

	// Doc Section.
	$wp_customize->add_section(
		new Wedding_Ceremony_Upsell_Section(
			$wp_customize,
			'doc_section',
			array(
				'title'            => __( 'Documentation', 'wedding-ceremony' ),
				'button_text'      => __( 'Free Doc', 'wedding-ceremony' ),
				'url'              => 'https://demo.asterthemes.com/docs/wedding-ceremony-free',
				'background_color' => '#295F98',
				'text_color'       => '#fff',
				'priority'         => 1,
			)
		)
	);

	// Theme Options.
	require get_template_directory() . '/theme-library/customizer/theme-options.php';

	// Front Page Options.
	require get_template_directory() . '/theme-library/customizer/front-page-options.php';

	// Colors.
	require get_template_directory() . '/theme-library/customizer/colors.php';

}
add_action( 'customize_register', 'wedding_ceremony_customize_register' );

function wedding_ceremony_customize_partial_blogname() {
	bloginfo( 'name' );
}

function wedding_ceremony_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function wedding_ceremony_customize_preview_js() {
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'wedding-ceremony-customizer', get_template_directory_uri() . '/resource/js/customizer' . $min . '.js', array( 'customize-preview' ), WEDDING_CEREMONY_VERSION, true );
}
add_action( 'customize_preview_init', 'wedding_ceremony_customize_preview_js' );

function wedding_ceremony_custom_control_scripts() {
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'wedding-ceremony-custom-controls-css', get_template_directory_uri() . '/resource/css/custom-controls' . $min . '.css', array(), '1.0', 'all' );

	wp_enqueue_script( 'wedding-ceremony-custom-controls-js', get_template_directory_uri() . '/resource/js/custom-controls' . $min . '.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'wedding_ceremony_custom_control_scripts' );
