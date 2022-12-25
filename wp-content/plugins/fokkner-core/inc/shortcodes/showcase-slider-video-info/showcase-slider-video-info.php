<?php

if ( ! function_exists( 'fokkner_core_add_showcase_slider_video_info_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function fokkner_core_add_showcase_slider_video_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'FokknerCoreShowcaseSliderVideoInfoShortcode';

		return $shortcodes;
	}

	add_filter( 'fokkner_core_filter_register_shortcodes', 'fokkner_core_add_showcase_slider_video_info_shortcode' );
}

if ( class_exists( 'FokknerCore_Shortcode' ) ) {
	class FokknerCoreShowcaseSliderVideoInfoShortcode extends FokknerCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( FOKKNER_CORE_SHORTCODES_URL_PATH . '/showcase-slider-video-info' );
			$this->set_base( 'fokkner_core_showcase_slider_video_info' );
			$this->set_name( esc_html__( 'Showcase Slider Video Info', 'fokkner-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds showcase slider video info holder', 'fokkner-core' ) );
			$this->set_category( esc_html__( 'Fokkner Core', 'fokkner-core' ) );
			$this->set_scripts(
				array(
					'swiper'         => array(
						'registered' => true,
					),
					'fokkner-main-js' => array(
						'registered' => true,
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'select',
					'name'        => 'slider_loop',
					'title'       => esc_html__( 'Enable Slider Loop', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'yes_no' ),
					'description' => esc_html__( 'Default is YES', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'select',
					'name'        => 'slider_autoplay',
					'title'       => esc_html__( 'Enable Slider Autoplay', 'fokkner-core' ),
					'options'     => fokkner_core_get_select_type_options_pool( 'yes_no' ),
					'description' => esc_html__( 'Default is YES', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'slider_speed',
					'title'       => esc_html__( 'Slide Duration', 'fokkner-core' ),
					'description' => esc_html__( 'Default value is 3000 (ms)', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'slider_speed_animation',
					'title'       => esc_html__( 'Slide Animation Duration', 'fokkner-core' ),
					'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 800.', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'slider_navigation',
					'title'         => esc_html__( 'Enable Slider Navigation', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'yes',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'slider_pagination',
					'title'         => esc_html__( 'Enable Slider Pagination', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'no',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'full_height_slider',
					'title'         => esc_html__( 'Full Height Slider', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'yes',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'show_social_links',
					'title'         => esc_html__( 'Show Social Links', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'icon_layout',
					'title'         => esc_html__( 'Layout', 'fokkner-core' ),
					'options'       => array(
						'normal' => esc_html__( 'Normal', 'fokkner-core' ),
						'circle' => esc_html__( 'Circle', 'fokkner-core' ),
						'square' => esc_html__( 'Square', 'fokkner-core' ),
					),
					'default_value' => 'normal',
					'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
				)
			);
			for ( $i = 1; $i <= 5; $i ++ ) {
				$this->set_option(
					array(
						'field_type' => 'iconpack',
						'name'       => 'main_icon_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'text',
						'name'       => 'link_' . $i,
						'title'      => sprintf( esc_html__( 'Link %s', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type'    => 'select',
						'name'          => 'target_' . $i,
						'title'         => sprintf( esc_html__( 'Link %s Target', 'fokkner-core' ), $i ),
						'options'       => fokkner_core_get_select_type_options_pool( 'link_target', false ),
						'default_value' => '_blank',
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'text',
						'name'       => 'custom_size_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Size', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'text',
						'name'       => 'margin_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Margin', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Color', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_background_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Background Color', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_hover_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Hover Color', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_hover_background_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Hover Background Color', 'fokkner-core' ), $i ),
						'group'         => esc_html__( 'Social Links', 'fokkner-core' ),
					)
				);
			}
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Image Items', 'fokkner-core' ),
					'items'      => array(
						array(
							'field_type'    => 'text',
							'name'          => 'slider_title',
							'title'         => esc_html__( 'Title', 'fokkner-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'item_button_link',
							'title'         => esc_html__( 'Button Link', 'fokkner-core' ),
							'default_value' => '',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'item_button_text',
							'title'         => esc_html__( 'Button Text', 'fokkner-core' ),
							'description'   => esc_html__( 'Default is Make an enquiry', 'fokkner-core' ),
							'default_value' => '',
						),
						array(
							'field_type' => 'image',
							'name'       => 'main_image',
							'title'      => esc_html__( 'Main Image', 'fokkner-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'info_title',
							'title'      => esc_html__( 'Info Title', 'fokkner-core' ),
						),
						array(
							'field_type'  => 'text',
							'name'        => 'line_break_positions',
							'title'       => esc_html__( 'Positions of Line Break', 'fokkner-core' ),
							'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'fokkner-core' ),
							'group'       => esc_html__( 'Title Style', 'fokkner-core' ),
						),
						array(
							'field_type'    => 'select',
							'name'          => 'disable_title_break_words',
							'title'         => esc_html__( 'Disable Title Line Break', 'fokkner-core' ),
							'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 768 and lower', 'fokkner-core' ),
							'options'       => fokkner_core_get_select_type_options_pool( 'no_yes', false ),
							'default_value' => 'no',
							'group'         => esc_html__( 'Title Style', 'fokkner-core' ),
						),
						array(
							'field_type' => 'textarea',
							'name'       => 'info_text',
							'title'      => esc_html__( 'Info Text', 'fokkner-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'info_video_link',
							'title'      => esc_html__( 'Info Video Link', 'fokkner-core' ),
						),
						array(
							'field_type' => 'image',
							'name'       => 'info_video_image',
							'title'      => esc_html__( 'Info Video Image', 'fokkner-core' ),
						),
					),
				)
			);
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['this_shortcode'] = $this;

			return fokkner_core_get_template_part( 'shortcodes/showcase-slider-video-info', 'templates/showcase-slider-video-info', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-showcase-slider-video-info';
			$holder_classes[] = isset( $atts['full_height_slider'] ) ? 'qodef-full-height-slider--' . $atts['full_height_slider'] : '';
			$holder_classes[] = isset( $atts['show_social_links'] ) ? 'qodef-show-social-links--' . $atts['show_social_links'] : '';

			return implode( ' ', $holder_classes );
		}

		public function get_slider_data( $atts ) {
			$data = array();

			$data['slidesPerView']  = 1;
			$data['spaceBetween']   = 0;
			$data['loop']           = isset( $atts['slider_loop'] ) ? 'no' !== $atts['slider_loop'] : true;
			$data['autoplay']       = isset( $atts['slider_autoplay'] ) ? 'no' !== $atts['slider_autoplay'] : true;
			$data['speed']          = isset( $atts['slider_speed'] ) ? $atts['slider_speed'] : '';
			$data['speedAnimation'] = isset( $atts['slider_speed_animation'] ) ? $atts['slider_speed_animation'] : '';

			return json_encode( $data );
		}
	}
}
