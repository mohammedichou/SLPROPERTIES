<?php

if ( ! function_exists( 'fokkner_core_add_single_image_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_single_image_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_single_image_layouts', 'fokkner_core_add_single_image_variation_default' );
}
