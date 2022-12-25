<?php

class FokknerCore_Comparison_Slider_Shortcode_Elementor extends FokknerCore_Elementor_Widget_Base {

	function __construct( $data = array(), $args = null ) {
		$this->set_shortcode_slug( 'fokkner_core_comparison_slider' );

		parent::__construct( $data, $args );
	}
}

fokkner_core_get_elementor_widgets_manager()->register_widget_type( new FokknerCore_Comparison_Slider_Shortcode_Elementor() );
