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
