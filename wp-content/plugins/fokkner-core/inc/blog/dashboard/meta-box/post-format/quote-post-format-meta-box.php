<?php

if ( ! function_exists( 'fokkner_core_add_quote_post_format_meta_box' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param mixed $page - general post format meta box section
	 */
	function fokkner_core_add_quote_post_format_meta_box( $page ) {

		if ( $page ) {
			$post_format_section = $page->add_section_element(
				array(
					'name'  => 'qodef_post_format_quote_section',
					'title' => esc_html__( 'Post Format Quote', 'fokkner-core' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type' => 'textarea',
					'name'       => 'qodef_post_format_quote_text',
					'title'      => esc_html__( 'Quote Text', 'fokkner-core' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_post_format_quote_author',
					'title'      => esc_html__( 'Quote Author', 'fokkner-core' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_post_format_quote_author_position',
					'title'      => esc_html__( 'Quote Author Position', 'fokkner-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'fokkner_core_action_after_quote_post_format_meta_box', $page );
		}
	}

	add_action( 'fokkner_core_action_after_blog_single_meta_box_map', 'fokkner_core_add_quote_post_format_meta_box', 5 );
}
