<?php

if ( ! function_exists( 'fokkner_core_is_back_to_top_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @return bool
	 */
	function fokkner_core_is_back_to_top_enabled() {
		return 'no' !== fokkner_core_get_post_value_through_levels( 'qodef_back_to_top' );
	}
}

if ( ! function_exists( 'fokkner_core_add_back_to_top_to_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function fokkner_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = fokkner_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';

		return $classes;
	}

	add_filter( 'body_class', 'fokkner_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'fokkner_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function fokkner_core_load_back_to_top() {

		if ( fokkner_core_is_back_to_top_enabled() ) {
			$parameters = array();

			fokkner_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}

	add_action( 'fokkner_action_before_wrapper_close_tag', 'fokkner_core_load_back_to_top' );
}
