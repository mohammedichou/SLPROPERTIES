<?php

if ( ! function_exists( 'fokkner_core_property_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param int $position
	 * @param string $map
	 *
	 * @return int
	 */
	function fokkner_core_property_set_admin_options_map_position( $position, $map ) {

		if ( 'property' === $map ) {
			$position = 55;
		}

		return $position;
	}

	add_filter( 'fokkner_core_filter_admin_options_map_position', 'fokkner_core_property_set_admin_options_map_position', 10, 2 );
}
