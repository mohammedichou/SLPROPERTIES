(function ( $ ) {
	'use strict';

	// This case is important when theme is not active
	if ( typeof qodef !== 'object' ) {
		window.qodef = {};
	}

	window.qodefCore                = {};
	qodefCore.shortcodes            = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper: qodef.qodefSwiper,
		qodefPagination: qodef.qodefPagination,
		qodefFilter: qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
		qodefJustifiedGallery: qodef.qodefJustifiedGallery,
	};

	qodefCore.body         = $( 'body' );
	qodefCore.html         = $( 'html' );
	qodefCore.windowWidth  = $( window ).width();
	qodefCore.windowHeight = $( window ).height();
	qodefCore.scroll       = 0;

	$( document ).ready(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
			qodefInlinePageStyle.init();
		}
	);

	$( window ).resize(
		function () {
			qodefCore.windowWidth  = $( window ).width();
			qodefCore.windowHeight = $( window ).height();
		}
	);

	$( window ).scroll(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
		}
	);

	var qodefScroll = {
		disable: function () {
			if ( window.addEventListener ) {
				window.addEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function () {
			if ( window.removeEventListener ) {
				window.removeEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function ( e ) {
			e = e || window.event;
			if ( e.preventDefault ) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function ( e ) {
			var keys = [37, 38, 39, 40];
			for ( var i = keys.length; i--; ) {
				if ( e.keyCode === keys[i] ) {
					qodefScroll.preventDefaultValue( e );
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init: function ( $holder ) {
			if ( $holder.length ) {
				qodefPerfectScrollbar.qodefInitScroll( $holder );
			}
		},
		qodefInitScroll: function ( $holder ) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar(
				$holder[0],
				$defaultParams
			);

			$( window ).resize(
				function () {
					$ps.update();
				}
			);
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $( '#fokkner-core-page-inline-style' );

			if ( this.holder.length ) {
				var style = this.holder.data( 'style' );

				if ( style.length ) {
					$( 'head' ).append( '<style type="text/css">' + style + '</style>' );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefBackToTop.init();
        }
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			var startPos = qodef.scroll,
				newPos   = qodef.scroll,
				step     = .9,
				animationFrameId;

			var startAnimation = function () {
				if ( newPos === 0 ) {
                    return;
                }

				newPos < 0.0001 ? newPos = 0 : null;

				var ease = qodefBackToTop.easingFunction( (startPos - newPos) / startPos );
				$( 'html, body' ).scrollTop( startPos - (startPos - newPos) * ease );
				newPos = newPos * step;

				animationFrameId = requestAnimationFrame( startAnimation );
			};
			startAnimation();
			$( window ).one(
				'wheel touchstart',
				function () {
					cancelAnimationFrame( animationFrameId );
				}
			);
		},
		easingFunction: function ( n ) {
			return 0 == n ? 0 : Math.pow( 1024, n - 1 );
		},
		showHideBackToTop: function () {
			$( window ).scroll( function () {
				var $thisItem = $( this ),
					b         = $thisItem.scrollTop(),
					c         = $thisItem.height(),
					d;

				if ( b > 0 ) {
					d = b + c / 2;
				} else {
					d = 1;
				}

				if ( d < 1e3 ) {
					qodefBackToTop.addClass( 'off' );
				} else {
					qodefBackToTop.addClass( 'on' );
				}
			} );
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( a === 'on' ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefUncoverFooter.init();
		}
	);

	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $( '#qodef-page-footer.qodef--uncover' );

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' ) ) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight( this.holder );

				$( window ).resize(
					function () {
						qodefUncoverFooter.setHeight( qodefUncoverFooter.holder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			$holder.css( 'height', 'auto' );

			var footerHeight = $holder.outerHeight();

			if ( footerHeight > 0 ) {
				$( '#qodef-page-outer' ).css(
					{
						'margin-bottom': footerHeight,
						'background-color': qodefCore.body.css( 'backgroundColor' )
					}
				);

				$holder.css( 'height', footerHeight );
			}
		},
		addClass: function () {
			qodefCore.body.addClass( 'qodef-page-footer--uncover' );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFullscreenMenu.init();
		}
	);

	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' ),
				$menuItems            = $( '#qodef-fullscreen-area nav ul li a' );

			// Open popup menu
			$fullscreenMenuOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();
					var $thisOpener = $( this );

					if ( ! qodefCore.body.hasClass( 'qodef-fullscreen-menu--opened' ) ) {
						qodefFullscreenMenu.openFullscreen( $thisOpener );

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefFullscreenMenu.closeFullscreen( $thisOpener );
								}
							}
						);
					} else {
						qodefFullscreenMenu.closeFullscreen( $thisOpener );
					}
				}
			);

			//open dropdowns
			$menuItems.on(
				'tap click',
				function ( e ) {
					var $thisItem = $( this );

					if ( $thisItem.parent().hasClass( 'menu-item-has-children' ) ) {
						e.preventDefault();
						qodefFullscreenMenu.clickItemWithChild( $thisItem );
					} else if ( $thisItem.attr( 'href' ) !== 'http://#' && $thisItem.attr( 'href' ) !== '#' ) {
						qodefFullscreenMenu.closeFullscreen( $fullscreenMenuOpener );
					}
				}
			);
		},
		openFullscreen: function ( $opener ) {
			$opener.addClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu-animate--out' ).addClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' );
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $opener ) {
			$opener.removeClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' ).addClass( 'qodef-fullscreen-menu-animate--out' );
			qodefCore.qodefScroll.enable();
			$( 'nav.qodef-fullscreen-menu ul.sub_menu' ).slideUp( 200 );
		},
		clickItemWithChild: function ( thisItem ) {
			var $thisItemParent  = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find( '.sub-menu' ).first();

			if ( $thisItemSubMenu.is( ':visible' ) ) {
				$thisItemSubMenu.slideUp( 300 );
				$thisItemParent.removeClass( 'qodef--opened' );
			} else {
				$thisItemSubMenu.slideDown( 300 );
				$thisItemParent.addClass( 'qodef--opened' ).siblings().find( '.sub-menu' ).slideUp( 400 );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefHeaderScrollAppearance.init();
		}
	);

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr( 'class' ).indexOf( 'qodef-header-appearance--' ) !== -1 ? qodefCore.body.attr( 'class' ).match( /qodef-header-appearance--([\w]+)/ )[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if ( appearanceType !== '' && appearanceType !== 'none' ) {
				qodefCore[appearanceType + 'HeaderAppearance']();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefMobileHeaderAppearance.init();
        }
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeaderAppearance = {
		init: function () {
			if ( qodefCore.body.hasClass( 'qodef-mobile-header-appearance--sticky' ) ) {

				var docYScroll1   = qodefCore.scroll,
					displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
					$pageOuter    = $( '#qodef-page-outer' );

				qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );

				$( window ).scroll(
				    function () {
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                        docYScroll1 = qodefCore.scroll;
                    }
				);

				$( window ).resize(
				    function () {
                        $pageOuter.css( 'padding-top', 0 );
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                    }
				);
			}
		},
		showHideMobileHeader: function ( docYScroll1, displayAmount, $pageOuter ) {
			if ( qodefCore.windowWidth <= 1024 ) {
				if ( qodefCore.scroll > displayAmount * 2 ) {
					//set header to be fixed
					qodefCore.body.addClass( 'qodef-mobile-header--sticky' );

					//add transition to it
					setTimeout(
						function () {
							qodefCore.body.addClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//add padding to content so there is no 'jumping'
					$pageOuter.css( 'padding-top', qodefGlobal.vars.mobileHeaderHeight );
				} else {
					//unset fixed header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky' );

					//remove transition
					setTimeout(
						function () {
							qodefCore.body.removeClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//remove padding from content since header is not fixed anymore
					$pageOuter.css( 'padding-top', 0 );
				}

				if ( (qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3) ) {
					//show sticky header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky-display' );
				} else {
					//hide sticky header
					qodefCore.body.addClass( 'qodef-mobile-header--sticky-display' );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefNavMenu.init();
		}
	);

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li' );

			$menuItems.each(
				function () {
					var $thisItem = $( this );

					if ( $thisItem.find( '.qodef-drop-down-second' ).length ) {
						$thisItem.waitForImages(
							function () {
								var $dropdownHolder      = $thisItem.find( '.qodef-drop-down-second' ),
									$dropdownMenuItem    = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
									dropDownHolderHeight = $dropdownMenuItem.outerHeight();

								if ( navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) ) {
									$thisItem.on(
										'touchstart mouseenter',
										function () {
											$dropdownHolder.css(
												{
													'height': dropDownHolderHeight,
													'overflow': 'visible',
													'visibility': 'visible',
													'opacity': '1',
												}
											);
										}
									).on(
										'mouseleave',
										function () {
											$dropdownHolder.css(
												{
													'height': '0px',
													'overflow': 'hidden',
													'visibility': 'hidden',
													'opacity': '0',
												}
											);
										}
									);
								} else {
									if ( qodefCore.body.hasClass( 'qodef-drop-down-second--animate-height' ) ) {
										var animateConfig = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).css(
															{
																'visibility': 'visible',
																'height': '0',
																'opacity': '1',
															}
														);
														$dropdownHolder.stop().animate(
															{
																'height': dropDownHolderHeight,
															},
															400,
															'easeInOutQuint',
															function () {
																$dropdownHolder.css( 'overflow', 'visible' );
															}
														);
													},
													100
												);
											},
											timeout: 100,
											out: function () {
												$dropdownHolder.stop().animate(
													{
														'height': '0',
														'opacity': 0,
													},
													100,
													function () {
														$dropdownHolder.css(
															{
																'overflow': 'hidden',
																'visibility': 'hidden',
															}
														);
													}
												);

												$dropdownHolder.removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( animateConfig );
									} else {
										var config = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).stop().css( { 'height': dropDownHolderHeight } );
													},
													150
												);
											},
											timeout: 150,
											out: function () {
												$dropdownHolder.stop().css( { 'height': '0' } ).removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( config );
									}
								}
							}
						);
					}
				}
			);
		},
		wideDropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--wide' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $menuItem        = $( this );
						var $menuItemSubMenu = $menuItem.find( '.qodef-drop-down-second' );

						if ( $menuItemSubMenu.length ) {
							$menuItemSubMenu.css( 'left', 0 );

							var leftPosition = $menuItemSubMenu.offset().left;

							if ( qodefCore.body.hasClass( 'qodef--boxed' ) ) {
								//boxed layout case
								var boxedWidth = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
								leftPosition   = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': boxedWidth } );

							} else if ( qodefCore.body.hasClass( 'qodef-drop-down-second--full-width' ) ) {
								//wide dropdown full width case
								$menuItemSubMenu.css( { 'left': -leftPosition } );
							} else {
								//wide dropdown in grid case
								$menuItemSubMenu.css( { 'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2 } );
							}
						}
					}
				);
			}
		},
		dropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $thisItem         = $( this ),
							menuItemPosition  = $thisItem.offset().left,
							$dropdownHolder   = $thisItem.find( '.qodef-drop-down-second' ),
							$dropdownMenuItem = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
							dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
							menuItemFromLeft  = $( window ).width() - menuItemPosition;

						if ( qodef.body.hasClass( 'qodef--boxed' ) ) {
							//boxed layout case
							var boxedWidth   = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
							menuItemFromLeft = boxedWidth - menuItemPosition;
						}

						var dropDownMenuFromLeft;

						if ( $thisItem.find( 'li.menu-item-has-children' ).length > 0 ) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						$dropdownHolder.removeClass( 'qodef-drop-down--right' );
						$dropdownMenuItem.removeClass( 'qodef-drop-down--right' );
						if ( menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth ) {
							$dropdownHolder.addClass( 'qodef-drop-down--right' );
							$dropdownMenuItem.addClass( 'qodef-drop-down--right' );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefParallaxBackground.init();
		}
	);

	/**
	 * Init global parallax background functionality
	 */
	var qodefParallaxBackground = {
		init: function ( settings ) {
			this.$sections = $( '.qodef-parallax' );

			// Allow overriding the default config
			$.extend( this.$sections, settings );

			var isSupported = ! qodefCore.html.hasClass( 'touchevents' ) && ! qodefCore.body.hasClass( 'qodef-browser--edge' ) && ! qodefCore.body.hasClass( 'qodef-browser--ms-explorer' );

			if ( this.$sections.length && isSupported ) {
				this.$sections.each(
					function () {
						qodefParallaxBackground.ready( $( this ) );
					}
				);
			}
		},
		ready: function ( $section ) {
			$section.$imgHolder  = $section.find( '.qodef-parallax-img-holder' );
			$section.$imgWrapper = $section.find( '.qodef-parallax-img-wrapper' );
			$section.$img        = $section.find( 'img.qodef-parallax-img' );

			var h           = $section.height(),
				imgWrapperH = $section.$imgWrapper.height();

			$section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

			$section.buffer       = window.pageYOffset;
			$section.scrollBuffer = null;


			//calc and init loop
			requestAnimationFrame(
				function () {
					$section.$imgHolder.animate( { opacity: 1 }, 100 );
					qodefParallaxBackground.calc( $section );
					qodefParallaxBackground.loop( $section );
				}
			);

			//recalc
			$( window ).on(
				'resize',
				function () {
					qodefParallaxBackground.calc( $section );
				}
			);
		},
		calc: function ( $section ) {
			var wH = $section.$imgWrapper.height(),
				wW = $section.$imgWrapper.width();

			if ( $section.$img.width() < wW ) {
				$section.$img.css(
					{
						'width': '100%',
						'height': 'auto',
					}
				);
			}

			if ( $section.$img.height() < wH ) {
				$section.$img.css(
					{
						'height': '100%',
						'width': 'auto',
						'max-width': 'unset',
					}
				);
			}
		},
		loop: function ( $section ) {
			if ( $section.scrollBuffer === Math.round( window.pageYOffset ) ) {
				requestAnimationFrame(
					function () {
						qodefParallaxBackground.loop( $section );
					}
				); //repeat loop

				return false; //same scroll value, do nothing
			} else {
				$section.scrollBuffer = Math.round( window.pageYOffset );
			}

			var wH   = window.outerHeight,
				sTop = $section.offset().top,
				sH   = $section.height();

			if ( $section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH ) {
				var delta = (Math.abs( $section.scrollBuffer + wH - sTop ) / (wH + sH)).toFixed( 4 ), //coeff between 0 and 1 based on scroll amount
					yVal  = (delta * $section.movement).toFixed( 4 );

				if ( $section.buffer !== delta ) {
					$section.$imgWrapper.css( 'transform', 'translate3d(0,' + yVal + '%, 0)' );
				}

				$section.buffer = delta;
			}

			requestAnimationFrame(
				function () {
					qodefParallaxBackground.loop( $section );
				}
			); //repeat loop
		}
	};

	qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefReview.init();
		}
	);

	var qodefReview = {
		init: function () {
			var ratingHolder = $( '#qodef-page-comments-form .qodef-rating-inner' );

			var addActive = function ( stars, ratingValue ) {
				for ( var i = 0; i < stars.length; i++ ) {
					var star = stars[i];

					if ( i < ratingValue ) {
						$( star ).addClass( 'active' );
					} else {
						$( star ).removeClass( 'active' );
					}
				}
			};

			ratingHolder.each(
				function () {
					var thisHolder  = $( this ),
						ratingInput = thisHolder.find( '.qodef-rating' ),
						ratingValue = ratingInput.val(),
						stars       = thisHolder.find( '.qodef-star-rating' );

					addActive( stars, ratingValue );

					stars.on(
						'click',
						function () {
							ratingInput.val( $( this ).data( 'value' ) ).trigger( 'change' );
						}
					);

					ratingInput.change(
						function () {
							ratingValue = ratingInput.val();

							addActive( stars, ratingValue );
						}
					);
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideArea.init();
		}
	);

	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $( 'a.qodef-side-area-opener' ),
				$sideAreaClose  = $( '#qodef-side-area-close' ),
				$sideArea       = $( '#qodef-side-area' );

			qodefSideArea.openerHoverColor( $sideAreaOpener );

			// Open Side Area
			$sideAreaOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					if ( ! qodefCore.body.hasClass( 'qodef-side-area--opened' ) ) {
						qodefSideArea.openSideArea();

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefSideArea.closeSideArea();
								}
							}
						);
					} else {
						qodefSideArea.closeSideArea();
					}
				}
			);

			$sideAreaClose.on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			if ( $sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $sideArea );
			}
		},
		openSideArea: function () {
			var $wrapper      = $( '#qodef-page-wrapper' );
			var currentScroll = $( window ).scrollTop();

			$( '.qodef-side-area-cover' ).remove();
			$wrapper.prepend( '<div class="qodef-side-area-cover"/>' );
			qodefCore.body.removeClass( 'qodef-side-area-animate--out' ).addClass( 'qodef-side-area--opened qodef-side-area-animate--in' );

			$( '.qodef-side-area-cover' ).on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			$( window ).scroll(
				function () {
					if ( Math.abs( qodefCore.scroll - currentScroll ) > 400 ) {
						qodefSideArea.closeSideArea();
					}
				}
			);
		},
		closeSideArea: function () {
			qodefCore.body.removeClass( 'qodef-side-area--opened qodef-side-area-animate--in' ).addClass( 'qodef-side-area-animate--out' );
		},
		openerHoverColor: function ( $opener ) {
			if ( typeof $opener.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $opener.data( 'hover-color' );
				var originalColor = $opener.css( 'color' );

				$opener.on(
					'mouseenter',
					function () {
						$opener.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$opener.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSpinner.init();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefSpinner.init( isEditMode );
			}
		}
	);

	var qodefSpinner = {
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner:not(.qodef-layout--fokkner)' );

			if ( this.holder.length ) {
				qodefSpinner.animateSpinner( this.holder, isEditMode );
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ( $holder, isEditMode ) {
			$( window ).on(
				'load',
				function () {
					qodefSpinner.fadeOutLoader( $holder );
				}
			);

			if ( isEditMode ) {
				qodefSpinner.fadeOutLoader( $holder );
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if ( qodefCore.body.hasClass( 'qodef-spinner--fade-out' ) ) {
				var $pageHolder = $( '#qodef-page-wrapper' ),
					$linkItems  = $( 'a' );

				// If back button is pressed, than show content to avoid state where content is on display:none
				window.addEventListener(
					'pageshow',
					function ( event ) {
						var historyPath = event.persisted || (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
						if ( historyPath && ! $pageHolder.is( ':visible' ) ) {
							$pageHolder.show();
						}
					}
				);

				$linkItems.on(
					'click',
					function ( e ) {
						var $clickedLink = $( this );

						if (
							e.which === 1 && // check if the left mouse button has been pressed
							$clickedLink.attr( 'href' ).indexOf( window.location.host ) >= 0 && // check if the link is to the same domain
							! $clickedLink.hasClass( 'remove' ) && // check is WooCommerce remove link
							$clickedLink.parent( '.product-remove' ).length <= 0 && // check is WooCommerce remove link
							$clickedLink.parents( '.woocommerce-product-gallery__image' ).length <= 0 && // check is product gallery link
							typeof $clickedLink.data( 'rel' ) === 'undefined' && // check pretty photo link
							typeof $clickedLink.attr( 'rel' ) === 'undefined' && // check VC pretty photo link
							! $clickedLink.hasClass( 'lightbox-active' ) && // check is lightbox plugin active
							(typeof $clickedLink.attr( 'target' ) === 'undefined' || $clickedLink.attr( 'target' ) === '_self') && // check if the link opens in the same window
							$clickedLink.attr( 'href' ).split( '#' )[0] !== window.location.href.split( '#' )[0] // check if it is an anchor aiming for a different page
						) {
							e.preventDefault();

							$pageHolder.fadeOut(
								600,
								'easeOutSine',
								function () {
									window.location = $clickedLink.attr( 'href' );
								}
							);
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefSubscribeModal.init();
		}
	);

	var qodefSubscribeModal = {
		init: function () {
			this.holder = $( '#qodef-subscribe-popup-modal' );

			if ( this.holder.length ) {
				var $preventHolder = this.holder.find( '.qodef-sp-prevent' ),
					$modalClose    = $( '.qodef-sp-close' ),
					disabledPopup  = 'no';

				if ( $preventHolder.length ) {
					var isLocalStorage = this.holder.hasClass( 'qodef-sp-prevent-cookies' ),
						$preventInput  = $preventHolder.find( '.qodef-sp-prevent-input' ),
						preventValue   = $preventInput.data( 'value' );

					if ( isLocalStorage ) {
						disabledPopup = localStorage.getItem( 'disabledPopup' );
						sessionStorage.removeItem( 'disabledPopup' );
					} else {
						disabledPopup = sessionStorage.getItem( 'disabledPopup' );
						localStorage.removeItem( 'disabledPopup' );
					}

					$preventHolder.children().on(
						'click',
						function ( e ) {
							if ( preventValue !== 'yes' ) {
								preventValue = 'yes';
								$preventInput.addClass( 'qodef-sp-prevent-clicked' ).data( 'value', 'yes' );
							} else {
								preventValue = 'no';
								$preventInput.removeClass( 'qodef-sp-prevent-clicked' ).data( 'value', 'no' );
							}

							if ( preventValue === 'yes' ) {
								if ( isLocalStorage ) {
									localStorage.setItem( 'disabledPopup', 'yes' );
								} else {
									sessionStorage.setItem( 'disabledPopup', 'yes' );
								}
							} else {
								if ( isLocalStorage ) {
									localStorage.setItem( 'disabledPopup', 'no' );
								} else {
									sessionStorage.setItem( 'disabledPopup', 'no' );
								}
							}
						}
					);
				}

				if ( disabledPopup !== 'yes' ) {
					if ( qodefCore.body.hasClass( 'qodef-sp-opened' ) ) {
						qodefSubscribeModal.handleClassAndScroll( 'remove' );
					} else {
						qodefSubscribeModal.handleClassAndScroll( 'add' );
					}

					$modalClose.on(
						'click',
						function ( e ) {
							e.preventDefault();

							qodefSubscribeModal.handleClassAndScroll( 'remove' );
						}
					);

					// Close on escape
					$( document ).keyup(
						function ( e ) {
							if ( e.keyCode === 27 ) { // KeyCode for ESC button is 27
								qodefSubscribeModal.handleClassAndScroll( 'remove' );
							}
						}
					);
				}
			}
		},

		handleClassAndScroll: function ( option ) {
			if ( option === 'remove' ) {
				qodefCore.body.removeClass( 'qodef-sp-opened' );
				qodefCore.qodefScroll.enable();
			}

			if ( option === 'add' ) {
				qodefCore.body.addClass( 'qodef-sp-opened' );
				qodefCore.qodefScroll.disable();
			}
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefCfSpinner.init();
		}
	);

	var qodefCfSpinner = {
		init: function () {
			this.holder = $('.wpcf7 .ajax-loader');

			if ( this.holder.length ) {
				this.holder.each( function () {
					var $holder	  = $( this );
					var $toAppend = '<svg class="qodef-form-spinner" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg>';

					$holder.append( $toAppend );
				});
			}

		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_button = {};

	$( document ).ready(
		function () {
			qodefButton.init();
		}
	);

	var qodefButton = {
		init: function () {
			this.buttons = $( '.qodef-button' );

			if ( this.buttons.length ) {
				this.buttons.each(
					function () {
						var $thisButton = $( this );

						qodefButton.buttonHoverColor( $thisButton );
						qodefButton.buttonHoverBgColor( $thisButton );
						qodefButton.buttonHoverBorderColor( $thisButton );
					}
				);
			}
		},
		buttonHoverColor: function ( $button ) {
			if ( typeof $button.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $button.data( 'hover-color' );
				var originalColor = $button.css( 'color' );

				$button.on(
					'mouseenter',
					function () {
						qodefButton.changeColor( $button, 'color', hoverColor );
					}
				);
				$button.on(
					'mouseleave',
					function () {
						qodefButton.changeColor( $button, 'color', originalColor );
					}
				);
			}
		},
		buttonHoverBgColor: function ( $button ) {
			if ( typeof $button.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $button.data( 'hover-background-color' );
				var originalBackgroundColor = $button.css( 'background-color' );

				$button.on(
					'mouseenter',
					function () {
						qodefButton.changeColor( $button, 'background-color', hoverBackgroundColor );
					}
				);
				$button.on(
					'mouseleave',
					function () {
						qodefButton.changeColor( $button, 'background-color', originalBackgroundColor );
					}
				);
			}
		},
		buttonHoverBorderColor: function ( $button ) {
			if ( typeof $button.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $button.data( 'hover-border-color' );
				var originalBorderColor = $button.css( 'borderTopColor' );

				$button.on(
					'mouseenter',
					function () {
						qodefButton.changeColor( $button, 'border-color', hoverBorderColor );
					}
				);
				$button.on(
					'mouseleave',
					function () {
						qodefButton.changeColor( $button, 'border-color', originalBorderColor );
					}
				);
			}
		},
		changeColor: function ( $button, cssProperty, color ) {
			$button.css( cssProperty, color );
		}
	};

	qodefCore.shortcodes.fokkner_core_button.qodefButton = qodefButton;

})( jQuery );

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

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_google_map = {};

	$( document ).ready(
		function () {
			qodefGoogleMap.init();
		}
	);

	var qodefGoogleMap = {
		init: function () {
			this.holder = $( '.qodef-google-map' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						if ( typeof window.qodefGoogleMap !== 'undefined' ) {
							window.qodefGoogleMap.init( $( this ).find( '.qodef-m-map' ) );
						}
					}
				);
			}
		}
	};

	qodefCore.shortcodes.fokkner_core_google_map.qodefGoogleMap = qodefGoogleMap;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_icon = {};

	$( document ).ready(
		function () {
			qodefIcon.init();
		}
	);

	var qodefIcon = {
		init: function () {
			this.icons = $( '.qodef-icon-holder' );

			if ( this.icons.length ) {
				this.icons.each(
					function () {
						var $thisIcon = $( this );

						qodefIcon.iconHoverColor( $thisIcon );
						qodefIcon.iconHoverBgColor( $thisIcon );
						qodefIcon.iconHoverBorderColor( $thisIcon );
					}
				);
			}
		},
		iconHoverColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-color' ) !== 'undefined' ) {
				var spanHolder    = $iconHolder.find( 'span' );
				var originalColor = spanHolder.css( 'color' );
				var hoverColor    = $iconHolder.data( 'hover-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							hoverColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							originalColor
						);
					}
				);
			}
		},
		iconHoverBgColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $iconHolder.data( 'hover-background-color' );
				var originalBackgroundColor = $iconHolder.css( 'background-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							hoverBackgroundColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							originalBackgroundColor
						);
					}
				);
			}
		},
		iconHoverBorderColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $iconHolder.data( 'hover-border-color' );
				var originalBorderColor = $iconHolder.css( 'borderTopColor' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							hoverBorderColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							originalBorderColor
						);
					}
				);
			}
		},
		changeColor: function ( iconElement, cssProperty, color ) {
			iconElement.css(
				cssProperty,
				color
			);
		}
	};

	qodefCore.shortcodes.fokkner_core_icon.qodefIcon = qodefIcon;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_image_gallery                    = {};
	qodefCore.shortcodes.fokkner_core_image_gallery.qodefSwiper        = qodef.qodefSwiper;
	qodefCore.shortcodes.fokkner_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})( jQuery );

