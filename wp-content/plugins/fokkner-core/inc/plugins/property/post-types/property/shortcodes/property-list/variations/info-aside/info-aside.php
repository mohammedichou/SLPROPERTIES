<?php

if ( ! function_exists( 'fokkner_core_add_property_list_variation_info_aside' ) ) {
	function fokkner_core_add_property_list_variation_info_aside( $variations ) {
		$variations['info-aside'] = esc_html__( 'Info Aside', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_property_list_layouts', 'fokkner_core_add_property_list_variation_info_aside' );
}
