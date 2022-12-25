<?php

if ( ! function_exists( 'fokkner_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function fokkner_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FOKKNER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'fokkner-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'fokkner-core' ),
				'icon'        => 'fa fa-cog',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'fokkner-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts',
					),
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'fokkner-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'fokkner-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'fokkner-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'fokkner-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type'  => 'googlefont',
					'name'        => 'qodef_choose_google_font',
					'title'       => esc_html__( 'Google Font', 'fokkner-core' ),
					'description' => esc_html__( 'Choose Google Font', 'fokkner-core' ),
					'args'        => array(
						'include' => 'google-fonts',
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'fokkner-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'fokkner-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'fokkner-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'fokkner-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'fokkner-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'fokkner-core' ),
						'300'  => esc_html__( '300 Light', 'fokkner-core' ),
						'300i' => esc_html__( '300 Light Italic', 'fokkner-core' ),
						'400'  => esc_html__( '400 Regular', 'fokkner-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'fokkner-core' ),
						'500'  => esc_html__( '500 Medium', 'fokkner-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'fokkner-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'fokkner-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'fokkner-core' ),
						'700'  => esc_html__( '700 Bold', 'fokkner-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'fokkner-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'fokkner-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'fokkner-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'fokkner-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'fokkner-core' ),
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'fokkner-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'fokkner-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'fokkner-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'fokkner-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'fokkner-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'fokkner-core' ),
						'greek'        => esc_html__( 'Greek', 'fokkner-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'fokkner-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'fokkner-core' ),
					),
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'fokkner-core' ),
					'description' => esc_html__( 'Add custom fonts', 'fokkner-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'fokkner-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_ttf',
					'title'      => esc_html__( 'Custom Font TTF', 'fokkner-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_otf',
					'title'      => esc_html__( 'Custom Font OTF', 'fokkner-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff',
					'title'      => esc_html__( 'Custom Font WOFF', 'fokkner-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff2',
					'title'      => esc_html__( 'Custom Font WOFF2', 'fokkner-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_custom_font_name',
					'title'      => esc_html__( 'Custom Font Name', 'fokkner-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'fokkner_core_action_default_options_init', 'fokkner_core_add_fonts_options', fokkner_core_get_admin_options_map_position( 'fonts' ) );
}
