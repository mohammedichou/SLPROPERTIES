<?php

if ( ! function_exists( 'fokkner_core_add_social_share_variation_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_social_share_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_social_share_layouts', 'fokkner_core_add_social_share_variation_list' );
}
