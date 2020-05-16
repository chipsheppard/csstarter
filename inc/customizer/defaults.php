<?php
/**
 * Sets all of our theme defaults.
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

if ( ! function_exists( 'csstarter_get_defaults' ) ) {
	/**
	 * Set default options
	 *
	 * @since 1.0
	 */
	function csstarter_get_defaults() {
		$csstarter_defaults = array(
			'background_color'            => '#ffffff',
			'home_layout_setting'         => 'layout-ns',
			'page_layout_setting'         => 'layout-ns',
			'single_layout_setting'       => 'layout-ns',
			'search_layout_setting'       => 'layout-ns',
			'archive_layout_setting'      => 'layout-ns',
			'meta_date'                   => true,
			'meta_author'                 => true,
			'meta_comments'               => true,
			'meta_updated'                => true,
			'meta_footer'                 => true,
			'post_nav'                    => true,
			'archives_hide_featuredimage' => '',
			'archives_hide_excerpt'       => '',
			'archives_hide_readmore'      => '',
			'archives_hide_meta'          => '',
			'nav_search'                  => '',
		);

		return apply_filters( 'csstarter_option_defaults', $csstarter_defaults );
	}
}
