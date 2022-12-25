(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_video_button = {};

	$( window ).on(
		'load',
		function () {
			qodefVideoButton.init();
		}
	);

	var qodefVideoButton = {
		init: function () {
			this.holder = $('.qodef-video-button');

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						if ( !$thisHolder.hasClass('qodef--has-img') ) {
							qodefVideoButton.setHeight( $thisHolder );
						}
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			setTimeout( function () {
				var $parallaxHolder = $holder.closest('.qodef-parallax');

				if ( $parallaxHolder.length ) {
					$holder.height($parallaxHolder.height());
				}
			}, 100);
		}
	};

	qodefCore.shortcodes.fokkner_core_video_button.qodefVideoButton   = qodefVideoButton;
	qodefCore.shortcodes.fokkner_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );