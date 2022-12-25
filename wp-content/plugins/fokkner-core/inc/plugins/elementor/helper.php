<?php

if ( ! function_exists( 'fokkner_core_get_elementor_instance' ) ) {
	/**
	 * Function that return page builder module instance
	 */
	function fokkner_core_get_elementor_instance() {
		return \Elementor\Plugin::instance();
	}
}

if ( ! function_exists( 'fokkner_core_get_elementor_widgets_manager' ) ) {
	/**
	 * Function that return page builder widget module instance
	 */
	function fokkner_core_get_elementor_widgets_manager() {
		return fokkner_core_get_elementor_instance()->widgets_manager;
	}
}

if ( ! function_exists( 'fokkner_core_load_elementor_widgets' ) ) {
	/**
	 * Function that include modules into page builder
	 */
	function fokkner_core_load_elementor_widgets() {
		include_once FOKKNER_CORE_PLUGINS_PATH . '/elementor/class-fokknercore-elementor-widget-base.php';

		$widgets = array();
		foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $shortcode ) {

			if ( basename( $shortcode ) !== 'dashboard' ) {
				$is_disabled = fokkner_core_performance_get_option_value( $shortcode, 'fokkner_core_performance_shortcode_' );

				if ( empty( $is_disabled ) ) {
					foreach ( glob( $shortcode . '/*-elementor.php' ) as $shortcode_load ) {
						$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
					}
				}
			}
		}

		foreach ( glob( FOKKNER_CORE_INC_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
		}

		foreach ( glob( FOKKNER_CORE_CPT_PATH . '/*', GLOB_ONLYDIR ) as $post_type ) {

			if ( 'dashboard' !== basename( $post_type ) ) {
				$is_disabled = fokkner_core_performance_get_option_value( $post_type, 'fokkner_core_performance_post_type_' );

				if ( empty( $is_disabled ) ) {
					foreach ( glob( $post_type . '/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
						$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
					}
				}
			}
		}

		foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
		}

		foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/*/post-types/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
		}

		if ( ! empty( $widgets ) ) {
			ksort( $widgets );

			foreach ( $widgets as $widget ) {
				include_once $widget;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'fokkner_core_load_elementor_widgets' );
}
