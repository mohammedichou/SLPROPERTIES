(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_property_image_map_gallery = {};

	$( document ).ready(
		function () {
			qodefPropertyImageMapTabs.init();
			qodefPropertyImageMapGallery.init();
			qodefInitPropertyMobileMap.init();
		}
	);

	var qodefPropertyImageMapGallery = {
		init: function () {
			var holder = $( '.qodef-property-image-map-inner' );

			if ( holder.length ) {
				holder.each(
					function () {
						var thisHolder = $( this );

						if ( thisHolder.hasClass( 'qodef-section-active' ) ) {

							var imageMapName = thisHolder.data( 'image-map-name' );
							var lastHighlight;
							var shapeName;

							var navigationActive = thisHolder.find( '.qodef-map-nav-item.qodef-active-map' );
							var navigation = thisHolder.find( '.qodef-map-nav-item.qodef-inactive-map' );
							var mappedImage = thisHolder.find( '.qodef-image-map-holder-overlay' );
							var imageHolder = thisHolder.find( '.qodef-image-map-holder' );

							navigation.each(
								function () {
									$( this ).on(
										'click',
										function () {
											mappedImage.css(
												'z-index',
												999
											);
											imageHolder.css(
												'opacity',
												0.5
											);
										}
									);
								}
							);

							navigationActive.each(
								function () {
									$( this ).on(
										'click',
										function () {
											mappedImage.css(
												'z-index',
												-1
											);
											imageHolder.css(
												'opacity',
												1
											);
										}
									);
								}
							);

							// reference for main items
							var slider = thisHolder.find( '.qodef-img-slider' );
							// reference for thumbnail items
							var thumbnailSlider = thisHolder.find( '.qodef-pagination-slider' );
							//transition time in ms
							var duration = 500;

							var swiperSlider = new Swiper(
								slider,
								{
									loop: false,
									autoplay: false,
									slidesPerView: 1,
									effect: 'fade',
									fadeEffect: {
										crossFade: true
									},
									on: {
										init: function () {
											slider.addClass( 'qodef--initialized' );
										},
										slideChange: function () {
											setTimeout(
												function () {
													shapeName = slider.find( '.swiper-slide.swiper-slide-active' ).data( 'imp-shape' );
													if ( typeof shapeName !== 'undefined' ) {
														if ( typeof lastHighlight !== 'undefined' ) {
															$.imageMapProUnhighlightShape(
																imageMapName,
																lastHighlight
															);
														}
														if ( shapeName !== 'empty' ) {
															$.imageMapProHighlightShape(
																imageMapName,
																shapeName
															);
															lastHighlight = shapeName;
														}
													}
												},
												300
											);

											swiperThumbnailSlider.slideTo(
												swiperSlider.realIndex,
												duration,
												true
											);
										},
									}
								}
							);

							swiperSlider.init();

							var swiperThumbnailSlider = new Swiper(
								thumbnailSlider,
								{
									loop: false,
									autoplay: false,
									slidesPerView: 4,
									spaceBetween: 15,
									on: {
										init: function () {
											slider.addClass( 'qodef--initialized' );
										},
										slideChange: function () {
											swiperSlider.slideTo(
												swiperThumbnailSlider.realIndex,
												duration,
												true
											);
										},
										click: function () {
											swiperSlider.slideTo(
												swiperThumbnailSlider.clickedIndex,
												duration,
												true
											);
										},
									}
								}
							);

							swiperThumbnailSlider.init();

							var singleSection = thisHolder.find( '.qodef-img-section' ),
								singleNav = thisHolder.find( '.qodef-map-navigation .qodef-map-nav-item' );

							singleNav.on(
								'click',
								function () {
									singleSection.removeClass( 'active' );
									singleNav.removeClass( 'active' );
									var thisNav = $( this ),
										index = thisNav.index();
									thisNav.addClass( 'active' );
									singleSection.eq( index ).addClass( 'active' );
								}
							);

							$.imageMapProEventClickedShape = function ( imageMapName, shapeName ) {
								var sliderIndex = -1;
								var impObject = $( '.qodef-property-image-map-inner[data-image-map-name=\'' + imageMapName + '\']' );

								// reference for main items
								var slider = impObject.find( '.qodef-img-slider' );
								// reference for thumbnail items
								var sliderItems = slider.find( '.swiper-slide' );
								sliderItems.each(
									function () {
										if ( $( this ).data( 'imp-shape' ) === shapeName ) {
											sliderIndex = $( this ).index();
										}
										if ( sliderIndex !== -1 ) {
											swiperSlider.slideTo(
												sliderIndex,
												duration,
												true
											);
											swiperThumbnailSlider.slideTo(
												sliderIndex,
												duration,
												true
											);
										}
									}
								);
							};
						}
					}
				);

			}
		}
	};

	//function used to repaint ImageMapPro in Elementor admin, that why it is only used in elementor reinitiate and not in $(document).ready
	var qodefPropertyImageMapSVG = {
		init: function () {
			var imageMapHolders = $( '.qodef-image-map-holder' );

			if ( imageMapHolders.length ) {
				imageMapHolders.each(
					function () {
						var thisHolder = $( this ),
							settings = thisHolder.data( 'options' ) !== 'undefined' ? thisHolder.data( 'options' ) : {},
							id = settings.id !== undefined && settings.id !== '' ? settings.id : 0,
							mapSvgHolder = thisHolder.find( '#image-map-pro-' + id );

						if ( mapSvgHolder.length ) {
							mapSvgHolder.imageMapPro( settings );
						}
					}
				);
			}
		}
	};

	var qodefInitPropertyMobileMap = {
		init: function () {
			var $mapOpener = $( '.qodef-view-larger-map a' ),
				$mapOpenerIcon = $mapOpener.children( 'i' ),
				$mapHolder = $( '.qodef-map-holder' );

			if ( $mapOpener.length ) {
				$mapOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();

						if ( $mapHolder.hasClass( 'qodef-fullscreen-map' ) ) {
							$mapHolder.removeClass( 'qodef-fullscreen-map' );
							$mapOpenerIcon.removeClass( 'icon-basic-magnifier-minus' );
							$mapOpenerIcon.addClass( 'icon-basic-magnifier-plus' );
						} else {
							$mapHolder.addClass( 'qodef-fullscreen-map' );
							$mapOpenerIcon.removeClass( 'icon-basic-magnifier-plus' );
							$mapOpenerIcon.addClass( 'icon-basic-magnifier-minus' );
						}

						window.qodefGoogleMap.init(
							$( '#qodef-multiple-map-holder' ),
							{ selectorIsID: true, multipleTrigger: true }
						);
					}
				);
			}
		}
	};

	var qodefPropertyImageMapTabs = {
		init: function () {
			this.holder = $( '.qodef-image-map-gallery' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefPropertyImageMapTabs.initTabs( $( this ) );
					}
				);
			}
		},
		initTabs: function ( $tabs ) {
			$tabs.find( '.qodef-tabs-content' ).each( function ( index ) {
				index = index + 1;

				var $that = $( this ),
					link = $that.attr( 'id' ),
					$navItem = $that.parent().find( '.qodef-tabs-navigation li:nth-child(' + index + ') a' ),
					navLink = $navItem.attr( 'href' );

				link = '#' + link;

				if ( link.indexOf( navLink ) > -1 ) {
					$navItem.attr(
						'href',
						link
					);
				}
			} );

			if ( $tabs.hasClass( 'qodef-image-map-gallery-display' ) ) {
				var liItem = $tabs.find( '.qodef-tabs-navigation li' );
				var tabImages = $tabs.find( '.qodef-property-image-map-holder .qodef-property-image-map-inner' );

				setTimeout(
					function () {
						var initActiveLi = $tabs.find( '.qodef-tabs-navigation li.ui-tabs-active' ).attr( 'data-index' );
						var initActiveImg = $tabs.find( '.qodef-property-image-map-holder .qodef-property-image-map-inner[data-index="' + initActiveLi + '"]' );

						// initial active img
						initActiveImg.addClass( 'qodef-section-active' );
					},
					100
				);

				liItem.on(
					'click',
					function () {
						var $thisLiItemIndex = $( this ).attr( 'data-index' );
						var $newActiveImg = $tabs.find( '.qodef-property-image-map-holder .qodef-property-image-map-inner[data-index="' + $thisLiItemIndex + '"]' );

						tabImages.removeClass( 'qodef-section-active' );
						$newActiveImg.addClass( 'qodef-section-active' );
						qodefPropertyImageMapGallery.init();
					}
				);
			}

			$tabs.addClass( 'qodef--init' ).tabs();

			qodefPropertyImageMapTabs.animateTabBorder( $tabs );
			qodefPropertyImageMapTabs.animateNavBorder( $tabs );
		},
		animateTabBorder: function ( $tabs ) {
			var $itemHolder = $tabs.find('.qodef-tabs-navigation'),
				$activeTab  = $itemHolder.find('.ui-state-active'),
				$tab        = $itemHolder.find('li'),
				$tabLink    = $itemHolder.find('li a'),
				$item,
				left,
				width;

			$itemHolder.append("<span class='qodef-following-tab-border'></span>");

			var $border = $itemHolder.find('.qodef-following-tab-border');

			$border
				.width($activeTab.outerWidth())
				.css('left', $tab.position().left)
				.data('defaultLeft', $border.position().left)
				.data('defaultWidth', $border.width());

			$tab.hover(
				function () {
					$item = $( this );
					left = $item.position().left;
					width = $item.outerWidth();
					$border.stop().animate({
						left: left,
						width: width
					}, 'easeOutQuart');
				},
				function () {
					$border.stop().animate({
						left: $border.data('defaultLeft'),
						width: $border.data('defaultWidth')
					}, 'easeOutQuart');
				}
			);

			$tabLink.on(
				'click',
				function () {
					$border
						.width($( this ).parent().outerWidth())
						.css('left', $( this ).parent().position().left)
						.data('defaultLeft', $border.position().left)
						.data('defaultWidth', $border.width());
				}
			);
		},
		animateNavBorder: function ( $tabs ) {
			var $itemHolder = $tabs.find('.qodef-map-navigation'),
				$activeNav  = $itemHolder.find('.active'),
				$nav        = $itemHolder.find('.qodef-map-nav-item'),
				$item,
				top,
				height;

			$itemHolder.append("<span class='qodef-following-nav-border'></span>");

			var $border = $itemHolder.find('.qodef-following-nav-border');

			$border
				.height($activeNav.outerHeight() - 4)
				.css('top', $nav.position().top)
				.data('defaultTop', $border.position().top)
				.data('defaultHeight', $border.height());

			$nav.hover(
				function () {
					$item = $( this );
					top = $item.position().top;
					height = $item.outerHeight() - 4;
					$border.stop().animate({
						top: top,
						height: height
					}, 'easeOutQuart');
				},
				function () {
					$border.stop().animate({
						top: $border.data('defaultTop'),
						height: $border.data('defaultHeight')
					}, 'easeOutQuart');
				}
			);

			$nav.on(
				'click',
				function () {
					$border
						.height($( this ).outerHeight() - 4)
						.css('top', $( this ).position().top)
						.data('defaultTop', $border.position().top)
						.data('defaultHeight', $border.height());
				}
			);
		}
	};

	qodefCore.shortcodes.fokkner_core_property_image_map_gallery.qodefPropertyImageMapTabs = qodefPropertyImageMapTabs;
	qodefCore.shortcodes.fokkner_core_property_image_map_gallery.qodefPropertyImageMapGallery = qodefPropertyImageMapGallery;
	qodefCore.shortcodes.fokkner_core_property_image_map_gallery.qodefPropertyImageMapSVG = qodefPropertyImageMapSVG;
	qodefCore.shortcodes.fokkner_core_property_image_map_gallery.qodefInitPropertyMobileMap = qodefInitPropertyMobileMap;

})( jQuery );
