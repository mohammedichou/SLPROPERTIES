<?php

if ( ! function_exists( 'fokkner_core_add_property_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_property_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'  => array( 'property-item' ),
				'type'   => 'meta',
				'slug'   => 'property-item',
				'title'  => esc_html__( 'Property Settings', 'fokkner-core' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			/* General section */

			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-general',
					'title' => esc_html__( 'Property General', 'fokkner-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_show_title_area_property_single',
					'title'       => esc_html__( 'Show Title Area', 'fokkner-core' ),
					'description' => esc_html__( 'Enabling this option will show title area on your single property page', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'yes_no' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_property_single_item_layout',
					'title'      => esc_html__( 'Single Item Layout', 'fokkner-core' ),
					'options'    => array(
						''                  => esc_html__( 'Default', 'fokkner-core' ),
						'custom'            => esc_html__( 'Custom', 'fokkner-core' ),
						'full-width-custom' => esc_html__( 'Full Width Custom', 'fokkner-core' ),
					),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_property_list_image',
					'title'       => esc_html__( 'Property List Image', 'fokkner-core' ),
					'description' => esc_html__( 'Upload image to be displayed on property list instead of featured image', 'fokkner-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_property_item',
					'title'       => esc_html__( 'Image Dimension', 'fokkner-core' ),
					'description' => esc_html__( 'Choose an image layout for "masonry behavior" property list. If you are using fixed image proportions on the list, choose an option other than default', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'no',
					'name'          => 'qodef_show_property_label',
					'title'         => esc_html__( 'Enable Property Label Item', 'fokkner-core' ),
					'description'   => esc_html__( 'Enabling this option will show label in property list', 'fokkner-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_property_label',
					'title'       => esc_html__( 'Property Label', 'fokkner-core' ),
					'description' => esc_html__( 'Enter property label', 'fokkner-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_show_property_label' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_property_label_margin',
					'title'       => esc_html__( 'Property Label Top Margin', 'fokkner-core' ),
					'description' => esc_html__( 'Enter property label top margin', 'fokkner-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_show_property_label' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_property_label_link',
					'title'       => esc_html__( 'Property Label Link', 'fokkner-core' ),
					'description' => esc_html__( 'Enter Property Label Link', 'fokkner-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_show_property_label' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$address_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-address',
					'title'       => esc_html__( 'Address Settings', 'fokkner-core' ),
					'description' => esc_html__( 'Add address information.', 'fokkner-core' ),
				)
			);

			$address_tab->add_field_element(
				array(
					'field_type' => 'address',
					'name'       => 'qodef_property_single_full_address',
					'title'      => esc_html__( 'Full Address', 'fokkner-core' ),
					'args'       => array(
						'latitude_field'  => 'qodef_property_single_latitude',
						'longitude_field' => 'qodef_property_single_longitude',
					),
				)
			);

			$address_tab->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_property_single_latitude',
					'title'      => esc_html__( 'Latitude', 'fokkner-core' ),
					'args'       => array(
						'custom_class' => 'qodef-address-elements',
					),
					'data_attrs' => array(
						'data-geo' => 'lat',
					),
				)
			);

			$address_tab->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_property_single_longitude',
					'title'      => esc_html__( 'Longitude', 'fokkner-core' ),
					'args'       => array(
						'custom_class' => 'qodef-address-elements',
					),
					'data_attrs' => array(
						'data-geo' => 'lng',
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_property_meta_box_map', $page, $general_tab );
		}
	}

	add_action( 'fokkner_core_action_default_meta_boxes_init', 'fokkner_core_add_property_single_meta_box' );
}
