<?php

if ( ! function_exists( 'fokkner_core_include_blog_single_author_info_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function fokkner_core_include_blog_single_author_info_template() {
		if ( is_single() ) {
			include_once FOKKNER_CORE_INC_PATH . '/blog/templates/single/author-info/templates/author-info.php';
		}
	}

	add_action( 'fokkner_action_after_blog_post_item', 'fokkner_core_include_blog_single_author_info_template', 15 );  // permission 15 is set to define template position
}

if ( ! function_exists( 'fokkner_core_get_author_social_networks' ) ) {
	/**
	 * Function which includes author info templates on single posts page
	 */
	function fokkner_core_get_author_social_networks( $user_id ) {
		$icons           = array();
		$social_networks = array(
			'facebook',
			'instagram',
			'twitter',
			'linkedin',
			'pinterest',
		);

		foreach ( $social_networks as $network ) {
			$network_meta = get_the_author_meta( 'qodef_user_' . $network, $user_id );

			if ( ! empty( $network_meta ) ) {
				$$network = array(
					'url'   => $network_meta,
					'icon'  => 'fab fa-' . $network,
					'class' => 'qodef-user-social-' . $network,
				);

				if ( $network == 'facebook' ) {

					$$network = array(
						'url'   => $network_meta,
						'icon'  => 'fab fa-' . $network . '-f',
						'class' => 'qodef-user-social-' . $network
					);
				}

				$icons[ $network ] = $$network;
			}
		}

		return $icons;
	}
}
