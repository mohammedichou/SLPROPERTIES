<?php

if ( ! function_exists( 'fokkner_core_add_property_single_features_meta_boxes' ) ) {
	/**
	 * Function that add features meta boxes for property single module
	 */
	function fokkner_core_add_property_single_features_meta_boxes( $page ) {

		if ( $page ) {

			$features_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-features',
					'title' => esc_html__( 'Property Features', 'fokkner-core' ),
				)
			);

			$features_repeater = $features_tab->add_repeater_element(
				array(
					'name'        => 'qodef_property_feature_repeater',
					'title'       => esc_html__( 'Property Feature', 'fokkner-core' ),
					'button_text' => esc_html__( 'Add New Feature', 'fokkner-core' ),
				)
			);

			$features_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_property_feature_image',
					'title'      => esc_html__( 'Feature Image', 'fokkner-core' ),
				)
			);

			$features_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_property_feature_title',
					'title'      => esc_html__( 'Title', 'fokkner-core' ),
				)
			);

			$features_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_property_feature_desc',
					'title'      => esc_html__( 'Short Description', 'fokkner-core' ),
				)
			);
		}
	}

	add_action( 'fokkner_core_action_after_property_meta_box_map', 'fokkner_core_add_property_single_features_meta_boxes', 12 );
}
