<?php
/**
 * The template for displaying comments.
 *
 * @package  CsStarter
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

tha_comments_before();
echo '<div id="comments" class="comments-area">';

if ( have_comments() ) :

	echo '<h2 class="comments-title">';
		esc_html__( 'Comments', 'csstarter' );
	echo '</h2>';

	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through?
		echo '<nav id="comment-nav-above" class="navigation comment-navigation cf" role="navigation">';
		echo '<h2 class="screen-reader-text">' . esc_html__( 'Comment navigation', 'csstarter' ) . '</h2>';
		echo '<div class="nav-links">';
			echo '<div class="nav-previous">';
				previous_comments_link( esc_html__( 'Older Comments', 'csstarter' ) );
			echo '</div>';
			echo '<div class="nav-next">';
				next_comments_link( esc_html__( 'Newer Comments', 'csstarter' ) );
			echo '</div>';
		echo '</div>';
		echo '</nav>';

	endif;

	echo '<ol class="comment-list">';
		wp_list_comments(
			array(
				'style'      => 'ol',
				'short_ping' => true,
			)
		);
	echo '</ol>';

	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through?
		echo '<nav id="comment-nav-below" class="navigation comment-navigation cf" role="navigation">';
		echo '<h2 class="screen-reader-text">' . esc_html__( 'Comment navigation', 'csstarter' ) . '</h2>';
		echo '<div class="nav-links">';
			echo '<div class="nav-previous">';
				previous_comments_link( esc_html__( 'Older Comments', 'csstarter' ) );
			echo '</div>';
			echo '<div class="nav-next">';
				next_comments_link( esc_html__( 'Newer Comments', 'csstarter' ) );
			echo '</div>';
		echo '</div>';
		echo '</nav>';
	endif;

endif;


// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	echo '<p class="no-comments">' . esc_html__( 'Comments are closed.', 'csstarter' ) . '</p>';
endif;

comment_form();

echo '</div>';
tha_comments_after();
