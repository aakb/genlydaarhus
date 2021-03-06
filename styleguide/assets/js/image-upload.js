/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License

  https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/
*/

jQuery(document).ready(function ($) {
  "use strict";

	$('.js-image-upload').each( function() {
		var $input	 = $( this ),
			$label	 = $input.next( 'label' ),
			labelVal = $label.html();

		$input.on('change', function(e) {
			var fileName = '';

      if (e.target.value)
				fileName = e.target.value.split( '\\' ).pop();

			if (fileName) {
        $label.find('span').html(fileName);
      } else {
        $label.html(labelVal);
      }
		});

		// Firefox bug fix.
		$input
		.on( 'focus', function() { $input.addClass( 'has-focus' ); } )
		.on( 'blur', function() { $input.removeClass( 'has-focus' ); } );
	});

});