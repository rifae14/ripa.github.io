<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package wedding_ceremony
 */

function wedding_ceremony_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'wedding_ceremony_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1360,
		'height'                 => 110,
		'flex-width'         	=> true,
        'flex-height'        	=> true,
		'wp-head-callback'       => 'wedding_ceremony_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'wedding_ceremony_custom_header_setup' );

if ( ! function_exists( 'wedding_ceremony_header_style' ) ) :

add_action( 'wp_enqueue_scripts', 'wedding_ceremony_header_style' );
function wedding_ceremony_header_style() {
	if ( get_header_image() ) :
	$wedding_ceremony_custom_css = "
        .bottom-header-outer-wrapper{
			background-image:url('".esc_url(get_header_image())."') !important;
			background-position: center top;
		}";
	   	wp_add_inline_style( 'wedding-ceremony-style', $wedding_ceremony_custom_css );
	endif;
}
endif;