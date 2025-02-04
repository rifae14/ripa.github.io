<?php

function wedding_ceremony_sanitize_select( $wedding_ceremony_input, $wedding_ceremony_setting ) {
	$wedding_ceremony_input = sanitize_key( $wedding_ceremony_input );
	$wedding_ceremony_choices = $wedding_ceremony_setting->manager->get_control( $wedding_ceremony_setting->id )->choices;
	return ( array_key_exists( $wedding_ceremony_input, $wedding_ceremony_choices ) ? $wedding_ceremony_input : $wedding_ceremony_setting->default );
}

function wedding_ceremony_sanitize_switch( $wedding_ceremony_input ) {
	if ( true === $wedding_ceremony_input ) {
		return true;
	} else {
		return false;
	}
}

function wedding_ceremony_sanitize_google_fonts( $wedding_ceremony_input, $wedding_ceremony_setting ) {
	$wedding_ceremony_choices = $wedding_ceremony_setting->manager->get_control( $wedding_ceremony_setting->id )->choices;
	return ( array_key_exists( $wedding_ceremony_input, $wedding_ceremony_choices ) ? $wedding_ceremony_input : $wedding_ceremony_setting->default );
}

/**
 * Sanitize HTML input.
 *
 * @param string $wedding_ceremony_input HTML input to sanitize.
 * @return string Sanitized HTML.
 */
function wedding_ceremony_sanitize_html( $wedding_ceremony_input ) {
    return wp_kses_post( $wedding_ceremony_input );
}

/**
 * Sanitize URL input.
 *
 * @param string $wedding_ceremony_input URL input to sanitize.
 * @return string Sanitized URL.
 */
function wedding_ceremony_sanitize_url( $wedding_ceremony_input ) {
    return esc_url_raw( $wedding_ceremony_input );
}

// Sanitize Scroll Top Position
function wedding_ceremony_sanitize_scroll_top_position( $wedding_ceremony_input ) {
    $wedding_ceremony_valid_positions = array( 'bottom-right', 'bottom-left', 'bottom-center' );
    if ( in_array( $wedding_ceremony_input, $wedding_ceremony_valid_positions ) ) {
        return $wedding_ceremony_input;
    } else {
        return 'bottom-right'; // Default to bottom-right if invalid value
    }
}

function wedding_ceremony_sanitize_choices( $wedding_ceremony_input, $wedding_ceremony_setting ) {
	global $wp_customize; 
	$control = $wp_customize->get_control( $wedding_ceremony_setting->id ); 
	if ( array_key_exists( $wedding_ceremony_input, $control->choices ) ) {
		return $wedding_ceremony_input;
	} else {
		return $wedding_ceremony_setting->default;
	}
}

function wedding_ceremony_sanitize_range_value( $wedding_ceremony_number, $wedding_ceremony_setting ) {

	// Ensure input is an absolute integer.
	$wedding_ceremony_number = absint( $wedding_ceremony_number );

	// Get the input attributes associated with the setting.
	$wedding_ceremony_atts = $wedding_ceremony_setting->manager->get_control( $wedding_ceremony_setting->id )->input_attrs;

	// Get minimum number in the range.
	$wedding_ceremony_min = ( isset( $wedding_ceremony_atts['min'] ) ? $wedding_ceremony_atts['min'] : $wedding_ceremony_number );

	// Get maximum number in the range.
	$wedding_ceremony_max = ( isset( $wedding_ceremony_atts['max'] ) ? $wedding_ceremony_atts['max'] : $wedding_ceremony_number );

	// Get step.
	$wedding_ceremony_step = ( isset( $wedding_ceremony_atts['step'] ) ? $wedding_ceremony_atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $wedding_ceremony_min <= $wedding_ceremony_number && $wedding_ceremony_number <= $wedding_ceremony_max && is_int( $wedding_ceremony_number / $wedding_ceremony_step ) ? $wedding_ceremony_number : $wedding_ceremony_setting->default );
}