(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_property_indent_slider = {};

	$( document ).ready(
		function () {
			qodefInitPaginationPosition.init();
		}
	);

	var qodefInitPaginationPosition = {
		init: function () {
			this.holder = $( '.qodef-property-indent-slider' );

			if ( this.holder.length ) {

				this.holder.each( function () {
					var $holder = $( this );
					qodefInitPaginationPosition.setPosition( $holder );

					$( window ).resize(
						function () {
							setTimeout(
								function () {
									qodefInitPaginationPosition.setPosition( $holder );
								},
								300
							);
						}
					);
				});
			}
		},
		setPosition: function ( $holder ) {
			var $item  		  = $holder.find('.swiper-slide');
			var $itemWidth 	  = $item.outerWidth();
			var $pagination   = $holder.find('.swiper-pagination-fraction');
			var $paginationPosition = $itemWidth - 40; // 40 is for spacing

			if ( qodefCore.windowWidth > 1024 ) {
				$pagination.css('left', $paginationPosition);
			} else {
				$pagination.css('left', 'initial');
			}
		}
	};

	qodefCore.shortcodes.fokkner_core_property_indent_slider.qodefInitPaginationPosition  = qodefInitPaginationPosition;

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes.fokkner_core_property_indent_slider[key] = value;
			}
		);
	}

})( jQuery );
