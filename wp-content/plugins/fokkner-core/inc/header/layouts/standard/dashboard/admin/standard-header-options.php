<?php

if ( ! function_exists( 'fokkner_core_add_standard_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function fokkner_core_add_standard_header_options( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_standard_header_section',
				'title'       => esc_html__( 'Standard Header', 'fokkner-core' ),
				'description' => esc_html__( 'Standard header settings', 'fokkner-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'standard',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_standard_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'fokkner-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'fokkner-core' ),
				'default_value' => 'no',
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'fokkner-core' ),
				'description' => esc_html__( 'Enter header height', 'fokkner-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'fokkner-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'fokkner-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'fokkner-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'fokkner-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'fokkner-core' ),
				'description' => esc_html__( 'Enter header background color', 'fokkner-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'fokkner-core' ),
				'default_value' => 'left',
				'options'       => array(
					'left'   => esc_html__( 'Left', 'fokkner-core' ),
					'center' => esc_html__( 'Center', 'fokkner-core' ),
					'right'  => esc_html__( 'Right', 'fokkner-core' ),
				),
			)
		);
	}

	add_action( 'fokkner_core_action_after_header_options_map', 'fokkner_core_add_standard_header_options', 10, 2 );
}
