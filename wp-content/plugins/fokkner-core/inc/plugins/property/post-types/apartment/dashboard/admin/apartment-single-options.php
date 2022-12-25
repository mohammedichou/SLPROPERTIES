<?php

if ( ! function_exists( 'fokkner_core_add_apartment_single_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_apartment_single_options( $page ) {

		$single_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-single-apartment',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Apartment Single', 'fokkner-core' ),
				'description' => esc_html__( 'Settings related to apartment single page', 'fokkner-core' ),
			)
		);

		if ( $single_tab ) {

			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_apartment_single_item_layout',
					'title'         => esc_html__( 'Single Item Layout', 'fokkner-core' ),
					'description'   => esc_html__( 'Set item layout for Apartment single page. Defauly is "Custom"', 'fokkner-core' ),
					'default_value' => 'custom',
					'options'       => array(
						'custom'            => esc_html__( 'Custom', 'fokkner-core' ),
						'full-width-custom' => esc_html__( 'Full Width Custom', 'fokkner-core' ),
					),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_show_title_area_apartment_single',
					'title'       => esc_html__( 'Show Title Area', 'fokkner-core' ),
					'description' => esc_html__( 'Enabling this option will show title area on single projects', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'yes_no' ),
				)
			);
		}
	}

	add_action( 'fokkner_core_action_property_options_map', 'fokkner_core_add_apartment_single_options', 4 );
}
