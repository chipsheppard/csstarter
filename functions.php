<?php
/**
 * Main Functions File
 *
 * @package  CsStarter
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Theme data.
define( 'CSSTARTER_VERSION', '1.0.0' );
define( 'CSSTARTER_THEME_NAME', 'CsStarter' );
define( 'CSSTARTER_AUTHOR_NAME', 'Chip Sheppard' );
define( 'CSSTARTER_AUTHOR_LINK', 'https://chipsheppard.com' );

if ( ! function_exists( 'csstarter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function csstarter_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'csstarter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// wp_nav_menu() in 1 location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'csstarter' ),
			)
		);

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// WordPress core custom background feature.
		add_theme_support( 'custom-background',
			apply_filters(
				'csstarter_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 40,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Theme styles for the visual editor.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );

		// Body open hook.
		add_theme_support( 'body-open' );

		// Support 2 Post Formats.
		add_theme_support( 'post-formats', array( 'aside', 'status' ) );

		// Gutenberg.
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );

	}
endif;
add_action( 'after_setup_theme', 'csstarter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function csstarter_content_width() {
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'csstarter_content_width', 640 );
}
add_action( 'after_setup_theme', 'csstarter_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function csstarter_scripts() {
	wp_enqueue_style( 'csstarter-style', get_stylesheet_uri(), array(), CSSTARTER_VERSION );
	wp_enqueue_script( 'csstarter-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), CSSTARTER_VERSION, true );
	wp_enqueue_script( 'csstarter-globaljs', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery' ), CSSTARTER_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$csstarter_settings = wp_parse_args(
		get_option( 'csstarter_settings', array() ),
		csstarter_get_defaults()
	);
	if ( $csstarter_settings['nav_search'] ) {
		wp_enqueue_script( 'csstarter_navsearch_js', get_template_directory_uri() . '/assets/js/csstarter-navsearch-min.js', array(), CSSTARTER_VERSION, true );
	}

}
add_action( 'wp_enqueue_scripts', 'csstarter_scripts' );

/**
 * Enqueue editor styles for the customizer
 */
function csstarter_customizer_custom_css() {
	wp_enqueue_style( 'customizer-css', get_stylesheet_directory_uri() . '/assets/css/customizer.css', array(), CSSTARTER_VERSION );
}
add_action( 'customize_controls_enqueue_scripts', 'csstarter_customizer_custom_css' );

/**
 * Enqueue editor styles for Gutenberg
 */
function csstarter_gutenberg_editor_styles() {
	wp_enqueue_style( 'csstarter_gutenberg-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css', array(), CSSTARTER_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'csstarter_gutenberg_editor_styles' );


// Load all the things.
require get_template_directory() . '/inc/tha-theme-hooks.php';
require get_template_directory() . '/inc/wordpress-cleanup.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/entry-meta.php';
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/loop.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer/defaults.php';
require get_template_directory() . '/inc/customizer/customizer-functions.php';


// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// WooCommerce?
define( 'CSSTARTER_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
if ( CSSTARTER_WOOCOMMERCE_ACTIVE ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
