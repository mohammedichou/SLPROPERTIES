<?php

if ( ! function_exists( 'fokkner_core_property_post_types' ) ) {
	function fokkner_core_property_post_types( $class ) {
		foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/*', GLOB_ONLYDIR ) as $post_type ) {

			if ( 'dashboard' !== basename( $post_type ) ) {
				$is_disabled = fokkner_core_performance_get_option_value( $post_type, 'fokkner_core_performance_post_type_' );

				if ( empty( $is_disabled ) ) {
					$class->set_allowed_post_types( $post_type );
				}
			}
		}
	}

	add_action( 'fokkner_core_action_add_custom_post_type', 'fokkner_core_property_post_types' );
}
