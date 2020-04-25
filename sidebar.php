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

csstarter_sidebars_before();
echo '<aside id="secondary" class="widget-area" role="complementary">';
csstarter_sidebar_top();
dynamic_sidebar( 'sidebar' );
csstarter_sidebar_bottom();
echo '</aside>';
csstarter_sidebars_after();
