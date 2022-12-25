<?php

if ( ! function_exists( 'fokkner_core_google_maps_extensions_property' ) ) {
	function fokkner_core_google_maps_extensions_property( $ext ) {
		$ext[] = 'places';

		return $ext;
	}

	add_filter( 'fokkner_core_filter_google_maps_extensions', 'fokkner_core_google_maps_extensions_property' );
}

if ( ! function_exists( 'fokkner_core_include_property_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function fokkner_core_include_property_shortcodes() {
		foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'fokkner_core_include_property_shortcodes' );
}

if ( ! function_exists( 'fokkner_core_include_property_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function fokkner_core_include_property_widgets() {
		foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'fokkner_core_include_property_widgets' );
}

if ( ! function_exists( 'fokkner_core_set_property_single_page_inner_class' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function fokkner_core_set_property_single_page_inner_class( $classes ) {
		$property_template = fokkner_core_get_post_value_through_levels( 'qodef_property_single_item_layout' );

		if ( is_singular('property-item') && isset( $property_template ) && 'full-width-custom' === $property_template ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'fokkner_filter_page_inner_classes', 'fokkner_core_set_property_single_page_inner_class' );
}

if ( ! function_exists( 'fokkner_core_is_property_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function fokkner_core_is_property_title_enabled( $is_enabled ) {

		if ( is_singular( 'property-item' ) ) {
			$property_title = fokkner_core_get_post_value_through_levels( 'qodef_show_title_area_property_single' );
			$is_enabled     = '' === $property_title ? $is_enabled : ( 'no' === $property_title ? false : true );
		}

		return $is_enabled;
	}

	add_filter( 'fokkner_core_filter_is_page_title_enabled', 'fokkner_core_is_property_title_enabled' );
}

if ( ! function_exists( 'fokkner_core_generate_property_archive_with_shortcode' ) ) {
	/**
	 * Function that executes portfolio list shortcode with params on archive pages
	 *
	 * @param string $tax - type of taxonomy
	 * @param string $tax_slug - slug of taxonomy
	 *
	 */
	function fokkner_core_generate_property_archive_with_shortcode( $tax = '', $tax_slug = '' ) {

		$number_of_items        = 12;
		$number_of_items_option = fokkner_core_get_post_value_through_levels( 'qodef_property_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}

		$number_of_columns        = 4;
		$number_of_columns_option = fokkner_core_get_post_value_through_levels( 'qodef_property_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}

		$space_between_items        = 'normal';
		$space_between_items_option = fokkner_core_get_post_value_through_levels( 'qodef_property_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}

		$image_size        = 'landscape';
		$image_size_option = fokkner_core_get_post_value_through_levels( 'qodef_property_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}

		$item_layout        = 'info-below';
		$item_layout_option = fokkner_core_get_post_value_through_levels( 'qodef_property_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_layout = $item_layout_option;
		}

		$params = array(
			'posts_per_page'    => $number_of_items,
			'columns'           => $number_of_columns,
			'space'             => $space_between_items,
			'layout'            => $item_layout,
			'images_proportion' => $image_size,
			'pagination_type'   => 'load-more',
			'additional_params' => 'tax',
			'tax'               => $tax,
			'tax_slug'          => $tax_slug,
		);

		echo FokknerCore_Property_List_Shortcode::call_shortcode( $params );
	}
}

if ( ! function_exists( 'fokkner_core_get_property_items_list' ) ) {
	function fokkner_core_get_property_items_list() {
		$property_items_array = array(
			'0' => esc_html__( 'Select Property', 'fokkner-core' ),
		);

		$query_array = array(
			'post_type'   => 'property-item',
			'post_status' => 'publish',
			'numberposts' => - 1,
		);

		$property_items = get_posts( $query_array );

		if ( is_array( $property_items ) && count( $property_items ) > 0 ) {
			foreach ( $property_items as $property_item ) {
				$property_items_array[ $property_item->ID ] = $property_item->post_title;
			}
		}

		return $property_items_array;
	}
}

if ( ! function_exists( 'fokkner_core_property_get_address_params' ) ) {
	/**
	 * Function that set up address params
	 *
	 * @param array $addresses
	 * @param int $id - id of current post
	 * @param string $post_type
	 *
	 * @return array
	 */
	function fokkner_core_property_get_address_params( $addresses, $id, $post_type ) {
		$address_array = array();

		if ( 'property-item' === $post_type ) {
			$address_string = get_post_meta( $id, 'qodef_property_single_full_address', true );
			$address_lat    = get_post_meta( $id, 'qodef_property_single_latitude', true );
			$address_long   = get_post_meta( $id, 'qodef_property_single_longitude', true );

			$address_array['address']      = '' !== $address_string ? $address_string : '';
			$address_array['address_lat']  = '' !== $address_lat ? $address_lat : '';
			$address_array['address_long'] = '' !== $address_long ? $address_long : '';
		}

		return array_merge( $addresses, $address_array );
	}

	add_filter( 'fokkner_core_filter_address_params', 'fokkner_core_property_get_address_params', 10, 3 );
}
