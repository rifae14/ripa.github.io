<?php
require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function wedding_ceremony_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'wedding-ceremony' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'wedding_ceremony_register_recommended_plugins_set' );