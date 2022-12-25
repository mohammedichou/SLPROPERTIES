(function($) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_comparison_slider = {};

	$( document ).ready(
		function () {
			qodefComparisonSlider.init();
		}
	);

	var qodefComparisonSlider = {
		init: function () {
			this.comparisonSlider =  $( '.qodef-comparison-slider-holder' );

			if(this.comparisonSlider.length) {
				this.comparisonSlider.each(function () {
					var $thisComparisonSlider = $(this);

					var $offset = 50 / 100;

					$thisComparisonSlider.waitForImages(function () {
						$thisComparisonSlider.css('visibility', 'visible');
						$thisComparisonSlider.twentytwenty({
							default_offset_pct: 1.1,
							orientation: 'horizontal'
						});
					});

					$thisComparisonSlider.appear(function () {
						setTimeout(function () {
							var $height = $thisComparisonSlider.height(),
								$width = $thisComparisonSlider.width(),
								$pixelWidth = $width * $offset, //target value
								$handle = $thisComparisonSlider.find('.twentytwenty-handle'),
								$image = $thisComparisonSlider.find('img:first-of-type'),
								$transitionTime = 800,
								$transitionEasing = 'cubic-bezier(0.85, 0.26, 0.17, 1)',
								$transitionDelay = 140;

							var position = function () {
								$handle.css({
										'left': + $pixelWidth + 1 + 'px'
									});

								$image.css({
										'clip': 'rect(0px ' + $pixelWidth + 'px ' + $height + 'px 0px)'
									});
							};

							$image.css('transition', 'all ' + $transitionTime + 'ms ' + $transitionEasing + ' ' + $transitionDelay + 'ms');
							$handle.css('transition', 'all ' + $transitionTime + 'ms ' + $transitionEasing + ' ' + $transitionDelay + 'ms');

							position();

							setTimeout(function () {
								$image.css('transition', 'none');
								$handle.css('transition', 'none');
							}, $transitionTime);

							$( window ).resize(function () {
								$height = $thisComparisonSlider.height();
								$width = $thisComparisonSlider.width();
								$pixelWidth = $width * $offset; //target value
								position();
							});

						}, 100); //necessary for calcs
					}, {accX: 0, accY: -200});
				});
			}
		}
	};

	qodefCore.shortcodes.fokkner_core_comparison_slider.qodefComparisonSlider = qodefComparisonSlider;

})( jQuery );
