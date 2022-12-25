<?php

if ( ! function_exists( 'fokkner_core_add_property_info_variation_simple' ) ) {
	function fokkner_core_add_property_info_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_property_info_layouts', 'fokkner_core_add_property_info_variation_simple' );
}
