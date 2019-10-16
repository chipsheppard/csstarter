<?php
/**
 * Widgets.
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

/**
 * Register widget areas.
 */
function csstarter_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Widget Area', 'csstarter' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Sidebar Widget', 'csstarter' ),
			'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget Area', 'csstarter' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'An optional widget area for your site footer. Displays at the very bottom of your website.', 'csstarter' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'csstarter_widgets_init' );
