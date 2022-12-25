<?php

if ( ! function_exists( 'fokkner_core_add_clients_meta_box' ) ) {
	/**
	 * Function that adds fields for clients
	 */
	function fokkner_core_add_clients_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'clients' ),
				'type'  => 'meta',
				'slug'  => 'clients',
				'title' => esc_html__( 'Clients Parameters', 'fokkner-core' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_logo_image',
					'title'      => esc_html__( 'Client Logo Image', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_logo_hover_image',
					'title'      => esc_html__( 'Client Logo Hover Image', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_client_link',
					'title'      => esc_html__( 'Client Link', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_client_link_target',
					'title'      => esc_html__( 'Client Link Target', 'fokkner-core' ),
					'options'    => fokkner_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_clients_meta_box_map', $page );
		}
	}

	add_action( 'fokkner_core_action_default_meta_boxes_init', 'fokkner_core_add_clients_meta_box' );
}
