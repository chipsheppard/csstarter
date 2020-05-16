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

if ( ! function_exists( 'csstarter_customize_register' ) ) {
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
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_control( 'header_textcolor' )->transport = 22;

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
		$wp_customize->add_section(
			'csstarter_layout_panel',
			array(
				'title'    => esc_html__( 'Layouts', 'csstarter' ),
				'priority' => 130,
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
					'label'       => esc_html__( 'Homepage Layout', 'csstarter' ),
					'description' => esc_html__( 'full width - left side - right side - thin', 'csstarter' ),
					'section'     => 'csstarter_layout_panel',
					'choices'     => array(
						'layout-ns' => esc_html__( 'layout-ns', 'csstarter' ),
						'layout-ls' => esc_html__( 'layout-ls', 'csstarter' ),
						'layout-rs' => esc_html__( 'layout-rs', 'csstarter' ),
						'layout-c'  => esc_html__( 'layout-c', 'csstarter' ),
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
					'type'     => 'select',
					'label'    => esc_html__( 'Pages Layout', 'csstarter' ),
					'section'  => 'csstarter_layout_panel',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'csstarter' ),
						'layout-ls' => esc_html__( 'layout-ls', 'csstarter' ),
						'layout-rs' => esc_html__( 'layout-rs', 'csstarter' ),
						'layout-c'  => esc_html__( 'layout-c', 'csstarter' ),
					),
					'settings' => 'csstarter_settings[page_layout_setting]',
					'priority' => 40,
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
					'label'    => esc_html__( 'Single Post Layout', 'csstarter' ),
					'section'  => 'csstarter_layout_panel',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'csstarter' ),
						'layout-ls' => esc_html__( 'layout-ls', 'csstarter' ),
						'layout-rs' => esc_html__( 'layout-rs', 'csstarter' ),
						'layout-c'  => esc_html__( 'layout-c', 'csstarter' ),
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
					'label'    => esc_html__( 'Archive/Blog Layout', 'csstarter' ),
					'section'  => 'csstarter_layout_panel',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'csstarter' ),
						'layout-ls' => esc_html__( 'layout-ls', 'csstarter' ),
						'layout-rs' => esc_html__( 'layout-rs', 'csstarter' ),
						'layout-c'  => esc_html__( 'layout-c', 'csstarter' ),
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
					'label'    => esc_html__( 'Search Results Layout', 'csstarter' ),
					'section'  => 'csstarter_layout_panel',
					'choices'  => array(
						'layout-ns' => esc_html__( 'layout-ns', 'csstarter' ),
						'layout-ls' => esc_html__( 'layout-ls', 'csstarter' ),
						'layout-rs' => esc_html__( 'layout-rs', 'csstarter' ),
						'layout-c'  => esc_html__( 'layout-c', 'csstarter' ),
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
				'priority' => 140,
			)
		);

		// POST META.
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
					'label'    => esc_html__( 'Post Meta', 'csstarter' ),
					'priority' => 10,
				)
			)
		);

		// Post Header.
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
					'content'  => esc_html__( 'Post header', 'csstarter' ),
					'priority' => 11,
				)
			)
		);
		// date.
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
				'priority' => 12,
			)
		);
		// author.
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
				'priority' => 13,
			)
		);
		// comments.
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
				'priority' => 14,
			)
		);
		// updated.
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
				'priority' => 15,
			)
		);

		// Post Footer.
		$wp_customize->add_setting(
			'themeops-metafooter-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Csstarter_Content_Area(
				$wp_customize,
				'themeops-metafooter-message',
				array(
					'section'  => 'csstarter_themeops',
					'content'  => esc_html__( 'Post footer', 'csstarter' ),
					'priority' => 16,
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
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Categories & Tags', 'csstarter' ),
				'section'  => 'csstarter_themeops',
				'settings' => 'csstarter_settings[meta_footer]',
				'priority' => 17,
			)
		);
		// show post navigation.
		$wp_customize->add_setting(
			'csstarter_settings[post_nav]',
			array(
				'default'           => $defaults['post_nav'],
				'type'              => 'option',
				'sanitize_callback' => 'csstarter_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'csstarter_settings[post_nav]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Post Navigation (prev, next)', 'csstarter' ),
				'section'  => 'csstarter_themeops',
				'settings' => 'csstarter_settings[post_nav]',
				'priority' => 18,
			)
		);

		// ARCHIVE META.
		$wp_customize->add_setting(
			'to-a-elements-message',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Csstarter_Content_Area(
				$wp_customize,
				'to-a-elements-message',
				array(
					'section'  => 'csstarter_themeops',
					'label'    => esc_html__( 'Archive Meta', 'csstarter' ),
					'priority' => 20,
				)
			)
		);
		// Hide featured images.
		$wp_customize->add_setting(
			'csstarter_settings[archives_hide_featuredimage]',
			array(
				'default'           => $defaults['archives_hide_featuredimage'],
				'type'              => 'option',
				'sanitize_callback' => 'csstarter_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'csstarter_settings[archives_hide_featuredimage]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Hide the featured image', 'csstarter' ),
				'section'  => 'csstarter_themeops',
				'settings' => 'csstarter_settings[archives_hide_featuredimage]',
				'priority' => 21,
			)
		);
		// Hide excerpt.
		$wp_customize->add_setting(
			'csstarter_settings[archives_hide_meta]',
			array(
				'default'           => $defaults['archives_hide_meta'],
				'type'              => 'option',
				'sanitize_callback' => 'csstarter_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'csstarter_settings[archives_hide_meta]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Hide the meta data', 'csstarter' ),
				'section'  => 'csstarter_themeops',
				'settings' => 'csstarter_settings[archives_hide_meta]',
				'priority' => 22,
			)
		);
		// Hide excerpt.
		$wp_customize->add_setting(
			'csstarter_settings[archives_hide_excerpt]',
			array(
				'default'           => $defaults['archives_hide_excerpt'],
				'type'              => 'option',
				'sanitize_callback' => 'csstarter_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'csstarter_settings[archives_hide_excerpt]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Hide the excerpt', 'csstarter' ),
				'section'  => 'csstarter_themeops',
				'settings' => 'csstarter_settings[archives_hide_excerpt]',
				'priority' => 23,
			)
		);
		// Hide readmore.
		$wp_customize->add_setting(
			'csstarter_settings[archives_hide_readmore]',
			array(
				'default'           => $defaults['archives_hide_readmore'],
				'type'              => 'option',
				'sanitize_callback' => 'csstarter_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'csstarter_settings[archives_hide_readmore]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Hide the Continue button', 'csstarter' ),
				'section'  => 'csstarter_themeops',
				'settings' => 'csstarter_settings[archives_hide_readmore]',
				'priority' => 24,
			)
		);

	}
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
