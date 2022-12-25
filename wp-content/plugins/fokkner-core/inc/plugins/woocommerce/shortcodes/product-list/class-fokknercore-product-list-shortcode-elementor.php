<?php

class FokknerCore_Product_List_Shortcode_Elementor extends FokknerCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'fokkner_core_product_list' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'woocommerce' ) ) {
	fokkner_core_get_elementor_widgets_manager()->register_widget_type( new FokknerCore_Product_List_Shortcode_Elementor() );
}