(function ($) {
	"use strict";

	qodefCore.shortcodes.fokkner_core_image_with_text = {};

	$(document).ready(
		function () {
			qodefImageWithText.init();
		}
	);

	var qodefImageWithText = {
		init: function () {
			var $holder = $('.qodef-image-with-text');

			if ( $holder.length ) {
				$holder.each(
					function () {
						var $thisHolder = $( this );

						qodefImageWithText.scrollAnimation( $thisHolder );
					}
				);
			}
		},
		scrollAnimation: function ( $thisHolder ) {
			if ( $thisHolder.hasClass('qodef-image-action--scrolling-image') ) {
				var $imageHolder = $thisHolder.find('.qodef-m-image'),
					$frame = $thisHolder.find('.qodef-m-frame'),
					$frameHeight,
					$frameWidth,
					$image = $thisHolder.find('.qodef-m-image-holder-inner > a > img, .qodef-m-image-holder-inner > img'),
					$imageHeight,
					$imageWidth,
					$delta,
					$timing,
					$scrollable = false,
					$horizontal = $thisHolder.hasClass('qodef-scrolling--horizontal');

				var setSize = function () {
					$frameHeight = $frame.height();
					$imageHeight = $image.height();
					$frameWidth  = $frame.width();
					$imageWidth  = $image.width();

					if ( $horizontal ) {
						$delta = Math.round($imageWidth - $frameWidth);
						$timing = Math.round($imageWidth / $frameWidth) * 2;
					} else {
						$delta = Math.round($imageHeight - $frameHeight);
						$timing = Math.round($imageHeight / $frameHeight) * 2;
					}

					if ( $horizontal ) {
						if ( $imageWidth > $frameWidth ) {
							$scrollable = true;
						}
					} else {
						if ( $imageHeight > $frameHeight ) {
							$scrollable = true;
						}
					}
				};

				var initAnimation = function () {
					$imageHolder.on(
						'mouseenter',
						function () {
							$image.css('transition-duration', $timing + 's');

							if ( $horizontal ) {
								$image.css('transform', 'translate3d(-' + $delta + 'px, 0px, 0px)');
							} else {
								$image.css('transform', 'translate3d(0px, -' + $delta + 'px, 0px)');
							}
						}
					);

					$imageHolder.on(
						'mouseleave',
						function () {
							if ( $scrollable ) {
								$image.css('transition-duration', Math.min($timing / 3, 3) + 's');
								$image.css('transform', 'translate3d(0px, 0px, 0px)');
							}
						}
					);
				};

				$thisHolder.waitForImages(
					function () {
						$thisHolder.css('visibility', 'visible');
						setSize();
						initAnimation();
					}
				);

				$(window).resize(
					function () {
						setSize();
					}
				);
			}
		}
	};

	qodefCore.shortcodes.fokkner_core_image_with_text.qodefImageWithText = qodefImageWithText;
	qodefCore.shortcodes.fokkner_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;

})(jQuery);
(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_progress_bar = {};

	$( document ).ready(
		function () {
			qodefProgressBar.init();
		}
	);

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $( '.qodef-progress-bar' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this ),
							layout      = $thisHolder.data( 'layout' );

						$thisHolder.appear(
							function () {
								$thisHolder.addClass( 'qodef--init' );

								var $container = $thisHolder.find( '.qodef-m-canvas' ),
									data       = qodefProgressBar.generateBarData( $thisHolder, layout ),
									number     = $thisHolder.data( 'number' ) / 100;

								switch (layout) {
									case 'circle':
										qodefProgressBar.initCircleBar( $container, data, number );
										break;
									case 'semi-circle':
										qodefProgressBar.initSemiCircleBar( $container, data, number );
										break;
									case 'line':
										data = qodefProgressBar.generateLineData( $thisHolder, number );
										qodefProgressBar.initLineBar( $container, data );
										break;
									case 'custom':
										qodefProgressBar.initCustomBar( $container, data, number );
										break;
								}
							}
						);
					}
				);
			}
		},
		generateBarData: function ( thisBar, layout ) {
			var activeWidth   = thisBar.data( 'active-line-width' );
			var activeColor   = thisBar.data( 'active-line-color' );
			var inactiveWidth = thisBar.data( 'inactive-line-width' );
			var inactiveColor = thisBar.data( 'inactive-line-color' );
			var easing        = 'linear';
			var duration      = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor     = thisBar.data( 'text-color' );

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function ( state, bar ) {
					if ( layout !== 'custom' ) {
						bar.setText( Math.round( bar.value() * 100 ) + '%' );
					}
				},
			};
		},
		generateLineData: function ( thisBar, number ) {
			var height         = thisBar.data( 'active-line-width' );
			var activeColor    = thisBar.data( 'active-line-color' );
			var inactiveHeight = thisBar.data( 'inactive-line-width' );
			var inactiveColor  = thisBar.data( 'inactive-line-color' );
			var duration       = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor      = thisBar.data( 'text-color' );

			return {
				percentage: number * 100,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: thisBar.hasClass( 'qodef-percentage--floating' ),
				textColor: textColor,
			};
		},
		initCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Circle( $container[0], data );

				$bar.animate( number );
			}
		},
		initSemiCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.SemiCircle( $container[0], data );

				$bar.animate( number );
			}
		},
		initCustomBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Path( $container[0], data );

				$bar.set( 0 );
				$bar.animate( number );
			}
		},
		initLineBar: function ( $container, data ) {
			$container.LineProgressbar( data );
		},
		checkBar: function ( $container ) {
			// check if svg is already in container, elementor fix
			if ( $container.find( 'svg' ).length ) {
				return false;
			}

			return true;
		}
	};

	qodefCore.shortcodes.fokkner_core_progress_bar.qodefProgressBar = qodefProgressBar;

})( jQuery );

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

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_tabs = {};

	$( document ).ready(
		function () {
			qodefTabs.init();
		}
	);

	var qodefTabs = {
		init: function () {
			this.holder = $( '.qodef-tabs' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTabs.initTabs( $( this ) );
					}
				);
			}
		},
		initTabs: function ( $tabs ) {
			$tabs.children( '.qodef-tabs-content' ).each( function ( index ) {
				index = index + 1;

				var $that    = $( this ),
					link     = $that.attr( 'id' ),
					$navItem = $that.parent().find( '.qodef-tabs-navigation li:nth-child(' + index + ') a' ),
					navLink  = $navItem.attr( 'href' );

				link = '#' + link;

				if ( link.indexOf( navLink ) > -1 ) {
					$navItem.attr( 'href', link );
				}
			} );

			$tabs.addClass( 'qodef--init' ).tabs();

			qodefTabs.animateBorder( $tabs );
		},
		animateBorder: function ( $tabs ) {
			var $itemHolder = $tabs.find('.qodef-tabs-navigation'),
				$activeTab  = $itemHolder.find('.ui-state-active'),
				$tab        = $itemHolder.find('li'),
				$tabLink    = $itemHolder.find('li a'),
				$item,
				left,
				width;

			$itemHolder.append("<span class='qodef-following-border'></span>");

			var $border = $itemHolder.find('.qodef-following-border');

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
		}
	};

	qodefCore.shortcodes.fokkner_core_tabs.qodefTabs = qodefTabs;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_tabs_showcase = {};

	$( document ).ready(
		function () {
			qodefTabsShowcase.init();
		}
	);

	var qodefTabsShowcase = {
		init: function () {
			this.holder = $( '.qodef-tabs-showcase' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTabsShowcase.initTabs( $( this ) );
					}
				);
			}
		},
		initTabs: function ( $tabs ) {
			$tabs.find( '.qodef-tabs-showcase-content' ).each( function ( index ) {
				index = index + 1;

				var $that    = $( this ),
					link     = $that.attr( 'id' ),
					$navItem = $that.parent().find( '.qodef-tabs-showcase-navigation li:nth-child(' + index + ') a' ),
					navLink  = $navItem.attr( 'href' );

				link = '#' + link;

				if ( link.indexOf( navLink ) > -1 ) {
					$navItem.attr( 'href', link );
				}
			} );

			if ( $tabs.hasClass('qodef-tabs-with-images') ) {
				var liItem     = $tabs.find('.qodef-tabs-showcase-navigation li');
				var tabImages  = $tabs.find('.qodef-tabs-images .qodef-tab-image');

				setTimeout(
					function () {
						var initActiveLi  = $tabs.find('.qodef-tabs-showcase-navigation li.ui-tabs-active').attr( 'data-index' );
						var initActiveImg = $tabs.find('.qodef-tabs-images .qodef-tab-image[data-index="'+ initActiveLi +'"]');

						// initial active img
						initActiveImg.addClass('qodef-img-active');
					},
					100
				);

				liItem.on('click', function() {
					var $thisLiItemIndex  = $( this ).attr( 'data-index' );
					var $newActiveImg = $tabs.find('.qodef-tabs-images .qodef-tab-image[data-index="'+ $thisLiItemIndex +'"]');

					tabImages.removeClass('qodef-img-active');
					$newActiveImg.addClass('qodef-img-active');
				});
			}

			$tabs.addClass( 'qodef--init' ).tabs();

			qodefTabsShowcase.animateBorder( $tabs );
		},
		animateBorder: function ( $tabs ) {
			var $itemHolder = $tabs.find('.qodef-tabs-showcase-navigation'),
				$activeTab  = $itemHolder.find('.ui-state-active'),
				$tab        = $itemHolder.find('li'),
				$tabLink    = $itemHolder.find('li a'),
				$item,
				left,
				width;

			$itemHolder.append("<span class='qodef-following-border'></span>");

			var $border = $itemHolder.find('.qodef-following-border');

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
		}
	};

	qodefCore.shortcodes.fokkner_core_tabs_showcase.qodefTabsShowcase = qodefTabsShowcase;

})( jQuery );

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
(function ( $ ) {
	'use strict';

	var shortcode = 'fokkner_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	$( window ).on(
		'load',
		function () {
			qodefBlogList.init();
		}
	);

	var qodefBlogList = {
		init: function () {
			this.blog = $('.qodef-blog');

			if ( this.blog.length ) {
				this.blog.each(
					function () {
						var $thisBlogList = $( this );

						if ( $thisBlogList.hasClass('qodef-hover-animation--enabled') ) {
							qodefBlogList.linkHover( $thisBlogList );
						}
					}
				)
			}
		},
		linkHover: function ( $holder ) {
			var $items = $holder.find('.qodef-blog-item');

			$items.each( function() {
				var $thisItem = $(this),
					$itemMedia = $thisItem.find('.qodef-e-media-image'),
					$titleLink = $thisItem.find('.qodef-e-title-link');

				$itemMedia.on(
					'mouseenter',
					function () {
						$thisItem.addClass('qodef--active');
					}
				);

				$itemMedia.on(
					'mouseleave',
					function () {
						$thisItem.removeClass('qodef--active');
					}
				);

				$titleLink.on(
					'mouseenter',
					function () {
						$thisItem.addClass('qodef--active');
					}
				);

				$titleLink.on(
					'mouseleave',
					function () {
						$thisItem.removeClass('qodef--active');
					}
				);
			});
		}
	}

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;
	qodefCore.shortcodes[shortcode].qodefBlogList = qodefBlogList;

})( jQuery );
(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefVerticalNavMenu.init();
		}
	);

	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalNavMenu = {
		initNavigation: function ( $verticalMenuObject ) {
			var $verticalNavObject = $verticalMenuObject.find( '.qodef-header-vertical-navigation' );

			if ( $verticalNavObject.hasClass( 'qodef-vertical-drop-down--below' ) ) {
				qodefVerticalNavMenu.dropdownClickToggle( $verticalNavObject );
			} else if ( $verticalNavObject.hasClass( 'qodef-vertical-drop-down--side' ) ) {
				qodefVerticalNavMenu.dropdownFloat( $verticalNavObject );
			}
		},
		dropdownClickToggle: function ( $verticalNavObject ) {
			var $menuItems = $verticalNavObject.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second, > ul' );
					var menuItem         = this;
					var $dropdownOpener  = $( this ).find( '> a' );
					var slideUpSpeed     = 'fast';
					var slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$( menuItem ).removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$( this ).parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $( this ).parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$( this ).parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
		dropdownFloat: function ( $verticalNavObject ) {
			var $menuItems = $verticalNavObject.find( 'ul li.menu-item-has-children' );
			var $allDropdowns = $menuItems.find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );
					var menuItem         = this;

					if ( Modernizr.touch ) {
						var $dropdownOpener = $( this ).find( '> a' );

						$dropdownOpener.on(
							'click tap',
							function ( e ) {
								e.preventDefault();
								e.stopPropagation();

								if ( $elementToExpand.hasClass( 'qodef-float--open' ) ) {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								} else {
									if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
										$menuItems.removeClass( 'qodef-menu-item--open' );
										$allDropdowns.removeClass( 'qodef-float--open' );
									}

									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								}
							}
						);
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$( this ).hoverIntent(
							{
								over: function () {
									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								},
								out: function () {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								},
								timeout: 300
							}
						);
					}
				}
			);
		},
		verticalAreaScrollable: function ( $verticalMenuObject ) {
			return $verticalMenuObject.hasClass( 'qodef-with-scroll' );
		},
		initVerticalAreaScroll: function ( $verticalMenuObject ) {
			if ( qodefVerticalNavMenu.verticalAreaScrollable( $verticalMenuObject ) && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $verticalMenuObject );
			}
		},
		init: function () {
			var $verticalMenuObject = $( '.qodef-header--vertical #qodef-page-header' );

			if ( $verticalMenuObject.length ) {
				qodefVerticalNavMenu.initNavigation( $verticalMenuObject );
				qodefVerticalNavMenu.initVerticalAreaScroll( $verticalMenuObject );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var fixedHeaderAppearance = {
		showHideHeader: function ( $pageOuter, $header ) {
			if ( qodefCore.windowWidth > 1024 ) {
				if ( qodefCore.scroll <= 0 ) {
					qodefCore.body.removeClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', '0' );
					$header.css( 'margin-top', '0' );
				} else {
					qodefCore.body.addClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight ) + 'px' );
					$header.css( 'margin-top', parseInt( qodefGlobal.vars.topAreaHeight ) + 'px' );
				}
			}
		},
		init: function () {

			if ( ! qodefCore.body.hasClass( 'qodef-header--vertical' ) ) {
				var $pageOuter = $( '#qodef-page-outer' ),
					$header    = $( '#qodef-page-header' );

				fixedHeaderAppearance.showHideHeader( $pageOuter, $header );

				$( window ).scroll(
					function () {
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);

				$( window ).resize(
					function () {
						$pageOuter.css( 'padding-top', '0' );
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);
			}
		}
	};

	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	var stickyHeaderAppearance = {
		header: '',
		docYScroll: 0,
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			// Set variables
			stickyHeaderAppearance.header 	  = $( '.qodef-header-sticky' );
			stickyHeaderAppearance.docYScroll = $( document ).scrollTop();

			// Set sticky visibility
			stickyHeaderAppearance.setVisibility( displayAmount );

			$( window ).scroll(
				function () {
					stickyHeaderAppearance.setVisibility( displayAmount );
				}
			);
		},
		displayAmount: function () {
			if ( qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0 ) {
				return parseInt( qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10 );
			} else {
				return parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10 );
			}
		},
		setVisibility: function ( displayAmount ) {
			var isStickyHidden = qodefCore.scroll < displayAmount;

			if ( stickyHeaderAppearance.header.hasClass( 'qodef-appearance--up' ) ) {
				var currentDocYScroll = $( document ).scrollTop();

				isStickyHidden = (currentDocYScroll > stickyHeaderAppearance.docYScroll && currentDocYScroll > displayAmount) || (currentDocYScroll < displayAmount);

				stickyHeaderAppearance.docYScroll = $( document ).scrollTop();
			}

			stickyHeaderAppearance.showHideHeader( isStickyHidden );
		},
		showHideHeader: function ( isStickyHidden ) {
			if ( isStickyHidden ) {
				qodefCore.body.removeClass( 'qodef-header--sticky-display' );
			} else {
				qodefCore.body.addClass( 'qodef-header--sticky-display' );
			}
		},
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchCoversHeader.init();
		}
	);

	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchForm   = $( '.qodef-search-cover-form' ),
				$searchClose  = $searchForm.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchForm.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.openCoversHeader( $searchForm );
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.closeCoversHeader( $searchForm );
					}
				);
			}
		},
		openCoversHeader: function ( $searchForm ) {
			qodefCore.body.addClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).focus();
				},
				600
			);
		},
		closeCoversHeader: function ( $searchForm ) {
			qodefCore.body.removeClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.addClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).val( '' );
					$searchForm.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );
				},
				300
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchFullscreen.init();
		}
	);

	var qodefSearchFullscreen = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchHolder = $( '.qodef-fullscreen-search-holder' ),
				$searchClose  = $searchHolder.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchHolder.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						if ( qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) {
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						} else {
							qodefSearchFullscreen.openFullscreen( $searchHolder );
						}
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchFullscreen.closeFullscreen( $searchHolder );
					}
				);

				//Close on escape
				$( document ).keyup(
					function ( e ) {
						if ( e.keyCode === 27 && qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) { //KeyCode for ESC button is 27
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						}
					}
				);
			}
		},
		openFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).focus();
				},
				900
			);

			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--fadeout' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).val( '' );
					$searchHolder.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
				},
				300
			);

			qodefCore.qodefScroll.enable();
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearch.init();
		}
	);

	var qodefSearch = {
		init: function () {
			this.search = $( 'a.qodef-search-opener' );

			if ( this.search.length ) {
				this.search.each(
					function () {
						var $thisSearch = $( this );

						qodefSearch.searchHoverColor( $thisSearch );
					}
				);
			}
		},
		searchHoverColor: function ( $searchHolder ) {
			if ( typeof $searchHolder.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $searchHolder.data( 'hover-color' ),
					originalColor = $searchHolder.css( 'color' );

				$searchHolder.on(
					'mouseenter',
					function () {
						$searchHolder.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$searchHolder.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ($) {
    "use strict";

    $( document ).ready(
        function () {
            qodefFokknerSpinner.init();
        }
    );

    $( window ).on(
        'load',
        function () {
            qodefFokknerSpinner.windowLoaded = true;
        }
    );

    $( window ).on(
        'elementor/frontend/init',
        function() {
            var isEditMode = Boolean( elementorFrontend.isEditMode() );

            if ( isEditMode ) {
                qodefFokknerSpinner.init( isEditMode );
            }
        }
    );

    var qodefFokknerSpinner = {
        init: function ( isEditMode ) {
            var $holder = $('#qodef-page-spinner.qodef-layout--fokkner');

            if ( $holder.length ) {
                if ( isEditMode ) {
                    qodefFokknerSpinner.fadeOutLoader( $holder );
                } else {
                    qodefFokknerSpinner.animateSpinner( $holder );
                }
            }
        },
        animateSpinner: function ( $holder ) {
            $holder.addClass('qodef--init');

            var $revSlider = $( '#qodef-main-rev-holder rs-module' );

            setTimeout(
                function () {
                    $holder.addClass('qodef--animate');
                }, 800
            )

            setTimeout(
                function () {
                    if ( qodefFokknerSpinner.windowLoaded ) {
                        qodefFokknerSpinner.fadeOutLoader( $holder );

                        if ( $revSlider.length ) {
                            $revSlider.revstart();
                        }
                    } else {
                        var interval = setInterval(
                            function() {
                                if ( qodefFokknerSpinner.windowLoaded ) {
                                    clearInterval(interval);

                                    qodefFokknerSpinner.fadeOutLoader( $holder );

                                    if ( $revSlider.length ) {
                                        $revSlider.revstart();
                                    }
                                }
                            }, 100
                        );
                    }
                }, 3000
            );
        },
        fadeOutLoader: function ($holder, speed, delay, easing) {
            speed = speed ? speed : 500;
            delay = delay ? delay : 0;
            easing = easing ? easing : 'swing';

            if ($holder.length) {
                $holder.delay(delay).fadeOut(speed, easing);
                $(window).on('bind', 'pageshow', function (event) {
                    if (event.originalEvent.persisted) {
                        $holder.fadeOut(speed, easing);
                    }
                });
            }
        }
    };

})(jQuery);
(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefProgressBarSpinner.init();
		}
	);

	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			if ( this.holder.length ) {
				qodefProgressBarSpinner.animateSpinner( this.holder );
			}
		},
		animateSpinner: function ( $holder ) {

			var $numberHolder = $holder.find( '.qodef-m-spinner-number-label' ),
				$spinnerLine  = $holder.find( '.qodef-m-spinner-line-front' ),
				numberIntervalFastest,
				windowLoaded  = false;

			$spinnerLine.animate(
				{ 'width': '100%' },
				10000,
				'linear'
			);

			var numberInterval = setInterval(
				function () {
					qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );

					if ( windowLoaded ) {
						clearInterval( numberInterval );
					}
				},
				100
			);

			$( window ).on(
				'load',
				function () {
					windowLoaded = true;

					numberIntervalFastest = setInterval(
						function () {
							if ( qodefProgressBarSpinner.percentNumber >= 100 ) {
								clearInterval( numberIntervalFastest );
								$spinnerLine.stop().animate(
									{ 'width': '100%' },
									500
								);

								setTimeout(
									function () {
										$holder.addClass( 'qodef--finished' );

										setTimeout(
											function () {
												qodefProgressBarSpinner.fadeOutLoader( $holder );
											},
											1000
										);
									},
									600
								);
							} else {
								qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );
							}
						},
						6
					);
				}
			);
		},
		animatePercent: function ( $numberHolder, percentNumber ) {
			if ( percentNumber < 100 ) {
				percentNumber += 5;
				$numberHolder.text( percentNumber );

				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_instagram_list = {};

	$( document ).ready(
		function () {
			qodefInstagram.init();
		}
	);

	var qodefInstagram = {
		init: function () {
			this.holder = $( '.sbi.qodef-instagram-swiper-container' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder     = $( this ),
							sliderOptions   = $thisHolder.parent().attr( 'data-options' ),
							$instagramImage = $thisHolder.find( '.sbi_item.sbi_type_image' ),
							$imageHolder    = $thisHolder.find( '#sbi_images' );

						$thisHolder.attr( 'data-options', sliderOptions );

						$imageHolder.addClass( 'swiper-wrapper' );

						if ( $instagramImage.length ) {
							$instagramImage.each(
								function () {
									$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
								}
							);
						}

						if ( typeof qodef.qodefSwiper === 'object' ) {
							qodef.qodefSwiper.init( $thisHolder );
						}
					}
				);
			}
		},
	};

	qodefCore.shortcodes.fokkner_core_instagram_list.qodefInstagram = qodefInstagram;
	qodefCore.shortcodes.fokkner_core_instagram_list.qodefSwiper    = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	/*
	 **	Re-init scripts on gallery loaded
	 */
	$( document ).on(
		'yith_wccl_product_gallery_loaded',
		function () {

			if ( typeof qodefCore.qodefWooMagnificPopup === 'function' ) {
				qodefCore.qodefWooMagnificPopup.init();
			}
		}
	);

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'fokkner_core_product_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideAreaCart.init();
		}
	);

	var qodefSideAreaCart = {
		init: function () {
			var $holder = $( '.qodef-woo-side-area-cart' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						var $thisHolder = $( this );

						if ( qodefCore.windowWidth > 680 ) {
							qodefSideAreaCart.trigger( $thisHolder );

							qodefCore.body.on(
								'added_to_cart',
								function () {
									qodefSideAreaCart.trigger( $thisHolder );
								}
							);
						}
					}
				);
			}
		},
		trigger: function ( $holder ) {
			var $opener = $holder.find( '.qodef-m-opener' ),
				$close  = $holder.find( '.qodef-m-close' ),
				$items  = $holder.find( '.qodef-m-items' );

			// Open Side Area
			$opener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					if ( ! $holder.hasClass( 'qodef--opened' ) ) {
						qodefSideAreaCart.openSideArea( $holder );

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefSideAreaCart.closeSideArea( $holder );
								}
							}
						);
					} else {
						qodefSideAreaCart.closeSideArea( $holder );
					}
				}
			);

			$close.on(
				'click',
				function ( e ) {
					e.preventDefault();

					qodefSideAreaCart.closeSideArea( $holder );
				}
			);

			if ( $items.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $items );
			}
		},
		openSideArea: function ( $holder ) {
			qodefCore.qodefScroll.disable();

			$holder.addClass( 'qodef--opened' );
			$( '#qodef-page-wrapper' ).prepend( '<div class="qodef-woo-side-area-cart-cover"/>' );

			$( '.qodef-woo-side-area-cart-cover' ).on(
				'click',
				function ( e ) {
					e.preventDefault();

					qodefSideAreaCart.closeSideArea( $holder );
				}
			);
		},
		closeSideArea: function ( $holder ) {
			if ( $holder.hasClass( 'qodef--opened' ) ) {
				qodefCore.qodefScroll.enable();

				$holder.removeClass( 'qodef--opened' );
				$( '.qodef-woo-side-area-cart-cover' ).remove();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_clients_list             = {};
	qodefCore.shortcodes.fokkner_core_clients_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_testimonials_list             = {};
	qodefCore.shortcodes.fokkner_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'fokkner_core_team_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_apartment_indent_slider = {};

	$( document ).ready(
		function () {
			qodefInitPaginationPosition.init();
		}
	);

	var qodefInitPaginationPosition = {
		init: function () {
			this.holder = $( '.qodef-apartment-indent-slider' );

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

	qodefCore.shortcodes.fokkner_core_apartment_indent_slider.qodefInitPaginationPosition  = qodefInitPaginationPosition;

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes.fokkner_core_apartment_indent_slider[key] = value;
			}
		);
	}

})( jQuery );

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

