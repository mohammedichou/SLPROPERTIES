<?php

if ( ! function_exists( 'fokkner_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function fokkner_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'FokknerCore_Social_Share_Widget';

		return $widgets;
	}

	add_filter( 'fokkner_core_filter_register_widgets', 'fokkner_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FokknerCore_Social_Share_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'fokkner_core_social_share',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'fokkner_core_social_share' );
				$this->set_name( esc_html__( 'Fokkner Social Share', 'fokkner-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'fokkner-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[fokkner_core_social_share $params]" ); // XSS OK
		}
	}
}
