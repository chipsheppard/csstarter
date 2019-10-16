<?php
/**
 * Theme Customizer.
 *
 * @package  CsStarter
 * @subpackage csstarter/inc
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'csstarter_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function csstarter_set_customizer_helpers( $wp_customize ) {
	// Load helpers.
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

add_action( 'customize_register', 'csstarter_customize_register' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function csstarter_customize_register( $wp_customize ) {

	$defaults = csstarter_get_defaults();

	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_control( 'header_textcolor' )->transport = 20;

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'csstarter_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'csstarter_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Render the site title for the selective refresh partial.
	 */
	function csstarter_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 */
	function csstarter_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

	/*
	 * LAYOUTS -------------------------------------------
	 * ----------------------------------------------------------
	 */
	if ( class_exists( 'WP_Customize_Panel' ) ) {
		if ( ! $wp_customize->get_panel( 'csstarter_layout_panel' ) ) {
			$wp_customize->add_panel(
				'csstarter_layout_panel',
				array(
					'title'    => __( 'Layouts', 'csstarter' ),
					'priority' => 30,
				)
			);
		}
	}

	/*
	 * Header Layout -----------------
	 */

	$wp_customize->add_section(
		'csstarter_header_layouts',
		array(
			'title'    => __( 'Header', 'csstarter' ),
			'priority' => 20,
			'panel'    => 'csstarter_layout_panel',
		)
	);

	 // section message.
	 $wp_customize->add_setting(
		 'layout-header-message',
		 array(
			 'sanitize_callback' => 'wp_kses_post',
		 )
	 );
	 $wp_customize->add_control(
		 new Csstarter_Content_Area(
			 $wp_customize,
			 'layout-header-message',
			 array(
				 'label'    => esc_html__( 'Header', 'csstarter' ),
				 'section'  => 'csstarter_header_layouts',
				 'priority' => 10,
			 )
		 )
	 );

	// Header Layout.
	$wp_customize->add_setting(
		'csstarter_settings[header_layout]',
		array(
			'default'           => $defaults['header_layout'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_choices',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Radio_Image_Control(
			$wp_customize,
			'csstarter_settings[header_layout]',
			array(
				'type'        => 'select',
				'label'       => __( 'Logo & Navigation.', 'csstarter' ),
				'description' => __( 'left & right &nbsp; &nbsp; &nbsp;&nbsp; centered', 'csstarter' ),
				'section'     => 'csstarter_header_layouts',
				'choices'     => array(
					'headernormal'   => __( 'headernormal', 'csstarter' ),
					'headercentered' => __( 'headercentered', 'csstarter' ),
				),
				'settings'    => 'csstarter_settings[header_layout]',
				'priority'    => 20,
			)
		)
	);

	/*
	 * Content/Sidebar Layouts - tab -----------------------
	 */
	$wp_customize->add_section(
		'csstarter_page_layouts',
		array(
			'title'    => __( 'Content & Sidebars', 'csstarter' ),
			'priority' => 20,
			'panel'    => 'csstarter_layout_panel',
		)
	);

	// Layout Home.
	$wp_customize->add_setting(
		'csstarter_settings[home_layout_setting]',
		array(
			'default'           => $defaults['home_layout_setting'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Radio_Image_Control(
			$wp_customize,
			'csstarter_settings[home_layout_setting]',
			array(
				'type'        => 'select',
				'label'       => __( 'Homepage Layout', 'csstarter' ),
				'description' => __( 'full width - left side - right side - thin', 'csstarter' ),
				'section'     => 'csstarter_page_layouts',
				'choices'     => array(
					'layout-ns' => __( 'layout-ns', 'csstarter' ),
					'layout-ls' => __( 'layout-ls', 'csstarter' ),
					'layout-rs' => __( 'layout-rs', 'csstarter' ),
					'layout-c'  => __( 'layout-c', 'csstarter' ),
				),
				'settings'    => 'csstarter_settings[home_layout_setting]',
				'priority'    => 30,
			)
		)
	);

	// Layout Pages.
	$wp_customize->add_setting(
		'csstarter_settings[page_layout_setting]',
		array(
			'default'           => $defaults['page_layout_setting'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Radio_Image_Control(
			$wp_customize,
			'csstarter_settings[page_layout_setting]',
			array(
				'type'        => 'select',
				'label'       => __( 'Pages Layout', 'csstarter' ),
				'section'     => 'csstarter_page_layouts',
				'choices'     => array(
					'layout-ns' => __( 'layout-ns', 'csstarter' ),
					'layout-ls' => __( 'layout-ls', 'csstarter' ),
					'layout-rs' => __( 'layout-rs', 'csstarter' ),
					'layout-c'  => __( 'layout-c', 'csstarter' ),
				),
				'settings'    => 'csstarter_settings[page_layout_setting]',
				'priority'    => 40,
			)
		)
	);

	// Layout Single Posts.
	$wp_customize->add_setting(
		'csstarter_settings[single_layout_setting]',
		array(
			'default'           => $defaults['single_layout_setting'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Radio_Image_Control(
			$wp_customize,
			'csstarter_settings[single_layout_setting]',
			array(
				'type'     => 'select',
				'label'    => __( 'Single Post Layout', 'csstarter' ),
				'section'  => 'csstarter_page_layouts',
				'choices'  => array(
					'layout-ns' => __( 'layout-ns', 'csstarter' ),
					'layout-ls' => __( 'layout-ls', 'csstarter' ),
					'layout-rs' => __( 'layout-rs', 'csstarter' ),
					'layout-c'  => __( 'layout-c', 'csstarter' ),
				),
				'settings' => 'csstarter_settings[single_layout_setting]',
				'priority' => 50,
			)
		)
	);

	// Layout Archive, Index & 404.
	$wp_customize->add_setting(
		'csstarter_settings[archive_layout_setting]',
		array(
			'default'           => $defaults['archive_layout_setting'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Radio_Image_Control(
			$wp_customize,
			'csstarter_settings[archive_layout_setting]',
			array(
				'type'     => 'select',
				'label'    => __( 'Archive/Blog Layout', 'csstarter' ),
				'section'  => 'csstarter_page_layouts',
				'choices'  => array(
					'layout-ns' => __( 'layout-ns', 'csstarter' ),
					'layout-ls' => __( 'layout-ls', 'csstarter' ),
					'layout-rs' => __( 'layout-rs', 'csstarter' ),
					'layout-c'  => __( 'layout-c', 'csstarter' ),
				),
				'settings' => 'csstarter_settings[archive_layout_setting]',
				'priority' => 60,
			)
		)
	);

	// Layout Search.
	$wp_customize->add_setting(
		'csstarter_settings[search_layout_setting]',
		array(
			'default'           => $defaults['search_layout_setting'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Radio_Image_Control(
			$wp_customize,
			'csstarter_settings[search_layout_setting]',
			array(
				'type'     => 'select',
				'label'    => __( 'Search Results Layout', 'csstarter' ),
				'section'  => 'csstarter_page_layouts',
				'choices'  => array(
					'layout-ns' => __( 'layout-ns', 'csstarter' ),
					'layout-ls' => __( 'layout-ls', 'csstarter' ),
					'layout-rs' => __( 'layout-rs', 'csstarter' ),
					'layout-c'  => __( 'layout-c', 'csstarter' ),
				),
				'settings' => 'csstarter_settings[search_layout_setting]',
				'priority' => 70,
			)
		)
	);

	/*
	 * THEME OPTIONS ------------------------------------------------------------------------
	 * new tab ------------------------------------------------------------------------------
	 * --------------------------------------------------------------------------------------
	 * --------------------------------------------------------------------------------------
	 */

	// NEW PANEL ------------------------------------------.
	$wp_customize->add_section(
		'csstarter_themeops',
		array(
			'title'    => esc_html__( 'Theme Options', 'csstarter' ),
			'priority' => 70,
		)
	);

	// section message.
	$wp_customize->add_setting(
		'themeops-meta-message',
		array(
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Content_Area(
			$wp_customize,
			'themeops-meta-message',
			array(
				'section'  => 'csstarter_themeops',
				'priority' => 50,
				'label'    => esc_html__( 'Post meta', 'csstarter' ),
			)
		)
	);

	// show footer meta.
	$wp_customize->add_setting(
		'csstarter_settings[meta_footer]',
		array(
			'default'           => $defaults['meta_footer'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'csstarter_settings[meta_footer]',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Show post footer meta data', 'csstarter' ),
			'description' => esc_html__( 'Categories/Tags', 'csstarter' ),
			'section'     => 'csstarter_themeops',
			'settings'    => 'csstarter_settings[meta_footer]',
			'priority'    => 51,
		)
	);

	// section message.
	$wp_customize->add_setting(
		'themeops-metaheader-message',
		array(
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Csstarter_Content_Area(
			$wp_customize,
			'themeops-metaheader-message',
			array(
				'section'  => 'csstarter_themeops',
				'priority' => 52,
				'content'  => esc_html__( 'Show post header meta data.', 'csstarter' ),
			)
		)
	);

	// show meta date.
	$wp_customize->add_setting(
		'csstarter_settings[meta_date]',
		array(
			'default'           => $defaults['meta_date'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'csstarter_settings[meta_date]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Publish Date', 'csstarter' ),
			'section'  => 'csstarter_themeops',
			'settings' => 'csstarter_settings[meta_date]',
			'priority' => 53,
		)
	);

	// show meta author.
	$wp_customize->add_setting(
		'csstarter_settings[meta_author]',
		array(
			'default'           => $defaults['meta_author'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'csstarter_settings[meta_author]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Author', 'csstarter' ),
			'section'  => 'csstarter_themeops',
			'settings' => 'csstarter_settings[meta_author]',
			'priority' => 54,
		)
	);

	// show meta comments.
	$wp_customize->add_setting(
		'csstarter_settings[meta_comments]',
		array(
			'default'           => $defaults['meta_comments'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'csstarter_settings[meta_comments]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Comments', 'csstarter' ),
			'section'  => 'csstarter_themeops',
			'settings' => 'csstarter_settings[meta_comments]',
			'priority' => 55,
		)
	);

	// show meta updated.
	$wp_customize->add_setting(
		'csstarter_settings[meta_updated]',
		array(
			'default'           => $defaults['meta_updated'],
			'type'              => 'option',
			'sanitize_callback' => 'csstarter_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'csstarter_settings[meta_updated]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Updated', 'csstarter' ),
			'section'  => 'csstarter_themeops',
			'settings' => 'csstarter_settings[meta_updated]',
			'priority' => 56,
		)
	);

}



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 0.1
 */
function csstarter_customizer_live_preview() {
	wp_enqueue_script( 'csstarter-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer-min.js', array( 'customize-preview' ), CSSTARTER_VERSION, true );
}
add_action( 'customize_preview_init', 'csstarter_customizer_live_preview' );
