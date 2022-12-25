<?php

function fokkner_core_remove_filter_for_anonymous_class( $hook_name = '', $class_name = '', $method_name = '', $priority = 0 ) {
	global $wp_filter;

	// Take only filters on right hook name and priority
	if ( ! isset( $wp_filter[ $hook_name ][ $priority ] ) || ! is_array( $wp_filter[ $hook_name ][ $priority ] ) ) {
		return false;
	}

	foreach ( (array) $wp_filter[ $hook_name ][ $priority ] as $unique_id => $filter_array ) {
		if ( isset( $filter_array['function'] ) && is_array( $filter_array['function'] ) ) {
			if ( is_object( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) == $class_name && $filter_array['function'][1] == $method_name ) {

				if ( is_a( $wp_filter[ $hook_name ], 'WP_Hook' ) ) {
					unset( $wp_filter[ $hook_name ]->callbacks[ $priority ][ $unique_id ] );
				} else {
					unset( $wp_filter[ $hook_name ][ $priority ][ $unique_id ] );
				}
			}
		}
	}

	return false;
}

//function to remove ImageMapPro script from elementor wp_footer hook, but it has to hook in to elementor wp_head in order to remove it before it is executed
if ( ! function_exists( 'fokkner_core_remove_image_map_pro_script' ) ) {
	function fokkner_core_remove_image_map_pro_script() {
		if ( class_exists( 'ImageMapPro' ) ) {
			fokkner_core_remove_filter_for_anonymous_class( 'wp_footer', 'ImageMapPro', 'call_plugin', 10 );
		}
	}

	add_action( 'elementor/editor/wp_head', 'fokkner_core_remove_image_map_pro_script' );
}
