<?php

/**
 * WooCommerce Settings
 *
 * @package wedding_ceremony
 */

$wp_customize->add_section(
	'wedding_ceremony_woocommerce_settings',
	array(
		'panel' => 'wedding_ceremony_theme_options',
		'title' => esc_html__( 'WooCommerce Settings', 'wedding-ceremony' ),
	)
);

//WooCommerce - Products per page.
$wp_customize->add_setting( 'wedding_ceremony_products_per_page', array(
    'default'           => 9,
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control( 'wedding_ceremony_products_per_page', array(
    'type'        => 'number',
    'section'     => 'wedding_ceremony_woocommerce_settings',
    'label'       => __( 'Products Per Page', 'wedding-ceremony' ),
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
));

//WooCommerce - Products per row.
$wp_customize->add_setting( 'wedding_ceremony_products_per_row', array(
    'default'           => '3',
    'sanitize_callback' => 'wedding_ceremony_sanitize_choices',
) );

$wp_customize->add_control( 'wedding_ceremony_products_per_row', array(
    'label'    => __( 'Products Per Row', 'wedding-ceremony' ),
    'section'  => 'wedding_ceremony_woocommerce_settings',
    'settings' => 'wedding_ceremony_products_per_row',
    'type'     => 'select',
    'choices'  => array(
        '2' => '2',
		'3' => '3',
		'4' => '4',
    ),
) );

//WooCommerce - Show / Hide Related Product.
$wp_customize->add_setting(
	'wedding_ceremony_related_product_show_hide',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_ceremony_sanitize_switch',
	)
);

$wp_customize->add_control(
	new wedding_ceremony_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_ceremony_related_product_show_hide',
		array(
			'label'   => esc_html__( 'Show / Hide Related product', 'wedding-ceremony' ),
			'section' => 'wedding_ceremony_woocommerce_settings',
		)
	)
);



