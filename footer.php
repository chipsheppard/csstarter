<?php
/**
 * Site footer
 *
 * @package  CsStarter
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

echo '</div>';  // /content-inner-wrap.
echo '</div>'; // /site-content.

tha_footer_before();
tha_footer_after();

echo '</div>'; // /site.
tha_body_bottom();
wp_footer();

echo '</body></html>';
