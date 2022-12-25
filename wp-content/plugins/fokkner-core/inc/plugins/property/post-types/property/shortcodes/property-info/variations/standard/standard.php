<?php

if ( ! function_exists( 'fokkner_core_add_property_info_variation_standard' ) ) {
	function fokkner_core_add_property_info_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_property_info_layouts', 'fokkner_core_add_property_info_variation_standard' );
}
