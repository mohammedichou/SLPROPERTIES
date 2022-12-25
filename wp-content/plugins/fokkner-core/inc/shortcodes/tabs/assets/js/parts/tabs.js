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
