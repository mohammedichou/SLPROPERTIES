<?php

class FokknerCore_Google_Map_Shortcode_Elementor extends FokknerCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'fokkner_core_google_map' );

		parent::__construct( $data, $args );
	}
}

fokkner_core_get_elementor_widgets_manager()->register_widget_type( new FokknerCore_Google_Map_Shortcode_Elementor() );
