<?php

if ( ! function_exists( 'fokkner_core_add_nav_menu_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_nav_menu_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'nav_menu_item' ),
				'type'  => 'nav-menu',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'checkbox',
					'name'       => 'qodef-enable-mega-menu',
					'title'      => esc_html__( 'Enable Mega Menu', 'fokkner-core' ),
					'options'    => array(
						'enable' => esc_html__( 'Enable', 'fokkner-core' ),
					),
					'args'       => array(
						'depth' => 0,
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'checkbox',
					'name'       => 'qodef-enable-anchor-link',
					'title'      => esc_html__( 'Enable Anchor Link', 'fokkner-core' ),
					'options'    => array(
						'enable' => esc_html__( 'Enable', 'fokkner-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef-menu-item-appearance',
					'title'      => esc_html__( 'Menu Item Appearance', 'fokkner-core' ),
					'options'    => array(
						'none'       => esc_html__( 'None', 'fokkner-core' ),
						'hide-item'  => esc_html__( 'Hide Item', 'fokkner-core' ),
						'hide-link'  => esc_html__( 'Hide Link', 'fokkner-core' ),
						'hide-label' => esc_html__( 'Hide Label', 'fokkner-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'iconpack',
					'name'       => 'qodef-menu-item-icon-pack',
					'title'      => esc_html__( 'Icon Pack', 'fokkner-core' ),
					'args'       => array(
						'width' => 'thin',
					),
				)
			);

			$custom_sidebars = fokkner_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$page->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef-enable-mega-menu-widget',
						'title'       => esc_html__( 'Custom Sidebar', 'fokkner-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on wide menu', 'fokkner-core' ),
						'options'     => $custom_sidebars,
						'args'        => array(
							'depth' => 1,
						),
					)
				);
			}
		}
	}

	add_action( 'qode_framework_action_custom_nav_menu_fields', 'fokkner_core_add_nav_menu_options' );
}
