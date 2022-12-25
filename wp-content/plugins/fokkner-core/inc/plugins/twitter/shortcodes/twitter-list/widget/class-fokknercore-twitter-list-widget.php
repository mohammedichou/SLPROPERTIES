<?php

if ( ! function_exists( 'fokkner_core_add_twitter_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function fokkner_core_add_twitter_list_widget( $widgets ) {
		if ( qode_framework_is_installed( 'twitter' ) ) {
			$widgets[] = 'FokknerCore_Twitter_List_Widget';
		}

		return $widgets;
	}

	add_filter( 'fokkner_core_filter_register_widgets', 'fokkner_core_add_twitter_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FokknerCore_Twitter_List_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'name'       => 'widget_title',
					'field_type' => 'text',
					'title'      => esc_html__( 'Title', 'fokkner-core' ),
				)
			);
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'fokkner_core_twitter_list',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'fokkner_core_twitter_list' );
				$this->set_name( esc_html__( 'Fokkner Twitter List', 'fokkner-core' ) );
				$this->set_description( esc_html__( 'Add a twitter list element into widget areas', 'fokkner-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[fokkner_core_twitter_list $params]" ); // XSS OK
		}
	}
}
