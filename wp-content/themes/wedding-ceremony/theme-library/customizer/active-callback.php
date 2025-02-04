<?php

/**
 * Active Callbacks
 *
 * @package wedding_ceremony
 */

// Theme Options.
function wedding_ceremony_is_pagination_enabled( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_enable_pagination' )->value() );
}
function wedding_ceremony_is_breadcrumb_enabled( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_enable_breadcrumb' )->value() );
}
function wedding_ceremony_is_layout_enabled( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_website_layout' )->value() );
}
function wedding_ceremony_is_pagetitle_bcakground_image_enabled( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_page_header_style' )->value() );
}
function wedding_ceremony_is_preloader_style( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_enable_preloader' )->value() );
}

// Header Options.
function wedding_ceremony_is_topbar_enabled( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_Setting( 'wedding_ceremony_enable_topbar' )->value() );
}

// Banner Slider Section.
function wedding_ceremony_is_banner_slider_section_enabled( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_enable_banner_section' )->value() );
}
function wedding_ceremony_is_banner_slider_section_and_content_type_post_enabled( $wedding_ceremony_control ) {
	$content_type = $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_banner_slider_content_type' )->value();
	return ( wedding_ceremony_is_banner_slider_section_enabled( $wedding_ceremony_control ) && ( 'post' === $content_type ) );
}
function wedding_ceremony_is_banner_slider_section_and_content_type_page_enabled( $wedding_ceremony_control ) {
	$content_type = $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_banner_slider_content_type' )->value();
	return ( wedding_ceremony_is_banner_slider_section_enabled( $wedding_ceremony_control ) && ( 'page' === $content_type ) );
}

//About section.
function wedding_ceremony_is_about_section_enabled( $wedding_ceremony_control ) {
	return ( $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_enable_about_section' )->value() );
}
function wedding_ceremony_is_about_section_and_content_type_post_enabled( $wedding_ceremony_control ) {
	$content_type = $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_about_content_type' )->value();
	return ( wedding_ceremony_is_about_section_enabled( $wedding_ceremony_control ) && ( 'post' === $content_type ) );
}
function wedding_ceremony_is_about_section_and_content_type_page_enabled( $wedding_ceremony_control ) {
	$content_type = $wedding_ceremony_control->manager->get_setting( 'wedding_ceremony_about_content_type' )->value();
	return ( wedding_ceremony_is_about_section_enabled( $wedding_ceremony_control ) && ( 'page' === $content_type ) );
}