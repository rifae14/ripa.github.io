<?php
function wedding_ceremony_get_all_google_fonts() {
    $wedding_ceremony_webfonts_json = get_template_directory() . '/theme-library/google-webfonts.json';
    if ( ! file_exists( $wedding_ceremony_webfonts_json ) ) {
        return array();
    }

    $wedding_ceremony_fonts_json_data = file_get_contents( $wedding_ceremony_webfonts_json );
    if ( false === $wedding_ceremony_fonts_json_data ) {
        return array();
    }

    $wedding_ceremony_all_fonts = json_decode( $wedding_ceremony_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $wedding_ceremony_google_fonts = array();
    foreach ( $wedding_ceremony_all_fonts as $wedding_ceremony_font ) {
        $wedding_ceremony_google_fonts[ $wedding_ceremony_font['family'] ] = array(
            'family'   => $wedding_ceremony_font['family'],
            'variants' => $wedding_ceremony_font['variants'],
        );
    }
    return $wedding_ceremony_google_fonts;
}


function wedding_ceremony_get_all_google_font_families() {
    $wedding_ceremony_google_fonts  = wedding_ceremony_get_all_google_fonts();
    $wedding_ceremony_font_families = array();
    foreach ( $wedding_ceremony_google_fonts as $wedding_ceremony_font ) {
        $wedding_ceremony_font_families[ $wedding_ceremony_font['family'] ] = $wedding_ceremony_font['family'];
    }
    return $wedding_ceremony_font_families;
}

function wedding_ceremony_get_fonts_url() {
    $wedding_ceremony_fonts_url = '';
    $wedding_ceremony_fonts     = array();

    $wedding_ceremony_all_fonts = wedding_ceremony_get_all_google_fonts();

    if ( ! empty( get_theme_mod( 'wedding_ceremony_site_title_font', 'Raleway' ) ) ) {
        $wedding_ceremony_fonts[] = get_theme_mod( 'wedding_ceremony_site_title_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'wedding_ceremony_site_description_font', 'Raleway' ) ) ) {
        $wedding_ceremony_fonts[] = get_theme_mod( 'wedding_ceremony_site_description_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'wedding_ceremony_header_font', 'Nanum Myeongjo' ) ) ) {
        $wedding_ceremony_fonts[] = get_theme_mod( 'wedding_ceremony_header_font', 'Nanum Myeongjo' );
    }

    if ( ! empty( get_theme_mod( 'wedding_ceremony_content_font', 'Wix Madefor Display' ) ) ) {
        $wedding_ceremony_fonts[] = get_theme_mod( 'wedding_ceremony_content_font', 'Wix Madefor Display' );
    }

    $wedding_ceremony_fonts = array_unique( $wedding_ceremony_fonts );

    foreach ( $wedding_ceremony_fonts as $wedding_ceremony_font ) {
        $wedding_ceremony_variants      = $wedding_ceremony_all_fonts[ $wedding_ceremony_font ]['variants'];
        $wedding_ceremony_font_family[] = $wedding_ceremony_font . ':' . implode( ',', $wedding_ceremony_variants );
    }

    $wedding_ceremony_query_args = array(
        'family' => urlencode( implode( '|', $wedding_ceremony_font_family ) ),
    );

    if ( ! empty( $wedding_ceremony_font_family ) ) {
        $wedding_ceremony_fonts_url = add_query_arg( $wedding_ceremony_query_args, 'https://fonts.googleapis.com/css' );
    }

    return $wedding_ceremony_fonts_url;
}

