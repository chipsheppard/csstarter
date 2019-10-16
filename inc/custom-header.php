<?php
/**
 * Custom Header.
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

/*
 * Sample implementation of the Custom Header feature
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses csstarter_header_style()
 */
function csstarter_custom_header_setup() {
	add_theme_support( 'custom-header',
		apply_filters( 'csstarter_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => 'ffffff',
				'width'              => 1600,
				'height'             => 1200,
				'flex-height'        => true,
				'flex-width'         => true,
				'video'              => true,
				'wp-head-callback'   => 'csstarter_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'csstarter_custom_header_setup' );


if ( ! function_exists( 'csstarter_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see _s_custom_header_setup().
	 */
	function csstarter_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
			else :
				?>
				.site-title a,
				.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
			<?php endif; ?>
		</style>
		<?php
	}
endif;




/**
 * CUSTOM HEADER
 * -----------------------------------------------------------------
 */
if ( ! function_exists( 'csstarter_display_customheader' ) ) {
	/**
	 * Get the Custom Header
	 * Uses csstarter_customheader_content()
	 */
	function csstarter_display_customheader() {
		echo '<div class="custom-header">';
		echo '<div class="custom-header-image"';
		// csstarter_customheader_image_url(); .
		echo '>';
		if ( is_front_page() ) :
			csstarter_customheader_content();
		endif;
		echo '</div>';
		echo '</div>';
	}
}
add_action( 'csstarter_header_after_wrap', 'csstarter_display_customheader' );


if ( ! function_exists( 'csstarter_customheader_content' ) ) {
	/**
	 * Put Video or Header Image and the Text into the Custom Header.
	 */
	function csstarter_customheader_content() {

		if ( ! is_front_page() ) :
			return;
		endif;

		// Get the media.
		if ( is_header_video_active() && ( has_header_video() || is_customize_preview() ) ) {
			echo '<div class="custom-header-media">';
				the_custom_header_markup();
			echo '</div>';
		}
	}
}
