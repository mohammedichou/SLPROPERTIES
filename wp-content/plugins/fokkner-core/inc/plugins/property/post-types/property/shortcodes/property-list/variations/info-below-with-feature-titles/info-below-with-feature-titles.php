<?php

if ( ! function_exists( 'fokkner_core_add_property_list_variation_info_below_with_feature_titles' ) ) {
	function fokkner_core_add_property_list_variation_info_below_with_feature_titles( $variations ) {

		$variations['info-below-with-feature-titles'] = esc_html__( 'Info Below With Feature Titles', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_property_list_layouts', 'fokkner_core_add_property_list_variation_info_below_with_feature_titles' );
}
