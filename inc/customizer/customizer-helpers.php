<?php
/**
 * Helper functions for the Customizer.
 *
 * @package  CsStarter
 * @subpackage csstarter/inc/customizer
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Controls.
// require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-csstarter-alpha-color-control.php';.
// require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-csstarter-range-control.php';.
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-csstarter-radio-image-control.php';
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-csstarter-content-area.php';

// Color Palette.
if ( ! function_exists( 'csstarter_get_default_color_palettes' ) ) {
	/**
	 * Set up our colors for the color picker palettes and filter them so you can change them.
	 *
	 * @since 0.1
	 */
	function csstarter_get_default_color_palettes() {
		$palettes = array(
			'#000000',
			'#ffffff',
			'#b22222', // FireBrick.
			'#ff8c00', // DarkOrange.
			'#eee8aa', // PaleGoldenrod.
			'#008000', // Green.
			'#4169e1', // RoyalBlue.
			'#9932cc', // DarkOrchid.
		);
		return apply_filters( 'csstarter_default_color_palettes', $palettes );
	}
}

if ( ! function_exists( 'csstarter_enqueue_color_palettes' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'csstarter_enqueue_color_palettes' );
	/**
	 * Add our custom color palettes to the color pickers in the Customizer.
	 */
	function csstarter_enqueue_color_palettes() {
		// Old versions of WP don't get nice things.
		if ( ! function_exists( 'wp_add_inline_script' ) ) :
			return;
		endif;

		// Grab our palette array and turn it into JS.
		$palettes = wp_json_encode( csstarter_get_default_color_palettes() );

		// Add our custom palettes
		// json_encode takes care of escaping.
		wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $palettes . ';' );
	}
}

if ( ! function_exists( 'csstarter_sanitize_integer' ) ) {
	/**
	 * Sanitize integers.
	 *
	 * @param Int $input number.
	 */
	function csstarter_sanitize_integer( $input ) {
		return absint( $input );
	}
}

if ( ! function_exists( 'csstarter_sanitize_checkbox' ) ) {
	/**
	 * Sanitize checkbox values.
	 *
	 * @param Bool $checked True or False.
	 */
	function csstarter_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
}

if ( ! function_exists( 'csstarter_sanitize_choices' ) ) {
	/**
	 * Sanitize choices.
	 *
	 * @param String $input number.
	 * @param String $setting number.
	 */
	function csstarter_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}


if ( ! function_exists( 'csstarter_sanitize_rgba' ) ) {
	/**
	 * Sanitize RGBA colors.
	 *
	 * @param String $color number.
	 */
	function csstarter_sanitize_rgba( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// If string does not start with 'rgba', then treat as hex.
		// sanitize the hex color and finally convert hex to rgba.
		if ( false === strpos( $color, 'rgba' ) ) {
			return sanitize_hex_color( $color );
		}

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba( ' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ' )';
	}
}
