<?php
/**
 * The main sidebar.
 *
 * @package  CsStarter
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

tha_sidebars_before();
echo '<aside id="secondary" class="widget-area" role="complementary">';
tha_sidebar_top();
dynamic_sidebar( 'sidebar' );
tha_sidebar_bottom();
echo '</aside>';
tha_sidebars_after();
