<?php

if ( ! function_exists( 'fokkner_core_add_comparison_slider_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function fokkner_core_add_comparison_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'FokknerCore_Comparison_Slider_Shortcode';

		return $shortcodes;
	}

	add_filter( 'fokkner_core_filter_register_shortcodes', 'fokkner_core_add_comparison_slider_shortcode' );
}

if ( class_exists( 'FokknerCore_Shortcode' ) ) {
	class FokknerCore_Comparison_Slider_Shortcode extends FokknerCore_Shortcode {


		public function map_shortcode() {
			$this->set_shortcode_path( FOKKNER_CORE_SHORTCODES_URL_PATH . '/comparison-slider' );
			$this->set_base( 'fokkner_core_comparison_slider' );
			$this->set_name( esc_html__( 'Comparison Slider', 'fokkner-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays a comparison slider', 'fokkner-core' ) );
			$this->set_category( esc_html__( 'Fokkner Core', 'fokkner-core' ) );

			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'image',
					'name'       => 'image_before',
					'multiple'   => 'no',
					'title'      => esc_html__( 'Before Image', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'image',
					'name'       => 'image_after',
					'multiple'   => 'no',
					'title'      => esc_html__( 'After Image', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'date_before',
					'title'      => esc_html__( 'Before Date', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'date_after',
					'title'      => esc_html__( 'After Date', 'fokkner-core' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return fokkner_core_get_template_part( 'shortcodes/comparison-slider', '/templates/comparison-slider', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-comparison-slider';

			return implode( ' ', $holder_classes );
		}
	}
}
