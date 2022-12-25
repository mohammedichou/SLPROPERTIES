<?php

if ( ! function_exists( 'fokkner_core_add_apartment_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_apartment_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'  => array( 'apartment-item' ),
				'type'   => 'meta',
				'slug'   => 'apartment-item',
				'title'  => esc_html__( 'Apartment Settings', 'fokkner-core' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			/* General section */

			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-general',
					'title' => esc_html__( 'Apartment General', 'fokkner-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_apartment_property',
					'title'         => esc_html__( 'Property', 'fokkner-core' ),
					'description'   => esc_html__( 'Choose property associated with this apartment item', 'fokkner-core' ),
					'options'       => fokkner_core_get_property_items_list(),
					'default_value' => '0',
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_show_title_area_apartment_single',
					'title'       => esc_html__( 'Show Title Area', 'fokkner-core' ),
					'description' => esc_html__( 'Enabling this option will show title area on your single apartment page', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'yes_no' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_apartment_single_item_layout',
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
					'name'        => 'qodef_apartment_list_image',
					'title'       => esc_html__( 'Apartment List Image', 'fokkner-core' ),
					'description' => esc_html__( 'Upload image to be displayed on apartment list instead of featured image', 'fokkner-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_apartment_item',
					'title'       => esc_html__( 'Image Dimension', 'fokkner-core' ),
					'description' => esc_html__( 'Choose an image layout for "masonry behavior" apartment list. If you are using fixed image proportions on the list, choose an option other than default', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_apartment_meta_box_map', $page, $general_tab );
		}
	}

	add_action( 'fokkner_core_action_default_meta_boxes_init', 'fokkner_core_add_apartment_single_meta_box' );
}
