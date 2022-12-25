<?php

if ( ! function_exists( 'fokkner_core_dependency_for_mobile_menu_typography_options' ) ) {
	/**
	 * Function that set dependency values for module global options
	 *
	 * @return array
	 */
	function fokkner_core_dependency_for_mobile_menu_typography_options() {
		return apply_filters( 'fokkner_core_filter_mobile_menu_typography_hide_option', array() );
	}
}
