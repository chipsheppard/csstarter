<?php
/**
 * Customizer functions.
 *
 * @package  CsStarter
 * @subpackage csstarter/inc/customizer
 * @author   Chip Sheppard
 * @since    1.2.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * A wrapper function to get our settings.
 *
 * @since 1.3.40
 *
 * @param string $setting The option name to look up.
 * @return string The option value.
 * @todo Ability to specify different option name and defaults.
 */
function csstarter_get_setting( $setting ) {
	$defaults = csstarter_get_defaults();

	if ( ! isset( $defaults[ $setting ] ) ) {
		return;
	}

	$csstarter_settings = wp_parse_args(
		get_option( 'csstarter_settings', array() ),
		$defaults
	);
	return $csstarter_settings[ $setting ];
}

/**
 * SIDEBAR LAYOUTS
 * -----------------------------------------------------------------
 *
 * @return string The sidebar layout location.
 */
function csstarter_get_layout() {
	$layout = null;

	// Get Customizer options.
	$csstarter_settings = wp_parse_args(
		get_option( 'csstarter_settings', array() ),
		csstarter_get_defaults()
	);

	// If on Homepage (page.php).
	if ( is_front_page() ) {
		$layout = $csstarter_settings['home_layout_setting'];
	}

	// If on PAGE but not the homepage (page.php).
	if ( ! is_front_page() && ! is_search() && 'page' === get_post_type() ) {
		$layout = $csstarter_settings['page_layout_setting'];
	}

	// If on SINGLE (single.php) - Works for any post type, except attachments and pages.
	if ( is_single() ) {
		$layout = $csstarter_settings['single_layout_setting'];
	}

	// If on SEARCH (search.php).
	if ( is_search() ) {
		$layout = $csstarter_settings['search_layout_setting'];
	}

	// If on ARCHIVE (archive.php), HOME-blog (index.php), 404 (404.php), attachment etc...
	if ( is_home() && ! is_front_page() || is_archive() || is_tax() || is_404() ) {
		$layout = $csstarter_settings['archive_layout_setting'];
	}

	// Return the layout.
	return apply_filters( 'csstarter_sidebar_layout', $layout );
}
add_action( 'csstarter_init', 'csstarter_get_layout' );

/**
 * SIDEBAR Body Classes
 * -----------------------------------------------------------------
 *
 * @param array $classes The body classes.
 */
function csstarter_sidebar_bodyclass( $classes ) {
	$layout = csstarter_get_layout();
	if ( 'layout-ls' === $layout ) :
		$classes[] = 'sidebar-left';
	elseif ( 'layout-rs' === $layout ) :
		$classes[] = 'sidebar-right';
	elseif ( 'layout-c' === $layout ) :
		$classes[] = 'nosidebar-silo';
	endif;
	return $classes;
}
add_filter( 'body_class', 'csstarter_sidebar_bodyclass' );

/**
 * SIDEBAR LEFT ------------------------
 * If layout is left sidebar...
 */
function csstarter_get_left_sidebar() {
	$layout = csstarter_get_layout();
	if ( 'layout-ls' !== $layout ) :
		return;
	endif;
	get_sidebar();
}
add_action( 'tha_content_before', 'csstarter_get_left_sidebar' );

/**
 * SIDEBAR RIGHT ----------------------
 * If layout is right sidebar...
 */
function csstarter_get_right_sidebar() {
	$layout = csstarter_get_layout();
	if ( 'layout-rs' !== $layout ) :
		return;
	endif;
	get_sidebar();
}
add_action( 'tha_content_after', 'csstarter_get_right_sidebar' );
