<?php

if ( ! function_exists( 'fokkner_core_add_standard_title_layout_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_standard_title_layout_meta_box( $page ) {

		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'       => 'qodef_standard_title_section',
					'title'      => esc_html__( 'Standard Title', 'fokkner-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => 'standard',
								'default_value' => '',
							),
						),
					),
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_page_title_subtitle',
					'title'      => esc_html__( 'Subtitle', 'fokkner-core' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_subtitle_color',
					'title'      => esc_html__( 'Subtitle Color', 'fokkner-core' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_page_title_subtitle_top_margin',
					'title'      => esc_html__( 'Subtitle Top Margin', 'fokkner-core' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'fokkner-core' ),
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_standard_title_layout_meta_box_map', $section );
		}
	}

	add_action( 'fokkner_core_action_after_page_title_meta_box_map', 'fokkner_core_add_standard_title_layout_meta_box' );
}
