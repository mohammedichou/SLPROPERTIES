<?php

if ( ! function_exists( 'fokkner_core_add_property_archive_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_property_archive_options( $page ) {

		$archive_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-archive-property',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Property Archive', 'fokkner-core' ),
				'description' => esc_html__( 'Settings related to property archive pages', 'fokkner-core' ),
			)
		);

		if ( $archive_tab ) {

			$archive_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_property_archive_number_of_items',
					'title'       => esc_html__( 'Number of Items', 'fokkner-core' ),
					'description' => esc_html__( 'Set number of items for your property list on archive pages. Default value is 12', 'fokkner-core' ),
				)
			);

			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_property_archive_number_of_columns',
					'title'         => esc_html__( 'Number of Columns', 'fokkner-core' ),
					'description'   => esc_html__( 'Set number of columns for your property list on archive pages. Default value is 4 columns', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '4',
				)
			);

			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_property_archive_space_between_items',
					'title'         => esc_html__( 'Space Between Items', 'fokkner-core' ),
					'description'   => esc_html__( 'Set space size between property items for your property list on archive pages. Default value is normal', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'items_space' ),
					'default_value' => 'normal',
				)
			);

			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_property_archive_image_size',
					'title'         => esc_html__( 'Image Proportions', 'fokkner-core' ),
					'description'   => esc_html__( 'Set image proportions for your property list on archive pages. Default value is landscape', 'fokkner-core' ),
					'default_value' => 'landscape',
					'options'       => fokkner_core_get_select_type_options_pool( 'list_image_dimension', false, array( 'custom' ) ),
				)
			);

			$archive_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_property_archive_item_layout',
					'title'         => esc_html__( 'Item Style', 'fokkner-core' ),
					'description'   => esc_html__( 'Set item style for your property list on archive pages. Default value is "Info Below"', 'fokkner-core' ),
					'default_value' => 'info-below',
					'options'       => array(
						'info-below'                     => esc_html__( 'Info Below', 'qodef-core' ),
						'info-below-with-feature-titles' => esc_html__( 'Info Below With Feature Titles', 'qodef-core' ),
						'info-aside'                     => esc_html__( 'Info Aside', 'qodef-core' ),
						'info-hover'                     => esc_html__( 'Info on Hover', 'qodef-core' ),
					),
				)
			);
		}
	}

	add_action( 'fokkner_core_action_property_options_map', 'fokkner_core_add_property_archive_options', 2 );
}
