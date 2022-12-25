<?php

if ( ! function_exists( 'fokkner_core_get_google_maps_api_key' ) ) {
	/**
	 * Function that check is option enabled or return option value
	 *
	 * @param string $return_type
	 *
	 * @return bool|string
	 */
	function fokkner_core_get_google_maps_api_key( $return_type = 'option' ) {
		$option = fokkner_core_get_option_value( 'admin', 'qodef_maps_api_key' );

		if ( 'is_enabled' === $return_type ) {
			return ! empty( $option );
		}

		return $option;
	}
}

/* MULTIPLE MAP FUNCTIONS - START */
if ( ! function_exists( 'fokkner_core_set_multiple_map_variables' ) ) {
	/**
	 * Function for setting single map variables
	 *
	 * @param array $query - $query is used just for multiple type. $query is Wp_Query args object containing listing items which should be presented on map
	 * @param bool $return - whether map object should be returned (for ajax call) or passed to localize script
	 *
	 * @return array - array with addresses parameters
	 */
	function fokkner_core_set_multiple_map_variables( $query = array() ) {
		$map_variables = array();

		if ( is_array( $query ) && count( $query ) ) {
			$items = qode_framework_get_cpt_items( $query['post_type'], $query );

			if ( ! empty( $items ) ) {
				foreach ( $items as $id => $title ) {
					$map_variables['addresses'][] = fokkner_core_generate_map_params( $id, $query['post_type'] );
				}
			}
		}

		return $map_variables;
	}
}

if ( ! function_exists( 'fokkner_core_get_multiple_map' ) ) {
	/**
	 * Function that renders map holder for multiple listing item
	 *
	 * @param array $query - $query is used just for multiple type. $query is Wp_Query object containing listing items which should be presented on map
	 *
	 * @return string
	 */
	function fokkner_core_get_multiple_map( $query = array() ) {
		$addresses = fokkner_core_set_multiple_map_variables( $query );

		if ( fokkner_core_get_google_maps_api_key( 'is_enabled' ) ) {
			$html = '<div id="qodef-multiple-map-holder" ' . qode_framework_get_inline_attr( json_encode( $addresses ), 'data-addresses' ) . '></div>';
		} else {
			$html = '<p id="qodef-multiple-map-notice">' . esc_html__( 'In order for the map functionality to be enabled please input the Google Map API key in the General section of the Fokkner Options', 'fokkner-core' ) . '</p>';
		}

		do_action( 'fokkner_core_action_after_multiple_map' );

		return $html;
	}
}

/* MULTIPLE MAP FUNCTIONS - START */

/* MAP ITEMS FUNCTIONS START - */
if ( ! function_exists( 'fokkner_core_marker_info_template' ) ) {
	/**
	 * Template with placeholders for marker info window
	 *
	 * uses underscore templates
	 */
	function fokkner_core_marker_info_template() {

		$html = '<script type="text/template" class="qodef-info-window-template">
				<div class="qodef-info-window">
					<div class="qodef-info-window-inner">
						<a itemprop="url" class="qodef-info-window-link" href="<%= itemUrl %>"></a>
						<% if ( featuredImage ) { %>
							<div class="qodef-info-window-image">
								<img itemprop="image" src="<%= featuredImage[0] %>" alt="<%= title %>" width="<%= featuredImage[1] %>" height="<%= featuredImage[2] %>">
							</div>
						<% } %>
						<div class="qodef-info-window-details">
							<h6 itemprop="name" class="qodef-info-window-title"><%= title %></h6>
							<p class="qodef-info-window-location"><%= address %></p>
						</div>
					</div>
				</div>
			</script>';

		print $html;
	}

	add_action( 'fokkner_core_action_after_multiple_map', 'fokkner_core_marker_info_template' );
}

if ( ! function_exists( 'fokkner_core_marker_template' ) ) {
	/**
	 * Template with placeholders for marker
	 */
	function fokkner_core_marker_template() {

		$html = '<script type="text/template" class="qodef-marker-template">
				<div class="qodef-map-marker">
					<div class="qodef-map-marker-inner">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="31px" height="31px" viewBox="0 0 31 31" style="enable-background:new 0 0 31 31;" xml:space="preserve"><g><circle style="fill:#000;" cx="15.5" cy="15.5" r="15.5"/><g><line style="fill:none; stroke:#fff; stroke-width:2; stroke-miterlimit:10;" x1="9" y1="15.5" x2="22" y2="15.5"/><line style="fill:none; stroke:#fff; stroke-width:2; stroke-miterlimit:10;" x1="15.5" y1="9" x2="15.5" y2="22"/></g></g></svg>
					</div>
				</div>
			</script>';

		print $html;
	}

	add_action( 'fokkner_core_action_after_multiple_map', 'fokkner_core_marker_template' );
}

/* MAP ITEMS FUNCTIONS - END */

/* HELPER FUNCTIONS - START */

if ( ! function_exists( 'fokkner_core_generate_map_params' ) ) {
	/**
	 * Function that generate maps parameters
	 *
	 * @param int $item_id
	 * @param string $post_type
	 *
	 * @return array
	 */
	function fokkner_core_generate_map_params( $item_id, $post_type ) {
		$map_params = array();

		//get listing image
		$image_id = get_post_thumbnail_id( $item_id );
		$image    = wp_get_attachment_image_src( $image_id );

		//take marker pin
		$marker_pin = qode_framework_icons()->render_icon( 'icon_pin', 'elegant-icons' );

		//get address params
		$address_array = apply_filters( 'fokkner_core_filter_address_params', array(), $item_id, $post_type );

		//Get item location
		if ( '' === $address_array['address'] && '' === $address_array['address_lat'] && '' === $address_array['address_long'] ) {
			$map_params['location'] = null;
		} else {
			$map_params['location'] = array(
				'address'   => $address_array['address'],
				'latitude'  => $address_array['address_lat'],
				'longitude' => $address_array['address_long'],
			);
		}

		$map_params['title']         = get_the_title( $item_id );
		$map_params['itemId']        = $item_id;
		$map_params['markerPin']     = $marker_pin;
		$map_params['featuredImage'] = $image;
		$map_params['itemUrl']       = get_the_permalink( $item_id );

		return $map_params;
	}
}

/* HELPER FUNCTIONS - END */
