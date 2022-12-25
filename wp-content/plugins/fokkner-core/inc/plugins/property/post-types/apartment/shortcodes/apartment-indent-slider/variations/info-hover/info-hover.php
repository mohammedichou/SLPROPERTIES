<?php

if ( ! function_exists( 'fokkner_core_add_apartment_indent_slider_variation_info_hover' ) ) {
	function fokkner_core_add_apartment_indent_slider_variation_info_hover( $variations ) {
		$variations['info-hover'] = esc_html__( 'Info On Hover', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_apartment_indent_slider_layouts', 'fokkner_core_add_apartment_indent_slider_variation_info_hover' );
}
