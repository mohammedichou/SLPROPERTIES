<?php

if ( ! function_exists( 'fokkner_core_add_apartment_single_features_meta_boxes' ) ) {
	/**
	 * Function that add features meta boxes for apartment single module
	 */
	function fokkner_core_add_apartment_single_features_meta_boxes( $page ) {

		if ( $page ) {

			$features_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-features',
					'title' => esc_html__( 'Apartment Info', 'fokkner-core' ),
				)
			);

			$features_tab->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_apartment_plan_image',
					'title'      => esc_html__( 'Apartment Plan Image', 'fokkner-core' ),
				)
			);

			$features_tab->add_field_element(
				array(
					'field_type' => 'textarea',
					'name'       => 'qodef_apartment_description',
					'title'      => esc_html__( 'Apartment Description', 'fokkner-core' ),
				)
			);

			$features_repeater = $features_tab->add_repeater_element(
				array(
					'name'        => 'qodef_apartment_feature_repeater',
					'title'       => esc_html__( 'Apartment Features', 'fokkner-core' ),
					'button_text' => esc_html__( 'Add New Feature', 'fokkner-core' ),
				)
			);

			$features_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_apartment_feature_title',
					'title'      => esc_html__( 'Feature Title', 'fokkner-core' ),
				)
			);

			$features_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_apartment_feature_value',
					'title'      => esc_html__( 'Value', 'fokkner-core' ),
				)
			);

			$features_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_apartment_feature_image',
					'title'      => esc_html__( 'Feature Image', 'fokkner-core' ),
				)
			);
		}
	}

	add_action( 'fokkner_core_action_after_apartment_meta_box_map', 'fokkner_core_add_apartment_single_features_meta_boxes', 12 );
}
