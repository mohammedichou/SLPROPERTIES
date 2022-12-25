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
