<?php
/**
 * Template part for the content area
 *
 * @package  CsStarter
 * @subpackage csstarter/template-parts
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
$csstarter_settings = wp_parse_args(
	get_option( 'csstarter_settings', array() ),
	csstarter_get_defaults()
);
$csstarter_hide_fi  = $csstarter_settings['archives_hide_featuredimage'];

if ( true !== $csstarter_hide_fi && ! is_singular() && ! has_post_format( 'aside' ) && ! has_post_format( 'status' ) && has_post_thumbnail() ) :

	echo '<a href="' . esc_url( get_permalink() ) . '" class="fi-link">';
	the_post_thumbnail(
		'post-thumbnail',
		array(
			'class' => 'featured-image',
			'title' => 'Feature image',
		)
	);
	echo '</a>';

endif;

echo '<header class="entry-header">';

if ( is_singular() ) :

	// Title for posts, attachments, pages, custom post types.
	echo '<div class="title-wrap">';
	the_title( '<h1 class="entry-title">', '</h1>' );

else :

	// Title for archives & search.
	echo '<div class="title-wrap">';
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

endif;

tha_entry_top();

echo '</div>';
echo '</header>';

echo '<div class="entry-content">';

	tha_entry_content_before();
	tha_entry_content_after();

echo '</div>';

tha_entry_bottom();

echo '</article>';
