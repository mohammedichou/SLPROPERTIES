<?php

if ( ! function_exists( 'fokkner_core_filter_clients_list_image_only_roll_over' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_filter_clients_list_image_only_roll_over( $variations ) {
		$variations['roll-over'] = esc_html__( 'Roll Over', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_clients_list_image_only_animation_options', 'fokkner_core_filter_clients_list_image_only_roll_over' );
}
