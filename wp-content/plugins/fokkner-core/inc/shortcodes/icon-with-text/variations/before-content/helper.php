<?php

if ( ! function_exists( 'fokkner_core_add_icon_with_text_variation_before_content' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_icon_with_text_variation_before_content( $variations ) {
		$variations['before-content'] = esc_html__( 'Before Content', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_icon_with_text_layouts', 'fokkner_core_add_icon_with_text_variation_before_content' );
}
