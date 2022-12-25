<?php

if ( ! function_exists( 'fokkner_core_add_cube_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function fokkner_core_add_cube_spinner_layout_option( $layouts ) {
		$layouts['cube'] = esc_html__( 'Cube', 'fokkner-core' );

		return $layouts;
	}

	add_filter( 'fokkner_core_filter_page_spinner_layout_options', 'fokkner_core_add_cube_spinner_layout_option' );
}
