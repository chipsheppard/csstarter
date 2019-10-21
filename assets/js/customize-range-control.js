/**
 * Customizer Range slider
 *
 * @package  CsStarter
 * @subpackage csstarter/assets/js
 * @since    1.0.0
 */

(function ($) {
    $(document).ready(function ($) {
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).prev('.csstarter-range-value').html(val);
            $(this).val(val);
        });

		// Handle the reset button
		$( '.csstarter-reset-slider' ).on('click', function() {
			var this_input, input_default;
			this_input 		= $( this ).closest( 'label' ).find( 'input' );
			input_default 	= this_input.data( 'reset_value' );

			this_input.val( input_default );
			this_input.change();

		} );
    });
})(jQuery);
