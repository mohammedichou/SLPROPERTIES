<?php

if ( ! function_exists( 'fokkner_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_clients_list_layouts', 'fokkner_core_add_clients_list_variation_image_only' );
}
