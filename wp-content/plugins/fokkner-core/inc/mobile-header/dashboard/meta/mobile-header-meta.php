<?php

if ( ! function_exists( 'fokkner_core_add_page_mobile_header_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function fokkner_core_add_page_mobile_header_meta_box( $page ) {

		if ( $page ) {
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Settings', 'fokkner-core' ),
					'description' => esc_html__( 'Mobile header layout settings', 'fokkner-core' ),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_mobile_header_layout',
					'title'       => esc_html__( 'Mobile Header Layout', 'fokkner-core' ),
					'description' => esc_html__( 'Choose a mobile header layout to set for your website', 'fokkner-core' ),
					'args'        => array( 'images' => true ),
					'options'     => fokkner_core_header_radio_to_select_options( apply_filters( 'fokkner_core_filter_mobile_header_layout_option', array() ) ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_page_mobile_header_meta_map', $mobile_header_tab );
		}
	}

	add_action( 'fokkner_core_action_after_general_meta_box_map', 'fokkner_core_add_page_mobile_header_meta_box' );
}

if ( ! function_exists( 'fokkner_core_add_general_mobile_header_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function fokkner_core_add_general_mobile_header_meta_box_callback( $callbacks ) {
		$callbacks['mobile-header'] = 'fokkner_core_add_page_mobile_header_meta_box';

		return $callbacks;
	}

	add_filter( 'fokkner_core_filter_general_meta_box_callbacks', 'fokkner_core_add_general_mobile_header_meta_box_callback' );
}
