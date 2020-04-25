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

csstarter_footer_before();
csstarter_footer_after();

echo '</div>'; // /site.
csstarter_body_bottom();
wp_footer();

echo '</body></html>';
