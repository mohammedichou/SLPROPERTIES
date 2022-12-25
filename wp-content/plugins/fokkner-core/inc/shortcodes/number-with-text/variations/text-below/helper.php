<?php

if ( ! function_exists( 'fokkner_core_add_number_with_text_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_number_with_text_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_number_with_text_layouts', 'fokkner_core_add_number_with_text_variation_text_below' );
}
