<?php

if ( ! function_exists( 'fokkner_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function fokkner_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'FokknerCore_Blog_List_Widget';

		return $widgets;
	}

	add_filter( 'fokkner_core_filter_register_widgets', 'fokkner_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FokknerCore_Blog_List_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'fokkner-core' ),
				)
			);
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'fokkner_core_blog_list',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'fokkner_core_blog_list' );
				$this->set_name( esc_html__( 'Fokkner Blog List', 'fokkner-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'fokkner-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[fokkner_core_blog_list $params]" ); // XSS OK
		}
	}
}
