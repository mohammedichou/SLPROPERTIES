<?php

if ( ! function_exists( 'fokkner_core_add_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function fokkner_core_add_typography_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FOKKNER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'typography',
				'icon'        => 'fa fa-indent',
				'title'       => esc_html__( 'Typography', 'fokkner-core' ),
				'description' => esc_html__( 'Global Typography Options', 'fokkner-core' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_typography_options_map', $page );
		}
	}

	add_action( 'fokkner_core_action_default_options_init', 'fokkner_core_add_typography_options', fokkner_core_get_admin_options_map_position( 'typography' ) );
}
