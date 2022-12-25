<?php

if ( ! function_exists( 'fokkner_core_add_social_share_variation_text' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_social_share_variation_text( $variations ) {
		$variations['text'] = esc_html__( 'Text', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_social_share_layouts', 'fokkner_core_add_social_share_variation_text' );
}
