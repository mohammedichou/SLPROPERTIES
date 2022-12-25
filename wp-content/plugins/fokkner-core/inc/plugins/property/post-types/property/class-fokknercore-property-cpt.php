<?php

if ( ! function_exists( 'fokkner_core_register_property_for_meta_options' ) ) {
	function fokkner_core_register_property_for_meta_options( $post_types ) {
		$post_types[] = 'property-item';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'fokkner_core_register_property_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'fokkner_core_register_property_for_meta_options' );
}

if ( ! function_exists( 'fokkner_core_add_property_custom_post_type' ) ) {
	/**
	 * Function that adds custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function fokkner_core_add_property_custom_post_type( $cpts ) {
		$cpts[] = 'FokknerCore_Property_CPT';

		return $cpts;
	}

	add_filter( 'fokkner_core_filter_register_custom_post_types', 'fokkner_core_add_property_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class FokknerCore_Property_CPT extends QodeFrameworkCustomPostType {

		public function map_post_type() {
			$name = esc_html__( 'Property', 'fokkner-core' );
			$this->set_base( 'property-item' );
			$this->set_menu_position( 5 );
			$this->set_menu_icon( 'dashicons-tide' );
			$this->set_slug( 'property-item' );
			$this->set_name( $name );
			$this->set_path( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property' );
			$this->set_labels(
				array(
					'name'          => esc_html__( 'Fokkner Property', 'fokkner-core' ),
					'singular_name' => esc_html__( 'Property Item', 'fokkner-core' ),
					'add_item'      => esc_html__( 'New Property Item', 'fokkner-core' ),
					'add_new_item'  => esc_html__( 'Add New Property Item', 'fokkner-core' ),
					'edit_item'     => esc_html__( 'Edit Property Item', 'fokkner-core' ),
				)
			);
			$this->set_supports(
				array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes',
					'comments',
				)
			);

			$this->add_post_taxonomy(
				array(
					'base'          => 'property-category',
					'slug'          => 'property-category',
					'singular_name' => esc_html__( 'Category', 'fokkner-core' ),
					'plural_name'   => esc_html__( 'Categories', 'fokkner-core' ),
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'property-tag',
					'slug'          => 'property-tag',
					'singular_name' => esc_html__( 'Tag', 'fokkner-core' ),
					'plural_name'   => esc_html__( 'Tags', 'fokkner-core' ),
				)
			);
		}
	}
}
