<?php

if ( ! function_exists( 'fokkner_core_add_button_variation_textual' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_button_variation_textual( $variations ) {
		$variations['textual'] = esc_html__( 'Textual', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_button_layouts', 'fokkner_core_add_button_variation_textual' );
}
