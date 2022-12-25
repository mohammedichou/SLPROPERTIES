<?php

if ( ! function_exists( 'fokkner_core_add_mobile_logo_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 * @param object $header_tab
	 */
	function fokkner_core_add_mobile_logo_options( $page, $header_tab ) {

		if ( $page ) {

			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Logo Options', 'fokkner-core' ),
					'description' => esc_html__( 'Set options for mobile headers', 'fokkner-core' ),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'fokkner-core' ),
					'description' => esc_html__( 'Enter mobile logo height', 'fokkner-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'fokkner-core' ),
					),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_mobile_logo_main',
					'title'         => esc_html__( 'Mobile Logo - Main', 'fokkner-core' ),
					'description'   => esc_html__( 'Choose main mobile logo image', 'fokkner-core' ),
					'default_value' => defined( 'FOKKNER_ASSETS_ROOT' ) ? FOKKNER_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'      => 'no',
				)
			);

			do_action( 'fokkner_core_action_after_mobile_logo_options_map', $page );
		}
	}

	add_action( 'fokkner_core_action_after_header_logo_options_map', 'fokkner_core_add_mobile_logo_options', 10, 2 );
}
