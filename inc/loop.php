<?php
/**
 * The Loop
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
 * Default Loop
 */
function csstarter_default_loop() {

	if ( have_posts() ) :

		csstarter_content_while_before();

		echo '<div class="loop-wrap">';

		while ( have_posts() ) :
			the_post();
			csstarter_entry_before();
			get_template_part( 'template-parts/content', get_post_format() );
			csstarter_entry_after();
		endwhile;

		echo '</div>';

		csstarter_content_while_after();

		else :

			csstarter_entry_before();
			get_template_part( 'template-parts/content', 'none' );
			csstarter_entry_after();

	endif;
}
add_action( 'csstarter_content_loop', 'csstarter_default_loop' );


/**
 * Archive Page Titles
 */
function csstarter_archive_page_titles() {
	if ( is_home() && ! is_front_page() || is_archive() || is_search() ) :
		echo '<header class="page-header">';
		echo '<div class="title-wrap">';

		if ( is_search() ) :
			echo '<h1 class="page-title">';
			/* translators: %$2s: is the search term */
			printf( '<span>' . esc_html__( 'Search Results for:%1$s %2$s', 'csstarter' ), '</span>', get_search_query() );
			echo '</h1>';
		else :
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
		endif;

		echo '</div>';
		echo '</header>';
	endif;
}
add_action( 'csstarter_content_while_before', 'csstarter_archive_page_titles' );


/**
 * Archive Pagination (<< 1 of 10 >>)
 */
function csstarter_postpagination() {

	if ( is_archive() || is_home() ) :
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __( '&laquo; Previous', 'csstarter' ),
				'next_text' => __( 'Next &raquo;', 'csstarter' ),
			)
		);
	endif;

}
add_action( 'csstarter_content_while_after', 'csstarter_postpagination' );


/**
 * Post Navigation (prev - next)
 */
function csstarter_postnav() {

	if ( is_single() ) :
		the_post_navigation(
			array(
				'prev_text' => __( '<span>previous</span> %title', 'csstarter' ),
				'next_text' => __( '<span>next</span> %title', 'csstarter' ),
			)
		);
	endif;

}
add_action( 'csstarter_entry_after', 'csstarter_postnav' );


/**
 * Post Comments
 */
function csstarter_comments() {

	if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}

}
add_action( 'csstarter_content_while_after', 'csstarter_comments' );
