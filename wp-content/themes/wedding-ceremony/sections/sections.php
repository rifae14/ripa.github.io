<?php

/**
 * Render homepage sections.
 */
function wedding_ceremony_homepage_sections() {
	$wedding_ceremony_homepage_sections = array_keys( wedding_ceremony_get_homepage_sections() );

	foreach ( $wedding_ceremony_homepage_sections as $wedding_ceremony_section ) {
		require get_template_directory() . '/sections/' . $wedding_ceremony_section . '.php';
	}
}