(function ( $ ) {
	'use strict';

	var shortcode = 'fokkner_core_property_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.fokkner_core_property_map = {};

	$( document ).ready(
		function () {
			qodefInitGoogleMapPropertyItems.init();
		}
	);

	$( window ).on(
		'load',
		function () {
		}
	);

	$( window ).resize(
		function () {
		}
	);

	var qodefInitGoogleMapPropertyItems = {
		init: function () {
			this.holder = $( '#qodef-multiple-map-holder' );

			if ( this.holder.length && typeof window.qodefGoogleMap !== 'undefined' ) {
				qodefMapsVariables.multiple = this.holder.data( 'addresses' );

				window.qodefGoogleMap.init(
					this.holder,
					{
						selectorIsID: true,
						multipleTrigger: true,
					}
				);
			}
		}
	};

	function qodefBindListTitlesAndMap() {
		var $itemsList = $( '.qodef-map-list-holder' );

		if ( $itemsList.length ) {
			$itemsList.each(
				function () {
					var $listItems = $( this ).find( 'article' ),
						$map       = $( this ).find( '.qodef-map' );

					if ( $map.length ) {
						$listItems.each(
							function () {
								// init hover
								var $listItem = $( this );

								if ( ! $listItem.hasClass( 'qodef-init' ) ) {
									$listItem.on(
										'mouseenter',
										function () {
											var itemId                 = $listItem.data( 'id' ),
												$inactiveMarkersHolder = $( '.qodef-map-marker-holder:not(.qodef-map-active)' ),
												$clusterMarkersHolder  = $( '.qodef-cluster-marker' );

											if ( $inactiveMarkersHolder.length ) {
												$inactiveMarkersHolder.removeClass( 'qodef-active' );
												$( '#' + itemId + '.qodef-map-marker-holder' ).addClass( 'qodef-active' );
											}

											if ( $clusterMarkersHolder.length ) {
												$clusterMarkersHolder.each(
													function () {
														var $thisClusterMarker    = $( this ),
															clusterMarkersItemIds = $thisClusterMarker.data( 'item-ids' );

														if ( clusterMarkersItemIds !== undefined && clusterMarkersItemIds.includes( itemId.toString() ) ) {
															$thisClusterMarker.addClass( 'qodef-active' );
														}
													}
												);
											}
										}
									).on(
										'mouseleave',
										function () {
											var $markersHolder        = $( '.qodef-map-marker-holder' ),
												$clusterMarkersHolder = $( '.qodef-cluster-marker' );

											if ( $markersHolder.length ) {
												$markersHolder.each(
													function () {
														var $thisMapHolder = $( this );

														if ( ! $thisMapHolder.hasClass( 'qodef-map-active' ) ) {
															$thisMapHolder.removeClass( 'qodef-active' );
														}
													}
												);
											}

											if ( $clusterMarkersHolder.length ) {
												$clusterMarkersHolder.removeClass( 'qodef-active' );
											}
										}
									);

									$listItem.addClass( 'qodef-init' );
								}
							}
						);
					}
				}
			);
		}
	}

	qodefCore.shortcodes.fokkner_core_property_map.qodefInitGoogleMapPropertyItems  = qodefInitGoogleMapPropertyItems;

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes.fokkner_core_property_map[key] = value;
			}
		);
	}

})( jQuery );
