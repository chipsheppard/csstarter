/**
 * Customizer Radio Image
 *
 * @package  CsStarter
 * @subpackage csstarter/assets/js
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */

jQuery( document ).ready(function () {
	jQuery( '#csstarter-img-container.controls label img' ).click(function () {
		jQuery( this ).parents( '#csstarter-img-container.controls' ).find( 'img' ).removeClass( 'csstarter-radio-img-selected' );
		jQuery( this ).addClass( 'csstarter-radio-img-selected' );
	} );
} );
