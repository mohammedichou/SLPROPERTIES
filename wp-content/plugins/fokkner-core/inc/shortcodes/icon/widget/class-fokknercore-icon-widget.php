<?php

if ( ! function_exists( 'fokkner_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function fokkner_core_add_icon_widget( $widgets ) {
		$widgets[] = 'FokknerCore_Icon_Widget';

		return $widgets;
	}

	add_filter( 'fokkner_core_filter_register_widgets', 'fokkner_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FokknerCore_Icon_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'fokkner_core_icon',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'fokkner_core_icon' );
				$this->set_name( esc_html__( 'Fokkner Icon', 'fokkner-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'fokkner-core' ) );
			}
		}

		public function render( $atts ) {

			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[fokkner_core_icon $params]" ); // XSS OK
		}
	}
}
