<?php

if ( ! function_exists( 'fokkner_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function fokkner_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'fokkner_filter_mobile_header_template', fokkner_get_template_part( 'mobile-header', 'templates/mobile-header' ) );
	}

	add_action( 'fokkner_action_page_header_template', 'fokkner_load_page_mobile_header' );
}

if ( ! function_exists( 'fokkner_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function fokkner_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'fokkner_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'fokkner' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'fokkner_action_after_include_modules', 'fokkner_register_mobile_navigation_menus' );
}
