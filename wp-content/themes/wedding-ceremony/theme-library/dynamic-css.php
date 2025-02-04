<?php

/**
 * Dynamic CSS
 */
function wedding_ceremony_dynamic_css() {
	$wedding_ceremony_primary_color = get_theme_mod( 'primary_color', '#295F98' );

	$wedding_ceremony_site_title_font       = get_theme_mod( 'wedding_ceremony_site_title_font', 'Raleway' );
	$wedding_ceremony_site_description_font = get_theme_mod( 'wedding_ceremony_site_description_font', 'Raleway' );
	$wedding_ceremony_header_font           = get_theme_mod( 'wedding_ceremony_header_font', 'Nanum Myeongjo' );
	$wedding_ceremony_content_font             = get_theme_mod( 'wedding_ceremony_content_font', 'Wix Madefor Display' );

	// Enqueue Google Fonts
	$fonts_url = wedding_ceremony_get_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'wedding-ceremony-google-fonts', esc_url( $fonts_url ), array(), null );
	}

	$wedding_ceremony_custom_css  = '';
	$wedding_ceremony_custom_css .= '
    /* Color */
    :root {
        --primary-color: ' . esc_attr( $wedding_ceremony_primary_color ) . ';
        --header-text-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
    }
    ';

	$wedding_ceremony_custom_css .= '
    /* Typography */
    :root {
        --font-heading: "' . esc_attr( $wedding_ceremony_header_font ) . '", serif;
        --font-main: -apple-system, BlinkMacSystemFont, "' . esc_attr( $wedding_ceremony_content_font ) . '", "Segoe UI",Nunito, Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }

    body,
	button, input, select, optgroup, textarea, p {
        font-family: "' . esc_attr( $wedding_ceremony_content_font ) . '", serif;
	}

	.site-identity p.site-title, h1.site-title a, h1.site-title, p.site-title a, .site-branding h1.site-title a {
        font-family: "' . esc_attr( $wedding_ceremony_site_title_font ) . '", serif;
	}
    
	p.site-description {
        font-family: "' . esc_attr( $wedding_ceremony_site_description_font ) . '", serif !important;
	}
    ';

	wp_add_inline_style( 'wedding-ceremony-style', $wedding_ceremony_custom_css );
}
add_action( 'wp_enqueue_scripts', 'wedding_ceremony_dynamic_css', 99 );