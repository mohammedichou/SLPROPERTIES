<?php

if ( ! function_exists( 'fokkner_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'fokkner-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'fokkner-core' ),
					'description' => esc_html__( 'Set background color', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'fokkner-core' ),
					'description' => esc_html__( 'Set background image', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_repeat',
					'title'       => esc_html__( 'Page Background Image Repeat', 'fokkner-core' ),
					'description' => esc_html__( 'Set background image repeat', 'fokkner-core' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'fokkner-core' ),
						'no-repeat' => esc_html__( 'No Repeat', 'fokkner-core' ),
						'repeat'    => esc_html__( 'Repeat', 'fokkner-core' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'fokkner-core' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'fokkner-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_size',
					'title'       => esc_html__( 'Page Background Image Size', 'fokkner-core' ),
					'description' => esc_html__( 'Set background image size', 'fokkner-core' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'fokkner-core' ),
						'contain' => esc_html__( 'Contain', 'fokkner-core' ),
						'cover'   => esc_html__( 'Cover', 'fokkner-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_attachment',
					'title'       => esc_html__( 'Page Background Image Attachment', 'fokkner-core' ),
					'description' => esc_html__( 'Set background image attachment', 'fokkner-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'fokkner-core' ),
						'fixed'  => esc_html__( 'Fixed', 'fokkner-core' ),
						'scroll' => esc_html__( 'Scroll', 'fokkner-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'fokkner-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'fokkner-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'fokkner-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'fokkner-core' ),
					'description'   => esc_html__( 'Set boxed layout', 'fokkner-core' ),
					'default_value' => 'no',
				)
			);

			$boxed_section = $page->add_section_element(
				array(
					'name'       => 'qodef_boxed_section',
					'title'      => esc_html__( 'Boxed Layout Section', 'fokkner-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_boxed' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_boxed_background_color',
					'title'       => esc_html__( 'Boxed Background Color', 'fokkner-core' ),
					'description' => esc_html__( 'Set boxed background color', 'fokkner-core' ),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_boxed_background_pattern',
					'title'       => esc_html__( 'Boxed Background Pattern', 'fokkner-core' ),
					'description' => esc_html__( 'Set boxed background pattern', 'fokkner-core' ),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_boxed_background_pattern_behavior',
					'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'fokkner-core' ),
					'description' => esc_html__( 'Set boxed background pattern behavior', 'fokkner-core' ),
					'options'     => array(
						'fixed'  => esc_html__( 'Fixed', 'fokkner-core' ),
						'scroll' => esc_html__( 'Scroll', 'fokkner-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_passepartout',
					'title'         => esc_html__( 'Passepartout', 'fokkner-core' ),
					'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'fokkner-core' ),
					'default_value' => 'no',
				)
			);

			$passepartout_section = $page->add_section_element(
				array(
					'name'       => 'qodef_passepartout_section',
					'title'      => esc_html__( 'Passepartout Section', 'fokkner-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_passepartout' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_passepartout_color',
					'title'       => esc_html__( 'Passepartout Color', 'fokkner-core' ),
					'description' => esc_html__( 'Choose background color for passepartout', 'fokkner-core' ),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_passepartout_image',
					'title'       => esc_html__( 'Passepartout Background Image', 'fokkner-core' ),
					'description' => esc_html__( 'Set background image for passepartout', 'fokkner-core' ),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size',
					'title'       => esc_html__( 'Passepartout Size', 'fokkner-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout', 'fokkner-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'fokkner-core' ),
					),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size_responsive',
					'title'       => esc_html__( 'Passepartout Responsive Size', 'fokkner-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'fokkner-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'fokkner-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'fokkner-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100',
				)
			);

            $page->add_field_element(
                array(
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_disable_images_lazy_loading',
                    'title'         => esc_html__( 'Disable Images Lazy Loading', 'fokkner-core' ),
                    'description'   => esc_html__( 'Note that some images that have hover animation will not load if this option is turned off', 'fokkner-core' ),
                    'options'       => fokkner_core_get_select_type_options_pool( 'yes_no', false ),
                    'default_value' => 'yes'
                )
            );

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_general_options_map', $page );

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'fokkner-core' ),
					'description' => esc_html__( 'Enter your custom JavaScript here', 'fokkner-core' ),
				)
			);
		}
	}

	add_action( 'fokkner_core_action_default_options_init', 'fokkner_core_add_general_options', fokkner_core_get_admin_options_map_position( 'general' ) );
}
