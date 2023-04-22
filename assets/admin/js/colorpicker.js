// For testing purposes only
console.clear();


init_colorpicker_fn( '#cp3', 'hex' );

function init_colorpicker_fn( id_str, format_str = 'hex' ) {
	
	if ( !id_str.startsWith( '#' ) ) {
		id_str = '#' + id_str;
	}
	
	var $picker_el = jQuery( id_str );

	$picker_el.colorpicker( {
		format: format_str,
		horizontal: true,
		popover: {
			container: id_str + '-container'
		},
		template: '<div class="colorpicker">' +
			'<div class="colorpicker-saturation"><i class="colorpicker-guide"></i></div>' +
			'<div class="colorpicker-hue"><i class="colorpicker-guide"></i></div>' +
			'<div class="colorpicker-alpha">' +
			'	<div class="colorpicker-alpha-color"></div>' +
			'	<i class="colorpicker-guide"></i>' +
			'</div>' +
			'<div class="colorpicker-bar">' +
			'	<div class="input-group">' +
			'		<input class="form-control input-block color-io" />' +
			'	</div>' +
			'</div>' +
			'</div>'
	} ).on( 'colorpickerCreate colorpickerUpdate', function( e ) {
		$picker_el.parent().find( '.colorpicker-input-addon>i' ).css( 'background-color', e.value );
	} ).on( 'colorpickerCreate', function( e ) {
		resize_color_picker_fn( $picker_el );
	} ).on( 'colorpickerShow', function( e ) {
		var cpInput_el = e.colorpicker.popupHandler.popoverTip.find( '.color-io' );

		cpInput_el.val( e.color.string() );

		cpInput_el.on( 'change keyup', function() {
			e.colorpicker.setValue( cpInput_el.val() );
		} );
	} ).on( 'colorpickerHide', function( e ) {
		var cpInput_el = e.colorpicker.popupHandler.popoverTip.find( '.color-io' );
		cpInput_el.off( 'change keyup' );
	} ).on( 'colorpickerChange', function( e ) {
		var cpInput_el = e.colorpicker.popupHandler.popoverTip.find( '.color-io' );

		if ( e.value === cpInput_el.val() || !e.color || !e.color.isValid() ) {
			return;
		}

		cpInput_el.val( e.color.string() );
	} );

	$picker_el.parent().find( '.colorpicker-input-addon>i' ).on( 'click', function( e ) {
		$picker_el.colorpicker( 'colorpicker' ).show();
	} );

	jQuery( window ).resize( function( e ) {
		resize_color_picker_fn( $picker_el );
	} );
}

function resize_color_picker_fn( $picker_el ) {
	return true;
	var rem_int = parseInt( getComputedStyle( document.documentElement ).fontSize ),
		width_int = $picker_el.parent().width() - ( ( rem_int * .75 ) * 2 ) - 2,
		colorPicker_obj = $picker_el.colorpicker( 'colorpicker' ),
		slider_obj = colorPicker_obj.options.slidersHorz;

	slider_obj.alpha.maxLeft = width_int;
	slider_obj.alpha.maxTop = 0;

	slider_obj.hue.maxLeft = width_int;
	slider_obj.hue.maxTop = 0;

	slider_obj.saturation.maxLeft = width_int;
	slider_obj.saturation.maxTop = 150;

	colorPicker_obj.update();
}
