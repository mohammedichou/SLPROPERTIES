<?php

if ( ! function_exists( 'fokkner_core_add_mobile_header_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_mobile_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FOKKNER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'mobile-header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Mobile Header', 'fokkner-core' ),
				'description' => esc_html__( 'Global Mobile Header Options', 'fokkner-core' ),
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-mobile-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'fokkner-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'no',
					'name'          => 'qodef_mobile_header_scroll_appearance',
					'title'         => esc_html__( 'Sticky Mobile Header', 'fokkner-core' ),
					'description'   => esc_html__( 'Set mobile header to be sticky', 'fokkner-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_mobile_header_layout',
					'title'         => esc_html__( 'Mobile Header Layout', 'fokkner-core' ),
					'description'   => esc_html__( 'Choose a mobile header layout to set for your website', 'fokkner-core' ),
					'args'          => array( 'images' => true ),
					'default_value' => apply_filters( 'fokkner_core_filter_mobile_header_layout_default_option', '' ),
					'options'       => apply_filters( 'fokkner_core_filter_mobile_header_layout_option', array() ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_mobile_menu_icon_source',
					'title'         => esc_html__( 'Icon Source', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'icon_source', false ),
					'default_value' => 'predefined',
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_mobile_menu_icon_pack',
					'title'         => esc_html__( 'Icon Pack', 'fokkner-core' ),
					'options'       => qode_framework_icons()->get_icon_packs( array( 'linea-icons', 'dripicons', 'simple-line-icons' ) ),
					'default_value' => 'elegant-icons',
					'dependency'    => array(
						'show' => array(
							'qodef_mobile_menu_icon_source' => array(
								'values'        => 'icon_pack',
								'default_value' => 'icon_pack',
							),
						),
					),
				)
			);

			$section_svg_path = $general_tab->add_section_element(
				array(
					'title'      => esc_html__( 'SVG Path', 'fokkner-core' ),
					'name'       => 'qodef_mobile_menu_svg_path_section',
					'dependency' => array(
						'show' => array(
							'qodef_mobile_menu_icon_source' => array(
								'values'        => 'svg_path',
								'default_value' => 'icon_pack',
							),
						),
					),
				)
			);

			$section_svg_path->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_mobile_menu_icon_svg_path',
					'title'       => esc_html__( 'Mobile Menu Open Icon SVG Path', 'fokkner-core' ),
					'description' => esc_html__( 'Enter your full screen menu open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'fokkner-core' ),
				)
			);

			$section_svg_path->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_mobile_menu_close_icon_svg_path',
					'title'       => esc_html__( 'Mobile Menu Close Icon SVG Path', 'fokkner-core' ),
					'description' => esc_html__( 'Enter your full screen menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'fokkner-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_mobile_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'fokkner_core_action_default_options_init', 'fokkner_core_add_mobile_header_options', fokkner_core_get_admin_options_map_position( 'mobile-header' ) );
}
