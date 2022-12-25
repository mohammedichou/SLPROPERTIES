<?php

if ( ! function_exists( 'fokkner_core_add_button_variation_outlined' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_button_variation_outlined( $variations ) {
		$variations['outlined'] = esc_html__( 'Outlined', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_button_layouts', 'fokkner_core_add_button_variation_outlined' );
}
