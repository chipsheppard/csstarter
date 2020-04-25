<?php
/**
 * The main template file.
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
	csstarter_content_loop();
	csstarter_content_bottom();
	echo '</main>';
	csstarter_content_wrap_after();
echo '</div>';
csstarter_content_after();

get_footer();
