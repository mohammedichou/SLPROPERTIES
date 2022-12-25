<?php

if ( ! function_exists( 'fokkner_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function fokkner_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'fokkner-core' );

		return $options;
	}

	add_filter( 'fokkner_core_filter_header_scroll_appearance_option', 'fokkner_core_add_fixed_header_option' );
}
