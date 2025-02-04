<?php

/**
 * Front Page Options
 *
 * @package Wedding Ceremony
 */

$wp_customize->add_panel(
	'wedding_ceremony_front_page_options',
	array(
		'title'    => esc_html__( 'Front Page Options', 'wedding-ceremony' ),
		'priority' => 20,
	)
);

// Banner Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/banner.php';

// Tranding Product Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/about.php';