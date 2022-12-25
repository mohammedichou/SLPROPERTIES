<?php

if ( ! function_exists( 'fokkner_core_add_property_list_variation_info_over_image' ) ) {
	function fokkner_core_add_property_list_variation_info_over_image( $variations ) {
		$variations['info-over-image'] = esc_html__( 'Info Over Image', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_property_list_layouts', 'fokkner_core_add_property_list_variation_info_over_image' );
}
