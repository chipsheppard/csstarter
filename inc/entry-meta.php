<?php
/**
 * Entry Meta functions
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
 * Date - Posted on.
 */
function csstarter_posted_on() {

	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf(
		$time_string,
		esc_attr(
			get_the_date( 'c' )
		),
		esc_html(
			get_the_date( 'M j, Y' )
		)
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on">' . wp_kses_post( $posted_on ) . '</span> ';
}

/**
 * Date - Updated.
 */
function csstarter_updated_on() {

	if ( get_the_time( 'U' ) === get_the_modified_time( 'U' ) ) {
		return;
	}

	$updated_string = '<time class="entry-date updated" datetime="%1$s">%2$s</time>';

	$updated_string = sprintf(
		$updated_string,
		esc_attr(
			get_the_modified_date( 'c' )
		),
		esc_html(
			get_the_modified_date( 'm/d/Y' )
		)
	);
	$updated_on     = sprintf(
		/* translators: %s: modified date. */
		esc_html_x( 'updated %s', 'modified date', 'csstarter' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $updated_string . '</a>'
	);

	echo '<span class="updated-on">' . wp_kses_post( $updated_on ) . '</span>';
}

/**
 * Current Author.
 */
function csstarter_posted_by() {

	$byline = sprintf(
		/* translators: %s: post author */
		esc_html_x( 'by %s', 'post author', 'csstarter' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline">' . wp_kses_post( $byline ) . '</span>';
}

/**
 * Comments Count.
 */
function csstarter_comment_count() {

	$num_comments = get_comments_number();

	if ( '0' === $num_comments ) {
		return;
	}

	if ( is_single() || is_archive() || is_home() && ! post_password_required() && comments_open() ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			'',
			__( '1 comment', 'csstarter' ),
			__( '% comments', 'csstarter' ),
			'meta-link',
			''
		);
		echo '</span>';
	}
}

/**
 * DISPLAY the entry meta
 */
function csstarter_display_entry_meta() {
	if ( 'post' === get_post_type() ) :

		$csstarter_settings = wp_parse_args(
			get_option( 'csstarter_settings', array() ),
			csstarter_get_defaults()
		);
		$meta_date          = $csstarter_settings['meta_date'];
		$meta_author        = $csstarter_settings['meta_author'];
		$meta_comments      = $csstarter_settings['meta_comments'];
		$meta_updated       = $csstarter_settings['meta_updated'];
		$hide_m             = $csstarter_settings['archives_hide_meta'];

		if ( true !== $meta_date && true !== $meta_author && true !== $meta_comments && true !== $meta_updated ) {
			return;
		}

		if ( true === $hide_m && ( is_archive() || is_home() || is_search() ) ) {
			return;
		}

		echo '<div class="entry-meta">';
		if ( true === $meta_date ) {
			csstarter_posted_on();
		}
		if ( true === $meta_author ) {
			csstarter_posted_by();
		}
		if ( true === $meta_comments ) {
			csstarter_comment_count();
		}
		if ( true === $meta_updated ) {
			csstarter_updated_on();
		}
		echo '</div>';
	endif;
}
add_action( 'tha_entry_top', 'csstarter_display_entry_meta' );
