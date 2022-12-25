<?php

if ( ! function_exists( 'fokkner_core_add_standard_mobile_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_tab
	 */
	function fokkner_core_add_standard_mobile_header_options( $page, $general_tab ) {

		$section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_standard_mobile_header_section',
				'title'      => esc_html__( 'Standard Mobile Header', 'fokkner-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values'        => 'standard',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_mobile_header_height',
				'title'       => esc_html__( 'Header Height', 'fokkner-core' ),
				'description' => esc_html__( 'Enter header height', 'fokkner-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'fokkner-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'fokkner-core' ),
				'description' => esc_html__( 'Enter header background color', 'fokkner-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'fokkner-core' ),
				),
			)
		);
	}

	add_action( 'fokkner_core_action_after_mobile_header_options_map', 'fokkner_core_add_standard_mobile_header_options', 10, 2 );
}
