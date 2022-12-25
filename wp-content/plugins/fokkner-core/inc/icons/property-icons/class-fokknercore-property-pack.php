<?php

if ( ! function_exists( 'fokkner_core_add_property_icons_to_collection' ) ) {
	/**
	 * Function that add icon font pack into the global list
	 *
	 * @param array $icons
	 *
	 * @return array
	 */
	function fokkner_core_add_property_icons_to_collection( $icons ) {
		$icons[] = 'FokknerCore_Property_Icons_Pack';

		return $icons;
	}

	add_filter( 'qode_framework_filter_add_icon', 'fokkner_core_add_property_icons_to_collection' );
}

if ( class_exists( 'QodeFrameworkIconPack' ) ) {
	class FokknerCore_Property_Icons_Pack extends QodeFrameworkIconPack {

		public function __construct() {
			parent::__construct();
		}

		public function add_icon_pack() {
			$this->set_base( 'property-icons' );
			$this->set_name( 'Property Icons' );
			$this->set_icons( $this->icons_array() );
			$this->set_specific_icons( $this->specific_icons() );
		}

		public function get_style_url() {
			return FOKKNER_CORE_INC_URL_PATH . '/icons/' . $this->get_base() . '/assets/css/' . $this->get_base() . '.min.css';
		}

		private function icons_array() {
			$icons = array(
				''                            => '',
				'qodef-property-360'          => '\e900',
				'qodef-property-bed'          => '\e901',
				'qodef-property-buildings'    => '\e902',
				'qodef-property-key'          => '\e903',
				'qodef-property-photos'       => '\e904',
				'qodef-property-pin'          => '\e905',
				'qodef-property-pool'         => '\e906',
				'qodef-property-sketch'       => '\e907',
				'qodef-property-surveillance' => '\e908',
				'qodef-property-tree'         => '\e909',
				'qodef-property-video'        => '\e90a',
			);

			$formated_icons = array();
			foreach ( $icons as $icon_key => $icon_value ) {
				$formated_icons[ $icon_key ] = $icon_key;
			}

			return $formated_icons;

		}

		function specific_icons() {
			return array();
		}
	}
}
