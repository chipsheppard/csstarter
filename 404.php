<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package  CsStarter
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

do_action( 'csstarter_init' );

get_header();

csstarter_content_before();
echo '<div id="primary" class="content-area">';
csstarter_content_wrap_before();
echo '<main id="main" class="site-main" role="main">';
csstarter_content_top();
echo '<section class="error-404 not-found">';

	echo '<header class="page-header">';
		echo '<div class="title-wrap">';
		echo '<h1 class="page-title">' . esc_html__( 'Page not found.', 'csstarter' ) . '</h1>';
		echo '</div>';
	echo '</header>';

	echo '<div class="page-content">';
		echo '<div class="error-message">' . esc_html__( 'ERROR - ERROR - ERROR', 'csstarter' ) . '</div>';
		echo '<p>' . esc_html__( 'Please use the menu in the header or try a search.', 'csstarter' ) . '</p>';
		get_search_form();
	echo '</div>';

echo '</section>';
csstarter_content_bottom();
echo '</main>';
csstarter_content_wrap_after();
echo '</div>';
csstarter_content_after();

get_footer();
