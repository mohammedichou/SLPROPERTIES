<?php

if ( ! function_exists( 'fokkner_core_add_property_list_variation_info_below' ) ) {
	function fokkner_core_add_property_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_property_list_layouts', 'fokkner_core_add_property_list_variation_info_below' );
}
