<?php

if ( ! function_exists( 'fokkner_core_add_page_sidebar_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_page_sidebar_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FOKKNER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'sidebar',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Sidebar', 'fokkner-core' ),
				'description' => esc_html__( 'Global Sidebar Options', 'fokkner-core' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'fokkner-core' ),
					'description'   => esc_html__( 'Choose a default sidebar layout for pages', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'sidebar_layouts', false ),
					'default_value' => 'no-sidebar',
				)
			);

			$custom_sidebars = fokkner_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$page->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'fokkner-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on pages', 'fokkner-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'fokkner-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'fokkner-core' ),
					'description' => esc_html__( 'Set space value between widgets', 'fokkner-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_page_sidebar_options_map', $page );
		}
	}

	add_action( 'fokkner_core_action_default_options_init', 'fokkner_core_add_page_sidebar_options', fokkner_core_get_admin_options_map_position( 'sidebar' ) );
}
