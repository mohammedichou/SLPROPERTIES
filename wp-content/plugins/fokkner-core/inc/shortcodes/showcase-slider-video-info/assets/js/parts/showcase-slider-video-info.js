(function ($) {
	"use strict";

	qodefCore.shortcodes.fokkner_core_showcase_slider_video_info = {};

	$(document).ready(
		function () {
			qodefShowcaseSliderVideoInfo.init();
		}
	);
	
	var qodefShowcaseSliderVideoInfo = {
		init: function () {
			this.holder = $('.qodef-showcase-slider-video-info');
			
			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						qodefShowcaseSliderVideoInfo.createSlider( $thisHolder );
						qodefShowcaseSliderVideoInfo.fullHeightSliderCalc( $thisHolder );
						qodefShowcaseSliderVideoInfo.sliderNavigationPosition( $thisHolder );

						$(window).resize(
							function () {
								qodefShowcaseSliderVideoInfo.fullHeightSliderCalc( $thisHolder );
								qodefShowcaseSliderVideoInfo.sliderNavigationPosition( $thisHolder );
							}
						);
					}
				);
			}
		},
		createSlider: function ( $holder ) {
			var $swiperHolder 			= $holder.find('.qodef-m-image-holder'),
				$additionalSwiperHolder = $holder.find('.qodef-additional-swiper'),
				$paginationHolder 		= $holder.find('.swiper-pagination');

            var sliderOptions = typeof $swiperHolder.data('options') !== 'undefined' ? $swiperHolder.data('options') : {},
                slidesPerView = 1,
                loop = sliderOptions.loop !== undefined && sliderOptions.loop !== '' ? sliderOptions.loop : true,
                autoplay = sliderOptions.autoplay !== undefined && sliderOptions.autoplay !== '' ? sliderOptions.autoplay : true,
                speed = sliderOptions.speed !== undefined && sliderOptions.speed !== '' ? parseInt(sliderOptions.speed, 10) : 3000,
                speedAnimation = sliderOptions.speedAnimation !== undefined && sliderOptions.speedAnimation !== '' ? parseInt(sliderOptions.speedAnimation, 10) : 800,
                spaceBetween = 0,
                centeredSlides = false,
                nextNavigation = $holder.find('.swiper-button-next'),
                prevNavigation = $holder.find('.swiper-button-prev');

            if ( autoplay === true ) {
                autoplay = {
                    delay: speed,
                    disableOnInteraction: false
                };
            }

			var $additionalSwiper = new Swiper($additionalSwiperHolder, {
				slidesPerView: slidesPerView,
				centeredSlides: centeredSlides,
				spaceBetween: spaceBetween,
				autoplay: autoplay,
				loop: loop,
				speed: speedAnimation,
				allowTouchMove: false,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
				on: {
					init: function () {
						$additionalSwiperHolder.addClass('qodef-swiper--initialized');
					}
				}
			});

			var $swiper = new Swiper($swiperHolder, {
				slidesPerView: slidesPerView,
				centeredSlides: centeredSlides,
				spaceBetween: spaceBetween,
				autoplay: autoplay,
				loop: loop,
				speed: speedAnimation,
				allowTouchMove: false,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
				controller: {
					control: $additionalSwiper,
				},
                navigation: {nextEl: nextNavigation, prevEl: prevNavigation},
                pagination: {
                    el: $paginationHolder,
                    clickable: true,
                    bulletClass: 'qodef-m-number',
                    renderBullet: function ( index, className ) {
                        return '<span class="' + className + '"><span>' + (index + 1) + '</span></span>';
                    },
                },
				on: {
					init: function () {
						$swiperHolder.addClass('qodef-swiper--initialized');
					},
					slideChange: function slideChange() {
						var swiper = this;
						var activeIndex = swiper.activeIndex;
					}
				}
			});
		},
		fullHeightSliderCalc: function ( $holder ) {
			if ( $holder.hasClass('qodef-full-height-slider--yes') ) {
				var windowHeight = (window.innerHeight || document.documentElement.clientHeight);

				if ( qodefCore.windowWidth > 1024 ) {
					var sliderHeight = windowHeight - qodefGlobal.vars.headerHeight - qodefGlobal.vars.topAreaHeight - qodefGlobal.vars.adminBarHeight;
				} else {
					sliderHeight = windowHeight - qodefGlobal.vars.mobileHeaderHeight - qodefGlobal.vars.adminBarHeight;
				}

				if (qodefCore.body.hasClass('qodef--passepartout')) {
					var passepartoutSize = parseInt(qodefCore.body.css('padding-top'));
					sliderHeight -= passepartoutSize;
				}

				$holder.height(sliderHeight);
			}
		},
		sliderNavigationPosition: function ( $holder ) {
			var $navigation = $holder.find('.swiper-navigation-holder .swiper-button-prev, .swiper-navigation-holder .swiper-button-next'),
				$navigationHeight = $navigation.height(),
				$title = $holder.find('.qodef-m-content-holder .qodef-m-title'),
				$titleTopPosition = $title.offset().top;

			if ( $navigation.length ) {
				if ( qodefCore.windowWidth > 1024 ) {
					$navigation.css('top', $titleTopPosition - $navigationHeight - qodefGlobal.vars.adminBarHeight + 3); // 3px adj. to arrow tail to be in line with title
				} else if ( qodefCore.windowWidth > 768 && qodefCore.windowWidth <= 1024 ) {
					$navigation.css('top', $titleTopPosition + $navigationHeight);
				} else if ( qodefCore.windowWidth > 684 && qodefCore.windowWidth <= 768 ) {
					$navigation.css('top', $titleTopPosition - 8); // 12px is adjustement on touch
				}
			}
		}
	};

	qodefCore.shortcodes.fokkner_core_showcase_slider_video_info.qodefShowcaseSliderVideoInfo = qodefShowcaseSliderVideoInfo;

})(jQuery);
