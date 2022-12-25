<?php

class FokknerCore_Blog_List_Shortcode_Elementor extends FokknerCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'fokkner_core_blog_list' );

		parent::__construct( $data, $args );
	}
}

fokkner_core_get_elementor_widgets_manager()->register_widget_type( new FokknerCore_Blog_List_Shortcode_Elementor() );
