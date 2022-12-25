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
