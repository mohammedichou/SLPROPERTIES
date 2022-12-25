<?php

if ( ! function_exists( 'fokkner_core_add_icon_with_text_variation_before_title' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_icon_with_text_variation_before_title( $variations ) {
		$variations['before-title'] = esc_html__( 'Before Title', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_icon_with_text_layouts', 'fokkner_core_add_icon_with_text_variation_before_title' );
}
