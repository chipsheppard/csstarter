<?php
/**
 * Site header
 *
 * @package  CsStarter
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

?><!doctype html>
<?php csstarter_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php
csstarter_head_top();
wp_head();
csstarter_head_bottom();
?>
</head>
<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}

csstarter_body_top();
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'csstarter' ); ?></a>

	<?php csstarter_header_before(); ?>
	<?php csstarter_header_after(); ?>

	<div id="content" class="site-content">
		<div class="content-inner-wrap">
