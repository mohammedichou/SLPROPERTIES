<?php

class FokknerCore_Property_Image_Map_Gallery_Shortcode_Elementor extends FokknerCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'fokkner_core_property_image_map_gallery' );

		parent::__construct( $data, $args );
	}
}

fokkner_core_get_elementor_widgets_manager()->register_widget_type( new FokknerCore_Property_Image_Map_Gallery_Shortcode_Elementor() );
