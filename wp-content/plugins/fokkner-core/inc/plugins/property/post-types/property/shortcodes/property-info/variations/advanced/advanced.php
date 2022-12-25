<?php

if ( ! function_exists( 'fokkner_core_add_property_info_variation_advanced' ) ) {
	function fokkner_core_add_property_info_variation_advanced( $variations ) {
		$variations['advanced'] = esc_html__( 'Advanced', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_property_info_layouts', 'fokkner_core_add_property_info_variation_advanced' );
}
