<?php
/**
 * Radio Image Control
 *
 * @package  CsStarter
 * @subpackage csstarter/inc/customizer
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

/**
 * The Customize Radio Image Control class extends the WP_Customize_Control class.
 * Creates the ever-coveted list of 'image' radio inputs.
 *
 * @author     Chip Sheppard w/ props to Justin Tadlock <justin@justintadlock.com>
 * @link       http://themehybrid.com/hybrid-core
 * @link       https://napitwptech.com/tutorial/wordpress-development/extend-customizer-options-include-radio-image-option/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class Csstarter_Radio_Image_Control extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @var $type string
	 */
	public $type = 'radio-image';

	/**
	 * Displays the control content.
	 *
	 * @access public
	 * @return void
	 */
	public function render_content() {
		/* If no choices are provided, scoot. */
		if ( empty( $this->choices ) ) {
			return;
		}

		$name = '_customize-radio-' . $this->id;
		?>

		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>

		<div id="csstarter-img-container" class="controls">

			<?php
			foreach ( $this->choices as $value => $label ) :
				$class = ( $this->value() === $value ) ? 'csstarter-radio-img-selected csstarter-radio-img-img' : 'csstarter-radio-img-img';
				?>

				<label>
					<input <?php $this->link(); ?> type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>"
					<?php
						$this->link();
						checked( $this->value(), $value );
					?>
					/>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $label . '.png' ); ?>" class="<?php echo esc_attr( $class ); ?>" />
				</label>

			<?php endforeach; ?>

		</div><!-- .image -->

		<?php
	}

	/**
	 * Loads our custom styles in.
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script(
			'csstarter-radio-image-control-js',
			get_template_directory_uri() . '/assets/js/customize-radio-image-control-min.js',
			array( 'jquery' ),
			CSSTARTER_VERSION,
			true
		);
		wp_enqueue_style(
			'csstarter-radio-image-control-css',
			get_template_directory_uri() . '/assets/css/customize-radio-image-control-min.css',
			array(),
			CSSTARTER_VERSION
		);
	}
}
